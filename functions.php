<?php
// Tema Kurulumu ve Destekler
function fortunalandscape_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');
    
    register_nav_menus(array(
        'primary' => __('Ana Menü', 'fortunalandscape'),
    ));
}
add_action('after_setup_theme', 'fortunalandscape_setup');

// CSS ve JS Dosyalarının Yüklenmesi
function fortunalandscape_scripts() {
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,700;1,400&family=Montserrat:wght@300;400;600;700&display=swap', array(), null);
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css', array(), '6.5.1');
    wp_enqueue_style('main-style', get_stylesheet_uri(), array(), '1.0');
    wp_enqueue_script('app-js', get_template_directory_uri() . '/app.js', array(), '1.0', true);
}
add_action('wp_enqueue_scripts', 'fortunalandscape_scripts');

// --- CUSTOM POST TYPES (Projeler ve Hizmetler) ---
function fortunalandscape_custom_posts() {
    // Projeler CPT
    register_post_type('projeler', array(
        'labels' => array('name' => 'Projeler', 'singular_name' => 'Proje'),
        'public' => true,
        'has_archive' => false,
        'supports' => array('title', 'thumbnail'),
        'menu_icon' => 'dashicons-portfolio'
    ));

    // Hizmetler CPT
    register_post_type('hizmetler', array(
        'labels' => array('name' => 'Hizmetlerimiz', 'singular_name' => 'Hizmet'),
        'public' => true,
        'has_archive' => false,
        'supports' => array('title', 'editor'),
        'menu_icon' => 'dashicons-grid-view'
    ));
}
add_action('init', 'fortunalandscape_custom_posts');

// --- THEME CUSTOMIZER (SİTE AYARLARI PANELİ) ---
function fortunalandscape_customize_register($wp_customize) {
    // 1. Genel Ayarlar (WhatsApp)
    $wp_customize->add_section('genel_ayarlar', array('title' => 'Genel Ayarlar & WhatsApp', 'priority' => 20));
    $wp_customize->add_setting('whatsapp_number', array('default' => '905000000000'));
    $wp_customize->add_control('whatsapp_number', array('label' => 'WhatsApp Numarası (Ülke Koduyla, örn: 905...)', 'section' => 'genel_ayarlar', 'type' => 'text'));

    // 2. Hero (Giriş) Bölümü
    $wp_customize->add_section('hero_section', array('title' => 'Hero (Giriş) Ayarları', 'priority' => 30));
    $wp_customize->add_setting('hero_title', array('default' => 'Doğayla Uyumlu, Estetik Mekanlar Tasarlıyoruz.'));
    $wp_customize->add_control('hero_title', array('label' => 'Hero Başlık', 'section' => 'hero_section', 'type' => 'text'));
    
    $wp_customize->add_setting('hero_desc', array('default' => 'Fortuna Landscape olarak, yaşam alanlarınızı yeşille buluşturuyoruz.'));
    $wp_customize->add_control('hero_desc', array('label' => 'Hero Açıklama', 'section' => 'hero_section', 'type' => 'textarea'));

    $wp_customize->add_setting('hero_bg_image');
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'hero_bg_image', array('label' => 'Hero Arka Plan Resmi', 'section' => 'hero_section')));

    $wp_customize->add_setting('hero_opacity', array('default' => '0.4'));
    $wp_customize->add_control('hero_opacity', array('label' => 'Hero Görsel Opaklığı (0.0 ile 1.0 arası)', 'section' => 'hero_section', 'type' => 'number', 'input_attrs' => array('min' => 0, 'max' => 1, 'step' => 0.1)));

    // 3. Hakkımızda Bölümü Metni
    $wp_customize->add_section('about_section', array('title' => 'Hakkımızda Metni', 'priority' => 40));
    $wp_customize->add_setting('about_text', array('default' => 'Fortuna Landscape olarak...'));
    $wp_customize->add_control('about_text', array('label' => 'Hakkımızda İçerik Metni', 'section' => 'about_section', 'type' => 'textarea'));

    // 4. İletişim Sayfası Ayarları & Aç/Kapat Butonları
    $wp_customize->add_section('contact_section', array('title' => 'İletişim Sayfası & Butonlar', 'priority' => 50));
    
    // Adres
    $wp_customize->add_setting('show_address', array('default' => true));
    $wp_customize->add_control('show_address', array('label' => 'Adres Bölümünü Göster', 'section' => 'contact_section', 'type' => 'checkbox'));
    $wp_customize->add_setting('contact_address', array('default' => 'Atatürk Mah. Mimarlık Cad. No:12, İzmir'));
    $wp_customize->add_control('contact_address', array('label' => 'Adres Metni', 'section' => 'contact_section', 'type' => 'text'));

    // Telefon
    $wp_customize->add_setting('show_phone', array('default' => true));
    $wp_customize->add_control('show_phone', array('label' => 'Telefon Bölümünü Göster', 'section' => 'contact_section', 'type' => 'checkbox'));
    $wp_customize->add_setting('contact_phone', array('default' => '+90 (232) 000 00 00'));
    $wp_customize->add_control('contact_phone', array('label' => 'Telefon Numarası', 'section' => 'contact_section', 'type' => 'text'));

    // E-posta
    $wp_customize->add_setting('show_email', array('default' => true));
    $wp_customize->add_control('show_email', array('label' => 'E-posta Bölümünü Göster', 'section' => 'contact_section', 'type' => 'checkbox'));
    $wp_customize->add_setting('contact_email', array('default' => 'info@fortunalandscape.com'));
    $wp_customize->add_control('contact_email', array('label' => 'E-posta Adresi', 'section' => 'contact_section', 'type' => 'text'));

    // Google Maps
    $wp_customize->add_setting('show_map', array('default' => true));
    $wp_customize->add_control('show_map', array('label' => 'Google Maps Haritasını Göster', 'section' => 'contact_section', 'type' => 'checkbox'));

    // 5. Footer Sosyal Medya İkon Kontrolleri
    $wp_customize->add_section('footer_section', array('title' => 'Footer & Sosyal Medya', 'priority' => 60));
    $wp_customize->add_setting('show_footer_icons', array('default' => true));
    $wp_customize->add_control('show_footer_icons', array('label' => 'Sosyal Medya İkonlarını Göster', 'section' => 'footer_section', 'type' => 'checkbox'));

    $socials = array('instagram', 'facebook', 'linkedin', 'x_twitter', 'pinterest');
    foreach ($socials as $social) {
        $wp_customize->add_setting("social_{$social}", array('default' => ''));
        $wp_customize->add_control("social_{$social}", array('label' => ucfirst($social) . ' Linki', 'section' => 'footer_section', 'type' => 'url'));
    }
}
add_action('customize_register', 'fortunalandscape_customize_register');