<?php
/**
 * Fortuna Landscape - functions.php
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


/* ==========================================================================
   3. TEMA ÖZELLEŞTİRİCİ (CUSTOMIZER) - HERO VE GENEL AYARLAR
   ========================================================================== */

function fortunalandscape_customizer($wp_customize) {
    // HERO BÖLÜMÜ
    $wp_customize->add_section('hero_section', array(
        'title'    => __('Hero (Giriş) Ayarları', 'fortunalandscape'),
        'priority' => 10,
    ));

    $wp_customize->add_setting('hero_bg_image', array('default' => '', 'sanitize_callback' => 'esc_url_raw'));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'hero_bg_image', array(
        'label'    => __('Hero Arka Plan Resmi', 'fortunalandscape'),
        'section'  => 'hero_section',
    )));

    $wp_customize->add_setting('hero_opacity', array('default' => '0.4', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('hero_opacity', array(
        'label'       => __('Görsel Opaklığı (0.0 Şeffaf - 1.0 Tam Koyu)', 'fortunalandscape'),
        'section'     => 'hero_section',
        'type'        => 'number',
        'input_attrs' => array('min' => 0, 'max' => 1, 'step' => 0.1),
    ));

    $wp_customize->add_setting('hero_title', array('default' => 'Doğayla Uyumlu, Estetik Mekanlar Tasarlıyoruz.', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('hero_title', array('label' => __('Hero Başlık', 'fortunalandscape'), 'section' => 'hero_section', 'type' => 'text'));

    $wp_customize->add_setting('hero_desc', array('default' => 'Fortuna Landscape olarak, yaşam alanlarınızı yeşille buluşturuyoruz.', 'sanitize_callback' => 'sanitize_textarea_field'));
    $wp_customize->add_control('hero_desc', array('label' => __('Hero Alt Metin (Açıklama)', 'fortunalandscape'), 'section' => 'hero_section', 'type' => 'textarea'));

    // HİZMETLER BÖLÜM BAŞLIĞI
    $wp_customize->add_section('services_section', array(
        'title'    => __('Hizmetler Bölüm Başlığı', 'fortunalandscape'),
        'priority' => 11,
    ));

    $wp_customize->add_setting('services_main_title', array('default' => 'Hizmetlerimiz', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('services_main_title', array('label' => __('Bölüm Başlığı', 'fortunalandscape'), 'section' => 'services_section', 'type' => 'text'));
}
add_action('customize_register', 'fortunalandscape_customizer');
/* ==========================================================================
   ÖZELLEŞTİRİCİ - NEDEN BİZİ TERCİH ETMELİSİNİZ (TAM UYUM)
   ========================================================================== */

function fortunalandscape_why_us_customizer($wp_customize) {
    
    $wp_customize->add_section('why_us_section', array(
        'title'    => __('Neden Bizi Tercih Etmelisiniz?', 'fortunalandscape'),
        'priority' => 12,
    ));

    // Ana Başlık
    $wp_customize->add_setting('why_us_title', array('default' => 'Neden Bizi Tercih Etmelisiniz?', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('why_us_title', array('label' => __('Bölüm Başlığı', 'fortunalandscape'), 'section' => 'why_us_section', 'type' => 'text'));

    // Madde 1
    $wp_customize->add_setting('why_us_item1_title', array('default' => 'Özgün ve İşlevsel Tasarımlar', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('why_us_item1_title', array('label' => __('1. Kart Başlığı', 'fortunalandscape'), 'section' => 'why_us_section', 'type' => 'text'));

    $wp_customize->add_setting('why_us_item1_desc', array('default' => 'Müşterilerimize estetik, işlevsellik ve sürdürülebilirliği bir araya getiren özgün tasarım çözümleri sunuyoruz.', 'sanitize_callback' => 'sanitize_textarea_field'));
    $wp_customize->add_control('why_us_item1_desc', array('label' => __('1. Kart Açıklaması', 'fortunalandscape'), 'section' => 'why_us_section', 'type' => 'textarea'));

    // Madde 2
    $wp_customize->add_setting('why_us_item2_title', array('default' => 'Kalite ve Güven', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('why_us_item2_title', array('label' => __('2. Kart Başlığı', 'fortunalandscape'), 'section' => 'why_us_section', 'type' => 'text'));

    $wp_customize->add_setting('why_us_item2_desc', array('default' => 'Kaliteli malzeme seçimi, zamanında teslim anlayışı ve müşteri memnuniyetini esas alan hizmet yaklaşımımızla güvenilir projelere imza atıyoruz.', 'sanitize_callback' => 'sanitize_textarea_field'));
    $wp_customize->add_control('why_us_item2_desc', array('label' => __('2. Kart Açıklaması', 'fortunalandscape'), 'section' => 'why_us_section', 'type' => 'textarea'));

    // Madde 3
    $wp_customize->add_setting('why_us_item3_title', array('default' => 'Geleceğe Değer Katan Yaklaşım', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('why_us_item3_title', array('label' => __('3. Kart Başlığı', 'fortunalandscape'), 'section' => 'why_us_section', 'type' => 'text'));

    $wp_customize->add_setting('why_us_item3_desc', array('default' => 'Doğaya duyarlı ve sürdürülebilir tasarım ilkelerini benimseyerek, yalnızca bugünün ihtiyaçlarını karşılayan değil, geleceğe değer katan yaşam alanları oluşturmayı hedefliyoruz.', 'sanitize_callback' => 'sanitize_textarea_field'));
    $wp_customize->add_control('why_us_item3_desc', array('label' => __('3. Kart Açıklaması', 'fortunalandscape'), 'section' => 'why_us_section', 'type' => 'textarea'));

    // Alt CTA Alanı
    $wp_customize->add_setting('why_us_cta_text', array('default' => 'Hayal ettiğiniz mekânları estetik ve fonksiyonel çözümlerle gerçeğe dönüştürmek için yanınızdayız.', 'sanitize_callback' => 'sanitize_textarea_field'));
    $wp_customize->add_control('why_us_cta_text', array('label' => __('Alt Çağrı Metni', 'fortunalandscape'), 'section' => 'why_us_section', 'type' => 'textarea'));

    $wp_customize->add_setting('why_us_btn_text', array('default' => 'Bizimle İletişime Geçin', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('why_us_btn_text', array('label' => __('Buton Yazısı', 'fortunalandscape'), 'section' => 'why_us_section', 'type' => 'text'));

    $wp_customize->add_setting('why_us_btn_link', array('default' => site_url('/contact.html'), 'sanitize_callback' => 'esc_url_raw'));
    $wp_customize->add_control('why_us_btn_link', array('label' => __('Buton Linki', 'fortunalandscape'), 'section' => 'why_us_section', 'type' => 'text'));

}
add_action('customize_register', 'fortunalandscape_why_us_customizer');
/* ==========================================================================
   4. SOL MENÜYE "HİZMETLER" CPT VE LINK/INPUT İLE İKON SEÇİCİ
   ========================================================================== */

function fortunalandscape_register_services_cpt() {
    $labels = array(
        'name'          => 'Hizmetler',
        'singular_name' => 'Hizmet',
        'menu_name'     => 'Hizmetler',
        'add_new'       => 'Yeni Hizmet Ekle',
        'add_new_item'  => 'Yeni Hizmet Ekle',
        'edit_item'     => 'Hizmeti Düzenle',
    );

    $args = array(
        'labels'        => $labels,
        'public'        => true,
        'menu_position' => 6,
        'menu_icon'     => 'dashicons-hammer',
        'supports'      => array('title', 'editor'),
    );

    register_post_type('hizmetler', $args);
}
add_action('init', 'fortunalandscape_register_services_cpt');

// Hizmet Düzenleme Sayfasına İkon Metin Kutusu ve Link Ekleme
function fortunalandscape_add_service_icon_box() {
    add_meta_box('service_icon_box', 'Hizmet İkonu', 'fortunalandscape_service_icon_callback', 'hizmetler', 'side', 'high');
}
add_action('add_meta_boxes', 'fortunalandscape_add_service_icon_box');

// İkon Kutusu HTML & JS
function fortunalandscape_service_icon_callback($post) {
    wp_nonce_field('service_icon_save', 'service_icon_nonce');
    $current_icon = get_post_meta($post->ID, '_service_icon', true);
    if(!$current_icon) $current_icon = 'fa-solid fa-tree';
    ?>
    <!-- FontAwesome Admin Önizleme Desteği -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <div style="margin-bottom: 12px;">
        <a href="https://fontawesome.com/search?o=r&m=free" target="_blank" class="button button-secondary" style="width: 100%; text-align: center; display: inline-block;">
            <i class="fa-solid fa-arrow-up-right-from-square"></i> FontAwesome İkon Bul
        </a>
    </div>

    <p style="margin-bottom: 5px;"><strong>İkon Kodu:</strong></p>
    <input type="text" name="service_icon" id="service_icon_input" value="<?php echo esc_attr($current_icon); ?>" style="width: 100%; margin-bottom: 10px;" placeholder="Örn: fa-solid fa-leaf">

    <p style="margin-bottom: 5px;"><strong>Canlı Önizleme:</strong></p>
    <div id="icon-preview" style="font-size: 32px; text-align: center; padding: 15px; background: #f0f0f1; border: 1px solid #ccc; border-radius: 6px; color: #2c3338;">
        <i class="<?php echo esc_attr($current_icon); ?>"></i>
    </div>

    <script>
    jQuery(document).ready(function($){
        // Kullanıcı koda yazıp değiştikçe veya tuşa bastıkça önizlemeyi anında güncelle
        $('#service_icon_input').on('input change', function(){
            var iconClass = $(this).val().trim();
            if(iconClass === '') {
                iconClass = 'fa-solid fa-question';
            }
            $('#icon-preview i').attr('class', iconClass);
        });
    });
    </script>
    <?php
}

// İkonu Kaydet
function fortunalandscape_save_service_icon($post_id) {
    if (!isset($_POST['service_icon_nonce']) || !wp_verify_nonce($_POST['service_icon_nonce'], 'service_icon_save')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (isset($_POST['service_icon'])) {
        update_post_meta($post_id, '_service_icon', sanitize_text_field($_POST['service_icon']));
    }
}
add_action('save_post', 'fortunalandscape_save_service_icon');


/* ==========================================================================
   5. SOL MENÜYE "PROJELER" EKLEME & ÖZEL GALERİ YÖNETİMİ
   ========================================================================== */

function fortunalandscape_register_projects_cpt() {
    $labels = array(
        'name'          => 'Projeler',
        'singular_name' => 'Proje',
        'menu_name'     => 'Projeler',
        'add_new'       => 'Yeni Proje Ekle',
        'add_new_item'  => 'Yeni Proje Ekle',
        'edit_item'     => 'Projeyi Düzenle',
    );

    $args = array(
        'labels'        => $labels,
        'public'        => true,
        'menu_position' => 5,
        'menu_icon'     => 'dashicons-portfolio',
        'supports'      => array('title', 'thumbnail'),
    );

    register_post_type('projeler', $args);
}
add_action('init', 'fortunalandscape_register_projects_cpt');

function fortunalandscape_add_gallery_metabox() {
    add_meta_box('project_gallery_box', 'Proje Galeri Fotoğrafları', 'fortunalandscape_gallery_metabox_callback', 'projeler', 'normal', 'high');
}
add_action('add_meta_boxes', 'fortunalandscape_add_gallery_metabox');

function fortunalandscape_gallery_metabox_callback($post) {
    wp_nonce_field('project_gallery_save', 'project_gallery_nonce');
    $gallery_ids = get_post_meta($post->ID, '_project_gallery_ids', true);
    ?>
    <div id="project_gallery_container">
        <ul id="project_gallery_thumbs" style="display: flex; flex-wrap: wrap; gap: 10px; margin-bottom: 15px;">
            <?php
            if (!empty($gallery_ids)) {
                $ids = explode(',', $gallery_ids);
                foreach ($ids as $id) {
                    $image_url = wp_get_attachment_image_url($id, 'thumbnail');
                    if ($image_url) {
                        echo '<li data-id="' . esc_attr($id) . '" style="position:relative; width:100px; height:100px; border:1px solid #ccc; border-radius:6px; overflow:hidden; background:#f9f9f9;">';
                        echo '<img src="' . esc_url($image_url) . '" style="width:100%; height:100%; object-fit:cover;">';
                        echo '<span class="remove-gallery-img" style="position:absolute; top:4px; right:4px; background:red; color:#fff; border-radius:50%; width:20px; height:20px; display:flex; align-items:center; justify-content:center; cursor:pointer; font-size:12px; font-weight:bold;">&times;</span>';
                        echo '</li>';
                    }
                }
            }
            ?>
        </ul>
        <input type="hidden" name="project_gallery_ids" id="project_gallery_ids" value="<?php echo esc_attr($gallery_ids); ?>">
        <button type="button" class="button button-primary" id="add_project_gallery_images">Galeriye Fotoğraf Ekle / Düzenle</button>
    </div>

    <script>
    jQuery(document).ready(function($){
        var frame;
        $('#add_project_gallery_images').on('click', function(e){
            e.preventDefault();
            if (frame) { frame.open(); return; }
            frame = wp.media({
                title: 'Proje Galeri Fotoğraflarını Seçin',
                button: { text: 'Seçilenleri Galeriye Ekle' },
                multiple: true
            });
            frame.on('select', function(){
                var selection = frame.state().get('selection');
                var ids = $('#project_gallery_ids').val() ? $('#project_gallery_ids').val().split(',') : [];
                selection.map(function(attachment){
                    attachment = attachment.toJSON();
                    if($.inArray(attachment.id.toString(), ids) === -1){
                        ids.push(attachment.id);
                        var thumbUrl = attachment.sizes.thumbnail ? attachment.sizes.thumbnail.url : attachment.url;
                        $('#project_gallery_thumbs').append(
                            '<li data-id="' + attachment.id + '" style="position:relative; width:100px; height:100px; border:1px solid #ccc; border-radius:6px; overflow:hidden; background:#f9f9f9;">' +
                                '<img src="' + thumbUrl + '" style="width:100%; height:100%; object-fit:cover;">' +
                                '<span class="remove-gallery-img" style="position:absolute; top:4px; right:4px; background:red; color:#fff; border-radius:50%; width:20px; height:20px; display:flex; align-items:center; justify-content:center; cursor:pointer; font-size:12px; font-weight:bold;">&times;</span>' +
                            '</li>'
                        );
                    }
                });
                $('#project_gallery_ids').val(ids.join(','));
            });
            frame.open();
        });

        $(document).on('click', '.remove-gallery-img', function(){
            var $li = $(this).closest('li');
            var removeId = $li.data('id').toString();
            var ids = $('#project_gallery_ids').val().split(',');
            ids = ids.filter(function(id){ return id !== removeId; });
            $('#project_gallery_ids').val(ids.join(','));
            $li.remove();
        });
    });
    </script>
    <?php
}

function fortunalandscape_save_gallery_metabox($post_id) {
    if (!isset($_POST['project_gallery_nonce']) || !wp_verify_nonce($_POST['project_gallery_nonce'], 'project_gallery_save')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (isset($_POST['project_gallery_ids'])) {
        update_post_meta($post_id, '_project_gallery_ids', sanitize_text_field($_POST['project_gallery_ids']));
    }
}
add_action('save_post', 'fortunalandscape_save_gallery_metabox');
/* ==========================================================================
   ÖZELLEŞTİRİCİ - FOOTER & SOSYAL MEDYA (AÇ/KAPAT SWITCH DESTEKLİ)
   ========================================================================== */

function fortunalandscape_footer_customizer($wp_customize) {
    
    // Footer Sekmesi
    $wp_customize->add_section('footer_section', array(
        'title'    => __('Footer & Sosyal Medya', 'fortunalandscape'),
        'priority' => 13,
    ));

    // Telif Metni
    $wp_customize->add_setting('footer_copyright', array(
        'default'           => 'Fortuna Landscape. Tüm hakları saklıdır.',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('footer_copyright', array(
        'label'    => __('Telif Hakkı Metni', 'fortunalandscape'),
        'section'  => 'footer_section',
        'type'     => 'text',
    ));

    // WhatsApp Telefon Numarası
    $wp_customize->add_setting('footer_whatsapp_phone', array(
        'default'           => '905000000000',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('footer_whatsapp_phone', array(
        'label'       => __('WhatsApp Numarası (Ülke kodlu, örn: 905321234567)', 'fortunalandscape'),
        'section'     => 'footer_section',
        'type'        => 'text',
    ));

    // Sosyal Medya Linkleri & Switch Yapısı
    $socials = array(
        'instagram' => 'Instagram',
        'facebook'  => 'Facebook',
        'linkedin'  => 'LinkedIn',
        'twitter'   => 'X (Twitter)',
        'pinterest' => 'Pinterest',
    );

    foreach ($socials as $key => $label) {
        
        // 1. Switch / Checkbox Kontrolü (Görünsün mü?)
        $wp_customize->add_setting('show_social_' . $key, array(
            'default'           => true,
            'sanitize_callback' => 'fortunalandscape_sanitize_checkbox',
        ));
        $wp_customize->add_control('show_social_' . $key, array(
            'label'   => sprintf(__('%s İkonunu Göster', 'fortunalandscape'), $label),
            'section' => 'footer_section',
            'type'    => 'checkbox',
        ));

        // 2. URL Girme Alanı
        $wp_customize->add_setting('social_' . $key, array(
            'default'           => 'https://' . $key . '.com',
            'sanitize_callback' => 'esc_url_raw',
        ));
        $wp_customize->add_control('social_' . $key, array(
            'label'   => sprintf(__('%s Bağlantısı (URL)', 'fortunalandscape'), $label),
            'section' => 'footer_section',
            'type'    => 'url',
        ));
    }
}
add_action('customize_register', 'fortunalandscape_footer_customizer');

// Checkbox Temizleme (Sanitization) Fonksiyonu
function fortunalandscape_sanitize_checkbox($checked) {
    return (isset($checked) && $checked === true) ? true : false;
}
/* ==========================================================================
   ÖZELLEŞTİRİCİ - HAKKIMIZDA SAYFASI AYARLARI
   ========================================================================== */

function fortunalandscape_about_customizer($wp_customize) {
    
    // Hakkımızda Sekmesi
    $wp_customize->add_section('about_page_section', array(
        'title'    => __('Hakkımızda Sayfası', 'fortunalandscape'),
        'priority' => 14,
    ));

    // Banner Başlığı
    $wp_customize->add_setting('about_banner_title', array(
        'default'           => 'Hakkımızda',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('about_banner_title', array(
        'label'    => __('Banner Başlığı', 'fortunalandscape'),
        'section'  => 'about_page_section',
        'type'     => 'text',
    ));

    // Paragraf Metni
    $wp_customize->add_setting('about_content_text', array(
        'default'           => 'Fortuna Landscape olarak; doğayla insanı estetik, fonksiyonel ve sürdürülebilir bir çizgide buluşturma vizyonuyla yola çıktık. Peyzaj mimarlığı ve açık alan tasarımı alanında uzman kadromuzla, her projeye bir sanat eseri titizliğiyle yaklaşıyor, yaşam alanlarınıza ruh ve değer katıyoruz. Modern tasarım anlayışımızı çevreye duyarlı malzemeler ve yenilikçi çözümlerle harmanlayarak, yalnızca bugünün değil geleceğin de ihtiyaçlarına cevap veren zamansız mekanlar kurguluyoruz. Müşteri memnuniyetini ve kaliteyi her zaman odağımıza alarak, hayal ettiğiniz doğal ve estetik yaşam alanlarını gerçeğe dönüştürmek için tutkuyla çalışmaya devam ediyoruz.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('about_content_text', array(
        'label'    => __('Hakkımızda Metni', 'fortunalandscape'),
        'section'  => 'about_page_section',
        'type'     => 'textarea',
    ));
}
add_action('customize_register', 'fortunalandscape_about_customizer');
/* ==========================================================================
   ÖZELLEŞTİRİCİ - İLETİŞİM SAYFASI TÜM AYARLAR & SWITCH KONTROLLERİ
   ========================================================================== */

function fortunalandscape_contact_customizer($wp_customize) {

    $wp_customize->add_section('contact_page_section', array(
        'title'    => __('İletişim Sayfası', 'fortunalandscape'),
        'priority' => 15,
    ));

    // --- 1. BANNER AYARLARI ---
    $wp_customize->add_setting('show_contact_banner', array('default' => true, 'sanitize_callback' => 'fortunalandscape_sanitize_checkbox'));
    $wp_customize->add_control('show_contact_banner', array('label' => __('Banner Alanını Göster', 'fortunalandscape'), 'section' => 'contact_page_section', 'type' => 'checkbox'));

    $wp_customize->add_setting('contact_banner_title', array('default' => 'İletişim', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('contact_banner_title', array('label' => __('Banner Başlığı', 'fortunalandscape'), 'section' => 'contact_page_section', 'type' => 'text'));

    $wp_customize->add_setting('contact_banner_subtitle', array('default' => 'Hayalinizdeki peyzaj projesini birlikte hayata geçirelim.', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('contact_banner_subtitle', array('label' => __('Banner Alt Başlığı', 'fortunalandscape'), 'section' => 'contact_page_section', 'type' => 'text'));

    // --- 2. SOL İLETİŞİM KARTI & BİLGİLERİ ---
    $wp_customize->add_setting('show_contact_info_card', array('default' => true, 'sanitize_callback' => 'fortunalandscape_sanitize_checkbox'));
    $wp_customize->add_control('show_contact_info_card', array('label' => __('İletişim Bilgileri Kartını Göster', 'fortunalandscape'), 'section' => 'contact_page_section', 'type' => 'checkbox'));

    $wp_customize->add_setting('contact_info_card_title', array('default' => 'Bizimle İletişime Geçin', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('contact_info_card_title', array('label' => __('İletişim Kartı Başlığı', 'fortunalandscape'), 'section' => 'contact_page_section', 'type' => 'text'));

    $wp_customize->add_setting('contact_info_card_desc', array('default' => 'Projeleriniz, danışmanlık talepleriniz veya sorularınız için doğrudan bize ulaşabilirsiniz.', 'sanitize_callback' => 'sanitize_textarea_field'));
    $wp_customize->add_control('contact_info_card_desc', array('label' => __('İletişim Kartı Açıklaması', 'fortunalandscape'), 'section' => 'contact_page_section', 'type' => 'textarea'));

    // Adres
    $wp_customize->add_setting('show_contact_address', array('default' => true, 'sanitize_callback' => 'fortunalandscape_sanitize_checkbox'));
    $wp_customize->add_control('show_contact_address', array('label' => __('Adres Satırını Göster', 'fortunalandscape'), 'section' => 'contact_page_section', 'type' => 'checkbox'));

    $wp_customize->add_setting('contact_address_label', array('default' => 'Adres', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('contact_address_label', array('label' => __('Adres Etiketi', 'fortunalandscape'), 'section' => 'contact_page_section', 'type' => 'text'));

    $wp_customize->add_setting('contact_address_text', array('default' => 'Atatürk Mah. Mimarlık Cad. No:12, İzmir / Türkiye', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('contact_address_text', array('label' => __('Adres Metni', 'fortunalandscape'), 'section' => 'contact_page_section', 'type' => 'text'));

    $wp_customize->add_setting('contact_address_url', array('default' => 'https://maps.google.com/?q=Atatürk+Mah.+Mimarlık+Cad.+No:12,+İzmir', 'sanitize_callback' => 'esc_url_raw'));
    $wp_customize->add_control('contact_address_url', array('label' => __('Adres Harita Linki (Tıklanınca Açılacak URL)', 'fortunalandscape'), 'section' => 'contact_page_section', 'type' => 'url'));

    // Telefon
    $wp_customize->add_setting('show_contact_phone', array('default' => true, 'sanitize_callback' => 'fortunalandscape_sanitize_checkbox'));
    $wp_customize->add_control('show_contact_phone', array('label' => __('Telefon Satırını Göster', 'fortunalandscape'), 'section' => 'contact_page_section', 'type' => 'checkbox'));

    $wp_customize->add_setting('contact_phone_label', array('default' => 'Telefon', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('contact_phone_label', array('label' => __('Telefon Etiketi', 'fortunalandscape'), 'section' => 'contact_page_section', 'type' => 'text'));

    $wp_customize->add_setting('contact_phone_text', array('default' => '+90 (232) 000 00 00', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('contact_phone_text', array('label' => __('Telefon Görünür Metin', 'fortunalandscape'), 'section' => 'contact_page_section', 'type' => 'text'));

    $wp_customize->add_setting('contact_phone_raw', array('default' => '+902320000000', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('contact_phone_raw', array('label' => __('Telefon Tıklanabilir Numara (örn: +902320000000)', 'fortunalandscape'), 'section' => 'contact_page_section', 'type' => 'text'));

    // E-posta
    $wp_customize->add_setting('show_contact_email', array('default' => true, 'sanitize_callback' => 'fortunalandscape_sanitize_checkbox'));
    $wp_customize->add_control('show_contact_email', array('label' => __('E-posta Satırını Göster', 'fortunalandscape'), 'section' => 'contact_page_section', 'type' => 'checkbox'));

    $wp_customize->add_setting('contact_email_label', array('default' => 'E-posta', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('contact_email_label', array('label' => __('E-posta Etiketi', 'fortunalandscape'), 'section' => 'contact_page_section', 'type' => 'text'));

    $wp_customize->add_setting('contact_email_text', array('default' => 'info@fortunalandscape.com', 'sanitize_callback' => 'sanitize_email'));
    $wp_customize->add_control('contact_email_text', array('label' => __('E-posta Adresi', 'fortunalandscape'), 'section' => 'contact_page_section', 'type' => 'text'));

    // Çalışma Saatleri
    $wp_customize->add_setting('show_contact_hours', array('default' => true, 'sanitize_callback' => 'fortunalandscape_sanitize_checkbox'));
    $wp_customize->add_control('show_contact_hours', array('label' => __('Çalışma Saatleri Satırını Göster', 'fortunalandscape'), 'section' => 'contact_page_section', 'type' => 'checkbox'));

    $wp_customize->add_setting('contact_hours_label', array('default' => 'Çalışma Saatleri', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('contact_hours_label', array('label' => __('Çalışma Saatleri Etiketi', 'fortunalandscape'), 'section' => 'contact_page_section', 'type' => 'text'));

    $wp_customize->add_setting('contact_hours_text_1', array('default' => 'Pazartesi - Cumartesi: 09:00 - 18:00', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('contact_hours_text_1', array('label' => __('Çalışma Saatleri (1. Satır)', 'fortunalandscape'), 'section' => 'contact_page_section', 'type' => 'text'));

    $wp_customize->add_setting('contact_hours_text_2', array('default' => 'Pazar: Kapalı', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('contact_hours_text_2', array('label' => __('Çalışma Saatleri (2. Satır Vurgulu)', 'fortunalandscape'), 'section' => 'contact_page_section', 'type' => 'text'));


    // --- 3. SAĞ WHATSAPP KARTI AYARLARI ---
    $wp_customize->add_setting('show_contact_whatsapp_card', array('default' => true, 'sanitize_callback' => 'fortunalandscape_sanitize_checkbox'));
    $wp_customize->add_control('show_contact_whatsapp_card', array('label' => __('WhatsApp Kartını Göster', 'fortunalandscape'), 'section' => 'contact_page_section', 'type' => 'checkbox'));

    $wp_customize->add_setting('contact_wa_card_title', array('default' => 'WhatsApp ile Hızlı İletişim', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('contact_wa_card_title', array('label' => __('WhatsApp Kartı Başlığı', 'fortunalandscape'), 'section' => 'contact_page_section', 'type' => 'text'));

    $wp_customize->add_setting('contact_wa_card_desc', array('default' => 'Projeleriniz hakkında anında bilgi almak, keşif talebinde bulunmak veya sorularınızı iletmek için bize WhatsApp üzerinden doğrudan ulaşabilirsiniz.', 'sanitize_callback' => 'sanitize_textarea_field'));
    $wp_customize->add_control('contact_wa_card_desc', array('label' => __('WhatsApp Kartı Açıklaması', 'fortunalandscape'), 'section' => 'contact_page_section', 'type' => 'textarea'));

    $wp_customize->add_setting('contact_wa_card_phone', array('default' => '905000000000', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('contact_wa_card_phone', array('label' => __('WhatsApp Numarası (Ülke Kodlu, örn: 905XXXXXXXXX)', 'fortunalandscape'), 'section' => 'contact_page_section', 'type' => 'text'));

    $wp_customize->add_setting('contact_wa_card_msg', array('default' => 'Merhaba, projem hakkında bilgi almak istiyorum.', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('contact_wa_card_msg', array('label' => __('Varsayılan WhatsApp Mesajı', 'fortunalandscape'), 'section' => 'contact_page_section', 'type' => 'text'));

    $wp_customize->add_setting('contact_wa_card_btn_text', array('default' => 'WhatsApp\'tan Yazın', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('contact_wa_card_btn_text', array('label' => __('WhatsApp Buton Yazısı', 'fortunalandscape'), 'section' => 'contact_page_section', 'type' => 'text'));


    // --- 4. GOOGLE MAPS HARİTA BÖLÜMÜ ---
    $wp_customize->add_setting('show_contact_map', array('default' => true, 'sanitize_callback' => 'fortunalandscape_sanitize_checkbox'));
    $wp_customize->add_control('show_contact_map', array('label' => __('Google Maps Harita Alanını Göster', 'fortunalandscape'), 'section' => 'contact_page_section', 'type' => 'checkbox'));

    $wp_customize->add_setting('contact_map_iframe_code', array('default' => '', 'sanitize_callback' => 'fortunalandscape_sanitize_iframe'));
    $wp_customize->add_control('contact_map_iframe_code', array(
        'label'       => __('Google Maps Embed (iFrame) Kodu', 'fortunalandscape'),
        'description' => __('Google Haritalar\'dan aldığınız <iframe ...></iframe> kodunu buraya yapıştırabilirsiniz.', 'fortunalandscape'),
        'section'     => 'contact_page_section',
        'type'        => 'textarea',
    ));
}
add_action('customize_register', 'fortunalandscape_contact_customizer');

// iFrame HTML Temizleme/İzin Verme Fonksiyonu
function fortunalandscape_sanitize_iframe($input) {
    return wp_kses($input, array(
        'iframe' => array(
            'src'             => true,
            'width'           => true,
            'height'          => true,
            'frameborder'     => true,
            'style'           => true,
            'allowfullscreen' => true,
            'loading'         => true,
            'referrerpolicy'  => true,
        ),
    ));
}
/* ==========================================================================
   HEADER & MENÜ AYARLARI
   ========================================================================== */

function fortunalandscape_header_setup() {
    // Dinamik Title Desteği
    add_theme_support('title-tag');

    // Özel Logo Desteği
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 100,
        'flex-height' => true,
        'flex-width'  => true,
    ));

    // Ana Menü Konumunu Tanımla
    register_nav_menus(array(
        'primary-menu' => __('Ana Navigasyon Menüsü', 'fortunalandscape'),
    ));
}
add_action('after_setup_theme', 'fortunalandscape_header_setup');

// Header Özelleştirici Ayarları (Preloader Switch)
function fortunalandscape_header_customizer($wp_customize) {
    $wp_customize->add_section('header_section', array(
        'title'    => __('Header & Preloader Ayarları', 'fortunalandscape'),
        'priority' => 10,
    ));

    // Preloader Göster/Gizle
    $wp_customize->add_setting('show_preloader', array(
        'default'           => true,
        'sanitize_callback' => 'fortunalandscape_sanitize_checkbox',
    ));
    $wp_customize->add_control('show_preloader', array(
        'label'    => __('Yükleme Ekranını (Preloader) Aktif Et', 'fortunalandscape'),
        'section'  => 'header_section',
        'type'     => 'checkbox',
    ));
}
add_action('customize_register', 'fortunalandscape_header_customizer');
/* ==========================================================================
   FOOTER MENÜ KAYDI & ÖZELLEŞTİRİCİ AYARLARI
   ========================================================================== */

function fortunalandscape_footer_menu_setup() {
    // Footer için menü konumu tanımla
    register_nav_menus(array(
        'footer-menu' => __('Footer Hızlı Menü', 'fortunalandscape'),
    ));
}
add_action('after_setup_theme', 'fortunalandscape_footer_menu_setup');

// Existing fortunalandscape_footer_customizer fonksiyonunuzun içine veya altına ekleyebilirsiniz:
function fortunalandscape_footer_menu_customizer($wp_customize) {
    
    // Footer Menü Göster/Gizle Switch
    $wp_customize->add_setting('show_footer_nav', array(
        'default'           => true,
        'sanitize_callback' => 'fortunalandscape_sanitize_checkbox',
    ));
    $wp_customize->add_control('show_footer_nav', array(
        'label'    => __('Footer Hızlı Menüyü Göster', 'fortunalandscape'),
        'section'  => 'footer_section', // Mevcut Footer sekmeniz
        'type'     => 'checkbox',
        'priority' => 5,
    ));
}
add_action('customize_register', 'fortunalandscape_footer_menu_customizer');