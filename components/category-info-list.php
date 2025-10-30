<section class="grid-show">
    <div class="container products-area">

        <!-- Дочерние страницы текущей страницы -->
        <div class="category-elements-block">
            <div class="grid-products-elements">
                <?php
                // Получаем ID текущей страницы
                $current_page_id = get_the_ID();
                
                // Получаем дочерние страницы
                $child_pages = get_pages(array(
                    'parent' => $current_page_id,
                    'sort_column' => 'menu_order',
                    'sort_order' => 'ASC'
                ));

                if (!empty($child_pages)) :
                    foreach ($child_pages as $page) :
                        // Используем компонент page-card, передаем страницу
                        get_template_part('components/category-card-info', null, array(
                            'page' => $page
                        ));
                    endforeach;
                else :
                ?>
                <?php endif; ?>
            </div>
        </div>

    </div>
</section>