<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-list"></i> BOM Items Upload</h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">BOM Items Upload</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12 col-lg-12" >
        
        <div class="tile">
            
            <div class="tile-body table-responsive">
                <div class="row">
                    <div class="col-sm-12 " >
                     Note: The upload .csv file columns in this order   should be in 
                     <br>
                    <?php   unset($fields[0]);
                            $fields = array_values($fields);
                            for($i=0;$i<count($fields);$i++){
                                $data[]= (chr(65+$i)).' : '. $fields[$i];
                            }
                            echo implode(', ',$data);
                            
                    ?>
                    </div>
                </div>
                 <div class="row">
                    <div class="col-sm-12 " >
                        <form class="form" id="bomupload" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                            <input type="file" accept=".csv" name="bom_file" class="form-control">
                            <button type="submit" class="btn btn-xs btn-primary">UPLOAD</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 " >
                        <div id="responsediv"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
     $('#bomupload').submit(function(e){
        e.preventDefault();
        if(confirm('Are you want to upload this BOM items?')){ 
            $.ajax({
                type:'post',
                url:'<?=base_url("AdminController/UploadBomDetails")?>',
                data:new FormData(this),
                processData:false,
                contentType:false,
                success:function(response){
                    if(response){
                        $('#responsediv').html('');
                        $('#responsediv').html(response);
                    }
                }
            });
        }
     });
 });
     
</script>