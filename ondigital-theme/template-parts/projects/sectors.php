<?php
/**
 * Projects - "Sectoral Distribution" (Sektoral təcrübə) bars section.
 *
 * @package OnDigital
 */

$lang = function_exists( 'pll_current_language' ) ? pll_current_language() : 'en';

$eyebrow = ondigital_get_option( 'sectors_eyebrow', $lang === 'en' ? 'Industry Experience' : 'Sektoral təcrübə' );
$title   = ondigital_get_option( 'sectors_title',   $lang === 'en' ? 'Where our work <span>concentrates</span>.' : 'İşimizin <span>cəmləşdiyi</span> sahələr.' );
$desc    = ondigital_get_option( 'sectors_desc',    $lang === 'en'
    ? 'Sector breakdown of the projects we delivered over the last 24 months — each one tied to measurable results.'
    : 'Son 24 ayda gördüyümüz layihələrin sektorlar üzrə bölgüsü — hər biri ölçülə bilən nəticə ilə.' );

// Editable bars; fall back to bilingual demo content when none are set.
$bars = ondigital_get_repeater( 'sector_bars', array() );
$bars = array_values( array_filter( $bars, function ( $b ) {
    return ! empty( $b['label_en'] ) || ! empty( $b['label_az'] );
} ) );

if ( empty( $bars ) ) {
    $bars = array(
        array( 'label_en' => 'E-commerce & Retail',           'label_az' => 'E-ticarət & Pərakəndə',        'percent' => '26' ),
        array( 'label_en' => 'Real Estate',                   'label_az' => 'Daşınmaz əmlak',               'percent' => '17' ),
        array( 'label_en' => 'Finance & Fintech',             'label_az' => 'Maliyyə & Fintech',            'percent' => '15' ),
        array( 'label_en' => 'HoReCa (Restaurants & Hotels)', 'label_az' => 'HoReCa (Restoran & Otel)',     'percent' => '13' ),
        array( 'label_en' => 'Education',                     'label_az' => 'Təhsil',                       'percent' => '9'  ),
        array( 'label_en' => 'Healthcare & Aesthetics',       'label_az' => 'Səhiyyə & Estetika',           'percent' => '8'  ),
        array( 'label_en' => 'Automotive',                    'label_az' => 'Avtomobil',                    'percent' => '7'  ),
        array( 'label_en' => 'Construction',                  'label_az' => 'Tikinti',                      'percent' => '5'  ),
    );
}
?>
<section class="sd-section">
    <div class="container sd-inner">

        <div class="sd-left">
            <span class="sd-eyebrow"><?php echo esc_html( $eyebrow ); ?></span>
            <h2 class="sd-title"><?php echo wp_kses_post( $title ); ?></h2>
            <p class="sd-desc"><?php echo esc_html( $desc ); ?></p>
        </div>

        <div class="sd-right">
            <?php foreach ( $bars as $b ) :
                $label = $b[ 'label_' . $lang ] ?? '';
                if ( '' === $label ) {
                    $label = $b['label_en'] ?? $b['label_az'] ?? '';
                }
                $pct = (int) preg_replace( '/[^0-9]/', '', (string) ( $b['percent'] ?? 0 ) );
                $pct = max( 0, min( 100, $pct ) );
            ?>
                <div class="sd-row">
                    <span class="sd-label"><?php echo esc_html( $label ); ?></span>
                    <div class="sd-track"><div class="sd-fill" style="--pct:<?php echo (int) $pct; ?>%"></div></div>
                    <span class="sd-pct"><?php echo (int) $pct; ?>%</span>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>
<script>
(function () {
    var sec = document.currentScript.previousElementSibling;
    if ( ! sec || ! window.IntersectionObserver ) {
        if ( sec ) sec.classList.add( 'sd-animate' );
        return;
    }
    var io = new IntersectionObserver( function ( entries ) {
        entries.forEach( function ( e ) {
            if ( e.isIntersecting ) { sec.classList.add( 'sd-animate' ); io.disconnect(); }
        } );
    }, { threshold: 0.25 } );
    io.observe( sec );
})();
</script>
