<?php
class Kota extends CI_Controller {
    
    public function index() {
        $data['aktif'] = 'master';
        $data['judul'] = 'Master Provinsi & Kota';
        $data['konten'] = 'master/kota';
        $data['menu'] = array("Data Master", "Master Provinsi & Kota");
        
        $data['provinsi'] = $this->tbl_provinsi->get_active();
        $data['kota'] = $this->tbl_kota->get_all();
        
        $data['id_kota'] = $this->tbl_kota->genId();
        
        $this->load->view('index', $data);
    }
    
    public function get_provinsi(){
        $id = $this->input->post('id');
        $kota = $this->tbl_kota->get_id($id);
        if(count($kota) > 0)
            echo $kota[0]->nama_provinsi;
        else 
            echo null;
    }

    public function provinsi()
    {
        $prov = $this->input->post('provinsi');
        $provinsi = $this->tbl_kota->get_provinsi($prov);
        header("Content-Type: application/json");
        echo json_encode($provinsi);
    }
    
    public function tambah_provinsi() {
        $id_provinsi = $this->tbl_provinsi->genId();
        $nama_provinsi = $this->input->post('nama_prov_new');
        $status = 'Y';
        
        $act = $this->tbl_provinsi->add($id_provinsi, $nama_provinsi, $status);
        if ($act > 0) {
                $this->session->set_flashdata('pesan', '<b>Berhasil!</b> Data provinsi telah disimpan.');
        } else {
                $this->session->set_flashdata('pesan', '<b>Gagal!</b> Data provinsi gagal disimpan.');
        }
        redirect('kota');
    }

    public function ubah_provinsi() {
        $id_provinsi = $this->input->post('id_provinsi-u');
        $nama_provinsi = $this->input->post('nama_provinsi-u');
        $status = $this->input->post('status-u');
        
        $act = $this->tbl_provinsi->edit($id_provinsi, $nama_provinsi, $status);
        if ($act > 0) {
                $this->session->set_flashdata('pesan', '<b>Berhasil!</b> Data provinsi telah diubah.');
        } else {
                $this->session->set_flashdata('pesan', '<b>Gagal!</b> Data provinsi gagal diubah.');
        }
        redirect('kota');
    }
    
    public function tambah_ubah_kota() {
        $id_kota = $this->input->post('id_kota');
        $id_provinsi = $this->input->post('provinsi');
        $nama_kota = $this->input->post('nama_kota');
        $status = 'Y';
        
        $check = $this->tbl_kota->get_id($id_kota);
        if(count($check) > 0)
            $act = $this->tbl_kota->edit($id_kota, $id_provinsi, $nama_kota, $status);
        else
            $act = $this->tbl_kota->add($id_kota, $id_provinsi, $nama_kota, $status);
        
        if ($act > 0) {
                $this->session->set_flashdata('pesan', '<b>Berhasil!</b> Data kota telah disimpan.');
        } else {
                $this->session->set_flashdata('pesan', '<b>Gagal!</b> Data kota gagal disimpan.');
        }
        redirect('kota');
    }
    
    public function activate_kota($id) {
        $check = $this->tbl_kota->get_id($id)[0]->status;
        if($check == "Y") {
            $act = $this->tbl_kota->deactivate($id);
            
            if ($act > 0)
                $this->session->set_flashdata('pesan', '<b>Berhasil!</b> Data kota telah dinon-aktifkan.');
            else 
                $this->session->set_flashdata('pesan', '<b>Gagal!</b> Data kota gagal dinon-aktifkan.');
        } else {
            $act = $this->tbl_kota->activate($id);
            
            if ($act > 0)
                $this->session->set_flashdata('pesan', '<b>Berhasil!</b> Data kota telah diaktifkan.');
            else 
                $this->session->set_flashdata('pesan', '<b>Gagal!</b> Data kota gagal diaktifkan.');
        }
        redirect('kota');
    }
    
    public function activate_provinsi($id) {
        $check = $this->tbl_provinsi->get_id($id)[0]->status;
        if($check == "Y") {
            $act = $this->tbl_provinsi->deactivate($id);
            
            if ($act > 0)
                $this->session->set_flashdata('pesan', '<b>Berhasil!</b> Data provinsi telah dinon-aktifkan.');
            else 
                $this->session->set_flashdata('pesan', '<b>Gagal!</b> Data provinsi gagal dinon-aktifkan.');
        } else {
            $act = $this->tbl_provinsi->activate($id);
            
            if ($act > 0)
                $this->session->set_flashdata('pesan', '<b>Berhasil!</b> Data provinsi telah diaktifkan.');
            else 
                $this->session->set_flashdata('pesan', '<b>Gagal!</b> Data provinsi gagal diaktifkan.');
        }
        redirect('kota');
    }
}
?>