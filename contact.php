<?php 
/* Template Name: İletişim Sayfası */
get_header(); 
$wa_num = get_theme_mod('whatsapp_number', '905000000000');
?>

<section class="page-banner">
    <div class="container">
        <h2>İletişim</h2>
        <p>Hayalinizdeki peyzaj projesini birlikte hayata geçirelim.</p>
    </div>
</section>

<section class="contact-page">
    <div class="container">
        <div class="contact-wrapper">
            
            <div class="contact-info-card">
                <div class="card-header">
                    <h3>Bizimle İletişime Geçin</h3>
                </div>
                <div class="info-items">
                    
                    <!-- Adres (Aç/Kapat Kontrollü) -->
                    <?php if (get_theme_mod('show_address', true)) : ?>
                        <div class="info-item">
                            <div class="icon-box"><i class="fa-solid fa-location-dot"></i></div>
                            <div class="info-content">
                                <h4>Adres</h4>
                                <p><?php echo esc_html(get_theme_mod('contact_address', 'Atatürk Mah. Mimarlık Cad. No:12, İzmir')); ?></p>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Telefon (Aç/Kapat Kontrollü) -->
                    <?php if (get_theme_mod('show_phone', true)) : ?>
                        <div class="info-item">
                            <div class="icon-box"><i class="fa-solid fa-phone"></i></div>
                            <div class="info-content">
                                <h4>Telefon</h4>
                                <a href="tel:<?php echo esc_attr(get_theme_mod('contact_phone')); ?>"><?php echo esc_html(get_theme_mod('contact_phone', '+90 (232) 000 00 00')); ?></a>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- E-posta (Aç/Kapat Kontrollü) -->
                    <?php if (get_theme_mod('show_email', true)) : ?>
                        <div class="info-item">
                            <div class="icon-box"><i class="fa-solid fa-envelope"></i></div>
                            <div class="info-content">
                                <h4>E-posta</h4>
                                <a href="mailto:<?php echo esc_attr(get_theme_mod('contact_email')); ?>"><?php echo esc_html(get_theme_mod('contact_email', 'info@fortunalandscape.com')); ?></a>
                            </div>
                        </div>
                    <?php endif; ?>

                </div>
            </div>

            <!-- WhatsApp İletişim Kartı -->
            <div class="contact-whatsapp-card">
                <div class="whatsapp-card-icon"><i class="fa-brands fa-whatsapp"></i></div>
                <h3>WhatsApp ile Hızlı İletişim</h3>
                <p>Projeleriniz hakkında anında bilgi almak için bize ulaşabilirsiniz.</p>
                <a href="https://wa.me/<?php echo esc_attr($wa_num); ?>?text=Merhaba,%20projem%20hakk%C4%B1nda%20bilgi%20almak%20istiyorum." target="_blank" class="whatsapp-btn-large">
                    <i class="fa-brands fa-whatsapp"></i> WhatsApp'tan Yazın
                </a>
            </div>

        </div>
    </div>
</section>

<!-- Google Maps Bölümü (Aç/Kapat Kontrollü) -->
<?php if (get_theme_mod('show_map', true)) : ?>
    <section class="map-section">
        <div class="container">
            <div class="map-placeholder">
                <p>📍 Google Maps Konumu Burada Yer Alacak</p>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php get_footer(); ?>