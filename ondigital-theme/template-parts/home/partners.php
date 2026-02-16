<?php
/**
 * Home - Partners/Clients Section
 *
 * @package OnDigital
 */

$brands = array(
    'img-s-13' => 'Partner 1',
    'img-s-14' => 'Partner 2',
    'img-s-15' => 'Partner 3',
    'img-s-16' => 'Partner 4',
    'img-s-17' => 'Partner 5',
    'img-s-18' => 'Partner 6',
);
?>
<div class="clients-area">
    <div class="container">
        <div class="clients-area-inner">
            <div class="section-header">
                <div class="section-title-wrapper">
                    <div class="title-wrapper">
                        <h2 class="section-title has_word_anim"><?php esc_html_e( 'We worked with the world\'s best companies', 'ondigital' ); ?></h2>
                    </div>
                </div>
            </div>
            <div class="client-slider has_fade_anim">
                <div class="swiper client-slider-active">
                    <div class="swiper-wrapper">
                        <?php foreach ( $brands as $img => $alt ) : ?>
                            <div class="swiper-slide">
                                <div class="client-box">
                                    <img class="show-light" src="<?php echo esc_url( ONDIGITAL_URI . '/assets/imgs/brand/' . $img . '.webp' ); ?>" alt="<?php echo esc_attr( $alt ); ?>">
                                    <img class="show-dark" src="<?php echo esc_url( ONDIGITAL_URI . '/assets/imgs/brand/' . $img . '-light.webp' ); ?>" alt="<?php echo esc_attr( $alt ); ?>">
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
