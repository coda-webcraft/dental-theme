<?php get_header(); ?>

<div class="l-container">

    <div class="l-grid l-grid--treatment">
        <?php
        if (have_posts()):
            while (have_posts()):
                the_post();
                ?>
                <div class="c-card">
                    <?php if (has_post_thumbnail()): ?>
                        <div class="c-card__image">
                            <?php the_post_thumbnail('medium'); ?>
                        </div>
                    <?php endif; ?>

                    <h2 class="c-card__title">
                        <a href="<?php the_permalink(); ?>">
                            <?php the_title(); ?>
                        </a>
                    </h2>
                    <p class="c-card__text">
                        <?php echo esc_html(get_field('treatment_catch')); ?>
                    </p>
                </div>
                <?php
            endwhile;
        else:
            echo '投稿が見つかりませんでした。';
        endif;
        ?>
    </div>

</div>

<?php get_footer(); ?>