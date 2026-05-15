<?php
/**
 * Projects Page — Partners/Clients Marquee (3 rows)
 *
 * @package OnDigital
 */

$default_brands = array(
    array( 'image_light' => 0, 'image_dark' => 0, 'alt' => 'Partner 1', '_fallback_light' => 'img-s-13', '_fallback_dark' => 'img-s-13-light' ),
    array( 'image_light' => 0, 'image_dark' => 0, 'alt' => 'Partner 2', '_fallback_light' => 'img-s-14', '_fallback_dark' => 'img-s-14-light' ),
    array( 'image_light' => 0, 'image_dark' => 0, 'alt' => 'Partner 3', '_fallback_light' => 'img-s-15', '_fallback_dark' => 'img-s-15-light' ),
    array( 'image_light' => 0, 'image_dark' => 0, 'alt' => 'Partner 4', '_fallback_light' => 'img-s-16', '_fallback_dark' => 'img-s-16-light' ),
    array( 'image_light' => 0, 'image_dark' => 0, 'alt' => 'Partner 5', '_fallback_light' => 'img-s-17', '_fallback_dark' => 'img-s-17-light' ),
    array( 'image_light' => 0, 'image_dark' => 0, 'alt' => 'Partner 6', '_fallback_light' => 'img-s-18', '_fallback_dark' => 'img-s-18-light' ),
);

$brands = ondigital_get_repeater( 'partners', $default_brands );

$logo_items = '';
foreach ( $brands as $brand ) :
    $alt = esc_attr( $brand['alt'] ?? '' );

    if ( ! empty( $brand['image_light'] ) ) {
        $light_url = wp_get_attachment_image_url( $brand['image_light'], 'medium' );
    } else {
        $fallback  = $brand['_fallback_light'] ?? 'img-s-13';
        $light_url = ONDIGITAL_URI . '/assets/imgs/brand/' . $fallback . '.webp';
    }

    if ( ! empty( $brand['image_dark'] ) ) {
        $dark_url = wp_get_attachment_image_url( $brand['image_dark'], 'medium' );
    } else {
        $fallback = $brand['_fallback_dark'] ?? 'img-s-13-light';
        $dark_url = ONDIGITAL_URI . '/assets/imgs/brand/' . $fallback . '.webp';
    }

    $logo_items .= '<div class="client-box">';
    $logo_items .= '<img class="show-light" src="' . esc_url( $light_url ) . '" alt="' . $alt . '" loading="lazy">';
    $logo_items .= '<img class="show-dark" src="' . esc_url( $dark_url ) . '" alt="' . $alt . '" loading="lazy">';
    $logo_items .= '</div>';
endforeach;
?>
<div class="pa-partners">
    <div class="client-slider">
        <!-- Row 1: scrolls left -->
        <div class="logo-marquee-track" data-direction="left"><?php echo $logo_items; ?></div>
        <!-- Row 2: scrolls right -->
        <div class="logo-marquee-track" data-direction="right"><?php echo $logo_items; ?></div>
        <!-- Row 3: scrolls left -->
        <div class="logo-marquee-track" data-direction="left"><?php echo $logo_items; ?></div>
    </div>
</div>
