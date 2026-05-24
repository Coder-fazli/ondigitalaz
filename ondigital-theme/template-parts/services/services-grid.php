<?php
/**
 * Services - Services Grid Section
 *
 * @package OnDigital
 */

$lang = function_exists( 'pll_current_language' ) ? pll_current_language() : 'en';

$grid_title = ondigital_get_option( 'services_grid_title', 'Our exclusive <br>services' );
$grid_body  = ondigital_get_option( 'services_grid_body', 'We bet on brands that shift categories and add value to people\'s lives; and on founders who are motivated to shape' );

$service_query = new WP_Query( array(
    'post_type'      => 'service',
    'posts_per_page' => -1,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
    'lang'           => $lang,
) );

$static_services = array(
    array(
        'title'    => $lang === 'az' ? 'Veb Sayt Dizaynı'  : 'Interaction Design',
        'features' => array( 'User Interface', 'User Experience', 'Design System', 'Wireframe', 'Prototype', 'Website & Mobile App' ),
    ),
    array(
        'title'    => $lang === 'az' ? 'Brend Dizaynı'     : 'Branding Design',
        'features' => array( 'User Interface', 'User Experience', 'Design System', 'Wireframe', 'Prototype', 'Website & Mobile App' ),
    ),
    array(
        'title'    => $lang === 'az' ? 'Rəqəmsal Marketinq': 'Design & Development',
        'features' => array( 'User Interface', 'User Experience', 'Design System', 'Wireframe', 'Prototype', 'IOS + Android' ),
    ),
    array(
        'title'    => $lang === 'az' ? 'Veb İnkişaf'       : 'eCommerce Development',
        'features' => array( 'User Interface', 'User Experience', 'Design System', 'Wireframe', 'Prototype', 'Website & Mobile App' ),
    ),
);
?>
<section class="od-sg-section">
    <div class="container">

        <div class="od-sg-header">
            <h2 class="od-sg-title has_text_move_anim">
                <?php echo wp_kses_post( $grid_title ); ?>
            </h2>
            <p class="od-sg-desc has_fade_anim" data-fade-from="right" data-delay="0.2">
                <?php echo esc_html( $grid_body ); ?>
            </p>
        </div>

        <div class="od-sg-grid">
            <?php if ( $service_query->have_posts() ) : ?>
                <?php $delay = 0.1; while ( $service_query->have_posts() ) : $service_query->the_post();
                    $icon_id      = get_post_meta( get_the_ID(), '_service_icon', true );
                    $icon_url     = $icon_id ? wp_get_attachment_image_url( $icon_id, 'thumbnail' ) : '';
                    $features_raw = get_post_meta( get_the_ID(), '_service_features', true );
                    $features     = $features_raw ? array_filter( array_map( 'trim', explode( "\n", $features_raw ) ) ) : array();
                    $service_url  = get_permalink();
                ?>
                <div class="od-sg-item has_fade_anim" data-fade-from="bottom" data-delay="<?php echo esc_attr( $delay ); ?>">
                    <?php if ( $icon_url ) : ?>
                    <div class="od-sg-icon">
                        <img src="<?php echo esc_url( $icon_url ); ?>" alt="<?php the_title_attribute(); ?>" width="48" height="48">
                    </div>
                    <?php endif; ?>
                    <h3 class="od-sg-name">
                        <a href="<?php echo esc_url( $service_url ); ?>"><?php the_title(); ?></a>
                    </h3>
                    <?php if ( ! empty( $features ) ) : ?>
                    <ul class="od-sg-features">
                        <?php foreach ( $features as $feature ) : ?>
                        <li><?php echo esc_html( $feature ); ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <?php elseif ( has_excerpt() ) : ?>
                    <p class="od-sg-excerpt"><?php echo wp_kses_post( get_the_excerpt() ); ?></p>
                    <?php endif; ?>
                </div>
                <?php $delay += 0.1; endwhile; wp_reset_postdata(); ?>
            <?php else : ?>
                <?php foreach ( $static_services as $i => $svc ) : ?>
                <div class="od-sg-item has_fade_anim" data-fade-from="bottom" data-delay="<?php echo esc_attr( 0.1 + ( $i * 0.1 ) ); ?>">
                    <div class="od-sg-icon od-sg-icon--placeholder">
                        <svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" width="48" height="48"><rect x="6" y="6" width="36" height="36" rx="4"/><line x1="6" y1="18" x2="42" y2="18"/><line x1="18" y1="6" x2="18" y2="42"/></svg>
                    </div>
                    <h3 class="od-sg-name"><?php echo esc_html( $svc['title'] ); ?></h3>
                    <ul class="od-sg-features">
                        <?php foreach ( $svc['features'] as $feat ) : ?>
                        <li><?php echo esc_html( $feat ); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

    </div>
</section>
