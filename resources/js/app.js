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

        var keyword = $('header .form-search').find('input[type=text]').val();

        $('.stores').find('a').removeClass('active');

        $(this).addClass('active');

        if (!$('.page').find('iframe').length) {
            $('.page').append("<iframe src=''></iframe>");
        }

        if (keyword) {
            $('.page').find('iframe').attr('src', $(this).data('search').replace('__keyword__', keyword));
        } else {
            $('.page').find('iframe').attr('src', $(this).attr('href'));
        }
    });

    // Show store search
    $(document).on('submit', 'header .form-search', function() {
        var keyword = $(this).find('input[type=text]').val(),
            site = $('.stores').find('.active');

        if (site.length) {
            $('.page').find('iframe').attr('src', site.data('search').replace('__keyword__', keyword));
        } else {
            alert('selecione uma loja');
        }

        return false;
    });

    // Stores filter category
    $(document).on('click', 'header nav .stores-filter-category', function(e) {
        e.preventDefault();

        $.ajax({
            url: $(this).attr('href'),
            method: 'GET',
            dataType: 'json',
            success: function (data) {
                $('.stores ul').find('li').remove();

                $(data).each(function(index, element) {
                    $('.stores ul').append("<li><a href='" + element.url_home + "' data-search='" + element.url_search + "'>" + element.name + "</a></li>");
                });

                $('header .backdrop-menu').trigger('click');
            },
            error: function (request, status, error) {
                //modalAlert('Ocorreu um erro inesperado. Atualize a página e tente novamente.');
            }
        });
    });
});
