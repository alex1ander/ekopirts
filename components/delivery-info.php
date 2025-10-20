<?php 
$delivery_info = get_field('delivery-info'); // или get_field('delivery-info') если на странице

if( $delivery_info ):
?>
<section class="delivery-info">
    <div class="container container-flex">

        <div class="title-block">
            <h2 class="products-title"><?= $delivery_info['title']; ?></h2>
        </div>

        <?php 
        $i = 0; // для чередования
        foreach( $delivery_info['block'] as $block ): 
            $reverse = $i % 2 !== 0 ? 'reverse' : ''; // если индекс нечётный, ставим класс reverse
        ?>
            <h3 class="text-center m-0"><?= esc_html($block['title']); ?></h3>
            <div class="text-with-image <?= $reverse; ?>">
                <div class="text">
                    <?= $block['text']; // WYSIWYG, поэтому выводим без esc_html ?> 
                </div>
                <?php if( !empty($block['image']) ): ?>
                    <img src="<?= esc_url($block['image']); ?>" alt="<?= esc_attr($block['title']); ?>">
                <?php endif; ?>
            </div>
        <?php 
            $i++;
        endforeach; 
        ?>
    </div>
</section>
<?php endif; ?>
