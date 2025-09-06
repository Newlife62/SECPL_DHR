<style>body{overflow:hidden;}</style>
<main class="app-content" >
      <div class="app-title">
        <div>
          <h1><i class="fa fa-list"></i> DHR Report</h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">DHR Report</a></li>
        </ul>
      </div>
        
        <div class="row">
            <div class="col-md-12 col-lg-12 ">
                <div class="tile" style="height:80vh;overflow:scroll;">
                    <button class="btn btn-success export-btn" onclick="exportTableToExcel('batchTable', 'batch_data')">Export to Excel </button>
                    <div class="tile-body table-responsive" >
                        <table class="table table-bordered table-striped table-hover table-responsive" id="batchTable">
                          <thead style="overflow-x:scroll;top:0px;">
                            <tr>
                              <th>SL no</th>
                              <th>Stage</th>
                              <th style="width:20%;">DHR Issued Date</th>
                              <th>DHR No.</th>
                              <th>Item Code</th>
                              <th>Item Name</th>
                              <th>Batch No.</th>
                              <th>Sales Order Number</th>
                              <th>Date of Batch Commencement</th>
                              <th>Mfg date</th>
                              <th>Exp Date</th>
                              <th>Date of Batch Completion</th>
                              
                              <th>Input Batch no.</th>
                              <th>Order Qty</th>
                              <th>Production Qty/Batch Qty</th>
                              <th>FG Transfered Qty</th>
                              <th>No. of Control samples</th>
                              <th>Rej Qty</th>
                              <th>% Yeild</th>
                              <th>% REJ</th>
                            </tr>
                          </thead>
                          <tbody >
                           <?php $i = 1; foreach($stage_one_dhr_order_information->result_array() as $dhr){
                                                $input_batch_number = isset($stage_one_dhr_bill_of_material[$dhr['id']]['input_batch_number'])?$stage_one_dhr_bill_of_material[$dhr['id']]['input_batch_number']:'';
                                                // $good_quantity = isset($stage_one_manufacturing_process[$dhr['id']]['good_quantity'])?$stage_one_manufacturing_process[$dhr['id']]['good_quantity']:0;
                                                // $rejected_quantity = isset($stage_one_manufacturing_process[$dhr['id']]['rejected_quantity'])?$stage_one_manufacturing_process[$dhr['id']]['rejected_quantity']:0;
                                                // $manufactured_quantity = isset($stage_one_manufacturing_process[$dhr['id']]['manufactured_quantity'])?$stage_one_manufacturing_process[$dhr['id']]['manufactured_quantity']:0;
                                                // $manufactured_quantity = $manufactured_quantity==0?1:$manufactured_quantity;
                           ?>
                                      <tr>
                                          <th><?=$i++?></th>
                                           <th><?=$dhr['stage']?></th>
                                           <th><?=$dhr['dhr_issued_date_qa']?></th>
                                            <th><?=$dhr['dhr_number']?></th>
                                          <th><?=$dhr['item_code']?></th>
                                           <th><?=$dhr['item_name']?></th>
                                            <th><?=$dhr['batch_number']?></th>
                                          <th><?=$dhr['sales_order_number']?></th>
                                          <th><?=$dhr['date_of_batch_commencement']?></th>
                                          <th><?=$dhr['manufactured_date']?></th>
                                          <th><?=$dhr['expiry_date']?></th>
                                          <th><?=$dhr['date_of_completion']?></th>
                                          
                                          <th><?=$input_batch_number?></th>
                                          <th><?=$dhr['ordered_quantity']??'-'?></th>
                                          <th><?=$dhr['production_quantity']??'-'?></th>
                                          <th><?=$finished_goods_transfer_note[$dhr['id']]['transferred_quantity']??0?></th>
                                          <th><?=$stage_one_finished_goods_reconcillation[$dhr['id']]['number_of_control_samples']??0?></th>
                                          <th><?=$stage_one_finished_goods_reconcillation[$dhr['id']]['rejected_quantity']??0?></th>
                                          <th><?=round(($stage_one_finished_goods_reconcillation[$dhr['id']]['yield_percentage']??0),2)?>%</th>
                                          <th><?=round(($stage_one_finished_goods_reconcillation[$dhr['id']]['reject_percentage']??0),2)?>%</th>
                                        </tr>
                           <?php }?>
                          </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
</main>        
  <!-- Export to Excel Script -->
<script>
  function exportTableToExcel(tableID, filename = '') {
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');

    filename = filename ? filename + '.xls' : 'excel_data.xls';

    var downloadLink = document.createElement("a");
    document.body.appendChild(downloadLink);

    if (navigator.msSaveOrOpenBlob) {
      var blob = new Blob(['\ufeff', tableHTML], { type: dataType });
      navigator.msSaveOrOpenBlob(blob, filename);
    } else {
      downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
      downloadLink.download = filename;
      downloadLink.click();
    }

    document.body.removeChild(downloadLink);
  }
</script>
