<?php
/**
 * Project Details — CTA Section
 *
 * @package OnDigital
 */

$eyebrow  = ondigital_get_option( 'project_cta_eyebrow', __( 'Ready to grow?', 'ondigital' ) );
$title    = ondigital_get_option( 'project_cta_title',   __( 'Want results like these?', 'ondigital' ) );
$desc     = ondigital_get_option( 'project_cta_desc',    __( "Let's talk about your business and build a strategy that actually delivers.", 'ondigital' ) );
$btn_url  = ondigital_get_option( 'project_cta_btn_url', home_url( '/elaqe/' ) );
$btn_text = ondigital_get_option( 'project_cta_btn_text', __( 'Book a Free Strategy Call', 'ondigital' ) );
?>
<section class="cs-section cs-cta-sec">
    <div class="cs-cta-line-t"></div>
    <div class="cs-cta-circle"></div>
    <div class="cs-cta-dot"></div>
    <div class="cs-cta-square"></div>

    <div class="cs-cta-inner">
        <?php if ( $eyebrow ) : ?>
            <div class="cs-cta-ey cs-fade"><?php echo esc_html( $eyebrow ); ?></div>
        <?php endif; ?>
        <h2 class="cs-cta-title cs-fade cs-d1">
            <?php
            // Split title at last word to italicise it
            $words = explode( ' ', $title );
            $last  = array_pop( $words );
            echo esc_html( implode( ' ', $words ) ) . '<br><em>' . esc_html( $last ) . '</em>';
            ?>
        </h2>
        <?php if ( $desc ) : ?>
            <p class="cs-cta-sub cs-fade cs-d2"><?php echo esc_html( $desc ); ?></p>
        <?php endif; ?>
        <div class="cs-cta-btns cs-fade cs-d3">
            <a href="<?php echo esc_url( $btn_url ); ?>" class="cs-btn-acc">
                <?php echo esc_html( $btn_text ); ?>
                <svg viewBox="0 0 24 24" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </a>
            <a href="<?php echo esc_url( home_url( '/portfolio/' ) ); ?>" class="cs-btn-wh">
                <?php esc_html_e( 'View All Projects', 'ondigital' ); ?>
            </a>
        </div>
    </div>
</section>
