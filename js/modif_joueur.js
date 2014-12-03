$(function() {
    $(".numberVaisseau").on("change",function(){
        if($(this).val()>0){
            $(this).parent().parent().find(".in_container_vaisseauMedium").removeClass( "disabled", 500);          
        }
        else{
            $(this).parent().parent().find(".in_container_vaisseauMedium").addClass( "disabled", 500);
        }
    });
    
    $('a[name="supprimer"]').on("click", function(e){
        var check = confirm('Etes vous sur de supprimer ce vaisseau de votre flotte?');
        if(!check) {
            e.preventDefault();
            return false;
        }
    });

  });