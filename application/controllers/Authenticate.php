<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authenticate extends CI_Controller {
    public function __construct($config="rest") {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
        parent::__construct();
        $this->load->model('authenticate/Mdl_authenticate');
        if($this->Mdl_authenticate->sessionCheck()){
            redirect("home");
        }
    }
	public function index(){
        $this->load->view('vw_header',array("heading"=>"Login"));
		$this->load->view('authenticate/vw_login');
        $this->load->view('vw_footer');
	}
    public function login(){
        $this->index();
    }
    public function signup(){
        $this->load->view('vw_header',array("heading"=>"Signup"));
		$this->load->view('authenticate/vw_signup');
        $this->load->view('vw_footer');
    }
    public function validateLogin(){
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $flag=$this->Mdl_authenticate->validateLoginMdl($email,$password);
        $this->sendJson(array("message"=>$flag["message"], "result"=>$flag["result"], "user"=>$flag["user"]));
        $this->session->set_userdata("mcqusername",$flag["user"]);
        $this->session->set_userdata("mcquseremail",$email);
        $this->session->set_userdata("useruniqueid",$email.'_'.session_id());

    }
    public function validateSignup(){
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $fullName = $this->input->post('fullname');
        $flag=$this->Mdl_authenticate->validateSignupMdl($email,$password,$fullName);
        $this->sendJson(array("message"=>$flag["message"], "result"=>$flag["result"]));
    }

    private function sendJson($data) {
        $this->output->set_header('Content-Type: application/json; charset=utf-8')->set_output(json_encode($data));
    }
}
