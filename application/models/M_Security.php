<?php
/**
* 
*/
class M_Security extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function gen_ai_id($tabel, $kolom)
	{
		$this->db->select_max($kolom, 'id');
		$data = $this->db->get($tabel)->result();
		return ($data[0]->id + 1);
	}
}
?>