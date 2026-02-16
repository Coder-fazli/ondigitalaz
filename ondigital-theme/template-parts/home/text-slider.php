<?php
/**
 * Home - Text Slider / Marquee Section
 *
 * @package OnDigital
 */
?>
<div class="container large has_fade_anim">
    <div class="text-slider">
        <div class="swiper text-slider-active">
            <div class="swiper-wrapper">
                <?php for ( $i = 0; $i < 5; $i++ ) : ?>
                    <div class="swiper-slide">
                        <div class="text-slider-item">
                            <h2 class="title">marketing. <span>strategy.</span></h2>
                        </div>
                    </div>
                <?php endfor; ?>
            </div>
        </div>
    </div>
</div>
