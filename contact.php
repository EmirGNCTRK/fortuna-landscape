<?php
/*
Template Name: İletişim Sayfası
*/

get_header(); ?>

<!-- Sayfa Başlığı (Banner) -->
<?php if (get_theme_mod('show_contact_banner', true)) : ?>
<section class="page-banner">
    <div class="container">
        <h2><?php echo esc_html(get_theme_mod('contact_banner_title', 'İletişim')); ?></h2>
        <p><?php echo esc_html(get_theme_mod('contact_banner_subtitle', 'Hayalinizdeki peyzaj projesini birlikte hayata geçirelim.')); ?></p>
    </div>
</section>
<?php endif; ?>

<!-- İletişim İçerik Bölümü -->
<section class="contact-page">
    <div class="container">
        <div class="contact-wrapper">
            
            <!-- Sol Taraf: İletişim Bilgileri -->
            <?php if (get_theme_mod('show_contact_info_card', true)) : ?>
            <div class="contact-info-card">
                <div class="card-header">
                    <h3><?php echo esc_html(get_theme_mod('contact_info_card_title', 'Bizimle İletişime Geçin')); ?></h3>
                    <p><?php echo esc_html(get_theme_mod('contact_info_card_desc', 'Projeleriniz, danışmanlık talepleriniz veya sorularınız için doğrudan bize ulaşabilirsiniz.')); ?></p>
                </div>
                
                <div class="info-items">
                    <!-- Adres -->
                    <?php if (get_theme_mod('show_contact_address', true)) : ?>
                    <div class="info-item">
                        <div class="icon-box">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <div class="info-content">
                            <h4><?php echo esc_html(get_theme_mod('contact_address_label', 'Adres')); ?></h4>
                            <a href="<?php echo esc_url(get_theme_mod('contact_address_url', 'https://maps.google.com/?q=Atatürk+Mah.+Mimarlık+Cad.+No:12,+İzmir')); ?>" target="_blank" rel="noopener noreferrer">
                                <?php echo esc_html(get_theme_mod('contact_address_text', 'Atatürk Mah. Mimarlık Cad. No:12, İzmir / Türkiye')); ?>
                            </a>
                        </div>
                    </div>
                    <?php endif; ?>

                    <!-- Telefon -->
                    <?php if (get_theme_mod('show_contact_phone', true)) : ?>
                    <div class="info-item">
                        <div class="icon-box">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                        <div class="info-content">
                            <h4><?php echo esc_html(get_theme_mod('contact_phone_label', 'Telefon')); ?></h4>
                            <a href="tel:<?php echo esc_attr(get_theme_mod('contact_phone_raw', '+902320000000')); ?>">
                                <?php echo esc_html(get_theme_mod('contact_phone_text', '+90 (232) 000 00 00')); ?>
                            </a>
                        </div>
                    </div>
                    <?php endif; ?>

                    <!-- E-posta -->
                    <?php if (get_theme_mod('show_contact_email', true)) : ?>
                    <div class="info-item">
                        <div class="icon-box">
                            <i class="fa-solid fa-envelope"></i>
                        </div>
                        <div class="info-content">
                            <h4><?php echo esc_html(get_theme_mod('contact_email_label', 'E-posta')); ?></h4>
                            <a href="mailto:<?php echo esc_attr(get_theme_mod('contact_email_text', 'info@fortunalandscape.com')); ?>">
                                <?php echo esc_html(get_theme_mod('contact_email_text', 'info@fortunalandscape.com')); ?>
                            </a>
                        </div>
                    </div>
                    <?php endif; ?>

                    <!-- Çalışma Saatleri -->
                    <?php if (get_theme_mod('show_contact_hours', true)) : ?>
                    <div class="info-item">
                        <div class="icon-box">
                            <i class="fa-regular fa-clock"></i>
                        </div>
                        <div class="info-content">
                            <h4><?php echo esc_html(get_theme_mod('contact_hours_label', 'Çalışma Saatleri')); ?></h4>
                            <p>
                                <?php echo esc_html(get_theme_mod('contact_hours_text_1', 'Pazartesi - Cumartesi: 09:00 - 18:00')); ?><br>
                                <span><?php echo esc_html(get_theme_mod('contact_hours_text_2', 'Pazar: Kapalı')); ?></span>
                            </p>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>

            <!-- Sağ Taraf: WhatsApp İletişim Kartı -->
            <?php if (get_theme_mod('show_contact_whatsapp_card', true)) : ?>
            <div class="contact-whatsapp-card">
                <div class="whatsapp-card-icon">
                    <i class="fa-brands fa-whatsapp"></i>
                </div>
                <h3><?php echo esc_html(get_theme_mod('contact_wa_card_title', 'WhatsApp ile Hızlı İletişim')); ?></h3>
                <p><?php echo esc_html(get_theme_mod('contact_wa_card_desc', 'Projeleriniz hakkında anında bilgi almak, keşif talebinde bulunmak veya sorularınızı iletmek için bize WhatsApp üzerinden doğrudan ulaşabilirsiniz.')); ?></p>
                
                <?php 
                $wa_phone = get_theme_mod('contact_wa_card_phone', '905000000000');
                $wa_text  = get_theme_mod('contact_wa_card_msg', 'Merhaba, projem hakkında bilgi almak istiyorum.');
                ?>
                <a href="https://wa.me/<?php echo esc_attr($wa_phone); ?>?text=<?php echo urlencode($wa_text); ?>" target="_blank" class="whatsapp-btn-large">
                    <i class="fa-brands fa-whatsapp"></i> <?php echo esc_html(get_theme_mod('contact_wa_card_btn_text', 'WhatsApp\'tan Yazın')); ?>
                </a>
            </div>
            <?php endif; ?>

        </div>
    </div>
</section>

<!-- Harita Bölümü -->
<?php if (get_theme_mod('show_contact_map', true)) : ?>
<section class="map-section">
    <div class="container">
        <?php 
        $map_iframe = get_theme_mod('contact_map_iframe_code', '');
        if (!empty($map_iframe)) : 
            echo $map_iframe;
        else : 
        ?>
            <div class="map-placeholder">
                <p>📍 Google Maps Konumu Burada Yer Alacak</p>
            </div>
        <?php endif; ?>
    </div>
</section>
<?php endif; ?>

<?php get_footer(); ?>