<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataTableContoller extends CI_Controller {
       function __construct() {
           parent::__construct();
           $this->load->model('DataTableM');
       }
        
        
        function schoolslist($tname){
            $list = $this->DataTableM->get_datatables_schools($tname);
        
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $schools) {
            $no++;
            $row = array();
            $row[]='<input type="checkbox" id="c'.$no.'" class="case" value="'.$schools->id.'" name="member_id[]" onclick="tog('.$no.', this)" />
                    <label for="c'.$no.'"><span></span></label>'.$no;
            $row[]=$schools->company_name;
            $row[]=$schools->mobile_number;
            $row[]=$schools->city;
            $row[]=$schools->taluk;
            $row[]=$schools->district;
            $row[]=$schools->state;
            $row[]='<div class=btn-group>
                        <button type="button" class="btn btn-info btn-xs btn-primary dropdown-toggle" data-toggle="dropdown" title="click to option">Options<i class="fa fa-caret" ></i></button>
                    <div class="dropdown-menu">'
                    . '<a  style="width:100%" class="btn btn-info btn-xs btn-primary dropdown-item" data-toggle="modal" data-target="#commonmodal" onclick="addschool('.$schools->id.')" title="Edit School Detail"><i class="fa fa-edit" ></i>Edit</a>'
                    . '<a  style="width:100%" class="btn  btn-xs  dropdown-item" data-toggle="modal" data-target="#commonmodal" onclick="addteacher(0,'.$schools->id.')" title="Add New Teacher"><i class="fa fa-plus" ></i>Add New Employee</a>'
                    . '<a style="width:100%" class="btn btn-info btn-xs btn-default dropdown-item" href="'.base_url().'AdminController/AddTeachers/'.$schools->id.'" title="All Teachers List"><i class="fa fa-list" ></i>Employees List</a>'
                    . '<a  style="width:100%" class="btn btn-info btn-xs btn-danger dropdown-item" onclick="deleteschool('.$schools->id.')" title="Delete"><i class="fa fa-trash" ></i>Delete</a></div>'
                    ;
            $data[] = $row;
        }
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->DataTableM->count_all(),
                        "recordsFiltered" => $this->DataTableM->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
        }
        
        function teacherslist($tname) {
            $list = $this->DataTableM->get_datatables_teachers($tname);
            
            $data   = array();
            $no     = $_POST['start'];
            foreach ($list as $teachers) {
                $schoolname = $this->db->select('company_name')
                                            ->from('companys_detail')
                                            ->where('id',$teachers->company_id)
                                            ->get();
                    if($schoolname->num_rows()>0){
                        foreach($schoolname->result_array() as $schoolnameres);
                    }
                    else{
                        $schoolnameres = NULL;
                    }
                    
                if($schoolnameres['company_name']==''){continue;}
                
                $teacherstatus = ($this->input->post('teachers_type')==1)?'hidden':'';
                $pteacherstatus = ($this->input->post('teachers_type')==0)?'hidden':'';
                
                $no++;
                $row = array();
                
                $row[]='<input type="checkbox" id="c'.$no.'" class="case" value="'.$teachers->id.'" name="member_id[]" onclick="tog('.$no.', this)" />
                        <label for="c'.$no.'"><span></span></label>'.$no;
                $row[]=$teachers->employee_name;
                $row[]=$teachers->dept_name;
                $row[]=$teachers->pos_name;
                $row[]=$teachers->mobile_number;
                $row[]=$teachers->city;
                $row[]=$teachers->employee_number;
                

                $row[]='<div class=btn-group>
                            <button type="button" class="btn btn-info btn-xs btn-primary dropdown-toggle" data-toggle="dropdown" title="click to option">Options<i class="fa fa-caret" ></i></button>
                        <div class="dropdown-menu">
                            <a type="button" class="btn btn-info btn-xs btn-primary dropdown-item" data-toggle="modal" data-target="#commonmodal" onclick="addteacher('.$teachers->id.','.$teachers->company_id.')" title="Edit Teacher Info."><i class="fa fa-edit" > Edit</i></a>
                            <a '.$pteacherstatus.' type="button" class="btn btn-info btn-xs btn-primary dropdown-item" onclick="addtoteacherlist('.$teachers->id.','.$teachers->company_id.')" title="Add To Present Teachers List"><i class="fa fa-arrow-left" > Add To Main List</i></a>
                            <a type="button" class="btn btn-info btn-xs btn-info dropdown-item" data-toggle="modal" data-target="#commonmodal" onclick="setprivilage('.$teachers->id.','.$teachers->company_id.')" title="Set Teacher Privilage."><i class="fa fa-edit" > Set Privilage</i></a>
                            <a '.$teacherstatus.' type="button" class="btn btn-info btn-xs btn-danger dropdown-item" onclick="removeteacher('.$teachers->id.')" title="Remove Teacher"><i class="fa fa-remove" > Remove</i></a>
                            <a type="button" class="btn btn-info btn-xs btn-danger dropdown-item" onclick="deleteteacher('.$teachers->id.')" title="Delete Teacher"><i class="fa fa-trash" > Delete</i></a>
                        </div>';
                $data[] = $row;
            }
            
            $output = array(
                            "draw" => $_POST['draw'],
                            "recordsTotal" => $this->DataTableM->count_all(),
                            "recordsFiltered" => $this->DataTableM->count_filtered(),
                            "data" => $data,
                    );
            //output to json format
            echo json_encode($output);
        }

        function expenseslist($tname){
            $list = $this->DataTableM->get_datatables_expense($tname);
        
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $expense) {
            $no++;
            $row = array();
            $row[]='<input type="checkbox" id="c'.$no.'" class="case" value="'.$expense->id.'" name="member_id[]" onclick="tog('.$no.', this)" />
                    <label for="c'.$no.'"><span></span></label>'.$no;
            $row[]=date('d-m-Y',strtotime($expense->date));
            $row[]=$expense->expense_amount;
            $row[]=$expense->type;
            $row[]=$expense->description;
            $row[]='<div class=btn-group>'
                    . '<button type="button" class="btn btn-info btn-xs btn-primary dropdown-toggle" data-toggle="dropdown" title="click to option">Options<i class="fa fa-caret" ></i></button>
                    <div class="dropdown-menu">
                    <a type="button" class="btn btn-info btn-xs btn-primary dropdown-item" data-toggle="modal" data-target="#commonmodal" onclick="addexpense('.$expense->id.')" title="Edit Expense"><i class="fa fa-edit" >Edit</i></a>'
                    
                    . '<a type="button" class="btn btn-info btn-xs btn-danger dropdown-item" onclick="deleteexpense('.$expense->id.')" title="Delete Expense"><i class="fa fa-trash" >Delete</i></a></div>'
                    ;
            $data[] = $row;
        }
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->DataTableM->count_all(),
                        "recordsFiltered" => $this->DataTableM->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
        }
        
    function orderslist($tname){
        $list = $this->DataTableM->get_datatables_orders($tname);
        
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $dhr) {
            $no++;
            $row = array();
            
            $stage_form='';
            if($dhr->stage=='stage_1'){
                $stage_form='stage_one_form';
            }elseif($dhr->stage=='stage_2'){
                $stage_form='stage_two_form';
            }elseif($dhr->stage=='stage_3'){
                $stage_form='stage_three_form';
            }elseif($dhr->stage=='stage_4'){
                $stage_form='stage_four_form';
            }
            
            $row[]='<input type="checkbox" id="c'.$no.'" class="case" value="'.$dhr->id.'" name="member_id[]" onclick="tog('.$no.', this)" />
                    <label for="c'.$no.'"><span></span></label>'.$no;
            $row[]=$dhr->dhr;
             $row[]=$dhr->batchorlot;
            $row[]=$dhr->sales_order;
            $row[]=$dhr->production_order;
            $row[]=$dhr->product_description;
            $row[]=$dhr->manufacturing_date==''||$dhr->manufacturing_date=='0000-00-00'?'':date('d-m-Y',strtotime($dhr->manufacturing_date));
            $row[]='<div class=btn-group>'
                    . '<button type="button" class="btn btn-info btn-xs btn-primary dropdown-toggle" data-toggle="dropdown" title="click to option">Options<i class="fa fa-caret" ></i></button>
                    <div class="dropdown-menu">
                    <a type="button" class="btn btn-info btn-xs  dropdown-item" data-toggle="modal" data-target="#commonmodal" onclick="adddhrecords('.$dhr->id.')" title="Edit DHR"><i class="fa fa-edit" >Edit</i></a>
                    <a type="button" class="btn btn-info btn-xs btn-danger dropdown-item" onclick="removedhr('.$dhr->id.')" title="Remove DHR"><i class="fa fa-remove" > Remove</i></a>
                    <br><a type="button" class="btn btn-info btn-xs btn-danger dropdown-item" onclick="deletedhr('.$dhr->id.')" title="Delete DHR"><i class="fa fa-trash" >Delete</i></a></div>
                    <button type="button"  id="coaprint" target="blank"   class="btn btn-primary" onclick="window.open(\''.base_url("ShahPDF/$stage_form/$dhr->id").'\',\'BLANK\');"><i class="fa fa-eye"></i></button>'
                    ;
            $data[] = $row;
        }
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->DataTableM->count_all(),
                        "recordsFiltered" => $this->DataTableM->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    } 
    
    function departmentslist($tname) {
            $list = $this->DataTableM->get_datatables_departments($tname);
            
            $data   = array();
            $no     = $_POST['start'];
            foreach ($list as $departments) {
               
                $no++;
                $row = array();
                
                $row[]='<input type="checkbox" id="c'.$no.'" class="case" value="'.$departments->dept_id.'" name="dept_id[]" onclick="tog('.$no.', this)" />
                        <label for="c'.$no.'"><span></span></label>'.$no;
                $row[]=$departments->dept_name;
                $row[]=str_replace(',','<br>',$departments->pos_name);
                $row[]='<div class=btn-group>
                            <button type="button" class="btn btn-info btn-xs btn-primary dropdown-toggle" data-toggle="dropdown" title="click to option">Options<i class="fa fa-caret" ></i></button>
                        <div class="dropdown-menu">
                            <a type="button" class="btn btn-info btn-xs btn-primary dropdown-item" data-toggle="modal" data-target="#secondModal" onclick="adddepartment('.$departments->dept_id.',\'Department Details\')" title="Edit Teacher Info."><i class="fa fa-edit" > Edit</i></a>
                            <a type="button" class="btn btn-info btn-xs btn-danger dropdown-item" onclick="deleteteacher('.$departments->dept_id.')" title="Delete Teacher"><i class="fa fa-trash" > Delete</i></a>
                        </div>';
                $data[] = $row;
            }
            
            $output = array(
                            "draw" => $_POST['draw'],
                            "recordsTotal" => $this->DataTableM->count_all(),
                            "recordsFiltered" => $this->DataTableM->count_filtered(),
                            "data" => $data,
                    );
            //output to json format
            echo json_encode($output);
        }
        
    function coalist($tname){
        
        $list = $this->DataTableM->get_datatables_coa($tname);
    
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $coa) {
            $no++;
            $row = array();
            
            $row[]='<input type="checkbox" id="c'.$no.'" class="case" value="'.$coa->id.'" name="member_id[]" onclick="tog('.$no.', this)" />
                    <label for="c'.$no.'"><span></span></label>'.$no;
            $row[]=$coa->product_description;
            $row[]=$coa->lot_or_batch_no;
            $row[]=$coa->prepared_by_date==''||$coa->prepared_by_date=='0000-00-00'?'':date('d-m-Y',strtotime($coa->prepared_by_date));
            $row[]=$coa->approved_by_date==''||$coa->approved_by_date=='0000-00-00'?'':date('d-m-Y',strtotime($coa->approved_by_date));
            $row[]='<div class=btn-group>'
                    . '<button type="button" class="btn btn-info btn-xs btn-primary dropdown-toggle" data-toggle="dropdown" title="click to option">Options<i class="fa fa-caret" ></i></button>
                    <div class="dropdown-menu">
                    <a type="button" class="btn btn-info btn-xs  dropdown-item" data-toggle="modal" data-target="#commonmodal" onclick="adddhrecords('.$coa->id.')" title="Edit DHR"><i class="fa fa-edit" >Edit</i></a>
                    <a type="button" class="btn btn-info btn-xs btn-danger dropdown-item" onclick="removedhr('.$coa->id.','.$coa->removed.')" title="Remove DHR"><i class="fa '.($coa->removed==0?"fa-remove":"fa-plus").'" > '.($coa->removed==0?"Remove":"Add").'</i></a>
                    <br><a type="button" class="btn btn-info btn-xs btn-danger dropdown-item" onclick="deletedhr('.$coa->id.')" title="Delete DHR"><i class="fa fa-trash" >Delete</i></a></div>
                    <button type="button"  id="coaprint" target="blank"   class="btn btn-primary" onclick="window.open(\''.base_url("ShahPDF/coa_form/$coa->id").'\',\'BLANK\');"><i class="fa fa-eye"></i></button>';
            $data[] = $row;
        }
    $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->DataTableM->count_all(),
                    "recordsFiltered" => $this->DataTableM->count_filtered(),
                    "data" => $data,
            );
    //output to json format
    echo json_encode($output);
}
}
