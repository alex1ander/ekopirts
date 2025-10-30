<?php 
$contacts     = get_field('contacts', 'options');
$details      = get_field('details', 'options');
$categories   = get_field('categories', 'options');
$social_links = get_field('social_links', 'options'); // Ссылки на соцсети
?>

<footer>
    <div class="container">
        <div class="footer-content">

            <!-- Колонка 1 — Контакты -->
            <div class="footer-col">
                <svg width="182" height="60">
                    <use href="#logo"></use>
                </svg>

                <?php if (!empty($contacts) && is_array($contacts)) : ?>
                    <ul>
                        <?php foreach ($contacts as $item) : ?>
                            <?php if (!empty($item['text'])) : ?>
                                <li>
                                    <?php 
                                    if (!empty($item['acf_fc_layout']) && $item['acf_fc_layout'] === 'phone') {
                                        echo __('Phone', 'ekopirts') . ': <a href="tel:' . esc_attr($item['text']) . '">' . esc_html($item['text']) . '</a>';
                                    } elseif (!empty($item['acf_fc_layout']) && $item['acf_fc_layout'] === 'email') {
                                        echo __('Email', 'ekopirts') . ': <a href="mailto:' . esc_attr($item['text']) . '">' . esc_html($item['text']) . '</a>';
                                    } else {
                                        echo esc_html($item['text']);
                                    }
                                    ?>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>

                <?php if (!empty($social_links) && is_array($social_links)) : ?>
                    <div class="social-links">
                        <?php foreach ($social_links as $social) : 
                            $link = !empty($social['link']) ? esc_url($social['link']) : '#';
                            $icon = !empty($social['icon']) ? $social['icon'] : '';
                            if ($icon) :
                        ?>
                            <a href="<?= $link; ?>" target="_blank" rel="noopener noreferrer">
                                <?= $icon; ?>
                            </a>
                        <?php 
                            endif;
                        endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Колонка 2 — Реквизиты -->
            <div class="footer-col">
                <h3><?php _e('Company Details', 'ekopirts'); ?></h3>
                <?php if (!empty($details) && is_array($details)) : ?>
                    <ul>
                        <?php foreach ($details as $item) : ?>
                            <?php if (!empty($item['text'])) : ?>
                                <li><?= esc_html($item['text']); ?></li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>

            <!-- Колонка 3 — Категории -->
            <div class="footer-col">
                <h3><?php _e('Categories', 'ekopirts'); ?></h3>
                <?php if (!empty($categories) && is_array($categories)) : ?>
                    <ul>
                        <?php foreach ($categories as $cat_id) : 
                            $term = get_term($cat_id, 'product_category'); 
                            if ($term && !is_wp_error($term)) : ?>
                                <li>
                                    <a href="<?= esc_url(get_term_link($term, 'product_category')); ?>">
                                        <?= esc_html($term->name); ?>
                                    </a>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>

            <!-- Колонка 4 — Карта -->
            <div class="footer-col">
                <h3><?php _e('Location', 'ekopirts'); ?></h3>
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d166542.77267000405!2d24.129073299999998!3d56.9717416!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46eecfb0e5073ded%3A0x400cfcd68f2fe30!2z0KDQuNCz0LAsINCb0LDRgtCy0LjRjw!5e1!3m2!1sru!2sde!4v1759516095983!5m2!1sru!2sde" 
                    style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                </iframe>
                <p><?php _e('Paegļu street 11, Vītoliņi, Valgunde parish, Jelgava municipality', 'ekopirts'); ?></p>
            </div>
        </div>
    </div>

    <div class="footer-line">
        <div class="container">
            <div class="footer-line-content">
                <div class="part">
                    <span><?php _e('Developed by', 'ekopirts'); ?></span>
                    <?php 
                    $svg_path1 = __DIR__ . '/assets/svg/jkonsult.svg';
                    if (file_exists($svg_path1)) include $svg_path1;
                    ?>
                    <a href="https://www.kurpirkt.lv" title="Latvijas interneta veikali">
                        <img style="Border:none;" alt="Latvijas interneta veikali" src="//www.kurpirkt.lv/media/kurpirkt88.gif" width=88 height=31>
                    </a>
                    <span>© 2024 <?php _e('Eko Pirts | All rights reserved', 'ekopirts'); ?></span>
                </div>

                <div class="part">
                    <?php
                    $locations  = get_nav_menu_locations();
                    $menu_id    = isset($locations['footer']) ? $locations['footer'] : 0;
                    $menu_items = $menu_id ? wp_get_nav_menu_items($menu_id) : [];

                    if (!empty($menu_items)) :
                        $menu_tree = [];

                        foreach ($menu_items as $item) {
                            if ($item->menu_item_parent == 0) {
                                $menu_tree[$item->ID] = [
                                    'item' => $item,
                                    'children' => []
                                ];
                            }
                        }

                        foreach ($menu_items as $item) {
                            if ($item->menu_item_parent != 0 && isset($menu_tree[$item->menu_item_parent])) {
                                $menu_tree[$item->menu_item_parent]['children'][] = $item;
                            }
                        }
                    ?>
                        <ul>
                            <?php foreach ($menu_tree as $menu_item) : ?>
                                <li>
                                    <a href="<?= esc_url($menu_item['item']->url); ?>">
                                        <?= esc_html($menu_item['item']->title); ?>
                                    </a>
                                    <?php if (!empty($menu_item['children'])) : ?>
                                        <ul>
                                            <?php foreach ($menu_item['children'] as $child) : ?>
                                                <li>
                                                    <a href="<?= esc_url($child->url); ?>">
                                                        <?= esc_html($child->title); ?>
                                                    </a>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</footer>

<?php 
$sprite_path = __DIR__ . '/assets/sprite.svg';
if (file_exists($sprite_path)) include $sprite_path;
wp_footer(); 
?>
</body>
</html>
