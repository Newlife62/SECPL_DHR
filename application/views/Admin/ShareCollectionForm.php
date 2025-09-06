
<?php echo $selected==null?'PLEASE SELECT THE TEACHERS':'';?>
<script>
    if(1){
    $('#modal-header').html('<b class="box-title">Collect Share</b>');
    }else{
     $('#modal-header').html('<b class="box-title">Edit Share</b>');   
    }
</script>
<!-- Default box -->
 <div class="tile">

<form id="savingsform" enctype="multipart/form-data" autocomplete="off">
                <div class="tile-body">
                     <input type="hidden" class="form-control" name="school_id" id="school_id" value="<?php echo $school_id;?>">
                     <input type="hidden" class="form-control" name="teacher_id" id="teacher_id" value="<?php echo $teacher_id=='selected'?implode(',',$selected):$teacher_id;?>">
 
                    <div class="row">
                        <div class="col-sm-3">
                            <label>Collecting Date:</label>
                            <input type="date" class="form-control" name="date" value="<?php echo date('Y-m-d');?>" >
                        </div>
                        <div class="col-sm-3">
                            <label>Collecting Time:</label>
                            <input type="time" class="form-control" name="time" value="<?php echo date('H:i:s');?>" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <label>Paying For:<span style="color:red;">*</span></label>
                            <select type="text" class="form-control" name="pay_for" required>
                             <option>INDIVIDUAL</option>
                             <option <?php echo $teacher_id=='selected'?'selected':'';?>>BULK</option>
                             </select>
                        </div>
                        <div class="col-sm-3">
                            <label>Collecting Bank:</label>
                            <select class="form-control" name="to_bank" >
                                <option value="">Select Bank</option>
                                 <?php 
                                $banks = $this->db
                                                ->select('*')
                                                ->from('banks')
                                                ->get();
                                foreach($banks->result_array() as $banksres){ ?>
                                <option value="<?php echo $banksres['id'];?>"><?php echo $banksres['bank_name'];?></option>
                                <?php }?>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <label>Collecting Mode:</label>
                            <select class="form-control" name="pay_mode" >
                                <option value="">Select Mode</option>
                                <option value="CASH">CASH</option>
                                <option value="CHEQUE">CHEQUE</option>
                            </select>
                        </div>
                         <div class="col-sm-3">
                            <label>Cheque Number:</label>
                            <input type="number" class="form-control" name="cheque_number" value="0" placeholder="">
                        </div>
                        <div class="col-sm-3">
                            <label>Cheque Date:</label>
                            <input type="date" class="form-control" name="cheque_date"  placeholder="">
                        </div>
                        <div class="col-sm-3">
                            <label>Cheque Bank:</label>
                            <select class="form-control" name="cheque_bank" >
                                <option value="">Select Bank</option>
                                 <?php 
                                $banks = $this->db
                                                ->select('*')
                                                ->from('banks')
                                                ->get();
                                foreach($banks->result_array() as $banksres){ ?>
                                <option value="<?php echo $banksres['id'];?>"><?php echo $banksres['bank_name'];?></option>
                                <?php }?>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <label>Share Amount Paid:</label>
                            <input type="number" class="form-control" name="credit" value="<?php echo $total_share[1]==''?0:$total_share[1];?>" placeholder="credit">
                            
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
                <!-- /.tile-body -->
                
            </form>
            
            <div class="tile">
                <div id="status"></div>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Date</th>
                        <th>Amount</th>
                        
                    </tr>
                    </thead>
                    <tbody>
                        <?php if($total_share[0]->num_rows()>0)
                        {
                            foreach($total_share[0]->result_array() as $sharelist)
                            { ?>
                             <tr>
                                <th><?= date('d-m-Y h:m:s A', strtotime($sharelist['date'] . ' ' . $sharelist['time']))?></th>
                                <th contenteditable="true" id="id:<?= $sharelist['id']; ?>"><?=$sharelist['credit']?></th>
                             </tr>  
                        <?php
                            }
                        } ?>
                        
                    </tbody>
                </table>
            </div>
            
        </div>
        <!-- /.tile -->
        
        <script>
            
            $(document).ready(function(){
             $('form#savingsform').submit(function(e){
                    e.preventDefault();
                   if(confirm("Are You sure!....")){
                     $.ajax({
                        type:'POST',
                        url:baseurl+'AdminController/AddUpSavings',
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
        
         $(function(){
            var message_status = $("#status"); //acknowledgement message
            $("th[contenteditable=true]").keyup(function(){
                var field_userid = $(this).attr("id") ;
                var value = $(this).text() ;
                $.post(baseurl+'AdminController/AddUpSavingsById' , field_userid + "=" + value, function(data){
                    if(data != '')
        			{
        				message_status.show();
        				message_status.text(data);
        				setTimeout(function(){message_status.hide();
        				                                         // $('.close').click();
                                                                table2.ajax.reload();
                                                                //teacherSavings($('#teacher_id').val(),$('#school_id').val());
        				    
        				},2000);
                                        
        			}
                });
            });
        });
        
        
        </script>