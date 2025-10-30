<div class="category-list-block desktop-only">
    <h3 class="category-block-title"><?php _e('Последние новости', 'ekopirts'); ?></h3>

    <ul class="last-news-list">
        <?php
        // Получаем последние 3 поста типа 'post'
        $recent_posts = new WP_Query([
            'post_type'      => 'post',
            'posts_per_page' => 3,
            'orderby'        => 'date',
            'order'          => 'DESC',
        ]);

        if ($recent_posts->have_posts()) :
            while ($recent_posts->have_posts()) : $recent_posts->the_post(); ?>
                <li>
                    <?php if (has_post_thumbnail()) : ?>
                        <a href="<?php the_permalink(); ?>" class="news-thumb">
                            <?php the_post_thumbnail('medium'); ?>
                        </a>
                    <?php endif; ?>

                    <div class="news-content">
                        <a href="<?php the_permalink(); ?>" class="news-title"><?php the_title(); ?></a>
                        <span class="news-date"><?php echo get_the_date(); ?></span>
                        <p class="news-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                    </div>
                </li>
            <?php endwhile;
        else : ?>
            <li><?php _e('Новостей пока нет', 'ekopirts'); ?></li>
        <?php
        endif;

        wp_reset_postdata();
        ?>
    </ul>
</div>
