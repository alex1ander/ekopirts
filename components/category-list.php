<section class="grid-show">
    <div class="container products-area">

        <!-- Товары текущей категории -->
        <div class="category-elements-block">
            <div class="grid-products-elements">
                <?php
                // Получаем только главные категории (parent = 0)
                $main_categories = get_terms(array(
                    'taxonomy' => 'product_category',
                    'hide_empty' => false,
                    'parent' => 0,
                ));

                if (!empty($main_categories) && !is_wp_error($main_categories)) :
                    foreach ($main_categories as $category) :
                        // Используем компонент
                        get_template_part('components/category-card', null, array(
                            'category' => $category
                        ));
                    endforeach;
                else :
                ?>
                    <p>Empty</p>
                <?php endif; ?>
            </div>
        </div>

    </div>
</section>