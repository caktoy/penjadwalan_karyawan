<?php  
/**
* 
*/
class Presensi extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['aktif'] = 'presensi';
        $data['judul'] = 'Presensi';
        $data['konten'] = 'presensi/input_presensi';
        $data['menu'] = array("Presensi");
        
        $this->load->view('index', $data);
	}

	public function jadwal_teknisi()
	{
		$tanggal = $this->input->post('tanggal');
		$tgl = date('Y-m-d', strtotime($tanggal));

		$data['tanggal'] = $tgl;
		$data['jadwal'] = $this->tbl_jadwal->get_input_presensi($tgl);

		$this->load->view('presensi/form_input', $data);
	}

	public function update()
	{
		$teknisi = $this->input->post('teknisi');
		$tanggal = $this->input->post('tanggal');

		echo "tanggal: ".$tanggal."<br>";
		$arr_teknisi = explode(";", $teknisi);
		$act = 0;
		foreach ($arr_teknisi as $t) {
			$value = $this->input->post($t);
			$query = $this->tbl_jadwal->update_keterangan($tanggal, $t, $value);
			if($query > 0) $act++;
		}

		if($act > 0)
			$this->session->set_flashdata('pesan', '<b>Berhasil!</b> Data presensi telah disimpan.');
		else 
			$this->session->set_flashdata('pesan', '<b>Gagal!</b> Data presensi gagal disimpan.');

		redirect('presensi');
	}

	public function cek_isi($tanggal)
	{
		$cek_isi = $this->tbl_jadwal->check_isi($tanggal);
		if(count($cek_isi) > 0)
			echo "ada";
		else
			echo "tidak";
	}
}
?>