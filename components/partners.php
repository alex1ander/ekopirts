<section class="partners">
    <div class="container">
        <div class="partners-content">
            <div class="title-block">
            <h2 class="products-title">Mūsu produkcija</h2>
            </div>



            <div class="partners-slider">
                <div class="swiper partners-slider-swiper">
                    <div class="swiper-wrapper">
                    <?php for($i = 0; $i < 8; $i++): ?>
                        <div class="swiper-slide">
                            <div class="partner-card">
                                <!-- <img src="images/partner-logo.png" alt="Partner Logo"> -->
                            </div>
                        </div>
                    <?php endfor; ?>
                    </div>
                </div>
                <div class="swiper-button-next products-slider-button-next"></div>
                <div class="swiper-button-prev products-slider-button-prev"></div>
                <div class="products-slider-pagination"></div>
            </div>
        </div>
    </div>
</section>


<script>
var swiper = new Swiper(".partners-slider-swiper", {
    slidesPerView: 6,
      spaceBetween: 20,
      pagination: {
        el: ".partners-slider .products-slider-pagination",
      },
      navigation: {
        nextEl: ".partners-slider .products-slider-button-next",
        prevEl: ".partners-slider .products-slider-button-prev",
      },
});
</script>
