<?php
/**
 * Auto-create required theme pages + Polylang AZ translations.
 *
 * @package OnDigital
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'init', 'ondigital_create_required_pages' );
function ondigital_create_required_pages(): void {
    if ( wp_doing_ajax() || ! is_admin() ) {
        return;
    }

    // ── Required EN pages ────────────────────────────────────────────────────
    $pages = array(
        array(
            'slug'     => 'thank-you',
            'title_en' => 'Thank You',
            'title_az' => 'Təşəkkür edirik',
            'template' => 'templates/page-thank-you.php',
        ),
    );

    foreach ( $pages as $page ) {
        // Create EN version
        $en_page = get_page_by_path( $page['slug'] );
        if ( ! $en_page ) {
            $en_id = wp_insert_post( array(
                'post_title'     => $page['title_en'],
                'post_name'      => $page['slug'],
                'post_status'    => 'publish',
                'post_type'      => 'page',
                'comment_status' => 'closed',
            ) );
            if ( $en_id && ! is_wp_error( $en_id ) ) {
                update_post_meta( $en_id, '_wp_page_template', $page['template'] );
                if ( function_exists( 'pll_set_post_language' ) ) {
                    pll_set_post_language( $en_id, 'en' );
                }
            }
        } else {
            $en_id = $en_page->ID;
        }

        // Create AZ translation if Polylang is active
        if ( ! function_exists( 'pll_get_post' ) ) {
            continue;
        }

        $az_id = pll_get_post( $en_id, 'az' );
        if ( $az_id ) {
            continue;
        }

        $az_id = wp_insert_post( array(
            'post_title'     => $page['title_az'],
            'post_name'      => $page['slug'] . '-az',
            'post_status'    => 'publish',
            'post_type'      => 'page',
            'comment_status' => 'closed',
        ) );

        if ( $az_id && ! is_wp_error( $az_id ) ) {
            update_post_meta( $az_id, '_wp_page_template', $page['template'] );
            pll_set_post_language( $az_id, 'az' );
            pll_save_post_translations( array( 'en' => $en_id, 'az' => $az_id ) );
        }
    }

    // ── Auto-create AZ translation of the front page ─────────────────────────
    ondigital_setup_az_home();
}

function ondigital_setup_az_home(): void {
    if ( ! function_exists( 'pll_get_post' ) || ! function_exists( 'pll_set_post_language' ) ) {
        return;
    }

    // Only works when a static front page is set
    $front_page_id = (int) get_option( 'page_on_front' );
    if ( ! $front_page_id ) {
        return;
    }

    // Already has AZ translation — nothing to do
    if ( pll_get_post( $front_page_id, 'az' ) ) {
        return;
    }

    // Get the EN front page
    $front_page = get_post( $front_page_id );
    if ( ! $front_page ) {
        return;
    }

    // Create AZ home page
    $az_home_id = wp_insert_post( array(
        'post_title'     => $front_page->post_title . ' (AZ)',
        'post_name'      => $front_page->post_name . '-az',
        'post_status'    => 'publish',
        'post_type'      => 'page',
        'comment_status' => 'closed',
    ) );

    if ( ! $az_home_id || is_wp_error( $az_home_id ) ) {
        return;
    }

    // Copy template from EN
    $template = get_post_meta( $front_page_id, '_wp_page_template', true );
    if ( $template ) {
        update_post_meta( $az_home_id, '_wp_page_template', $template );
    }

    // Set language + link as translation
    pll_set_post_language( $az_home_id, 'az' );
    pll_save_post_translations( array(
        'en' => $front_page_id,
        'az' => $az_home_id,
    ) );
}
