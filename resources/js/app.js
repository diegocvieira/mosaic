$(function() {
    $('body').css('opacity', '1');

    // Open menu
    $(document).on('click', 'header nav .open-menu', function() {
        $('header').append("<div class='backdrop backdrop-menu'></div>");

        $('header nav ul').addClass('active');
    });

    // Close menu
    $(document).on('click', 'header .backdrop-menu', function() {
        $('header nav ul').removeClass('active');

        $(this).remove();
    });

    // Show store homepage
    $(document).on('click', '.stores a', function(e) {
        e.preventDefault();

        $('.stores').find('a').removeClass('active');

        $(this).addClass('active');

        if (!$('.page').find('iframe').length) {
            $('.page').append("<iframe src=''></iframe>");
        }

        $('.page').find('iframe').attr('src', $(this).attr('href'));
    });

    // Show store search
    $(document).on('submit', 'header .form-search', function() {
        var keyword = $(this).find('input[type=text]').val(),
            site = $('.stores').find('.active');

        if (site.length) {
            $('.page').find('iframe').attr('src', site.data('search') + keyword);
        } else {
            alert('selecione uma loja');
        }

        return false;
    });
});
