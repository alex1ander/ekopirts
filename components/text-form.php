<?php $contactForm = get_field('contact-form'); ?>
<?php $form = get_field('contact_forms','options'); ?>
<?php if ($contactForm && !empty($contactForm['title']) && !empty($contactForm['text'])): ?>
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
                 <?= do_shortcode($form['contact_form_with_text']);?>
            </div>
        </div>
    </div>
</section>

<?php endif; ?>