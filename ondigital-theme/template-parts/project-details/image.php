<?php
/**
 * Project Details — Full-Width Image Section
 *
 * @package OnDigital
 */

$image_id  = absint( ondigital_get_option( 'project_hero_image', '0' ) );
$image_url = $image_id ? wp_get_attachment_image_url( $image_id, 'full' ) : '';

if ( ! $image_url ) {
    return;
}
?>
<div class="cs-img-sec">
    <div class="cs-img-wrap cs-fade">
        <img
            src="<?php echo esc_url( $image_url ); ?>"
            alt="<?php echo esc_attr( get_post_meta( $image_id, '_wp_attachment_image_alt', true ) ); ?>"
            loading="lazy"
        >
    </div>
</div>
