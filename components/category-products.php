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
                <?php include 'product-card.php' ?>
                <?php endfor;?>
            </div>
        </div>
    </div>
</section>