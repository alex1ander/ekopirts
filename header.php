<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.css"/>
  <script src="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.js"></script>

  <!-- GLightbox -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>
  <?php wp_head() ?>
</head>

<body>
<header class="dark-block">
  <div class="container">
    <div class="top-part">
      <a href="<?= home_url();?>" class="logoc">
        <svg class="desktop-only" width="182" height="45">
          <use href="#logo"></use>
        </svg>
        <svg class="mobile-only" width="135" height="33">
          <use href="#logo-mobile"></use>
        </svg>
      </a>

      <div class="support-block">
<?php
$languages = apply_filters('wpml_active_languages', null, array('skip_missing' => 0));
if (!empty($languages)) : ?>
  <div class="language-codes">
    <?php foreach ($languages as $lang) : ?>
      <a href="<?php echo esc_url($lang['url']); ?>" 
         class="<?php echo $lang['active'] ? 'active' : ''; ?>" 
         title="<?php echo esc_attr($lang['native_name']); ?>">
        <svg width="33" height="32">
          <?php if ($lang['code'] === 'ru') : ?>
            <use href="#russia"></use>
          <?php elseif ($lang['code'] === 'lv') : ?>
            <use href="#latvia"></use>
          <?php elseif ($lang['code'] === 'en') : ?>
            <use href="#unitedkingdom"></use>
          <?php endif; ?>
        </svg>
      </a>
    <?php endforeach; ?>
  </div>
<?php endif; ?>

<?php 
$headerLinks = get_field('header_links', 'options');

if ($headerLinks) : 
    $btnTransparent = $headerLinks['btn-transparent'] ?? null;
    $btnMatte = $headerLinks['btn-matte'] ?? null;
?>

    <?php if (!empty($btnTransparent['url']) && !empty($btnTransparent['title'])) : ?>
        <a href="<?= esc_url($btnTransparent['url']); ?>" 
           target="<?= esc_attr($btnTransparent['target'] ?? '_self'); ?>" 
           class="btn btn-transparent desktop-only">
           <?= esc_html($btnTransparent['title']); ?>
        </a>
    <?php endif; ?>

    <?php if (!empty($btnMatte)) : ?>
        <a href="telto:<?= $btnMatte; ?>" 
           class="btn btn-red desktop-only">
            <svg width="27" height="27">
              <use href="#whatsapp-btn"></use>
            </svg>
            <?= $btnMatte; ?>
        </a>
    <?php endif; ?>

<?php endif; ?>

        <!-- Бургер -->
        <div class="burger-menu mobile-only">
          <div class="line"><span></span></div>
          <div class="line"><span></span></div>
          <div class="line"><span></span></div>
        </div>
      </div>
    </div>

    <div class="bottom-part desktop-only">
      <ul class="main-menu">
        <?php
        $locations = get_nav_menu_locations();
        $menu_id = isset($locations['header']) ? $locations['header'] : 0;
        $menu_items = wp_get_nav_menu_items($menu_id);
        
        if ($menu_items) {
          $menu_tree = array();
          foreach ($menu_items as $item) {
            if ($item->menu_item_parent == 0) {
              $menu_tree[$item->ID] = array(
                'item' => $item,
                'children' => array()
              );
            }
          }
          foreach ($menu_items as $item) {
            if ($item->menu_item_parent != 0) {
              if (isset($menu_tree[$item->menu_item_parent])) {
                $menu_tree[$item->menu_item_parent]['children'][] = $item;
              }
            }
          }
          
          foreach ($menu_tree as $menu_item) {
            $has_children = !empty($menu_item['children']);
            $class = $has_children ? ' class="has-submenu"' : '';
            echo '<li' . $class . '>';
            echo '<a href="' . esc_url($menu_item['item']->url) . '">' . esc_html($menu_item['item']->title) . '</a>';
            
            if ($has_children) {
              echo '<ul class="sub-menu">';
              foreach ($menu_item['children'] as $child) {
                echo '<li><a href="' . esc_url($child->url) . '">' . esc_html($child->title) . '</a></li>';
              }
              echo '</ul>';
            }
            
            echo '</li>';
          }
        }
        ?>
      </ul>
    </div>
  </div>
</header>

<?php get_template_part('components/modal-order'); ?>

<!-- Мобильное меню -->
<div class="mobile-menu">
  
  <ul>
    <?php
    $locations = get_nav_menu_locations();
    $menu_id = isset($locations['header']) ? $locations['header'] : 0;
    $menu_items = wp_get_nav_menu_items($menu_id);
    
    if ($menu_items) {
      $menu_tree = array();
      foreach ($menu_items as $item) {
        if ($item->menu_item_parent == 0) {
          $menu_tree[$item->ID] = array(
            'item' => $item,
            'children' => array()
          );
        }
      }
      foreach ($menu_items as $item) {
        if ($item->menu_item_parent != 0) {
          if (isset($menu_tree[$item->menu_item_parent])) {
            $menu_tree[$item->menu_item_parent]['children'][] = $item;
          }
        }
      }
      
      foreach ($menu_tree as $menu_item) {
        $has_children = !empty($menu_item['children']);
        $class = $has_children ? ' class="has-submenu"' : '';
        echo '<li' . $class . '>';
        echo '<a href="' . esc_url($menu_item['item']->url) . '">' . esc_html($menu_item['item']->title) . '</a>';
        
        if ($has_children) {
          echo '<ul class="sub-menu">';
          foreach ($menu_item['children'] as $child) {
            echo '<li><a href="' . esc_url($child->url) . '">' . esc_html($child->title) . '</a></li>';
          }
          echo '</ul>';
        }
        
        echo '</li>';
      }
    }
    ?>
  </ul>


  <div class="buttons">
    <?php $social_links = get_field('social_links', 'options'); // Ссылки на соцсети ?>

    <?php if (!empty($social_links) && is_array($social_links)) : ?>
        <div class="social-links">
            <?php foreach ($social_links as $social) : 
                $link = !empty($social['link']) ? esc_url($social['link']) : '#';
                $icon = !empty($social['icon']) ? $social['icon'] : '';
                if ($icon) :
            ?>
                <a href="<?= $link; ?>" target="_blank" rel="noopener noreferrer">
                    <?= $icon; ?>
                </a>
            <?php 
                endif;
            endforeach; ?>
        </div>
    <?php endif; ?>

    <div class="bottom">
    <?php if (!empty($btnTransparent['url']) && !empty($btnTransparent['title'])) : ?>
          <a href="<?= esc_url($btnTransparent['url']); ?>" 
            target="<?= esc_attr($btnTransparent['target'] ?? '_self'); ?>" 
            class="btn btn-transparent">
            <?= esc_html($btnTransparent['title']); ?>
          </a>
      <?php endif; ?>

      <?php if (!empty($btnMatte)) : ?>
        <a href="telto:<?= $btnMatte; ?>" 
           class="btn btn-matte">
           <?= $btnMatte; ?>
        </a>
      <?php endif; ?>
    </div>
  </div>
</div>

<!-- Фоновая подложка (опционально, если хочешь затемнение) -->
<div class="menu-overlay"></div>

<script>
document.addEventListener('DOMContentLoaded', () => {
  const burger = document.querySelector('.burger-menu');
  const mobileMenu = document.querySelector('.mobile-menu');
  const overlay = document.querySelector('.menu-overlay');

  const toggleMenu = () => {
    burger.classList.toggle('active');
    mobileMenu.classList.toggle('active');
    overlay.classList.toggle('active');
    document.body.classList.toggle('menu-open');
  };

  burger.addEventListener('click', toggleMenu);
  overlay.addEventListener('click', toggleMenu);

});



// Открытие подменю в мобильном меню
document.addEventListener('DOMContentLoaded', () => {
  const submenuParents = document.querySelectorAll('.mobile-menu .has-submenu > a');

  submenuParents.forEach(parentLink => {
    parentLink.addEventListener('click', (e) => {
      e.preventDefault();
      const li = parentLink.parentElement;

      // закрываем все другие подменю
      document.querySelectorAll('.mobile-menu .has-submenu').forEach(item => {
        if (item !== li) item.classList.remove('open');
      });

      // переключаем текущее
      li.classList.toggle('open');
    });
  });
});

// Модальное окно заказа
document.addEventListener('DOMContentLoaded', () => {
  const modal = document.getElementById('order-modal');
  const dialog = modal ? modal.querySelector('.modal__dialog') : null;
  const openTriggers = document.querySelectorAll('.add-order .order-text');
  const closeTriggers = modal ? modal.querySelectorAll('.modal-close') : [];

  const openModal = () => {
    if (!modal) return;
    modal.setAttribute('aria-hidden', 'false');
    modal.classList.add('is-open');
    document.body.classList.add('modal-open');
  };

  const closeModal = () => {
    if (!modal) return;
    modal.setAttribute('aria-hidden', 'true');
    modal.classList.remove('is-open');
    document.body.classList.remove('modal-open');
  };

  openTriggers.forEach(btn => {
    btn.addEventListener('click', (e) => {
      e.preventDefault();
      // Найдём карточку товара и вытащим данные
      const card = btn.closest('.product-card, .the-product');
      const title = btn.getAttribute('data-product-title') || (card ? (card.querySelector('.product-name, h1')?.textContent || '').trim() : '');
      const img = btn.getAttribute('data-product-image') || (card ? (card.querySelector('img')?.getAttribute('src') || '') : '') || '';
      const price = btn.getAttribute('data-product-price') || (card ? (card.querySelector('.new-price, .current-price')?.textContent || '') : '');

      // Проставим в модалку
      const modalTitle = document.getElementById('order-product-title');
      const modalImg = document.getElementById('order-product-image');
      const inputName = document.getElementById('order-product-name-input');
      const inputImg = document.getElementById('order-product-image-input');
      const inputPrice = document.getElementById('order-product-price-input');
      const priceEl = document.getElementById('order-product-price');
      if (modalTitle) modalTitle.textContent = title || '<?php echo esc_js(__('Product', 'ekopirts')); ?>';
      if (modalImg && img) modalImg.src = img;
      if (inputName) inputName.value = title || '';
      if (inputImg) inputImg.value = img || '';
      if (inputPrice) inputPrice.value = price || '';
      if (priceEl) priceEl.textContent = price ? '€' + price : '';

      openModal();
    });
  });

  if (modal) {
    closeTriggers.forEach(el => el.addEventListener('click', closeModal));
    modal.addEventListener('click', (e) => {
      if (e.target === modal) closeModal();
    });
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape') closeModal();
    });
  }
});

</script>