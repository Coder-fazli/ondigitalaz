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

// Build the logo markup for a single brand.
$od_build_logo = function ( $brand ) {
    $alt = esc_attr( $brand['alt'] ?? '' );

    if ( ! empty( $brand['image_light'] ) ) {
        $light_url = wp_get_attachment_image_url( $brand['image_light'], 'medium' );
    } else {
        $light_url = ONDIGITAL_URI . '/assets/imgs/brand/' . ( $brand['_fallback_light'] ?? 'img-s-13' ) . '.webp';
    }

    if ( ! empty( $brand['image_dark'] ) ) {
        $dark_url = wp_get_attachment_image_url( $brand['image_dark'], 'medium' );
    } else {
        $dark_url = ONDIGITAL_URI . '/assets/imgs/brand/' . ( $brand['_fallback_dark'] ?? 'img-s-13-light' ) . '.webp';
    }

    return '<div class="client-box">'
        . '<img class="show-light" src="' . esc_url( $light_url ) . '" alt="' . $alt . '" loading="lazy">'
        . '<img class="show-dark" src="' . esc_url( $dark_url ) . '" alt="' . $alt . '" loading="lazy">'
        . '</div>';
};

// Split the logos across up to 3 rows (no duplication): more logos → fill the
// 3rd row. Few logos stay in 2 (or 1) rows.
$od_total     = count( $brands );
$od_per_row   = max( 1, (int) ceil( $od_total / 3 ) );
$od_rows      = array_chunk( $brands, $od_per_row );
$od_dirs      = array( 'left', 'right', 'left' );
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
                <?php foreach ( $od_rows as $od_i => $od_row ) :
                    $od_items = '';
                    foreach ( $od_row as $od_brand ) {
                        $od_items .= $od_build_logo( $od_brand );
                    }
                    if ( '' === $od_items ) {
                        continue;
                    }
                    $od_dir = $od_dirs[ $od_i ] ?? ( ( $od_i % 2 ) ? 'right' : 'left' );
                ?>
                <div class="logo-marquee-track" data-direction="<?php echo esc_attr( $od_dir ); ?>"><?php echo $od_items; ?></div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
