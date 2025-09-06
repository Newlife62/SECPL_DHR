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
                    <button class="btn btn-success export-btn" onclick="exportTableToExcel('batchTable', 'COA_Report')">Export to Excel </button>
                    <div class="tile-body table-responsive" >
                        <table class="table table-bordered table-striped table-hover table-responsive" id="batchTable" style="width:100%">
                            <thead style="overflow-x:scroll;top:0px;position:sticky;background:#f8f9fa;z-index:1;">
                             <tr>
                                <th>SL no</th>
                                <th>Batch No.</th>
                                <th>DHR No #</th>
                                <th>Approved Qty</th>
                                <th>COA prepared</th>
                                <th>COA Approved</th>
                                <th>Approved Date</th>
                                <th>COA Issued (Yes / No)</th>
                             </tr>
                            </thead>
                            <tbody ><?php $j=1; $coa = NULL; foreach ($coa_details->result_array() as $coa): ?>
                            <tr>
                                <td><?=$j++?></td>
                                <td><?=$coa['lot_or_batch_no']?></td>
                                <td><?=$coa['reference_dhr_no']?></td>
                                <td><?=$coa['released_quantity']?></td>
                                <td><?=$employees[$coa['prepared_by']]?></td>
                                <td><?=$employees[$coa['approved_by']]?></td>
                                <td><?=$coa['approved_by_date']?></td>
                                <td><?=($coa['approved_by_date']=='0000-00-00'||$coa['approved_by_date']==''?'Not Iddued':'Issued')?></td>
                            </tr>
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
