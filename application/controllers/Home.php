<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    public function __construct($config="rest") {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
        parent::__construct();
        $this->load->model('authenticate/Mdl_authenticate');
        //$this->load->library('session');
        if(! $this->Mdl_authenticate->sessionCheck()){
            redirect("authenticate");
        }
    }
    function logout(){
        $this->session->unset_userdata('mcqusername');
        $this->session->unset_userdata('mcquseremail');
        // remove all session variables
        session_unset();
        // destroy the session
        session_destroy();
        redirect("authenticate");
    }
    
	public function index(){
		$this->load->view('vw_header',array("heading"=>"Home"));
		$this->load->view('vw_navbar',array("user"=>$_SESSION["mcqusername"]));
		$this->load->view('vw_home');
		$this->load->view('vw_footer');
	}
}