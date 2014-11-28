$(document).ready(function () {

    $('#menu div').click(function () {
        window.location.href = '?action=' + $(this).attr("action");
    });

});
