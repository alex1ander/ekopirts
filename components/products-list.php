<section class="grid-show">
    <div class="container products-area">

        <?php get_template_part('components/category-list-block'); ?>

        <div class="category-elements-block">

            <?php
            $current_category = get_queried_object();

            if ($current_category && isset($current_category->term_id)) :

                // Get selected sort from GET
                $sort = $_GET['sort'] ?? '';

                // Sort settings
                $meta_key = '';
                $orderby  = 'date';
                $order    = 'DESC';

                switch ($sort) {
                    case 'price_asc':
                        $meta_key = 'price'; // ACF field "price"
                        $orderby  = 'meta_value_num';
                        $order    = 'ASC';
                        break;
                    case 'price_desc':
                        $meta_key = 'price';
                        $orderby  = 'meta_value_num';
                        $order    = 'DESC';
                        break;
                    case 'views_asc':
                        $meta_key = 'views'; // ACF field "views"
                        $orderby  = 'meta_value_num';
                        $order    = 'ASC';
                        break;
                    case 'views_desc':
                        $meta_key = 'views';
                        $orderby  = 'meta_value_num';
                        $order    = 'DESC';
                        break;
                }

                // Main query
                $args = [
                    'post_type'      => 'product',
                    'posts_per_page' => 12,
                    'paged'          => 1,
                    'tax_query'      => [
                        [
                            'taxonomy' => 'product_category',
                            'field'    => 'term_id',
                            'terms'    => $current_category->term_id,
                        ],
                    ],
                    'orderby' => $orderby,
                    'order'   => $order,
                ];

                // If sorting by meta field, add it
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
                $product_count = $products->found_posts;
            ?>

                <!-- Top panel -->
                <div class="products-top-bar">
                    <div class="products-count">
                        <?php _e('Number of products:', 'ekopirts'); ?> <strong><?php echo $product_count; ?></strong>
                    </div>

                    <div class="products-sort">
                        <form method="get" id="sort-form">
                            <label for="sort"><?php _e('Sort by:', 'ekopirts'); ?></label>
                            <select name="sort" id="sort" onchange="this.form.submit()">
                                <option value=""><?php _e('Default', 'ekopirts'); ?></option>
                                <option value="price_asc" <?php selected($sort, 'price_asc'); ?>><?php _e('Price (Low to High)', 'ekopirts'); ?></option>
                                <option value="price_desc" <?php selected($sort, 'price_desc'); ?>><?php _e('Price (High to Low)', 'ekopirts'); ?></option>
                                <option value="views_asc" <?php selected($sort, 'views_asc'); ?>><?php _e('Popularity (Less → More)', 'ekopirts'); ?></option>
                                <option value="views_desc" <?php selected($sort, 'views_desc'); ?>><?php _e('Popularity (More → Less)', 'ekopirts'); ?></option>
                            </select>
                        </form>
                    </div>
                </div>

                <div class="grid-products-elements" id="products-container">
                    <?php
                    if ($products->have_posts()) :
                        while ($products->have_posts()) : $products->the_post();

                            $product_data = [
                                'gallery' => get_field('gallery'),
                                'price'   => get_field('price'),
                                'title'   => get_the_title(),
                                'excerpt' => wp_trim_words(get_the_excerpt(), 10, '...'),
                                'views'   => get_field('views'), // use ACF
                            ];

                            get_template_part('components/product-card', null, $product_data);

                        endwhile;
                        wp_reset_postdata();
                    endif;
                    ?>
                </div>

                <?php if ($products->max_num_pages > 1) : ?>
                    <div class="load-more-wrapper">
                        <button class="load-more-products" 
                                data-page="1" 
                                data-max="<?php echo $products->max_num_pages; ?>"
                                data-category="<?php echo $current_category->term_id; ?>"
                                data-sort="<?php echo esc_attr($sort); ?>"
                                data-meta-key="<?php echo esc_attr($meta_key); ?>"
                                data-orderby="<?php echo esc_attr($orderby); ?>"
                                data-order="<?php echo esc_attr($order); ?>">
                            <?php _e('Load More', 'ekopirts'); ?>
                        </button>
                    </div>
                <?php endif; ?>

            <?php endif; ?>
        </div>
    </div>
</section>
