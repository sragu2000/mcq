<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('Mdl_login');
		if($this->session->userdata('user')){
			redirect('home');
		}
	}
	public function index()
	{
		$this->load->view('header');
		$this->load->view('vw_login');
		$this->load->view('footer');
	}

	public function userLogin(){
		$flag=$this->Mdl_login->signincheck();
		$userName=$this->input->post('email');
		if($flag==true){
			echo $this->sendJson(array("message"=>"t"));
			$this->session->set_userdata("user",$userName);
		}else{
			echo $this->sendJson(array("message"=>"f"));
		}
	}
	public function userSignup(){
		$flag=$this->Mdl_login->insertuser();
		if($flag==true){
			echo $this->sendJson(array("message"=>"Success..Login using your email and password !"));
		}else{
			echo $this->sendJson(array("message"=>"Try again later.."));
		}
	}

	private function sendJson($data) {
	  $this->output->set_header('Content-Type: application/json; charset=utf-8')->set_output(json_encode($data));
	}
}
