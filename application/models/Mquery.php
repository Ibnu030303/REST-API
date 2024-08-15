<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mquery extends CI_Model{
    function ambildata($tabel, $where){
        //fungsi ini digunakan utk select data pada sebuah tabel
        //$tabel berisi nama tabel yg akan kita select
        //$where berisi array filed utk filter data WHERE
        
        if(!empty($where)) $this->db->where($where);
        return $this->db->get($tabel);
    }

    function hapusdata($tabel, $where){
        //fungsi ini digunakan utk hapus data pada sebuah tabel
              
        if(!empty($where)) $this->db->where($where);
        return $this->db->delete($tabel);
    }

    function tambahdata($tabel, $data){
        //fungsi ini untuk tambah data ke suatu tabel pada db kita
        return $this->db->insert($tabel, $data);
 
    }

    function ubahdata($tabel, $data, $where){
        //fungsi ini untuk ubah data ke suatu tabel pada db kita
        //$where berisi array utk generate perintah WHERE pada query SQL
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

    function getField($tabel){
        //fungsi ini digunakan utk select data pada sebuah tabel
        $qry = "SHOW COLUMNS FROM ".$tabel;
        return $this->db->query($qry);
    }
}