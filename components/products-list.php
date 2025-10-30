<section class="grid-show">
    <div class="container products-area">

        <?php get_template_part('components/category-list-block'); ?>

        <div class="category-elements-block">

            <?php
            $current_category = get_queried_object();

            if ($current_category && isset($current_category->term_id)) :

                // Получаем выбранную сортировку из GET
                $sort = $_GET['sort'] ?? '';

                // Настройки сортировки
                $meta_key = '';
                $orderby  = 'date';
                $order    = 'DESC';

                switch ($sort) {
                    case 'price_asc':
                        $meta_key = 'price'; // поле ACF "price"
                        $orderby  = 'meta_value_num';
                        $order    = 'ASC';
                        break;
                    case 'price_desc':
                        $meta_key = 'price';
                        $orderby  = 'meta_value_num';
                        $order    = 'DESC';
                        break;
                    case 'views_asc':
                        $meta_key = 'views'; // поле ACF "views"
                        $orderby  = 'meta_value_num';
                        $order    = 'ASC';
                        break;
                    case 'views_desc':
                        $meta_key = 'views';
                        $orderby  = 'meta_value_num';
                        $order    = 'DESC';
                        break;
                }

                // Основной запрос
                $args = [
                    'post_type'      => 'product',
                    'posts_per_page' => -1,
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

                // Если сортировка по метаполю, добавляем его
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

                <!-- Верхняя панель -->
                <div class="products-top-bar" style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;">
                    <div class="products-count">
                        Количество товаров: <strong><?php echo $product_count; ?></strong>
                    </div>

                    <div class="products-sort">
                        <form method="get" id="sort-form">
                            <label for="sort" style="margin-right:8px;">Сортировать по:</label>
                            <select name="sort" id="sort" onchange="this.form.submit()">
                                <option value="">По умолчанию</option>
                                <option value="price_asc" <?php selected($sort, 'price_asc'); ?>>Цене (возрастание)</option>
                                <option value="price_desc" <?php selected($sort, 'price_desc'); ?>>Цене (убывание)</option>
                                <option value="views_asc" <?php selected($sort, 'views_asc'); ?>>Популярности (меньше → больше)</option>
                                <option value="views_desc" <?php selected($sort, 'views_desc'); ?>>Популярности (больше → меньше)</option>
                            </select>
                        </form>
                    </div>
                </div>

                <div class="grid-products-elements">
                    <?php
                    if ($products->have_posts()) :
                        while ($products->have_posts()) : $products->the_post();

                            $product_data = [
                                'gallery' => get_field('gallery'),
                                'price'   => get_field('price'),
                                'title'   => get_the_title(),
                                'excerpt' => wp_trim_words(get_the_excerpt(), 10, '...'),
                                'views'   => get_field('views'), // используем ACF
                            ];

                            get_template_part('components/product-card', null, $product_data);

                        endwhile;
                        wp_reset_postdata();
                    else :
                        echo '<p>Товары не найдены.</p>';
                    endif;
                    ?>
                </div>

            <?php endif; ?>
        </div>
    </div>
</section>
