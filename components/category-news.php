<section class="grid-show">
    <div class="container products-area">

        <!-- Блок с новостями (посты) -->
        <div class="category-elements-block">
            <div class="grid-products-elements">
                <?php
                $args = array(
                    'post_type' => 'post',
                    'posts_per_page' => 12,
                    'category_name' => get_query_var('category_name'),
                    'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
                );
                $news_query = new WP_Query($args);

                if($news_query->have_posts()):
                    while($news_query->have_posts()): $news_query->the_post();
                        // Подключаем отдельный компонент карточки
                        get_template_part('components/news', 'card');
                    endwhile;

                    the_posts_pagination(array(
                        'prev_text' => __('« Previous'),
                        'next_text' => __('Next »'),
                    ));

                else:
                    echo '<p>No posts found.</p>';
                endif;
                wp_reset_postdata();
                ?>
            </div>

        </div>

        <?php get_template_part('components/category-list-block'); ?>



    </div>
</section>
