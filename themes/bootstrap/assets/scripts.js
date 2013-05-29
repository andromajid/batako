$(function() {
    //overiding window alert 
    window.alert = function(text) {
        bootbox.alert(text);
    }
    $(document).ajaxStart(function() {
        $('.loading').show(200);
    }).ajaxComplete(function() {
        $('.loading').hide(200);
    }).ajaxError(function(event, request, settings, exception) {
         $('.loading').hide(200);
         alert("ERROR(404) : Page "+settings.url+" Not Found");
    });
    // Side Bar Toggle
    $('.hide-sidebar').click(function() {
        $('#sidebar').hide('fast', function() {
            $('#content').removeClass('span9');
            $('#content').addClass('span12');
            $('.hide-sidebar').hide();
            $('.show-sidebar').show();
        });
    });

    $('.show-sidebar').click(function() {
        $('#content').removeClass('span12');
        $('#content').addClass('span9');
        $('.show-sidebar').hide();
        $('.hide-sidebar').show();
        $('#sidebar').show('fast');
    });
    $('.slide-card').bind('click', function() {
        $(this).parent().find('.block-content').slideToggle(10);
    });
});