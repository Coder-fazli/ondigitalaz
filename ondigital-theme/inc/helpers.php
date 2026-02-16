<?php
/**
 * OnDigital Helper Functions
 *
 * @package OnDigital
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Get theme mod with fallback.
 */
function ondigital_get_option( $key, $default = '' ) {
    return get_theme_mod( 'ondigital_' . $key, $default );
}

/**
 * Convert an attachment ID to a URL, with fallback to a default path.
 *
 * @param string $mod_name  Theme mod name (without prefix).
 * @param string $fallback  Fallback path relative to theme URI (e.g. '/assets/imgs/gallery/img.webp').
 * @param string $size      Image size for wp_get_attachment_image_url().
 * @return string Image URL.
 */
function ondigital_img( $mod_name, $fallback = '', $size = 'full' ) {
    $attachment_id = get_theme_mod( 'ondigital_' . $mod_name );
    if ( $attachment_id ) {
        $url = wp_get_attachment_image_url( $attachment_id, $size );
        if ( $url ) {
            return $url;
        }
    }
    if ( $fallback ) {
        return ONDIGITAL_URI . $fallback;
    }
    return '';
}

/**
 * Get a repeater option (serialized array stored via Theme Options page).
 *
 * @param string $key     Option name.
 * @param array  $default Default value if option doesn't exist.
 * @return array
 */
function ondigital_get_repeater( $key, $default = array() ) {
    $data = get_option( 'ondigital_' . $key, $default );
    if ( ! is_array( $data ) || empty( $data ) ) {
        return $default;
    }
    return $data;
}
