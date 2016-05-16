<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {
    
    public function index() {
        $data['aktif'] = 'beranda';
        $data['judul'] = 'Beranda';
        $data['konten'] = 'beranda';
        $data['menu'] = array("Beranda");
        
        $this->load->view('index', $data);
    }
}
?>