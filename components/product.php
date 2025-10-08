<section class="grid-show">
    <div class="container products-area">
        <div class="category-list-block">
            <h3 class="category-block-title">Sadaļas</h3>

            <ul class="category-list">
                <li><a href="#">Apaļās pirts mucas</a></li>
                <li><a href="#">Apaļās pirts mucas</a></li>
                <li><a href="#">Apaļās pirts mucas</a></li>
                <li><a href="#">Apaļās pirts mucas</a></li>
                <li><a href="#">Apaļās pirts mucas</a></li>
                <li><a href="#">Apaļās pirts mucas</a></li>
                <li><a href="#">Apaļās pirts mucas</a></li>
            </ul>
        </div>
        

        <div class="category-elements-block">
            <div class="the-product">
                <div class="the-product-top">
                    <!-- Большой слайдер -->


                    <div class="product-images">
                        <div class="swiper main-slider">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <img src="/images/product.png" alt="">
                                </div>
                                <div class="swiper-slide">
                                    <img src="/images/product.png" alt="">
                                </div>
                                <div class="swiper-slide">
                                    <img src="/images/product.png" alt="">
                                </div>
                                <div class="swiper-slide">
                                    <img src="/images/product.png" alt="">
                                </div>
                                <div class="swiper-slide">
                                    <img src="/images/product.png" alt="">
                                </div>
                            </div>
                        </div>

                            <!-- Маленькие миниатюры -->
                        <div class="swiper thumbs-slider">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <img src="/images/product.png" alt="">
                                </div>
                                <div class="swiper-slide">
                                    <img src="/images/product.png" alt="">
                                </div>
                                <div class="swiper-slide">
                                    <img src="/images/product.png" alt="">
                                </div>
                                <div class="swiper-slide">
                                    <img src="/images/product.png" alt="">
                                </div>
                                <div class="swiper-slide">
                                    <img src="/images/product.png" alt="">
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="main-product-info">
                        <div class="block-info">
                            <h1>2,5 m apaļā pirts muca</h1>
                            <div class="price">
                                <span class="old-price">€3,900.00</span>
                                <span class="new-price">€2,900.00</span>
                            </div>
                        </div>
                        <div class="block-info">
                            <p class="short-description">Pirts muca(apaļā) 2,5m. Ekonomiskā pirtiņa.Pirts diametrs 2,25m.</p>
                        </div>
                        <div class="block-info">
                                <div class="product-characteristic">
                                    <div class="characteristic-row">
                                        <span class="char-name">Izmērs:</span>
                                        <span class="char-value">2,5m</span>
                                    </div>
                                      <div class="characteristic-row">
                                        <span class="char-name">Izmērs:</span>
                                        <span class="char-value">2,5m</span>
                                    </div>
                                      <div class="characteristic-row">
                                        <span class="char-name">Izmērs:</span>
                                        <span class="char-value">2,5m</span>
                                    </div>
                                </div>
                        </div>


                        <div class="add-order">
                            <div class="order-text">Noformēt pasūtījumu</div>
                            <div class="icon">
                                <svg width="33" height="33">
                                    <use href="#whatsapp"></use>
                                </svg>
                            </div>
                        </div>
                    </div>

                </div>


               <div class="the-product-bottom">
                    <div class="tabs">
                        <div class="tab-buttons">
                        <button class="active">Tab 1</button>
                        <button>Tab 2</button>
                        </div>

                        <div class="tab-contents">
                        <div class="tab-content active">
                            <h3>Tab 1 Content</h3>
                            <p>This is the content for Tab 1.</p>
                        </div>
                        <div class="tab-content">
                            <h3>Tab 2 Content</h3>
                            <p>This is the content for Tab 2.</p>
                        </div>
                        </div>
                    </div>
                </div>




            </div>
        </div>
    </div>
</section>


<script>
document.addEventListener("DOMContentLoaded", () => {
  const tabButtons = document.querySelectorAll(".tab-buttons button");
  const tabContents = document.querySelectorAll(".tab-content");

  tabButtons.forEach((button, index) => {
    button.addEventListener("click", () => {
      // Удаляем активный класс у всех кнопок и контента
      tabButtons.forEach(btn => btn.classList.remove("active"));
      tabContents.forEach(content => content.classList.remove("active"));

      // Добавляем активный класс текущим
      button.classList.add("active");
      tabContents[index].classList.add("active");
    });
  });
});
</script>

<script>

    const thumbs = new Swiper('.thumbs-slider', {
    slidesPerView: 4,
    spaceBetween: 10,
    watchSlidesProgress: true,
  });

  const main = new Swiper('.main-slider', {
    spaceBetween: 10,
    thumbs: {
      swiper: thumbs,
    },
  });
</script>
