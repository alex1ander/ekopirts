<?php 
$gallery = get_field('gallery');
if ($gallery):
?>
<section class="gallery">
    <div class="container">
        <div class="gallery-block">
            <div class="gallery-head">
                <!-- Обертка для теней -->
                <div class="gallery-tabs-wrapper">
                    <!-- Swiper контейнер -->
                    <div class="gallery-tabs swiper">
                        <div class="swiper-wrapper">
                            <?php foreach ($gallery as $index => $item): ?>
                                <div 
                                    class="swiper-slide btn btn-secondary <?php echo $index === 0 ? 'active' : ''; ?>" 
                                    data-tab="tab-<?php echo $index; ?>">
                                    <?php echo esc_html($item['title']); ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <!-- Тени -->
                    <div class="gallery-shadow gallery-shadow-left"></div>
                    <div class="gallery-shadow gallery-shadow-right"></div>
                </div>
            </div>

            <div class="gallery-body">
                <?php foreach ($gallery as $index => $item): ?>
                <div 
                    class="grid-image-gallery <?php echo $index === 0 ? 'active' : ''; ?>" 
                    data-tab-content="tab-<?php echo $index; ?>">
                    <?php if (!empty($item['gallery'])): ?>
                        <?php foreach ($item['gallery'] as $image): ?>
                        <a 
                            href="<?php echo esc_url($image); ?>" 
                            class="glightbox"
                            data-gallery="gallery-<?php echo $index; ?>">
                            <img src="<?php echo esc_url($image); ?>" alt="" style="cursor:pointer;">
                        </a>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>


<?php endif; ?>

<script>
document.addEventListener('DOMContentLoaded', () => {

  const tabs = document.querySelectorAll('.gallery-tabs .swiper-slide');
  const contents = document.querySelectorAll('.grid-image-gallery');
  const shadowLeft = document.querySelector('.gallery-shadow-left');
  const shadowRight = document.querySelector('.gallery-shadow-right');
  const swiperContainer = document.querySelector('.gallery-tabs');

  // Добавляем класс инициализации
  if (swiperContainer) {
    swiperContainer.classList.add('swiper-initializing');
  }

  // Инициализация Swiper для drag
  const gallerySwiper = new Swiper(".gallery-tabs", {
    slidesPerView: "auto",
    spaceBetween: 12,
    freeMode: true,
    grabCursor: true,
    on: {
      init: function() {
        // Убираем класс инициализации после init
        if (swiperContainer) {
          swiperContainer.classList.remove('swiper-initializing');
        }
        updateShadows(this);
      },
      slideChange: function() {
        updateShadows(this);
      },
      reachBeginning: function() {
        updateShadows(this);
      },
      reachEnd: function() {
        updateShadows(this);
      },
      progress: function() {
        updateShadows(this);
      },
      setTranslate: function() {
        updateShadows(this);
      }
    }
  });

  // Функция обновления видимости теней
  function updateShadows(swiper) {
    const isBeginning = swiper.isBeginning;
    const isEnd = swiper.isEnd;

    // Показываем левую тень, если не в начале
    if (shadowLeft) {
      shadowLeft.classList.toggle('visible', !isBeginning);
    }

    // Показываем правую тень, если не в конце
    if (shadowRight) {
      shadowRight.classList.toggle('visible', !isEnd);
    }
  }

  // Переключение табов
  tabs.forEach(tab => {
    tab.addEventListener('click', () => {
      const target = tab.getAttribute('data-tab');

      // Снимаем активные классы
      tabs.forEach(t => t.classList.remove('active'));
      contents.forEach(c => c.classList.remove('active'));

      // Делаем активными выбранный таб и контент
      tab.classList.add('active');
      const activeContent = document.querySelector(`.grid-image-gallery[data-tab-content="${target}"]`);
      if (activeContent) activeContent.classList.add('active');

      // Прокрутка к выбранному табу
      gallerySwiper.slideTo(Array.from(tabs).indexOf(tab), 300);
    });
  });

  // Инициализация GLightbox
  GLightbox({
    selector: '.glightbox',
    touchNavigation: true,
    loop: true,
    zoomable: true,
  });

  // Обновление теней при изменении размера окна
  window.addEventListener('resize', () => {
    updateShadows(gallerySwiper);
  });

});
</script>