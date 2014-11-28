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
    
    $('#handle').on("blur",function(){
       $('#signature').attr("src","http://vps36292.ovh.net/mordu/t/"+$('#select_teamP_joueur option:selected').text()+"/"+$('#handle').val()+".png");
    });
    
    $('#select_teamP_joueur').on("change",function(){
        if($(this).val()==-1) location.href='?action=ajout_team'
       $('#signature').attr("src","http://vps36292.ovh.net/mordu/t/"+$('#select_teamP_joueur option:selected').text()+"/"+$('#handle').val()+".png");
    });
    
  });