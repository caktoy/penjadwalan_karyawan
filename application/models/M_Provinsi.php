<?php

class M_Provinsi extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    public function get_all()
    {
        return $this->db->get('provinsi')->result();
    }

    public function get_id($id)
    {
        return $this->db->get_where('provinsi', array('id_provinsi' => $id))->result();
    }
    
    public function get_active() 
    {
        return $this->db->get_where('provinsi', array('status' => 'Y'))->result();
    }

    public function add($id, $nama, $status)
    {
        return $this->db->insert('provinsi', array(
            'id_provinsi' => $id,
            'nama_provinsi' => $nama,
            'status' => $status
            ));
    }

    public function edit($id, $nama, $status)
    {
        $this->db->where('id_provinsi', $id);
        return $this->db->update('provinsi', array(
            'nama_provinsi' => $nama,
            'status' => $status
            ));
    }

    public function deactivate($id)
    {
        $this->db->where('id_provinsi', $id);
        $this->db->update('kota', array('status' => 'N'));
        
        $this->db->where('id_provinsi', $id);
        return $this->db->update('provinsi', array('status' => 'N'));
    }
    
    public function activate($id)
    {
        $this->db->where('id_provinsi', $id);
        $this->db->update('kota', array('status' => 'Y'));
        
        $this->db->where('id_provinsi', $id);
        return $this->db->update('provinsi', array('status' => 'Y'));
    }
    
    public function genId() 
    {
        $this->db->select("ifnull(max(right(id_provinsi, 2)), 0) + 1 as ID");
        $this->db->from("provinsi");
        $counter = '00'.$this->db->get()->result()[0]->ID;
        return 'P'.substr($counter, strlen($counter) - 2, 2);
    }
}
?>