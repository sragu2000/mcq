<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_question extends CI_Model {
	function addquestion($question,$answers){
        $answers=json_decode($answers,true);
        //add question first
        $user=$this->session->userdata('mcquseremail');
        $date=time();
        if($this->db->query("insert into questions(question, user, timestamp) values('$question','$user','$date')")){

        }else{

        }
        //return array("message"=>"Question added successfully","result"=>true);
    }
}