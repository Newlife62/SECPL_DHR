<?php 

if($loanchart[0]->num_rows()>0){
    foreach($loanchart[0]->result_array() as $teacherdetail);
}else{
    $teacherdetail = NULL;
}

if($loanchart[1]->num_rows()>0){
     foreach($loanchart[1]->result_array() as $loandetail);
}else{
    exit;
}
?>

<div class="row">
    <div class="col-sm-12">
	<input type="button"  class="btn btn-success pull-right" value="Export Excel" onclick="exportexcel('loanchart','loanchart')">
    </div>
</div><br>
				
<table style="border:solid black 1px" id="loanchart">
    <thead>
        <tr>
            <th colspan="9" style="border:solid black 1px"><b style="font-size: 15px;">Date: <?=date('d-m-Y')?></b></th>
        </tr>
        <tr>
            <th colspan="9" style="border:solid black 1px">
                <center><b style="font-size: 20px;">
                ಹಾವೇರಿ ತಾಲ್ಲೂಕ ಅನುದಾನಿತ ಶಿಕ್ಷಣ ಸಂಸ್ಥೆಗಳ ನೌಕರರ ಸಹಕಾರಿ ಪತ್ತಿನ ಸಂಘ (ನಿ) ಹಾವೇರಿ
                </b></center>
            </th>
        </tr>
        <tr>
            <th colspan="3" style="border:solid black 1px">
                <b style="font-size: 20px;">ಸಾಲ ಪಡೆದವರ ಹೆಸರು</b>
            </th>
            <th colspan="6" style="border:solid black 1px">
                <b style="font-size: 20px;"><?=$teacherdetail['teacher_name'];?></b>
            </th>
        </tr>
        <tr>
            <th style="border:solid black 1px">&#3221;&#3202;&#3236;&#3277;&#3236;&#3265;&#3223;&#3251;&#3265;<!--kanthugalu--></th>
            <th style="border:solid black 1px">&#3221;&#3202;&#3236;&#3277;&#3236;&#3263;&#3240; &#3238;&#3263;&#3240;&#3262;&#3202;&#3221;<br/></th>
            <th style="border:solid black 1px">&#3242;&#3277;&#3248;&#3236;&#3263; &#3236;&#3263;&#3202;&#3223;&#3251;&#3265; &#3236;&#3265;&#3202;&#3244;&#3263;&#3238; &#3205;&#3256;&#3250;&#3265;<!--prathi thingalu thumbida asalu--></th> 
            <th style="border:solid black 1px">&#3242;&#3277;&#3248;&#3236;&#3263; &#3236;&#3263;&#3202;&#3223;&#3251;&#3265; &#3205;&#3256;&#3250;&#3265; &#3236;&#3265;&#3202;&#3244;&#3263; &#3209;&#3251;&#3263;&#3238; &#3244;&#3262;&#3221;&#3263; &#3256;&#3262;&#3250;<!--prathi thingalu asalu thumbi ulida baaki sala--> </th> 
            <th style="border:solid black 1px">&#3242;&#3277;&#3248;&#3236;&#3263; &#3236;&#3263;&#3202;&#3223;&#3251; &#3244;&#3233;&#3277;&#3233;&#3263; &#3250;&#3270;&#3221;&#3277;&#3221;&#3262;&#3226;&#3262;&#3248; &#3205;&#3256;&#3250;&#3263;&#3223;&#3270;<!--prathi thingala baddi lekkaachaara asalige--></th> 
            <th style="border:solid black 1px">&#3236;&#3263;&#3202;&#3223;&#3251;&#3253;&#3262;&#3248;&#3265; &#3221;&#3231;&#3277;&#3231;&#3244;&#3270;&#3221;&#3262;&#3238; &#3244;&#3233;&#3277;&#3233;&#3263;&#40; &#51; &#3221;&#3262;&#3250;&#3246;&#3277;&#41; &#3250;&#3270;&#3221;&#3277;&#3221;&#3226;&#3262;&#3248;<!--thingalavaaru kattabekaada baddi( 3 kaalam) lekkachaara--></th> 
            <th style="border:solid black 1px">&#3256;&#3238;&#3256;&#3277;&#3247;&#3248;&#3265; &#3221;&#3231;&#3277;&#3231;&#3263;&#3238; &#3244;&#3233;&#3277;&#3233;&#3263;<!--sadasyaru kattida baddi--></th> 
            <th style="border:solid black 1px">&#3248;&#3263; &#3244;&#3262;&#3202;&#3233;&#3277; &#3246;&#3262;&#3233;&#3263;&#3238;&#3262;&#3223; &#3221;&#3231;&#3277;&#3231;&#3244;&#3271;&#3221;&#3262;&#3238; &#3244;&#3233;&#3277;&#3233;&#3263;<!--re bond maadidaaga kattabekaada baddi--></th> 
            <th style="border:solid black 1px">&#3248;&#3263; &#3244;&#3262;&#3202;&#3233;&#3277; &#3246;&#3262;&#3233;&#3263;&#3238;&#3262;&#3223; &#3221;&#3231;&#3277;&#3231;&#3244;&#3271;&#3221;&#3262;&#3238; &#3205;&#3256;&#3250;&#3265; &#3246;&#3236;&#3277;&#3236;&#3265; &#3244;&#3233;&#3277;&#3233;&#3263;<!--re bond maadidaaga kattabekaada asalu maththu baddi--></th>
            <!--<th>Submitted or Not</th>-->
        </tr>
    </thead>
    <tbdy>
    <?php 
    $i=$cummulative_baddi=$cummulative_kattida_baddi=$cummulative_ulike_baddi=0;
    
    $installmentdates = array();
    foreach($loanchart[2]->result_array() as $installmentdate){
        $installmentdates[] = $installmentdate['date'];
    }
    $installmentdates[] = 'Next Installment';
    for($i=0;$i<$loanchart[2]->num_rows()+1;$i++)
    {
        if($i==0)
        { ?>
            <tr>
                <th  style="border:solid black 1px"><?php echo $i;?></th>
                <th  style="border:solid black 1px"><?php echo date('d-m-Y',strtotime($installmentdates[$i]));?></th>
                <th  style="border:solid black 1px"><?php echo $thingalakanthu = 0;?></th> 
                <th  style="border:solid black 1px"><?php echo $asalu = $nextasalu = ($loandetail['loan_amount']-=$thingalakanthu);?></th> 
                <th  style="border:solid black 1px"><?php echo $baddi = 0;?></th> 
                <th  style="border:solid black 1px"><?php echo $cummulative_baddi+=$baddi;?></th> 
                <th  style="border:solid black 1px"><?php echo $cummulative_kattida_baddi += 0;?></th> 
                <th  style="border:solid black 1px"><?php echo $cummulative_ulike_baddi += ($cummulative_baddi-$cummulative_kattida_baddi);?></th> 
                <th  style="border:solid black 1px"><?php echo $cummulative_ulike_baddi;?></th>
                <!--<th></th>-->
            </tr>
        <?php 
        }
        else
        { ?>
        <tr>
            <th style="border:solid black 1px"><?php echo $i;?></th>
            <th  style="border:solid black 1px"><?php echo $installmentdates[$i]=='Next Installment'?$installmentdates[$i]:date('d-m-Y',strtotime($installmentdates[$i]));?></th>
            <th style="border:solid black 1px"><?php echo $thingalakanthu = $loandetail['loan_installment'];?></th> 
            <th style="border:solid black 1px"><?php echo $nextasalu = ($nextasalu-=$thingalakanthu);?></th> 
            <th style="border:solid black 1px"><?php echo $baddi = $asalu*($loandetail['interest_percentage']/100);?></th> 
            <th style="border:solid black 1px"><?php echo $cummulative_baddi+=$baddi;?></th> 
            <th style="border:solid black 1px"><?php echo $cummulative_kattida_baddi += $loandetail['interest_amount'];?></th> 
            <th style="border:solid black 1px"><?php echo $cummulative_ulike_baddi += ($baddi-$loandetail['interest_amount']);?></th> 
            <th style="border:solid black 1px"><?php echo $nextasalu+$cummulative_ulike_baddi;?></th>
            <!--<th><button type="button" class="btn btn-xs btn-flat" onclick="rebond(<?php echo $i;?>)">SUBMIT</button></th>-->
        </tr>
        <?php $asalu = $nextasalu;
        }
    } ?>
    </tbody>
</table>