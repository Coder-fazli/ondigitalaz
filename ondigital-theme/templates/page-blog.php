<?php
/**
 * Template Name: Blog Page
 *
 * @package OnDigital
 */

add_action( 'wp_head', function () {
    $meta_title = ondigital_get_option( 'blog_meta_title', '' );
    $meta_desc  = ondigital_get_option( 'blog_meta_desc',  '' );
    if ( $meta_title ) {
        echo '<title>' . esc_html( $meta_title ) . '</title>' . "\n";
    }
    if ( $meta_desc ) {
        echo '<meta name="description" content="' . esc_attr( $meta_desc ) . '">' . "\n";
    }
}, 1 );

get_header();

// Section 1: Hero / Featured
get_template_part( 'template-parts/blog/hero' );

// Section 2: Featured Posts
get_template_part( 'template-parts/blog/featured-posts' );

// Section 3: Blog Grid with Pagination
get_template_part( 'template-parts/blog/grid' );

get_footer();
