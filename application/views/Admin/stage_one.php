<?php 
$order_information = $bill_of_material = $stage_one_pmpr = $stage_one_mpr = $f_g_transfer_note = $mrec = $fgrec = $qaar = $employee = $fn = $qcp_files = $user_privilage = NULL;

$employeeslist = $user_privilage_list = $dept_employeeslist = $departmentemployees = array();

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

foreach($user_privilages->result_array() as $user_privilage){
    $user_privilage_list[$user_privilage['entry_field']]=array('read'=>$user_privilage['read'],'write'=>$user_privilage['write']);
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
    <!--Order Information-->  
    <div class="row">
        <div class="col-sm-12">
            
            <?php foreach($stage_one_dhr_order_information->result_array() as $order_information); ?>
            
            <div class="form-container">
                <form id="stage_one_order_form" enctype="multipart/form-data">
                    <input type="hidden"  id="stage" name="stage" value="stage_1">
                    <input type="hidden" class="dhr_id" name="dhr_id" value="<?=$order_information['id']?>">
               
                <div class="row">
                    <div class="col-sm-12">
                        <center><h4>Order Information</h4></center>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-6">
                        <label>Sales Order #</label>
                        <input type="text" name="sales_order" id="sales_order" value="<?=$order_information['sales_order']?>" class="form-control" <?=($user_privilage_list['sales_order']['read']==1)?'readonly':''?> >
                    </div>
                    <div class="col-sm-6">
                        <label>Production Order #</label>
                        <input type="text" name="production_order" id="production_order" value="<?=$order_information['production_order']?>" class="form-control" <?=($user_privilage_list['production_order']['read']==1)?'readonly':''?>>
                    </div>
                </div>    
                
                <div class="row">
                    <div class="col-sm-12">
                        <label>Product Description</label>
                        <textarea name="product_description" id="product_description" class="form-control" readonly ><?=$order_information['product_description']?></textarea>
                    </div>
                </div>    
                
                <div class="row">    
                    <div class="col-sm-6">
                        <label>DHR #</label>
                        <input type="text" name="dhr" id="dhr" value="<?=$order_information['dhr']?>" class="form-control" <?=($user_privilage_list['dhr']['read']==1)?'readonly':''?>>
                    </div>
                    <div class="col-sm-6">
                        <label>Order Quantity</label>
                        <input type="text" name="order_quantity" id="order_quantity" value="<?=$order_information['order_quantity']?>" class="form-control" readonly>
                    </div>
                </div>    
                
                <div class="row">    
                    <div class="col-sm-6">
                        <label>Batch/Lot #</label>
                        <input type="text" name="batchorlot" id="batchorlot" value="<?=$order_information['batchorlot']?>" class="form-control" <?=($user_privilage_list['batchorlot']['read']==1)?'readonly':''?>>
                    </div>
                    <div class="col-sm-6">
                        <label>Production Quantity</label>
                        <input type="text" name="production_quantity" id="production_quantity" value="<?=$order_information['production_quantity']?>" class="form-control" readonly>
                    </div>
                </div>    
                
                <div class="row">    
                    <div class="col-sm-4">
                        <label>REF/Model #</label>
                        <input type="text" name="reformodel" id="reformodel" value="<?=$order_information['reformodel']?>" class="form-control"  <?=($user_privilage_list['reformodel']['read']==1)?'readonly':''?>>
                    </div>
                    <div class="col-sm-4">
                        <label>Manufacturing Date</label>
                        <input type="date" name="manufacturing_date" id="manufacturing_date" value="<?=$order_information['manufacturing_date']?>" class="form-control" <?=($user_privilage_list['manufacturing_date']['read']==1)?'readonly':''?>>
                    </div>
                    <div class="col-sm-4">
                        <label>Date Of Commencement</label>
                        <input type="date" name="date_of_commencement" id="date_of_commencement" value="<?=$order_information['date_of_commencement']?>" class="form-control" <?=($user_privilage_list['date_of_commencement']['read']==1)?'readonly':''?>>
                    </div>
                </div>    
                
                <div class="row">    
                    <div class="col-sm-4">
                        <label>Item Code #</label>
                        <input type="text" name="itemcode" id="itemcode" value="<?=$order_information['itemcode']?>" class="form-control" <?=($user_privilage_list['itemcode']['read']==1)?'readonly':''?>>
                    </div>
                    <div class="col-sm-4">
                        <label>Expiry Date</label>
                        <input type="date" name="expiry_date" id="expiry_date" value="<?=$order_information['expiry_date']?>" class="form-control" <?=($user_privilage_list['expiry_date']['read']==1)?'readonly':''?>>
                    </div>
                    <div class="col-sm-4">
                        <label>Date Of Completion</label>
                        <input type="date" name="date_of_completion" id="date_of_completion" value="<?=$order_information['date_of_completion']?>" class="form-control" <?=($user_privilage_list['date_of_completion']['read']==1)?'readonly':''?>>
                    </div>
               </div>    
                
                <div class="row">    
                    <div class="col-sm-3">
                        <label>DHR Issued by(QA) #</label>
                        <select name="dhr_issued_by_qa" id="dhr_issued_by_qa" value="<?=$order_information['dhr_issued_by_qa']?>" class="form-control" <?=($user_privilage_list['dhr_issued_by_qa']['read']==1)?'onmousedown="event.preventDefault(); this.blur();" readonly ':''?>>
                            <option value="">Select DHR Issued by</option>
                            <?php foreach($employees->result_array() as $employee){ if($employee['dept_id']==22){ ?>
                                        <option value="<?=$employee['id']?>" <?=$employee['id']==$order_information['dhr_issued_by_qa']?'selected':''?>><?=$employee['employee_name'].' ('.$employee['dept_name'].'-'.$employee['pos_name'].')'?></option>
                            <?php } }?>
                        </select>         
                    </div>
                    <div class="col-sm-3">
                        <label>DHR Issued Date(QA) #</label>
                        <input type="date" name="dhr_issued_date_qa" id="dhr_issued_date_qa" value="<?=$order_information['dhr_issued_date_qa']?>" class="form-control" <?=($user_privilage_list['dhr_issued_date_qa']['read']==1)?'readonly':''?>>
                    </div>
                    <div class="col-sm-3">
                        <label>DHR Received by (Production)</label>
                        <select name="dhr_received_by_production" id="dhr_received_by_production" value="<?=$order_information['dhr_received_by_production']?>" class="form-control" <?=($user_privilage_list['dhr_received_by_production']['read']==1)?'onmousedown="event.preventDefault(); this.blur();" readonly ':''?> >
                           <option value="">Select DHR Received by</option>
                            <?php foreach($employees->result_array() as $employee){ if($employee['dept_id']==15){ ?>
                                    <option value="<?=$employee['id']?>" <?=$employee['id']==$order_information['dhr_received_by_production']?'selected':''?>><?=$employee['employee_name'].' ('.$employee['dept_name'].'-'.$employee['pos_name'].')'?></option>
                            <?php } }?>
                        </select>    
                    </div>
                    <div class="col-sm-3">
                        <label>DHR Received Date (Production)</label>
                        <input type="date" name="dhr_received_date_production" id="dhr_received_date_production" value="<?=$order_information['dhr_received_date_production']?>" class="form-control" <?=($user_privilage_list['dhr_received_date_production']['read']==1)?'readonly':''?>>
                    </div>
                </div>
                
                <div class="row">
                    <div col-sm-12>
                        <p>Note:Manufacturing and Expiry Date as per Customer Label.</p>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-12">
                        <center><button type="submit" for="stage_one_order_form" if="stage_one_order_form_save" title="Save Order Information" class="btn btn-success">SAVE</button></center>
                    </div>
                </div>
                
            </form>
            </div>
        </div>
    </div>
    
    <!--BOM-->  
    <div class="row">
        <div class="col-sm-12">
            
            <?php foreach($stage_one_dhr_bill_of_material->result_array() as $bill_of_material);?>
            
            <div class="form-container">
                <form id="stage_one_bill_of_material_form" enctype="multipart/form-data">
                <input type="hidden" class="dhr_id" name="dhr_id" value="<?=$order_information['id']?>">
               
                <div class="row">
                    <div class="col-sm-12">
                        <center><h4>Bill Of Material</h4></center>
                    </div>
                </div>
                 <div class="row">
                    <div class="col-sm-6">
                        <label>Reference :</label>
                        <input type="text" name="reference" id="reference" value="<?=$bill_of_material['reference']?>" class="form-control">
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
                                    <th style="width:10%;">Item #</th>
                                    <th style="width:30%;">Description</th>
                                    <th style="width:7.14%;">UOM</th>
                                    <th style="width:7.14%;">Quantity Required</th>
                                    <th style="width:7.14%;">Quantity Issued</th>
                                    <th style="width:7.14%;">QIR #</th>
                                    <th style="width:7.14%;">Item Lot # (Input Lot)</th>
                                    <th style="width:7.14%;">Issued By</th>
                                    <th style="width:7.14%;">Received By</th>
                                    <th>Date</th>
                                    <th style="width:20%;">Remarks</th>
                                    <th><button type="button" onclick="add_dhr_bill_item_row()" title="Add BOM" class="btn btn-success btn-flat" <?=($user_privilage_list['add_dhr_bill_item_row']['read']==1)?'hidden':''?>><i class="fa fa-plus"></i></button></th>
                                </tr>
                            </thead>
                            <tbody>
                        
                        <?php  $i=1; foreach($stage_one_dhr_bill_of_material->result_array() as $bill_of_material){ ?>
                                   
                                <tr>
                                    <th><input style="padding-left:0px;padding-right:0px;" type="text" name="item_number[]" value="<?=$bill_of_material['item_number']?>" id="item_number<?=$i?>" class="form-control" <?=($user_privilage_list['item_number']['read']==1)?'readonly':''?> ></th>
                                    <th><input style="padding-left:0px;padding-right:0px;" type="text" name="item_description[]" value="<?=$bill_of_material['item_description']?>" id="item_description<?=$i?>" class="form-control" <?=($user_privilage_list['item_description']['read']==1)?'readonly':''?>></th>
                                    <th><input style="padding-left:0px;padding-right:0px;" type="text" name="uom[]" value="<?=$bill_of_material['uom']?>" id="uom<?=$i?>" class="form-control" <?=($user_privilage_list['uom']['read']==1)?'readonly':''?>></th>
                                    <th><input style="padding-left:0px;padding-right:0px;" type="number" step="0.001" name="quantity_required[]" value="<?=$bill_of_material['quantity_required']?>"  id="quantity_required<?=$i?>" class="form-control" <?=($user_privilage_list['quantity_required']['read']==1)?'readonly':''?>></th>
                                    <th><input style="padding-left:0px;padding-right:0px;" type="number" step="0.001" name="quantity_issued[]" value="<?=$bill_of_material['quantity_issued']?>" onchange="calculate_orderdered_quantity()" id="quantity_issued<?=$i?>" class="form-control" <?=($user_privilage_list['quantity_issued']['read']==1)?'readonly':''?>></th>
                                    <th><input style="padding-left:0px;padding-right:0px;" type="text" name="qir_number[]" value="<?=$bill_of_material['qir_number']?>" id="qir_number<?=$i?>" class="form-control" <?=($user_privilage_list['qir_number']['read']==1)?'readonly':''?>></th>
                                    <th><input style="padding-left:0px;padding-right:0px;" type="text" name="item_lot_number[]" value="<?=$bill_of_material['item_lot_number']?>" id="item_lot_number<?=$i?>" class="form-control" <?=($user_privilage_list['item_lot_number']['read']==1)?'readonly':''?>></th>
                                    <th>
                                        <select style="padding-left:0px;padding-right:0px;" type="text" name="issued_by[]" id="issued_by<?=$i?>" class="form-control" <?=($user_privilage_list['issued_by']['read']==1)?'onmousedown="event.preventDefault(); this.blur();" readonly':''?>>
                                            <option value="">Select issued by</option>
                                            <?php foreach($employees->result_array() as $employee){  if(in_array($employee['dept_id'],array(16))){ ?>
                                                <option value="<?=$employee['id']?>" <?=$employee['id']==$bill_of_material['issued_by']?'selected':''?>><?=$employee['employee_name'].' ('.$employee['dept_name'].'-'.$employee['pos_name'].')'?></option>
                                            <?php }}?>
                                        </select>
                                    </th>
                                    <th>
                                        <select style="padding-left:0px;padding-right:0px;" type="text" name="received_by[]"  id="received_by<?=$i?>" class="form-control" <?=($user_privilage_list['received_by']['read']==1)?'onmousedown="event.preventDefault(); this.blur();" readonly':''?>>
                                        <option value="">Select received by</option>
                                            <?php foreach($employees->result_array() as $employee){  if(in_array($employee['dept_id'],array(15))){ ?>
                                                <option value="<?=$employee['id']?>" <?=$employee['id']==$bill_of_material['received_by']?'selected':''?>><?=$employee['employee_name'].' ('.$employee['dept_name'].'-'.$employee['pos_name'].')'?></option>
                                            <?php }}?>
                                        </select>
                                    </th>
                                    <th><input style="padding-left:0px;padding-right:0px;" type="date" name="date[]" value="<?=$bill_of_material['date']?>" id="date<?=$i?>" class="form-control" <?=($user_privilage_list['date']['read']==1)?'readonly':''?>></th>
                                    <th><input style="padding-left:0px;padding-right:0px;" type="text" name="remarks[]" value="<?=$bill_of_material['remarks']?>" id="remarks<?=$i?>" class="form-control" <?=($user_privilage_list['bom_remarks']['read']==1)?'readonly':''?>></th>
                                    <th><button type="button" onclick="delete_dhr_bill_item_row(this)" title="Delete BOM" class="btn btn-danger btn-flat" <?=($user_privilage_list['delete_dhr_bill_item_row']['read']==1)?'hidden':''?>><i class="fa fa-minus"></i></button></th>
                                </tr>
                            
                        <?php   $i++; } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <center><button type="submit" title="Save Bill Of Material" id="stage_one_bill_of_material_form_save" class="btn btn-success">SAVE</button></center>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
    
    <!--Pre-Manufacturing Process-->  
    <div class="row">
        <div class="col-sm-12">
            <div class="form-container">
                <form id="stage_one_pre_manufacturing_process_form" enctype="multipart/form-data">
                <input type="hidden" class="dhr_id" name="dhr_id" value="<?=$order_information['id']?>">
                <div class="row">
                    <div  class="col-sm-12">
                        <center><h4>Pre-Manufacturing Process</h4></center>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-responsive" id="premanufacturingprocesstable" width="100%">
                            <thead>
                                <tr>
                                    <th width="10%">Item #</th>
                                    <th width="50%">Description</th>
                                    <th width="<?=(40/8)?>%">UOM</th>
                                    <th width="<?=(40/8)?>%">Qunatity</th>
                                    <th width="<?=(40/8)?>%">WI #</th>
                                    <th width="<?=(40/8)?>%">Equipment #</th>
                                    <th width="<?=(40/8)?>%">Done By</th>
                                    <th width="<?=(40/8)?>%">Verified By</th>
                                    <th width="<?=(40/8)?>%">Date</th>
                                    <th><button type="button" onclick="add_premprocess_row()" title="Add the Pre-Manufacturing Process item"class="btn btn-success btn-flat" <?=($user_privilage_list['add_premprocess_row']['read']==1)?'hidden':''?>><i class="fa fa-plus" ></i></button></th>
                                </tr>
                            </thead>
                            <tbody>
                        
                        <?php   foreach($stage_one_pre_manufacturing_process->result_array() as $stage_one_pmpr){ ?>
                                   
                                <tr>
                                    <th><input type="text" name="prmp_item_number[]" value="<?=$stage_one_pmpr['prmp_item_number']?>" class="form-control"  <?=($user_privilage_list['prmp_item_number']['read']==1)?'readonly':''?>></th>
                                    <th><input type="text" name="prmp_item_description[]" value="<?=$stage_one_pmpr['prmp_item_description']?>" class="form-control"  <?=($user_privilage_list['prmp_item_description']['read']==1)?'readonly':''?>></th>
                                    <th><input type="text" name="prmp_uom[]" value="<?=$stage_one_pmpr['prmp_uom']?>" class="form-control"  <?=($user_privilage_list['prmp_uom']['read']==1)?'readonly':''?>></th>
                                    <th><input type="text" name="prmp_qunatity[]" value="<?=$stage_one_pmpr['prmp_qunatity']?>" class="form-control"  <?=($user_privilage_list['prmp_qunatity']['read']==1)?'readonly':''?>></th>
                                    <th><input type="text" name="prmp_wi_number[]" value="<?=$stage_one_pmpr['prmp_wi_number']?>" class="form-control"  <?=($user_privilage_list['prmp_wi_number']['read']==1)?'readonly':''?>></th>
                                    <th><input type="text" name="prmp_equipment_number[]" value="<?=$stage_one_pmpr['prmp_equipment_number']?>" class="form-control"  <?=($user_privilage_list['prmp_equipment_number']['read']==1)?'readonly':''?>></th>
                                    <th><input type="text" name="prmp_done_by[]" class="form-control"  value="<?=$stage_one_pmpr['prmp_done_by']?>" <?=($user_privilage_list['prmp_done_by']['read']==1)?'readonly':''?>></th>
                                    <th>
                                        <select name="prmp_verified_by[]" class="form-control"  <?=($user_privilage_list['prmp_verified_by']['read']==1)?'onmousedown="event.preventDefault(); this.blur();" readonly':''?>>
                                             <option value="">Select Verified By</option>
                                            <?php foreach($employees->result_array() as $employee){ if(in_array($employee['dept_id'],array(15))){?>
                                                <option value="<?=$employee['id']?>" <?=$employee['id']==$stage_one_pmpr['prmp_verified_by']?'selected':''?>><?=$employee['employee_name'].' ('.$employee['dept_name'].'-'.$employee['pos_name'].')'?></option>
                                            <?php }}?>
                                        </select>
                                    </th>
                                    <th><input type="date" name="prmp_date[]" value="<?=$stage_one_pmpr['prmp_date']?>" class="form-control"  <?=($user_privilage_list['prmp_date']['read']==1)?'readonly':''?>></th>
                                    <th><button type="button" onclick="delete_premprocess_row(this)" title="Remove the Pre-Manufacturing Process item" class="btn btn-danger btn-flat"  <?=($user_privilage_list['delete_premprocess_row']['read']==1)?'hidden':''?>><i class="fa fa-minus"></i></button></th>
                                </tr>
                            
                        <?php    } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <button type="submit" title="Save Pre-Manufacturing Process" id="stage_one_pre_manufacturing_process_form_save" class="btn btn-success">SAVE</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
    
    <!--Manufacturing Process-->   
    <div class="row">
        <div class="col-sm-12">        
            <div class="form-container">
                <form id="stage_one_manufacturing_process_form" enctype="multipart/form-data">
                <input type="hidden" class="dhr_id" name="dhr_id" value="<?=$order_information['id']?>">
                <div class="row">
                    <div  class="col-sm-12">
                        <center><h4>Manufacturing Process</h4></center>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-responsive" id="manufacturingprocess" width="100%">
                            <thead>
                                <tr>
                                    <th style="width:10%;">Seq. #</th>
                                    <th style="width:30%;">Process Description</th>
                                    <th style="width:20%;">WI #</th>
                                    <th style="width:10%;">Equipment #</th>
                                    <th style="width:<?=(40/8)?>%;">Line Clearance By</th>
                                    <th style="width:<?=(40/8)?>%;">Start Date/Time</th>
                                    <th style="width:<?=(40/8)?>%;">End Date/Time</th>
                                    <th style="width:<?=(40/8)?>%;">Manufactured Qunatity</th>
                                    <th style="width:<?=(40/8)?>%;">Good Qunatity</th>
                                    <th style="width:<?=(40/8)?>%;">Rejected Quantity</th>
                                    <th style="width:<?=(40/8)?>%;">Done By</th>
                                    <th style="width:<?=(40/8)?>%;">Verified By</th>
                                    
                                    <th><button type="button" onclick="add_mprocess_row()" title="Add Manufacturing Process Item" class="btn btn-success btn-flat" <?=($user_privilage_list['add_mprocess_row']['read']==1)?'hidden':''?>><i class="fa fa-plus"></i></button></th>
                                </tr>
                            </thead>
                            <tbody>
                        
                        <?php $mp_i=1;  foreach($stage_one_manufacturing_process->result_array() as $stage_one_mpr){ ?>
                                   
                                <tr>
                                    <th><input style="padding-left:0px;padding-right:0px;" type="number" name="mp_seq_number[]" id="mp_seq_number<?=$mp_i?>" onchange="get_mp_process_description(<?=$mp_i?>)" value="<?=$stage_one_mpr['mp_seq_number']?>" class="form-control mp_seq_number"  <?=($user_privilage_list['mp_seq_number']['read']==1)?'readonly':''?>></th>
                                    <th><input style="padding-left:0px;padding-right:0px;" type="text" name="mp_process_description[]" id="mp_process_description<?=$mp_i?>" value="<?=$stage_one_mpr['mp_process_description']?>" class="form-control" <?=($user_privilage_list['mp_process_description']['read']==1)?'readonly':''?>></th>
                                    <th><input style="padding-left:0px;padding-right:0px;" type="text" name="mp_wi_number[]" id="mp_wi_number<?=$mp_i?>" value="<?=$stage_one_mpr['mp_wi_number']?>" class="form-control" <?=($user_privilage_list['mp_wi_number']['read']==1)?'readonly':''?>></th>
                                    <th><select style="padding-left:0px;padding-right:0px;"  name="mp_equipment_number[]" id="mp_equipment_number<?=$mp_i?>" class="form-control" <?=($user_privilage_list['mp_equipment_number']['read']==1)?'onmousedown="event.preventDefault(); this.blur();" readonly':''?>>
                                            <option><?=$stage_one_mpr['mp_equipment_number']?></option>
                                        </select>
                                    </th>
                                    <th>
                                        <select style="padding-left:0px;padding-right:0px;" name="mp_line_clearance_by[]" id="mp_line_clearance_by<?=$mp_i?>" class="form-control" <?=($user_privilage_list['mp_line_clearance_by']['read']==1)?'onmousedown="event.preventDefault(); this.blur();" readonly':''?>>
                                             <option value="">Select Clearance By</option>
                                            <?php foreach($employees->result_array() as $employee){ if(in_array($employee['dept_id'],array(14))){ ?>
                                                <option value="<?=$employee['id']?>" <?=$employee['id']==$stage_one_mpr['mp_line_clearance_by']?'selected':''?>><?=$employee['employee_name'].' ('.$employee['dept_name'].'-'.$employee['pos_name'].')'?></option>
                                            <?php }}?>
                                        </select>
                                    </th>    
                                    <th><input style="padding-left:0px;padding-right:0px;" type="datetime-local" name="mp_start_datetime[]" id="mp_start_datetime<?=$mp_i?>" value="<?=$stage_one_mpr['mp_start_datetime']?>" class="form-control" <?=($user_privilage_list['mp_start_datetime']['read']==1)?'readonly':''?>></th>
                                    <th><input style="padding-left:0px;padding-right:0px;" type="datetime-local" name="mp_end_datetime[]" id="mp_end_datetime<?=$mp_i?>" value="<?=$stage_one_mpr['mp_end_datetime']?>" class="form-control" <?=($user_privilage_list['mp_end_datetime']['read']==1)?'readonly':''?>></th>
                                   
                                    <th><input style="padding-left:0px;padding-right:0px;" type="text" name="mp_manufactured_qunatity[]" id="mp_manufactured_qunatity<?=$mp_i?>" value="<?=$stage_one_mpr['mp_manufactured_qunatity']?>"  class="form-control mp_manufactured_qunatity" readonly></th>
                                    <th><input style="padding-left:0px;padding-right:0px;" type="text" name="mp_good_qunatity[]" id="mp_good_qunatity<?=$mp_i?>" value="<?=$stage_one_mpr['mp_good_qunatity']?>" onblur="sum_mp_good_quantity(<?=$mp_i?>)" class="form-control mp_good_qunatity" <?=($user_privilage_list['mp_good_qunatity']['read']==1)?'readonly':''?>></th>
                                    <th><input style="padding-left:0px;padding-right:0px;" type="text" name="mp_rejected_qunatity[]" id="mp_rejected_qunatity<?=$mp_i?>" value="<?=$stage_one_mpr['mp_rejected_qunatity']?>" onblur="sum_mp_good_quantity(<?=$mp_i?>)" class="form-control mp_rejected_qunatity" <?=($user_privilage_list['mp_rejected_qunatity']['read']==1)?'readonly':''?>></th>
                                     
                                    <th><input type="text" style="padding-left:0px;padding-right:0px;" name="mp_done_by[]" id="mp_done_by<?=$mp_i?>" value="<?=$stage_one_mpr['mp_done_by']?>" class="form-control" <?=($user_privilage_list['mp_done_by']['read']==1)?'readonly':''?>></th>
                                    <th>
                                        <select style="padding-left:0px;padding-right:0px;"  name="mp_verified_by[]" id="mp_verified_by<?=$mp_i?>" class="form-control" <?=($user_privilage_list['mp_verified_by']['read']==1)?'onmousedown="event.preventDefault(); this.blur();" readonly':''?>>
                                            <option value="">Select Verified By</option>
                                            <?php foreach($employees->result_array() as $employee){ if(in_array($employee['dept_id'],array(15))){ ?>
                                                <option value="<?=$employee['id']?>" <?=$employee['id']==$stage_one_mpr['mp_verified_by']?'selected':''?>><?=$employee['employee_name'].' ('.$employee['dept_name'].'-'.$employee['pos_name'].')'?></option>
                                            <?php }}?>
                                        </select>
                                    </th>
                                    
                                    <th><button type="button" onclick="delete_mprocess_row(this)" title="Delete Manufacturing Process Item" class="btn btn-danger btn-flat" <?=($user_privilage_list['delete_mprocess_row']['read']==1)?'hidden':''?>><i class="fa fa-minus"></i></button></th>
                                </tr>
                            
                        <?php  $mp_i++;  } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <center><button type="submit" title="Save Manufacturing Process" id="stage_one_manufacturing_process_form_save" class="btn btn-success">SAVE</button></center>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
    
     <!--Post Manufacturing Process-->  
    <div class="row">
        <div class="col-sm-12">
            <div class="form-container">
                <form id="stage_one_post_manufacturing_process_form" enctype="multipart/form-data">    
                <input type="hidden" class="dhr_id" name="dhr_id" value="<?=$order_information['id']?>">
                 <div class="row">
                    <div  class="col-sm-12">
                        <center><h4>Post Manufacturing Process</h4></center>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-responsive" id="postmanufacturingprocess" width="100%">
                            <thead>
                                <tr>
                                    <th>Seq. #</th>
                                    <th>Process Description</th>
                                    <th>WI #</th>
                                    <th>DCC # (If Applicable)</th>
                                    <th>Sent Date</th>
                                    <th>Cycle #/Report #</th>
                                    <th>Process Date</th>
                                    <th>Done By</th>
                                    <th>Checked By</th>
                                    <th><button type="button" onclick="add_pmprocess_row()" title="Add Post Manufacturing Process Item" class="btn btn-success btn-flat" <?=($user_privilage_list['add_pmprocess_row']['read']==1)?'hidden':''?>><i class="fa fa-plus"></i></button></th>
                                </tr>
                            </thead>
                            <tbody>
                        
                        <?php  $postmp_i=1; foreach($stage_one_post_manufacturing_process->result_array() as $stage_one_pompr){ ?>
                                   
                                <tr>
                                    <th><input style="padding-left:0px;padding-right:0px;" type="text" name="pmp_seq_number[]"  id="pmp_seq_number<?=$postmp_i?>" value="<?=$stage_one_pompr['pmp_seq_number']?>" class="form-control" <?=($user_privilage_list['pmp_seq_number']['read']==1)?'readonly':''?>></th>
                                    <th><input style="padding-left:0px;padding-right:0px;" type="text" name="pmp_process_description[]" id="pmp_process_description<?=$postmp_i?>" value="<?=$stage_one_pompr['pmp_process_description']?>" class="form-control" <?=($user_privilage_list['pmp_process_description']['read']==1)?'readonly':''?>></th>
                                    <th><input style="padding-left:0px;padding-right:0px;" type="text" name="pmp_wi_number[]"  id="pmp_wi_number<?=$postmp_i?>" value="<?=$stage_one_pompr['pmp_wi_number']?>" class="form-control" <?=($user_privilage_list['pmp_wi_number']['read']==1)?'readonly':''?>></th>
                                    <th><input style="padding-left:0px;padding-right:0px;" type="text" name="pmp_dcc_number[]" id="pmp_dcc_number<?=$postmp_i?>" value="<?=$stage_one_pompr['pmp_dcc_number']?>" class="form-control" <?=($user_privilage_list['pmp_dcc_number']['read']==1)?'readonly':''?>></th>
                                    <th><input style="padding-left:0px;padding-right:0px;" type="date" name="pmp_sent_date[]" id="pmp_sent_date<?=$postmp_i?>" value="<?=$stage_one_pompr['pmp_sent_date']?>" class="form-control" <?=($user_privilage_list['pmp_sent_date']['read']==1)?'readonly':''?>></th>
                                    <th><input style="padding-left:0px;padding-right:0px;" type="text" name="pmp_cycle_number_or_report_number[]" id="pmp_cycle_number_or_report_number<?=$postmp_i?>" value="<?=$stage_one_pompr['pmp_cycle_number_or_report_number']?>" class="form-control" <?=($user_privilage_list['pmp_cycle_number_or_report_number']['read']==1)?'readonly':''?>></th>
                                    <th><input style="padding-left:0px;padding-right:0px;" type="date" name="pmp_process_date[]" id="pmp_process_date<?=$postmp_i?>" value="<?=$stage_one_pompr['pmp_process_date']?>" class="form-control" <?=($user_privilage_list['pmp_process_date']['read']==1)?'readonly':''?>></th>
                                    <th>
                                        <input type="" style="padding-left:0px;padding-right:0px;" name="pmp_done_by[]" id="pmp_done_by<?=$postmp_i?>" class="form-control" value="<?=$stage_one_pompr['pmp_done_by']?>" <?=($user_privilage_list['pmp_done_by']['read']==1)?'readonly':''?>>
                                        <!--<select style="padding-left:0px;padding-right:0px;" name="pmp_done_by[]" class="form-control"  <?=($user_privilage_list['pmp_done_by']['read']==1)?'onmousedown="event.preventDefault(); this.blur();" readonly':''?>>-->
                                        <!--    <option value="">Select Done By</option>-->
                                        <!--    <?php foreach($employees->result_array() as $employee){ ?>-->
                                        <!--        <option value="<?=$employee['id']?>" <?=$employee['id']==$stage_one_pompr['pmp_done_by']?'selected':''?>><?=$employee['employee_name'].' ('.$employee['dept_name'].'-'.$employee['pos_name'].')'?></option>-->
                                        <!--    <?php }?>-->
                                        <!--</select>-->
                                    </th>
                                    <th>
                                        <select style="padding-left:0px;padding-right:0px;" name="pmp_checked_by[]" class="form-control" id="pmp_checked_by<?=$postmp_i?>"  <?=($user_privilage_list['pmp_checked_by']['read']==1)?'onmousedown="event.preventDefault(); this.blur();" readonly':''?>>
                                            <option value="">Select checked_by</option>
                                            <?php foreach($employees->result_array() as $employee){ if(in_array($employee['dept_id'],array(14))){ ?>
                                                <option value="<?=$employee['id']?>" <?=$employee['id']==$stage_one_pompr['pmp_checked_by']?'selected':''?>><?=$employee['employee_name'].' ('.$employee['dept_name'].'-'.$employee['pos_name'].')'?></option>
                                            <?php }}?>
                                        </select>
                                    </th>
                                    <th><button type="button" onclick="delete_pmprocess_row(this)" title="Remove Post Manufacturing Process Item" class="btn btn-danger btn-flat"  <?=($user_privilage_list['delete_pmprocess_row']['read']==1)?'hidden':''?>><i class="fa fa-minus"></i></button></th>
                                </tr>
                            
                        <?php  $postmp_i++;  } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-12">
                        <center><button type="submit" title="Save Post Manufacturing Process" id="stage_one_post_manufacturing_process_form_save" class="btn btn-success">SAVE</button></center>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
     
      <!--Quality Control Process-->     
    <div class="row">
        <div class="col-sm-12">        
            <div class="form-container">
                <form id="stage_one_quality_control_process_form" enctype="multipart/form-data">    
                <input type="hidden" class="dhr_id" name="dhr_id" value="<?=$order_information['id']?>">
                 <div class="row">
                    <div  class="col-sm-12">
                        <center><h4>Quality Control Process</h4></center>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-responsive" id="qualitycontrolprocess" width="100%">
                            <thead>
                                <tr>
                                    <th width="10%">Seq. #</th>
                                    <th width="20%">Inspection (Or) Testing Description</th>
                                    <th width="20%">WI #</th>
                                    <th width="<?=50/6?>%">QIR #/Report #</th>
                                    <th width="<?=50/6?>%">Sample Quantity</th>
                                    <th width="<?=50/6?>%">Pass/Fail</th>
                                    <th width="<?=50/6?>%">Verified By</th>
                                    <th width="<?=50/6?>%">Verified Date</th>
                                    <th width="<?=50/6?>%">Scanned File</th>
                                    <th><button type="button" onclick="add_qcprocess_row()" title="Add Quality Control Process Item" class="btn btn-success btn-flat"  <?=($user_privilage_list['add_qcprocess_row']['read']==1)?'hidden':''?>><i class="fa fa-plus"></i></button></th>
                                </tr>
                            </thead>
                            <tbody>
                        
                        <?php   foreach($stage_one_qcp_files->result_array() as $qcp_files); 
                                $qcp_i=1; 
                                foreach($stage_one_quality_control_process->result_array() as $qcpr){ ?>
                                   
                                <tr>
                                    <th><input type="number" name="qcp_seq_number[]" id="qcp_seq_number<?=$qcp_i?>" value="<?=$qcpr['qcp_seq_number']?>" onchange="get_qc_process_description(<?=$qcp_i?>)" class="form-control"  <?=($user_privilage_list['qcp_seq_number']['read']==1)?'readonly':''?>></th>
                                    <th><input type="text" name="qcp_process_inspection_or_testing_description[]" id="qcp_process_inspection_or_testing_description<?=$qcp_i?>" value="<?=$qcpr['qcp_process_inspection_or_testing_description']?>" class="form-control" <?=($user_privilage_list['qcp_process_inspection_or_testing_description']['read']==1)?'readonly':''?>></th>
                                    <th><input type="text" name="qcp_wi_number[]" id="qcp_wi_number<?=$qcp_i?>" value="<?=$qcpr['qcp_wi_number']?>" class="form-control" <?=($user_privilage_list['qcp_wi_number']['read']==1)?'readonly':''?>></th>
                                    <th><input type="text" name="qcp_qir_number_or_report_number[]" id="qcp_qir_number_or_report_number<?=$qcp_i?>" value="<?=$qcpr['qcp_qir_number_or_report_number']?>" class="form-control" <?=($user_privilage_list['qcp_qir_number_or_report_number']['read']==1)?'readonly':''?>></th>
                                    <th><input type="text" name="qcp_sample_quantity[]" id="qcp_sample_quantity<?=$qcp_i?>" value="<?=$qcpr['qcp_sample_quantity']?>" class="form-control" <?=($user_privilage_list['qcp_sample_quantity']['read']==1)?'readonly':''?>></th>
                                    <th>
                                        <select name="qcp_pass_or_fail[]" id="qcp_pass_or_fail<?=$qcp_i?>"  class="form-control" <?=($user_privilage_list['qcp_pass_or_fail']['read']==1)?'onmousedown="event.preventDefault(); this.blur();" readonly':''?>>
                                            <option value="">Select the option</option>
                                            <option <?=$qcpr['qcp_pass_or_fail']=='Pass'?'selected':''?>>Pass</option>
                                            <option <?=$qcpr['qcp_pass_or_fail']=='Fail'?'selected':''?>>Fail</option>
                                        </select>
                                    </th>
                                    <th>
                                        <select name="qcp_verified_by[]" id="qcp_verified_by<?=$qcp_i?>" class="form-control"  <?=($user_privilage_list['qcp_verified_by']['read']==1)?'onmousedown="event.preventDefault(); this.blur();" readonly':''?>>
                                            <option value="">Select Verified By</option>
                                                <?php foreach($employees->result_array() as $employee){  if(in_array($employee['dept_id'],array(14))){ ?>
                                                    <option value="<?=$employee['id']?>" <?=$employee['id']==$qcpr['qcp_verified_by']?'selected':''?>><?=$employee['employee_name'].' ('.$employee['dept_name'].'-'.$employee['pos_name'].')'?></option>
                                                <?php }}?>
                                        </select>
                                    </th>
                                    <th><input type="date" name="qcp_verified_date[]" id="qcp_verified_date<?=$qcp_i?>" value="<?=$qcpr['qcp_verified_date']?>" class="form-control"  <?=($user_privilage_list['qcp_verified_date']['read']==1)?'readonly':''?>></th>
                                    <th><select name="qcp_scanned_file[]" id="qcp_scanned_file<?=$qcp_i?>" class="form-control" style="width:50px;padding:0px;"  <?=($user_privilage_list['qcp_scanned_file']['read']==1)?'onmousedown="event.preventDefault(); this.blur();" readonly':''?>>
                                        <option value="0" <?=$qcpr['qcp_scanned_file']==0?'selected':''?>>&#10060;</option>
                                        <option value="1" <?=$qcpr['qcp_scanned_file']==1?'selected':''?>>&#x2714;</option>
                                        </select>
                                    </th>
                                    <th><button type="button" onclick="delete_qcprocess_row(this)" title="Remove Quality Control Process Item" class="btn btn-danger btn-flat"  <?=($user_privilage_list['delete_qcprocess_row']['read']==1)?'hidden':''?>><i class="fa fa-minus"></i></button></th>
                                </tr>
                            
                        <?php  $qcp_i++;  } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                 <div class="row">
                    <div class="col-sm-4 col-sm-offset-4">
                        <label>Scanned File Upload</label>
                        <input type="file" name="qcp_scanned_pdf_file" id="qcp_scanned_pdf_file"  class="form-control">
                    </div>
                    <?php if(file_exists($qcp_files['scanned_file'])){ ?>
                        <div class="col-sm-4" id="scanfiledata">
                            <?php $fullpath=explode('/',$qcp_files['scanned_file']);?>
                           <a href="<?=base_url($qcp_files['scanned_file'])?>" target="_blank"  class="btn btn-success " > <i class="fa fa-eye">  <?=$fullpath[count($fullpath)-1]?></i></a><span class="btn btn-danger" onclick="deleteqcscannedfile(<?=$qcp_files['dhr_id']?>,'<?=$qcp_files['scanned_file']?>')"><i class="fa fa-trash"></i></span>
                        </div>
                    <?php } ?>
                </div>    
                
                <div class="row">
                    <div class="col-sm-12">
                        <center><button type="submit" title="Save Quality Control Process" id="stage_one_quality_control_process_form_save" class="btn btn-success">SAVE</button></center>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
    
     <!--Finished Goods Transfer Note-->         
    <div class="row">
        <div class="col-sm-12">        
            <div class="form-container">
                <form id="stage_one_finished_goods_transferred_note_form" enctype="multipart/form-data">    
            <input type="hidden" class="dhr_id" name="dhr_id" value="<?=$order_information['id']?>">
                <div class="row">
                    <div class="col-sm-12">
                        <center><h4>Finished Goods Transfer Note</h4></center>
                    </div>
                </div>
                
                <?php   foreach($finished_goods_transfer_note->result_array() as $f_g_transfer_note); ?>
                
                <div class="row">
                    <div class="col-sm-4">
                        <label>Transferred Quantity</label>
                        <input type="text" name="transferred_quantity" id="transferred_quantity" value="<?=$f_g_transfer_note['transferred_quantity']?>" class="form-control" readonly>
                    </div>
                    <div class="col-sm-4">
                        <label>Transferred By (Sign)</label>
                        <select type="text" name="transferred_by"  class="form-control" <?=($user_privilage_list['transferred_by']['read']==1)?'onmousedown="event.preventDefault(); this.blur();" readonly':''?>>
                            <option value="">Select transferred_by</option>
                                <?php foreach($employees->result_array() as $employee){ if(in_array($employee['dept_id'],array(15))){ ?>
                                    <option value="<?=$employee['id']?>" <?=$employee['id']==$f_g_transfer_note['transferred_by']?'selected':''?>><?=$employee['employee_name'].' ('.$employee['dept_name'].'-'.$employee['pos_name'].')'?></option>
                                <?php }}?>
                        </select>
                         <label>Transferred Date</label>
                         <input type="date" name="transferred_date" id="transferred_date" value="<?=$f_g_transfer_note['transferred_date']?>" class="form-control" <?=($user_privilage_list['transferred_date']['read']==1)?'readonly':''?> >
                    </div>
                    
                    <div class="col-sm-4">
                        <label>Accepted By (Sign)</label>
                        <select type="text" name="accepted_by" value="<?=$f_g_transfer_note['accepted_by']?>" class="form-control" <?=($user_privilage_list['accepted_by']['read']==1)?'onmousedown="event.preventDefault(); this.blur();" readonly':''?> >
                            <option value="">Select accepted_by</option>
                                <?php foreach($employees->result_array() as $employee){ if(in_array($employee['dept_id'],array(10,16))){  ?>
                                    <option value="<?=$employee['id']?>" <?=$employee['id']==$f_g_transfer_note['accepted_by']?'selected':''?>><?=$employee['employee_name'].' ('.$employee['dept_name'].'-'.$employee['pos_name'].')'?></option>
                                <?php }}?>
                        </select>
                         <label>Accepted Date</label>
                         <input type="date" name="accepted_date" id="accepted_date" value="<?=$f_g_transfer_note['accepted_date']?>" class="form-control" <?=($user_privilage_list['accepted_date']['read']==1)?'readonly':''?>>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-12">
                        <center><button type="submit" title="Save Finished Goods Transfer Note" id="stage_one_finished_goods_transferred_note_form_save" class="btn btn-success">SAVE</button></center>
                    </div>
                </div>
            </form></div>
        </div>
    </div>    
     
      <!--Material Reconciliation-->     
    <div class="row">
        <div class="col-sm-12">         
            <div class="form-container">
                <form id="stage_one_material_reconciliation_form" enctype="multipart/form-data">    
            <input type="hidden" class="dhr_id" name="dhr_id" value="<?=$order_information['id']?>">
                 <div class="row">
                    <div  class="col-sm-12">
                        <center><h4>Material Reconciliation</h4></center>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-12">
                        <button type="button" onclick="copy_from_bom_to_mrec_row()"  title="Copy Material From BOM" class="btn btn-success btn-flat" <?=(($user_privilage_list['copy_from_bom_to_mrec_row']['read'] ?? 0)==1)?'hidden':''?>><i class="fa fa-copy"></i></button>
                        <table class="table table-responsive" id="materialreconciliation" width="100%">
                            <thead>
                                <tr>
                                    <th width="10%">Item. #</th>
                                    <th width="30%">Description</th>
                                    <th width="<?=(60/8)?>%">UOM</th>
                                    <th width="<?=(60/8)?>%">Quantity Received</th>
                                    <th width="<?=(60/8)?>%">QIR #</th>
                                    <th width="<?=(60/8)?>%">Item Lot # (Input Lot)</th>
                                    <th width="<?=(60/8)?>%">Returned By</th>
                                    <th width="<?=(60/8)?>%">Received By</th>
                                    <th width="<?=(60/8)?>%">Date</th>
                                    <th width="<?=(60/8)?>%">Remarks</th>
                                    <th><button type="button" onclick="add_mrec_row()"  title="Add Material Reconciliation Item" class="btn btn-success btn-flat"><i class="fa fa-plus" <?=($user_privilage_list['add_mrec_row']['read']==1)?'hidden':''?>></i></button></th>
                                </tr>
                            </thead>
                            <tbody>
                        
                        <?php  $mrec_i=1; foreach($stage_one_material_reconciliation->result_array() as $mrec){ ?>
                                   
                                <tr>
                                    <th><input type="text" name="mrec_item_number[]" id="mrec_item_number<?$mrec_i?>" value="<?=$mrec['mrec_item_number']?>" class="form-control" <?=($user_privilage_list['mrec_item_number']['read']==1)?'readonly':''?>></th>
                                    <th><input type="text" name="mrec_description[]" id="mrec_description<?$mrec_i?>" value="<?=$mrec['mrec_description']?>" class="form-control" <?=($user_privilage_list['mrec_description']['read']==1)?'readonly':''?>></th>
                                    <th><input type="text" name="mrec_uom[]" id="mrec_uom<?$mrec_i?>" value="<?=$mrec['mrec_uom']?>" class="form-control"  <?=($user_privilage_list['mrec_uom']['read']==1)?'readonly':''?>></th>
                                    <th><input type="number" step="0.001" name="mrec_quantity_received[]" id="mrec_quantity_received<?$mrec_i?>" value="<?=$mrec['mrec_quantity_received']?>"  onchange="calculate_orderdered_quantity()" class="form-control" <?=($user_privilage_list['mrec_quantity_received']['read']==1)?'readonly':''?>></th>
                                    <th><input type="text" name="mrec_qir_number[]" id="mrec_qir_number<?$mrec_i?>" value="<?=$mrec['mrec_qir_number']?>" class="form-control" <?=($user_privilage_list['mrec_qir_number']['read']==1)?'readonly':''?>></th>
                                    <th><input type="text" name="mrec_item_lot_number_or_input_lot[]" id="mrec_item_lot_number_or_input_lot<?$mrec_i?>" value="<?=$mrec['mrec_item_lot_number_or_input_lot']?>" class="form-control" <?=($user_privilage_list['mrec_item_lot_number_or_input_lot']['read']==1)?'readonly':''?>></th>
                                    <th>
                                        <select type="text" name="mrec_returned_by[]" id="mrec_returned_by<?$mrec_i?>" class="form-control" <?=($user_privilage_list['mrec_returned_by']['read']==1)?'onmousedown="event.preventDefault(); this.blur();" readonly':''?>>
                                            <option value="">Select returned_by</option>
                                            <?php foreach($employees->result_array() as $employee){ if(in_array($employee['dept_id'],array(15))){ ?>
                                                <option value="<?=$employee['id']?>" <?=$employee['id']==$mrec['mrec_returned_by']?'selected':''?>><?=$employee['employee_name'].' ('.$employee['dept_name'].'-'.$employee['pos_name'].')'?></option>
                                            <?php }}?>
                                        </select>
                                    </th>
                                    <th>
                                        <select type="text" name="mrec_received_by[]" id="mrec_received_by<?$mrec_i?>"  class="form-control" <?=($user_privilage_list['mrec_received_by']['read']==1)?'onmousedown="event.preventDefault(); this.blur();" readonly':''?>>
                                            <option value="">Select received_by</option>
                                            <?php foreach($employees->result_array() as $employee){ if(in_array($employee['dept_id'],array(16))){ ?>
                                                <option value="<?=$employee['id']?>" <?=$employee['id']==$mrec['mrec_received_by']?'selected':''?>><?=$employee['employee_name'].' ('.$employee['dept_name'].'-'.$employee['pos_name'].')'?></option>
                                            <?php }}?>
                                        </select>
                                    </th>
                                    <th><input type="date" name="mrec_date[]" id="mrec_date<?$mrec_i?>" value="<?=$mrec['mrec_date']?>" class="form-control" <?=(($user_privilage_list['mrec_date']['read'] ?? 0)==1)?'readonly':''?>></th>
                                    <th><input type="text" name="mrec_remark[]" id="mrec_remark<?$mrec_i?>" value="<?=$mrec['mrec_remark']?>" class="form-control" <?=($user_privilage_list['mrec_remark']['read']==1)?'readonly':''?>></th>
                                    <th><button type="button" onclick="delete_mrec_row(this)" title="Remove Material Reconciliation Item" class="btn btn-danger btn-flat"  <?=(($user_privilage_list['delete_mrec_row']['read']??0)==1)?'hidden':''?>><i class="fa fa-minus"></i></button></th>
                                </tr>
                            
                        <?php   $mrec_i++; } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-12">
                        <center><button type="submit" title="Material Reconciliation" id="stage_one_material_reconciliation_form_save" class="btn btn-success">SAVE</button></center>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>      
     
      <!--Finished Goods Reconciliation-->         
    <div class="row">
        <div class="col-sm-12">    
        
        <?php foreach($stage_one_finished_goods_reconcillation->result_array() as $fgrec); ?>
        
            <div class="form-container">
                <form id="stage_one_finished_goods_reconciliation_form" enctype="multipart/form-data">    
            <input type="hidden" class="dhr_id" name="dhr_id" value="<?=$order_information['id']?>">
                 <div class="row">
                    <div  class="col-sm-12">
                        <center><h4>Finished Goods Reconciliation</h4></center>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-3">
                        <label>Total Quantity Produced and Packed</label>
                        <input type="number" name="total_quantity_produced_and_packed" id="total_quantity_produced_and_packed" value="<?=$fgrec['total_quantity_produced_and_packed']?>" class="form-control" readonly>
                    </div>
                    <div class="col-sm-3">
                        <label>Archive Samples Quantity</label>
                        <input type="number" name="archive_samples_quantity" id="archive_samples_quantity" value="<?=$fgrec['archive_samples_quantity']?>" class="form-control" onkeyup="archive_quantity_reduce()" <?=($user_privilage_list['archive_samples_quantity']['read']==1)?'readonly':''?>>
                    </div>
                    <div class="col-sm-3">
                        <label>Rejected Quantity</label>
                        <input type="number" name="rejected_quantity" id="rejected_quantity" value="<?=$fgrec['rejected_quantity']?>" class="form-control" readonly>
                    </div>
                     <div class="col-sm-3">
                        <label>Yield (Percentage)</label>
                        <input type="number" name="yield_percentage" step="0.01" id="yield_percentage" value="<?=$fgrec['yield_percentage']?>" class="form-control" readonly>
                    </div>
                     <div class="col-sm-3">
                        <label>Reject (Percentage)</label>
                        <input type="number" name="reject_percentage" step="0.01" id="reject_percentage" value="<?=$fgrec['reject_percentage']?>" class="form-control" readonly>
                    </div>
                </div>
                
                 <div class="row">
                    <div class="col-sm-3">
                        <label>Verified By - Production Head (Signature)</label>
                        <select type="text" name="production_verified_by"  class="form-control" <?=($user_privilage_list['production_verified_by']['read']==1)?'onmousedown="event.preventDefault(); this.blur();" readonly':''?>>
                            <option value="">Select Signature Of</option>
                            <?php foreach($employees->result_array() as $employee){ if(in_array($employee['dept_id'],array(15))){  ?>
                                <option value="<?=$employee['id']?>" <?=$employee['id']==$fgrec['production_verified_by']?'selected':''?>><?=$employee['employee_name'].' ('.$employee['dept_name'].'-'.$employee['pos_name'].')'?></option>
                            <?php }}?>
                        </select>
                        <label>Verified Date</label>
                         <input type="date" name="production_verified_date" id="production_verified_date" value="<?=$fgrec['production_verified_date']?>" class="form-control" <?=($user_privilage_list['production_verified_date']['read']==1)?'readonly':''?> >
                    </div>
                    <div class="col-sm-3">
                        <label>Verified Remarks</label>
                        <input type="text" name="production_verified_by_remarks"  value="<?=$fgrec['production_verified_by_remarks']?>" class="form-control" <?=($user_privilage_list['production_verified_by_remarks']['read']==1)?'readonly':''?>>
                    </div>
                    <div class="col-sm-3">
                        <label>Checked By - Quality Control Head (Signature)</label>
                        <select name="checked_by_quality_control"  class="form-control" <?=($user_privilage_list['checked_by_quality_control']['read']==1)?'onmousedown="event.preventDefault(); this.blur();" readonly':''?>>
                            <option value="">Select Signature Of</option>
                            <?php foreach($employees->result_array() as $employee){ if(in_array($employee['dept_id'],array(14))){ ?>
                                <option value="<?=$employee['id']?>" <?=$employee['id']==$fgrec['checked_by_quality_control']?'selected':''?>><?=$employee['employee_name'].' ('.$employee['dept_name'].'-'.$employee['pos_name'].')'?></option>
                            <?php }}?>
                        </select>
                         <label>Checked Date</label>
                         <input type="date" name="checked_by_quality_control_date" id="checked_by_quality_control_date" value="<?=$fgrec['checked_by_quality_control_date']?>" class="form-control" <?=($user_privilage_list['checked_by_quality_control_date']['read']==1)?'readonly':''?>>
                    </div>
                     <div class="col-sm-3">
                        <label>Checked Remarks</label>
                        <input type="text" name="checked_by_quality_control_remark" value="<?=$fgrec['checked_by_quality_control_remark']?>" class="form-control" <?=($user_privilage_list['checked_by_quality_control_remark']['read']==1)?'readonly':''?>>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-12">
                        <center><button type="submit" title="Finished Goods Reconciliation" id="stage_one_finished_goods_reconciliation_form_save" class="btn btn-success">SAVE</button></center>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
     
      <!--QA Approval and Release-->     
    <div class="row">
        <div class="col-sm-12">   
        
         <?php foreach($stage_one_qa_approval_and_release->result_array() as $qaar); ?>
         
            <div class="form-container">
                <form id="stage_one_qa_approval_and_release_form" enctype="multipart/form-data">    
            <input type="hidden" class="dhr_id" name="dhr_id" value="<?=$order_information['id']?>">
                 <div class="row">
                    <div  class="col-sm-12">
                        <center><h4>QA Approval and Release</h4></center>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-3">
                        <label>Quantity Released for Dispatch</label>
                        <input type="number" name="quantity_released_for_dispatch" id="quantity_released_for_dispatch" value="<?=$qaar['quantity_released_for_dispatch']?>" class="form-control" readonly>
                    </div>
                    <div class="col-sm-3">
                        <label>Date Of Release</label>
                        <input type="date" name="date_of_release" value="<?=$qaar['date_of_release']?>" class="form-control" <?=($user_privilage_list['date_of_release']['read']==1)?'readonly':''?>>
                    </div>
                    <div class="col-sm-3">
                        <label>Remarks</label>
                        <input type="text" name="remarks" value="<?=$qaar['remarks']?>" class="form-control" <?=($user_privilage_list['remarks']['read']==1)?'readonly':''?>>
                    </div>
                     <div class="col-sm-3">
                        <label>Signature</label>
                        <select name="signature" value="<?=$qaar['signature']?>" class="form-control" <?=($user_privilage_list['signature']['read']==1)?'onmousedown="event.preventDefault(); this.blur();" readonly':''?>>
                              <option value="">Select Signature Of</option>
                                <?php foreach($employees->result_array() as $employee){ if(in_array($employee['dept_id'],array(22))){ ?>
                                    <option value="<?=$employee['id']?>" <?=$employee['id']==$qaar['signature']?'selected':''?>><?=$employee['employee_name'].' ('.$employee['dept_name'].'-'.$employee['pos_name'].')'?></option>
                                <?php }}?>
                        </select>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-12">
                        <center><button type="submit" title="Save QA Approval and Release" id="stage_one_qa_approval_and_release_form_save" class="btn btn-success">SAVE</button></center>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
    
      <!--Footer Note-->     
    <div class="row">
        <div class="col-sm-12">   
        
         <?php foreach($stage_one_footer_note->result_array() as $fn); ?>
         
            <div class="form-container">
                <form id="stage_one_footer_note" enctype="multipart/form-data">    
            <input type="hidden" class="dhr_id" name="dhr_id" value="<?=$order_information['id']?>">
                 <div class="row">
                    <div  class="col-sm-12">
                        <center><h4>Footer Note</h4></center>
                    </div>
                </div>
               
                <div class="row">
                    <div class="col-sm-4">
                        <label>Format No.</label>
                        <input type="text" name="format_no" id="format_no" value="<?=$fn['format_no']==''?'SECPL_FM_017':$fn['format_no']?>" class="form-control"  readonly>
                    </div>
                    <div class="col-sm-4">
                        <label>Rev. No.</label>
                        <input type="text" name="rev_no" value="<?=$fn['rev_no']==''?'01':$fn['rev_no']?>" class="form-control" readonly>
                    </div>
                    <div class="col-sm-4">
                        <label>Effective Date</label>
                        <input type="date" name="effective_date" value="<?=$fn['effective_date']==''?'2024-01-23':$fn['effective_date']?>" class="form-control" readonly>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-12">
                        <center><button type="submit" title="Save Footer Note" id="stage_one_qa_footer_note" class="btn btn-success">SAVE</button></center>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
    
   
        <div id="printstageone" style="position:fixed;bottom:40px;width:300px;z-index:12050;">
            <center>
                <table>
                    <tr>
                        <td>
                            <button type="button" type="button" onclick="saveallforms()"  style="width:150px;z-index:12050;" class="btn btn-success">SAVE ALL FORMS</button>
                        </td>
                        <td>
                            <button type="button"  id="stageonedhrprint" target="blank" style="width:150px;z-index:12050;"  class="btn btn-primary">STAGE-1 PDF</button>
                        </td>
                    </tr>
                </table>
            </center>
        </div>
   
<script>
 var employeeslist= '<?=$employeeslist?>';
 var departmentemployees = <?=json_encode($departmentemployees)?>;
 
////stage_one_order_form
    $('#stage_one_order_form').submit(function(e){
        e.preventDefault();
        if(confirm('are you want to save this record?')){
            $.ajax({
                type:'post',
                url:'<?=base_url("AdminController/stage_one_order_form")?>',
                dataType:'json',
                data:new FormData(this),
                processData:false,
                contentType:false,
                success:function(responsedata){
                    $('#dhr').val(responsedata['dhr']);
                    $('.dhr_id').val(responsedata['dhr_id']);
                    //alert('Saved Successfully.');
                    ordertable.ajax.reload();
                    //$('.close').click();
                }
            });
        }
    });
    
    $('#dhr').change(function(){
         $.ajax({
                type:'post',
                url:'<?=base_url("AdminController/order_form_dhr_check")?>',
                dataType:'json',
                data:{dhr:$('#dhr').val()},
                success:function(responsedata){
                    if(responsedata){
                        $('#dhr').val('');
                        $('#dhr').focus();
                        alert('This DHR number already given. Please enter the incremented last recent DHR');
                    }
                }
            });
    });
    
    var i= '<?=$i?>';
    
    $('#itemcode').change(function(){
        $.ajax({
                type:'post',
                url:'<?=base_url("AdminController/get_item_description")?>',
                data:{item_code:$('#itemcode').val()},
                dataType:'json',
                success:function(responsedata){
                   $('#product_description').val(responsedata['item_details']['description']);
                   
                   
                  responsedata['bom_details'].forEach(item=>{
                      var row='<tr>'+
                        '<th><input style="padding-left:0px;padding-right:0px;" type="text" name="item_number[]" value="'+item['raw_material_or_ingredient']+'" id="item_number'+i+'" class="form-control" ></th>'+
                        '<th><input style="padding-left:0px;padding-right:0px;" type="text" name="item_description[]" value="'+item['bom_description']+'" id="item_description'+i+'" class="form-control"></th>'+
                        '<th><input style="padding-left:0px;padding-right:0px;" type="text" name="uom[]" value="'+item['uom']+'" id="uom'+i+'" class="form-control"></th>'+
                        '<th><input style="padding-left:0px;padding-right:0px;" type="number" step="0.001" name="quantity_required[]" value="0" id="quantity_required'+i+'" class="form-control"></th>'+
                        '<th><input style="padding-left:0px;padding-right:0px;" type="number" step="0.001" name="quantity_issued[]" value="0" onchange="calculate_orderdered_quantity()"  id="quantity_issued'+i+'" class="form-control"></th>'+
                        '<th><input style="padding-left:0px;padding-right:0px;" type="text" name="qir_number[]" value="" id="qir_number'+i+'" class="form-control"></th>'+
                        '<th><input style="padding-left:0px;padding-right:0px;" type="text" name="item_lot_number[]" value="" id="item_lot_number'+i+'" class="form-control"></th>'+
                        '<th><select style="padding-left:0px;padding-right:0px;" name="issued_by[]"  id="issued_by'+i+'" class="form-control"><option value="">select issued_by</option>'+departmentemployees[16]+'</select></th>'+
                        '<th><select style="padding-left:0px;padding-right:0px;" name="received_by[]"  id="received_by'+i+'" class="form-control"><option value="">select received_by</option>'+departmentemployees[15]+'</select></th>'+
                        '<th><input style="padding-left:0px;padding-right:0px;" type="date" name="date[]" value="" id="date'+i+'" class="form-control"></th>'+
                        '<th><input style="padding-left:0px;padding-right:0px;" type="text" name="remarks[]" value="" id="remarks'+i+'" class="form-control"></th>'+
                        '<th><button type="button" onclick="delete_dhr_bill_item_row(this)" title="Delete BOM" class="btn btn-danger btn-flat"><i class="fa fa-minus"></i></button></th>'+
                    '</tr>';
                    $('#billofmaterial').append(row);
                    i++;
                  });
                }
            });
    });
    
    //$(document).ready(function(){
       
        function calculate_orderdered_quantity(){
            
            $.ajax({
                type:'post',
                url:'<?=base_url("AdminController/get_bom_item_code_description")?>',
                data:{
                    item_code           :$('#itemcode').val(),
                },
                dataType:'json',
                success:function(responsedata){
                    let order_quantity = 0;
                    let each_quantity_issued = [];
                    let each_uom = [];
                    
                    let each_mrec_quantity_returned = [];
                    let each_mrec_uom = [];
                    
                    $('input[name="quantity_issued[]"]').each(function(){
                        each_quantity_issued.push($(this).val());
                    });
                    $('input[name="uom[]"]').each(function(){
                        each_uom.push($(this).val());
                    });
                    
                    let i=0;
                    
                    $('input[name="item_number[]"]').each(function(){
                        let bom_item_code = $(this).val(); 
                        let quantity_issued       = parseFloat(each_quantity_issued[i]);
                            quantity_issued       = isNaN(quantity_issued)?0:quantity_issued; //required bom quantity
                            quantity_issued       = quantity_issued*((each_uom[i]=='KGS')?1000:1); //required bom in unit quantity
                        let convertto_unit_qty  =0;
                        let quantity            =1;
                        let base_qty            =0;
                            if(bom_item_code!='' && responsedata['bom_details'] && responsedata['bom_details'][bom_item_code] && responsedata['bom_details'][bom_item_code]['uom']){
                                convertto_unit_qty      = responsedata['bom_details'][bom_item_code]['uom']=='KGS'?1000:1;
                            }
                            if(bom_item_code!='' && responsedata['bom_details'] && responsedata['bom_details'][bom_item_code] && responsedata['bom_details'][bom_item_code]['quantity']){
                                quantity                = responsedata['bom_details'][bom_item_code]['quantity']*convertto_unit_qty; // for this quantity material
                            }
                            if(bom_item_code!='' && responsedata['bom_details'] && responsedata['bom_details'][bom_item_code] && responsedata['bom_details'][bom_item_code]['base_qty']){
                                base_qty                = responsedata['bom_details'][bom_item_code]['base_qty']; // this much of unit peices are produced.
                            }
                        order_quantity      += (((quantity_issued/quantity)*base_qty));
                        i++;
                    }); 
                    
                    i=0;
                    
                    $('input[name="mrec_quantity_received[]"]').each(function(){
                        each_mrec_quantity_returned.push($(this).val());
                    });
                    $('input[name="mrec_uom[]"]').each(function(){
                        each_mrec_uom.push($(this).val());
                    });
                    
                    let returned_convertto_unit_qty      =0;
                    let returned_quantity                =1;
                    let returned_base_qty                =0;
                    
                     $('input[name="mrec_item_number[]"]').each(function(){
                        let bom_item_code = $(this).val(); 
                        let quantity_returned_asitis       = parseFloat(each_mrec_quantity_returned[i]);
                            quantity_returned_asitis       = isNaN(quantity_returned_asitis)?0:quantity_returned_asitis; //required bom quantity
                        let quantity_returned       = parseFloat(each_mrec_quantity_returned[i]);
                            quantity_returned       = isNaN(quantity_returned)?0:quantity_returned; //required bom quantity
                            quantity_returned       = quantity_returned*((each_mrec_uom[i]=='KGS')?1000:1); //required bom in unit quantity
                        if(bom_item_code != '' && responsedata['bom_details'] && responsedata['bom_details'][bom_item_code] && responsedata['bom_details'][bom_item_code]['uom'] !== undefined){    
                            returned_convertto_unit_qty      = responsedata['bom_details'][bom_item_code]['uom']=='KGS'?1000:1;
                        }
                        if(bom_item_code != '' && responsedata['bom_details'] && responsedata['bom_details'][bom_item_code] && responsedata['bom_details'][bom_item_code]['quantity'] !== undefined){  
                            returned_quantity                = responsedata['bom_details'][bom_item_code]['quantity']*returned_convertto_unit_qty; // for this quantity material
                        }
                        if(bom_item_code != '' && responsedata['bom_details'] && responsedata['bom_details'][bom_item_code] && responsedata['bom_details'][bom_item_code]['base_qty'] !== undefined){  
                            returned_base_qty                = responsedata['bom_details'][bom_item_code]['base_qty']; // this much of unit peices are produced.
                        }
                        
                        $('input[name="item_number[]"]').each(function(){
                            let itemcode = $(this).val(); 
                            if(itemcode === bom_item_code){
                                let inputQty    = $(this).closest('tr').find('input[name="quantity_issued[]"]');
                                 //alert(inputQty.val()); //newQty>=0?newQty:0;
                                let currentQty  = parseFloat(inputQty.val()) || 0;
                                let newQty      = currentQty-quantity_returned_asitis;
                                
                                inputQty.val(newQty>=0?newQty:0); 
                               return false;
                            }
                             
                        });
                        
                        order_quantity      -= (((quantity_returned/returned_quantity)*returned_base_qty));
                        i++;
                    }); 
                 
                    $('#order_quantity').val(Math.round(order_quantity));
                }
            });
           
        }
        
    //});
//    
    
////stage_one_bill_of_material_form   
   
    
    function add_dhr_bill_item_row(){
        
        var row='<tr>'+
                        '<th><input style="padding-left:0px;padding-right:0px;" type="text" name="item_number[]" value="" id="item_number'+i+'" class="form-control" ></th>'+
                        '<th><input style="padding-left:0px;padding-right:0px;" type="text" name="item_description[]" value="" id="item_description'+i+'" class="form-control"></th>'+
                        '<th><input style="padding-left:0px;padding-right:0px;" type="text" name="uom[]" value="" id="uom'+i+'" class="form-control"></th>'+
                        '<th><input style="padding-left:0px;padding-right:0px;" type="number" step="0.001" name="quantity_required[]" value=""  id="quantity_required'+i+'" class="form-control"></th>'+
                        '<th><input style="padding-left:0px;padding-right:0px;" type="number" name="quantity_issued[]" value="0" onchange="calculate_orderdered_quantity()" id="quantity_issued'+i+'" class="form-control"></th>'+
                        '<th><input style="padding-left:0px;padding-right:0px;" type="text" name="qir_number[]" value="" id="qir_number'+i+'" class="form-control"></th>'+
                        '<th><input style="padding-left:0px;padding-right:0px;" type="text" name="item_lot_number[]" value="" id="item_lot_number'+i+'" class="form-control"></th>'+
                        '<th><select style="padding-left:0px;padding-right:0px;"  name="issued_by[]" value="" id="issued_by'+i+'" class="form-control"><option value="">select issued_by</option>'+departmentemployees[16]+'</select></th>'+
                        '<th><select style="padding-left:0px;padding-right:0px;"  name="received_by[]" value="" id="received_by'+i+'" class="form-control"><option value="">select received_by</option>'+departmentemployees[15]+'</select></th>'+
                        '<th><input style="padding-left:0px;padding-right:0px;" type="date" name="date[]" value="" id="date'+i+'" class="form-control"></th>'+
                        '<th><input style="padding-left:0px;padding-right:0px;" type="text" name="remarks[]" value="" id="remarks'+i+'" class="form-control"></th>'+
                        '<th><button type="button" onclick="delete_dhr_bill_item_row(this)" title="Delete BOM" class="btn btn-danger btn-flat"><i class="fa fa-minus"></i></button></th>'+
                    '</tr>';
        $('#billofmaterial').append(row);
        i++;
    }
    
    function delete_dhr_bill_item_row(tr){
        $(tr).closest('tr').remove();
    }
    
    $('#stage_one_bill_of_material_form').submit(function(e){
        e.preventDefault();
        if(1){ //confirm('Are you want to save this bill of material?')
            $.ajax({
                type:'post',
                url:'<?=base_url("AdminController/stage_one_bill_of_material_form")?>',
                data:new FormData(this),
                processData:false,
                contentType:false,
                success:function(){
                    //alert('Saved Successfully.');
                    ordertable.ajax.reload();
                    //$('.close').click();
                }
            });
        }
    });
    
//    

////stage_one_pre_manufacturing_process_form     
    $('#stage_one_pre_manufacturing_process_form').submit(function(e){
        e.preventDefault();
        if(1){ //confirm('Are you want to save this pre manufacturing process?')
            $.ajax({
                type:'post',
                url:'<?=base_url("AdminController/stage_one_pre_manufacturing_process_form")?>',
                data:new FormData(this),
                processData:false,
                contentType:false,
                success:function(){
                    //alert('Saved Successfully.');
                    //$('.close').click();
                }
            });
        }
    });
    
    function add_premprocess_row(){
        var row = '<tr>'+
                    '<th><input style="padding-left:0px;padding-right:0px;" type="text" name="prmp_item_number[]" value="" class="form-control"></th>'+
                    '<th><input style="padding-left:0px;padding-right:0px;" type="text" name="prmp_item_description[]" value="" class="form-control"></th>'+
                    '<th><input style="padding-left:0px;padding-right:0px;" type="text" name="prmp_uom[]" value="" class="form-control"></th>'+
                    '<th><input style="padding-left:0px;padding-right:0px;" type="text" name="prmp_qunatity[]" value="" class="form-control"></th>'+
                    '<th><input style="padding-left:0px;padding-right:0px;" type="text" name="prmp_wi_number[]" value="" class="form-control"></th>'+
                    '<th><input style="padding-left:0px;padding-right:0px;" type="text" name="prmp_equipment_number[]" value="" class="form-control"></th>'+
                    '<th><input type="text" style="padding-left:0px;padding-right:0px;"  name="prmp_done_by[]" class="form-control"><option value=""></th>'+
                    '<th><select style="padding-left:0px;padding-right:0px;"  name="prmp_verified_by[]" class="form-control"><option value="">select verified_by</option>'+departmentemployees[15]+'</select></th>'+
                    '<th><input style="padding-left:0px;padding-right:0px;" type="date" name="prmp_date[]" value="" class="form-control"></th>'+
                    '<th><button type="button" onclick="delete_premprocess_row(this)" title="Remove pre manufacturing process Item" class="btn btn-danger btn-flat"><i class="fa fa-minus"></i></button></th>'+
                '</tr>';
        $('#premanufacturingprocesstable').append(row);
    }
    
    function delete_premprocess_row(tr){
        $(tr).closest('tr').remove();
    }
//

////stage_one_manufacturing_process_form     
    $('#stage_one_manufacturing_process_form').submit(function(e){
        e.preventDefault();
        if(1){ //confirm('Are you want to save this manufacturing process?')
            $.ajax({
                type:'post',
                url:'<?=base_url("AdminController/stage_one_manufacturing_process_form")?>',
                data:new FormData(this),
                processData:false,
                contentType:false,
                success:function(){
                    //alert('Saved Successfully.');
                }
            });
        }
    });
    
    var mp_i='<?=$mp_i?>';
    function add_mprocess_row(){
        // let mp_seq_number = $('#itemcode').val();
        // let mp_process_description = $('#product_description').val();
       var row = '<tr>'+
                    '<th><input style="padding-left:0px;padding-right:0px;" type="number" name="mp_seq_number[]" id="mp_seq_number'+mp_i+'" onchange="get_mp_process_description('+mp_i+')" value="" class="form-control mp_seq_number"></th>'+
                    '<th><input style="padding-left:0px;padding-right:0px;" type="text" name="mp_process_description[]" id="mp_process_description'+mp_i+'" value="" class="form-control"></th>'+
                    '<th><input style="padding-left:0px;padding-right:0px;" type="text" name="mp_wi_number[]" id="mp_wi_number'+mp_i+'" value="" class="form-control"></th>'+
                    '<th><select style="padding-left:0px;padding-right:0px;"  name="mp_equipment_number[]" id="mp_equipment_number'+mp_i+'"  class="form-control"><option value="">Select Equipment</option></select></th>'+
                    '<th><select style="padding-left:0px;padding-right:0px;" name="mp_line_clearance_by[]"  id="mp_line_clearance_by'+mp_i+'" class="form-control"><option value="">select verified_by</option>'+departmentemployees[14]+'</select></th>'+
                    '<th><input style="padding-left:0px;padding-right:0px;" type="datetime-local" name="mp_start_datetime[]"  id="mp_start_datetime'+mp_i+'" value="" class="form-control"></th>'+
                    '<th><input style="padding-left:0px;padding-right:0px;" type="datetime-local" name="mp_end_datetime[]" id="mp_end_datetime'+mp_i+'" value="" class="form-control" ></th>'+
                    '<th><input style="padding-left:0px;padding-right:0px;" type="text" name="mp_manufactured_qunatity[]" id="mp_manufactured_qunatity'+mp_i+'" value="0" class="form-control mp_manufactured_qunatity" readonly></th>'+
                    '<th><input style="padding-left:0px;padding-right:0px;" type="text" name="mp_good_qunatity[]" id="mp_good_qunatity'+mp_i+'" value="0" onblur="sum_mp_good_quantity('+mp_i+')" class="form-control mp_good_qunatity"></th>'+
                    '<th><input style="padding-left:0px;padding-right:0px;" type="text" name="mp_rejected_qunatity[]" id="mp_rejected_qunatity'+mp_i+'" value="0" onblur="sum_mp_good_quantity('+mp_i+')" class="form-control mp_rejected_qunatity"></th>'+
                    '<th><input type="text" style="padding-left:0px;padding-right:0px;"  name="mp_done_by[]"  id="mp_done_by'+mp_i+'"  class="form-control"></th>'+
                    '<th><select style="padding-left:0px;padding-right:0px;"  name="mp_verified_by[]"  id="mp_verified_by'+mp_i+'"  class="form-control"><option value="">select verified_by</option>'+departmentemployees[15]+'</select></th>'+
                    '<th><button type="button" onclick="delete_mprocess_row(this)" title="Delete Manufacturing Process Item" class="btn btn-danger btn-flat"><i class="fa fa-minus"></i></button></th>'+
                '</tr>';
        $('#manufacturingprocess').append(row);
        mp_i++;
    }
    function delete_mprocess_row(tr){
        $(tr).closest('tr').remove();
    }
    
    function get_mp_process_description(mp_i){
        $.ajax({
                type:'post',
                url:'<?=base_url("AdminController/get_mp_process_description")?>',
                data:{
                    mp_seq_number   : $('#mp_seq_number'+mp_i).val(),
                    stage           : $('#stage').val(),
                },
                dataType:'json',
                success:function(data){
                    $('#mp_process_description'+mp_i).val(data['process_description']);
                    $('#mp_wi_number'+mp_i).val(data['wi_number']);
                    
                     var quipment = '<option value="">Select Equipment</option>'; 
                    for(var i=0;i<data['mp_equipment_number'].length;i++){
                        quipment += '<option>'+data['mp_equipment_number'][i]+'</option>';
                    }
                     $('#mp_equipment_number'+mp_i).html(quipment);
                }
            });
    }
    
    function sum_mp_good_quantity(mp_i){
        let mp_rejected_qunatity    = parseFloat($('#mp_rejected_qunatity'+mp_i).val());
        let mp_good_qunatity         = parseFloat($('#mp_good_qunatity'+mp_i).val());
        let ordered_qunatity         = parseFloat($('#order_quantity').val());
        
        mp_rejected_qunatity = isNaN(mp_rejected_qunatity)?0:mp_rejected_qunatity;
        mp_good_qunatity         = isNaN(mp_good_qunatity)?0:mp_good_qunatity;
        ordered_qunatity         = isNaN(ordered_qunatity)?0:ordered_qunatity;
        
        $('#mp_manufactured_qunatity'+mp_i).val(mp_good_qunatity+mp_rejected_qunatity);
        
        let mp_seq_numbers_value=[];
         let mppi=0;
        $('.mp_seq_number').each(
            function(){
                const value=parseFloat($(this).val());
                if(!isNaN(value)){
                    mp_seq_numbers_value[mppi]=value;
                }
            mppi++;    
        });
        
        let mp_good_produt_sum =0;
        mppi=0;
        $('.mp_good_qunatity').each(
            function(){
                const value=parseFloat($(this).val());
                if(!isNaN(value)){
                    if(mp_seq_numbers_value[mppi]!=2){
                        mp_good_produt_sum+=value;
                    }
                }
            mppi++;
        });
        
        let mp_manufactured_qunatity =0;
        mppi=0;
        $('.mp_manufactured_qunatity').each(
            function(){
                const value=parseFloat($(this).val());
                if(!isNaN(value)){
                    if(mp_seq_numbers_value[mppi]!=2){
                        mp_manufactured_qunatity+=value;
                    }
                }
            mppi++;
        });
       
        $('#production_quantity').val(mp_good_produt_sum);
        $('#transferred_quantity').val(mp_good_produt_sum);
        $('#total_quantity_produced_and_packed').val(mp_good_produt_sum);
        
        let mp_rejected_produt_sum =0;
         mppi=0;
        $('.mp_rejected_qunatity').each(
            function(){
                const value=parseFloat($(this).val());
                if(!isNaN(value)){
                     if(mp_seq_numbers_value[mppi]!=2){
                        mp_rejected_produt_sum+=value;
                     }
                }
                 mppi++;
            });
            
        $('#rejected_quantity').val(mp_rejected_produt_sum);
        let percentage = (mp_good_produt_sum/mp_manufactured_qunatity)*100;
        let rejectpercentage = (mp_rejected_produt_sum/mp_manufactured_qunatity)*100;
        $('#yield_percentage').val(Math.round(percentage*100)/100);
        $('#reject_percentage').val(Math.round(rejectpercentage*100)/100);
        $('#quantity_released_for_dispatch').val(mp_good_produt_sum);
        archive_quantity_reduce();
    }
//    

////stage_one_post_manufacturing_process_form     
    $('#stage_one_post_manufacturing_process_form').submit(function(e){
        e.preventDefault();
        if(1){ //confirm('Are you want to save this post manufacturing process?')
            $.ajax({
                type:'post',
                url:'<?=base_url("AdminController/stage_one_post_manufacturing_process_form")?>',
                data:new FormData(this),
                processData:false,
                contentType:false,
                success:function(){
                    //alert('Saved Successfully.');
                  //  $('.close').click();
                }
            });
        }
    });
    
     var postmp_i='<?=$postmp_i?>';
    function add_pmprocess_row(){
        var row = ' <tr>'+
                        '<th><input style="padding-left:0px;padding-right:0px;" type="text" name="pmp_seq_number[]"  id="pmp_seq_number'+postmp_i+'" value="" class="form-control"></th>'+
                        '<th><input style="padding-left:0px;padding-right:0px;" type="text" name="pmp_process_description[]" id="pmp_process_description'+postmp_i+'" value="" class="form-control"></th>'+
                        '<th><input style="padding-left:0px;padding-right:0px;" type="text" name="pmp_wi_number[]" id="pmp_wi_number'+postmp_i+'" value="" class="form-control"></th>'+
                        '<th><input style="padding-left:0px;padding-right:0px;" type="text" name="pmp_dcc_number[]" id="pmp_dcc_number'+postmp_i+'" value="" class="form-control"></th>'+
                        '<th><input style="padding-left:0px;padding-right:0px;" type="date" name="pmp_sent_date[]" id="pmp_sent_date'+postmp_i+'" value="" class="form-control"></th>'+
                        '<th><input style="padding-left:0px;padding-right:0px;" type="text" name="pmp_cycle_number_or_report_number[]" id="pmp_cycle_number_or_report_number'+postmp_i+'" value="" class="form-control"></th>'+
                        '<th><input style="padding-left:0px;padding-right:0px;" type="date" name="pmp_process_date[]" id="pmp_process_date'+postmp_i+'"  value="" class="form-control"></th>'+
                        '<th><input type="text" style="padding-left:0px;padding-right:0px;"  name="pmp_done_by[]" id="pmp_done_by'+postmp_i+'" value="" class="form-control"></th>'+
                        '<th><select style="padding-left:0px;padding-right:0px;"  name="pmp_checked_by[]"  class="form-control"><option id="pmp_checked_by'+postmp_i+'"  value="">select checked_by</option>'+departmentemployees[14]+'</select></th>'+
                        '<th><button type="button" onclick="delete_pmprocess_row(this)" title="Remove post manufacturing process Item" class="btn btn-danger btn-flat"><i class="fa fa-minus"></i></button></th>'+
                    '</tr>';
        $('#postmanufacturingprocess').append(row);
    }
    
    function delete_pmprocess_row(tr){
        $(tr).closest('tr').remove();
    }
//  

////stage_one_quality_control_process_form     
    $('#stage_one_quality_control_process_form').submit(function(e){
        e.preventDefault();
        if(1){ //confirm('Are you want to save this quality control process?')
            $.ajax({
                type:'post',
                url:'<?=base_url("AdminController/stage_one_quality_control_process_form")?>',
                data:new FormData(this),
                processData:false,
                contentType:false,
                success:function(){
                    //alert('Saved Successfully.');
                   // $('.close').click();
                }
            });
        }
    });
    
    var qcp_i='<?=$qcp_i?>';
    function add_qcprocess_row(){
        var row = '<tr>'+
                    '<th><input type="number" name="qcp_seq_number[]" id="qcp_seq_number'+qcp_i+'"  onchange="get_qc_process_description('+qcp_i+')" value="" class="form-control"></th>'+
                    '<th><input type="text" name="qcp_process_inspection_or_testing_description[]" id="qcp_process_inspection_or_testing_description'+qcp_i+'" value="" class="form-control"></th>'+
                    '<th><input type="text" name="qcp_wi_number[]" id="qcp_wi_number'+qcp_i+'" value="" class="form-control"></th>'+
                    '<th><input type="text" name="qcp_qir_number_or_report_number[]" id="qcp_qir_number_or_report_number'+qcp_i+'" value="" class="form-control"></th>'+
                    '<th><input type="text" name="qcp_sample_quantity[]" id="qcp_sample_quantity'+qcp_i+'" value="" class="form-control"></th>'+
                    '<th><select name="qcp_pass_or_fail[]" id="qcp_pass_or_fail'+qcp_i+'"  class="form-control"><option value="">Select the option</option><option>Pass</option><option>Fail</option></select></th>'+
                    '<th><select name="qcp_verified_by[]" id="qcp_verified_by'+qcp_i+'"  class="form-control"><option value="">Select verified by</option>'+departmentemployees[14]+'</th>'+
                    '<th><input type="date" name="qcp_verified_date[]" id="qcp_verified_date'+qcp_i+'" value="" class="form-control"></th>'+
                     '<th><select name="qcp_scanned_file[]" id="qcp_scanned_file'+qcp_i+'" class="form-control" style="width:50px;padding:0px;"><option value="0">&#10060;</option><option value="1">&#x2714;</option></select></th>'+
                    '<th><button type="button" onclick="delete_qcprocess_row(this)" title="Remove Quality Control process Item" class="btn btn-danger btn-flat"><i class="fa fa-minus"></i></button></th>'+
                '</tr>';
         $('#qualitycontrolprocess').append(row);    
         qcp_i++;
    }
    
    function delete_qcprocess_row(tr){
        $(tr).closest('tr').remove();
    }
    
    function deleteqcscannedfile(dhr_id,file_path){
        $.ajax({
                type:'post',
                url:'<?=base_url("AdminController/delete_qc_scanned_file")?>',
                data:{
                    dhr_id      : dhr_id,
                    file_path   : file_path,
                },
                dataType:'json',
                success:function(data){
                    $('#scanfiledata').remove();
                    let a = file_path.split('/');
                    alert(a[(a.length)-1] + ' has been successfully deleted.');
                }
            });
    }
    
    function get_qc_process_description(qcp_i){
        $.ajax({
                type:'post',
                url:'<?=base_url("AdminController/get_qc_process_description")?>',
                data:{
                    qc_seq_number   : $('#qcp_seq_number'+qcp_i).val(),
                    stage           : $('#stage').val(),
                },
                dataType:'json',
                success:function(data){
                    $('#qcp_process_inspection_or_testing_description'+qcp_i).val(data['process_description']);
                    $('#qcp_wi_number'+qcp_i).val(data['wi_number']);
                }
            });
    }
// 

////stage_one_finished_goods_transferred_note_form     
    $('#stage_one_finished_goods_transferred_note_form').submit(function(e){
        e.preventDefault();
        if(1){ //confirm('Are you want to save this finished goods transferred note?')
            $.ajax({
                type:'post',
                url:'<?=base_url("AdminController/stage_one_finished_goods_transferred_note_form")?>',
                data:new FormData(this),
                processData:false,
                contentType:false,
                success:function(){
                    //alert('Saved Successfully.');
                   // $('.close').click();
                }
            });
        }
    });
//  
    
////stage_one_material_reconciliation_form     
    $('#stage_one_material_reconciliation_form').submit(function(e){
        e.preventDefault();
        if(1){ //confirm('Are you want to save this material reconciliation details?')
            $.ajax({
                type:'post',
                url:'<?=base_url("AdminController/stage_one_material_reconciliation_form")?>',
                data:new FormData(this),
                processData:false,
                contentType:false,
                success:function(){
                    //alert('Saved Successfully.');
                    //$('.close').click();
                }
            });
        }
    });
    
    var mrec_i = '<?=$mrec_i?>';
     function add_mrec_row(){
        var row = '<tr>'+
                    '<th><input type="number" name="mrec_item_number[]" id="mrec_item_number'+mrec_i+'" value="" class="form-control"></th>'+
                    '<th><input type="text" name="mrec_description[]" id="mrec_description'+mrec_i+'" value="" class="form-control"></th>'+
                    '<th><input type="text" name="mrec_uom[]" id="mrec_uom'+mrec_i+'" value="" class="form-control"></th>'+
                    '<th><input type="number" step="0.001" name="mrec_quantity_received[]" id="mrec_quantity_received'+mrec_i+'" onchange="calculate_orderdered_quantity()" class="form-control"></th>'+
                    '<th><input type="text" name="mrec_qir_number[]" id="mrec_qir_number'+mrec_i+'" value="" class="form-control"></th>'+
                    '<th><input type="text" name="mrec_item_lot_number_or_input_lot[]" id="mrec_item_lot_number_or_input_lot'+mrec_i+'" value="" class="form-control"></th>'+
                    '<th><select name="mrec_returned_by[]" id="mrec_returned_by'+mrec_i+'" value="" class="form-control"><option value="">select returned_by</option>'+departmentemployees[15]+'</select></th>'+
                    '<th><select name="mrec_received_by[]" id="mrec_received_by'+mrec_i+'" value="" class="form-control"><option value="">select received_by</option>'+departmentemployees[16]+'</select></th>'+
                    '<th><input type="date" name="mrec_date[]" id="mrec_date'+mrec_i+'" value="" class="form-control"></th>'+
                    '<th><input type="text" name="mrec_remark[]" id="mrec_remark'+mrec_i+'" value="" class="form-control"></th>'+
                    '<th><button type="button" onclick="delete_mrec_row(this)" title="Remove material reconcillation Item" class="btn btn-danger btn-flat"><i class="fa fa-minus"></i></button></th>'+
                '</tr>';
         $('#materialreconciliation').append(row);   
         mrec_i++;
    }
    
    function delete_mrec_row(tr){
        $(tr).closest('tr').remove();
    }
    
    function copy_from_bom_to_mrec_row(){
        $('#billofmaterial tbody tr').each(function(){
            let mrec_item_number = $(this).find('th').eq(0).find('input[type="text"]').val();
            let mrec_description = $(this).find('th').eq(1).find('input[type="text"]').val();
            let mrec_uom = $(this).find('th').eq(2).find('input[type="text"]').val();
            var row = '<tr>'+
                    '<th><input type="text" name="mrec_item_number[]" id="mrec_item_number'+mrec_i+'" value="'+mrec_item_number+'" class="form-control"></th>'+
                    '<th><input type="text" name="mrec_description[]" id="mrec_description'+mrec_i+'" value="'+mrec_description+'" class="form-control"></th>'+
                    '<th><input type="text" name="mrec_uom[]" id="mrec_uom'+mrec_i+'" value="'+mrec_uom+'" class="form-control"></th>'+
                    '<th><input type="number" step="0.001" name="mrec_quantity_received[]" id="mrec_quantity_received'+mrec_i+'" onchange="calculate_orderdered_quantity()" class="form-control"></th>'+
                    '<th><input type="text" name="mrec_qir_number[]" id="mrec_qir_number'+mrec_i+'" value="" class="form-control"></th>'+
                    '<th><input type="text" name="mrec_item_lot_number_or_input_lot[]" id="mrec_item_lot_number_or_input_lot'+mrec_i+'" value="" class="form-control"></th>'+
                    '<th><select name="mrec_returned_by[]" id="mrec_returned_by'+mrec_i+'" value="" class="form-control"><option value="">select returned_by</option>'+employeeslist+'</select></th>'+
                    '<th><select name="mrec_received_by[]" id="mrec_received_by'+mrec_i+'" value="" class="form-control"><option value="">select received_by</option>'+employeeslist+'</select></th>'+
                    '<th><input type="date" name="mrec_date[]" id="mrec_date'+mrec_i+'" value="" class="form-control"></th>'+
                    '<th><input type="text" name="mrec_remark[]" id="mrec_remark'+mrec_i+'" value="" class="form-control"></th>'+
                    '<th><button type="button" onclick="delete_mrec_row(this)" title="Remove material reconcillation Item" class="btn btn-danger btn-flat"><i class="fa fa-minus"></i></button></th>'+
                '</tr>';
         $('#materialreconciliation').append(row);
             mrec_i++;
        });
    }
    
    
// 

 ////stage_one_finished_goods_reconciliation_form     
     $('#stage_one_finished_goods_reconciliation_form').submit(function(e){
        e.preventDefault();
        if(1){ //confirm('Are you want to save this finished goods reconciliation details?')
         $.ajax({
             type:'post',
             url:'<?=base_url("AdminController/stage_one_finished_goods_reconciliation_form")?>',
             data:new FormData(this),
             processData:false,
             contentType:false,
             success:function(){
                 //alert('Saved Successfully.');
                 //$('.close').click();
             }
         });
        }
     });
     
     function archive_quantity_reduce(){
         $pq    = parseFloat($('#production_quantity').val());
         $easq  = parseFloat($('#archive_samples_quantity').val());
         
         $pq    = isNaN($pq)?0:$pq;
         $easq = isNaN($easq)?0:$easq;
         $('#transferred_quantity').val($pq-$easq);
         $('#quantity_released_for_dispatch').val($pq-$easq);
     }
 // 

 ////stage_one_qa_approval_and_release_form     
     $('#stage_one_qa_approval_and_release_form').submit(function(e){
        e.preventDefault();
        if(1){ //confirm('Are you want to save this quality analysis approval and release details?')
         $.ajax({
             type:'post',
             url:'<?=base_url("AdminController/stage_one_qa_approval_and_release_form")?>',
             data:new FormData(this),
             processData:false,
             contentType:false,
             success:function(){
                 //alert('Saved Successfully.');
                  //$('.close').click();
             }
         });
        }
     });
 // 
 
 
 ////stage_one_footer_note     
     $('#stage_one_footer_note').submit(function(e){
        e.preventDefault();
        if(1){ //confirm('Are you want to save footer note details?')
         $.ajax({
             type:'post',
             url:'<?=base_url("AdminController/stage_one_footer_note")?>',
             data:new FormData(this),
             processData:false,
             contentType:false,
             success:function(){
                 alert('Saved Successfully.');
                  //$('.close').click();
             }
         });
        }
     });
 // 
 
//  $('#stage_one_form').submit(function(e){
//       e.preventDefault();
//         if(confirm('Are you want to save all STAGE-1 details?')){
//          $.ajax({
//              type:'post',
//              url:'<?=base_url("AdminController/SaveUpdateStageOne")?>',
//              data:new FormData(this),
//              processData:false,
//              contentType:false,
//              success:function(){
//                  alert('Saved Successfully.');
//                   $('.close').click();
//              }
//          });
//         }
//  });

    async function saveallforms(){
        try{
            await $('#stage_one_order_form').submit();
            
            await $('#stage_one_bill_of_material_form').submit();
            await new Promise(resolve=>setTimeout(resolve,500));
            await $('#stage_one_pre_manufacturing_process_form').submit();
            await $('#stage_one_manufacturing_process_form').submit();
            await $('#stage_one_post_manufacturing_process_form').submit();
            await $('#stage_one_quality_control_process_form').submit();
            await $('#stage_one_finished_goods_transferred_note_form').submit();
            await $('#stage_one_material_reconciliation_form').submit();
            await $('#stage_one_finished_goods_reconciliation_form').submit();
            await $('#stage_one_qa_approval_and_release_form').submit();
            await $('#stage_one_footer_note').submit();
            
        }catch(err){
            console.error("Error:"+err)
        }
    }

    $('#stageonedhrprint').click(function(){
        window.open("<?=base_url('ShahPDF/stage_one_form/')?>"+$('.dhr_id').val(),"BLANK");
    });
    
</script>