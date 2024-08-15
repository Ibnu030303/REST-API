<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sqlhelper extends CI_Model{


    //https://scrimba.com/scrim/ce47V7up
    function GetWhere($aWhere, $aOrder, $table){
        if(!empty($aWhere)) $this->db->where($aWhere);
        if(!empty($aOrder)) $this->db->order_by($aOrder);
        return $this->db->get($table);
    }

    function InsertData($aData, $table){
        return $this->db->insert($table, $aData);
    }

    function UpdateData($aData, $aWhere, $table){
        if(!empty($aWhere)) $this->db->where($aWhere);
        return $this->db->update($table, $aData);
    }

    function DeleteData($aWhere, $table){
        if(!empty($aWhere)) $this->db->where($aWhere);
        return $this->db->delete($table);
    }

    function idISExist($aWhere, $table){
        if(!empty($aWhere)) $this->db->where($aWhere);
        $res = $this->db->get($table);
        if($res->num_rows() == 0) return false; else return true;
    }
}
