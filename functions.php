<?php
add_filter( 'wpcf7_autop_or_not', '__return_false' );

// Регистрируем меню
function my_theme_register_menus() {
    register_nav_menus(array(
        'header' => __('Header Menu', 'ekopirts'),
        'footer' => __('Footer Menu', 'ekopirts')
    ));
}
add_action('after_setup_theme', 'my_theme_register_menus');


function theme_enqueue_styles() {
    wp_enqueue_style(
        'theme-style',
        get_template_directory_uri() . '/assets/css/style.css',
        array(),
        filemtime(get_template_directory() . '/assets/css/style.css')
    );
}
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');

function theme_enqueue_scripts() {
    wp_enqueue_script('jquery');
    
    wp_enqueue_script(
        'load-more',
        get_template_directory_uri() . '/assets/js/load-more.js',
        array('jquery'),
        filemtime(get_template_directory() . '/assets/js/load-more.js'),
        true
    );
    
    wp_localize_script('load-more', 'ajax_params', array(
        'ajax_url' => admin_url('admin-ajax.php')
    ));
}
add_action('wp_enqueue_scripts', 'theme_enqueue_scripts');

add_theme_support( 'post-thumbnails' );

// === Custom Post Type: Products ===
function create_products_post_type() {
    $labels = array(
        'name' => 'Products',
        'singular_name' => 'Product',
        'menu_name' => 'Products',
        'add_new' => 'Add New',
        'add_new_item' => 'Add New Product',
        'edit_item' => 'Edit Product',
        'new_item' => 'New Product',
        'view_item' => 'View Product',
        'search_items' => 'Search Products',
        'not_found' => 'No products found',
        'not_found_in_trash' => 'No products in trash',
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        // 'has_archive' => true,
        'rewrite' => array('slug' => 'products'),
        'supports' => array('title', 'editor', 'thumbnail'),
        'show_in_rest' => true,
        'taxonomies' => array('product_category'),
        'menu_icon' => 'dashicons-products',
        'show_in_nav_menus' => true,
    );

    register_post_type('product', $args);
}
add_action('init', 'create_products_post_type');

// === Taxonomy: Product Categories ===
function create_product_taxonomy() {
    $labels = array(
        'name' => 'Product Categories',
        'singular_name' => 'Product Category',
        'search_items' => 'Search Categories',
        'all_items' => 'All Categories',
        'parent_item' => 'Parent Category',
        'parent_item_colon' => 'Parent Category:',
        'edit_item' => 'Edit Category',
        'update_item' => 'Update Category',
        'add_new_item' => 'Add New Category',
        'new_item_name' => 'New Category Name',
        'menu_name' => 'Categories',
    );

    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'product-category'),
        'show_in_rest' => true,
        'show_in_nav_menus' => true,
    );

    register_taxonomy('product_category', array('product'), $args);
}
add_action('init', 'create_product_taxonomy');


if (function_exists('icl_register_string')) {
    icl_register_string('Theme', 'Products', 'Products');
}





///////


add_filter( 'wpseo_breadcrumb_output', function( $output ) {

    // 1️⃣ Удаляем обертку <span> Yoast
    $output = preg_replace( '/<span[^>]*>/', '', $output );
    $output = str_replace('</span>', '', $output);

    // 2️⃣ Добавляем класс к ссылкам
    $output = str_replace('<a ', '<a class="breadcrums-link" ', $output);

    // 3️⃣ Заменяем последний элемент (текущая страница)
    $output = preg_replace(
        '/<span class="breadcrumb_last"[^>]*>(.*?)<\/span>/',
        '<span class="breadcrums-current">$1</span>',
        $output
    );

    // 4️⃣ Добавляем иконку домика к первой ссылке
    $output = preg_replace(
        '/<a class="breadcrums-link" href="([^"]+)">([^<]*)<\/a>/',
        '<a class="breadcrums-link" href="$1">
            <svg width="14" height="12"><use href="#home"></use></svg>
        </a>',
        $output,
        1 // только первая ссылка
    );

    // 5️⃣ Убираем стандартный разделитель (»)
    $output = str_replace('&raquo;', '', $output);
    $output = str_replace('»', '', $output);

    return $output;
});



if ( function_exists('acf_add_options_page') ) {

    acf_add_options_page(array(
        'page_title'  => 'Theme options', // Название в заголовке страницы
        'menu_title'  => 'Theme options', // Название в меню
        'menu_slug'   => 'site-options',    // Слаг страницы
        'capability'  => 'edit_posts',
        'redirect'    => false,
        'position'    => 2, // можно поменять (чтобы страница была выше/ниже в меню)
        'icon_url'    => 'dashicons-admin-generic' // иконка WordPress
    ));
}


add_theme_support( 'title-tag' );


//просмотры
function ekopirts_track_product_views() {
    if (is_singular('product')) {
        global $post;

        $views = (int) get_field('views', $post->ID); // через ACF
        $views++;
        update_field('views', $views, $post->ID);    // через ACF
    }
}
add_action('wp', 'ekopirts_track_product_views');


// === Ajax Load More для товаров ===
function ekopirts_load_more_products() {
    $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $category = isset($_POST['category']) ? intval($_POST['category']) : 0;
    $sort = isset($_POST['sort']) ? sanitize_text_field($_POST['sort']) : '';
    $meta_key = isset($_POST['meta_key']) ? sanitize_text_field($_POST['meta_key']) : '';
    $orderby = isset($_POST['orderby']) ? sanitize_text_field($_POST['orderby']) : 'date';
    $order = isset($_POST['order']) ? sanitize_text_field($_POST['order']) : 'DESC';

    $args = [
        'post_type'      => 'product',
        'posts_per_page' => 12,
        'paged'          => $page,
        'tax_query'      => [
            [
                'taxonomy' => 'product_category',
                'field'    => 'term_id',
                'terms'    => $category,
            ],
        ],
        'orderby' => $orderby,
        'order'   => $order,
    ];

    if ($meta_key) {
        $args['meta_key'] = $meta_key;
        $args['meta_query'] = [
            [
                'key'     => $meta_key,
                'compare' => 'EXISTS',
            ]
        ];
    }

    $products = new WP_Query($args);

    if ($products->have_posts()) :
        while ($products->have_posts()) : $products->the_post();
            $product_data = [
                'gallery' => get_field('gallery'),
                'price'   => get_field('price'),
                'title'   => get_the_title(),
                'excerpt' => wp_trim_words(get_the_excerpt(), 10, '...'),
                'views'   => get_field('views'),
            ];
            get_template_part('components/product-card', null, $product_data);
        endwhile;
        wp_reset_postdata();
    endif;

    wp_die();
}
add_action('wp_ajax_load_more_products', 'ekopirts_load_more_products');
add_action('wp_ajax_nopriv_load_more_products', 'ekopirts_load_more_products');


// === Ajax Load More для новостей ===
function ekopirts_load_more_news() {
    $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $taxonomy = isset($_POST['taxonomy']) ? sanitize_text_field($_POST['taxonomy']) : '';
    $term = isset($_POST['term']) ? sanitize_text_field($_POST['term']) : '';

    $tax_query = array();
    if ($taxonomy && $term) {
        $tax_query = array(
            array(
                'taxonomy' => $taxonomy,
                'field'    => 'slug',
                'terms'    => $term,
            ),
        );
    }

    $args = array(
        'post_type'      => 'post',
        'posts_per_page' => 12,
        'paged'          => $page,
        'tax_query'      => $tax_query,
    );

    $news_query = new WP_Query($args);

    if ($news_query->have_posts()) :
        while ($news_query->have_posts()) : $news_query->the_post();
            get_template_part('components/news', 'card');
        endwhile;
        wp_reset_postdata();
    endif;

    wp_die();
}
add_action('wp_ajax_load_more_news', 'ekopirts_load_more_news');
add_action('wp_ajax_nopriv_load_more_news', 'ekopirts_load_more_news');


