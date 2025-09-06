<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserController extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('UserM');
    }
    
    public function index()
	{
        $this->load->view('templates/Header');
        $this->load->view('User/UserHome');
        $this->load->view('templates/Footer');
	}
	
	public function ShareLedger()
	{
	    $this->load->view('templates/Header');
        $this->load->view('User/LedgerReports');
        $this->load->view('templates/Footer');
	}
	
	function GetTeachersLedgerReportTeacher(){
	    $data['ledgerdetails'] = $this->UserM->GetTeachersLedgerReportTeacher();
            $this->load->view('Admin/ShareLedgerReport',$data);
	} 
    
}
?>