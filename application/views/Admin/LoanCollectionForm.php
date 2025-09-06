<?php
if($loaninfo[0]->num_rows()>0){
    foreach($loaninfo[0]->result_array() as $loandetails);
}else{
   $loandetails = NULL;
}

if($loaninfo[1]->num_rows()>0){
    foreach($loaninfo[1]->result_array() as $loanpaiddetails);
}else{
    $loanpaiddetails = NULL;
 }

 if($loaninfo[2]->num_rows()>0){
    foreach($loaninfo[2]->result_array() as $loansetdetails);
}else{
    $loansetdetails = NULL;
 }
?>
<script>
    if(1){
    $('#modal-header').html('<b class="box-title">Collect Loan</b>');
    }else{
     $('#modal-header').html('<b class="box-title">Edit Loan</b>');   
    }
</script>
<!-- Default box -->
        <div class="tile">


                <div class="tile-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="tile">
                                <div class="tile-body">
                                    <table style="width:100%;border-collapse: collapse">
                                        <tr>
                                            <th>Issued Date <i class="pull-right">:</i> </th>
                                            <th style="align:right;"><?php echo ($loandetails['issued_date']=='0000-00-00' )|| ($loandetails['issued_date']=='')?'-':date('d-m-Y',strtotime($loandetails['issued_date']));?></th>
                                        </tr>
                                        <tr>
                                            <th>Loan Amount <i class="pull-right">:</i> </th>
                                            <th style="align:right;"><?php echo number_format($loanpaiddetails['loan_amount'],2);?></th>
                                        </tr>
                                        <tr>
                                            <th>Loan Paid <i class="pull-right">:</i> </th>
                                            <th style="align:right;"><?php echo number_format($loanpaiddetails['loan_paid'],2);?></th>
                                        </tr>
                                        <tr>
                                            <th>Balance Amount <i class="pull-right">:</i> </th>
                                            <th style="align:right;"><?php echo number_format($loanpaiddetails['balance'],2);?></th>
                                        </tr>
                                        
                                    </table>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                <form id="loanform" enctype="multipart/form-data" autocomplete="off" style="padding:2px;">              
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
                            <label>Collecting For:<span style="color:red;">*</span></label>
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
                            <label>Total Amount Paid:</label>
                            <input type="number" class="form-control" name="total_paid_amount" id="total_paid_amount" value="<?php echo $loansetdetails['per_month_paying_amount']-$loansetdetails['share'];?>" placeholder="total_paid_amount">
                        </div>
                        
                        <div class="col-sm-3">
                            <label>Total Month:</label>
                            <input type="number" class="form-control" name="total_month" id="total_month" value="0" placeholder="Total_month" min="0" max="24">
                        </div>
                        
                        <div class="col-sm-3">
                            <label>Loan Amount:</label>
                            <input type="number" class="form-control" name="loan" id="loan" value="<?php echo $loansetdetails['loan'];?>" placeholder="credit">
                        </div>
                        <div class="col-sm-3">
                            <label>Interest Amount:</label>
                            <input type="number" class="form-control" name="interest" id="interest" value="<?php echo $loansetdetails['interest'];?>" placeholder="credit">
                        </div>
                        <div class="col-sm-3">
                            <label>Total Amount:</label>
                            <input type="number" class="form-control" name="credit" id="credit" value="<?php echo $loansetdetails['loan'];?>" placeholder="credit">
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
                    </div>
                   <br>
                   <div class="row">
                    <div class="col-sm-5"></div>
                        <div class="col-sm-2">
                            <center><button type="submit" Class="btn btn-flat btn-sm btn-primary">SUBMIT</button></center>
                        </div>
                    </div><br>
                </form>
                    
                    <div class="row">
                <div class="col-sm-12">
                            <div class="tile"  style="padding:0px;">
                                <div class="tile-body" style="height:135px;overflow-y: scroll;padding:0px;">
                                    <div id="status"></div>
                                    <table class="table" >
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Date Time</th>
                                                <th>Teacher Name</th>
                                                <th>Amount</th>
                                                <th>Interest</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
        
                                            if ($loaninfo[3]->num_rows() > 0) {
                                                foreach ($loaninfo[3]->result_array() as $loancollections) {
                                                    ?>
                                                    <tr>
                                                        <th><?= $i; ?></th>
                                                        <th id="datetime:<?= $loancollections['id']; ?>"><?= date('d-m-Y h:m:s A', strtotime($loancollections['date'] . ' ' . $loancollections['time'])) ?></th>
                                                        <th><?= $loancollections['teacher_name'] ?></th>
                                                        <th contenteditable="true" id="credit:<?= $loancollections['id']; ?>"><?= $loancollections['credit'] ?></th>
                                                        <th contenteditable="true" id="interest:<?= $loancollections['id']; ?>"><?= $loancollections['interest'] ?></th>
                                                    </tr>
                                                <?php $i++;}
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                        
                                </div>
                            </div>
                        </div>
                </div>
            </div>
                

            
            
        </div>
        <!-- /.tile -->
        
        <script>
                   

            $(document).ready(function(){
                
                $('form#loanform').submit(function(e){
                    e.preventDefault();
                   if(confirm("Are You sure!....")){
                     $.ajax({
                        type:'POST',
                        url:baseurl+'AdminController/AddUpLoan',
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
                $.post(baseurl+'AdminController/AddUpLoanById' , field_userid + "=" + value, function(data){
                    if(data != '')
        			{
        				message_status.show();
        				message_status.text(data);
        				setTimeout(function(){message_status.hide();
        				                                        
                                                                //$('.close').click();
                                                                table2.ajax.reload();
                                                                //teacherLoan($('#teacher_id').val(),$('#school_id').val());
        				    
        				},2000);
                                        
        			}
                });
            });
        });
        
        $('#total_paid_amount,#total_month').blur(function(){
             $.ajax({
                        type        :'POST',
                        url         :baseurl+'AdminController/GetLoanAmountDetails',
                        dataType    : 'json',
                        data        :{
                                        school_id:$('#school_id').val(),
                                        teacher_id:$('#teacher_id').val()
                                },
                        success:function(data){
                            var total_months = $('#total_month').val();
                            var interest_amount = Math.round(((data['loan_balance']/100)*data['interest_percentage'])*total_months);
                            var instalment_credit = $('#total_paid_amount').val()-interest_amount;
                            $('#loan').val(instalment_credit);
                            $('#interest').val(interest_amount);
                            $('#credit').val(instalment_credit);
                        },
                    });
        });
        </script>