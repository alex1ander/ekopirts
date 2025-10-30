<?php $form = get_field('contact_forms','options'); ?>

<section class="form-area dark">
    <div class="container">
        <?= do_shortcode($form['contact_form']);?>
    </div>
</section>