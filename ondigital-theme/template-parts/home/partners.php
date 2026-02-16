<?php
/**
 * Home - Partners/Clients Section
 *
 * @package OnDigital
 */

$partners_title = ondigital_get_option( 'partners_title', "We worked with the world's best companies" );

$default_brands = array(
    array( 'image_light' => 0, 'image_dark' => 0, 'alt' => 'Partner 1', '_fallback_light' => 'img-s-13', '_fallback_dark' => 'img-s-13-light' ),
    array( 'image_light' => 0, 'image_dark' => 0, 'alt' => 'Partner 2', '_fallback_light' => 'img-s-14', '_fallback_dark' => 'img-s-14-light' ),
    array( 'image_light' => 0, 'image_dark' => 0, 'alt' => 'Partner 3', '_fallback_light' => 'img-s-15', '_fallback_dark' => 'img-s-15-light' ),
    array( 'image_light' => 0, 'image_dark' => 0, 'alt' => 'Partner 4', '_fallback_light' => 'img-s-16', '_fallback_dark' => 'img-s-16-light' ),
    array( 'image_light' => 0, 'image_dark' => 0, 'alt' => 'Partner 5', '_fallback_light' => 'img-s-17', '_fallback_dark' => 'img-s-17-light' ),
    array( 'image_light' => 0, 'image_dark' => 0, 'alt' => 'Partner 6', '_fallback_light' => 'img-s-18', '_fallback_dark' => 'img-s-18-light' ),
);

$brands = ondigital_get_repeater( 'partners', $default_brands );
?>
<div class="clients-area">
    <div class="container">
        <div class="clients-area-inner">
            <div class="section-header">
                <div class="section-title-wrapper">
                    <div class="title-wrapper">
                        <h2 class="section-title has_word_anim"><?php echo esc_html( $partners_title ); ?></h2>
                    </div>
                </div>
            </div>
            <div class="client-slider has_fade_anim">
                <div class="swiper client-slider-active">
                    <div class="swiper-wrapper">
                        <?php foreach ( $brands as $brand ) :
                            $alt = esc_attr( $brand['alt'] ?? '' );

                            // Light image
                            if ( ! empty( $brand['image_light'] ) ) {
                                $light_url = wp_get_attachment_image_url( $brand['image_light'], 'medium' );
                            } else {
                                $fallback = $brand['_fallback_light'] ?? 'img-s-13';
                                $light_url = ONDIGITAL_URI . '/assets/imgs/brand/' . $fallback . '.webp';
                            }

                            // Dark image
                            if ( ! empty( $brand['image_dark'] ) ) {
                                $dark_url = wp_get_attachment_image_url( $brand['image_dark'], 'medium' );
                            } else {
                                $fallback = $brand['_fallback_dark'] ?? 'img-s-13-light';
                                $dark_url = ONDIGITAL_URI . '/assets/imgs/brand/' . $fallback . '.webp';
                            }
                        ?>
                            <div class="swiper-slide">
                                <div class="client-box">
                                    <img class="show-light" src="<?php echo esc_url( $light_url ); ?>" alt="<?php echo $alt; ?>">
                                    <img class="show-dark" src="<?php echo esc_url( $dark_url ); ?>" alt="<?php echo $alt; ?>">
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
