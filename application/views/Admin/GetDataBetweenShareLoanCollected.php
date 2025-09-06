<?php
if(count($teachersshareloanlist[0])>0){
	foreach($teachersshareloanlist[0] as $teacherdetail);
}else{
	$teacherdetail=NULL;
}
?>
<table  style="padding:0px;border:solid black 2px;overflow-y:scroll;" id="schoolamountcollected">
                    		<thead>
                    			<tr>
                    				<th colspan="8">
                    					<b style="font-size: 20px;">
                    					ಹಾವೇರಿ ತಾಲ್ಲೂಕ ಅನುದಾನಿತ ಶಿಕ್ಷಣ ಸಂಸ್ಥೆಗಳ ನೌಕರರ ಸಹಕಾರಿ ಪತ್ತಿನ ಸಂಘ (ನಿ) ಹಾವೇರಿ
                    					</b>
                    				</th>
                    			</tr>
                    			<tr>
                    				<th colspan="2" style="font-size: 15px;border:solid black 1px;">ಶಾಲೆಯ ಹೆಸರು</th>
                    				<th colspan="6" style="border:solid black 1px;"><?php echo $teacherdetail['school_name']; ?></th>
                    			</tr>
                    			<tr>
                    				<th class="headerclass" style="border:solid black 1px;">ಕ್ರ. ಸಂ.</th>
                    				<th class="headerclass" style="border:solid black 1px;">ಶಾಲೆಯ ಹೆಸರು</th>
                    				<th class="headerclass" style="border:solid black 1px;">ದಿನಾಂಕ</th>
                    				<th class="headerclass" style="border:solid black 1px;">ಚಕ್ ನಂಬರ</th>
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
                    								<th class="teacherclass" style="border:solid black 1px;text-align: left;"><?php echo $shareloandetail['pay_for']=='BULK'?$shareloandetail['school_name']:$shareloandetail['teacher_name'];?></th>
                    								<th class="headerclass" style="border:solid black 1px;"><?php echo date('d-m-Y',strtotime($shareloandetail['date']));?></th>
                    								<th class="headerclass" style="border:solid black 1px;"><?php echo $shareloandetail['cheque_number'];?></th>
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
                    					<th class="numberclass" colspan="4" style="border:solid black 1px;text-align: right;">ಒಟ್ಟು</th>
                    					<th class="numberclass"  style="border:solid black 1px;text-align:right;"><?php echo $share_amount;?></th>
                    					<th class="numberclass"  style="border:solid black 1px;text-align:right;"><?php echo $loan_amount;?></th>
                    					<th class="numberclass"  style="border:solid black 1px;text-align:right;"><?php echo $interest_amount;?></th>
                    					<th class="numberclass"  style="border:solid black 1px;text-align:right;"><?php echo $total_amount;?></th>
                    				</tr>
                    			</tfoot>
                    		
                    	</table>