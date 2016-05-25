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
}
?>