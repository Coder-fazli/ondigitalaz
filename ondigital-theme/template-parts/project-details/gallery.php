<?php
/**
 * Project Details — Gallery Section
 *
 * @package OnDigital
 */

$imgs = array();
for ( $n = 1; $n <= 3; $n++ ) {
    $id  = absint( ondigital_get_option( 'project_gallery_' . $n, '0' ) );
    $url = $id ? wp_get_attachment_image_url( $id, 'large' ) : '';
    $alt = $id ? get_post_meta( $id, '_wp_attachment_image_alt', true ) : '';
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
            <?php foreach ( $imgs as $idx => $img ) :
                $delay = 'd' . ( $idx + 1 );
            ?>
                <div class="cs-gi cs-fade <?php echo esc_attr( $delay ); ?>">
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
