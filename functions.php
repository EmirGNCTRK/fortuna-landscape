<?php
/**
 * Fortuna Landscape - functions.php
 * Adım 1: Temel Kurulumlar ve Özelleştirici (Customizer) Hero Bölümü
 */

// 1. TEMA KURULUMU VE DESTEKLERİ
function fortunalandscape_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');
    
    register_nav_menus(array(
        'primary' => __('Ana Menü', 'fortunalandscape'),
    ));
}
add_action('after_setup_theme', 'fortunalandscape_setup');

// 2. CSS VE JS DOSYALARININ DAHİL EDİLMESİ
function fortunalandscape_scripts() {
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,700;1,400&family=Montserrat:wght@300;400;600;700&display=swap', array(), null);
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css', array(), '6.5.1');
    wp_enqueue_style('main-style', get_stylesheet_uri(), array(), '1.0');
    wp_enqueue_script('app-js', get_template_directory_uri() . '/app.js', array(), '1.0', true);
}
add_action('wp_enqueue_scripts', 'fortunalandscape_scripts');

// 3. TEMA ÖZELLEŞTİRİCİ (CUSTOMIZER) - HERO BÖLÜMÜ
function fortunalandscape_hero_customizer($wp_customize) {
    
    // Hero Sekmesi
    $wp_customize->add_section('hero_section', array(
        'title'    => __('Hero (Giriş) Ayarları', 'fortunalandscape'),
        'priority' => 10,
    ));

    // A) Hero Arka Plan Resmi
    $wp_customize->add_setting('hero_bg_image', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'hero_bg_image', array(
        'label'    => __('Hero Arka Plan Resmi', 'fortunalandscape'),
        'section'  => 'hero_section',
        'settings' => 'hero_bg_image',
    )));

    // B) Hero Resim Opaklığı (Opacity)
    $wp_customize->add_setting('hero_opacity', array(
        'default'           => '0.4',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('hero_opacity', array(
        'label'       => __('Görsel Opaklığı (0.0 Şeffaf - 1.0 Tam Koyu)', 'fortunalandscape'),
        'section'     => 'hero_section',
        'type'        => 'number',
        'input_attrs' => array(
            'min'  => 0,
            'max'  => 1,
            'step' => 0.1,
        ),
    ));

    // C) Hero Başlık Metni
    $wp_customize->add_setting('hero_title', array(
        'default'           => 'Doğayla Uyumlu, Estetik Mekanlar Tasarlıyoruz.',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('hero_title', array(
        'label'   => __('Hero Başlık', 'fortunalandscape'),
        'section' => 'hero_section',
        'type'    => 'text',
    ));

    // D) Hero Alt Metin (Açıklama)
    $wp_customize->add_setting('hero_desc', array(
        'default'           => 'Fortuna Landscape olarak, yaşam alanlarınızı yeşille buluşturuyoruz.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('hero_desc', array(
        'label'   => __('Hero Alt Metin (Açıklama)', 'fortunalandscape'),
        'section' => 'hero_section',
        'type'    => 'textarea',
    ));

}
add_action('customize_register', 'fortunalandscape_hero_customizer');