<section class="grid-show">
    <div class="container products-area">

        <!-- Блок с постами (категории или теги) -->
        <div class="category-elements-block">
            <div class="grid-products-elements">
                <?php
                // Получаем текущую страницу пагинации
                $paged = get_query_var('paged') ? get_query_var('paged') : 1;

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
                } elseif (is_tag()) {
                    $tax_query = array(
                        array(
                            'taxonomy' => 'post_tag',
                            'field'    => 'slug',
                            'terms'    => get_query_var('tag'),
                        ),
                    );
                    $title = single_tag_title('', false);
                } else {
                    $tax_query = array();
                    $title = __('All Posts', 'ekopirts');
                }

                // WP_Query с учётом категории или тега
                $args = array(
                    'post_type'      => 'post',
                    'posts_per_page' => 12,
                    'paged'          => $paged,
                    'tax_query'      => $tax_query,
                );

                $news_query = new WP_Query($args);

                // Вывод постов
                if ($news_query->have_posts()) :
                    while ($news_query->have_posts()) : $news_query->the_post();
                        get_template_part('components/news', 'card');
                    endwhile;

                    // Пагинация
                    the_posts_pagination(array(
                        'prev_text' => __('« Previous', 'ekopirts'),
                        'next_text' => __('Next »', 'ekopirts'),
                    ));

                else :
                    echo '<p>' . __('No posts found.', 'ekopirts') . '</p>';
                endif;

                wp_reset_postdata();
                ?>
            </div>
        </div>

        <!-- Блок со списком категорий -->
        <?php get_template_part('components/category-list-block'); ?>

    </div>
</section>
