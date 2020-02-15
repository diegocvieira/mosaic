$(function() {
    // $('body').css('opacity', '1');
    $('.loading').remove();

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

    // Search stores
    // $(document).on('submit', 'header .form-search', function() {
    //     var input = $(this).find('input[type=text]'),
    //         keyword = convertToSlug(input.val());
    //
    //     if (keyword) {
    //         $('.stores a').each(function(index, element) {
    //             $(this).attr('href', $(this).data('search').replace('__keyword__', keyword));
    //         });
    //
    //         if (!$('.stores').find('.advice').length) {
    //             $('.stores').find('.category-name').after("<span class='advice'>Selecione uma loja para ver os produtos</span>");
    //         }
    //
    //         input.blur();
    //
    //         // store keyword in session
    //         $.ajax({ url: '/store-keyword/' + keyword, method: 'GET' });
    //
    //         window.location.href = "https://www.mosaicapp.com.br";
    //     }
    //
    //     return false;
    // });

    // Stores filter category
    // $(document).on('click', 'header nav .stores-filter-category', function(e) {
    //     e.preventDefault();
    //
    //     $('header').find('nav .stores-filter-category').removeClass('active');
    //     $(this).addClass('active');
    //
    //     $('header .backdrop-menu').trigger('click');
    //
    //     $('body').append("<div class='loading'></div>");
    //
    //     $.ajax({
    //         url: $(this).attr('href'),
    //         method: 'GET',
    //         dataType: 'json',
    //         success: function (data) {
    //             $('.loading').remove();
    //
    //             $('.stores').html('');
    //             $('header .form-search').find('input[type=text]').val('');
    //
    //             // Remove keyword in session
    //             $.ajax({ url: '/store-keyword', method: 'GET' });
    //
    //             $('.stores').append("<h4 class='category-name'>" + $(data)[0].categories[0].name + "</h4>");
    //
    //             $(data).each(function(index, store) {
    //                 $('.stores').append(
    //                     "<a href='" + store.url_home + "' data-search='" + store.url_search + "' class='store'>"
    //                         + "<img src='/storage/uploads/" + store.image + "' alt='" + store.name + "' class='store-image' />"
    //                         + "<h3 class='store-name'>" + store.name + "</h3>"
    //                     + "</a>"
    //                 );
    //             });
    //
    //             window.location.href = "https://www.mosaicapp.com.br";
    //         },
    //         error: function (request, status, error) {
    //             $('.loading').remove();
    //
    //             alert('Ocorreu um erro inesperado. Por favor, tente novamente.');
    //         }
    //     });
    // });

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
        .replace(/[àÀáÁâÂãäÄÅåª]+/g, 'a')       // Special Characters #1
        .replace(/[èÈéÉêÊëË]+/g, 'e')       	// Special Characters #2
        .replace(/[ìÌíÍîÎïÏ]+/g, 'i')       	// Special Characters #3
        .replace(/[òÒóÓôÔõÕöÖº]+/g, 'o')       	// Special Characters #4
        .replace(/[ùÙúÚûÛüÜ]+/g, 'u')       	// Special Characters #5
        .replace(/[ýÝÿŸ]+/g, 'y')       		// Special Characters #6
        .replace(/[ñÑ]+/g, 'n')       			// Special Characters #7
        .replace(/[çÇ]+/g, 'c')       			// Special Characters #8
        .replace(/[ß]+/g, 'ss')       			// Special Characters #9
        .replace(/[Ææ]+/g, 'ae')       			// Special Characters #10
        .replace(/[Øøœ]+/g, 'oe')       		// Special Characters #11
        .replace(/[%]+/g, 'pct')       			// Special Characters #12
        .replace(/\s+/g, '-')           		// Replace spaces with -
        .replace(/[^\w\-]+/g, '')       		// Remove all non-word chars
        .replace(/\-\-+/g, '-')         		// Replace multiple - with single -
        .replace(/^-+/, '')             		// Trim - from start of text
        .replace(/-+$/, '');
}
