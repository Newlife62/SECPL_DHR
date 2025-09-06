<?php 
// if($loandetails->num_rows()>0){
//     foreach($loandetails->result_array() as $loandetails_res);
// }else{
    $loandetails_res=NULL;
//}
?>
<script>
    if(1){
    $('#modal-header').html('<b class="box-title">Loan Issue</b>');
    }else{
     $('#modal-header').html('<b class="box-title">Edit Share</b>');   
    }
</script>
<form id="loanissueform" method="POST" enctype="multipart/form-data" autocomplete="off">
    <input type="hidden" name="id" id="id" value="<?php echo $loandetails_res['id'];?>">
    <input type="hidden" name="loan_id" id="loan_id" value="<?php echo $loandetails_res['loan_id'];?>">
    <input type="hidden" name="teacher_id" id="teacher_id" value="<?php echo $loandetails_res['teacher_id']==''?$teacher_id:$loandetails_res['teacher_id'];?>">
    <input type="hidden" name="school_id" id="school_id" value="<?php echo $loandetails_res['school_id']==''?$school_id:$loandetails_res['school_id'];?>">
    <div class="row">
        <div class="col-sm-3">
            <label>Issued Date:</label>
            <input type="date" name="issued_date" id="issued_date" class="form-control"  value="<?php echo date('Y-m-d');?>">
        </div>
        <div class="col-sm-3">
            <label>Issued Time:</label>
            <input type="time" name="issued_time" id="issued_time" class="form-control"  value="<?php echo $loandetails_res['issued_time']==''?date('H:i'):$loandetails_res['issued_time'];?>">
        </div>
        <div class="col-sm-3">
            <label>Loan Amount:</label>
            <input type="number" name="loan_amount" id="loan_amount" class="form-control" value="<?php echo $loandetails_res['loan_amount'];?>">
        </div>
        <div class="col-sm-3">
            <label>Interest Percentage:</label>
            <input type="number" name="interest_percentage" id="interest_percentage" class="form-control" value="<?php echo $loandetails_res['interest_percentage'];?>">
        </div>
            <div class="col-sm-3">
            <label>Installment Amount:</label>
            <input type="number" name="loan_installment" id="loan_installment" class="form-control" value="<?php echo $loandetails_res['loan_installment'];?>">
        </div>
            <div class="col-sm-3">
            <label>Interest Amount:</label>
            <input type="number" name="interest_amount" id="interest_amount" class="form-control" value="<?php echo $loandetails_res['interest_amount'];?>">
        </div>
        <div class="col-sm-3">
            <label>Bank:</label>
            <select type="number" name="bank_id" id="bank_id"  class="form-control">
                <option value="" >Select Bank</option>
                <?php 
                $banks = $this->db->select('*')->from('banks')->get();
                foreach($banks->result_array() as $banksres){
                ?>
                <option value="<?php echo $banksres['id'];?>" <?php echo $loandetails_res['bank_id']==$banksres['id']?'selected':'';?>><?php echo $banksres['bank_name'];?></option>
                <?php }?>
            </select>
        </div>
    </div>
    
    <br>
    <div class="row">
        <div class="col-sm-4 col-sm-offset-4">
            <button type="submit" class="btn btn-success form-control">Submit</button>
        </div>
    </div>
</form>
<br>
<div class="row">
    <div class="col-sm-12">
        <table style="width:100%;border:solid black 1px;">
            <thead>
            <tr>
                <th>Sl No.</th>
                <th>Loan Issued Date</th>
                <th>Loan Issued Time</th>
                <th>Loan Amount</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
                <?php $i=1; foreach($loandetails->result_array() as $loanrow){ ?>
                <tr>
                    <td><?php echo $i++;?></td>
                    <td><?php echo date('d-m-Y',strtotime($loanrow['issued_date']));?></td>
                    <td><?php echo date('h:i A',strtotime($loanrow['issued_time']));?></td>
                    <td><?php echo $loanrow['loan_amount'];?></td>
                    <td><?php echo $loanrow['status'];?></td>
                    <td><button type="button" class="btn btn-edit btn-xs btn-flat" onclick="editloan(<?php echo $loanrow['id'];?>)"><i class="fa fa-edit"></i></button></td>
                </tr>
                <?php }?>
            </tbody>
        </table>
        </div>
        </div>

<script>
    $(document).ready(function(){
        $('#loanissueform').submit(function(e){
            e.preventDefault();
            if(confirm("Are You sure!....")){
                 $.ajax({
                    type:'POST',
                    url:baseurl+'AdminController/AddUpTeachersLoanIssue',
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
        
    function editloan(id){
        $.ajax({
                    type:'POST',
                    url:baseurl+'AdminController/GetTeachersLoanIssueData',
                    data:{
                        id:id,
                    },
                    dataType:'json',
                    success:function(data){
                        if(data){
                            $('#id').val(data.id);
                            $('#loan_id').val(data.loan_id);
                            $('#teacher_id').val(data.teacher_id);
                            $('#school_id').val(data.school_id);
                            $('#issued_date').val(data.issued_date);
                            $('#issued_time').val(data.issued_time);
                            $('#loan_amount').val(data.loan_amount);
                            $('#interest_percentage').val(data.interest_percentage);
                            $('#loan_installment').val(data.loan_installment);
                            $('#interest_amount').val(data.interest_amount);
                            $('#bank_id').val(data.bank_id);
                        }
                    },
        });
    } 
</script>