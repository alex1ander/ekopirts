<?php 
$benefits = get_field('benefits');
// echo '<pre>';
// print_r($benefits);
// echo '</pre>';
?>


<section class="benefits-section">
    <div class="container">


        <div class="show-cat-titles">
            <h2><?= $benefits['title'] ?></h2>
            <p><?= $benefits['text'] ?></p>
        </div>


        <div class="benefits">

            <?php foreach($benefits['benefits'] as $benefit): ?>

            <div class="benefit">

                <div class="gear-box">
                    <svg width="101" height="101">
                        <use href="#gear"></use>
                    </svg>
                </div>

                <div class="benefit-title"><?= $benefit['title'] ?></div>

                <div class="benefit-text"><?= $benefit['text'] ?></div>


                <ul class="benefit-list">
                    <?php foreach($benefit['list'] as $list): ?>
                        <li><?= $list['text'] ?></li>
                    <?php endforeach; ?>
                </ul>


            </div>
            <?php endforeach; ?>

        </div>
    
</section>
