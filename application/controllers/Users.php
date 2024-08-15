<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{
    public function index()
    {
        $this->load->helper('url');
        
        // Define the current URL
        $data['current_url'] = current_url();
        
        // Load the view and pass the data
        $this->load->view('users/view_users', $data);
    }
}
?>
	