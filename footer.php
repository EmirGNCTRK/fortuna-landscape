<!-- MERKEZİ SABİT WHATSAPP BUTONU -->
    <?php $wa_num = get_theme_mod('whatsapp_number', '905000000000'); ?>
    <a href="https://wa.me/<?php echo esc_attr($wa_num); ?>?text=Merhaba,%20projem%20hakk%C4%B1nda%20bilgi%20almak%20istiyorum." class="fixed-whatsapp" target="_blank" title="WhatsApp ile İletişime Geçin">
        <i class="fa-brands fa-whatsapp"></i>
    </a>

    <!-- FOOTER -->
    <footer>
        <div class="container footer-container">
            <div class="footer-brand">
                <a href="<?php echo home_url(); ?>" class="logo-container">
                    <span class="logo-text"><?php bloginfo('name'); ?></span>
                </a>
                <p class="copyright">&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. Tüm hakları saklıdır.</p>
            </div>

            <div class="footer-nav">
                <?php 
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'container' => false
                )); 
                ?>
            </div>

            <!-- DİNAMİK SOSYAL MEDYA İKONLARI -->
            <?php if (get_theme_mod('show_footer_icons', true)) : ?>
                <div class="footer-social">
                    <?php 
                    $socials = array(
                        'instagram' => 'fa-instagram',
                        'facebook'  => 'fa-facebook-f',
                        'linkedin'  => 'fa-linkedin-in',
                        'x_twitter' => 'fa-x-twitter',
                        'pinterest' => 'fa-pinterest-p'
                    );

                    foreach ($socials as $key => $icon) :
                        $url = get_theme_mod("social_{$key}");
                        if (!empty($url)) : ?>
                            <a href="<?php echo esc_url($url); ?>" target="_blank" class="social-icon <?php echo esc_attr($key); ?>">
                                <i class="fa-brands <?php echo esc_attr($icon); ?>"></i>
                            </a>
                        <?php endif;
                    endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </footer>

    <?php wp_footer(); ?>
</body>
</html>