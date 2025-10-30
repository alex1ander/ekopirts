<section class="grid-show">
    <div class="container products-area">
        <?php get_template_part('components/category-list-block'); ?>

        <div class="category-elements-block">
            <div class="the-product">
                <div class="the-product-top">
                    <?php
                    // Получаем данные ACF
                    $additionalDesription = get_field('additional_desription');
                    $shortDescription = get_field('short_description');
                    $attributes = get_field('attributes');

                    $gallery = get_field('gallery');
                    $price = get_field('price');
                    $old_price = isset($price['old']) ? $price['old'] : '';
                    $new_price = isset($price['new']) ? $price['new'] : '';
                    ?>

                    <!-- Галерея товара -->
                    <div class="product-images">
                        <?php if (!empty($gallery) && is_array($gallery)): ?>
                            <div class="swiper main-slider">
                                <div class="swiper-wrapper">
                                    <?php foreach ($gallery as $index => $image): ?>
                                        <div class="swiper-slide">
                                            <a 
                                                href="<?php echo esc_url($image['url']); ?>" 
                                                class="glightbox" 
                                                data-gallery="product-gallery">
                                                <img 
                                                    src="<?php echo esc_url($image['url']); ?>" 
                                                    alt="<?php echo esc_attr($image['alt']); ?>" 
                                                    style="cursor:pointer;">
                                            </a>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>

                            <div class="swiper thumbs-slider">
                                <div class="swiper-wrapper">
                                    <?php foreach ($gallery as $image): ?>
                                        <div class="swiper-slide">
                                            <img 
                                                src="<?php echo esc_url($image['sizes']['thumbnail']); ?>" 
                                                alt="<?php echo esc_attr($image['alt']); ?>">
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="main-product-info">
                        <div class="block-info">
                            <h1><?php the_title(); ?></h1>
                            <?php if ($old_price || $new_price): ?>
                                <div class="price">
                                    <?php if ($old_price): ?>
                                        <span class="old-price">€<?php echo esc_html(number_format($old_price, 2, '.', ',')); ?></span>
                                    <?php endif; ?>
                                    <?php if ($new_price): ?>
                                        <span class="new-price">€<?php echo esc_html($new_price); ?></span>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <?php if ($shortDescription): ?>
                        <div class="block-info">
                            <p class="short-description">
                                <?php echo esc_html(strip_tags($shortDescription)); ?>
                            </p>
                        </div>
                        <?php endif; ?>

                        <!-- Характеристики -->
                        <?php if (!empty($attributes) && is_array($attributes)): ?>
                        <div class="block-info">
                            <div class="product-characteristic">
                                <?php foreach($attributes as $attribute): ?>
                                    <?php if (isset($attribute['name']) && isset($attribute['value'])): ?>
                                    <div class="characteristic-row">
                                        <span class="char-name"><?php echo esc_html($attribute['name']); ?>:</span>
                                        <span class="char-value"><?php echo esc_html($attribute['value']); ?></span>
                                    </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <?php endif; ?>

                        <!-- Кнопка заказа -->
                       <!-- Кнопка заказа -->
                        <div class="add-order">
                            <?php 
                                $phone = '+37129749161';
                                $product_title = urlencode(get_the_title());
                                $product_link = get_permalink(get_the_ID());
                                $product_link_encoded = urlencode($product_link);

                                // Многоязычный текст
                                $message_text = urlencode(__('Hello! I want to order a product:', 'ekopirts'));

                                // Формируем сообщение с переводом и ссылкой на товар
                                $message = "{$message_text}%20{$product_title}%0A{$product_link_encoded} - ";
                                $whatsapp_link = " https://wa.me/{$phone}?text={$message}";
                            ?>

                            <a href="<?= esc_url($whatsapp_link); ?>" 
                            target="_blank" 
                            class="order-text"
                            data-product-title="<?= esc_attr(get_the_title()); ?>"
                            data-product-image="<?= esc_url(!empty($gallery[0]['url']) ? $gallery[0]['url'] : ''); ?>"
                            data-product-price="<?= esc_attr($new_price ? $new_price : ($old_price ? $old_price : '')); ?>">
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

                <!-- Tabs -->
                <div class="the-product-bottom">
                    <div class="tabs">
                        <div class="tab-buttons">
                            <button class="active"><?php _e('Description','ekopirts'); ?></button>
                            <button><?php _e('Additional information','ekopirts'); ?></button>
                        </div>

                        <div class="tab-contents">
                            <div class="tab-content active">
                                <?php the_content(); ?>
                            </div>
                            <div class="tab-content">
                                <?php echo wp_kses_post($additionalDesription); ?>
                            </div>


                            <div class="file-list">
                                <?php $filesList = get_field('files-list'); ?>
                                <?php if($filesList && !empty($filesList)): ?>
                                <?php foreach($filesList as $file): ?>
                                <div class="file-block">
                                    <a href="<?= $file['file'] ?>" target="_blank">
                                        <svg class="icon" width="48" height="48">
                                            <use href="#pdf-file"></use>
                                        </svg>
                                    </a>
                                    <a href="<?= $file['file'] ?>" target="_blank"><?= $file['title'] ?></a>
                                </div>
                                <?php endforeach; ?> 
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div><!-- /.the-product -->
        </div><!-- /.category-elements-block -->
    </div><!-- /.container -->
</section>

<script>
document.addEventListener("DOMContentLoaded", () => {
  const tabButtons = document.querySelectorAll(".tab-buttons button");
  const tabContents = document.querySelectorAll(".tab-content");

  tabButtons.forEach((button, index) => {
    button.addEventListener("click", () => {
      // Удаляем активный класс у всех кнопок и контента
      tabButtons.forEach(btn => btn.classList.remove("active"));
      tabContents.forEach(content => content.classList.remove("active"));

      // Добавляем активный класс текущим
      button.classList.add("active");
      tabContents[index].classList.add("active");
    });
  });
});
</script>

<script>
  const thumbsSlider = document.querySelector('.thumbs-slider');
  const mainSlider = document.querySelector('.main-slider');
  
  if (thumbsSlider && mainSlider) {
    const thumbs = new Swiper('.thumbs-slider', {
      slidesPerView: 4,
      spaceBetween: 10,
      watchSlidesProgress: true,
    });

    const main = new Swiper('.main-slider', {
      autoHeight: true,
      spaceBetween: 10,
      thumbs: {
        swiper: thumbs,
      },
    });
  }
</script>



<script>
document.addEventListener('DOMContentLoaded', () => {
// GLightbox
  const lightbox = GLightbox({
    selector: '.glightbox',
    touchNavigation: true,
    loop: true,
    zoomable: true,
    openEffect: 'zoom',
    closeEffect: 'fade',
  });
});
</script>