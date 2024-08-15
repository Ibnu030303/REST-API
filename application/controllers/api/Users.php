<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Users extends REST_Controller
{

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->tabel = "users";
        $this->load->model('Mquery');
        $this->pkey = "id";
        $this->field = $this->Mquery->getField($this->tabel);
        $this->load->model('Utility');
    }

    // JSON
    function index_get($id = null)
    {
        if ($id === null) {
            $where = array();
        } else {
            $where = array($this->pkey => $id);
        }

        $orderby = array();
        $aUser = $this->Utility->GetWhere($where, $orderby, $this->tabel)->result();

        if ($id !== null && empty($aUser)) {
            $this->response(array("status" => false, "msg" => "User dengan ID " . $id . " tidak ditemukan"), 404);
        } else {
            $this->response($aUser);
        }
    }

    function index_post()
    {
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

        // Validasi jika email sudah terdaftar
        $where = array("email" => $data["email"]);
        $cek = $this->Utility->GetWhere($where, array(), $this->tabel);

        if ($cek->num_rows() > 0) {
            $this->response(array("status" => false, "msg" => "Email sudah digunakan"), 400); // 400 Bad Request untuk konflik data
            return; // Menghentikan eksekusi lebih lanjut
        }

        // Menyimpan data ke database
        $res = $this->Utility->InsertData($data, $this->tabel);

        if ($res) {
            $this->response(array("data" => $data, "status" => true), 200);
        } else {
            $this->response(array("status" => false, "msg" => "Gagal menyimpan data"), 500); // 500 Internal Server Error
        }
    }

    // Update user data
    function index_put()
    {
        $data = array(
            "first_name"    => $this->put('first_name'),
            "last_name"     => $this->put('last_name'),
            "email"         => $this->put('email'),
            "password"      => $this->put('password'),
            "phone"         => $this->put('phone'),
            "created"       => $this->put('created'),
            "modified"      => date("Y-m-d H:i:s"),
            "status"        => $this->put('status')
        );

        $where = array($this->pkey => $this->put($this->pkey));
        $res = $this->Utility->UpdateData($data, $where, $this->tabel);
        if ($res) {
            $this->response(array("data" => $data, "status" => "success", 200));
        } else {
            $this->response(array("status" => "Fail", 502));
        }
    }

    // Delete user
    function index_delete($id = null)
    {
        if ($id != null) {
            $where = array($this->pkey => $id);
            $user = $this->Utility->GetWhere($where, array(), $this->tabel)->row(); // Ambil data user berdasarkan id

            if ($user) {
                $res = $this->Utility->DeleteData($where, $this->tabel);
                if ($res) {
                    $this->response(array("status" => true), 200);
                } else {
                    $this->response(array("status" => false, "msg" => "Gagal menghapus data"), 500);
                }
            } else {
                $this->response(array("status" => false, "msg" => "User dengan ID " . $id . " tidak ditemukan"), 404);
            }
        } else {
            $this->response(array("status" => false, "msg" => "Parameter " . $this->pkey . " harus ada"), 400);
        }
    }
}
