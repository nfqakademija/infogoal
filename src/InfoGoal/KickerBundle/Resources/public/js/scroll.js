$(document).ready(function () {
    var ias = jQuery.ias({
        container: '.timeline-centered',
        item: '.timeline-entry',
        pagination: '#pagination',
        next: '.next',
        negativeMargin: 350
    });
    ias.extension(new IASSpinnerExtension());
});