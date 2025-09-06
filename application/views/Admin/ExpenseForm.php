<?php
if($expenseinfo->num_rows()>0){
    foreach($expenseinfo->result_array() as $expensedetails);
}else{
   $expensedetails = NULL;
}
?>
<script>
    if(1){
    $('#modal-header').html('<b class="box-title">Expense</b>');
    }else{
     $('#modal-header').html('<b class="box-title">Edit Expense</b>');   
    }
</script>
<!-- Default box -->
        <div class="tile">

<form id="expenseform" enctype="multipart/form-data" autocomplete="off">
                <div class="tile-body">
                    
                    
                     <input type="hidden" class="form-control" name="expense_id" value="<?php echo $expensedetails['id']!=''?$expensedetails['id']:$expense_id;?>">
                     
 
                    <div class="row">
                        <div class="col-sm-3">
                            <label>Given Date:</label>
                            <input type="date" class="form-control" name="date" value="<?php echo (($expensedetails['date']=='0000-00-00') ||($expensedetails['date']==''))?date('Y-m-d'):$expensedetails['date'];?>" >
                        </div>
                        <div class="col-sm-3">
                            <label>Given Time:</label>
                            <input type="time" class="form-control" name="time" value="<?php echo date('H:i:s');?>" readonly>
                        </div>
                    </div>
                    <div class="row">
                        
                        <div class="col-sm-3">
                            <label>Expense Amount:</label>
                            <input type="number" class="form-control" name="expense_amount" id="loan" value="<?php echo $expensedetails['expense_amount'];?>" placeholder="debit">
                        </div>
                        <div class="col-sm-3">
                            <label>Pay Mode:</label>
                            <select class="form-control" name="paymode" id="paymode"  placeholder="paymode">
                                <option <?php echo $expensedetails['paymode']=='CHEQUE'?'selected':'';?>>CHEQUE</option>
                                <option <?php echo $expensedetails['paymode']=='CASH'?'selected':'';?>>CASH</option>
                                
                                
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <label>Cheque date:</label>
                            <input type="date" class="form-control" name="cheque_date" id="cheque_date" value="<?php echo $expensedetails['cheque_date'];?>" placeholder="cheque_date">
                        </div>
                        <div class="col-sm-3">
                            <label>Cheque Number:</label>
                            <input type="text" class="form-control" name="cheque_number" id="cheque_number" value="<?php echo $expensedetails['cheque_number'];?>" placeholder="cheque_number">
                        </div>
                        <div class="col-sm-3">
                            <label>Cheque Bank:</label>
                            <select class="form-control" name="cheque_bank_id" id="cheque_bank_id" value="<?php echo $expensedetails['cheque_bank_id'];?>" placeholder="cheque_bank">
                                <option value="">select chq bank</option>
                                       <?php 
                                            $banks = $this->db->select('*')->from('banks')->get();
                                            foreach($banks->result_array() as $banksres){
                                            ?>
                                            <option value="<?php echo $banksres['id'];?>" <?php echo $expensedetails['cheque_bank_id']==$banksres['id']?'selected':'';?>><?php echo $banksres['bank_name'];?></option>
                                        <?php }?>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <label>Type:</label>
                            <select class="form-control" name="type" id="type"  placeholder="type">
                                <option value="">Select Type</option>
                                <option <?php echo $expensedetails['type']=='VETANA SAHAKAARA NIDHI'?'selected':'';?>>VETANA SAHAKAARA NIDHI</option>
                                <option <?php echo $expensedetails['type']=='SAHAKAARA SHIKSHANA NIDHI'?'selected':'';?>>SAHAKAARA SHIKSHANA NIDHI</option>
                                <option <?php echo $expensedetails['type']=='AMAANAT'?'selected':'';?>>AMAANAT</option>
                                <option <?php echo $expensedetails['type']=='BANK CHARGES'?'selected':'';?>>BANK CHARGES</option>
                                <option <?php echo $expensedetails['type']=='DIVIDEND'?'selected':'';?>>DIVIDEND</option>
                                <option <?php echo $expensedetails['type']=='OTHERS'?'selected':'';?>>OTHERS</option>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label>Note:</label>
                            <textarea name="description" id="description" placeholder="description" class="form-control" ><?php echo $expensedetails['description'];?></textarea> 
                               
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
                
                $('form#expenseform').submit(function(e){
                    e.preventDefault();
                   if(confirm("Are You sure!....")){
                     $.ajax({
                        type:'POST',
                        url:baseurl+'AdminController/AddUpExpense',
                        contentType:false,
                        processData:false,
                        cache:true,
                        data:new FormData(this),
                        success:function(data){
                            if(data){
                                $('.close').click();
                                table3.ajax.reload();
                            }
                            
                        },
                    });
                    }
                });
        });
        
        
        </script>