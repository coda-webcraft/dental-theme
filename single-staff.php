<?php get_header(); ?>

<div class="l-container">

    <?php
    if (have_posts()):
        while (have_posts()):
            the_post();
            $kana = get_field('staff_name_kana');
            $position = get_field('staff_position');
            $message = get_field('staff_message');
            ?>

            <div class="p-staff-detail">
                <?php if (has_post_thumbnail()): ?>
                    <div class="p-staff-detail__photo">
                        <?php the_post_thumbnail('medium'); ?>
                    </div>
                <?php endif; ?>

                <div class="p-staff-detail__body">
                    <?php if ($position): ?>
                        <p class="p-staff-detail__position">
                            <?php echo esc_html($position); ?>
                        </p>
                    <?php endif; ?>

                    <h1 class="p-staff-detail__name">
                        <?php the_title(); ?>
                    </h1>
                    <?php if ($kana): ?>
                        <p class="p-staff-detail__kana">
                            <?php echo esc_html($kana); ?>
                        </p>
                    <?php endif; ?>

                    <?php if ($message): ?>
                        <p class="p-staff-detail__message">
                            <?php echo esc_html($message); ?>
                        </p>
                    <?php endif; ?>

                    <div class="p-staff-detail__content">
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>

            <?php
        endwhile;
    endif;
    ?>

</div>

<?php get_footer(); ?>