<?php get_header(); ?>

<div class="l-container">

    <?php
    if (have_posts()):
        while (have_posts()):
            the_post();

            $before = get_field('case_before_image');
            $after = get_field('case_after_image');
            $period = get_field('case_period');
            $count = get_field('case_count');
            $cost = get_field('case_cost');
            $risk = get_field('case_risk_note');
            $related = get_field('case_related_treatment');
            ?>

            <h1>
                <?php the_title(); ?>
            </h1>

            <div class="p-case-detail__images">
                <?php if ($before): ?>
                    <figure>
                        <img src="<?php echo esc_url($before['sizes']['large']); ?>" alt="施術前">
                        <figcaption>Before</figcaption>
                    </figure>
                <?php endif; ?>
                <?php if ($after): ?>
                    <figure>
                        <img src="<?php echo esc_url($after['sizes']['large']); ?>" alt="施術後">
                        <figcaption>After</figcaption>
                    </figure>
                <?php endif; ?>
            </div>

            <table class="p-case-detail__table">
                <?php if ($period): ?>
                    <tr>
                        <th>治療期間</th>
                        <td>
                            <?php echo esc_html($period); ?>
                        </td>
                    </tr>
                <?php endif; ?>
                <?php if ($count): ?>
                    <tr>
                        <th>治療回数</th>
                        <td>
                            <?php echo esc_html($count); ?>回
                        </td>
                    </tr>
                <?php endif; ?>
                <?php if ($cost): ?>
                    <tr>
                        <th>費用目安</th>
                        <td>
                            <?php echo esc_html($cost); ?>
                        </td>
                    </tr>
                <?php endif; ?>
            </table>

            <div class="p-case-detail__content">
                <?php the_content(); ?>
            </div>

            <?php if ($risk): ?>
                <div class="p-case-detail__risk">
                    <?php echo wp_kses_post($risk); ?>
                </div>
            <?php endif; ?>

            <?php if ($related): ?>
                <p>関連する診療メニュー:
                    <a href="<?php echo esc_url(get_permalink($related->ID)); ?>">
                        <?php echo esc_html($related->post_title); ?>
                    </a>
                </p>
            <?php endif; ?>

            <?php
        endwhile;
    endif;
    ?>
</div>

<?php get_footer(); ?>