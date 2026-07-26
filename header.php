<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Google Fonts (Montserrat ve Lora) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,700;1,400&family=Montserrat:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome İkon Kütüphanesi -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

    <!-- YÜKLEME EKRANI (PRELOADER) -->
    <?php if (get_theme_mod('show_preloader', true)) : ?>
    <div id="preloader">
        <div class="loader-content">
            <div class="spinner-wrapper">
                <div class="spinner"></div>
                <?php 
                $custom_logo_id = get_theme_mod('custom_logo');
                $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
                if (has_custom_logo()) : ?>
                    <img src="<?php echo esc_url($logo[0]); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" class="loader-logo">
                <?php else : ?>
                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/mini logo.jpeg" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" class="loader-logo">
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- Header / Navigasyon Bölümü -->
    <header>
        <div class="container header-container">
            <!-- Logo ve İsim -->
            <a href="<?php echo esc_url(home_url('/')); ?>" class="logo-container">
                <?php if (has_custom_logo()) : ?>
                    <img src="<?php echo esc_url($logo[0]); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" class="site-logo">
                <?php else : ?>
                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/mini logo.jpeg" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" class="site-logo">
                <?php endif; ?>
                <h1 class="logo-text"><?php bloginfo('name'); ?></h1>
            </a>

            <!-- Hamburger Menü Butonu (Mobilde Görünür) -->
            <button class="hamburger-menu" id="hamburgerMenu" aria-label="Menüyü Aç">
                <i class="fa-solid fa-bars"></i>
            </button>

            <!-- Navigasyon Menüsü -->
            <nav class="nav-menu" id="navMenu">
                <?php
                if (has_nav_menu('primary-menu')) {
                    wp_nav_menu(array(
                        'theme_location' => 'primary-menu',
                        'container'      => false,
                        'fallback_cb'    => false,
                    ));
                } else {
                    // Varsayılan Statik Menü (Eğer panelden menü atanmamışsa)
                    echo '<ul>';
                    echo '<li><a href="' . esc_url(home_url('/')) . '">Anasayfa</a></li>';
                    echo '<li><a href="' . esc_url(home_url('/hakkimizda/')) . '">Hakkımızda</a></li>';
                    echo '<li><a href="' . esc_url(home_url('/iletisim/')) . '" class="cta-button">Bize Ulaşın</a></li>';
                    echo '</ul>';
                }
                ?>
            </nav>
        </div>
    </header>