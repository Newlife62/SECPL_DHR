<?php
if($ledgerdetails[0]->num_rows()>0){
	foreach($ledgerdetails[0]->result_array() as $detail);
}else{
	$detail=NULL;
}

if($ledgerdetails[1]->num_rows()>0){
	foreach($ledgerdetails[1]->result_array() as $tillshares);
}else{
	$tillshares=NULL;
}

 if($ledgerdetails[5]!=NULL)
 {
    if($ledgerdetails[5]->num_rows()>0)
    {
   
        foreach ($ledgerdetails[5]->result_array() as $openloandetail);
    }
}
else{
    $openloandetail = NULL;
}

?>
<!-------------------------------------------------SHARE DETAILS-------------------------------------->
<style>
	.table-bordered{
		border-color:black;
		border-collapse: collapse;
	}
</style>
<div class="row">
	<div class="col-sm-6">
	    <div class="row">
			<div class="col-sm-6"></div>
			
			<div class="col-sm-3">
				<input type="button" class="btn btn-success pull-right" value="Export Excel" onclick="exportexcel('Share_Ledger','individualshareexcel');">
			</div>
			<div class="col-sm-3">
				<input type="button" class="btn btn-success pull-right" value="Print" onclick="printspecifiedDiv('individualshare');">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-12" id="individualshare">
	<table class=" table-responsive table-bordered" style="padding:0px;" id="individualshareexcel">
		<thead>
			<tr>
				<th colspan="4" style="border:solid black 1px;"><b style="font-size: 20px;">
				    ಸರಕಾರಿ ಪ್ರೌಢಶಾಲಾ ಶಿಕ್ಷಕ ನೌಕರರ ಪತ್ತಿನ ಸಹಕಾರಿ ಸಂಘ (ನಿ)ಹಾವೇರಿ
				</b></th>

			</tr>
			<tr>
				<th style="font-size: 15px;border:solid black 1px;">ಶೇರುದಾರರ ಹೆಸರು</th>
				<th colspan="3" style="border:solid black 1px;"><?php echo $detail['teacher_name']; ?></th>
			</tr>
			<tr>
				<th style="font-size: 15px;border:solid black 1px;">ಶಾಲೆಯ ಹೆಸರು</th>
				<th colspan="3" style="border:solid black 1px;"><?php echo $detail['school_name']; ?></th>
			</tr>
			<tr>
				<th style="border:solid black 1px;">ದಿನಾಂಕ</th>
				<th style="border:solid black 1px;">ತಿಂಗಳ ಶೇರು</th>
				<th style="border:solid black 1px;">ರಿಟರ್ನ್</th>
				<th style="border:solid black 1px;">ಒಟ್ಟು ಶೇರು</th>
			</tr>
		</thead>
		<tbody>

			<?php
			$credit =0;
			$tilldateshare = $tillshares['total_share'];
				if($ledgerdetails[2]->num_rows()>0){
					
					foreach ($ledgerdetails[2]->result_array() as $sharedetail){ ?>
						<tr>
								<th style="border:solid black 1px;"><?php echo date('d-m-Y',strtotime($sharedetail['date']));?></th>
								<th style="border:solid black 1px;"><?php echo $sharedetail['credit'];?></th>
								<th style="border:solid black 1px;"><?php echo $sharedetail['debit'];?></th>
								<th style="border:solid black 1px;"><?php echo $tilldateshare+=($sharedetail['credit']-$sharedetail['debit']);?></th>
						</tr>
				<?php	
					$credit += $sharedetail['credit'];
					
						}
							}
			?>
		</tbody>
			<tfoot>
				<tr>
				<th colspan="3" style="text-align:right;border:solid black 1px;">ಒಟ್ಟು</th>
				<th style="border:solid black 1px;"><?php echo $tilldateshare;?></th>
			</tr>
			</tfoot>
		
	</table>
	
	</div>
		</div>
</div>
<!-------------------------------------------------LOAN DETAILS-------------------------------------->
<div class="col-sm-6">
    <div class="row">
			<div class="col-sm-6"></div>
				<div class="col-sm-3">
				<input type="button" class="btn btn-success pull-right" value="Export Excel" onclick="exportexcel('Loan_Ledger','individualloanexcel');">
			</div>
			<div class="col-sm-3">
				<input type="button" class="btn btn-success pull-right" value="Print" onclick="printspecifiedDiv('individualloan');">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-12" id="individualloan">
	<table class=" table-responsive table-bordered" style="padding:0px;" id="individualloanexcel">
		<thead>
			<tr>
				<th colspan="5" style="border:solid black 1px;"><b style="font-size: 20px;">
					ಸರಕಾರಿ ಪ್ರೌಢಶಾಲಾ ಶಿಕ್ಷಕ ನೌಕರರ ಪತ್ತಿನ ಸಹಕಾರಿ ಸಂಘ (ನಿ)ಹಾವೇರಿ
				</b></th>

			</tr>
			<tr>
				<th style="font-size: 15px; border:solid black 1px;">ಸಾಲಗಾರರ ಹೆಸರು</th>
				<th colspan="4" style="border:solid black 1px;"><?php echo $detail['teacher_name']; ?></th>
			</tr>
			<tr>
				<th style="font-size: 15px; border:solid black 1px;">ಶಾಲೆಯ ಹೆಸರು</th>
				<th colspan="4" style="border:solid black 1px;"><?php echo $detail['school_name']; ?></th>
			</tr>
			<tr>
				<th style="border:solid black 1px;">ದಿನಾಂಕ</th>
				<th style="border:solid black 1px;">ಸಾಲ</th>
				<th style="border:solid black 1px;">ಅಸಲು</th>
				<th style="border:solid black 1px;">ಬಡ್ಡಿ</th>
				<th style="border:solid black 1px;">ಬಾಕಿ ಸಾಲದ ಮೊತ್ತ</th>
			</tr>
		</thead>
		<tbody>
		    <tr>
		        <th colspan="4">Opening Balance</th>
		        <th><?=$opening = ($openloandetail['loanopening']==NULL?0:$openloandetail['loanopening'])?></th>
		        </tr>

			<?php
			if($ledgerdetails[3]->num_rows()>0){
				foreach($ledgerdetails[3]->result_array() as $tillloan);
			}else{
				$tillloan=NULL;
			}
			
			$credit = $debit =	0;$tilldateloan = $opening;
			        
			        
				if($ledgerdetails[4]->num_rows()>0){
					
					foreach ($ledgerdetails[4]->result_array() as $loandetail){ ?>
						<tr>
								<th style="border:solid black 1px;"><?php echo date('d-m-Y',strtotime($loandetail['date']));?></th>
								<th style="border:solid black 1px;"><?php $tilldateloan += $loandetail['debit'];echo $loandetail['debit'];?></th>
								<th style="border:solid black 1px;"><?php echo $loandetail['credit'];?></th>
								<th style="border:solid black 1px;"><?php echo $loandetail['interest'];?></th>
								<th style="border:solid black 1px;"><?php echo $tilldateloan-=$loandetail['credit'];?></th>
						</tr>
				<?php	
					$debit += $loandetail['debit'];
					$credit += $loandetail['credit'];
						}
							}
			?>
		</tbody>
			<tfoot>
				<tr>
				<th style="text-align:right; border:solid black 1px;" colspan="4">ಒಟ್ಟು</th>
				
				<th style="border:solid black 1px;"><?php echo $tilldateloan;//$tillloan['total_loan'];?></th>
			</tr>
			</tfoot>
		
	</table>
		</div>
		</div>
</div>
</div>