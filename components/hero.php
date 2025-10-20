<?php 
$heroSlider = get_field('hero-slider');
// echo '<pre>';
// print_r($heroSlider);
// echo '</pre>';
?>


<section id="hero" class="hero hero-section">
  <div class="slider-area">
    <!-- === Главный слайдер === -->
    <div class="swiper heroSwiper">
      <div class="swiper-wrapper">
        <?php foreach($heroSlider as $slide): ?>
        <div class="swiper-slide">
          <div class="hero-slide">
        
            <img class="hero-background" src="<?= $slide['image'] ?>" alt="">

            <div class="container">
              <div class="hero-content">
                <div class="hero-info">
                  <h1 class="hero-title"><?= $slide['title'] ?></h1>
                  <p class="hero-text"><?= $slide['text'] ?></p>
                  <a href="<?= $slide['button']['url'] ?>" target="<?= $slide['button']['target'] ?>" class="btn btn-matte hover-red"><?= $slide['button']['title'] ?></a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>

      <div class="swiper-button-prev desktop-only"></div>
      <div class="swiper-button-next desktop-only"></div>
    </div>

    <!-- === Превью (нижний слайдер) === -->
    <div class="nested-slider">
      <div class="swiper nested-swiper">
        <div class="swiper-wrapper">
          <?php foreach($heroSlider as $slide): ?>
          <div class="swiper-slide">
            <div class="nested-slide">
              <div class="nested-content">
                <img class="nested-image" src="<?= $slide['image'] ?>" alt="">
                <div class="nested-bottom">
                  <span class="nested-name"><?= $slide['icon-text'] ?></span>
                </div>
              </div>
            </div>
          </div>
           <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
document.addEventListener("DOMContentLoaded", function () {
  // === Нижний (превью) слайдер ===
  const nestedSwiper = new Swiper(".nested-swiper", {
    slidesPerView: 2,
    spaceBetween: 10,
    centeredSlides: true,
    slideToClickedSlide: true,
    watchSlidesProgress: true,
    breakpoints: {
      540: { slidesPerView: 2 },
      768: { slidesPerView: 2.5 },
      1024: { slidesPerView: 3 },
    },
  });

  // === Верхний (главный) слайдер ===
  const heroSwiper = new Swiper(".heroSwiper", {
    speed: 800,
    effect: "fade",
    fadeEffect: { crossFade: true },
    centeredSlides: true,
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
  });

  // === Синхронизация: при смене верхнего обновляем нижний ===
  heroSwiper.on("slideChange", function () {
    const realIndex = heroSwiper.activeIndex;
    nestedSwiper.slideTo(realIndex);
  });

  // === Синхронизация: при смене нижнего обновляем верхний ===
  nestedSwiper.on("slideChange", function () {
    const realIndex = nestedSwiper.activeIndex;
    heroSwiper.slideTo(realIndex);
  });

  // === Клик по нижнему слайду ===
  nestedSwiper.on("click", function (swiper) {
    if (typeof swiper.clickedIndex !== "undefined") {
      heroSwiper.slideTo(swiper.clickedIndex);
    }
  });
});
</script>
