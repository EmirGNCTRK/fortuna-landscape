<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
    <!-- Sekme İkonu (Favicon) -->
    <?php if (has_site_icon()) : ?>
        <?php wp_site_icon(); ?>
    <?php else : ?>
        <link rel="icon" type="image/jpeg" href="<?php echo get_template_directory_uri(); ?>/images/mini logo.jpeg">
    <?php endif; ?>
</head>
<body <?php body_class(); ?>>

    <!-- PRELOADER -->
    <div id="preloader">
        <div class="loader-content">
            <div class="spinner-wrapper">
                <div class="spinner"></div>
                <?php 
                $custom_logo_id = get_theme_mod('custom_logo');
                $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
                if (has_custom_logo()) : ?>
                    <img src="<?php echo esc_url($logo[0]); ?>" alt="<?php bloginfo('name'); ?>" class="loader-logo">
                <?php else : ?>
                    <img src="<?php echo get_template_directory_uri(); ?>/images/mini logo.jpeg" alt="<?php bloginfo('name'); ?>" class="loader-logo">
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- HEADER -->
    <header>
        <div class="container header-container">
            <a href="<?php echo home_url(); ?>" class="logo-container">
                <?php if (has_custom_logo()) : ?>
                    <img src="<?php echo esc_url($logo[0]); ?>" alt="<?php bloginfo('name'); ?>" class="site-logo">
                <?php else : ?>
                    <img src="<?php echo get_template_directory_uri(); ?>/images/mini logo.jpeg" alt="<?php bloginfo('name'); ?>" class="site-logo">
                <?php endif; ?>
                <h1 class="logo-text"><?php bloginfo('name'); ?></h1>
            </a>

            <button class="hamburger-menu" id="hamburgerMenu" aria-label="Menüyü Aç">
                <i class="fa-solid fa-bars"></i>
            </button>

            <nav class="nav-menu" id="navMenu">
                <?php 
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'container' => false,
                    'fallback_cb' => false
                )); 
                ?>
            </nav>
        </div>
    </header>