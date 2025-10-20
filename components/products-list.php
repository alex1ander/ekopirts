<section class="grid-show">
    <div class="container products-area">

        <?php get_template_part('components/category-list-block');?>

        <!-- Товары текущей категории -->
        <div class="category-elements-block">
            <div class="grid-products-elements">
                <?php
                $current_category = get_queried_object();

                if ($current_category && isset($current_category->term_id)) :

                    $products = new WP_Query([
                        'post_type'      => 'product',
                        'posts_per_page' => -1,
                        'tax_query'      => [
                            [
                                'taxonomy' => 'product_category',
                                'field'    => 'term_id',
                                'terms'    => $current_category->term_id,
                            ],
                        ],
                    ]);

                    if ($products->have_posts()) :
                        while ($products->have_posts()) : $products->the_post();

                            $product_data = [
                                'gallery' => get_field('gallery'),
                                'price'   => get_field('price'),
                                'title'   => get_the_title(),
                                'excerpt' => wp_trim_words(get_the_excerpt(), 10, '...'),
                            ];

                            get_template_part('components/product-card', null, $product_data);

                        endwhile;
                        wp_reset_postdata();
                    else :
                        echo '<p>No products found in this category</p>';
                    endif;

                endif;
                ?>
            </div>
        </div>

    </div>
</section>
