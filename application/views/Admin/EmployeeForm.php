<?php 
if($employeeinfo->num_rows()>0){
    foreach($employeeinfo->result_array() as $employinfo);
    $mode='edit';
}else{
   $employinfo=NULL;
    $mode='add';
}

?>
<script>
    var cc='<?php echo $mode;?>';
    if(cc=='add'){
    $('#modal-header').html('<b class="box-title">Add Employee Details</b>');
    }else{
     $('#modal-header').html('<b class="box-title">Edit Employee Details</b>');   
    }
</script>


 <!-- Default box -->
<div class="tile">

<div class="tile-body">

     <ul class="nav nav-tabs">
        <li class="nav-item ">
            <a class="nav-link active" data-toggle="tab" href="#home">Details</a>
        </li>
        <!--<li class="nav-item">-->
        <!--    <a class="nav-link" data-toggle="tab" href="#menu1">Set Share/Loan</a>-->
        <!--</li>-->
      </ul>
<form id="employeeform" enctype="multipart/form-data" autocomplete="off" method="POST">
  <div class="tab-content" id="myTabContent">
    
    <div id="home" class="tab-pane fade active show">
    


                
                     <input type="hidden" class="form-control" name="id" value="<?php echo $employinfo['id'];?>" placeholder="">
                
                     <div class="row">
                         <div class="col-sm-3">
                            <label>Photo:</label>
                                <span><input type="file" class="form-control" name="photo" value="<?php echo $employinfo['photo'];?>" placeholder="Employee Photo"></span>
                        </div>
                        <div class="col-sm-3">
                            
                            <img style="height:100px;width:80px; " class="pull-right" src="<?php echo base_url($employinfo['photo']);?>" style="border:solid black 5px;">
                             </div>
                           
                            <div class="col-sm-3">
                            <label>Signature:</label>
                                <span><input type="file" class="form-control" name="signature" value="<?php echo $employinfo['signature'];?>" placeholder="Sign. Photo"></span>
                        </div>
                        <div class="col-sm-3">
                            
                            <img style="height:100px;width:80px; " class="pull-right" src="<?php echo base_url($employinfo['signature']);?>" style="border:solid black 5px;">
                             </div>
                    </div>
                    
                     <div class="row">
                        <div class="col-sm-3">
                            <label>Company Name:</label>
                            <select  class="form-control" name="company_id" placeholder="company name" required>
                                <option value="">Select The Company</option>
                                <?php foreach($companyslist->result_array() as $company){ ?>
                                <option value="<?php echo $company['id'];?>" <?php if($company_id!=0){echo ($company_id==$company['id'])?'selected':'';}?>><?php echo $company['company_name'];?></option>
                                <?php } ?>
                                </select>
                        </div>
                         <div class="col-sm-3">
                            <label>Department Name:</label>
                            <select  class="form-control" name="dept_id" id="dept_id" placeholder="department" required>
                                <option value="">Select The Department</option>
                                <?php foreach($departmentslist->result_array() as $department){ ?>
                                <option value="<?=$department['dept_id']?>" <?=$department['dept_id']==$employinfo['dept_id']?'selected':''?>><?php echo $department['dept_name'];?></option>
                                <?php } ?>
                                </select>
                        </div>
                        
                          <div class="col-sm-3">
                            <label>Position (Designation) :</label>
                            <select type="text" class="form-control" id="pos_id" name="pos_id" required>
                                <option value="">Select Position</option>
                            </select>
                        </div>
                        
                        <div class="col-sm-3">
                            <label>Employee Number:</label>
                            <input type="text" class="form-control" name="employee_number" value="<?php echo $employinfo['employee_number'];?>" placeholder="employee number">
                        </div>
                       
                        
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-3">
                            <label>Employee Name</label>
                            <input type="text" class="form-control" name="employee_name" value="<?php echo $employinfo['employee_name'];?>" placeholder="employee name" required>
                                
                        </div>
                        
                        <div class="col-sm-3">
                            <label>Short Name</label>
                            <input type="text" class="form-control" name="employee_short_name" value="<?php echo $employinfo['employee_short_name'];?>" placeholder="employee short name">
                                
                        </div>
                      
                        <div class="col-sm-6">
                            <label>Date Of Birth:</label>
                            <input type="date" class="form-control" name="date_of_birth" value="<?php echo $employinfo['date_of_birth'];?>" placeholder="Date Of Birth">
                        </div>
                        
                    </div>
                     <div class="row">
                         <div class="col-sm-6">
                            <label>City:</label>
                            <input type="text" class="form-control" name="city" value="<?php echo $employinfo['city'];?>" placeholder="City">
                        </div>
                        <div class="col-sm-6">
                            <label>Taluk:</label>
                            <input type="text" class="form-control" name="taluk" value="<?php echo $employinfo['taluk'];?>" placeholder="Taluk">
                        </div>
                         </div>
                    <div class="row">
                         
                        <div class="col-sm-6">
                            <label>District:</label>
                            <input type="text" class="form-control" name="district" value="<?php echo $employinfo['district'];?>" placeholder="district">
                        </div>
                       <div class="col-sm-6">
                            <label>State</label>
                            <input type="text" class="form-control" name="state" value="KARNATAKA" placeholder="State">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <label>Mobile:</label>
                            <input type="text" class="form-control" name="mobile_number" value="<?php echo $employinfo['mobile_number'];?>" placeholder="Mobile number">
                        </div>
                        <div class="col-sm-6">
                            <label>Full Address</label>
                            
                            <textarea class="form-control" name="full_address" placeholder="full address"><?php echo $employinfo['full_address'];?></textarea>
                                
                        </div>
                    </div>
                    <div class="row">
                       <div class="col-sm-6">
                            <label>Caste:</label>
                            
                            <input list="caste" class="form-control" value="<?php echo $employinfo['caste'];?>" name="caste" placeholder="Jaathi">
                                <datalist id="caste" >
                                <option>SC</option>
                                <option>ST</option>
                                <option>LINGAYATH</option>
                                <option>GOUDA</option>
                                <option>GENERAL</option>
                                
                            </datalist>
                        </div>
                        <div class="col-sm-6">
                            <label>Sub Caste :</label>
                            <input type="text" class="form-control" name="sub_caste" value="<?php echo $employinfo['sub_caste'];?>" placeholder="sub caste">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <label>Ration Card Number</label>
                            <input type="text" class="form-control" name="ration_card_number" value="<?php echo $employinfo['ration_card_number'];?>" placeholder="ration card number">
                        </div>
                        <div class="col-sm-6">
                            <label>PAN Card Number</label>
                            <input type="text" class="form-control" name="paan_card_number" value="<?php echo $employinfo['paan_card_number'];?>" placeholder="PAN card number">
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <label>Aadhaar Card Number</label>
                            <input type="text" class="form-control" name="aadhaar_number" value="<?php echo $employinfo['aadhaar_number'];?>" placeholder="AADHAAR card number">
                        </div>
                        
                         <div class="col-sm-6">
                            <label>Left Date</label>
                            <input type="date" class="form-control" name="left_date" value="<?php echo $employinfo['left_date'];?>" placeholder="Left Date">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <label>User name:</label>
                            <input type="text" class="form-control" name="username" value="<?php echo $employinfo['username'];?>" placeholder="user name">
                            <span style="color:red" id="uniqueerror"></span>
                        </div>
                        <div class="col-sm-6">
                            <label>Password:</label>
                            <input type="text" class="form-control" name="password" value="<?php echo $employinfo['password'];?>" placeholder="password">
                        </div>
                                    
                    </div>
                    <br>
                <div class="col-sm-12">
                    <center><button type="submit" Class="btn btn-flat btn-sm btn-primary">SAVE</button></center>
                </div>
           
           
    </div>
    
    
    
  </div>
 </form>
       </div>
             
        <script>
           
            $(document).ready(function(){
                
                $('#dept_id').change(function(){
                    $.ajax({
                        type:'POST',
                        url:baseurl+'AdminController/getPositionsList',
                        data:{
                            department_id:$('#dept_id').val(),
                            pos_id:'<?php echo $employinfo["pos_id"];?>'},
                        success:function(data){
                            if(data){
                                $('#pos_id').html(data);
                            }
                        }
                    });
                }).change();
                
             $('#employeeform').submit(function(e){
                    e.preventDefault();
                    if(confirm("Are You sure!....")){
                     $.ajax({
                        type:'POST',
                        url:baseurl+'AdminController/AddUpEmployees',
                        contentType:false,
                        processData:false,
                        cache:true,
                        data:new FormData(this),
                        success:function(data){
                           
                            if(data){
                                $('.close').click();
                                table2.ajax.reload();
                            }
                            
                        },
                        error: function(xhr, status, error) {
                          $('#uniqueerror').text('This user name is already registered try with another one.');
                        }
                    });
                    }
                });

             
        });
        
        
        </script>