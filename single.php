<?php get_header(); ?>

<div class="l-container">

    <?php
    if (have_posts()):
        while (have_posts()):
            the_post();
            ?>
            <article>
                <h1>
                    <?php the_title(); ?>
                </h1>
                <p class="p-news-detail__date">
                    <?php echo get_the_date('Y.m.d'); ?>
                </p>

                <div class="p-news-detail__content">
                    <?php the_content(); ?>
                </div>
            </article>
            <?php
        endwhile;
    endif;
    ?>

</div>

<?php get_footer(); ?>