<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-list"></i> Stage-4 Device History Record List</h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Stage-4 DHR List</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12 col-lg-12" >
        
        <div class="tile">
            
            <div class="tile-body table-responsive">
                <div class="row">
                    <div class="col-sm-12 " >
                        <div class=""><!--table-responsive-->
                             <table class="table table-border" id="orderslist" width="100%">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="all"  title="SELECT ALL" />#</th>
                                        <th width="20%">DHR</th>
                                        <th width="20%">Batch/Lot #</th>
                                        <th width="10%">Sales Order</th>
                                        <th width="20%">Production Order</th>
                                        <th width="20%">Product Description</th>
                                        <th width="10%">Manufacturing Date</th>
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
    function adddhrecords(id){
         $.ajax({
             type:'post',
             url:baseurl+'AdminController/LoadStageFourForm',
             data:{dhr_id:id},
             success:function(response){
                 $('#commonmodal .modal-body').empty().html(response);
             }
         });
    }
    
    function deletedhr(id){
       if(confirm("Warning: If you delete this DHR it's details will erased from the system PERMANENTLY. Please make sure to delete this DHR?")){
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
                 url:baseurl+'AdminController/DeleteDHR',
                 data:{dhr_id:data_to_send},
                 success:function(response){
                     ordertable.ajax.reload();
                 }
            });
        }
    }
     
    function removedhr(id){
        if(confirm("Warning: If you Remove this DHR it's corresponding details will removed from this list. Please make sure to remove this DHR?")){
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
                 url:baseurl+'AdminController/RemoveDHR',
                 data:{dhr_id:data_to_send},
                 success:function(response){
                     ordertable.ajax.reload();
                 }
             });
        }
    }
    
</script>