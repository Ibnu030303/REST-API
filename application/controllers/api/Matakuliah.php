<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Matakuliah extends REST_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Mquery');
        $this->load->model('Utility');

        // Define your table and primary key
        $this->tabel = "matakuliah";
        $this->pkey = "kode_mk";

        // Get the fields dynamically from your model
        $this->field = $this->Mquery->getField($this->tabel);
    }

    // Get matakuliah(s)
    function index_get($id = null)
    {
        if ($id === null) {
            $where = array();
        } else {
            $where = array($this->pkey => $id);
        }

        $orderby = array(); // Optional: Add ordering criteria if needed
        $aMatakuliah = $this->Utility->GetWhere($where, $orderby, $this->tabel)->result();

        if ($id !== null && empty($aMatakuliah)) {
            $this->response(array("status" => false, "msg" => "Matakuliah dengan ID " . $id . " tidak ditemukan"), 404);
        } else {
            $this->response($aMatakuliah);
        }
    }

    // Add new matakuliah
    function index_post()
    {
        $data = array(
            "kode_mk" => $this->post('kode_mk'),
            "nama_mk" => $this->post('nama_mk'),
            "sks" => $this->post('sks'),
            "semester" => $this->post('semester'),
            "program_studi" => $this->post('program_studi')
        );

        // Validate if kode_mk is not empty
        if (empty($data['kode_mk'])) {
            $this->response(array("status" => false, "msg" => "Kode matakuliah is required"), 400);
            return;
        }

        // Check for duplicate entry
        $where = array("kode_mk" => $data['kode_mk']);
        $existing_matakuliah = $this->Utility->GetWhere($where, array(), $this->tabel)->row();

        if ($existing_matakuliah) {
            $this->response(array("status" => false, "msg" => "Duplicate entry for kode_mk: " . $data['kode_mk']), 409); // HTTP 409 Conflict
            return;
        }

        // Insert data into database
        $res = $this->Utility->InsertData($data, $this->tabel);

        if ($res) {
            $this->response(array("status" => true, "data" => $data), 201); // HTTP 201 Created
        } else {
            $this->response(array("status" => false, "msg" => "Gagal menyimpan data"), 500); // HTTP 500 Internal Server Error
        }
    }

    // Update matakuliah
    public function index_put()
    {
        // Extract PUT data using input class
        $data = array(
            "kode_mk" => $this->put('kode_mk'),
            "nama_mk" => $this->put('nama_mk'),
            "sks" => $this->put('sks'),
            "semester" => $this->put('semester'),
            "program_studi" => $this->put('program_studi')
        );

        // Validate if kode_mk is provided
        $kode_mk = $this->put('kode_mk');
        if (empty($kode_mk)) {
            $this->response(array("status" => false, "msg" => "Kode matakuliah is required"), 400);
            return;
        }

        // Where condition for update
        $where = array("kode_mk" => $kode_mk);

        // Update data in database using your Utility model or directly if using CI's database class
        $this->db->where($where);
        $res = $this->db->update($this->tabel, $data);

        if ($res) {
            $this->response(array("status" => true, "data" => $data), 200); // HTTP 200 OK
        } else {
            $this->response(array("status" => false, "msg" => "Failed to update data"), 500); // HTTP 500 Internal Server Error
        }
    }

    // Delete matakuliah
    function index_delete($id = null)
    {
        if ($id != null) {
            $where = array($this->pkey => $id);
            $matakuliah = $this->Utility->GetWhere($where, array(), $this->tabel)->row();

            if ($matakuliah) {
                $res = $this->Utility->DeleteData($where, $this->tabel);
                if ($res) {
                    $this->response(array("status" => true), 200); // HTTP 200 OK
                } else {
                    $this->response(array("status" => false, "msg" => "Gagal menghapus data"), 500); // HTTP 500 Internal Server Error
                }
            } else {
                $this->response(array("status" => false, "msg" => "Matakuliah dengan ID " . $id . " tidak ditemukan"), 404); // HTTP 404 Not Found
            }
        } else {
            $this->response(array("status" => false, "msg" => "Parameter " . $this->pkey . " harus ada"), 400); // HTTP 400 Bad Request
        }
    }
}
