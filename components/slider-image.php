<?php 
$images = get_field('slider_demonstration'); // получаем поле текущей страницы

if ($images && !empty($images)):
?>

<section class="images">
    <div class="container">
        <div class="images-content">

            <div class="images-slider">
                <div class="swiper images-slider-swiper image-slider">
                    <div class="swiper-wrapper">
                        <?php foreach($images as $imageIndex => $image): ?>
                        <div class="swiper-slide">
                            <div class="partner-card aspect-ratio-1">
                                <a 
                                    href="<?= esc_url($image) ?>" 
                                    class="glightbox"
                                    data-gallery="images-gallery">
                                    <img src="<?= esc_url($image) ?>" alt="Partner Logo" style="cursor:pointer;">
                                </a>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="swiper-button-next products-slider-button-next desktop-only"></div>
                <div class="swiper-button-prev products-slider-button-prev desktop-only"></div>
            </div>
            <div class="products-slider-pagination gray"></div>

        </div>
    </div>
</section>


<script>
document.addEventListener('DOMContentLoaded', () => {
    // Инициализация Swiper
    var swiper = new Swiper(".images-slider-swiper", {
        slidesPerView: 2,
        spaceBetween: 20,
        pagination: {
            el: ".images .products-slider-pagination",
            clickable: true,
        },
        navigation: {
            nextEl: ".images-slider .products-slider-button-next",
            prevEl: ".images-slider .products-slider-button-prev",
        },
        breakpoints: {
            540: { slidesPerView: 2 },
            768: { slidesPerView: 4 },
            1024: { slidesPerView: 6 },
        },
    });

    // Инициализация GLightbox без описания
    const lightbox = GLightbox({
        selector: '.glightbox',
        touchNavigation: true,
        loop: true,
        zoomable: true
    });
});
</script>

<?php endif; ?>
