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

	public function presensi()
	{
		$data['aktif'] = 'laporan';
        $data['judul'] = 'Laporan Presensi';
        $data['konten'] = 'laporan/presensi';
        $data['menu'] = array("Laporan", "Laporan Presensi");
        
        $this->load->view('index', $data);
	}

	public function detil()
	{
		$data['aktif'] = 'laporan';
        $data['judul'] = 'Laporan Detil Presensi';
        $data['konten'] = 'laporan/detil_presensi';
        $data['menu'] = array("Laporan", "Laporan Detil Presensi");
        
        $this->load->view('index', $data);
	}
}
?>