<section id="hero" class="hero hero-section">
    <div class="slider-area">
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                <?php for($i = 0; $i < 3; $i++): ?>
                <div class="swiper-slide">
                    <div class="hero-slide">
                        <img class="hero-background" src="/images/hero.png" alt="">
                        <div class="container">
                            <div class="hero-content">

                                <div class="hero-info">
                                    <h1 class="hero-title">Tava Mucu Pirts</h1>
                                    <p class="hero-text">Pērc No Ražotāja būs Lētāk</p>
                                    <a href="#" class="btn btn-matte">+371 25912321</a>
                                </div>
                                <!-- Вложенный слайдер -->
                                <div class="nested-slider">
                                    <div class="swiper nested-swiper">
                                        <div class="swiper-wrapper">
                                            <?php for($j = 0; $j < 5; $j++): ?>
                                            <div class="swiper-slide">
                                                <div class="nested-slide">
                                                    <div class="nested-content">
                                                        <img class="nested-image" src="/images/nested.png" alt="">
                                                        <div class="nested-bottom">
                                                            <span class="nested-name">Name</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php endfor; ?>    
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <?php endfor; ?>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
</section>

<script>
document.addEventListener("DOMContentLoaded", function() {
    // Главный слайдер
    var swiper = new Swiper(".mySwiper", {
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });

    // Вложенные слайдеры
    document.querySelectorAll(".nested-swiper").forEach(function(el) {
        new Swiper(el, {
            loop: true,
            slidesPerView: 3,
            spaceBetween: 5,
            centeredSlides: true,
            nested: true, // чтобы корректно работал внутри другого Swiper
        });
    });
});
</script>
