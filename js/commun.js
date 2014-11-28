$(function() {
    $( "#menu div" )
      .button()
      .click(function( event ) {
        event.preventDefault();
      });
      
    $(document).tooltip();
    
    $(".multiselect").multiselect({
        selectedList: 2
    }).multiselectfilter({
        label:"Filre :",
        placeholder:"Entrer un texte"
    });; 
    
    $(".select").multiselect({
        multiple: false,
        selectedList: 2
    }).multiselectfilter({
        label:"Filre :",
        placeholder:"Entrer un texte"
    }); 
    
  });