<?php

defined('BASEPATH') OR exit('direct script access not allowed');

class AllPdf extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('pdf'); // Load library
        $this->pdf->fontpath = 'font/'; // Specify font folder
        $this->load->model('AdminM');
        $this->load->database();
        ini_set('memory_limit','1024M');
        ini_set('max_execution_time','1200000000000000000');
    }

    function idcard() {
        extract($this->input->post());
        $this->PhotoCard($this->input->post());
//        if ($side == 'FRONT') {
//            $this->VerticalBulkIDCard($this->input->post());
//        } else if ($side == 'BACK') {
//            $this->VerticalBulkIDCardback($this->input->post());
//        }
    }
    
    function Photocard($post_data){
        $member_id=NULL;
        extract($post_data);
        
        for ($i = 0; $i < count($member_id); $i++) {
             $this->pdf->AddPage('P', array(102,152), 0);
                $this->pdf->SetAutoPageBreak(1);
           $x = 10;$y = 10; 
           $this->pdf->SetLineWidth(1);
           $this->pdf->SetDrawColor(55,160,255);
            if(file_exists('id/idfront.png')){
                 $this->pdf->Image('id/idfront.png', $x, $y+0.5, 84.5, 54);
            }
             if(file_exists('id/idback.png')){
                 $this->pdf->Image('id/idback.png', $x, $y+65, 85, 55);
            }
           
            
            $this->pdf->Rect($x, $y, 85, 55, 'D'); //idfront
            
            $this->pdf->Rect($x, $y+65, 85, 55, 'D'); //idback
            
            
           
            $this->pdf->SetTextColor(0, 0, 0);

            $this->pdf->SetFont('Times', 'B', 10);
            $this->pdf->SetXY($x, $y);
          
            
           $members = $this->db->select('*')->from('customers_detail')->where('member_id', $member_id[$i])->get();
                foreach ($members->result_array() as $sinfo);
                
            $this->pdf->SetFont('Times', 'B', 7.5);
            
            $this->pdf->SettextColor(255,0,0);
            
             $this->pdf->SetXY($x+8, $y+6.5);
            $this->pdf->CellFitScale(31,4,strtoupper($sinfo['jille']),0,1,'L');
              $this->pdf->SetXY($x+61, $y+6.5);
            $this->pdf->CellFitScale(24,4,strtoupper($sinfo['taluk']),0,1,'L');
            
             $this->pdf->SetXY($x+14, $y+13.5);
            $this->pdf->CellFitScale(31.5,4,strtoupper($sinfo['grama_panchaaythi']),0,1,'L');
             $this->pdf->SetXY($x+53, $y+13.5);
            $this->pdf->CellFitScale(31,4,strtoupper($sinfo['grama']),0,1,'L');
            
              $this->pdf->SetXY($x+16.5, $y+17.5);
             $this->pdf->SetFont('Times', 'B', 11);
            $this->pdf->CellFitScale(30,4,strtoupper($sinfo['aadhaar_number']),0,1,'L');
             $this->pdf->SetFont('Times', 'B', 7.5);
             $this->pdf->SetXY($x+64, $y+17.5);
            $this->pdf->CellFitScale(32,4,strtoupper($sinfo['mobile_number']),0,1,'L');
            
            $this->pdf->SetXY($x+2, $y+26.5);
            $this->pdf->CellFitScale(32,4,strtoupper($sinfo['mane_number']),0,1,'L');
             $this->pdf->SetXY($x+58, $y+26.5);
            $this->pdf->CellFitScale(32,4,strtoupper($sinfo['chunavane_guruthina_number']),0,1,'L');
            
             $this->pdf->SetXY($x+2, $y+32.5);
            $this->pdf->CellFitScale(32,4,strtoupper($sinfo['ward_number']),0,1,'L');
              $this->pdf->SetXY($x+58, $y+32.5);
            $this->pdf->CellFitScale(26,4,strtoupper($sinfo['padithara_guruthina_number']),0,1,'L');
            
            
            $this->pdf->SetXY($x+2, $y+38.3);
            $this->pdf->CellFitScale(26,4,strtoupper($sinfo['rr_number']),0,1,'L');
             $this->pdf->SetXY($x+58, $y+38.3);
            $this->pdf->CellFitScale(26,4,strtoupper($sinfo['gas_number']),0,1,'L');
            
             $this->pdf->SetXY($x+2, $y+44);
            $this->pdf->CellFitScale(32,4,strtoupper($sinfo['paan_card_number']),0,1,'L');
            $this->pdf->SetXY($x+58, $y+44);
            $this->pdf->CellFitScale(26,4,strtoupper($sinfo['krushi_card_number']),0,1,'L');
            
            
            $this->pdf->SetXY($x+2, $y+50.4);
            $this->pdf->CellFitScale(32,4,strtoupper($sinfo['account_number']),0,1,'L');
             $this->pdf->SetXY($x+58, $y+50.4);
            $this->pdf->CellFitScale(26,4,strtoupper($sinfo['jaathi']),0,1,'L');
            
            $this->pdf->SetFont('Times', 'B', 8);
            $this->pdf->SettextColor(35, 25, 145);
            $this->pdf->SetXY($x+2, $y+21);
            $this->pdf->CellFitScale(81,4,strtoupper($sinfo['arjidaarana_hesaru']),0,1,'C');
            $this->pdf->SettextColor(255,0,0);
            $this->pdf->SetFont('Times', 'B', 7.5);
            
            if (file_exists($sinfo['photo'])) {
                 $this->pdf->ClippingRect($x + 37, $y + 27, 14, 17,true);
                    $this->pdf->Image($sinfo['photo'], $x + 37, $y + 27, 14, 17);
                $this->pdf->UnsetClipping(); 
            }
            
            $this->pdf->SetFont('Times', 'B', 5.5);
            $this->pdf->SetLineWidth(0.2);
            $this->pdf->SetXY($x+2,$y+78);
            $members_relations = $this->db->select('*')->from('backside_detail')->where('member_id', $member_id[$i])->get();
                $k=1;
                $ystart=$this->pdf->GetY();
                foreach ($members_relations->result_array() as $relatives){
                        $this->pdf->MultiCell(10, 0, '', 0);
                        $x1 = $this->pdf->GetX();
                        $y1 = $this->pdf->GetY();
                        $c = 0;
                        $this->pdf->CellFitScale($w = 2.9, 3, $k, 0,1, 'L');
                        $c += $w;
                        $this->pdf->SetXY($x1 + $c, $y1);
                        $this->pdf->SetFont('Times', 'B', 5.3);
                        $this->pdf->MultiCell($w = 14.2, 2, $relatives['hesaru'],0, 'L');
                        $this->pdf->SetFont('Times', 'B', 5.5);
                        $c += $w;
                        $this->pdf->SetXY($x1 + $c, $y1);
                        $this->pdf->CellFitScale($w = 11.5, 3, $relatives['sambhanda'],0, 1, 'L');
                        $c += $w;
                        $this->pdf->SetXY($x1 + $c, $y1);
                        $this->pdf->CellFitScale($w = 13.9, 3, $relatives['aadhar_sankye'],0, 1, 'L');
                        $c += $w;
                        $this->pdf->SetXY($x1 + $c, $y1);
                        $this->pdf->CellFitScale($w = 15.5, 3, $relatives['chu_gu_no'], 0,1, 'L');
                        $c += $w;
                        $this->pdf->SetXY($x1 + $c, $y1);
                        $this->pdf->CellFitScale($w = 12.5, 3, $relatives['pan_card_no'],0, 1, 'L');
                        $c += $w;
                        $this->pdf->SetXY($x1 + $c, $y1);
                        $this->pdf->CellFitScale($w = 14, 3, $relatives['janadhana_khaathe_sankye'],0, 1, 'L');
                        $this->pdf->Ln(3);
                       
                        $p = $this->pdf->GetY();
                        $this->pdf->Line($x,$p,$x+85,$p);
                        $k++;
                }
                $xstart =$x;
                if($members_relations->num_rows()>0){
                $this->pdf->Line($xstart+=2.9,$ystart,$xstart,$p);
                $this->pdf->Line($xstart+=14.2,$ystart,$xstart,$p);
                $this->pdf->Line($xstart+=11.5,$ystart,$xstart,$p);
                $this->pdf->Line($xstart+=13.9,$ystart,$xstart,$p);
                $this->pdf->Line($xstart+=15.5,$ystart,$xstart,$p);
                $this->pdf->Line($xstart+=12.5,$ystart,$xstart,$p);
                }
            $this->pdf->SetLineWidth(1);
            $this->pdf->SetFont('Times', 'B', 7);
            $this->pdf->SetTextColor(0, 0, 0);
        }

        $this->pdf->Output();
    }

    function VerticalBulkIDCard($post_data) {
        $member_id=NULL;
        extract($post_data);
        
        $x = 10;$y = 10;$som = 0;
        $this->pdf->AddPage('P', 'A4', 0);
        $this->pdf->SetAutoPageBreak(false);

       
         for ($i = 0; $i < count($member_id); $i++) {
           

            if ($som == 10) {
                $this->pdf->AddPage('P', 'A4', 0);

                $this->pdf->SetAutoPageBreak(true);
                
                $y = 10;
                $som = 0;
            }
            

            if ($i > 0) {
                if ($i % 2 == 0) {
                   
                    $y += 58;
                   $x=10; 
                }else{
                    $x +=  95;
                }
            }else if ($i == 0){
                
                $y = 10;
                $som = 0;
            }
            
            
            
            
            
           
            
            $this->pdf->Rect($x, $y, 85, 55, 'D');
            
            
            $this->pdf->SetFont('Arial', 'B', 18);
            $this->pdf->SetTextColor(0, 0, 0);

            $this->pdf->SetFont('Times', 'B', 10);
            $this->pdf->SetXY($x, $y);
          
            
           $members = $this->db->select('*')->from('customers_detail')->where('member_id', $member_id[$i])->get();
                foreach ($members->result_array() as $sinfo);
                
            $this->pdf->SetFont('Arial', 'B', '6');
            $this->pdf->setFillColor(19, 38, 130);
            $this->pdf->settextColor(255, 255, 255);
            $this->pdf->SetXY($x, $y);
            $this->pdf->Cell(55, 2, '', 0, 1, 'C');
            $this->pdf->SetXY($x, $y + 1);
            $this->pdf->Cell(55, 3, strtoupper("HEADER1"), 0, 1, 'C');
            $this->pdf->SetFont('Arial', 'B', 10);
            $this->pdf->SetXY($x, $y + 4);
           


            $this->pdf->settextColor(200, 0, 0);
            $this->pdf->SetFont('Arial', 'B', 9);
            $this->pdf->SetXY($x, $y + 44);
            $this->pdf->MultiCell(52, 3, strtoupper($sinfo['arjidaarana_hesaru']), '0', 'C');
            $this->pdf->SetFont('Arial', 'B', '7');

            $this->pdf->SetXY($x + 7, $y + 47);
            $this->pdf->settextColor(0, 0, 0);
            $this->pdf->SetFont('Arial', 'B', 8);






            $rt1 = $this->pdf->GetY();
            $this->pdf->SetXY($x + 3, $rt1 + 9);
            $this->pdf->Cell(12, 3, ' ', 0);
            $this->pdf->Cell(2, 3, '');
            $this->pdf->MultiCell(41, 3, date('d-m-Y', strtotime($sinfo['dinaanka'])));

            $this->pdf->SetFillColor(0, 0, 0);


            $this->pdf->SetXY($x, $y + 82);


            $this->pdf->SetFont('Arial', 'B', '7.5');
            if (file_exists($sinfo['photo'])) {
                $this->pdf->Image($sinfo['photo'], $x + 19.5, $y + 23, 17, 20);
            }
            

            $som++;
        }

        $this->pdf->Output();
    }

    function VerticalBulkIDCardback($post_data) {
        $member_id=NULL;
        extract($post_data);
       
        $x = 115;
        $y = 10;
        $som = 0;
        $this->pdf->AddPage('P', 'A4', 0);
        $this->pdf->SetAutoPageBreak(false);
       
        $allx = array( 115, 20);
        for ($i = 0; $i < count($member_id); $i++) {
            $ii = $i;

            if ($som == 10) {
                $this->pdf->AddPage('P', 'A4', 0);

                $this->pdf->SetAutoPageBreak(true);
               $y = 10;
               $som = 0;
            }
            

            if ($i > 0) {
                if ($i % 2 == 0) {
                   $y += 58;
                   $x=115;
                }else{
                     $x = 20;
                }
            }else if ($i == 0){
                $y = 10;
                $som = 0;
            }
            
            if(file_exists('id/idback.jpg')){
                $this->pdf->Image('id/idback.jpg', $x, $y, 85, 55);
            }
           $this->pdf->Rect($x, $y, 85, 55, 'D');
            
            $this->pdf->SetFont('Arial', 'B', 18);
            $this->pdf->SetTextColor(0, 0, 0);

            $this->pdf->SetFont('Times', 'B', 10);
            $this->pdf->SetXY($x, $y);
            
             $members = $this->db->select('*')->from('customers_detail')->where('member_id', $member_id[$i])->get();
                foreach ($members->result_array() as $sinfo);

           $this->pdf->settextColor(0);
            $this->pdf->SetFont('Arial', 'B', 8);
            $this->pdf->SetXY($x, $y );
              $this->pdf->MultiCell(52, 3, strtoupper($sinfo['arjidaarana_hesaru']), '0', 'C');
             
              
            
            $som++;
        }

        $this->pdf->Output();
    }

}

?>
