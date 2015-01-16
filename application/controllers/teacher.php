<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Teacher extends CI_Controller {
	public function __construct(){
		parent::__construct();
		include 'C:\wamp\www\test\vendor\autoload.php';
		$this->load->library('session');
	}
	public function index(){
		$uname = htmlspecialchars($_POST['teacher-uname']);
		$pw = sha1(htmlspecialchars($_POST['teacher-pw']));
		
		$result = $this->user->get_teacher($uname,$pw);
		if(count($result)!=1){
			$data['uname'] = $_POST['teacher-uname'];
			$data['error'] = 'Username/Password does not match.';
			$this->load->view('login_error',$data);
		}else{
			if($result[0]['status']==0){
				$data['uname'] = $_POST['teacher-uname'];
				$data['error'] = 'Account is not yet validated by admin.';
				$this->load->view('login_error',$data);
			}
			else{
				$array = array(
					'username' => $uname,
					'id' => $result[0]['id'],
					'logged_in' => TRUE
				);
				$this->session->set_userdata($array);
				$data['uname'] = $uname;
				$this->load->view('teacher',$data);
			}
		}
		/*$parser = new Smalot\PdfParser\Parser();
		$pdf1 = $parser->parseFile('pdf/Chapter_01.pdf');
		$pdf2 = $parser->parseFile('pdf/Chapter_02.pdf');

		$pages1 = $pdf1->getPages();
		$pages2 = $pdf2->getPages();
		$ctr = 0;
		foreach ($pages1 as $page) {
			$temp[$ctr]=$page->getText();
			$ctr++;
		}

		$data['page1'] = $temp;

		$ctr2 = 0;

		$temp = [];

		foreach ($pages2 as $page) {
			$temp[$ctr2]=$page->getText();
			$ctr2++;
		}

		$data['page2']=$temp;
		$data['ctr'] = $ctr;
		$data['ctr2'] = $ctr2;

		$this->load->view('teacher',$data);*/
	}
}


