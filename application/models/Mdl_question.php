<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_question extends CI_Model{
    function insertQuestionAndAnswers(){
        $correctAnswer=$this->input->post("correctanswer");
        $answers=$this->input->post("answers");
		header('Content-Type: application/json');
		$answers= json_decode($answers,true);
        
        $questionArray["qtext"]=$this->input->post("question");
        $questionArray["user"]=$this->session->userdata("user");
        $timestamp=(new DateTime())->getTimestamp();
        $questionArray["timestamp"]=$timestamp;
        $this->db->insert("questions",$questionArray);

        $userdata=$questionArray["user"];

        
        $qidd=$this->db->query("SELECT qid from questions where user='$userdata' && timestamp='$timestamp' ")->result_array();
        $qidd=$qidd[0]["qid"];
        
        foreach($answers as $i=>$a){
            $atext= $a;
            if((string)$i==$correctAnswer-1){
                $aanswer="1";
            }else{
                $aanswer="0";
            }
            
            $this->db->query("INSERT INTO answers(atext,answer,qid) VALUES('$atext','$aanswer','$qidd')");
        }
        
        return "success";
    }
    function getQuestion(){
        $user=$this->session->userdata("user");
        $questionJson= $this->db->query("select * from questions, answers where questions.qid=answers.qid and user !='$user' ")->result_array();
        return json_encode($questionJson);
    }

    function listmyquestions(){
        $user=$this->session->userdata("user");
        $query=$this->db->query("select * from questions where user='$user'")->result_array();
        return json_encode($query);
    }

}