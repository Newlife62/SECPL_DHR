<?php
class AdminM extends CI_Model {
    function __construct() {
        parent::__construct();
        $this->load->database();
        date_default_timezone_set('Asia/Calcutta');
    }

    function Verify(){
        extract($this->input->post());
        $veridata=array(
            'e.pos_id'=>$this->security->xss_clean($role),
            'e.username'=>$this->security->xss_clean($user_name),
            'e.password'=>$this->security->xss_clean($user_password)
        );

        $year=$this->db
                            ->select('*')
                            ->from('financial_years')
                            ->where('active',1)
                            ->get();
        foreach ($year->result_array() as $yearres);
            
        $positions=$this->db
                        ->select('dept_id')
                        ->from('positions')
                        ->where('pos_id',$role)
                        ->get();
        foreach ($positions->result_array() as $p);
        
        $veridata['e.dept_id']=$p['dept_id'];
            
        $confirms=$this->db
                            ->select('e.*,p.pos_name designation')
                            ->from('employees e')
                            ->join('positions p','p.pos_id=e.pos_id')
                            ->where($veridata)
                            ->get()
                            ->result();
        if($confirms){
            foreach ($confirms as $confirm);
            $data=array(
                'dept_id'   =>$p['dept_id'],
                'role'      =>$confirm->designation,
                'staff_id'  =>$confirm->id,
                'user_name' =>$confirm->employee_name,
                'user_photo'=>$confirm->photo,
                'financial_year' => $yearres['financial_year'],
            );
            $this->session->set_userdata($data);
            
            if($confirm->designation=='ADMINISTRATOR'){
                redirect(base_url('AdminController'));
            }else if(in_array($confirm->designation,array('USER','EXECUTIVE','MANAGER'))){
                redirect(base_url('UserController'));
            }else{
                redirect(base_url());
            }
        }else{
                redirect(base_url());
            }
    }
    
    function Logout(){
         $this->session->sess_destroy();
         redirect(base_url());
    }
   
    function AddUpCompanys() {
        extract($this->input->post());
        $data = array(
                        'company_name' => $company_name,
                        'trust_name' => $trust_name,
                        'full_address' => $full_address,
                        'city' => $city,
                        'taluk' => $taluk,
                        'district' => $district,
                        'state' => $state,
                        'register_number' => $register_number,
                        'mobile_number' => $mobile_number,
        );
        
       $where = array('id' => $id);
        $cc = $this->db->select('*')->from('companys_detail')->where($where)->get();
        if ($cc->num_rows() > 0) {
            echo $this->db->where($where)->update('companys_detail', $data);
        } else {
            $data['user'] = $this->session->userdata('staff_id');
            echo $this->db->insert('companys_detail', $data);
            $id = $this->db->insert_id();
         }
   }
    
    function AddUpEmployees(){
        extract($this->input->post());
        $data = array(
                        'company_id' => $company_id,
                        'dept_id'=>$dept_id,
                        'pos_id'=>$pos_id,
                        'employee_number' => $employee_number,
                        'username' => $username,
                        'password' => $password,
                        'employee_name' => $employee_name,
                        'employee_short_name' => $employee_short_name,
                        'date_of_birth' => $date_of_birth,
                        'city' => $city,
                        'taluk' => $taluk,
                        'district' => $district,
                        'state' => $state,
                        'full_address' => $full_address,
                        'ration_card_number' => $ration_card_number,
                        'paan_card_number' => $paan_card_number,
                        'aadhaar_number' => $aadhaar_number,
                        'mobile_number' => $mobile_number,
                        'caste' =>$caste,
                        'sub_caste' => $sub_caste,
                        'left_date' => $left_date,
                        
        );
        
       $where = array('id' => $id);
        $cc = $this->db
                        ->select('*')
                        ->from('employees')
                        ->where($where)
                        ->get();
        if ($cc->num_rows() > 0) {
            echo $this->db->where($where)->update('employees', $data);
        } else {
            $data['user'] = $this->session->userdata('staff_id');
            echo $this->db->insert('employees', $data);
            $id = $this->db->insert_id();
         }
        
         if (!empty($_FILES["photo"]["name"])) {
                $type = explode('.', $_FILES["photo"]["name"]);
                $type = $type[count($type) - 1];
                $url = 'assets/employeephotos/' . $id . '.' . $type;
                 $config['upload_path']='assets/employeephotos/';
                $config['file_name']=$id . '.' . $type;
                $config['allowed_types']='png|PNG|jpeg|JPEG|jpg|JPG';
                $config['file_size']='1024M';
                $config['overwrite']=TRUE;
                $this->upload->initialize($config);
                $this->upload->do_upload('photo');
                $photo=$url;
                $this->db->where('id', $id)->set('photo',$photo)->update('employees');
            }
            
             if (!empty($_FILES["signature"]["name"])) {
                $type = explode('.', $_FILES["signature"]["name"]);
                $type = $type[count($type) - 1];
                $url = 'assets/employeephotos/s' . $id . '.' . $type;
                 $config['upload_path']='assets/employeephotos/';
                $config['file_name']='s'.$id . '.' . $type;
                $config['allowed_types']='png|PNG|jpeg|JPEG|jpg|JPG';
                $config['file_size']='1024M';
                $config['overwrite']=TRUE;
                $this->upload->initialize($config);
                $this->upload->do_upload('signature');
                $signature=$url;
                $this->db->where('id', $id)->set('signature',$signature)->update('employees');
            }

        //     $datasetting = array(
        //             'date'=>date('Y-m-d'),
        //             'per_month_paying_amount'=>$per_month_paying_amount,
        //             'share'=>$share,
        //             'loan'=>$loan,
        //             'interest'=>$interest,
        //             'school_id'=>$school_id,
        //         );
        //  $check = $this->db
        //                      ->select('employee_id')
        //                      ->from('teachers_share_loan_set')
        //                      ->where('employee_id',$id)
        //                      ->get();
        // if($check->num_rows()>0){
        //     echo $this->db
        //             ->where('employee_id',$id)
        //             ->update('teachers_share_loan_set',$datasetting);
        // }else{
        //     $datasetting['employee_id']=$id;
        //     echo $this->db->insert('teachers_salary_set',$datasetting);
        // }      
           
    }
    
    function DepartmentsList(){
        return $this->db->select('*')->from('departments')->get();
    }
    
    function get_department_details($dept_id){
         $this->db->select('*');
         $this->db->from('departments d');
         $this->db->join('positions p','p.dept_id=d.dept_id','left');
         if($dept_id!=''){
         $this->db->where('d.dept_id',$dept_id);
         }
         $out = $this->db->get();
        return $out;
    }
    
    function SaveUpdateDepartment(){
        extract($this->input->post());
        $this->db->select('*');
        $this->db->from('departments d');
        $this->db->join('positions p','p.dept_id=d.dept_id','left');
        $this->db->where('d.dept_id',$dept_id);
        $check =  $this->db->get();
        
            $deptdata = array(
                'dept_name'=>$dept_name,
            );
        
        if($check->num_rows()==0){
          
            $this->db->insert('departments',$deptdata);
            $dept_id = $this->db->insert_id();
            
            for($i=0;$i<count($pos_id);$i++){
                $deptpositiondata = array(
                    'dept_id'=>$dept_id,
                    'pos_name'=>$pos_name[$i]
                );
                
                $this->db->insert('positions',$deptpositiondata);
            }
            
        }else{
            
            $this->db->where('dept_id',$dept_id)->set($deptdata)->update('departments');
            
            for($i=0;$i<count($pos_id);$i++){
                $deptpositiondata = array(
                    'dept_id'=>$dept_id,
                    'pos_name'=>$pos_name[$i]
                );
                $this->db->select('*');
                $this->db->from('positions');
                $this->db->where('dept_id',$dept_id);
                $this->db->where('pos_id',$pos_id[$i]);
                $checkpos =  $this->db->get();
                if($checkpos->num_rows()>0){
                    $this->db->where('dept_id',$dept_id)->where('pos_id',$pos_id[$i])->set($deptpositiondata)->update('positions');
                }else{
                    $this->db->insert('positions',$deptpositiondata);
                }
            }
            
        }
    }
    
    function GetStagePrivilage(){
        extract($this->input->post());
        return $this->db->select('*')->from('user_privilage')->where('user_id',$user_id)->where('stage',$stage)->get();
    }
    
    function SaveUpdatePrivilage(){
         extract($this->input->post());
        
        foreach ($_POST['field_names'] as $field_name) {
            
            $can_read = isset($_POST['read'][$field_name]) ? 1 : 0;
            $can_write = isset($_POST['write'][$field_name]) ? 1 : 0;
            
            $data=array(
                'read'          =>$can_read,
                'write'         =>$can_write,
            );
    
            $check = $this->db->select('*')->from('user_privilage')->where('user_id',$user_id)->where('stage',$stage)->where('entry_field',$field_name)->get();
        
            if($check->num_rows()==0){
                $data['user_id']=$user_id;
                $data['stage']=$stage;
                $data['entry_field']   =$field_name;
                
                $this->db->insert('user_privilage',$data);
            }else{
                
                $this->db->where('user_id',$user_id)->where('stage',$stage)->where('entry_field',$field_name)->update('user_privilage',$data);
            }
        }
    }
    
    function GetEmployees(){
        extract($this->input->post());
        return $this->db->select('*')
                        ->from('employees e')
                        ->join('positions p','p.pos_id=e.pos_id','left')
                        ->join('departments d','d.dept_id=e.dept_id','left')
                        // ->where('id',$employee_id)
                        ->get();
    }
    
    function getPositionsList(){
        extract($this->input->post());
        return $this->db->select('*')->from('positions')->where('dept_id',$department_id)->get();
    }
    
   function LoadCompanyForm() {
        extract($this->input->post());
        $where = array('id' => $school_id);
        return $result = $this->db->select('*')->from('companys_detail')->where($where)->get();
    }
    function LoadEmployeeForm(){
        extract($this->input->post());
        $where = array('id' => $employee_id);
        return $result = $this->db->select('*')->from('employees')->where($where)->get();
    }
  
    function CompanyList(){
        return $result = $this->db->select('id,company_name')->from('companys_detail')->get();
    }

    function TeachersList(){
        extract($this->input->post());
        $finalout = array();
        
        if($school_id==''){exit;}
        
         $result = $this->db
                            ->select('*')
                            ->from('employees')
                            ->where('school_id',$school_id)
                            ->where('status',0)
                            ->get();
        $out = array();
        foreach ($result->result_array() as $detail) {
            $singlerow = array();
                $setdet = $this->db
                                    ->select('t.*,t.id id,s.company_name company_name,s.id school_id')
                                    ->from('teachers_share_loan_set t')
                                    ->join('companys_detail s','s.id=t.school_id','left')
                                    ->where('t.school_id',$detail['school_id'])
                                    ->where('t.employee_id',$detail['id'])
                                    ->get();
                
                    foreach($setdet->result_array() as $setdetail);
                
                
                $singlerow['date']=date('Y-m-d');
                $singlerow['teacher_name']=$detail['teacher_name'];
                $singlerow['company_name']=$setdetail['company_name'];
                $singlerow['school_id']=$setdetail['school_id'];
                $singlerow['share_amount']=$setdetail['share'];
                $singlerow['loan_amount']=$setdetail['loan'];
                $singlerow['interest_amount']=$setdetail['interest'];
                $singlerow['total_amount']=$setdetail['share']+$setdetail['loan']+$setdetail['interest'];
                $out[]=$singlerow;
        }
        $finalout[] = $out;
        ///////////////////////////////////////////////////
        // $shareandloandates = array();
        // $loanledger = $this->db
        //                             ->select('t.date date,sum(t.credit) loan,sum(t.interest) interest,t.id id,s.company_name company_name,t.cheque_number cheque_number')
        //                             ->from('loan_ledger t')
        //                             ->join('companys_detail s','s.id=t.school_id','left')
        //                             ->where('t.school_id',$school_id)
        //                             ->group_by('t.date')
        //                             ->order_by('t.date','desc')
        //                             ->get();
                                    
        //                              foreach ($loanledger->result_array() as $loandetailschool)
        //                              {
        //                                  $shareandloandates[] = $loandetailschool['date'];
        //                              }
                                    
        // $shareledger = $this->db
        //                             ->select('t.date date,sum(t.credit) share,t.id id,s.company_name company_name,t.cheque_number cheque_number')
        //                             ->from('savings_ledger t')
        //                             ->join('companys_detail s','s.id=t.school_id','left')
        //                             ->where('t.school_id',$school_id)
        //                             ->group_by('t.date')
        //                             ->order_by('t.date','desc')
        //                             ->get();
                                    
        //                              foreach ($shareledger->result_array() as $sharedetailschool)
        //                              {
        //                                  $shareandloandates[] = $sharedetailschool['date'];
        //                              }
                                        
        //                                 $shareandloandates = array_unique($shareandloandates);
        //                                 foreach($shareandloandates as $time) {
        //                                     $o[strtotime($time)] = $time;
        //                                 } 
                                        
        //                             ksort($o,1);
                                    
        //                             $shareandloandates = array_values($o);
        
        // $out = array();
        // for($i=0;$i<count($shareandloandates);$i++)
        // {
        //     $singlerow = array();
        //     $cheque_number= array();
        //             $singlerow['share_amount'] =$singlerow['loan_amount'] =$singlerow['interest_amount'] = 0;
                
        //     foreach ($shareledger->result_array() as $sharedetailschool)
        //      {
        //          if($shareandloandates[$i] == $sharedetailschool['date'])
        //          {
        //             $singlerow['share_amount']=$sharedetailschool['share'];
        //             if(!in_array($sharedetailschool['cheque_number'],$cheque_number)){
        //                 $cheque_number[]     = $sharedetailschool['cheque_number'];
        //             }
        //             break;
        //          }
                 
        //      }
             
        //     foreach ($loanledger->result_array() as $loandetailschool)
        //      {
        //          if($shareandloandates[$i] == $loandetailschool['date'])
        //          {
        //             $singlerow['loan_amount']=$loandetailschool['loan'];
        //             $singlerow['interest_amount']=$loandetailschool['interest'];
                    
        //             if(!in_array($loandetailschool['cheque_number'],$cheque_number)){
        //                 $cheque_number[]     = $loandetailschool['cheque_number'];
        //             }
                    
        //             break;
        //          }
                 
        //      }
        //             $singlerow['date']              = $shareandloandates[$i];
        //             $singlerow['cheque_number']     = implode(',',$cheque_number);
        //             $singlerow['company_name']       = ($sharedetailschool['company_name']==''?$loandetailschool['company_name']:$sharedetailschool['company_name']);
        //             $singlerow['share_amount']      = $singlerow['share_amount']> 0?$singlerow['share_amount']:0;
        //             $singlerow['loan_amount']       = $singlerow['loan_amount']>0?$singlerow['loan_amount']:0;
        //             $singlerow['interest_amount']   = $singlerow['interest_amount']>0?$singlerow['interest_amount']:0;
        //             $singlerow['total_amount']      = $singlerow['share_amount']+$singlerow['loan_amount']+$singlerow['interest_amount'];
            
        //     $out[]=$singlerow;
        // }
        
        //$finalout[] = $out;
        
        return $finalout;
    }
    
   function DeleteSchool() {
        extract($this->input->post());
        if(is_array($company_id)){
            $this->db->where_in('id' , $company_id);
        }else{
            $this->db->where('id' , $company_id);
        }
          return $result = $this->db->delete('companys_detail');
    }
    
    function DeleteTeacher() {
        extract($this->input->post());
        if(is_array($employee_id)){
            $this->db->where_in('id' , $employee_id);
        }else{
            $this->db->where('id' , $employee_id);
        }
          return $result = $this->db->delete('employees');
    }
    
    function RemoveTeacher() {
        extract($this->input->post());
        if(is_array($employee_id)){
            $this->db->where_in('id' , $employee_id);
        }else{
            $this->db->where('id' , $employee_id);
        }
        
          $result = $this->db->set('status',1)->update('employees');
          
          print_r($this->db->last_query());
    }
    
    function GetStates(){
        return $this->db->select('*')->from('states')->get();
    }
    
    function GetJaathi(){
        return $this->db->select('caste')->from('employees')->group_by('caste')->get();
    }

    function GetTeachers(){
        extract($this->input->post());
        $where = array('school_id' => $school_id);
        $result = $this->db
                        ->select('*')
                        ->from('employees')
                        ->where($where)
                        ->get()
                        ->result_array();
        echo json_encode($result);

    }

    function exportemployeeslist(){
        
        $teachers =  $this->db
                                    ->select('*')
                                    ->from('employees t')
                                    ->join('positions p','p.pos_id=t.pos_id','left')
                                    ->join('departments d','d.dept_id=t.dept_id','left')
                                    ->get();
        $output = array();
        foreach($teachers->result_array() as $teacher)
        {
            $row = array();
            $row['employee_name']  = $teacher['employee_name'];
            $row['dept_name']  = $teacher['dept_name'];
            $row['mobile_number']  = $teacher['mobile_number'];
            $row['city']  = $teacher['city'];
            $row['designation']  = $teacher['pos_name'];
            $row['employee_number']  = $teacher['employee_number'];

            $output[] = $row;
        }
        
        return $output;
    }
    
    function GetCashBookBanks(){
        return $this->db->select('*')->from('banks')->get();
    }
    
    function AddToEmployeeList(){
        extract($this->input->post());
        $this->db->where('id',$employee_id)->set('status',0)->update('employees');
    }
    
    function GetStageOneDetails($dhr_id){
        $output = array();
        
        $dhr_count = $this->db->select('dhr_count')
                                        ->from('dhr_count')
                                       ->get();
        foreach($dhr_count->result_array() as $dhr_counter);
        
        $output['dhr_count'] = $dhr_counter['dhr_count']+1;
        
        $output['stage_one_dhr_order_information'] = $this->db->select('*')->from('stage_one_dhr_order_information')->where('id',$dhr_id)->get();
        $output['stage_one_dhr_bill_of_material'] = $this->db->select('*')->from('stage_one_dhr_bill_of_material')->where('dhr_id',$dhr_id)->get();
        $output['stage_one_pre_manufacturing_process'] = $this->db->select('*')->from('stage_one_dhr_pre_manufacturing_process')->where('dhr_id',$dhr_id)->get();
        $output['stage_one_manufacturing_process'] = $this->db->select('*')->from('stage_one_dhr_manufacturing_process')->where('dhr_id',$dhr_id)->get();
        $output['stage_one_post_manufacturing_process'] = $this->db->select('*')->from('stage_one_dhr_post_manufacturing_process')->where('dhr_id',$dhr_id)->get();
        $output['stage_one_quality_control_process'] = $this->db->select('*')->from('stage_one_dhr_quality_control_process')->where('dhr_id',$dhr_id)->get();
        $output['finished_goods_transfer_note'] = $this->db->select('*')->from('stage_one_dhr_finished_goods_transfer_note')->where('dhr_id',$dhr_id)->get();
        $output['stage_one_material_reconciliation'] = $this->db->select('*')->from('stage_one_dhr_material_reconciliation')->where('dhr_id',$dhr_id)->get();
        $output['stage_one_finished_goods_reconcillation'] = $this->db->select('*')->from('stage_one_dhr_finished_goods_reconciliation')->where('dhr_id',$dhr_id)->get();
        $output['stage_one_qa_approval_and_release'] = $this->db->select('*')->from('stage_one_dhr_qa_approval_and_release')->where('dhr_id',$dhr_id)->get();
        $output['employees'] = $this->db->select('*')
                                        ->from('employees e')
                                        ->join('positions s','s.pos_id=e.pos_id','left')
                                        ->join('departments d','d.dept_id=e.dept_id','left')
                                        ->where('e.status',0)
                                        ->get();
        $output['stage_one_footer_note']= $this->db->select('*')->from('stage_one_footer_note')->where('dhr_id',$dhr_id)->get();   
        $output['stage_one_qcp_files'] = $orderno = $this->db->select('*')->from('stage_one_qcp_files')->where('dhr_id',$dhr_id)->get();
        $output['user_privilages'] = $orderno = $this->db->select('*')
                                                            ->from('user_privilage')
                                                            ->where('stage','Stage_1')
                                                            ->where('user_id',$this->session->userdata('staff_id'))
                                                            ->get();
         $output['departments'] = $orderno = $this->db->select('*')
                                                            ->from('departments')
                                                           ->get();                                                    
           
        return $output;
    }
    
    function stage_one_order_form(){
        extract($this->input->post());
        
        $data = array(
            'sales_order'           =>$sales_order,
            'production_order'      =>$production_order,
            'product_description'   =>$product_description,
            'order_quantity'        =>$order_quantity,
            'batchorlot'            =>$batchorlot,
            'production_quantity'   =>$production_quantity,
            'reformodel'            =>$reformodel,
            'manufacturing_date'    =>$manufacturing_date,
            'date_of_commencement'  =>$date_of_commencement,
            'itemcode'              =>$itemcode,
            'expiry_date'           =>$expiry_date,
            'date_of_completion'    =>$date_of_completion,
            'dhr_issued_by_qa'      =>$dhr_issued_by_qa,
            'dhr_issued_date_qa'    =>$dhr_issued_date_qa,
            'dhr_received_by_production'=>$dhr_received_by_production,
            'dhr_received_date_production'=>$dhr_received_date_production,
            'stage'                 =>$stage,
        );
        
        $check =  $this->db->select('id,dhr')->from('stage_one_dhr_order_information')->where('id',$dhr_id)->get();
        
        if($check->num_rows()>0){
            foreach($check->result_array() as $checkr);
            
            $dhr_id  = $dhr_id;
            $dhr     = $checkr['dhr'];
            
            $this->db->where('id',$dhr_id)->set($data)->update('stage_one_dhr_order_information');
            
        }else{
            $dhrc =  $this->db->select('dhr_count')->from('dhr_count')->get();
            foreach($dhrc->result_array() as $dhrcr);
            
            //$dhr_count  = $dhrcr['dhr_count']+=1;
            //$dhr        = (date('Y').str_pad($dhr_count,4,0,STR_PAD_LEFT));
           //TEMP BASIS CLOSED INCREMENTING
            
            $data['dhr'] = $dhr;
        
            $this->db->insert('stage_one_dhr_order_information',$data);
            $dhr_id = $this->db->insert_id();
            
            //$this->db->set('dhr_count',$dhr_count)->update('dhr_count');
        }
        return array('dhr'=>$dhr,'dhr_id'=>$dhr_id);
    }
    
    function stage_one_bill_of_material_form(){
        extract($this->input->post());
        
        $check =  $this->db->where('dhr_id',$dhr_id)->where('financial_year',$this->session->userdata('financial_year'))->delete('stage_one_dhr_bill_of_material');
        
        for($i=0;$i<count($item_number);$i++){
            $data = array(
                'dhr_id'            =>$dhr_id,
                'financial_year'    =>$this->session->userdata('financial_year'),
                'last_stage_three_product'=>isset($last_stage_three_product[$i])?$last_stage_three_product[$i]:'',
                'item_number'       =>isset($item_number[$i])?$item_number[$i]:'',
                'item_description'  =>isset($item_description[$i])?$item_description[$i]:'',
                'uom'               =>isset($uom[$i])?$uom[$i]:'',
                'last_quantity_transfered'=>isset($last_quantity_transfered[$i])?$last_quantity_transfered[$i]:'',
                'actual_quantity_required'=>isset($actual_quantity_required[$i])?$actual_quantity_required[$i]:'',
                'extra_quantity_required_percentage'=>isset($extra_quantity_required_percentage[$i])?$extra_quantity_required_percentage[$i]:'',
                'quantity_required' =>isset($quantity_required[$i])?$quantity_required[$i]:'',
                'quantity_issued'   =>isset($quantity_issued[$i])?$quantity_issued[$i]:'',
                'qir_number'        =>isset($qir_number[$i])?$qir_number[$i]:'',
                'item_lot_number'   =>isset($item_lot_number[$i])?$item_lot_number[$i]:'',
                'issued_by'         =>isset($issued_by[$i])?$issued_by[$i]:'',
                'received_by'       =>isset($received_by[$i])?$received_by[$i]:'',
                'date'              =>isset($date[$i])?$date[$i]:'',
                'remarks'           =>isset($remarks[$i])?$remarks[$i]:'',
            );
            $this->db->insert('stage_one_dhr_bill_of_material',$data);
        }
    }
    
    function stage_one_pre_manufacturing_process_form(){
        extract($this->input->post());
        
        $check =  $this->db->where('dhr_id',$dhr_id)->where('financial_year',$this->session->userdata('financial_year'))->delete('stage_one_dhr_pre_manufacturing_process');
        
        for($i=0;$i<count($prmp_item_number);$i++){
            $data = array(
                'dhr_id'                =>$dhr_id,
                'financial_year'        =>$this->session->userdata('financial_year'),
                'prmp_item_number'      =>isset($prmp_item_number[$i])?$prmp_item_number[$i]:'',
                'prmp_item_description' =>isset($prmp_item_description[$i])?$prmp_item_description[$i]:'',
                'prmp_uom'              =>isset($prmp_uom[$i])?$prmp_uom[$i]:'',
                'prmp_qunatity'         =>isset($prmp_qunatity[$i])?$prmp_qunatity[$i]:'',
                'prmp_wi_number'        =>isset($prmp_wi_number[$i])?$prmp_wi_number[$i]:'',
                'prmp_equipment_number' =>isset($prmp_equipment_number[$i])?$prmp_equipment_number[$i]:'',
                'prmp_done_by'          =>isset($prmp_done_by[$i])?$prmp_done_by[$i]:'',
                'prmp_verified_by'      =>isset($prmp_verified_by[$i])?$prmp_verified_by[$i]:'',
                'prmp_date'             =>isset($prmp_date[$i])?$prmp_date[$i]:'',
                
            );
       
            $this->db->insert('stage_one_dhr_pre_manufacturing_process',$data);
        }
    }
    
    function stage_one_manufacturing_process_form(){
         extract($this->input->post());
        
        $check =  $this->db->where('dhr_id',$dhr_id)->where('financial_year',$this->session->userdata('financial_year'))->delete('stage_one_dhr_manufacturing_process');
        
        for($i=0;$i<count($mp_seq_number);$i++){
            $data = array(
                'dhr_id'                =>$dhr_id,
                'financial_year'        =>$this->session->userdata('financial_year'),
                'mp_seq_number'         =>isset($mp_seq_number[$i])?$mp_seq_number[$i]:'',
                'mp_process_description'=>isset($mp_process_description[$i])?$mp_process_description[$i]:'',
                'mp_wi_number'          =>isset($mp_wi_number[$i])?$mp_wi_number[$i]:'',
                'mp_equipment_number'   =>isset($mp_equipment_number[$i])?$mp_equipment_number[$i]:'',
                'mp_start_datetime'     =>isset($mp_start_datetime[$i])?$mp_start_datetime[$i]:'',
                'mp_end_datetime'       =>isset($mp_end_datetime[$i])?$mp_end_datetime[$i]:'',
                'mp_manufactured_qunatity'      =>isset($mp_manufactured_qunatity[$i])?$mp_manufactured_qunatity[$i]:'',
                'mp_good_qunatity'      =>isset($mp_good_qunatity[$i])?$mp_good_qunatity[$i]:'',
                'mp_rejected_qunatity'  =>isset($mp_rejected_qunatity[$i])?$mp_rejected_qunatity[$i]:'',
                'mp_done_by'            =>isset($mp_done_by[$i])?$mp_done_by[$i]:'',
                'mp_verified_by'        =>isset($mp_verified_by[$i])?$mp_verified_by[$i]:'',
                'mp_remarks'            =>isset($mp_remarks[$i])?$mp_remarks[$i]:'',
                'mp_line_clearance_by'  =>isset($mp_line_clearance_by[$i])?$mp_line_clearance_by[$i]:'',
                
            );
       
            $this->db->insert('stage_one_dhr_manufacturing_process',$data);
        }
       
    }
    
    function stage_one_post_manufacturing_process_form(){
         extract($this->input->post());
        
        $check =  $this->db->where('dhr_id',$dhr_id)->where('financial_year',$this->session->userdata('financial_year'))->delete('stage_one_dhr_post_manufacturing_process');
        
        for($i=0;$i<count($pmp_seq_number);$i++){
            $data = array(
                'dhr_id'                =>$dhr_id,
                'financial_year'        =>$this->session->userdata('financial_year'),
                'pmp_seq_number'        =>isset($pmp_seq_number[$i])?$pmp_seq_number[$i]:'',
                'pmp_process_description'=>isset($pmp_process_description[$i])?$pmp_process_description[$i]:'',
                'pmp_wi_number'         =>isset($pmp_wi_number[$i])?$pmp_wi_number[$i]:'',
                'pmp_dcc_number'        =>isset($pmp_dcc_number[$i])?$pmp_dcc_number[$i]:'',
                'pmp_sent_date'         =>isset($pmp_sent_date[$i])?$pmp_sent_date[$i]:'',
                'pmp_cycle_number_or_report_number'=>isset($pmp_cycle_number_or_report_number[$i])?$pmp_cycle_number_or_report_number[$i]:'',
                'pmp_process_date'      =>isset($pmp_process_date[$i])?$pmp_process_date[$i]:'',
                'pmp_done_by'           =>isset($pmp_done_by[$i])?$pmp_done_by[$i]:'',
                'pmp_checked_by'        =>isset($pmp_checked_by[$i])?$pmp_checked_by[$i]:'',
                
            );
       
            $this->db->insert('stage_one_dhr_post_manufacturing_process',$data);
        }
       
    }
    
    function stage_one_quality_control_process_form(){
         extract($this->input->post());
        
        $this->db->where('dhr_id',$dhr_id)->where('financial_year',$this->session->userdata('financial_year'))->delete('stage_one_dhr_quality_control_process');
        
        for($i=0;$i<count($qcp_seq_number);$i++){
            $data = array(
                'dhr_id'                =>$dhr_id,
                'financial_year'        =>$this->session->userdata('financial_year'),
                'qcp_seq_number'=>$qcp_seq_number[$i],
                'qcp_process_inspection_or_testing_description'=>$qcp_process_inspection_or_testing_description[$i],
                'qcp_wi_number'=>$qcp_wi_number[$i],
                'qcp_qir_number_or_report_number'=>$qcp_qir_number_or_report_number[$i],
                'qcp_sample_quantity'=>$qcp_sample_quantity[$i],
                'qcp_pass_or_fail'=>$qcp_pass_or_fail[$i],
                'qcp_verified_by'=>$qcp_verified_by[$i],
                'qcp_verified_date'=>$qcp_verified_date[$i],
                'qcp_scanned_file'=>$qcp_scanned_file[$i],
            );
       
            $this->db->insert('stage_one_dhr_quality_control_process',$data);
            $current_id = $this->db->insert_id();
        }
            
        if (!empty($_FILES["qcp_scanned_pdf_file"]["name"]))
        {
            $orderno = $this->db->select('*')->from('stage_one_dhr_order_information')->where('id',$dhr_id)->get();
            foreach($orderno->result_array() as $orderdetail);
            $batch_or_lot_no = $orderdetail['batchorlot'];
             
            $type = explode('.', $_FILES['qcp_scanned_pdf_file']['name']);
            $type = $type[count($type) - 1];
            $filename = str_replace(['/','*','&','@'],'_',($batch_or_lot_no . '.' . $type));
            
            $config['upload_path'] = 'assets/qcp_scanned_files/';
            $config['file_name'] = $filename;
            $config['allowed_types'] = 'png|PNG|jpeg|JPEG|jpg|JPG|PDF|pdf';
            $config['file_size'] = '1024M';
            $config['overwrite'] = TRUE;
            
            if(!file_exists($config['upload_path'])){
                mkdir($config['upload_path']);
            }
            
            
            $this->upload->initialize($config);
            if(!$this->upload->do_upload('qcp_scanned_pdf_file')){
              echo $this->upload->display_errors();   
            }else{
                $fileuploadeddata = $this->upload->data();
            }
            
            $scanned_file = $config['upload_path'].$fileuploadeddata['file_name'];
            
            $scanned_data=array(
                'dhr_id'=>$dhr_id,
                'scanned_file'=>$scanned_file,
            );
            $checkscanned = $this->db->select('*')->from('stage_one_qcp_files')->where('dhr_id',$dhr_id)->get();
            if($checkscanned->num_rows()>0){
                $this->db->where('dhr_id',$dhr_id)->set($scanned_data)->update('stage_one_qcp_files');
            }else{
                $this->db->insert('stage_one_qcp_files',$scanned_data);
            }
        }
    }
    
    function stage_one_finished_goods_transferred_note_form(){
        extract($this->input->post());
        
        $data = array(
            'dhr_id'            =>$dhr_id,
            'financial_year'    =>$this->session->userdata('financial_year'),
            'transferred_quantity'=>$transferred_quantity,
            'transferred_by'    =>$transferred_by,
            'transferred_date'  =>$transferred_date,
            'accepted_by'       =>$accepted_by,
            'accepted_date'     =>$accepted_date
        );
        
            $check =  $this->db->select('id')->from('stage_one_dhr_finished_goods_transfer_note')->where('dhr_id',$dhr_id)->get();
            if($check->num_rows()>0){
                $this->db->where('dhr_id',$dhr_id)->set($data)->update('stage_one_dhr_finished_goods_transfer_note');
            }else{
                $this->db->insert('stage_one_dhr_finished_goods_transfer_note',$data);
            }
        
    }
    
    function stage_one_material_reconciliation_form(){
        extract($this->input->post());
        
        $check =  $this->db->where('dhr_id',$dhr_id)->where('financial_year',$this->session->userdata('financial_year'))->delete('stage_one_dhr_material_reconciliation');
        
        for($i=0;$i<count($mrec_item_number);$i++){
            $data = array(
                'dhr_id'                =>$dhr_id,
                'financial_year'        =>$this->session->userdata('financial_year'),
                'mrec_last_stage_three_product'=>isset($mrec_last_stage_three_product[$i])?$mrec_last_stage_three_product[$i]:'',
                'mrec_item_number'      =>$mrec_item_number[$i],
                'mrec_description'      =>$mrec_description[$i],
                'mrec_uom'              =>$mrec_uom[$i],
                'mrec_quantity_received'=>$mrec_quantity_received[$i],
                'mrec_qir_number'       =>$mrec_qir_number[$i],
                'mrec_item_lot_number_or_input_lot'=>$mrec_item_lot_number_or_input_lot[$i],
                'mrec_returned_by'      =>$mrec_returned_by[$i],
                'mrec_received_by'      =>$mrec_received_by[$i],
                'mrec_date'             =>$mrec_date[$i],
                'mrec_remark'           =>$mrec_remark[$i],
                
            );
       
            $this->db->insert('stage_one_dhr_material_reconciliation',$data);
        }
       
    }
    
    function stage_one_finished_goods_reconciliation_form(){
        extract($this->input->post());
        
        $data = array(
            'dhr_id'                                =>$dhr_id,
            'financial_year'                        =>$this->session->userdata('financial_year'),
            'total_quantity_produced_and_packed'    =>$total_quantity_produced_and_packed,
            'archive_samples_quantity'              =>isset($archive_samples_quantity)?$archive_samples_quantity:'',
            'ep_archive_samples_quantity'           =>isset($ep_archive_samples_quantity)?$ep_archive_samples_quantity:'',
            'production_archive_samples_quantity'   =>isset($production_archive_samples_quantity)?$production_archive_samples_quantity:'',
            'penetration_samples_quantity'          =>isset($penetration_samples_quantity)?$penetration_samples_quantity:'',
            'control_samples_quantity'              =>$control_samples_quantity,
            'rejected_quantity'                     =>$rejected_quantity,
            'yield_percentage'                      =>$yield_percentage,
            'reject_percentage'                      =>$reject_percentage,
            'production_verified_by'                =>$production_verified_by,
            'production_verified_date'              =>$production_verified_date,
            'production_verified_by_remarks'        =>$production_verified_by_remarks,
            'checked_by_quality_control'            =>$checked_by_quality_control,
            'checked_by_quality_control_date'       =>$checked_by_quality_control_date,
            'checked_by_quality_control_remark'     =>$checked_by_quality_control_remark,
        );
        
            $check =  $this->db->select('id')->from('stage_one_dhr_finished_goods_reconciliation')->where('dhr_id',$dhr_id)->get();
            if($check->num_rows()>0){
                $this->db->where('dhr_id',$dhr_id)->set($data)->update('stage_one_dhr_finished_goods_reconciliation');
            }else{
                $this->db->insert('stage_one_dhr_finished_goods_reconciliation',$data);
            }
        
    }
    
    function stage_one_qa_approval_and_release_form(){
        extract($this->input->post());
        
        $data = array(
            'dhr_id'                            =>$dhr_id,
            'financial_year'                    =>$this->session->userdata('financial_year'),
            'quantity_released_for_dispatch'    =>$quantity_released_for_dispatch,
            'date_of_release'                   =>$date_of_release,
            'remarks'                           =>$remarks,
            'signature'                         =>$signature,
        );
        
            $check =  $this->db->select('id')->from('stage_one_dhr_qa_approval_and_release')->where('dhr_id',$dhr_id)->get();
            if($check->num_rows()>0){
                $this->db->where('dhr_id',$dhr_id)->set($data)->update('stage_one_dhr_qa_approval_and_release');
            }else{
                $this->db->insert('stage_one_dhr_qa_approval_and_release',$data);
            }
            
        if (!empty($_FILES["cc_scanned_pdf_file"]["name"]))
        {
            $orderno = $this->db->select('*')->from('stage_one_dhr_order_information')->where('id',$dhr_id)->get();
            foreach($orderno->result_array() as $orderdetail);
            $batch_or_lot_no = $orderdetail['dhr'];
             
            $type = explode('.', $_FILES['cc_scanned_pdf_file']['name']);
            $type = $type[count($type) - 1];
            $filename = str_replace(['/','*','&','@'],'_',($batch_or_lot_no . '.' . $type));
            
            $config['upload_path'] = 'assets/qacc_scanned_files/';
            $config['file_name'] = $filename;
            $config['allowed_types'] = 'png|PNG|jpeg|JPEG|jpg|JPG|PDF|pdf';
            $config['file_size'] = '1024M';
            $config['overwrite'] = TRUE;
            
            if(!file_exists($config['upload_path'])){
                mkdir($config['upload_path']);
            }
            
            
            $this->upload->initialize($config);
            if(!$this->upload->do_upload('cc_scanned_pdf_file')){
              echo $this->upload->display_errors();   
            }else{
                $fileuploadeddata = $this->upload->data();
            }
            
            $scanned_file = $config['upload_path'].$fileuploadeddata['file_name'];
            
            $scanned_data=array(
                'dhr_id'=>$dhr_id,
                'scanned_file'=>$scanned_file,
            );
            $checkscanned = $this->db->select('*')->from('stage_one_qap_files')->where('dhr_id',$dhr_id)->get();
            if($checkscanned->num_rows()>0){
                $this->db->where('dhr_id',$dhr_id)->set($scanned_data)->update('stage_one_qap_files');
            }else{
                $this->db->insert('stage_one_qap_files',$scanned_data);
            }
        }
        
    }
    
    function stage_one_footer_note(){
        extract($this->input->post());
        
        $data = array(
            'dhr_id'            =>$dhr_id,
            'financial_year'    =>$this->session->userdata('financial_year'),
            'format_no'         =>$format_no,
            'rev_no'            =>$rev_no,
            'effective_date'    =>$effective_date,
        );
        
        $check =  $this->db->select('id')->from('stage_one_footer_note')->where('dhr_id',$dhr_id)->get();
        
        if($check->num_rows()>0){
            return $this->db->where('dhr_id',$dhr_id)->set($data)->update('stage_one_footer_note');
        }else{
            return $this->db->insert('stage_one_footer_note',$data);
        }
         
    }
    
    function RemoveDHR() {
        extract($this->input->post());
        if(is_array($dhr_id)){
            $this->db->where_in('id' , $dhr_id);
        }else{
            $this->db->where('id' , $dhr_id);
        }
        
          $result = $this->db->set('removed',1)->update('stage_one_dhr_order_information');
          
          print_r($this->db->last_query());
    }
    
    function DeleteDHR() {
        extract($this->input->post());
        if(is_array($dhr_id)){
            $this->db->where_in('id' , $dhr_id);
        }else{
            $this->db->where('id' , $dhr_id);
        }
          return $result = $this->db->delete('stage_one_dhr_order_information');
    }
    
    function SaveUpdateStageOne(){
        $data = $this->input->post();
        
        $this->stage_one_order_form();
        $this->stage_one_bill_of_material_form();
        $this->stage_one_pre_manufacturing_process_form();
        $this->stage_one_manufacturing_process_form();
        $this->stage_one_post_manufacturing_process_form();
        $this->stage_one_quality_control_process_form();
        $this->stage_one_finished_goods_transferred_note_form();
        $this->stage_one_material_reconciliation_form();
        $this->stage_one_finished_goods_reconciliation_form();
        $this->stage_one_qa_approval_and_release_form();
        
        // $check =  $this->db->select('id')->from('stage_one_dhr_order_information')->where('id',$order_id)->get();
        // if($check->num_rows()>0){
        //     $this->db->where('id',$order_id)->set($data)->update('stage_one_dhr_order_information');
        // }else{
        //     $this->db->insert('stage_one_dhr_order_information',$data);
        // }
    }
    
    function get_item_description(){
        extract($this->input->post());
        return $this->db->select('*')->from('item_wise_bom')->where('item_code',$item_code)->get();
        
    }
    
    function stage_two_get_item_description(){
        $output = array();
        extract($this->input->post());
        $output['bom_details']              = $this->db->select('*')->from('item_wise_bom')->where('item_code',$item_code)->get();
        
        $codefetch = $this->db->select('group_concat(raw_material_or_ingredient) rmi')->from('item_wise_bom')->where('item_code',$item_code)->get();
        foreach($codefetch->result_array() as $foritemcode);
        $item_code_wise_stage_one_lot_details    = $this->db->select('itemcode,group_concat(batchorlot) batchorlot')
                                                        ->from('stage_one_dhr_order_information')
                                                        ->where_in('itemcode',explode(',',$foritemcode['rmi']))
                                                        ->where('stage','stage_1')
                                                        ->group_by('itemcode')
                                                        ->get();
        $lots = array();
        foreach($item_code_wise_stage_one_lot_details->result_array() as $itemwiselots){
            $lots[$itemwiselots['itemcode']]=explode(',',$itemwiselots['batchorlot']);
        }                                              
        $output['stage_one_lot_details']   = $lots;                                              
        return $output;
    }
    
    function stage_three_get_item_description(){
        $output = array();
        extract($this->input->post());
        $output['bom_details']              = $this->db->select('*')->from('item_wise_bom')->where('item_code',$item_code)->get();
        
        $codefetch = $this->db->select('group_concat(REPLACE(IFNULL(raw_material_or_ingredient, ""), "_HD", "")) rmi')->from('item_wise_bom')->where('item_code',$item_code)->get();
        //print_r($this->db->last_query());
        foreach($codefetch->result_array() as $foritemcode);
        $item_code_wise_stage_one_lot_details    = $this->db->select('UPPER(itemcode) itemcode,group_concat(batchorlot) batchorlot')
                                                        ->from('stage_one_dhr_order_information')
                                                        ->where_in('itemcode',explode(',',$foritemcode['rmi']))
                                                        ->where('stage','stage_2')
                                                        ->group_by('itemcode')
                                                        ->get();
        // print_r($this->db->last_query());
        $lots = array();
        foreach($item_code_wise_stage_one_lot_details->result_array() as $itemwiselots){
            $lots[$itemwiselots['itemcode']]=explode(',',$itemwiselots['batchorlot']);
        }                                              
        $output['stage_two_lot_details']   = $lots;                                              
        return $output;
    }
    
    function stage_four_get_item_description(){
        $output = array();
        extract($this->input->post());
        
        $this->db->select('*')->from('item_wise_bom');
        $this->db->where('item_code',$item_code);
        if(substr($item_code,0,3)==='F03'){
            $this->db->where('bom_name','BOM Inhouse');
        }else{
            $this->db->where('bom_name','BOM IH Prod');
        }
        $output['bom_details'] = $this->db->get();
        
        $codefetch = $this->db->select('group_concat(REPLACE(IFNULL(raw_material_or_ingredient, ""), "_HD", "")) rmi')->from('item_wise_bom')->where('item_code',$item_code)->where('bom_name','BOM IH Prod')->get();
        //print_r($this->db->last_query());
        foreach($codefetch->result_array() as $foritemcode);
        $item_code_wise_stage_one_lot_details    = $this->db->select('UPPER(itemcode) itemcode,group_concat(batchorlot) batchorlot')
                                                        ->from('stage_one_dhr_order_information')
                                                        ->where_in('itemcode',explode(',',$foritemcode['rmi']))
                                                        ->where('stage','stage_3')
                                                        ->group_by('itemcode')
                                                        ->get();
        // print_r($this->db->last_query());
        $lots = array();
        foreach($item_code_wise_stage_one_lot_details->result_array() as $itemwiselots){
            $lots[$itemwiselots['itemcode']]=explode(',',$itemwiselots['batchorlot']);
        }                                              
        $output['stage_two_lot_details']   = $lots;                                              
        return $output;
    }
    
    function get_bom_item_code_description(){
        extract($this->input->post());
        return $this->db->select('*')->from('item_wise_bom')->where('item_code',$item_code)->get();
        
    }
    
    function get_mp_process_description(){
        extract($this->input->post());
        $output['manufacturing_process_steps']=$this->db->select('*')->from('manufacturing_process_steps')->where('step',$mp_seq_number)->get();
        $output['steps_equipments']=$this->db->select('*')->from('each_manufacturing_process_steps_equipments')->where('step',$mp_seq_number)->get();
        return $output;
    }
    
    function get_premp_process_description(){
        extract($this->input->post());
        $output['manufacturing_process_steps']=$this->db->select('*')->from('manufacturing_process_steps')->where('step',$mp_seq_number)->get();
        $output['steps_equipments']=$this->db->select('*')->from('each_manufacturing_process_steps_equipments')->where('step',$mp_seq_number)->get();
        return $output;
    }
    
    function get_postmp_process_description(){
        extract($this->input->post());
        $output['manufacturing_process_steps']=$this->db->select('*')->from('manufacturing_process_steps')->where('step',$mp_seq_number)->get();
        $output['steps_equipments']=$this->db->select('*')->from('each_manufacturing_process_steps_equipments')->where('step',$mp_seq_number)->get();
        return $output;
    }
    
    function get_qc_process_description(){
        extract($this->input->post());
        return $this->db->select('*')->from('quality_control_process_steps')->where('step',$qc_seq_number)->get();
    }
    
    function GetStageTwoDetails($dhr_id){
        $output = array();
        
        $dhr_count = $this->db->select('dhr_count')
                                        ->from('dhr_count')
                                       ->get();
        foreach($dhr_count->result_array() as $dhr_counter);
        
        $output['dhr_count'] = $dhr_counter['dhr_count']+1;
        
        $output['stage_one_dhr_order_information'] = $this->db->select('*')->from('stage_one_dhr_order_information')->where('id',$dhr_id)->get();
        $output['stage_one_dhr_bill_of_material'] = $this->db->select('*')->from('stage_one_dhr_bill_of_material')->where('dhr_id',$dhr_id)->get();
        $output['stage_one_pre_manufacturing_process'] = $this->db->select('*')->from('stage_one_dhr_pre_manufacturing_process')->where('dhr_id',$dhr_id)->get();
        $output['stage_one_manufacturing_process'] = $this->db->select('*')->from('stage_one_dhr_manufacturing_process')->where('dhr_id',$dhr_id)->get();
        $output['stage_one_post_manufacturing_process'] = $this->db->select('*')->from('stage_one_dhr_post_manufacturing_process')->where('dhr_id',$dhr_id)->get();
        $output['stage_one_quality_control_process'] = $this->db->select('*')->from('stage_one_dhr_quality_control_process')->where('dhr_id',$dhr_id)->get();
        $output['finished_goods_transfer_note'] = $this->db->select('*')->from('stage_one_dhr_finished_goods_transfer_note')->where('dhr_id',$dhr_id)->get();
        $output['stage_one_material_reconciliation'] = $this->db->select('*')->from('stage_one_dhr_material_reconciliation')->where('dhr_id',$dhr_id)->get();
        $output['stage_one_finished_goods_reconcillation'] = $this->db->select('*')->from('stage_one_dhr_finished_goods_reconciliation')->where('dhr_id',$dhr_id)->get();
        $output['stage_one_qa_approval_and_release'] = $this->db->select('*')->from('stage_one_dhr_qa_approval_and_release')->where('dhr_id',$dhr_id)->get();
        $output['employees'] = $this->db->select('*')
                                        ->from('employees e')
                                        ->join('positions s','s.pos_id=e.pos_id','left')
                                        ->join('departments d','d.dept_id=e.dept_id','left')
                                        ->where('e.status',0)
                                        ->get();
        $output['batchorlot_list'] = $this->db->select('id,batchorlot,itemcode')
                                        ->from('stage_one_dhr_order_information')
                                        ->where('batchorlot!=','')
                                        ->where('stage','stage_1')
                                        ->get();  
         $output['stage_one_footer_note']= $this->db->select('*')->from('stage_one_footer_note')->where('dhr_id',$dhr_id)->get();     
         $output['stage_one_qcp_files'] = $orderno = $this->db->select('*')->from('stage_one_qcp_files')->where('dhr_id',$dhr_id)->get();
         $output['user_privilages'] = $orderno = $this->db->select('*')
                                                            ->from('user_privilage')
                                                            ->where('stage','Stage_2')
                                                            ->where('user_id',$this->session->userdata('staff_id'))
                                                            ->get();
        $output['departments'] = $orderno = $this->db->select('*')
                                                            ->from('departments')
                                                           ->get();                                                       
        return $output;
    }
    
    function get_stageone_lot_transfered_qnatity(){
        extract($this->input->post());
       
            
        $stagetwodhrdetails = $this->db->select('group_concat(id) id')
                ->from('stage_one_dhr_order_information')
                ->where('dhr<=',$currentdhr)
                ->where('stage','stage_2')
                ->get(); 
                
        foreach($stagetwodhrdetails->result_array() as $stagetwodhr); 
        
        $quantity_issued = $this->db->select('sum(quantity_issued) quantity_issued')
                ->from('stage_one_dhr_bill_of_material')
                ->where('item_lot_number',$batchorlot)
                ->where_in('dhr_id',explode(',',$stagetwodhr['id']))
                ->get(); 
               
        foreach($quantity_issued->result_array() as $quantity_issuedr); 
            
        $quantity_till_issued = $quantity_issuedr['quantity_issued']==''?0:$quantity_issuedr['quantity_issued'];
        
         $out['batchdetails'] = $this->db->select('id,(production_quantity - '.$quantity_till_issued.') production_quantity,batchorlot')
                    ->from('stage_one_dhr_order_information')
                    ->where('batchorlot',$batchorlot)
                    ->where('stage','stage_1')
                    ->get(); 
            foreach($out['batchdetails']->result_array() as $dhr);
            
            $out['finished_goods_details'] = $this->db->select('transferred_quantity')
                    ->from('stage_one_dhr_finished_goods_transfer_note')
                    ->where('dhr_id',$dhr['id'])
                    ->get(); 
            foreach($out['batchdetails']->result_array() as $dhr);
        
        $out['qircodedetails'] = $this->db->select('qcp_qir_number_or_report_number qir_number')
                    ->from('stage_one_dhr_quality_control_process')
                    ->where('dhr_id',$dhr['id'])
                    ->where('qcp_seq_number',14)
                    ->get();             
        return $out;
    }
    
    function GetStageThreeDetails($dhr_id){
        $output = array();
        
        $dhr_count = $this->db->select('dhr_count')
                                        ->from('dhr_count')
                                       ->get();
        foreach($dhr_count->result_array() as $dhr_counter);
        
        $output['dhr_count'] = $dhr_counter['dhr_count']+1;
        
        $output['stage_one_dhr_order_information'] = $this->db->select('*')->from('stage_one_dhr_order_information')->where('id',$dhr_id)->get();
        $output['stage_one_dhr_bill_of_material'] = $this->db->select('*')->from('stage_one_dhr_bill_of_material')->where('dhr_id',$dhr_id)->get();
        $output['stage_one_pre_manufacturing_process'] = $this->db->select('*')->from('stage_one_dhr_pre_manufacturing_process')->where('dhr_id',$dhr_id)->get();
        $output['stage_one_manufacturing_process'] = $this->db->select('*')->from('stage_one_dhr_manufacturing_process')->where('dhr_id',$dhr_id)->get();
        $output['stage_one_post_manufacturing_process'] = $this->db->select('*')->from('stage_one_dhr_post_manufacturing_process')->where('dhr_id',$dhr_id)->get();
        $output['stage_one_quality_control_process'] = $this->db->select('*')->from('stage_one_dhr_quality_control_process')->where('dhr_id',$dhr_id)->get();
        $output['finished_goods_transfer_note'] = $this->db->select('*')->from('stage_one_dhr_finished_goods_transfer_note')->where('dhr_id',$dhr_id)->get();
        $output['stage_one_material_reconciliation'] = $this->db->select('*')->from('stage_one_dhr_material_reconciliation')->where('dhr_id',$dhr_id)->get();
        $output['stage_one_finished_goods_reconcillation'] = $this->db->select('*')->from('stage_one_dhr_finished_goods_reconciliation')->where('dhr_id',$dhr_id)->get();
        $output['stage_one_qa_approval_and_release'] = $this->db->select('*')->from('stage_one_dhr_qa_approval_and_release')->where('dhr_id',$dhr_id)->get();
        $output['employees'] = $this->db->select('*')
                                        ->from('employees e')
                                        ->join('positions s','s.pos_id=e.pos_id','left')
                                        ->join('departments d','d.dept_id=e.dept_id','left')
                                        ->where('e.status',0)
                                        ->get();
                                        
        $group_dhr_on_item_code = array();      
        
        $dhr_on_item_code =  $this->db->select('UPPER(item_number) item_number,group_concat(dhr_id) dhr_idies')
                                        ->from('stage_one_dhr_bill_of_material')
                                        ->group_by('item_number')
                                        ->get(); 
                                        
        foreach($dhr_on_item_code->result_array() as $dhr_on_item_coder){
            $group_dhr_on_item_code[$dhr_on_item_coder['item_number']] = explode(',',$dhr_on_item_coder['dhr_idies']);
        }
        $output['group_dhr_on_item_code'] = $group_dhr_on_item_code;
          
        $output['batchorlot_list'] = $this->db->select('id,batchorlot,itemcode')
                                        ->from('stage_one_dhr_order_information')
                                        ->where('batchorlot!=','')
                                        ->where('stage','stage_2')
                                        ->get();       
         $output['stage_one_footer_note']= $this->db->select('*')->from('stage_one_footer_note')->where('dhr_id',$dhr_id)->get();     
         $output['stage_one_qcp_files'] = $orderno = $this->db->select('*')->from('stage_one_qcp_files')->where('dhr_id',$dhr_id)->get();
         $output['user_privilages'] = $orderno = $this->db->select('*')
                                                            ->from('user_privilage')
                                                            ->where('stage','Stage_3')
                                                            ->where('user_id',$this->session->userdata('staff_id'))
                                                            ->get();
          $output['departments'] = $orderno = $this->db->select('*')
                                                            ->from('departments')
                                                           ->get();                                                       
        return $output;
    }
    
    function get_stagetwo_lot_transfered_qnatity(){
        extract($this->input->post());
       
            
        $stagetwodhrdetails = $this->db->select('group_concat(id) id')
                ->from('stage_one_dhr_order_information')
                ->where('dhr<=',$currentdhr)
                ->where('stage','stage_3')
                ->get(); 
                
        foreach($stagetwodhrdetails->result_array() as $stagetwodhr); 
        
        $quantity_issued = $this->db->select('sum(quantity_issued) quantity_issued')
                ->from('stage_one_dhr_bill_of_material')
                ->where('item_lot_number',$batchorlot)
                ->where_in('dhr_id',explode(',',$stagetwodhr['id']))
                ->get(); 
               
        foreach($quantity_issued->result_array() as $quantity_issuedr); 
            
        $quantity_till_issued = $quantity_issuedr['quantity_issued']==''?0:$quantity_issuedr['quantity_issued'];
        
         $out['batchdetails'] = $this->db->select('id,(production_quantity - '.$quantity_till_issued.') production_quantity,batchorlot')
                    ->from('stage_one_dhr_order_information')
                    ->where('batchorlot',$batchorlot)
                    ->where('stage','stage_2')
                    ->get(); 
            foreach($out['batchdetails']->result_array() as $dhr);
        
        $out['qircodedetails'] = $this->db->select('qcp_qir_number_or_report_number qir_number')
                    ->from('stage_one_dhr_quality_control_process')
                    ->where('dhr_id',$dhr['id'])
                     ->where('qcp_seq_number',15)
                    ->get();         
                    
        $out['finished_goods_details'] = $this->db->select('transferred_quantity')
                    ->from('stage_one_dhr_finished_goods_transfer_note')
                    ->where('dhr_id',$dhr['id'])
                    ->get(); 
            foreach($out['batchdetails']->result_array() as $dhr);
            
        return $out;
    }
    
    
    
    function GetStageFourDetails($dhr_id){
        $output = array();
        
        $dhr_count = $this->db->select('dhr_count')
                                        ->from('dhr_count')
                                       ->get();
        foreach($dhr_count->result_array() as $dhr_counter);
        
        $output['dhr_count'] = $dhr_counter['dhr_count']+1;
        
        $output['stage_one_dhr_order_information'] = $this->db->select('*')->from('stage_one_dhr_order_information')->where('id',$dhr_id)->get();
        $output['stage_one_dhr_bill_of_material'] = $this->db->select('*')->from('stage_one_dhr_bill_of_material')->where('dhr_id',$dhr_id)->get();
        $output['stage_one_pre_manufacturing_process'] = $this->db->select('*')->from('stage_one_dhr_pre_manufacturing_process')->where('dhr_id',$dhr_id)->get();
        $output['stage_one_manufacturing_process'] = $this->db->select('*')->from('stage_one_dhr_manufacturing_process')->where('dhr_id',$dhr_id)->get();
        $output['stage_one_post_manufacturing_process'] = $this->db->select('*')->from('stage_one_dhr_post_manufacturing_process')->where('dhr_id',$dhr_id)->get();
        $output['stage_one_quality_control_process'] = $this->db->select('*')->from('stage_one_dhr_quality_control_process')->where('dhr_id',$dhr_id)->get();
        $output['finished_goods_transfer_note'] = $this->db->select('*')->from('stage_one_dhr_finished_goods_transfer_note')->where('dhr_id',$dhr_id)->get();
        $output['stage_one_material_reconciliation'] = $this->db->select('*')->from('stage_one_dhr_material_reconciliation')->where('dhr_id',$dhr_id)->get();
        $output['stage_one_finished_goods_reconcillation'] = $this->db->select('*')->from('stage_one_dhr_finished_goods_reconciliation')->where('dhr_id',$dhr_id)->get();
        $output['stage_one_qa_approval_and_release'] = $this->db->select('*')->from('stage_one_dhr_qa_approval_and_release')->where('dhr_id',$dhr_id)->get();
        $output['employees'] = $this->db->select('*')
                                        ->from('employees e')
                                        ->join('positions s','s.pos_id=e.pos_id','left')
                                        ->join('departments d','d.dept_id=e.dept_id','left')
                                        ->where('e.status',0)
                                        ->get();
                                        
        $group_dhr_on_item_code = array();      
        
        $dhr_on_item_code =  $this->db->select('UPPER(item_number) item_number,group_concat(dhr_id) dhr_idies')
                                        ->from('stage_one_dhr_bill_of_material')
                                        ->group_by('item_number')
                                        ->get(); 
                                        
        foreach($dhr_on_item_code->result_array() as $dhr_on_item_coder){
            $group_dhr_on_item_code[$dhr_on_item_coder['item_number']] = explode(',',$dhr_on_item_coder['dhr_idies']);
        }
        $output['group_dhr_on_item_code'] = $group_dhr_on_item_code;
          
        $output['batchorlot_list'] = $this->db->select('id,batchorlot,itemcode')
                                        ->from('stage_one_dhr_order_information')
                                        ->where('batchorlot!=','')
                                        ->where('stage','stage_3')
                                        ->get();  
                                         
         $output['stage_one_footer_note']= $this->db->select('*')->from('stage_one_footer_note')->where('dhr_id',$dhr_id)->get();   
         $output['stage_one_qcp_files'] = $orderno = $this->db->select('*')->from('stage_one_qcp_files')->where('dhr_id',$dhr_id)->get();
          $output['stage_one_qap_files'] = $orderno = $this->db->select('*')->from('stage_one_qap_files')->where('dhr_id',$dhr_id)->get();
         $output['user_privilages'] = $orderno = $this->db->select('*')
                                                            ->from('user_privilage')
                                                            ->where('stage','Stage_4')
                                                            ->where('user_id',$this->session->userdata('staff_id'))
                                                            ->get();
          $output['departments'] = $orderno = $this->db->select('*')
                                                            ->from('departments')
                                                           ->get();                                                       
        return $output;
    }
    
    function get_stagethree_lot_transfered_qnatity(){
        extract($this->input->post());
       
            
        $stagetwodhrdetails = $this->db->select('group_concat(id) id')
                ->from('stage_one_dhr_order_information')
                ->where('dhr<=',$currentdhr)
                ->where('stage','stage_4')
                ->get(); 
                
        foreach($stagetwodhrdetails->result_array() as $stagetwodhr); 
        
        $quantity_issued = $this->db->select('sum(quantity_issued) quantity_issued')
                ->from('stage_one_dhr_bill_of_material')
                ->where('item_lot_number',$batchorlot)
                ->where_in('dhr_id',explode(',',$stagetwodhr['id']))
                ->get(); 
               
        foreach($quantity_issued->result_array() as $quantity_issuedr); 
            
        $quantity_till_issued = $quantity_issuedr['quantity_issued']==''?0:$quantity_issuedr['quantity_issued'];
        
         $out['batchdetails'] = $this->db->select('id,(production_quantity - '.$quantity_till_issued.') production_quantity,batchorlot')
                    ->from('stage_one_dhr_order_information')
                    ->where('batchorlot',$batchorlot)
                    ->where('stage','stage_3')
                    ->get(); 
            foreach($out['batchdetails']->result_array() as $dhr);
        
        $out['qircodedetails'] = $this->db->select('qcp_qir_number_or_report_number qir_number')
                    ->from('stage_one_dhr_quality_control_process')
                    ->where('dhr_id',$dhr['id'])
                     ->where('qcp_seq_number',17)
                    ->get();  
          $out['finished_goods_details'] = $this->db->select('transferred_quantity')
                    ->from('stage_one_dhr_finished_goods_transfer_note')
                    ->where('dhr_id',$dhr['id'])
                    ->get(); 
            foreach($out['batchdetails']->result_array() as $dhr);
            
        return $out;
    }
    
    function getEmployeesDetails(){
        return $this->db->select('*')->from('employees')->where('status',1)->get();
    }
    
    function delete_qc_scanned_file(){
        extract($this->input->post());
        unlink($file_path);
        if($from_where=='QC'){
            $table = 'stage_one_qcp_files';
        }elseif($from_where=='QA'){
            $table = 'stage_one_qap_files';
        }
        return $this->db->where('dhr_id',$dhr_id)->delete($table);
    }
    
    function get_stage_one_bom_details(){
        extract($this->input->post());
        $item_wise_bom  = $this->db->select('*')->from('item_wise_bom')->where('item_code',$item_code)->where('raw_material_or_ingredient',$bom_item_code)->get();
        foreach($item_wise_bom->result_array() as $item_wise_bomr);
        $output['bom_details']              = $item_wise_bomr;
        $item_code_wise_stage_one_lot_details    = $this->db->select('itemcode,group_concat(batchorlot) batchorlot')
                                                        ->from('stage_one_dhr_order_information')
                                                        ->where_in('itemcode',$bom_item_code)
                                                        ->where('stage','stage_1')
                                                        ->group_by('itemcode')
                                                        ->get();
        $lots = array();
        foreach($item_code_wise_stage_one_lot_details->result_array() as $itemwiselots){
            $lots=explode(',',$itemwiselots['batchorlot']);
        }                                              
        $output['stage_one_lot_details']   = $lots;   
        return $output;
    }
    
     function get_stage_two_bom_details(){
        extract($this->input->post());
        $item_wise_bom  = $this->db->select('*')->from('item_wise_bom')->where('item_code',$item_code)->where('raw_material_or_ingredient',$bom_item_code)->get();
        foreach($item_wise_bom->result_array() as $item_wise_bomr);
        $output['bom_details']              = $item_wise_bomr;
        $item_code_wise_stage_one_lot_details    = $this->db->select('itemcode,group_concat(batchorlot) batchorlot')
                                                        ->from('stage_one_dhr_order_information')
                                                        ->where_in('itemcode',str_replace('_HD','',$bom_item_code))
                                                        ->where('stage','stage_2')
                                                        ->group_by('itemcode')
                                                        ->get();
        $lots = array();
        foreach($item_code_wise_stage_one_lot_details->result_array() as $itemwiselots){
            $lots=explode(',',$itemwiselots['batchorlot']);
        }                                              
        $output['stage_one_lot_details']   = $lots;   
        return $output;
    }
    
    function get_stage_three_bom_details(){
        extract($this->input->post());
        $item_wise_bom  = $this->db->select('*')->from('item_wise_bom')->where('item_code',$item_code)->where('raw_material_or_ingredient',$bom_item_code)->get();
        foreach($item_wise_bom->result_array() as $item_wise_bomr);
        $output['bom_details']              = $item_wise_bomr;
        $item_code_wise_stage_one_lot_details    = $this->db->select('itemcode,group_concat(batchorlot) batchorlot')
                                                        ->from('stage_one_dhr_order_information')
                                                        ->where_in('itemcode',$bom_item_code)
                                                        ->where('stage','stage_3')
                                                        ->group_by('itemcode')
                                                        ->get();
                                                        
         $item_code_wise_stage_one_lot_details    = $this->db->select('itemcode,group_concat(batchorlot) batchorlot')
                                                        ->from('stage_one_dhr_order_information')
                                                        ->where_in('itemcode',$bom_item_code)
                                                        ->where('stage','stage_3')
                                                        ->group_by('itemcode')
                                                        ->get();
                                                        
         $item_code_wise_stage_four_lot_issued_details    = $this->db->select('item_number,sum(quantity_issued) quantity_issued')
                                                        ->from('stage_one_dhr_bill_of_material')
                                                        ->where_in('item_number',$bom_item_code)
                                                        ->where("`dhr_id` in(select `id` from `stage_one_dhr_order_information` where `stage`='stage_4')")
                                                        ->group_by('item_number')
                                                        ->get(); 
        $lotsissued = array();
        foreach($item_code_wise_stage_four_lot_issued_details->result_array() as $item_code_wise_stage_four_lot_issued_detailsr){
            $lotsissued[$item_code_wise_stage_four_lot_issued_detailsr['item_number']]=$item_code_wise_stage_four_lot_issued_detailsr['quantity_issued'];
        }                                                 
                                                        
        $lots = array();
        foreach($item_code_wise_stage_one_lot_details->result_array() as $itemwiselots){
            $lots=explode(',',$itemwiselots['batchorlot']);
        }                                              
        $output['stage_one_lot_details']   = $lots;   
        return $output;
    }
    
    function get_dhr_details(){
        extract($this->input->post());
        $dhr_id = $dhr_id??'';
        
        

                $this->db->select('
                            id,
                            sales_order sales_order_number,
                            production_order,
                            product_description item_name,
                            dhr as dhr_number,
                            order_quantity ordered_quantity,
                            batchorlot batch_number,
                            production_quantity production_quantity,
                            reformodel,
                            CASE 
                            WHEN manufacturing_date = "0000-00-00" OR manufacturing_date IS NULL THEN ""
                            ELSE DATE_FORMAT(manufacturing_date,"%d-%m-%Y") 
                            END AS manufactured_date ,
                            CASE 
                            WHEN date_of_commencement = "0000-00-00" OR date_of_commencement IS NULL THEN ""
                            ELSE DATE_FORMAT(date_of_commencement,"%d-%m-%Y") 
                            END AS date_of_batch_commencement ,
                            CASE 
                            WHEN expiry_date = "0000-00-00" OR expiry_date IS NULL THEN ""
                            ELSE DATE_FORMAT(expiry_date,"%d-%m-%Y") 
                            END AS expiry_date ,
                            CASE 
                            WHEN date_of_completion = "0000-00-00" OR date_of_completion IS NULL THEN ""
                            ELSE DATE_FORMAT(date_of_completion,"%d-%m-%Y") 
                            END AS date_of_completion ,
                            CASE 
                            WHEN dhr_issued_date_qa = "0000-00-00" OR dhr_issued_date_qa IS NULL THEN ""
                            ELSE DATE_FORMAT(dhr_issued_date_qa,"%d-%m-%Y") 
                            END AS dhr_issued_date_qa ,
                            itemcode item_code,
                            dhr_issued_by_qa,
                            dhr_received_by_production,
                            dhr_received_date_production,
                            removed,
                            stage
                            ');
        $this->db->from('stage_one_dhr_order_information');
        if($dhr_id!=''){
        $this->db->where('id',$dhr_id);
        }
        $this->db->order_by('dhr_number','asc');
        $output['stage_one_dhr_order_information'] = $this->db->get();
        


        $this->db->select("id,
                            dhr_id,
                            financial_year,
                            reference,
                            last_stage_three_product,
                            last_quantity_transfered,
                            item_number,
                            item_description,
                            uom,
                            extra_quantity_required_percentage,
                            actual_quantity_required,
                            quantity_required,
                            quantity_issued,
                            qir_number,
                            GROUP_CONCAT(
                                CASE 
                                    WHEN item_lot_number <> '' THEN item_lot_number 
                                    ELSE NULL 
                                END
                                SEPARATOR ', '
                                ) input_batch_number,
                            issued_by,
                            received_by,
                            date,
                            remarks")->from('stage_one_dhr_bill_of_material');
        if($dhr_id!=''){
        $this->db->where('dhr_id',$dhr_id);
        }
        $this->db->group_by('dhr_id');
        $bill_of_material = $this->db->get();
        
        $stage_one_dhr_bill_of_material=array();
        foreach($bill_of_material->result_array() as  $bom){
            $stage_one_dhr_bill_of_material[$bom['dhr_id']]=$bom;
        }
        $output['stage_one_dhr_bill_of_material'] = $stage_one_dhr_bill_of_material;
        
        // $this->db->select('*')->from('stage_one_dhr_pre_manufacturing_process');
        // if($dhr_id!=''){
        // $this->db->where('dhr_id',$dhr_id);
        // }
        // $output['stage_one_pre_manufacturing_process'] = $this->db->get();
        
        $this->db->select('
                            id,
                            dhr_id,
                            financial_year,
                            mp_seq_number,
                            mp_process_description,
                            mp_wi_number,
                            mp_equipment_number,
                            mp_start_datetime,
                            mp_end_datetime,
                            sum(mp_manufactured_qunatity) manufactured_quantity,
                            sum(mp_good_qunatity) good_quantity,
                            sum(mp_rejected_qunatity) rejected_quantity,
                            mp_done_by,
                            mp_verified_by,
                            mp_line_clearance_by,
                            mp_remarks
                            ');
        $this->db->from('stage_one_dhr_manufacturing_process');
        if($dhr_id!=''){
        $this->db->where('dhr_id',$dhr_id);
        }
        $this->db->where('mp_seq_number!=',2);
        $this->db->group_by('dhr_id');
        $manufacturing_process = $this->db->get();
        
        $stage_one_manufacturing_process=array();
        foreach($manufacturing_process->result_array() as  $mp){
            $stage_one_manufacturing_process[$mp['dhr_id']]=$mp;
        }
        $output['stage_one_manufacturing_process'] = $stage_one_manufacturing_process;
        
        // $this->db->select('*')->from('stage_one_dhr_post_manufacturing_process');
        // if($dhr_id!=''){
        // $this->db->where('dhr_id',$dhr_id);
        // }
        // $output['stage_one_post_manufacturing_process'] = $this->db->get();
        
        // $this->db->select('*')->from('stage_one_dhr_quality_control_process');
        // if($dhr_id!=''){
        // $this->db->where('dhr_id',$dhr_id);
        // }
        // $output['stage_one_quality_control_process'] = $this->db->get();
        
               
// transfered_quantity
// number_of_control_samples
// rejected_quantity
// yield_percentage
// rejected_percentage
        
        $this->db->select('
                            id,
                            dhr_id,
                            financial_year,
                            transferred_quantity,
                            transferred_by,
                            transferred_date,
                            accepted_by,
                            accepted_date,
                        ');
        $this->db->from('stage_one_dhr_finished_goods_transfer_note');
        if($dhr_id!=''){
        $this->db->where('dhr_id',$dhr_id);
        }
        $transfer_note = $this->db->get();
        
         $finished_goods_transfer_note=array();
        foreach($transfer_note->result_array() as  $fgtn){
            $finished_goods_transfer_note[$fgtn['dhr_id']]=$fgtn;
        }
        $output['finished_goods_transfer_note'] = $finished_goods_transfer_note;
        
        
        // $this->db->select('*')->from('stage_one_dhr_material_reconciliation');
        // if($dhr_id!=''){
        //     $this->db->where('dhr_id',$dhr_id);
        // } 
        // $output['stage_one_material_reconciliation'] =$this->db->get();
        
        $this->db->select('
                        id,
                        dhr_id,
                        financial_year,
                        total_quantity_produced_and_packed,
                        archive_samples_quantity ,
                        ep_archive_samples_quantity,
                        production_archive_samples_quantity,
                        penetration_samples_quantity,
                        control_samples_quantity number_of_control_samples,
                        rejected_quantity,
                        yield_percentage,
                        reject_percentage,
                        production_verified_by,
                        production_verified_date,
                        production_verified_by_remarks,
                        checked_by_quality_control,
                        checked_by_quality_control_date,
                        checked_by_quality_control_remark
                        ');
        $this->db->from('stage_one_dhr_finished_goods_reconciliation');
        if($dhr_id!=''){
        $this->db->where('dhr_id',$dhr_id);
        }
        $stage_one_finished_goods_reconcillation = $this->db->get();
        
         $finished_goods_reconcillation=array();
        foreach($stage_one_finished_goods_reconcillation->result_array() as  $fgrc){
            $finished_goods_reconcillation[$fgrc['dhr_id']]=$fgrc;
        }
        $output['stage_one_finished_goods_reconcillation'] = $finished_goods_reconcillation;
        
        // $this->db->select('*')->from('stage_one_dhr_qa_approval_and_release');
        // if($dhr_id!=''){
        // $this->db->where('dhr_id',$dhr_id);
        // }
        // $output['stage_one_qa_approval_and_release'] = $this->db->get();
        
       
        return $output;
    }
    
    function get_dhr_store_details(){
        extract($this->input->post());
        $dhr_id = $dhr_id??'';
        
        // $this->db->select('
        //                     id,
        //                     sales_order sales_order_number,
        //                     production_order,
        //                     product_description item_name,
        //                     dhr dhr_number,
        //                     order_quantity ordered_quantity,
        //                     batchorlot batch_number,
        //                     production_quantity production_quantity,
        //                     reformodel,
        //                     DATE_FORMAT(manufacturing_date,"%d-%m-%Y") manufactured_date,
        //                     DATE_FORMAT(date_of_commencement,"%d-%m-%Y") date_of_batch_commencement,
        //                     itemcode item_code,
        //                     DATE_FORMAT(expiry_date,"%d-%m-%Y") expiry_date,
        //                     DATE_FORMAT(date_of_completion,"%d-%m-%Y") date_of_completion,
        //                     dhr_issued_by_qa,
        //                     dhr_issued_date_qa,
        //                     dhr_received_by_production,
        //                     dhr_received_date_production,
        //                     removed,
        //                     stage
        //                     ');
        // $this->db->from('stage_one_dhr_order_information');
        // if($dhr_id!=''){
        // $this->db->where('id',$dhr_id);
        // }
        // $this->db->order_by('dhr_number','asc');
        // $output['stage_one_dhr_order_information'] = $this->db->get();
        
        $this->db->select('b.id,
                            b.dhr_id,
                            b.financial_year,
                            b.reference,
                            b.last_stage_three_product,
                            b.last_quantity_transfered,
                            b.item_number bom_item_code,
                            b.item_description bom_item_name,
                            b.uom,
                            b.extra_quantity_required_percentage,
                            b.actual_quantity_required,
                            b.quantity_required required_qty,
                            b.quantity_issued issued_qt,
                            b.qir_number qirm_number,
                            b.item_lot_number input_batch_number,
                            b.issued_by,
                            b.received_by,
                            b.date,
                            b.remarks,
                            
                            o.id,
                            o.sales_order sales_order_number,
                            o.production_order,
                            o.product_description product_description,
                            o.dhr dhr_number,
                            o.order_quantity ordered_quantity,
                            o.batchorlot batch_number,
                            o.production_quantity production_quantity,
                            o.reformodel,
                            DATE_FORMAT(o.manufacturing_date,"%d-%m-%Y") manufactured_date,
                            DATE_FORMAT(o.date_of_commencement,"%d-%m-%Y") date_of_batch_commencement,
                            o.itemcode item_code,
                            DATE_FORMAT(o.expiry_date,"%d-%m-%Y") expiry_date,
                            DATE_FORMAT(o.date_of_completion,"%d-%m-%Y") date_of_completion,
                            o.dhr_issued_by_qa,
                            o.dhr_issued_date_qa,
                            o.dhr_received_by_production,
                            o.dhr_received_date_production,
                            o.removed,
                            o.stage');
                            $this->db->from('stage_one_dhr_bill_of_material b');
                            $this->db->join('stage_one_dhr_order_information o','b.dhr_id=o.id','left');
        if($dhr_id!=''){
            $this->db->where('b.dhr_id',$dhr_id);
        }
        $bill_of_material = $this->db->get();
        
        
        $output['stage_one_dhr_order_information_bill_of_material'] = $bill_of_material;
        
        return $output;
    }
    
    function get_dhr_qc_details(){
        extract($this->input->post());
        $dhr_id = $dhr_id??'';
        
        
        
        $this->db->select('b.id,
                            b.dhr_id,
                            b.financial_year,
                            b.reference,
                            b.last_stage_three_product,
                            b.last_quantity_transfered,
                            b.item_number bom_item_code,
                            b.item_description bom_item_name,
                            b.uom,
                            b.extra_quantity_required_percentage,
                            b.actual_quantity_required,
                            b.quantity_required required_qty,
                            b.quantity_issued issued_qt,
                            b.qir_number qirm_number,
                            group_concat(distinct b.item_lot_number separator ", ") as input_batch_number,
                            b.issued_by,
                            b.received_by,
                            CASE 
                                WHEN  b.date = "0000-00-00" OR  b.date IS NULL 
                                THEN "NA" 
                                ELSE DATE_FORMAT( b.date, "%d-%m-%Y") 
                            END AS  date,
                            b.remarks,
                            
                            o.id,
                            o.sales_order sales_order_number,
                            o.production_order,
                            o.product_description product_description,
                            o.dhr dhr_number,
                            o.order_quantity ordered_quantity,
                            o.batchorlot batch_number,
                            o.production_quantity production_quantity,
                            o.reformodel,
                            CASE 
                                WHEN  o.manufacturing_date = "0000-00-00" OR  o.manufacturing_date IS NULL 
                                THEN "NA" 
                                ELSE DATE_FORMAT( o.manufacturing_date, "%d-%m-%Y") 
                            END AS  manufactured_date,
                            CASE 
                                WHEN  o.date_of_commencement = "0000-00-00" OR  o.date_of_commencement IS NULL 
                                THEN "NA" 
                                ELSE DATE_FORMAT( o.date_of_commencement, "%d-%m-%Y") 
                            END AS  date_of_batch_commencement,
                            o.itemcode item_code,
                            CASE 
                                WHEN  o.expiry_date = "0000-00-00" OR  o.expiry_date IS NULL 
                                THEN "NA" 
                                ELSE DATE_FORMAT( o.expiry_date, "%d-%m-%Y") 
                            END AS  expiry_date,
                            CASE 
                                WHEN  o.date_of_completion = "0000-00-00" OR  o.date_of_completion IS NULL 
                                THEN "NA" 
                                ELSE DATE_FORMAT( o.date_of_completion, "%d-%m-%Y") 
                            END AS  date_of_completion,
                            o.dhr_issued_by_qa,
                            CASE 
                                WHEN  o.dhr_issued_date_qa = "0000-00-00" OR  o.dhr_issued_date_qa IS NULL 
                                THEN "NA" 
                                ELSE DATE_FORMAT( o.dhr_issued_date_qa, "%d-%m-%Y") 
                            END AS  dhr_issued_date_qa,
                            o.dhr_received_by_production,
                            CASE 
                                WHEN  o.dhr_received_date_production = "0000-00-00" OR  o.dhr_received_date_production IS NULL 
                                THEN "NA" 
                                ELSE DATE_FORMAT( o.dhr_received_date_production, "%d-%m-%Y") 
                            END AS  dhr_received_date_production,
                            o.removed,
                            o.stage,
                            
                            group_concat(distinct emp_mp.employee_name  separator ", ") as mp_line_clearance_by,
                            group_concat(distinct emp_pmp.employee_name  separator ", ") as pmp_checked_by,
                            qcf.scanned_file,
                            fgtn.transferred_quantity,
                            sum(mr.mrec_quantity_received) as mrec_quantity_received,
                            (fgr.archive_samples_quantity+fgr.ep_archive_samples_quantity+fgr.production_archive_samples_quantity+fgr.penetration_samples_quantity+fgr.control_samples_quantity) as archive_samples,
                            fgr.total_quantity_produced_and_packed,
                            fgr.rejected_quantity,
                            fgr.yield_percentage,
                            fgr.reject_percentage,
                            group_concat(distinct emp_qcp.employee_name separator ", ") as qcp_verified_by');
        $this->db->from('stage_one_dhr_order_information o');
        $this->db->join('stage_one_dhr_bill_of_material b','b.dhr_id=o.id','left');
        $this->db->join('stage_one_dhr_manufacturing_process mp','mp.dhr_id=o.id','left');
        $this->db->join('employees emp_mp','find_in_set(emp_mp.id, mp.mp_line_clearance_by)','left');
        $this->db->join('stage_one_dhr_post_manufacturing_process pmp','pmp.dhr_id=o.id','left');
        $this->db->join('employees emp_pmp','find_in_set(emp_pmp.id, pmp.pmp_checked_by)','left');
        $this->db->join('stage_one_qcp_files qcf','qcf.dhr_id=o.id','left');
        $this->db->join('stage_one_dhr_finished_goods_transfer_note fgtn','fgtn.dhr_id=o.id','left');
        $this->db->join('stage_one_dhr_material_reconciliation mr','mr.dhr_id=o.id','left');
        $this->db->join('stage_one_dhr_finished_goods_reconciliation fgr','fgr.dhr_id=o.id','left');
        $this->db->join('stage_one_dhr_quality_control_process qcp','qcp.dhr_id=o.id','left');
        $this->db->join('employees emp_qcp','find_in_set(emp_qcp.id, qcp.qcp_verified_by)','left');
        if($dhr_id!=''){
            $this->db->where('o.id',$dhr_id);
        }
        $this->db->group_by('o.id');
        $bill_of_material = $this->db->get();
        
        $output['stage_one_dhr_order_information_bill_of_material'] = $bill_of_material;
        
        
        
        return $output;
    }
    
     function get_dhr_qa_details(){
        extract($this->input->post());
        $dhr_id = $dhr_id??'';
        
        $this->db->select("
                            o.id,
                            o.sales_order sales_order_number,
                            o.production_order,
                            o.product_description product_description,
                            o.dhr dhr_number,
                            o.order_quantity ordered_quantity,
                            o.batchorlot batch_number,
                            o.production_quantity production_quantity,
                            o.reformodel,
                            CASE 
                                WHEN o.manufacturing_date = '0000-00-00' OR o.manufacturing_date IS NULL 
                                THEN 'NA' 
                                ELSE DATE_FORMAT(o.manufacturing_date, '%d-%m-%Y') 
                            END AS manufactured_date,
                            CASE 
                                WHEN o.date_of_commencement = '0000-00-00' OR o.date_of_commencement IS NULL 
                                THEN 'NA' 
                                ELSE DATE_FORMAT(o.date_of_commencement, '%d-%m-%Y') 
                            END AS date_of_batch_commencement,
                            CASE 
                                WHEN o.expiry_date = '0000-00-00' OR o.expiry_date IS NULL 
                                THEN 'NA' 
                                ELSE DATE_FORMAT(o.expiry_date, '%d-%m-%Y') 
                            END AS expiry_date,
                            CASE 
                                WHEN o.date_of_completion = '0000-00-00' OR o.date_of_completion IS NULL 
                                THEN 'NA' 
                                ELSE DATE_FORMAT(o.date_of_completion, '%d-%m-%Y') 
                            END AS date_of_completion,
                            
                            o.itemcode item_code,
                            o.dhr_issued_by_qa,
                            CASE 
                                WHEN o.dhr_issued_date_qa = '0000-00-00' OR o.dhr_issued_date_qa IS NULL 
                                THEN 'NA' 
                                ELSE DATE_FORMAT(o.dhr_issued_date_qa, '%d-%m-%Y') 
                            END AS dhr_issued_date_qa,
                            o.dhr_received_by_production,
                            CASE 
                                WHEN o.dhr_received_date_production = '0000-00-00' OR o.dhr_received_date_production IS NULL 
                                THEN 'NA' 
                                ELSE DATE_FORMAT(o.dhr_received_date_production, '%d-%m-%Y') 
                            END AS dhr_received_date_production,
                            CASE 
                                WHEN o.dhr_issued_date_qa = '0000-00-00' OR o.dhr_issued_date_qa IS NULL 
                                THEN 'NA' 
                                ELSE DATE_FORMAT(o.dhr_issued_date_qa, '%d-%m-%Y') 
                            END AS dhr_issued_date_qa,
                            
                            o.removed,
                            o.stage,
            
            
                GROUP_CONCAT(DISTINCT b.item_lot_number SEPARATOR ', ') as input_batch_number,
            
            
            GROUP_CONCAT(
                DISTINCT CONCAT(
                    m.mp_seq_number, ' - ',
                    m.mp_process_description, ' (',
                    m.mp_wi_number, ', ',
                    m.mp_equipment_number, ', ',
                    m.mp_start_datetime, ', ',
                    m.mp_end_datetime, ', ',
                    m.mp_manufactured_qunatity, ', ',
                    m.mp_good_qunatity, ', ',
                    m.mp_rejected_qunatity, ', ',
                    m.mp_done_by, ', ',
                    m.mp_verified_by, ', ',
                    m.mp_line_clearance_by, ', ',
                    m.mp_remarks, ')'
                ) SEPARATOR ' | '
            ) AS manufacturing_processes,
        
           
            GROUP_CONCAT(
                DISTINCT CONCAT(
                    q.qcp_seq_number, ' - ',
                    q.qcp_process_inspection_or_testing_description, ' (',
                    q.qcp_wi_number, ', ',
                    q.qcp_qir_number_or_report_number, ', ',
                    q.qcp_sample_quantity, ', ',
                    q.qcp_pass_or_fail, ', ',
                    q.qcp_verified_by, ', ',
                    q.qcp_verified_date, ', ',
                    q.qcp_scanned_file, ')'
                ) SEPARATOR ' | '
            ) AS quality_control_processes,
            
           
                fgtn.transferred_quantity,
                
           
                (fgr.archive_samples_quantity+fgr.ep_archive_samples_quantity+fgr.production_archive_samples_quantity+fgr.penetration_samples_quantity+fgr.control_samples_quantity) AS archive_samples_quantity,
                fgr.yield_percentage,
                fgr.reject_percentage,
                fgr.production_verified_by AS production_head_verified,
                fgr.checked_by_quality_control AS qc_head_clearance,
                
           
                qaar.quantity_released_for_dispatch,
                CASE 
                    WHEN  qaar.date_of_release = '0000-00-00' OR  qaar.date_of_release IS NULL 
                    THEN 'NA' 
                    ELSE DATE_FORMAT( qaar.date_of_release, '%d-%m-%Y') 
                END AS  date_of_release,
                qaar.signature
        ", false);
        
        $this->db->from('stage_one_dhr_order_information o');
        $this->db->join('stage_one_dhr_manufacturing_process m', 'o.id = m.dhr_id', 'left');
        $this->db->join('stage_one_dhr_quality_control_process q', 'o.id = q.dhr_id', 'left');
        $this->db->join('stage_one_dhr_bill_of_material b', 'o.id = b.dhr_id', 'left');
        $this->db->join('stage_one_dhr_finished_goods_reconciliation fgr', 'o.id = fgr.dhr_id', 'left');
        $this->db->join('stage_one_dhr_finished_goods_transfer_note fgtn', 'o.id = fgtn.dhr_id', 'left');
        $this->db->join('stage_one_dhr_qa_approval_and_release qaar', 'o.id = qaar.dhr_id', 'left');
        
        $this->db->group_by('o.id');
        $this->db->order_by('o.dhr', 'DESC');
        
        $bill_of_material = $this->db->get();

        $output['stage_one_dhr_order_information_mp_qc'] = $bill_of_material;
        
         $employees=$this->db
                            ->select('e.*,p.pos_name designation')
                            ->from('employees e')
                            ->join('positions p','p.pos_id=e.pos_id')
                            ->get();  
        foreach($employees->result_array() as $employee){
            $employs[$employee['id']] = $employee['employee_name'];
        }             
        
        $output['employees'] = $employs;
        
        return $output;
    }
    
    function order_form_dhr_check(){
        extract($this->input->post());
        
        $this->db->select('id');
        $this->db->from('stage_one_dhr_order_information');
        $this->db->where('dhr',$dhr);
        $dhr_order_check = $this->db->get();
        
        if($dhr_order_check->num_rows()>0){
            return 1;
        }else{
            return 0;
        }
    }
    
    function get_bom_details(){
        $item_wise_bom = $this->db->list_fields('item_wise_bom');
      
        return $item_wise_bom;
    }
    
    function check_bom_item($item_code,$raw_material_or_ingredient){
        $this->db->select('id');
        $this->db->from('item_wise_bom');
        $this->db->where('item_code',$item_code);
        $this->db->where('raw_material_or_ingredient',$raw_material_or_ingredient);
        $item_wise_bom = $this->db->get();
        
        if($item_wise_bom->num_rows()>0){
            return 1;
        }else{
            return 0;
        }
    }
    
    function UploadBomDetails(){
        extract($this->input->post());
        $not_entered_bom = array();
        echo $number_columns = count($this->get_bom_details())-1;
        $file = fopen($_FILES['bom_file']['tmp_name'],"r");
        $rows = 1;
        while(($fileop = fgetcsv($file,1000,","))!==FALSE){
            if($rows==1){
                $columns = array();
                for($i=0;$i<$number_columns;$i++){
                $columns[$i] = $fileop[$i];
                }
            }
            if($rows>1){
                $data = array();
                for($i=0;$i<$number_columns;$i++){
                    $data[$columns[$i]] = $fileop[$i];
                }
                $bom = $this->check_bom_item($data['item_code'],$data['raw_material_or_ingredient']);
                if(!$bom){
                    $this->db->insert('item_wise_bom',$data);
                }else{
                    $not_entered_bom[] = $data;
                }
            }
            $rows++;
        }
        
        return $not_entered_bom;
    }
    
    function GetCOADetails($coa_id){
        $output = array();
        
        $output['stage_one_dhr_order_information'] = $this->db->select('dhr dhr_number')->from('stage_one_dhr_order_information')->where('stage','stage_4')->get();
        
        $output['coa_details'] = $this->db->select('*')->from('coa_details')->where('id',$coa_id)->get();
        
        $output['coa_parameter'] = $this->db->select('*')->from('coa_parameter')->where('coa_id',$coa_id)->get();
        
        $output['coa_default_parameters']= $this->db->select('*')->from('coa_default_parameters')->get();
        
        $output['coa_footer_note']= $this->db->select('*')->from('coa_footer_note')->where('coa_id',$coa_id)->get();
        
        $output['employees'] = $this->db->select('*')
                                        ->from('employees e')
                                        ->join('positions s','s.pos_id=e.pos_id','left')
                                        ->join('departments d','d.dept_id=e.dept_id','left')
                                        ->where('e.status',0)
                                        ->get();
          
        $output['departments'] = $orderno = $this->db->select('*')
                                                            ->from('departments')
                                                           ->get();                                                    
           
        return $output;
    }
    
    function coa_form(){
        
        /////////////////////////////////coa form/////////////////////////////////////////
        extract($this->input->post());
        
        $data = array(
            	'product_description'=>$product_description,
            	'product_code'=>$product_code,
            	'brand'=>$brand,
            	'lot_or_batch_no'=>$lot_or_batch_no,
            	'released_quantity'=>$released_quantity,
            	'reference_dhr_no'=>$reference_dhr_no,
            	'remarks'=>$remarks,
            	'prepared_by'=>$prepared_by,
            	'prepared_by_date'=>$prepared_by_date,
            	'approved_by'=>$approved_by,
            	'approved_by_date'=>$approved_by_date,
        );
        
        $check =  $this->db->select('id')->from('coa_details')->where('id',$coa_id)->get();
        
        if($check->num_rows()>0){
            foreach($check->result_array() as $checkr);
            
            $coa_id  = $coa_id;
            $this->db->where('id',$coa_id)->set($data)->update('coa_details');
        }else{
            $this->db->insert('coa_details',$data);
            $coa_id = $this->db->insert_id();
        }
        
         $this->db->where('coa_id',$coa_id)->delete('coa_parameter');
         
         for($i=0;$i<count($parameter);$i++){
             $parameterdata=array(
                 'coa_id'=>$coa_id,
                  'parameter'=>$parameter[$i],
                 'sl_number'=>$sl_number[$i],
                 'requirement'=>$requirement[$i],
                 'result_or_observation'=>$result_or_observation[$i],
                 'complied_or_not_complied'=>$complied_or_not_complied[$i]
             );
             $this->db->insert('coa_parameter',$parameterdata);
         }
        
        /////////////////////////////////coa footer note/////////////////////////////////////////
        
        
        $data = array(
            'coa_id'            =>$coa_id,
            'financial_year'    =>$this->session->userdata('financial_year'),
            'format_no'         =>$format_no,
            'rev_no'            =>$rev_no,
            'effective_date'    =>$effective_date,
        );
        
        $check =  $this->db->select('id')->from('coa_footer_note')->where('coa_id',$coa_id)->get();
        
        if($check->num_rows()>0){
             $this->db->where('coa_id',$coa_id)->set($data)->update('coa_footer_note');
        }else{
             $this->db->insert('coa_footer_note',$data);
        }
         
        return array('coa_id'=>$coa_id);
    }
    
     function RemoveCOA() {
        extract($this->input->post());
        if(is_array($coa_id)){
            $this->db->where_in('id' , $coa_id);
        }else{
            $this->db->where('id' , $coa_id);
        }
        
          $result = $this->db->set('removed',($status==1?0:1))->update('coa_details');
          
          print_r($this->db->last_query());
    }
    
    function DeleteCOA() {
        extract($this->input->post());
        if(is_array($coa_id)){
            $this->db->where_in('id' , $coa_id);
        }else{
            $this->db->where('id' , $coa_id);
        }
          return $result = $this->db->delete('coa_details');
    }
    
    function fetchcoadefaultdetails(){
        extract($this->input->post());
        $coa_default_parameters = $this->db->select('*')->from('coa_default_parameters')->where('serial_number',$serial_number)->get();
        return($coa_default_parameters);
    }
    
    function fetchdhrdetails(){
        extract($this->input->post());
        $stage_one_dhr_order_information_and_qa_release = $this->db->select('
                                                                            o.product_description as product_description,
                                                                            o.batchorlot as lot_or_batch_no,
                                                                            o.itemcode as product_code,
                                                                            o.reformodel as brand,
                                                                            q.quantity_released_for_dispatch as released_quantity
                                                                ')
                                                            ->from('stage_one_dhr_order_information o')
                                                            ->join('stage_one_dhr_qa_approval_and_release q','q.dhr_id=o.id','left')
                                                            ->where('o.dhr',$dhr_number)
                                                            ->get();
       
        return($stage_one_dhr_order_information_and_qa_release);
    }
    
    function get_dhr_coa_details(){
        extract($this->input->post());
        $data['coa_details'] = $this->db->select("*,
        
        CASE 
            WHEN  prepared_by_date = '0000-00-00' OR prepared_by_date IS NULL 
            THEN 'NA' 
            ELSE DATE_FORMAT( prepared_by_date, '%d-%m-%Y') 
        END AS  prepared_by_date,
        CASE 
            WHEN  approved_by_date = '0000-00-00' OR approved_by_date IS NULL 
            THEN 'NA' 
            ELSE DATE_FORMAT( approved_by_date, '%d-%m-%Y') 
        END AS  approved_by_date,
        ")
                            ->from('coa_details')
                            ->get();
        $employees=$this->db
                            ->select('e.*,p.pos_name designation')
                            ->from('employees e')
                            ->join('positions p','p.pos_id=e.pos_id')
                            ->get();  
        foreach($employees->result_array() as $employee){
            $employs[$employee['id']] = $employee['employee_name'];
        }             
        
        $data['employees'] = $employs;
        return($data);
    }
    
} ?>