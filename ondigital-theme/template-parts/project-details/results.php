<?php
/**
 * Project Details — Results & Metrics Section
 *
 * @package OnDigital
 */

$id    = get_the_ID();
$title = get_post_meta( $id, '_od_results_title', true );
$desc  = get_post_meta( $id, '_od_results_desc',  true );

$stats = array();
for ( $n = 1; $n <= 4; $n++ ) {
    $val    = get_post_meta( $id, "_od_stat{$n}_value",  true );
    $suffix = get_post_meta( $id, "_od_stat{$n}_suffix", true );
    $label  = get_post_meta( $id, "_od_stat{$n}_label",  true );
    if ( $val !== '' && $val !== false ) {
        $stats[] = array( 'value' => $val, 'suffix' => $suffix, 'label' => $label );
    }
}

$has_stats = ! empty( $stats );
if ( ! $has_stats && ! $title ) {
    return;
}
?>
<section class="cs-section cs-results-sec">
    <div class="cs-inner">
        <div class="cs-stag cs-fade"><?php esc_html_e( 'Results & Metrics', 'ondigital' ); ?></div>
        <div class="cs-rg">
            <div class="cs-fade cs-d1">
                <?php if ( $title ) : ?>
                    <h2 class="cs-rtitle"><?php echo esc_html( $title ); ?></h2>
                <?php endif; ?>
                <?php if ( $desc ) : ?>
                    <p class="cs-rdesc"><?php echo esc_html( $desc ); ?></p>
                <?php endif; ?>
            </div>

            <?php if ( $has_stats ) : ?>
            <div class="cs-mbox cs-fade cs-d2">
                <?php foreach ( $stats as $stat ) :
                    $is_numeric = is_numeric( $stat['value'] );
                    $is_decimal = $is_numeric && strpos( $stat['value'], '.' ) !== false;
                    $int_val    = $is_numeric ? intval( $stat['value'] ) : 0;
                ?>
                    <div class="cs-mcell">
                        <div class="cs-mbig">
                            <?php if ( $is_numeric && ! $is_decimal ) : ?>
                                <span class="cs-counter" data-target="<?php echo esc_attr( $int_val ); ?>">0</span>
                            <?php else : ?>
                                <span><?php echo esc_html( $stat['value'] ); ?></span>
                            <?php endif; ?>
                            <?php if ( $stat['suffix'] ) : ?>
                                <span><?php echo esc_html( $stat['suffix'] ); ?></span>
                            <?php endif; ?>
                        </div>
                        <?php if ( $stat['label'] ) : ?>
                            <div class="cs-mlbl"><?php echo esc_html( $stat['label'] ); ?></div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>
