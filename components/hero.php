<section id="hero" class="hero hero-section">
  <div class="slider-area">
    <!-- === Главный слайдер === -->
    <div class="swiper heroSwiper">
      <div class="swiper-wrapper">
        <?php for($i = 0; $i < 6; $i++): ?>
        <div class="swiper-slide">
          <div class="hero-slide">
            <?php if($i % 2 == 0): ?>
              <img class="hero-background" src="/images/hero.png" alt="">
            <?php else: ?>
              <img class="hero-background" src="/images/nested.png" alt="">
            <?php endif; ?>

            <div class="container">
              <div class="hero-content">
                <div class="hero-info">
                  <h1 class="hero-title">Tava Mucu Pirts</h1>
                  <p class="hero-text">Pērc No Ražotāja būs Lētāk</p>
                  <a href="#" class="btn btn-matte">+371 25912321</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php endfor; ?>
      </div>

      <div class="swiper-button-prev desktop-only"></div>
      <div class="swiper-button-next desktop-only"></div>
    </div>

    <!-- === Превью (нижний слайдер) === -->
    <div class="nested-slider">
      <div class="swiper nested-swiper">
        <div class="swiper-wrapper">
          <?php for($j = 0; $j < 6; $j++): ?>
          <div class="swiper-slide">
            <div class="nested-slide">
              <div class="nested-content">
                <?php if($j % 2 == 0): ?>
                  <img class="nested-image" src="/images/hero.png" alt="">
                <?php else: ?>
                  <img class="nested-image" src="/images/nested.png" alt="">
                <?php endif; ?>
                <div class="nested-bottom">
                  <span class="nested-name">Name <?php echo $j + 1; ?></span>
                </div>
              </div>
            </div>
          </div>
          <?php endfor; ?>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
document.addEventListener("DOMContentLoaded", function() {
  const totalSlides = 6;
  let isHeroChanging = false;
  let isNestedChanging = false;

  // === Сначала создаём превью-слайдер ===
  const nestedSwiper = new Swiper(".nested-swiper", {
    loop: true,
    slidesPerView: 3,
    spaceBetween: 10,
    slideToClickedSlide: true,
    centeredSlides: true,
    watchSlidesProgress: true,
    loopedSlides: totalSlides,
    breakpoints: {
      540: { slidesPerView: 2 },
      768: { slidesPerView: 2.5 },
      1024: { slidesPerView: 3 },
    }
  });

  // === Затем главный слайдер с эффектом fade ===
  const heroSwiper = new Swiper(".heroSwiper", {
    loop: true,
    loopedSlides: totalSlides,
    centeredSlides: true,
    speed: 800,
    effect: 'fade',
    fadeEffect: {
      crossFade: true
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    }
  });

  // === Полная двусторонняя синхронизация ===
  
  // Когда меняется главный слайдер -> обновляем превью
  heroSwiper.on('slideChange', function() {
    if (!isNestedChanging) {
      isHeroChanging = true;
      nestedSwiper.slideToLoop(heroSwiper.realIndex);
      setTimeout(() => { isHeroChanging = false; }, 50);
    }
  });

  // Когда меняется превью -> обновляем главный
  nestedSwiper.on('slideChange', function() {
    if (!isHeroChanging) {
      isNestedChanging = true;
      heroSwiper.slideToLoop(nestedSwiper.realIndex);
      setTimeout(() => { isNestedChanging = false; }, 50);
    }
  });

  // Клик по превью
  nestedSwiper.on('click', function() {
    heroSwiper.slideToLoop(nestedSwiper.clickedIndex);
  });
});
</script>