<?php
/**
 * Fortuna Landscape - index.php
 */
get_header(); ?>

<!-- Hero Bölümü (Giriş) -->
<?php 
// Özelleştirici (Customizer) Verilerini Çekme
$hero_bg      = get_theme_mod('hero_bg_image', get_template_directory_uri() . '/images/hero-bg.jpg');
$hero_opacity = get_theme_mod('hero_opacity', '0.4');
$hero_title   = get_theme_mod('hero_title', 'Doğayla Uyumlu, Estetik Mekanlar Tasarlıyoruz.');
$hero_desc    = get_theme_mod('hero_desc', 'Fortuna Landscape olarak, yaşam alanlarınızı yeşille buluşturuyor, modern tasarımlarımızla mekanlara ruh katıyoruz.');
?>
<section class="hero" style="<?php echo $hero_bg ? 'background-image: url(' . esc_url($hero_bg) . ');' : ''; ?>">
    <div class="hero-overlay" style="background-color: rgba(0, 0, 0, <?php echo esc_attr($hero_opacity); ?>);"></div>
    <div class="container hero-content">
        <h2><?php echo esc_html($hero_title); ?></h2>
        <p><?php echo esc_html($hero_desc); ?></p>
        <a href="#neden-biz" class="btn">Keşfedin</a>
    </div>
</section>

<!-- Projeler Bölümü (Sol Menüdeki 'Projeler' CPT ve Galeriye Bağlı) -->
<section class="projects" id="projects">
    <div class="container">
        <h2 class="section-title">Projelerimiz</h2>
        
        <div class="projects-slider-container">
            <!-- Sol Ok Butonu -->
            <button class="project-slider-btn prev-project-btn" id="prevProjectBtn" aria-label="Önceki Projeler">
                <i class="fa-solid fa-chevron-left"></i>
            </button>

            <!-- Yatay Kayan Proje Listesi -->
            <div class="projects-track" id="projectsTrack">
                
                <?php
                // Sol Menüden Eklenen "Projeler" Sorgusu
                $args = array(
                    'post_type'      => 'projeler',
                    'posts_per_page' => -1,
                    'orderby'        => 'date',
                    'order'          => 'DESC'
                );
                $projects_query = new WP_Query($args);

                if ($projects_query->have_posts()) :
                    while ($projects_query->have_posts()) : $projects_query->the_post();
                        
                        // Öne Çıkarılan Görsel (Kapak Fotoğrafı)
                        $thumb_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
                        if (!$thumb_url) {
                            $thumb_url = 'https://images.unsplash.com/photo-1557429287-b2e26467fc2b?q=80&w=800'; // Varsayılan görsel
                        }

                        // Galeri Görsellerinin ID'lerini ve URL'lerini Hazırlama
                        $gallery_ids = get_post_meta(get_the_ID(), '_project_gallery_ids', true);
                        $gallery_urls = array();

                        if (!empty($gallery_ids)) {
                            $ids_array = explode(',', $gallery_ids);
                            foreach ($ids_array as $img_id) {
                                $url = wp_get_attachment_image_url($img_id, 'full');
                                if ($url) {
                                    $gallery_urls[] = "'" . esc_url($url) . "'";
                                }
                            }
                        } else {
                            // Galeri boşsa kapak fotoğrafını JS array'ine at
                            $gallery_urls[] = "'" . esc_url($thumb_url) . "'";
                        }

                        // JS için virgülle ayrılmış URL dizisi
                        $json_gallery = implode(',', $gallery_urls);
                ?>
                    <!-- Proje Kartı -->
                    <div class="project-card" onclick="openGallery([<?php echo $json_gallery; ?>])">
                        <img src="<?php echo esc_url($thumb_url); ?>" alt="<?php the_title_attribute(); ?>">
                        <div class="project-info">
                            <h4><?php the_title(); ?></h4>
                        </div>
                    </div>
                <?php 
                    endwhile;
                    wp_reset_postdata();
                else :
                ?>
                    <p style="text-align: center; width: 100%;">Henüz eklenmiş bir proje bulunmuyor.</p>
                <?php endif; ?>

            </div>

            <!-- Sağ Ok Butonu -->
            <button class="project-slider-btn next-project-btn" id="nextProjectBtn" aria-label="Sonraki Projeler">
                <i class="fa-solid fa-chevron-right"></i>
            </button>
        </div>
    </div>
</section>

<!-- Galeri Modal (Açılır Pencere) -->
<div id="projectModal" class="modal">
    <div class="modal-content">
        <span class="close-modal" onclick="closeGallery()">&times;</span>
        
        <div class="modal-body">
            <!-- Sol Küçük Fotoğraflar (Thumbnails) -->
            <div class="thumbnail-list" id="thumbnailList"></div>

            <!-- Orta Ana Görsel ve Oklar -->
            <div class="main-image-container">
                <button class="modal-arrow prev-arrow" onclick="changeImage(-1, event)">&#10094;</button>
                <img id="modalMainImg" src="" alt="Proje Görseli">
                <button class="modal-arrow next-arrow" onclick="changeImage(1, event)">&#10095;</button>
            </div>
        </div>
    </div>
</div>

<!-- Hizmetler Bölümü (Sol Menüden Eklenen Sınırsız Hizmetler) -->
<?php 
$services_title = get_theme_mod('services_main_title', 'Hizmetlerimiz');
?>
<section id="hizmetler" class="services">
    <div class="container">
        <h3 class="section-title"><?php echo esc_html($services_title); ?></h3>
        
        <div class="slider-container">
            <button class="slider-btn prev-btn" id="prevBtn">&#10094;</button>

            <div class="services-track" id="servicesTrack">
                <?php
                $services_query = new WP_Query(array(
                    'post_type'      => 'hizmetler',
                    'posts_per_page' => -1,
                    'orderby'        => 'date',
                    'order'          => 'ASC'
                ));

                if ($services_query->have_posts()) :
                    while ($services_query->have_posts()) : $services_query->the_post();
                        $icon = get_post_meta(get_the_ID(), '_service_icon', true);
                        if (!$icon) $icon = 'fa-solid fa-tree';
                ?>
                    <div class="service-card">
                        <div class="icon-box">
                            <i class="<?php echo esc_attr($icon); ?>"></i>
                        </div>
                        <h4><?php the_title(); ?></h4>
                        <p><?php echo esc_html(get_the_excerpt() ? get_the_excerpt() : wp_strip_all_tags(get_the_content())); ?></p>
                    </div>
                <?php 
                    endwhile;
                    wp_reset_postdata();
                else :
                ?>
                    <p style="text-align: center; width: 100%;">Henüz hizmet eklenmemiş.</p>
                <?php endif; ?>
            </div>

            <button class="slider-btn next-btn" id="nextBtn">&#10095;</button>
        </div>
    </div>
</section>
<!-- Neden Bizi Tercih Etmelisiniz? Bölümü -->
<section id="neden-biz" class="why-us">
    <div class="container">
        <h3 class="section-title">
            <?php echo esc_html(get_theme_mod('why_us_title', 'Neden Bizi Tercih Etmelisiniz?')); ?>
        </h3>
        
        <div class="why-us-grid">
            <!-- Madde 1 -->
            <div class="why-us-card">
                <div class="why-us-number">01</div>
                <h4><?php echo esc_html(get_theme_mod('why_us_item1_title', 'Özgün ve İşlevsel Tasarımlar')); ?></h4>
                <p><?php echo esc_html(get_theme_mod('why_us_item1_desc', 'Müşterilerimize estetik, işlevsellik ve sürdürülebilirliği bir araya getiren özgün tasarım çözümleri sunuyoruz.')); ?></p>
            </div>

            <!-- Madde 2 -->
            <div class="why-us-card">
                <div class="why-us-number">02</div>
                <h4><?php echo esc_html(get_theme_mod('why_us_item2_title', 'Kalite ve Güven')); ?></h4>
                <p><?php echo esc_html(get_theme_mod('why_us_item2_desc', 'Kaliteli malzeme seçimi, zamanında teslim anlayışı ve müşteri memnuniyetini esas alan hizmet yaklaşımımızla güvenilir projelere imza atıyoruz.')); ?></p>
            </div>

            <!-- Madde 3 -->
            <div class="why-us-card">
                <div class="why-us-number">03</div>
                <h4><?php echo esc_html(get_theme_mod('why_us_item3_title', 'Geleceğe Değer Katan Yaklaşım')); ?></h4>
                <p><?php echo esc_html(get_theme_mod('why_us_item3_desc', 'Doğaya duyarlı ve sürdürülebilir tasarım ilkelerini benimseyerek, yalnızca bugünün ihtiyaçlarını karşılayan değil, geleceğe değer katan yaşam alanları oluşturmayı hedefliyoruz.')); ?></p>
            </div>
        </div>

        <div class="why-us-cta">
            <p><?php echo esc_html(get_theme_mod('why_us_cta_text', 'Hayal ettiğiniz mekânları estetik ve fonksiyonel çözümlerle gerçeğe dönüştürmek için yanınızdayız.')); ?></p>
            <a href="<?php echo esc_url(get_theme_mod('why_us_btn_link', )); ?>" class="btn">
                <?php echo esc_html(get_theme_mod('why_us_btn_text', 'Bizimle İletişime Geçin')); ?>
            </a>
        </div>
    </div>
</section>
<!-- Sağ Alt Sabit WhatsApp Butonu -->
<a href="https://wa.me/905000000000?text=Merhaba,%20projem%20hakk%C4%B1nda%20bilgi%20almak%20istiyorum." class="fixed-whatsapp" target="_blank" title="WhatsApp ile İletişime Geçin">
    <i class="fa-brands fa-whatsapp"></i>
</a>

<?php get_footer(); ?>