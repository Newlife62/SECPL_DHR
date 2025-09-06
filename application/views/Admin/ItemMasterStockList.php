<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i> Stock List</h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Stock List</a></li>
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
                                        <th>Company</th>
                                        <th>Mobile</th>
                                        <th>City </th>
                                        
                                        <th>Designation</th>
                                        <th>Emp.No.</th>
                                        <th>Share</th>
                                        <th>Loan Balance</th>
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
                                        <th>Company</th>
                                        <th>Mobile</th>
                                        <th>City </th>
                                        <th>Designation</th>
                                        <th>Emp.No.</th>
                                        <th>Share</th>
                                        <th>Loan Balance</th>
                                    </tr>
                                    <?php 
                                    $i=1;
                                    foreach($teacherslist as $teacher){ ?>
                                        <tr>
                                            <th><?=$i++?></th>
                                            <th><?=$teacher['teacher_name']?></th>
                                            <th><?=$teacher['school_name']?></th>
                                            <th><?=$teacher['mobile_number']?></th>
                                            <th><?=$teacher['city']?></th>
                                            <th><?=$teacher['designation']?></th>
                                            <th><?=$teacher['employee_number']?></th>
                                            <th><?=$teacher['share']?></th>
                                            <th><?=$teacher['loan_balance']?></th>

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
    function addteacher(id,sidd){
        
         $.ajax({
             type:'post',
             url:baseurl+'AdminController/LoadTeacherForm',
             data:{teacher_id:id,school_id:sidd},
             success:function(response){
                 $('.modal-body').html('');
                 $('.modal-body').html(response);
             }
         });
    }
    
    function addtoteacherlist(id,sid){
         $.ajax({
             type:'post',
             url:baseurl+'AdminController/AddToTeacherList',
             data:{teacher_id:id,school_id:sid},
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
             data:{teacher_id:teachers_id,school_id:schools_id,selected:selectedl},
             success:function(response){
                 $('.modal-body').html('');
                 $('.modal-body').html(response);
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
             data:{teacher_id:teachers_id,school_id:schools_id,selected:selectedl},
             success:function(response){
                 $('.modal-body').html('');
                 $('.modal-body').html(response);
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
             data:{teacher_id:data_to_send},
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
             data:{teacher_id:data_to_send},
             success:function(response){
                 table2.ajax.reload();
             }
         });
   }
     }
    
   function teacherLoanIssue(teacher_id,school_id){
             $.ajax({
             type:'post',
             url:baseurl+'AdminController/LoadTeacherLoanIssueForm',
             data:{teacher_id:teacher_id,school_id:school_id},
             success:function(response){
                 $('.modal-body').html('');
                 $('.modal-body').html(response)
             }
         });
   }
   
   function returnteacherLoan(teacher_id,school_id){
        $.ajax({
             type:'post',
             url:baseurl+'AdminController/ReturnTeacherLoanForm',
             data:{teacher_id:teacher_id,school_id:school_id},
             success:function(response){
                 $('.modal-body').html('');
                 $('.modal-body').html(response)
             }
         });
    }

   
function returnteacherSavings(teacher_id,school_id){
        $.ajax({
             type:'post',
             url:baseurl+'AdminController/ReturnTeacherSavingsForm',
             data:{teacher_id:teacher_id,school_id:school_id},
             success:function(response){
                 $('.modal-body').html('');
                 $('.modal-body').html(response)
             }
         });
}

function otherfees(teacher_id,school_id,other_id){
    $.ajax({
             type:'post',
             url:baseurl+'AdminController/otherfees',
             data:{teacher_id:teacher_id,school_id:school_id,other_id:other_id},
             success:function(response){
                 $('.modal-body').html('');
                 $('.modal-body').html(response)
             }
         });
}
        </script>