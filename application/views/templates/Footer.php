<?php 
$segmentone     = str_replace(' ','',$this->uri->segment(1));
$segmenttwo     = str_replace(' ','',$this->uri->segment(2));
$schooloptions  = '';
$companylist    = $this->db->select('id,company_name')->from('companys_detail')->get();


foreach($companylist->result_array() as $company){
    $companyid       = $company['id'];
    $companyname     = $company['company_name'];
    $schooloptions .= '<option value="'.$companyid.'" >'.$companyname.' SCHOOL</option>';
}
?>

<!--MODAL DIVISION-->
<div class="modal fade" role="dialog" id="commonmodal" data-backdrop="static" data-keyboard="false" style="height:100%;overflow:hidden;padding-top:-15px;padding-bottom:25px;">
    <div class="modal-dialog modal-lg" id="modal-dialog" style="height:100%;">
        <div class="modal-content" style="height:100%;">
            <div class="modal-header" style="padding:0px;">
                <div id="modal-header" class="" style="text-align:center;"></div>
                <button class='close btn-xs btn-danger pull-right' data-dismiss="modal" id="close"><i class="fa fa-close"></i></button>
            </div>
            <div class="modal-body" style="overflow:scroll;"></div>
            <div class="modal-footer" style="padding:0px;">
                <!--<center><button class=' btn-xs btn-success '  id="save"><i class="">SAVE</i></button></center>-->
            </div>
        </div>
    </div>
</div>
<!--Stacked modal-->
<div class="modal fade" id="secondModal" tabindex="-1" role="dialog" data-keyboard="false" style="height:100%;overflow:hidden;padding-top:-15px;padding-bottom:25px;">
  <div class="modal-dialog modal-md" role="document" style="height:100%;">
    <div class="modal-content" style="height:100%;">
      <div class="modal-header">
        <h5 class="modal-title second-modal-title" ></h5>
        <button type="button" class="close second-close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body second-modal-body" style="overflow:scroll;">
        
      </div>
    </div>
  </div>
</div>
<!--MODAL DIVISION-->


 <!-- Essential javascripts for application to work-->
    <script src="<?=base_url();?>assets/js/jquery-3.2.1.min.js"></script>
    <script src="<?=base_url();?>assets/js/popper.min.js"></script>
    <script src="<?=base_url();?>assets/js/bootstrap.min.js"></script>
    <script src="<?=base_url();?>assets/js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="<?=base_url();?>assets/js/plugins/pace.min.js"></script>
    <!-- Page specific javascripts-->
    <script type="text/javascript" src="<?=base_url();?>assets/js/plugins/chart.js"></script>
    <!-- Data table plugin-->
    <script type="text/javascript" src="<?=base_url();?>assets/js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="<?=base_url();?>assets/js/plugins/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">$('#sampleTable').DataTable();</script>
    <script type="text/javascript" src="<?=base_url();?>assets/js/DataTable.js"></script>
    <script type="text/javascript" src="<?=base_url();?>assets/js/Ledger.js"></script>
    <script type="text/javascript" src="<?=base_url();?>assets/js/jquery.table2excel.js"></script>

    <script type="text/javascript">
        //   var data = {
        //   	labels: ["January", "February", "March", "April", "May"],
        //   	datasets: [
        //   		{
        //   			label: "My First dataset",
        //   			fillColor: "rgba(220,220,220,0.2)",
        //   			strokeColor: "rgba(220,220,220,1)",
        //   			pointColor: "rgba(220,220,220,1)",
        //   			pointStrokeColor: "#fff",
        //   			pointHighlightFill: "#fff",
        //   			pointHighlightStroke: "rgba(220,220,220,1)",
        //   			data: [65, 59, 80, 81, 56]
        //   		},
        //   		{
        //   			label: "My Second dataset",
        //   			fillColor: "rgba(151,187,205,0.2)",
        //   			strokeColor: "rgba(151,187,205,1)",
        //   			pointColor: "rgba(151,187,205,1)",
        //   			pointStrokeColor: "#fff",
        //   			pointHighlightFill: "#fff",
        //   			pointHighlightStroke: "rgba(151,187,205,1)",
        //   			data: [28, 48, 40, 19, 86]
        //   		}
        //   	]
        //   };
          
        //   var pdata = [
        //   	{
        //   		value: 300,
        //   		color: "#46BFBD",
        //   		highlight: "#5AD3D1",
        //   		label: "Complete"
        //   	},
        //   	{
        //   		value: 50,
        //   		color:"#F7464A",
        //   		highlight: "#FF5A5E",
        //   		label: "In-Progress"
        //   	}
        //   ]
          
        // var ctxl = $("#lineChartDemo").get(0).getContext("2d");
        // var lineChart = new Chart(ctxl).Line(data);
          
        // var ctxp = $("#pieChartDemo").get(0).getContext("2d");
        // var pieChart = new Chart(ctxp).Pie(pdata);
    </script>
    <!-- Google analytics script-->
    
     <script type="text/javascript">
        $('#all').on('click', function () {
            if (this.checked) {
                $('.case').each(function () {
                    this.checked = true;
                });
            } else {
                $('.case').each(function () {
                    this.checked = false;
                });
            }
        });

        function tog(n, d){
              if($('.case:checked').length == $('.case').length){
                  
                  $('#all').prop('checked',true);
              }else{
                  $('#all').prop('checked',false);
              }
        }
          
        $(document).ready(function(){
            var segmenttwo = '<?php echo $segmenttwo;?>';
            var segmentone = '<?php echo $segmentone;?>';
           
            if(segmenttwo == 'AddSchools')
            {
                $('#schoolslist_filter').append('<table class="pull-right"><tr><td><button type="button" class="btn btn-info btn-xs pull-right" data-toggle="modal" data-target="#commonmodal" onclick="addschool(0)" style="border-radius:45px;" title="ADD NEW COMPANY"><i class="fa fa-plus"></i>S</button></td><td ><button type="button" class="btn btn-info btn-xs pull-right" data-toggle="modal" data-target="#commonmodal" onclick="addteacher(0,0)" style="border-radius:45px;" title="ADD NEW EMPLOYEE"><i class="fa fa-plus"></i>T</button></td><td ><button type="button" class="btn btn-info btn-xs btn-danger" id="delall"  onclick="deleteschool(\'delall\')" title="DELETE SELECTED COMPANY" style="border-radius:45px;"><i class="fa fa-trash"></i>S</button><label for="delall"><span></span></label></td></tr></table>');
            }
            else if(segmentone == 'staff_list')
            {
                $('#teacherslist_filter').append('<table><tr><td><button type="button" class="btn btn-info btn-xs pull-left" data-toggle="modal" data-target="#commonmodal" onclick="departmentlist()" style="border-radius:45px;" title="DEPARTMENT LIST"><i class="fa fa-plus"></i>Dept.List</button></td><td><select id="teachers_type" class="form-control" title="REMOVED EMPLOYEES LIST"><option value="0">Present Employees</option><option value="1">Removed Employees</option></select></td><td ><select  class="form-control" name="school_id" id="school_id" placeholder="company name"  required><option value="">Select The Company</option><option value="ALL">All Company Employees</option>'+'<?php echo $schooloptions ?>'+'</select></td><td ></td><td ><button type="button" class="btn btn-info btn-xs pull-right" data-toggle="modal" data-target="#commonmodal" onclick="addteacher(0,0)" style="border-radius:45px;" title="ADD NEW EMPLOYEE"><i class="fa fa-plus"></i>A</button></td><td ><button type="button" class="btn btn-info btn-xs btn-danger pull-right" id="delall"  onclick="deleteteacher(\'delall\')" title="DELETE SELECTED EMPLOYEES" style="border-radius:45px;"><i class="fa fa-trash"></i>D</button><label for="delall"><span></span></label></td><td><button type="button" title="EXPORT EMPLOYEES LIST" style="border-radius:45px;" class="btn btn-success btn-xs" onclick="exportexcel(\'TEACHERS\',\'teacherslistproper\');"><i class="fa fa-list"></i></button></td></tr></table>');
            
                $('#school_id').change(function(){
                    table2.ajax.reload();
                });
                $('#teachers_type').change(function(){
                    table2.ajax.reload();
                });
            }
            else if(segmenttwo == 'AddExpense')
            {
                $('#expenselist_filter').append(' <table class="pull-right"><tr> <td > <button type="button" class="btn btn-info btn-xs pull-right" data-toggle="modal" data-target="#commonmodal" onclick="addexpense(0)" style="border-radius:45px;"><i class="fa fa-plus"></i>E</button></td> <td ><button type="button" class="btn btn-info btn-xs btn-danger" id="delall"  onclick="deleteexpense(\'delall\')" title="DELETE SELECTED EXPENSES" style="border-radius:45px;"><i class="fa fa-trash"></i>D</button><label for="delall"><span></span></label></td></tr></table>');
            
            }
            else if(segmenttwo == 'StageOneOrdersList')
            {
                $('#orderslist_filter').append(' <table class="pull-right"><tr><td><select id="dhr_type" class="form-control" title="REMOVED DHR LIST" style="height:30px;padding:0px;" ><option value="0">Present DHR</option><option value="1">Removed DHR</option></select></td> <td > <button type="button" class="btn btn-info btn-xs pull-right" data-toggle="modal" data-target="#commonmodal" onclick="adddhrecords(0)" style="border-radius:35px;padding:0px;"><i class="fa fa-plus"></i>DHR</button></td> </tr></table>');
                $('#modal-dialog').css('max-width','100%');
                $('#modal-dialog').css('width','100%');
                $('#modal-dialog').css('padding','10px');
                $('#modal-header').append('<center><h2>STAGE-1 DEVICE HISTORY RECORD</h2></center>')
            }
            else if(segmenttwo == 'StageTwoOrdersList')
            {
                $('#orderslist_filter').append(' <table class="pull-right"><tr><td><select id="dhr_type" class="form-control" title="REMOVED DHR LIST" style="height:30px;padding:0px;" ><option value="0">Present DHR</option><option value="1">Removed DHR</option></select></td> <td > <button type="button" class="btn btn-info btn-xs pull-right" data-toggle="modal" data-target="#commonmodal" onclick="adddhrecords(0)" style="border-radius:35px;padding:0px;"><i class="fa fa-plus"></i>DHR</button></td> </tr></table>');
                $('#modal-dialog').css('max-width','100%');
                $('#modal-dialog').css('width','100%');
                $('#modal-dialog').css('padding','10px');
                $('#modal-header').append('<center><h2>STAGE-2 DEVICE HISTORY RECORD</h2></center>')
            }
            else if(segmenttwo == 'StageThreeOrdersList')
            {
                $('#orderslist_filter').append(' <table class="pull-right"><tr><td><select id="dhr_type" class="form-control" title="REMOVED DHR LIST" style="height:30px;padding:0px;" ><option value="0">Present DHR</option><option value="1">Removed DHR</option></select></td> <td > <button type="button" class="btn btn-info btn-xs pull-right" data-toggle="modal" data-target="#commonmodal" onclick="adddhrecords(0)" style="border-radius:35px;padding:0px;"><i class="fa fa-plus"></i>DHR</button></td> </tr></table>');
                $('#modal-dialog').css('max-width','100%');
                $('#modal-dialog').css('width','100%');
                $('#modal-dialog').css('padding','10px');
                $('#modal-header').append('<center><h2>STAGE-3 DEVICE HISTORY RECORD</h2></center>')
            }
            else if(segmenttwo == 'StageFourOrdersList')
            {
                $('#orderslist_filter').append(' <table class="pull-right"><tr><td><select id="dhr_type" class="form-control" title="REMOVED DHR LIST" style="height:30px;padding:0px;" ><option value="0">Present DHR</option><option value="1">Removed DHR</option></select></td> <td > <button type="button" class="btn btn-info btn-xs pull-right" data-toggle="modal" data-target="#commonmodal" onclick="adddhrecords(0)" style="border-radius:35px;padding:0px;"><i class="fa fa-plus"></i>DHR</button></td> </tr></table>');
                $('#modal-dialog').css('max-width','100%');
                $('#modal-dialog').css('width','100%');
                $('#modal-dialog').css('padding','10px');
                $('#modal-header').append('<center><h2>STAGE-4 DEVICE HISTORY RECORD</h2></center>')
            }
            else if(segmenttwo == 'COAList')
            {
                $('#coalist_filter').append(' <table class="pull-right"><tr><td><select id="coa_type" class="form-control" title="REMOVED COA LIST" style="height:30px;padding:0px;" ><option value="0">Present COA</option><option value="1">Removed COA</option></select></td> <td > <button type="button" class="btn btn-info btn-xs pull-right" data-toggle="modal" data-target="#commonmodal" onclick="adddhrecords(0)" style="border-radius:35px;padding:0px;"><i class="fa fa-plus"></i>COA</button></td> </tr></table>');
                $('#modal-dialog').css('max-width','100%');
                $('#modal-dialog').css('width','100%');
                $('#modal-dialog').css('padding','10px');
                $('#modal-header').append('<center><h2>COA FORM</h2></center>')
            }
        });
         
        
     </script>
     
     <!--shah specific js functions in this js file-->
     <script type="text/javascript" src="<?=base_url();?>assets/js/ShahSpecific.js"></script>

    <script type="text/javascript">
      if(document.location.hostname == 'trendway.co.in') {
      	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
      	ga('create', 'UA-72504830-1', 'auto');
      	ga('send', 'pageview');
      }
    </script>

    <textarea id="printing-css" style="display:none;">html,body,div,span,applet,object,iframe,h1,h2,h3,h4,h5,h6,p,blockquote,pre,a,abbr,acronym,address,big,cite,code,del,dfn,em,img,ins,kbd,q,s,samp,small,strike,strong,sub,sup,tt,var,b,u,i,center,dl,dt,dd,ol,ul,li,fieldset,form,label,legend,table,caption,tbody,tfoot,thead,tr,th,td,article,aside,canvas,details,embed,figure,figcaption,footer,header,hgroup,menu,nav,output,ruby,section,summary,time,mark,audio,video{margin:0;padding:0;border:0;font-size:100%;font:inherit;vertical-align:baseline}article,aside,details,figcaption,figure,footer,header,hgroup,menu,nav,section{display:block}body{line-height:1}ol,ul{list-style:none}blockquote,q{quotes:none}blockquote:before,blockquote:after,q:before,q:after{content:'';content:none}table{border-collapse:collapse;border-spacing:0}body{font:normal normal .8125em/1.4 Arial,Sans-Serif;background-color:white;color:#333}strong,b{font-weight:bold}cite,em,i{font-style:italic}a{text-decoration:none}a:hover{text-decoration:underline}a img{border:none}abbr,acronym{border-bottom:1px dotted;cursor:help}sup,sub{vertical-align:baseline;position:relative;top:-.4em;font-size:86%}sub{top:.4em}small{font-size:86%}kbd{font-size:80%;border:1px solid #999;padding:2px 5px;border-bottom-width:2px;border-radius:3px}mark{background-color:#ffce00;color:black}p,blockquote,pre,table,figure,hr,form,ol,ul,dl{margin:1.5em 0}hr{height:1px;border:none;background-color:#666}h1,h2,h3,h4,h5,h6{font-weight:bold;line-height:normal;margin:1.5em 0 0}h1{font-size:200%}h2{font-size:180%}h3{font-size:160%}h4{font-size:140%}h5{font-size:120%}h6{font-size:100%}ol,ul,dl{margin-left:3em}ol{list-style:decimal outside}ul{list-style:disc outside}li{margin:.5em 0}dt{font-weight:bold}dd{margin:0 0 .5em 2em}input,button,select,textarea{font:inherit;font-size:100%;line-height:normal;vertical-align:baseline}textarea{display:block;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box}pre,code{font-family:"Courier New",Courier,Monospace;color:inherit}pre{white-space:pre;word-wrap:normal;overflow:auto}blockquote{margin-left:2em;margin-right:2em;border-left:4px solid #ccc;padding-left:1em;font-style:italic}table[border="1"] th,table[border="1"] td,table[border="1"] caption{border:1px solid;padding:.5em 1em;text-align:left;vertical-align:top}th{font-weight:bold}table[border="1"] caption{border:none;font-style:italic}.no-print{display:none} @media print{table{width:100%;color:black;} .fontsetting{font-color:black;}}</textarea>
    <iframe id="printing-frame" name="print_frame" src="about:blank" style="display:none;"></iframe>
  </body>
</html>