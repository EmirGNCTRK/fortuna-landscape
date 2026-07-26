<?php
/*
Template Name: Hakkımızda Sayfası
*/

get_header(); ?>

<!-- Sayfa Başlığı (Banner) -->
<section class="page-banner">
    <div class="container">
        <h2><?php echo esc_html(get_theme_mod('about_banner_title', 'Hakkımızda')); ?></h2>
    </div>
</section>

<!-- Hakkımızda Tek Paragraf İçerik Bölümü -->
<section class="about-single-page">
    <div class="container">
        <div class="about-paragraph-box">
            <p>
                <?php 
                $default_about_text = 'Fortuna Landscape olarak; doğayla insanı estetik, fonksiyonel ve sürdürülebilir bir çizgide buluşturma vizyonuyla yola çıktık. Peyzaj mimarlığı ve açık alan tasarımı alanında uzman kadromuzla, her projeye bir sanat eseri titizliğiyle yaklaşıyor, yaşam alanlarınıza ruh ve değer katıyoruz. Modern tasarım anlayışımızı çevreye duyarlı malzemeler ve yenilikçi çözümlerle harmanlayarak, yalnızca bugünün değil geleceğin de ihtiyaçlarına cevap veren zamansız mekanlar kurguluyoruz. Müşteri memnuniyetini ve kaliteyi her zaman odağımıza alarak, hayal ettiğiniz doğal ve estetik yaşam alanlarını gerçeğe dönüştürmek için tutkuyla çalışmaya devam ediyoruz.';
                
                echo nl2br(esc_html(get_theme_mod('about_content_text', $default_about_text))); 
                ?>
            </p>
        </div>
    </div>
</section>

<?php get_footer(); ?>