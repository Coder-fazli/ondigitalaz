<?php
/**
 * Home - Counter / Stats Section (creative-agency style)
 *
 * @package OnDigital
 */

$default_counters = array(
    array( 'number' => '7',   'suffix' => '',  'label' => "İllik\ntəcrübə" ),
    array( 'number' => '500', 'suffix' => '+', 'label' => "Uğurla\ntamamlanan" ),
    array( 'number' => '15',  'suffix' => '',  'label' => "Komanda\nüzvü" ),
    array( 'number' => '98',  'suffix' => '%', 'label' => "Müştəri\nməmnuniyyəti" ),
);

$counters = ondigital_get_repeater( 'stats', $default_counters );

// Alternate fade directions: left, right, left, right …
$directions = array( 'left', 'right', 'left', 'right' );
$delays     = array( '0.45', '0.15', '0.15', '0.45' );
?>
<div class="counter-area">
    <div class="container">
        <div class="counter-area-inner">
            <div class="counter-items">
                <?php foreach ( $counters as $i => $counter ) :
                    $dir    = $directions[ $i % 4 ];
                    $delay  = $delays[ $i % 4 ];
                    $suffix = $counter['suffix'] ?? '';
                ?>
                    <div class="counter-item has_fade_anim"
                         data-fade-from="<?php echo esc_attr( $dir ); ?>"
                         data-duration="0.75"
                         data-delay="<?php echo esc_attr( $delay ); ?>">
                        <div class="counter-item-content">
                            <h2 class="title wc-counter"><?php echo esc_html( $counter['number'] ); ?></h2>
                            <p class="text">
                                <?php if ( $suffix ) : ?>
                                    <span><?php echo esc_html( $suffix ); ?></span>
                                <?php endif; ?>
                                <?php echo wp_kses_post( nl2br( esc_html( $counter['label'] ) ) ); ?>
                            </p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
