$(document).ready(function () {

    $('.button_prevent_multiple_submits').on('click', function () {
        $(this).attr('disabled', 'true');
        $('.form_prevent_multiple_submits').submit();
    });

});
