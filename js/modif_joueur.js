$(function() {
    $(".numberVaisseau").on("change",function(){
        if($(this).val()>0){
            $(this).parent().parent().find(".in_container_vaisseauMedium").removeClass( "disabled", 500);          
        }
        else{
            $(this).parent().parent().find(".in_container_vaisseauMedium").addClass( "disabled", 500);
        }
    });
    
    $('input[type="password"]').on("click",function(){
        alert('Pour des raisons de sécurité,\nne mettez ni votre mot de passe forum, ni votre mot de passe du jeu.\nCe mot de passe ne sert que pour s\'identifier sur ce site');
    });
  });