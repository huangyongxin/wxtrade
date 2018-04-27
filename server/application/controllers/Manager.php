<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use QCloud_WeApp_SDK\Auth\LoginService as LoginService;
use QCloud_WeApp_SDK\Constants as Constants;


class Manager extends CI_Controller {


    public function login() {
       $this->load->view('manager/login');
       
    }

    public function verify(){
      $username = $this->input->post('username');
		  $password = $this->input->post('password');
      if($username=="lendoo" && $password== "lendoo888"){
        $this->session->logined = true; 
        echo_json('登录成功');

      }else{
        echo_json('用户名或密码错误', false);
      }

    }
  
}
