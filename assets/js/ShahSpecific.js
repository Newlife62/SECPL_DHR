$(document).ready(function(){
    $('#dhr_type').change(function(){
        ordertable.ajax.reload();
    }).change();
    
     $('#coa_type').change(function(){
        coadetails.ajax.reload();
    }).change();
    
});