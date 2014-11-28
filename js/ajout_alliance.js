 $(function() {
    $(".prive").hide();
    $( "#id_constructeur" ).selectmenu();
    $('input[name="prive"]').click(function(){
        if($(this).val()==1){
            $(".prive").show();
        }
        else{
            $(".prive").hide();
        }
    });
  });