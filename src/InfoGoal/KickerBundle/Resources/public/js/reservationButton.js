$(document).ready(function () {
    function load() {
        $.ajax({
            type: "GET",
            url: '/reservation_button',
            success: function (data) {
                $('#reservation-button').replaceWith(data);
            }
        });
        setTimeout(function () {
            load();
        }, 1000);
    }
    if ($('#reservation-button').length) {
       load();
    }
});