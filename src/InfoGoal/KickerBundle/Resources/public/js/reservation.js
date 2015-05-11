jQuery(document).on("click", "#makeReservation", function () {
    var reservationDialog = jQuery("#reservationDialog");
    var backOverlay = jQuery("#backgroundOverlay");

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
                jQuery(this).dialog("close");
                backOverlay.addClass("hidden");
            },
            "Atšaukti": function () {
                jQuery(this).dialog("close");
                backOverlay.addClass("hidden");
            }
        }
    });
});