    $('#schools').change(function(){

        $.ajax({
            type:'post',
            url:baseurl+'AdminController/GetTeachers',
            dataType:'json',
            data:{school_id:$('#schools').val()},
            success:function(data){
                var opt ='<option value="">Select Teacher</option>';
                for(var i=0;i<data.length;i++){
                    opt +='<option value="'+data[i].id+'">'+data[i].teacher_name+'</option>';
                }
                 $('#teachers').html('');
                 $('#teachers').html(opt);
             }
        });


    });

    $('#schools,#teachers').change(function(){
    	var directto ='';
    	if($('#teachers').val()==''){
    		directto = 'GetSchoolLedgerReport';
    	}else if($('#teachers').val()!=''){
    		directto = 'GetTeachersLedgerReport';
    	}
        $.ajax({
             type:'post',
             url:baseurl+'AdminController/'+directto,
             data:{
             	teacher_id:$('#teachers').val(),
             	school_id:$('#schools').val(),
             	from:$('#from').val(),
             	to:$('#to').val(),
             },
             success:function(response){
                 $('#shareledger').html('');
                 $('#shareledger').html(response);
             }
         });
    });
    
    $('#onlyteacher').change(function(){
    	var directto ='';
    		directto = 'GetTeachersLedgerReportTeacher';
    	
        $.ajax({
             type:'post',
             url:baseurl+'UserController/'+directto,
             data:{
             	teacher_id:$('#onlyteacher').val(),
             	from:$('#from').val(),
             	to:$('#to').val(),
             },
             success:function(response){
                 $('#shareledger').html('');
                 $('#shareledger').html(response);
             }
         });
    });
    
    $('#userto').change(function(){
    	var directto ='';
    		directto = 'GetTeachersLedgerReportTeacher';
    	
        $.ajax({
             type:'post',
             url:baseurl+'UserController/'+directto,
             data:{
             	teacher_id:$('#onlyteacher').val(),
             	from:$('#userfrom').val(),
             	to:$('#userto').val(),
             },
             success:function(response){
                 $('#shareledger').html('');
                 $('#shareledger').html(response);
             }
         });
    });

    $('#bank_id').change(function(){
    	$.ajax({
             type:'post',
             url:baseurl+'AdminController/CashBookReport',
             data:{
             	from    :$('#from').val(),
             	to      :$('#to').val(),
             	bank_id :$('#bank_id').val(),
             },
             success:function(response){
                 $('#cashbook').html('');
                 $('#cashbook').html(response);
             }
         });
    });

    $('#school_id').change(function(){
            $.ajax({
                 type:'post',
                 url:baseurl+'AdminController/LoanSharePdf',
                 data:{school_id:$('#school_id').val()},
                 success:function(response){
                     $('#loansharepdf').html('');
                     $('#loansharepdf').html(response);
                 }
             });
        });

    function printspecifiedDiv(elementId){
        var a = document.getElementById('printing-css').value;
        var b = document.getElementById(elementId).innerHTML;
        window.frames["print_frame"].document.title = document.title;
        window.frames["print_frame"].document.body.innerHTML = '<style>' + a + '</style>' + b;
        window.frames["print_frame"].window.focus();
        window.frames["print_frame"].window.print();
    }
    
    function exportexcel(name,id) {
        
            $("#"+id).table2excel({
                name: "Table2Excel",
                filename: name,
                fileext: ".xls"
            });
            
        } 
        
        $('#chartschools').change(function(){

        $.ajax({
            type:'post',
            url:baseurl+'AdminController/GetTeachers',
            dataType:'json',
            data:{school_id:$('#chartschools').val()},
            success:function(data){
                var opt ='<option value="">Select Teacher</option>';
                for(var i=0;i<data.length;i++){
                    opt +='<option value="'+data[i].id+'">'+data[i].teacher_name+'</option>';
                }
                 $('#chartteachers').html('');
                 $('#chartteachers').html(opt);
             }
        });


    });
    
     $('#chartteachers').change(function(){
    	$.ajax({
             type:'post',
             url:baseurl+'AdminController/GetTeachersLoanChart',
             data:{
             	teacher_id:$('#chartteachers').val(),
             	school_id:$('#chartschools').val(),
             },
             success:function(response){
                 $('#loanchart').html('');
                 $('#loanchart').html(response);
             }
         });
    });

    $('#givendate').change(function(){
            $.ajax({
                 type:'post',
                 url:baseurl+'AdminController/GivenDateCollectedShareLoan',
                 data:{givendate:$('#givendate').val()},
                 success:function(response){
                     $('#shareloan').html('');
                     $('#shareloan').html(response);
                 }
             });
        });