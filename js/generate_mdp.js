$(function(){

    $( "#form" ).submit(function( event ) {
        if($( "#mdp" ).val()!=$( "#mdp2" ).val()){
            alert( "les mdps ne correspondent pas!" );
            return false;
        }
    });
});