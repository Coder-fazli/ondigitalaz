<?php
/**
 * About - Clients Section
 *
 * @package OnDigital
 */

$clients_title = ondigital_get_option( 'about_clients_title', 'Ən böyük qlobal brendlərlə əməkdaşlıq etdik' );

$default_clients = array();
for ( $i = 1; $i <= 12; $i++ ) {
    $default_clients[] = array(
        'img_light'      => '',
        'img_dark'       => '',
        'alt'            => '',
        '_fallback_light' => ONDIGITAL_URI . '/assets/imgs/brand/img-s-' . $i . '.webp',
        '_fallback_dark'  => ONDIGITAL_URI . '/assets/imgs/brand/img-s-' . $i . '-light.webp',
    );
}

$clients = ondigital_get_repeater( 'about_clients', $default_clients );
?>
<div class="client-area">
    <div class="container">
        <div class="client-area-inner section-spacing">
            <div class="client-area-text">
                <h2 class="text has_fade_anim"><?php echo esc_html( $clients_title ); ?></h2>
            </div>
            <div class="clients-wrapper-box has_fade_anim">
                <div class="clients-wrapper">
                    <?php foreach ( $clients as $client ) :
                        $light = ! empty( $client['img_light'] ) ? wp_get_attachment_image_url( $client['img_light'], 'full' ) : ( $client['_fallback_light'] ?? '' );
                        $dark  = ! empty( $client['img_dark'] )  ? wp_get_attachment_image_url( $client['img_dark'],  'full' ) : ( $client['_fallback_dark']  ?? '' );
                        $alt   = $client['alt'] ?? '';
                        if ( ! $light ) continue;
                    ?>
                        <div class="client-box">
                            <img class="show-light" src="<?php echo esc_url( $light ); ?>" alt="<?php echo esc_attr( $alt ); ?>">
                            <img class="show-dark"  src="<?php echo esc_url( $dark  ); ?>" alt="<?php echo esc_attr( $alt ); ?>">
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
