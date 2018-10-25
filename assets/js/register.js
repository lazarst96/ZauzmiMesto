$(function() {
    var $divs = $('#divs > div');
    $divs.first().show()
    $('input[type=radio]').on('change',function() {
        $divs.hide();
        $divs.eq( $('input[type=radio]').index( this ) ).show();
    });
});