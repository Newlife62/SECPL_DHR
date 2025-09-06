
<?php
    $eachprivilage=array();
    $privilage=$eachprivilage=NULL;
    foreach($stagePrivilage->result_array() as $privilage){
        $eachprivilage[$privilage['entry_field']]['read'] = $privilage['read'];
        $eachprivilage[$privilage['entry_field']]['write'] = $privilage['write'];
    }
?>
<div class="row">
    <div class="col-sm-12">
        <form id="privilage_form" method="post" enctype="multipart/form-control">
            <input type="hidden" value="<?=$this->input->post('user_id')?>" name="user_id">
            <input type="hidden" value="<?=$this->input->post('stage')?>" name="stage">
            <div class="container">
                <h4 class="page-header"><?=$this->input->post('stage')?> Form Field Privilege Settings</h4>
            
               
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr class="bg-primary">
                                    <th class="text-center" colspan="3">Order Information</th>
                                </tr>
                                <tr class="bg-primary">
                                    <th>Field Name</th>
                                    <th class="text-center"><input type="checkbox" id="read_all_check" title="Click here to check all READ check box."> <label for="read_all_check">Read</lanel></th>
                                    <th class="text-center"><input type="checkbox" id="write_all_check" title="Click here to check all WRITE check box."> <label for="write_all_check">Write</lanel></th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <tr>
                                    <td><strong>dhr_id</strong>
                                         <input type="hidden" name="field_names[]" value="dhr_id">
                                    </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[dhr_id]" value="1"    <?=($eachprivilage['dhr_id']['read'] ?? 0)==1?'checked':''?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[dhr_id]" value="1"   <?=($eachprivilage['dhr_id']['write'] ?? 0)==1?'checked':''?>></td>
                                </tr>
                                <tr>
                                    <td><strong>Sales Order #</strong>
                                        <input type="hidden" name="field_names[]" value="sales_order">
                                     </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[sales_order]" value="1" <?=($eachprivilage['sales_order']['read'] ?? 0)==1?'checked':''?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[sales_order]" value="1" <?=($eachprivilage['sales_order']['write'] ?? 0)==1?'checked':''?>></td>
                                </tr>
                                <tr>
                                    <td><strong>Production Order #<</strong> <input type="hidden" name="field_names[]" value="production_order">
                                     </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[production_order]" value="1" <?=($eachprivilage['production_order']['read'] ?? 0)==1?'checked':''?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[production_order]" value="1" <?=($eachprivilage['production_order']['write'] ?? 0)==1?'checked':''?>></td>
                                </tr>
                                <tr>
                                    <td><strong>Product Description</strong> <input type="hidden" name="field_names[]" value="product_description">
                                     </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[product_description]" value="1" <?=($eachprivilage['product_description']['read'] ?? 0)==1?'checked':''?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[product_description]" value="1" <?=($eachprivilage['product_description']['write'] ?? 0)==1?'checked':''?>></td>
                                </tr>
                                <tr>
                                    <td><strong>DHR #</strong> <input type="hidden" name="field_names[]" value="dhr">
                                     </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[dhr]" value="1" <?=($eachprivilage['dhr']['read'] ?? 0)==1?'checked':''?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[dhr]" value="1" <?=($eachprivilage['dhr']['write'] ?? 0)==1?'checked':''?>></td>
                                </tr>
                                <tr>
                                    <td><strong>Order Quantity</strong> <input type="hidden" name="field_names[]" value="order_quantity">
                                     </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[order_quantity]" value="1" <?=($eachprivilage['order_quantity']['read'] ?? 0)==1?'checked':''?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[order_quantity]" value="1" <?=($eachprivilage['order_quantity']['write'] ?? 0)==1?'checked':''?>></td>
                                </tr>
                                <tr>
                                    <td><strong>Batch/Lot #</strong> <input type="hidden" name="field_names[]" value="batchorlot">
                                     </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[batchorlot]" value="1" <?=($eachprivilage['batchorlot']['read'] ?? 0)==1?'checked':''?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[batchorlot]" value="1" <?=($eachprivilage['batchorlot']['write'] ?? 0)==1?'checked':''?>></td>
                                </tr>
                                <tr>
                                    <td><strong>>Production Quantity</strong> <input type="hidden" name="field_names[]" value="production_quantity">
                                     </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[production_quantity]" value="1" <?=($eachprivilage['production_quantity']['read'] ?? 0)==1?'checked':''?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[production_quantity]" value="1" <?=($eachprivilage['production_quantity']['write'] ?? 0)==1?'checked':''?>></td>
                                </tr>
                                <tr>
                                    <td><strong>REF/Model #</strong> <input type="hidden" name="field_names[]" value="reformodel">
                                     </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[reformodel]" value="1" <?=($eachprivilage['reformodel']['read'] ?? 0)==1?'checked':''?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[reformodel]" value="1" <?=($eachprivilage['reformodel']['write'] ?? 0)==1?'checked':''?>></td>
                                </tr>
                                <tr>
                                    <td><strong>Manufacturing Date</strong> <input type="hidden" name="field_names[]" value="manufacturing_date">
                                     </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[manufacturing_date]" value="1" <?=($eachprivilage['manufacturing_date']['read'] ?? 0)==1?'checked':''?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[manufacturing_date]" value="1" <?=($eachprivilage['manufacturing_date']['write'] ?? 0)==1?'checked':''?>></td>
                                </tr>
                                <tr>
                                    <td><strong>Date Of Commencement</strong> <input type="hidden" name="field_names[]" value="date_of_commencement">
                                     </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[date_of_commencement]" value="1" <?=($eachprivilage['date_of_commencement']['read'] ?? 0)==1?'checked':''?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[date_of_commencement]" value="1" <?=($eachprivilage['date_of_commencement']['write'] ?? 0)==1?'checked':''?>></td>
                                </tr>
                                <tr>
                                    <td><strong>Item Code #</strong> <input type="hidden" name="field_names[]" value="itemcode">
                                     </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[itemcode]" value="1" <?=($eachprivilage['itemcode']['read'] ?? 0)==1?'checked':''?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[itemcode]" value="1" <?=($eachprivilage['itemcode']['write'] ?? 0)==1?'checked':''?>></td>
                                </tr>
                                <tr>
                                    <td><strong>Expiry Date</strong> <input type="hidden" name="field_names[]" value="expiry_date">
                                     </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[expiry_date]" value="1" <?=($eachprivilage['expiry_date']['read'] ?? 0)==1?'checked':''?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[expiry_date]" value="1" <?=($eachprivilage['expiry_date']['write'] ?? 0)==1?'checked':''?>></td>
                                </tr>
                                <tr>
                                    <td><strong>Date Of Completion</strong> <input type="hidden" name="field_names[]" value="date_of_completion">
                                     </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[date_of_completion]" value="1" <?=($eachprivilage['date_of_completion']['read'] ?? 0)==1?'checked':''?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[date_of_completion]" value="1" <?=($eachprivilage['date_of_completion']['write'] ?? 0)==1?'checked':''?>></td>
                                </tr>
                                <tr>
                                    <td><strong>DHR Issued by(QA) #</strong> <input type="hidden" name="field_names[]" value="dhr_issued_by_qa">
                                     </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[dhr_issued_by_qa]" value="1" <?=($eachprivilage['dhr_issued_by_qa']['read'] ?? 0)==1?'checked':''?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[dhr_issued_by_qa]" value="1" <?=($eachprivilage['dhr_issued_by_qa']['write'] ?? 0)==1?'checked':''?>></td>
                                </tr>
                                <tr>
                                    <td><strong>DHR Issued Date(QA) #</strong> <input type="hidden" name="field_names[]" value="dhr_issued_date_qa">
                                     </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[dhr_issued_date_qa]" value="1" <?=($eachprivilage['dhr_issued_date_qa']['read'] ?? 0)==1?'checked':''?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[dhr_issued_date_qa]" value="1" <?=($eachprivilage['dhr_issued_date_qa']['write'] ?? 0)==1?'checked':''?>></td>
                                </tr>
                                <tr>
                                    <td><strong>DHR Received by (Production)</strong> <input type="hidden" name="field_names[]" value="dhr_received_by_production">
                                     </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[dhr_received_by_production]" value="1" <?=($eachprivilage['dhr_received_by_production']['read'] ?? 0)==1?'checked':''?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[dhr_received_by_production]" value="1" <?=($eachprivilage['dhr_received_by_production']['write'] ?? 0)==1?'checked':''?>></td>
                                </tr>
                                <tr>
                                    <td><strong>DHR Received Date (Production)</strong> <input type="hidden" name="field_names[]" value="dhr_received_date_production">
                                     </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[dhr_received_date_production]" value="1" <?=($eachprivilage['dhr_received_date_production']['read'] ?? 0)==1?'checked':''?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[dhr_received_date_production]" value="1" <?=($eachprivilage['dhr_received_date_production']['write'] ?? 0)==1?'checked':''?>></td>
                                </tr>
                            </tbody>
                        </table>
                        
                        
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr class="bg-primary text-center">
                                    <th colspan="3">Bill of Material - Field Privileges</th>
                                </tr>
                                <tr class="bg-primary">
                                    <th>Field Name</th>
                                    <th class="text-center">Read</th>
                                    <th class="text-center">Write</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <tr>
                                    <td><strong>Reference</strong>
                                        <input type="hidden" name="field_names[]" value="reference">
                                    </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[reference]" value="1" <?= ($eachprivilage['reference']['read'] ?? 0)==1 ? 'checked' : '' ?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[reference]" value="1" <?= ($eachprivilage['reference']['write'] ?? 0)==1 ? 'checked' : '' ?>></td>
                                </tr>
                                <tr>
                                    <td><strong>Item #</strong>
                                        <input type="hidden" name="field_names[]" value="item_number">
                                    </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[item_number]" value="1" <?= ($eachprivilage['item_number']['read'] ?? 0)==1 ? 'checked' : '' ?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[item_number]" value="1" <?= ($eachprivilage['item_number']['write'] ?? 0)==1 ? 'checked' : '' ?>></td>
                                </tr>
                                <tr>
                                    <td><strong>Description</strong>
                                        <input type="hidden" name="field_names[]" value="item_description">
                                    </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[item_description]" value="1" <?= ($eachprivilage['item_description']['read'] ?? 0)==1 ? 'checked' : '' ?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[item_description]" value="1" <?= ($eachprivilage['item_description']['write'] ?? 0)==1 ? 'checked' : '' ?>></td>
                                </tr>
                                <tr>
                                    <td><strong>UOM</strong>
                                        <input type="hidden" name="field_names[]" value="uom">
                                    </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[uom]" value="1" <?= ($eachprivilage['uom']['read'] ?? 0)==1 ? 'checked' : '' ?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[uom]" value="1" <?= ($eachprivilage['uom']['write'] ?? 0)==1 ? 'checked' : '' ?>></td>
                                </tr>
                                  <tr>
                                    <td><strong>UOM</strong>
                                        <input type="hidden" name="field_names[]" value="last_quantity_transfered">
                                    </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[last_quantity_transfered]" value="1" <?= ($eachprivilage['last_quantity_transfered']['read'] ?? 0)==1 ? 'checked' : '' ?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[last_quantity_transfered]" value="1" <?= ($eachprivilage['last_quantity_transfered']['write'] ?? 0)==1 ? 'checked' : '' ?>></td>
                                </tr>
                                  <tr>
                                    <td><strong>UOM</strong>
                                        <input type="hidden" name="field_names[]" value="actual_quantity_required">
                                    </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[actual_quantity_required]" value="1" <?= ($eachprivilage['actual_quantity_required']['read'] ?? 0)==1 ? 'checked' : '' ?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[actual_quantity_required]" value="1" <?= ($eachprivilage['actual_quantity_required']['write'] ?? 0)==1 ? 'checked' : '' ?>></td>
                                </tr>
                                  <tr>
                                    <td><strong>UOM</strong>
                                        <input type="hidden" name="field_names[]" value="extra_quantity_required_percentage">
                                    </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[extra_quantity_required_percentage]" value="1" <?= ($eachprivilage['extra_quantity_required_percentage']['read'] ?? 0)==1 ? 'checked' : '' ?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[extra_quantity_required_percentage]" value="1" <?= ($eachprivilage['extra_quantity_required_percentage']['write'] ?? 0)==1 ? 'checked' : '' ?>></td>
                                </tr>
                                <tr>
                                    <td><strong>Quantity Required</strong>
                                        <input type="hidden" name="field_names[]" value="quantity_required">
                                    </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[quantity_required]" value="1" <?= ($eachprivilage['quantity_required']['read'] ?? 0)==1 ? 'checked' : '' ?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[quantity_required]" value="1" <?= ($eachprivilage['quantity_required']['write'] ?? 0)==1 ? 'checked' : '' ?>></td>
                                </tr>
                                <tr>
                                    <td><strong>Quantity Issued</strong>
                                        <input type="hidden" name="field_names[]" value="quantity_issued">
                                    </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[quantity_issued]" value="1" <?= ($eachprivilage['quantity_issued']['read'] ?? 0)==1 ? 'checked' : '' ?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[quantity_issued]" value="1" <?= ($eachprivilage['quantity_issued']['write'] ?? 0)==1 ? 'checked' : '' ?>></td>
                                </tr>
                                <tr>
                                    <td><strong>QIR #</strong>
                                        <input type="hidden" name="field_names[]" value="qir_number">
                                    </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[qir_number]" value="1" <?= ($eachprivilage['qir_number']['read'] ?? 0)==1 ? 'checked' : '' ?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[qir_number]" value="1" <?= ($eachprivilage['qir_number']['write'] ?? 0)==1 ? 'checked' : '' ?>></td>
                                </tr>
                                <tr>
                                    <td><strong>Item Lot # (Input Lot)</strong>
                                        <input type="hidden" name="field_names[]" value="item_lot_number">
                                    </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[item_lot_number]" value="1" <?= ($eachprivilage['item_lot_number']['read'] ?? 0)==1 ? 'checked' : '' ?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[item_lot_number]" value="1" <?= ($eachprivilage['item_lot_number']['write'] ?? 0)==1 ? 'checked' : '' ?>></td>
                                </tr>
                                <tr>
                                    <td><strong>Issued By</strong>
                                        <input type="hidden" name="field_names[]" value="issued_by">
                                    </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[issued_by]" value="1" <?= ($eachprivilage['issued_by']['read'] ?? 0)==1 ? 'checked' : '' ?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[issued_by]" value="1" <?= ($eachprivilage['issued_by']['write'] ?? 0)==1 ? 'checked' : '' ?>></td>
                                </tr>
                                <tr>
                                    <td><strong>>Received By</strong>
                                        <input type="hidden" name="field_names[]" value="received_by">
                                    </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[received_by]" value="1" <?= ($eachprivilage['received_by']['read'] ?? 0)==1 ? 'checked' : '' ?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[received_by]" value="1" <?= ($eachprivilage['received_by']['write'] ?? 0)==1 ? 'checked' : '' ?>></td>
                                </tr>
                                <tr>
                                    <td><strong>Date</strong>
                                        <input type="hidden" name="field_names[]" value="date">
                                    </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[date]" value="1" <?= ($eachprivilage['date']['read'] ?? 0)==1 ? 'checked' : '' ?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[date]" value="1" <?= ($eachprivilage['date']['write'] ?? 0)==1 ? 'checked' : '' ?>></td>
                                </tr>
                                <tr>
                                    <td><strong>Remarks</strong>
                                        <input type="hidden" name="field_names[]" value="bom_remarks">
                                    </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[bom_remarks]" value="1" <?= ($eachprivilage['bom_remarks']['read'] ?? 0)==1 ? 'checked' : '' ?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[bom_remarks]" value="1" <?= ($eachprivilage['bom_remarks']['write'] ?? 0)==1 ? 'checked' : '' ?>></td>
                                </tr>
                                 <tr>
                                    <td><strong>BOM Add Option</strong>
                                        <input type="hidden" name="field_names[]" value="add_dhr_bill_item_row">
                                    </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[add_dhr_bill_item_row]" value="1" <?= ($eachprivilage['add_dhr_bill_item_row']['read'] ?? 0)==1 ? 'checked' : '' ?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[add_dhr_bill_item_row]" value="1" <?= ($eachprivilage['add_dhr_bill_item_row']['write'] ?? 0)==1 ? 'checked' : '' ?>></td>
                                </tr>
                                <tr>
                                    <td><strong>BOM Delete Option</strong>
                                        <input type="hidden" name="field_names[]" value="delete_dhr_bill_item_row">
                                    </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[delete_dhr_bill_item_row]" value="1" <?= ($eachprivilage['delete_dhr_bill_item_row']['read'] ?? 0)==1 ? 'checked' : '' ?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[delete_dhr_bill_item_row]" value="1" <?= ($eachprivilage['delete_dhr_bill_item_row']['write'] ?? 0)==1 ? 'checked' : '' ?>></td>
                                </tr>
                                
                            </tbody>
                        </table>
    
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr class="bg-primary">
                                    <th class="text-center" colspan="3">Pre-Manufacturing Process Fields</th>
                                </tr>
                                <tr class="bg-primary">
                                    <th>Field Name</th>
                                    <th class="text-center">Read</th>
                                    <th class="text-center">Write</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><strong>dhr_id</strong>
                                        <input type="hidden" name="field_names[]" value="dhr_id">
                                    </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[dhr_id]" value="1" <?=($eachprivilage['dhr_id']['read'] ?? 0)==1?'checked':''?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[dhr_id]" value="1" <?=($eachprivilage['dhr_id']['write'] ?? 0)==1?'checked':''?>></td>
                                </tr>
                                <tr>
                                    <td><strong>prmp_item_number</strong>
                                        <input type="hidden" name="field_names[]" value="prmp_item_number">
                                    </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[prmp_item_number]" value="1" <?=($eachprivilage['prmp_item_number']['read'] ?? 0)==1?'checked':''?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[prmp_item_number]" value="1" <?=($eachprivilage['prmp_item_number']['write'] ?? 0)==1?'checked':''?>></td>
                                </tr>
                                <tr>
                                    <td><strong>prmp_item_description</strong>
                                        <input type="hidden" name="field_names[]" value="prmp_item_description">
                                    </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[prmp_item_description]" value="1" <?=($eachprivilage['prmp_item_description']['read'] ?? 0)==1?'checked':''?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[prmp_item_description]" value="1" <?=($eachprivilage['prmp_item_description']['write'] ?? 0)==1?'checked':''?>></td>
                                </tr>
                                <tr>
                                    <td><strong>prmp_uom</strong>
                                        <input type="hidden" name="field_names[]" value="prmp_uom">
                                    </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[prmp_uom]" value="1" <?=($eachprivilage['prmp_uom']['read'] ?? 0)==1?'checked':''?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[prmp_uom]" value="1" <?=($eachprivilage['prmp_uom']['write'] ?? 0)==1?'checked':''?>></td>
                                </tr>
                                <tr>
                                    <td><strong>prmp_qunatity</strong>
                                        <input type="hidden" name="field_names[]" value="prmp_qunatity">
                                    </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[prmp_qunatity]" value="1" <?=($eachprivilage['prmp_qunatity']['read'] ?? 0)==1?'checked':''?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[prmp_qunatity]" value="1" <?=($eachprivilage['prmp_qunatity']['write'] ?? 0)==1?'checked':''?>></td>
                                </tr>
                                <tr>
                                    <td><strong>prmp_wi_number</strong>
                                        <input type="hidden" name="field_names[]" value="prmp_wi_number">
                                    </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[prmp_wi_number]" value="1" <?=($eachprivilage['prmp_wi_number']['read'] ?? 0)==1?'checked':''?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[prmp_wi_number]" value="1" <?=($eachprivilage['prmp_wi_number']['write'] ?? 0)==1?'checked':''?>></td>
                                </tr>
                                <tr>
                                    <td><strong>prmp_equipment_number</strong>
                                        <input type="hidden" name="field_names[]" value="prmp_equipment_number">
                                    </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[prmp_equipment_number]" value="1" <?=($eachprivilage['prmp_equipment_number']['read'] ?? 0)==1?'checked':''?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[prmp_equipment_number]" value="1" <?=($eachprivilage['prmp_equipment_number']['write'] ?? 0)==1?'checked':''?>></td>
                                </tr>
                                <tr>
                                    <td><strong>prmp_done_by</strong>
                                        <input type="hidden" name="field_names[]" value="prmp_done_by">
                                    </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[prmp_done_by]" value="1" <?=($eachprivilage['prmp_done_by']['read'] ?? 0)==1?'checked':''?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[prmp_done_by]" value="1" <?=($eachprivilage['prmp_done_by']['write'] ?? 0)==1?'checked':''?>></td>
                                </tr>
                                <tr>
                                    <td><strong>prmp_verified_by</strong>
                                        <input type="hidden" name="field_names[]" value="prmp_verified_by">
                                    </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[prmp_verified_by]" value="1" <?=($eachprivilage['prmp_verified_by']['read'] ?? 0)==1?'checked':''?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[prmp_verified_by]" value="1" <?=($eachprivilage['prmp_verified_by']['write'] ?? 0)==1?'checked':''?>></td>
                                </tr>
                                <tr>
                                    <td><strong>prmp_date</strong>
                                        <input type="hidden" name="field_names[]" value="prmp_date">
                                    </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[prmp_date]" value="1" <?=($eachprivilage['prmp_date']['read'] ?? 0)==1?'checked':''?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[prmp_date]" value="1" <?=($eachprivilage['prmp_date']['write'] ?? 0)==1?'checked':''?>></td>
                                </tr>
                                 <tr>
                                    <td><strong>Pre-Manufacturing Add Option</strong>
                                        <input type="hidden" name="field_names[]" value="add_premprocess_row">
                                    </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[add_premprocess_row]" value="1" <?= ($eachprivilage['add_premprocess_row']['read'] ?? 0)==1 ? 'checked' : '' ?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[add_premprocess_row]" value="1" <?= ($eachprivilage['add_premprocess_row']['write'] ?? 0)==1 ? 'checked' : '' ?>></td>
                                </tr>
                                <tr>
                                    <td><strong>Pre-Manufacturing Delete Option</strong>
                                        <input type="hidden" name="field_names[]" value="delete_premprocess_row">
                                    </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[delete_premprocess_row]" value="1" <?= ($eachprivilage['delete_premprocess_row']['read'] ?? 0)==1 ? 'checked' : '' ?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[delete_premprocess_row]" value="1" <?= ($eachprivilage['delete_premprocess_row']['write'] ?? 0)==1 ? 'checked' : '' ?>></td>
                                </tr>
                            </tbody>
                        </table>
    
                        <table class="table table-bordered table-striped">
                        <thead>
                            <tr class="bg-primary">
                                <th class="text-center" colspan="3">Stage One Manufacturing Process Fields</th>
                            </tr>
                            <tr class="bg-primary">
                                <th>Field Name</th>
                                <th class="text-center">Read</th>
                                <th class="text-center">Write</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>dhr_id</strong>
                                    <input type="hidden" name="field_names[]" value="dhr_id">
                                </td>
                                <td class="text-center"><input type="checkbox" class="read_group" name="read[dhr_id]" value="1" <?=($eachprivilage['dhr_id']['read'] ?? 0)==1?'checked':''?>></td>
                                <td class="text-center"><input type="checkbox" class="write_group" name="write[dhr_id]" value="1" <?=($eachprivilage['dhr_id']['write'] ?? 0)==1?'checked':''?>></td>
                            </tr>
                            <tr>
                                <td><strong>mp_seq_number</strong>
                                    <input type="hidden" name="field_names[]" value="mp_seq_number">
                                </td>
                                <td class="text-center"><input type="checkbox" class="read_group" name="read[mp_seq_number]" value="1" <?=($eachprivilage['mp_seq_number']['read'] ?? 0)==1?'checked':''?>></td>
                                <td class="text-center"><input type="checkbox" class="write_group" name="write[mp_seq_number]" value="1" <?=($eachprivilage['mp_seq_number']['write'] ?? 0)==1?'checked':''?>></td>
                            </tr>
                            <tr>
                                <td><strong>mp_process_description</strong>
                                    <input type="hidden" name="field_names[]" value="mp_process_description">
                                </td>
                                <td class="text-center"><input type="checkbox" class="read_group" name="read[mp_process_description]" value="1" <?=($eachprivilage['mp_process_description']['read'] ?? 0)==1?'checked':''?>></td>
                                <td class="text-center"><input type="checkbox" class="write_group" name="write[mp_process_description]" value="1" <?=($eachprivilage['mp_process_description']['write'] ?? 0)==1?'checked':''?>></td>
                            </tr>
                            <tr>
                                <td><strong>mp_wi_number</strong>
                                    <input type="hidden" name="field_names[]" value="mp_wi_number">
                                </td>
                                <td class="text-center"><input type="checkbox" class="read_group" name="read[mp_wi_number]" value="1" <?=($eachprivilage['mp_wi_number']['read'] ?? 0)==1?'checked':''?>></td>
                                <td class="text-center"><input type="checkbox" class="write_group" name="write[mp_wi_number]" value="1" <?=($eachprivilage['mp_wi_number']['write'] ?? 0)==1?'checked':''?>></td>
                            </tr>
                            <tr>
                                <td><strong>mp_equipment_number</strong>
                                    <input type="hidden" name="field_names[]" value="mp_equipment_number">
                                </td>
                                <td class="text-center"><input type="checkbox" class="read_group" name="read[mp_equipment_number]" value="1" <?=($eachprivilage['mp_equipment_number']['read'] ?? 0)==1?'checked':''?>></td>
                                <td class="text-center"><input type="checkbox" class="write_group" name="write[mp_equipment_number]" value="1" <?=($eachprivilage['mp_equipment_number']['write'] ?? 0)==1?'checked':''?>></td>
                            </tr>
                            <tr>
                                <td><strong>mp_line_clearance_by</strong>
                                    <input type="hidden" name="field_names[]" value="mp_line_clearance_by">
                                </td>
                                <td class="text-center"><input type="checkbox" class="read_group" name="read[mp_line_clearance_by]" value="1" <?=($eachprivilage['mp_line_clearance_by']['read'] ?? 0)==1?'checked':''?>></td>
                                <td class="text-center"><input type="checkbox" class="write_group" name="write[mp_line_clearance_by]" value="1" <?=($eachprivilage['mp_line_clearance_by']['write'] ?? 0)==1?'checked':''?>></td>
                            </tr>
                            <tr>
                                <td><strong>mp_start_datetime</strong>
                                    <input type="hidden" name="field_names[]" value="mp_start_datetime">
                                </td>
                                <td class="text-center"><input type="checkbox" class="read_group" name="read[mp_start_datetime]" value="1" <?=($eachprivilage['mp_start_datetime']['read'] ?? 0)==1?'checked':''?>></td>
                                <td class="text-center"><input type="checkbox" class="write_group" name="write[mp_start_datetime]" value="1" <?=($eachprivilage['mp_start_datetime']['write'] ?? 0)==1?'checked':''?>></td>
                            </tr>
                            <tr>
                                <td><strong>mp_end_datetime</strong>
                                    <input type="hidden" name="field_names[]" value="mp_end_datetime">
                                </td>
                                <td class="text-center"><input type="checkbox" class="read_group" name="read[mp_end_datetime]" value="1" <?=($eachprivilage['mp_end_datetime']['read'] ?? 0)==1?'checked':''?>></td>
                                <td class="text-center"><input type="checkbox" class="write_group" name="write[mp_end_datetime]" value="1" <?=($eachprivilage['mp_end_datetime']['write'] ?? 0)==1?'checked':''?>></td>
                            </tr>
                            <tr>
                                <td><strong>mp_manufactured_qunatity</strong>
                                    <input type="hidden" name="field_names[]" value="mp_manufactured_qunatity">
                                </td>
                                <td class="text-center"><input type="checkbox" class="read_group" name="read[mp_manufactured_qunatity]" value="1" <?=($eachprivilage['mp_manufactured_qunatity']['read'] ?? 0)==1?'checked':''?>></td>
                                <td class="text-center"><input type="checkbox" class="write_group" name="write[mp_manufactured_qunatity]" value="1" <?=($eachprivilage['mp_manufactured_qunatity']['write'] ?? 0)==1?'checked':''?>></td>
                            </tr>
                            <tr>
                                <td><strong>mp_good_qunatity</strong>
                                    <input type="hidden" name="field_names[]" value="mp_good_qunatity">
                                </td>
                                <td class="text-center"><input type="checkbox" class="read_group" name="read[mp_good_qunatity]" value="1" <?=($eachprivilage['mp_good_qunatity']['read'] ?? 0)==1?'checked':''?>></td>
                                <td class="text-center"><input type="checkbox" class="write_group" name="write[mp_good_qunatity]" value="1" <?=($eachprivilage['mp_good_qunatity']['write'] ?? 0)==1?'checked':''?>></td>
                            </tr>
                            <tr>
                                <td><strong>mp_rejected_qunatity</strong>
                                    <input type="hidden" name="field_names[]" value="mp_rejected_qunatity">
                                </td>
                                <td class="text-center"><input type="checkbox" class="read_group" name="read[mp_rejected_qunatity]" value="1" <?=($eachprivilage['mp_rejected_qunatity']['read'] ?? 0)==1?'checked':''?>></td>
                                <td class="text-center"><input type="checkbox" class="write_group" name="write[mp_rejected_qunatity]" value="1" <?=($eachprivilage['mp_rejected_qunatity']['write'] ?? 0)==1?'checked':''?>></td>
                            </tr>
                            <tr>
                                <td><strong>mp_done_by</strong>
                                    <input type="hidden" name="field_names[]" value="mp_done_by">
                                </td>
                                <td class="text-center"><input type="checkbox" class="read_group" name="read[mp_done_by]" value="1" <?=($eachprivilage['mp_done_by']['read'] ?? 0)==1?'checked':''?>></td>
                                <td class="text-center"><input type="checkbox" class="write_group" name="write[mp_done_by]" value="1" <?=($eachprivilage['mp_done_by']['write'] ?? 0)==1?'checked':''?>></td>
                            </tr>
                            <tr>
                                <td><strong>mp_verified_by</strong>
                                    <input type="hidden" name="field_names[]" value="mp_verified_by">
                                </td>
                                <td class="text-center"><input type="checkbox" class="read_group" name="read[mp_verified_by]" value="1" <?=($eachprivilage['mp_verified_by']['read'] ?? 0)==1?'checked':''?>></td>
                                <td class="text-center"><input type="checkbox" class="write_group" name="write[mp_verified_by]" value="1" <?=($eachprivilage['mp_verified_by']['write'] ?? 0)==1?'checked':''?>></td>
                            </tr>
                             <tr>
                                    <td><strong>Pre-Manufacturing Add Option</strong>
                                        <input type="hidden" name="field_names[]" value="add_mprocess_row">
                                    </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[add_mprocess_row]" value="1" <?= ($eachprivilage['add_mprocess_row']['read'] ?? 0)==1 ? 'checked' : '' ?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[add_mprocess_row]" value="1" <?= ($eachprivilage['add_mprocess_row']['write'] ?? 0)==1 ? 'checked' : '' ?>></td>
                                </tr>
                                <tr>
                                    <td><strong>Pre-Manufacturing Delete Option</strong>
                                        <input type="hidden" name="field_names[]" value="delete_mprocess_row">
                                    </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[delete_mprocess_row]" value="1" <?= ($eachprivilage['delete_mprocess_row']['read'] ?? 0)==1 ? 'checked' : '' ?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[delete_mprocess_row]" value="1" <?= ($eachprivilage['delete_mprocess_row']['write'] ?? 0)==1 ? 'checked' : '' ?>></td>
                                </tr>
                                 <tr>
                                <td><strong>MP Remarks</strong>
                                    <input type="hidden" name="field_names[]" value="mp_remarks">
                                </td>
                                <td class="text-center"><input type="checkbox" class="read_group" name="read[mp_remarks]" value="1" <?=($eachprivilage['mp_remarks']['read'] ?? 0)==1?'checked':''?>></td>
                                <td class="text-center"><input type="checkbox" class="write_group" name="write[mp_remarks]" value="1" <?=($eachprivilage['mp_remarks']['write'] ?? 0)==1?'checked':''?>></td>
                            </tr>
                                
                        </tbody>
                    </table>

                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr class="bg-primary">
                                    <th class="text-center" colspan="3">Post Manufacturing Process Fields</th>
                                </tr>
                                <tr class="bg-primary">
                                    <th>Field Name</th>
                                    <th class="text-center">Read</th>
                                    <th class="text-center">Write</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><strong>Seq. #</strong>
                                        <input type="hidden" name="field_names[]" value="pmp_seq_number">
                                    </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[pmp_seq_number]" value="1" <?=($eachprivilage['pmp_seq_number']['read'] ?? 0)==1?'checked':''?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[pmp_seq_number]" value="1" <?=($eachprivilage['pmp_seq_number']['write'] ?? 0)==1?'checked':''?>></td>
                                </tr>
                                <tr>
                                    <td><strong>Process Description</strong>
                                        <input type="hidden" name="field_names[]" value="pmp_process_description">
                                    </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[pmp_process_description]" value="1" <?=($eachprivilage['pmp_process_description']['read'] ?? 0)==1?'checked':''?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[pmp_process_description]" value="1" <?=($eachprivilage['pmp_process_description']['write'] ?? 0)==1?'checked':''?>></td>
                                </tr>
                                <tr>
                                    <td><strong>WI #</strong>
                                        <input type="hidden" name="field_names[]" value="pmp_wi_number">
                                    </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[pmp_wi_number]" value="1" <?=($eachprivilage['pmp_wi_number']['read'] ?? 0)==1?'checked':''?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[pmp_wi_number]" value="1" <?=($eachprivilage['pmp_wi_number']['write'] ?? 0)==1?'checked':''?>></td>
                                </tr>
                                <tr>
                                    <td><strong>DCC # (If Applicable)</strong>
                                        <input type="hidden" name="field_names[]" value="pmp_dcc_number">
                                    </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[pmp_dcc_number]" value="1" <?=($eachprivilage['pmp_dcc_number']['read'] ?? 0)==1?'checked':''?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[pmp_dcc_number]" value="1" <?=($eachprivilage['pmp_dcc_number']['write'] ?? 0)==1?'checked':''?>></td>
                                </tr>
                                <tr>
                                    <td><strong>Sent Date</strong>
                                        <input type="hidden" name="field_names[]" value="pmp_sent_date">
                                    </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[pmp_sent_date]" value="1" <?=($eachprivilage['pmp_sent_date']['read'] ?? 0)==1?'checked':''?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[pmp_sent_date]" value="1" <?=($eachprivilage['pmp_sent_date']['write'] ?? 0)==1?'checked':''?>></td>
                                </tr>
                                <tr>
                                    <td><strong>Cycle #/Report #</strong>
                                        <input type="hidden" name="field_names[]" value="pmp_cycle_number_or_report_number">
                                    </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[pmp_cycle_number_or_report_number]" value="1" <?=($eachprivilage['pmp_cycle_number_or_report_number']['read'] ?? 0)==1?'checked':''?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[pmp_cycle_number_or_report_number]" value="1" <?=($eachprivilage['pmp_cycle_number_or_report_number']['write'] ?? 0)==1?'checked':''?>></td>
                                </tr>
                                <tr>
                                    <td><strong>Process Date</strong>
                                        <input type="hidden" name="field_names[]" value="pmp_process_date">
                                    </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[pmp_process_date]" value="1" <?=($eachprivilage['pmp_process_date']['read'] ?? 0)==1?'checked':''?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[pmp_process_date]" value="1" <?=($eachprivilage['pmp_process_date']['write'] ?? 0)==1?'checked':''?>></td>
                                </tr>
                                <tr>
                                    <td><strong>Done By</strong>
                                        <input type="hidden" name="field_names[]" value="pmp_done_by">
                                    </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[pmp_done_by]" value="1" <?=($eachprivilage['pmp_done_by']['read'] ?? 0)==1?'checked':''?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[pmp_done_by]" value="1" <?=($eachprivilage['pmp_done_by']['write'] ?? 0)==1?'checked':''?>></td>
                                </tr>
                                <tr>
                                    <td><strong>Checked By</strong>
                                        <input type="hidden" name="field_names[]" value="pmp_checked_by">
                                    </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[pmp_checked_by]" value="1" <?=($eachprivilage['pmp_checked_by']['read'] ?? 0)==1?'checked':''?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[pmp_checked_by]" value="1" <?=($eachprivilage['pmp_checked_by']['write'] ?? 0)==1?'checked':''?>></td>
                                </tr>
                                 <tr>
                                    <td><strong>Pre-Manufacturing Add Option</strong>
                                        <input type="hidden" name="field_names[]" value="add_pmprocess_row">
                                    </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[add_pmprocess_row]" value="1" <?= ($eachprivilage['add_pmprocess_row']['read'] ?? 0)==1 ? 'checked' : '' ?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[add_pmprocess_row]" value="1" <?= ($eachprivilage['add_pmprocess_row']['write'] ?? 0)==1 ? 'checked' : '' ?>></td>
                                </tr>
                                <tr>
                                    <td><strong>Pre-Manufacturing Delete Option</strong>
                                        <input type="hidden" name="field_names[]" value="delete_pmprocess_row">
                                    </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[delete_pmprocess_row]" value="1" <?= ($eachprivilage['delete_pmprocess_row']['read'] ?? 0)==1 ? 'checked' : '' ?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[delete_pmprocess_row]" value="1" <?= ($eachprivilage['delete_pmprocess_row']['write'] ?? 0)==1 ? 'checked' : '' ?>></td>
                                </tr>
                            </tbody>
                        </table>

                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr class="bg-primary">
                                    <th class="text-center" colspan="3">Quality Control Process Fields</th>
                                </tr>
                                <tr class="bg-primary">
                                    <th>Field Name</th>
                                    <th class="text-center">Read</th>
                                    <th class="text-center">Write</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><strong>Seq. #</strong>
                                        <input type="hidden" name="field_names[]" value="qcp_seq_number">
                                    </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[qcp_seq_number]" value="1" <?=($eachprivilage['qcp_seq_number']['read'] ?? 0)==1?'checked':''?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[qcp_seq_number]" value="1"  <?=($eachprivilage['qcp_seq_number']['write'] ?? 0)==1?'checked':''?>></td>
                                </tr>
                                <tr>
                                    <td><strong>Inspection (Or) Testing Description</strong>
                                        <input type="hidden" name="field_names[]" value="qcp_process_inspection_or_testing_description">
                                    </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[qcp_process_inspection_or_testing_description]" value="1" <?=($eachprivilage['qcp_process_inspection_or_testing_description']['read'] ?? 0)==1?'checked':''?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[qcp_process_inspection_or_testing_description]" value="1"  <?=($eachprivilage['qcp_process_inspection_or_testing_description']['write'] ?? 0)==1?'checked':''?>></td>
                                </tr>
                                <tr>
                                    <td><strong>WI #</strong>
                                        <input type="hidden" name="field_names[]" value="qcp_wi_number">
                                    </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[qcp_wi_number]" value="1" <?=($eachprivilage['qcp_wi_number']['read'] ?? 0)==1?'checked':''?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[qcp_wi_number]" value="1"  <?=($eachprivilage['qcp_wi_number']['write'] ?? 0)==1?'checked':''?>></td>
                                </tr>
                                <tr>
                                    <td><strong>QIR #/Report #</strong>
                                        <input type="hidden" name="field_names[]" value="qcp_qir_number_or_report_number">
                                    </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[qcp_qir_number_or_report_number]" value="1" <?=($eachprivilage['qcp_qir_number_or_report_number']['read'] ?? 0)==1?'checked':''?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[qcp_qir_number_or_report_number]" value="1"  <?=($eachprivilage['qcp_qir_number_or_report_number']['write'] ?? 0)==1?'checked':''?>></td>
                                </tr>
                                <tr>
                                    <td><strong>Sample Quantity</strong>
                                        <input type="hidden" name="field_names[]" value="qcp_sample_quantity">
                                    </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[qcp_sample_quantity]" value="1" <?=($eachprivilage['qcp_sample_quantity']['read'] ?? 0)==1?'checked':''?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[qcp_sample_quantity]" value="1"  <?=($eachprivilage['qcp_sample_quantity']['write'] ?? 0)==1?'checked':''?>></td>
                                </tr>
                                <tr>
                                    <td><strong>Pass/Fail</strong>
                                        <input type="hidden" name="field_names[]" value="qcp_pass_or_fail">
                                    </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[qcp_pass_or_fail]" value="1" <?=($eachprivilage['qcp_pass_or_fail']['read'] ?? 0)==1?'checked':''?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[qcp_pass_or_fail]" value="1"  <?=($eachprivilage['qcp_pass_or_fail']['write'] ?? 0)==1?'checked':''?>></td>
                                </tr>
                                <tr>
                                    <td><strong>Verified By</strong>
                                        <input type="hidden" name="field_names[]" value="qcp_verified_by">
                                    </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[qcp_verified_by]" value="1" <?=($eachprivilage['qcp_verified_by']['read'] ?? 0)==1?'checked':''?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[qcp_verified_by]" value="1"  <?=($eachprivilage['qcp_verified_by']['write'] ?? 0)==1?'checked':''?>></td>
                                </tr>
                                <tr>
                                    <td><strong>Verified Date</strong>
                                        <input type="hidden" name="field_names[]" value="qcp_verified_date">
                                    </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[qcp_verified_date]" value="1" <?=($eachprivilage['qcp_verified_date']['read'] ?? 0)==1?'checked':''?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[qcp_verified_date]" value="1"  <?=($eachprivilage['qcp_verified_date']['write'] ?? 0)==1?'checked':''?>></td>
                                </tr>
                                <tr>
                                    <td><strong>Scanned File</strong>
                                        <input type="hidden" name="field_names[]" value="qcp_scanned_file">
                                    </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[qcp_scanned_file]" value="1" <?=($eachprivilage['qcp_scanned_file']['read'] ?? 0)==1?'checked':''?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[qcp_scanned_file]" value="1"  <?=($eachprivilage['qcp_scanned_file']['write'] ?? 0)==1?'checked':''?>></td>
                                </tr>
                                <tr>
                                    <td><strong>Scanned PDF File Upload</strong>
                                        <input type="hidden" name="field_names[]" value="qcp_scanned_pdf_file">
                                    </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[qcp_scanned_pdf_file]" value="1" <?=($eachprivilage['qcp_scanned_pdf_file']['read'] ?? 0)==1?'checked':''?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[qcp_scanned_pdf_file]" value="1"  <?=($eachprivilage['qcp_scanned_pdf_file']['write'] ?? 0)==1?'checked':''?>></td>
                                </tr>
                                  <tr>
                                    <td><strong>QC Add Option</strong>
                                        <input type="hidden" name="field_names[]" value="add_qcprocess_row">
                                    </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[add_qcprocess_row]" value="1" <?= ($eachprivilage['add_qcprocess_row']['read'] ?? 0)==1 ? 'checked' : '' ?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[add_qcprocess_row]" value="1" <?= ($eachprivilage['add_qcprocess_row']['write'] ?? 0)==1 ? 'checked' : '' ?>></td>
                                </tr>
                                <tr>
                                    <td><strong>QC Delete Option</strong>
                                        <input type="hidden" name="field_names[]" value="delete_qcprocess_row">
                                    </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[delete_qcprocess_row]" value="1" <?= ($eachprivilage['delete_qcprocess_row']['read'] ?? 0)==1 ? 'checked' : '' ?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[delete_qcprocess_row]" value="1" <?= ($eachprivilage['delete_qcprocess_row']['write'] ?? 0)==1 ? 'checked' : '' ?>></td>
                                </tr>
                            </tbody>
                        </table>

                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr class="bg-primary">
                                    <th class="text-center" colspan="3">Finished Goods Transfer Note Fields</th>
                                </tr>
                                <tr class="bg-primary">
                                    <th>Field Name</th>
                                    <th class="text-center">Read</th>
                                    <th class="text-center">Write</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><strong>Transferred Quantity</strong>
                                        <input type="hidden" name="field_names[]" value="transferred_quantity">
                                    </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[transferred_quantity]" value="1" <?=($eachprivilage['transferred_quantity']['read'] ?? 0)==1?'checked':''?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[transferred_quantity]" value="1" <?=($eachprivilage['transferred_quantity']['write'] ?? 0)==1?'checked':''?>></td>
                                </tr>
                                <tr>
                                    <td><strong>Transferred By (Sign)</strong>
                                        <input type="hidden" name="field_names[]" value="transferred_by">
                                    </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[transferred_by]" value="1" <?=($eachprivilage['transferred_by']['read'] ?? 0)==1?'checked':''?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[transferred_by]" value="1" <?=($eachprivilage['transferred_by']['write'] ?? 0)==1?'checked':''?>></td>
                                </tr>
                                <tr>
                                    <td><strong>Transferred Date</strong>
                                        <input type="hidden" name="field_names[]" value="transferred_date">
                                    </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[transferred_date]" value="1" <?=($eachprivilage['transferred_date']['read'] ?? 0)==1?'checked':''?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[transferred_date]" value="1" <?=($eachprivilage['transferred_date']['write'] ?? 0)==1?'checked':''?>></td>
                                </tr>
                                <tr>
                                    <td><strong>Accepted By (Sign)</strong>
                                        <input type="hidden" name="field_names[]" value="accepted_by">
                                    </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[accepted_by]" value="1" <?=($eachprivilage['accepted_by']['read'] ?? 0)==1?'checked':''?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[accepted_by]" value="1" <?=($eachprivilage['accepted_by']['write'] ?? 0)==1?'checked':''?>></td>
                                </tr>
                                <tr>
                                    <td><strong>Accepted Date</strong>
                                        <input type="hidden" name="field_names[]" value="accepted_date">
                                    </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[accepted_date]" value="1" <?=($eachprivilage['accepted_date']['read'] ?? 0)==1?'checked':''?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[accepted_date]" value="1" <?=($eachprivilage['accepted_date']['write'] ?? 0)==1?'checked':''?>></td>
                                </tr>
                            </tbody>
                        </table>

                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr class="bg-primary">
                                    <th class="text-center" colspan="3">Material Reconciliation Fields</th>
                                </tr>
                                <tr class="bg-primary">
                                    <th>Field Name</th>
                                    <th class="text-center">Read</th>
                                    <th class="text-center">Write</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                 <tr>
                                    <td><strong>Item Number</strong>
                                        <input type="hidden" name="field_names[]" value="copy_from_bom_to_mrec_row">
                                    </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[copy_from_bom_to_mrec_row]" value="1" <?=($eachprivilage['copy_from_bom_to_mrec_row']['read'] ?? 0)==1?'checked':''?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[copy_from_bom_to_mrec_row]" value="1" <?=($eachprivilage['copy_from_bom_to_mrec_row']['write'] ?? 0)==1?'checked':''?>></td>
                                </tr>
                                <tr>
                                    <td><strong>Item Number</strong>
                                        <input type="hidden" name="field_names[]" value="mrec_item_number">
                                    </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[mrec_item_number]" value="1" <?=($eachprivilage['mrec_item_number']['read'] ?? 0)==1?'checked':''?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[mrec_item_number]" value="1" <?=($eachprivilage['mrec_item_number']['write'] ?? 0)==1?'checked':''?>></td>
                                </tr>
                                <tr>
                                    <td><strong>Description</strong>
                                        <input type="hidden" name="field_names[]" value="mrec_description">
                                    </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[mrec_description]" value="1" <?=($eachprivilage['mrec_description']['read'] ?? 0)==1?'checked':''?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[mrec_description]" value="1" <?=($eachprivilage['mrec_description']['write'] ?? 0)==1?'checked':''?>></td>
                                </tr>
                                <tr>
                                    <td><strong>UOM</strong>
                                        <input type="hidden" name="field_names[]" value="mrec_uom">
                                    </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[mrec_uom]" value="1" <?=($eachprivilage['mrec_uom']['read'] ?? 0)==1?'checked':''?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[mrec_uom]" value="1" <?=($eachprivilage['mrec_uom']['write'] ?? 0)==1?'checked':''?>></td>
                                </tr>
                                <tr>
                                    <td><strong>Quantity Received</strong>
                                        <input type="hidden" name="field_names[]" value="mrec_quantity_received">
                                    </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[mrec_quantity_received]" value="1" <?=($eachprivilage['mrec_quantity_received']['read'] ?? 0)==1?'checked':''?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[mrec_quantity_received]" value="1" <?=($eachprivilage['mrec_quantity_received']['write'] ?? 0)==1?'checked':''?>></td>
                                </tr>
                                <tr>
                                    <td><strong>QIR Number</strong>
                                        <input type="hidden" name="field_names[]" value="mrec_qir_number">
                                    </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[mrec_qir_number]" value="1" <?=($eachprivilage['mrec_qir_number']['read'] ?? 0)==1?'checked':''?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[mrec_qir_number]" value="1" <?=($eachprivilage['mrec_qir_number']['write'] ?? 0)==1?'checked':''?>></td>
                                </tr>
                                <tr>
                                    <td><strong>Item Lot Number (Input Lot)</strong>
                                        <input type="hidden" name="field_names[]" value="mrec_item_lot_number_or_input_lot">
                                    </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[mrec_item_lot_number_or_input_lot]" value="1" <?=($eachprivilage['mrec_item_lot_number_or_input_lot']['read'] ?? 0)==1?'checked':''?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[mrec_item_lot_number_or_input_lot]" value="1" <?=($eachprivilage['mrec_item_lot_number_or_input_lot']['write'] ?? 0)==1?'checked':''?></td>
                                </tr>
                                <tr>
                                    <td><strong>Returned By</strong>
                                        <input type="hidden" name="field_names[]" value="mrec_returned_by">
                                    </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[mrec_returned_by]" value="1" <?=($eachprivilage['mrec_returned_by']['read'] ?? 0)==1?'checked':''?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[mrec_returned_by]" value="1" <?=($eachprivilage['mrec_returned_by']['write'] ?? 0)==1?'checked':''?>></td>
                                </tr>
                                <tr>
                                    <td><strong>Received By</strong>
                                        <input type="hidden" name="field_names[]" value="mrec_received_by">
                                    </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[mrec_received_by]" value="1" <?=($eachprivilage['mrec_received_by']['read'] ?? 0)==1?'checked':''?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[mrec_received_by]" value="1" <?=($eachprivilage['mrec_received_by']['write'] ?? 0)==1?'checked':''?>></td>
                                </tr>
                                <tr>
                                    <td><strong>Date</strong>
                                        <input type="hidden" name="field_names[]" value="mrec_date">
                                    </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[mrec_date]" value="1" <?=($eachprivilage['mrec_date']['read'] ?? 0)==1?'checked':''?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[mrec_date]" value="1" <?=($eachprivilage['mrec_date']['write'] ?? 0)==1?'checked':''?>></td>
                                </tr>
                                <tr>
                                    <td><strong>Remarks</strong>
                                        <input type="hidden" name="field_names[]" value="mrec_remark">
                                    </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[mrec_remark]" value="1" <?=($eachprivilage['mrec_remark']['read'] ?? 0)==1?'checked':''?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[mrec_remark]" value="1" <?=($eachprivilage['mrec_remark']['write'] ?? 0)==1?'checked':''?>></td>
                                </tr>
                                  <tr>
                                    <td><strong>Material Recociliation Add Option</strong>
                                        <input type="hidden" name="field_names[]" value="add_mrec_row">
                                    </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[add_mrec_row]" value="1" <?=(($eachprivilage['add_mrec_row']['read'] ?? 0)??0)==1 ? 'checked' : '' ?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[add_mrec_row]" value="1" <?=(($eachprivilage['add_mrec_row']['write'] ?? 0)??0)==1 ? 'checked' : '' ?>></td>
                                </tr>
                                <tr>
                                    <td><strong>Material Recociliation Delete Option</strong>
                                        <input type="hidden" name="field_names[]" value="delete_mrec_row">
                                    </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[delete_mrec_row]" value="1" <?=(($eachprivilage['delete_mrec_row']['read'] ?? 0) ?? 0)==1 ? 'checked' : '' ?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[delete_mrec_row]" value="1" <?=(($eachprivilage['delete_mrec_row']['write'] ?? 0) ?? 0)==1 ? 'checked' : '' ?>></td>
                                </tr>
                            </tbody>
                        </table>

                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr class="bg-primary">
                                    <th class="text-center" colspan="3">Finished Goods Reconciliation Fields</th>
                                </tr>
                                <tr class="bg-primary">
                                    <th>Field Name</th>
                                    <th class="text-center">Read</th>
                                    <th class="text-center">Write</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><strong>Total Quantity Produced and Packed</strong>
                                        <input type="hidden" name="field_names[]" value="total_quantity_produced_and_packed">
                                    </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[total_quantity_produced_and_packed]" value="1"  <?=($eachprivilage['total_quantity_produced_and_packed']['read'] ?? 0)==1?'checked':''?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[total_quantity_produced_and_packed]" value="1" <?=($eachprivilage['total_quantity_produced_and_packed']['write'] ?? 0)==1?'checked':''?>></td>
                                </tr>
                                <tr>
                                    <td><strong>Archive Samples Quantity</strong>
                                        <input type="hidden" name="field_names[]" value="archive_samples_quantity">
                                    </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[archive_samples_quantity]" value="1"  <?=($eachprivilage['archive_samples_quantity']['read'] ?? 0)==1?'checked':''?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[archive_samples_quantity]" value="1" <?=($eachprivilage['archive_samples_quantity']['write'] ?? 0)==1?'checked':''?>></td>
                                </tr>
                                  <tr>
                                    <td><strong>Penetration Samples Quantity</strong>
                                        <input type="hidden" name="field_names[]" value="penetration_samples_quantity">
                                    </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[penetration_samples_quantity]" value="1"  <?=($eachprivilage['penetration_samples_quantity']['read'] ?? 0)==1?'checked':''?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[penetration_samples_quantity]" value="1" <?=($eachprivilage['penetration_samples_quantity']['write'] ?? 0)==1?'checked':''?>></td>
                                </tr>
                                  <tr>
                                    <td><strong>Control Samples Quantity</strong>
                                        <input type="hidden" name="field_names[]" value="control_samples_quantity">
                                    </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[control_samples_quantity]" value="1"  <?=($eachprivilage['control_samples_quantity']['read'] ?? 0)==1?'checked':''?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[control_samples_quantity]" value="1" <?=($eachprivilage['control_samples_quantity']['write'] ?? 0)==1?'checked':''?>></td>
                                </tr>
                                
                                
                                <tr>
                                    <td><strong>Rejected Quantity</strong>
                                        <input type="hidden" name="field_names[]" value="rejected_quantity">
                                    </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[rejected_quantity]" value="1"  <?=($eachprivilage['rejected_quantity']['read'] ?? 0)==1?'checked':''?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[rejected_quantity]" value="1" <?=($eachprivilage['rejected_quantity']['write'] ?? 0)==1?'checked':''?>></td>
                                </tr>
                                <tr>
                                    <td><strong>Yield (Percentage)</strong>
                                        <input type="hidden" name="field_names[]" value="yield_percentage">
                                    </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[yield_percentage]" value="1"  <?=($eachprivilage['yield_percentage']['read'] ?? 0)==1?'checked':''?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[yield_percentage]" value="1" <?=($eachprivilage['yield_percentage']['write'] ?? 0)==1?'checked':''?>></td>
                                </tr>
                                <tr>
                                    <td><strong>Verified By - Production Head (Signature)</strong>
                                        <input type="hidden" name="field_names[]" value="production_verified_by">
                                    </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[production_verified_by]" value="1"  <?=($eachprivilage['production_verified_by']['read'] ?? 0)==1?'checked':''?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[production_verified_by]" value="1" <?=($eachprivilage['production_verified_by']['write'] ?? 0)==1?'checked':''?>></td>
                                </tr>
                                <tr>
                                    <td><strong>Verified Date</strong>
                                        <input type="hidden" name="field_names[]" value="production_verified_date">
                                    </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[production_verified_date]" value="1"  <?=($eachprivilage['production_verified_date']['read'] ?? 0)==1?'checked':''?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[production_verified_date]" value="1" <?=($eachprivilage['production_verified_date']['write'] ?? 0)==1?'checked':''?>></td>
                                </tr>
                                <tr>
                                    <td><strong>Verified Remarks</strong>
                                        <input type="hidden" name="field_names[]" value="production_verified_by_remarks">
                                    </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[production_verified_by_remarks]" value="1"  <?=($eachprivilage['production_verified_by_remarks']['read'] ?? 0)==1?'checked':''?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[production_verified_by_remarks]" value="1" <?=($eachprivilage['production_verified_by_remarks']['write'] ?? 0)==1?'checked':''?>></td>
                                </tr>
                                <tr>
                                    <td><strong>Checked By - Quality Control Head (Signature)</strong>
                                        <input type="hidden" name="field_names[]" value="checked_by_quality_control">
                                    </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[checked_by_quality_control]" value="1"  <?=($eachprivilage['checked_by_quality_control']['read'] ?? 0)==1?'checked':''?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[checked_by_quality_control]" value="1" <?=($eachprivilage['checked_by_quality_control']['write'] ?? 0)==1?'checked':''?>></td>
                                </tr>
                                <tr>
                                    <td><strong>Checked Date</strong>
                                        <input type="hidden" name="field_names[]" value="checked_by_quality_control_date">
                                    </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[checked_by_quality_control_date]" value="1"  <?=($eachprivilage['checked_by_quality_control_date']['read'] ?? 0)==1?'checked':''?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[checked_by_quality_control_date]" value="1" <?=($eachprivilage['checked_by_quality_control_date']['write'] ?? 0)==1?'checked':''?>></td>
                                </tr>
                                <tr>
                                    <td><strong>Checked Remarks</strong>
                                        <input type="hidden" name="field_names[]" value="checked_by_quality_control_remark">
                                    </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[checked_by_quality_control_remark]" value="1"  <?=($eachprivilage['checked_by_quality_control_remark']['read'] ?? 0)==1?'checked':''?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[checked_by_quality_control_remark]" value="1" <?=($eachprivilage['checked_by_quality_control_remark']['write'] ?? 0)==1?'checked':''?>></td>
                                </tr>
                            </tbody>
                        </table>

                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr class="bg-primary">
                                    <th class="text-center" colspan="3">QA Approval and Release Fields</th>
                                </tr>
                                <tr class="bg-primary">
                                    <th>Field Name</th>
                                    <th class="text-center">Read</th>
                                    <th class="text-center">Write</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><strong>Quantity Released for Dispatch</strong>
                                        <input type="hidden" name="field_names[]" value="quantity_released_for_dispatch">
                                    </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[quantity_released_for_dispatch]" value="1"  <?=($eachprivilage['quantity_released_for_dispatch']['read'] ?? 0)==1?'checked':''?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[quantity_released_for_dispatch]" value="1"  <?=($eachprivilage['quantity_released_for_dispatch']['write'] ?? 0)==1?'checked':''?>></td>
                                </tr>
                                <tr>
                                    <td><strong>Date Of Release</strong>
                                        <input type="hidden" name="field_names[]" value="date_of_release">
                                    </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[date_of_release]" value="1"  <?=($eachprivilage['date_of_release']['read'] ?? 0)==1?'checked':''?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[date_of_release]" value="1"  <?=($eachprivilage['date_of_release']['write'] ?? 0)==1?'checked':''?>></td>
                                </tr>
                                <tr>
                                    <td><strong>Remarks</strong>
                                        <input type="hidden" name="field_names[]" value="remarks">
                                    </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[remarks]" value="1"  <?=($eachprivilage['remarks']['read'] ?? 0)==1?'checked':''?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[remarks]" value="1"  <?=($eachprivilage['remarks']['write'] ?? 0)==1?'checked':''?>></td>
                                </tr>
                                <tr>
                                    <td><strong>Signature</strong>
                                        <input type="hidden" name="field_names[]" value="signature">
                                    </td>
                                    <td class="text-center"><input type="checkbox" class="read_group" name="read[signature]" value="1"  <?=($eachprivilage['signature']['read'] ?? 0)==1?'checked':''?>></td>
                                    <td class="text-center"><input type="checkbox" class="write_group" name="write[signature]" value="1"  <?=($eachprivilage['signature']['write'] ?? 0)==1?'checked':''?>></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
            
                    <div class="form-group">
                        <div class="col-sm-12 text-right">
                            <button type="submit" class="btn btn-success">Save Privileges</button>
                        </div>
                    </div>
               
            </div>
        </form>
    </div>
</div>
<script>
$('#read_all_check').click(function(){
    if($('#read_all_check').prop('checked')){
        $('.read_group').prop('checked',true);
    }else{
        $('.read_group').prop('checked',false);
    }
});

$('#write_all_check').click(function(){
    if($('#write_all_check').prop('checked')){
        $('.write_group').prop('checked',true);
    }else{
        $('.write_group').prop('checked',false);
    }
});

    $('#privilage_form').submit(function(e){
        e.preventDefault();
         if(confirm('Are you want to save Privilage details?')){
         $.ajax({
             type:'post',
             url:'<?=base_url("AdminController/SaveUpdatePrivilage")?>',
             data:new FormData(this),
             processData:false,
             contentType:false,
             success:function(){
                 alert('Saved Successfully.');
                 $('.close').click();
             }
         });
        }
    });
</script>