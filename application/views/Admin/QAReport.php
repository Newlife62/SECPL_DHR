<style>
    /* Professional QA Report Styles */
    .qa-report-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    
    .qa-report-header h1 {
        margin: 0;
        font-size: 1.8rem;
        font-weight: 600;
    }
    
    .qa-report-header p {
        margin: 0.5rem 0 0 0;
        opacity: 0.9;
    }
    
    .report-controls {
        background: white;
        padding: 1.5rem;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        margin-bottom: 1.5rem;
    }
    
    .export-controls {
        display: flex;
        gap: 10px;
        align-items: center;
        flex-wrap: wrap;
    }
    
    .btn-export {
        background: linear-gradient(135deg, #28a745, #20c997);
        border: none;
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 6px;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    
    .btn-export:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(40, 167, 69, 0.3);
        color: white;
    }
    
    .btn-refresh {
        background: linear-gradient(135deg, #007bff, #6610f2);
        border: none;
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 6px;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    
    .btn-refresh:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 123, 255, 0.3);
        color: white;
    }
    
    .table-container {
        background: white;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        overflow: hidden;
    }
    
    .table-header {
        background: #f8f9fa;
        padding: 1rem 1.5rem;
        border-bottom: 1px solid #dee2e6;
    }
    
    .table-header h5 {
        margin: 0;
        color: #495057;
        font-weight: 600;
    }
    
    #qaReportTable {
        width: 100% !important;
        border-collapse: collapse;
    }
    
    #qaReportTable thead th {
        background: linear-gradient(135deg, #f8f9fa, #e9ecef);
        color: #495057;
        font-weight: 600;
        padding: 12px 8px;
        border: 1px solid #dee2e6;
        position: sticky;
        top: 0;
        z-index: 10;
        font-size: 0.85rem;
        text-align: center;
        white-space: nowrap;
    }
    
    #qaReportTable tbody td {
        padding: 10px 8px;
        border: 1px solid #dee2e6;
        font-size: 0.8rem;
        vertical-align: middle;
        max-width: 150px;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    
    #qaReportTable tbody tr:hover {
        background-color: #f8f9fa;
    }
    
    #qaReportTable tbody tr:nth-child(even) {
        background-color: #fbfbfb;
    }
    
    /* Stage badges */
    .stage-badge {
        display: inline-block;
        padding: 0.25rem 0.5rem;
        border-radius: 12px;
        font-size: 0.75rem;
        font-weight: 600;
        text-align: center;
        min-width: 60px;
    }
    
    .stage-1 { background: linear-gradient(135deg, #4facfe, #00f2fe); color: white; }
    .stage-2 { background: linear-gradient(135deg, #43e97b, #38f9d7); color: white; }
    .stage-3 { background: linear-gradient(135deg, #fa709a, #fee140); color: white; }
    .stage-4 { background: linear-gradient(135deg, #a8edea, #fed6e3); color: #333; }
    
    /* Status indicators */
    .status-pass {
        color: #28a745;
        font-weight: 600;
    }
    
    .status-fail {
        color: #dc3545;
        font-weight: 600;
    }
    
    .status-pending {
        color: #ffc107;
        font-weight: 600;
    }
    
    /* DataTable custom styling */
    .dataTables_wrapper .dataTables_length select,
    .dataTables_wrapper .dataTables_filter input {
        border: 1px solid #ced4da;
        border-radius: 6px;
        padding: 0.375rem 0.75rem;
    }
    
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        border-radius: 6px !important;
        margin: 0 2px;
    }
    
    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: linear-gradient(135deg, #667eea, #764ba2) !important;
        border-color: #667eea !important;
        color: white !important;
    }
    
    .dataTables_wrapper .dataTables_info {
        color: #6c757d;
        font-weight: 500;
    }
    
    /* Loading indicator */
    .dataTables_processing {
        background: rgba(255, 255, 255, 0.9) !important;
        border: 1px solid #dee2e6 !important;
        border-radius: 6px !important;
        color: #495057 !important;
        font-weight: 600 !important;
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        .export-controls {
            justify-content: center;
        }
        
        .qa-report-header h1 {
            font-size: 1.5rem;
        }
        
        #qaReportTable {
            font-size: 0.75rem;
        }
        
        #qaReportTable thead th,
        #qaReportTable tbody td {
            padding: 8px 4px;
        }
    }
    
    /* Tooltip styles */
    .tooltip-content {
        max-width: 300px;
        font-size: 0.8rem;
        line-height: 1.4;
    }
    
    /* Process details styling */
    .process-details {
        max-width: 200px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        cursor: pointer;
    }
    
    .process-details:hover {
        background: #e9ecef;
        border-radius: 4px;
        padding: 2px 4px;
    }
</style>

<main class="app-content">
    <!-- Enhanced Header -->
    <div class="qa-report-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1><i class="fa fa-bar-chart"></i> QA Report Dashboard</h1>
                <p>Comprehensive Quality Assurance reporting and analytics</p>
            </div>
            <div class="d-none d-md-block">
                <i class="fa fa-clipboard-list" style="font-size: 3rem; opacity: 0.3;"></i>
            </div>
        </div>
    </div>

    <!-- Report Controls -->
    <div class="report-controls">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="fa fa-cogs"></i> Report Controls</h5>
            <div class="export-controls">
                <button class="btn btn-export" onclick="exportToExcel()">
                    <i class="fa fa-file-excel-o"></i> Export Excel
                </button>
                <button class="btn btn-export" onclick="exportToPDF()">
                    <i class="fa fa-file-pdf-o"></i> Export PDF
                </button>
                <button class="btn btn-refresh" onclick="refreshTable()">
                    <i class="fa fa-refresh"></i> Refresh
                </button>
            </div>
        </div>
    </div>

    <!-- Data Table Container -->
    <div class="table-container">
        <div class="table-header">
            <h5><i class="fa fa-table"></i> QA Report Data</h5>
        </div>
        <div class="table-responsive p-3">
            <table id="qaReportTable" class="table table-striped table-bordered nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>SL No</th>
                        <th>Stage</th>
                        <th>DHR Number</th>
                        <th>DHR Issued Date</th>
                        <th>Batch No.</th>
                        <th>DHR Received Date</th>
                        <th>Batch Commencement</th>
                        <th>Batch Completion</th>
                        <th>Item Code</th>
                        <th>Product Description</th>
                        <th>Mfg Date</th>
                        <th>Exp Date</th>
                        <th>Input Batch No.</th>
                        <th>Order Qty</th>
                        <th>Production Qty</th>
                        <th>Manufacturing Process</th>
                        <th>Good Qty</th>
                        <th>Rejected Qty</th>
                        <th>Production Verified</th>
                        <th>QC Clearance Status</th>
                        <th>QC Process</th>
                        <th>QC Verification By</th>
                        <th>QC Status</th>
                        <th>FG Transferred Qty</th>
                        <th>Control Samples</th>
                        <th>% Yield</th>
                        <th>Production Head Verified</th>
                        <th>QC Head Clearance</th>
                        <th>QA Released Qty</th>
                        <th>QA Approved</th>
                        <th>Date of Release</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</main>

<script>
$(document).ready(function() {
    // Initialize DataTable with server-side processing
    var table = $('#qaReportTable').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "<?php echo base_url('AdminController/QAReportData'); ?>",
            "type": "POST",
            "data": function(d) {
                // Add any additional parameters here if needed
                return $.extend({}, d, {
                    // custom parameters can be added here
                });
            },
            "error": function(xhr, error, thrown) {
                console.error('DataTable Ajax Error:', error);
                alert('Error loading data. Please refresh the page.');
            }
        },
        "columns": [
            { 
                "data": null,
                "render": function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                },
                "orderable": false,
                "searchable": false,
                "width": "50px"
            },
            { 
                "data": "stage",
                "render": function(data, type, row) {
                    if (type === 'display' && data) {
                        return '<span class="stage-badge stage-' + data + '">Stage ' + data + '</span>';
                    }
                    return data || 'N/A';
                },
                "width": "80px"
            },
            { "data": "dhr_number", "width": "100px" },
            { "data": "dhr_issued_date_qa", "width": "100px" },
            { "data": "batch_number", "width": "100px" },
            { "data": "dhr_received_date_production", "width": "100px" },
            { "data": "date_of_batch_commencement", "width": "100px" },
            { "data": "date_of_completion", "width": "100px" },
            { "data": "item_code", "width": "80px" },
            { 
                "data": "product_description", 
                "width": "150px",
                "render": function(data, type, row) {
                    if (type === 'display' && data && data.length > 30) {
                        return '<span title="' + data + '">' + data.substring(0, 30) + '...</span>';
                    }
                    return data || 'N/A';
                }
            },
            { "data": "manufactured_date", "width": "90px" },
            { "data": "expiry_date", "width": "90px" },
            { 
                "data": "input_batch_number", 
                "width": "120px",
                "render": function(data, type, row) {
                    if (type === 'display' && data && data.length > 20) {
                        return '<span title="' + data + '">' + data.substring(0, 20) + '...</span>';
                    }
                    return data || 'N/A';
                }
            },
            { "data": "ordered_quantity", "width": "80px" },
            { "data": "production_quantity", "width": "80px" },
            { 
                "data": "manufacturing_processes", 
                "width": "150px",
                "render": function(data, type, row) {
                    if (type === 'display' && data) {
                        var processes = data.split(' | ');
                        var processCount = processes.length;
                        var displayText = processes[0];
                        if (displayText && displayText.length > 30) {
                            displayText = displayText.substring(0, 30) + '...';
                        }
                        if (processCount > 1) {
                            displayText += ' (+' + (processCount - 1) + ' more)';
                        }
                        return '<span class="process-details" title="' + data + '">' + displayText + '</span>';
                    }
                    return data || 'N/A';
                }
            },
            { "data": null, "width": "80px", "defaultContent": "N/A" }, // Good Qty - will be extracted from manufacturing_processes
            { "data": null, "width": "80px", "defaultContent": "N/A" }, // Rejected Qty - will be extracted from manufacturing_processes
            { "data": "production_head_verified", "width": "100px" },
            { "data": "qc_head_clearance", "width": "100px" },
            { 
                "data": "quality_control_processes", 
                "width": "150px",
                "render": function(data, type, row) {
                    if (type === 'display' && data) {
                        var processes = data.split(' | ');
                        var processCount = processes.length;
                        var displayText = processes[0];
                        if (displayText && displayText.length > 30) {
                            displayText = displayText.substring(0, 30) + '...';
                        }
                        if (processCount > 1) {
                            displayText += ' (+' + (processCount - 1) + ' more)';
                        }
                        return '<span class="process-details" title="' + data + '">' + displayText + '</span>';
                    }
                    return data || 'N/A';
                }
            },
            { "data": null, "width": "100px", "defaultContent": "N/A" }, // QC Verification By - will be extracted from quality_control_processes
            { "data": null, "width": "80px", "defaultContent": "N/A" }, // QC Status - will be extracted from quality_control_processes
            { "data": "transferred_quantity", "width": "80px" },
            { "data": "archive_samples_quantity", "width": "80px" },
            { 
                "data": "yield_percentage", 
                "width": "80px",
                "render": function(data, type, row) {
                    if (type === 'display' && data) {
                        return data + '%';
                    }
                    return data || 'N/A';
                }
            },
            { "data": "production_head_verified", "width": "100px" },
            { "data": "qc_head_clearance", "width": "100px" },
            { "data": "quantity_released_for_dispatch", "width": "80px" },
            { "data": "signature", "width": "100px" },
            { "data": "date_of_release", "width": "100px" }
        ],
        "order": [[2, "desc"]], // Order by DHR Number descending
        "pageLength": 25,
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        "scrollX": true,
        "scrollY": "500px",
        "scrollCollapse": true,
        "fixedColumns": {
            leftColumns: 3
        },
        "language": {
            "processing": '<i class="fa fa-spinner fa-spin"></i> Loading QA Report Data...',
            "lengthMenu": "Show _MENU_ records per page",
            "zeroRecords": "No QA records found",
            "info": "Showing _START_ to _END_ of _TOTAL_ records",
            "infoEmpty": "No records available",
            "infoFiltered": "(filtered from _MAX_ total records)",
            "search": "Search QA Records:",
            "paginate": {
                "first": "First",
                "last": "Last",
                "next": "Next",
                "previous": "Previous"
            }
        },
        "dom": '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>' +
               '<"row"<"col-sm-12"tr>>' +
               '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
        "responsive": true,
        "autoWidth": false
    });

    // Refresh table function
    window.refreshTable = function() {
        table.ajax.reload(null, false);
        showNotification('Table refreshed successfully!', 'success');
    };

    // Export to Excel function
    window.exportToExcel = function() {
        // Get all data for export
        $.ajax({
            url: "<?php echo base_url('AdminController/QAReportData'); ?>",
            type: "POST",
            data: {
                draw: 1,
                start: 0,
                length: -1, // Get all records
                search: { value: "" }
            },
            success: function(response) {
                exportTableToExcel(response.data, 'QA_Report');
            },
            error: function() {
                alert('Error exporting data. Please try again.');
            }
        });
    };

    // Export to PDF function
    window.exportToPDF = function() {
        showNotification('PDF export feature will be implemented soon!', 'info');
    };

    // Enhanced Excel export function
    function exportTableToExcel(data, filename) {
        var csv = '';
        
        // Add headers
        var headers = [
            'SL No', 'Stage', 'DHR Number', 'DHR Issued Date', 'Batch No.', 
            'DHR Received Date', 'Batch Commencement', 'Batch Completion', 
            'Item Code', 'Product Description', 'Mfg Date', 'Exp Date', 
            'Input Batch No.', 'Order Qty', 'Production Qty', 'Manufacturing Process',
            'Good Qty', 'Rejected Qty', 'Production Verified', 'QC Clearance Status',
            'QC Process', 'QC Verification By', 'QC Status', 'FG Transferred Qty',
            'Control Samples', '% Yield', 'Production Head Verified', 'QC Head Clearance',
            'QA Released Qty', 'QA Approved', 'Date of Release'
        ];
        csv += headers.join(',') + '\n';
        
        // Add data rows
        data.forEach(function(row, index) {
            var csvRow = [
                index + 1,
                row.stage || '',
                row.dhr_number || '',
                row.dhr_issued_date_qa || '',
                row.batch_number || '',
                row.dhr_received_date_production || '',
                row.date_of_batch_commencement || '',
                row.date_of_completion || '',
                row.item_code || '',
                '"' + (row.product_description || '').replace(/"/g, '""') + '"',
                row.manufactured_date || '',
                row.expiry_date || '',
                '"' + (row.input_batch_number || '').replace(/"/g, '""') + '"',
                row.ordered_quantity || '',
                row.production_quantity || '',
                '"' + (row.manufacturing_processes || '').replace(/"/g, '""') + '"',
                '', // Good Qty - would need to be extracted
                '', // Rejected Qty - would need to be extracted
                row.production_head_verified || '',
                row.qc_head_clearance || '',
                '"' + (row.quality_control_processes || '').replace(/"/g, '""') + '"',
                '', // QC Verification By - would need to be extracted
                '', // QC Status - would need to be extracted
                row.transferred_quantity || '',
                row.archive_samples_quantity || '',
                row.yield_percentage || '',
                row.production_head_verified || '',
                row.qc_head_clearance || '',
                row.quantity_released_for_dispatch || '',
                row.signature || '',
                row.date_of_release || ''
            ];
            csv += csvRow.join(',') + '\n';
        });
        
        // Create and download file
        var blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
        var link = document.createElement('a');
        var url = URL.createObjectURL(blob);
        link.setAttribute('href', url);
        link.setAttribute('download', filename + '_' + new Date().toISOString().slice(0,10) + '.csv');
        link.style.visibility = 'hidden';
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
        
        showNotification('Excel file exported successfully!', 'success');
    }

    // Notification function
    function showNotification(message, type) {
        var alertClass = 'alert-' + (type === 'success' ? 'success' : type === 'error' ? 'danger' : 'info');
        var notification = $('<div class="alert ' + alertClass + ' alert-dismissible fade show" role="alert">' +
            message +
            '<button type="button" class="close" data-dismiss="alert">' +
            '<span>&times;</span></button></div>');
        
        $('.app-content').prepend(notification);
        
        setTimeout(function() {
            notification.alert('close');
        }, 3000);
    }
});
</script>