$(document).ready(function () {
    var ias = jQuery.ias({
        container: 'main.container',
        item: '.block',
        pagination: '#pagination',
        next: '.next'
    });
    ias.extension(new IASSpinnerExtension());
});