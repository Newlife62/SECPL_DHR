<div class="row">
    <div class="col-sm-12 " >
        <div class=""><!--table-responsive-->
             <table class="table table-border" id="departmentslist" width="100%">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="all"  title="SELECT ALL" />#</th>
                        <th width="20%">Department Name</th>
                        <th>Designations</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
        </div>
        </div>
</div>
<script>
var departmentslist;
$(document).ready(function(){
    departmentslist = $('#departmentslist').DataTable({
         "iDisplayLength":10,
         "serverSide":true,
         "order":[],
         "ajax":{
             "type":"POST",
             "url":baseurl+'DataTableContoller/departmentslist/departments',
             "data":function(data){
                 data.school_id=$('#school_id').val();
                 data.teachers_type=$('#teachers_type').val();
             },
             "fnRowCallback":function(nRow,aData,iDisplayIndex,iDisplayIndexFull){
                 
             }
         },
         "searching":true,
         "columnDefs":[{
             "targets":[0,3],
             "orderable":false
         }],
         "lengthMenu": [[10, 25, 100,500, -1], [10, 25, 100,500, "All"]]
    });
    
});    
</script>