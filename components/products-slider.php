<section class="products-slider">
    <div class="container">
        <div class="products-head">
            <div class="title-block">
                <h2 class="products-title">Mūsu produkcija</h2>
            </div>
            <ul class="category-tabs">
                <li>Mucu Pirtis</li>
                <li>Kubli</li>
                <li>Produktu katalogs</li>
                <li>Mājas</li>
            </ul>
            <a href="#" class="products-link">View All Products</a>
        </div>

        <div class="proudcts-body">
            <div class="swiper products-slider-swiper">
                <div class="swiper-wrapper">
                        <?php for($i = 0; $i < 8; $i++): ?>
                            <div class="swiper-slide">
                                <?php include 'product-card.php'; ?>
                            </div>
                        <?php endfor; ?>
                </div>
                <!-- <div class="products-slider-button-next"></div>
                <div class="products-slider-button-prev"></div>
                <div class="products-slider-pagination"></div> -->
            </div>
        </div>
    </div>
</section>


<script>
    var swiper = new Swiper(".products-slider-swiper", {
      slidesPerView: 4,
      spaceBetween: 20,
      pagination: {
        el: ".products-slider-pagination",
        clickable: true,
      },
      navigation: {
        nextEl: ".products-slider-button-next",
        prevEl: ".products-slider-button-prev",
      },
    });
</script>