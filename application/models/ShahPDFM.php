<?php

class ShahPDFM extends CI_Model {
    function __construct() {
        parent::__construct();
        $this->load->database();
        date_default_timezone_set('Asia/Calcutta');
    }
    
    function stage_one_form_details($dhr_id){
        $output = array();
        $output['stage_one_dhr_order_information'] = $this->db->select('*,
                                                    IF (`sales_order`="","NA",`sales_order`) AS sales_order,
                                                    IF (`production_order`="","NA",`production_order`) AS production_order,
                                                    IF (`product_description`="","NA",`product_description`) AS product_description,
                                                    IF (`dhr`="","NA",`dhr`) AS dhr,
                                                    IF (`order_quantity`="","NA",`order_quantity`) AS order_quantity,
                                                    IF (`batchorlot`="","NA",`batchorlot`) AS batchorlot,
                                                    IF (`production_quantity`="","NA",`production_quantity`) AS production_quantity,
                                                    IF (`reformodel`="","NA",`reformodel`) AS reformodel,
                                                    IF (`date_of_commencement`="","NA",`date_of_commencement`) AS date_of_commencement,
                                                    IF (`itemcode`="","NA",`itemcode`) AS itemcode,
                                                    IF (`date_of_completion`="","NA",`date_of_completion`) AS date_of_completion,
                                                    IF (`dhr_issued_by_qa`="","NA",`dhr_issued_by_qa`) AS dhr_issued_by_qa,
                                                    IF (`dhr_issued_date_qa`="","NA",`dhr_issued_date_qa`) AS dhr_issued_date_qa,
                                                    IF (`dhr_received_by_production`="","NA",`dhr_received_by_production`) AS dhr_received_by_production,
                                                    IF(`manufacturing_date`="0000-00-00","NA",DATE_FORMAT(`manufacturing_date`,"%d-%m-%Y")) as manufacturing_date,
                                                    IF(`date_of_commencement`="0000-00-00","NA",DATE_FORMAT(`date_of_commencement`,"%d-%m-%Y")) as date_of_commencement,
                                                    IF(`expiry_date`="0000-00-00","NA",DATE_FORMAT(`expiry_date`,"%d-%m-%Y")) as expiry_date,
                                                    IF(`date_of_completion`="0000-00-00","NA",DATE_FORMAT(`date_of_completion`,"%d-%m-%Y")) as date_of_completion,
                                                    IF(`dhr_issued_date_qa`="0000-00-00","NA",DATE_FORMAT(`dhr_issued_date_qa`,"%d-%m-%Y")) as dhr_issued_date_qa,
                                                    IF(`dhr_received_date_production`="0000-00-00","NA",DATE_FORMAT(`dhr_received_date_production`,"%d-%m-%Y")) as dhr_received_date_production,
                                                    ')
                                                    ->from('stage_one_dhr_order_information')->where('id',$dhr_id)->get();
        



        $output['stage_one_dhr_bill_of_material'] = $this->db->select('*,
                                                    IF(`financial_year`="","NA",`financial_year`) AS financial_year,
                                                    IF(`reference`="","NA",`reference`) AS reference,
                                                    IF(`item_number`="","NA",`item_number`) AS item_number,
                                                    IF(`item_description`="","NA",`item_description`) AS item_description,
                                                    IF(`uom`="","NA",`uom`) AS uom,
                                                    IF(`quantity_required`="","NA",`quantity_required`) AS quantity_required,
                                                    IF(`quantity_issued`="","NA",`quantity_issued`) AS quantity_issued,
                                                    IF(`qir_number`="","NA",`qir_number`) AS qir_number,
                                                    IF(`item_lot_number`="","NA",`item_lot_number`) AS item_lot_number,
                                                    IF(`remarks`="","NA",`remarks`) AS remarks,
                                                    IF(`date`="0000-00-00","NA",DATE_FORMAT(`date`,"%d-%m-%Y")) as date,
                                                    ')
                                                    ->from('stage_one_dhr_bill_of_material')->where('dhr_id',$dhr_id)->get();
        
        $output['stage_one_pre_manufacturing_process'] = $this->db->select('*,
                                                        IF(`financial_year`="","NA",`financial_year`) AS financial_year,
                                                        IF(`prmp_item_number`="","NA",`prmp_item_number`) AS prmp_item_number,
                                                        IF(`prmp_item_description`="","NA",`prmp_item_description`) AS prmp_item_description,
                                                        IF(`prmp_uom`="","NA",`prmp_uom`) AS prmp_uom,
                                                        IF(`prmp_qunatity`="","NA",`prmp_qunatity`) AS prmp_qunatity,
                                                        IF(`prmp_wi_number`="","NA",`prmp_wi_number`) AS prmp_wi_number,
                                                        IF(`prmp_equipment_number`="","NA",`prmp_equipment_number`) AS prmp_equipment_number,
                                                        IF(`prmp_date`="0000-00-00","NA",DATE_FORMAT(`prmp_date`,"%d-%m-%Y")) as prmp_date,
                                                        ')
                                                    ->from('stage_one_dhr_pre_manufacturing_process')->where('dhr_id',$dhr_id)->get();
    

   
        $output['stage_one_manufacturing_process'] = $this->db->select('*,
                                                    IF(`financial_year`="","NA",`financial_year`) AS financial_year,
                                                    IF(`mp_seq_number`="","NA",`mp_seq_number`) AS mp_seq_number,
                                                    IF(`mp_process_description`="","NA",`mp_process_description`) AS mp_process_description,
                                                    IF(`mp_wi_number`="","NA",`mp_wi_number`) AS mp_wi_number,
                                                    IF(`mp_equipment_number`="","NA",`mp_equipment_number`) AS mp_equipment_number,
                                                    IF(`mp_start_datetime`="0000-00-00 00:00:00","NA",DATE_FORMAT(`mp_start_datetime`,"%d-%m-%Y %h:%i-%p")) as mp_start_datetime,
                                                    IF(`mp_end_datetime`="0000-00-00 00:00:00","NA",DATE_FORMAT(`mp_end_datetime`,"%d-%m-%Y %h:%i-%p")) as mp_end_datetime,
                                                    IF(`mp_manufactured_qunatity`="0","NA",`mp_manufactured_qunatity`) as mp_manufactured_qunatity,
                                                    IF(`mp_good_qunatity`="0","NA",`mp_good_qunatity`) as mp_good_qunatity,
                                                    IF(`mp_rejected_qunatity`="0","NA",`mp_rejected_qunatity`) as mp_rejected_qunatity,
                                                    IF(`mp_remarks`="","NA",`mp_remarks`) AS mp_remarks,
                                                    ')
                                                    ->from('stage_one_dhr_manufacturing_process')->where('dhr_id',$dhr_id)->get();
         

                                           
        $output['stage_one_post_manufacturing_process'] = $this->db->select('*,
                                                        IF(`financial_year`="","NA",`financial_year`) AS financial_year,
                                                        IF(`pmp_seq_number`="","NA",`pmp_seq_number`) AS pmp_seq_number,
                                                        IF(`pmp_process_description`="","NA",`pmp_process_description`) AS pmp_process_description,
                                                        IF(`pmp_wi_number`="","NA",`pmp_wi_number`) AS pmp_wi_number,
                                                        IF(`pmp_dcc_number`="","NA",`pmp_dcc_number`) AS pmp_dcc_number,
                                                        IF(`pmp_cycle_number_or_report_number`="","NA",`pmp_cycle_number_or_report_number`) AS pmp_cycle_number_or_report_number,
                                                        IF(`pmp_sent_date`="0000-00-00","NA",DATE_FORMAT(`pmp_sent_date`,"%d-%m-%Y")) as pmp_sent_date,
                                                        IF(`pmp_process_date`="0000-00-00","NA",DATE_FORMAT(`pmp_process_date`,"%d-%m-%Y")) as pmp_process_date,
                                                        ')
                                                    ->from('stage_one_dhr_post_manufacturing_process')->where('dhr_id',$dhr_id)->get();
         

                                    
        $output['stage_one_quality_control_process'] = $this->db->select('*,
                                                    IF(`financial_year`="","NA",`financial_year`) AS financial_year,
                                                    IF(`qcp_seq_number`="","NA",`qcp_seq_number`) AS qcp_seq_number,
                                                    IF(`qcp_process_inspection_or_testing_description`="","NA",`qcp_process_inspection_or_testing_description`) AS qcp_process_inspection_or_testing_description,
                                                    IF(`qcp_wi_number`="","NA",`qcp_wi_number`) AS qcp_wi_number,
                                                    IF(`qcp_qir_number_or_report_number`="","NA",`qcp_qir_number_or_report_number`) AS qcp_qir_number_or_report_number,
                                                    IF(`qcp_sample_quantity`="","NA",`qcp_sample_quantity`) AS qcp_sample_quantity,
                                                    IF(`qcp_pass_or_fail`="","NA",`qcp_pass_or_fail`) AS qcp_pass_or_fail,
                                                    IF(`qcp_scanned_file`="","NA",`qcp_scanned_file`) AS qcp_scanned_file,       
                                                    IF(`qcp_verified_date`="0000-00-00","NA",DATE_FORMAT(`qcp_verified_date`,"%d-%m-%Y")) as qcp_verified_date,')
                                                    ->from('stage_one_dhr_quality_control_process')->where('dhr_id',$dhr_id)->get();
          

                                     
        $output['finished_goods_transfer_note'] = $this->db->select('*,
                                                                    IF(`financial_year`="","NA",`financial_year`) AS financial_year,
                                                                    IF(`transferred_quantity`="","NA",`transferred_quantity`) AS transferred_quantity,
                                                                    IF(`transferred_date`="0000-00-00","NA",DATE_FORMAT(`transferred_date`,"%d-%m-%Y")) as transferred_date,
                                                                    IF(`accepted_date`="0000-00-00","NA",DATE_FORMAT(`accepted_date`,"%d-%m-%Y")) as accepted_date,
                                                                    ')->from('stage_one_dhr_finished_goods_transfer_note')->where('dhr_id',$dhr_id)->get();
        


        $output['stage_one_material_reconciliation'] = $this->db->select('*,
                                                                        IF(`financial_year`="","NA",`financial_year`) AS financial_year, 
                                                                        IF(`mrec_item_number`="","NA",`mrec_item_number`) AS mrec_item_number, 
                                                                        IF(`mrec_description`="","NA",`mrec_description`) AS mrec_description, 
                                                                        IF(`mrec_uom`="","NA",`mrec_uom`) AS mrec_uom, 
                                                                        IF(`mrec_quantity_received`="","NA",`mrec_quantity_received`) AS mrec_quantity_received, 
                                                                        IF(`mrec_qir_number`="","NA",`mrec_qir_number`) AS mrec_qir_number, 
                                                                        IF(`mrec_item_lot_number_or_input_lot`="","NA",`mrec_item_lot_number_or_input_lot`) AS mrec_item_lot_number_or_input_lot, 
                                                                        IF(`mrec_remark`="","NA",`mrec_remark`) AS mrec_remark, 
                                                                        IF(`mrec_date`="0000-00-00","NA",DATE_FORMAT(`mrec_date`,"%d-%m-%Y")) as mrec_date')
                                                                        ->from('stage_one_dhr_material_reconciliation')->where('dhr_id',$dhr_id)->get();
             

                                                           
        $output['stage_one_finished_goods_reconcillation'] = $this->db->select('*,
                                                                            IF(`financial_year`="","NA",`financial_year`) AS financial_year,
                                                                            IF(`total_quantity_produced_and_packed`="","NA",`total_quantity_produced_and_packed`) AS total_quantity_produced_and_packed,
                                                                            IF(`archive_samples_quantity`="0","NA",`archive_samples_quantity`) AS archive_samples_quantity,
                                                                            IF(`ep_archive_samples_quantity`="","NA",`ep_archive_samples_quantity`) AS ep_archive_samples_quantity,
                                                                            IF(`production_archive_samples_quantity`="","NA",`production_archive_samples_quantity`) AS production_archive_samples_quantity,
                                                                            IF(`penetration_samples_quantity`="","NA",`penetration_samples_quantity`) AS penetration_samples_quantity,
                                                                            IF(`control_samples_quantity`="","NA",`control_samples_quantity`) AS control_samples_quantity,
                                                                            IF(`rejected_quantity`="","NA",`rejected_quantity`) AS rejected_quantity,
                                                                            IF(`yield_percentage`="","NA",`yield_percentage`) AS yield_percentage,
                                                                            IF(`production_verified_by_remarks`="","NA",`production_verified_by_remarks`) AS production_verified_by_remarks,
                                                                            IF(`checked_by_quality_control_remark`="","NA",`checked_by_quality_control_remark`) AS checked_by_quality_control_remark,
                                                                            IF(`production_verified_date`="0000-00-00","NA",DATE_FORMAT(`production_verified_date`,"%d-%m-%Y")) as production_verified_date,
                                                                            IF(`checked_by_quality_control_date`="0000-00-00","NA",DATE_FORMAT(`checked_by_quality_control_date`,"%d-%m-%Y")) as checked_by_quality_control_date,
                                                                            ')->from('stage_one_dhr_finished_goods_reconciliation')->where('dhr_id',$dhr_id)->get();
        


        $output['stage_one_qa_approval_and_release'] = $this->db->select('*,
                                                                        IF(`financial_year`="","NA",`financial_year`) AS financial_year,
                                                                        IF(`quantity_released_for_dispatch`="","NA",`quantity_released_for_dispatch`) AS quantity_released_for_dispatch,
                                                                        IF(`remarks`="","NA",`remarks`) AS remarks,
                                                                        IF(`date_of_release`="0000-00-00","NA",DATE_FORMAT(`date_of_release`,"%d-%m-%Y")) as date_of_release')
                                                                        ->from('stage_one_dhr_qa_approval_and_release')->where('dhr_id',$dhr_id)->get();
                                                                        
         $output['stage_one_footer_note'] = $this->db->select('*,
                                                                        IF(`financial_year`="","NA",`financial_year`) AS financial_year,
                                                                        IF(`format_no`="","NA",`format_no`) AS format_no,
                                                                        IF(`rev_no`="","NA",`rev_no`) AS rev_no,
                                                                        IF(`effective_date`="0000-00-00","NA",DATE_FORMAT(`effective_date`,"%d-%m-%Y")) as effective_date')
                                                                        ->from('stage_one_footer_note')->where('dhr_id',$dhr_id)->get();
                                                                        
        $employees_details = $this->db->select('*')
                                    ->from('employees')
                                    ->get(); 
        $employees=array();
        foreach($employees_details->result_array() as $employees_detail){
            $employees[$employees_detail['id']]=$employees_detail;
        }
         $output['employee_details'] = $employees;
        
        return $output;
    }
    
    function coa_form_details($coa_id){
        
        $output = array();
       
        $output['coa_details'] = $this->db->select('*,
        CASE
            WHEN prepared_by_date="0000-00-00" OR prepared_by_date IS NULL
            THEN "NA"
            ELSE DATE_FORMAT(prepared_by_date,"%d-%m-%Y")
        END AS prepared_by_date,
        CASE
            WHEN approved_by_date="0000-00-00" OR approved_by_date IS NULL
            THEN "NA"
            ELSE DATE_FORMAT(approved_by_date,"%d-%m-%Y")
        END AS approved_by_date
        ')->from('coa_details')->where('id',$coa_id)->get();
        
        $output['coa_parameter'] = $this->db->select('*')->from('coa_parameter')->where('coa_id',$coa_id)->get();
        
        
        $output['coa_footer_note']= $this->db->select('*')->from('coa_footer_note')->where('coa_id',$coa_id)->get();
        
       
        $employees=$this->db
                            ->select('e.*,p.pos_name designation')
                            ->from('employees e')
                            ->join('positions p','p.pos_id=e.pos_id')
                            ->get();  
        foreach($employees->result_array() as $employee){
            $employs[$employee['id']] = $employee;
        }  
        
         $output['employee_details']=$employs;
          
        $output['departments'] = $orderno = $this->db->select('*')
                                                            ->from('departments')
                                                           ->get();                                                    
           
        return $output;
    }
}

?>