<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    private $table = 'users'; // Define your table name here

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Utility'); // Load the Utility model
        $this->load->library('session'); // Load session library
    }
    

    public function index()
    {
        $this->load->helper('url');
        $this->load->view('v_login');
    }

    public function login()
    {
        $email = $this->input->post("email");
        $password = $this->input->post("password");
    
        // Check if email and password are not null
        if ($email && $password) {
            $hashed_password = md5($password); // Use a proper hashing mechanism in production
    
            $where = array("email" => $email, "password" => $hashed_password);
            $cek = $this->Utility->GetWhere($where, array(), $this->table);
    
            if ($cek->num_rows() > 0) {
                $user = $cek->row();
    
                // Set session data
                $this->session->set_userdata('user_id', $user->id);
                $this->session->set_userdata('email', $user->email);
    
                // Redirect to users page
                redirect('users');
            } else {
                // Load the login view with an error message
                $data['error'] = 'Invalid email or password';
                $this->load->view('v_login', $data);
            }
        } else {
            // Load the login view with an error message
            $data['error'] = 'Email and password cannot be empty';
            $this->load->view('v_login', $data);
        }
    }
    

    private function send_response($data, $status_code = 200)
    {
        $this->output
            ->set_content_type('application/json')
            ->set_status_header($status_code)
            ->set_output(json_encode($data));
    }
}
