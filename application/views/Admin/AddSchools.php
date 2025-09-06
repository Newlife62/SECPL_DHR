<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i> Company List</h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Company List</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12 col-lg-12" >
           <div class="tile">
            
            <div class="tile-body ">
                
                
                <div class="row">
                    <div class="col-sm-12" >
                        <div class="table-responsive">
                            <table class="table " id="schoolslist">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="all"  title="SELECT ALL"/>#</th>
                                        <th>Company Name</th>
                                        <th>Mobile</th>
                                        <th>City </th>
                                        <th>Taluk</th>
                                        <th>District</th>
                                        <th>State</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
                        </div>
                </div>
                
            </div>
            
        </div>
        </div>
      </div>
     
      
    </main>

<script>
    function addschool(id){
        
         $.ajax({
             type:'post',
             url:baseurl+'AdminController/LoadSchoolForm',
             data:{school_id:id},
             success:function(response){
                 $('#commonmodal .modal-body').empty().html(response);
             }
         });
    }
   
    function addteacher(id,sidd){
        
         $.ajax({
             type:'post',
             url:baseurl+'AdminController/LoadEmployeeForm',
             data:{employee_id:id,company_id:sidd},
             success:function(response){
                 $('#commonmodal .modal-body').empty().html(response);
             }
         });
    }
    
     function deleteschool(id){
       if(confirm("Are you sure to delete the School?")){
       if(id=='delall'){
           var data_to_send = [];
           $("input[name='member_id[]']:checked").each(function(){
                data_to_send.push(this.value);
            });
           
        }else{
           var data_to_send=id;
       }
         
        $.ajax({
             type:'post',
             url:baseurl+'AdminController/DeleteSchool',
             data:{company_id:data_to_send},
             success:function(response){
                table.ajax.reload();
             }
         });
   }
     }
    
   
   
        </script>