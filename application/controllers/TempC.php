<?php
       class TempC extends CI_Controller{
           function __construct() {
               parent::__construct();
               $this->load->database();
           }
           function index(){
               $this->load->view('FileUploadCode');
           }
           
       }
?>
