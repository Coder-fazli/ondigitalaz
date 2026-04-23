<?php
/**
 * Home - Counter / Stats Section (Arolax-style with circles)
 *
 * @package OnDigital
 */

$stats_title = ondigital_get_option( 'stats_title', 'The reasons why you should work with us' );

$default_counters = array(
    array( 'number' => '7',   'suffix' => '+', 'label' => "İllik\ntəcrübə" ),
    array( 'number' => '500', 'suffix' => '+', 'label' => "Uğurla\ntamamlanan" ),
    array( 'number' => '15',  'suffix' => '',  'label' => "Komanda\nüzvü" ),
    array( 'number' => '98',  'suffix' => '%', 'label' => "Müştəri\nməmnuniyyəti" ),
);

$counters = ondigital_get_repeater( 'stats', $default_counters );

$delays = array( '0.15', '0.30', '0.45', '0.60' );
?>
<section class="counter-area">
    <div class="container">
        <div class="counter-area-inner">

            <h2 class="counter-section-title has_text_move_anim">
                <?php echo wp_kses_post( $stats_title ); ?>
            </h2>

            <div class="counter-items">
                <?php foreach ( $counters as $i => $counter ) :
                    $suffix = $counter['suffix'] ?? '';
                ?>
                    <div class="counter-item has_fade_anim" data-delay="<?php echo esc_attr( $delays[ $i % 4 ] ); ?>">
                        <h3 class="number"><?php echo esc_html( $counter['number'] . $suffix ); ?></h3>
                        <p class="text"><?php echo wp_kses_post( nl2br( esc_html( $counter['label'] ) ) ); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>

        </div>
    </div>
</section>
