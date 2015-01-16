<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Model {
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function get_teacher($uname, $pw){
		$query = $this->db->query("SELECT id, status FROM teacher WHERE username='{$uname}' and password='{$pw}'");
		return $query->result_array();
	}
}