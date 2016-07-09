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

    public function distinct_site($tahun)
    {
        $this->db->distinct();
        $this->db->select("jadwal.id_site, site.nama_site");
        $this->db->from("jadwal");
        $this->db->join("site", "jadwal.id_site = site.id_site");
        $this->db->where('extract(year from tanggal) =', $tahun);
        $this->db->order_by("jadwal.id_site", "asc");
        return $this->db->get()->result();
    }

    public function distinct_teknisi($tahun)
    {
        $this->db->distinct();
        $this->db->select("jadwal.id_teknisi, teknisi.nama_teknisi");
        $this->db->from("jadwal");
        $this->db->join("teknisi", "jadwal.id_teknisi = teknisi.id_teknisi");
        $this->db->where('extract(year from tanggal) =', $tahun);
        $this->db->order_by("jadwal.id_teknisi", "asc");
        return $this->db->get()->result();
    }
    
    public function get_tanggal($tanggal) {
        return $this->db->get_where('jadwal', array('tanggal' => $tanggal))->result();
    }
    
    public function get_where(array $cond) {
        $this->db->distinct();
        $this->db->select("jadwal.*, teknisi.nama_teknisi, site.nama_site");
        $this->db->from("jadwal");
        $this->db->join("teknisi", "jadwal.id_teknisi = teknisi.id_teknisi");
        $this->db->join("site", "jadwal.id_site = site.id_site");
        $this->db->where($cond);
        $this->db->order_by("tanggal, id_site", "asc");
        return $this->db->get()->result();
    }

    public function get_presensi($awal, $akhir)
    {
        $this->db->distinct();
        $this->db->select("teknisi.id_teknisi as id, teknisi.nama_teknisi as nama, 
            (select count(*) from jadwal where id_teknisi = teknisi.id_teknisi and tanggal >= '".$awal."' and tanggal <= '".$akhir."' and keterangan = 'S') as sakit,
            (select count(*) from jadwal where id_teknisi = teknisi.id_teknisi and tanggal >= '".$awal."' and tanggal <= '".$akhir."' and keterangan = 'H') as hadir,
            (select count(*) from jadwal where id_teknisi = teknisi.id_teknisi and tanggal >= '".$awal."' and tanggal <= '".$akhir."' and keterangan = 'I') as izin,
            (select count(*) from jadwal where id_teknisi = teknisi.id_teknisi and tanggal >= '".$awal."' and tanggal <= '".$akhir."' and keterangan = 'A') as alpha,
            (select count(*) from jadwal where id_teknisi = teknisi.id_teknisi and tanggal >= '".$awal."' and tanggal <= '".$akhir."' and keterangan = 'C') as cuti");
        $this->db->from("jadwal");
        $this->db->join("teknisi", "jadwal.id_teknisi = teknisi.id_teknisi", "left");
        $this->db->where("jadwal.tanggal >=", $awal);
        $this->db->where("jadwal.tanggal <=", $akhir);
        return $this->db->get()->result();
    }

    public function get_input_presensi($tanggal)
    {
        $this->db->select("jadwal.id_teknisi, teknisi.nama_teknisi, jadwal.id_site, site.nama_site, jadwal.keterangan");
        $this->db->from('jadwal');
        $this->db->join('teknisi', 'jadwal.id_teknisi = teknisi.id_teknisi', 'left');
        $this->db->join('site', 'jadwal.id_site = site.id_site', 'left');
        $this->db->where("jadwal.tanggal", $tanggal);
        $this->db->order_by("jadwal.id_teknisi", "asc");
        return $this->db->get()->result();
    }

    public function add($teknisi, $site, $tanggal, $keterangan)
    {
        return $this->db->insert('public.jadwal', array(
            'id_teknisi' => $teknisi,
            'id_site' => $site,
            'tanggal' => $tanggal,
            'keterangan' => $keterangan
            ));
    }

    public function update_keterangan($tanggal, $teknisi, $keterangan)
    {
        $this->db->where(array(
            'tanggal' => $tanggal,
            'id_teknisi' => $teknisi
            ));
        return $this->db->update('public.jadwal', array('keterangan' => $keterangan));
    }

    public function edit($teknisi, $site, $tanggal, $keterangan, $teknisi_u, $site_u, $tanggal_u, $keterangan_u)
    {
        $this->db->where(array(
            'id_teknisi' => $teknisi,
            'id_site' => $site,
            'tanggal' => $tanggal,
            'keterangan' => $keterangan
        ));
        return $this->db->update('public.jadwal', array(
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
        return $this->db->delete('public.jadwal');
    }

    public function remove_tahun($tahun)
    {
        $this->db->where(array(
            'extract(year from tanggal) =' => $tahun
        ));
        return $this->db->delete('public.jadwal');
    }

    public function check_isi($tanggal)
    {
        return $this->db->get_where('public.jadwal', array(
                'tanggal' => $tanggal,
                'keterangan is not' => null
            ))->result();
    }
}
?>