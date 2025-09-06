<?php 
$coa_information = $coaparameter =  $employee   = $fn = NULL;

$employeeslist  = $dept_employeeslist = $departmentemployees = array();

$employeeslist[] = '<option value="">Select Done By</option>';
foreach($employees->result_array() as $employee){
    $employeeslist[] = '<option value="'.$employee['id'].'">'.$employee['employee_name'].' ('.$employee['dept_name'].'-'.$employee['pos_name'].')'.'</option>';
    $dept_employeeslist[$employee['dept_id']][] = '<option value="'.$employee['id'].'">'.$employee['employee_name'].' ('.$employee['dept_name'].'-'.$employee['pos_name'].')'.'</option>';
}
$employeeslist = implode('',$employeeslist);

foreach($departments->result_array() as $department){
    if(isset($dept_employeeslist[$department['dept_id']])){
        $departmentemployees[$department['dept_id']] = implode('',$dept_employeeslist[$department['dept_id']]);
    }
}



?>
<style>
.form-container {
    border: 2px solid #007bff; /* Blue border */
    padding: 20px;
    border-radius: 10px;
    width: 100%;
    /*max-width: 500px;*/
    margin-bottom: 30px; /* Spacing after the form */
}

.form-container label {
    font-weight: bold;
}

.form-container input, 
.form-container textarea {
    width: 100%;
    padding: 8px;
    margin: 5px 0;
    border: 1px solid #ccc;
    border-radius: 5px;
}

/*.form-container button {*/
/*    background-color: #007bff;*/
/*    color: white;*/
/*    border: none;*/
/*    padding: 10px;*/
/*    width: 100%;*/
/*    border-radius: 5px;*/
/*    cursor: pointer;*/
/*}*/

.form-container button:hover {
    background-color: #0056b3;
}

</style>
 <form id="coa_form" enctype="multipart/form-data">
    <!--COA Information-->  
    <div class="row">
        <div class="col-sm-12">
            
            <?php foreach($coa_details->result_array() as $coa_information); ?>
            
            <div class="form-container">
               <input type="hidden" class="coa_id" name="coa_id" value="<?=$coa_information['id']?>">
               
                <div class="row">
                    <div class="col-sm-12">
                        <center><h4>Certificate Of Analysis</h4></center>
                    </div>
                </div>
                
                <div class="row">
                    			
                    <div class="col-sm-6">
                        <label>Product Description</label>
                        <textarea name="product_description" id="product_description" rows="1"class="form-control" readonly ><?=$coa_information['product_description']?></textarea>
                    </div>
                   
                     <div class="col-sm-6">
                        <label>Lot/Batch No</label>
                        <input type="text" name="lot_or_batch_no" id="lot_or_batch_no" value="<?=$coa_information['lot_or_batch_no']?>" class="form-control">
                    </div>
                    <div class="col-sm-6">
                        <label>Product Code</label>
                        <input type="text" name="product_code" id="product_code" value="<?=$coa_information['product_code']?>" class="form-control">
                    </div>
                    <div class="col-sm-6">
                        <label>Released Quantity</label>
                        <input type="text" name="released_quantity" id="released_quantity" value="<?=$coa_information['released_quantity']?>" class="form-control">
                    </div>
                    <div class="col-sm-6">
                        <label>Brand (If Applicable)</label>
                        <input type="text" name="brand" id="brand" value="<?=$coa_information['brand']?>" class="form-control">
                    </div>
                    <div class="col-sm-6">
                        <label>Reference DHR No.</label>
                        <select type="text" name="reference_dhr_no" id="reference_dhr_no" class="form-control" >
                            <option value="">Select DHR</option>
                            <?php foreach($stage_one_dhr_order_information->result_array() as $dhrs){ ?>
                            <option value="<?=$dhrs['dhr_number']?>" <?=$dhrs['dhr_number'] == $coa_information['reference_dhr_no']?'selected':''?>><?=$dhrs['dhr_number']?></option>
                            <?php } ?>
                            
                        </select>
                    </div>
                   
                </div>    
            </div>
        </div>
    </div>
    
    <!--COA PARAMETERS-->  
    <div class="row">
        <div class="col-sm-12">
            <div class="form-container">
               <div class="row">
                    <div class="col-sm-12">
                        <center><h4>COA Parameter</h4></center>
                    </div>
                </div>
               
                <div class="row">
                    <div class="col-sm-12">
                        <style>
                            .table td,
                            .table th {
                                padding: 0px; /* Your desired padding */
                            }
                            input{
                                padding-left:0.5px;
                                padding-right:0.5px;
                            }
                        </style>
                        <table class="table table-responsive" id="billofmaterial" style="width:100%;padding:0px;">
                            <thead>
                                    
                                <tr>
                                    <th style="width:5%;">Sl.No.</th>
                                    <th style="width:<?=(90/4)?>%;">Parameter</th>
                                    <th style="width:<?=(90/4)?>%;">Requirement</th>
                                    <th style="width:<?=(90/4)?>%;">Result/Observation</th>
                                    <th style="width:<?=(90/4)?>%;">Complied/Not Complied</th>
                                    <th style="width:5%;"><button type="button" onclick="add_dhr_bill_item_row()" title="Add BOM" class="btn btn-success btn-flat" ><i class="fa fa-plus"></i></button></th>
                                </tr>
                            </thead>
                            <tbody>
                        
                        <?php  $i=1; if($coa_parameter->num_rows()>0){ foreach($coa_parameter->result_array() as $coaparameter){ ?>
                                   
                                <tr>
                                    <th><input style="padding-left:0px;padding-right:0px;" type="number" name="sl_number[]" value="<?=$coaparameter['sl_number']?>" id="sl_number<?=$i?>" onchange="fetchcoadefaultdetails(this,<?=$i?>)" class="form-control" ></th>
                                    <th><input style="padding-left:0px;padding-right:0px;" type="text" name="parameter[]" value="<?=$coaparameter['parameter']?>" id="parameter<?=$i?>" class="form-control"></th>
                                    <th><input style="padding-left:0px;padding-right:0px;" type="text" name="requirement[]" value="<?=$coaparameter['requirement']?>" id="requirement<?=$i?>" class="form-control" ></th>
                                    <th><input style="padding-left:0px;padding-right:0px;" type="text" name="result_or_observation[]" value="<?=$coaparameter['result_or_observation']?>"  id="result_or_observation<?=$i?>" class="form-control" ></th>
                                    <th><select  name="complied_or_not_complied[]" id="complied_or_not_complied<?=$i?>" class="form-control">
                                            <option value="">Select Option</option> 
                                            <option value="1" <?=$coaparameter['complied_or_not_complied']==1?'selected':''?>>Complied</option>
                                            <option value="0" <?=$coaparameter['complied_or_not_complied']==0?'selected':''?>>Not Complied</option>
                                        </select>
                                    </th>
                                    <th><button type="button" onclick="delete_dhr_bill_item_row(this)" title="Delete BOM" class="btn btn-danger btn-flat" ><i class="fa fa-minus"></i></button></th>
                                </tr>
                            
                        <?php   $i++; } }else{ 
                                foreach($coa_default_parameters->result_array() as $coadefaultparameter){
                        ?>
                                <tr>
                                    <th><input style="padding-left:0px;padding-right:0px;" type="number" name="sl_number[]" value="<?=$coadefaultparameter['serial_number']?>" id="sl_number<?=$i?>" onchange="fetchcoadefaultdetails(this,<?=$i?>)" class="form-control" ></th>
                                    <th><input style="padding-left:0px;padding-right:0px;" type="text" name="parameter[]" value="<?=$coadefaultparameter['parameter']?>" id="parameter<?=$i?>" class="form-control"></th>
                                    <th><input style="padding-left:0px;padding-right:0px;" type="text" name="requirement[]" value="<?=$coadefaultparameter['requirement']?>" id="requirement<?=$i?>" class="form-control" ></th>
                                    <th><input style="padding-left:0px;padding-right:0px;" type="text" name="result_or_observation[]" value=""  id="result_or_observation<?=$i?>" class="form-control" ></th>
                                    <th><select  name="complied_or_not_complied[]" id="complied_or_not_complied<?=$i?>" class="form-control">
                                            <option value="">Select Option</option> 
                                            <option value="1" >Compiled</option>
                                            <option value="0" >Not Compiled</option>
                                        </select>
                                    </th>
                                    <th><button type="button" onclick="delete_dhr_bill_item_row(this)" title="Delete BOM" class="btn btn-danger btn-flat" ><i class="fa fa-minus"></i></button></th>
                                </tr>
                        <?php $i++; } } ?>
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-sm-12">
                                <label>Remarks</label>
                                <input type="text" name="remarks" value="<?=$coa_information['remarks']?>" class="form-control">
                            </div>
                        </div>    
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Prepare Approval Details-->     
    <div class="row">
        <div class="col-sm-12">   
            <div class="form-container">
                <div class="row">
                    <div  class="col-sm-12">
                        <center><h4>Prepare & Approval Details</h4></center>
                    </div>
                </div>
                			
                <div class="row">
                     <div class="col-sm-6">
                        <label>Prepared Date</label>
                        <input type="date" name="prepared_by_date" id="prepared_by_date" value="<?=$coa_information['prepared_by_date']?>" class="form-control">
                    </div>
                    <div class="col-sm-6">
                        <label>Approved Date</label>
                        <input type="date" name="approved_by_date" value="<?=$coa_information['approved_by_date']?>" class="form-control" >
                    </div>
                     <div class="col-sm-6">
                        <label>Prepared By</label>
                        <select name="prepared_by"  class="form-control">
                              <option value="">Select Signature Of</option>
                                <?php foreach($employees->result_array() as $employee){ if(in_array($employee['dept_id'],array(14))){ ?>
                                    <option value="<?=$employee['id']?>" <?=$employee['id']==$coa_information['prepared_by']?'selected':''?>><?=$employee['employee_name'].' ('.$employee['dept_name'].'-'.$employee['pos_name'].')'?></option>
                                <?php }}?>
                        </select>
                    </div>
                     <div class="col-sm-6">
                        <label>Approved By</label>
                        <select name="approved_by"  class="form-control" >
                              <option value="">Select Signature Of</option>
                                <?php foreach($employees->result_array() as $employee){ if(in_array($employee['dept_id'],array(22))){ ?>
                                    <option value="<?=$employee['id']?>" <?=$employee['id']==$coa_information['approved_by']?'selected':''?>><?=$employee['employee_name'].' ('.$employee['dept_name'].'-'.$employee['pos_name'].')'?></option>
                                <?php }}?>
                        </select>
                    </div>
                </div>
                
               
          
            </div>
        </div>
    </div>
    
      <!--Footer Note-->     
    <div class="row">
        <div class="col-sm-12">   
        
         <?php foreach($coa_footer_note->result_array() as $fn); ?>
         
            <div class="form-container">
               
          
                 <div class="row">
                    <div  class="col-sm-12">
                        <center><h4>Footer Note</h4></center>
                    </div>
                </div>
               
                <div class="row">
                    <div class="col-sm-4">
                        <label>Format No.</label>
                        <input type="text" name="format_no" id="format_no" value="<?=$fn['format_no']==''?'Format No: SECPL_FM_094':$fn['format_no']?>" class="form-control"  readonly>
                    </div>
                    <div class="col-sm-4">
                        <label>Rev. No.</label>
                        <input type="text" name="rev_no" value="<?=$fn['rev_no']==''?'03':$fn['rev_no']?>" class="form-control" readonly>
                    </div>
                    <div class="col-sm-4">
                        <label>Effective Date</label>
                        <input type="date" name="effective_date" value="<?=$fn['effective_date']==''?'2023-11-04':$fn['effective_date']?>" class="form-control" readonly>
                    </div>
                </div>
                
               
            </div>
        </div>
    </div>
   
                <div class="row">
                    <div class="col-sm-12">
                        <center><button type="submit" title="Save Footer Note" class="btn btn-success">SAVE</button></center>
                    </div>
                </div>
    </form> 
   
        <div id="printstageone" style="position:fixed;bottom:40px;width:300px;z-index:12050;">
            <center>
                <table>
                    <tr>
                        <td>
                            <button type="button"  id="coaprint" target="blank" style="width:150px;z-index:12050;"  class="btn btn-primary">COA PDF</button>
                        </td>
                    </tr>
                </table>
            </center>
        </div>
   
<script>
 var employeeslist= '<?=$employeeslist?>';
 var departmentemployees = <?=json_encode($departmentemployees)?>;
 
////coa_form
    $('#coa_form').submit(function(e){
        e.preventDefault();
        if(confirm('are you want to save this record?')){
            $.ajax({
                type:'post',
                url:'<?=base_url("AdminController/coa_form")?>',
                dataType:'json',
                data:new FormData(this),
                processData:false,
                contentType:false,
                success:function(responsedata){
                    alert('Saved Successfully.');
                    coadetails.ajax.reload();
                    $('.close').click();
                }
            });
        }
    });
   
    
////stage_one_bill_of_material_form   
   
    var i= '<?=$i?>';
    function add_dhr_bill_item_row(){
        
        var row='<tr>'+
                        '<th><input style="padding-left:0px;padding-right:0px;" type="number" name="sl_number[]" id="sl_number' + i + '" onchange="fetchcoadefaultdetails(this,'+i+')" class="form-control" ></th>'+
                        '<th><input style="padding-left:0px;padding-right:0px;" type="text" name="parameter[]" id="parameter'+i+'" class="form-control"></th>'+
                        '<th><input style="padding-left:0px;padding-right:0px;" type="text" name="requirement[]" id="requirement'+i+'" class="form-control" ></th>'+
                        '<th><input style="padding-left:0px;padding-right:0px;" type="text" name="result_or_observation[]"  id="result_or_observation'+i+'" class="form-control" ></th>'+
                        '<th><select style="padding-left:0px;padding-right:0px;" name="complied_or_not_complied[]" id="complied_or_not_complied'+i+'" class="form-control"><option value="">Select Option</option> <option value="1">Complied</option><option value="0">Not Complied</option></select></th>'+
                        '<th><button type="button" onclick="delete_dhr_bill_item_row(this)" title="Delete BOM" class="btn btn-danger btn-flat"><i class="fa fa-minus"></i></button></th>'+
                    '</tr>';
        $('#billofmaterial').append(row);
        i++;
    }
    
    function delete_dhr_bill_item_row(tr){
        $(tr).closest('tr').remove();
    }
    
    function fetchcoadefaultdetails(t,pi){
         $.ajax({
                type:'post',
                url:'<?=base_url("AdminController/fetchcoadefaultdetails")?>',
                dataType:'json',
                data:{serial_number:t.value},
                success:function(responsedata){
                    $('#parameter'+pi).val(responsedata['parameter']);
                    $('#requirement'+pi).val(responsedata['requirement']);
                }
            });
    }
    
    $('#reference_dhr_no').change(function(){
         $.ajax({
                type:'post',
                url:'<?=base_url("AdminController/fetchdhrdetails")?>',
                dataType:'json',
                data:{dhr_number:$('#reference_dhr_no').val()},
                success:function(responsedata){
                    $('#product_description').val(responsedata['product_description']);
                    $('#lot_or_batch_no').val(responsedata['lot_or_batch_no']);
                    $('#product_code').val(responsedata['product_code']);
                    $('#released_quantity').val(responsedata['released_quantity']);
                    $('#brand').val(responsedata['brand']);
                }
            });
    });
    
    $('#coaprint').click(function(){
        window.open("<?=base_url('ShahPDF/coa_form/')?>"+$('.coa_id').val(),"BLANK");
    });
    
</script>