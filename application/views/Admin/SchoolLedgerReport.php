<?php

if(count($ledgerdetails)>0){
	foreach($ledgerdetails as $schooldetail);
}else{
	$schooldetail=NULL;
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
	
<!-------------------------------------------------LOAN & SHARE DETAILS-------------------------------------->
<div class="col-sm-12">
	<center>
	<table  style="padding:0px;border:solid black 2px;overflow-y:scroll;">
		<thead>
			<tr>
				<th colspan="7">
					<b style="font-size: 20px;">
				    ಸರಕಾರಿ ಪ್ರೌಢಶಾಲಾ ಶಿಕ್ಷಕ ನೌಕರರ ಪತ್ತಿನ ಸಹಕಾರಿ ಸಂಘ (ನಿ)ಹಾವೇರಿ
					</b>
				</th>
			</tr>
			<tr>
				<th style="font-size: 15px;">ಶಾಲೆಯ ಹೆಸರು</th>
				<th colspan="6"><?php echo $schooldetail['school_name']; ?></th>
			</tr>
			<tr>
				<th class="headerclass">ಕ್ರ. ಸಂ.</th>
				<th class="headerclass">ಶಿಕ್ಷಕರ ಹೆಸರು</th>
				<th class="headerclass">ದಿನಾಂಕ</th>
				<th class="headerclass">ಶೇರು ವಂತಿಕೆ</th>
				<th class="headerclass">ಸಾಲದ ಕಂತು</th>
				<th class="headerclass">ಬಡ್ಡಿ</th>
				<th class="headerclass">ಒಟ್ಟು</th>
			</tr>
		</thead>
		<tbody>

			<?php
			$share_amount =0;
			$loan_amount =0;
			$interest_amount=0;
			$total_amount=0;
				if(count($ledgerdetails)>0){
					$i=1;
					foreach ($ledgerdetails as $shareloandetail){ ?>
						<tr>
							<th class="headerclass"><?php echo $i++;?></th>
								<th class="teacherclass"><?php echo $shareloandetail['teacher_name'];?></th>
								<th class="headerclass"><?php echo date('d-m-Y',strtotime($shareloandetail['date']));?></th>
								<th class="numberclass"><?php echo $shareloandetail['share_amount']==''?0:$shareloandetail['share_amount'];?></th>
								<th class="numberclass"><?php echo $shareloandetail['loan_amount']==''?0:$shareloandetail['loan_amount'];?></th>
								<th class="numberclass"><?php echo $shareloandetail['interest_amount']==''?0:$shareloandetail['interest_amount'];?></th>
								<th class="numberclass"><?php echo $shareloandetail['total_amount']==''?0:$shareloandetail['total_amount'];?></th>
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
					<th class="numberclass" colspan="3">ಒಟ್ಟು</th>
					<th class="numberclass" ><?php echo $share_amount;?></th>
					<th class="numberclass" ><?php echo $loan_amount;?></th>
					<th class="numberclass" ><?php echo $interest_amount;?></th>
					<th class="numberclass" ><?php echo $total_amount;?></th>
				</tr>
			</tfoot>
		
	</table>
	</center>
</div>
</div>