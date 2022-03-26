$(function(){
    
    $('input[type=checkbox]').change(function() {
        var chk= $(this).prop('checked');

        if(chk){
            $('button').prop('disabled', false);
        }else{
            $('button').prop('disabled', true);
        }
    });

});