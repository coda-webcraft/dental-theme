<?php get_header(); ?>

<div class="l-container">

    <h1>
        <?php single_term_title(); ?>の症例
    </h1>

    <div class="l-grid">
        <?php
        $term_id = get_queried_object_id();
        $query = new WP_Query([
            'post_type' => 'case',
            'tax_query' => [
                [
                    'taxonomy' => 'treatment_category',
                    'field' => 'term_id',
                    'terms' => $term_id,
                ],
            ],
        ]);

        if ($query->have_posts()):
            while ($query->have_posts()):
                $query->the_post();
                ?>
                <a href="<?php the_permalink(); ?>" class="c-case-card">
                    <h2 class="c-case-card__title">
                        <?php the_title(); ?>
                    </h2>
                </a>
                <?php
            endwhile;
            wp_reset_postdata();
        else:
            echo '<p>該当する症例が見つかりませんでした。</p>';
        endif;
        ?>
    </div>

</div>

<?php get_footer(); ?>