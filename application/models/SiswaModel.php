<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Siswamodel extends CI_Model {
 
    var $table = 'siswa';
    var $order = array('nama' => 'asc'); // default order 
 
    public function __construct()
    {
        parent::__construct();
    }
	
	
	function get_data()
    {
        $query = $this->db->get($this->table);
        return $query->result();
    }
	
	function get_data_byid($id)
    {
        $this->db->where('id', $id);
		$query = $this->db->get($this->table);
        return $query->result();
    }
	
	function insert_data($data)
    {
        return $this->db->insert($this->table, $data);
    }
 
	public function updateData($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('data', $data);
    }

    public function deleteData($id)
    {
        return $this->db->delete('data', array('id' => $id));
    }
   
 
}