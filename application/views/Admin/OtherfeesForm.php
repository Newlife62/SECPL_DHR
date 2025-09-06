<?php
if($otherdetails->num_rows()>0){
    foreach($otherdetails->result_array() as $otherdetailsres);
}else{
   $otherdetailsres = NULL;
}
?>
<script>
    if(1){
    $('#modal-header').html('<b class="box-title">Other Fees</b>');
    }else{
     $('#modal-header').html('<b class="box-title">Edit Other Fees</b>');   
    }
</script>
<!-- Default box -->
        <div class="tile">

<form id="otherform" enctype="multipart/form-data" autocomplete="off">
                <div class="tile-body">
                    
                    
                     <input type="hidden" class="form-control" name="other_id" value="<?php echo $otherdetailsres['id']!=''?$otherdetailsres['id']:$other_id;?>">

                     <input type="hidden" class="form-control" name="teacher_id" value="<?php echo $otherdetailsres['teacher_id']!=''?$otherdetailsres['teacher_id']:$teacher_id;?>">

                     <input type="hidden" class="form-control" name="school_id" value="<?php echo $otherdetailsres['school_id']!=''?$otherdetailsres['school_id']:$school_id;?>">
                     
 
                    <div class="row">
                        <div class="col-sm-3">
                            <label>Recieving Date:</label>
                            <input type="date" class="form-control" name="date" value="<?php echo (($otherdetailsres['date']=='0000-00-00') ||($otherdetailsres['date']==''))?date('Y-m-d'):$otherdetailsres['date'];?>" >
                        </div>
                         <div class="col-sm-3">
                            <label>Recieving Time:</label>
                            <input type="time" class="form-control" name="time" value="<?php echo (($otherdetailsres['time']=='00:00:00') ||($otherdetailsres['time']==''))?date('H:i:s'):$otherdetailsres['time'];?>" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <label>To Bank:</label>
                            <select class="form-control" name="to_bank" id="to_bank"  placeholder="to_bank">
                                <option value="" >Select Bank</option>
                                <?php 
                                    $banks = $this->db->select('*')->from('banks')->get();
                                    foreach($banks->result_array() as $banksres){
                                    ?>
                                    <option value="<?php echo $banksres['id'];?>" <?php echo $otherdetailsres['to_bank']==$banksres['id']?'selected':'';?>><?php echo $banksres['bank_name'];?></option>
                                    <?php }?>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <label>Others Amount:</label>
                            <input type="number" class="form-control" name="expense_amount" id="loan" value="<?php echo $otherdetailsres['other_amount'];?>" placeholder="credit">
                        </div>

                        <div class="col-sm-3">
                            <label>Pay Mode:</label>
                            <select class="form-control" name="paymode" id="paymode"  placeholder="paymode">
                                <option <?php echo $otherdetailsres['paymode']=='CHEQUE'?'selected':'';?>>CHEQUE</option>
                                <option <?php echo $otherdetailsres['paymode']=='CASH'?'selected':'';?>>CASH</option>
                                
                                
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <label>Cheque date:</label>
                            <input type="date" class="form-control" name="cheque_date" id="cheque_date" value="<?php echo $otherdetailsres['cheque_date'];?>" placeholder="cheque_date">
                        </div>
                        <div class="col-sm-3">
                            <label>Cheque Number:</label>
                            <input type="text" class="form-control" name="cheque_number" id="cheque_number" value="<?php echo $otherdetailsres['cheque_number'];?>" placeholder="cheque_number">
                        </div>
                        <div class="col-sm-3">
                            <label>Cheque Bank:</label>
                            <select class="form-control" name="cheque_bank" id="cheque_bank"  placeholder="cheque_bank">
                                <option value="" >Select Bank</option>
                                <?php 
                                    $banks = $this->db->select('*')->from('banks')->get();
                                    foreach($banks->result_array() as $banksres){
                                    ?>
                                    <option value="<?php echo $banksres['id'];?>" <?php echo $otherdetailsres['cheque_bank']==$banksres['id']?'selected':'';?>><?php echo $banksres['bank_name'];?></option>
                                    <?php }?>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <label>Type:</label>
                            <select class="form-control" name="type" id="type"  placeholder="type">
                                <option value="">Select Type</option>
                                <option <?php echo $otherdetailsres['type']=='BUILDING FUND'?'selected':'';?>>BUILDING FUND</option>
                                <option <?php echo $otherdetailsres['type']=='MEMBER FEE'?'selected':'';?>>MEMBER FEE</option>
                                <option <?php echo $otherdetailsres['type']=='OTHERS'?'selected':'';?>>OTHERS</option>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label>Note:</label>
                            <textarea name="description" id="description" placeholder="description" class="form-control" ><?php echo $otherdetailsres['description'];?></textarea> 
                               
                        </div>
                    </div>
                   <br>
                   <div class="row">
                    <div class="col-sm-5"></div>
                        <div class="col-sm-2">
                            <center><button type="submit" Class="btn btn-flat btn-sm btn-primary">SUBMIT</button></center>
                        </div>
                    </div>
                    
                </div>
                

            </form>
            
        </div>
        <!-- /.tile -->
        
        <script>
                   

            $(document).ready(function(){
                
                $('form#otherform').submit(function(e){
                    e.preventDefault();
                   if(confirm("Are You sure!....")){
                     $.ajax({
                        type:'POST',
                        url:baseurl+'AdminController/AddUpOtherFees',
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
                    });
                    }
                });
        });
        
        
        </script>