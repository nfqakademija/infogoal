jQuery(document).on("click", "#makeReservation", function () {
    var reservationDialog = jQuery("#reservationDialog");
    var backOverlay = jQuery("#backgroundOverlay");
    var reservationBtn = jQuery("#makeReservation");

    backOverlay.removeClass("hidden");
    reservationDialog.removeClass("hidden");

    reservationDialog.dialog({
        resizable: false,
        draggable: false,
        width: 350,
        height: 150,
        modal: false,
        buttons: {
            "Patvirtinti": function () {
                reservationDialog.text('Prašome palaukti...');
                reservationDialog.parent().children(".ui-dialog-titlebar, .ui-dialog-buttonpane").hide();
                jQuery.ajax({
                    url: reservationBtn.data("url"),
                    type: "POST",
                    success: function (data, textStatus, jqXHR) {
                        if (parseInt(data) == 1) {
                            reservationDialog.text("Rezervacija sėkminga! Nedelskite - rezervacija galioja tik vieną minutę!");
                        } else {
                            reservationDialog.text("Stalas jau rezervuotas!");
                        }
                        reservationDialog.append("<p class=\"text-right\"><a class=\"close-link\" href=\"#\">Uždaryti</a></p>");
                        reservationBtn.hide();
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                    }
                });
            },
            "Atšaukti": function () {
                closeDialog();
            }
        }
    });

    jQuery(document).on("click", ".close-link", function(){
        closeDialog();
    });

    function closeDialog()
    {
        reservationDialog.dialog("close");
        backOverlay.addClass("hidden");
    }
});