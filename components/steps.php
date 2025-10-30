<?php 
$steps = get_field('steps');
if ($steps && is_array($steps)): ?>
<aside class="steps">
    <div class="container">
        <div class="steps-flex">
            <?php foreach ($steps as $index => $step): ?>
                <?php if ($index === 0): ?>
                    <div class="step-item first">
                        <h3><?= esc_html($step['title']); ?></h3>
                        <p><?= esc_html($step['text']); ?></p>
                    </div>
                <?php else: ?>
                    <div class="step-item">
                        <svg width="126" height="125">
                            <use href="#lamp"></use>
                        </svg>
                        <h3><?= esc_html($step['title']); ?></h3>
                        <p><?= esc_html($step['text']); ?></p>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</aside>
<?php endif; ?>
