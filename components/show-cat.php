<?php 
$showCategory = get_field('show-category');
?>

<section class="show-cat">
    <div class="container">
        <div class="show-cat-content">

            <div class="categories">
                <div class="swiper categories-slider-swiper">
                    <div class="swiper-wrapper">
                        <?php if (!empty($showCategory['categories'])): ?>
                            <?php foreach ($showCategory['categories'] as $cat_id): ?>

                                <?php
                                // Получаем категорию
                                $category = get_term($cat_id, 'product_category');

                                if (!is_wp_error($category)) :
                                ?>

                                    <div class="swiper-slide">
                                        <?php get_template_part('components/category-card', null, array(
                                            'category' => $category
                                        )); ?>
                                    </div>

                                <?php endif; ?>

                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="swiper-button-next categories-slider-button-next desktop-only"></div>
                <div class="swiper-button-prev categories-slider-button-prev desktop-only"></div>
                <div class="categories-slider-pagination"></div>
            </div>

        </div>
    </div>
</section>

<script>
    var swiper = new Swiper(".categories-slider-swiper", {
      slidesPerView: 1,
      spaceBetween: 20,
      pagination: {
        el: '.categories-slider-pagination',
        clickable: true,
      },
      navigation: {
        nextEl: '.categories-slider-button-next',
        prevEl: '.categories-slider-button-prev',
      },
      breakpoints: {
        540: {
          slidesPerView: 1,
        },
        768: {
          slidesPerView: 2,
        },
        1024: {
          slidesPerView: 3,
        },
      },
    });
</script>