<?php

class LoginM extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
        date_default_timezone_set('Asia/Calcutta');
    }
    
    function Designations() {
        $designationths = $this->db
                            ->select('*')
                            ->from('positions p')
                            ->join('departments d','d.dept_id=p.dept_id','left')
                            ->get()
                            ->result();
        return $designationths;
    }
    
} ?>