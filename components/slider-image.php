<?php 
$images = get_field('slider_demonstration'); // получаем поле текущей страницы
?>

<section class="images">
    <div class="container">
        <div class="images-content">

            <?php if ($images): // проверяем, есть ли изображения ?>
            <div class="images-slider">
                <div class="swiper images-slider-swiper image-slider">
                    <div class="swiper-wrapper">
                        <?php foreach($images as $image): ?>
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
var swiper = new Swiper(".images-slider-swiper", {
    slidesPerView: 2,
        spaceBetween: 20,
        pagination: {
            el: ".images .products-slider-pagination",
        },
        navigation: {
            nextEl: ".images-slider .products-slider-button-next",
            prevEl: ".images-slider .products-slider-button-prev",
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
