<?php
/**
 * About - Clients Section
 *
 * @package OnDigital
 */
?>
<div class="client-area">
    <div class="container">
        <div class="client-area-inner section-spacing">
            <div class="client-area-text">
                <h2 class="text has_fade_anim"><?php esc_html_e( 'Ən böyük qlobal brendlərlə əməkdaşlıq etdik', 'ondigital' ); ?></h2>
            </div>
            <div class="clients-wrapper-box has_fade_anim">
                <div class="clients-wrapper">
                    <?php for ( $i = 1; $i <= 12; $i++ ) : ?>
                        <div class="client-box">
                            <img class="show-light" src="<?php echo esc_url( ONDIGITAL_URI . '/assets/imgs/brand/img-s-' . $i . '.webp' ); ?>" alt="<?php esc_attr_e( 'müştəri', 'ondigital' ); ?>">
                            <img class="show-dark" src="<?php echo esc_url( ONDIGITAL_URI . '/assets/imgs/brand/img-s-' . $i . '-light.webp' ); ?>" alt="<?php esc_attr_e( 'müştəri', 'ondigital' ); ?>">
                        </div>
                    <?php endfor; ?>
                </div>
            </div>
        </div>
    </div>
</div>
