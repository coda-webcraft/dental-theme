<?php get_header(); ?>

<div class="l-container">

    <h1>スタッフ紹介</h1>

    <div class="l-grid">
        <?php
        if (have_posts()):
            while (have_posts()):
                the_post();
                $kana = get_field('staff_name_kana');
                $position = get_field('staff_position');
                $message = get_field('staff_message');
                ?>
                <a href="<?php the_permalink(); ?>" class="c-staff-card">
                    <?php if (has_post_thumbnail()): ?>
                        <div class="c-staff-card__photo">
                            <?php the_post_thumbnail('medium'); ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($position): ?>
                        <p class="c-staff-card__position">
                            <?php echo esc_html($position); ?>
                        </p>
                    <?php endif; ?>

                    <h2 class="c-staff-card__name">
                        <?php the_title(); ?>
                    </h2>
                    <?php if ($kana): ?>
                        <p class="c-staff-card__kana">
                            <?php echo esc_html($kana); ?>
                        </p>
                    <?php endif; ?>

                    <?php if ($message): ?>
                        <p class="c-staff-card__message">
                            <?php echo esc_html($message); ?>
                        </p>
                    <?php endif; ?>
                </a>
                <?php
            endwhile;
        else:
            echo '<p>スタッフが見つかりませんでした。</p>';
        endif;
        ?>
    </div>

</div>

<?php get_footer(); ?>