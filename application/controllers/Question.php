<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Question extends CI_Controller {
    public function __construct($config="rest") {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
        parent::__construct();
        $this->load->model('authenticate/Mdl_authenticate');
        $this->load->model('Mdl_question');
        //$this->load->library('session');
        if(! $this->Mdl_authenticate->sessionCheck()){
            redirect("authenticate");
        }
    }
    function addquestion(){
        $this->load->view('vw_header',array("heading"=>"Add Question"));
		$this->load->view('vw_navbar',array("user"=>$_SESSION["mcqusername"]));
		$this->load->view('vw_addquestion');
		$this->load->view('vw_footer');
    }
    function insertquestion(){
        $question=$this->input->post('questionText');
        $answers=$this->input->post('encodedAnswers');
        $questionSetName=$this->input->post('questionSetName');
        $flag=$this->Mdl_question->addquestion($question,$answers,$questionSetName);
        $this->sendJson(array("message"=>$flag["message"], "result"=>$flag["result"]));
    }
	public function index(){
		$this->load->view('errors/index.html');
	}
   private function sendJson($data) {
     $this->output->set_header('Content-Type: application/json; charset=utf-8')->set_output(json_encode($data));
   }
}
