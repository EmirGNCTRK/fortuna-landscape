<?php get_header(); ?>

<!-- HERO BÖLÜMÜ -->
<?php 
$hero_bg = get_theme_mod('hero_bg_image', get_template_directory_uri() . '/images/hero-bg.jpg');
$hero_opacity = get_theme_mod('hero_opacity', '0.4');
?>
<section class="hero" style="background-image: url('<?php echo esc_url($hero_bg); ?>');">
    <div class="hero-overlay" style="background-color: rgba(0,0,0, <?php echo esc_attr($hero_opacity); ?>);"></div>
    <div class="container hero-content">
        <h2><?php echo esc_html(get_theme_mod('hero_title', 'Doğayla Uyumlu, Estetik Mekanlar Tasarlıyoruz.')); ?></h2>
        <p><?php echo esc_html(get_theme_mod('hero_desc', 'Fortuna Landscape olarak yaşam alanlarınızı yeşille buluşturuyoruz.')); ?></p>
        <a href="#projects" class="btn">Keşfedin</a>
    </div>
</section>

<!-- PROJELER BÖLÜMÜ (Custom Post Type) -->
<section class="projects" id="projects">
    <div class="container">
        <h2 class="section-title">Projelerimiz</h2>
        <div class="projects-slider-container">
            <button class="project-slider-btn prev-project-btn" id="prevProjectBtn"><i class="fa-solid fa-chevron-left"></i></button>
            <div class="projects-track" id="projectsTrack">
                
                <?php 
                $projects_query = new WP_Query(array('post_type' => 'projeler', 'posts_per_page' => -1));
                if ($projects_query->have_posts()) :
                    while ($projects_query->have_posts()) : $projects_query->the_post();
                        $thumb_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
                ?>
                    <div class="project-card" onclick="openGallery(['<?php echo esc_url($thumb_url); ?>'])">
                        <img src="<?php echo esc_url($thumb_url); ?>" alt="<?php the_title(); ?>">
                        <div class="project-info">
                            <h4><?php the_title(); ?></h4>
                        </div>
                    </div>
                <?php 
                    endwhile; 
                    wp_reset_postdata();
                endif; 
                ?>

            </div>
            <button class="project-slider-btn next-project-btn" id="nextProjectBtn"><i class="fa-solid fa-chevron-right"></i></button>
        </div>
    </div>
</section>

<!-- HİZMETLER BÖLÜMÜ (Custom Post Type) -->
<section id="hizmetler" class="services">
    <div class="container">
        <h3 class="section-title">Hizmetlerimiz</h3>
        <div class="slider-container">
            <button class="slider-btn prev-btn" id="prevBtn">&#10094;</button>
            <div class="services-track" id="servicesTrack">
                
                <?php 
                $services_query = new WP_Query(array('post_type' => 'hizmetler', 'posts_per_page' => -1));
                if ($services_query->have_posts()) :
                    while ($services_query->have_posts()) : $services_query->the_post();
                ?>
                    <div class="service-card">
                        <div class="icon-box">🍃</div>
                        <h4><?php the_title(); ?></h4>
                        <p><?php echo get_the_excerpt(); ?></p>
                    </div>
                <?php 
                    endwhile; 
                    wp_reset_postdata();
                endif; 
                ?>

            </div>
            <button class="slider-btn next-btn" id="nextBtn">&#10095;</button>
        </div>
    </div>
</section>

<?php get_footer(); ?>