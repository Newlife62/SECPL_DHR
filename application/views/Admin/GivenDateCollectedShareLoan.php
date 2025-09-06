<div class="row">
    <div class="col-sm-12">
	<input type="button"  class="btn btn-success pull-right" value="Export Excel" onclick="exportexcel('shareloangivendate','shareloangivendate')">
    </div>
</div><br>
<div class="row">
    <div class="col-sm-12">
        
        <table class="table" style="border:solid black 1px;" id="shareloangivendate">
            <thead>
                <tr>
                    	<th colspan="8" style="border:solid black 1px;text-align: center;"><b style="font-size: 20px;">
					ಸರಕಾರಿ ಪ್ರೌಢಶಾಲಾ ಶಿಕ್ಷಕ ನೌಕರರ ಪತ್ತಿನ ಸಹಕಾರಿ ಸಂಘ (ನಿ)ಹಾವೇರಿ
				</b>
                        </th>
                </tr>
                <tr>
                    <th colspan="8">ದಿನಾಂಕ : <?php echo date('d-m-Y',strtotime($givendate));?></th>
                </tr>
                <tr>
                    <th>ಕ್ರಮ ಸಂಖ್ಯೆ</th>
                    <th>ಮೆಂಬರ್ ಹೆಸರು</th>
                    <th>ಶಾಲೆಯ ಹೆಸರು</th>
                    <th>ಸಾಲದ ಮೊತ್ತ</th>
                    <th>ಬಡ್ಡಿ ಮೊತ್ತ</th>
                    <th>ಶೇರು ಮೊತ್ತ</th>
                    <th>Share Interest</th>
                    <th contenteditable="true" id="shareinterest" >0</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php $i=1; foreach($shareloan as $result){ ?>
                <tr>
                    <th><?php echo $i;?></th>
                    <th><?php echo $result['teacher_name'];?></th>
                    <th><?php echo $result['school_name'];?></th>
                    <th><?php echo $result['loan_amount'];?></th>
                    <th><?php echo $result['interest_amount'];?></th>
                    <th id="shareamount<?php echo $i;?>"><?php echo $result['share_amount'];?></th>
                    <th id="shareinterestamount<?php echo $i;?>">0</th>
                    <th id="totalshareinterestamount<?php echo $i;?>">0</th>
                </tr>
                <?php $i++;} ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    $(function(){
            var message_status = $("#status"); //acknowledgement message
            $("th[contenteditable=true]").keyup(function(){
                var field_userid = $(this).attr("id") ;
                var value = parseFloat($(this).text()) ;
                for(var i = 1;i<(<?php echo $i;?>);i++){
                    var shareamount = parseFloat($('#shareamount'+i).text());
                    var shareinterestamount = (shareamount/100)*value;
                    $('#shareinterestamount'+i).text(shareinterestamount.toFixed(2));
                    $('#totalshareinterestamount'+i).text((shareamount+shareinterestamount).toFixed(2));
                }
            });
    });
</script>
