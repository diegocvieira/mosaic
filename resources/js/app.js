$(function() {
    $('body').css('opacity', '1');

    if (localStorage.getItem('stores_storage') != null) {
        $('.page-home .stores').html(localStorage.getItem('stores_storage'));
    }

    if (localStorage.getItem('category_storage') != null) {
        $('header').find('nav .stores-filter-category').removeClass('active');
        $('header .stores-filter-category[data-slug=' + localStorage.getItem('category_storage') + ']').addClass('active');
    }

    if (localStorage.getItem('keyword_storage') != null) {
        $('header .form-search').find('input[type=text]').val(localStorage.getItem('keyword_storage'));
    }

    $('header .logo').on('click', function(e) {
        e.preventDefault();

        $('body').append("<div class='loading'></div>");

        var href = $(this).attr('href');

        localStorage.removeItem('keyword_storage');
        localStorage.removeItem('stores_storage');

        $.ajax({
            url: '/lojas/store-keyword',
            method: 'GET',
            complete: function (data) {
                window.location.href = href;
            }
        });
    });

    // Open menu
    $(document).on('click', 'header nav .open-menu', function() {
        $('header').append("<div class='backdrop backdrop-menu'></div>");

        var ul = $('header nav ul');

        ul.addClass('active');

        // if (ul[0].scrollHeight >= screen.height) {
        //     ul.css('bottom', '10px');
        // }
    });

    // Close menu
    $(document).on('click', 'header .backdrop-menu', function() {
        $('header nav ul').removeClass('active');

        $(this).remove();
    });

    // Search stores
    $(document).on('submit', 'header .form-search', function() {
        var input = $(this).find('input[type=text]'),
            keyword = convertToSlug(input.val());

        if (keyword) {
            input.blur();

            $('body').append("<div class='loading'></div>");

            setTimeout(function() {
                $('.loading').remove();

                $('.stores a').each(function(index, element) {
                    $(this).attr('href', $(this).data('search').replace('__keyword__', keyword));
                });

                if (!$('.stores').find('.advice').length) {
                    $('.stores').find('.category-name').after("<span class='advice'>Selecione uma loja para ver os produtos</span>");
                }

                // store keyword in session
                $.ajax({ url: '/lojas/store-keyword/' + keyword, method: 'GET' });

                localStorage.setItem('stores_storage', $('.stores').html());
                localStorage.setItem('keyword_storage', keyword);
            }, 1000);
        }

        return false;
    });

    // Stores filter category
    $(document).on('click', 'header nav .stores-filter-category', function(e) {
        e.preventDefault();

        var category_name = $(this).text(),
            category_slug = $(this).data('slug');

        $('header').find('nav .stores-filter-category').removeClass('active');
        $(this).addClass('active');

        $('header .backdrop-menu').trigger('click');

        $('body').append("<div class='loading'></div>");

        $.ajax({
            url: $(this).attr('href'),
            method: 'GET',
            dataType: 'json',
            success: function (data) {
                $('.loading').remove();

                $('.stores').html('');
                $('header .form-search').find('input[type=text]').val('');

                // Remove keyword in session
                $.ajax({ url: '/lojas/store-keyword', method: 'GET' });

                $('.stores').append("<h4 class='category-name'>" + category_name + "</h4>");

                $(data).each(function(index, store) {
                    $('.stores').append(
                        "<a href='" + store.url_home + "' data-search='" + store.url_search + "' class='store'>"
                            + "<img src='/storage/uploads/" + store.image + "' alt='" + store.name + "' class='store-image' />"
                            + "<h3 class='store-name'>" + store.name + "</h3>"
                        + "</a>"
                    );
                });

                localStorage.setItem('stores_storage', $('.stores').html());
                localStorage.setItem('category_storage', category_slug);
            },
            error: function (request, status, error) {
                $('.loading').remove();

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

function convertToSlug(string) {
    return string.toString().toLowerCase()
        .replace(/[????????????????????????]+/g, 'a')       // Special Characters #1
        .replace(/[????????????????]+/g, 'e')       	// Special Characters #2
        .replace(/[????????????????]+/g, 'i')       	// Special Characters #3
        .replace(/[??????????????????????]+/g, 'o')       	// Special Characters #4
        .replace(/[????????????????]+/g, 'u')       	// Special Characters #5
        .replace(/[????????]+/g, 'y')       		// Special Characters #6
        .replace(/[????]+/g, 'n')       			// Special Characters #7
        .replace(/[????]+/g, 'c')       			// Special Characters #8
        .replace(/[??]+/g, 'ss')       			// Special Characters #9
        .replace(/[????]+/g, 'ae')       			// Special Characters #10
        .replace(/[??????]+/g, 'oe')       		// Special Characters #11
        .replace(/[%]+/g, 'pct')       			// Special Characters #12
        .replace(/\s+/g, '-')           		// Replace spaces with -
        .replace(/[^\w\-]+/g, '')       		// Remove all non-word chars
        .replace(/\-\-+/g, '-')         		// Replace multiple - with single -
        .replace(/^-+/, '')             		// Trim - from start of text
        .replace(/-+$/, '');
}
