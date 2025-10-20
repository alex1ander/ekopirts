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
                    <h3>Uzdot jautājumu</h3>

                    <input type="text" placeholder="Vārds, Uzvārds">
                    <input type="text" placeholder="Vārds, Uzvārds">
                    <input type="text" placeholder="Vārds, Uzvārds">

                    <textarea name="" id=""></textarea>

                    <button href="#" class="btn">Pasūtīt</button>

                </form>
            </div>
        </div>
    </div>
</section>