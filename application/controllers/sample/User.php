<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	public function index()
	{
		$this->load->helper('url');
		$this->load->view('sample/user');
	}

	public function modal()
	{
		$this->load->helper('url');
		$this->load->view('sample/modal');
	}

	public function ubah()
	{
		$this->load->helper('url');
		$this->load->view('user/ubah');
	}
}

