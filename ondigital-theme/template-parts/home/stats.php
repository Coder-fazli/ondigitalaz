<?php
/**
 * Home - Fun Facts / Stats Section
 *
 * @package OnDigital
 */

$counters = array(
    array( 'number' => '7',   'label' => __( 'Years experience', 'ondigital' ), 'delay' => '0.15' ),
    array( 'number' => '500+', 'label' => __( 'Projects done successfully', 'ondigital' ), 'delay' => '0.30' ),
    array( 'number' => '15',  'label' => __( 'Marketing team member', 'ondigital' ), 'delay' => '0.45' ),
    array( 'number' => '10',  'label' => __( 'We achieved awards', 'ondigital' ), 'delay' => '0.60' ),
);
?>
<section class="fun-fact-area">
    <div class="container">
        <div class="fun-fact-area-inner section-spacing-top">
            <div class="section-header">
                <div class="section-title-wrapper">
                    <div class="title-wrapper">
                        <h2 class="section-title has_text_move_anim">
                            <?php echo wp_kses_post( __( 'The reasons why you should <span>work</span> with us', 'ondigital' ) ); ?>
                        </h2>
                    </div>
                </div>
            </div>
            <div class="counter-wrapper-box">
                <div class="counter-wrapper">
                    <?php foreach ( $counters as $counter ) : ?>
                        <div class="counter-box has_fade_anim" data-delay="<?php echo esc_attr( $counter['delay'] ); ?>">
                            <h3 class="number wc-counter"><?php echo esc_html( $counter['number'] ); ?></h3>
                            <h3 class="text"><?php echo wp_kses_post( nl2br( $counter['label'] ) ); ?></h3>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>
