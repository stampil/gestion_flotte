function annule_sortie(id){
    
 var ok = confirm("Etes vous sur de supprimé cette sortie? elle ne sera plus accessible dans le calendrier"); 
 if(ok){
     location.href='annule_sortie.php?id_sortie='+id;
 }
}


