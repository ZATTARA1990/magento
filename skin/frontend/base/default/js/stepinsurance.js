(function ($) {
    $('#cost').text();
    $('#insurance').change(function () {
        var val = $('#insurance').val();

        if(val == 1){
            $('#cost').text(cost);
            $('#insurance-message').show()
        }
        if(val == 2) {
            $('#insurance-message').hide()
        }
    });
}(jQuery));
