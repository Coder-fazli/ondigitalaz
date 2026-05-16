<?php
/**
 * Contact - Hero Section
 *
 * @package OnDigital
 */

$options = get_option( 'ondigital_options', array() );
$lang    = function_exists( 'pll_current_language' ) ? pll_current_language() : 'en';
$badge   = $options[ 'contact_badge_' . $lang ] ?? $options['contact_badge_az'] ?? __( 'Bizimlə əlaqə', 'ondigital' );
$title   = $options[ 'contact_title_' . $lang ] ?? $options['contact_title_az'] ?? __( 'Sualınız var? Sadəcə soruşun.', 'ondigital' );
?>
<section class="contact-hero">
    <div class="contact-hero-inner">
        <?php if ( $badge ) : ?>
        <div class="contact-hero-badge">
            <span><?php echo esc_html( $badge ); ?></span>
        </div>
        <?php endif; ?>
        <h1 class="contact-hero-title"><?php echo wp_kses( $title, array( 'em' => array(), 'br' => array(), 'strong' => array() ) ); ?></h1>
    </div>
</section>
