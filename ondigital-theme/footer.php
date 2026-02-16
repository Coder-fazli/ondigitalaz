<?php
/**
 * Theme Footer
 *
 * @package OnDigital
 */
?>

</main>

<!-- Footer -->
<div class="container large">
    <footer class="footer-area">
        <div class="container">
            <div class="footer-area-inner">

                <!-- Column 1: Logo + Description + Social -->
                <div class="footer-widget-wrapper">
                    <div class="footer-logo">
                        <?php if ( has_custom_logo() ) :
                            $logo_id = get_theme_mod( 'custom_logo' );
                            $logo_url = wp_get_attachment_image_url( $logo_id, 'full' );
                        ?>
                            <img src="<?php echo esc_url( $logo_url ); ?>" alt="<?php bloginfo( 'name' ); ?>">
                        <?php else : ?>
                            <h2 class="site-title"><?php bloginfo( 'name' ); ?></h2>
                        <?php endif; ?>
                    </div>
                    <p class="info-text"><?php echo esc_html( get_bloginfo( 'description' ) ); ?></p>
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
                    <h2 class="title"><?php esc_html_e( 'Services', 'ondigital' ); ?></h2>
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
                    <h2 class="title"><?php esc_html_e( 'Company', 'ondigital' ); ?></h2>
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
                    <h2 class="title"><?php esc_html_e( 'Newsletter', 'ondigital' ); ?></h2>
                    <div class="newsletter-text">
                        <p class="text"><?php esc_html_e( 'Feel free to reach out if you want to collaborate with us, or simply have a chat.', 'ondigital' ); ?></p>
                    </div>
                    <form action="#" class="subscribe-form" method="post">
                        <div class="input-field">
                            <span class="icon"><i class="fa-regular fa-envelope"></i></span>
                            <input type="email" name="email" placeholder="<?php esc_attr_e( 'Enter your email', 'ondigital' ); ?>" required>
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
                        <p class="text">
                            &copy; <?php echo date( 'Y' ); ?>
                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
                            <?php esc_html_e( 'Agency', 'ondigital' ); ?>
                        </p>
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
