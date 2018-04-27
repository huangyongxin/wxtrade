<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use QCloud_WeApp_SDK\Auth\LoginService as LoginService;
use QCloud_WeApp_SDK\Constants as Constants;


class Dashboard extends CI_Controller {

    public function index() {
       $this->layout->view('dashboard/index');
       
    }

  
  
}
