/**
 * Created by Aurelija on 2015-05-11.
 */

$(document).ready(function () {
    var tableReload;
    function load() {
        $("#table").load(location.href + " #table");
        if ($("#table-game").hasClass("match-results")) {
            tableReload = setTimeout(function () {
                load();
            }, 10000);
            console.log(10);
        } else {
            tableReload = setTimeout(function () {
                load();
            }, 1000);
            console.log(1);
        }
    }

    load();
});
