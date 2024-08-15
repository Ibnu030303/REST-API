<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Matakuliah extends CI_Controller
{

    public function index()
    {
        $this->load->helper('url');
        // Define the current URL
        $data['current_url'] = current_url();
        $this->load->view('matakuliah/view_matakuliah', $data);
    }
}
