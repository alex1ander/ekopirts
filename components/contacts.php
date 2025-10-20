<?php 
$contacts = get_field('contacts', 'options'); // Повторяющиеся контакты: телефон, email
$details = get_field('details', 'options');   // Реквизиты компании
$social_links = get_field('social_links', 'options'); // Ссылки на соцсети
?>

<section class="contacts">
    <div class="container">
        <div class="contact-three-grid">

            <!-- Контакты -->
            <div class="contact-block">
                <h4><?php _e('Contacts', 'ekopirts'); ?></h4>
                <?php if (!empty($contacts)) : ?>
                    <ul>
                        <?php foreach ($contacts as $item) : ?>
                            <li>
                                <?php 
                                if ($item['acf_fc_layout'] === 'phone') {
                                    echo __('Phone', 'ekopirts') . ': <a href="tel:' . esc_attr($item['text']) . '">' . esc_html($item['text']) . '</a>';
                                } elseif ($item['acf_fc_layout'] === 'email') {
                                    echo __('Email', 'ekopirts') . ': <a href="mailto:' . esc_attr($item['text']) . '">' . esc_html($item['text']) . '</a>';
                                } else {
                                    echo esc_html($item['text']);
                                }
                                ?>

                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>

            <!-- Реквизиты -->
            <div class="contact-block">
                <h4><?php _e('Company Details', 'ekopirts'); ?></h4>
                <?php if (!empty($details)) : ?>
                    <ul>
                        <?php foreach ($details as $item) : ?>
                            <li><?= esc_html($item['text']); ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>

            <!-- Соцсети -->
            <div class="contact-block">
                <h4><?php _e('Social Networks', 'ekopirts'); ?></h4>

                <?php if (!empty($social_links)) : ?>
                    <div class="social-links">
                        <?php foreach ($social_links as $social) : 
                            // $social['link'] - ссылка на соцсеть
                            // $social['icon'] - SVG код соцсети
                        ?>
                            <a href="<?= esc_url($social['link']); ?>" target="_blank" rel="noopener noreferrer">
                                <?= $social['icon']; ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <svg width="191" height="46" class="dark">
                    <use href="#logo-dark"></use>
                </svg>
            </div>


        </div>
    </div>

    <!-- Карта -->
    <h3 class="text-center"><?php _e('How to find us?', 'ekopirts'); ?></h3>
    <iframe style="width: 100%; height: 700px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d166542.77267000405!2d24.129073299999998!3d56.9717416!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46eecfb0e5073ded%3A0x400cfcd68f2fe30!2z0KDQuNCz0LAsINCb0LDRgtCy0LjRjw!5e1!3m2!1sru!2sde!4v1759516095983!5m2!1sru!2sde" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      

</section>
