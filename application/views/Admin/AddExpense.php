<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i> Expenses</h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Expenses List</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12 col-lg-12" >
        
        <div class="tile">
            
            <div class="tile-body table-responsive">
                
               
                <div class="row">
                    <div class="col-sm-12 " >
                        <div class=""><!--table-responsive-->
                             <table class="table table-border" id="expenselist" width="100%">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="all"  title="SELECT ALL" />#</th>
                                        <th>Date</th>
                                        <th>Amount</th>
                                        <th>Type</th>
                                        <th>Description</th>
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
    function addexpense(id){
        
         $.ajax({
             type:'post',
             url:baseurl+'AdminController/LoadExpenseForm',
             data:{expense_id:id},
             success:function(response){
                 $('.modal-body').html('');
                 $('.modal-body').html(response);
             }
         });
    }
   
   
   
     function deleteexpense(id){
               if(confirm("Are you sure to delete the Expenses?")){
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
                         url:baseurl+'AdminController/DeleteExpense',
                         data:{expense_id:data_to_send},
                         success:function(response){
                             table3.ajax.reload();
                         }
                     });
               }
     }
    
</script>