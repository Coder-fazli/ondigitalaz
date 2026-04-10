<?php
/**
 * OnDigital Panel — Save Handler (AJAX)
 *
 * @package OnDigital
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'wp_ajax_ondigital_save', 'ondigital_panel_save' );
function ondigital_panel_save(): void {
    check_ajax_referer( 'ondigital_save', 'nonce' );

    if ( ! current_user_can( 'manage_options' ) ) {
        wp_send_json_error( 'Unauthorized' );
    }

    // Options come as JSON string from JS
    $raw_options = isset( $_POST['options'] ) ? wp_unslash( $_POST['options'] ) : '{}';
    $posted      = json_decode( $raw_options, true );
    if ( ! is_array( $posted ) ) {
        $posted = array();
    }

    // Sanitize all scalar options
    $existing = get_option( 'ondigital_options', array() );
    $updated  = $existing;

    // Keys treated as passwords — never overwrite with empty string
    $password_keys = array( 'smtp_password' );

    foreach ( $posted as $key => $value ) {
        $key = sanitize_key( $key );
        if ( is_array( $value ) ) {
            continue;
        }
        // Don't wipe a stored password if the field was left blank
        if ( in_array( $key, $password_keys, true ) && $value === '' ) {
            continue;
        }
        if ( substr( $key, -4 ) === '_url' ) {
            $updated[ $key ] = esc_url_raw( $value );
        } elseif ( in_array( $key, $password_keys, true ) ) {
            $updated[ $key ] = $value; // store as-is, no kses stripping
        } else {
            $updated[ $key ] = wp_kses( $value, array( 'span' => array( 'class' => array() ) ) );
        }
    }

    update_option( 'ondigital_options', $updated );

    // Handle repeaters
    $repeater_keys = array( 'partners', 'features', 'pricing', 'faq', 'stats', 'testimonials', 'text_slider', 'about_clients', 'about_faq_items', 'footer_quick_links', 'footer_services_links', 'project_steps' );

    foreach ( $repeater_keys as $rkey ) {
        if ( ! isset( $_POST[ 'ondigital_' . $rkey ] ) ) {
            continue;
        }
        $raw  = wp_unslash( $_POST[ 'ondigital_' . $rkey ] );
        $data = ondigital_sanitize_repeater( $rkey, $raw );
        update_option( 'ondigital_' . $rkey, $data );
    }

    wp_send_json_success( array( 'message' => __( 'Saved!', 'ondigital' ) ) );
}

function ondigital_sanitize_repeater( string $key, array $raw ): array {
    $out = array();

    foreach ( $raw as $item ) {
        if ( ! is_array( $item ) ) {
            continue;
        }
        switch ( $key ) {
            case 'partners':
                $out[] = array(
                    'image_light' => absint( $item['image_light'] ?? 0 ),
                    'image_dark'  => absint( $item['image_dark'] ?? 0 ),
                    'alt'         => sanitize_text_field( $item['alt'] ?? '' ),
                );
                break;
            case 'features':
                $out[] = array(
                    'title'       => sanitize_text_field( $item['title'] ?? '' ),
                    'description' => sanitize_textarea_field( $item['description'] ?? '' ),
                    'icon_light'  => absint( $item['icon_light'] ?? 0 ),
                    'icon_dark'   => absint( $item['icon_dark'] ?? 0 ),
                );
                break;
            case 'pricing':
                $out[] = array(
                    'name'     => sanitize_text_field( $item['name'] ?? '' ),
                    'price'    => sanitize_text_field( $item['price'] ?? '' ),
                    'features' => sanitize_textarea_field( $item['features'] ?? '' ),
                    'cta_url'  => esc_url_raw( $item['cta_url'] ?? '' ),
                );
                break;
            case 'faq':
            case 'about_faq_items':
                $out[] = array(
                    'question' => sanitize_text_field( $item['question'] ?? '' ),
                    'answer'   => sanitize_textarea_field( $item['answer'] ?? '' ),
                    'open'     => ! empty( $item['open'] ) ? 1 : 0,
                );
                break;
            case 'stats':
                $out[] = array(
                    'number' => sanitize_text_field( $item['number'] ?? '' ),
                    'suffix' => sanitize_text_field( $item['suffix'] ?? '' ),
                    'label'  => sanitize_text_field( $item['label'] ?? '' ),
                );
                break;
            case 'testimonials':
                $out[] = array(
                    'quote' => sanitize_textarea_field( $item['quote'] ?? '' ),
                    'name'  => sanitize_text_field( $item['name'] ?? '' ),
                    'role'  => sanitize_text_field( $item['role'] ?? '' ),
                );
                break;
            case 'text_slider':
                $out[] = array(
                    'text'        => sanitize_text_field( $item['text'] ?? '' ),
                    'highlighted' => sanitize_text_field( $item['highlighted'] ?? '' ),
                );
                break;
            case 'about_clients':
                $out[] = array(
                    'img_light' => absint( $item['img_light'] ?? 0 ),
                    'img_dark'  => absint( $item['img_dark'] ?? 0 ),
                    'alt'       => sanitize_text_field( $item['alt'] ?? '' ),
                );
                break;
            case 'footer_quick_links':
            case 'footer_services_links':
                $out[] = array(
                    'label' => sanitize_text_field( $item['label'] ?? '' ),
                    'url'   => esc_url_raw( $item['url'] ?? '' ),
                );
                break;
            case 'project_steps':
                $out[] = array(
                    'title_az' => sanitize_text_field( $item['title_az'] ?? '' ),
                    'title_en' => sanitize_text_field( $item['title_en'] ?? '' ),
                    'desc_az'  => sanitize_textarea_field( $item['desc_az'] ?? '' ),
                    'desc_en'  => sanitize_textarea_field( $item['desc_en'] ?? '' ),
                    'duration' => sanitize_text_field( $item['duration'] ?? '' ),
                );
                break;
        }
    }

    return $out;
}
