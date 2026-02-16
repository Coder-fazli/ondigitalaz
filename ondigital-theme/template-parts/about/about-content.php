<?php
/**
 * About - About Content Section
 *
 * @package OnDigital
 */
?>
<section class="about-area container-hd">
    <div class="about-area-inner">
        <div class="thumb">
            <img src="<?php echo esc_url( ONDIGITAL_URI . '/assets/imgs/gallery/img-s-30.webp' ); ?>" alt="<?php esc_attr_e( 'Agentlik', 'ondigital' ); ?>">
        </div>
        <div class="section-content">
            <div class="bg">
                <img src="<?php echo esc_url( ONDIGITAL_URI . '/assets/imgs/gallery/img-s-31.webp' ); ?>" alt="<?php esc_attr_e( 'fon', 'ondigital' ); ?>">
            </div>
            <div class="section-title-wrapper">
                <div class="title-wrapper">
                    <h2 class="section-title has_fade_anim">
                        <?php esc_html_e( 'Sadə amma peşəkar səviyyədə agentlik', 'ondigital' ); ?>
                    </h2>
                </div>
            </div>
            <div class="text-wrapper">
                <p class="text has_fade_anim" data-fade-from="left">
                    <?php echo wp_kses_post( __( 'Veb saytınızın hər bir <span>statik elementi</span> üzərində tam nəzarətə sahib olun', 'ondigital' ) ); ?>
                </p>
            </div>
            <div class="btn-wrapper has_fade_anim" data-ease="bounce">
                <a href="<?php echo esc_url( home_url( '/elaqe/' ) ); ?>" class="wc-btn wc-btn-primary btn-text-flip">
                    <span data-text="<?php esc_attr_e( 'Ətraflı', 'ondigital' ); ?>"><?php esc_html_e( 'Ətraflı', 'ondigital' ); ?></span>
                </a>
            </div>
        </div>
    </div>
</section>
