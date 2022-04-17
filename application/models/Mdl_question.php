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
    function listQuestionTopics(){
        $user=$this->session->userdata('mcquseremail');
        $val=$this->db->query("SELECT questionset as topic FROM questions WHERE user='$user' GROUP BY questionset")->result();
        return json_encode($val,true);
    }

    // function listQuestionUnderTopics($topic){
    //     $user=$this->session->userdata('mcquseremail');
    //     $ques=$this->db->query("SELECT * from questions WHERE questionset='$topic'")->result();
    //     $ans=$this->db->query("SELECT * from questions WHERE questionset='$topic'")->result();
    //     return json_encode($val,true);
    // }
    
    function deleteTopic($topic){
        if($this->db->query("DELETE FROM questions WHERE questionset='$topic'")){
            return array("message"=>"Topic Deleted Sucessfully","result"=>true);
        }else{
            return array("message"=>"Can't Delete Topic","result"=>false);
        }
    }
    function editTopic($oldtopic,$newtopic){
        $newtopic=urldecode($newtopic);
        $oldtopic=urldecode($oldtopic);
        if($this->db->query("UPDATE questions SET questionset='$newtopic' WHERE questionset='$oldtopic'")){
            return array("message"=>"Topic Edited Sucessfully","result"=>true);
        }else{
            return array("message"=>"Can't Edit Topic","result"=>false);
        }
    }
}