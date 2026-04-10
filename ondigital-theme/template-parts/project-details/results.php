<?php
/**
 * Project Details — Results & Metrics Section
 *
 * @package OnDigital
 */

$title = ondigital_get_option( 'project_results_title', __( 'Numbers that speak for themselves.', 'ondigital' ) );
$desc  = ondigital_get_option( 'project_results_desc',  __( 'Four months after launch — revenue tripled, ad cost dropped 62%, and organic traffic quadrupled.', 'ondigital' ) );

$default_stats = array(
    array( 'value' => '340', 'suffix' => '%', 'label_az' => 'Gəlirin artımı — 4 ay ərzində',    'label_en' => 'Revenue growth in 4 months' ),
    array( 'value' => '4',   'suffix' => '×', 'label_az' => 'SEO-dan üzvi trafik artımı',        'label_en' => 'More organic traffic from SEO' ),
    array( 'value' => '62',  'suffix' => '%', 'label_az' => 'Aşağı müştəri əldəetmə dəyəri',    'label_en' => 'Lower cost-per-acquisition' ),
    array( 'value' => '3.8', 'suffix' => '%', 'label_az' => 'Konversiya dərəcəsi (0.8% idi)',   'label_en' => 'Conversion rate (was 0.8%)' ),
);

$stats = array();
for ( $n = 1; $n <= 4; $n++ ) {
    $def = $default_stats[ $n - 1 ];
    $lang = function_exists( 'pll_current_language' ) ? pll_current_language() : 'az';
    $stats[] = array(
        'value'  => ondigital_get_option( 'project_stat' . $n . '_value',  $def['value'] ),
        'suffix' => ondigital_get_option( 'project_stat' . $n . '_suffix', $def['suffix'] ),
        'label'  => ondigital_get_option( 'project_stat' . $n . '_label',  $def[ 'label_' . $lang ] ?? $def['label_az'] ),
    );
}

// Don't render if no stats
$has_stats = array_filter( $stats, function( $s ) { return ! empty( $s['value'] ); } );
if ( ! $has_stats && ! $title ) {
    return;
}
?>
<section class="cs-section cs-results-sec">
    <div class="cs-inner">
        <div class="cs-stag cs-fade"><?php esc_html_e( 'Results & Metrics', 'ondigital' ); ?></div>
        <div class="cs-rg">
            <div class="cs-fade cs-d1">
                <h2 class="cs-rtitle"><?php echo esc_html( $title ); ?></h2>
                <?php if ( $desc ) : ?>
                    <p class="cs-rdesc"><?php echo esc_html( $desc ); ?></p>
                <?php endif; ?>
            </div>

            <div class="cs-mbox cs-fade cs-d2">
                <?php foreach ( $stats as $i => $stat ) :
                    if ( empty( $stat['value'] ) ) continue;
                    // Determine if numeric (animate) or text (static)
                    $is_numeric = is_numeric( $stat['value'] );
                    $int_val    = $is_numeric ? intval( $stat['value'] ) : 0;
                    // Use decimal display for non-integer (e.g. 3.8)
                    $is_decimal = $is_numeric && strpos( $stat['value'], '.' ) !== false;
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
        </div>
    </div>
</section>
