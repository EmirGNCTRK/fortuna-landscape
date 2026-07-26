<!-- Sağ Alt Sabit WhatsApp Butonu -->
    <?php 
    $wa_phone = get_theme_mod('footer_whatsapp_phone', '905000000000');
    $wa_text  = get_theme_mod('footer_whatsapp_text', 'Merhaba, projem hakkında bilgi almak istiyorum.');
    if ($wa_phone) : 
    ?>
        <a href="https://wa.me/<?php echo esc_attr($wa_phone); ?>?text=<?php echo urlencode($wa_text); ?>" class="fixed-whatsapp" target="_blank" title="WhatsApp ile İletişime Geçin">
            <i class="fa-brands fa-whatsapp"></i>
        </a>
    <?php endif; ?>

    <!-- Footer Bölümü -->
    <footer>
        <div class="container footer-container">
            <!-- Logo ve Telif Bilgisi -->
            <div class="footer-brand">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="logo-container">
                    <?php 
                    $custom_logo_id = get_theme_mod('custom_logo');
                    $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
                    if (has_custom_logo()) : ?>
                        <img src="<?php echo esc_url($logo[0]); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" class="site-logo small">
                    <?php else : ?>
                        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/mini logo.jpeg" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" class="site-logo small">
                    <?php endif; ?>
                    <span class="logo-text"><?php bloginfo('name'); ?></span>
                </a>
                <p class="copyright">
                    &copy; <?php echo date('Y'); ?> <?php echo esc_html(get_theme_mod('footer_copyright', 'Fortuna Landscape. Tüm hakları saklıdır.')); ?>
                </p>
            </div>

            <!-- Hızlı Menü Linkleri -->
            <?php if (get_theme_mod('show_footer_nav', true)) : ?>
            <div class="footer-nav">
                <?php
                if (has_nav_menu('footer-menu')) {
                    wp_nav_menu(array(
                        'theme_location' => 'footer-menu',
                        'container'      => false,
                        'depth'          => 1, // Footer menüsü genelde tek seviye olur
                        'fallback_cb'    => false,
                    ));
                } else {
                    // Panelden henüz menü atanmamışsa görünecek varsayılan yedek linkler
                    echo '<ul>';
                    echo '<li><a href="' . esc_url(home_url('/')) . '">Anasayfa</a></li>';
                    echo '<li><a href="' . esc_url(home_url('/hakkimizda/')) . '">Hakkımızda</a></li>';
                    echo '<li><a href="' . esc_url(home_url('/iletisim/')) . '">İletişim</a></li>';
                    echo '</ul>';
                }
                ?>
            </div>
            <?php endif; ?>

            <!-- Sosyal Medya İkon Linkleri -->
            <div class="footer-social">
                
                <?php if (get_theme_mod('show_social_instagram', true)) : ?>
                    <a href="<?php echo esc_url(get_theme_mod('social_instagram', 'https://instagram.com')); ?>" target="_blank" rel="noopener noreferrer" class="social-icon instagram" title="Instagram">
                        <i class="fa-brands fa-instagram"></i>
                    </a>
                <?php endif; ?>

                <?php if (get_theme_mod('show_social_facebook', true)) : ?>
                    <a href="<?php echo esc_url(get_theme_mod('social_facebook', 'https://facebook.com')); ?>" target="_blank" rel="noopener noreferrer" class="social-icon facebook" title="Facebook">
                        <i class="fa-brands fa-facebook-f"></i>
                    </a>
                <?php endif; ?>

                <?php if (get_theme_mod('show_social_linkedin', true)) : ?>
                    <a href="<?php echo esc_url(get_theme_mod('social_linkedin', 'https://linkedin.com')); ?>" target="_blank" rel="noopener noreferrer" class="social-icon linkedin" title="LinkedIn">
                        <i class="fa-brands fa-linkedin-in"></i>
                    </a>
                <?php endif; ?>

                <?php if (get_theme_mod('show_social_twitter', true)) : ?>
                    <a href="<?php echo esc_url(get_theme_mod('social_twitter', 'https://x.com')); ?>" target="_blank" rel="noopener noreferrer" class="social-icon x-twitter" title="X (Twitter)">
                        <i class="fa-brands fa-x-twitter"></i>
                    </a>
                <?php endif; ?>

                <?php if (get_theme_mod('show_social_pinterest', true)) : ?>
                    <a href="<?php echo esc_url(get_theme_mod('social_pinterest', 'https://pinterest.com')); ?>" target="_blank" rel="noopener noreferrer" class="social-icon pinterest" title="Pinterest">
                        <i class="fa-brands fa-pinterest-p"></i>
                    </a>
                <?php endif; ?>

            </div>
        </div>
    </footer>

    <?php wp_footer(); ?>
</body>
</html>