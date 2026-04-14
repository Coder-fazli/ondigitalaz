<?php
/**
 * Services - About Section
 *
 * @package OnDigital
 */

$services_about_thumb    = ondigital_img( 'services_about_thumb', '/assets/imgs/gallery/img-s-30.webp' );
$services_about_bg       = ondigital_img( 'services_about_bg', '/assets/imgs/gallery/img-s-31.webp' );
$services_about_title    = ondigital_get_option( 'services_about_title', 'Sadə amma peşəkar <br> agentlik' );
$services_about_body     = ondigital_get_option( 'services_about_body', 'Müştərilərimizin saytlarını vizual cəhətdən cəlbedici, funksional və istifadəçi dostu hala gətiririk.' );
$services_about_btn_text = ondigital_get_option( 'services_about_btn_text', 'Ətraflı' );
$services_about_btn_url  = ondigital_get_option( 'services_about_btn_url' );
$services_about_btn_url  = $services_about_btn_url ? $services_about_btn_url : home_url( '/haqqimizda/' );
?>
<section class="about-area container-hd">
    <div class="about-area-inner">
        <div class="thumb">
            <img src="<?php echo esc_url( $services_about_thumb ); ?>" alt="<?php esc_attr_e( 'haqqımızda', 'ondigital' ); ?>">
        </div>
        <div class="section-content">
            <div class="bg">
                <img src="<?php echo esc_url( $services_about_bg ); ?>" alt="<?php esc_attr_e( 'fon', 'ondigital' ); ?>">
            </div>
            <div class="section-title-wrapper">
                <div class="title-wrapper">
                    <h2 class="section-title has_text_move_anim">
                        <?php echo wp_kses_post( $services_about_title ); ?>
                    </h2>
                </div>
            </div>
            <div class="text-wrapper">
                <p class="text has_fade_anim">
                    <?php echo esc_html( $services_about_body ); ?>
                </p>
            </div>
            <div class="btn-wrapper has_fade_anim" data-ease="bounce">
                <a href="<?php echo esc_url( $services_about_btn_url ); ?>" class="wc-btn wc-btn-primary btn-text-flip">
                    <span data-text="<?php echo esc_attr( $services_about_btn_text ); ?>"><?php echo esc_html( $services_about_btn_text ); ?></span>
                </a>
            </div>
        </div>
    </div>
</section>
