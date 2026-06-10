<?php
/**
 * Theme Footer
 *
 * @package OnDigital
 */

// Brand column
$footer_tagline      = ondigital_get_option( 'footer_tagline', 'Adapt to the digital age with Ondigital!' );
$footer_partner_label = ondigital_get_option( 'footer_partner_label', 'Partner with' );
$footer_partner_badge = ondigital_get_option( 'footer_partner_badge', '' );

// Quick links column
$footer_quick_links_title = ondigital_get_option( 'footer_quick_links_title', 'Quick Links' );
$footer_quick_links       = ondigital_get_repeater( 'footer_quick_links', array() );
if ( empty( $footer_quick_links ) ) {
    $footer_quick_links = array(
        array( 'label' => __( 'About', 'ondigital' ),    'url' => home_url( '/about' ) ),
        array( 'label' => __( 'Services', 'ondigital' ), 'url' => home_url( '/services' ) ),
        array( 'label' => __( 'Projects', 'ondigital' ), 'url' => home_url( '/projects' ) ),
        array( 'label' => __( 'Blog', 'ondigital' ),     'url' => home_url( '/blog' ) ),
        array( 'label' => __( 'Contact', 'ondigital' ),  'url' => home_url( '/contact' ) ),
    );
}

// Services links column
$footer_services_col_title = ondigital_get_option( 'footer_services_col_title', 'Services' );
$footer_services_links     = ondigital_get_repeater( 'footer_services_links', array() );
if ( empty( $footer_services_links ) ) {
    $footer_services_links = array(
        array( 'label' => __( 'Digital Marketing', 'ondigital' ),     'url' => home_url( '/services' ) ),
        array( 'label' => __( 'SEO', 'ondigital' ),                   'url' => home_url( '/services' ) ),
        array( 'label' => __( 'Social Media Marketing', 'ondigital' ),'url' => home_url( '/services' ) ),
        array( 'label' => __( 'Web Development', 'ondigital' ),       'url' => home_url( '/services' ) ),
        array( 'label' => __( 'Branding & Design', 'ondigital' ),     'url' => home_url( '/services' ) ),
        array( 'label' => __( 'Email Marketing', 'ondigital' ),       'url' => home_url( '/services' ) ),
    );
}

// Contact column
$footer_contact_title   = ondigital_get_option( 'footer_contact_title', 'Contact' );
$footer_social_title    = ondigital_get_option( 'footer_social_title', 'Social Media' );
$footer_contact_phone   = ondigital_get_option( 'phone', '+994 (55) 431 47 50' );
$footer_contact_email   = ondigital_get_option( 'email', 'office@ondigital.az' );
$footer_contact_address = ondigital_get_option( 'address', 'Old Town Plaza, 10th floor, #1007. 123 Bashir Safaroglu St, Baku' );

// Copyright bar
$footer_copyright  = ondigital_get_option( 'footer_copyright', 'Copyright <strong>OnDigital</strong> ' . date( 'Y' ) );
$footer_terms_text = ondigital_get_option( 'footer_terms_text', 'Terms & Conditions' );
$footer_terms_url  = ondigital_get_option( 'footer_terms_url', home_url( '/privacy-policy' ) );
?>

</main>

<footer class="footer-area">
    <div class="footer-area-inner">

        <!-- Column 1: Brand -->
        <div class="footer-widget-wrapper footer-col-brand">
            <div class="footer-logo">
                <?php
                $footer_logo_id  = ondigital_get_option( 'footer_logo' );
                $footer_logo_url = $footer_logo_id ? wp_get_attachment_image_url( $footer_logo_id, 'full' ) : '';

                if ( $footer_logo_url ) : ?>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <img src="<?php echo esc_url( $footer_logo_url ); ?>" alt="<?php bloginfo( 'name' ); ?>" style="max-width:160px;height:auto;">
                    </a>
                <?php elseif ( has_custom_logo() ) :
                    $logo_id    = get_theme_mod( 'custom_logo' );
                    $logo_url   = wp_get_attachment_image_url( $logo_id, 'full' );
                    $logo_w     = absint( get_theme_mod( 'ondigital_logo_width', 150 ) );
                    $logo_h     = absint( get_theme_mod( 'ondigital_logo_height', 0 ) );
                    $logo_style = 'width:' . $logo_w . 'px;height:' . ( $logo_h ? $logo_h . 'px' : 'auto' ) . ';';
                ?>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <img src="<?php echo esc_url( $logo_url ); ?>" alt="<?php bloginfo( 'name' ); ?>" style="<?php echo esc_attr( $logo_style ); ?>">
                    </a>
                <?php else : ?>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <h2 class="site-title"><?php bloginfo( 'name' ); ?></h2>
                    </a>
                <?php endif; ?>
            </div>

            <?php if ( $footer_tagline ) : ?>
                <p class="info-text"><?php echo esc_html( $footer_tagline ); ?></p>
            <?php endif; ?>

        </div>

        <!-- Column 2: Quick Links -->
        <div class="footer-widget-wrapper footer-col-quicklinks">
            <h2 class="title"><?php echo esc_html( $footer_quick_links_title ); ?></h2>
            <?php if ( ! empty( $footer_quick_links ) ) : ?>
                <ul class="footer-nav-list">
                    <?php foreach ( $footer_quick_links as $link ) :
                        if ( empty( $link['label'] ) ) continue;
                    ?>
                        <li>
                            <?php if ( ! empty( $link['url'] ) ) : ?>
                                <a href="<?php echo esc_url( $link['url'] ); ?>"><?php echo esc_html( $link['label'] ); ?></a>
                            <?php else : ?>
                                <?php echo esc_html( $link['label'] ); ?>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>

        <!-- Column 3: Services Links -->
        <div class="footer-widget-wrapper footer-col-services">
            <h2 class="title"><?php echo esc_html( $footer_services_col_title ); ?></h2>
            <?php if ( ! empty( $footer_services_links ) ) : ?>
                <ul class="footer-nav-list">
                    <?php foreach ( $footer_services_links as $link ) :
                        if ( empty( $link['label'] ) ) continue;
                    ?>
                        <li>
                            <?php if ( ! empty( $link['url'] ) ) : ?>
                                <a href="<?php echo esc_url( $link['url'] ); ?>"><?php echo esc_html( $link['label'] ); ?></a>
                            <?php else : ?>
                                <?php echo esc_html( $link['label'] ); ?>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>

        <!-- Column 4: Contact -->
        <div class="footer-widget-wrapper footer-col-contact">
            <h2 class="title"><?php echo esc_html( $footer_contact_title ); ?></h2>
            <ul class="footer-nav-list footer-contact-info">
                <?php if ( $footer_contact_phone ) : ?>
                    <li>
                        <i class="fa-solid fa-phone"></i>
                        <a href="tel:<?php echo esc_attr( preg_replace( '/\s+/', '', $footer_contact_phone ) ); ?>"><?php echo esc_html( $footer_contact_phone ); ?></a>
                    </li>
                <?php endif; ?>
                <?php if ( $footer_contact_email ) : ?>
                    <li>
                        <i class="fa-solid fa-envelope"></i>
                        <a href="mailto:<?php echo esc_attr( $footer_contact_email ); ?>"><?php echo esc_html( $footer_contact_email ); ?></a>
                    </li>
                <?php endif; ?>
                <?php if ( $footer_contact_address ) : ?>
                    <li>
                        <i class="fa-solid fa-location-dot"></i>
                        <span><?php echo esc_html( $footer_contact_address ); ?></span>
                    </li>
                <?php endif; ?>
            </ul>
            <?php /* Social shown here on DESKTOP only (inside contact column) */ ?>
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
                'whatsapp'  => 'fa-whatsapp',
            );
            ?>
            <div class="footer-social-in-contact">
                <p class="footer-social-title"><?php echo esc_html( $footer_social_title ); ?></p>
                <ul class="social-links">
                    <?php foreach ( $social_links as $platform => $url ) :
                        $icon = $social_icons[ $platform ] ?? '';
                        if ( ! $icon ) continue;
                    ?>
                        <li><a href="<?php echo esc_url( $url ); ?>" target="_blank" rel="noopener noreferrer"><i class="fa-brands <?php echo esc_attr( $icon ); ?>"></i></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>

        <?php /* Social shown here on MOBILE only (full-width row) */ ?>
        <div class="footer-col-social">
            <p class="footer-social-title"><?php echo esc_html( $footer_social_title ); ?></p>
            <ul class="social-links">
                <?php foreach ( $social_links as $platform => $url ) :
                    $icon = $social_icons[ $platform ] ?? '';
                    if ( ! $icon ) continue;
                ?>
                    <li><a href="<?php echo esc_url( $url ); ?>" target="_blank" rel="noopener noreferrer"><i class="fa-brands <?php echo esc_attr( $icon ); ?>"></i></a></li>
                <?php endforeach; ?>
            </ul>
        </div>

    </div>

    <!-- Copyright bar -->
    <div class="copyright-area">
        <div class="copyright-area-inner">
            <div class="copyright-text">
                <p class="text"><?php echo wp_kses_post( $footer_copyright ); ?></p>
            </div>
            <?php if ( $footer_terms_text ) : ?>
                <div class="copyright-terms">
                    <?php if ( $footer_terms_url ) : ?>
                        <a href="<?php echo esc_url( $footer_terms_url ); ?>"><?php echo esc_html( $footer_terms_text ); ?></a>
                    <?php else : ?>
                        <span><?php echo esc_html( $footer_terms_text ); ?></span>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</footer>

</div><!-- .body-wrapper -->
</div><!-- #smooth-content -->
</div><!-- #smooth-wrapper -->

<?php wp_footer(); ?>
</body>
</html>
