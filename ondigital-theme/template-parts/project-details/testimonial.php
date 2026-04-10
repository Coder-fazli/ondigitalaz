<?php
/**
 * Project Details — Testimonial / Quote Section
 *
 * @package OnDigital
 */

$quote    = ondigital_get_option( 'project_quote',       __( 'We were spending €8,000 a month on ads and barely breaking even. Ondigital completely changed how we think about our digital presence — the results speak for themselves.', 'ondigital' ) );
$author   = ondigital_get_option( 'project_author',      'Sara Khalil' );
$role     = ondigital_get_option( 'project_author_role', __( 'Founder, Alas Academy', 'ondigital' ) );
$initials = ondigital_get_option( 'project_author_initials', 'SK' );

if ( ! $quote ) {
    return;
}
?>
<section class="cs-section cs-quote-sec">
    <div class="cs-qi">
        <div class="cs-qmark cs-fade">"</div>
        <p class="cs-qtext cs-fade cs-d1"><?php echo esc_html( $quote ); ?></p>
        <div class="cs-qauthor cs-fade cs-d2">
            <div class="cs-qav"><?php echo esc_html( $initials ); ?></div>
            <div>
                <?php if ( $author ) : ?>
                    <div class="cs-qname"><?php echo esc_html( $author ); ?></div>
                <?php endif; ?>
                <?php if ( $role ) : ?>
                    <div class="cs-qrole"><?php echo esc_html( $role ); ?></div>
                <?php endif; ?>
                <div class="cs-qstars">
                    <?php for ( $s = 0; $s < 5; $s++ ) : ?>
                        <svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                    <?php endfor; ?>
                </div>
            </div>
        </div>
    </div>
</section>
