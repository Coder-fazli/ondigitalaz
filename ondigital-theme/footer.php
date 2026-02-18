<?php
/**
 * Theme Footer
 *
 * @package OnDigital
 */

$footer_info_text       = ondigital_get_option( 'footer_info_text', 'OnDigital rəqəmsal marketinq agentliyidir' );
$footer_services_title  = ondigital_get_option( 'footer_services_title', 'Xidmətlər' );
$footer_company_title   = ondigital_get_option( 'footer_company_title', 'Şirkət' );
$footer_newsletter_title = ondigital_get_option( 'footer_newsletter_title', 'Xəbər bülleteni' );
$footer_newsletter_text  = ondigital_get_option( 'footer_newsletter_text', 'Bizimlə əməkdaşlıq etmək və ya sadəcə söhbət etmək istəyirsinizsə, sizindən xəbər almaqdan məmnun olarıq.' );
$footer_copyright        = ondigital_get_option( 'footer_copyright', '© ' . date( 'Y' ) . ' OnDigital Agency. Bütün hüquqlar qorunur.' );
?>

</main>

<div class="container large">
    <footer class="footer-area">
        <div class="container">
            <div class="footer-area-inner">

                <!-- Column 1: Logo + Description + Social -->
                <div class="footer-widget-wrapper">
                    <div class="footer-logo">
                        <?php if ( has_custom_logo() ) :
                            $logo_id  = get_theme_mod( 'custom_logo' );
                            $logo_url = wp_get_attachment_image_url( $logo_id, 'full' );
                            $logo_w   = absint( get_theme_mod( 'ondigital_logo_width', 150 ) );
                            $logo_h   = absint( get_theme_mod( 'ondigital_logo_height', 0 ) );
                            $logo_style = 'width:' . $logo_w . 'px;height:' . ( $logo_h ? $logo_h . 'px' : 'auto' ) . ';';
                        ?>
                            <img src="<?php echo esc_url( $logo_url ); ?>" alt="<?php bloginfo( 'name' ); ?>" style="<?php echo esc_attr( $logo_style ); ?>">
                        <?php else : ?>
                            <h2 class="site-title"><?php bloginfo( 'name' ); ?></h2>
                        <?php endif; ?>
                    </div>
                    <p class="info-text"><?php echo esc_html( $footer_info_text ); ?></p>
                    <ul class="social-links">
                        <?php
                        $social_links = ondigital_get_social_links();
                        $social_icons = array(
                            'facebook'  => 'fa-facebook-f',
                            'instagram' => 'fa-instagram',
                            'linkedin'  => 'fa-linkedin-in',
                            'tiktok'    => 'fa-tiktok',
                            'youtube'   => 'fa-youtube',
                            'behance'   => 'fa-behance',
                            'pinterest' => 'fa-pinterest-p',
                        );
                        foreach ( $social_links as $platform => $url ) :
                            $icon = $social_icons[ $platform ] ?? '';
                        ?>
                            <li>
                                <a href="<?php echo esc_url( $url ); ?>" target="_blank" rel="noopener noreferrer">
                                    <i class="fa-brands <?php echo esc_attr( $icon ); ?>"></i>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <!-- Column 2: Service Links -->
                <div class="footer-widget-wrapper">
                    <h2 class="title"><?php echo esc_html( $footer_services_title ); ?></h2>
                    <?php
                    wp_nav_menu( array(
                        'theme_location' => 'services',
                        'container'      => false,
                        'menu_class'     => 'footer-nav-list',
                        'fallback_cb'    => false,
                        'depth'          => 1,
                    ) );
                    ?>
                </div>

                <!-- Column 3: Company Links -->
                <div class="footer-widget-wrapper">
                    <h2 class="title"><?php echo esc_html( $footer_company_title ); ?></h2>
                    <?php
                    wp_nav_menu( array(
                        'theme_location' => 'footer',
                        'container'      => false,
                        'menu_class'     => 'footer-nav-list',
                        'fallback_cb'    => false,
                        'depth'          => 1,
                    ) );
                    ?>
                </div>

                <!-- Column 4: Newsletter -->
                <div class="footer-widget-wrapper newsletter">
                    <h2 class="title"><?php echo esc_html( $footer_newsletter_title ); ?></h2>
                    <div class="newsletter-text">
                        <p class="text"><?php echo esc_html( $footer_newsletter_text ); ?></p>
                    </div>
                    <form action="#" class="subscribe-form" method="post">
                        <div class="input-field">
                            <span class="icon"><i class="fa-regular fa-envelope"></i></span>
                            <input type="email" name="email" placeholder="<?php esc_attr_e( 'E-poçt ünvanınız', 'ondigital' ); ?>" required>
                            <button type="submit" class="subscribe-btn"><i class="fa-solid fa-paper-plane"></i></button>
                        </div>
                    </form>
                </div>

            </div>
        </div>

        <!-- Copyright -->
        <div class="copyright-area">
            <div class="container">
                <div class="copyright-area-inner">
                    <div class="copyright-text">
                        <p class="text"><?php echo wp_kses_post( $footer_copyright ); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>

</div><!-- .body-wrapper -->
</div><!-- #smooth-content -->
</div><!-- #smooth-wrapper -->

<?php wp_footer(); ?>
</body>
</html>
