<?php 
$showCategory = get_field('products_by_category');
// echo '<pre>';
// print_r($showCategory);
// echo '</pre>';


$category_link = '';
if (!empty($showCategory['categories'])) {
    $first_cat_id = $showCategory['categories'][0];
    $term = get_term($first_cat_id, 'product_category');
    if ($term && !is_wp_error($term)) {
        $category_link = get_term_link($term);
    }
}
?>

<section class="products-slider">
  <div class="container">
    <div class="products-slider-content">

      <div class="products-head">
        <div class="title-block">
          <h2 class="products-title"><?php _e('Our Products', 'ekopirts'); ?></h2>
        </div>

        <ul class="category-tabs desktop-only">
          <?php 
          $first = true;
          foreach($showCategory['categories'] as $cat_id):
              $term = get_term($cat_id, 'product_category');
              if(is_wp_error($term)) continue;
          ?>
              <li data-tab="tab-<?= $cat_id; ?>" class="<?= $first ? 'active' : ''; ?>">
                  <?= esc_html($term->name); ?>
              </li>
          <?php 
              $first = false;
          endforeach; 
          ?>
        </ul>


        <a href="<?php echo esc_url($category_link ? $category_link : '#'); ?>" class="all-products">
          <span><?php _e('Show All', 'ekopirts'); ?></span>
          <div class="category-arrow">
              <svg width="15" height="28">
                  <use href="#arrow-right"></use>
              </svg>
          </div>
        </a>

      </div>

      <div class="products-body">
        <?php 
        $first = true;
        foreach($showCategory['categories'] as $cat_id):
            $term = get_term($cat_id, 'product_category');
            if(is_wp_error($term)) continue;

            // Получаем все товары из этой категории
            $products = new WP_Query(array(
                'post_type' => 'product',
                'posts_per_page' => -1,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'product_category',
                        'field' => 'term_id',
                        'terms' => $cat_id,
                    )
                )
            ));
        ?>
          <div class="products-tab-content <?= $first ? 'active' : ''; ?>" data-tab-content="tab-<?= $cat_id; ?>">
            <div class="swiper products-slider-swiper tab-<?= $cat_id; ?>">
              <div class="swiper-wrapper">
                <?php if($products->have_posts()): ?>
                  <?php while($products->have_posts()): $products->the_post(); ?>
                    <div class="swiper-slide flex-slide">
                      <?php 
                        $product_data = array(
                            'gallery'   => get_field('gallery'),
                            'price'     => get_field('price'),
                            'title'     => get_the_title(), // название товара
                            'excerpt'   => wp_trim_words(get_the_excerpt(), 10, '...'), // описание до ~50 символов
                        );

                        get_template_part('components/product-card', null, $product_data);
                        ?>
                    </div>
                  <?php endwhile; wp_reset_postdata(); ?>
                <?php else: ?>
                  <p><?php _e('No products in this category', 'ekopirts'); ?></p>
                <?php endif; ?>
              </div>
            </div>
            <div class="swiper-button-next products-slider-button-next desktop-only"></div>
            <div class="swiper-button-prev products-slider-button-prev desktop-only"></div>
            <div class="products-slider-pagination"></div>
          </div>
        <?php 
          $first = false;
        endforeach; 
        ?>
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
