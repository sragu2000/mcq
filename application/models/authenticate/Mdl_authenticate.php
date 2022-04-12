<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_authenticate extends CI_Model {
	function validateLoginMdl($email,$password){
        $password=md5($password);
        $query=$this->db->query("SELECT * FROM users WHERE useremail='$email' AND userpassword='$password'");
        if($query->num_rows()==1){
            $user=$query->first_row()->fullname;
            return array("message"=>"Login Success","result"=>true,"user"=>$user);
        }else{
            return array("message"=>"Login Failed","result"=>false);
        }
    }
    function validateSignupMdl($email,$password,$fullName){
        $password=md5($password);
        if($this->db->query("SELECT * FROM users WHERE useremail='$email'")->num_rows()==0){
            if($this->db->query("INSERT INTO users(useremail,userpassword,fullname) VALUES('$email','$password','$fullName')")){
                return array("message"=>"Signup Success","result"=>true);
            }else{
                return array("message"=>"Try again Later","result"=>false);
            }
        }else{
            return array("message"=>"Email address already in use","result"=>false);
        }
    }

    public function sessionCheck(){
        $session_data = $this->session->get_userdata();
        if (is_null($session_data)) {
          return false;
        }
        else if (empty($session_data['mcquseremail'])) {
          return false;
        }
        else if ($session_data['mcquseremail']=="") {
          return false;
        }
        else{
          $ses=$session_data['mcquseremail'];
          return true;
        }
    }

}