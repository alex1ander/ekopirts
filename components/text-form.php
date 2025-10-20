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
                <form action="#" class="mxw-380">
                    <h3><?php _e('Ask a question', 'ekopirts'); ?></h3>

                    <input type="text" placeholder="<?php echo esc_attr(__('First name, Last name', 'ekopirts')); ?>">
                    <input type="text" placeholder="<?php echo esc_attr(__('First name, Last name', 'ekopirts')); ?>">
                    <input type="text" placeholder="<?php echo esc_attr(__('First name, Last name', 'ekopirts')); ?>">

                    <textarea name="" id=""></textarea>

                    <button href="#" class="btn"><?php _e('Order', 'ekopirts'); ?></button>

                </form>
            </div>
        </div>
    </div>
</section>