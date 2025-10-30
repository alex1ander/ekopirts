<div class="product-card">
    <div class="product-tags">
        <?php if (isset($args['price']['old']) && $args['price']['old'] > $args['price']['new']): ?>
            <div class="discount-tag">%</div>
        <?php endif; ?>
    </div>

    <?php 
    // получаем ссылку на текущий пост (товар)
    $product_link = get_permalink($args['id'] ?? get_the_ID());
    ?>

    <a href="<?= esc_url($product_link); ?>" class="product-image">
        <img src="<?= esc_url($args['gallery'][0]['url'] ?? ''); ?>" alt="<?= esc_attr($args['title']); ?>">
    </a>

    <div class="product-content pb-30-no">
        <h4 class="product-name">
            <a href="<?= esc_url($product_link); ?>"><?= esc_html($args['title']); ?></a>
        </h4>

        <div class="product-info">
            <p class="product-description">
                <?php 
                $excerpt = wp_strip_all_tags($args['excerpt']); // удаляем теги, если они есть
                echo esc_html(mb_strimwidth($excerpt, 0, 50, '...')); // обрезаем до 20 символов
                ?>
            </p>

        </div>

        <div class="product-price">
            <?php if (!empty($args['price']['old'])): ?>
                <span class="old-price">€ <?= esc_html($args['price']['old']); ?></span>
            <?php endif; ?>
            <?php if (!empty($args['price']['new'])): ?>
                <span class="current-price">€ <?= esc_html($args['price']['new']); ?></span>
            <?php endif; ?>
        </div>

        <a href="<?= esc_url($product_link); ?>" class="product-more"><?php _e('Learn more', 'ekopirts'); ?></a>

        <div class="add-order">
            <?php 
                $phone = '+37129749161';
                $product_title = urlencode($args['title'] ?? '');
                $product_link = get_permalink($args['id'] ?? get_the_ID());
                $product_link_encoded = urlencode($product_link);

                // Многоязычный текст через __()
                $message_text = urlencode(__('Hello! I want to order a product:', 'ekopirts'));

                $message = "{$message_text} {$product_title} {$product_link_encoded}";
                $whatsapp_link = "https://wa.me/{$phone}?text={$message}";
            ?>
            <a href="<?= esc_url($whatsapp_link); ?>" target="_blank" class="order-text"
            data-product-title="<?= esc_attr($args['title'] ?? ''); ?>"
            data-product-image="<?= esc_url($args['gallery'][0]['url'] ?? ''); ?>"
            data-product-price="<?= esc_attr(isset($args['price']['new']) ? $args['price']['new'] : ''); ?>">
                <?php _e('Place an order', 'ekopirts'); ?>
            </a>
            <a href="<?= esc_url($whatsapp_link); ?>" target="_blank" class="icon">
                <svg width="33" height="33">
                    <use href="#whatsapp"></use>
                </svg>
            </a>
        </div>




    </div>
</div>
