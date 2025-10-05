<section class="products-slider">
  <div class="container">
    <div class="products-slider-content">
      <div class="products-head">
        <div class="title-block">
          <h2 class="products-title">Mūsu produkcija</h2>
        </div>
        <ul class="category-tabs">
          <li data-tab="tab1" class="active">Mucu Pirtis</li>
          <li data-tab="tab2">Kubli</li>
          <li data-tab="tab3">Produktu katalogs</li>
          <li data-tab="tab4">Mājas</li>
        </ul>
        <a href="#" class="products-link">Radit visu</a>
      </div>

      <div class="products-body">
        <!-- TAB 1 -->
        <div class="products-tab-content active" data-tab-content="tab1">
          <div class="swiper products-slider-swiper tab1-swiper">
            <div class="swiper-wrapper">
              <?php for($i = 0; $i < 8; $i++): ?>
                <div class="swiper-slide flex-slide">
                  <?php include 'product-card.php'; ?>
                </div>
              <?php endfor; ?>
            </div>
          </div>
          <div class="swiper-button-next products-slider-button-next desktop-only"></div>
          <div class="swiper-button-prev products-slider-button-prev desktop-only"></div>
          <div class="products-slider-pagination"></div>
        </div>

        <!-- TAB 2 -->
        <div class="products-tab-content" data-tab-content="tab2">
          <div class="swiper products-slider-swiper tab2-swiper">
            <div class="swiper-wrapper">
              <?php for($i = 0; $i < 6; $i++): ?>
                <div class="swiper-slide flex-slide">
                  <?php include 'product-card.php'; ?>
                </div>
              <?php endfor; ?>
            </div>
          </div>
          <div class="swiper-button-next products-slider-button-next desktop-only"></div>
          <div class="swiper-button-prev products-slider-button-prev desktop-only"></div>
          <div class="products-slider-pagination"></div>
        </div>

        <!-- TAB 3 -->
        <div class="products-tab-content" data-tab-content="tab3">
          <div class="swiper products-slider-swiper tab3-swiper">
            <div class="swiper-wrapper">
              <?php for($i = 0; $i < 4; $i++): ?>
                <div class="swiper-slide flex-slide">
                  <?php include 'product-card.php'; ?>
                </div>
              <?php endfor; ?>
            </div>
          </div>
          <div class="swiper-button-next products-slider-button-next desktop-only"></div>
          <div class="swiper-button-prev products-slider-button-prev desktop-only"></div>
          <div class="products-slider-pagination"></div>
        </div>

        <!-- TAB 4 -->
        <div class="products-tab-content" data-tab-content="tab4">
          <div class="swiper products-slider-swiper tab4-swiper">
            <div class="swiper-wrapper">
              <?php for($i = 0; $i < 5; $i++): ?>
                <div class="swiper-slide flex-slide">
                  <?php include 'product-card.php'; ?>
                </div>
              <?php endfor; ?>
            </div>
          </div>
          <div class="swiper-button-next products-slider-button-next desktop-only"></div>
          <div class="swiper-button-prev products-slider-button-prev desktop-only"></div>
          <div class="products-slider-pagination"></div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
  // Инициализация всех слайдеров
  const swipers = {};
  document.querySelectorAll('.products-slider-swiper').forEach((el, i) => {
    swipers[i] = new Swiper(el, {
      slidesPerView: 1,
      spaceBetween: 20,
      pagination: {
        el: el.closest('.products-tab-content').querySelector('.products-slider-pagination'),
        clickable: true,
      },
      navigation: {
        nextEl: el.closest('.products-tab-content').querySelector('.products-slider-button-next'),
        prevEl: el.closest('.products-tab-content').querySelector('.products-slider-button-prev'),
      },
      breakpoints: {
        540: {
          slidesPerView: 1,
        },
        768: {
          slidesPerView: 2,
        },
        1024: {
          slidesPerView: 4,
        },
      },
    });
  });

  // Переключение табов
  const tabs = document.querySelectorAll('.category-tabs li');
  const contents = document.querySelectorAll('.products-tab-content');

  tabs.forEach(tab => {
    tab.addEventListener('click', () => {
      const target = tab.getAttribute('data-tab');

      tabs.forEach(t => t.classList.remove('active'));
      tab.classList.add('active');

      contents.forEach(c => {
        c.classList.remove('active');
        if (c.getAttribute('data-tab-content') === target) {
          c.classList.add('active');
        }
      });
    });
  });
</script>
