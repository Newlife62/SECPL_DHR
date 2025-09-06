<?php foreach($department_details->result_array() as $department); ?>
<div class="row">
    <div class="col-md-12 col-lg-12">
        <form id="department" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <input type="hidden" name="dept_id" value="<?=$department['dept_id']?>" class="form-control">
                    <label>Department Name:</label>
                    <input type="text" name="dept_name" value="<?=$department['dept_name']?>" class="form-control">
                </div>
                
                <div class="col-md-12 col-lg-12"><br>
                    <label>Positions : <button type="button" class="btn-xs btn-success " onclick="addpositionrow()"><i class="fa fa-plus"> New Pisition</i></button></label>
                    <table class="table" id="positions">
                    <?php foreach($department_details->result_array() as $department){ ?>
                        <tr>
                            <th><input type="hidden"  value="<?=$department['pos_id']?>" name="pos_id[]" class="form-control">
                                <input type="text"  value="<?=$department['pos_name']?>" name="pos_name[]" class="form-control"></th>
                            <!--<th><button class="btn btn-xs btn-danger" onclick="deleterow(this)"><i class="fa fa-trash"></button></th>-->
                        </tr>
                    <?php } ?>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <center><button type="submit" class="btn btn-xs btn-success">SAVE</button></center>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    $('#department').submit(function(e){
        e.preventDefault();
        if(confirm('Are you want to save department details?')){
         $.ajax({
             type:'post',
             url:'<?=base_url("AdminController/SaveUpdateDepartment")?>',
             data:new FormData(this),
             processData:false,
             contentType:false,
             success:function(){
                 alert('Saved Successfully.');
                 departmentslist.ajax.reload();
                 table2.ajax.reload();
                  $('.second-close').click();
             }
         });
        }
    });
    
    function addpositionrow(){
        var np = '<tr>'+
                    '<th><input type="hidden" name="pos_id[]" class="form-control">'+
                    '<input type="text" name="pos_name[]" class="form-control"></th>'+
                  '</tr>';
        $('#positions').append(np);
    }
</script>