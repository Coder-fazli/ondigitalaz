<?php
/**
 * Theme Footer
 *
 * @package OnDigital
 */

$lang = function_exists( 'pll_current_language' ) ? pll_current_language() : 'az';

// Brand column
$footer_tagline      = ondigital_get_option( 'footer_tagline_' . $lang, 'Ondigital ilə rəqəmsal dövrə uyğunlaşın!' );
$footer_partner_label = ondigital_get_option( 'footer_partner_label_' . $lang, 'Partner with' );
$footer_partner_badge = ondigital_get_option( 'footer_partner_badge', '' );

// Quick links column
$footer_quick_links_title = ondigital_get_option( 'footer_quick_links_title_' . $lang, 'Sürətli keçidlər' );
$footer_quick_links       = ondigital_get_repeater( 'footer_quick_links', array() );
if ( empty( $footer_quick_links ) ) {
    $footer_quick_links = array(
        array( 'label' => __( 'Haqqımızda', 'ondigital' ), 'url' => home_url( '/about' ) ),
        array( 'label' => __( 'Xidmətlər', 'ondigital' ),  'url' => home_url( '/services' ) ),
        array( 'label' => __( 'Layihələr', 'ondigital' ),  'url' => home_url( '/projects' ) ),
        array( 'label' => __( 'Bloq', 'ondigital' ),       'url' => home_url( '/blog' ) ),
        array( 'label' => __( 'Əlaqə', 'ondigital' ),      'url' => home_url( '/contact' ) ),
    );
}

// Services links column
$footer_services_col_title = ondigital_get_option( 'footer_services_col_title_' . $lang, 'Xidmətlər' );
$footer_services_links     = ondigital_get_repeater( 'footer_services_links', array() );
if ( empty( $footer_services_links ) ) {
    $footer_services_links = array(
        array( 'label' => __( 'Rəqəmsal Marketinq', 'ondigital' ),     'url' => home_url( '/services' ) ),
        array( 'label' => __( 'SEO Xidməti', 'ondigital' ),            'url' => home_url( '/services' ) ),
        array( 'label' => __( 'Sosial Media Marketinq', 'ondigital' ), 'url' => home_url( '/services' ) ),
        array( 'label' => __( 'Web Development', 'ondigital' ),        'url' => home_url( '/services' ) ),
        array( 'label' => __( 'Brendinq & Dizayn', 'ondigital' ),      'url' => home_url( '/services' ) ),
        array( 'label' => __( 'Email marketinq', 'ondigital' ),        'url' => home_url( '/services' ) ),
    );
}

// Contact column
$footer_contact_title  = ondigital_get_option( 'footer_contact_title_' . $lang, 'Əlaqə' );
$footer_social_title   = ondigital_get_option( 'footer_social_title_' . $lang, 'Sosial media' );
$footer_contact_phone  = ondigital_get_option( 'contact_phone', '' );
$footer_contact_email  = ondigital_get_option( 'contact_email', '' );
$footer_contact_address = ondigital_get_option( 'contact_address_' . $lang, '' );

// Copyright bar
$footer_copyright  = ondigital_get_option( 'footer_copyright_' . $lang, 'Copyright <strong>OnDigital</strong> ' . date( 'Y' ) );
$footer_terms_text = ondigital_get_option( 'footer_terms_text_' . $lang, 'Terms & Conditions' );
$footer_terms_url  = ondigital_get_option( 'footer_terms_url_' . $lang, '' );
?>

</main>

<footer class="footer-area">
    <div class="footer-area-inner">

        <!-- Column 1: Brand + Partner -->
        <div class="footer-widget-wrapper footer-col-brand">
            <div class="footer-logo">
                <?php if ( has_custom_logo() ) :
                    $logo_id    = get_theme_mod( 'custom_logo' );
                    $logo_url   = wp_get_attachment_image_url( $logo_id, 'full' );
                    $logo_w     = absint( get_theme_mod( 'ondigital_logo_width', 150 ) );
                    $logo_h     = absint( get_theme_mod( 'ondigital_logo_height', 0 ) );
                    $logo_style = 'width:' . $logo_w . 'px;height:' . ( $logo_h ? $logo_h . 'px' : 'auto' ) . ';';
                ?>
                    <img src="<?php echo esc_url( $logo_url ); ?>" alt="<?php bloginfo( 'name' ); ?>" style="<?php echo esc_attr( $logo_style ); ?>">
                <?php else : ?>
                    <h2 class="site-title"><?php bloginfo( 'name' ); ?></h2>
                <?php endif; ?>
            </div>

            <?php if ( $footer_tagline ) : ?>
                <p class="info-text"><?php echo esc_html( $footer_tagline ); ?></p>
            <?php endif; ?>

            <?php if ( $footer_partner_label || $footer_partner_badge ) : ?>
                <div class="footer-partner">
                    <?php if ( $footer_partner_label ) : ?>
                        <span class="footer-partner-label"><?php echo esc_html( $footer_partner_label ); ?></span>
                    <?php endif; ?>
                    <?php if ( $footer_partner_badge ) :
                        $badge_url = wp_get_attachment_image_url( $footer_partner_badge, 'medium' );
                        if ( $badge_url ) : ?>
                            <img src="<?php echo esc_url( $badge_url ); ?>" alt="<?php esc_attr_e( 'Partner Badge', 'ondigital' ); ?>" class="footer-partner-badge">
                        <?php endif;
                    endif; ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- Column 2: Quick Links -->
        <div class="footer-widget-wrapper">
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
        <div class="footer-widget-wrapper">
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

        <!-- Column 4: Contact + Social -->
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

            <p class="footer-social-title"><?php echo esc_html( $footer_social_title ); ?></p>
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
                    if ( ! $icon ) continue;
                ?>
                    <li>
                        <a href="<?php echo esc_url( $url ); ?>" target="_blank" rel="noopener noreferrer">
                            <i class="fa-brands <?php echo esc_attr( $icon ); ?>"></i>
                        </a>
                    </li>
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
