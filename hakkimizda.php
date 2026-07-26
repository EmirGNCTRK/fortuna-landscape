<?php 
/* Template Name: Hakkımızda Sayfası */
get_header(); 
?>

<section class="page-banner">
    <div class="container">
        <h2>Hakkımızda</h2>
    </div>
</section>

<section class="about-single-page">
    <div class="container">
        <div class="about-paragraph-box">
            <p>
                <?php echo esc_html(get_theme_mod('about_text', 'Fortuna Landscape olarak; doğayla insanı estetik, fonksiyonel ve sürdürülebilir bir çizgide buluşturma vizyonuyla yola çıktık...')); ?>
            </p>
        </div>
    </div>
</section>

<?php get_footer(); ?>