<section class="grid-show">
    <div class="container products-area">
        <?php get_template_part('components/category-list-block');?>
        

        <div class="category-elements-block">
            <div class="grid-products-elements">


                <?php for($i = 0 ; $i < 15; $i++):?>
                <?php include 'product-card.php' ?>
                <?php endfor;?>
            </div>
        </div>
    </div>
</section>