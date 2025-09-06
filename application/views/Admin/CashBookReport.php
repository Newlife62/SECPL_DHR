    <div class="tile">
		<div class="tile-body">
		    <div class="row">
				<div class="col-sm-12">
		           <input type="button"  class="btn btn-success pull-right" value="Export Excel" onclick="exportexcel('cashbook','cashbook')">
				</div>
			</div>
				<br>
			<div class="row">
				<div class="col-sm-12 table-responsive" id="cashbook"><center>
					
					<table class="" style="border:solid black 2px;">
						<thead>
							<tr>
								<th colspan="15" class="headerclass"><center><font style="font-size: 20px;">ಸರಕಾರಿ ಪ್ರೌಢಶಾಲಾ ಶಿಕ್ಷಕ ನೌಕರರ ಪತ್ತಿನ ಸಹಕಾರಿ ಸಂಘ (ನಿ)ಹಾವೇರಿ-581110</font></center></th>
								
							</tr>
							<tr>
								<th rowspan="2" class="headerclass">ದಿನಾಂಕ</th>
								<th rowspan="2" class="headerclass">ಹೆಸರು</th>
								<th colspan="7" class="headerclass">ಜಮಾ</th>
								<th colspan="5" class="headerclass">ಖರ್ಚು</th>
								<th rowspan="2" class="headerclass">ಒಟ್ಟು(<?=$cashbookdetails['opening']?>)</th>
							</tr>
							<tr>
								<th  class="headerclass">ಶೇರು</th>
								<th  class="headerclass">ಸಾಲ</th>
								<th  class="headerclass">ಬಡ್ಡಿ</th>
								<th  class="headerclass">ಮೆಂಬರ್ ಫೀ</th>
								<th  class="headerclass">ಕಟ್ಟಡ ನಿಧಿ</th>
								<th  class="headerclass">ಬ್ಯಾಂಕು ಬಡ್ಡಿ</th>
								<th  class="headerclass">ಇತರೆ</th>
								<th  class="headerclass"><?=$cashbookdetails['bank_name']?></th>
								
								<th  class="headerclass">ಶೇರು ಪರತ</th>
								<th  class="headerclass">ಸಾಲ ಪರತ</th>
								<th  class="headerclass">ಸಾಲ</th>
								<th  class="headerclass">ವೇತನ ಸಹಕಾರ ನಿಧಿ</th>
								<th  class="headerclass">ಸಹಕಾರ ಶಿಕ್ಷಣ ನಿಧಿ</th>
								<th  class="headerclass">ಅಮಾನತ್</th>
								<th  class="headerclass">ಬ್ಯಾಂಕ್ ಚಾರ್ಜಸ್</th>
								<th  class="headerclass">ಡಿವಿಡೆಂಡ್</th>
								<th  class="headerclass">ಇತರೆ</th>
								<th  class="headerclass"><?=$cashbookdetails['bank_name']?></th>
						        
							</tr>
						</thead>
						<tbody>
							<?php
						//	echo '<pre>';print_r($cashbookdetails);echo '</pre>';
							
							if(count($cashbookdetails['cash_book']) > 0){
							    $shareamount=$loanamount=$interestamount=$memberfee=$urbanbankl=$buildingamount=$other=$shareparatha=$saalaparatha=$loan=$bankcharges=$centralbank=$urbanbank=$expense=$total=0;
							 
							    $closingBalance = $cashbookdetails['opening'];
							 
    							foreach($cashbookdetails['cash_book'] as $cashbook){
        							 $a=$b=$c=$d=$e=$f=$g=$h=$i=$j=$k=$l=$m=$tot=0;
        							 
        							 
        							$h = $cashbook['share_paratha'];
        							$m = $cashbook['saala_paratha'];
        							$i = $cashbook['loan'];
        							$v = $cashbook['vetana sahakaara nidhi'];
        							$w = $cashbook['sahakaara shikshana nidhi'];
        							$x = $cashbook['amaanat'];
        							$j = $cashbook['bank_charges'];
        							$y = $cashbook['dividend'];
        							$l = $cashbook['expense'];
        						?>
        								<tr>
        									<th class="headerclass"><?php echo date('d-m-Y',strtotime($cashbook['date']));?></th>
        									<th class="headerclass"><?php echo $cashbook['bywhom'];?></th>
        									<!----JAMA---->
        									<th class="headerclass"><?php echo $a = $cashbook['share_amount'];?></th>
        									<th class="headerclass"><?php echo $b = $cashbook['loan_amount'];?></th>
        									<th  class="headerclass"><?php echo $c = $cashbook['interest_amount'];?></th>
        									<th  class="headerclass"><?php echo $d = $cashbook['member_fee'];?></th>
        									<th  class="headerclass"><?php echo $e = $cashbook['building_amount'];?></th>
        									<th  class="headerclass"><?php echo $z = $cashbook['bank_interest_credit'];?></th>
        									<th  class="headerclass"><?php echo $f = $cashbook['other'];?></th>
        									<th  class="headerclass"><?php echo $k = ($h+$i+$j+$l);?></th>
        									
        									<!-----KARCHU----->
        									<th  class="headerclass"><?php echo $h;?></th>
        									<th  class="headerclass"><?php echo $m;?></th>
        									<th  class="headerclass"><?php echo $i;?></th>
        									<th  class="headerclass"><?php echo $v;?></th>
        									<th  class="headerclass"><?php echo $w;?></th>
        									<th  class="headerclass"><?php echo $x;?></th>
        									<th  class="headerclass"><?php echo $j;?></th>
        									<th  class="headerclass"><?php echo $y;?></th>
        									<th  class="headerclass"><?php echo $l;?></th>
        									<th  class="headerclass"><?php echo $g = ($a+$b+$c+$d+$e+$f);?></th>
        									
        									<?php 
        									$tot = (($a+$b+$c+$d+$e+$f)-($h+$i+$j+$l+$m));
        									$closingBalance += $tot;
        									?>
        									<th class="headerclass"><?=$closingBalance?></th>
        								
        									
        								</tr>
        							<?php 
        							     ///////////////////////CREDT TOTAL/////////////////////////////////
        							        $shareamount    +=  $a;
        									$loanamount     +=  $b;
        									$interestamount += $c;
        									$memberfee      += $d;
        									$buildingamount += $e;
        									$other          += $f;
        									
        									$urbanbankl     += $g;
        									
        									////////DEBIT TOTAL/////////////////////////////////////////////
        									
        									$shareparatha   += $h;
        									$saalaparatha   += $m;
        									$loan           += $i;
        									$bankcharges    += $j;
        									$expense        += $l;
        								
        								 	$urbanbank      += $k;
        									
        									$total          = $closingBalance;
        							    ///////////////////////////////////////////////////////////////////
        							} ?>
							
						</tbody>
						<tfoot>
						    	<tr>
									<th class="headerclass" style="text-align:right;" colspan="2">Total</th>
									<!----JAMA---->
									<th class="headerclass"><?php echo $shareamount;?></th>
									<th class="headerclass"><?php echo $loanamount;?></th>
									<th  class="headerclass"><?php echo $interestamount;?></th>
									<th  class="headerclass"><?php echo $memberfee;?></th>
									<th  class="headerclass"><?php echo $buildingamount;?></th>
									<th  class="headerclass"><?php echo $other;?></th>
									<th  class="headerclass"><?php echo $urbanbank;?></th>
									
									<!-----KARCHU----->
									<th  class="headerclass"><?php echo $shareparatha;?></th>
									<th  class="headerclass"><?php echo $saalaparatha;?></th>
									<th  class="headerclass"><?php echo $loan;?></th>
									<th  class="headerclass"><?php echo $bankcharges;?></th>
									<th  class="headerclass"><?php echo $expense;?></th>
									
									<th  class="headerclass"><?php echo $urbanbankl;?></th>
								    <th class="headerclass"><?=$total?></th>
									
								</tr>
						</tfoot>
						<?php } ?>
					</table>
				</center>
				</div>
			</div>
		</div>
	</div>