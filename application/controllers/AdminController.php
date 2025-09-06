<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminController extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('AdminM');
    }
    
    public function index(){
                $this->load->view('templates/Header');
		$this->load->view('Admin/AdminHome');
                $this->load->view('templates/Footer');
	}
	
    function Verify(){
        $this->AdminM->Verify();
    }
    
    function Logout(){
        $this->AdminM->Logout();
    }
   
    function CustomerBalanceReciev(){
         $this->AdminM->CustomerBalanceReciev();
    }
   
    public function LoadSchoolForm(){
        $data['schoolinfo']=$this->AdminM->LoadCompanyForm();
        $this->load->view('Admin/CompanyForm',$data);
     }
     
    function LoadDepartmentForm(){
        extract($this->input->post());
        $data['department_details'] = $this->AdminM->get_department_details($dept_id);
        $this->load->view('Admin/DepartmentForm',$data);
    }
    
    function SaveUpdateDepartment(){
        $this->AdminM->SaveUpdateDepartment();
    }
     
     function getPositionsList(){
         extract($this->input->post());
         echo $pos_id;
         $data=$this->AdminM->getPositionsList();
         $p = array();
         $p[] = '<option value="">Select Position</option>';
         foreach($data->result_array() as $datar){
             $p[] = '<option value="'.$datar['pos_id'].'" '.($datar['pos_id']==$pos_id?'selected':'').'>'.$datar['pos_name'].'</option>';
         }
         echo implode('',$p);
     }
     
     public function LoadEmployeeForm(){
        $data['employeeinfo']=$this->AdminM->LoadEmployeeForm();
        $data['companyslist']=$this->AdminM->CompanyList();
        $data['departmentslist']=$this->AdminM->DepartmentsList();
        $data['company_id']=$this->input->post('company_id');
        $this->load->view('Admin/EmployeeForm',$data);
     }
     
     function LoadPrivilageForm(){
        $data['employee_id'] = $this->input->post('employee_id');
        $data['employees'] = $this->AdminM->GetEmployees();
        $this->load->view('Admin/PrivilageForm',$data);
     }
     
     function GetStagePrivilage(){
         $data['stagePrivilage'] = $this->AdminM->GetStagePrivilage();
         $this->load->view('Admin/StagePrivilageForm',$data);
     }
     
     function SaveUpdatePrivilage(){
         $this->AdminM->SaveUpdatePrivilage();
     }
     
     
     public function LoadDepartmentList(){
        $data['departmentslist']=$this->AdminM->DepartmentsList();
        $data['company_id']=$this->input->post('company_id');
        $this->load->view('Admin/DepartmentList',$data);
     }
     
      public function LoadSharecollectionForm(){
        $data['school_id']=$this->input->post('school_id');
        $data['teacher_id']=$this->input->post('teacher_id');
        $data['selected']=$this->input->post('selected');
        $data['total_share']=$this->AdminM->GetShareAmount();
        $this->load->view('Admin/ShareCollectionForm',$data);
     }
     
    public function AddUpLoanById(){
        $this->AdminM->AddUpLoanById();
    }
     
    public function AddUpSavingsById(){
        $this->AdminM->AddUpSavingsById();
    }
     
    public function ReturnTeacherSavingsById(){
        $this->AdminM->ReturnTeacherSavingsById();
    }
    
    public function ReturnTeacherLoanById(){
         $this->AdminM->ReturnTeacherLoanById();
    }
     
     
     public function LoadLoancollectionForm(){
        $data['school_id']=$this->input->post('school_id');
        $data['teacher_id']=$this->input->post('teacher_id');
        $data['selected']=$this->input->post('selected');
        $data['loaninfo']=$this->AdminM->LoanDetails();
        $this->load->view('Admin/LoanCollectionForm',$data);
     }

      public function LoadTeacherLoanIssueForm(){
        $data['loandetails']=$this->AdminM->LoadTeacherLoanIssueFormDetails();
        $data['teacher_id']=$this->input->post('teacher_id');
        $data['school_id']=$this->input->post('school_id');
        $this->load->view('Admin/LoanIssueForm',$data);
     }
     
     public function GetTeachersLoanIssueData(){
         $data = $this->AdminM->LoadTeacherLoanIssueFormDetails();
         foreach($data->result_array() as $result);
         echo json_encode($result);
     }

     public function AddUpTeachersLoanIssue(){
        $this->AdminM->AddUpTeachersLoanIssue();
     }
     
     
     public function AddSchools(){
            $this->load->view('templates/Header');
	        $this->load->view('Admin/AddSchools');
            $this->load->view('templates/Footer');
    }
    
     public function AddTeachers($company_id){
            $data['schoolslist']=$this->AdminM->CompanyList();
            $data['emploeeslist']=$this->AdminM->exportemployeeslist();
            $data['company_id'] = $company_id;
            $this->load->view('templates/Header');
	        $this->load->view('Admin/AddEmployees',$data);
            $this->load->view('templates/Footer');
    }
    
    public function AddToEmployeeList(){
        $this->AdminM->AddToEmployeeList();
    }
    
    public function DeleteTeacher(){
            $this->AdminM->DeleteTeacher();
    }
    
    public function RemoveTeacher(){
            $this->AdminM->RemoveTeacher();
    }

    public function DeleteSchool(){
            $this->AdminM->DeleteSchool();
    }

    public function AddUpCompanys(){
            $this->AdminM->AddUpCompanys();
    }
    public function AddUpEmployees(){
            $this->AdminM->AddUpEmployees();
    }
    public function AddUpSavings(){
            $this->AdminM->AddUpSavings();
    }

    public function AddUpLoan(){
            $this->AdminM->AddUpLoan();
    }

    public function AddExpense(){
            $this->load->view('templates/Header');
             $this->load->view('Admin/AddExpense');
             $this->load->view('templates/Footer');
    }

    public function LoadExpenseForm(){
        $data['expenseinfo']=$this->AdminM->LoadExpenseFormDetails();
        $data['expense_id']=$this->input->post('expense_id');
        $this->load->view('Admin/ExpenseForm',$data);
    }

    public function AddUpExpense(){
            $this->AdminM->AddUpExpense();
    }

    public function DeleteExpense(){
            $this->AdminM->DeleteExpense();
    }
    

    public function AddUpTeachersShareLoan(){
            $this->AdminM->AddUpTeachersShareLoan();
    }
    
    public function ShareLedger(){
        $data['schoolslist']=$this->AdminM->SchoolList();
            $this->load->view('templates/Header');
            $this->load->view('Admin/ShareLedger',$data);
            $this->load->view('templates/Footer');
    }

    public function GetTeachers(){
            $this->AdminM->GetTeachers();
    }

    public function GetTeachersLedgerReport(){
        $data['ledgerdetails'] = $this->AdminM->GetTeachersLedgerReport();
        $this->load->view('Admin/ShareLedgerReport',$data);
    }

    public function GetSchoolLedgerReport(){
        $data['ledgerdetails'] = $this->AdminM->GetSchoolLedgerReport();
        $this->load->view('Admin/SchoolLedgerReport',$data);
    }

    public function CashBook(){
        $data['banks'] = $this->AdminM->GetCashBookBanks();
        $this->load->view('templates/Header');
        $this->load->view('Admin/CashBook',$data);
        $this->load->view('templates/Footer');
    }

    public function CashBookReport(){
        $data['cashbookdetails'] = $this->AdminM->CashBookReport();
        $this->load->view('Admin/CashBookReport',$data);
    }

    public function ReturnTeacherSavingsForm(){
        $data['total_share']=$this->AdminM->ReturnTeacherSavingsFormDetails();
        $data['teacher_id']=$this->input->post('teacher_id');
        $data['school_id']=$this->input->post('school_id');
        $this->load->view('Admin/ReturnTeacherSavingsForm',$data);
    }
    
    public function ReturnTeacherLoanForm(){
        $data['total_share']=$this->AdminM->ReturnTeacherLoanFormDetails();
        $data['teacher_id']=$this->input->post('teacher_id');
        $data['school_id']=$this->input->post('school_id');
        $this->load->view('Admin/ReturnTeacherLoanForm',$data);
    }

    public function ReturnTeacherSavings(){
        $this->AdminM->ReturnTeacherSavings();
    }
    
    public function ReturnTeacherLoan(){
        $this->AdminM->ReturnTeacherLoan();
    }

    public function otherfees(){
        $data['otherdetails']=$this->AdminM->otherfees();
        $data['teacher_id']=$this->input->post('teacher_id');
        $data['school_id']=$this->input->post('school_id');
        $data['other_id']=$this->input->post('other_id');
        $this->load->view('Admin/OtherfeesForm',$data);
    }

    public function AddUpOtherFees(){
        $this->AdminM->AddUpOtherFees();
    }

    public function ShareLoanPDF(){
        $data['schoolslist']=$this->AdminM->SchoolList();
        $this->load->view('templates/Header');
        $this->load->view('Admin/ShareLoanPDF',$data);
        $this->load->view('templates/Footer');
    }

    public function LoanSharePdf(){
        $data['teachersshareloanlist']=$this->AdminM->TeachersList();
        $this->load->view('Admin/ShareLoanPDFList',$data);
    }
    
    public function LoanInterestChart(){
        $data['schoolslist']=$this->AdminM->SchoolList();
        $this->load->view('templates/Header');
        $this->load->view('Admin/LoanInterestChart',$data);
        $this->load->view('templates/Footer');
    }
    
    public function GetTeachersLoanChart(){
        $data['loanchart']=$this->AdminM->GetTeachersLoanChart();
        $this->load->view('Admin/LoanChart',$data);
    }
    
    public function GivenDateCollected(){
        $data['schoolslist']=$this->AdminM->SchoolList();
        $this->load->view('templates/Header');
        $this->load->view('Admin/GivenDateCollected',$data);
        $this->load->view('templates/Footer');
    }
    
    public function GivenDateCollectedShareLoan(){
        $data['shareloan']=$this->AdminM->GivenDateCollectedShareLoan();
        $data['givendate']=$this->input->post('givendate');
        $this->load->view('Admin/GivenDateCollectedShareLoan',$data);
    }
    
    public function GetDataBetweenShareLoanCollected(){
        $data['teachersshareloanlist']=$this->AdminM->GetDataBetweenShareLoanCollected();
        $data['from']=$this->input->post('from');
        $data['to']=$this->input->post('to');
        $this->load->view('Admin/GetDataBetweenShareLoanCollected',$data);
    }
    
    function GetLoanAmountDetails(){
        $out = $this->AdminM->GetLoanAmountDetails();
        
        echo json_encode($out);
    }
    
    //////////////////////////////////////////////////////shah company//////////////////////////////////////////////////////////////
    
     function StageOneOrdersList(){
        $this->load->view('templates/Header');
        $this->load->view('Admin/StageOneOrderList');
        $this->load->view('templates/Footer');
    }
    
    function RemoveDHR(){
        $this->AdminM->RemoveDHR();
    }
    
    public function DeleteDHR(){
        $this->AdminM->DeleteDHR();
    }
    
    function RemoveCOA(){
        $this->AdminM->RemoveCOA();
    }
    
    public function DeleteCOA(){
        $this->AdminM->DeleteCOA();
    }
    
    function LoadStageOneForm(){
        extract($this->input->post());
        $this->load->view('Admin/stage_one',$this->AdminM->GetStageOneDetails($dhr_id));
    }
    
    function stage_one_order_form(){
        $output = $this->AdminM->stage_one_order_form();
        echo json_encode($output);
    }
    
    function stage_one_bill_of_material_form(){
        $this->AdminM->stage_one_bill_of_material_form();
    }
    
    function stage_one_pre_manufacturing_process_form(){
        $this->AdminM->stage_one_pre_manufacturing_process_form();
    }
    
    function stage_one_manufacturing_process_form(){
       $this->AdminM->stage_one_manufacturing_process_form();
    }
    
    function stage_one_post_manufacturing_process_form(){
       $this->AdminM->stage_one_post_manufacturing_process_form();
    }
    
    function stage_one_quality_control_process_form(){
        $this->AdminM->stage_one_quality_control_process_form();
    }
    
    function stage_one_finished_goods_transferred_note_form(){
         $this->AdminM->stage_one_finished_goods_transferred_note_form();
    }
    
    function stage_one_material_reconciliation_form(){
         $this->AdminM->stage_one_material_reconciliation_form();
    }
    
    function stage_one_finished_goods_reconciliation_form(){
        $this->AdminM->stage_one_finished_goods_reconciliation_form();
    }
    
    function stage_one_qa_approval_and_release_form(){
        $this->AdminM->stage_one_qa_approval_and_release_form();
    }
    
    //stage 2
    
     function StageTwoOrdersList(){
        $this->load->view('templates/Header');
        $this->load->view('Admin/StageTwoOrderList');
        $this->load->view('templates/Footer');
    }
    
    // function RemoveDHR(){
    //     $this->AdminM->RemoveDHR();
    // }
    
    // public function DeleteDHR(){
    //     $this->AdminM->DeleteDHR();
    // }
    
    function LoadStageTwoForm(){
        extract($this->input->post());
        $this->load->view('Admin/stage_two',$this->AdminM->GetStageTwoDetails($dhr_id));
    }
    
    function stage_two_order_form(){
        $output = $this->AdminM->stage_two_order_form();
        echo json_encode($output);
    }
    
    function get_stageone_lot_transfered_qnatity(){
        $output = $finaloutput = array();
        
        $output = $this->AdminM->get_stageone_lot_transfered_qnatity();
        
        foreach($output['batchdetails']->result_array() as $outputr);
        foreach($output['finished_goods_details']->result_array() as $fgtn);
        foreach($output['qircodedetails']->result_array() as $qiroutputr);
        
        
        $finaloutput = array_merge($outputr,$qiroutputr,$fgtn);
        echo json_encode($finaloutput);
    }
    
     //stage 3
    
     function StageThreeOrdersList(){
        $this->load->view('templates/Header');
        $this->load->view('Admin/StageThreeOrderList');
        $this->load->view('templates/Footer');
    }
    
    function LoadStageThreeForm(){
        extract($this->input->post());
        $this->load->view('Admin/stage_three',$this->AdminM->GetStageThreeDetails($dhr_id));
    }
    
     function get_stagetwo_lot_transfered_qnatity(){
        $output = $finaloutput = $outputr = $qiroutputr = array();
        
        $output = $this->AdminM->get_stagetwo_lot_transfered_qnatity();
        
        foreach($output['batchdetails']->result_array() as $outputr);
        foreach($output['qircodedetails']->result_array() as $qiroutputr);
        foreach($output['finished_goods_details']->result_array() as $ftgn);
        
        $finaloutput = array_merge($outputr,$qiroutputr,$ftgn);
        echo json_encode($finaloutput);
    }
    
    //stage 4
    
    function StageFourOrdersList(){
        $this->load->view('templates/Header');
        $this->load->view('Admin/StageFourOrderList');
        $this->load->view('templates/Footer');
    }
    
    function LoadStageFourForm(){
        extract($this->input->post());
        $this->load->view('Admin/stage_four',$this->AdminM->GetStageFourDetails($dhr_id));
    }
    
     function get_stagethree_lot_transfered_qnatity(){
        $output = $finaloutput = $outputr = $qiroutputr = array();
        
        $output = $this->AdminM->get_stagethree_lot_transfered_qnatity();
        
        foreach($output['batchdetails']->result_array() as $outputr);
        foreach($output['qircodedetails']->result_array() as $qiroutputr);
         foreach($output['finished_goods_details']->result_array() as $ftgn);
        
        $finaloutput = array_merge($outputr,$qiroutputr,$ftgn);
        echo json_encode($finaloutput);
    }
    
    // function stage_two_bill_of_material_form(){
    //     $this->AdminM->stage_two_bill_of_material_form();
    // }
    
    // function stage_two_pre_manufacturing_process_form(){
    //     $this->AdminM->stage_two_pre_manufacturing_process_form();
    // }
    
    // function stage_two_manufacturing_process_form(){
    //   $this->AdminM->stage_two_manufacturing_process_form();
    // }
    
    // function stage_two_post_manufacturing_process_form(){
    //   $this->AdminM->stage_two_post_manufacturing_process_form();
    // }
    
    // function stage_two_quality_control_process_form(){
    //     $this->AdminM->stage_two_quality_control_process_form();
    // }
    
    // function stage_two_finished_goods_transferred_note_form(){
    //      $this->AdminM->stage_two_finished_goods_transferred_note_form();
    // }
    
    // function stage_two_material_reconciliation_form(){
    //      $this->AdminM->stage_two_material_reconciliation_form();
    // }
    
    // function stage_two_finished_goods_reconciliation_form(){
    //     $this->AdminM->stage_two_finished_goods_reconciliation_form();
    // }
    
    // function stage_two_qa_approval_and_release_form(){
    //     $this->AdminM->stage_two_qa_approval_and_release_form();
    // }
    
    //
    
    function ItemMasterStockList(){
        $this->load->view('templates/Header');
        $this->load->view('Admin/ItemMasterStockList');
        $this->load->view('templates/Footer');
    }
    
    function SaveUpdateItemMaserStock(){
        $this->AdminM->SaveUpdateItemMaserStock();
    }
    
    function stage_two(){
        $this->load->view('templates/Header');
        $this->load->view('Admin/stage_two',$this->AdminM->GetStageTwoDetails());
        $this->load->view('templates/Footer');
    }
    
    function stage_three(){
        $this->load->view('templates/Header');
        $this->load->view('Admin/stage_three',$this->AdminM->GetStageThreeDetails());
        $this->load->view('templates/Footer');
    }
    
    function stage_four(){
        $this->load->view('templates/Header');
        $this->load->view('Admin/stage_four',$this->AdminM->GetStageFourDetails());
        $this->load->view('templates/Footer');
    }
    
    function get_item_description(){
        $output = array();
        $data = $this->AdminM->get_item_description();
        foreach($data->result_array() as $item_details);
        $output['item_details'] = $item_details;
        $output['bom_details']  = $data->result_array();
        echo json_encode($output);
    }
    
    function stage_two_get_item_description(){
        $output = array();
        $data = $this->AdminM->stage_two_get_item_description();
        foreach($data['bom_details']->result_array() as $item_details);
        $output['item_details'] = $item_details;
        $output['bom_details']  = $data['bom_details']->result_array();
        $output['stage_one_lot_details']  = $data['stage_one_lot_details'];
        echo json_encode($output);
    }
    
    function stage_three_get_item_description(){
        $output = array();
        $data = $this->AdminM->stage_three_get_item_description();
        foreach($data['bom_details']->result_array() as $item_details);
        $output['item_details'] = $item_details;
        $output['bom_details']  = $data['bom_details']->result_array();
        $output['stage_two_lot_details']  = $data['stage_two_lot_details'];
        // echo '<pre>';
        // print_r($output['stage_two_lot_details']);
        echo json_encode($output);
    }
    
    function stage_four_get_item_description(){
        $output = array();
        $data = $this->AdminM->stage_four_get_item_description();
        foreach($data['bom_details']->result_array() as $item_details);
        $output['item_details'] = $item_details;
        $output['bom_details']  = $data['bom_details']->result_array();
        $output['stage_two_lot_details']  = $data['stage_two_lot_details'];
        // echo '<pre>';
        // print_r($output['stage_two_lot_details']);
        echo json_encode($output);
    }
    
    function get_bom_item_code_description(){
        $output = $item_details = $out = array();
        $data = $this->AdminM->get_bom_item_code_description();
        foreach($data->result_array() as $item_details){
            $out[$item_details['raw_material_or_ingredient']] = $item_details;
        }
        $output['bom_details']  = $out;
        
        echo json_encode($output);
    }
    
    function get_premp_process_description(){
        extract($this->input->post());
        $data = $this->AdminM->get_premp_process_description();
        $euipments=array();
        foreach($data['steps_equipments']->result_array() as $datastepeuipment){
            $euipments[]=$datastepeuipment['euipment_number'];
        }

        foreach($data['manufacturing_process_steps']->result_array() as $datar);
        $datar['wi_number'] = $datar[$stage.'_wi_number'];
        $datar['mp_equipment_number'] = $euipments;
        echo json_encode($datar);
    }
    
    function get_postmp_process_description(){
        extract($this->input->post());
        $data = $this->AdminM->get_postmp_process_description();
        $euipments=array();
        foreach($data['steps_equipments']->result_array() as $datastepeuipment){
            $euipments[]=$datastepeuipment['euipment_number'];
        }

        foreach($data['manufacturing_process_steps']->result_array() as $datar);
        $datar['wi_number'] = $datar[$stage.'_wi_number'];
        $datar['mp_equipment_number'] = $euipments;
        echo json_encode($datar);
    }
    
    function get_mp_process_description(){
        extract($this->input->post());
        $data = $this->AdminM->get_mp_process_description();
        $euipments=array();
        foreach($data['steps_equipments']->result_array() as $datastepeuipment){
            $euipments[]=$datastepeuipment['euipment_number'];
        }

        foreach($data['manufacturing_process_steps']->result_array() as $datar);
        $datar['wi_number'] = $datar[$stage.'_wi_number'];
        $datar['mp_equipment_number'] = $euipments;
        echo json_encode($datar);
    }
    
    function get_qc_process_description(){
        extract($this->input->post());
        $data = $this->AdminM->get_qc_process_description();
        foreach($data->result_array() as $datar);
        $datar['wi_number'] = $datar[$stage.'_wi_number'];
        echo json_encode($datar);
    }
    
    function stage_one_footer_note(){
         $data = $this->AdminM->stage_one_footer_note();
         echo json_encode($data);
    }
    
    function delete_qc_scanned_file(){
        $data = $this->AdminM->delete_qc_scanned_file();
         echo json_encode($data);
    }
    
    function get_stage_one_bom_details(){
         $data = $this->AdminM->get_stage_one_bom_details();
         echo json_encode($data);
    }
    
    function get_stage_two_bom_details(){
         $data = $this->AdminM->get_stage_two_bom_details();
         echo json_encode($data);
    }
    
    function get_stage_three_bom_details(){
         $data = $this->AdminM->get_stage_three_bom_details();
         echo json_encode($data);
    }
    
    public function DHR_Report(){
        $data = $this->AdminM->get_dhr_details();
        $this->load->view('templates/Header');
		$this->load->view('Admin/DHR_Report',$data);
        $this->load->view('templates/Footer');
	}
	
	 public function DHR_Store_Report(){
        $data = $this->AdminM->get_dhr_store_details();
        $this->load->view('templates/Header');
		$this->load->view('Admin/DHR_Store_Report',$data);
        $this->load->view('templates/Footer');
	}
	
	 public function QCReport(){
        $data = $this->AdminM->get_dhr_qc_details();
        $this->load->view('templates/Header');
		$this->load->view('Admin/QCReport',$data);
        $this->load->view('templates/Footer');
	}
	
	 public function QAReport(){
        // Get employees list for the view
        $data['employees'] = $this->AdminM->get_employees_list();
        $this->load->view('templates/Header');
		$this->load->view('Admin/QAReport',$data);
        $this->load->view('templates/Footer');
	}
	
	public function QAReportData(){
        // Server-side DataTable processing for QA Report
        $draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));
        $search = $this->input->post("search")["value"];
        $order_column = $this->input->post("order")[0]["column"];
        $order_dir = $this->input->post("order")[0]["dir"];
        
        // Define column names for ordering
        $columns = array(
            0 => 'o.id',
            1 => 'o.stage',
            2 => 'o.dhr',
            3 => 'o.dhr_issued_date_qa',
            4 => 'o.batchorlot',
            5 => 'o.product_description',
            6 => 'o.manufacturing_date',
            7 => 'o.expiry_date'
        );
        
        $order_column_name = isset($columns[$order_column]) ? $columns[$order_column] : 'o.id';
        
        // Get data from model
        $data = $this->AdminM->get_qa_report_datatable($start, $length, $search, $order_column_name, $order_dir);
        $total_records = $this->AdminM->get_qa_report_total_count();
        $filtered_records = $this->AdminM->get_qa_report_filtered_count($search);
        
        $response = array(
            "draw" => $draw,
            "recordsTotal" => $total_records,
            "recordsFiltered" => $filtered_records,
            "data" => $data
        );
        
        echo json_encode($response);
	}
	
	public function order_form_dhr_check(){
	    echo $data = $this->AdminM->order_form_dhr_check();
	}
	
	public function AddBOMItems(){
	    $data['fields'] = $this->AdminM->get_bom_details();
	    $this->load->view('templates/Header');
		$this->load->view('Admin/BOMItemUploadForm',$data);
        $this->load->view('templates/Footer');
	}
	
	public function UploadBomDetails(){
	    $data = $this->AdminM->UploadBomDetails();
	    echo json_encode($data);
	}
	
	function COAList(){
        $this->load->view('templates/Header');
        $this->load->view('Admin/COAList');
        $this->load->view('templates/Footer');
    }
    
    function LoadCOAForm(){
        extract($this->input->post());
        $this->load->view('Admin/coa',$this->AdminM->GetCOADetails($coa_id));
    }
    
    function coa_form(){
        $output = $this->AdminM->coa_form();
        echo json_encode($output);
    }
    
    function fetchcoadefaultdetails(){
        $output = $this->AdminM->fetchcoadefaultdetails();
        $out = array();
        if($output->num_rows()>0){
            foreach($output->result_array() as $out);
        }else{
            $out = NULL;
        }
        echo json_encode($out);
    }
    
    function fetchdhrdetails(){
        $output = $this->AdminM->fetchdhrdetails();
        $out = array();
        if($output->num_rows()>0){
            foreach($output->result_array() as $out);
        }else{
            $out = NULL;
        }
        echo json_encode($out);
    }
    
    public function COAReport(){
        $data = $this->AdminM->get_dhr_coa_details();
        $this->load->view('templates/Header');
		$this->load->view('Admin/COAReport',$data);
        $this->load->view('templates/Footer');
	}
	
} ?>