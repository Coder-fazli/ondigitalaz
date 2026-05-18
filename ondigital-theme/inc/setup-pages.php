<?php
/**
 * Auto-create required theme pages if they don't exist.
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

    $pages = array(
        array(
            'slug'     => 'teshekkurler',
            'title'    => 'Thank You',
            'template' => 'templates/page-thank-you.php',
        ),
    );

    foreach ( $pages as $page ) {
        $existing = get_page_by_path( $page['slug'] );
        if ( $existing ) {
            continue;
        }

        $page_id = wp_insert_post( array(
            'post_title'     => $page['title'],
            'post_name'      => $page['slug'],
            'post_status'    => 'publish',
            'post_type'      => 'page',
            'comment_status' => 'closed',
        ) );

        if ( $page_id && ! is_wp_error( $page_id ) ) {
            update_post_meta( $page_id, '_wp_page_template', $page['template'] );
        }
    }
}
