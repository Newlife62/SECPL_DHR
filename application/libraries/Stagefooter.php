<?php if(!defined('BASEPATH'))  exit("No direct script access allowed.");
require('fpdf.php');
class Stagefooter extends FPDF
{
    function Footer(){
        $this->SetY(-5);
        $this->Cell(100,5,'own Footer Of the Page',0,1,'L');   
    }
}
?>