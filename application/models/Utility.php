<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Utility extends CI_Model{

    function GetWhere($where, $orderby, $tabel){
        //$where adalah array untuk klausul where
        //$order adalah array untuk order by
        //$tabel adalah nama tabel yg mau di select
        if(!empty($where)) $this->db->where($where);
        if(!empty($orderby)) $this->db->order_by($orderby);
        return $this->db->get($tabel);
    }

    function InsertData($data, $tabel){
        return $this->db->insert($tabel, $data);
    }

    function UpdateData($data, $where, $tabel){
        if(!empty($where)) $this->db->where($where);
        return $this->db->update($tabel, $data);
    }

    function DeleteData($where, $tabel){
        if(!empty($where)) $this->db->where($where);
        return $this->db->delete($tabel);
    }

}