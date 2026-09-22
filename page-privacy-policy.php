<?php
/**
 * Template Name: プライバシーポリシーページ
 */
get_header();
?>

<div class="l-container">

    <h1>プライバシーポリシー</h1>

    <div class="p-privacy-content">
        <?php
        if (have_posts()):
            while (have_posts()):
                the_post();
                the_content();
            endwhile;
        endif;
        ?>
    </div>

</div>

<?php get_footer(); ?>