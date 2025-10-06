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
            <div class="grid-products-elements">


                <?php for($i = 0 ; $i < 15; $i++):?>
                <div class="category-preview">
                    <img class="category-image" src="/images/category.png" alt="">
                    <div class="category-info">
                        <span class="name">Apaļās pirts mucas</span>
                        <div class="category-arrow">
                            <svg width="15" height="28">
                                <use href="#arrow-right"></use>
                            </svg>
                        </div>
                    </div>
                </div>
                <?php endfor;?>
            </div>
        </div>
    </div>
</section>