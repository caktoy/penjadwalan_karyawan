<?php

class M_Site extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function get_all()
    {
        $this->db->select("site.*, kota.nama_kota");
        $this->db->from("site");
        $this->db->join("kota", "site.id_kota = kota.id_kota", "left");
        $this->db->order_by("site.id_site", "asc");
        return $this->db->get()->result();
    }

    public function get_id($id)
    {
        $this->db->select("site.*, kota.nama_kota");
        $this->db->from("site");
        $this->db->join("kota", "site.id_kota = kota.id_kota", "left");
        $this->db->where("id_site", $id);
        return $this->db->get()->result();
    }

    public function get_kota($kota) {
        $this->db->select("site.*, kota.nama_kota");
        $this->db->from("site");
        $this->db->join("kota", "site.id_kota = kota.id_kota", "left");
        $this->db->where("id_kota", $kota);
        return $this->db->get()->result();
    }

    public function get_where(array $cond)
    {
        $this->db->select("site.*, kota.nama_kota");
        $this->db->from("site");
        $this->db->join("kota", "site.id_kota = kota.id_kota", "left");
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
        $this->db->select("max(right(id_site, 3)) as id");
        $this->db->from("site");
        $id = $this->db->get()->result()[0]->id;
        $id = $id==null?1:($id+1);
        $counter = '000'.$id;
        return 'S'.substr($counter, strlen($counter) - 3, 3);
    }
}
?>
