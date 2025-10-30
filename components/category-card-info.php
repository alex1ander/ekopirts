<?php
/**
 * Template part for displaying page card
 * 
 * @param WP_Post $page - Page object
 */

// Получаем страницу из аргументов
$page = isset($args['page']) ? $args['page'] : null;

if (!$page) {
    return;
}

// Ссылка на страницу
$page_link = get_permalink($page->ID);

// Получаем миниатюру страницы (featured image)
$page_image = get_the_post_thumbnail_url($page->ID, 'medium');
?>

<a href="<?= esc_url($page_link); ?>" class="category-preview">
    <div class="category-image">
        <?php if ($page_image): ?>
            <img src="<?= esc_url($page_image); ?>" alt="<?= esc_attr($page->post_title); ?>">
        <?php endif; ?>
    </div>
    <div class="category-info">
        <span class="name"><?= esc_html($page->post_title); ?></span>
        <div class="category-arrow">
            <svg width="15" height="28">
                <use href="#arrow-right"></use>
            </svg>
        </div>
    </div>
</a>