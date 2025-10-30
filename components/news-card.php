<div class="product-card">
    <div class="product-image">
        <?php if(has_post_thumbnail()): ?>
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail('medium'); ?>
            </a>
        <?php else: ?>
            <a href="<?php the_permalink(); ?>">
            <img src="<?php echo get_template_directory_uri(); ?>/images/product.png" alt="">
            </a>
        <?php endif; ?>
    </div>

    <div class="product-content">
        <h4 class="product-name">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h4>
        <div class="product-info">
            <p class="product-description">
                <?php 
                $excerpt = wp_strip_all_tags(get_the_excerpt());
                echo mb_strimwidth($excerpt, 0, 120, '...'); // обрезаем до 20 символов и добавляем "..."
                ?>
            </p>

        </div>

        <div class="tags">
        <?php if (has_tag()): ?>
            <?php foreach (get_the_tags() as $tag): ?>
                <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>" class="tag">
                    <svg width="18" height="18">
                        <use href="#tag"></use>
                    </svg>
                    <span><?php echo esc_html($tag->name); ?></span>
                </a>
            <?php endforeach; ?>
        <?php endif; ?>
        </div>


        <a href="<?php the_permalink(); ?>" class="view-news"><?php _e('Learn more', 'ekopirts'); ?></a>
    </div>
</div>
