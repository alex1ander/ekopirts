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
                                    <?php foreach ($gallery as $image): ?>
                                        <div class="swiper-slide">
                                            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>

                            <div class="swiper thumbs-slider">
                                <div class="swiper-wrapper">
                                    <?php foreach ($gallery as $image): ?>
                                        <div class="swiper-slide">
                                            <img src="<?php echo esc_url($image['sizes']['thumbnail']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
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
                        <div class="add-order">
                            <div class="order-text"><?php _e('Place an order', 'ekopirts'); ?></div>
                            <div class="icon">
                                <svg width="33" height="33">
                                    <use href="#whatsapp"></use>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tabs -->
                <div class="the-product-bottom">
                    <div class="tabs">
                        <div class="tab-buttons">
                            <button class="active">Description</button>
                            <button>Additional information</button>
                        </div>

                        <div class="tab-contents">
                            <div class="tab-content active">
                                <?php the_content(); ?>
                            </div>
                            <div class="tab-content">
                                <?php echo wp_kses_post($additionalDesription); ?>
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