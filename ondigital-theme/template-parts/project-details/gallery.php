<?php
/**
 * Project Details — Gallery Section
 *
 * @package OnDigital
 */

$id   = get_the_ID();
$imgs = array();

for ( $n = 1; $n <= 3; $n++ ) {
    $img_id = absint( get_post_meta( $id, "_od_gallery_{$n}", true ) );
    $url    = $img_id ? wp_get_attachment_image_url( $img_id, 'large' ) : '';
    $alt    = $img_id ? get_post_meta( $img_id, '_wp_attachment_image_alt', true ) : '';
    if ( $url ) {
        $imgs[] = array( 'url' => $url, 'alt' => $alt );
    }
}

if ( empty( $imgs ) ) {
    return;
}
?>
<section class="cs-section cs-gallery-sec">
    <div class="cs-inner">
        <div class="cs-stag cs-fade"><?php esc_html_e( 'Project Gallery', 'ondigital' ); ?></div>
        <div class="cs-gg">
            <?php foreach ( $imgs as $idx => $img ) : ?>
                <div class="cs-gi cs-fade d<?php echo $idx + 1; ?>">
                    <img
                        src="<?php echo esc_url( $img['url'] ); ?>"
                        alt="<?php echo esc_attr( $img['alt'] ); ?>"
                        loading="lazy"
                        <?php echo $idx === 0 ? 'style="object-position:center top;"' : ''; ?>
                    >
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
