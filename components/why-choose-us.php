<?php 
$whyUs = get_field('why_us');
// echo '<pre>';
// print_r($whyUs);
// echo '</pre>';
?>


<section class="why-choose-us">
    <div class="container">
        <div class="why-us-content">
            <div class="info">
                <h2><?= $whyUs['title'] ?></h2>

                <div class="benefits-list">
                    <?php foreach($whyUs['list'] as $element):?>
                        <div class="benefit">
                            <div class="checkmark">
                                <div class="checkmark-area">
                                    <svg width="36" height="30">
                                        <use href="#checkmark"></use>
                                    </svg>
                                </div>
                            </div>
                            <div class="title"><?= $element['title'];?></div>
                            <div class="text"><?= $element['text'];?></div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="video">
                <?= $whyUs['iframe'] ?>
            </div>
        </div>
    </div>
</section>