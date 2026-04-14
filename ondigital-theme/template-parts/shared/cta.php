<?php
/**
 * Shared - CTA Section
 *
 * @package OnDigital
 */

$cta_title    = ondigital_get_option( 'cta_title', 'Have an idea in your mind? Let\'s <span>make</span> something great together' );
$cta_btn_text = ondigital_get_option( 'cta_btn_text', "Let's get in touch" );
$cta_btn_url  = ondigital_get_option( 'cta_btn_url' );
$cta_btn_url  = $cta_btn_url ? $cta_btn_url : home_url( '/elaqe/' );
?>
<section class="cta-area">
    <div class="container">
        <div class="cta-area-inner section-spacing">
            <div class="section-header">
                <div class="section-title-wrapper">
                    <div class="title-wrapper">
                        <h2 class="section-title has_text_move_anim">
                            <?php echo wp_kses_post( $cta_title ); ?>
                        </h2>
                    </div>
                </div>
                <div class="btn-wrapper has_fade_anim">
                    <a href="<?php echo esc_url( $cta_btn_url ); ?>" class="wc-btn wc-btn-primary btn-text-flip">
                        <span data-text="<?php echo esc_attr( $cta_btn_text ); ?>"><?php echo esc_html( $cta_btn_text ); ?></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
