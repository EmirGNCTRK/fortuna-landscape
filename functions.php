<?php
/**
 * Fortuna Landscape - functions.php
 * Adım 1: Temel Kurulumlar ve Sol Menüde Özel Hero Yönetimi Sayfası
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

// 3. SOL MENÜYE "HERO YÖNETİMİ" SAYFASI EKLEME
function fortunalandscape_add_hero_admin_menu() {
    add_menu_page(
        'Hero Yönetimi',           // Sayfa başlığı
        'Hero Yönetimi',           // Menüdeki adı
        'manage_options',          // Yetki seviyesi
        'hero-yonetimi',           // Sayfa URL slug'ı
        'fortunalandscape_hero_page_html', // İçeriği basan fonksiyon
        'dashicons-format-image',  // İkon
        20                         // Menüdeki sırası
    );
}
add_action('admin_menu', 'fortunalandscape_add_hero_admin_menu');

// 4. ADMIN PANELİ İÇİN MEDYA KÜTÜPHANESİ JS DAHİL ETME
function fortunalandscape_admin_scripts($hook) {
    if ($hook != 'toplevel_page_hero-yonetimi') {
        return;
    }
    wp_enqueue_media(); // WordPress Resim Yükleme Penceresi
}
add_action('admin_enqueue_scripts', 'fortunalandscape_admin_scripts');

// 5. HERO YÖNETİMİ SAYFASI HTML VE FORMU
function fortunalandscape_hero_page_html() {
    if (!current_user_can('manage_options')) {
        return;
    }

    // Form Gönderildiğinde Verileri Kaydet
    if (isset($_POST['hero_option_save'])) {
        check_admin_referer('hero_options_verify');
        
        update_option('hero_bg_image', sanitize_text_field($_POST['hero_bg_image']));
        update_option('hero_opacity', sanitize_text_field($_POST['hero_opacity']));
        update_option('hero_title', sanitize_text_field($_POST['hero_title']));
        update_option('hero_desc', sanitize_textarea_field($_POST['hero_desc']));

        echo '<div class="notice notice-success is-dismissible"><p>Hero ayarları başarıyla kaydedildi!</p></div>';
    }

    // Mevcut Değerleri Çek
    $hero_bg_image = get_option('hero_bg_image', '');
    $hero_opacity  = get_option('hero_opacity', '0.4');
    $hero_title    = get_option('hero_title', 'Doğayla Uyumlu, Estetik Mekanlar Tasarlıyoruz.');
    $hero_desc     = get_option('hero_desc', 'Fortuna Landscape olarak, yaşam alanlarınızı yeşille buluşturuyoruz.');
    ?>

    <div class="wrap">
        <h1>Hero (Giriş) Bölümü Yönetimi</h1>
        <hr>
        <form method="post" action="">
            <?php wp_nonce_field('hero_options_verify'); ?>
            
            <table class="form-table">
                <!-- HERO ARKA PLAN RESMİ -->
                <tr>
                    <th scope="row"><label for="hero_bg_image">Hero Arka Plan Resmi</label></th>
                    <td>
                        <input type="text" name="hero_bg_image" id="hero_bg_image" value="<?php echo esc_attr($hero_bg_image); ?>" class="regular-text">
                        <button type="button" class="button button-secondary" id="upload_hero_image_button">Görsel Seç / Yükle</button>
                        <p class="description">Arka planda görünecek büyük görseli yükleyin veya seçin.</p>
                        <div id="hero_image_preview" style="margin-top:10px;">
                            <?php if ($hero_bg_image) : ?>
                                <img src="<?php echo esc_url($hero_bg_image); ?>" style="max-width:300px; height:auto; border-radius:6px;">
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>

                <!-- HERO OPAKLIK -->
                <tr>
                    <th scope="row"><label for="hero_opacity">Arka Plan Opaklığı</label></th>
                    <td>
                        <input type="number" step="0.1" min="0" max="1" name="hero_opacity" id="hero_opacity" value="<?php echo esc_attr($hero_opacity); ?>" class="small-text">
                        <p class="description">Görselin üzerindeki karartma derecesi (0.0 Tam Şeffaf - 1.0 Tam Koyu).</p>
                    </td>
                </tr>

                <!-- HERO BAŞLIK -->
                <tr>
                    <th scope="row"><label for="hero_title">Hero Başlık</label></th>
                    <td>
                        <input type="text" name="hero_title" id="hero_title" value="<?php echo esc_attr($hero_title); ?>" class="large-text">
                    </td>
                </tr>

                <!-- HERO ALT METİN -->
                <tr>
                    <th scope="row"><label for="hero_desc">Hero Alt Metin (Açıklama)</label></th>
                    <td>
                        <textarea name="hero_desc" id="hero_desc" rows="4" class="large-text"><?php echo esc_textarea($hero_desc); ?></textarea>
                    </td>
                </tr>
            </table>

            <input type="hidden" name="hero_option_save" value="1">
            <?php submit_button('Ayarları Kaydet'); ?>
        </form>
    </div>

    <!-- Medya Kütüphanesini Çağıran JS -->
    <script>
    jQuery(document).ready(function($){
        $('#upload_hero_image_button').click(function(e) {
            e.preventDefault();
            var image = wp.media({ 
                title: 'Hero Görseli Seç',
                multiple: false
            }).open()
            .on('select', function(e){
                var uploaded_image = image.state().get('selection').first();
                var image_url = uploaded_image.toJSON().url;
                $('#hero_bg_image').val(image_url);
                $('#hero_image_preview').html('<img src="' + image_url + '" style="max-width:300px; height:auto; border-radius:6px;">');
            });
        });
    });
    </script>
    <?php
}