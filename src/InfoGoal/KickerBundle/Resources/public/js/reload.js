/**
 * Created by Aurelija on 2015-05-11.
 */

$(document).ready(function () {
    function load() {
        var tableReload = setInterval(function () {
            $("#table").load(location.href + " #table");
            console.log('refreshed');
        }, 2000);
        if ($("#table-game").hasClass("match-results")) {
            clearInterval(tableReload);
            setTimeout(function (){
                console.log('10');
                $("#table").load(location.href + " #table");
                load();
            }, 10000)

        }
    }

    load();
});
