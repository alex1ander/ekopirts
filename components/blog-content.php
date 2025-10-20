<section class="grid-show">
    <div class="container products-area">

        <div class="post-content">
            <div class="blog-content">

                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <div class="image-text">
                        <?php if (has_post_thumbnail()) : ?>
                            <?php  $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'full');?>
                            <img src="<?= $thumbnail_url ?>" alt="">
                        <?php else : ?>
                            <img src="/images/product.png" alt="">
                        <?php endif; ?>
                        
                        <div class="content"><?php the_content(); ?></div>
                    </div>

                    <!-- Теги текущей записи -->
                    <div class="current-category-tags">
                        <h4>Kategorijas</h4>
                        <div class="tags">
                            <?php
                            $post_tags = get_the_tags();
                            if ($post_tags) :
                                foreach ($post_tags as $tag) : ?>
                                    <div class="tag">
                                        <svg width="18" height="18">
                                            <use href="#tag"></use>
                                        </svg>
                                        <span><?php echo esc_html($tag->name); ?></span>
                                    </div>
                                <?php endforeach;
                            endif; ?>
                        </div>
                    </div>

                <?php endwhile; endif; ?>

            </div>

            <!-- Навигация по записям -->
            <div class="post-navigation">
                <?php
                $current_id = get_the_ID();

                // Самый новый пост (последний по дате) кроме текущего
                $latest_posts = get_posts([
                    'posts_per_page' => 1,
                    'post_status'    => 'publish',
                    'orderby'        => 'date',
                    'order'          => 'DESC',
                    'post__not_in'   => [$current_id],
                ]);

                if (!empty($latest_posts)) {
                    $latest = $latest_posts[0];
                    $latest_link = get_permalink($latest->ID);
                    ?>
                    <a href="<?php echo esc_url($latest_link); ?>" class="prev-post post-navigation" aria-label="Перейти к самому новому посту">
                        <div class="content">
                            <h4><?php echo esc_html(get_the_title($latest->ID)); ?></h4>
                            <p><?php echo esc_html(mb_strimwidth(strip_tags(get_the_excerpt($latest->ID)), 0, 50, '…')); ?></p>
                        </div>
                        <?php echo get_the_post_thumbnail($latest->ID, 'thumbnail'); ?>
                        <div class="icon arrow">
                            <svg width="15" height="28">
                                <use href="#arrow-right-green"></use>
                            </svg>
                        </div>
                    </a>
                    <?php
                }

                // Самый старый пост (первый по дате) кроме текущего
                $oldest_posts = get_posts([
                    'posts_per_page' => 1,
                    'post_status'    => 'publish',
                    'orderby'        => 'date',
                    'order'          => 'ASC',
                    'post__not_in'   => [$current_id],
                ]);

                if (!empty($oldest_posts)) {
                    $oldest = $oldest_posts[0];
                    $oldest_link = get_permalink($oldest->ID);
                    ?>
                    <a href="<?php echo esc_url($oldest_link); ?>" class="next-post post-navigation" aria-label="Перейти к самому старому посту">
                        <div class="content">
                            <h4><?php echo esc_html(get_the_title($oldest->ID)); ?></h4>
                            <p><?php echo esc_html(mb_strimwidth(strip_tags(get_the_excerpt($oldest->ID)), 0, 50, '…')); ?></p>
                        </div>
                        <?php echo get_the_post_thumbnail($oldest->ID, 'thumbnail'); ?>
                        <div class="icon arrow">
                            <svg width="15" height="28">
                                <use href="#arrow-right-green"></use>
                            </svg>
                        </div>
                    </a>
                    <?php
                }
                ?>
            </div>


        </div>

        <!-- Список категорий -->
        <?php get_template_part('components/category-list-block'); ?>

    </div>
</section>
