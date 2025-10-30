<?php 
// Получаем значение из поля "related" (категория)
$related_category = get_field('related');

// Если категория указана вручную
if ($related_category) {

    // Используем указанную категорию
    $terms = array($related_category);

} else {

    // Иначе получаем категории текущего товара
    $current_product_id = get_the_ID();
    $terms = wp_get_post_terms($current_product_id, 'product_category', array('fields' => 'ids'));
}


$category_link = '';
if (!empty($terms)) {
    // Берем первую категорию из массива $terms
    $term_id = $terms[0];
    $term = get_term($term_id, 'product_category');
    if ($term && !is_wp_error($term)) {
        $category_link = get_term_link($term);
    }
}

// Проверяем, есть ли категории
if ($terms):

    // Запрос случайных сопутствующих товаров из выбранных категорий
    $related_products = new WP_Query(array(
        'post_type'      => 'product',
        'posts_per_page' => 8,
        'post__not_in'   => !empty($current_product_id) ? array($current_product_id) : array(),
        'orderby'        => 'rand',
        'tax_query'      => array(
            array(
                'taxonomy' => 'product_category',
                'field'    => 'term_id',
                'terms'    => $terms,
            ),
        ),
    ));
?>
<section class="products-slider dark1">
  <div class="container">
    <div class="products-slider-content">

      <div class="products-head">
        <div class="title-block">
          <h2 class="products-title"><?php _e('Related Products', 'ekopirts'); ?></h2>
        </div>

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
        <div class="products-tab-content active">
          <div class="swiper products-slider-swiper related-products-swiper">
            <div class="swiper-wrapper">
              <?php if ($related_products->have_posts()): ?>
                <?php while ($related_products->have_posts()): $related_products->the_post(); ?>
                  <div class="swiper-slide flex-slide">
                    <?php 
                      $product_data = array(
                          'gallery' => get_field('gallery'),
                          'price'   => get_field('price'),
                          'title'   => get_the_title(),
                          'excerpt' => wp_trim_words(get_the_excerpt(), 10, '...'),
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
          <div class="products-slider-pagination gray"></div>
        </div>
      </div>

    </div>
  </div>
</section>


<script>
  new Swiper('.related-products-swiper', {
    slidesPerView: 1,
    spaceBetween: 20,
    pagination: {
      el: '.products-slider-pagination',
      clickable: true,
    },
    navigation: {
      nextEl: '.products-slider-button-next',
      prevEl: '.products-slider-button-prev',
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
</script>

<?php endif; ?>