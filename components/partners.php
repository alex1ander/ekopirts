<?php 
$partners = get_field('partners'); // получаем поле текущей страницы

// Если поле пустое, берем поле с главной страницы
if (!$partners) {
    $front_id = get_option('page_on_front'); // ID главной страницы
    $partners = get_field('partners', $front_id);
}
?>

<section class="partners">
    <div class="container">
        <div class="partners-content">
            <div class="title-block">
                <h2 class="products-title"><?php _e('Our Products', 'ekopirts'); ?></h2>
            </div>

            <?php if ($partners): // проверяем, есть ли изображения ?>
            <div class="partners-slider">
                <div class="swiper partners-slider-swiper image-slider">
                    <div class="swiper-wrapper">
                        <?php foreach($partners as $image): ?>
                            <div class="swiper-slide">
                                <div class="partner-card">
                                    <img src="<?= esc_url($image) ?>" alt="Partner Logo">
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="swiper-button-next products-slider-button-next desktop-only"></div>
                <div class="swiper-button-prev products-slider-button-prev desktop-only"></div>
            </div>
            <div class="products-slider-pagination gray"></div>
            <?php endif; ?>
        </div>
    </div>
</section>



<script>
var swiper = new Swiper(".partners-slider-swiper", {
    slidesPerView: 2,
        spaceBetween: 20,
        pagination: {
            el: ".partners .products-slider-pagination",
        },
        navigation: {
            nextEl: ".partners-slider .products-slider-button-next",
            prevEl: ".partners-slider .products-slider-button-prev",
        },
       breakpoints: {
            540: {
            slidesPerView: 2,
            },
            768: {
            slidesPerView: 4,
            },
            1024: {
            slidesPerView: 6,
            },
        },
});
</script>
