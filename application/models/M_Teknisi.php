<?php

class M_Teknisi extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    public function get_all()
    {
        $this->db->select("teknisi.*, kota.NAMA_KOTA");
        $this->db->from("teknisi");
        $this->db->join("kota", "teknisi.ID_KOTA = kota.ID_KOTA", "left");
        return $this->db->get()->result();
    }

    public function get_id($id)
    {
        $this->db->select("teknisi.*, kota.NAMA_KOTA");
        $this->db->from("teknisi");
        $this->db->join("kota", "teknisi.ID_KOTA = kota.ID_KOTA", "left");
        $this->db->where("id_teknisi", $id);
        return $this->db->get()->result();
    }
    
    public function get_kota($kota) {
        $this->db->select("teknisi.*, kota.NAMA_KOTA");
        $this->db->from("teknisi");
        $this->db->join("kota", "teknisi.ID_KOTA = kota.ID_KOTA", "left");
        $this->db->where("id_kota", $kota);
        return $this->db->get()->result();
    }
    
    public function get_where(array $cond)
    {
        $this->db->select("teknisi.*, kota.NAMA_KOTA");
        $this->db->from("teknisi");
        $this->db->join("kota", "teknisi.ID_KOTA = kota.ID_KOTA", "left");
        $this->db->where($cond);
        return $this->db->get()->result();
    }

    public function add($id, $kota, $nama, $alamat, $telp, $email, $tgl, $agama, $jk, $status)
    {
        return $this->db->insert('teknisi', array(
            'id_teknisi' => $id,
            'id_kota' => $kota,
            'nama_teknisi' => $nama,
            'alamat_teknisi' => $alamat,
            'no_telp_teknisi' => $telp,
            'email_teknisi' => $email,
            'tanggal_lahir_teknisi' => $tgl,
            'agama_teknisi' => $agama,
            'jenis_kelamin_teknisi' => $jk,
            'status' => $status,
            ));
    }

    public function edit($id, $kota, $nama, $alamat, $telp, $email, $tgl, $agama, $jk, $status)
    {
        $this->db->where('id_teknisi', $id);
        return $this->db->update('teknisi', array(
            'id_kota' => $kota,
            'nama_teknisi' => $nama,
            'alamat_teknisi' => $alamat,
            'no_telp_teknisi' => $telp,
            'email_teknisi' => $email,
            'tanggal_lahir_teknisi' => $tgl,
            'agama_teknisi' => $agama,
            'jenis_kelamin_teknisi' => $jk,
            'status' => $status,
            ));
    }

    public function deactivate($id)
    {
        $this->db->where('id_teknisi', $id);
        return $this->db->update('teknisi', array('status' => 'N'));
    }
    
    public function activate($id)
    {
        $this->db->where('id_teknisi', $id);
        return $this->db->update('teknisi', array('status' => 'Y'));
    }
    
    public function genId() 
    {
        $this->db->select("ifnull(max(right(id_teknisi, 3)), 0) + 1 as ID");
        $this->db->from("teknisi");
        $counter = '000'.$this->db->get()->result()[0]->ID;
        return 'T'.substr($counter, strlen($counter) - 3, 3);
    }
}
?>