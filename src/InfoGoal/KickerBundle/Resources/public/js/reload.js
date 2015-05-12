/**
 * Created by Aurelija on 2015-05-11.
 */

$(document).ready(function () {
    var tableReload;

    function load() {
        $.ajax({
            type: "GET",
            url: location.href,
            success: function (data) {
                var response = $('#table', data);
                $('#table').html(response.html());
            }
        });
        if ($("#table-game").hasClass("match-results")) {
            tableReload = setTimeout(function () {
                load();
            }, 10000);
        } else {
            tableReload = setTimeout(function () {
                load();
            }, 1000);
        }
    }

    load();
});
