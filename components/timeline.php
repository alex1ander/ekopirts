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
                $is_flipped = ($i % 2 !== 0);
            ?>
            <li class="timeline__entry <?php echo $is_flipped ? 'timeline__entry--flipped' : ''; ?>">
                <span class="timeline__id"><?php echo esc_html($year); ?></span>
                <div class="timeline__icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                        <line x1="16" y1="2" x2="16" y2="6"></line>
                        <line x1="8" y1="2" x2="8" y2="6"></line>
                        <line x1="3" y1="10" x2="21" y2="10"></line>
                    </svg>
                </div>
                <div class="timeline__content">
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
