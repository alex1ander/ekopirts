<section class="faq">
  <div class="container">
    <div class="faqs-block">
      <div class="accordion">

        <div class="accordion-item">
          <div class="accordion-head">
            <span class="accordion-sign"></span>
            <button class="accordion-btn">Vai ir iespējas kredīts, ar kādām bankām strādājat ?</button>
          </div>
          <div class="accordion-content">
                <p>Содержимое раздела 1</p>
          </div>
        </div>

        <div class="accordion-item">
          <div class="accordion-head">
            <span class="accordion-sign"></span>
            <button class="accordion-btn">Раздел 2</button>
          </div>
          <div class="accordion-content">
                <p>Содержимое раздела 1</p>
          </div>
        </div>

        <div class="accordion-item">
          <div class="accordion-head">
            <span class="accordion-sign"></span>
            <button class="accordion-btn">Раздел 3</button>
          </div>
          <div class="accordion-content">
            <p>Содержимое раздела 1</p>
          </div>
        </div>

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
