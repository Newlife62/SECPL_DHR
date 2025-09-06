<div class="row">
    <div class="col-sm-6">
        <select id="user_id" class="form-control">
            <option value="">Select User</option>
            <?php foreach($employees->result_array() as $user){ ?>
            <option value="<?=$user['id']?>" <?=$user['id']==$employee_id?'selected':''?>><?=$user['employee_name'].'-'.$user['dept_name']?></option>
            <?php } ?>
        </select>
    </div>
    <div class="col-sm-6">
        <select id="stage" class="form-control">
            <option value="">Select stage</option>
            <option value="Stage_1">Stage-1</option>
            <option value="Stage_2">Stage-2</option>
            <option value="Stage_3">Stage-3</option>
            <option value="Stage_4">Stage-4</option>
        </select>
    </div>
</div>
<br>
<div class="row">
    <div class="col-sm-12">
        <div id="stage_privilages_content"></div>
    </div>
</div>
<script>
    $('#stage').change(function(){
        $.ajax({
            type:'post',
            url:"<?=base_url('AdminController/GetStagePrivilage')?>",
            data:{user_id:$('#user_id').val(),stage:$('#stage').val()},
            success:function(response){
                $('#stage_privilages_content').html(response);
            }
        });
    });
</script>