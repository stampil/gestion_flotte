$(function() {
    $('#email').on("change",function(){
        $('#email_oublie_mdp').val($(this).val());
    });
    $('#mdp_oublie').on("click",function(){
        $( "#dialog" ).dialog();
    });
    
});

