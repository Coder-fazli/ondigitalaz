<?php
/**
 * OnDigital — SEO meta (title + description) from theme options.
 *
 * The site uses Rank Math, which outputs the <title> and meta description.
 * These per-page theme-option fields are routed through Rank Math's filters so
 * they cleanly OVERRIDE Rank Math when set (no duplicate tags). A non-Rank-Math
 * fallback is included in case the plugin is ever disabled.
 *
 * @package OnDigital
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Resolve the title/description override for the current page from theme options.
 * Returns array( 'title' => '', 'desc' => '' ); '' means "no override".
 */
function ondigital_seo_meta(): array {
    static $cache = null;
    if ( $cache !== null ) {
        return $cache;
    }

    $base = '';
    if ( is_page_template( 'templates/page-about-new.php' ) || is_page_template( 'templates/page-about.php' ) ) {
        $base = 'about';
    } elseif ( is_page_template( 'templates/page-contact.php' ) ) {
        $base = 'contact';
    } elseif ( is_page_template( 'templates/page-blog.php' ) ) {
        $base = 'blog';
    } elseif ( is_page_template( 'templates/page-services.php' ) || is_post_type_archive( 'service' ) ) {
        $base = 'services';
    } elseif ( is_page_template( 'templates/page-projects.php' ) || is_post_type_archive( 'project' ) ) {
        $base = 'projects';
    } elseif ( is_page_template( 'templates/page-glossary.php' ) || is_post_type_archive( 'od_glossary' ) ) {
        $base = 'dict';
    }

    if ( '' === $base ) {
        $cache = array( 'title' => '', 'desc' => '' );
        return $cache;
    }

    $cache = array(
        'title' => ondigital_get_option( $base . '_meta_title', '' ),
        'desc'  => ondigital_get_option( $base . '_meta_desc', '' ),
    );
    return $cache;
}

/* ── Rank Math (active SEO plugin): let theme options win when set ── */
add_filter( 'rank_math/frontend/title', function ( $title ) {
    $t = ondigital_seo_meta()['title'];
    return '' !== $t ? $t : $title;
} );

add_filter( 'rank_math/frontend/description', function ( $desc ) {
    $d = ondigital_seo_meta()['desc'];
    return '' !== $d ? $d : $desc;
} );

/* ── Fallback when Rank Math is NOT active ── */
function ondigital_seo_has_rankmath(): bool {
    return defined( 'RANK_MATH_VERSION' ) || class_exists( 'RankMath' );
}

add_filter( 'pre_get_document_title', function ( $title ) {
    if ( ondigital_seo_has_rankmath() ) {
        return $title;
    }
    $t = ondigital_seo_meta()['title'];
    return '' !== $t ? $t : $title;
}, 30 );

add_action( 'wp_head', function () {
    if ( ondigital_seo_has_rankmath() ) {
        return;
    }
    $d = ondigital_seo_meta()['desc'];
    if ( '' !== $d ) {
        echo '<meta name="description" content="' . esc_attr( $d ) . '">' . "\n";
    }
}, 1 );
