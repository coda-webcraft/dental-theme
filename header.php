<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <header class="l-header">
        <div class="l-container l-header__inner">
            <div class="l-header__logo">
                <a href="<?php echo esc_url(home_url('/')); ?>">
                    <?php bloginfo('name'); ?>
                </a>
            </div>

            <button type="button" class="p-hamburger" aria-label="メニューを開く">
                <span></span>
                <span></span>
                <span></span>
            </button>

            <nav class="l-header__nav">
                <?php
                wp_nav_menu([
                    'theme_location' => 'header-menu',
                    'container' => false,
                    'menu_class' => 'p-nav-menu',
                ]);
                ?>
            </nav>
        </div>
    </header>