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
                $prev_post = get_previous_post();
                if (!empty($prev_post)) : ?>
                    <div class="prev-post post-navigation">
                        <div class="content">
                            <h4><?php echo esc_html(get_the_title($prev_post->ID)); ?></h4>
                            <p><?php echo wp_trim_words(get_the_excerpt($prev_post->ID), 20); ?></p>
                        </div>
                        <?php echo get_the_post_thumbnail($prev_post->ID, 'thumbnail'); ?>
                        <div class="icon">
                            <svg width="15" height="28">
                                <use href="#arrow-right-green"></use>
                            </svg>
                        </div>
                    </div>
                <?php endif; ?>

                <?php
                $next_post = get_next_post();
                if (!empty($next_post)) : ?>
                    <div class="next-post post-navigation">
                        <div class="content">
                            <h4><?php echo esc_html(get_the_title($next_post->ID)); ?></h4>
                            <p><?php echo wp_trim_words(get_the_excerpt($next_post->ID), 20); ?></p>
                        </div>
                        <?php echo get_the_post_thumbnail($next_post->ID, 'thumbnail'); ?>
                        <div class="icon">
                            <svg width="15" height="28">
                                <use href="#arrow-right-green"></use>
                            </svg>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

        </div>

        <!-- Список категорий -->
        <?php get_template_part('components/category-list-block'); ?>

    </div>
</section>
