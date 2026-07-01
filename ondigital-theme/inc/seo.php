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

/* ============================================================================
 * Canonical URL — self-referencing and language-aware (Polylang).
 * The site was outputting no canonical at all; we emit exactly one per page,
 * each language pointing to its own URL.
 * ========================================================================== */

/**
 * Resolve the canonical URL for the current request.
 */
function ondigital_canonical_url(): string {
    // Home / front page — current language home.
    if ( is_front_page() ) {
        return function_exists( 'pll_home_url' ) ? pll_home_url() : home_url( '/' );
    }
    // Blog posts index (if a separate page).
    if ( is_home() ) {
        $blog_id = (int) get_option( 'page_for_posts' );
        if ( $blog_id ) {
            return get_permalink( $blog_id );
        }
    }
    // Singular posts, pages and CPTs (page templates included) — language-specific permalink.
    if ( is_singular() ) {
        return get_permalink();
    }
    // Custom post type archives (services, projects, glossary…).
    if ( is_post_type_archive() ) {
        $pt = get_query_var( 'post_type' );
        if ( is_array( $pt ) ) {
            $pt = reset( $pt );
        }
        $link = get_post_type_archive_link( $pt );
        if ( $link ) {
            return $link;
        }
    }
    // Taxonomy / category / tag archives.
    if ( is_category() || is_tag() || is_tax() ) {
        $term = get_queried_object();
        if ( $term && ! is_wp_error( $term ) ) {
            $link = get_term_link( $term );
            if ( ! is_wp_error( $link ) ) {
                return $link;
            }
        }
    }
    // Fallback: current path without the query string (drops tracking params).
    $path = isset( $_SERVER['REQUEST_URI'] ) ? strtok( wp_unslash( $_SERVER['REQUEST_URI'] ), '?' ) : '/';
    return home_url( $path );
}

// Remove WordPress core's canonical and Rank Math's (which was empty) so ours is the only one.
remove_action( 'wp_head', 'rel_canonical' );
add_filter( 'rank_math/frontend/canonical', '__return_empty_string' );

add_action( 'wp_head', function () {
    if ( is_404() || is_search() ) {
        return;
    }
    $url = ondigital_canonical_url();
    if ( $url ) {
        echo '<link rel="canonical" href="' . esc_url( $url ) . '">' . "\n";
    }
}, 2 );
