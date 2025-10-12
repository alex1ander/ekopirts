<section class="show-cat">
    <div class="container">
        <div class="show-cat-content">

            <div class="show-cat-titles">
                <h2>Kādēļ Izvēlēties Mūsu Produkciju ?</h2>
                <p>Ir daudz un dažādu iemeslu, bet svarīgākais, mēs savā darbā ieliekam dvēseli un to var just katrā mūsu produktu līnijā.</p>
            </div>

            <div class="benefits">
                <div class="swiper benefits-slider-swiper">
                    <div class="swiper-wrapper">
                        <?php for($i = 0;$i < 6; $i++): ?>
                        <div class="swiper-slide">
                            <div class="benefit">
                                    <div class="gear-box">
                                        <svg width="101" height="101">
                                            <use href="#gear"></use>
                                        </svg>
                                    </div>
                                    <div class="benefit-title">Ražotāji</div>
                                    <div class="benefit-text">Paši ražojam un pārdodam savu produkciju. Tas nav tikai produkts, ko pārdot, tas ir mūsu arods, mūsu hobijs, mūsu dvēsele.</div>

                                    <ul class="benefit-list">
                                        <li>Ražots Latvijā</li>
                                        <li>Ražots Latvijā</li>
                                        <li>Ražots Latvijā</li>
                                        <li>Ražots Latvijā</li>
                                    </ul>


                                    <div class="category-preview">
                                        <div class="category-image">
                                            <img src="/images/category.png" alt="">
                                        </div>
                                        <div class="category-info">
                                            <span class="name">Apaļās pirts mucas</span>
                                            <div class="category-arrow">
                                                <svg width="15" height="28">
                                                    <use href="#arrow-right"></use>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <?php endfor; ?>
                    </div>
                </div>
                <div class="swiper-button-next benefits-slider-button-next desktop-only"></div>
                <div class="swiper-button-prev benefits-slider-button-prev desktop-only"></div>
                <div class="benefits-slider-pagination"></div>
            </div>

        </div>
    </div>
</section>


<script>
    var swiper = new Swiper(".benefits-slider-swiper", {
      slidesPerView: 1,
      spaceBetween: 20,
      pagination: {
        el: '.benefits-slider-pagination',
        clickable: true,
      },
      navigation: {
        nextEl: '.benefits-slider-button-next',
        prevEl: '.benefits-slider-button-prev',
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