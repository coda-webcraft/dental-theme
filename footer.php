<footer class="l-footer">
	<div class="l-container">
		<nav class="l-footer__nav">
			<?php
			wp_nav_menu([
				'theme_location' => 'footer-menu',
				'container' => false,
				'menu_class' => 'p-footer-menu',
				'fallback_cb' => false, // メニュー未設定時に何も表示しない
			]);
			?>
		</nav>

		<p class="l-footer__copyright">
			&copy; <?php echo esc_html(date('Y')); ?> <?php bloginfo('name'); ?>
		</p>
	</div>
</footer>

<button type="button" class="p-scroll-top" aria-label="ページトップへ戻る">
	<span>↑</span>
</button>

<?php wp_footer(); ?>
</body>

</html>