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

	public function do($tahun, $kerja, $libur)
	{
		echo "Tahun: ".$tahun.";Kerja: ".$kerja.";Libur: ".$libur;
	}
}
?>