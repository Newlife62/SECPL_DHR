<?php

class UserM extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
        date_default_timezone_set('Asia/Calcutta');
    }
    
    function GetTeachersLedgerReportTeacher(){
        
        extract($this->input->post());
        $teacherledger = array();
        $where = array(
                        
                        'teacher_id'=>$teacher_id
                );
        $teacherledger[] = $this->db
                                    ->select('t.*,s.school_name school_name')
                                    ->from('teachers_detail t')
                                    ->join('schools_detail s','s.id=t.school_id','left')
                                   
                                    ->where('t.id',$teacher_id)
                                    ->get();
        $teacherledger[] = $this->db
                                    ->select('sum(credit) total_share')
                                    ->from('savings_ledger')
                                    ->where($where)
                                    ->where('date <',$from)
                                    ->get();
        $teacherledger[] = $this->db
                                    ->select('*')
                                    ->from('savings_ledger')
                                    ->where($where)
                                    ->where("date between '$from' and '$to'")
                                    ->order_by('date','asc')
                                    ->get();

            $loandetails = $this->db
                                    ->select('issued_date')
                                    ->from('loan_details')
                                    ->where($where)
                                    ->where('status','PENDING')
                                    ->get();
                                    if($loandetails->num_rows()>0){
                                        foreach($loandetails->result_array() as $loandet);
                                    }else{
                                        $loandet=NULL;
                                    }
                                    
                                    $loanissuedate = $loandet['issued_date'];
        $teacherledger[] = $this->db
                                    ->select('sum(debit) total_loan')
                                    ->from('loan_ledger')
                                    ->where($where)
                                    ->get();
        $teacherledger[] = $this->db
                                    ->select('*')
                                    ->from('loan_ledger')
                                    ->where($where)
                                    ->where("date between '$from' and '$to'")
                                    ->order_by('date,time','asc')
                                    ->get();
                                    
         $teacherledger[] = $this->db
                                    ->select('sum(debit)-sum(credit) loanopening')
                                    ->from('loan_ledger')
                                    ->where($where)
                                    ->where("date<'$from'")
                                    ->order_by('date,time','asc')
                                    ->get();
        
        return $teacherledger;
        
    }

}
?>