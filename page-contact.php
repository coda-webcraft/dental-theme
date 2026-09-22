<?php
/**
 * Template Name: お問い合わせページ
 */

$name = '';
$tel = '';
$email = '';
$message = '';
$sent = false;
$errors = []; // エラーメッセージを溜める配列

if (isset($_POST['your_name'])) {
	$name = $_POST['your_name'];
	$tel = $_POST['tel'];
	$email = $_POST['email'];
	$message = $_POST['message'];
}

// honeypotチェック:botによる送信を弾く
if (isset($_POST['contact_confirm']) || isset($_POST['contact_send'])) {
	if (!empty($_POST['website'])) {
		// 何か入力されていたら、botとみなして通常の処理をせず終了する
		wp_die('不正な送信が検出されました。', '送信エラー', ['response' => 403]);
	}
}

// 「確認画面へ」または「この内容で送信する」が押された時にバリデーションを行う
if (isset($_POST['contact_confirm']) || isset($_POST['contact_send'])) {

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
}

// メール送信処理(エラーが1つもない時だけ実行)
if (isset($_POST['contact_send']) && empty($errors)) {

	$to = get_option('admin_email');
	$subject = 'お問い合わせがありました';
	$body = "お名前:{$name}\n電話番号:{$tel}\nメールアドレス:{$email}\n\nお問い合わせ内容:\n{$message}";
	$headers = ['Content-Type: text/plain; charset=UTF-8'];

	wp_mail($to, $subject, $body, $headers);
	$sent = true;
}

get_header();
?>

<div class="l-container">

	<h1>お問い合わせ</h1>

	<?php if ($sent): ?>

		<!-- 送信完了画面 -->
		<p>お問い合わせありがとうございました。送信が完了しました。</p>

	<?php elseif (isset($_POST['contact_confirm']) && empty($errors)): ?>

		<!-- 確認画面 -->
		<p>以下の内容でよろしいですか?</p>
		<ul>
			<li>お名前:<?php echo esc_html($name); ?></li>
			<li>電話番号:<?php echo esc_html($tel); ?></li>
			<li>メールアドレス:<?php echo esc_html($email); ?></li>
			<li>お問い合わせ内容:<?php echo esc_html($message); ?></li>
		</ul>

		<form method="post" action="<?php echo esc_url(get_permalink()); ?>">
			<input type="hidden" name="your_name" value="<?php echo esc_attr($name); ?>">
			<input type="hidden" name="tel" value="<?php echo esc_attr($tel); ?>">
			<input type="hidden" name="email" value="<?php echo esc_attr($email); ?>">
			<input type="hidden" name="message" value="<?php echo esc_attr($message); ?>">

			<button type="submit" name="contact_back">戻る</button>
			<button type="submit" name="contact_send">この内容で送信する</button>
		</form>

	<?php else: ?>

		<!-- 入力フォーム -->

		<?php if (!empty($errors)): ?>
			<div class="p-form-errors">
				<ul>
					<?php foreach ($errors as $error): ?>
						<li><?php echo esc_html($error); ?></li>
					<?php endforeach; ?>
				</ul>
			</div>
		<?php endif; ?>

		<form class="p-contact-form" method="post" action="<?php echo esc_url(get_permalink()); ?>">

			<div class="p-contact-form__row">
				<label for="your_name">お名前 <span>必須</span></label>
				<input type="text" id="your_name" name="your_name" value="<?php echo esc_attr($name); ?>">
			</div>

			<div class="p-contact-form__row">
				<label for="tel">電話番号 <span>必須</span></label>
				<input type="tel" id="tel" name="tel" value="<?php echo esc_attr($tel); ?>">
			</div>

			<div class="p-contact-form__row">
				<label for="email">メールアドレス <span>必須</span></label>
				<input type="email" id="email" name="email" value="<?php echo esc_attr($email); ?>">
			</div>

			<div class="p-contact-form__row">
				<label for="message">お問い合わせ内容</label>
				<textarea id="message" name="message" rows="5"><?php echo esc_html($message); ?></textarea>
			</div>

			<button type="submit" name="contact_confirm">確認画面へ</button>

			<div class="p-contact-form__honeypot">
				<label for="website">ウェブサイト(入力しないでください)</label>
				<input type="text" id="website" name="website" value="" autocomplete="off" tabindex="-1">
			</div>

		</form>

	<?php endif; ?>

</div>

<?php get_footer(); ?>