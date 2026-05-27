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
 * Get the current language code (en, az, etc.).
 * Defaults to 'en' when Polylang is not active.
 */
function ondigital_get_lang(): string {
    if ( function_exists( 'pll_current_language' ) ) {
        return pll_current_language() ?: 'en';
    }
    return 'en';
}

/**
 * Read a scalar option from the central options array.
 * Tries current language key first, then EN, then AZ, then $default.
 */
function ondigital_get_option( string $key, string $default = '' ): string {
    static $options = null;
    if ( $options === null ) {
        $options = get_option( 'ondigital_options', array() );
    }

    $lang     = ondigital_get_lang();
    $lang_key = $key . '_' . $lang;
    $en_key   = $key . '_en';
    $az_key   = $key . '_az';

    if ( ! empty( $options[ $lang_key ] ) ) {
        return $options[ $lang_key ];
    }
    // Non-EN languages fall back to EN, never the other way around
    if ( $lang !== 'en' && ! empty( $options[ $en_key ] ) ) {
        return $options[ $en_key ];
    }
    // Legacy fallback (no suffix)
    if ( ! empty( $options[ $key ] ) ) {
        return $options[ $key ];
    }
    return $default;
}

/**
 * Convert an attachment ID (stored in options) to a URL.
 * Falls back to a theme asset path.
 */
function ondigital_img( string $key, string $fallback = '', string $size = 'full' ): string {
    static $options = null;
    if ( $options === null ) {
        $options = get_option( 'ondigital_options', array() );
    }

    $attachment_id = ! empty( $options[ $key ] ) ? absint( $options[ $key ] ) : 0;
    if ( $attachment_id ) {
        $url = wp_get_attachment_image_url( $attachment_id, $size );
        if ( $url ) {
            return $url;
        }
    }
    return $fallback ? ONDIGITAL_URI . $fallback : '';
}

/**
 * Return array of non-empty social media URLs.
 */
function ondigital_get_social_links(): array {
    $defaults = array(
        'facebook'  => 'https://www.facebook.com/ondigital.az',
        'linkedin'  => 'https://www.linkedin.com/company/ondigital-az/',
        'tiktok'    => 'https://www.tiktok.com/@ondigital.az',
        'instagram' => 'https://www.instagram.com/ondigital.az/',
        'behance'   => 'https://www.behance.net/ondigitalaz/moodboards',
        'pinterest' => 'https://www.pinterest.com/ondigital_az/',
    );

    $options = get_option( 'ondigital_options', array() );
    $links   = array();

    foreach ( $defaults as $key => $default_url ) {
        $url = ! empty( $options[ $key ] ) ? $options[ $key ] : $default_url;
        $links[ $key ] = esc_url( $url );
    }

    // youtube + whatsapp only if explicitly set (no default)
    if ( ! empty( $options['youtube'] ) ) {
        $links['youtube'] = esc_url( $options['youtube'] );
    }
    if ( ! empty( $options['whatsapp'] ) ) {
        $links['whatsapp'] = esc_url( $options['whatsapp'] );
    }

    return $links;
}

/**
 * Get a repeater array stored as its own option.
 */
function ondigital_get_repeater( string $key, array $default = array() ): array {
    $data = get_option( 'ondigital_' . $key, null );
    if ( is_array( $data ) && ! empty( $data ) ) {
        return $data;
    }
    return $default;
}
