<?php
/**
 * Template part for displaying category card
 * 
 * @param WP_Term $category - Category term object
 */

// Получаем категорию из аргументов
$category = isset($args['category']) ? $args['category'] : null;

if (!$category || is_wp_error($category)) {
    return;
}

// Ссылка на категорию
$term_link = get_term_link($category);

// Получаем изображение категории из ACF
$category_image = get_field('image', 'product_category_' . $category->term_id);
?>

<a href="<?= esc_url($term_link); ?>" class="category-preview">
    <div class="category-image">
        <?php if ($category_image): ?>
            <img src="<?= $category_image; ?>" alt="<?= esc_attr($category->name); ?>">
        <?php endif; ?>
    </div>
    <div class="category-info">
        <span class="name"><?= esc_html($category->name); ?></span>
        <div class="category-arrow">
            <svg width="15" height="28">
                <use href="#arrow-right"></use>
            </svg>
        </div>
    </div>
</a>