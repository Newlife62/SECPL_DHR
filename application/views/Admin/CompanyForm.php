<?php 
if($schoolinfo->num_rows()>0){
    foreach($schoolinfo->result_array() as $schooinfo);
    $mode='edit';
}else{
   $schooinfo=NULL;
    $mode='add';
}

?>
<script>
    var cc='<?php echo $mode;?>';
    if(cc=='add'){
    $('#modal-header').html('<b class="box-title">Add School Details</b>');
    }else{
     $('#modal-header').html('<b class="box-title">Edit School Details</b>');   
    }
</script>
<!-- Default box -->
        <div class="box">
<!--            <div class="box-header with-border">
                <h3 class="box-title">Add Dealer</h3>

            </div>-->
<form id="customerform" enctype="multipart/form-data" autocomplete="off">
                <div class="box-body">
                     <input type="hidden" class="form-control" name="id" value="<?php echo $schooinfo['id'];?>" placeholder="">
 
                    <div class="row">
                        <div class="col-sm-6">
                            <label>Register Number:</label>
                            <input type="text" class="form-control" name="register_number" value="<?php echo $schooinfo['register_number'];?>" placeholder="register number">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <label>Company Name:</label>
                            <input type="text" class="form-control" name="company_name" value="<?php echo $schooinfo['company_name'];?>" placeholder="school name">
                        </div>
                        <div class="col-sm-6">
                            <label>Trust Name:</label>
                            <input type="text" class="form-control" name="trust_name" value="<?php echo $schooinfo['trust_name'];?>" placeholder="trust name">
                        </div>
                        
                    </div>
                    
                    <div class="row">
                         <div class="col-sm-6">
                            <label>City:</label>
                            <input type="text" class="form-control" name="city" value="<?php echo $schooinfo['city'];?>" placeholder="City">
                        </div>
                         <div class="col-sm-6">
                            <label>Taluk:</label>
                            <input type="text" class="form-control" name="taluk" value="<?php echo $schooinfo['taluk']?>" placeholder="Taluk">
                        </div>
                         </div>
                       <div class="row">  
                        <div class="col-sm-6">
                            <label>District:</label>
                            <input type="text" class="form-control" name="district" value="<?php echo $schooinfo['district'];?>" placeholder="district">
                        </div>
                       <div class="col-sm-6">
                            <label>State:</label>
                            <input type="text" class="form-control" name="state" value="<?php echo $schooinfo['state']==''?'KARNATAKA':$schooinfo['state'];?>" placeholder="state">
                        </div>
                    </div>
                    
                       <div class="row"> 
                        <div class="col-sm-6">
                            <label>Mobile :</label>
                            <input type="text" class="form-control" name="mobile_number" value="<?php echo $schooinfo['mobile_number'];?>" placeholder="Mobile number">
                        </div>
                      <div class="col-sm-6">
                            <label>Full Address:</label>
                            <textarea type="text" class="form-control" name="full_address" placeholder="Full address"><?php echo $schooinfo['full_address'];?></textarea> 
                        </div>
                       </div>
                    
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <center><button type="submit" Class="btn btn-flat btn-sm btn-primary">SAVE</button></center>
                </div>
            </form>
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->
        
        <script>
            
            $(document).ready(function(){
             $('form#customerform').submit(function(e){
                    e.preventDefault();
                   if(confirm("Are You sure!....")){
                     $.ajax({
                        type:'POST',
                        url:baseurl+'AdminController/AddUpCompanys',
                        contentType:false,
                        processData:false,
                        cache:true,
                        data:new FormData(this),
                        success:function(data){
                            if(data){
                                $('.close').click();
                                location.reload();
                            }
                            
                        },
                    });
                    }
                });
        });
        
        
        </script>