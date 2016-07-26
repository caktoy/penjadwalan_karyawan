<?php  
/**
* 
*/
class Laporan extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function presensi($act = null)
	{
		switch ($act) {
			case 'lihat':
				# menampilkan preview laporan
				$awal = $this->input->post('awal');
				$akhir = $this->input->post('akhir');

				$data['aktif'] = 'laporan';
		        $data['judul'] = 'Laporan Presensi Teknisi';
		        $data['subjudul'] = date('d M Y', strtotime($awal)).' - '.date('d M Y', strtotime($akhir));
		        $data['konten'] = 'laporan/presensi_lihat';
		        $data['menu'] = array("Laporan", "Laporan Presensi");
		        $data['presensi'] = $this->tbl_jadwal->get_presensi($awal, $akhir);
		        $data['awal'] = $awal;
		        $data['akhir'] = $akhir;

		        $tgl_awal = date_create($awal);
		        $tgl_akhir = date_create($akhir);
		        $data['periode'] = date_diff($tgl_awal, $tgl_akhir);
		        $data['cetak'] = base_url().'laporan/presensi/cetak';

		        $this->load->view('index', $data);
				break;

			case 'cetak':
				# action untuk cetak jadi pdf
				$awal = $this->input->post('awal');
				$akhir = $this->input->post('akhir');

		        $data['judul'] = 'Laporan Presensi Teknisi';
		        $data['subjudul'] = date('d M Y', strtotime($awal)).' - '.date('d M Y', strtotime($akhir));
		        $data['presensi'] = $this->tbl_jadwal->get_presensi($awal, $akhir);
		        $tgl_awal = date_create($awal);
		        $tgl_akhir = date_create($akhir);
		        $data['periode'] = date_diff($tgl_awal, $tgl_akhir);
		        
		        $this->pdfgenerator->generate('laporan/presensi_lihat', 'presensi_'.$awal.'_'.$akhir, 'portrait', 'a4', $data);
				break;
			
			default:
				# halaman utama laporan presensi
				$data['aktif'] = 'laporan';
		        $data['judul'] = 'Laporan Presensi';
		        $data['konten'] = 'laporan/presensi';
		        $data['menu'] = array("Laporan", "Laporan Presensi");
		        
		        $this->load->view('index', $data);
				break;
		}
	}

	public function detil($act = null)
	{
		switch ($act) {
			case 'lihat':
				# menampilkan preview 
				$awal = $this->input->post('awal');
				$akhir = $this->input->post('akhir');

				$data['aktif'] = 'laporan';
		        $data['judul'] = 'Laporan Detil Presensi Teknisi';
		        $data['subjudul'] = date('d M Y', strtotime($awal)).' - '.date('d M Y', strtotime($akhir));
		        $data['konten'] = 'laporan/detil_presensi_lihat';
		        $data['menu'] = array("Laporan", "Laporan Presensi");

		        $data['teknisi'] = $this->tbl_teknisi->get_where(array('teknisi.status' => 'Y'));
		        $data['sites'] = $this->tbl_site->get_where(array('site.status' => 'Y'));
		        
		        $begin = new DateTime($awal);
				$end = new DateTime($akhir.' + 1 day');
				$interval = DateInterval::createFromDateString('1 day');
				$period = new DatePeriod($begin, $interval, $end);

		        $arr_detil = array();
		        $row_idx = 0;
				foreach ($period as $dt) {
					$row = array();
					$row[0] = $dt->format( "d M Y" );
					$col = 1;
			        foreach ($data['sites'] as $site) {
			        	$kehadiran = $this->tbl_jadwal->get_where(
			        		array(
			        			'jadwal.tanggal' => $dt->format('m/d/Y'), 
			        			'jadwal.id_site' => $site->id_site
			        			)
			        		);
			        	if(count($kehadiran) > 0) {
			        		$teknisi = '';
			        		$keterangan = '';
			        		$idx_kehadiran = 0;
			        		foreach ($kehadiran as $k) {
			        			$teknisi = $teknisi.$k->id_teknisi;
			        			$keterangan = $keterangan.$k->keterangan;
			        			$idx_kehadiran++;
			        			if($idx_kehadiran < count($kehadiran)) {
			        				$teknisi = $teknisi.', ';
			        				$keterangan = $keterangan.';';
			        			}
			        		}

				        	$row[$col] = $teknisi;
				        	$row[$col + 1] = $keterangan;
			        	} else {
			        		$row[$col] = null;
				        	$row[$col + 1] = null;
			        	}
			        	$col += 2;
			        }
			        $arr_detil[$row_idx] = $row;
			        $row_idx++;
				}

		        $data['presensi'] = $arr_detil;

		        $data['awal'] = $awal;
		        $data['akhir'] = $akhir;
		        $data['cetak'] = base_url().'laporan/detil/cetak';

		        $this->load->view('index', $data);
				break;

			case 'cetak':
				# action untuk meng-generate file pdf
				$awal = $this->input->post('awal');
				$akhir = $this->input->post('akhir');

		        $data['judul'] = 'Laporan Detil Presensi Teknisi';
		        $data['subjudul'] = date('d M Y', strtotime($awal)).' - '.date('d M Y', strtotime($akhir));
		        
		        $data['teknisi'] = $this->tbl_teknisi->get_where(array('teknisi.status' => 'Y'));
		        $data['sites'] = $this->tbl_site->get_where(array('site.status' => 'Y'));
		        
		        $begin = new DateTime($awal);
				$end = new DateTime($akhir.' + 1 day');
				$interval = DateInterval::createFromDateString('1 day');
				$period = new DatePeriod($begin, $interval, $end);

		        $arr_detil = array();
		        $row_idx = 0;
				foreach ($period as $dt) {
					$row = array();
					$row[0] = $dt->format( "d M Y" );
					$col = 1;
			        foreach ($data['sites'] as $site) {
			        	$kehadiran = $this->tbl_jadwal->get_where(
			        		array(
			        			'jadwal.tanggal' => $dt->format('m/d/Y'), 
			        			'jadwal.id_site' => $site->id_site
			        			)
			        		);
			        	if(count($kehadiran) > 0) {
			        		$teknisi = '';
			        		$keterangan = '';
			        		$idx_kehadiran = 0;
			        		foreach ($kehadiran as $k) {
			        			$teknisi = $teknisi.$k->id_teknisi;
			        			$keterangan = $keterangan.$k->keterangan;
			        			$idx_kehadiran++;
			        			if($idx_kehadiran < count($kehadiran)) {
			        				$teknisi = $teknisi.', ';
			        				$keterangan = $keterangan.';';
			        			}
			        		}

				        	$row[$col] = $teknisi;
				        	$row[$col + 1] = $keterangan;
			        	} else {
			        		$row[$col] = null;
				        	$row[$col + 1] = null;
			        	}
			        	$col += 2;
			        }
			        $arr_detil[$row_idx] = $row;
			        $row_idx++;
				}

		        $data['presensi'] = $arr_detil;
		        
		        $this->pdfgenerator->generate('laporan/detil_presensi_lihat', 'detil_presensi_'.$awal.'_'.$akhir, 'landscape', 'a4', $data);
				break;
			
			default:
				# halaman utama laporan detil presensi
				$data['aktif'] = 'laporan';
		        $data['judul'] = 'Laporan Detil Presensi';
		        $data['konten'] = 'laporan/detil_presensi';
		        $data['menu'] = array("Laporan", "Laporan Detil Presensi");
		        
		        $this->load->view('index', $data);
				break;
		}
	}

	private function getFirstDateOfWeek($tahun, $week)
	{
		date_default_timezone_set('Asia/Jakarta');
		$date = new DateTime();
		$date->setISODate($tahun, $week);
		return $date;
	}

	public function teknisi($act = null)
	{
		switch ($act) {
			case 'lihat':
				# menampilkan preview laporan
				$tahun = $this->input->post('tahun');
				$id_teknisi = $this->input->post('teknisi');
				$teknisi = $this->tbl_teknisi->get_id($id_teknisi);

				$data['aktif'] = 'laporan';
		        $data['judul'] = 'Laporan Jadwal Teknisi';
		        $data['subjudul'] = 'Tahun '.$tahun;
		        $data['konten'] = 'laporan/teknisi_lihat';
		        $data['menu'] = array("Laporan", "Laporan Jadwal Teknisi");
		        $data['teknisi'] = $teknisi;
		        $data['id_teknisi'] = $id_teknisi;
		        $data['tahun'] = $tahun;

		        $data['cetak'] = base_url().'laporan/teknisi/cetak';

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
			        	$jadwal_tgl = $this->tbl_jadwal->get_where(array('jadwal.tanggal' => $tanggal->format('Y-m-d'), 
			        		'jadwal.id_site' => $site->id_site));
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

		        $this->load->view('index', $data);
				break;

			case 'cetak':
				# action untuk cetak jadi pdf
				$tahun = $this->input->post('tahun');
				$id_teknisi = $this->input->post('teknisi');
				$teknisi = $this->tbl_teknisi->get_id($id_teknisi);

		        $data['judul'] = 'Laporan Jadwal Teknisi';
		        $data['subjudul'] = 'Tahun '.$tahun;
		        $data['teknisi'] = $teknisi;
		        $data['id_teknisi'] = $id_teknisi;
		        $data['tahun'] = $tahun;
		        
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
			        	$jadwal_tgl = $this->tbl_jadwal->get_where(array('jadwal.tanggal' => $tanggal->format('Y-m-d'), 
			        		'jadwal.id_site' => $site->id_site));
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
		        
		        $this->pdfgenerator->generate('laporan/teknisi_lihat', 'jadwal_teknisi_'.$id_teknisi, 'landscape', 'a4', $data);
				break;
			
			default:
				# halaman utama laporan presensi
				$data['aktif'] = 'laporan';
		        $data['judul'] = 'Laporan Jadwal Teknisi';
		        $data['konten'] = 'laporan/teknisi';
		        $data['menu'] = array("Laporan", "Laporan Jadwal Teknisi");
		        
		        $data['teknisi'] = $this->tbl_teknisi->get_where(array('teknisi.status' => 'Y'));

		        $this->load->view('index', $data);
				break;
		}
	}
}
?>