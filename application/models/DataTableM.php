<?php
class DataTableM extends CI_Model{
    var $table='';
    
    var $column_search=array();
    var $column_order=array();
    var $order = array();
    
    function __construct() {
        parent::__construct();
        $this->load->database();
        
    }
    
    function get_datatables_schools($tname){
        $this->order['company_name']='asc';
         $this->table=$tname;
         $this->column_search=array(
                'company_name',
                'city',
                'taluk',
                'district',
                'mobile_number'
            );
         $this->column_order=array(
                null, 
                'company_name',
                'city',
                'taluk',
                'district',
                'mobile_number'
        );
        $this->get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    
    
    function get_datatables_teachers($tname){
        $this->order['employee_name']='asc';

         $this->table=$tname;
         $this->column_search=array(
                'employee_name',
                'city',
                'taluk',
                'district',
                'mobile_number'
            );
         $this->column_order=array(
                null,   
                'employee_name',
                'city',
                'taluk',
                'district',
                'mobile_number'
        );
        $this->get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function get_datatables_expense($tname){
        $this->order['date']='asc';

         $this->table=$tname;
         $this->column_search=array(
                'date',
                'expense_amount',
                'type',
                'description',
                
            );
         $this->column_order=array(
                null,   
                'date',
                'expense_amount',
                'type',
                'description',
        );
        $this->get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    
    function get_datatables_orders($tname){
        $this->order['dhr']='desc';
        $this->order['manufacturing_date']='asc';

         $this->table=$tname;
         $this->column_search=array(
                'dhr',
                'manufacturing_date',
                'batchorlot',
                'sales_order',
                'production_order',
                'product_description',
            );
         $this->column_order=array(
                null,   
                'dhr',
                'manufacturing_date',
                 'batchorlot',
                'sales_order',
                'production_order',
                'product_description',
        );
        
        $this->get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    
    function get_datatables_coa($tname){
        $this->order['id']='desc';
        $this->order['prepared_by_date']='asc';

         $this->table=$tname;
         $this->column_search=array(
                'product_description',
                'lot_or_batch_no',
                'prepared_by_date',
                'approved_by_date',
            );
         $this->column_order=array(
                null,   
                'product_description',
                'lot_or_batch_no',
                'prepared_by_date',
                'approved_by_date',
        );
        
        $this->get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    
    public function count_filtered(){
        $this->get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function count_all(){
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
    
    private function get_datatables_query(){
         $this->db->from($this->table);
         
         if(strtolower($this->session->userdata('role'))!='administrator'){
            //$this->db->where('dhr_issued_by_qa',$this->session->userdata('staff_id'));
         }
         if(strtolower($this->table=='employees')){
             $this->db->join('positions','positions.pos_id=employees.pos_id','left');
             $this->db->join('departments','departments.dept_id=employees.dept_id','left');
            if($this->input->post('teachers_type')!=''){
                $this->db->where('status',$this->input->post('teachers_type'));
            }
         }
         if($this->input->post('school_id')!=''){
             if($this->input->post('school_id')!='ALL'){
             $this->db->where('school_id',$this->input->post('school_id'));
             }
         }
         
        if(strtolower($this->table=='stage_one_dhr_order_information')){
            if($this->input->post('dhr_type')!=''){
                $this->db->where('removed',$this->input->post('dhr_type'));
            }
            
            $stage = NULL; 
            if($this->input->post('stage') == 'StageOneOrdersList'){
                $stage = 'stage_1';
            }elseif($this->input->post('stage') == 'StageTwoOrdersList'){
                $stage = 'stage_2';
            }elseif($this->input->post('stage') == 'StageThreeOrdersList'){
                $stage = 'stage_3';
            }elseif($this->input->post('stage') == 'StageFourOrdersList'){
                $stage = 'stage_4';
            }
             
            $this->db->where('stage',$stage);
        }
        
         if(strtolower($this->table=='departments')){
             $this->db->select('d.dept_id,d.dept_name,group_concat(distinct(p.pos_name)) pos_name');
             $this->db->from($this->table.' as d');
             $this->db->join('positions as p','p.dept_id=d.dept_id','left');
             $this->db->group_by('d.dept_name');
         }
         
         if(strtolower($this->table=='coa_details')){
             $this->db->select('id,product_description,lot_or_batch_no,prepared_by_date,approved_by_date,removed');
             if($this->input->post('coa_type')!=''){
                 $this->db->where('removed',$this->input->post('coa_type'));
             }
         }
         
        
         
       $i = 0;
       foreach ($this->column_search as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                 
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
    
    function get_datatables_departments($tname){
        $this->order['dept_name']='asc';

         $this->table=$tname;
         
         $this->column_search=array(
                'd.dept_name',
               
            );
         $this->column_order=array(
                null,   
                'd.dept_name',
                
        );
        $this->get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

}
?>