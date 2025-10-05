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

</script>
