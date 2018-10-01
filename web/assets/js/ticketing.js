$(function () {
    $('#form_visitor').hide();

    $('#form_first').submit(function (e) {
        e.preventDefault();
        $('#form_visitor').show();
        var nbVisitor = $('#louvres_ticketingbundle_booking_quantity').val();
        if (nbVisitor > 1) {
            for (i=1;i < nbVisitor;i++) {
                $('#divFormVisitor').clone().appendTo('article');
            }
        }
    });
});