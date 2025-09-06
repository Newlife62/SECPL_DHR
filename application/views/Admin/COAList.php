<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-list"></i> COA List</h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">COA List</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12 col-lg-12" >
        
            <div class="tile">
                
                <div class="tile-body table-responsive">
                    <div class="row">
                        <div class="col-sm-12 " >
                            <div class=""><!--table-responsive-->
                                 <table class="table table-border" id="coalist" width="100%">
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" id="all"  title="SELECT ALL" />#</th>
                                            <th width="20%">Product Description</th>
                                            <th width="20%">Batch/Lot #</th>
                                            <th width="10%">Prepared Date</th>
                                            <th width="10%">Approved Date</th>
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
             url:baseurl+'AdminController/LoadCOAForm',
             data:{coa_id:id},
             success:function(response){
                 $('#commonmodal .modal-body').empty().html(response);
             }
         });
    }
    
    function deletedhr(id){
       if(confirm("Warning: If you delete this COA it's details will erased from the system PERMANENTLY. Please make sure to delete this COA?")){
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
                 url:baseurl+'AdminController/DeleteCOA',
                 data:{coa_id:data_to_send},
                 success:function(response){
                     coadetails.ajax.reload();
                 }
            });
        }
    }
     
    function removedhr(id,status){
        if(confirm("Warning: If you "+(status==0?'Remove':'Add')+" this COA it's corresponding details will "+(status==0?'removing':'adding')+" to "+(status==0?'removed':'present')+" list. Please make sure to "+(status==0?'remove':'add')+" this COA?")){
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
                 url:baseurl+'AdminController/RemoveCOA',
                 data:{coa_id:data_to_send,status:status},
                 success:function(response){
                     coadetails.ajax.reload();
                 }
             });
        }
    }
    
    
</script>