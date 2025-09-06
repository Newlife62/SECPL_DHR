<?php
defined('BASEPATH') OR exiit('direct script access not allowed');
class Login extends CI_Controller{
    function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Calcutta');
    }
    
    function index(){
        $data['designations'] = $this->LoginM->Designations();
        $this->load->view('LoginPage',$data);
    }
}
?>