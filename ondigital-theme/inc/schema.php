<?php
/**
 * OnDigital — Custom Schema (JSON-LD structured data)
 *
 * Fully self-contained structured data. Rank Math's own JSON-LD is disabled
 * below so it can never override or conflict with this output.
 *
 * @package OnDigital
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Stop Rank Math from printing its (mis-configured Person/Article) JSON-LD.
 * Meta tags / titles / OG from Rank Math are left untouched — only schema is removed.
 */
add_filter( 'rank_math/json_ld', function ( $data ) {
    return array();
}, 99 );

/**
 * Organization node — the central entity referenced by everything else.
 */
function ondigital_schema_organization(): array {
    $home = home_url( '/' );

    // Logo: footer logo option → custom logo → empty.
    $logo_id  = (int) ondigital_get_option( 'footer_logo' );
    if ( ! $logo_id ) {
        $logo_id = (int) get_theme_mod( 'custom_logo' );
    }
    $logo_url = $logo_id ? wp_get_attachment_image_url( $logo_id, 'full' ) : '';

    $phone   = ondigital_get_option( 'contact_phone' )   ?: get_theme_mod( 'ondigital_phone', '' );
    $email   = ondigital_get_option( 'contact_email' )   ?: get_theme_mod( 'ondigital_email', '' );
    $address = ondigital_get_option( 'contact_address' ) ?: get_theme_mod( 'ondigital_address', '' );

    $org = array(
        '@type' => 'Organization',
        '@id'   => $home . '#organization',
        'name'  => get_bloginfo( 'name' ),
        'url'   => $home,
    );

    $desc = get_bloginfo( 'description' );
    if ( $desc ) {
        $org['description'] = $desc;
    }

    if ( $logo_url ) {
        $org['logo'] = array(
            '@type' => 'ImageObject',
            '@id'   => $home . '#logo',
            'url'   => $logo_url,
        );
        $org['image'] = array( '@id' => $home . '#logo' );
    }

    // Contact point.
    if ( $phone || $email ) {
        $contact = array(
            '@type'       => 'ContactPoint',
            'contactType' => 'customer service',
        );
        if ( $phone ) {
            $contact['telephone'] = $phone;
        }
        if ( $email ) {
            $contact['email'] = $email;
        }
        $org['contactPoint'] = array( $contact );
    }

    if ( $address ) {
        $org['address'] = array(
            '@type'           => 'PostalAddress',
            'streetAddress'   => $address,
            'addressCountry'  => 'AZ',
        );
    }

    // Social profiles → sameAs.
    $socials = array_values( array_filter( ondigital_get_social_links() ) );
    if ( $socials ) {
        $org['sameAs'] = $socials;
    }

    return $org;
}

/**
 * WebSite node (with the site search action).
 */
function ondigital_schema_website(): array {
    $home = home_url( '/' );
    return array(
        '@type'     => 'WebSite',
        '@id'       => $home . '#website',
        'url'       => $home,
        'name'      => get_bloginfo( 'name' ),
        'publisher' => array( '@id' => $home . '#organization' ),
        'inLanguage' => function_exists( 'pll_current_language' ) ? pll_current_language() : 'az',
        'potentialAction' => array(
            array(
                '@type'       => 'SearchAction',
                'target'      => array(
                    '@type'       => 'EntryPoint',
                    'urlTemplate' => $home . '?s={search_term_string}',
                ),
                'query-input' => 'required name=search_term_string',
            ),
        ),
    );
}

/**
 * BreadcrumbList for the current request.
 */
function ondigital_schema_breadcrumb(): array {
    $home  = home_url( '/' );
    $items = array(
        array(
            '@type'    => 'ListItem',
            'position' => 1,
            'name'     => __( 'Home', 'ondigital' ),
            'item'     => $home,
        ),
    );
    $pos = 2;

    if ( is_singular( 'service' ) ) {
        $items[] = array(
            '@type'    => 'ListItem',
            'position' => $pos++,
            'name'     => __( 'Services', 'ondigital' ),
            'item'     => home_url( '/services/' ),
        );
        $items[] = array(
            '@type'    => 'ListItem',
            'position' => $pos++,
            'name'     => get_the_title(),
            'item'     => get_permalink(),
        );
    } elseif ( is_singular( 'project' ) ) {
        $items[] = array(
            '@type'    => 'ListItem',
            'position' => $pos++,
            'name'     => get_the_title(),
            'item'     => get_permalink(),
        );
    } elseif ( is_singular() || is_page() ) {
        $items[] = array(
            '@type'    => 'ListItem',
            'position' => $pos++,
            'name'     => get_the_title(),
            'item'     => get_permalink(),
        );
    } else {
        return array();
    }

    return array(
        '@type'           => 'BreadcrumbList',
        '@id'             => ( is_singular() ? get_permalink() : home_url( add_query_arg( array() ) ) ) . '#breadcrumb',
        'itemListElement' => $items,
    );
}

/**
 * Service node for single service pages.
 */
function ondigital_schema_service(): array {
    $home = home_url( '/' );
    $id   = get_the_ID();

    $img_id  = (int) get_post_meta( $id, '_service_hero_image', true );
    $img_url = $img_id ? wp_get_attachment_image_url( $img_id, 'large' ) : ( has_post_thumbnail() ? get_the_post_thumbnail_url( $id, 'large' ) : '' );

    $service = array(
        '@type'       => 'Service',
        '@id'         => get_permalink() . '#service',
        'name'        => get_the_title(),
        'url'         => get_permalink(),
        'serviceType' => get_the_title(),
        'provider'    => array( '@id' => $home . '#organization' ),
        'areaServed'  => array(
            '@type' => 'Country',
            'name'  => 'Azerbaijan',
        ),
    );

    $excerpt = get_the_excerpt();
    if ( $excerpt ) {
        $service['description'] = wp_strip_all_tags( $excerpt );
    }
    if ( $img_url ) {
        $service['image'] = $img_url;
    }

    return $service;
}

/**
 * Collect FAQ pairs for the current page (services use _service_faq_items;
 * other contexts can be added here later). Returns array of [q, a].
 */
function ondigital_schema_collect_faqs(): array {
    $faqs = array();

    if ( is_singular( 'service' ) ) {
        $items = get_post_meta( get_the_ID(), '_service_faq_items', true );
        if ( is_array( $items ) ) {
            foreach ( $items as $item ) {
                $q = trim( (string) ( $item['q'] ?? '' ) );
                $a = trim( (string) ( $item['a'] ?? '' ) );
                if ( $q && $a ) {
                    $faqs[] = array( $q, $a );
                }
            }
        }
    }

    return $faqs;
}

/**
 * FAQPage node built from collected FAQ pairs.
 */
function ondigital_schema_faqpage( array $faqs ): array {
    $entities = array();
    foreach ( $faqs as $pair ) {
        $entities[] = array(
            '@type'          => 'Question',
            'name'           => $pair[0],
            'acceptedAnswer' => array(
                '@type' => 'Answer',
                'text'  => $pair[1],
            ),
        );
    }
    return array(
        '@type'      => 'FAQPage',
        'mainEntity' => $entities,
    );
}

/**
 * Print the combined @graph in the <head>.
 */
function ondigital_output_schema(): void {
    if ( is_admin() || is_feed() || is_robots() || is_404() ) {
        return;
    }

    $graph = array(
        ondigital_schema_organization(),
        ondigital_schema_website(),
    );

    $breadcrumb = ondigital_schema_breadcrumb();
    if ( ! empty( $breadcrumb['itemListElement'] ) ) {
        $graph[] = $breadcrumb;
    }

    if ( is_singular( 'service' ) ) {
        $graph[] = ondigital_schema_service();
    }

    $faqs = ondigital_schema_collect_faqs();
    if ( $faqs ) {
        $graph[] = ondigital_schema_faqpage( $faqs );
    }

    $data = array(
        '@context' => 'https://schema.org',
        '@graph'   => $graph,
    );

    echo "\n<!-- OnDigital Schema -->\n";
    echo '<script type="application/ld+json">' . wp_json_encode( $data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>' . "\n";
}
add_action( 'wp_head', 'ondigital_output_schema', 20 );
