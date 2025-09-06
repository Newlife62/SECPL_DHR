<?php
if(count($teachersshareloanlist[0])>0){
	foreach($teachersshareloanlist[0] as $teacherdetail);
}else{
	$teacherdetail=NULL;
}
?>
<style>
	.numberclass{
		text-align: right;
		border:solid black 2px;
	}
	.headerclass{
		text-align: center;
		border:solid black 2px;
	}
	.teacherclass{
		text-align: left;
		border:solid black 2px;
	}
</style>
<div class="row">
    <div class="col-sm-12">
            <div class="bs-component">
              <ul class="nav nav-tabs">
                <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#everystaff">Every Staff</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#overall">Overall Collected</a></li>
              </ul>
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade active show" id="everystaff">
                    <div class="row">
                        <div class="col-sm-1"></div>
                        <div class="col-sm-4">
                            <label>Month:</label>
                            <input type="month" class="form-control" name="payable_moth_year" id="payable_moth_year">
                        </div>
                        
                        <div class="col-sm-2"></div>
                        
                        <div class="col-sm-2">
            				<input type="button" class="btn btn-success" value="Export Excel" onclick="exportexcel('School_Book','schoolamount');" style="width:100%">
            			</div>
                        <div class="col-sm-2">
                        	<input type="button" class="btn btn-success" value="Print" onclick="printspecifiedDiv('schoolloansharepdf');" style="width:100%">
                        </div>
                    </div>
                    <br>
                    <!-------------------------------------------------LOAN & SHARE DETAILS-------------------------------------->
                    
                    <div class="row">
                    <div class="col-sm-12" id="schoolloansharepdf">
                    	<center>
                    	<table  style="padding:0px;border:solid black 2px;overflow-y:scroll;" id="schoolamount">
                    		<thead>
                    			<tr>
                    				<th colspan="6">
                    					<b style="font-size: 20px;">
                    					ಸರಕಾರಿ ಪ್ರೌಢಶಾಲಾ ಶಿಕ್ಷಕ ನೌಕರರ ಪತ್ತಿನ ಸಹಕಾರಿ ಸಂಘ (ನಿ)ಹಾವೇರಿ
                    					</b>
                    				</th>
                    			</tr>
                    			<tr>
                    		        <th colspan="6" style="border:solid black 1px;"><b style="font-size: 20px;">
                    		           <center><b><p id="monthyear"></p></b></center>
                    		        </th>
                    		    </tr>
                    			<tr>
                    				<th style="font-size: 15px;border:solid black 1px;">ಶಾಲೆಯ ಹೆಸರು</th>
                    				<th colspan="5" style="border:solid black 1px;"><?php echo $teacherdetail['school_name']; ?>
                    				    <input type="hidden" name="school_id" id="school_id" value="<?php echo $teacherdetail['school_id'];?>">
                    				</th>
                    			</tr>
                    			<tr>
                    				<th class="headerclass" style="border:solid black 1px;">ಕ್ರ. ಸಂ.</th>
                    				<th class="headerclass" style="border:solid black 1px;">ಶಿಕ್ಷಕರ ಹೆಸರು</th>
                    				<th class="headerclass" style="border:solid black 1px;">ಶೇರು ವಂತಿಕೆ</th>
                    				<th class="headerclass" style="border:solid black 1px;">ಸಾಲದ ಕಂತು</th>
                    				<th class="headerclass" style="border:solid black 1px;">ಬಡ್ಡಿ</th>
                    				<th class="headerclass" style="border:solid black 1px;">ಒಟ್ಟು</th>
                    			</tr>
                    		</thead>
                    		<tbody>
                    
                    			<?php
                    			$share_amount =0;
                    			$loan_amount =0;
                    			$interest_amount=0;
                    			$total_amount=0;
                    				if(count($teachersshareloanlist[0])>0){
                    					$i=1;
                    					foreach ($teachersshareloanlist[0] as $shareloandetail){ ?>
                    						<tr>
                    							<th class="headerclass" style="border:solid black 1px;"><?php echo $i++;?></th>
                    								<th class="teacherclass" style="border:solid black 1px;text-align: left;"><?php echo $shareloandetail['teacher_name'];?></th>
                    								<th class="numberclass" style="border:solid black 1px;text-align:right;text-align:right;"><?php echo $shareloandetail['share_amount']==''?0:$shareloandetail['share_amount'];?></th>
                    								<th class="numberclass" style="border:solid black 1px;text-align:right;text-align:right;"><?php echo $shareloandetail['loan_amount']==''?0:$shareloandetail['loan_amount'];?></th>
                    								<th class="numberclass" style="border:solid black 1px;text-align:right;text-align:right;"><?php echo $shareloandetail['interest_amount']==''?0:$shareloandetail['interest_amount'];?></th>
                    								<th class="numberclass" style="border:solid black 1px;text-align:right;text-align:right;"><?php echo $shareloandetail['total_amount']==''?0:$shareloandetail['total_amount'];?></th>
                    						</tr>
                    				<?php	
                    					$share_amount +=$shareloandetail['share_amount'];
                    					$loan_amount +=$shareloandetail['loan_amount'];
                    					$interest_amount+=$shareloandetail['interest_amount'];
                    					$total_amount+=$shareloandetail['total_amount'];
                    				}
                    			}
                    			?>
                    		</tbody>
                    			<tfoot>
                    				<tr>
                    					<th class="numberclass" colspan="2" style="border:solid black 1px;text-align: right;">ಒಟ್ಟು</th>
                    					<th class="numberclass"  style="border:solid black 1px;text-align:right;"><?php echo $share_amount;?></th>
                    					<th class="numberclass"  style="border:solid black 1px;text-align:right;"><?php echo $loan_amount;?></th>
                    					<th class="numberclass"  style="border:solid black 1px;text-align:right;"><?php echo $interest_amount;?></th>
                    					<th class="numberclass"  style="border:solid black 1px;text-align:right;"><?php echo $total_amount;?></th>
                    				</tr>
                    			</tfoot>
                    		
                    	</table>
                    	</center>
                    </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="overall">
                    <div class="row">
                        <div class="col-sm-1" ></div>
                        <div class="col-sm-2 col-sm-offset-1" >
                            <label>From:</label>
                            <input type="date" class="form-control" name="from" id="from">
                        </div>
                        <div class="col-sm-2" >
                            <label>To:</label>
                            <input type="date" class="form-control" name="to" id="to">
                        </div>
                        <div class="col-sm-2" ></div>
                        <div class="col-sm-2">
                            <input type="button" class="btn btn-success" value="ExportExcel" onclick="exportexcel('School_Book','schoolamountcollected');" style="width:100%">
                        </div>
                        <div class="col-sm-2">
                        	<input type="button" class="btn btn-success" value="Print" onclick="printspecifiedDiv('schoolamountcollectedpdf');" style="width:100%">
                        </div>
                    </div>
                    <br>
                    <!-------------------------------------------------LOAN & SHARE DETAILS-------------------------------------->
                    
                    <div class="row">
                    <div class="col-sm-12" id="schoolamountcollectedpdf">
                        <center>
                            <div id="collection"></div>
                    	
                    	</center>
                    </div>
                    </div>
                </div>
              </div>
            </div>
    </div>
 </div>
 
 <script type="text/javascript">
     $('#payable_moth_year').change(function(){
        var key = $('#payable_moth_year').val().split('-');
        var months = {'01':'&#3228;&#3240;&#3253;&#3248;&#3263;','02':'&#3243;&#3270;&#3244;&#3277;&#3248;&#3253;&#3248;&#3263;','03':'&#3246;&#3262;&#3248;&#3277;&#3226;&#3277;','04':'&#3215;&#3242;&#3277;&#3248;&#3263;&#3250;&#3277;','05':'&#3246;&#3271;','06':'&#3228;&#3266;&#3240;&#3277;','07':'&#3228;&#3265;&#3250;&#3272;','08':'&#3206;&#3223;&#3256;&#3277;&#3231;&#3277;','09':'&#3256;&#3270;&#3242;&#3277;&#3231;&#3270;&#3202;&#3244;&#3248;&#3277;','10':'&#3205;&#3221;&#3277;&#3231;&#3274;&#3244;&#3248;&#3277;','11':'&#3240;&#3253;&#3270;&#3202;&#3244;&#3248;&#3277;','12':'&#3233;&#3263;&#3256;&#3270;&#3202;&#3244;&#3248;&#3277;'};
        
        $('#monthyear').html( months[key[1]]+'-'+key[0]+' &#3256;&#3263;&#3244;&#3277;&#3244;&#3202;&#3238;&#3263;&#3247;&#3253;&#3248; &#3253;&#3271;&#3236;&#3240;&#3238;&#3250;&#3277;&#3250;&#3263; &#3244;&#3248;&#3244;&#3271;&#3221;&#3262;&#3238; &#3254;&#3271;&#3248;&#3265; &#3246;&#3236;&#3277;&#3236;&#3265; &#3256;&#3262;&#3250;&#3238; &#3247;&#3262;&#3238;&#3263;');
     });
     
     $('#from,#to').change(function(){
        $.ajax({
             type:'POST',
             url:baseurl+'AdminController/GetDataBetweenShareLoanCollected',
             data:{
                    from:$('#from').val(),
                    to:$('#to').val(),
                    school_id:$('#school_id').val(),
              },
             success:function(data){
                 $('#collection').html('');
                 $('#collection').html(data);
             }
         });
     });
 </script>