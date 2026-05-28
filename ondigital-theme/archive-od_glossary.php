<?php
/**
 * Glossary (Sözlük) archive template.
 *
 * @package OnDigital
 */

add_action( 'wp_head', function () {
    $meta_title = ondigital_get_option( 'dict_meta_title', '' );
    $meta_desc  = ondigital_get_option( 'dict_meta_desc',  '' );
    if ( $meta_title ) {
        echo '<title>' . esc_html( $meta_title ) . '</title>' . "\n";
    }
    if ( $meta_desc ) {
        echo '<meta name="description" content="' . esc_attr( $meta_desc ) . '">' . "\n";
    }
}, 1 );

get_header();

get_template_part( 'template-parts/glossary/archive' );

get_footer();
