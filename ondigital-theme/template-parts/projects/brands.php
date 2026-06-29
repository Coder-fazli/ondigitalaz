<?php
/**
 * Projects - "Brands We Worked With" logo grid.
 *
 * @package OnDigital
 */

$lang   = function_exists( 'pll_current_language' ) ? pll_current_language() : 'en';
$title  = ondigital_get_option( 'brands_grid_title', $lang === 'en' ? 'Brands We Worked With' : 'Birlikdə çalışdığımız brendlər' );
$brands = ondigital_get_repeater( 'brand_logos', array() );

// Keep only rows that actually have a logo.
$brands = array_values( array_filter( $brands, function ( $b ) {
    return ! empty( $b['logo'] );
} ) );

if ( empty( $brands ) ) {
    return;
}

// Group by optional "group" label (ungrouped items share the empty key).
$groups = array();
foreach ( $brands as $b ) {
    $g = trim( (string) ( $b['group'] ?? '' ) );
    $groups[ $g ][] = $b;
}
?>
<section class="pb-section">
    <div class="container">
        <h2 class="pb-title"><?php echo esc_html( $title ); ?></h2>

        <?php foreach ( $groups as $gname => $items ) : ?>
            <?php if ( '' !== $gname ) : ?>
                <h3 class="pb-group"><?php echo esc_html( $gname ); ?></h3>
            <?php endif; ?>
            <div class="pb-grid">
                <?php foreach ( $items as $b ) :
                    $logo = wp_get_attachment_image_url( (int) $b['logo'], 'medium' );
                    if ( ! $logo ) {
                        continue;
                    }
                    $url = trim( (string) ( $b['url'] ?? '' ) );
                ?>
                    <?php if ( '' !== $url ) : ?>
                        <a class="pb-card" href="<?php echo esc_url( $url ); ?>" target="_blank" rel="noopener noreferrer">
                            <img src="<?php echo esc_url( $logo ); ?>" alt="" loading="lazy">
                        </a>
                    <?php else : ?>
                        <div class="pb-card pb-card--static">
                            <img src="<?php echo esc_url( $logo ); ?>" alt="" loading="lazy">
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    </div>
</section>
