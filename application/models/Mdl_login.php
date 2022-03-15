<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_login extends CI_Model{
    function insertuser(){
        $arr["fname"]=$this->input->post('fname');
        $arr["lname"]=$this->input->post('lname');
        $arr["email"]=$this->input->post('email');
        $arr["password"]=md5($this->input->post('password'));
        $this->db->insert("users",$arr);
        return true;
    }
    
    function signincheck(){
        $arr["email"] = $this->input->post('email');
		$arr["password"] = md5($this->input->post('password'));
        if($this->db->get_where("users",$arr)->num_rows()>0){
            return true;
        }else{
            return false;
        }
    }
}