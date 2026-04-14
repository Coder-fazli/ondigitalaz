<?php
/**
 * About - Counter Section
 *
 * @package OnDigital
 */

$counter_img1      = ondigital_img( 'about_counter_img1', '/assets/imgs/gallery/img-s-27.webp' );
$counter_img2      = ondigital_img( 'about_counter_img2', '/assets/imgs/gallery/img-s-28.webp' );
$counter_img3      = ondigital_img( 'about_counter_img3', '/assets/imgs/gallery/img-s-29.webp' );
$counter1_number   = ondigital_get_option( 'about_counter1_number', '100+' );
$counter1_text     = ondigital_get_option( 'about_counter1_text', '100+ <br> məmnun müştəri' );
$counter2_number   = ondigital_get_option( 'about_counter2_number', '7+' );
$counter2_text     = ondigital_get_option( 'about_counter2_text', '7+ il<br>təcrübə ilə<br>xidmətinizdəyik' );
?>
<div class="counter-area">
    <div class="counter-area-inner">
        <div class="thumb">
            <img src="<?php echo esc_url( $counter_img1 ); ?>" alt="<?php esc_attr_e( 'OnDigital ofis', 'ondigital' ); ?>">
        </div>
        <div class="counter-wrapper-box">
            <div class="counter-wrapper">
                <div class="thumb overflow-hidden">
                    <img src="<?php echo esc_url( $counter_img2 ); ?>" data-speed="0.9" alt="<?php esc_attr_e( 'Komanda', 'ondigital' ); ?>">
                </div>
                <div class="counter-box">
                    <h2 class="text has_fade_anim"><?php echo wp_kses_post( $counter1_text ); ?></h2>
                    <h2 class="number wc-counter has_fade_anim"><?php echo esc_html( $counter1_number ); ?></h2>
                </div>
                <div class="counter-box dark">
                    <h2 class="text has_fade_anim"><?php echo wp_kses_post( $counter2_text ); ?></h2>
                    <h2 class="number wc-counter has_fade_anim"><?php echo esc_html( $counter2_number ); ?></h2>
                </div>
                <div class="thumb overflow-hidden">
                    <img src="<?php echo esc_url( $counter_img3 ); ?>" data-speed="0.9" alt="<?php esc_attr_e( 'Layihə', 'ondigital' ); ?>">
                </div>
            </div>
        </div>
    </div>
</div>
