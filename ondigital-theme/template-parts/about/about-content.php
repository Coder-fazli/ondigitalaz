<?php
/**
 * About - About Content Section
 *
 * @package OnDigital
 */

$ac_thumb    = ondigital_img( 'about_content_thumb', '/assets/imgs/gallery/img-s-30.webp' );
$ac_bg       = ondigital_img( 'about_content_bg', '/assets/imgs/gallery/img-s-31.webp' );
$ac_title    = ondigital_get_option( 'about_content_title', 'Sadə amma peşəkar səviyyədə agentlik' );
$ac_body     = ondigital_get_option( 'about_content_body', 'Veb saytınızın hər bir <span>statik elementi</span> üzərində tam nəzarətə sahib olun' );
$ac_btn_text = ondigital_get_option( 'about_content_btn_text', 'Ətraflı' );
$ac_btn_url  = ondigital_get_option( 'about_content_btn_url' );
$ac_btn_url  = $ac_btn_url ? $ac_btn_url : home_url( '/elaqe/' );
?>
<section class="about-area container-hd">
    <div class="about-area-inner">
        <div class="thumb">
            <img src="<?php echo esc_url( $ac_thumb ); ?>" alt="<?php esc_attr_e( 'Agentlik', 'ondigital' ); ?>">
        </div>
        <div class="section-content">
            <div class="bg">
                <img src="<?php echo esc_url( $ac_bg ); ?>" alt="<?php esc_attr_e( 'fon', 'ondigital' ); ?>">
            </div>
            <div class="section-title-wrapper">
                <div class="title-wrapper">
                    <h2 class="section-title has_fade_anim">
                        <?php echo esc_html( $ac_title ); ?>
                    </h2>
                </div>
            </div>
            <div class="text-wrapper">
                <p class="text has_fade_anim" data-fade-from="left">
                    <?php echo wp_kses_post( $ac_body ); ?>
                </p>
            </div>
            <div class="btn-wrapper has_fade_anim" data-ease="bounce">
                <a href="<?php echo esc_url( $ac_btn_url ); ?>" class="wc-btn wc-btn-primary btn-text-flip">
                    <span data-text="<?php echo esc_attr( $ac_btn_text ); ?>"><?php echo esc_html( $ac_btn_text ); ?></span>
                </a>
            </div>
        </div>
    </div>
</section>
