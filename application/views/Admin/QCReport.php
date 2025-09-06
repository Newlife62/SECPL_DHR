<style>body{overflow:hidden;}</style>
<main class="app-content" >
      <div class="app-title">
        <div>
          <h1><i class="fa fa-list"></i> QC Report</h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">QC Report</a></li>
        </ul>
      </div>
      
      <style>
        #batchTable thead th {
          position: sticky;
          top: 0;
          background: #f8f9fa; /* light gray background */
          z-index: 2;
        }

      </style>
        
        <div class="row">
            <div class="col-md-12 col-lg-12 ">
                <div class="tile" style="height:80vh;overflow:scroll;">
                    <button class="btn btn-success export-btn" onclick="exportTableToExcel('batchTable', 'qc_report')">Export to Excel </button>
                    <div class="tile-body table-responsive" >
                        <table class="table table-bordered table-striped table-hover table-responsive" id="batchTable">
                          <thead style="overflow-x:scroll;top:0px;">
                           <tr>
                                <th>SL no</th>
                                <th>Stage</th>
                                <th>DHR Issued Date</th>
                                <th>DHR No.</th>
                                <th>Item Code</th>
                                <th>Item Name</th>
                                <th>Batch No.</th>
                                <th>Sales Order Number</th>
                                <th>Date of Batch Commencement</th>
                                <th>Mfg Date</th>
                                <th>Exp Date</th>
                                <th>Date of Batch Completion</th>
                                <th>Input Batch Details</th>
                                <th>Order Qty</th>
                                <th>Production Qty / Batch Qty</th>
                                <th>Post Manufacturing Process (Optional)</th>
                                <th>QC Line Clearance</th>
                                <th>QC Testing Details</th>
                                
                                <th>Transfered Qty</th>
                                <th>No. of Control Samples</th>
                                <th>Rej Qty</th>
                                <th>FG Transferred Details</th>
                                <th>Material Reconciliation Details</th>
                                <th>% Yield</th>
                                <th>% Rej</th>
                                <th>QC Head Sign</th>
                              </tr>
                          </thead>
                          <tbody >
                           <?php $i = 1; foreach($stage_one_dhr_order_information_bill_of_material->result_array() as $dhr){ ?>
                                      <tr>
                                            <th><?=$i++?></th>
                                            <th><?=$dhr['stage']?></th>
                                            <th><?=$dhr['dhr_issued_date_qa']?></th>
                                            <th><?=$dhr['dhr_number']?></th>
                                            <th><?=$dhr['item_code']?></th>
                                            <th><?=$dhr['product_description']?></th>
                                            <th><?=$dhr['batch_number']?></th>
                                            <th><?=$dhr['sales_order_number']?></th>
                                            <th><?=$dhr['date_of_batch_commencement']?></th>
                                            <th><?=$dhr['manufactured_date']?></th>
                                            <th><?=$dhr['expiry_date']?></th>
                                            <th><?=$dhr['date_of_completion']?></th>
                                            <th><?=$dhr['input_batch_number']?></th>
                                            <th><?=$dhr['ordered_quantity']?></th>
                                            <th><?=$dhr['production_quantity']?></th>
                                            <th><?=$dhr['pmp_checked_by']?></th>
                                           
                                            <th><?=$dhr['mp_line_clearance_by']?></th>
                                            <th><?=$dhr['scanned_file']==''?'NA':'Attached'?></th>
                                            
                                            <th><?=$dhr['transferred_quantity']?></th>
                                            <th><?=$dhr['archive_samples']?></th>
                                            <th><?=$dhr['rejected_quantity']?></th>
                                            <th><?=$dhr['total_quantity_produced_and_packed']?></th>
                                            <th><?=$dhr['mrec_quantity_received']?></th>
                                            <th><?=$dhr['yield_percentage']?>%</th>
                                            <th><?=$dhr['reject_percentage']?>%</th>
                                            <th><?=$dhr['qcp_verified_by']?></th>
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
