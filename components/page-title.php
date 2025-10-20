<div class="page-title-area">
    <div class="container">
        <?php 
        // Получаем категории текущего поста
        $categories = get_the_category();
        if ( ! empty( $categories ) ) {
            // Выводим название первой категории
            echo '<h1 class="page-title">' . esc_html( $categories[0]->name ) . '</h1>';
        } else {
            // Если категорий нет, выводим заголовок поста
            echo '<h1 class="page-title">' . get_the_title() . '</h1>';
        }
        ?>
    </div>
</div>
