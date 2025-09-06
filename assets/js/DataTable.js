var table;
var table2;
var table3;
var table4;
var table5;
var ordertable;
var coadetails;

$(document).ready(function(){
     table = $('#schoolslist').DataTable({
         "iDisplayLength":10,
         "serverSide":true,
         "order":[],
         "ajax":{
             "type":"POST",
             "url":baseurl+'DataTableContoller/schoolslist/companys_detail',
             "data":function(data){
                 data.dates=$('#dates').val();
             },
             "fnRowCallback":function(nRow,aData,iDisplayIndex,iDisplayIndexFull){
                 
             }
         },
         "searching":true,
         "columnDefs":[{
             "targets":[0,7],
             "orderable":false
         }],
         "lengthMenu": [[10, 25, 100,500, -1], [10, 25, 100,500, "All"]]
     });
         
        
         
     table2 = $('#teacherslist').DataTable({
         "iDisplayLength":10,
         "serverSide":true,
         "order":[],
         "ajax":{
             "type":"POST",
             "url":baseurl+'DataTableContoller/teacherslist/employees',
             "data":function(data){
                 data.school_id=$('#school_id').val();
                 data.teachers_type=$('#teachers_type').val();
             },
             "fnRowCallback":function(nRow,aData,iDisplayIndex,iDisplayIndexFull){
                 
             }
         },
         "searching":true,
         "columnDefs":[{
             "targets":[0,7],
             "orderable":false
         }],
         "lengthMenu": [[10, 25, 100,500, -1], [10, 25, 100,500, "All"]]
     });
         
         $('#school_id').change(function(){
             table2.ajax.reload();
         }).change();

          

     table3 = $('#expenselist').DataTable({
         "iDisplayLength":10,
         "serverSide":true,
         "order":[],
         "ajax":{
             "type":"POST",
             "url":baseurl+'DataTableContoller/expenseslist/expense_detail',
             "data":function(data){
                 data.school_id=$('#school_id').val();
             },
             "fnRowCallback":function(nRow,aData,iDisplayIndex,iDisplayIndexFull){
                 
             }
         },
         "searching":true,
         "columnDefs":[{
             "targets":[0,5],
             "orderable":false
         }],
         "lengthMenu": [[10, 25, 100,500, -1], [10, 25, 100,500, "All"]]
     });
         
     ordertable =  $('#orderslist').DataTable({
         "iDisplayLength":10,
         "serverSide":true,
         "order":[],
         "ajax":{
             "type":"POST",
             "url":baseurl+'DataTableContoller/orderslist/stage_one_dhr_order_information',
             "data":function(data){
                 var pathsegment = window.location.pathname.split('/');
                  data.dhr_type=$('#dhr_type').val();
                  data.stage=pathsegment[2];
             },
             "fnRowCallback":function(nRow,aData,iDisplayIndex,iDisplayIndexFull){
                 
             }
         },
         "searching":true,
         "columnDefs":[{
             "targets":[0,6],
             "orderable":false
         }],
         "lengthMenu": [[10, 25, 100,500, -1], [10, 25, 100,500, "All"]]
    });
     
    coadetails =  $('#coalist').DataTable({
         "iDisplayLength":10,
         "serverSide":true,
         "order":[],
         "ajax":{
             "type":"POST",
             "url":baseurl+'DataTableContoller/coalist/coa_details',
             "data":function(data){
                 var pathsegment = window.location.pathname.split('/');
                  data.coa_type=$('#coa_type').val();
                  data.stage=pathsegment[2];
             },
             "fnRowCallback":function(nRow,aData,iDisplayIndex,iDisplayIndexFull){
                 
             }
         },
         "searching":true,
         "columnDefs":[{
             "targets":[0,5],
             "orderable":false
         }],
         "lengthMenu": [[10, 25, 100,500, -1], [10, 25, 100,500, "All"]]
    });
         
 });