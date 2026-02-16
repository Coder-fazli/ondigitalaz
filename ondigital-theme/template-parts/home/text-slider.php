<?php
/**
 * Home - Text Slider / Marquee Section
 *
 * @package OnDigital
 */

$default_slides = array(
    array( 'text' => 'marketing.', 'highlighted' => 'strategy.' ),
);

$slides = ondigital_get_repeater( 'text_slider', $default_slides );
?>
<div class="container large has_fade_anim">
    <div class="text-slider">
        <div class="swiper text-slider-active">
            <div class="swiper-wrapper">
                <?php for ( $i = 0; $i < 5; $i++ ) :
                    foreach ( $slides as $slide ) :
                        $text = $slide['text'] ?? 'marketing.';
                        $highlighted = $slide['highlighted'] ?? 'strategy.';
                ?>
                    <div class="swiper-slide">
                        <div class="text-slider-item">
                            <h2 class="title"><?php echo esc_html( $text ); ?> <span><?php echo esc_html( $highlighted ); ?></span></h2>
                        </div>
                    </div>
                <?php
                    endforeach;
                endfor; ?>
            </div>
        </div>
    </div>
</div>
