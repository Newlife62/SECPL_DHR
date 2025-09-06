<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i> Employees List</h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Employees List</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12 col-lg-12" >
        
        <div class="tile">
            
            <div class="tile-body table-responsive">
                <div class="row">
                    <div class="col-sm-12 " >
                        <div class=""><!--table-responsive-->
                             <table class="table table-border" id="teacherslist" width="100%">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="all"  title="SELECT ALL" />#</th>
                                        <th width="20%">Employee Name</th>
                                        <th>Department</th>
                                        <th>Position(Designation)</th>
                                        <th>Mobile</th>
                                        <th>City </th>
                                        <th>Emp.No.</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
                        </div>
                </div>
                <div class="row" hidden>
                    <div class="col-sm-12 " >
                        <div class=""><!--table-responsive-->
                             <table class="table table-border" id="teacherslistproper" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th width="20%">Employee Name</th>
                                        <th>Department</th>
                                        <th>Mobile</th>
                                        <th>City </th>
                                        <th>Position(Designation)</th>
                                        <th>Emp.No.</th>
                                    </tr>
                                    <?php 
                                    $i=1;
                                    foreach($employeeslist as $employee){ ?>
                                        <tr>
                                            <th><?=$i++?></th>
                                            <th><?=$employee['employee_name']?></th>
                                            <th><?=$employee['dept_name']?></th>
                                            <th><?=$employee['mobile_number']?></th>
                                            <th><?=$employee['city']?></th>
                                            <th><?=$employee['designation']?></th>
                                            <th><?=$employee['employee_number']?></th>
                                        </tr>
                                    <?php 
                                    }
                                    ?>
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
    function departmentlist(){
        $.ajax({
             type:'post',
             url:baseurl+'AdminController/LoadDepartmentList',
             data:{},
             success:function(response){
                 $('#commonmodal .modal-body').empty().html(response);
             }
        });
    }
    
    function adddepartment(dept_id,title){ 
        $.ajax({
             type:'post',
             url:baseurl+'AdminController/LoadDepartmentForm',
             data:{dept_id:dept_id},
             success:function(response){
                 $('.second-modal-title').text(title);
                 $('.second-modal-body').html('');
                 $('.second-modal-body').html(response);
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
    
    function setprivilage(id,sidd){
        $.ajax({
             type:'post',
             url:baseurl+'AdminController/LoadPrivilageForm',
             data:{employee_id:id,company_id:sidd},
             success:function(response){
                 $('#commonmodal .modal-body').empty().html(response);
             }
         });
    }
    
    function addtoteacherlist(id,sid){
         $.ajax({
             type:'post',
             url:baseurl+'AdminController/AddToEmployeeList',
             data:{employee_id:id,school_id:sid},
             success:function(response){
                 table2.ajax.reload();
                 alert('Added to main list.');
             }
         });
    }
   
   function teacherSavings(teachers_id,schools_id){
    if(teachers_id!='selected'){
        var a = document.getElementsByName('member_id[]');
        for(var i=0;i<a.length;i++){
                if(a[i].checked){
                  a[i].checked=false;    
                }
        }
    }
    var a = document.getElementsByName('member_id[]');
    var selectedl = [];
    for(var i=0;i<a.length;i++){
            if(a[i].checked){
                  selectedl.push(a[i].value);  
            }
    }
    

    if((teachers_id=='selected') && (selectedl.length==0)){
        $('.modal-body').html('Please select the teachers you want to collect SHARES from.');
        exit;
    }

    if(selectedl.length==0){
        selectedl.push(0);
    }

       $.ajax({
             type:'post',
             url:baseurl+'AdminController/LoadSharecollectionForm',
             data:{employee_id:teachers_id,school_id:schools_id,selected:selectedl},
             success:function(response){
                $('#commonmodal .modal-body').empty().html(response);
             }
         });
    }
   
   function teacherLoan(teachers_id,schools_id){
    if(teachers_id!='selected'){
        var a = document.getElementsByName('member_id[]');
        for(var i=0;i<a.length;i++){
                if(a[i].checked){
                  a[i].checked=false;    
                }
        }
    }
    var a = document.getElementsByName('member_id[]');
    var selectedl = [];
    for(var i=0;i<a.length;i++){
            if(a[i].checked){
                  selectedl.push(a[i].value);  
            }
    }
    

    if((teachers_id=='selected') && (selectedl.length==0)){
        $('.modal-body').html('Please select the teachers you want to collect LOAN from.');
        exit;
    }

    if(selectedl.length==0){
        selectedl.push(0);
    }
       $.ajax({
             type:'post',
             url:baseurl+'AdminController/LoadLoancollectionForm',
             data:{employee_id:teachers_id,school_id:schools_id,selected:selectedl},
             success:function(response){
                 $('#commonmodal .modal-body').empty().html(response);
             }
         });
    
   }
   
     function deleteteacher(id){
       if(confirm("Warning: If you delete this teacher their share amount details and loan details will erased from the system PERMANENTLY. Please make sure to delete this teacher?")){
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
             url:baseurl+'AdminController/DeleteTeacher',
             data:{employee_id:data_to_send},
             success:function(response){
                 table2.ajax.reload();
             }
         });
   }
     }
     
     
     
     function removeteacher(id){
       if(confirm("Warning: If you Remove this teacher their share amount details and loan details will remain as it is. Please make sure to remove this teacher?")){
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
             url:baseurl+'AdminController/RemoveTeacher',
             data:{employee_id:data_to_send},
             success:function(response){
                 table2.ajax.reload();
             }
         });
   }
     }
    
   function teacherLoanIssue(employee_id,school_id){
             $.ajax({
             type:'post',
             url:baseurl+'AdminController/LoadTeacherLoanIssueForm',
             data:{employee_id:employee_id,school_id:school_id},
             success:function(response){
                 $('#commonmodal .modal-body').empty().html(response);
             }
         });
   }
   
   function returnteacherLoan(employee_id,school_id){
        $.ajax({
             type:'post',
             url:baseurl+'AdminController/ReturnTeacherLoanForm',
             data:{employee_id:employee_id,school_id:school_id},
             success:function(response){
                 $('#commonmodal .modal-body').empty().html(response);
             }
         });
    }

   
function returnteacherSavings(employee_id,school_id){
        $.ajax({
             type:'post',
             url:baseurl+'AdminController/ReturnTeacherSavingsForm',
             data:{employee_id:employee_id,school_id:school_id},
             success:function(response){
                $('#commonmodal .modal-body').empty().html(response);
             }
         });
}

function otherfees(employee_id,school_id,other_id){
    $.ajax({
             type:'post',
             url:baseurl+'AdminController/otherfees',
             data:{employee_id:employee_id,school_id:school_id,other_id:other_id},
             success:function(response){
                $('#commonmodal .modal-body').empty().html(response);
             }
         });
}
        </script>