Barba.Pjax.start();

$(document).ready(function() {
    $.cookieBar();
});

$(document).ready(function() {
    $(window).scroll(function () {
        if ($(this).scrollTop() > $("header").height() / 2) {
            $('.upArrow').addClass('visible');
            $('.upArrow').removeClass('hidden');
        } else {
            $('.upArrow').removeClass('visible');
            $('.upArrow').addClass('hidden');
        }
    });

    $('.upArrow').click(function () {
        $("html, body").stop(true, true, true).animate({scrollTop: 0}, 600);
        return false;
    });

    $('.collapse').collapse()
});