jQuery(document).ready(function($) {
    
    // Проверка наличия ajax_params
    if (typeof ajax_params === 'undefined') {
        console.error('ajax_params is not defined!');
        return;
    }
    
    console.log('Load More script initialized', ajax_params);
    
    // Load More для товаров
    $(document).on('click', '.load-more-products', function(e) {
        e.preventDefault();
        
        var button = $(this);
        var page = parseInt(button.attr('data-page'));
        var maxPages = parseInt(button.attr('data-max'));
        var category = button.attr('data-category');
        var sort = button.attr('data-sort');
        var metaKey = button.attr('data-meta-key');
        var orderby = button.attr('data-orderby');
        var order = button.attr('data-order');
        
        var nextPage = page + 1;
        
        console.log('Loading products page:', nextPage, 'Category:', category);
        
        button.prop('disabled', true).css('opacity', '0.5');
        
        $.ajax({
            url: ajax_params.ajax_url,
            type: 'POST',
            data: {
                action: 'load_more_products',
                page: nextPage,
                category: category,
                sort: sort,
                meta_key: metaKey,
                orderby: orderby,
                order: order
            },
            success: function(response) {
                console.log('Products response received:', response);
                if (response && response.trim() !== '') {
                    $('#products-container').append(response);
                    button.attr('data-page', nextPage);
                    button.prop('disabled', false).css('opacity', '1');
                    
                    // Скрыть кнопку, если достигли последней страницы
                    if (nextPage >= maxPages) {
                        button.parent().fadeOut();
                    }
                } else {
                    console.log('Empty response, hiding button');
                    button.parent().fadeOut();
                }
            },
            error: function(xhr, status, error) {
                console.error('Ajax error:', status, error, xhr);
                button.prop('disabled', false).css('opacity', '1');
            }
        });
    });
    
    // Load More для новостей
    $(document).on('click', '.load-more-news', function(e) {
        e.preventDefault();
        
        var button = $(this);
        var page = parseInt(button.attr('data-page'));
        var maxPages = parseInt(button.attr('data-max'));
        var taxonomy = button.attr('data-taxonomy');
        var term = button.attr('data-term');
        
        var nextPage = page + 1;
        
        console.log('Loading news page:', nextPage, 'Taxonomy:', taxonomy, 'Term:', term);
        
        button.prop('disabled', true).css('opacity', '0.5');
        
        $.ajax({
            url: ajax_params.ajax_url,
            type: 'POST',
            data: {
                action: 'load_more_news',
                page: nextPage,
                taxonomy: taxonomy,
                term: term
            },
            success: function(response) {
                console.log('News response received:', response);
                if (response && response.trim() !== '') {
                    $('#news-container').append(response);
                    button.attr('data-page', nextPage);
                    button.prop('disabled', false).css('opacity', '1');
                    
                    // Скрыть кнопку, если достигли последней страницы
                    if (nextPage >= maxPages) {
                        button.parent().fadeOut();
                    }
                } else {
                    console.log('Empty response, hiding button');
                    button.parent().fadeOut();
                }
            },
            error: function(xhr, status, error) {
                console.error('Ajax error:', status, error, xhr);
                button.prop('disabled', false).css('opacity', '1');
            }
        });
    });
    
});

