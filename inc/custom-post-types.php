<?php
/**
 * カスタム投稿タイプ登録(まずは診療メニューのみ)
 */

if (!defined('ABSPATH')) {
	exit;
}

function dental_register_post_types()
{

	register_post_type('treatment', [
		'label' => '診療メニュー',
		'labels' => [
			'name' => '診療メニュー',
			'singular_name' => '診療メニュー',
			'add_new_item' => '診療メニューを追加',
			'edit_item' => '診療メニューを編集',
		],
		'public' => true,
		'show_in_rest' => true,
		'menu_icon' => 'dashicons-heart',
		'menu_position' => 5,
		'has_archive' => true,
		'rewrite' => ['slug' => 'treatment'],
		'supports' => ['title', 'editor', 'thumbnail'],
	]);

	register_post_type('case', [
		'label' => '症例紹介',
		'labels' => [
			'name' => '症例紹介',
			'singular_name' => '症例',
			'add_new_item' => '症例を追加',
			'edit_item' => '症例を編集',
		],
		'public' => true,
		'show_in_rest' => true,
		'menu_icon' => 'dashicons-format-image',
		'menu_position' => 7,
		'has_archive' => true,
		'rewrite' => ['slug' => 'case'],
		'supports' => ['title', 'editor', 'thumbnail'],
	]);

	register_post_type('staff', [
		'label' => 'スタッフ',
		'labels' => [
			'name' => 'スタッフ',
			'singular_name' => 'スタッフ',
			'add_new_item' => 'スタッフを追加',
			'edit_item' => 'スタッフを編集',
		],
		'public' => true,
		'show_in_rest' => true,
		'menu_icon' => 'dashicons-groups',
		'menu_position' => 6,
		'has_archive' => true,
		'rewrite' => ['slug' => 'staff'],
		'supports' => ['title', 'editor', 'thumbnail', 'page-attributes'],
	]);
}

add_action('init', 'dental_register_post_types');

function dental_register_taxonomies()
{

	register_taxonomy('treatment_category', ['treatment', 'case'], [
		'label' => '診療カテゴリ',
		'labels' => [
			'name' => '診療カテゴリ',
			'singular_name' => '診療カテゴリ',
			'add_new_item' => '診療カテゴリを追加',
			'edit_item' => '診療カテゴリを編集',
		],
		'hierarchical' => true,
		'public' => true,
		'show_in_rest' => true,
		'rewrite' => ['slug' => 'treatment-category'],
	]);

}
add_action('init', 'dental_register_taxonomies');