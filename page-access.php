<?php
/**
 * Template Name: アクセスページ
 */
get_header();

$tel = get_field('clinic_tel');
$address = get_field('clinic_address');
$hours = get_field('clinic_hours');
$closed = get_field('clinic_closed_days');
$map = get_field('clinic_map_embed');
?>

<div class="l-container">

    <h1>アクセス</h1>

    <table class="p-case-detail__table">
        <?php if ($address): ?>
            <tr>
                <th>住所</th>
                <td>
                    <?php echo esc_html($address); ?>
                </td>
            </tr>
        <?php endif; ?>
        <?php if ($tel): ?>
            <tr>
                <th>電話番号</th>
                <td>
                    <?php echo esc_html($tel); ?>
                </td>
            </tr>
        <?php endif; ?>
        <?php if ($hours): ?>
            <tr>
                <th>診療時間</th>
                <td>
                    <?php echo nl2br(esc_html($hours)); ?>
                </td>
            </tr>
        <?php endif; ?>
        <?php if ($closed): ?>
            <tr>
                <th>休診日</th>
                <td>
                    <?php echo esc_html($closed); ?>
                </td>
            </tr>
        <?php endif; ?>
    </table>

    <?php if ($map): ?>
        <div class="p-access-map">
            <iframe src="<?php echo esc_url($map); ?>" width="100%" height="400" style="border:0;" allowfullscreen
                loading="lazy"></iframe>
        </div>
    <?php endif; ?>

</div>

<?php get_footer(); ?>