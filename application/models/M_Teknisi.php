<?php

class M_Teknisi extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function get_all()
    {
        $this->db->select("teknisi.*, 
            kota_lokasi.id_kota as id_kota_lokasi, 
            kota_lokasi.nama_kota as kota_lokasi, 
            kota_lahir.id_kota as id_kota_lahir,
            kota_lahir.nama_kota as kota_lahir");
        $this->db->from("teknisi");
        $this->db->join("kota as kota_lokasi", "teknisi.id_kota_lokasi = kota_lokasi.id_kota", "left");
        $this->db->join("kota as kota_lahir", "teknisi.id_kota_lahir = kota_lahir.id_kota", "left");
        $this->db->order_by("teknisi.id_teknisi", "asc");
        return $this->db->get()->result();
    }

    public function get_id($id)
    {
        $this->db->select("teknisi.*, 
            kota_lokasi.id_kota as id_kota_lokasi, 
            kota_lokasi.nama_kota as kota_lokasi, 
            kota_lahir.id_kota as id_kota_lahir,
            kota_lahir.nama_kota as kota_lahir");
        $this->db->from("teknisi");
        $this->db->join("kota as kota_lokasi", "teknisi.id_kota_lokasi = kota_lokasi.id_kota", "left");
        $this->db->join("kota as kota_lahir", "teknisi.id_kota_lahir = kota_lahir.id_kota", "left");
        $this->db->where("teknisi.id_teknisi", $id);
        return $this->db->get()->result();
    }

    public function get_kota_lokasi($kota) {
        $this->db->select("teknisi.*, 
            kota_lokasi.id_kota as id_kota_lokasi, 
            kota_lokasi.nama_kota as kota_lokasi, 
            kota_lahir.id_kota as id_kota_lahir,
            kota_lahir.nama_kota as kota_lahir");
        $this->db->from("teknisi");
        $this->db->join("kota as kota_lokasi", "teknisi.id_kota_lokasi = kota_lokasi.id_kota", "left");
        $this->db->join("kota as kota_lahir", "teknisi.id_kota_lahir = kota_lahir.id_kota", "left");
        $this->db->where("kota_lokasi.id_kota", $kota);
        return $this->db->get()->result();
    }

    public function get_kota_lahir($kota) {
        $this->db->select("teknisi.*, 
            kota_lokasi.id_kota as id_kota_lokasi, 
            kota_lokasi.nama_kota as kota_lokasi, 
            kota_lahir.id_kota as id_kota_lahir,
            kota_lahir.nama_kota as kota_lahir");
        $this->db->from("teknisi");
        $this->db->join("kota as kota_lokasi", "teknisi.id_kota_lokasi = kota_lokasi.id_kota", "left");
        $this->db->join("kota as kota_lahir", "teknisi.id_kota_lahir = kota_lahir.id_kota", "left");
        $this->db->where("kota_lahir.id_kota", $kota);
        return $this->db->get()->result();
    }

    public function get_where(array $cond)
    {
        $this->db->select("teknisi.*, 
            kota_lokasi.id_kota as id_kota_lokasi, 
            kota_lokasi.nama_kota as kota_lokasi, 
            kota_lahir.id_kota as id_kota_lahir,
            kota_lahir.nama_kota as kota_lahir");
        $this->db->from("teknisi");
        $this->db->join("kota as kota_lokasi", "teknisi.id_kota_lokasi = kota_lokasi.id_kota", "left");
        $this->db->join("kota as kota_lahir", "teknisi.id_kota_lahir = kota_lahir.id_kota", "left");
        $this->db->where($cond);
        $this->db->order_by("teknisi.id_teknisi", "asc");
        return $this->db->get()->result();
    }

    public function add($id, $kota_lokasi, $kota_lahir, $nama, $alamat, $telp, $email, $tgl, $agama, $jk, $status)
    {
        return $this->db->insert('teknisi', array(
            'id_teknisi' => $id,
            'id_kota_lokasi' => $kota_lokasi,
            'id_kota_lahir' => $kota_lahir,
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

    public function edit($id, $kota_lokasi, $kota_lahir, $nama, $alamat, $telp, $email, $tgl, $agama, $jk, $status)
    {
        $this->db->where('id_teknisi', $id);
        return $this->db->update('teknisi', array(
            'id_kota_lokasi' => $kota_lokasi,
            'id_kota_lahir' => $kota_lahir,
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
        $this->db->select("max(right(id_teknisi, 3)) as id");
        $this->db->from("teknisi");
        $id = $this->db->get()->result()[0]->id;
        $id = $id==null?1:($id+1);
        $counter = '000'.$id;
        return 'T'.substr($counter, strlen($counter) - 3, 3);
    }
}
?>
