<?php
/**
 * OnDigital — Sözlük (Glossary) CPT + Taxonomy
 *
 * CPT   : od_glossary
 * Tax   : glossary_cat
 * Slug  : sozluk / sozluk-cat
 *
 * @package OnDigital
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// =============================================================================
// Register CPT
// =============================================================================

add_action( 'init', 'ondigital_register_glossary_cpt' );
function ondigital_register_glossary_cpt(): void {
    $labels = array(
        'name'               => __( 'Sözlük', 'ondigital' ),
        'singular_name'      => __( 'Termin', 'ondigital' ),
        'menu_name'          => __( 'Sözlük', 'ondigital' ),
        'add_new'            => __( 'Yeni termin', 'ondigital' ),
        'add_new_item'       => __( 'Yeni termin əlavə et', 'ondigital' ),
        'edit_item'          => __( 'Termini redaktə et', 'ondigital' ),
        'new_item'           => __( 'Yeni termin', 'ondigital' ),
        'view_item'          => __( 'Termini gör', 'ondigital' ),
        'search_items'       => __( 'Termin axtar', 'ondigital' ),
        'not_found'          => __( 'Termin tapılmadı', 'ondigital' ),
        'not_found_in_trash' => __( 'Zibildə termin yoxdur', 'ondigital' ),
    );

    register_post_type( 'od_glossary', array(
        'labels'             => $labels,
        'public'             => true,
        'show_in_menu'       => true,
        'menu_position'      => 6,
        'menu_icon'          => 'dashicons-book-alt',
        'supports'           => array( 'title', 'editor', 'thumbnail' ),
        'has_archive'        => true,
        'rewrite'            => array( 'slug' => 'sozluk', 'with_front' => false ),
        'show_in_rest'       => true,
    ) );
}

// =============================================================================
// Register Taxonomy
// =============================================================================

add_action( 'init', 'ondigital_register_glossary_taxonomy' );
function ondigital_register_glossary_taxonomy(): void {
    $labels = array(
        'name'              => __( 'Kateqoriyalar', 'ondigital' ),
        'singular_name'     => __( 'Kateqoriya', 'ondigital' ),
        'search_items'      => __( 'Kateqoriya axtar', 'ondigital' ),
        'all_items'         => __( 'Bütün kateqoriyalar', 'ondigital' ),
        'edit_item'         => __( 'Kateqoriyanı redaktə et', 'ondigital' ),
        'add_new_item'      => __( 'Yeni kateqoriya', 'ondigital' ),
        'menu_name'         => __( 'Kateqoriyalar', 'ondigital' ),
    );

    register_taxonomy( 'glossary_cat', 'od_glossary', array(
        'labels'            => $labels,
        'hierarchical'      => true,
        'public'            => true,
        'show_in_rest'      => true,
        'rewrite'           => array( 'slug' => 'sozluk-cat', 'with_front' => false ),
    ) );
}

// =============================================================================
// Polylang — register CPT and taxonomy as translatable
// =============================================================================

add_filter( 'pll_get_post_types', 'ondigital_glossary_pll_post_types' );
function ondigital_glossary_pll_post_types( array $types ): array {
    $types['od_glossary'] = 'od_glossary';
    return $types;
}

add_filter( 'pll_get_taxonomies', 'ondigital_glossary_pll_taxonomies' );
function ondigital_glossary_pll_taxonomies( array $taxonomies ): array {
    $taxonomies['glossary_cat'] = 'glossary_cat';
    return $taxonomies;
}

// =============================================================================
// Flush rewrite rules on activation (run once)
// =============================================================================

add_action( 'after_switch_theme', 'ondigital_glossary_flush_rewrites' );
function ondigital_glossary_flush_rewrites(): void {
    ondigital_register_glossary_cpt();
    ondigital_register_glossary_taxonomy();
    flush_rewrite_rules();
}
