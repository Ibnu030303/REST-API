<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
class Karyawan extends REST_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->tabel = "employees";
        $this->load->model('Mquery');
        $this->pkey = "employeeNumber";
        $this->field = $this->Mquery->getField($this->tabel);
        $this->load->model('Utility');
    }

    //JSON
    function index_get(){
        $where = array();
        $orderby = array();
        $aUser = $this->Utility->GetWhere($where, $orderby, $this->tabel)->result();
        $this->response($aUser);
    }
    
    //https://scrimba.com/scrim/ce47V7up
    function index_post(){
        $data = array(
            "first_name"    => $this->post('first_name'),
            "last_name"     => $this->post('last_name'),
            "email"         => $this->post('email'),
            "password"      => md5($this->post('password')),
            "phone"         => $this->post('phone'),
            "created"       => date('Y-m-d'),
            "modified"      => date('Y-m-d'),
            "status"        => 1
        );

        //var_dump($data);exit;
        //cek primary sudah ada atau belum di dalam tabel
        //$where = array($this->pkey => $this->input->post($this->pkey));
        
        $where = array("email" => $this->post("email"));
        $cek = $this->Utility->GetWhere($where, array(), $this->tabel);
        
        //$cek adalah untuk cek apakah data userid sudah ada atau belum
        
        if($cek->num_rows() > 0){
        //if(false){
            $this->response(array("status" => false, "msg" => "Userid sudah digunakan"));
        }else{
            $res = $this->Utility->InsertData($data, $this->tabel);
            if($res){
                $this->response(array("data" => $data, "status" => true, 200));
            }else{
                $this->response(array("status" => false, 502));
            }
        }
    }

    function index_put(){
        $data = array(
            //$this->pkey     => $this->put($this->pkey),
            "first_name"    => $this->put('first_name'),
            "last_name"     => $this->put('last_name'),
            "email"         => $this->put('email'),
            "password"      => $this->put('password'),
            "phone"         => $this->put('phone'),
            "created"       => $this->put('created'),
            "modified"      => date("Y-m-d H:i:s"),
            "status"        => $this->put('status')
        );

        //var_dump($data);exit;
        $where = array($this->pkey => $this->put($this->pkey));
        $res = $this->Utility->UpdateData($data, $where, $this->tabel);
        if($res){
            $this->response(array("data" => $data, "status" => "success", 200));
        }else{
            $this->response(array("status" => "Fail", 502));
        }
    }

    function index_delete($id = null){
        if($id != null){
            $where = array($this->pkey => $id);
            $res = $this->Utility->DeleteData($where, $this->tabel);
            if($res){
                $this->response(array("status" => true, 200));
            }else{
                $this->response(array("status" => false, 502));
            }
        }else{
            $this->response(array("status"=> false,"msg" => "Parameter ".$this->pkey." harus ada"));
        }
    }



}
