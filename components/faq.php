<?php $faq = get_field('faq'); ?>

<section class="faq">
  <div class="container">
    <div class="faqs-block">
      <div class="accordion">


        <?php foreach($faq as $accordion): ?>
        <div class="accordion-item">
          <div class="accordion-head">
            <span class="accordion-sign"></span>
            <button class="accordion-btn"><?= $accordion['title'];?></button>
          </div>
          <div class="accordion-content">
              <div><?= $accordion['text'];?></div>
          </div>
        </div>
        <?php endforeach; ?>

      </div>
    </div>
  </div>
</section>

<script>
  const accordionItems = document.querySelectorAll('.accordion-item');

  accordionItems.forEach(item => {
    const head = item.querySelector('.accordion-head');

    head.addEventListener('click', () => {
      const isActive = item.classList.contains('active');

      // Закрываем все остальные
      accordionItems.forEach(i => i.classList.remove('active'));

      // Если текущий был закрыт, открываем
      if (!isActive) {
        item.classList.add('active');
      }
    });
  });
</script>
