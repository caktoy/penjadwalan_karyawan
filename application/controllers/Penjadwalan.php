<?php  
/**
* 
*/
class Penjadwalan extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['aktif'] = 'penjadwalan';
        $data['judul'] = 'Penjadwalan';
        $data['konten'] = 'penjadwalan/pengaturan_awal';
        $data['menu'] = array("Penjadwalan");

        $setting = read_file('./pengaturan_penjadwalan.txt');
        if($setting == null) {
        	$tahun = date('Y');
        	$kerja = 0;
        	$libur = 0;
        } else {
        	$set = explode(';', $setting);
        	$tahun = $set[0];
        	$kerja = $set[1];
        	$libur = $set[2];
        }
        $data['setting'] = array(
        	'tahun' => $tahun,
        	'kerja' => $kerja,
        	'libur' => $libur
        	);
        
        $this->load->view('index', $data);
	}

	public function save_setting()
	{
		$tahun = $this->input->post('tahun');
		$kerja = $this->input->post('kerja');
		$libur = $this->input->post('libur');

		$setting = $tahun.';'.$kerja.';'.$libur.';';
		if(write_file('./pengaturan_penjadwalan.txt', $setting)) {
			$this->session->set_flashdata('pesan', '<b>Berhasil!</b> Pengaturan penjadwalan telah disimpan.');
		} else {
			$this->session->set_flashdata('pesan', '<b>Berhasil!</b> Pengaturan penjadwalan gagal disimpan.');
		}

		redirect('penjadwalan');
	}

	public function check_year()
	{
		$tahun = $this->input->post('tahun');
		$jadwal = $this->tbl_jadwal->get_where(array(
				'extract(year from tanggal) =' => $tahun
			));
		
        echo count($jadwal);
	}

	public function lihat_jadwal($tahun)
	{
		$data['aktif'] 	= 'penjadwalan';
        $data['judul'] 	= 'Jadwal Tahun '.$tahun;
        $data['konten']	= 'penjadwalan/lihat_jadwal';
        $data['menu'] 	= array("Penjadwalan", "Lihat Jadwal", $tahun);
        $data['tahun'] = $tahun;
        $data['jadwal']	= $this->tbl_jadwal->get_where(array(
				'extract(year from tanggal) =' => $tahun
			));

        $this->load->view('index', $data);
	}

	private function getFirstDateOfWeek($tahun, $week)
	{
		date_default_timezone_set('Asia/Jakarta');
		$date = new DateTime();
		$date->setISODate($tahun, $week);
		return $date;
	}

	public function cetak_jadwal($tahun)
	{
        $data['judul'] = 'Jadwal Teknisi';
        $data['subjudul'] = "Tahun: ".$tahun;
        
        $arr_tanggal = array();
        for ($i=0; $i < 52; $i++) { 
        	$tanggal = $this->getFirstDateOfWeek($tahun, $i);
        	$arr_tanggal[$i] = $tanggal;
        }

        $sites = $this->tbl_jadwal->distinct_site($tahun);
        $arr_jadwal = array();
        foreach ($sites as $site) {
        	$arr_site = array();
        	$idx_col = 0;
	        foreach ($arr_tanggal as $tanggal) {
	        	$jadwal_tgl = $this->tbl_jadwal->get_where(array('jadwal.tanggal' => $tanggal->format('Y-m-d'), 'jadwal.id_site' => $site->id_site));
	        	if(count($jadwal_tgl) > 0) {
	        		$teknisi = "";
	        		$idx_jdwl = 0;
	        		foreach ($jadwal_tgl as $jdwl) {
	        			$teknisi .= $jdwl->id_teknisi;
	        			$idx_jdwl++;

	        			if($idx_jdwl < count($jadwal_tgl))
	        				$teknisi .= ", ";
	        		}
	        	} else {
	        		$teknisi = null;
	        	}
	        	$arr_site[$idx_col] = $teknisi;
	        	$idx_col++;
	        }
	        $arr_jadwal[$site->nama_site] = $arr_site;
        }

        $data['jadwal'] = $arr_jadwal;
        $data['teknisi'] = $this->tbl_jadwal->distinct_teknisi($tahun);
        
        $this->pdfgenerator->generate('penjadwalan/jadwal_tahun', 'jadwal_tahun_'.$tahun, 'landscape', 'a3', $data);
	}

	private function getStartEndDate($week, $year)
	{
		$dto = new DateTime();
		$ret['start'] = $dto->setISODate($year, $week)->format('Y-m-d');
		$ret['end'] = $dto->modify('+6 days')->format('Y-m-d');
		return $ret;
	}

	private function getDates($start, $finish)
	{
		$begin = new DateTime($start);
		$end = new DateTime($finish);
		$end->modify('+1 day');
		
		$daterange = new DatePeriod($begin, new DateInterval("P1D"), $end);
		$arr_dates = array();
		$idx = 0;
		foreach ($daterange as $date) {
			$arr_dates[$idx] = $date->format("Y-m-d");
			$idx++;
		}
		return $arr_dates;
	}

	public function do()
	{
		$tahun = $this->input->post('tahun');
		$kerja = $this->input->post('kerja');
		$libur = $this->input->post('libur');

		$setting = $tahun.';'.$kerja.';'.$libur.';';
		write_file('./pengaturan_penjadwalan.txt', $setting);

		$total_week		= date('W', strtotime('December 31st, '.$tahun));
		// $round			= floor($total_week/$kerja);
		$round			= 52;
		$sites			= $this->tbl_site->get_where(array('site.status' => 'Y'));
		$technicians	= $this->tbl_teknisi->get_where(array('teknisi.status' => 'Y'));
		$site_total		= count($sites);

		$hasil = array();
		for ($r=0; $r<$round; $r++) { 
			$row = array();
			$pembagi	= $site_total - 1;
			$sudah_ada_baris = 0;
			for($i=0; $i<count($sites); $i++) {
				$pembilang 	= $i - $r;
				
				$j 			= $pembilang % $pembagi;
				if($j == 0) {
					$j = $pembagi;
					if($sudah_ada_baris == 1)
						$j = $j * 2;
					$sudah_ada_baris = 1;
				} else {
					$j = $j + 5;
				}

				// masukkan hasil hitung proses ke array $row, dengan key:id_site dan value:hasil proses
				$row[$i] = $j;
			}

			// cek lagi, apakah nilai didalam baris yang akan ditambahkan sudah ada,
			foreach ($row as $key_row => $value_row) {
				for($i=0; $i<count($hasil); $i++) {
					$val_hasil = element($key_row, $hasil[$i]);
					if($value_row == $val_hasil) {
						if($value_row == $site_total - 1) {
							$value_row = $value_row * 2;
						} else {
							$value_row = $value_row / 2;
						}

						$row[$key_row] = $value_row;
					}
				}
			}
			// masukkan array $row ke array $hasil, dengan key:$r dan value:$row
			$hasil[$r] = $row;
		}
		// putar hasil dari perhitungan untuk digunakan sebagai dasar plot
		// ini hasil akhir perhitungan round
		$reverse_hasil = array();
		for($i=0; $i<count($hasil[0]); $i++) {
			$row = array();
			for($j=0; $j<count($hasil); $j++) {
				$row[$j] = $hasil[$j][$i];
			}
			$reverse_hasil[$i] = $row;
		}

		// ambil kolom pertama dari hasil akhir round
		$first_tech = $reverse_hasil[0];

		// lanjutkan ke proses ploting jadwal teknisi
		$arr_jadwal = array();
		for($row = 0; $row < count($sites); $row++) {
			$arr_row = array();
			$step = 8; 
			$step_teknisi = 0;
			$teknisi_terakhir = 0;
			for ($col = 0; $col < $total_week; $col++) { 
				$nilai = null;
				if($col == $step) {
					$step = $step + 8;
					$step_teknisi++;
				}
				if($step <= $total_week) {
					$teknisi_terakhir = $first_tech[$step_teknisi];
					$nilai = $first_tech[$step_teknisi];
				} else {
					$nilai = $teknisi_terakhir - 1;
				}
				$arr_row[$col] = $nilai;
			}
			$arr_jadwal[$row] = $arr_row;
		}
		$arr_jadwal_final = $this->jadwal->dictionaries(count($sites), count($technicians), $kerja, $libur);
		if(count($arr_jadwal_final) != count($sites)) {
			$this->session->set_flashdata('pesan', '<b>Gagal!</b> Proses penjadwalan gagal dilakukan. Pastikan jumlah site dan teknisi tersedia.');
			redirect("penjadwalan");
		} else {
			// header("Content-Type: application/json");
			// echo json_encode($arr_jadwal_final);
			$this->tbl_jadwal->remove_tahun($tahun);
			$idx_site = 0; 
			foreach ($arr_jadwal_final as $jadwal_row) {
				for ($i=0; $i < count($jadwal_row); $i++) { 
					$start_end_date = $this->getStartEndDate($i, $tahun);
					$arr_dates = $this->getDates($start_end_date['start'], $start_end_date['end']);
					foreach ($arr_dates as $date) {
						// ambil semua parameter selain tanggal
						# site
						$id_site = $sites[$idx_site]->id_site;
						# teknisi -> bisa jadi lebih dari 1
						$arrtek = explode(",", $jadwal_row[$i]);
						foreach ($arrtek as $tekn) {
							$id_teknisi = $technicians[$tekn - 1]->id_teknisi;
							$this->tbl_jadwal->remove($id_teknisi, $id_site, $date);
							$this->tbl_jadwal->add($id_teknisi, $id_site, $date, null);
						}
					}
				}
				$idx_site++;
			}

			redirect("penjadwalan/lihat_jadwal/".$tahun);
		}
	}
}
?>