<section class="show-cat">
    <div class="container">
        <div class="show-cat-content">

            <div class="show-cat-titles">
                <h2>Kādēļ Izvēlēties Mūsu Produkciju ?</h2>
                <p>Ir daudz un dažādu iemeslu, bet svarīgākais, mēs savā darbā ieliekam dvēseli un to var just katrā mūsu produktu līnijā.</p>
            </div>

            <div class="benefits">
                <?php for($i = 0;$i < 3; $i++): ?>
                <div class="benefit">
                        <div class="gear-box">
                            <svg width="101" height="101">
                                <use href="#gear"></use>
                            </svg>
                        </div>
                        <div class="benefit-title">Ražotāji</div>
                        <div class="benefit-text">Paši ražojam un pārdodam savu produkciju. Tas nav tikai produkts, ko pārdot, tas ir mūsu arods, mūsu hobijs, mūsu dvēsele.</div>

                        <ul class="benefit-list">
                            <li>123</li>
                            <li>123</li>
                            <li>123</li>
                            <li>123</li>
                        </ul>


                        <div class="category-preview">
                            <img class="category-image" src="/images/category.png" alt="">
                            <div class="category-info">
                                <span class="name">Apaļās pirts mucas</span>
                                <div class="category-arrow">
                                    <svg width="15" height="28">
                                        <use href="#arrow-right"></use>
                                    </svg>
                                </div>
                            </div>
                        </div>
                </div>
                <?php endfor; ?>
            </div>


            <div class="category-show">

            </div>
        </div>
    </div>
</section>