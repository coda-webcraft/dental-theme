<?php get_header(); ?>

<!-- ヒーローセクション -->
<?php
$front_page_id = get_option('page_on_front'); // フロントページに設定されている固定ページのID
$hero_bg = get_field('hero_bg_image', $front_page_id);
?>
<section class="p-hero" <?php if ($hero_bg): ?>style="background-image: url('<?php echo esc_url($hero_bg['url']); ?>');" <?php endif; ?>>
    <div class="l-container">
        <h1 class="p-hero__title">歯と心に、やさしい治療を。</h1>
        <p class="p-hero__text">お子様からご年配の方まで、安心して通っていただける歯科医院を目指しています。</p>
        <a href="<?php echo esc_url(home_url('/reservation/')); ?>" class="c-button c-button--primary">
            ご予約はこちら
        </a>
    </div>
</section>

<!-- 診療メニュー -->
<section class="p-section">
    <div class="l-container">
        <h2 class="p-section__title">診療メニュー</h2>

        <div class="l-grid">
            <?php
            $treatments = new WP_Query([
                'post_type' => 'treatment',
                'posts_per_page' => 6,
                'orderby' => 'menu_order',
                'order' => 'ASC',
            ]);

            if ($treatments->have_posts()):
                while ($treatments->have_posts()):
                    $treatments->the_post();
                    ?>
                    <div class="c-card">
                        <h3 class="c-card__title">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </h3>
                        <p class="c-card__text">
                            <?php echo esc_html(get_field('treatment_catch')); ?>
                        </p>
                    </div>
                    <?php
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>

        <div class="p-section__more">
            <a href="<?php echo esc_url(get_post_type_archive_link('treatment')); ?>">
                診療メニュー一覧を見る
            </a>
        </div>
    </div>
</section>

<!-- 症例紹介 -->
<section class="p-section">
    <div class="l-container">
        <h2 class="p-section__title">症例紹介</h2>

        <div class="l-grid">
            <?php
            $cases = new WP_Query([
                'post_type' => 'case',
                'posts_per_page' => 3,
            ]);

            if ($cases->have_posts()):
                while ($cases->have_posts()):
                    $cases->the_post();
                    $before = get_field('case_before_image');
                    $after = get_field('case_after_image');
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
                        <h3 class="c-case-card__title"><?php the_title(); ?></h3>
                    </a>
                    <?php
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>

        <div class="p-section__more">
            <a href="<?php echo esc_url(get_post_type_archive_link('case')); ?>">
                症例紹介一覧を見る
            </a>
        </div>
    </div>
</section>

<!-- スタッフ紹介 -->
<section class="p-section">
    <div class="l-container">
        <h2 class="p-section__title">スタッフ紹介</h2>

        <div class="l-grid">
            <?php
            $staffs = new WP_Query([
                'post_type' => 'staff',
                'posts_per_page' => 3,
                'orderby' => 'menu_order',
                'order' => 'ASC',
            ]);

            if ($staffs->have_posts()):
                while ($staffs->have_posts()):
                    $staffs->the_post();
                    $position = get_field('staff_position');
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

                        <h3 class="c-staff-card__name">
                            <?php the_title(); ?>
                        </h3>
                    </a>
                    <?php
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>

        <div class="p-section__more">
            <a href="<?php echo esc_url(get_post_type_archive_link('staff')); ?>">
                スタッフ紹介一覧を見る
            </a>
        </div>
    </div>
</section>

<!-- お知らせ -->
<section class="p-section">
    <div class="l-container">
        <h2 class="p-section__title">お知らせ</h2>

        <ul class="p-news-list">
            <?php
            $news = new WP_Query([
                'post_type' => 'post',
                'posts_per_page' => 5,
            ]);

            if ($news->have_posts()):
                while ($news->have_posts()):
                    $news->the_post();
                    ?>
                    <li class="p-news-list__item">
                        <a href="<?php the_permalink(); ?>">
                            <span class="p-news-list__date"><?php echo get_the_date('Y.m.d'); ?></span>
                            <span class="p-news-list__title"><?php the_title(); ?></span>
                        </a>
                    </li>
                    <?php
                endwhile;
                wp_reset_postdata();
            else:
                echo '<p>お知らせはまだありません。</p>';
            endif;
            ?>
        </ul>
    </div>
</section>

<!-- アクセス -->
<section class="p-section">
    <div class="l-container">
        <h2 class="p-section__title">アクセス</h2>

        <?php
        // 「アクセス」固定ページの情報を取得
        $access_page = get_page_by_path('access');

        if ($access_page):
            $tel = get_field('clinic_tel', $access_page->ID);
            $address = get_field('clinic_address', $access_page->ID);
            $hours = get_field('clinic_hours', $access_page->ID);
            ?>
            <table class="p-case-detail__table">
                <?php if ($address): ?>
                    <tr>
                        <th>住所</th>
                        <td><?php echo esc_html($address); ?></td>
                    </tr>
                <?php endif; ?>
                <?php if ($tel): ?>
                    <tr>
                        <th>電話番号</th>
                        <td><?php echo esc_html($tel); ?></td>
                    </tr>
                <?php endif; ?>
                <?php if ($hours): ?>
                    <tr>
                        <th>診療時間</th>
                        <td><?php echo nl2br(esc_html($hours)); ?></td>
                    </tr>
                <?php endif; ?>
            </table>

            <div class="p-section__more">
                <a href="<?php echo esc_url(get_permalink($access_page->ID)); ?>">
                    アクセス詳細・地図を見る
                </a>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>