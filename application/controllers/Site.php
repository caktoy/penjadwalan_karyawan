<?php
class Site extends CI_Controller {
    
    public function index() {
        $data['aktif'] = 'master';
        $data['judul'] = 'Master Site';
        $data['konten'] = 'master/site';
        $data['menu'] = array("Data Master", "Master Site");
        
        $data['kota'] = $this->tbl_kota->get_where(array('kota.status' => 'Y'));
        $data['site'] = $this->tbl_site->get_all();
        
        $data['id_site'] = $this->tbl_site->genId();
        
        $this->load->view('index', $data);
    }
    
    public function detil() {
        $id = $this->input->post('id');
        $site = $this->tbl_site->get_id($id);
        header("Content-Type: application/json");
        echo json_encode($site);
    }
    
    public function tambah_ubah() {
        $id = $this->input->post('id');
        $kota = $this->input->post('kota');
        $nama = $this->input->post('nama');
        $alamat = $this->input->post('alamat');
        $telp = $this->input->post('telp');
        $status = "Y";
        
        $check = $this->tbl_site->get_id($id);
        if(sizeof($check) > 0)
            $act = $this->tbl_site->edit($id, $kota, $nama, $alamat, $telp, $status);
        else
            $act = $this->tbl_site->add($id, $kota, $nama, $alamat, $telp, $status);
        
        if ($act > 0) {
                $this->session->set_flashdata('pesan', '<b>Berhasil!</b> Data site telah disimpan.');
        } else {
                $this->session->set_flashdata('pesan', '<b>Gagal!</b> Data site gagal disimpan.');
        }
        redirect('site');
    }
    
    public function activate($id) {
        $check = $this->tbl_site->get_id($id)[0]->STATUS;
        if($check == "Y") {
            $act = $this->tbl_site->deactivate($id);
            
            if ($act > 0)
                $this->session->set_flashdata('pesan', '<b>Berhasil!</b> Data site telah dinon-aktifkan.');
            else 
                $this->session->set_flashdata('pesan', '<b>Gagal!</b> Data site gagal dinon-aktifkan.');
        } else {
            $act = $this->tbl_site->activate($id);
            
            if ($act > 0)
                $this->session->set_flashdata('pesan', '<b>Berhasil!</b> Data site telah diaktifkan.');
            else 
                $this->session->set_flashdata('pesan', '<b>Gagal!</b> Data site gagal diaktifkan.');
        }
        redirect('site');
    }
}
?>