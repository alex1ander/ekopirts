<!DOCTYPE html>
<html lang="lv">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.css"/>
  <script src="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.js"></script>
  <title>Header with Burger Menu</title>
</head>

<body>
<header class="dark-block">
  <div class="container">
    <div class="top-part">
      <svg width="182" height="45">
        <use href="#logo"></use>
      </svg>

      <div class="support-block">
        <div class="language-codes">
          <a href="#">
            <svg width="33" height="32">
              <use href="#russia"></use>
            </svg>
          </a>
          <a href="#">
            <svg width="33" height="32">
              <use href="#latvia"></use>
            </svg>
          </a>
          <a href="#">
            <svg width="33" height="32">
              <use href="#unitedkingdom"></use>
            </svg>
          </a>
        </div>

        <a href="#" class="btn btn-transparent desktop-only">Jautājums?</a>
        <a href="#" class="btn btn-matte desktop-only">+371 25912321</a>

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
        <li><a href="#">page</a></li>
        <li class="has-submenu">
          <a href="#">menu</a>
          <ul class="sub-menu">
            <li><a href="#">menu second</a></li>
            <li><a href="#">menu second</a></li>
            <li><a href="#">menu second</a></li>  
            <li><a href="#">menu second</a></li>      
          </ul>
        </li>
        <li><a href="#">page</a></li>
        <li><a href="#">page</a></li>
        <li><a href="#">page</a></li>
      </ul>
    </div>
  </div>
</header>

<?php include 'components/modal-order.php'; ?>

<!-- Мобильное меню -->
<nav class="mobile-menu">
  <ul>
    <li><a href="#">page</a></li>
    <li class="has-submenu">
      <a href="#">page</a>
      <ul class="sub-menu">
        <li><a href="#">menu second</a></li>
        <li><a href="#">menu second</a></li>
        <li><a href="#">menu second</a></li>  
        <li><a href="#">menu second</a></li>  
      </ul>
    </li>
    <li><a href="#">page</a></li>
    <li><a href="#">page</a></li>
    <li><a href="#">page</a></li>
  </ul>
</nav>

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
const submenuParents = document.querySelectorAll('.mobile-menu .has-submenu > a');

submenuParents.forEach(parentLink => {
  parentLink.addEventListener('click', (e) => {
    e.preventDefault(); // предотвращаем переход по ссылке
    const li = parentLink.parentElement;

    // закрываем все другие подменю (если хочешь, чтобы открывалось только одно)
    document.querySelectorAll('.mobile-menu .has-submenu').forEach(item => {
      if (item !== li) item.classList.remove('open');
    });

    // переключаем текущее
    li.classList.toggle('open');
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
      const titleEl = card ? card.querySelector('.product-name, h1') : null;
      const imgEl = card ? card.querySelector('img') : null;
      const title = titleEl ? titleEl.textContent.trim() : '';
      const img = imgEl ? imgEl.getAttribute('src') : '/images/product.png';

      // Проставим в модалку
      const modalTitle = document.getElementById('order-product-title');
      const modalImg = document.getElementById('order-product-image');
      const inputName = document.getElementById('order-product-name-input');
      const inputImg = document.getElementById('order-product-image-input');
      if (modalTitle) modalTitle.textContent = title || 'Produkts';
      if (modalImg && img) modalImg.src = img;
      if (inputName) inputName.value = title || '';
      if (inputImg) inputImg.value = img || '';

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
