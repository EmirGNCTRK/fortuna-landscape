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
   TEMA ÖZELLEŞTİRİCİ (CUSTOMIZER) - "NEDEN BİZİ TERCİH ETMELİSİNİZ"
   ========================================================================== */

function fortunalandscape_why_us_customizer($wp_customize) {
    
    // "Neden Bizi Tercih Etmelisiniz?" Sekmesi
    $wp_customize->add_section('why_us_section', array(
        'title'    => __('Neden Bizi Tercih Etmelisiniz?', 'fortunalandscape'),
        'priority' => 12,
    ));

    // 1. Ana Başlık
    $wp_customize->add_setting('why_us_title', array(
        'default'           => 'Neden Bizi Tercih Etmelisiniz?',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('why_us_title', array(
        'label'    => __('Ana Başlık', 'fortunalandscape'),
        'section'  => 'why_us_section',
        'type'     => 'text',
    ));

    // 2. Alt Açıklama Metni
    $wp_customize->add_setting('why_us_subtitle', array(
        'default'           => 'Yılların getirdiği tecrübe ve doğaya olan tutkumuzla yaşam alanlarınızı dönüştürüyoruz.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('why_us_subtitle', array(
        'label'    => __('Alt Açıklama Metni', 'fortunalandscape'),
        'section'  => 'why_us_section',
        'type'     => 'textarea',
    ));

    // Madde 1 - Başlık & Metin
    $wp_customize->add_setting('why_us_item1_title', array('default' => 'Uzman Kadro', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('why_us_item1_title', array('label' => __('1. Madde Başlığı', 'fortunalandscape'), 'section' => 'why_us_section', 'type' => 'text'));

    $wp_customize->add_setting('why_us_item1_desc', array('default' => 'Alanında deneyimli peyzaj mimarları ve uygulama ekibimizle profesyonel hizmet sunuyoruz.', 'sanitize_callback' => 'sanitize_textarea_field'));
    $wp_customize->add_control('why_us_item1_desc', array('label' => __('1. Madde Açıklaması', 'fortunalandscape'), 'section' => 'why_us_section', 'type' => 'textarea'));

    // Madde 2 - Başlık & Metin
    $wp_customize->add_setting('why_us_item2_title', array('default' => 'Kaliteli Malzeme', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('why_us_item2_title', array('label' => __('2. Madde Başlığı', 'fortunalandscape'), 'section' => 'why_us_section', 'type' => 'text'));

    $wp_customize->add_setting('why_us_item2_desc', array('default' => 'Projelerimizde sadece en dayanıklı, iklime uygun bitki ve yapı malzemelerini kullanıyoruz.', 'sanitize_callback' => 'sanitize_textarea_field'));
    $wp_customize->add_control('why_us_item2_desc', array('label' => __('2. Madde Açıklaması', 'fortunalandscape'), 'section' => 'why_us_section', 'type' => 'textarea'));

    // Madde 3 - Başlık & Metin
    $wp_customize->add_setting('why_us_item3_title', array('default' => 'Zamanında Teslim', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('why_us_item3_title', array('label' => __('3. Madde Başlığı', 'fortunalandscape'), 'section' => 'why_us_section', 'type' => 'text'));

    $wp_customize->add_setting('why_us_item3_desc', array('default' => 'Belirlenen takvime sadık kalarak projelerinizi eksiksiz ve zamanında teslim ediyoruz.', 'sanitize_callback' => 'sanitize_textarea_field'));
    $wp_customize->add_control('why_us_item3_desc', array('label' => __('3. Madde Açıklaması', 'fortunalandscape'), 'section' => 'why_us_section', 'type' => 'textarea'));
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