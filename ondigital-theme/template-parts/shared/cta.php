<?php
/**
 * Shared - CTA Section
 *
 * @package OnDigital
 */
?>
<section class="cta-area">
    <div class="container">
        <div class="cta-area-inner section-spacing">
            <div class="section-header">
                <div class="section-title-wrapper">
                    <div class="title-wrapper">
                        <h2 class="section-title has_text_move_anim">
                            <?php echo wp_kses_post( __( 'Have an idea in your mind? Let\'s <span>make</span> something great together', 'ondigital' ) ); ?>
                        </h2>
                    </div>
                </div>
                <div class="btn-wrapper has_fade_anim">
                    <a href="<?php echo esc_url( home_url( '/elaqe/' ) ); ?>" class="wc-btn wc-btn-primary btn-text-flip">
                        <span data-text="<?php esc_attr_e( 'Let\'s get in touch', 'ondigital' ); ?>"><?php esc_html_e( 'Let\'s get in touch', 'ondigital' ); ?></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
