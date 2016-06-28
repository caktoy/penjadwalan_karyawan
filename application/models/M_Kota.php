<?php

class M_Kota extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function get_all()
    {
        $this->db->select("kota.*, provinsi.nama_provinsi, provinsi.status as status_provinsi");
        $this->db->from("kota");
        $this->db->join("provinsi", "kota.id_provinsi = provinsi.id_provinsi", "left");
        return $this->db->get()->result();
    }

    public function get_id($id)
    {
        $this->db->select("kota.*, provinsi.nama_provinsi, provinsi.status as status_provinsi");
        $this->db->from("kota");
        $this->db->join("provinsi", "kota.id_provinsi = provinsi.id_provinsi", "left");
        $this->db->where("id_kota", $id);
        return $this->db->get()->result();
    }

    public function get_where(array $cond)
    {
        $this->db->select("kota.*, provinsi.nama_provinsi, provinsi.status as status_provinsi");
        $this->db->from("kota");
        $this->db->join("provinsi", "kota.id_provinsi = provinsi.id_provinsi", "left");
        $this->db->where($cond);
        return $this->db->get()->result();
    }

    public function get_provinsi($prov) {
        $this->db->select("kota.*, provinsi.nama_provinsi, provinsi.status as status_provinsi");
        $this->db->from("kota");
        $this->db->join("provinsi", "kota.id_provinsi = provinsi.id_provinsi", "left");
        $this->db->where("kota.id_provinsi", $prov);
        return $this->db->get()->result();
    }

    public function add($id, $prov, $nama, $status)
    {
        return $this->db->insert('kota', array(
            'id_kota' => $id,
            'id_provinsi' => $prov,
            'nama_kota' => $nama,
            'status' => $status
            ));
    }

    public function edit($id, $prov, $nama, $status)
    {
        $this->db->where('id_kota', $id);
        return $this->db->update('kota', array(
            'id_provinsi' => $prov,
            'nama_kota' => $nama,
            'status' => $status
            ));
    }

    public function deactivate($id)
    {
        $this->db->where('id_kota', $id);
        return $this->db->update('kota', array('status' => 'N'));
    }

    public function activate($id)
    {
        $this->db->where('id_kota', $id);
        return $this->db->update('kota', array('status' => 'Y'));
    }

    public function activate_by_provinsi($id)
    {
        $this->db->where('id_provinsi', $id);
        return $this->db->update('public.kota', array('status' => 'Y'));
    }

    public function genId()
    {
        $this->db->select("max(right(id_kota, 3)) as id");
        $this->db->from("kota");
        $id = $this->db->get()->result()[0]->id;
        $id = $id==null?1:($id+1);
        $counter = '000'.$id;
        return 'K'.substr($counter, strlen($counter) - 3, 3);
    }
}
?>
