$(document).ready(function () {

    $('#menu div').click(function () {
        console.log('href','?action=' + $(this).attr("action"));
        window.location.href = '?action=' + $(this).attr("action");
        
    });

});
