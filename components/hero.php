<?php 
$heroSlider = get_field('hero-slider');

if ($heroSlider && !empty($heroSlider)):
?>


<section id="hero" class="hero hero-section">
  <div class="slider-area">
    <!-- === Главный слайдер === -->
     <div class="swiper heroSwiper">
      <div class="swiper-wrapper">
        <div class="swiper-slide">
          <div class="hero-slide">
        
            <img class="hero-background" src="<?= $heroSlider['image'] ?>" alt="">

            <div class="container">
              <div class="hero-content">
                <div class="hero-info">
                  <h1 class="hero-title"><?= $heroSlider['title'] ?></h1>
                  <p class="hero-text"><?= $heroSlider['text'] ?></p>
                  <a href="<?= $heroSlider['button']['url'] ?>" target="<?= $heroSlider['button']['target'] ?>" class="btn btn-matte hover-red"><?= $heroSlider['button']['title'] ?></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- === Превью (нижний слайдер) === -->
    <div class="nested-slider">
      <div class="swiper nested-swiper">
        <div class="swiper-wrapper">
          <?php foreach($heroSlider['slider_link'] as $slide): ?>
          <div class="swiper-slide">
            <a href="<?= $slide['link']['url'] ?>" target="<?= $slide['link']['target'] ?>" class="nested-slide">
              <div class="nested-content">
                <img class="nested-image" src="<?= $slide['image'] ?>" alt="">
                <div class="nested-bottom">
                  <span class="nested-name"><?= $slide['link']['title'] ?></span>
                </div>
              </div>
            </a>
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
    initialSlide: 1, 
    breakpoints: {
      540: { slidesPerView: 2 },
      768: { slidesPerView: 2.5 },
      1024: { slidesPerView: 3 },
    },
  });


  // === Клик по нижнему слайду ===
  nestedSwiper.on("click", function (swiper) {
    if (typeof swiper.clickedIndex !== "undefined") {
      heroSwiper.slideTo(swiper.clickedIndex);
    }
  });
});
</script>

<?php endif; ?>
