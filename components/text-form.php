<?php $contactForm = get_field('contact-form'); ?>

<section class="text-form-section dark">
    <div class="container">
        <div class="text-form">
            <div class="text-area">

                <div class="title-block">
                    <h2 class="products-title"><?= $contactForm['title']; ?></h2>
                </div>

                <div class="text"><?= $contactForm['text']; ?></div>

            </div>
            <div class="form-area">
                 <?= do_shortcode('[contact-form-7 id="976c1ff" title="Contact form 2"]');?>
            </div>
        </div>
    </div>
</section>