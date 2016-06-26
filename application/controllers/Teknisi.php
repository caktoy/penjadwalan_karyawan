<?php
class Teknisi extends CI_Controller {
    
    public function index() {
        $data['aktif'] = 'master';
        $data['judul'] = 'Master Teknisi';
        $data['konten'] = 'master/teknisi';
        $data['menu'] = array("Data Master", "Master Teknisi");
        
        $data['kota'] = $this->tbl_kota->get_where(array('kota.status' => 'Y'));
        $data['teknisi'] = $this->tbl_teknisi->get_where(array('teknisi.status' => 'Y'));
        
        $data['id_teknisi'] = $this->tbl_teknisi->genId();
        
        $this->load->view('index', $data);
    }
    
    public function tambah_ubah() {
        $id = $this->input->post('id');
        $kota_lokasi = $this->input->post('tmp_lokasi');
        $kota_lahir = $this->input->post('tmp_lahir');
        $nama = $this->input->post('nama');
        $alamat = $this->input->post('alamat');
        $telp = $this->input->post('telp');
        $email = $this->input->post('email');
        $tgl = $this->input->post('tgl_lahir');
        $agama = $this->input->post('agama');
        $jk = $this->input->post('jk');
        $status = "Y";

        $check_tech = $this->tbl_teknisi->get_where(
                array(
                        'lower(id_kota_lahir)'          => strtolower($kota_lahir),
                        'lower(nama_teknisi)'           => strtolower($nama),
                        'tanggal_lahir_teknisi'         => $tgl,
                        'lower(agama_teknisi)'          => strtolower($agama),
                        'lower(jenis_kelamin_teknisi)'  => strtolower($jk)
                    )
            );
        
        if(count($check_tech) > 0) {
            $id = $check_tech[0]->id_teknisi;
            $act = $this->tbl_teknisi->edit($id, $kota_lokasi, $kota_lahir, $nama, $alamat, $telp, $email, $tgl, $agama, $jk, $status);
        } else {
            $check = $this->tbl_teknisi->get_id($id);
            if(sizeof($check) > 0)
                $act = $this->tbl_teknisi->edit($id, $kota_lokasi, $kota_lahir, $nama, $alamat, $telp, $email, $tgl, $agama, $jk, $status);
            else
                $act = $this->tbl_teknisi->add($id, $kota_lokasi, $kota_lahir, $nama, $alamat, $telp, $email, $tgl, $agama, $jk, $status);
        }
            
        if ($act > 0) {
            $this->session->set_flashdata('pesan', '<b>Berhasil!</b> Data teknisi telah disimpan.');
        } else {
            $this->session->set_flashdata('pesan', '<b>Gagal!</b> Data teknisi gagal disimpan.');
        }

        redirect('teknisi');
    }
    
    public function detil() {
        $id = $this->input->post('id');
        $teknisi = $this->tbl_teknisi->get_id($id);
        header("Content-Type: application/json");
        echo json_encode($teknisi);
    }
    
    public function activate($id) {
        $check = $this->tbl_teknisi->get_id($id)[0]->status;
        if($check == "Y") {
            $act = $this->tbl_teknisi->deactivate($id);
            
            if ($act > 0)
                $this->session->set_flashdata('pesan', '<b>Berhasil!</b> Data teknisi telah dinon-aktifkan.');
            else 
                $this->session->set_flashdata('pesan', '<b>Gagal!</b> Data teknisi gagal dinon-aktifkan.');
        } else {
            $act = $this->tbl_teknisi->activate($id);
            
            if ($act > 0)
                $this->session->set_flashdata('pesan', '<b>Berhasil!</b> Data teknisi telah diaktifkan.');
            else 
                $this->session->set_flashdata('pesan', '<b>Gagal!</b> Data teknisi gagal diaktifkan.');
        }
        redirect('teknisi');
    }
}
?>