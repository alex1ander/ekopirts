<?php 
$promotions = get_field('promotions');
// echo '<pre>';
// print_r($promotions);
// echo '</pre>';
?>

<aside class="promotions-section">
    <div class="promotions-side">
        <div class="container">
            <div class="promotions-content">
                <div class="promotions-info">
                    <h4 class="promotions-title"><?= $promotions['title'] ?></h4>
                    <p class="promotions-text"><?= $promotions['text'] ?></p>
                </div>
                <div class="promotions-btn">
                    <a href="<?= $promotions['button']['url'] ?>" target="<?= $promotions['button']['target'] ?>" class="btn btn-matte"><?= $promotions['button']['title'] ?></a>
                    <svg class="leaflet" width="278" height="170" width="182" height="45">
                        <use href="#leaflet"></use>
                    </svg>
                </div>
            </div>
        </div>
    </div>
</aside>