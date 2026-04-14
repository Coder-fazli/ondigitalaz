<?php
/**
 * Services - Services Grid Section
 *
 * @package OnDigital
 */

$grid_title = ondigital_get_option( 'services_grid_title', 'Eksklüziv <br> xidmətlərimiz' );
$grid_body  = ondigital_get_option( 'services_grid_body', 'Kateqoriyanı dəyişdirən və insanların həyatına dəyər qatan brendlərə investisiya edirik' );

$service_query = new WP_Query( array(
    'post_type'      => 'service',
    'posts_per_page' => -1,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
    'lang'           => '',
) );

$static_services = array(
    array( 'title' => 'Veb Sayt Dizaynı',    'icon' => 'icon-s-1', 'features' => array( 'İstifadəçi İnterfeysi', 'İstifadəçi Təcrübəsi', 'Dizayn Sistemi', 'Prototip', 'Responsive Dizayn', 'Veb & Mobil' ) ),
    array( 'title' => 'Brend Dizaynı',        'icon' => 'icon-s-2', 'features' => array( 'Loqo Dizaynı', 'Korporativ Üslub', 'Brend Strategiyası', 'Vizual İdentifikasiya', 'Qablaşdırma Dizaynı', 'Çap Materialları' ) ),
    array( 'title' => 'Rəqəmsal Marketinq',   'icon' => 'icon-s-3', 'features' => array( 'SEO Optimallaşdırma', 'Google Ads', 'Sosial Media', 'Kontent Marketinq', 'Email Marketinq', 'Analitika' ) ),
    array( 'title' => 'Veb İnkişaf',          'icon' => 'icon-s-4', 'features' => array( 'WordPress', 'E-ticarət', 'API İnteqrasiya', 'CMS İnkişaf', 'Front-end Development', 'Texniki Dəstək' ) ),
);
?>
<section class="service-area section-spacing">
    <div class="container">
        <div class="service-top-wrapper">
            <div class="section-heading">
                <h2 class="section-title has_text_move_anim">
                    <?php echo wp_kses_post( $grid_title ); ?>
                </h2>
            </div>
            <div class="content">
                <p class="text has_fade_anim">
                    <?php echo esc_html( $grid_body ); ?>
                </p>
            </div>
        </div>
        <div class="services-wrapper-box">
            <div class="services-grid">
                <?php if ( $service_query->have_posts() ) : ?>
                    <?php $delay = 0.15; while ( $service_query->have_posts() ) : $service_query->the_post();
                        $icon_id       = get_post_meta( get_the_ID(), '_service_icon', true );
                        $icon_url      = $icon_id ? wp_get_attachment_image_url( $icon_id, 'thumbnail' ) : '';
                        $features_raw  = get_post_meta( get_the_ID(), '_service_features', true );
                        $features      = $features_raw ? array_filter( array_map( 'trim', explode( "\n", $features_raw ) ) ) : array();
                    ?>
                        <div class="service-item has_fade_anim" data-delay="<?php echo esc_attr( $delay ); ?>">
                            <?php if ( $icon_url ) : ?>
                                <div class="icon">
                                    <img src="<?php echo esc_url( $icon_url ); ?>" alt="<?php the_title_attribute(); ?>">
                                </div>
                            <?php endif; ?>
                            <h2 class="title"><?php the_title(); ?></h2>
                            <?php if ( ! empty( $features ) ) : ?>
                                <ul class="service-features">
                                    <?php foreach ( $features as $feature ) : ?>
                                        <li><?php echo esc_html( $feature ); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php elseif ( has_excerpt() ) : ?>
                                <div class="service-features-text"><?php the_excerpt(); ?></div>
                            <?php endif; ?>
                        </div>
                    <?php $delay += 0.15; endwhile; wp_reset_postdata(); ?>
                <?php else : ?>
                    <?php foreach ( $static_services as $i => $service ) : ?>
                        <div class="service-item has_fade_anim" data-delay="<?php echo esc_attr( 0.15 + ( $i * 0.15 ) ); ?>">
                            <div class="icon">
                                <img class="show-light" src="<?php echo esc_url( ONDIGITAL_URI . '/assets/imgs/icon/' . $service['icon'] . '.webp' ); ?>" alt="<?php echo esc_attr( $service['title'] ); ?>">
                                <img class="show-dark"  src="<?php echo esc_url( ONDIGITAL_URI . '/assets/imgs/icon/' . $service['icon'] . '-light.webp' ); ?>" alt="<?php echo esc_attr( $service['title'] ); ?>">
                            </div>
                            <h2 class="title"><?php echo esc_html( $service['title'] ); ?></h2>
                            <ul class="service-features">
                                <?php foreach ( $service['features'] as $feature ) : ?>
                                    <li><?php echo esc_html( $feature ); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
