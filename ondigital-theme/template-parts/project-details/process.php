<?php
/**
 * Project Details — Process / Steps Section
 *
 * @package OnDigital
 */

$id      = get_the_ID();
$eyebrow = get_post_meta( $id, '_od_process_eyebrow', true ) ?: __( 'Our Process', 'ondigital' );
$heading = get_post_meta( $id, '_od_process_heading', true ) ?: __( 'How we made it happen.', 'ondigital' );
$steps   = get_post_meta( $id, '_od_steps', true );

if ( empty( $steps ) || ! is_array( $steps ) ) {
    return;
}

// Filter out empty steps
$steps = array_filter( $steps, function( $s ) {
    return ! empty( $s['title_az'] ) || ! empty( $s['title_en'] );
} );

if ( empty( $steps ) ) {
    return;
}

$icons = array(
    '<svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>',
    '<svg viewBox="0 0 24 24"><polygon points="12 2 2 7 12 12 22 7 12 2"/><polyline points="2 17 12 22 22 17"/><polyline points="2 12 12 17 22 12"/></svg>',
    '<svg viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18M9 21V9"/></svg>',
    '<svg viewBox="0 0 24 24"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>',
    '<svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>',
);

$lang = function_exists( 'pll_current_language' ) ? pll_current_language() : 'en';
?>
<section class="cs-section cs-process-sec">
    <div class="cs-inner">
        <div class="cs-stag cs-fade"><?php echo esc_html( $eyebrow ); ?></div>
        <h2 class="cs-process-heading cs-fade cs-d1"><?php echo esc_html( $heading ); ?></h2>

        <div class="cs-steps">
            <?php $i = 0; foreach ( $steps as $step ) :
                $delay = 'd' . ( ( $i % 4 ) + 1 );
                $num   = str_pad( $i + 1, 2, '0', STR_PAD_LEFT );
                $icon  = $icons[ $i % count( $icons ) ];
                $title = $step[ 'title_' . $lang ] ?? $step['title_az'] ?? '';
                $desc  = $step[ 'desc_' . $lang ]  ?? $step['desc_az']  ?? '';
                $dur   = $step['duration'] ?? '';
                $i++;
            ?>
                <div class="cs-step cs-fade <?php echo esc_attr( $delay ); ?>">
                    <div class="cs-step-n"><?php echo esc_html( $num ); ?></div>
                    <div class="cs-step-connector"></div>
                    <div class="cs-step-icon"><?php echo $icon; // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
                    <div class="cs-step-body">
                        <div class="cs-step-title"><?php echo esc_html( $title ); ?></div>
                        <div class="cs-step-desc"><?php echo esc_html( $desc ); ?></div>
                    </div>
                    <?php if ( $dur ) : ?>
                        <div class="cs-step-dur"><?php echo esc_html( $dur ); ?></div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
