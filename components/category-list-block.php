<div class="category-list-block desktop-only">


    <?php if (is_category() || is_singular('post')): ?>
    <div class="recent-news-block">
        <h3 class="category-block-title"><?php _e('Latest News', 'ekopirts'); ?></h3>
        <div class="recent-news-cards">

            <?php
            $news_query = new WP_Query(array(
                'posts_per_page' => 3,
                'post_status' => 'publish',
            ));

            if ($news_query->have_posts()):
                while ($news_query->have_posts()): $news_query->the_post(); ?>
                    <div class="news-card-recent">
                        <div class="product-image">
                            <?php if(has_post_thumbnail()): ?>
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('medium'); ?>
                                </a>
                            <?php else: ?>
                                <a href="<?php the_permalink(); ?>">
                                    <img src="<?php echo get_template_directory_uri(); ?>/images/no-image.jpg" alt="">
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
                                    echo mb_strimwidth($excerpt, 0, 120, '...');
                                    ?>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php endwhile;
                wp_reset_postdata();
            endif; ?>

        </div>
    </div>
<?php endif; ?>


    <h3 class="category-block-title"><?php _e('Categories', 'ekopirts'); ?></h3>
    <ul class="category-list">
        <?php
        $current_term = null;
        $taxonomy = 'product_category';

        if (is_tax($taxonomy)) {
            $current_term = get_queried_object();
        }

        if ($taxonomy) {

            function display_category_tree($parent_id, $current_term, $taxonomy) {
                $categories = get_terms(array(
                    'taxonomy'   => $taxonomy,
                    'hide_empty' => false,
                    'parent'     => $parent_id,
                ));

                if ($categories) {
                    foreach ($categories as $cat) {
                        $is_active = ($current_term && $current_term->term_id === $cat->term_id);
                        $children = get_terms(array(
                            'taxonomy'   => $taxonomy,
                            'hide_empty' => false,
                            'parent'     => $cat->term_id,
                        ));
                        ?>
                        <li class="<?php echo $is_active ? 'active' : ''; ?>">
                            <a href="<?php echo esc_url(get_term_link($cat)); ?>">
                                <?php echo esc_html($cat->name); ?>
                            </a>
                            <?php if (!empty($children)) { ?>
                                <ul>
                                    <?php display_category_tree($cat->term_id, $current_term, $taxonomy); ?>
                                </ul>
                            <?php } ?>
                        </li>
                        <?php
                    }
                }
            }

            display_category_tree(0, $current_term, $taxonomy);

        } else { ?>
            <li><?php _e('No categories found.', 'ekopirts'); ?></li>
        <?php } ?>

    </ul>
</div>
