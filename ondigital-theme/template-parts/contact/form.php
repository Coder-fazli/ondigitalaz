<?php
/**
 * Contact - Form Section
 *
 * @package OnDigital
 */

$phone   = get_theme_mod( 'ondigital_phone', '+994 50 123 45 67' );
$email   = get_theme_mod( 'ondigital_email', 'info@ondigital.az' );
$address = get_theme_mod( 'ondigital_address', 'Bakı, Azərbaycan' );

$social_linkedin  = get_theme_mod( 'ondigital_linkedin', '#' );
$social_instagram = get_theme_mod( 'ondigital_instagram', '#' );
$social_facebook  = get_theme_mod( 'ondigital_facebook', '#' );
?>
<section class="contact-section">
    <div class="contact-section-inner">
        <div class="contact-card">

            <!-- Left: Info panel -->
            <div class="contact-info-panel">
                <h2><?php esc_html_e( 'Əlaqə', 'ondigital' ); ?><br><em><?php esc_html_e( 'Məlumatları', 'ondigital' ); ?></em></h2>
                <p class="contact-info-desc"><?php esc_html_e( 'Bizdən eşitmək istəyirik. Sizə necə kömək edə biləcəyimizi bilin!', 'ondigital' ); ?></p>

                <div class="contact-info-item">
                    <div class="contact-info-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#00FFA3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 11.5a19.79 19.79 0 01-3.07-8.67A2 2 0 012 .84h3a2 2 0 012 1.72c.13.96.36 1.9.7 2.81a2 2 0 01-.45 2.11L6.09 8.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.91.34 1.85.57 2.81.7A2 2 0 0122 16.92z"/></svg>
                    </div>
                    <div class="contact-info-text">
                        <span class="contact-info-label"><?php esc_html_e( 'Telefon', 'ondigital' ); ?></span>
                        <span class="contact-info-value"><a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $phone ) ); ?>"><?php echo esc_html( $phone ); ?></a></span>
                    </div>
                </div>

                <div class="contact-info-item">
                    <div class="contact-info-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#00FFA3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                    </div>
                    <div class="contact-info-text">
                        <span class="contact-info-label"><?php esc_html_e( 'E-mail', 'ondigital' ); ?></span>
                        <span class="contact-info-value"><a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a></span>
                    </div>
                </div>

                <div class="contact-info-item">
                    <div class="contact-info-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#00FFA3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    </div>
                    <div class="contact-info-text">
                        <span class="contact-info-label"><?php esc_html_e( 'Ünvan', 'ondigital' ); ?></span>
                        <span class="contact-info-value"><?php echo esc_html( $address ); ?></span>
                    </div>
                </div>

                <div class="contact-info-divider"></div>

                <div class="contact-info-socials">
                    <?php if ( $social_linkedin && $social_linkedin !== '#' ) : ?>
                    <a href="<?php echo esc_url( $social_linkedin ); ?>" class="contact-social-btn" title="LinkedIn" target="_blank" rel="noopener noreferrer">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6z"/><rect x="2" y="9" width="4" height="12"/><circle cx="4" cy="4" r="2"/></svg>
                    </a>
                    <?php endif; ?>
                    <?php if ( $social_instagram && $social_instagram !== '#' ) : ?>
                    <a href="<?php echo esc_url( $social_instagram ); ?>" class="contact-social-btn" title="Instagram" target="_blank" rel="noopener noreferrer">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5"/><path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
                    </a>
                    <?php endif; ?>
                    <?php if ( $social_facebook && $social_facebook !== '#' ) : ?>
                    <a href="<?php echo esc_url( $social_facebook ); ?>" class="contact-social-btn" title="Facebook" target="_blank" rel="noopener noreferrer">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"/></svg>
                    </a>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Right: Form panel -->
            <div class="contact-form-panel">
                <?php
                if ( function_exists( 'odf_render_contact_page_inline' ) ) {
                    odf_render_contact_page_inline();
                }
                ?>
            </div>

        </div>
    </div>
</section>
