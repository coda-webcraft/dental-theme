<?php get_header(); ?>

<div class="l-container">

    <?php
    if (have_posts()):
        while (have_posts()):
            the_post();
            ?>
            <h1><?php the_title(); ?></h1>

            <?php
            $catch = get_field('treatment_catch');
            if ($catch):
                ?>
                <p><?php echo esc_html($catch); ?></p>
                <?php
            endif;
            ?>

            <div>
                <?php the_content(); ?>
            </div>
            <?php
        endwhile;
    endif;
    ?>

</div>

<?php get_footer(); ?>