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
    function deletequestiontopic($topic){
        $flag=$this->Mdl_question->deleteTopic($topic);
        $this->session->set_flashdata('messageBack', $flag["message"]);
        redirect("question/myquestions");
    }
    function editquestiontopic($oldtopic,$newtopic){
        $flag=$this->Mdl_question->editTopic($oldtopic,$newtopic);
        $this->session->set_flashdata('messageBack', $flag["message"]);
        redirect("question/myquestions");
    }
    function myquestions(){
        $this->load->view('vw_header',array("heading"=>"My Questions"));
        if($this->session->has_userdata('messageBack')!=NULL){
            $message=$this->session->userdata('messageBack');
            $this->session->unset_userdata('messageBack');
        }else{
            $message="";
        }
		$this->load->view('vw_navbar',array("user"=>$_SESSION["mcqusername"],"message"=>$message));
		$this->load->view('vw_myquestions');
		$this->load->view('vw_footer');
    }
    function listmytopics(){
        //function will return question topics in json
        echo $this->Mdl_question->listQuestionTopics();
    }

    // function listquestionundertopic($topic){
    //     //function will return question under topics in json
    //     $topic=urldecode($topic);
    //     echo $this->Mdl_question->listQuestionUnderTopics($topic);
    // }

    
    function addquestion($topic=''){
        $this->load->view('vw_header',array("heading"=>"Add Question"));
		$this->load->view('vw_navbar',array("user"=>$_SESSION["mcqusername"]));
        $data["topic"]=urldecode($topic);
		$this->load->view('vw_addquestion',$data);
		$this->load->view('vw_footer');
    }
    function insertquestion(){
        $question=$this->input->post('questionText');
        $answers=$this->input->post('encodedAnswers');
        $questionSetName=$this->input->post('questionSetName');
        $flag=$this->Mdl_question->addquestion($question,$answers,$questionSetName);
        $this->sendJson(array("message"=>$flag["message"], "result"=>$flag["result"]));
    }
    // ------------------------------------------------------
	public function index(){
		$this->load->view('errors/index.html');
	}
   private function sendJson($data) {
     $this->output->set_header('Content-Type: application/json; charset=utf-8')->set_output(json_encode($data));
   }
}
