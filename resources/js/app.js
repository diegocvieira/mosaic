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

        $('.no-store').remove();

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

    // Search stores
    $(document).on('submit', 'header .form-search', function() {
        var keyword = $(this).find('input[type=text]').val(),
            site = $('.stores').find('.active');

        if (site.length && keyword) {
            $('.page').find('iframe').attr('src', site.data('search').replace('__keyword__', keyword));
        }

        return false;
    });

    // Stores filter category
    $(document).on('click', 'header nav .stores-filter-category', function(e) {
        e.preventDefault();

        $('header').find('nav .stores-filter-category').removeClass('active');
        $(this).addClass('active');

        $('header .backdrop-menu').trigger('click');

        $.ajax({
            url: $(this).attr('href'),
            method: 'GET',
            dataType: 'json',
            success: function (data) {
                $('.stores ul').find('li').remove();

                $(data).each(function(index, element) {
                    $('.stores ul').append("<li><a href='" + element.url_home + "' data-search='" + element.url_search + "'>" + element.name + "</a></li>");
                });
            },
            error: function (request, status, error) {
                alert('Ocorreu um erro inesperado. Por favor, tente novamente.');
            }
        });
    });

    // Show stores
    $(document).on('click', '.page-list-stores .category-name', function() {
        $(this).next().slideToggle();

        $(this).toggleClass('open');
    });

    // Change store status (activate/desactivate)
    $(document).on('click', '.page-list-stores .store', function(e) {
        e.preventDefault();

        var store_id = $(this).data('storeid'),
            divswitch = $('.store[data-storeid=' + store_id + ']').find('.switch'),
            status = divswitch.hasClass('active') ? 'desativar' : 'ativar',
            url = '/lojas/' + status + '/' + store_id;

        divswitch.toggleClass('active');

        $.ajax({
            url: url,
            method: 'GET',
            dataType: 'json',
            success: function (data) {

            },
            error: function (request, status, error) {
                divswitch.toggleClass('active');

                alert('Ocorreu um erro inesperado. Por favor, tente novamente.');
            }
        });
    });

    // Suggest store
    $(document).on('submit', '.page-list-stores .suggest-store form', function(e) {
        var form = $(this),
            btn = form.find('input[type=submit]');

        if (form.find('input[name=store_name]').val() && form.find('input[name=store_url]').val()) {
            btn.prop('disabled', true).val('ENVIANDO');

            $.ajax({
                url: form.attr('action'),
                method: 'POST',
                dataType: 'json',
                data: $(this).serialize(),
                success: function (data) {
                    btn.prop('disabled', false).val('ENVIAR');

                    if (data.success) {
                        form.find('input[type=text]').val('');
                    }

                    alert(data.message);
                },
                error: function (request, status, error) {
                    btn.prop('disabled', false).val('ENVIAR');

                    alert('Ocorreu um erro inesperado. Por favor, tente novamente.');
                }
            });
        }

        return false;
    });

    $(document).on('click', '.delete-button', function(e) {
        if (confirm('Tem certeza que deseja excluir?')) {
            return true;
        } else {
            return false;
        }
    });
});
