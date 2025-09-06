<?php

defined('BASEPATH') OR exit('direct script access not allowed');

class ShahPDF extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('pdf'); // Load library
        $this->pdf->fontpath = 'font/'; // Specify font folder
        $this->load->model('ShahPDFM');
        $this->load->database();
        ini_set('memory_limit','1024M');
        ini_set('max_execution_time','1200000000000000000');
    }

    function stage_one_form($dhr_id){
        $order_information = $bill_of_material   = $f_g_transfer_note   = $finished_goods_reconcillation = $qa_approval_and_release = $employee_details= $footer_note = NULL;
        
        $data = $this->ShahPDFM->stage_one_form_details($dhr_id);
        
        $employee_details=$data['employee_details'];
        
        foreach($data['stage_one_footer_note']->result_array() as $footer_note);
        
        foreach($data['stage_one_dhr_order_information']->result_array() as $order_information);
       
        
        // $data['stage_one_pre_manufacturing_process'];
        // $data['stage_one_manufacturing_process'];
        // $data['stage_one_post_manufacturing_process'];
        // $data['stage_one_quality_control_process'];
        // $data['finished_goods_transfer_note'];
        // $data['stage_one_material_reconciliation'];
        // $data['stage_one_finished_goods_reconcillation'];
        // $data['stage_one_qa_approval_and_release'];
        
        $this->pdf->setHeaderForNextPage(array('title'=>'Device History Record'));
        $this->pdf->setFooterForNextPage($footer_note);
        $this->pdf->AddPage('L','','A4');
        $this->pdf->SetAutoPageBreak(1);
        // $this->pdf->SetFont('Arial','B',12);
        // $this->pdf->Image(LOGO_PATH,20,10,25,10);
        // $this->pdf->Cell(50,10,'',1,0,'C');
        // $this->pdf->Cell(227,10,'Device History Record',1,1,'C');
        
        ////////////////////////////////////////////////////////////Order Information/////////////////////////////////////////////////////////////
        $this->pagebreak($this->pdf->GetY(),(8*8),210,10); //$currentY,$segment_height(rows*each_row_height) or exact height,$page_height,$bottom_margin
        
        $this->pdf->SetXY(10,$this->pdf->GetY()+0);
        $this->pdf->SetFillColor(217,217,217);
        $this->pdf->Cell(277,8,'Order Information',1,1,'C',1);
        
        $this->pdf->SetFont('Arial','',10);
        
        $this->pdf->Cell(50,8,'Sales Order #',1,0,'L');
        $this->pdf->CellFitScale(125,8,$order_information['sales_order'],1,0,'L');
        $this->pdf->Cell(50,8,'Production Order #',1,0,'L');
        $this->pdf->CellFitScale(52,8,$order_information['production_order'],1,1,'L');
        
        $this->pdf->Cell(50,8,'Product Description',1,0,'L');
        $this->pdf->CellFitScale(227,8,$order_information['product_description'],1,1,'L');
        
        
        $this->pdf->Cell(50,8,'DHR #',1,0,'L');
        $this->pdf->CellFitScale(125,8,$order_information['dhr'],1,0,'L');
        $this->pdf->Cell(50,8,'Order Quantity',1,0,'L');
        $this->pdf->CellFitScale(52,8,$order_information['order_quantity'],1,1,'L');
        
        $this->pdf->Cell(50,8,'Batch/Lot #',1,0,'L');
        $this->pdf->CellFitScale(125,8,$order_information['batchorlot'],1,0,'L');
        $this->pdf->Cell(50,8,'Production Quantity',1,0,'L');
        $this->pdf->CellFitScale(52,8,$order_information['production_quantity'],1,1,'L');
         
        $this->pdf->Cell(50,8,'REF/Model #',1,0,'L');
        $this->pdf->CellFitScale(50,8,$order_information['reformodel'],1,0,'L');
        $this->pdf->Cell(40,8,'Manufacturing Date',1,0,'L');
        $this->pdf->CellFitScale(35,8,$order_information['manufacturing_date'],1,0,'L');
        $this->pdf->Cell(50,8,'Date of Commencement',1,0,'L');
        $this->pdf->CellFitScale(52,8,$order_information['date_of_commencement'],1,1,'L');
          
        $this->pdf->Cell(50,8,'Item Code',1,0,'L');
        $this->pdf->CellFitScale(50,8,$order_information['itemcode'],1,0,'L');
        $this->pdf->Cell(40,8,'Expiry Date',1,0,'L');
        $this->pdf->CellFitScale(35,8,$order_information['expiry_date'],1,0,'L');
        $this->pdf->Cell(50,8,'Date of Completion',1,0,'L');
        $this->pdf->CellFitScale(52,8,$order_information['date_of_completion'],1,1,'L');
        $dhr_issued_by_qa_employee_short_name = isset($employee_details[$order_information['dhr_issued_by_qa']]['employee_short_name'])?$employee_details[$order_information['dhr_issued_by_qa']]['employee_short_name']:'NA';
        $dhr_issued_by_qa_signature = isset($employee_details[$order_information['dhr_issued_by_qa']]['signature'])?$employee_details[$order_information['dhr_issued_by_qa']]['signature']:'NA';
        $this->pdf->CellFitScale(277/8,8,'DHR Issued by (QA)',1,0,'L');
        $this->pdf->CellFitScale(277/8,8,$dhr_issued_by_qa_employee_short_name,1,0,'L');
        if(file_exists($dhr_issued_by_qa_signature)){
            $this->pdf->Image($dhr_issued_by_qa_signature,70,$this->pdf->GetY(),10,8);
        }
        
         $this->pdf->CellFitScale(277/8,8,'DHR Issued Date (QA)',1,0,'L');
        $this->pdf->CellFitScale(277/8,8,$order_information['dhr_issued_date_qa'],1,0,'L');
        
        $dhr_received_by_production_employee_short_name = isset($employee_details[$order_information['dhr_received_by_production']]['employee_short_name'])?$employee_details[$order_information['dhr_received_by_production']]['employee_short_name']:'NA';
        $dhr_received_by_production_signature = isset($employee_details[$order_information['dhr_received_by_production']]['signature'])?$employee_details[$order_information['dhr_received_by_production']]['signature']:'NA';
        $this->pdf->CellFitScale(277/8,8,'DHR Received by (Production)',1,0,'L');
         $this->pdf->CellFitScale(277/8,8,$dhr_received_by_production_employee_short_name,1,0,'L');
        if(file_exists($dhr_received_by_production_signature)){
            $this->pdf->Image($employee_details[$order_information['dhr_received_by_production']]['signature'],208,$this->pdf->GetY(),10,8);
        }
        
        
        $this->pdf->CellFitScale(277/8,8,'DHR Received Date (Production)',1,0,'L');
        $this->pdf->CellFitScale(277/8,8,$order_information['dhr_received_date_production'],1,1,'L');
        
        $this->pdf->SetFont('Arial','I',10);
        $this->pdf->Cell(277,8,'Note: Manufacturing and Expiry Date as per customer label.',0,1,'L');
        
        ////////////////////////////////////////////////////////////Bill of Material/////////////////////////////////////////////////////////////
       
        foreach($data['stage_one_dhr_bill_of_material']->result_array() as $bill_of_material);
        
        $this->pdf->SetFont('Arial','B',12);
        
        $this->pdf->SetXY(10,$this->pdf->GetY()+5);
        $this->pdf->SetFillColor(217,217,217);
        $this->pdf->Cell(277,8,'Bill of Material',1,1,'C',1);
        
        $this->pdf->SetFont('Arial','',10);
        
        $this->pdf->Cell(277,8,'Reference: '.$bill_of_material['reference'],1,1,'L',1);
        
        $headingy = $this->pdf->GetY();
        $headingx = $this->pdf->GetX();
        
        $this->pdf->SetXY($headingx,$headingy);
        $this->pdf->CellFitScale(23,10,'Item #',1,0,'C');
        
        $this->pdf->SetXY($headingx+=23,$headingy);
        $this->pdf->CellFitScale(55,10,'Description',1,0,'C');
        
        $this->pdf->SetXY($headingx+=55,$headingy);
        $this->pdf->CellFitScale(20,10,'UOM',1,0,'C');
        
        $this->pdf->SetXY($headingx+=20,$headingy);
        $this->pdf->MultiCell(20,5,'Qunatity Required',1,'C');
        
        $this->pdf->SetXY($headingx+=20,$headingy);
        $this->pdf->MultiCell(20,5,'Quantity Issued',1,'C');
        
        $this->pdf->SetXY($headingx+=20,$headingy);
        $this->pdf->CellFitScale(20,10,'QIR #',1,0,'C');
        
        $this->pdf->SetXY($headingx+=20,$headingy);
        $this->pdf->MultiCell(20,5,'Item Lot # (Input Lot)',1,'C');
        
        $this->pdf->SetXY($headingx+=20,$headingy);
        $this->pdf->CellFitScale(20,10,'Issued By',1,0,'C');
        
        $this->pdf->SetXY($headingx+=20,$headingy);
        $this->pdf->CellFitScale(20,10,'Received By',1,0,'C');
        
        $this->pdf->SetXY($headingx+=20,$headingy);
        $this->pdf->CellFitScale(25,10,'Date',1,0,'C');
        
        $this->pdf->SetXY($headingx+=25,$headingy);
        $this->pdf->CellFitScale(34,10,'Remarks',1,1,'C');
        
        $bom=0;
        foreach($data['stage_one_dhr_bill_of_material']->result_array() as $bill_of_material){
            $headingy = $this->pdf->GetY();
            $headingx = $this->pdf->GetX();
            
            $this->pdf->SetXY($headingx,$headingy);
            $this->pdf->CellFitScale(23,12,$bill_of_material['item_number'],1,0,'C');
            
            $this->pdf->SetXY($headingx+=23,$headingy);
            $this->pdf->CellFitScale(55,12,$bill_of_material['item_description'],1,0,'C');
            
            $this->pdf->SetXY($headingx+=55,$headingy);
            $this->pdf->CellFitScale(20,12,$bill_of_material['uom'],1,0,'C');
            
            $this->pdf->SetXY($headingx+=20,$headingy);
            $this->pdf->CellFitScale(20,12,$bill_of_material['quantity_required'],1,0,'C');
            
            $this->pdf->SetXY($headingx+=20,$headingy);
            $this->pdf->CellFitScale(20,12,$bill_of_material['quantity_issued'],1,0,'C');
            
            $this->pdf->SetXY($headingx+=20,$headingy);
            $this->pdf->CellFitScale(20,12,$bill_of_material['qir_number'],1,0,'C');
            
            $this->pdf->SetXY($headingx+=20,$headingy);
            $this->pdf->CellFitScale(20,12,$bill_of_material['item_lot_number'],1,0,'C');
            
            
            $this->pdf->SetXY($headingx+=20,$headingy);
            if($bill_of_material['issued_by']!=''){
                $this->pdf->CellFitScale(20,6,'','LTR',1,'L');
                $this->pdf->SetX($headingx);
                $this->pdf->CellFitScale(20,6,$employee_details[$bill_of_material['issued_by']]['employee_short_name'],'LBR',0,'C');
                if(file_exists($employee_details[$bill_of_material['issued_by']]['signature'])){
                    $this->pdf->Image($employee_details[$bill_of_material['issued_by']]['signature'],$headingx+2,$headingy+1,15,6);
                }
            }else{
                $this->pdf->CellFitScale(20,12,'',1,0,'L');
            }
            
            $this->pdf->SetXY($headingx+=20,$headingy);
            if($bill_of_material['received_by']!=''){
                $this->pdf->CellFitScale(20,6,'','LTR',1,'L');
                $this->pdf->SetX($headingx);
                $this->pdf->CellFitScale(20,6,$employee_details[$bill_of_material['received_by']]['employee_short_name'],'LBR',0,'C');
                if(file_exists($employee_details[$bill_of_material['received_by']]['signature'])){
                    $this->pdf->Image($employee_details[$bill_of_material['received_by']]['signature'],$headingx+2,$headingy+1,15,6);
                }
            }else{
                $this->pdf->CellFitScale(20,12,'',1,0,'L');
            }
            
            $this->pdf->SetXY($headingx+=20,$headingy);
            $this->pdf->CellFitScale(25,12,$bill_of_material['date'],1,0,'C');
            
            $this->pdf->SetXY($headingx+=25,$headingy);
            $this->pdf->CellFitScale(34,12,$bill_of_material['remarks'],1,1,'C');
            
             $this->pagebreak($this->pdf->GetY(),(18+(12*($data['stage_one_dhr_bill_of_material']->num_rows()-$bom))),210,10); //$currentY,$segment_height(rows*each_row_height) or exact height,$page_height,$bottom_margin
        
            $bom++;
        }
        
         ////////////////////////////////////////////////////////////Pre Manufacturing Process/////////////////////////////////////////////////////////////
          $this->pagebreak($this->pdf->GetY(),(18+(12*$data['stage_one_pre_manufacturing_process']->num_rows())),210,10); //$currentY,$segment_height(rows*each_row_height) or exact height,$page_height,$bottom_margin
       
        if($data['stage_one_pre_manufacturing_process']->num_rows()>0){
            $this->pdf->SetFont('Arial','B',12);
            
            $this->pdf->SetXY(10,$this->pdf->GetY()+5);
            $this->pdf->SetFillColor(217,217,217);
            $this->pdf->Cell(277,8,'Pre Manufacturing Process',1,1,'C',1);
            
            $this->pdf->SetFont('Arial','',10);
         
            $headingy = $this->pdf->GetY();
            $headingx = $this->pdf->GetX();
            $w = 0;
            
            $this->pdf->SetXY($headingx,$headingy);
            $this->pdf->CellFitScale($w=13,10,'Item #',1,0,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->CellFitScale($w=70,10,'Description',1,0,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->CellFitScale($w=20,10,'UOM',1,0,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->CellFitScale($w=20,10,'Qunatity',1,0,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->MultiCell($w=34,10,'WI #',1,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->MultiCell($w=30,10,'Equipment #',1,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->MultiCell($w=30,10,'Done By',1,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->MultiCell($w=30,10,'Verified By',1,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->MultiCell($w=30,10,'Date',1,'C');
            $premp=0;
            foreach($data['stage_one_pre_manufacturing_process']->result_array() as $pre_manufacturing_process){
                $headingy = $this->pdf->GetY();
                $headingx = $this->pdf->GetX();
                $w=0;
                
                    $this->pdf->SetXY($headingx,$headingy);
                    $this->pdf->CellFitScale($w=13,12,$pre_manufacturing_process['prmp_item_number'],1,0,'C');
                    
                    $this->pdf->SetXY($headingx+=$w,$headingy);
                    $this->pdf->CellFitScale($w=70,12,$pre_manufacturing_process['prmp_item_description'],1,0,'C');
                    
                    $this->pdf->SetXY($headingx+=$w,$headingy);
                    $this->pdf->CellFitScale($w=20,12,$pre_manufacturing_process['prmp_uom'],1,0,'C');
                    
                    $this->pdf->SetXY($headingx+=$w,$headingy);
                    $this->pdf->CellFitScale($w=20,12,$pre_manufacturing_process['prmp_qunatity'],1,0,'C');
                    
                    $this->pdf->SetXY($headingx+=$w,$headingy);
                    $this->pdf->MultiCell($w=34,12,$pre_manufacturing_process['prmp_wi_number'],1,'C');
                    
                    $this->pdf->SetXY($headingx+=$w,$headingy);
                    $this->pdf->MultiCell($w=30,12,$pre_manufacturing_process['prmp_equipment_number'],1,'C');
                    
                    $this->pdf->SetXY($headingx+=$w,$headingy);
                    if($pre_manufacturing_process['prmp_done_by']!=''){
                        $this->pdf->CellFitScale($w=30,6,'','LTR',1,'L');
                        $this->pdf->SetX($headingx);
                        $this->pdf->CellFitScale($w=30,6,$pre_manufacturing_process['prmp_done_by'],'LBR',0,'C');
                    }else{
                        $this->pdf->CellFitScale($w=30,12,'',1,0,'L');
                    }
                    
                    $this->pdf->SetXY($headingx+=$w,$headingy);
                    if($pre_manufacturing_process['prmp_verified_by']!=''){
                        $this->pdf->CellFitScale($w=30,6,'','LTR',1,'L');
                        $this->pdf->SetX($headingx);
                        $this->pdf->CellFitScale($w=30,6,$employee_details[$pre_manufacturing_process['prmp_verified_by']]['employee_short_name'],'LBR',0,'C');
                        if(file_exists($employee_details[$pre_manufacturing_process['prmp_verified_by']]['signature'])){
                            $this->pdf->Image($employee_details[$pre_manufacturing_process['prmp_verified_by']]['signature'],$headingx+2,$headingy+1,15,6);
                        }
                    }else{
                        $this->pdf->CellFitScale($w=30,12,'',1,0,'L');
                    }
                    
                    $this->pdf->SetXY($headingx+=$w,$headingy);
                    $this->pdf->MultiCell($w=30,12,$pre_manufacturing_process['prmp_date'],1,'C');
                }
                 $this->pagebreak($this->pdf->GetY(),(18+(12*($data['stage_one_pre_manufacturing_process']->num_rows()-$premp))),210,10); //$currentY,$segment_height(rows*each_row_height) or exact height,$page_height,$bottom_margin
                $premp++;
            }
            
       ///////////////////////////////////////////////////////////////////////Manufacturing Process/////////////////////////////////////////////////////////////////////////// 
       
        //$this->pdf->AddPage('L','','A4');
        //$this->pdf->SetAutoPageBreak(1);
        // $this->pdf->SetFont('Arial','B',12);
        // $this->pdf->Image(LOGO_PATH,20,10,25,10);
        // $this->pdf->Cell(50,10,'',1,0,'C');
        // $this->pdf->Cell(227,10,'Device History Record',1,1,'C');
        
        $this->pdf->SetFont('Arial','B',12);
        
        $this->pdf->SetXY(10,$this->pdf->GetY()+0);
        $this->pdf->SetFillColor(217,217,217);
        $this->pdf->Cell(277,8,'Manufacturing Process',1,1,'C',1);
        
        $this->pdf->SetFont('Arial','',10);
     
        $headingy = $this->pdf->GetY();
        $headingx = $this->pdf->GetX();
        $w = 0;
        
        $this->pdf->SetXY($headingx,$headingy);
        $this->pdf->CellFitScale($w=13,12,'Seq.#',1,0,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->CellFitScale($w=55,12,'Process Description',1,0,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->CellFitScale($w=24.5,12,'WI #',1,0,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->CellFitScale($w=24.5,12,'Equipment #',1,0,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->MultiCell($w=20,6,'Start'.PHP_EOL.'Date/Time',1,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->MultiCell($w=20,6,'End'.PHP_EOL.'Date/Time',1,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->MultiCell($w=25,6,'Manufactured'.PHP_EOL.'Quantity',1,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->MultiCell($w=18,6,'Good'.PHP_EOL.'Quantity',1,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->MultiCell($w=20,6,'Rejected'.PHP_EOL.'Quantity',1,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->MultiCell($w=19,6,'Done'.PHP_EOL.'By',1,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->MultiCell($w=19,6,'Verified'.PHP_EOL.'By',1,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->MultiCell($w=19,4,'Line'.PHP_EOL.'Clearance By',1,'C');
        
        $mp=0;
        foreach($data['stage_one_manufacturing_process']->result_array() as $manufacturing_process){
            $headingy = $this->pdf->GetY();
            $headingx = $this->pdf->GetX();
            $w=0;
            $this->pdf->SetXY($headingx,$headingy);
            $this->pdf->CellFitScale($w=13,12,$manufacturing_process['mp_seq_number'],1,0,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->CellFitScale($w=55,12,$manufacturing_process['mp_process_description'],1,0,'L');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->CellFitScale($w=24.5,12,$manufacturing_process['mp_wi_number'],1,0,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->CellFitScale($w=24.5,12,$manufacturing_process['mp_equipment_number'],1,0,'C');
            
            $this->pdf->SetFont('Arial','',9);
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $mpsdt = explode(' ',$manufacturing_process['mp_start_datetime']);
            $this->pdf->MultiCell($w=20,($manufacturing_process['mp_start_datetime']=='NA'?12:6),implode(PHP_EOL,$mpsdt),1,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $mpedt = explode(' ',$manufacturing_process['mp_end_datetime']);
            $this->pdf->MultiCell($w=20,($manufacturing_process['mp_end_datetime']=='NA'?12:6),implode(PHP_EOL,$mpedt),1,'C');
            $this->pdf->SetFont('Arial','',10);
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->CellFitScale($w=25,12,$manufacturing_process['mp_manufactured_qunatity'],1,0,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->CellFitScale($w=18,12,$manufacturing_process['mp_good_qunatity'],1,0,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->CellFitScale($w=20,12,$manufacturing_process['mp_rejected_qunatity'],1,0,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            if($manufacturing_process['mp_done_by']!=''){
                $this->pdf->CellFitScale($w=19,6,'','LTR',1,'L');
                $this->pdf->SetX($headingx);
                $this->pdf->CellFitScale($w=19,6,$manufacturing_process['mp_done_by'],'LBR',0,'C');
              
            }else{
                $this->pdf->CellFitScale($w=19,12,'',1,0,'L');
            }
           
            $this->pdf->SetXY($headingx+=$w,$headingy);
            if($manufacturing_process['mp_verified_by']!=''){
                $this->pdf->CellFitScale($w=19,6,'','LTR',1,'L');
                $this->pdf->SetX($headingx);
                $this->pdf->CellFitScale($w=19,6,$employee_details[$manufacturing_process['mp_verified_by']]['employee_short_name'],'LBR',0,'C');
                if(file_exists($employee_details[$manufacturing_process['mp_verified_by']]['signature'])){
                    $this->pdf->Image($employee_details[$manufacturing_process['mp_verified_by']]['signature'],$headingx+2,$headingy+1,15,6);
                }
            }else{
                 $this->pdf->CellFitScale($w=19,12,'',1,0,'L');
            }
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            if($manufacturing_process['mp_line_clearance_by']!=''){
                $this->pdf->CellFitScale($w=19,6,'','LTR',1,'L');
                $this->pdf->SetX($headingx);
                $this->pdf->CellFitScale($w=19,6,$employee_details[$manufacturing_process['mp_line_clearance_by']]['employee_short_name'],'LBR',1,'C');
                if(file_exists($employee_details[$manufacturing_process['mp_line_clearance_by']]['signature'])){
                    $this->pdf->Image($employee_details[$manufacturing_process['mp_line_clearance_by']]['signature'],$headingx+2,$headingy+1,15,6);
                }
            }else{
                $this->pdf->CellFitScale($w=19,12,'',1,1,'L');
            }
             $this->pagebreak($this->pdf->GetY(),(18+(12*($data['stage_one_manufacturing_process']->num_rows()-$mp))),210,10); //$currentY,$segment_height(rows*each_row_height) or exact height,$page_height,$bottom_margin
                $mp++;
        }
        
        /////////////////////////////////////////////////////////////Post manufacturing Process//////////////////////////////////////////////////////////////
        // $this->pagebreak($this->pdf->GetY(),(20+(12*$data['stage_one_post_manufacturing_process']->num_rows())),210,10); //$currentY,$segment_height(rows*each_row_height) or exact height,$page_height,$bottom_margin
       
        // $this->pdf->AddPage('L','','A4');
        //$this->pdf->SetAutoPageBreak(1);
        // $this->pdf->SetFont('Arial','B',12);
        // $this->pdf->Image(LOGO_PATH,20,10,25,10);
        // $this->pdf->Cell(50,10,'',1,0,'C');
        // $this->pdf->Cell(227,10,'Device History Record',1,1,'C');
        
        
        if($data['stage_one_post_manufacturing_process']->num_rows()>0){
            $this->pdf->SetFont('Arial','B',12);
            
            $this->pdf->SetXY(10,$this->pdf->GetY()+0);
            $this->pdf->SetFillColor(217,217,217);
            $this->pdf->Cell(277,8,'Post Manufacturing Process',1,1,'C',1);
            
            $this->pdf->SetFont('Arial','',10);
         
            $headingy = $this->pdf->GetY();
            $headingx = $this->pdf->GetX();
            $w = 0;
            
            
            $this->pdf->SetXY($headingx,$headingy);
            $this->pdf->CellFitScale($w=12,12,'Seq.#',1,0,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->CellFitScale($w=55,12,'Process Description',1,0,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->CellFitScale($w=30,12,'WI #',1,0,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->CellFitScale($w=30,12,'DCC # (If Applicable)',1,0,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->MultiCell($w=30,12,'Sent Date',1,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->MultiCell($w=30,12,'Cycle #/Report #',1,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->MultiCell($w=30,12,'Process Date',1,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->MultiCell($w=30,12,'Done By',1,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->MultiCell($w=30,12,'Checked By',1,'C');
            $postmp=0;
            foreach($data['stage_one_post_manufacturing_process']->result_array() as $post_manufacturing_process){
                $headingy = $this->pdf->GetY();
                $headingx = $this->pdf->GetX();
                $w=0;
                $this->pdf->SetXY($headingx,$headingy);
                $this->pdf->CellFitScale($w=12,12,$post_manufacturing_process['pmp_seq_number'],1,0,'C');
                
                $this->pdf->SetXY($headingx+=$w,$headingy);
                $this->pdf->CellFitScale($w=55,12,$post_manufacturing_process['pmp_process_description'],1,0,'C');
                
                $this->pdf->SetXY($headingx+=$w,$headingy);
                $this->pdf->CellFitScale($w=30,12,$post_manufacturing_process['pmp_wi_number'],1,0,'C');
                
                $this->pdf->SetXY($headingx+=$w,$headingy);
                $this->pdf->CellFitScale($w=30,12,$post_manufacturing_process['pmp_dcc_number'],1,0,'C');
                
                $this->pdf->SetXY($headingx+=$w,$headingy);
                $this->pdf->MultiCell($w=30,12,$post_manufacturing_process['pmp_sent_date'],1,'C');
                
                $this->pdf->SetXY($headingx+=$w,$headingy);
                $this->pdf->CellFitScale($w=30,12,$post_manufacturing_process['pmp_cycle_number_or_report_number'],1,0,'C');
                
                $this->pdf->SetXY($headingx+=$w,$headingy);
                $this->pdf->MultiCell($w=30,12,$post_manufacturing_process['pmp_process_date'],1,'C');
                
                $this->pdf->SetXY($headingx+=$w,$headingy);
                $this->pdf->MultiCell($w=30,12,$post_manufacturing_process['pmp_done_by'],1,'C');
                
                // $this->pdf->SetXY($headingx+=$w,$headingy);
                // if($post_manufacturing_process['pmp_done_by']!=''){
                //     $this->pdf->CellFitScale($w=30,6,'','LTR',1,'L');
                //     $this->pdf->SetX($headingx);
                //     $this->pdf->CellFitScale($w=30,6,$employee_details[$post_manufacturing_process['pmp_done_by']]['employee_short_name'],'LBR',0,'C');
                //     if(file_exists($employee_details[$post_manufacturing_process['pmp_done_by']]['signature'])){
                //         $this->pdf->Image($employee_details[$post_manufacturing_process['pmp_done_by']]['signature'],$headingx+2,$headingy+1,15,6);
                //     }
                // }else{
                //   $this->pdf->CellFitScale($w=30,12,'',1,0,'L'); 
                // }
                
                $this->pdf->SetXY($headingx+=$w,$headingy);
                if($post_manufacturing_process['pmp_checked_by']!=''){
                    $this->pdf->CellFitScale($w=30,6,'','LTR',1,'L');
                    $this->pdf->SetX($headingx);
                    $this->pdf->CellFitScale($w=30,6,$employee_details[$post_manufacturing_process['pmp_checked_by']]['employee_short_name'],'LBR',1,'C');
                    if(file_exists($employee_details[$post_manufacturing_process['pmp_checked_by']]['signature'])){
                        $this->pdf->Image($employee_details[$post_manufacturing_process['pmp_checked_by']]['signature'],$headingx+2,$headingy+1,15,6);
                    }
                }else{
                    $this->pdf->CellFitScale($w=30,12,'',1,1,'L');
                }
                
                 $this->pagebreak($this->pdf->GetY(),(18+(12*($data['stage_one_post_manufacturing_process']->num_rows()-$postmp))),210,10); //$currentY,$segment_height(rows*each_row_height) or exact height,$page_height,$bottom_margin
                $postmp++;
                
            }
        }
        
         ////////////////////////////////////////////////////////////Quality Control Process/////////////////////////////////////////////////////////////
        //$this->pagebreak($this->pdf->GetY(),(20+(12*$data['stage_one_quality_control_process']->num_rows())),210,10); //$currentY,$segment_height(rows*each_row_height) or exact height,$page_height,$bottom_margin
       
       $this->pdf->SetFont('Arial','B',12);
        
        $this->pdf->SetXY(10,$this->pdf->GetY()+5);
        $this->pdf->SetFillColor(217,217,217);
        $this->pdf->Cell(277,8,'Quality Control Process',1,1,'C',1);
        
        $this->pdf->SetFont('Arial','',10);
     
        $headingy = $this->pdf->GetY();
        $headingx = $this->pdf->GetX();
        $w = 0;
        
        $this->pdf->SetXY($headingx,$headingy);
        $this->pdf->CellFitScale($w=13,12,'Seq.#',1,0,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->CellFitScale($w=80,12,'Inspection (Or) Testing Description',1,0,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->CellFitScale($w=44,12,'WI #',1,0,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->CellFitScale($w=40,12,'QIR #/Report #',1,0,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->MultiCell($w=20,6,'Sample Quantity',1,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->CellFitScale($w=20,12,'Pass/Fail',1,0,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->CellFitScale($w=30,12,'Verified By',1,0,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->MultiCell($w=30,12,'Verified Date',1,'C');
        $qcp=0;
        foreach($data['stage_one_quality_control_process']->result_array() as $quality_control_process){
            $headingy = $this->pdf->GetY();
            $headingx = $this->pdf->GetX();
            $w = 0;
            
            $this->pdf->SetXY($headingx,$headingy);
            $this->pdf->CellFitScale($w=13,12,$quality_control_process['qcp_seq_number'],1,0,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->CellFitScale($w=80,12,$quality_control_process['qcp_process_inspection_or_testing_description'],1,0,'L');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->CellFitScale($w=44,12,$quality_control_process['qcp_wi_number'],1,0,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->CellFitScale($w=40,12,$quality_control_process['qcp_qir_number_or_report_number'],1,0,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->CellFitScale($w=20,12,$quality_control_process['qcp_sample_quantity'],1,0,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->CellFitScale($w=20,12,$quality_control_process['qcp_pass_or_fail'],1,0,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            if($quality_control_process['qcp_verified_by']!=''){
                $this->pdf->CellFitScale($w=30,6,'','LTR',1,'L');
                $this->pdf->SetX($headingx);
                $this->pdf->CellFitScale($w=30,6,$employee_details[$quality_control_process['qcp_verified_by']]['employee_short_name'],'LBR',0,'C');
                if(file_exists($employee_details[$quality_control_process['qcp_verified_by']]['signature'])){
                    $this->pdf->Image($employee_details[$quality_control_process['qcp_verified_by']]['signature'],$headingx+5,$headingy+1,15,6);
                }
            }else{
                $this->pdf->CellFitScale($w=30,12,'',1,0,'C');
            }
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->MultiCell($w=30,12,$quality_control_process['qcp_verified_date'],1,'C');
            
             $this->pagebreak($this->pdf->GetY(),(18+(12*($data['stage_one_quality_control_process']->num_rows()-$qcp))),210,10); //$currentY,$segment_height(rows*each_row_height) or exact height,$page_height,$bottom_margin
                $qcp++;
        }
            
            ////////////////////////////////////////////////////////////Finished Goods Transfer Note/////////////////////////////////////////////////////////////
            $this->pagebreak($this->pdf->GetY(),20,210,10); //$currentY,$segment_height(rows*each_row_height) or exact height,$page_height,$bottom_margin
       
            $this->pdf->SetFont('Arial','B',12);
            
            $this->pdf->SetXY(10,$this->pdf->GetY()+10);
            $this->pdf->SetFillColor(217,217,217);
            $this->pdf->Cell(277,8,'Finished Goods Transfer Note',1,1,'C',1);
            
                foreach($data['finished_goods_transfer_note']->result_array() as $f_g_transfer_note);
            
                $this->pdf->SetFont('Arial','',10);
                $fgtnwidth = 277/3;
                $this->pdf->CellFitScale($fgtnwidth,12,'Transferred Quantity : '.$f_g_transfer_note['transferred_quantity'],1,0,'L');
                
                $this->pdf->CellFitScale($fgtnwidth/2,12,'Transferred By (Sign) : '.$f_g_transfer_note['transferred_date'],'TLB',0,'L');
                $tqafterx = $this->pdf->GetX();
                if($f_g_transfer_note['transferred_by']!=''){
                    $this->pdf->CellFitScale($fgtnwidth/2,6,'','TR',1,'C');
                    if(file_exists($employee_details[$f_g_transfer_note['transferred_by']]['signature'])){
                        $this->pdf->Image($employee_details[$f_g_transfer_note['transferred_by']]['signature'],$tqafterx+15,$this->pdf->GetY()-5,15,6);
                    }
                    $this->pdf->SetXY($tqafterx,$this->pdf->GetY());
                    $this->pdf->CellFitScale($fgtnwidth/2,6,$employee_details[$f_g_transfer_note['transferred_by']]['employee_short_name'],'BR',0,'C');
                }else{
                    $this->pdf->CellFitScale($fgtnwidth/2,12,'','TRB',0,'C');
                    $this->pdf->SetXY($this->pdf->GetX(),$this->pdf->GetY()+6);
                }
                
                $this->pdf->SetXY($this->pdf->GetX(),$this->pdf->GetY()-6);
                $this->pdf->CellFitScale($fgtnwidth/2,12,'Accepted By (Sign) : '.$f_g_transfer_note['accepted_date'],'TLB',0,'L');
                $tqafterx = $this->pdf->GetX();
                if($f_g_transfer_note['accepted_by']!=''){
                    $this->pdf->CellFitScale($fgtnwidth/2,6,'','TR',1,'C');
                    if(file_exists($employee_details[$f_g_transfer_note['accepted_by']]['signature'])){
                        $this->pdf->Image($employee_details[$f_g_transfer_note['accepted_by']]['signature'],$tqafterx+15,$this->pdf->GetY()-5,15,6);
                    }
                    $this->pdf->SetXY($tqafterx,$this->pdf->GetY());
                    $this->pdf->CellFitScale($fgtnwidth/2,6,$employee_details[$f_g_transfer_note['accepted_by']]['employee_short_name'],'BR',1,'C');
                }else{
                    $this->pdf->CellFitScale($fgtnwidth/2,12,'','TRB',1,'C');
                }
                
            
            
        ////////////////////////////////////////////////////////////Material Reconciliation/////////////////////////////////////////////////////////////
        $this->pagebreak($this->pdf->GetY(),(20+(12*$data['stage_one_material_reconciliation']->num_rows())),210,10); //$currentY,$segment_height(rows*each_row_height) or exact height,$page_height,$bottom_margin
       
        //$this->pdf->AddPage('L','','A4');
        //$this->pdf->SetAutoPageBreak(1);
        // $this->pdf->SetFont('Arial','B',12);
        // $this->pdf->Image(LOGO_PATH,20,10,25,10);
        // $this->pdf->Cell(50,10,'',1,0,'C');
        // $this->pdf->Cell(227,10,'Device History Record',1,1,'C');
        
        $this->pdf->SetFont('Arial','B',12);
        
        $this->pdf->SetXY(10,$this->pdf->GetY()+0);
        $this->pdf->SetFillColor(217,217,217);
        $this->pdf->Cell(277,8,'Material Reconciliation',1,1,'C',1);
        
        $this->pdf->SetFont('Arial','',10);
     
        $headingy = $this->pdf->GetY();
        $headingx = $this->pdf->GetX();
        $w = 0;
        
        $this->pdf->SetXY($headingx,$headingy);
        $this->pdf->CellFitScale($w=22,12,'Item. #',1,0,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->CellFitScale($w=65,12,'Description',1,0,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->CellFitScale($w=20,12,'UOM',1,0,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->MultiCell($w=20,6,'Quantity Received',1,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->MultiCell($w=20,12,'QIR #',1,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->MultiCell($w=20,6,'Item Lot # (Input Lot)',1,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->CellFitScale($w=30,12,'Returned By',1,0,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->MultiCell($w=30,12,'Received By',1,'C');
        
         $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->MultiCell($w=20,12,'Date',1,'C');
        
         $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->MultiCell($w=30,12,'Remarks',1,'C');
        
        
        $mrec=0;
        foreach($data['stage_one_material_reconciliation']->result_array() as $material_reconciliation){
            $headingy = $this->pdf->GetY();
                $headingx = $this->pdf->GetX();
                $w = 0;
                
                $this->pdf->SetXY($headingx,$headingy);
                $this->pdf->CellFitScale($w=22,12,$material_reconciliation['mrec_item_number'],1,0,'C');
                
                $this->pdf->SetXY($headingx+=$w,$headingy);
                $this->pdf->CellFitScale($w=65,12,$material_reconciliation['mrec_description'],1,0,'L');
                
                $this->pdf->SetXY($headingx+=$w,$headingy);
                $this->pdf->CellFitScale($w=20,12,$material_reconciliation['mrec_uom'],1,0,'C');
                
                $this->pdf->SetXY($headingx+=$w,$headingy);
                $this->pdf->MultiCell($w=20,12,$material_reconciliation['mrec_quantity_received'],1,'C');
                
                $this->pdf->SetXY($headingx+=$w,$headingy);
                $this->pdf->MultiCell($w=20,12,$material_reconciliation['mrec_qir_number'],1,'C');
                
                $this->pdf->SetXY($headingx+=$w,$headingy);
                $this->pdf->CellFitScale($w=20,12,$material_reconciliation['mrec_item_lot_number_or_input_lot'],1,0,'C');
                
                $this->pdf->SetXY($headingx+=$w,$headingy);
                if($material_reconciliation['mrec_returned_by']!=''){
                    $this->pdf->CellFitScale($w=30,6,'','LTR',1,'L');
                    $this->pdf->SetX($headingx);
                    $this->pdf->CellFitScale($w=30,6,$employee_details[$material_reconciliation['mrec_returned_by']]['employee_short_name'],'LBR',0,'C');
                    if(file_exists($employee_details[$material_reconciliation['mrec_returned_by']]['signature'])){
                        $this->pdf->Image($employee_details[$material_reconciliation['mrec_returned_by']]['signature'],$headingx+8,$headingy+1,15,6);
                    }
                }else{
                    $this->pdf->CellFitScale($w=30,12,'',1,0,'L');
                }
                
                $this->pdf->SetXY($headingx+=$w,$headingy);
                if($material_reconciliation['mrec_received_by']!=''){
                    $this->pdf->CellFitScale($w=30,6,'','LTR',1,'L');
                    $this->pdf->SetX($headingx);
                    $this->pdf->CellFitScale($w=30,6,$employee_details[$material_reconciliation['mrec_received_by']]['employee_short_name'],'LBR',0,'C');
                    if(file_exists($employee_details[$material_reconciliation['mrec_received_by']]['signature'])){
                        $this->pdf->Image($employee_details[$material_reconciliation['mrec_received_by']]['signature'],$headingx+8,$headingy+1,15,6);
                    }
                }else{
                    $this->pdf->CellFitScale($w=30,12,'',1,0,'L');
                }
                
                
                 $this->pdf->SetXY($headingx+=$w,$headingy);
                $this->pdf->CellFitScale($w=20,12,$material_reconciliation['mrec_date'],1,0,'C');
                
                 $this->pdf->SetXY($headingx+=$w,$headingy);
                $this->pdf->MultiCell($w=30,12,$material_reconciliation['mrec_remark'],1,'C');
                
                 $this->pagebreak($this->pdf->GetY(),(18+(12*($data['stage_one_material_reconciliation']->num_rows()-$mrec))),210,10); //$currentY,$segment_height(rows*each_row_height) or exact height,$page_height,$bottom_margin
                $mrec++;
            }
            
             ////////////////////////////////////////////////////////////Finished Goods Reconciliation/////////////////////////////////////////////////////////////
             
              $this->pagebreak($this->pdf->GetY(),(8*6)+36,210,10); //$currentY,$segment_height(rows*each_row_height) or exact height,$page_height,$bottom_margin
       
           
            $this->pdf->SetFont('Arial','B',12);
            
            $this->pdf->SetXY(10,$this->pdf->GetY()+10);
            $this->pdf->SetFillColor(217,217,217);
            $this->pdf->Cell(277,8,'Finished Goods Reconciliation',1,1,'C',1);
            
            $this->pdf->SetFont('Arial','',10);
            foreach($data['stage_one_finished_goods_reconcillation']->result_array() as $finished_goods_reconcillation);
            $fgrwidth = 277/2;
            $this->pdf->Cell($fgrwidth,8,'Total Quantity Produced and Packed',1,0,'L'); 
            $this->pdf->Cell($fgrwidth,8,$finished_goods_reconcillation['total_quantity_produced_and_packed'],1,1,'L');
            $this->pdf->Cell($fgrwidth,8,'Archive Samples Quantity',1,0,'L'); 
            $this->pdf->Cell($fgrwidth,8,$finished_goods_reconcillation['archive_samples_quantity'],1,1,'L');
            $this->pdf->Cell($fgrwidth,8,'Rejected Quantity',1,0,'L');
            $this->pdf->Cell($fgrwidth,8,$finished_goods_reconcillation['rejected_quantity'],1,1,'L');
            $this->pdf->Cell($fgrwidth,8,'Yield (Percentage)',1,0,'L');
            $this->pdf->Cell($fgrwidth,8,$finished_goods_reconcillation['yield_percentage'].'%',1,1,'L');
            
            $this->pdf->SetFont('Arial','B',10);
            $this->pdf->SetXY(10,$this->pdf->GetY()+5);
            $this->pdf->SetFillColor(217,217,217);
          
            $this->pdf->CellFitScale($fgrwidth/2,12,'Verified By - Production Head (Signature) '.$finished_goods_reconcillation['production_verified_date'],'LTB',0,'C');
            $tqafterx = $this->pdf->GetX();
            if($finished_goods_reconcillation['production_verified_by']!=''){
                $this->pdf->CellFitScale($fgrwidth/2,6,'','TR',1,'C');
                if(file_exists($employee_details[$finished_goods_reconcillation['production_verified_by']]['signature'])){
                    $this->pdf->Image($employee_details[$finished_goods_reconcillation['production_verified_by']]['signature'],$tqafterx+25,$this->pdf->GetY()-5,15,6);
                }
                $this->pdf->SetXY($tqafterx,$this->pdf->GetY());
                $this->pdf->CellFitScale($fgrwidth/2,6,$employee_details[$finished_goods_reconcillation['production_verified_by']]['employee_short_name'],'BR',0,'C');
            }else{
                $this->pdf->CellFitScale($fgrwidth/2,12,'','TRB',0,'C');
                $this->pdf->SetXY($this->pdf->GetX(),$this->pdf->GetY()+6);
            }
            
            $this->pdf->SetXY($this->pdf->GetX(),$this->pdf->GetY()-6);
            $this->pdf->CellFitScale($fgrwidth/2,12,'Checked By - Quality Control Head (Signature) '.$finished_goods_reconcillation['checked_by_quality_control_date'],'TLB',0,'L');
            $tqafterx = $this->pdf->GetX();
            if($finished_goods_reconcillation['checked_by_quality_control']!=''){
                $this->pdf->CellFitScale($fgrwidth/2,6,'','TR',1,'C');
                if(file_exists($employee_details[$finished_goods_reconcillation['checked_by_quality_control']]['signature'])){
                    $this->pdf->Image($employee_details[$finished_goods_reconcillation['checked_by_quality_control']]['signature'],$tqafterx+25,$this->pdf->GetY()-5,15,6);
                }
                $this->pdf->SetXY($tqafterx,$this->pdf->GetY());
                $this->pdf->CellFitScale($fgrwidth/2,6,$employee_details[$finished_goods_reconcillation['checked_by_quality_control']]['employee_short_name'],'BR',1,'C');
            }else{
                $this->pdf->CellFitScale($fgrwidth/2,12,'','TRB',1,'C');
            }
            
            
            $this->pdf->CellFitScale($fgrwidth,12,'Remarks:'.$finished_goods_reconcillation['production_verified_by_remarks'],1,0,'L');
            $this->pdf->CellFitScale($fgrwidth,12,'Remarks:'.$finished_goods_reconcillation['checked_by_quality_control_remark'],1,1,'L');
            
            ////////////////////////////////////////////////////////////QA Approval and Release/////////////////////////////////////////////////////////////
            $this->pagebreak($this->pdf->GetY(),24,210,10);
            
           $this->pdf->SetFont('Arial','B',12);
            
            $this->pdf->SetXY(10,$this->pdf->GetY()+10);
            $this->pdf->SetFillColor(217,217,217);
            $this->pdf->Cell(277,8,'QA Approval and Release',1,1,'C',1);
            
            $this->pdf->SetFont('Arial','',10);
            foreach($data['stage_one_qa_approval_and_release']->result_array() as $qa_approval_and_release);
            $qaarwidth = 277/4;
            $this->pdf->CellFitScale($qaarwidth,12,'Quantity Released for Dispatch',1,0,'L'); 
            $this->pdf->CellFitScale($qaarwidth,12,$qa_approval_and_release['quantity_released_for_dispatch'],1,0,'L');
            $this->pdf->CellFitScale($qaarwidth,12,'Date Of Release',1,0,'L'); 
            $this->pdf->CellFitScale($qaarwidth,12,$qa_approval_and_release['date_of_release'],1,1,'L');
            $this->pdf->CellFitScale($qaarwidth,12,'Remarks',1,0,'L');
            $this->pdf->CellFitScale($qaarwidth,12,$qa_approval_and_release['remarks'],1,0,'L');
            $this->pdf->CellFitScale($qaarwidth,12,'Signature',1,0,'L');
           
            $tqafterx = $this->pdf->GetX();
            if($qa_approval_and_release['signature']!=''){
                $this->pdf->CellFitScale($qaarwidth,6,'','TR',1,'C');
                if(file_exists($employee_details[$qa_approval_and_release['signature']]['signature'])){
                    $this->pdf->Image($employee_details[$qa_approval_and_release['signature']]['signature'],$tqafterx+25,$this->pdf->GetY()-5,15,6);
                }
                $this->pdf->SetXY($tqafterx,$this->pdf->GetY());
                $this->pdf->CellFitScale($qaarwidth,6,$employee_details[$qa_approval_and_release['signature']]['employee_short_name'],'BR',1,'C');
            }else{
                $this->pdf->CellFitScale($qaarwidth,12,'',1,1,'C');
            }
            
            $this->pdf->AliasNbPages();
        
        $this->pdf->Output();
        
    }
    
    function stage_two_form($dhr_id){
        $order_information = $bill_of_material   = $f_g_transfer_note   = $finished_goods_reconcillation = $qa_approval_and_release = $employee_details = $footer_note = NULL;
        
        $data = $this->ShahPDFM->stage_one_form_details($dhr_id);
        $employee_details=$data['employee_details'];
        foreach($data['stage_one_footer_note']->result_array() as $footer_note);
        foreach($data['stage_one_dhr_order_information']->result_array() as $order_information);
        
        
        // $data['stage_one_pre_manufacturing_process'];
        // $data['stage_one_manufacturing_process'];
        // $data['stage_one_post_manufacturing_process'];
        // $data['stage_one_quality_control_process'];
        // $data['finished_goods_transfer_note'];
        // $data['stage_one_material_reconciliation'];
        // $data['stage_one_finished_goods_reconcillation'];
        // $data['stage_one_qa_approval_and_release'];
        
        $this->pdf->setHeaderForNextPage(array('title'=>'Device History Record'));
        $this->pdf->setFooterForNextPage($footer_note);
        $this->pdf->AddPage('L','','A4');
        $this->pdf->SetAutoPageBreak(0);
        // $this->pdf->SetFont('Arial','B',12);
        // $this->pdf->Image(LOGO_PATH,20,10,25,10);
        // $this->pdf->Cell(50,10,'',1,0,'C');
        // $this->pdf->Cell(227,10,'Device History Record',1,1,'C');
        
        ////////////////////////////////////////////////////////////Order Information/////////////////////////////////////////////////////////////
        $this->pdf->SetXY(10,$this->pdf->GetY()+0);
        $this->pdf->SetFillColor(217,217,217);
        $this->pdf->Cell(277,8,'Order Information',1,1,'C',1);
        
        $this->pdf->SetFont('Arial','',10);
        
        $this->pdf->Cell(50,8,'Sales Order #',1,0,'L');
        $this->pdf->CellFitScale(125,8,$order_information['sales_order'],1,0,'L');
        $this->pdf->Cell(50,8,'Production Order #',1,0,'L');
        $this->pdf->CellFitScale(52,8,$order_information['production_order'],1,1,'L');
        
        $this->pdf->Cell(50,8,'Product Description',1,0,'L');
        $this->pdf->CellFitScale(227,8,$order_information['product_description'],1,1,'L');
        
        
        $this->pdf->Cell(50,8,'DHR #',1,0,'L');
        $this->pdf->CellFitScale(125,8,$order_information['dhr'],1,0,'L');
        $this->pdf->Cell(50,8,'Order Quantity',1,0,'L');
        $this->pdf->CellFitScale(52,8,$order_information['order_quantity'],1,1,'L');
        
        $this->pdf->Cell(50,8,'Batch/Lot #',1,0,'L');
        $this->pdf->CellFitScale(125,8,$order_information['batchorlot'],1,0,'L');
        $this->pdf->Cell(50,8,'Production Quantity',1,0,'L');
        $this->pdf->CellFitScale(52,8,$order_information['production_quantity'],1,1,'L');
         
        $this->pdf->Cell(50,8,'REF/Model #',1,0,'L');
        $this->pdf->CellFitScale(50,8,$order_information['reformodel'],1,0,'L');
        $this->pdf->Cell(40,8,'Manufacturing Date',1,0,'L');
        $this->pdf->CellFitScale(35,8,$order_information['manufacturing_date'],1,0,'L');
        $this->pdf->Cell(50,8,'Date of Commencement',1,0,'L');
        $this->pdf->CellFitScale(52,8,$order_information['date_of_commencement'],1,1,'L');
          
        $this->pdf->Cell(50,8,'Item Code',1,0,'L');
        $this->pdf->CellFitScale(50,8,$order_information['itemcode'],1,0,'L');
        $this->pdf->Cell(40,8,'Expiry Date',1,0,'L');
        $this->pdf->CellFitScale(35,8,$order_information['expiry_date'],1,0,'L');
        $this->pdf->Cell(50,8,'Date of Completion',1,0,'L');
        $this->pdf->CellFitScale(52,8,$order_information['date_of_completion'],1,1,'L');
        
        $dhr_issued_by_qa_employee_short_name = isset($employee_details[$order_information['dhr_issued_by_qa']]['employee_short_name'])?$employee_details[$order_information['dhr_issued_by_qa']]['employee_short_name']:'NA';
        $dhr_issued_by_qa_signature = isset($employee_details[$order_information['dhr_issued_by_qa']]['signature'])?$employee_details[$order_information['dhr_issued_by_qa']]['signature']:'NA';
       
        $this->pdf->CellFitScale(277/8,8,'DHR Issued by (QA)',1,0,'L');
        $this->pdf->CellFitScale(277/8,8,$dhr_issued_by_qa_employee_short_name,1,0,'L');
        if(file_exists($dhr_issued_by_qa_signature)){
            $this->pdf->Image($dhr_issued_by_qa_signature,70,$this->pdf->GetY(),10,8);
        }
        
         $this->pdf->CellFitScale(277/8,8,'DHR Issued Date (QA)',1,0,'L');
        $this->pdf->CellFitScale(277/8,8,$order_information['dhr_issued_date_qa'],1,0,'L');
        
        $dhr_received_by_production_employee_short_name = isset($employee_details[$order_information['dhr_received_by_production']]['employee_short_name'])?$employee_details[$order_information['dhr_received_by_production']]['employee_short_name']:'NA';
        $dhr_received_by_production_signature = isset($employee_details[$order_information['dhr_received_by_production']]['signature'])?$employee_details[$order_information['dhr_received_by_production']]['signature']:'NA';
        
        $this->pdf->CellFitScale(277/8,8,'DHR Received by (Production)',1,0,'L');
        $this->pdf->CellFitScale(277/8,8,$dhr_received_by_production_employee_short_name,1,0,'L');
        if(file_exists($dhr_received_by_production_signature)){
            $this->pdf->Image($dhr_received_by_production_signature,208,$this->pdf->GetY(),10,8);
        }
        
        $this->pdf->CellFitScale(277/8,8,'DHR Received Date (Production)',1,0,'L');
        $this->pdf->CellFitScale(277/8,8,$order_information['dhr_received_date_production'],1,1,'L');
        
        $this->pdf->SetFont('Arial','I',10);
        $this->pdf->Cell(277,8,'Note: Manufacturing and Expiry Date as per customer label.',0,1,'L');
        
        ////////////////////////////////////////////////////////////Bill of Material/////////////////////////////////////////////////////////////
        
        foreach($data['stage_one_dhr_bill_of_material']->result_array() as $bill_of_material);
        
        $this->pdf->SetFont('Arial','B',12);
        
        $this->pdf->SetXY(10,$this->pdf->GetY()+5);
        $this->pdf->SetFillColor(217,217,217);
        $this->pdf->Cell(277,8,'Bill of Material',1,1,'C',1);
        
        $this->pdf->SetFont('Arial','',10);
        
        $this->pdf->Cell(277,8,'Reference: '.$bill_of_material['reference'],1,1,'L',1);
        
        $headingy = $this->pdf->GetY();
        $headingx = $this->pdf->GetX();
        
        $this->pdf->SetXY($headingx,$headingy);
        $this->pdf->CellFitScale(23,10,'Item #',1,0,'C');
        
        $this->pdf->SetXY($headingx+=23,$headingy);
        $this->pdf->CellFitScale(55,10,'Description',1,0,'C');
        
        $this->pdf->SetXY($headingx+=55,$headingy);
        $this->pdf->CellFitScale(20,10,'UOM',1,0,'C');
        
        $this->pdf->SetXY($headingx+=20,$headingy);
        $this->pdf->MultiCell(20,5,'Qunatity Required',1,'C');
        
        $this->pdf->SetXY($headingx+=20,$headingy);
        $this->pdf->MultiCell(20,5,'Quantity Issued',1,'C');
        
        $this->pdf->SetXY($headingx+=20,$headingy);
        $this->pdf->CellFitScale(20,10,'QIR #',1,0,'C');
        
        $this->pdf->SetXY($headingx+=20,$headingy);
        $this->pdf->MultiCell(20,5,'Item Lot # (Input Lot)',1,'C');
        
        $this->pdf->SetXY($headingx+=20,$headingy);
        $this->pdf->CellFitScale(20,10,'Issued By',1,0,'C');
        
        $this->pdf->SetXY($headingx+=20,$headingy);
        $this->pdf->CellFitScale(20,10,'Received By',1,0,'C');
        
        $this->pdf->SetXY($headingx+=20,$headingy);
        $this->pdf->CellFitScale(25,10,'Date',1,0,'C');
        
        $this->pdf->SetXY($headingx+=25,$headingy);
        $this->pdf->CellFitScale(34,10,'Remarks',1,1,'C');
        
        foreach($data['stage_one_dhr_bill_of_material']->result_array() as $bill_of_material){
            $headingy = $this->pdf->GetY();
            $headingx = $this->pdf->GetX();
            
            $this->pdf->SetXY($headingx,$headingy);
            $this->pdf->CellFitScale(23,12,$bill_of_material['item_number'],1,0,'C');
            
            $this->pdf->SetXY($headingx+=23,$headingy);
            $this->pdf->CellFitScale(55,12,$bill_of_material['item_description'],1,0,'C');
            
            $this->pdf->SetXY($headingx+=55,$headingy);
            $this->pdf->CellFitScale(20,12,$bill_of_material['uom'],1,0,'C');
            
            $this->pdf->SetXY($headingx+=20,$headingy);
            $this->pdf->CellFitScale(20,12,$bill_of_material['quantity_required'],1,0,'C');
            
            $this->pdf->SetXY($headingx+=20,$headingy);
            $this->pdf->CellFitScale(20,12,$bill_of_material['quantity_issued'],1,0,'C');
            
            $this->pdf->SetXY($headingx+=20,$headingy);
            $this->pdf->CellFitScale(20,12,$bill_of_material['qir_number'],1,0,'C');
            
            $this->pdf->SetXY($headingx+=20,$headingy);
            $this->pdf->CellFitScale(20,12,$bill_of_material['item_lot_number'],1,0,'C');
            
            $this->pdf->SetXY($headingx+=20,$headingy);
             if($bill_of_material['issued_by']!=''){
                $this->pdf->CellFitScale(20,6,'','LTR',1,'L');
                $this->pdf->SetX($headingx);
                $this->pdf->CellFitScale(20,6,$employee_details[$bill_of_material['issued_by']]['employee_short_name'],'LBR',0,'C');
                if(file_exists($employee_details[$bill_of_material['issued_by']]['signature'])){
                    $this->pdf->Image($employee_details[$bill_of_material['issued_by']]['signature'],$headingx+2,$headingy+1,15,6);
                }
            }else{
                $this->pdf->CellFitScale(20,12,'',1,0,'L');
            }
            
            $this->pdf->SetXY($headingx+=20,$headingy);
             if($bill_of_material['received_by']!=''){
                $this->pdf->CellFitScale(20,6,'','LTR',1,'L');
                $this->pdf->SetX($headingx);
                $this->pdf->CellFitScale(20,6,$employee_details[$bill_of_material['received_by']]['employee_short_name'],'LBR',0,'C');
                if(file_exists($employee_details[$bill_of_material['received_by']]['signature'])){
                    $this->pdf->Image($employee_details[$bill_of_material['received_by']]['signature'],$headingx+2,$headingy+1,15,6);
                }
            }else{
                $this->pdf->CellFitScale(20,12,'',1,0,'L');
            }
            
            $this->pdf->SetXY($headingx+=20,$headingy);
            $this->pdf->CellFitScale(25,12,$bill_of_material['date'],1,0,'C');
            
            $this->pdf->SetXY($headingx+=25,$headingy);
            $this->pdf->CellFitScale(34,12,$bill_of_material['remarks'],1,1,'C');
            
        }
        
         ////////////////////////////////////////////////////////////Pre Manufacturing Process/////////////////////////////////////////////////////////////
         
        if($data['stage_one_pre_manufacturing_process']->num_rows()>0){
            $this->pdf->SetFont('Arial','B',12);
            
            $this->pdf->SetXY(10,$this->pdf->GetY()+5);
            $this->pdf->SetFillColor(217,217,217);
            $this->pdf->Cell(277,8,'Pre Manufacturing Process',1,1,'C',1);
            
            $this->pdf->SetFont('Arial','',10);
         
            $headingy = $this->pdf->GetY();
            $headingx = $this->pdf->GetX();
            $w = 0;
            
            $this->pdf->SetXY($headingx,$headingy);
            $this->pdf->CellFitScale($w=13,10,'Item #',1,0,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->CellFitScale($w=70,10,'Description',1,0,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->CellFitScale($w=20,10,'UOM',1,0,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->CellFitScale($w=20,10,'Qunatity',1,0,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->MultiCell($w=34,10,'WI #',1,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->MultiCell($w=30,10,'Equipment #',1,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->MultiCell($w=30,10,'Done By',1,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->MultiCell($w=30,10,'Verified By',1,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->MultiCell($w=30,10,'Date',1,'C');
            
            foreach($data['stage_one_pre_manufacturing_process']->result_array() as $pre_manufacturing_process){
                $headingy = $this->pdf->GetY();
                $headingx = $this->pdf->GetX();
                $w=0;
                
                    $this->pdf->SetXY($headingx,$headingy);
                    $this->pdf->CellFitScale($w=13,12,$pre_manufacturing_process['prmp_item_number'],1,0,'C');
                    
                    $this->pdf->SetXY($headingx+=$w,$headingy);
                    $this->pdf->CellFitScale($w=70,12,$pre_manufacturing_process['prmp_item_description'],1,0,'C');
                    
                    $this->pdf->SetXY($headingx+=$w,$headingy);
                    $this->pdf->CellFitScale($w=20,12,$pre_manufacturing_process['prmp_uom'],1,0,'C');
                    
                    $this->pdf->SetXY($headingx+=$w,$headingy);
                    $this->pdf->CellFitScale($w=20,12,$pre_manufacturing_process['prmp_qunatity'],1,0,'C');
                    
                    $this->pdf->SetXY($headingx+=$w,$headingy);
                    $this->pdf->MultiCell($w=34,12,$pre_manufacturing_process['prmp_wi_number'],1,'C');
                    
                    $this->pdf->SetXY($headingx+=$w,$headingy);
                    $this->pdf->MultiCell($w=30,12,$pre_manufacturing_process['prmp_equipment_number'],1,'C');
                    
                    $this->pdf->SetXY($headingx+=$w,$headingy);
                     if($pre_manufacturing_process['prmp_done_by']!=''){
                        $this->pdf->CellFitScale($w=30,6,'','LTR',1,'L');
                        $this->pdf->SetX($headingx);
                        $this->pdf->CellFitScale($w=30,6,$pre_manufacturing_process['prmp_done_by'],'LBR',0,'C');
                       
                    }else{
                        $this->pdf->CellFitScale($w=30,12,'',1,0,'L');
                    }
                    
                    $this->pdf->SetXY($headingx+=$w,$headingy);
                    if($pre_manufacturing_process['prmp_verified_by']!=''){
                        $this->pdf->CellFitScale($w=30,6,'','LTR',1,'L');
                        $this->pdf->SetX($headingx);
                        $this->pdf->CellFitScale($w=30,6,$employee_details[$pre_manufacturing_process['prmp_verified_by']]['employee_short_name'],'LBR',0,'C');
                        if(file_exists($employee_details[$pre_manufacturing_process['prmp_verified_by']]['signature'])){
                            $this->pdf->Image($employee_details[$pre_manufacturing_process['prmp_verified_by']]['signature'],$headingx+2,$headingy+1,15,6);
                        }
                    }else{
                        $this->pdf->CellFitScale($w=30,12,'',1,0,'L');
                    }
                    
                    $this->pdf->SetXY($headingx+=$w,$headingy);
                    $this->pdf->MultiCell($w=30,12,$pre_manufacturing_process['prmp_date'],1,'C');
                }
        }
            
       ///////////////////////////////////////////////////////////////////////Manufacturing Process/////////////////////////////////////////////////////////////////////////// 
        $this->pdf->AddPage('L','','A4');
        $this->pdf->SetAutoPageBreak(0);
        // $this->pdf->SetFont('Arial','B',12);
        // $this->pdf->Image(LOGO_PATH,20,10,25,10);
        // $this->pdf->Cell(50,10,'',1,0,'C');
        // $this->pdf->Cell(227,10,'Device History Record',1,1,'C');
        
        $this->pdf->SetFont('Arial','B',12);
        
        $this->pdf->SetXY(10,$this->pdf->GetY()+0);
        $this->pdf->SetFillColor(217,217,217);
        $this->pdf->Cell(277,8,'Manufacturing Process',1,1,'C',1);
        
        $this->pdf->SetFont('Arial','',10);
     
        $headingy = $this->pdf->GetY();
        $headingx = $this->pdf->GetX();
        $w = 0;
        
        $this->pdf->SetXY($headingx,$headingy);
        $this->pdf->CellFitScale($w=13,12,'Seq.#',1,0,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->CellFitScale($w=55,12,'Process Description',1,0,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->CellFitScale($w=24.5,12,'WI #',1,0,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->CellFitScale($w=24.5,12,'Equipment #',1,0,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->MultiCell($w=20,6,'Start'.PHP_EOL.'Date/Time',1,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->MultiCell($w=20,6,'End'.PHP_EOL.'Date/Time',1,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->MultiCell($w=25,6,'Manufactured'.PHP_EOL.'Quantity',1,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->MultiCell($w=18,6,'Good'.PHP_EOL.'Quantity',1,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->MultiCell($w=20,6,'Rejected'.PHP_EOL.'Quantity',1,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->MultiCell($w=19,6,'Done'.PHP_EOL.'By',1,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->MultiCell($w=19,6,'Verified'.PHP_EOL.'By',1,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->MultiCell($w=19,4,'Line'.PHP_EOL.'Clearance By',1,'C');
        
        foreach($data['stage_one_manufacturing_process']->result_array() as $manufacturing_process){
            $headingy = $this->pdf->GetY();
            $headingx = $this->pdf->GetX();
            $w=0;
            $this->pdf->SetXY($headingx,$headingy);
            $this->pdf->CellFitScale($w=13,12,$manufacturing_process['mp_seq_number'],1,0,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->CellFitScale($w=55,12,$manufacturing_process['mp_process_description'],1,0,'L');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->CellFitScale($w=24.5,12,$manufacturing_process['mp_wi_number'],1,0,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->CellFitScale($w=24.5,12,$manufacturing_process['mp_equipment_number'],1,0,'C');
            
            $this->pdf->SetFont('Arial','',9);
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $mpsdt = explode(' ',$manufacturing_process['mp_start_datetime']);
            $this->pdf->MultiCell($w=20,($manufacturing_process['mp_start_datetime']=='NA'?12:6),implode(PHP_EOL,$mpsdt),1,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $mpedt = explode(' ',$manufacturing_process['mp_end_datetime']);
            $this->pdf->MultiCell($w=20,($manufacturing_process['mp_end_datetime']=='NA'?12:6),implode(PHP_EOL,$mpedt),1,'C');
            $this->pdf->SetFont('Arial','',10);
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->CellFitScale($w=25,12,$manufacturing_process['mp_manufactured_qunatity'],1,0,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->CellFitScale($w=18,12,$manufacturing_process['mp_good_qunatity'],1,0,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->CellFitScale($w=20,12,$manufacturing_process['mp_rejected_qunatity'],1,0,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            if($manufacturing_process['mp_done_by']!=''){
                $this->pdf->CellFitScale($w=19,6,'','LTR',1,'L');
                $this->pdf->SetX($headingx);
                $this->pdf->CellFitScale($w=19,6,$manufacturing_process['mp_done_by'],'LBR',0,'C');
               
            }else{
                $this->pdf->CellFitScale($w=19,12,'',1,0,'L');
            }
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
             if($manufacturing_process['mp_verified_by']!=''){
                $this->pdf->CellFitScale($w=19,6,'','LTR',1,'L');
                $this->pdf->SetX($headingx);
                $this->pdf->CellFitScale($w=19,6,$employee_details[$manufacturing_process['mp_verified_by']]['employee_short_name'],'LBR',0,'C');
                if(file_exists($employee_details[$manufacturing_process['mp_verified_by']]['signature'])){
                    $this->pdf->Image($employee_details[$manufacturing_process['mp_verified_by']]['signature'],$headingx+2,$headingy+1,15,6);
                }
            }else{
                 $this->pdf->CellFitScale($w=19,12,'',1,0,'L');
            }
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            if($manufacturing_process['mp_line_clearance_by']!=''){
                $this->pdf->CellFitScale($w=19,6,'','LTR',1,'L');
                $this->pdf->SetX($headingx);
                $this->pdf->CellFitScale($w=19,6,$employee_details[$manufacturing_process['mp_line_clearance_by']]['employee_short_name'],'LBR',1,'C');
                if(file_exists($employee_details[$manufacturing_process['mp_line_clearance_by']]['signature'])){
                    $this->pdf->Image($employee_details[$manufacturing_process['mp_line_clearance_by']]['signature'],$headingx+2,$headingy+1,15,6);
                }
            }else{
                $this->pdf->CellFitScale($w=19,12,'',1,1,'L');
            }
        }
        
        /////////////////////////////////////////////////////////////Post manufacturing Process//////////////////////////////////////////////////////////////
         $this->pdf->AddPage('L','','A4');
        $this->pdf->SetAutoPageBreak(0);
        // $this->pdf->SetFont('Arial','B',12);
        // $this->pdf->Image(LOGO_PATH,20,10,25,10);
        // $this->pdf->Cell(50,10,'',1,0,'C');
        // $this->pdf->Cell(227,10,'Device History Record',1,1,'C');
        
        
        if($data['stage_one_post_manufacturing_process']->num_rows()>0){
            $this->pdf->SetFont('Arial','B',12);
            
            $this->pdf->SetXY(10,$this->pdf->GetY()+0);
            $this->pdf->SetFillColor(217,217,217);
            $this->pdf->Cell(277,8,'Post Manufacturing Process',1,1,'C',1);
            
            $this->pdf->SetFont('Arial','',10);
         
            $headingy = $this->pdf->GetY();
            $headingx = $this->pdf->GetX();
            $w = 0;
            
            
            $this->pdf->SetXY($headingx,$headingy);
            $this->pdf->CellFitScale($w=12,12,'Seq.#',1,0,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->CellFitScale($w=55,12,'Process Description',1,0,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->CellFitScale($w=30,12,'WI #',1,0,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->CellFitScale($w=30,12,'DCC # (If Applicable)',1,0,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->MultiCell($w=30,12,'Sent Date',1,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->MultiCell($w=30,12,'Cycle #/Report #',1,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->MultiCell($w=30,12,'Process Date',1,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->MultiCell($w=30,12,'Done By',1,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->MultiCell($w=30,12,'Checked By',1,'C');
            
            foreach($data['stage_one_post_manufacturing_process']->result_array() as $post_manufacturing_process){
                $headingy = $this->pdf->GetY();
                $headingx = $this->pdf->GetX();
                $w=0;
                $this->pdf->SetXY($headingx,$headingy);
                $this->pdf->CellFitScale($w=12,12,$post_manufacturing_process['pmp_seq_number'],1,0,'C');
                
                $this->pdf->SetXY($headingx+=$w,$headingy);
                $this->pdf->CellFitScale($w=55,12,$post_manufacturing_process['pmp_process_description'],1,0,'C');
                
                $this->pdf->SetXY($headingx+=$w,$headingy);
                $this->pdf->CellFitScale($w=30,12,$post_manufacturing_process['pmp_wi_number'],1,0,'C');
                
                $this->pdf->SetXY($headingx+=$w,$headingy);
                $this->pdf->CellFitScale($w=30,12,$post_manufacturing_process['pmp_dcc_number'],1,0,'C');
                
                $this->pdf->SetXY($headingx+=$w,$headingy);
                $this->pdf->MultiCell($w=30,12,$post_manufacturing_process['pmp_sent_date'],1,'C');
                
                $this->pdf->SetXY($headingx+=$w,$headingy);
                $this->pdf->CellFitScale($w=30,12,$post_manufacturing_process['pmp_cycle_number_or_report_number'],1,0,'C');
                
                $this->pdf->SetXY($headingx+=$w,$headingy);
                $this->pdf->MultiCell($w=30,12,$post_manufacturing_process['pmp_process_date'],1,'C');
                
                $this->pdf->SetXY($headingx+=$w,$headingy);
                if($post_manufacturing_process['pmp_done_by']!=''){
                    $this->pdf->CellFitScale($w=30,6,'','LTR',1,'L');
                    $this->pdf->SetX($headingx);
                    $this->pdf->CellFitScale($w=30,6,$post_manufacturing_process['pmp_done_by'],'LBR',0,'C');
                   
                }else{
                   $this->pdf->CellFitScale($w=30,12,'',1,0,'L'); 
                }
                
                $this->pdf->SetXY($headingx+=$w,$headingy);
                if($post_manufacturing_process['pmp_checked_by']!=''){
                    $this->pdf->CellFitScale($w=30,6,'','LTR',1,'L');
                    $this->pdf->SetX($headingx);
                    $this->pdf->CellFitScale($w=30,6,$employee_details[$post_manufacturing_process['pmp_checked_by']]['employee_short_name'],'LBR',1,'C');
                    if(file_exists($employee_details[$post_manufacturing_process['pmp_checked_by']]['signature'])){
                        $this->pdf->Image($employee_details[$post_manufacturing_process['pmp_checked_by']]['signature'],$headingx+2,$headingy+1,15,6);
                    }
                }else{
                    $this->pdf->CellFitScale($w=30,12,'',1,1,'L');
                }
            }
        }
        
         ////////////////////////////////////////////////////////////Quality Control Process/////////////////////////////////////////////////////////////
       
       $this->pdf->SetFont('Arial','B',12);
        
        $this->pdf->SetXY(10,$this->pdf->GetY()+5);
        $this->pdf->SetFillColor(217,217,217);
        $this->pdf->Cell(277,8,'Quality Control Process',1,1,'C',1);
        
        $this->pdf->SetFont('Arial','',10);
     
        $headingy = $this->pdf->GetY();
        $headingx = $this->pdf->GetX();
        $w = 0;
        
        $this->pdf->SetXY($headingx,$headingy);
        $this->pdf->CellFitScale($w=13,12,'Seq.#',1,0,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->CellFitScale($w=80,12,'Inspection (Or) Testing Description',1,0,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->CellFitScale($w=44,12,'WI #',1,0,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->CellFitScale($w=40,12,'QIR #/Report #',1,0,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->MultiCell($w=20,6,'Sample Quantity',1,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->CellFitScale($w=20,12,'Pass/Fail',1,0,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->CellFitScale($w=30,12,'Verified By',1,0,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->MultiCell($w=30,12,'Verified Date',1,'C');
        
        foreach($data['stage_one_quality_control_process']->result_array() as $quality_control_process){
            $headingy = $this->pdf->GetY();
            $headingx = $this->pdf->GetX();
            $w = 0;
            
            $this->pdf->SetXY($headingx,$headingy);
            $this->pdf->CellFitScale($w=13,12,$quality_control_process['qcp_seq_number'],1,0,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->CellFitScale($w=80,12,$quality_control_process['qcp_process_inspection_or_testing_description'],1,0,'L');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->CellFitScale($w=44,12,$quality_control_process['qcp_wi_number'],1,0,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->CellFitScale($w=40,12,$quality_control_process['qcp_qir_number_or_report_number'],1,0,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->CellFitScale($w=20,12,$quality_control_process['qcp_sample_quantity'],1,0,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->CellFitScale($w=20,12,$quality_control_process['qcp_pass_or_fail'],1,0,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
             if($quality_control_process['qcp_verified_by']!=''){
                $this->pdf->CellFitScale($w=30,6,'','LTR',1,'L');
                $this->pdf->SetX($headingx);
                $this->pdf->CellFitScale($w=30,6,isset($employee_details[$quality_control_process['qcp_verified_by'] ?? ''])?$employee_details[$quality_control_process['qcp_verified_by']]['employee_short_name']:'','LBR',0,'C');
                if(file_exists(isset($employee_details[$quality_control_process['qcp_verified_by'] ?? ''])?$employee_details[$quality_control_process['qcp_verified_by']]['signature']:'')){
                    $this->pdf->Image($employee_details[$quality_control_process['qcp_verified_by']]['signature'],$headingx+5,$headingy+1,15,6);
                }
            }else{
                $this->pdf->CellFitScale($w=30,12,'',1,0,'C');
            }
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->MultiCell($w=30,12,$quality_control_process['qcp_verified_date'],1,'C');
            
        }
            
            ////////////////////////////////////////////////////////////Finished Goods Transfer Note/////////////////////////////////////////////////////////////
            $this->pdf->SetFont('Arial','B',12);
            
            $this->pdf->SetXY(10,$this->pdf->GetY()+10);
            $this->pdf->SetFillColor(217,217,217);
            $this->pdf->Cell(277,8,'Finished Goods Transfer Note',1,1,'C',1);
            
                foreach($data['finished_goods_transfer_note']->result_array() as $f_g_transfer_note);
            
                $this->pdf->SetFont('Arial','',10);
                
                $fgtnwidth = 277/3;
                $this->pdf->CellFitScale($fgtnwidth,12,'Transferred Quantity : '.$f_g_transfer_note['transferred_quantity'],1,0,'L');
                
                $this->pdf->CellFitScale($fgtnwidth/2,12,'Transferred By (Sign) : '.$f_g_transfer_note['transferred_date'],'TLB',0,'L');
                $tqafterx = $this->pdf->GetX();
                if($f_g_transfer_note['transferred_by']!=''){
                    $this->pdf->CellFitScale($fgtnwidth/2,6,'','TR',1,'C');
                    if(file_exists($employee_details[$f_g_transfer_note['transferred_by']]['signature'])){
                        $this->pdf->Image($employee_details[$f_g_transfer_note['transferred_by']]['signature'],$tqafterx+15,$this->pdf->GetY()-5,15,6);
                    }
                    $this->pdf->SetXY($tqafterx,$this->pdf->GetY());
                    $this->pdf->CellFitScale($fgtnwidth/2,6,$employee_details[$f_g_transfer_note['transferred_by']]['employee_short_name'],'BR',0,'C');
                }else{
                    $this->pdf->CellFitScale($fgtnwidth/2,12,'','TRB',0,'C');
                    $this->pdf->SetXY($this->pdf->GetX(),$this->pdf->GetY()+6);
                }
                
                $this->pdf->SetXY($this->pdf->GetX(),$this->pdf->GetY()-6);
                $this->pdf->CellFitScale($fgtnwidth/2,12,'Accepted By (Sign) : '.$f_g_transfer_note['accepted_date'],'TLB',0,'L');
                $tqafterx = $this->pdf->GetX();
                if($f_g_transfer_note['accepted_by']!=''){
                    $this->pdf->CellFitScale($fgtnwidth/2,6,'','TR',1,'C');
                    if(file_exists($employee_details[$f_g_transfer_note['accepted_by']]['signature'])){
                        $this->pdf->Image($employee_details[$f_g_transfer_note['accepted_by']]['signature'],$tqafterx+15,$this->pdf->GetY()-5,15,6);
                    }
                    $this->pdf->SetXY($tqafterx,$this->pdf->GetY());
                    $this->pdf->CellFitScale($fgtnwidth/2,6,$employee_details[$f_g_transfer_note['accepted_by']]['employee_short_name'],'BR',1,'C');
                }else{
                    $this->pdf->CellFitScale($fgtnwidth/2,12,'','TRB',1,'C');
                }
            
            
        ////////////////////////////////////////////////////////////Material Reconciliation/////////////////////////////////////////////////////////////
       
        $this->pdf->AddPage('L','','A4');
        $this->pdf->SetAutoPageBreak(0);
        // $this->pdf->SetFont('Arial','B',12);
        // $this->pdf->Image(LOGO_PATH,20,10,25,10);
        // $this->pdf->Cell(50,10,'',1,0,'C');
        // $this->pdf->Cell(227,10,'Device History Record',1,1,'C');
        
        $this->pdf->SetFont('Arial','B',12);
        
        $this->pdf->SetXY(10,$this->pdf->GetY()+0);
        $this->pdf->SetFillColor(217,217,217);
        $this->pdf->Cell(277,8,'Material Reconciliation',1,1,'C',1);
        
        $this->pdf->SetFont('Arial','',10);
     
        $headingy = $this->pdf->GetY();
        $headingx = $this->pdf->GetX();
        $w = 0;
        
        $this->pdf->SetXY($headingx,$headingy);
        $this->pdf->CellFitScale($w=22,12,'Item. #',1,0,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->CellFitScale($w=65,12,'Description',1,0,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->CellFitScale($w=20,12,'UOM',1,0,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->MultiCell($w=20,6,'Quantity Received',1,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->MultiCell($w=20,12,'QIR #',1,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->MultiCell($w=20,6,'Item Lot # (Input Lot)',1,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->CellFitScale($w=30,12,'Returned By',1,0,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->MultiCell($w=30,12,'Received By',1,'C');
        
         $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->MultiCell($w=20,12,'Date',1,'C');
        
         $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->MultiCell($w=30,12,'Remarks',1,'C');
        
        
        
        foreach($data['stage_one_material_reconciliation']->result_array() as $material_reconciliation){
            $headingy = $this->pdf->GetY();
                $headingx = $this->pdf->GetX();
                $w = 0;
                
                $this->pdf->SetXY($headingx,$headingy);
                $this->pdf->CellFitScale($w=22,12,$material_reconciliation['mrec_item_number'],1,0,'C');
                
                $this->pdf->SetXY($headingx+=$w,$headingy);
                $this->pdf->CellFitScale($w=65,12,$material_reconciliation['mrec_description'],1,0,'L');
                
                $this->pdf->SetXY($headingx+=$w,$headingy);
                $this->pdf->CellFitScale($w=20,12,$material_reconciliation['mrec_uom'],1,0,'C');
                
                $this->pdf->SetXY($headingx+=$w,$headingy);
                $this->pdf->MultiCell($w=20,12,$material_reconciliation['mrec_quantity_received'],1,'C');
                
                $this->pdf->SetXY($headingx+=$w,$headingy);
                $this->pdf->MultiCell($w=20,12,$material_reconciliation['mrec_qir_number'],1,'C');
                
                $this->pdf->SetXY($headingx+=$w,$headingy);
                $this->pdf->CellFitScale($w=20,12,$material_reconciliation['mrec_item_lot_number_or_input_lot'],1,0,'C');
                
                $this->pdf->SetXY($headingx+=$w,$headingy);
                if($material_reconciliation['mrec_returned_by']!=''){
                    $this->pdf->CellFitScale($w=30,6,'','LTR',1,'L');
                    $this->pdf->SetX($headingx);
                    $this->pdf->CellFitScale($w=30,6,$employee_details[$material_reconciliation['mrec_returned_by']]['employee_short_name'],'LBR',0,'C');
                    if(file_exists($employee_details[$material_reconciliation['mrec_returned_by']]['signature'])){
                        $this->pdf->Image($employee_details[$material_reconciliation['mrec_returned_by']]['signature'],$headingx+8,$headingy+1,15,6);
                    }
                }else{
                    $this->pdf->CellFitScale($w=30,12,'',1,0,'L');
                }
                
                $this->pdf->SetXY($headingx+=$w,$headingy);
                if($material_reconciliation['mrec_received_by']!=''){
                    $this->pdf->CellFitScale($w=30,6,'','LTR',1,'L');
                    $this->pdf->SetX($headingx);
                    $this->pdf->CellFitScale($w=30,6,$employee_details[$material_reconciliation['mrec_received_by']]['employee_short_name'],'LBR',0,'C');
                    if(file_exists($employee_details[$material_reconciliation['mrec_received_by']]['signature'])){
                        $this->pdf->Image($employee_details[$material_reconciliation['mrec_received_by']]['signature'],$headingx+8,$headingy+1,15,6);
                    }
                }else{
                    $this->pdf->CellFitScale($w=30,12,'',1,0,'L');
                }
                
                 $this->pdf->SetXY($headingx+=$w,$headingy);
                $this->pdf->CellFitScale($w=20,12,$material_reconciliation['mrec_date'],1,0,'C');
                
                 $this->pdf->SetXY($headingx+=$w,$headingy);
                $this->pdf->MultiCell($w=30,12,$material_reconciliation['mrec_remark'],1,'C');
            }
            
             ////////////////////////////////////////////////////////////Finished Goods Reconciliation/////////////////////////////////////////////////////////////
           
            $this->pdf->SetFont('Arial','B',12);
            
            $this->pdf->SetXY(10,$this->pdf->GetY()+10);
            $this->pdf->SetFillColor(217,217,217);
            $this->pdf->Cell(277,8,'Finished Goods Reconciliation',1,1,'C',1);
            
            $this->pdf->SetFont('Arial','',10);
            foreach($data['stage_one_finished_goods_reconcillation']->result_array() as $finished_goods_reconcillation);
             $fgrwidth = 277/2;
            $this->pdf->Cell($fgrwidth,8,'Total Quantity Produced and Packed',1,0,'L'); 
            $this->pdf->Cell($fgrwidth,8,$finished_goods_reconcillation['total_quantity_produced_and_packed'],1,1,'L');
            $this->pdf->Cell($fgrwidth,8,'EP Archive Samples Quantity',1,0,'L'); 
            $this->pdf->Cell($fgrwidth,8,$finished_goods_reconcillation['ep_archive_samples_quantity'],1,1,'L');
            $this->pdf->Cell($fgrwidth,8,'Production Archive Samples Quantity',1,0,'L'); 
            $this->pdf->Cell($fgrwidth,8,$finished_goods_reconcillation['production_archive_samples_quantity'],1,1,'L');
            $this->pdf->Cell($fgrwidth,8,'Rejected Quantity',1,0,'L');
            $this->pdf->Cell($fgrwidth,8,$finished_goods_reconcillation['rejected_quantity'],1,1,'L');
            $this->pdf->Cell($fgrwidth,8,'Yield (Percentage)',1,0,'L');
            $this->pdf->Cell($fgrwidth,8,$finished_goods_reconcillation['yield_percentage'].'%',1,1,'L');
            
            $this->pdf->SetFont('Arial','B',10);
            $this->pdf->SetXY(10,$this->pdf->GetY()+5);
            $this->pdf->SetFillColor(217,217,217);
          
            $this->pdf->CellFitScale($fgrwidth/2,12,'Verified By - Production Head (Signature) '.$finished_goods_reconcillation['production_verified_date'],'LTB',0,'C');
            $tqafterx = $this->pdf->GetX();
            if($finished_goods_reconcillation['production_verified_by']!=''){
                $this->pdf->CellFitScale($fgrwidth/2,6,'','TR',1,'C');
                if(file_exists($employee_details[$finished_goods_reconcillation['production_verified_by']]['signature'])){
                    $this->pdf->Image($employee_details[$finished_goods_reconcillation['production_verified_by']]['signature'],$tqafterx+25,$this->pdf->GetY()-5,15,6);
                }
                $this->pdf->SetXY($tqafterx,$this->pdf->GetY());
                $this->pdf->CellFitScale($fgrwidth/2,6,$employee_details[$finished_goods_reconcillation['production_verified_by']]['employee_short_name'],'BR',0,'C');
            }else{
                $this->pdf->CellFitScale($fgrwidth/2,12,'','TRB',0,'C');
                $this->pdf->SetXY($this->pdf->GetX(),$this->pdf->GetY()+6);
            }
            
            $this->pdf->SetXY($this->pdf->GetX(),$this->pdf->GetY()-6);
            $this->pdf->CellFitScale($fgrwidth/2,12,'Checked By - Quality Control Head (Signature) '.$finished_goods_reconcillation['checked_by_quality_control_date'],'TLB',0,'L');
            $tqafterx = $this->pdf->GetX();
            if($finished_goods_reconcillation['checked_by_quality_control']!=''){
                $this->pdf->CellFitScale($fgrwidth/2,6,'','TR',1,'C');
                if(file_exists($employee_details[$finished_goods_reconcillation['checked_by_quality_control']]['signature'])){
                    $this->pdf->Image($employee_details[$finished_goods_reconcillation['checked_by_quality_control']]['signature'],$tqafterx+25,$this->pdf->GetY()-5,15,6);
                }
                $this->pdf->SetXY($tqafterx,$this->pdf->GetY());
                $this->pdf->CellFitScale($fgrwidth/2,6,$employee_details[$finished_goods_reconcillation['checked_by_quality_control']]['employee_short_name'],'BR',1,'C');
            }else{
                $this->pdf->CellFitScale($fgrwidth/2,12,'','TRB',1,'C');
            }
            
           
            $this->pdf->CellFitScale($fgrwidth,12,'Remarks:'.$finished_goods_reconcillation['production_verified_by_remarks'],1,0,'L');
            $this->pdf->CellFitScale($fgrwidth,12,'Remarks:'.$finished_goods_reconcillation['checked_by_quality_control_remark'],1,1,'L');
            
            ////////////////////////////////////////////////////////////QA Approval and Release/////////////////////////////////////////////////////////////
           
            $this->pdf->SetFont('Arial','B',12);
            
            $this->pdf->SetXY(10,$this->pdf->GetY()+10);
            $this->pdf->SetFillColor(217,217,217);
            $this->pdf->Cell(277,8,'QA Approval and Release',1,1,'C',1);
            
            $this->pdf->SetFont('Arial','',10);
            foreach($data['stage_one_qa_approval_and_release']->result_array() as $qa_approval_and_release);
            $qaarwidth = 277/4;
            $this->pdf->CellFitScale($qaarwidth,12,'Quantity Released for Dispatch',1,0,'L'); 
            $this->pdf->CellFitScale($qaarwidth,12,$qa_approval_and_release['quantity_released_for_dispatch'],1,0,'L');
            $this->pdf->CellFitScale($qaarwidth,12,'Date Of Release',1,0,'L'); 
            $this->pdf->CellFitScale($qaarwidth,12,$qa_approval_and_release['date_of_release'],1,1,'L');
            $this->pdf->CellFitScale($qaarwidth,12,'Remarks',1,0,'L');
            $this->pdf->CellFitScale($qaarwidth,12,$qa_approval_and_release['remarks'],1,0,'L');
            $this->pdf->CellFitScale($qaarwidth,12,'Signature',1,0,'L');
           
            $tqafterx = $this->pdf->GetX();
            if($qa_approval_and_release['signature']!=''){
                $this->pdf->CellFitScale($qaarwidth,6,'','TR',1,'C');
                if(file_exists($employee_details[$qa_approval_and_release['signature']]['signature'])){
                    $this->pdf->Image($employee_details[$qa_approval_and_release['signature']]['signature'],$tqafterx+25,$this->pdf->GetY()-5,15,6);
                }
                $this->pdf->SetXY($tqafterx,$this->pdf->GetY());
                $this->pdf->CellFitScale($qaarwidth,6,$employee_details[$qa_approval_and_release['signature']]['employee_short_name'],'BR',1,'C');
            }else{
                $this->pdf->CellFitScale($qaarwidth,12,'',1,1,'C');
            }
            
        $this->pdf->AliasNbPages();
        $this->pdf->Output();
        
    }
    
    function stage_three_form($dhr_id){
        $order_information = $bill_of_material   = $f_g_transfer_note   = $finished_goods_reconcillation = $qa_approval_and_release = $employee_details = $footer_note = NULL;
        
        $data = $this->ShahPDFM->stage_one_form_details($dhr_id);
        $employee_details=$data['employee_details'];
        foreach($data['stage_one_footer_note']->result_array() as $footer_note);
        foreach($data['stage_one_dhr_order_information']->result_array() as $order_information);
        
        
        // $data['stage_one_pre_manufacturing_process'];
        // $data['stage_one_manufacturing_process'];
        // $data['stage_one_post_manufacturing_process'];
        // $data['stage_one_quality_control_process'];
        // $data['finished_goods_transfer_note'];
        // $data['stage_one_material_reconciliation'];
        // $data['stage_one_finished_goods_reconcillation'];
        // $data['stage_one_qa_approval_and_release'];
        
        $this->pdf->setHeaderForNextPage(array('title'=>'Device History Record'));
        $this->pdf->setFooterForNextPage($footer_note);
        $this->pdf->AddPage('L','','A4');
        $this->pdf->SetAutoPageBreak(0);
        // $this->pdf->SetFont('Arial','B',12);
        // $this->pdf->Image(LOGO_PATH,20,10,25,10);
        // $this->pdf->Cell(50,10,'',1,0,'C');
        // $this->pdf->Cell(227,10,'Device History Record',1,1,'C');
        
        ////////////////////////////////////////////////////////////Order Information/////////////////////////////////////////////////////////////
        $this->pdf->SetXY(10,$this->pdf->GetY()+0);
        $this->pdf->SetFillColor(217,217,217);
        $this->pdf->Cell(277,8,'Order Information',1,1,'C',1);
        
        $this->pdf->SetFont('Arial','',10);
        
        $this->pdf->Cell(50,8,'Sales Order #',1,0,'L');
        $this->pdf->CellFitScale(125,8,$order_information['sales_order'],1,0,'L');
        $this->pdf->Cell(50,8,'Production Order #',1,0,'L');
        $this->pdf->CellFitScale(52,8,$order_information['production_order'],1,1,'L');
        
        $this->pdf->Cell(50,8,'Product Description',1,0,'L');
        $this->pdf->CellFitScale(227,8,$order_information['product_description'],1,1,'L');
        
        
        $this->pdf->Cell(50,8,'DHR #',1,0,'L');
        $this->pdf->CellFitScale(125,8,$order_information['dhr'],1,0,'L');
        $this->pdf->Cell(50,8,'Order Quantity',1,0,'L');
        $this->pdf->CellFitScale(52,8,$order_information['order_quantity'],1,1,'L');
        
        $this->pdf->Cell(50,8,'Batch/Lot #',1,0,'L');
        $this->pdf->CellFitScale(125,8,$order_information['batchorlot'],1,0,'L');
        $this->pdf->Cell(50,8,'Production Quantity',1,0,'L');
        $this->pdf->CellFitScale(52,8,$order_information['production_quantity'],1,1,'L');
         
        $this->pdf->Cell(50,8,'REF/Model #',1,0,'L');
        $this->pdf->CellFitScale(50,8,$order_information['reformodel'],1,0,'L');
        $this->pdf->Cell(40,8,'Manufacturing Date',1,0,'L');
        $this->pdf->CellFitScale(35,8,$order_information['manufacturing_date'],1,0,'L');
        $this->pdf->Cell(50,8,'Date of Commencement',1,0,'L');
        $this->pdf->CellFitScale(52,8,$order_information['date_of_commencement'],1,1,'L');
          
        $this->pdf->Cell(50,8,'Item Code',1,0,'L');
        $this->pdf->CellFitScale(50,8,$order_information['itemcode'],1,0,'L');
        $this->pdf->Cell(40,8,'Expiry Date',1,0,'L');
        $this->pdf->CellFitScale(35,8,$order_information['expiry_date'],1,0,'L');
        $this->pdf->Cell(50,8,'Date of Completion',1,0,'L');
        $this->pdf->CellFitScale(52,8,$order_information['date_of_completion'],1,1,'L');
        
        $dhr_issued_by_qa_employee_short_name = isset($employee_details[$order_information['dhr_issued_by_qa']]['employee_short_name'])?$employee_details[$order_information['dhr_issued_by_qa']]['employee_short_name']:'NA';
        $dhr_issued_by_qa_signature = isset($employee_details[$order_information['dhr_issued_by_qa']]['signature'])?$employee_details[$order_information['dhr_issued_by_qa']]['signature']:'NA';
       
        $this->pdf->CellFitScale(277/8,8,'DHR Issued by (QA)',1,0,'L');
        $this->pdf->CellFitScale(277/8,8,$dhr_issued_by_qa_employee_short_name,1,0,'L');
        if(file_exists($dhr_issued_by_qa_signature)){
            $this->pdf->Image($dhr_issued_by_qa_signature,70,$this->pdf->GetY(),10,8);
        }
        
        $this->pdf->CellFitScale(277/8,8,'DHR Issued Date (QA)',1,0,'L');
        $this->pdf->CellFitScale(277/8,8,$order_information['dhr_issued_date_qa'],1,0,'L');
        
        $dhr_received_by_production_employee_short_name = isset($employee_details[$order_information['dhr_received_by_production']]['employee_short_name'])?$employee_details[$order_information['dhr_received_by_production']]['employee_short_name']:'NA';
        $dhr_received_by_production_signature = isset($employee_details[$order_information['dhr_received_by_production']]['signature'])?$employee_details[$order_information['dhr_received_by_production']]['signature']:'NA';
       
        $this->pdf->CellFitScale(277/8,8,'DHR Received by (Production)',1,0,'L');
        $this->pdf->CellFitScale(277/8,8,$dhr_received_by_production_employee_short_name,1,0,'L');
        if(file_exists($dhr_received_by_production_signature)){
            $this->pdf->Image($dhr_received_by_production_signature,208,$this->pdf->GetY(),10,8);
        }
        
        $this->pdf->CellFitScale(277/8,8,'DHR Received Date (Production)',1,0,'L');
        $this->pdf->CellFitScale(277/8,8,$order_information['dhr_received_date_production'],1,1,'L');
        
        $this->pdf->SetFont('Arial','I',10);
        $this->pdf->Cell(277,8,'Note: Manufacturing and Expiry Date as per customer label.',0,1,'L');
        
        ////////////////////////////////////////////////////////////Bill of Material/////////////////////////////////////////////////////////////
        
        foreach($data['stage_one_dhr_bill_of_material']->result_array() as $bill_of_material);
        
        $this->pdf->SetFont('Arial','B',12);
        
        $this->pdf->SetXY(10,$this->pdf->GetY()+5);
        $this->pdf->SetFillColor(217,217,217);
        $this->pdf->Cell(277,8,'Bill of Material',1,1,'C',1);
        
        $this->pdf->SetFont('Arial','',10);
        
        $this->pdf->Cell(277,8,'Reference: '.$bill_of_material['reference'],1,1,'L',1);
        
        $headingy = $this->pdf->GetY();
        $headingx = $this->pdf->GetX();
        
        $this->pdf->SetXY($headingx,$headingy);
        $this->pdf->CellFitScale(23,10,'Item #',1,0,'C');
        
        $this->pdf->SetXY($headingx+=23,$headingy);
        $this->pdf->CellFitScale(55,10,'Description',1,0,'C');
        
        $this->pdf->SetXY($headingx+=55,$headingy);
        $this->pdf->CellFitScale(20,10,'UOM',1,0,'C');
        
        $this->pdf->SetXY($headingx+=20,$headingy);
        $this->pdf->MultiCell(20,5,'Qunatity Required',1,'C');
        
        $this->pdf->SetXY($headingx+=20,$headingy);
        $this->pdf->MultiCell(20,5,'Quantity Issued',1,'C');
        
        $this->pdf->SetXY($headingx+=20,$headingy);
        $this->pdf->CellFitScale(20,10,'QIR #',1,0,'C');
        
        $this->pdf->SetXY($headingx+=20,$headingy);
        $this->pdf->MultiCell(20,5,'Item Lot # (Input Lot)',1,'C');
        
        $this->pdf->SetXY($headingx+=20,$headingy);
        $this->pdf->CellFitScale(20,10,'Issued By',1,0,'C');
        
        $this->pdf->SetXY($headingx+=20,$headingy);
        $this->pdf->CellFitScale(20,10,'Received By',1,0,'C');
        
        $this->pdf->SetXY($headingx+=20,$headingy);
        $this->pdf->CellFitScale(25,10,'Date',1,0,'C');
        
        $this->pdf->SetXY($headingx+=25,$headingy);
        $this->pdf->CellFitScale(34,10,'Remarks',1,1,'C');
        
        foreach($data['stage_one_dhr_bill_of_material']->result_array() as $bill_of_material){
            $headingy = $this->pdf->GetY();
            $headingx = $this->pdf->GetX();
            
            $this->pdf->SetXY($headingx,$headingy);
            $this->pdf->CellFitScale(23,12,$bill_of_material['item_number'],1,0,'C');
            
            $this->pdf->SetXY($headingx+=23,$headingy);
            $this->pdf->CellFitScale(55,12,$bill_of_material['item_description'],1,0,'C');
            
            $this->pdf->SetXY($headingx+=55,$headingy);
            $this->pdf->CellFitScale(20,12,$bill_of_material['uom'],1,0,'C');
            
            $this->pdf->SetXY($headingx+=20,$headingy);
            $this->pdf->CellFitScale(20,12,$bill_of_material['quantity_required'],1,0,'C');
            
            $this->pdf->SetXY($headingx+=20,$headingy);
            $this->pdf->CellFitScale(20,12,$bill_of_material['quantity_issued'],1,0,'C');
            
            $this->pdf->SetXY($headingx+=20,$headingy);
            $this->pdf->CellFitScale(20,12,$bill_of_material['qir_number'],1,0,'C');
            
            $this->pdf->SetXY($headingx+=20,$headingy);
            $this->pdf->CellFitScale(20,12,$bill_of_material['item_lot_number'],1,0,'C');
            
            $this->pdf->SetXY($headingx+=20,$headingy);
           if($bill_of_material['issued_by']!=''){
                $this->pdf->CellFitScale(20,6,'','LTR',1,'L');
                $this->pdf->SetX($headingx);
                $this->pdf->CellFitScale(20,6,$employee_details[$bill_of_material['issued_by']]['employee_short_name'],'LBR',0,'C');
                if(file_exists($employee_details[$bill_of_material['issued_by']]['signature'])){
                    $this->pdf->Image($employee_details[$bill_of_material['issued_by']]['signature'],$headingx+2,$headingy+1,15,6);
                }
            }else{
                $this->pdf->CellFitScale(20,12,'',1,0,'L');
            }
            
            $this->pdf->SetXY($headingx+=20,$headingy);
             if($bill_of_material['received_by']!=''){
                $this->pdf->CellFitScale(20,6,'','LTR',1,'L');
                $this->pdf->SetX($headingx);
                $this->pdf->CellFitScale(20,6,$employee_details[$bill_of_material['received_by']]['employee_short_name'],'LBR',0,'C');
                if(file_exists($employee_details[$bill_of_material['received_by']]['signature'])){
                    $this->pdf->Image($employee_details[$bill_of_material['received_by']]['signature'],$headingx+2,$headingy+1,15,6);
                }
            }else{
                $this->pdf->CellFitScale(20,12,'',1,0,'L');
            }
            
            $this->pdf->SetXY($headingx+=20,$headingy);
            $this->pdf->CellFitScale(25,12,$bill_of_material['date'],1,0,'C');
            
            $this->pdf->SetXY($headingx+=25,$headingy);
            $this->pdf->CellFitScale(34,12,$bill_of_material['remarks'],1,1,'C');
            
        }
        
         ////////////////////////////////////////////////////////////Pre Manufacturing Process/////////////////////////////////////////////////////////////
         
        if($data['stage_one_pre_manufacturing_process']->num_rows()>0){
            $this->pdf->SetFont('Arial','B',12);
            
            $this->pdf->SetXY(10,$this->pdf->GetY()+5);
            $this->pdf->SetFillColor(217,217,217);
            $this->pdf->Cell(277,8,'Pre Manufacturing Process',1,1,'C',1);
            
            $this->pdf->SetFont('Arial','',10);
         
            $headingy = $this->pdf->GetY();
            $headingx = $this->pdf->GetX();
            $w = 0;
            
            $this->pdf->SetXY($headingx,$headingy);
            $this->pdf->CellFitScale($w=13,10,'Item #',1,0,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->CellFitScale($w=70,10,'Description',1,0,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->CellFitScale($w=20,10,'UOM',1,0,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->CellFitScale($w=20,10,'Qunatity',1,0,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->MultiCell($w=34,10,'WI #',1,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->MultiCell($w=30,10,'Equipment #',1,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->MultiCell($w=30,10,'Done By',1,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->MultiCell($w=30,10,'Verified By',1,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->MultiCell($w=30,10,'Date',1,'C');
            
            foreach($data['stage_one_pre_manufacturing_process']->result_array() as $pre_manufacturing_process){
                $headingy = $this->pdf->GetY();
                $headingx = $this->pdf->GetX();
                $w=0;
                
                    $this->pdf->SetXY($headingx,$headingy);
                    $this->pdf->CellFitScale($w=13,12,$pre_manufacturing_process['prmp_item_number'],1,0,'C');
                    
                    $this->pdf->SetXY($headingx+=$w,$headingy);
                    $this->pdf->CellFitScale($w=70,12,$pre_manufacturing_process['prmp_item_description'],1,0,'C');
                    
                    $this->pdf->SetXY($headingx+=$w,$headingy);
                    $this->pdf->CellFitScale($w=20,12,$pre_manufacturing_process['prmp_uom'],1,0,'C');
                    
                    $this->pdf->SetXY($headingx+=$w,$headingy);
                    $this->pdf->CellFitScale($w=20,12,$pre_manufacturing_process['prmp_qunatity'],1,0,'C');
                    
                    $this->pdf->SetXY($headingx+=$w,$headingy);
                    $this->pdf->MultiCell($w=34,12,$pre_manufacturing_process['prmp_wi_number'],1,'C');
                    
                    $this->pdf->SetXY($headingx+=$w,$headingy);
                    $this->pdf->MultiCell($w=30,12,$pre_manufacturing_process['prmp_equipment_number'],1,'C');
                    
                    $this->pdf->SetXY($headingx+=$w,$headingy);
                     if($pre_manufacturing_process['prmp_done_by']!=''){
                        $this->pdf->CellFitScale($w=30,6,'','LTR',1,'L');
                        $this->pdf->SetX($headingx);
                        $this->pdf->CellFitScale($w=30,6,$pre_manufacturing_process['prmp_done_by'],'LBR',0,'C');
                       
                    }else{
                        $this->pdf->CellFitScale($w=30,12,'',1,0,'L');
                    }
                    
                    $this->pdf->SetXY($headingx+=$w,$headingy);
                     if($pre_manufacturing_process['prmp_verified_by']!=''){
                        $this->pdf->CellFitScale($w=30,6,'','LTR',1,'L');
                        $this->pdf->SetX($headingx);
                        $this->pdf->CellFitScale($w=30,6,$employee_details[$pre_manufacturing_process['prmp_verified_by']]['employee_short_name'],'LBR',0,'C');
                        if(file_exists($employee_details[$pre_manufacturing_process['prmp_verified_by']]['signature'])){
                            $this->pdf->Image($employee_details[$pre_manufacturing_process['prmp_verified_by']]['signature'],$headingx+2,$headingy+1,15,6);
                        }
                    }else{
                        $this->pdf->CellFitScale($w=30,12,'',1,0,'L');
                    }
                    $this->pdf->SetXY($headingx+=$w,$headingy);
                    $this->pdf->MultiCell($w=30,12,$pre_manufacturing_process['prmp_date'],1,'C');
                }
        }
            
       ///////////////////////////////////////////////////////////////////////Manufacturing Process/////////////////////////////////////////////////////////////////////////// 
        $this->pdf->AddPage('L','','A4');
        $this->pdf->SetAutoPageBreak(0);
        // $this->pdf->SetFont('Arial','B',12);
        // $this->pdf->Image(LOGO_PATH,20,10,25,10);
        // $this->pdf->Cell(50,10,'',1,0,'C');
        // $this->pdf->Cell(227,10,'Device History Record',1,1,'C');
        
        $this->pdf->SetFont('Arial','B',12);
        
        $this->pdf->SetXY(10,$this->pdf->GetY()+0);
        $this->pdf->SetFillColor(217,217,217);
        $this->pdf->Cell(277,8,'Manufacturing Process',1,1,'C',1);
        
        $this->pdf->SetFont('Arial','',10);
     
        $headingy = $this->pdf->GetY();
        $headingx = $this->pdf->GetX();
        $w = 0;
        
        $this->pdf->SetXY($headingx,$headingy);
        $this->pdf->CellFitScale($w=13,12,'Seq.#',1,0,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->CellFitScale($w=55,12,'Process Description',1,0,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->CellFitScale($w=24.5,12,'WI #',1,0,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->CellFitScale($w=24.5,12,'Equipment #',1,0,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->MultiCell($w=20,6,'Start'.PHP_EOL.'Date/Time',1,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->MultiCell($w=20,6,'End'.PHP_EOL.'Date/Time',1,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->MultiCell($w=25,6,'Manufactured'.PHP_EOL.'Quantity',1,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->MultiCell($w=18,6,'Good'.PHP_EOL.'Quantity',1,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->MultiCell($w=20,6,'Rejected'.PHP_EOL.'Quantity',1,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->MultiCell($w=19,6,'Done'.PHP_EOL.'By',1,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->MultiCell($w=19,6,'Verified'.PHP_EOL.'By',1,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->MultiCell($w=19,4,'Line'.PHP_EOL.'Clearance By',1,'C');
        
        foreach($data['stage_one_manufacturing_process']->result_array() as $manufacturing_process){
            $headingy = $this->pdf->GetY();
            $headingx = $this->pdf->GetX();
            $w=0;
            $this->pdf->SetXY($headingx,$headingy);
            $this->pdf->CellFitScale($w=13,12,$manufacturing_process['mp_seq_number'],1,0,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->CellFitScale($w=55,12,$manufacturing_process['mp_process_description'],1,0,'L');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->CellFitScale($w=24.5,12,$manufacturing_process['mp_wi_number'],1,0,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->CellFitScale($w=24.5,12,$manufacturing_process['mp_equipment_number'],1,0,'C');
            
            $this->pdf->SetFont('Arial','',9);
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $mpsdt = explode(' ',$manufacturing_process['mp_start_datetime']);
            $this->pdf->MultiCell($w=20,($manufacturing_process['mp_start_datetime']=='NA'?12:6),implode(PHP_EOL,$mpsdt),1,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $mpedt = explode(' ',$manufacturing_process['mp_end_datetime']);
            $this->pdf->MultiCell($w=20,($manufacturing_process['mp_end_datetime']=='NA'?12:6),implode(PHP_EOL,$mpedt),1,'C');
            $this->pdf->SetFont('Arial','',10);
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->CellFitScale($w=25,12,$manufacturing_process['mp_manufactured_qunatity'],1,0,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->CellFitScale($w=18,12,$manufacturing_process['mp_good_qunatity'],1,0,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->CellFitScale($w=20,12,$manufacturing_process['mp_rejected_qunatity'],1,0,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
             if($manufacturing_process['mp_done_by']!=''){
                $this->pdf->CellFitScale($w=19,6,'','LTR',1,'L');
                $this->pdf->SetX($headingx);
                $this->pdf->CellFitScale($w=19,6,$manufacturing_process['mp_done_by'],'LBR',0,'C');
               
            }else{
                $this->pdf->CellFitScale($w=19,12,'',1,0,'L');
            }
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            if($manufacturing_process['mp_verified_by']!=''){
                $this->pdf->CellFitScale($w=19,6,'','LTR',1,'L');
                $this->pdf->SetX($headingx);
                $this->pdf->CellFitScale($w=19,6,$employee_details[$manufacturing_process['mp_verified_by']]['employee_short_name'],'LBR',0,'C');
                if(file_exists($employee_details[$manufacturing_process['mp_verified_by']]['signature'])){
                    $this->pdf->Image($employee_details[$manufacturing_process['mp_verified_by']]['signature'],$headingx+2,$headingy+1,15,6);
                }
            }else{
                 $this->pdf->CellFitScale($w=19,12,'',1,0,'L');
            }
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            if($manufacturing_process['mp_line_clearance_by']!=''){
                $this->pdf->CellFitScale($w=19,6,'','LTR',1,'L');
                $this->pdf->SetX($headingx);
                $this->pdf->CellFitScale($w=19,6,$employee_details[$manufacturing_process['mp_line_clearance_by']]['employee_short_name'],'LBR',1,'C');
                if(file_exists($employee_details[$manufacturing_process['mp_line_clearance_by']]['signature'])){
                    $this->pdf->Image($employee_details[$manufacturing_process['mp_line_clearance_by']]['signature'],$headingx+2,$headingy+1,15,6);
                }
            }else{
                $this->pdf->CellFitScale($w=19,12,'',1,1,'L');
            }
        }
        
        /////////////////////////////////////////////////////////////Post manufacturing Process//////////////////////////////////////////////////////////////
         $this->pdf->AddPage('L','','A4');
        $this->pdf->SetAutoPageBreak(0);
        // $this->pdf->SetFont('Arial','B',12);
        // $this->pdf->Image(LOGO_PATH,20,10,25,10);
        // $this->pdf->Cell(50,10,'',1,0,'C');
        // $this->pdf->Cell(227,10,'Device History Record',1,1,'C');
        
        
        if($data['stage_one_post_manufacturing_process']->num_rows()>0){
            $this->pdf->SetFont('Arial','B',12);
            
            $this->pdf->SetXY(10,$this->pdf->GetY()+0);
            $this->pdf->SetFillColor(217,217,217);
            $this->pdf->Cell(277,8,'Post Manufacturing Process',1,1,'C',1);
            
            $this->pdf->SetFont('Arial','',10);
         
            $headingy = $this->pdf->GetY();
            $headingx = $this->pdf->GetX();
            $w = 0;
            
            
            $this->pdf->SetXY($headingx,$headingy);
            $this->pdf->CellFitScale($w=12,12,'Seq.#',1,0,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->CellFitScale($w=55,12,'Process Description',1,0,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->CellFitScale($w=30,12,'WI #',1,0,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->CellFitScale($w=30,12,'DCC # (If Applicable)',1,0,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->MultiCell($w=30,12,'Sent Date',1,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->MultiCell($w=30,12,'Cycle #/Report #',1,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->MultiCell($w=30,12,'Process Date',1,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->MultiCell($w=30,12,'Done By',1,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->MultiCell($w=30,12,'Checked By',1,'C');
            
            foreach($data['stage_one_post_manufacturing_process']->result_array() as $post_manufacturing_process){
                $headingy = $this->pdf->GetY();
                $headingx = $this->pdf->GetX();
                $w=0;
                $this->pdf->SetXY($headingx,$headingy);
                $this->pdf->CellFitScale($w=12,12,$post_manufacturing_process['pmp_seq_number'],1,0,'C');
                
                $this->pdf->SetXY($headingx+=$w,$headingy);
                $this->pdf->CellFitScale($w=55,12,$post_manufacturing_process['pmp_process_description'],1,0,'C');
                
                $this->pdf->SetXY($headingx+=$w,$headingy);
                $this->pdf->CellFitScale($w=30,12,$post_manufacturing_process['pmp_wi_number'],1,0,'C');
                
                $this->pdf->SetXY($headingx+=$w,$headingy);
                $this->pdf->CellFitScale($w=30,12,$post_manufacturing_process['pmp_dcc_number'],1,0,'C');
                
                $this->pdf->SetXY($headingx+=$w,$headingy);
                $this->pdf->MultiCell($w=30,12,$post_manufacturing_process['pmp_sent_date'],1,'C');
                
                $this->pdf->SetXY($headingx+=$w,$headingy);
                $this->pdf->CellFitScale($w=30,12,$post_manufacturing_process['pmp_cycle_number_or_report_number'],1,0,'C');
                
                $this->pdf->SetXY($headingx+=$w,$headingy);
                $this->pdf->MultiCell($w=30,12,$post_manufacturing_process['pmp_process_date'],1,'C');
                
                $this->pdf->SetXY($headingx+=$w,$headingy);
                 if($post_manufacturing_process['pmp_done_by']!=''){
                    $this->pdf->CellFitScale($w=30,6,'','LTR',1,'L');
                    $this->pdf->SetX($headingx);
                    $this->pdf->CellFitScale($w=30,6,$post_manufacturing_process['pmp_done_by'],'LBR',0,'C');
                    
                }else{
                   $this->pdf->CellFitScale($w=30,12,'',1,0,'L'); 
                }
                
                $this->pdf->SetXY($headingx+=$w,$headingy);
                if($post_manufacturing_process['pmp_checked_by']!=''){
                    $this->pdf->CellFitScale($w=30,6,'','LTR',1,'L');
                    $this->pdf->SetX($headingx);
                    $this->pdf->CellFitScale($w=30,6,$employee_details[$post_manufacturing_process['pmp_checked_by']]['employee_short_name'],'LBR',1,'C');
                    if(file_exists($employee_details[$post_manufacturing_process['pmp_checked_by']]['signature'])){
                        $this->pdf->Image($employee_details[$post_manufacturing_process['pmp_checked_by']]['signature'],$headingx+2,$headingy+1,15,6);
                    }
                }else{
                    $this->pdf->CellFitScale($w=30,12,'',1,1,'L');
                }
            }
        }
        
         ////////////////////////////////////////////////////////////Quality Control Process/////////////////////////////////////////////////////////////
       
       $this->pdf->SetFont('Arial','B',12);
        
        $this->pdf->SetXY(10,$this->pdf->GetY()+5);
        $this->pdf->SetFillColor(217,217,217);
        $this->pdf->Cell(277,8,'Quality Control Process',1,1,'C',1);
        
        $this->pdf->SetFont('Arial','',10);
     
        $headingy = $this->pdf->GetY();
        $headingx = $this->pdf->GetX();
        $w = 0;
        
        $this->pdf->SetXY($headingx,$headingy);
        $this->pdf->CellFitScale($w=13,12,'Seq.#',1,0,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->CellFitScale($w=80,12,'Inspection (Or) Testing Description',1,0,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->CellFitScale($w=44,12,'WI #',1,0,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->CellFitScale($w=40,12,'QIR #/Report #',1,0,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->MultiCell($w=20,6,'Sample Quantity',1,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->CellFitScale($w=20,12,'Pass/Fail',1,0,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->CellFitScale($w=30,12,'Verified By',1,0,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->MultiCell($w=30,12,'Verified Date',1,'C');
        
        foreach($data['stage_one_quality_control_process']->result_array() as $quality_control_process){
            $headingy = $this->pdf->GetY();
            $headingx = $this->pdf->GetX();
            $w = 0;
            
            $this->pdf->SetXY($headingx,$headingy);
            $this->pdf->CellFitScale($w=13,12,$quality_control_process['qcp_seq_number'],1,0,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->CellFitScale($w=80,12,$quality_control_process['qcp_process_inspection_or_testing_description'],1,0,'L');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->CellFitScale($w=44,12,$quality_control_process['qcp_wi_number'],1,0,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->CellFitScale($w=40,12,$quality_control_process['qcp_qir_number_or_report_number'],1,0,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->CellFitScale($w=20,12,$quality_control_process['qcp_sample_quantity'],1,0,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->CellFitScale($w=20,12,$quality_control_process['qcp_pass_or_fail'],1,0,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            if($quality_control_process['qcp_verified_by']!=''){
                $this->pdf->CellFitScale($w=30,6,'','LTR',1,'L');
                $this->pdf->SetX($headingx);
                $this->pdf->CellFitScale($w=30,6,$employee_details[$quality_control_process['qcp_verified_by']]['employee_short_name'],'LBR',0,'C');
                if(file_exists($employee_details[$quality_control_process['qcp_verified_by']]['signature'])){
                    $this->pdf->Image($employee_details[$quality_control_process['qcp_verified_by']]['signature'],$headingx+5,$headingy+1,15,6);
                }
            }else{
                $this->pdf->CellFitScale($w=30,12,'',1,0,'C');
            }
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->MultiCell($w=30,12,$quality_control_process['qcp_verified_date'],1,'C');
            
        }
            
            ////////////////////////////////////////////////////////////Finished Goods Transfer Note/////////////////////////////////////////////////////////////
            $this->pdf->SetFont('Arial','B',12);
            
            $this->pdf->SetXY(10,$this->pdf->GetY()+10);
            $this->pdf->SetFillColor(217,217,217);
            $this->pdf->Cell(277,8,'Finished Goods Transfer Note',1,1,'C',1);
            
                foreach($data['finished_goods_transfer_note']->result_array() as $f_g_transfer_note);
            
                $this->pdf->SetFont('Arial','',10);
                
                $fgtnwidth = 277/3;
                $this->pdf->CellFitScale($fgtnwidth,12,'Transferred Quantity : '.$f_g_transfer_note['transferred_quantity'],1,0,'L');
                
                $this->pdf->CellFitScale($fgtnwidth/2,12,'Transferred By (Sign) : '.$f_g_transfer_note['transferred_date'],'TLB',0,'L');
                $tqafterx = $this->pdf->GetX();
                if($f_g_transfer_note['transferred_by']!=''){
                    $this->pdf->CellFitScale($fgtnwidth/2,6,'','TR',1,'C');
                    if(file_exists($employee_details[$f_g_transfer_note['transferred_by']]['signature'])){
                        $this->pdf->Image($employee_details[$f_g_transfer_note['transferred_by']]['signature'],$tqafterx+15,$this->pdf->GetY()-5,15,6);
                    }
                    $this->pdf->SetXY($tqafterx,$this->pdf->GetY());
                    $this->pdf->CellFitScale($fgtnwidth/2,6,$employee_details[$f_g_transfer_note['transferred_by']]['employee_short_name'],'BR',0,'C');
                }else{
                    $this->pdf->CellFitScale($fgtnwidth/2,12,'','TRB',0,'C');
                    $this->pdf->SetXY($this->pdf->GetX(),$this->pdf->GetY()+6);
                }
                
                $this->pdf->SetXY($this->pdf->GetX(),$this->pdf->GetY()-6);
                $this->pdf->CellFitScale($fgtnwidth/2,12,'Accepted By (Sign) : '.$f_g_transfer_note['accepted_date'],'TLB',0,'L');
                $tqafterx = $this->pdf->GetX();
                if($f_g_transfer_note['accepted_by']!=''){
                    $this->pdf->CellFitScale($fgtnwidth/2,6,'','TR',1,'C');
                    if(file_exists($employee_details[$f_g_transfer_note['accepted_by']]['signature'])){
                        $this->pdf->Image($employee_details[$f_g_transfer_note['accepted_by']]['signature'],$tqafterx+15,$this->pdf->GetY()-5,15,6);
                    }
                    $this->pdf->SetXY($tqafterx,$this->pdf->GetY());
                    $this->pdf->CellFitScale($fgtnwidth/2,6,$employee_details[$f_g_transfer_note['accepted_by']]['employee_short_name'],'BR',1,'C');
                }else{
                    $this->pdf->CellFitScale($fgtnwidth/2,12,'','TRB',1,'C');
                }
            
            
        ////////////////////////////////////////////////////////////Material Reconciliation/////////////////////////////////////////////////////////////
       
        $this->pdf->AddPage('L','','A4');
        $this->pdf->SetAutoPageBreak(0);
        // $this->pdf->SetFont('Arial','B',12);
        // $this->pdf->Image(LOGO_PATH,20,10,25,10);
        // $this->pdf->Cell(50,10,'',1,0,'C');
        // $this->pdf->Cell(227,10,'Device History Record',1,1,'C');
        
        $this->pdf->SetFont('Arial','B',12);
        
        $this->pdf->SetXY(10,$this->pdf->GetY()+0);
        $this->pdf->SetFillColor(217,217,217);
        $this->pdf->Cell(277,8,'Material Reconciliation',1,1,'C',1);
        
        $this->pdf->SetFont('Arial','',10);
     
        $headingy = $this->pdf->GetY();
        $headingx = $this->pdf->GetX();
        $w = 0;
        
        $this->pdf->SetXY($headingx,$headingy);
        $this->pdf->CellFitScale($w=22,12,'Item. #',1,0,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->CellFitScale($w=65,12,'Description',1,0,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->CellFitScale($w=20,12,'UOM',1,0,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->MultiCell($w=20,6,'Quantity Received',1,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->MultiCell($w=20,12,'QIR #',1,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->MultiCell($w=20,6,'Item Lot # (Input Lot)',1,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->CellFitScale($w=30,12,'Returned By',1,0,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->MultiCell($w=30,12,'Received By',1,'C');
        
         $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->MultiCell($w=20,12,'Date',1,'C');
        
         $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->MultiCell($w=30,12,'Remarks',1,'C');
        
        
        
        foreach($data['stage_one_material_reconciliation']->result_array() as $material_reconciliation){
            $headingy = $this->pdf->GetY();
                $headingx = $this->pdf->GetX();
                $w = 0;
                
                $this->pdf->SetXY($headingx,$headingy);
                $this->pdf->CellFitScale($w=22,12,$material_reconciliation['mrec_item_number'],1,0,'C');
                
                $this->pdf->SetXY($headingx+=$w,$headingy);
                $this->pdf->CellFitScale($w=65,12,$material_reconciliation['mrec_description'],1,0,'L');
                
                $this->pdf->SetXY($headingx+=$w,$headingy);
                $this->pdf->CellFitScale($w=20,12,$material_reconciliation['mrec_uom'],1,0,'C');
                
                $this->pdf->SetXY($headingx+=$w,$headingy);
                $this->pdf->MultiCell($w=20,12,$material_reconciliation['mrec_quantity_received'],1,'C');
                
                $this->pdf->SetXY($headingx+=$w,$headingy);
                $this->pdf->MultiCell($w=20,12,$material_reconciliation['mrec_qir_number'],1,'C');
                
                $this->pdf->SetXY($headingx+=$w,$headingy);
                $this->pdf->CellFitScale($w=20,12,$material_reconciliation['mrec_item_lot_number_or_input_lot'],1,0,'C');
                
                $this->pdf->SetXY($headingx+=$w,$headingy);
                if($material_reconciliation['mrec_returned_by']!=''){
                    $this->pdf->CellFitScale($w=30,6,'','LTR',1,'L');
                    $this->pdf->SetX($headingx);
                    $this->pdf->CellFitScale($w=30,6,$employee_details[$material_reconciliation['mrec_returned_by']]['employee_short_name'],'LBR',0,'C');
                    if(file_exists($employee_details[$material_reconciliation['mrec_returned_by']]['signature'])){
                        $this->pdf->Image($employee_details[$material_reconciliation['mrec_returned_by']]['signature'],$headingx+8,$headingy+1,15,6);
                    }
                }else{
                    $this->pdf->CellFitScale($w=30,12,'',1,0,'L');
                }
                
                $this->pdf->SetXY($headingx+=$w,$headingy);
                if($material_reconciliation['mrec_received_by']!=''){
                    $this->pdf->CellFitScale($w=30,6,'','LTR',1,'L');
                    $this->pdf->SetX($headingx);
                    $this->pdf->CellFitScale($w=30,6,$employee_details[$material_reconciliation['mrec_received_by']]['employee_short_name'],'LBR',0,'C');
                    if(file_exists($employee_details[$material_reconciliation['mrec_received_by']]['signature'])){
                        $this->pdf->Image($employee_details[$material_reconciliation['mrec_received_by']]['signature'],$headingx+8,$headingy+1,15,6);
                    }
                }else{
                    $this->pdf->CellFitScale($w=30,12,'',1,0,'L');
                }
                
                 $this->pdf->SetXY($headingx+=$w,$headingy);
                $this->pdf->CellFitScale($w=20,12,$material_reconciliation['mrec_date'],1,0,'C');
                
                 $this->pdf->SetXY($headingx+=$w,$headingy);
                $this->pdf->MultiCell($w=30,12,$material_reconciliation['mrec_remark'],1,'C');
            }
            
             ////////////////////////////////////////////////////////////Finished Goods Reconciliation/////////////////////////////////////////////////////////////
           
            $this->pdf->SetFont('Arial','B',12);
            
            $this->pdf->SetXY(10,$this->pdf->GetY()+10);
            $this->pdf->SetFillColor(217,217,217);
            $this->pdf->Cell(277,8,'Finished Goods Reconciliation',1,1,'C',1);
            
            $this->pdf->SetFont('Arial','',10);
            foreach($data['stage_one_finished_goods_reconcillation']->result_array() as $finished_goods_reconcillation);
            $fgrwidth = 277/2;
            $this->pdf->Cell($fgrwidth,8,'Total Quantity Produced and Packed',1,0,'L'); 
            $this->pdf->Cell($fgrwidth,8,$finished_goods_reconcillation['total_quantity_produced_and_packed'],1,1,'L');
            $this->pdf->Cell($fgrwidth,8,'Penetration Samples Quantity',1,0,'L'); 
            $this->pdf->Cell($fgrwidth,8,$finished_goods_reconcillation['penetration_samples_quantity'],1,1,'L');
            $this->pdf->Cell($fgrwidth,8,'Control Samples Quantity',1,0,'L'); 
            $this->pdf->Cell($fgrwidth,8,$finished_goods_reconcillation['control_samples_quantity'],1,1,'L');
            $this->pdf->Cell($fgrwidth,8,'Rejected Quantity',1,0,'L');
            $this->pdf->Cell($fgrwidth,8,$finished_goods_reconcillation['rejected_quantity'],1,1,'L');
            $this->pdf->Cell($fgrwidth,8,'Yield (Percentage)',1,0,'L');
            $this->pdf->Cell($fgrwidth,8,$finished_goods_reconcillation['yield_percentage'].'%',1,1,'L');
            
            $this->pdf->SetFont('Arial','B',10);
            $this->pdf->SetXY(10,$this->pdf->GetY()+5);
            $this->pdf->SetFillColor(217,217,217);
          
            $this->pdf->CellFitScale($fgrwidth/2,12,'Verified By - Production Head (Signature) '.$finished_goods_reconcillation['production_verified_date'],'LTB',0,'C');
            $tqafterx = $this->pdf->GetX();
            if($finished_goods_reconcillation['production_verified_by']!=''){
                $this->pdf->CellFitScale($fgrwidth/2,6,'','TR',1,'C');
                if(file_exists($employee_details[$finished_goods_reconcillation['production_verified_by']]['signature'])){
                    $this->pdf->Image($employee_details[$finished_goods_reconcillation['production_verified_by']]['signature'],$tqafterx+25,$this->pdf->GetY()-5,15,6);
                }
                $this->pdf->SetXY($tqafterx,$this->pdf->GetY());
                $this->pdf->CellFitScale($fgrwidth/2,6,$employee_details[$finished_goods_reconcillation['production_verified_by']]['employee_short_name'],'BR',0,'C');
            }else{
                $this->pdf->CellFitScale($fgrwidth/2,12,'','TRB',0,'C');
                $this->pdf->SetXY($this->pdf->GetX(),$this->pdf->GetY()+6);
            }
            
            $this->pdf->SetXY($this->pdf->GetX(),$this->pdf->GetY()-6);
            $this->pdf->CellFitScale($fgrwidth/2,12,'Checked By - Quality Control Head (Signature) '.$finished_goods_reconcillation['checked_by_quality_control_date'],'TLB',0,'L');
            $tqafterx = $this->pdf->GetX();
            if($finished_goods_reconcillation['checked_by_quality_control']!=''){
                $this->pdf->CellFitScale($fgrwidth/2,6,'','TR',1,'C');
                if(file_exists($employee_details[$finished_goods_reconcillation['checked_by_quality_control']]['signature'])){
                    $this->pdf->Image($employee_details[$finished_goods_reconcillation['checked_by_quality_control']]['signature'],$tqafterx+25,$this->pdf->GetY()-5,15,6);
                }
                $this->pdf->SetXY($tqafterx,$this->pdf->GetY());
                $this->pdf->CellFitScale($fgrwidth/2,6,$employee_details[$finished_goods_reconcillation['checked_by_quality_control']]['employee_short_name'],'BR',1,'C');
            }else{
                $this->pdf->CellFitScale($fgrwidth/2,12,'','TRB',1,'C');
            }
            
            $this->pdf->CellFitScale(277/2,12,'Remarks:'.$finished_goods_reconcillation['production_verified_by_remarks'],1,0,'L');
            $this->pdf->CellFitScale(277/2,12,'Remarks:'.$finished_goods_reconcillation['checked_by_quality_control_remark'],1,1,'L');
            
            ////////////////////////////////////////////////////////////QA Approval and Release/////////////////////////////////////////////////////////////
           
           $this->pdf->SetFont('Arial','B',12);
            
            $this->pdf->SetXY(10,$this->pdf->GetY()+10);
            $this->pdf->SetFillColor(217,217,217);
            $this->pdf->Cell(277,8,'QA Approval and Release',1,1,'C',1);
            
            $this->pdf->SetFont('Arial','',10);
            foreach($data['stage_one_qa_approval_and_release']->result_array() as $qa_approval_and_release);
            
             $qaarwidth = 277/4;
            $this->pdf->CellFitScale($qaarwidth,12,'Quantity Released for Dispatch',1,0,'L'); 
            $this->pdf->CellFitScale($qaarwidth,12,$qa_approval_and_release['quantity_released_for_dispatch'],1,0,'L');
            $this->pdf->CellFitScale($qaarwidth,12,'Date Of Release',1,0,'L'); 
            $this->pdf->CellFitScale($qaarwidth,12,$qa_approval_and_release['date_of_release'],1,1,'L');
            $this->pdf->CellFitScale($qaarwidth,12,'Remarks',1,0,'L');
            $this->pdf->CellFitScale($qaarwidth,12,$qa_approval_and_release['remarks'],1,0,'L');
            $this->pdf->CellFitScale($qaarwidth,12,'Signature',1,0,'L');
           
            $tqafterx = $this->pdf->GetX();
            if($qa_approval_and_release['signature']!=''){
                $this->pdf->CellFitScale($qaarwidth,6,'','TR',1,'C');
                if(file_exists($employee_details[$qa_approval_and_release['signature']]['signature'])){
                    $this->pdf->Image($employee_details[$qa_approval_and_release['signature']]['signature'],$tqafterx+25,$this->pdf->GetY()-5,15,6);
                }
                $this->pdf->SetXY($tqafterx,$this->pdf->GetY());
                $this->pdf->CellFitScale($qaarwidth,6,$employee_details[$qa_approval_and_release['signature']]['employee_short_name'],'BR',1,'C');
            }else{
                $this->pdf->CellFitScale($qaarwidth,12,'',1,1,'C');
            }
            
        $this->pdf->AliasNbPages();
        $this->pdf->Output();
        
    }
    
    function stage_four_form($dhr_id){
        setlocale(LC_CTYPE,'en_US.UTF-8');
        $order_information = $bill_of_material   = $f_g_transfer_note   = $finished_goods_reconcillation = $qa_approval_and_release = $employee_details = $footer_note = NULL;
        
        $data = $this->ShahPDFM->stage_one_form_details($dhr_id);
        $employee_details=$data['employee_details'];
        foreach($data['stage_one_footer_note']->result_array() as $footer_note);
        foreach($data['stage_one_dhr_order_information']->result_array() as $order_information);
        
        
        // $data['stage_one_pre_manufacturing_process'];
        // $data['stage_one_manufacturing_process'];
        // $data['stage_one_post_manufacturing_process'];
        // $data['stage_one_quality_control_process'];
        // $data['finished_goods_transfer_note'];
        // $data['stage_one_material_reconciliation'];
        // $data['stage_one_finished_goods_reconcillation'];
        // $data['stage_one_qa_approval_and_release'];
        
        $this->pdf->setHeaderForNextPage(array('title'=>'Device History Record'));
        $this->pdf->setFooterForNextPage($footer_note);
        $this->pdf->AddPage('L','','A4');
        $this->pdf->SetAutoPageBreak(0);
        // $this->pdf->SetFont('Arial','B',12);
        // $this->pdf->Image(LOGO_PATH,20,10,25,10);
        // $this->pdf->Cell(50,10,'',1,0,'C');
        // $this->pdf->Cell(227,10,'Device History Record',1,1,'C');
        
        ////////////////////////////////////////////////////////////Order Information/////////////////////////////////////////////////////////////
        $this->pdf->SetXY(10,$this->pdf->GetY()+0);
        $this->pdf->SetFillColor(217,217,217);
        $this->pdf->Cell(277,8,'Order Information',1,1,'C',1);
        
        $this->pdf->SetFont('Arial','',10);
        
        $this->pdf->Cell(50,8,'Sales Order #',1,0,'L');
        $this->pdf->CellFitScale(125,8,$order_information['sales_order'],1,0,'L');
        $this->pdf->Cell(50,8,'Production Order #',1,0,'L');
        $this->pdf->CellFitScale(52,8,$order_information['production_order'],1,1,'L');
        
        $this->pdf->Cell(50,8,'Product Description',1,0,'L');
        $this->pdf->CellFitScale(227,8,$order_information['product_description'],1,1,'L');
        
        
        $this->pdf->Cell(50,8,'DHR #',1,0,'L');
        $this->pdf->CellFitScale(125,8,$order_information['dhr'],1,0,'L');
        $this->pdf->Cell(50,8,'Order Quantity',1,0,'L');
        $this->pdf->CellFitScale(52,8,$order_information['order_quantity'],1,1,'L');
        
        $this->pdf->Cell(50,8,'Batch/Lot #',1,0,'L');
        $this->pdf->CellFitScale(125,8,$order_information['batchorlot'],1,0,'L');
        $this->pdf->Cell(50,8,'Production Quantity',1,0,'L');
        $this->pdf->CellFitScale(52,8,$order_information['production_quantity'],1,1,'L');
         
        $this->pdf->Cell(50,8,'REF/Model #',1,0,'L');
        $this->pdf->CellFitScale(50,8,$order_information['reformodel'],1,0,'L');
        $this->pdf->Cell(40,8,'Manufacturing Date',1,0,'L');
        $this->pdf->CellFitScale(35,8,$order_information['manufacturing_date'],1,0,'L');
        $this->pdf->Cell(50,8,'Date of Commencement',1,0,'L');
        $this->pdf->CellFitScale(52,8,$order_information['date_of_commencement'],1,1,'L');
          
        $this->pdf->Cell(50,8,'Item Code',1,0,'L');
        $this->pdf->CellFitScale(50,8,$order_information['itemcode'],1,0,'L');
        $this->pdf->Cell(40,8,'Expiry Date',1,0,'L');
        $this->pdf->CellFitScale(35,8,$order_information['expiry_date'],1,0,'L');
        $this->pdf->Cell(50,8,'Date of Completion',1,0,'L');
        $this->pdf->CellFitScale(52,8,$order_information['date_of_completion'],1,1,'L');
        
         $dhr_issued_by_qa_employee_short_name = isset($employee_details[$order_information['dhr_issued_by_qa']]['employee_short_name'])?$employee_details[$order_information['dhr_issued_by_qa']]['employee_short_name']:'NA';
        $dhr_issued_by_qa_signature = isset($employee_details[$order_information['dhr_issued_by_qa']]['signature'])?$employee_details[$order_information['dhr_issued_by_qa']]['signature']:'NA';
        
        $this->pdf->CellFitScale(277/8,8,'DHR Issued by (QA)',1,0,'L');
        $this->pdf->CellFitScale(277/8,8,$dhr_issued_by_qa_employee_short_name,1,0,'L');
        if(file_exists($dhr_issued_by_qa_signature)){
            $this->pdf->Image($dhr_issued_by_qa_signature,70,$this->pdf->GetY(),10,8);
        }
        
         $dhr_received_by_production_employee_short_name = isset($employee_details[$order_information['dhr_received_by_production']]['employee_short_name'])?$employee_details[$order_information['dhr_received_by_production']]['employee_short_name']:'NA';
        $dhr_received_by_production_signature = isset($employee_details[$order_information['dhr_received_by_production']]['signature'])?$employee_details[$order_information['dhr_received_by_production']]['signature']:'NA';
       
        
         $this->pdf->CellFitScale(277/8,8,'DHR Issued Date (QA)',1,0,'L');
        $this->pdf->CellFitScale(277/8,8,$order_information['dhr_issued_date_qa'],1,0,'L');
        
        $this->pdf->CellFitScale(277/8,8,'DHR Received by (Production)',1,0,'L');
         $this->pdf->CellFitScale(277/8,8,$dhr_received_by_production_employee_short_name,1,0,'L');
        if(file_exists($dhr_received_by_production_signature)){
            $this->pdf->Image($dhr_received_by_production_signature,208,$this->pdf->GetY(),10,8);
        }
        
        $this->pdf->CellFitScale(277/8,8,'DHR Received Date (Production)',1,0,'L');
        $this->pdf->CellFitScale(277/8,8,$order_information['dhr_received_date_production'],1,1,'L');
        
        $this->pdf->SetFont('Arial','I',10);
        $this->pdf->Cell(277,8,'Note: Manufacturing and Expiry Date as per customer label.',0,1,'L');
        
        ////////////////////////////////////////////////////////////Bill of Material/////////////////////////////////////////////////////////////
        
        foreach($data['stage_one_dhr_bill_of_material']->result_array() as $bill_of_material);
        
        
        $this->pdf->SetFont('Arial','B',12);
        
        $this->pdf->SetXY(10,$this->pdf->GetY()+0);
        $this->pdf->SetFillColor(217,217,217);
        $this->pdf->Cell(277,8,'Bill of Material',1,1,'C',1);
        
        $this->pdf->SetFont('Arial','',10);
        
        $this->pdf->Cell(277,8,'Reference: '.$bill_of_material['reference'],1,1,'L',1);
        
        $headingy = $this->pdf->GetY();
        $headingx = $this->pdf->GetX();
        
        $this->pdf->SetXY($headingx,$headingy);
        $this->pdf->CellFitScale(23,10,'Item #',1,0,'C');
        
        $this->pdf->SetXY($headingx+=23,$headingy);
        $this->pdf->CellFitScale(55,10,'Description',1,0,'C');
        
        $this->pdf->SetXY($headingx+=55,$headingy);
        $this->pdf->CellFitScale(20,10,'UOM',1,0,'C');
        
        $this->pdf->SetXY($headingx+=20,$headingy);
        $this->pdf->MultiCell(20,5,'Qunatity Required',1,'C');
        
        $this->pdf->SetXY($headingx+=20,$headingy);
        $this->pdf->MultiCell(20,5,'Quantity Issued',1,'C');
        
        $this->pdf->SetXY($headingx+=20,$headingy);
        $this->pdf->CellFitScale(20,10,'QIR #',1,0,'C');
        
        $this->pdf->SetXY($headingx+=20,$headingy);
        $this->pdf->MultiCell(20,5,'Item Lot # (Input Lot)',1,'C');
        
        $this->pdf->SetXY($headingx+=20,$headingy);
        $this->pdf->CellFitScale(20,10,'Issued By',1,0,'C');
        
        $this->pdf->SetXY($headingx+=20,$headingy);
        $this->pdf->CellFitScale(20,10,'Received By',1,0,'C');
        
        $this->pdf->SetXY($headingx+=20,$headingy);
        $this->pdf->CellFitScale(25,10,'Date',1,0,'C');
        
        $this->pdf->SetXY($headingx+=25,$headingy);
        $this->pdf->CellFitScale(34,10,'Remarks',1,1,'C');
        
        $bomrows=0;
        foreach($data['stage_one_dhr_bill_of_material']->result_array() as $bill_of_material){
            $headingy = $this->pdf->GetY();
            $headingx = $this->pdf->GetX();
            
            $this->pdf->SetXY($headingx,$headingy);
            $this->pdf->CellFitScale(23,12,$bill_of_material['item_number'],1,0,'C');
            
            $this->pdf->SetXY($headingx+=23,$headingy);
            $bill_of_material['item_description'] = utf8_encode($bill_of_material['item_description']);//mb_convert_encoding(utf8_encode($bill_of_material['item_description']),'ASCII','UTF-8');
            $this->pdf->CellFitScale(55,12,$bill_of_material['item_description'],1,0,'C');
            
            $this->pdf->SetXY($headingx+=55,$headingy);
            $this->pdf->CellFitScale(20,12,$bill_of_material['uom'],1,0,'C');
            
            $this->pdf->SetXY($headingx+=20,$headingy);
            $this->pdf->CellFitScale(20,12,$bill_of_material['quantity_required'],1,0,'C');
            
            $this->pdf->SetXY($headingx+=20,$headingy);
            $this->pdf->CellFitScale(20,12,$bill_of_material['quantity_issued'],1,0,'C');
            
            $this->pdf->SetXY($headingx+=20,$headingy);
            $this->pdf->CellFitScale(20,12,$bill_of_material['qir_number'],1,0,'C');
            
            $this->pdf->SetXY($headingx+=20,$headingy);
            $this->pdf->CellFitScale(20,12,$bill_of_material['item_lot_number'],1,0,'C');
            
            $this->pdf->SetXY($headingx+=20,$headingy);
           if($bill_of_material['issued_by']!=''){
                $this->pdf->CellFitScale(20,6,'','LTR',1,'L');
                $this->pdf->SetX($headingx);
                $this->pdf->CellFitScale(20,6,$employee_details[$bill_of_material['issued_by']]['employee_short_name'],'LBR',0,'C');
                if(file_exists($employee_details[$bill_of_material['issued_by']]['signature'])){
                    $this->pdf->Image($employee_details[$bill_of_material['issued_by']]['signature'],$headingx+2,$headingy+1,15,6);
                }
            }else{
                $this->pdf->CellFitScale(20,12,'',1,0,'L');
            }
            
            $this->pdf->SetXY($headingx+=20,$headingy);
             if($bill_of_material['received_by']!=''){
                $this->pdf->CellFitScale(20,6,'','LTR',1,'L');
                $this->pdf->SetX($headingx);
                $this->pdf->CellFitScale(20,6,$employee_details[$bill_of_material['received_by']]['employee_short_name'],'LBR',0,'C');
                if(file_exists($employee_details[$bill_of_material['received_by']]['signature'])){
                    $this->pdf->Image($employee_details[$bill_of_material['received_by']]['signature'],$headingx+2,$headingy+1,15,6);
                }
            }else{
                $this->pdf->CellFitScale(20,12,'',1,0,'L');
            }
            
            $this->pdf->SetXY($headingx+=20,$headingy);
            $this->pdf->CellFitScale(25,12,$bill_of_material['date'],1,0,'C');
            
            $this->pdf->SetXY($headingx+=25,$headingy);
            $this->pdf->CellFitScale(34,12,$bill_of_material['remarks'],1,1,'C');
            
            $this->pagebreak($this->pdf->GetY(),((12*($bomrows))),210,10); //$currentY,$segment_height(rows*each_row_height) or exact height,$page_height,$bottom_margin
            $bomrows++;
        }
        
         ////////////////////////////////////////////////////////////Pre Manufacturing Process/////////////////////////////////////////////////////////////
         
        if($data['stage_one_pre_manufacturing_process']->num_rows()>0){
            $this->pdf->SetFont('Arial','B',12);
            
            $this->pdf->SetXY(10,$this->pdf->GetY()+5);
            $this->pdf->SetFillColor(217,217,217);
            $this->pdf->Cell(277,8,'Pre Manufacturing Process',1,1,'C',1);
            
            $this->pdf->SetFont('Arial','',10);
         
            $headingy = $this->pdf->GetY();
            $headingx = $this->pdf->GetX();
            $w = 0;
            
            $this->pdf->SetXY($headingx,$headingy);
            $this->pdf->CellFitScale($w=13,10,'Item #',1,0,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->CellFitScale($w=70,10,'Description',1,0,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->CellFitScale($w=20,10,'UOM',1,0,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->CellFitScale($w=20,10,'Qunatity',1,0,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->MultiCell($w=34,10,'WI #',1,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->MultiCell($w=30,10,'Equipment #',1,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->MultiCell($w=30,10,'Done By',1,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->MultiCell($w=30,10,'Verified By',1,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->MultiCell($w=30,10,'Date',1,'C');
            
            $pre_mp=0;
            foreach($data['stage_one_pre_manufacturing_process']->result_array() as $pre_manufacturing_process){
                $headingy = $this->pdf->GetY();
                $headingx = $this->pdf->GetX();
                $w=0;
                
                    $this->pdf->SetXY($headingx,$headingy);
                    $this->pdf->CellFitScale($w=13,12,$pre_manufacturing_process['prmp_item_number'],1,0,'C');
                    
                    $this->pdf->SetXY($headingx+=$w,$headingy);
                    $this->pdf->CellFitScale($w=70,12,$pre_manufacturing_process['prmp_item_description'],1,0,'C');
                    
                    $this->pdf->SetXY($headingx+=$w,$headingy);
                    $this->pdf->CellFitScale($w=20,12,$pre_manufacturing_process['prmp_uom'],1,0,'C');
                    
                    $this->pdf->SetXY($headingx+=$w,$headingy);
                    $this->pdf->CellFitScale($w=20,12,$pre_manufacturing_process['prmp_qunatity'],1,0,'C');
                    
                    $this->pdf->SetXY($headingx+=$w,$headingy);
                    $this->pdf->MultiCell($w=34,12,$pre_manufacturing_process['prmp_wi_number'],1,'C');
                    
                    $this->pdf->SetXY($headingx+=$w,$headingy);
                    $this->pdf->MultiCell($w=30,12,$pre_manufacturing_process['prmp_equipment_number'],1,'C');
                    
                    $this->pdf->SetXY($headingx+=$w,$headingy);
                     if($pre_manufacturing_process['prmp_done_by']!=''){
                        $this->pdf->CellFitScale($w=30,6,'','LTR',1,'L');
                        $this->pdf->SetX($headingx);
                        $this->pdf->CellFitScale($w=30,6,$pre_manufacturing_process['prmp_done_by'],'LBR',0,'C');
                       
                    }else{
                        $this->pdf->CellFitScale($w=30,12,'',1,0,'L');
                    }
                    
                    $this->pdf->SetXY($headingx+=$w,$headingy);
                     if($pre_manufacturing_process['prmp_verified_by']!=''){
                        $this->pdf->CellFitScale($w=30,6,'','LTR',1,'L');
                        $this->pdf->SetX($headingx);
                        $this->pdf->CellFitScale($w=30,6,$employee_details[$pre_manufacturing_process['prmp_verified_by']]['employee_short_name'],'LBR',0,'C');
                        if(file_exists($employee_details[$pre_manufacturing_process['prmp_verified_by']]['signature'])){
                            $this->pdf->Image($employee_details[$pre_manufacturing_process['prmp_verified_by']]['signature'],$headingx+2,$headingy+1,15,6);
                        }
                    }else{
                        $this->pdf->CellFitScale($w=30,12,'',1,0,'L');
                    }
                    $this->pdf->SetXY($headingx+=$w,$headingy);
                    $this->pdf->MultiCell($w=30,12,$pre_manufacturing_process['prmp_date'],1,'C');
                    
                     $this->pagebreak($this->pdf->GetY(),((12*($pre_mp))),210,10); //$currentY,$segment_height(rows*each_row_height) or exact height,$page_height,$bottom_margin
                $pre_mp++;
            }
        }
            
       ///////////////////////////////////////////////////////////////////////Manufacturing Process/////////////////////////////////////////////////////////////////////////// 
        $this->pdf->AddPage('L','','A4');
        $this->pdf->SetAutoPageBreak(1);
        // $this->pdf->SetFont('Arial','B',12);
        // $this->pdf->Image(LOGO_PATH,20,10,25,10);
        // $this->pdf->Cell(50,10,'',1,0,'C');
        // $this->pdf->Cell(227,10,'Device History Record',1,1,'C');
        
        $this->pdf->SetFont('Arial','B',12);
        
        $this->pdf->SetXY(10,$this->pdf->GetY()+0);
        $this->pdf->SetFillColor(217,217,217);
        $this->pdf->Cell(277,8,'Manufacturing Process',1,1,'C',1);
        
        $this->pdf->SetFont('Arial','',10);
     
        $headingy = $this->pdf->GetY();
        $headingx = $this->pdf->GetX();
        $w = 0;
        
        $this->pdf->SetXY($headingx,$headingy);
        $this->pdf->CellFitScale($w=13,12,'Seq.#',1,0,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->CellFitScale($w=40,12,'Process Description',1,0,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->CellFitScale($w=24.5,12,'WI #',1,0,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->CellFitScale($w=24.5,12,'Equipment #',1,0,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->MultiCell($w=20,6,'Start'.PHP_EOL.'Date/Time',1,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->MultiCell($w=20,6,'End'.PHP_EOL.'Date/Time',1,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->MultiCell($w=25,6,'Manufactured'.PHP_EOL.'Quantity',1,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->MultiCell($w=18,6,'Good'.PHP_EOL.'Quantity',1,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->MultiCell($w=20,6,'Rejected'.PHP_EOL.'Quantity',1,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->MultiCell($w=19,6,'Done'.PHP_EOL.'By',1,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->MultiCell($w=19,6,'Verified'.PHP_EOL.'By',1,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->MultiCell($w=19,4,'Line'.PHP_EOL.'Clearance By',1,'C');
        
         $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->CellFitScale($w=15,12,'Remarks',1,1,'C');
        
        $mp=0;
        foreach($data['stage_one_manufacturing_process']->result_array() as $manufacturing_process){
            $headingy = $this->pdf->GetY();
            $headingx = $this->pdf->GetX();
            $w=0;
            $this->pdf->SetXY($headingx,$headingy);
            $this->pdf->CellFitScale($w=13,12,$manufacturing_process['mp_seq_number'],1,0,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->CellFitScale($w=40,12,$manufacturing_process['mp_process_description'],1,0,'L');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->CellFitScale($w=24.5,12,$manufacturing_process['mp_wi_number'],1,0,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->CellFitScale($w=24.5,12,$manufacturing_process['mp_equipment_number'],1,0,'C');
            
            $this->pdf->SetFont('Arial','',9);
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $mpsdt = explode(' ',$manufacturing_process['mp_start_datetime']);
            $this->pdf->MultiCell($w=20,($manufacturing_process['mp_start_datetime']=='NA'?12:6),implode(PHP_EOL,$mpsdt),1,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $mpedt = explode(' ',$manufacturing_process['mp_end_datetime']);
            $this->pdf->MultiCell($w=20,($manufacturing_process['mp_end_datetime']=='NA'?12:6),implode(PHP_EOL,$mpedt),1,'C');
            $this->pdf->SetFont('Arial','',10);
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->CellFitScale($w=25,12,$manufacturing_process['mp_manufactured_qunatity'],1,0,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->CellFitScale($w=18,12,$manufacturing_process['mp_good_qunatity'],1,0,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->CellFitScale($w=20,12,$manufacturing_process['mp_rejected_qunatity'],1,0,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
             if($manufacturing_process['mp_done_by']!=''){
                $this->pdf->CellFitScale($w=19,6,'','LTR',1,'L');
                $this->pdf->SetX($headingx);
                $this->pdf->CellFitScale($w=19,6,$manufacturing_process['mp_done_by'],'LBR',0,'C');
               
            }else{
                $this->pdf->CellFitScale($w=19,12,'',1,0,'L');
            }
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            if($manufacturing_process['mp_verified_by']!=''){
                $this->pdf->CellFitScale($w=19,6,'','LTR',1,'L');
                $this->pdf->SetX($headingx);
                $this->pdf->CellFitScale($w=19,6,$employee_details[$manufacturing_process['mp_verified_by']]['employee_short_name'],'LBR',0,'C');
                if(file_exists($employee_details[$manufacturing_process['mp_verified_by']]['signature'])){
                    $this->pdf->Image($employee_details[$manufacturing_process['mp_verified_by']]['signature'],$headingx+2,$headingy+1,15,6);
                }
            }else{
                 $this->pdf->CellFitScale($w=19,12,'',1,0,'L');
            }
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            if($manufacturing_process['mp_line_clearance_by']!=''){
                $this->pdf->CellFitScale($w=19,6,'','LTR',1,'L');
                $this->pdf->SetX($headingx);
                $this->pdf->CellFitScale($w=19,6,$employee_details[$manufacturing_process['mp_line_clearance_by']]['employee_short_name'],'LBR',0,'C');
                if(file_exists($employee_details[$manufacturing_process['mp_line_clearance_by']]['signature'])){
                    $this->pdf->Image($employee_details[$manufacturing_process['mp_line_clearance_by']]['signature'],$headingx+2,$headingy+1,15,6);
                }
            }else{
                $this->pdf->CellFitScale($w=19,12,'',1,0,'L');
            }
            
            $this->pdf->SetXY($headingx+=$w,$headingy+0.5);
             $this->pdf->SetFont('Arial','',7);
            $this->pdf->MultiCell($w=15,2,$manufacturing_process['mp_remarks']=='NA'?'':$manufacturing_process['mp_remarks'],0,'C');
             $this->pdf->SetFont('Arial','',10);
            $this->pdf->SetXY($headingx,$headingy);
            $this->pdf->CellFitScale($w=15,12,$manufacturing_process['mp_remarks']=='NA'?$manufacturing_process['mp_remarks']:'',1,1,'C');
            
             $this->pagebreak($this->pdf->GetY(),((12*($data['stage_one_manufacturing_process']->num_rows()-$mp))),210,10); //$currentY,$segment_height(rows*each_row_height) or exact height,$page_height,$bottom_margin
             $mp++;
        }
        
        /////////////////////////////////////////////////////////////Post manufacturing Process//////////////////////////////////////////////////////////////
         
       
         $this->pdf->AddPage('L','','A4');
        $this->pdf->SetAutoPageBreak(0);
        // $this->pdf->SetFont('Arial','B',12);
        // $this->pdf->Image(LOGO_PATH,20,10,25,10);
        // $this->pdf->Cell(50,10,'',1,0,'C');
        // $this->pdf->Cell(227,10,'Device History Record',1,1,'C');
        
        
        if($data['stage_one_post_manufacturing_process']->num_rows()>0){
            $this->pdf->SetFont('Arial','B',12);
            
            $this->pdf->SetXY(10,$this->pdf->GetY()+0);
            $this->pdf->SetFillColor(217,217,217);
            $this->pdf->Cell(277,8,'Post Manufacturing Process',1,1,'C',1);
            
            $this->pdf->SetFont('Arial','',10);
         
            $headingy = $this->pdf->GetY();
            $headingx = $this->pdf->GetX();
            $w = 0;
            
            
            $this->pdf->SetXY($headingx,$headingy);
            $this->pdf->CellFitScale($w=12,12,'Seq.#',1,0,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->CellFitScale($w=55,12,'Process Description',1,0,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->CellFitScale($w=30,12,'WI #',1,0,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->CellFitScale($w=30,12,'DCC # (If Applicable)',1,0,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->MultiCell($w=30,12,'Sent Date',1,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->MultiCell($w=30,12,'Cycle #/Report #',1,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->MultiCell($w=30,12,'Process Date',1,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->MultiCell($w=30,12,'Done By',1,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->MultiCell($w=30,12,'Checked By',1,'C');
            $post_mp=0;
            foreach($data['stage_one_post_manufacturing_process']->result_array() as $post_manufacturing_process){
                $headingy = $this->pdf->GetY();
                $headingx = $this->pdf->GetX();
                $w=0;
                $this->pdf->SetXY($headingx,$headingy);
                $this->pdf->CellFitScale($w=12,12,$post_manufacturing_process['pmp_seq_number'],1,0,'C');
                
                $this->pdf->SetXY($headingx+=$w,$headingy);
                $this->pdf->CellFitScale($w=55,12,$post_manufacturing_process['pmp_process_description'],1,0,'C');
                
                $this->pdf->SetXY($headingx+=$w,$headingy);
                $this->pdf->CellFitScale($w=30,12,$post_manufacturing_process['pmp_wi_number'],1,0,'C');
                
                $this->pdf->SetXY($headingx+=$w,$headingy);
                $this->pdf->CellFitScale($w=30,12,$post_manufacturing_process['pmp_dcc_number'],1,0,'C');
                
                $this->pdf->SetXY($headingx+=$w,$headingy);
                $this->pdf->MultiCell($w=30,12,$post_manufacturing_process['pmp_sent_date'],1,'C');
                
                $this->pdf->SetXY($headingx+=$w,$headingy);
                $this->pdf->CellFitScale($w=30,12,$post_manufacturing_process['pmp_cycle_number_or_report_number'],1,0,'C');
                
                $this->pdf->SetXY($headingx+=$w,$headingy);
                $this->pdf->MultiCell($w=30,12,$post_manufacturing_process['pmp_process_date'],1,'C');
                
                $this->pdf->SetXY($headingx+=$w,$headingy);
                 if($post_manufacturing_process['pmp_done_by']!=''){
                    $this->pdf->CellFitScale($w=30,6,'','LTR',1,'L');
                    $this->pdf->SetX($headingx);
                    $this->pdf->CellFitScale($w=30,6,$post_manufacturing_process['pmp_done_by'],'LBR',0,'C');
                   
                }else{
                   $this->pdf->CellFitScale($w=30,12,'',1,0,'L'); 
                }
                
                $this->pdf->SetXY($headingx+=$w,$headingy);
                if($post_manufacturing_process['pmp_checked_by']!=''){
                    $this->pdf->CellFitScale($w=30,6,'','LTR',1,'L');
                    $this->pdf->SetX($headingx);
                    $this->pdf->CellFitScale($w=30,6,$employee_details[$post_manufacturing_process['pmp_checked_by']]['employee_short_name'],'LBR',1,'C');
                    if(file_exists($employee_details[$post_manufacturing_process['pmp_checked_by']]['signature'])){
                        $this->pdf->Image($employee_details[$post_manufacturing_process['pmp_checked_by']]['signature'],$headingx+2,$headingy+1,15,6);
                    }
                }else{
                    $this->pdf->CellFitScale($w=30,12,'',1,1,'L');
                }
                
                $this->pagebreak($this->pdf->GetY(),((12*$post_mp)),210,10); //$currentY,$segment_height(rows*each_row_height) or exact height,$page_height,$bottom_margin
                $post_mp++;
            }
        }
        
         ////////////////////////////////////////////////////////////Quality Control Process/////////////////////////////////////////////////////////////
        
        
       $this->pdf->SetFont('Arial','B',12);
        
        $this->pdf->SetXY(10,$this->pdf->GetY()+5);
        $this->pdf->SetFillColor(217,217,217);
        $this->pdf->Cell(277,8,'Quality Control Process',1,1,'C',1);
        
        $this->pdf->SetFont('Arial','',10);
     
        $headingy = $this->pdf->GetY();
        $headingx = $this->pdf->GetX();
        $w = 0;
        
        $this->pdf->SetXY($headingx,$headingy);
        $this->pdf->CellFitScale($w=13,12,'Seq.#',1,0,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->CellFitScale($w=80,12,'Inspection (Or) Testing Description',1,0,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->CellFitScale($w=44,12,'WI #',1,0,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->CellFitScale($w=40,12,'QIR #/Report #',1,0,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->MultiCell($w=20,6,'Sample Quantity',1,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->CellFitScale($w=20,12,'Pass/Fail',1,0,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->CellFitScale($w=30,12,'Verified By',1,0,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->MultiCell($w=30,12,'Verified Date',1,'C');
        $qc=0;
        foreach($data['stage_one_quality_control_process']->result_array() as $quality_control_process){
            $headingy = $this->pdf->GetY();
            $headingx = $this->pdf->GetX();
            $w = 0;
            
            $this->pdf->SetXY($headingx,$headingy);
            $this->pdf->CellFitScale($w=13,12,$quality_control_process['qcp_seq_number'],1,0,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->CellFitScale($w=80,12,$quality_control_process['qcp_process_inspection_or_testing_description'],1,0,'L');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->CellFitScale($w=44,12,$quality_control_process['qcp_wi_number'],1,0,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->CellFitScale($w=40,12,$quality_control_process['qcp_qir_number_or_report_number'],1,0,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->CellFitScale($w=20,12,$quality_control_process['qcp_sample_quantity'],1,0,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->CellFitScale($w=20,12,$quality_control_process['qcp_pass_or_fail'],1,0,'C');
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            if($quality_control_process['qcp_verified_by']!=''){
                $this->pdf->CellFitScale($w=30,6,'','LTR',1,'L');
                $this->pdf->SetX($headingx);
                $this->pdf->CellFitScale($w=30,6,$employee_details[$quality_control_process['qcp_verified_by']]['employee_short_name'],'LBR',0,'C');
                if(file_exists($employee_details[$quality_control_process['qcp_verified_by']]['signature'])){
                    $this->pdf->Image($employee_details[$quality_control_process['qcp_verified_by']]['signature'],$headingx+5,$headingy+1,15,6);
                }
            }else{
                $this->pdf->CellFitScale($w=30,12,'',1,0,'C');
            }
            
            $this->pdf->SetXY($headingx+=$w,$headingy);
            $this->pdf->MultiCell($w=30,12,$quality_control_process['qcp_verified_date'],1,'C');
            
            $this->pagebreak($this->pdf->GetY(),((12*$qc)),210,10); //$currentY,$segment_height(rows*each_row_height) or exact height,$page_height,$bottom_margin
            $qc++;
        }
            
            ////////////////////////////////////////////////////////////Finished Goods Transfer Note/////////////////////////////////////////////////////////////
             $this->pagebreak($this->pdf->GetY(),20,210,10); //$currentY,$segment_height(rows*each_row_height) or exact height,$page_height,$bottom_margin
        
            $this->pdf->SetFont('Arial','B',12);
            
            $this->pdf->SetXY(10,$this->pdf->GetY()+10);
            $this->pdf->SetFillColor(217,217,217);
            $this->pdf->Cell(277,8,'Finished Goods Transfer Note',1,1,'C',1);
            
                foreach($data['finished_goods_transfer_note']->result_array() as $f_g_transfer_note);
            
                $this->pdf->SetFont('Arial','',10);
                
                $fgtnwidth = 277/3;
                $this->pdf->CellFitScale($fgtnwidth,12,'Transferred Quantity : '.$f_g_transfer_note['transferred_quantity'],1,0,'L');
                
                $this->pdf->CellFitScale($fgtnwidth/2,12,'Transferred By (Sign) : '.$f_g_transfer_note['transferred_date'],'TLB',0,'L');
                $tqafterx = $this->pdf->GetX();
                if($f_g_transfer_note['transferred_by']!=''){
                    $this->pdf->CellFitScale($fgtnwidth/2,6,'','TR',1,'C');
                    if(file_exists($employee_details[$f_g_transfer_note['transferred_by']]['signature'])){
                        $this->pdf->Image($employee_details[$f_g_transfer_note['transferred_by']]['signature'],$tqafterx+15,$this->pdf->GetY()-5,15,6);
                    }
                    $this->pdf->SetXY($tqafterx,$this->pdf->GetY());
                    $this->pdf->CellFitScale($fgtnwidth/2,6,$employee_details[$f_g_transfer_note['transferred_by']]['employee_short_name'],'BR',0,'C');
                }else{
                    $this->pdf->CellFitScale($fgtnwidth/2,12,'','TRB',0,'C');
                    $this->pdf->SetXY($this->pdf->GetX(),$this->pdf->GetY()+6);
                }
                
                $this->pdf->SetXY($this->pdf->GetX(),$this->pdf->GetY()-6);
                $this->pdf->CellFitScale($fgtnwidth/2,12,'Accepted By (Sign) : '.$f_g_transfer_note['accepted_date'],'TLB',0,'L');
                $tqafterx = $this->pdf->GetX();
                if($f_g_transfer_note['accepted_by']!=''){
                    $this->pdf->CellFitScale($fgtnwidth/2,6,'','TR',1,'C');
                    if(file_exists($employee_details[$f_g_transfer_note['accepted_by']]['signature'])){
                        $this->pdf->Image($employee_details[$f_g_transfer_note['accepted_by']]['signature'],$tqafterx+15,$this->pdf->GetY()-5,15,6);
                    }
                    $this->pdf->SetXY($tqafterx,$this->pdf->GetY());
                    $this->pdf->CellFitScale($fgtnwidth/2,6,$employee_details[$f_g_transfer_note['accepted_by']]['employee_short_name'],'BR',1,'C');
                }else{
                    $this->pdf->CellFitScale($fgtnwidth/2,12,'','TRB',1,'C');
                }
            
            
        ////////////////////////////////////////////////////////////Material Reconciliation/////////////////////////////////////////////////////////////
        
        $this->pdf->AddPage('L','','A4');
        $this->pdf->SetAutoPageBreak(0);
        // $this->pdf->SetFont('Arial','B',12);
        // $this->pdf->Image(LOGO_PATH,20,10,25,10);
        // $this->pdf->Cell(50,10,'',1,0,'C');
        // $this->pdf->Cell(227,10,'Device History Record',1,1,'C');
        
        $this->pdf->SetFont('Arial','B',12);
        
        $this->pdf->SetXY(10,$this->pdf->GetY()+0);
        $this->pdf->SetFillColor(217,217,217);
        $this->pdf->Cell(277,8,'Material Reconciliation',1,1,'C',1);
        
        $this->pdf->SetFont('Arial','',10);
     
        $headingy = $this->pdf->GetY();
        $headingx = $this->pdf->GetX();
        $w = 0;
        
        $this->pdf->SetXY($headingx,$headingy);
        $this->pdf->CellFitScale($w=22,12,'Item. #',1,0,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->CellFitScale($w=65,12,'Description',1,0,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->CellFitScale($w=20,12,'UOM',1,0,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->MultiCell($w=20,6,'Quantity Received',1,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->MultiCell($w=20,12,'QIR #',1,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->MultiCell($w=20,6,'Item Lot # (Input Lot)',1,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->CellFitScale($w=30,12,'Returned By',1,0,'C');
        
        $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->MultiCell($w=30,12,'Received By',1,'C');
        
         $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->MultiCell($w=20,12,'Date',1,'C');
        
         $this->pdf->SetXY($headingx+=$w,$headingy);
        $this->pdf->MultiCell($w=30,12,'Remarks',1,'C');
        
        
        $mrc=0;
        foreach($data['stage_one_material_reconciliation']->result_array() as $material_reconciliation){
            $headingy = $this->pdf->GetY();
                $headingx = $this->pdf->GetX();
                $w = 0;
                
                $this->pdf->SetXY($headingx,$headingy);
                $this->pdf->CellFitScale($w=22,12,$material_reconciliation['mrec_item_number'],1,0,'C');
                
                $this->pdf->SetXY($headingx+=$w,$headingy);
                $this->pdf->CellFitScale($w=65,12,$material_reconciliation['mrec_description'],1,0,'L');
                
                $this->pdf->SetXY($headingx+=$w,$headingy);
                $this->pdf->CellFitScale($w=20,12,$material_reconciliation['mrec_uom'],1,0,'C');
                
                $this->pdf->SetXY($headingx+=$w,$headingy);
                $this->pdf->MultiCell($w=20,12,$material_reconciliation['mrec_quantity_received'],1,'C');
                
                $this->pdf->SetXY($headingx+=$w,$headingy);
                $this->pdf->CellFitScale($w=20,12,$material_reconciliation['mrec_qir_number'],1,0,'C');
                
                $this->pdf->SetXY($headingx+=$w,$headingy);
                $this->pdf->CellFitScale($w=20,12,$material_reconciliation['mrec_item_lot_number_or_input_lot'],1,0,'C');
                
                $this->pdf->SetXY($headingx+=$w,$headingy);
                if($material_reconciliation['mrec_returned_by']!=''){
                    $this->pdf->CellFitScale($w=30,6,'','LTR',1,'L');
                    $this->pdf->SetX($headingx);
                    $this->pdf->CellFitScale($w=30,6,$employee_details[$material_reconciliation['mrec_returned_by']]['employee_short_name'],'LBR',0,'C');
                    if(file_exists($employee_details[$material_reconciliation['mrec_returned_by']]['signature'])){
                        $this->pdf->Image($employee_details[$material_reconciliation['mrec_returned_by']]['signature'],$headingx+8,$headingy+1,15,6);
                    }
                }else{
                    $this->pdf->CellFitScale($w=30,12,'',1,0,'L');
                }
                
                $this->pdf->SetXY($headingx+=$w,$headingy);
                if($material_reconciliation['mrec_received_by']!=''){
                    $this->pdf->CellFitScale($w=30,6,'','LTR',1,'L');
                    $this->pdf->SetX($headingx);
                    $this->pdf->CellFitScale($w=30,6,$employee_details[$material_reconciliation['mrec_received_by']]['employee_short_name'],'LBR',0,'C');
                    if(file_exists($employee_details[$material_reconciliation['mrec_received_by']]['signature'])){
                        $this->pdf->Image($employee_details[$material_reconciliation['mrec_received_by']]['signature'],$headingx+8,$headingy+1,15,6);
                    }
                }else{
                    $this->pdf->CellFitScale($w=30,12,'',1,0,'L');
                }
                
                 $this->pdf->SetXY($headingx+=$w,$headingy);
                $this->pdf->CellFitScale($w=20,12,$material_reconciliation['mrec_date'],1,0,'C');
                
                 $this->pdf->SetXY($headingx+=$w,$headingy);
                $this->pdf->MultiCell($w=30,12,$material_reconciliation['mrec_remark'],1,'C');
                
                $this->pagebreak($this->pdf->GetY(),((12*$mrc)),210,10); //$currentY,$segment_height(rows*each_row_height) or exact height,$page_height,$bottom_margin
                $mrc++;
            }
            
             ////////////////////////////////////////////////////////////Finished Goods Reconciliation/////////////////////////////////////////////////////////////
            $this->pagebreak($this->pdf->GetY(),20,210,10); //$currentY,$segment_height(rows*each_row_height) or exact height,$page_height,$bottom_margin
            
            $this->pdf->SetFont('Arial','B',12);
            
            $this->pdf->SetXY(10,$this->pdf->GetY()+5);
            $this->pdf->SetFillColor(217,217,217);
            $this->pdf->Cell(277,8,'Finished Goods Reconciliation',1,1,'C',1);
            
            $this->pdf->SetFont('Arial','',10);
            foreach($data['stage_one_finished_goods_reconcillation']->result_array() as $finished_goods_reconcillation);
            $fgrwidth = 277/2;
            $this->pdf->Cell($fgrwidth,8,'Total Quantity Produced and Packed',1,0,'L'); 
            $this->pdf->Cell($fgrwidth,8,$finished_goods_reconcillation['total_quantity_produced_and_packed'],1,1,'L');
            // $this->pdf->Cell($fgrwidth,8,'Penetration Samples Quantity',1,0,'L'); 
            // $this->pdf->Cell($fgrwidth,8,$finished_goods_reconcillation['penetration_samples_quantity'],1,1,'L'); 
            $this->pdf->Cell($fgrwidth,8,'Archive Samples Quantity',1,0,'L'); 
            $this->pdf->Cell($fgrwidth,8,$finished_goods_reconcillation['control_samples_quantity'],1,1,'L');
            $this->pdf->Cell($fgrwidth,8,'Rejected Quantity',1,0,'L');
            $this->pdf->Cell($fgrwidth,8,$finished_goods_reconcillation['rejected_quantity'],1,1,'L');
            $this->pdf->Cell($fgrwidth,8,'Yield (Percentage)',1,0,'L');
            $this->pdf->Cell($fgrwidth,8,$finished_goods_reconcillation['yield_percentage'].'%',1,1,'L');
            
            $this->pdf->SetFont('Arial','B',10);
            $this->pdf->SetXY(10,$this->pdf->GetY()+5);
            $this->pdf->SetFillColor(217,217,217);
          
            $this->pdf->CellFitScale($fgrwidth/2,12,'Verified By - Production Head (Signature) '.$finished_goods_reconcillation['production_verified_date'],'LTB',0,'C');
            $tqafterx = $this->pdf->GetX();
            if($finished_goods_reconcillation['production_verified_by']!=''){
                $this->pdf->CellFitScale($fgrwidth/2,6,'','TR',1,'C');
                if(file_exists($employee_details[$finished_goods_reconcillation['production_verified_by']]['signature'])){
                    $this->pdf->Image($employee_details[$finished_goods_reconcillation['production_verified_by']]['signature'],$tqafterx+25,$this->pdf->GetY()-5,15,6);
                }
                $this->pdf->SetXY($tqafterx,$this->pdf->GetY());
                $this->pdf->CellFitScale($fgrwidth/2,6,$employee_details[$finished_goods_reconcillation['production_verified_by']]['employee_short_name'],'BR',0,'C');
            }else{
                $this->pdf->CellFitScale($fgrwidth/2,12,'','TRB',0,'C');
                $this->pdf->SetXY($this->pdf->GetX(),$this->pdf->GetY()+6);
            }
            
            $this->pdf->SetXY($this->pdf->GetX(),$this->pdf->GetY()-6);
            $this->pdf->CellFitScale($fgrwidth/2,12,'Checked By - Quality Control Head (Signature) '.$finished_goods_reconcillation['checked_by_quality_control_date'],'TLB',0,'L');
            $tqafterx = $this->pdf->GetX();
            if($finished_goods_reconcillation['checked_by_quality_control']!=''){
                $this->pdf->CellFitScale($fgrwidth/2,6,'','TR',1,'C');
                if(file_exists($employee_details[$finished_goods_reconcillation['checked_by_quality_control']]['signature'])){
                    $this->pdf->Image($employee_details[$finished_goods_reconcillation['checked_by_quality_control']]['signature'],$tqafterx+25,$this->pdf->GetY()-5,15,6);
                }
                $this->pdf->SetXY($tqafterx,$this->pdf->GetY());
                $this->pdf->CellFitScale($fgrwidth/2,6,$employee_details[$finished_goods_reconcillation['checked_by_quality_control']]['employee_short_name'],'BR',1,'C');
            }else{
                $this->pdf->CellFitScale($fgrwidth/2,12,'','TRB',1,'C');
            }
            
            $this->pdf->CellFitScale(277/2,12,'Remarks:'.$finished_goods_reconcillation['production_verified_by_remarks'],1,0,'L');
            $this->pdf->CellFitScale(277/2,12,'Remarks:'.$finished_goods_reconcillation['checked_by_quality_control_remark'],1,1,'L');
            
            ////////////////////////////////////////////////////////////QA Approval and Release/////////////////////////////////////////////////////////////
        
            $this->pagebreak($this->pdf->GetY(),(12*3),210,10); //$currentY,$segment_height(rows*each_row_height),$page_height,$bottom_margin
           
           $this->pdf->SetFont('Arial','B',12);
            
            $this->pdf->SetXY(10,$this->pdf->GetY()+10);
            $this->pdf->SetFillColor(217,217,217);
            $this->pdf->Cell(277,8,'QA Approval and Release',1,1,'C',1);
            
            $this->pdf->SetFont('Arial','',10);
            foreach($data['stage_one_qa_approval_and_release']->result_array() as $qa_approval_and_release);
            
             $qaarwidth = 277/4;
            $this->pdf->CellFitScale($qaarwidth,12,'Quantity Released for Dispatch',1,0,'L'); 
            $this->pdf->CellFitScale($qaarwidth,12,$qa_approval_and_release['quantity_released_for_dispatch'],1,0,'L');
            $this->pdf->CellFitScale($qaarwidth,12,'Date Of Release',1,0,'L'); 
            $this->pdf->CellFitScale($qaarwidth,12,$qa_approval_and_release['date_of_release'],1,1,'L');
            $this->pdf->CellFitScale($qaarwidth,12,'Remarks',1,0,'L');
            $this->pdf->CellFitScale($qaarwidth,12,$qa_approval_and_release['remarks'],1,0,'L');
            $this->pdf->CellFitScale($qaarwidth,12,'Signature',1,0,'L');
           
            $tqafterx = $this->pdf->GetX();
            if($qa_approval_and_release['signature']!=''){
                $this->pdf->CellFitScale($qaarwidth,6,'','TR',1,'C');
                if(file_exists($employee_details[$qa_approval_and_release['signature']]['signature'])){
                    $this->pdf->Image($employee_details[$qa_approval_and_release['signature']]['signature'],$tqafterx+25,$this->pdf->GetY()-5,15,6);
                }
                $this->pdf->SetXY($tqafterx,$this->pdf->GetY());
                $this->pdf->CellFitScale($qaarwidth,6,$employee_details[$qa_approval_and_release['signature']]['employee_short_name'],'BR',1,'C');
            }else{
                $this->pdf->CellFitScale($qaarwidth,12,'',1,1,'C');
            }
            
        $this->pdf->AliasNbPages();
        $this->pdf->Output();
        
    }
    
    function pagebreak($currentY,$segment_height,$page_height,$bottom_margin){
            if($currentY+$segment_height > $page_height-$bottom_margin){
               $this->pdf->AddPage('L','','A4');
               $this->pdf->SetAutoPageBreak(0);
           }
    }
    
     function coa_form($coa_id){
        $coa_details = $coa_parameter   = $coa_footer_note = NULL;
      
        $data = $this->ShahPDFM->coa_form_details($coa_id);
        
        
        $employee_details=$data['employee_details'];
        
        foreach($data['coa_details']->result_array() as $coa_details);
        foreach($data['coa_footer_note']->result_array() as $footer_note);
        
        
        $this->pdf->setHeaderForNextPage(array('title'=>'Certificate Of Analysis'));
        $this->pdf->setFooterForNextPage($footer_note);
        $this->pdf->AddPage('L','','A4');
        $this->pdf->SetAutoPageBreak(1);
       
        
        ////////////////////////////////////////////////////////////Order Information/////////////////////////////////////////////////////////////
        
        $this->pdf->SetXY(10,$this->pdf->GetY()+0);
        $this->pdf->SetFillColor(217,217,217);
        
        $this->pdf->SetFont('Arial','B',10);
        $this->pdf->Cell(50,8,'Product Description',1,0,'L',1);
        $this->pdf->SetFont('Arial','',10);
        
        $this->pdf->CellFitScale(125,8,$coa_details['product_description']==''?'NA':$coa_details['product_description'],1,0,'L');
        
        $this->pdf->SetFont('Arial','B',10);
        $this->pdf->Cell(50,8,'Lot/Batch No.',1,0,'L',1);
        $this->pdf->SetFont('Arial','',10);
        
        $this->pdf->CellFitScale(52,8,$coa_details['lot_or_batch_no']==''?'NA':$coa_details['lot_or_batch_no'],1,1,'L');
        
        $this->pdf->SetFont('Arial','B',10);
        $this->pdf->Cell(50,8,'Product Code',1,0,'L',1);
        $this->pdf->SetFont('Arial','',10);
        
        $this->pdf->CellFitScale(125,8,$coa_details['product_code']==''?'NA':$coa_details['product_code'],1,0,'L');
        
        $this->pdf->SetFont('Arial','B',10);
        $this->pdf->Cell(50,8,'Released Quantity',1,0,'L',1);
        $this->pdf->SetFont('Arial','',10);
        
        $this->pdf->CellFitScale(52,8,$coa_details['released_quantity']==''?'NA':$coa_details['released_quantity'],1,1,'L');
        
        
        $this->pdf->SetFont('Arial','B',10);
        $this->pdf->Cell(50,8,'Brand (If Applicable)',1,0,'L',1);
        $this->pdf->SetFont('Arial','',10);
        
        $this->pdf->CellFitScale(125,8,$coa_details['brand']==''?'NA':$coa_details['brand'],1,0,'L');
        
        $this->pdf->SetFont('Arial','B',10);
        $this->pdf->Cell(50,8,'Reference DHR No.',1,0,'L',1);
        $this->pdf->SetFont('Arial','',10);
        
        $this->pdf->CellFitScale(52,8,$coa_details['reference_dhr_no']==''?'NA':$coa_details['reference_dhr_no'],1,1,'L');
       
     
        ////////////////////////////////////////////////////////////COA Parameters/////////////////////////////////////////////////////////////
       
        
         $parameterwidth = 250/4;
        $headingy = $this->pdf->GetY()+4;
        $headingx = $this->pdf->GetX();
        
         $this->pdf->SetFont('Arial','B',10);
        $this->pdf->SetXY($headingx,$headingy);
        $this->pdf->CellFitScale(27,10,'Sl. No.',1,0,'C',1);
        
        $this->pdf->SetXY($headingx+=27,$headingy);
        $this->pdf->CellFitScale($parameterwidth,10,'Parameter',1,0,'C',1);
        
        $this->pdf->SetXY($headingx+=$parameterwidth,$headingy);
        $this->pdf->CellFitScale($parameterwidth,10,'Requirement',1,0,'C',1);
        
        $this->pdf->SetXY($headingx+=$parameterwidth,$headingy);
        $this->pdf->MultiCell($parameterwidth,10,'Result/Observation',1,'C',1);
        
        $this->pdf->SetXY($headingx+=$parameterwidth,$headingy);
        $this->pdf->MultiCell($parameterwidth,10,'Complied/Not Complied',1,'C',1);
         $this->pdf->SetFont('Arial','',10);
       
        $p=1;
        foreach($data['coa_parameter']->result_array() as $coa_parameter){
            $headingy = $this->pdf->GetY();
            $headingx = $this->pdf->GetX();
            
            $this->pdf->SetXY($headingx,$headingy);
            $this->pdf->CellFitScale(27,12,$p,1,0,'C');
            
            $this->pdf->SetXY($headingx+=27,$headingy);
            $this->pdf->CellFitScale($parameterwidth,12,$coa_parameter['parameter'],1,0,'C');
            
            $this->pdf->SetXY($headingx+=$parameterwidth,$headingy);
            $this->pdf->CellFitScale($parameterwidth,12,$coa_parameter['requirement'],1,0,'C');
            
            $this->pdf->SetXY($headingx+=$parameterwidth,$headingy);
            $this->pdf->CellFitScale($parameterwidth,12,$coa_parameter['result_or_observation'],1,0,'C');
            
            $this->pdf->SetXY($headingx+=$parameterwidth,$headingy);
            $this->pdf->CellFitScale($parameterwidth,12,$coa_parameter['complied_or_not_complied'],1,1,'C');
           
            $p++;
        }
        
        $this->pdf->SetFont('Arial','B',10);
        $this->pdf->Cell(20,8,'Remarks ','LTB',0,'L',1);
        $this->pdf->SetFont('Arial','',10);
        $this->pdf->Cell(257,8,$coa_details['remarks'],'RTB',1,'L',1);
            
           
           
            $headingy = $this->pdf->GetY();
            $headingx = $this->pdf->GetX();
            
            $this->pdf->SetXY($headingx,$headingy+4);
            
            $qaarwidth = 277/4;
             $this->pdf->SetFont('Arial','B',10);
            $this->pdf->CellFitScale($qaarwidth,12,'Prepared By',1,0,'L',1); 
             $this->pdf->SetFont('Arial','',10);
            $this->pdf->CellFitScale($qaarwidth,12,isset($employee_details[$coa_details['prepared_by'] ?? ''])?$employee_details[$coa_details['prepared_by']]['employee_name']:'',1,0,'L');
            if(file_exists(isset($employee_details[$coa_details['prepared_by'] ?? ''])?$employee_details[$coa_details['prepared_by']]['signature']:'')){
                $this->pdf->Image($employee_details[$coa_details['prepared_by']]['signature'],$headingx+100,$headingy+6,15,8);
            }
             $this->pdf->SetFont('Arial','B',10);
            $this->pdf->CellFitScale($qaarwidth,12,'Approved By',1,0,'L',1); 
             $this->pdf->SetFont('Arial','',10);
             
            $this->pdf->CellFitScale($qaarwidth,12,isset($employee_details[$coa_details['approved_by'] ?? ''])?$employee_details[$coa_details['approved_by']]['employee_name']:'',1,1,'L');
            if(file_exists(isset($employee_details[$coa_details['approved_by'] ?? ''])?$employee_details[$coa_details['approved_by']]['signature']:'')){
                $this->pdf->Image($employee_details[$coa_details['approved_by']]['signature'],$headingx+240,$headingy+6,15,8);
            }
             $this->pdf->SetFont('Arial','B',10);
            $this->pdf->CellFitScale($qaarwidth,12,'Date ',1,0,'L',1); 
             $this->pdf->SetFont('Arial','',10);
            $this->pdf->CellFitScale($qaarwidth,12,$coa_details['prepared_by_date'],1,0,'L');
            
             $this->pdf->SetFont('Arial','B',10);
            $this->pdf->CellFitScale($qaarwidth,12,'Date',1,0,'L',1); 
             $this->pdf->SetFont('Arial','',10);
            $this->pdf->CellFitScale($qaarwidth,12,$coa_details['approved_by_date'],1,1,'L');
           
           
           
            
            $this->pdf->AliasNbPages();
        
        $this->pdf->Output();
        
    }

} ?>