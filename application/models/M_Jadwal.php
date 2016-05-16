<?php

class M_Jadwal extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    public function get_all()
    {
        return $this->db->get('jadwal')->result();
    }

    public function get_teknisi($id)
    {
        return $this->db->get_where('jadwal', array('id_teknisi' => $id))->result();
    }
    
    public function get_site($id) {
        return $this->db->get_where('jadwal', array('id_site' => $id))->result();
    }
    
    public function get_tanggal($tanggal) {
        return $this->db->get_where('jadwal', array('tanggal' => $tanggal))->result();
    }
    
    public function get_where(array $cond) {
        return $this->db->get_where('jadwal', $cond)->result();
    }

    public function add($teknisi, $site, $tanggal, $keterangan)
    {
        return $this->db->insert('jadwal', array(
            'id_teknisi' => $teknisi,
            'id_site' => $site,
            'tanggal' => $tanggal,
            'keterangan' => $keterangan
            ));
    }

    public function edit($teknisi, $site, $tanggal, $keterangan, $teknisi_u, $site_u, $tanggal_u, $keterangan_u)
    {
        $this->db->where(array(
            'id_teknisi' => $teknisi,
            'id_site' => $site,
            'tanggal' => $tanggal,
            'keterangan' => $keterangan
        ));
        return $this->db->update('jadwal', array(
            'id_teknisi' => $teknisi_u,
            'id_site' => $site_u,
            'tanggal' => $tanggal_u,
            'keterangan' => $keterangan_u
            ));
    }

    public function remove($teknisi, $site, $tanggal)
    {
        $this->db->where(array(
            'id_teknisi' => $teknisi,
            'id_site' => $site,
            'tanggal' => $tanggal
        ));
        return $this->db->delete('jadwal');
    }
}
?>