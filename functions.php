<?php
/**
 * テーマの機能読み込み
 */

if (!defined('ABSPATH')) {
    exit;
}

// カスタム投稿タイプの読み込み
require_once get_template_directory() . '/inc/custom-post-types.php';

function dental_enqueue_styles()
{
    wp_enqueue_style(
        'dental-style',                          // 好きな名前(他と被らなければOK)
        get_stylesheet_uri(),                    // style.css のURLを自動取得
        [],                                       // 依存するCSS(今回はなし)
        '1.0'                                     // バージョン番号(更新時にここを変えるとキャッシュ対策になる)
    );
}
add_action('wp_enqueue_scripts', 'dental_enqueue_styles');

/**
 * JavaScriptファイルの読み込み
 */
function dental_enqueue_scripts()
{
    wp_enqueue_script(
        'dental-navigation',                              // 名前(他と被らなければOK)
        get_template_directory_uri() . '/js/navigation.js', // ファイルのURL
        [],                                                 // 依存するJS(jQueryなど、今回はなし)
        '1.0',                                              // バージョン
        true                                                // true = </body>の直前で読み込む(推奨)
    );
}
add_action('wp_enqueue_scripts', 'dental_enqueue_scripts');

/**
 * アイキャッチ画像(投稿サムネイル)を有効化
 */
function dental_theme_setup()
{
    add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'dental_theme_setup');

/**
 * ナビゲーションメニューを有効化
 */
function dental_register_menus()
{
    register_nav_menus([
        'header-menu' => 'ヘッダーメニュー',
        'footer-menu' => 'フッターメニュー',
    ]);
}
add_action('after_setup_theme', 'dental_register_menus');