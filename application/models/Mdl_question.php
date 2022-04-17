<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_question extends CI_Model {
	function addquestion($question,$answers,$questionSetName){
        header('Content-Type: application/json');
        $answers=json_decode($answers,true);

        $timestamp=(new DateTime())->getTimestamp();
        $uniqueid=$this->session->userdata('useruniqueid').$timestamp;

        $user=$this->session->userdata('mcquseremail');

        if($this->db->query("INSERT INTO questions(useridentificationid,question,questionset,user) VALUES('$uniqueid','$question','$questionSetName','$user')")){
            //get question id
            $qid=$this->db->query("SELECT * FROM questions WHERE useridentificationid='$uniqueid'")->first_row()->questionid;
            foreach($answers as $key => $value){
                $answerText=$value["answerText"];
                $state=$value["state"];
                $this->db->query("INSERT INTO answers(useridentificationid,answer,astate,questionid,user) VALUES('$uniqueid','$answerText','$state','$qid','$user')");
            }
            return array("message"=>"Question and Answers Added Sucessfully","result"=>true);
        }else{
            return array("message"=>"Failed! Try again later","result"=>false);
        }
    }
}