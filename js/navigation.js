document.addEventListener( 'DOMContentLoaded', function () {
	const hamburger = document.querySelector( '.p-hamburger' );
	const nav        = document.querySelector( '.l-header__nav' );

	if ( hamburger && nav ) {
		hamburger.addEventListener( 'click', function () {
			nav.classList.toggle( 'is-open' );
		} );
	}

	// ここから追加:スクロールトップボタンの制御
	const scrollTopBtn = document.querySelector( '.p-scroll-top' );

	if ( scrollTopBtn ) {
		// スクロール量に応じてボタンの表示・非表示を切り替える
		window.addEventListener( 'scroll', function () {
			if ( window.scrollY > 300 ) {
				scrollTopBtn.classList.add( 'is-visible' );
			} else {
				scrollTopBtn.classList.remove( 'is-visible' );
			}
		} );

		// クリックしたら、ページの一番上にスムーズスクロール
		scrollTopBtn.addEventListener( 'click', function () {
			window.scrollTo( { top: 0, behavior: 'smooth' } );
		} );
	}
} );