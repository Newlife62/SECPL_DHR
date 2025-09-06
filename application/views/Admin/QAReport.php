<style>body{overflow:hidden;}</style>
<main class="app-content" >
      <div class="app-title">
        <div>
          <h1><i class="fa fa-list"></i> QA Report</h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">QA Report</a></li>
        </ul>
      </div>
        
        <div class="row">
            <div class="col-md-12 col-lg-12 ">
                <div class="tile" style="height:80vh;overflow:scroll;">
                    <button class="btn btn-success export-btn" onclick="exportTableToExcel('batchTable', 'QA__Report')">Export to Excel </button>
                    <div class="tile-body table-responsive" >
                        <table class="table table-bordered table-striped table-hover table-responsive" id="batchTable">
                          <thead style="overflow-x:scroll;top:0px;position:sticky;background:#f8f9fa;z-index:1;">
                              <tr>
                                <th>SL no</th>
                                <th>Stage</th>
                                <th>DHR Number</th>
                                <th>DHR Issued Date</th>
                                <th>Batch No.</th>
                                <th>DHR Issued Date</th>
                                <th>DHR Received Date</th>
                                <th>Date of Batch Commencement</th>
                                <th>Date of Batch Completion</th>
                                <th>Item Code (Optional)</th>
                                
                                <th>Product Description</th>
                                <th>Mfg Date</th>
                                <th>Exp Date</th>
                                <th>Input Batch no.</th>
                                <th>Order Qty</th>
                                <th>Production Qty / Batch Qty</th>
                                <!--<th>Pre Manufacturing Process (Optional)</th>-->
                                
                                <!--Manufacturing Process-->
                                <th>Manufacturing Process</th>
                                <th>Good Qty</th>
                                <th>Rej Qty</th>
                                <th>Production Verified</th>
                                <th>QC Clearance Status</th>
                                
                                <!--QC Process-->
                                <th>QC Process</th>
                                <th>QC Verification By</th>
                                <th>QC Status</th>
                                
                                <!--Finished Goods Reconciliation-->
                                <th>FG Transferred Qty</th>
                                <th>No. of Control Samples</th>
                                <th>% Yield</th>
                                <th>Production Head Verified</th>
                                <th>QC Head Clearance</th>
                                
                                <!--QA Release-->
                                <th>QA Released Qty</th>
                                <th>QA Approved</th>
                                <th>Date of Release</th>
                              </tr> 
                            </thead>

                           <tbody ><?php $j=1; foreach ($stage_one_dhr_order_information_mp_qc->result_array() as $dhr): ?>
                            <?php
                                $mp_list = !empty($dhr['manufacturing_processes']) 
                                           ? explode(' | ', $dhr['manufacturing_processes']) 
                                           : [];
                        
                                $qc_list = !empty($dhr['quality_control_processes']) 
                                           ? explode(' | ', $dhr['quality_control_processes']) 
                                           : [];
                        
                                $row_count = max(count($mp_list), count($qc_list));
                            ?>
                            
                            <?php for ($i=0; $i<$row_count; $i++): ?>
                                <tr>
                                    <?php if ($i == 0): ?>
                                        <!-- Master DHR columns only once with rowspan -->
                                        <td rowspan="<?=$row_count?>"><?=$j++?></td>
                                        <td rowspan="<?=$row_count?>"><?=$dhr['stage']?></td>
                                        <td rowspan="<?=$row_count?>"><?=$dhr['dhr_number']?></td>
                                        <td rowspan="<?=$row_count?>"><?=$dhr['dhr_issued_date_qa']?></td>
                                        <td rowspan="<?=$row_count?>"><?=$dhr['batch_number']?></td>
                                        <td rowspan="<?=$row_count?>"><?=$dhr['dhr_issued_date_qa']?></td>
                                        <td rowspan="<?=$row_count?>"><?=$dhr['dhr_received_date_production']?></td>
                                        <td rowspan="<?=$row_count?>"><?=$dhr['date_of_batch_commencement']?></td>
                                        <td rowspan="<?=$row_count?>"><?=$dhr['date_of_completion']?></td>
                                        <td rowspan="<?=$row_count?>"><?=$dhr['item_code']?></td>
                                        <td rowspan="<?=$row_count?>"><?=$dhr['product_description']?></td>
                                        <td rowspan="<?=$row_count?>"><?=$dhr['manufactured_date']?></td>
                                        <td rowspan="<?=$row_count?>"><?=$dhr['expiry_date']?></td>
                                        <td rowspan="<?=$row_count?>"><?=$dhr['input_batch_number']?></td>
                                        <td rowspan="<?=$row_count?>"><?=$dhr['ordered_quantity']?></td>
                                        <td rowspan="<?=$row_count?>"><?=$dhr['production_quantity']?></td>
                                        
                                    <?php endif; ?>
                        
                                    <!-- Manufacturing Process columns -->
                                    <?php if (isset($mp_list[$i])): ?>
                                        <?php 
                                            $mp_parts = explode(', ', $mp_list[$i]); 
                                            // Your concat was "seq - desc (wi, eq, start, end, mfg, good, rej, done_by, verified_by, clearance_by, remarks)"
                                        ?>
                                        <td><?=$mp_parts[0] ?? ''?></td> <!-- seq+desc -->
                                        <td><?=$mp_parts[5] ?? ''?></td> <!-- manufactured qty -->
                                        <td><?=$mp_parts[6] ?? ''?></td> <!-- good qty -->
                                        <td><?=$mp_parts[7] ?? ''?></td> <!-- rejected qty -->
                                        <td><?=(isset($employees[$mp_parts[9] ?? ''])?$employees[$mp_parts[9]]:'')?></td> <!-- verified_by -->
                                    <?php else: ?>
                                        <td colspan="5">-</td>
                                    <?php endif; ?>
                        
                                    <!-- QC Process columns -->
                                    <?php if (isset($qc_list[$i])): ?>
                                        <?php 
                                            $qc_parts = explode(', ', $qc_list[$i]);
                                            // concat was "seq - desc (wi, qir, sample, passfail, verified_by, verified_date, file)"
                                        ?>
                                        <td><?=$qc_parts[0] ?? ''?></td> <!-- seq+desc -->
                                        <td><?=(isset($employees[$qc_parts[4] ?? ''])?$employees[$qc_parts[4]]:'')?></td> <!-- verified_by  -->
                                        <td><?=$qc_parts[3] ?? ''?></td> <!-- pass/fail -->
                                    <?php else: ?>
                                        <td colspan="3">-</td>
                                    <?php endif; ?>
                                    
                                     <?php if ($i == 0): ?>
                                        <td rowspan="<?=$row_count?>"><?=$dhr['transferred_quantity']?></td>
                                        <td rowspan="<?=$row_count?>"><?=$dhr['archive_samples_quantity']?></td>
                                        <td rowspan="<?=$row_count?>"><?=$dhr['yield_percentage']?></td>
                                        <td rowspan="<?=$row_count?>"><?=isset($employees[$dhr['production_head_verified'] ?? ''])?$employees[$dhr['production_head_verified']]:''?></td>
                                        <td rowspan="<?=$row_count?>"><?=isset($employees[$dhr['qc_head_clearance'] ?? ''])?$employees[$dhr['qc_head_clearance']]:''?></td>
                                        <td rowspan="<?=$row_count?>"><?=$dhr['quantity_released_for_dispatch']?></td>
                                        <td rowspan="<?=$row_count?>"><?=isset($employees[$dhr['signature'] ?? ''])?$employees[$dhr['signature']]:'NA'?></td>
                                        <td rowspan="<?=$row_count?>"><?=$dhr['date_of_release']?></td>
                                        
                                     <?php endif; ?>
                                </tr>
                            <?php endfor; ?>
                            
                            


                        <?php endforeach; ?>
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
    var tableSelect = document.getElementById(tableID);

    // full HTML for Excel (including meta charset for encoding)
    var tableHTML = `
      <html xmlns:o="urn:schemas-microsoft-com:office:office"
            xmlns:x="urn:schemas-microsoft-com:office:excel"
            xmlns="http://www.w3.org/TR/REC-html40">
      <head>
        <meta charset="UTF-8">
        <!--[if gte mso 9]><xml>
        <x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet>
        <x:Name>Sheet1</x:Name>
        <x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions>
        </x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook>
        </xml><![endif]-->
      </head>
      <body>
        ${tableSelect.outerHTML}
      </body>
      </html>`;

    // Default file name
    filename = filename ? filename + '.xls' : 'excel_data.xls';

    // Create download link
    var downloadLink = document.createElement("a");
    document.body.appendChild(downloadLink);

    if (navigator.msSaveOrOpenBlob) {
        // For IE/Edge
        var blob = new Blob(['\ufeff', tableHTML], { type: 'application/vnd.ms-excel' });
        navigator.msSaveOrOpenBlob(blob, filename);
    } else {
        // For modern browsers
        downloadLink.href = 'data:application/vnd.ms-excel;charset=utf-8,' + encodeURIComponent(tableHTML);
        downloadLink.download = filename;
        downloadLink.click();
    }

    document.body.removeChild(downloadLink);
}
</script>