<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Customers extends REST_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Mquery');
        $this->load->model('Utility');

        // Define your table and primary key
        $this->tabel = "customers";
        $this->pkey = "customerNumber";

        // Get the fields dynamically from your model
        $this->field = $this->Mquery->getField($this->tabel);
    }

    // Get customer(s)
    function index_get($id = null)
    {
        if ($id === null) {
            $where = array();
        } else {
            $where = array($this->pkey => $id);
        }

        $orderby = array(); // Optional: Add ordering criteria if needed
        $aCustomer = $this->Utility->GetWhere($where, $orderby, $this->tabel)->result();

        if ($id !== null && empty($aCustomer)) {
            $this->response(array("status" => false, "msg" => "Customer dengan ID " . $id . " tidak ditemukan"), 404);
        } else {
            $this->response($aCustomer);
        }
    }

    // Add new customer
    function index_post()
    {
        $data = array(
            "customerName" => $this->post('customerName'),
            "contactLastName" => $this->post('contactLastName'),
            "contactFirstName" => $this->post('contactFirstName'),
            "phone" => $this->post('phone'),
            "addressLine1" => $this->post('addressLine1'),
            "city" => $this->post('city'),
            "country" => $this->post('country'),
        );

        // Validate if customerName is not empty
        if (empty($data['customerName'])) {
            $this->response(array("status" => false, "msg" => "Customer name is required"), 400);
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

    // Update customer
    public function index_put()
    {
        // Extract PUT data using input class
        $data = array(
            "customerName" => $this->put('customerName'),
            "contactLastName" => $this->put('contactLastName'),
            "contactFirstName" => $this->put('contactFirstName'),
            "phone" => $this->put('phone'),
            "addressLine1" => $this->put('addressLine1'),
            "city" => $this->put('city'),
            "country" => $this->put('country'),
        );

        // Validate if customerNumber is provided
        $customerNumber = $this->put('customerNumber');
        if (empty($customerNumber)) {
            $this->response(array("status" => false, "msg" => "Customer number is required"), 400);
            return;
        }

        // Where condition for update
        $where = array("customerNumber" => $customerNumber);

        // Update data in database using your Utility model or directly if using CI's database class
        $this->db->where($where);
        $res = $this->db->update('customers', $data);

        if ($res) {
            $this->response(array("status" => true, "data" => $data), 200); // HTTP 200 OK
        } else {
            $this->response(array("status" => false, "msg" => "Failed to update data"), 500); // HTTP 500 Internal Server Error
        }
    }


    // Delete customer
    function index_delete($id = null)
    {
        if ($id != null) {
            $where = array($this->pkey => $id);
            $customer = $this->Utility->GetWhere($where, array(), $this->tabel)->row();

            if ($customer) {
                $res = $this->Utility->DeleteData($where, $this->tabel);
                if ($res) {
                    $this->response(array("status" => true), 200); // HTTP 200 OK
                } else {
                    $this->response(array("status" => false, "msg" => "Gagal menghapus data"), 500); // HTTP 500 Internal Server Error
                }
            } else {
                $this->response(array("status" => false, "msg" => "Customer dengan ID " . $id . " tidak ditemukan"), 404); // HTTP 404 Not Found
            }
        } else {
            $this->response(array("status" => false, "msg" => "Parameter " . $this->pkey . " harus ada"), 400); // HTTP 400 Bad Request
        }
    }
}
