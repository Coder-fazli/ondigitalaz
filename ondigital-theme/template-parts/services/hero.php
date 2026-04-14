<?php
/**
 * Services - Hero Section
 *
 * @package OnDigital
 */

$services_hero_title = ondigital_get_option( 'services_hero_title', 'Rəqəmsal dünyada fərq yaradan dizayn və xidmətlər.' );
$services_hero_body  = ondigital_get_option( 'services_hero_body', 'Müasir və unikal dizayn yanaşması ilə istifadəçi dostu rəqəmsal həllər yaradırıq.' );
$services_hero_thumb = ondigital_img( 'services_hero_thumb', '/assets/imgs/gallery/img-s-86.webp' );
$services_icon_light = ondigital_img( 'services_hero_icon_light', '/assets/imgs/shape/img-s-82.webp' );
$services_icon_dark  = ondigital_img( 'services_hero_icon_dark', '/assets/imgs/shape/img-s-82-light.webp' );
?>
<section class="hero-area">
    <div class="container">
        <div class="hero-area-inner">
            <div class="section-content">
                <div class="section-title-wrapper">
                    <div class="title-wrapper">
                        <h1 class="section-title large has_text_move_anim">
                            <?php echo wp_kses_post( $services_hero_title ); ?>
                        </h1>
                    </div>
                </div>
                <div class="text-wrapper">
                    <p class="text has_fade_anim">
                        <?php echo esc_html( $services_hero_body ); ?>
                    </p>
                </div>
                <div class="icon has_fade_anim" data-on-scroll="0">
                    <img class="show-light" src="<?php echo esc_url( $services_icon_light ); ?>" alt="<?php esc_attr_e( 'dekor', 'ondigital' ); ?>">
                    <img class="show-dark"  src="<?php echo esc_url( $services_icon_dark ); ?>"  alt="<?php esc_attr_e( 'dekor', 'ondigital' ); ?>">
                </div>
            </div>
            <div class="thumb">
                <img src="<?php echo esc_url( $services_hero_thumb ); ?>" class="has_fade_anim" data-fade-offset="0" data-delay="0.45" alt="<?php esc_attr_e( 'Xidmətlər', 'ondigital' ); ?>">
            </div>
        </div>
    </div>
</section>
