<?php get_header(); ?>

<div class="l-container">

    <!-- カテゴリ別バナー -->
    <div class="p-case-category-nav">
        <?php
        $terms = get_terms(['taxonomy' => 'treatment_category', 'hide_empty' => false]);
        foreach ($terms as $term):
            ?>
            <a href="<?php echo esc_url(get_term_link($term)); ?>" class="c-tag">
                <?php echo esc_html($term->name); ?> 症例
            </a>
            <?php
        endforeach;
        ?>
    </div>

    <div class="l-grid">
        <?php
        if (have_posts()):
            while (have_posts()):
                the_post();
                $before = get_field('case_before_image');
                $after = get_field('case_after_image');
                $age = get_field('case_age');
                $gender = get_field('case_gender');
                $cats = get_the_terms(get_the_ID(), 'treatment_category');
                ?>
                <a href="<?php the_permalink(); ?>" class="c-case-card">
                    <div class="c-case-card__images">
                        <?php if ($before): ?>
                            <img src="<?php echo esc_url($before['sizes']['medium']); ?>" alt="施術前">
                        <?php endif; ?>
                        <?php if ($after): ?>
                            <img src="<?php echo esc_url($after['sizes']['medium']); ?>" alt="施術後">
                        <?php endif; ?>
                    </div>
                    <h2 class="c-case-card__title">
                        <?php the_title(); ?>
                    </h2>

                    <div class="c-case-card__tags">
                        <?php if ($cats && !is_wp_error($cats)): ?>
                            <?php foreach ($cats as $cat): ?>
                                <span class="c-tag c-tag--sm">
                                    <?php echo esc_html($cat->name); ?>
                                </span>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <?php if ($age): ?><span class="c-tag c-tag--sm">
                                <?php echo esc_html($age); ?>
                            </span>
                        <?php endif; ?>
                        <?php if ($gender): ?><span class="c-tag c-tag--sm">
                                <?php echo esc_html($gender); ?>
                            </span>
                        <?php endif; ?>
                    </div>
                </a>
                <?php
            endwhile;
        else:
            echo '<p>症例が見つかりませんでした。</p>';
        endif;
        ?>
    </div>

</div>

<?php get_footer(); ?>