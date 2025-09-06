<style>body{overflow:hidden;}</style>
<main class="app-content" >
      <div class="app-title">
        <div>
          <h1><i class="fa fa-list"></i> DHR Store Report</h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">DHR Store Report</a></li>
        </ul>
      </div>
        
        <div class="row">
            <div class="col-md-12 col-lg-12 ">
                <div class="tile" style="height:80vh;overflow:scroll;">
                    <button class="btn btn-success export-btn" onclick="exportTableToExcel('batchTable', 'dhr_store__data')">Export to Excel </button>
                    <div class="tile-body table-responsive" >
                        <table class="table table-bordered table-striped table-hover table-responsive" id="batchTable">
                          <thead style="overflow-x:scroll;top:0px;">
                           <tr>
                                <th>SL no</th>
                                <th>Stage</th>
                                <th>DHR No.</th>
                                <th>Order Info Item Code</th>
                                <th>Order Info Item Name</th>
                                <th>BOM Item Code</th>
                                <th>BOM Item Description</th>
                                <th>Sales Order Number</th>
                                <th>Production Order Number</th>
                                <th>Required qty</th>
                                <th>Issued qty</th>
                                <th>QIRM NO</th>
                                <th>Input Lot Number</th>
                            </tr>
                          </thead>
                          <tbody >
                           <?php $i = 1; foreach($stage_one_dhr_order_information_bill_of_material->result_array() as $dhr){  ?>
                                      <tr>
                                            <th><?=$i++?></th>
                                            <th><?=$dhr['stage']?></th>
                                            <th><?=$dhr['dhr_number']?></th>
                                            <th><?=$dhr['item_code']?></th>
                                            <th><?=$dhr['product_description']?></th>
                                            <th><?=$dhr['bom_item_code']?></th>
                                            <th><?=$dhr['bom_item_name']?></th>
                                            <th><?=$dhr['sales_order_number']?></th>
                                            <th><?=$dhr['production_order_number']??'-'?></th>
                                            <th><?=$dhr['required_qty']?></th>
                                            <th><?=$dhr['issued_qt']?></th>
                                            <th><?=$dhr['qirm_number']?></th>
                                            <th><?=$dhr['input_batch_number']?></th>
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
