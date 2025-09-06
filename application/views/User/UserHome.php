<?php 
                $this->db
                        ->select('count(s.id) schoolscount')
                        ->from('companys_detail s');
                $schools = $this->db->get();
                foreach($schools->result_array() as $schoolsdata);              

                $this->db
                        ->select('count(t.id) teacherscount')
                        ->from('employees t');
                $teachers = $this->db->get();
                foreach($teachers->result_array() as $teachersdata);  
                
               
?>
<style>
    .widget-small:hover {
      background-color:gray;
      color:black;
      opacity:0.6;
      z-index:100;
  }
</style>
<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        </ul>
      </div>
      
      <div class="row">
        <!--<div class="col-md-6 col-lg-3" >-->
        <!--  <div class="widget-small primary coloured-icon" onclick="window.location='<?=base_url('AdminController/AddSchools');?>'"><i class="icon fa fa-home fa-3x"></i>-->
        <!--    <div class="info">-->
        <!--      <a href="<?=base_url();?>AdminController/AddSchools"><h4>Company</h4></a>-->
        <!--      <p><b><?php echo $schoolsdata['schoolscount']==''?0:$schoolsdata['schoolscount'];?></b></p>-->
        <!--    </div>-->
        <!--  </div>-->
        <!--</div>-->
        <!--<div class="col-md-6 col-lg-3">-->
        <!--  <div class="widget-small info coloured-icon" onclick="window.location='<?=base_url('AdminController/AddTeachers/ALL');?>'"><i class="icon fa fa-users fa-3x"></i>-->
        <!--    <div class="info">-->
        <!--        <a href="#"><h4>Employees</h4></a>-->
        <!--      <p><b><?php echo $teachersdata['teacherscount']==''?0:$teachersdata['teacherscount'];?></b></p>-->
        <!--    </div>-->
        <!--  </div>-->
        <!--</div>-->
        
        <!--<div class="col-md-6 col-lg-3" >-->
        <!--  <div class="widget-small primary coloured-icon" onclick="window.location='<?=base_url('AdminController/AddExpense');?>'"><i class="icon fa fa-money fa-3x"></i>-->
        <!--    <div class="info">-->
        <!--      <a href="#"><h4>Expense</h4></a>-->
        <!--      <p><b><?php echo $expenseamount['expenseamount']==''?0:$expenseamount['expenseamount'];?></b></p>-->
        <!--    </div>-->
        <!--  </div>-->
        <!--</div>-->
        
        <!--<div class="col-md-6 col-lg-3">-->
        <!--  <div class="widget-small warning coloured-icon" onclick="window.location='<?=base_url('AdminController/ShareLedger');?>'"><i class="icon fa fa-money fa-3x"></i>-->
        <!--    <div class="info">-->
        <!--      <a href="#"><h4>Share</h4></a>-->
        <!--      <p><b><?php echo $shareamount['shareamount']==''?0:$shareamount['shareamount'];?></b></p>-->
        <!--    </div>-->
        <!--  </div>-->
        <!--</div>-->
        <!--<div class="col-md-6 col-lg-3">-->
        <!--  <div class="widget-small danger coloured-icon"  onclick="window.location='<?=base_url('AdminController/ShareLedger');?>'"><i class="icon fa fa-money fa-3x"></i>-->
        <!--    <div class="info">-->
        <!--      <a href="#"><h4>Loan</h4></a>-->
        <!--      <p><b><?php echo $loanamount['loanamount']==''?0:$loanamount['loanamount'];?></b></p>-->
        <!--    </div>-->
        <!--  </div>-->
        <!--</div>-->
      </div>

      <div class="row">
        <div class="col-md-6 col-lg-3" >
          <div class="widget-small primary coloured-icon" style="background-color:#ffff66;" onclick="window.location='<?=base_url('AdminController/StageOneOrdersList');?>'"><i class="icon fa fa-home fa-3x"></i>
            <div class="info">
              <a href="#"><h4>Stage-1</h4></a>
              <p><b></b></p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="widget-small info coloured-icon" style="background-color:#bee8c2;" onclick="window.location='<?=base_url('AdminController/StageTwoOrdersList');?>'"><i class="icon fa fa-users fa-3x"></i>
            <div class="info">
                <a href="#"><h4>Stage-2</h4></a>
              <p><b></b></p>
            </div>
          </div>
        </div>
        
        <div class="col-md-6 col-lg-3" >
          <div class="widget-small primary coloured-icon" style="background-color:#ff9999;" onclick="window.location='<?=base_url('AdminController/StageThreeOrdersList');?>'"><i class="icon fa fa-money fa-3x"></i>
            <div class="info">
              <a href="#"><h4>Stage-3</h4></a>
              <p><b></b></p>
            </div>
          </div>
        </div>
        
        <div class="col-md-6 col-lg-3" >
          <div class="widget-small primary coloured-icon" style="background-color:#bddde9;" onclick="window.location='<?=base_url('AdminController/StageFourOrdersList');?>'"><i class="icon fa fa-money fa-3x"></i>
            <div class="info">
              <a href="#"><h4>Stage-4</h4></a>
              <p><b></b></p>
            </div>
          </div>
        </div>
      </div>
     
      
    </main>
  

  
