<?php
/**
 * Services - Contact CTA Section
 *
 * @package OnDigital
 */

$services_cta_title    = ondigital_get_option( 'services_cta_title', 'Arolax ilə təcrübənizə başlayın' );
$services_cta_btn_text = ondigital_get_option( 'services_cta_btn_text', 'Əlaqə saxlayaq' );
$services_cta_btn_url  = ondigital_get_option( 'services_cta_btn_url' );
$services_cta_btn_url  = $services_cta_btn_url ? $services_cta_btn_url : home_url( '/elaqe/' );
$services_cta_shape    = ondigital_img( 'services_cta_shape', '/assets/imgs/shape/img-s-73.webp' );
?>
<section class="contact-area">
    <div class="container">
        <div class="contact-area-inner section-spacing">
            <div class="shape-1">
                <img src="<?php echo esc_url( $services_cta_shape ); ?>" alt="<?php esc_attr_e( 'dekor', 'ondigital' ); ?>">
            </div>
            <div class="section-content">
                <div class="section-title-wrapper">
                    <div class="title-wrapper">
                        <h2 class="section-title has_text_move_anim">
                            <?php echo wp_kses_post( $services_cta_title ); ?>
                        </h2>
                    </div>
                </div>
                <div class="btn-wrapper has_fade_anim">
                    <a href="<?php echo esc_url( $services_cta_btn_url ); ?>" class="wc-btn wc-btn-underline btn-text-flip">
                        <span data-text="<?php echo esc_attr( $services_cta_btn_text ); ?>"><?php echo esc_html( $services_cta_btn_text ); ?></span>
                        <img src="<?php echo esc_url( ONDIGITAL_URI . '/assets/imgs/icon/arrow-right-half-light.webp' ); ?>" alt="<?php esc_attr_e( 'ox', 'ondigital' ); ?>">
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
