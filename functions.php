<?php

// Регистрируем меню
function my_theme_register_menus() {
    register_nav_menus(array(
        'header' => __('Header Menu', 'your-theme-textdomain'),
        'footer' => __('Footer Menu', 'your-theme-textdomain')
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
        'has_archive' => true,
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

// // === Редирект /product-category/ на архив продуктов ===
// function redirect_taxonomy_base_to_archive() {
//     // Проверяем, что это именно /product-category/ без категории
//     $request_uri = trim($_SERVER['REQUEST_URI'], '/');
    
//     if ($request_uri === 'product-category') {
//         wp_redirect(home_url('/products/'), 301);
//         exit;
//     }
// }
// add_action('template_redirect', 'redirect_taxonomy_base_to_archive');




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