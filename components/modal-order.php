<div class="modal" id="order-modal" aria-hidden="true" role="dialog">
   <div class="modal-form">

        <div class="modal-head">
            <h2 class="modal-title"><?php _e('Order', 'ekopirts'); ?></h2>
            <button class="modal-close" aria-label="Close modal" data-micromodal-close>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="23" viewBox="0 0 24 23" fill="none">
                    <path d="M11.6527 13.8332L3.07773 22.204C2.7569 22.5172 2.34857 22.6738 1.85273 22.6738C1.3569 22.6738 0.948567 22.5172 0.627734 22.204C0.3069 21.8908 0.146484 21.4922 0.146484 21.0082C0.146484 20.5242 0.3069 20.1255 0.627734 19.8124L9.20273 11.4415L0.627734 3.07069C0.3069 2.75749 0.146484 2.35888 0.146484 1.87485C0.146484 1.39083 0.3069 0.992214 0.627734 0.67902C0.948567 0.365825 1.3569 0.209229 1.85273 0.209229C2.34857 0.209229 2.7569 0.365825 3.07773 0.67902L11.6527 9.04985L20.2277 0.67902C20.5486 0.365825 20.9569 0.209229 21.4527 0.209229C21.9486 0.209229 22.3569 0.365825 22.6777 0.67902C22.9986 0.992214 23.159 1.39083 23.159 1.87485C23.159 2.35888 22.9986 2.75749 22.6777 3.07069L14.1027 11.4415L22.6777 19.8124C22.9986 20.1255 23.159 20.5242 23.159 21.0082C23.159 21.4922 22.9986 21.8908 22.6777 22.204C22.3569 22.5172 21.9486 22.6738 21.4527 22.6738C20.9569 22.6738 20.5486 22.5172 20.2277 22.204L11.6527 13.8332Z" fill="white"/>
                </svg> 
            </button>
       </div>


       <div class="modal-form-content">
            <form action="#">
                <input type="hidden" id="order-product-name-input" name="product_name" value="">
                <input type="hidden" id="order-product-image-input" name="product_image" value="">
                <input type="hidden" id="order-product-price-input" name="product_price" value="">
                <input type="text" placeholder="<?php echo esc_attr(__('First name, Last name', 'ekopirts')); ?>">
                <input type="text" placeholder="<?php echo esc_attr(__('First name, Last name', 'ekopirts')); ?>">
                <input type="text" placeholder="<?php echo esc_attr(__('First name, Last name', 'ekopirts')); ?>">
                <span><?php _e('Object location', 'ekopirts'); ?></span>
                <div class="row">
                    <input type="text" placeholder="<?php echo esc_attr(__('First name, Last name', 'ekopirts')); ?>">
                    <input type="text" placeholder="<?php echo esc_attr(__('First name, Last name', 'ekopirts')); ?>">
                </div>

                <div class="short-product">
                    <div class="product-image">
                        <img id="order-product-image" src="/images/product.png" alt="">
                    </div>
                    <div class="product-info">
                        <h3 id="order-product-title"><?php _e('Product name', 'ekopirts'); ?></h3>
                        <span class="price" id="order-product-price">€3,700.00</span>
                        <span class="without-pdv"><?php _e('*Price is without VAT', 'ekopirts'); ?></span>
                    </div>
                </div>

                <textarea name="" id=""></textarea>

                <button href="#" class="btn"><?php _e('Order', 'ekopirts'); ?></button>

            </form>
       </div>

   </div>
</div>

