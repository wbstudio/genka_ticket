$(function(){

    //shop情報のcheckbox
    $('input[name=permission_chk]').change(function() {
            var chkPermission = $(this).prop('checked');
            if(chkPermission){
                $(".submit_btn").prop("disabled", false);
            }else{
                $(".submit_btn").prop("disabled", true);
            }            
    })
});