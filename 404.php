<?php get_header(); ?>

<div class="l-container">

    <div class="p-404">
        <h1 class="p-404__title">404</h1>
        <p class="p-404__text">
            お探しのページは見つかりませんでした。<br>
            URLが変更または削除された可能性があります。
        </p>

        <a href="<?php echo esc_url(home_url('/')); ?>" class="c-button c-button--primary">
            トップページに戻る
        </a>
    </div>

</div>

<?php get_footer(); ?>