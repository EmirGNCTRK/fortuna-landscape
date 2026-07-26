<?php
/**
 * Fortuna Landscape - functions.php
 * Adım 1: Temel Kurulumlar & Hero Ayarları
 * Adım 2: Sol Menüde Projeler CPT & Özel Galeri Yönetimi
 */

// 1. TEMA KURULUMU VE DESTEKLERİ
function fortunalandscape_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails'); // Kapak fotoğrafı desteği
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
    $wp_customize->add_section('hero_section', array(
        'title'    => __('Hero (Giriş) Ayarları', 'fortunalandscape'),
        'priority' => 10,
    ));

    // Hero Görsel
    $wp_customize->add_setting('hero_bg_image', array('default' => '', 'sanitize_callback' => 'esc_url_raw'));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'hero_bg_image', array(
        'label'    => __('Hero Arka Plan Resmi', 'fortunalandscape'),
        'section'  => 'hero_section',
    )));

    // Hero Opaklık
    $wp_customize->add_setting('hero_opacity', array('default' => '0.4', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('hero_opacity', array(
        'label'       => __('Görsel Opaklığı (0.0 Şeffaf - 1.0 Tam Koyu)', 'fortunalandscape'),
        'section'     => 'hero_section',
        'type'        => 'number',
        'input_attrs' => array('min' => 0, 'max' => 1, 'step' => 0.1),
    ));

    // Hero Başlık
    $wp_customize->add_setting('hero_title', array('default' => 'Doğayla Uyumlu, Estetik Mekanlar Tasarlıyoruz.', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('hero_title', array('label' => __('Hero Başlık', 'fortunalandscape'), 'section' => 'hero_section', 'type' => 'text'));

    // Hero Alt Metin
    $wp_customize->add_setting('hero_desc', array('default' => 'Fortuna Landscape olarak, yaşam alanlarınızı yeşille buluşturuyoruz.', 'sanitize_callback' => 'sanitize_textarea_field'));
    $wp_customize->add_control('hero_desc', array('label' => __('Hero Alt Metin (Açıklama)', 'fortunalandscape'), 'section' => 'hero_section', 'type' => 'textarea'));
}
add_action('customize_register', 'fortunalandscape_hero_customizer');


/* ==========================================================================
   4. SOL MENÜYE "PROJELER" EKLEME & ÖZEL GALERİ YÖNETİMİ
   ========================================================================== */

// A) Projeler CPT Tanımlama
function fortunalandscape_register_projects_cpt() {
    $labels = array(
        'name'               => 'Projeler',
        'singular_name'      => 'Proje',
        'menu_name'          => 'Projeler',
        'add_new'            => 'Yeni Proje Ekle',
        'add_new_item'       => 'Yeni Proje Ekle',
        'edit_item'          => 'Projeyi Düzenle',
        'new_item'           => 'Yeni Proje',
        'view_item'          => 'Projeyi İncele',
        'search_items'       => 'Proje Ara',
        'not_found'          => 'Proje Bulunamadı',
        'not_found_in_trash' => 'Çöpte Proje Bulunamadı'
    );

    $args = array(
        'labels'              => $labels,
        'public'              => true,
        'has_archive'         => false,
        'menu_position'       => 5,
        'menu_icon'           => 'dashicons-portfolio', // Çanta İkonu
        'supports'            => array('title', 'thumbnail'), // Başlık ve Kapak Fotoğrafı
        'show_in_rest'        => false,
    );

    register_post_type('projeler', $args);
}
add_action('init', 'fortunalandscape_register_projects_cpt');


// B) Proje Düzenleme Sayfasına "Proje Galerisi (Çoklu Fotoğraf)" Kutusu Ekleme
function fortunalandscape_add_gallery_metabox() {
    add_meta_box(
        'project_gallery_box',
        'Proje Galeri Fotoğrafları',
        'fortunalandscape_gallery_metabox_callback',
        'projeler',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'fortunalandscape_add_gallery_metabox');


// C) Galeri Kutusunun HTML ve JS Kodları (Önizlemeli)
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

    <!-- Admin Paneli Galeri Yönetimi Scripti -->
    <script>
    jQuery(document).ready(function($){
        var frame;
        $('#add_project_gallery_images').on('click', function(e){
            e.preventDefault();
            
            if (frame) {
                frame.open();
                return;
            }
            
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

        // Görsel Silme İşlemi
        $(document).on('click', '.remove-gallery-img', function(){
            var $li = $(this).closest('li');
            var removeId = $li.data('id').toString();
            var ids = $('#project_gallery_ids').val().split(',');
            
            ids = ids.filter(function(id){
                return id !== removeId;
            });
            
            $('#project_gallery_ids').val(ids.join(','));
            $li.remove();
        });
    });
    </script>
    <?php
}


// D) Galeri Görsellerini Veritabanına Kaydetme
function fortunalandscape_save_gallery_metabox($post_id) {
    if (!isset($_POST['project_gallery_nonce']) || !wp_verify_nonce($_POST['project_gallery_nonce'], 'project_gallery_save')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (isset($_POST['project_gallery_ids'])) {
        update_post_meta($post_id, '_project_gallery_ids', sanitize_text_field($_POST['project_gallery_ids']));
    }
}
add_action('save_post', 'fortunalandscape_save_gallery_metabox');