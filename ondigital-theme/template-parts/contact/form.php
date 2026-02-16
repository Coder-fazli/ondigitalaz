<?php
/**
 * Contact - Form Section
 *
 * @package OnDigital
 */

$phone   = get_theme_mod( 'ondigital_phone', '+994 50 123 45 67' );
$email   = get_theme_mod( 'ondigital_email', 'info@ondigital.az' );
$address = get_theme_mod( 'ondigital_address', 'Bakı, Azərbaycan' );
?>
<section class="contact-area">
    <div class="container">
        <div class="contact-area-inner section-spacing">
            <div class="section-header">
                <div class="section-title-wrapper">
                    <div class="title-wrapper">
                        <h2 class="section-title large has_fade_anim">
                            <?php esc_html_e( 'Sizin üçün buradayıq!', 'ondigital' ); ?>
                        </h2>
                    </div>
                </div>
                <div class="text-wrapper">
                    <p class="text has_fade_anim">
                        <?php esc_html_e( 'Bazarda ən yaxşı istedadları, çevik idarəetmə və mükəmməl əməkdaşlıq təqdim edirik', 'ondigital' ); ?>
                    </p>
                </div>
            </div>
            <div class="section-content">
                <div class="info-box has_fade_anim">
                    <div class="text-wrapper">
                        <p class="text"><?php esc_html_e( 'Bizdən eşitmək istəyirik. Sizə necə kömək edə biləcəyimizi bilin!', 'ondigital' ); ?></p>
                    </div>
                    <ul class="contact-list">
                        <li><a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $phone ) ); ?>"><?php echo esc_html( $phone ); ?></a></li>
                        <li><a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a></li>
                        <li><?php echo esc_html( $address ); ?></li>
                    </ul>
                </div>
                <div class="contact-wrap has_fade_anim" data-delay="0.30">
                    <form action="#" method="post">
                        <?php wp_nonce_field( 'ondigital_contact', 'contact_nonce' ); ?>
                        <div class="contact-formwrap">
                            <div class="contact-formfield">
                                <input type="text" name="contact_name" id="contact_name" placeholder="<?php esc_attr_e( 'Ad*', 'ondigital' ); ?>" required>
                            </div>
                            <div class="contact-formfield">
                                <input type="email" name="contact_email" id="contact_email" placeholder="<?php esc_attr_e( 'Email*', 'ondigital' ); ?>" required>
                            </div>
                            <div class="contact-formfield">
                                <input type="tel" name="contact_phone" id="contact_phone" placeholder="<?php esc_attr_e( 'Telefon', 'ondigital' ); ?>">
                            </div>
                            <div class="contact-formfield">
                                <input type="text" name="contact_subject" id="contact_subject" placeholder="<?php esc_attr_e( 'Mövzu*', 'ondigital' ); ?>" required>
                            </div>
                            <div class="contact-formfield messages">
                                <input type="text" name="contact_message" id="contact_message" placeholder="<?php esc_attr_e( 'Mesaj*', 'ondigital' ); ?>" required>
                            </div>
                        </div>
                        <div class="submit-btn">
                            <button type="submit" class="wc-btn wc-btn-primary btn-text-flip">
                                <span data-text="<?php esc_attr_e( 'Mesaj Göndər', 'ondigital' ); ?>"><?php esc_html_e( 'Mesaj Göndər', 'ondigital' ); ?></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
