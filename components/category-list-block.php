<div class="category-list-block desktop-only">
    <h3 class="category-block-title"><?php _e('Categories', 'ekopirts'); ?></h3>

    <ul class="category-list">
        <?php
        $current_term = null;
        $taxonomy = 'product_category';

        // Определяем текущий объект и таксономию
        // if (is_tax('product_category')) {
        //     $current_term = get_queried_object();
        //     $taxonomy = 'product_category';
        // } elseif (is_singular('product')) {
        //     $terms = wp_get_post_terms(get_the_ID(), 'product_category');
        //     if (!empty($terms) && !is_wp_error($terms)) {
        //         $current_term = $terms[0];
        //         $taxonomy = 'product_category';
        //     }
        // } elseif (is_category()) {
        //     $current_term = get_queried_object();
        //     $taxonomy = 'category';
        // } elseif (is_singular('post')) {
        //     $terms = wp_get_post_terms(get_the_ID(), 'category'); // стандартная таксономия категорий
        //     if (!empty($terms) && !is_wp_error($terms)) {
        //         // Берем первую категорию записи
        //         $current_term = $terms[0];
        //         $taxonomy = 'category';
        //     }
        // }

        if ($taxonomy) {

            // Рекурсивная функция вывода категорий
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
                        <li>
                            <a href="<?php echo esc_url(get_term_link($cat)); ?>" class="<?php echo $is_active ? 'active' : ''; ?>">
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

            // Выводим всю ветку начиная с корня
            display_category_tree(0, $current_term, $taxonomy);

        } else { ?>
            <li><?php _e('No categories found.', 'ekopirts'); ?></li>
        <?php } ?>
    </ul>
</div>
