<?php
/**
 * Template Name: ご予約ページ
 */

$name = '';
$tel = '';
$email = '';
$treatment = '';
$visit_type = '';
$date1 = '';
$time1 = '';
$date2 = '';
$time2 = '';
$message = '';
$sent = false;
$errors = [];

// 予約受付時間(1時間ごと、12時台は除外)
$time_slots = ['9:00', '10:00', '11:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00'];

if (isset($_POST['your_name'])) {
    $name = $_POST['your_name'];
    $tel = $_POST['tel'];
    $email = $_POST['email'];
    $treatment = $_POST['rsv_treatment'] ?? '';
    $visit_type = $_POST['visit_type'] ?? '';
    $date1 = $_POST['date1'];
    $time1 = $_POST['time1'];
    $date2 = $_POST['date2'];
    $time2 = $_POST['time2'];
    $message = $_POST['message'];
}

// honeypotチェック:botによる送信を弾く
if (isset($_POST['reservation_confirm']) || isset($_POST['reservation_send'])) {
    if (!empty($_POST['website'])) {
        wp_die('不正な送信が検出されました。', '送信エラー', ['response' => 403]);
    }
}

// バリデーション
if (isset($_POST['reservation_confirm']) || isset($_POST['reservation_send'])) {

    if (empty($name)) {
        $errors[] = 'お名前を入力してください。';
    }

    if (empty($tel)) {
        $errors[] = '電話番号を入力してください。';
    } elseif (!preg_match('/^[0-9\-]+$/', $tel)) {
        $errors[] = '電話番号は半角数字とハイフンのみで入力してください。';
    }

    if (empty($email)) {
        $errors[] = 'メールアドレスを入力してください。';
    } elseif (!is_email($email)) {
        $errors[] = 'メールアドレスの形式が正しくありません。';
    }

    if (empty($treatment)) {
        $errors[] = '診療メニューを選択してください。';
    }

    if (empty($visit_type)) {
        $errors[] = '初診・再診を選択してください。';
    }

    if (empty($date1)) {
        $errors[] = '第一希望日を入力してください。';
    }

    if (empty($time1)) {
        $errors[] = '第一希望の時間を選択してください。';
    }
}

// メール送信処理
if (isset($_POST['reservation_send']) && empty($errors)) {

    $to = get_option('admin_email');
    $subject = 'ご予約がありました';
    $body = "お名前:{$name}\n電話番号:{$tel}\nメールアドレス:{$email}\n診療メニュー:{$treatment}\n初診・再診:{$visit_type}\n第一希望:{$date1} {$time1}\n第二希望:{$date2} {$time2}\n\nご要望・症状:\n{$message}";
    $headers = ['Content-Type: text/plain; charset=UTF-8'];

    wp_mail($to, $subject, $body, $headers);
    $sent = true;
}

get_header();
?>

<div class="l-container">

    <h1>ご予約</h1>

    <?php if ($sent): ?>

        <!-- 完了画面 -->
        <p>ご予約ありがとうございました。内容を確認のうえ、担当者よりご連絡いたします。</p>

    <?php elseif (isset($_POST['reservation_confirm']) && empty($errors)): ?>

        <!-- 確認画面 -->
        <p>以下の内容でよろしいですか?</p>
        <ul>
            <li>お名前:
                <?php echo esc_html($name); ?>
            </li>
            <li>電話番号:
                <?php echo esc_html($tel); ?>
            </li>
            <li>メールアドレス:
                <?php echo esc_html($email); ?>
            </li>
            <li>診療メニュー:
                <?php echo esc_html($treatment); ?>
            </li>
            <li>初診・再診:
                <?php echo esc_html($visit_type); ?>
            </li>
            <li>第一希望日時:
                <?php echo esc_html($date1 . ' ' . $time1); ?>
            </li>
            <?php if ($date2): ?>
                <li>第二希望日時:
                    <?php echo esc_html($date2 . ' ' . $time2); ?>
                </li>
            <?php endif; ?>
            <li>ご要望・症状:
                <?php echo esc_html($message); ?>
            </li>
        </ul>

        <form class="p-reservation-form" method="post" action="<?php echo esc_url(get_permalink()); ?>">
            <input type="hidden" name="your_name" value="<?php echo esc_attr($name); ?>">
            <input type="hidden" name="tel" value="<?php echo esc_attr($tel); ?>">
            <input type="hidden" name="email" value="<?php echo esc_attr($email); ?>">
            <input type="hidden" name="rsv_treatment" value="<?php echo esc_attr($treatment); ?>">
            <input type="hidden" name="visit_type" value="<?php echo esc_attr($visit_type); ?>">
            <input type="hidden" name="date1" value="<?php echo esc_attr($date1); ?>">
            <input type="hidden" name="time1" value="<?php echo esc_attr($time1); ?>">
            <input type="hidden" name="date2" value="<?php echo esc_attr($date2); ?>">
            <input type="hidden" name="time2" value="<?php echo esc_attr($time2); ?>">
            <input type="hidden" name="message" value="<?php echo esc_attr($message); ?>">

            <div class="p-reservation-form__actions">
                <button type="submit" name="reservation_back" class="p-reservation-form__back">戻る</button>
                <button type="submit" name="reservation_send">この内容で送信する</button>
            </div>
        </form>

    <?php else: ?>

        <!-- 入力フォーム -->

        <?php if (!empty($errors)): ?>
            <div class="p-form-errors">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li>
                            <?php echo esc_html($error); ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form class="p-reservation-form" method="post" action="<?php echo esc_url(get_permalink()); ?>">

            <div class="p-reservation-form__row">
                <label for="your_name">お名前 <span>必須</span></label>
                <input type="text" id="your_name" name="your_name" value="<?php echo esc_attr($name); ?>">
            </div>

            <div class="p-reservation-form__row">
                <label for="tel">電話番号 <span>必須</span></label>
                <input type="tel" id="tel" name="tel" value="<?php echo esc_attr($tel); ?>">
            </div>

            <div class="p-reservation-form__row">
                <label for="email">メールアドレス <span>必須</span></label>
                <input type="email" id="email" name="email" value="<?php echo esc_attr($email); ?>">
            </div>

            <div class="p-reservation-form__row">
                <label for="rsv_treatment">診療メニュー <span>必須</span></label>
                <select id="rsv_treatment" name="rsv_treatment">
                    <option value="">選択してください</option>
                    <?php
                    $treatments = new WP_Query([
                        'post_type' => 'treatment',
                        'posts_per_page' => -1,
                        'orderby' => 'menu_order',
                        'order' => 'ASC',
                    ]);

                    if ($treatments->have_posts()):
                        while ($treatments->have_posts()):
                            $treatments->the_post();
                            $selected = (get_the_title() === $treatment) ? 'selected' : '';
                            ?>
                            <option value="<?php the_title_attribute(); ?>" <?php echo $selected; ?>>
                                <?php the_title(); ?>
                            </option>
                            <?php
                        endwhile;
                        wp_reset_postdata();
                    endif;
                    ?>
                </select>
            </div>

            <div class="p-reservation-form__row">
                <span class="p-reservation-form__label-text">初診・再診 <span>必須</span></span>
                <label class="p-reservation-form__radio">
                    <input type="radio" name="visit_type" value="初診" <?php checked($visit_type, '初診'); ?>> 初診
                </label>
                <label class="p-reservation-form__radio">
                    <input type="radio" name="visit_type" value="再診" <?php checked($visit_type, '再診'); ?>> 再診
                </label>
            </div>

            <div class="p-reservation-form__row">
                <label for="date1">第一希望日時 <span>必須</span></label>
                <input type="date" id="date1" name="date1" value="<?php echo esc_attr($date1); ?>">
                <select id="time1" name="time1">
                    <option value="">選択してください</option>
                    <?php foreach ($time_slots as $slot): ?>
                        <option value="<?php echo esc_attr($slot); ?>" <?php selected($time1, $slot); ?>>
                            <?php echo esc_html($slot); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="p-reservation-form__row">
                <label for="date2">第二希望日時</label>
                <input type="date" id="date2" name="date2" value="<?php echo esc_attr($date2); ?>">
                <select id="time2" name="time2">
                    <option value="">選択してください</option>
                    <?php foreach ($time_slots as $slot): ?>
                        <option value="<?php echo esc_attr($slot); ?>" <?php selected($time2, $slot); ?>>
                            <?php echo esc_html($slot); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="p-reservation-form__row">
                <label for="message">ご要望・症状など</label>
                <textarea id="message" name="message" rows="5"><?php echo esc_html($message); ?></textarea>
            </div>

            <div class="p-contact-form__honeypot">
                <label for="website">ウェブサイト(入力しないでください)</label>
                <input type="text" id="website" name="website" value="" autocomplete="off" tabindex="-1">
            </div>

            <button type="submit" name="reservation_confirm">確認画面へ</button>

        </form>

    <?php endif; ?>

</div>

<?php get_footer(); ?>