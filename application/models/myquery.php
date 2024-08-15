<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Myquery extends CI_Model{
    function ambildata($tabel, $where){
        //fungsi ini untuk select data ke suatu tabel pada db kita
        //$where berisi array utk generate perintah WHERE pada query SQL

        if(!empty($where)) $this->db->where($where);
        return $this->db->get($tabel);
 
    }
	
	function selectdata($tabel, $where, $select, $limit, $order){
        //fungsi ini untuk select data ke suatu tabel pada db kita
        //$where berisi array utk generate perintah WHERE pada query SQL

        if(!empty($select)) $this->db->select($select);
        if(!empty($where)) $this->db->where($where);
        if($order != '') $this->db->order_by($order);
        if($limit != '') $this->db->limit($limit);
        return $this->db->get($tabel);
    }

    function hapusdata($tabel, $where){
        //fungsi ini untuk hapus data ke suatu tabel pada db kita
        //$where berisi array utk generate perintah WHERE pada query SQL

        if(!empty($where)) $this->db->where($where);
        return $this->db->delete($tabel);
 
    }

    function tambahdata($tabel, $data){
        //fungsi ini untuk select data ke suatu tabel pada db kita
        //$where berisi array utk generate perintah WHERE pada query SQL
        return $this->db->insert($tabel, $data);
 
    }

    function ubahdata($tabel, $data, $where){
        //fungsi ini untuk ubah data ke suatu tabel pada db kita
        //$data berisi array utk generate update data
        if(!empty($where)) $this->db->where($where);
        return $this->db->update($tabel, $data);
    }

    function Cekdata($tabel, $where){
        //fungsi ini untuk select data ke suatu tabel pada db kita
        //$where berisi array utk generate perintah WHERE pada query SQL

        if(!empty($where)) $this->db->where($where);
        $res = $this->db->get($tabel);
        if($res->num_rows() == 0) return false; else return true;
    }
}