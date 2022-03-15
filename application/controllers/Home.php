<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Mdl_question');
		if(!$this->session->userdata('user')){
			redirect('login');
		}
	}

	public function index()
	{
		$this->load->view('header');
		$arr["user"]=$this->session->userdata('user');
		$this->load->view('vw_home',$arr);
		$this->load->view('footer');
	}

	public function dashboard(){
		$this->load->view('header');
		$arr["user"]=$this->session->userdata('user');
		$this->load->view('vw_dashboard',$arr);
		$this->load->view('footer');
	}

	public function logout(){
		$this->session->unset_userdata('user');
        redirect ("login");
	}

	public function addquestions(){
		$this->load->view('header');
		$arr["user"]=$this->session->userdata('user');
		$this->load->view('vw_question',$arr);
		$this->load->view('footer');
	}

	public function addq(){
		$flag=$this->Mdl_question->insertQuestionAndAnswers();
		if($flag != "success"){
			$flag="ERROR !";
		}
		echo $this->sendJson(array("message"=>$flag));
    }

	public function getAllQuestions(){
		if(!$this->session->userdata('user')){
			redirect('login');
		}else{
			$flag=$this->Mdl_question->getQuestion();
			echo $flag;
		}
	}

	public function myquestions(){
		$this->load->view('header');
		$arr["user"]=$this->session->userdata('user');
		$this->load->view('vw_myquestions',$arr);
		$this->load->view('footer');
	}
	public function lmquestions(){
		$flag=$this->Mdl_question->listmyquestions();
		echo $flag;
	}
	function updatequestion($qid){
		if(!$this->session->userdata('user')){
			redirect('login');
		}else{
			$flag=$this->Mdl_question->updateQ($qid);
			echo $flag;
		}
	}
	function deletequestion(){

	}


	private function sendJson($data) {
	  $this->output->set_header('Content-Type: application/json; charset=utf-8')->set_output(json_encode($data));
	}
}
