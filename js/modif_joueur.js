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
    
    $('input[data-remplace]').each(function(){
        var id_remplace =$(this).attr("data-remplace");
        console.log('remplace',id_remplace);
         $('input[data-id='+id_remplace+']').prop('checked',false).prop('disabled',true).prop('title','Une meilleur decoration remplace celle là');

    });

  });