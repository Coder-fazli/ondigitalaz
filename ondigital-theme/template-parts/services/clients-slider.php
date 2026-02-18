<?php
/**
 * Services - Clients Slider Section
 *
 * @package OnDigital
 */

$default_clients = array();
for ( $i = 1; $i <= 6; $i++ ) {
    $default_clients[] = array(
        'img_light'       => '',
        'img_dark'        => '',
        'alt'             => '',
        '_fallback_light' => ONDIGITAL_URI . '/assets/imgs/brand/img-s-' . $i . '-light.webp',
        '_fallback_dark'  => ONDIGITAL_URI . '/assets/imgs/brand/img-s-' . $i . '-light.webp',
    );
}

// Reuse the about page clients, falling back to default brand images
$clients = ondigital_get_repeater( 'about_clients', $default_clients );
$clients = array_slice( $clients, 0, 6 ); // show max 6 in slider
?>
<div class="container-hd has_fade_anim">
    <div class="clients-area">
        <div class="container">
            <div class="clients-area-inner">
                <div class="shape-1">
                    <img src="<?php echo esc_url( ONDIGITAL_URI . '/assets/imgs/shape/img-s-83.webp' ); ?>" alt="<?php esc_attr_e( 'dekor', 'ondigital' ); ?>">
                </div>
                <div class="client-slider">
                    <div class="swiper client-slider-active">
                        <div class="swiper-wrapper">
                            <?php foreach ( $clients as $client ) :
                                $img = ! empty( $client['img_light'] )
                                    ? wp_get_attachment_image_url( $client['img_light'], 'full' )
                                    : ( $client['_fallback_light'] ?? '' );
                                $alt = $client['alt'] ?? '';
                                if ( ! $img ) continue;
                            ?>
                                <div class="swiper-slide">
                                    <div class="client-box">
                                        <img src="<?php echo esc_url( $img ); ?>" alt="<?php echo esc_attr( $alt ); ?>">
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
