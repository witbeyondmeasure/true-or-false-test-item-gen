<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site extends CI_Controller {
	public function index(){
		$this->load->view('login');
	}

	public function user(){
		$data['username'] = "teacher1";
		$this->load->view('user',$data);
	}
}
