<?php 
$gallery = get_field('gallery');
if ($gallery):
?>
<section class="gallery">
    <div class="container">
        <div class="gallery-block">
            <div class="gallery-head">
            <ul class="gallery-tabs">
                <?php foreach ($gallery as $index => $item): ?>
                <li 
                    data-tab="tab-<?php echo $index; ?>" 
                    class="btn btn-secondary  <?php echo $index === 0 ? 'active' : ''; ?>">
                    <?php echo esc_html($item['title']); ?>
                </li>
                <?php endforeach; ?>
            </ul>
            </div>

            <div class="gallery-body">
            <?php foreach ($gallery as $index => $item): ?>
                <div 
                class="grid-image-gallery <?php echo $index === 0 ? 'active' : ''; ?>" 
                data-tab-content="tab-<?php echo $index; ?>">
                <?php if (!empty($item['gallery'])): ?>
                    <?php foreach ($item['gallery'] as $image): ?>
                    <img class="lightbox-img" src="<?php echo esc_url($image); ?>" alt="" style="cursor:pointer;">
                    <?php endforeach; ?>
                <?php endif; ?>
                </div>
            <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Подключаем basicLightbox -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/basiclightbox@5.0.4/dist/basicLightbox.min.css">
<script src="https://cdn.jsdelivr.net/npm/basiclightbox@5.0.4/dist/basicLightbox.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', () => {
  // Переключение табов
  const tabs = document.querySelectorAll('.gallery-tabs li');
  const contents = document.querySelectorAll('.grid-image-gallery');

  tabs.forEach(tab => {
    tab.addEventListener('click', () => {
      const target = tab.getAttribute('data-tab');

      tabs.forEach(t => t.classList.remove('active'));
      contents.forEach(c => c.classList.remove('active'));

      tab.classList.add('active');
      const activeContent = document.querySelector(`.grid-image-gallery[data-tab-content="${target}"]`);
      if (activeContent) activeContent.classList.add('active');
    });
  });

  // Lightbox для изображений
  const lightboxImages = document.querySelectorAll('.lightbox-img');
  lightboxImages.forEach(img => {
    img.addEventListener('click', () => {
      const instance = basicLightbox.create(`
        <img src="${img.src}" alt="" style="max-width:90vw; max-height:90vh;">
      `);
      instance.show();
    });
  });
});
</script>
