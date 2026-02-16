<?php
/**
 * Services - Clients Slider Section
 *
 * @package OnDigital
 */
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
                            <?php for ( $i = 1; $i <= 6; $i++ ) : ?>
                                <div class="swiper-slide">
                                    <div class="client-box">
                                        <img src="<?php echo esc_url( ONDIGITAL_URI . '/assets/imgs/brand/img-s-' . $i . '-light.webp' ); ?>" alt="<?php esc_attr_e( 'müştəri', 'ondigital' ); ?>">
                                    </div>
                                </div>
                            <?php endfor; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
