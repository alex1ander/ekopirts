<section class="grid-show">
    <div class="container products-area">

        <!-- Блок с постами (категории или теги) -->
        <div class="category-elements-block">
            <?php
            // Определяем тип архива (категория или тег)
            if (is_category()) {
                $tax_query = array(
                    array(
                        'taxonomy' => 'category',
                        'field'    => 'slug',
                        'terms'    => get_query_var('category_name'),
                    ),
                );
                $title = single_cat_title('', false);
                $taxonomy_type = 'category';
                $taxonomy_term = get_query_var('category_name');
            } elseif (is_tag()) {
                $tax_query = array(
                    array(
                        'taxonomy' => 'post_tag',
                        'field'    => 'slug',
                        'terms'    => get_query_var('tag'),
                    ),
                );
                $title = single_tag_title('', false);
                $taxonomy_type = 'post_tag';
                $taxonomy_term = get_query_var('tag');
            } else {
                $tax_query = array();
                $title = __('All Posts', 'ekopirts');
                $taxonomy_type = '';
                $taxonomy_term = '';
            }

            // WP_Query с учётом категории или тега
            $args = array(
                'post_type'      => 'post',
                'posts_per_page' => 12,
                'paged'          => 1,
                'tax_query'      => $tax_query,
            );

            $news_query = new WP_Query($args);
            ?>

            <div class="grid-products-elements" id="news-container">
                <?php
                // Вывод постов
                if ($news_query->have_posts()) :
                    while ($news_query->have_posts()) : $news_query->the_post();
                        get_template_part('components/news', 'card');
                    endwhile;
                else :
                    echo '<p>' . __('No posts found.', 'ekopirts') . '</p>';
                endif;

                wp_reset_postdata();
                ?>
            </div>

            <?php if ($news_query->max_num_pages > 1) : ?>
                <div class="load-more-wrapper">
                    <button class="btn btn-red load-more-news" 
                            data-page="1" 
                            data-max="<?php echo $news_query->max_num_pages; ?>"
                            data-taxonomy="<?php echo esc_attr($taxonomy_type); ?>"
                            data-term="<?php echo esc_attr($taxonomy_term); ?>">
                        <?php _e('Load More', 'ekopirts'); ?>
                    </button>
                </div>
            <?php endif; ?>
        </div>

        <!-- Блок со списком категорий -->
        <?php get_template_part('components/category-list-block'); ?>

    </div>
</section>
