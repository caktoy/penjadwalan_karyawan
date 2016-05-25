<?php

class M_Provinsi extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function get_all()
    {
        return $this->db->get('public.provinsi')->result();
    }

    public function get_id($id)
    {
        return $this->db->get_where('public.provinsi', array('id_provinsi' => $id))->result();
    }

    public function get_active()
    {
        return $this->db->get_where('public.provinsi', array('status' => 'Y'))->result();
    }

    public function add($id, $nama, $status)
    {
        return $this->db->insert('public.provinsi', array(
            'id_provinsi' => $id,
            'nama_provinsi' => $nama,
            'status' => $status
            ));
    }

    public function edit($id, $nama, $status)
    {
        $this->db->where('id_provinsi', $id);
        return $this->db->update('public.provinsi', array(
            'nama_provinsi' => $nama,
            'status' => $status
            ));
    }

    public function deactivate($id)
    {
        $this->db->where('id_provinsi', $id);
        $this->db->update('public.kota', array('status' => 'N'));

        $this->db->where('id_provinsi', $id);
        return $this->db->update('public.provinsi', array('status' => 'N'));
    }

    public function activate($id)
    {
        $this->db->where('id_provinsi', $id);
        $this->db->update('public.kota', array('status' => 'Y'));

        $this->db->where('id_provinsi', $id);
        return $this->db->update('public.provinsi', array('status' => 'Y'));
    }

    public function genId()
    {
        $this->db->select("max(right(id_provinsi, 2)) as id");
        $this->db->from("public.provinsi");
        $id = $this->db->get()->result()[0]->id;
        $id = $id==null?1:($id+1);
        $counter = '00'.$id;
        return 'P'.substr($counter, strlen($counter) - 2, 2);
    }
}
?>
