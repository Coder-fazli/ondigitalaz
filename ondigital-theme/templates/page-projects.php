<?php
/**
 * Template Name: Projects Page
 *
 * @package OnDigital
 */

add_action( 'wp_enqueue_scripts', function() {
    // Version by file modified-time so uploads always bust the cache.
    $ver = function ( string $rel ) {
        $path = get_template_directory() . $rel;
        return file_exists( $path ) ? (string) filemtime( $path ) : ONDIGITAL_VERSION;
    };
    wp_enqueue_style(
        'ondigital-projects-archive',
        get_template_directory_uri() . '/assets/css/components/projects-archive.css',
        array(),
        $ver( '/assets/css/components/projects-archive.css' )
    );
    // Logo cloud for partners section
    wp_enqueue_style( 'ondigital-logo-cloud', get_template_directory_uri() . '/assets/css/components/logo-cloud.css', array(), $ver( '/assets/css/components/logo-cloud.css' ) );
    wp_enqueue_script( 'ondigital-logo-cloud', get_template_directory_uri() . '/assets/js/components/logo-cloud.js', array(), $ver( '/assets/js/components/logo-cloud.js' ), true );
}, 20 );

get_header();

// Section 1: Hero + Partners marquee (project cards grid hidden via CSS)
get_template_part( 'template-parts/projects/hero' );

// Section 2: Sectoral Distribution (light)
get_template_part( 'template-parts/projects/sectors' );

// Section 3: Brands We Worked With grid (dark)
get_template_part( 'template-parts/projects/brands' );

// Section 3: CTA (shared) — wrapped so we can center it via CSS
echo '<div class="projects-page-cta">';
get_template_part( 'template-parts/shared/cta' );
echo '</div>';

get_footer();
