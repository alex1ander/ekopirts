<article class="timeline-article">
    <div class="container">
        <?php if( have_rows('timeline') ): ?>
        <ol class="timeline">
            <?php 
            $i = 0; // для чередования flipped
            while( have_rows('timeline') ) : the_row(); 
                $year = get_sub_field('year');
                $title = get_sub_field('title');
                $text = get_sub_field('text');
                $flipped_class = ($i % 2 !== 0) ? 'timeline__content--flipped' : '';
            ?>
            <li class="timeline__entry">
                <span class="timeline__id"><?php echo esc_html($year); ?></span>
                <div class="timeline__content <?php echo $flipped_class; ?>">
                    <h2 class="timeline__heading"><?php echo esc_html($title); ?></h2>
                    <p class="timeline__text"><?php echo esc_html($text); ?></p>
                </div>
            </li>
            <?php 
                $i++;
            endwhile; ?>
        </ol>
        <?php endif; ?>

        <!-- Блок "Наши дни" -->
        <div class="timeline__end">
            <span class="timeline__end-marker"><?php _e('Our Days','ekopirts'); ?></span>
        </div>
    </div>
</article>
