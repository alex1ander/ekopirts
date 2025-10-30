<div class="page-title-area">
    <div class="container">
        <?php 
        if ( is_tax('product_category') ) {
            // ✅ Кастомная таксономия для товаров
            $term = get_queried_object();
            echo '<h1 class="page-title">' . esc_html( $term->name ) . '</h1>';

        } elseif ( is_category() ) {
            // ✅ Обычная категория постов (category)
            echo '<h1 class="page-title">' . esc_html( single_cat_title( '', false ) ) . '</h1>';

        } elseif ( is_tag() ) {
            // ✅ Страница тега (tag)
            echo '<h1 class="page-title">#' . esc_html( single_tag_title( '', false ) ) . '</h1>';

        } elseif ( is_post_type_archive('product') ) {
            // ✅ Архив всех товаров
            echo '<h1 class="page-title">' . esc_html__( 'All product categories', 'ekopirts' ) . '</h1>';

        } elseif ( is_singular('product') ) {
            // ✅ Одиночный товар — показываем категорию товара
            $terms = get_the_terms( get_the_ID(), 'product_category' );
            if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
                echo '<h1 class="page-title">' . esc_html( $terms[0]->name ) . '</h1>';
            } else {
                echo '<h1 class="page-title">' . esc_html( get_the_title() ) . '</h1>';
            }

        } else {
            // ✅ Все остальные страницы
            echo '<h1 class="page-title">' . esc_html( get_the_title() ) . '</h1>';
        }
        ?>
    </div>
</div>
