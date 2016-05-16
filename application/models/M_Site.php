<?php

class M_Site extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    public function get_all()
    {
        $this->db->select("site.*, kota.NAMA_KOTA");
        $this->db->from("site");
        $this->db->join("kota", "site.ID_KOTA = kota.ID_KOTA", "left");
        return $this->db->get()->result();
    }

    public function get_id($id)
    {
        $this->db->select("site.*, kota.NAMA_KOTA");
        $this->db->from("site");
        $this->db->join("kota", "site.ID_KOTA = kota.ID_KOTA", "left");
        $this->db->where("id_site", $id);
        return $this->db->get()->result();
    }
    
    public function get_kota($kota) {
        $this->db->select("site.*, kota.NAMA_KOTA");
        $this->db->from("site");
        $this->db->join("kota", "site.ID_KOTA = kota.ID_KOTA", "left");
        $this->db->where("id_kota", $kota);
        return $this->db->get()->result();
    }
    
    public function get_where(array $cond)
    {
        $this->db->select("site.*, kota.NAMA_KOTA");
        $this->db->from("site");
        $this->db->join("kota", "site.ID_KOTA = kota.ID_KOTA", "left");
        $this->db->where($cond);
        return $this->db->get()->result();
    }

    public function add($id, $kota, $nama, $alamat, $telp, $status)
    {
        return $this->db->insert('site', array(
            'id_site' => $id,
            'id_kota' => $kota,
            'nama_site' => $nama,
            'alamat_site' => $alamat,
            'no_telp_site' => $telp,
            'status' => $status,
            ));
    }

    public function edit($id, $kota, $nama, $alamat, $telp, $status)
    {
        $this->db->where('id_site', $id);
        return $this->db->update('site', array(
            'id_kota' => $kota,
            'nama_site' => $nama,
            'alamat_site' => $alamat,
            'no_telp_site' => $telp,
            'status' => $status,
            ));
    }

    public function deactivate($id)
    {
        $this->db->where('id_site', $id);
        return $this->db->update('site', array('status' => 'N'));
    }
    
    public function activate($id)
    {
        $this->db->where('id_site', $id);
        return $this->db->update('site', array('status' => 'Y'));
    }
    
    public function genId() 
    {
        $this->db->select("ifnull(max(right(id_site, 3)), 0) + 1 as ID");
        $this->db->from("site");
        $counter = '000'.$this->db->get()->result()[0]->ID;
        return 'S'.substr($counter, strlen($counter) - 3, 3);
    }
}
?>