<?php
/**
 * Services - Services Grid Section
 *
 * @package OnDigital
 */

$service_query = new WP_Query( array(
    'post_type'      => 'service',
    'posts_per_page' => -1,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
) );

$static_services = array(
    array(
        'title'    => __( 'Veb Sayt Dizaynı', 'ondigital' ),
        'icon'     => 'icon-s-1',
        'features' => array(
            __( 'İstifadəçi İnterfeysi', 'ondigital' ),
            __( 'İstifadəçi Təcrübəsi', 'ondigital' ),
            __( 'Dizayn Sistemi', 'ondigital' ),
            __( 'Prototip', 'ondigital' ),
            __( 'Responsive Dizayn', 'ondigital' ),
            __( 'Veb & Mobil', 'ondigital' ),
        ),
    ),
    array(
        'title'    => __( 'Brend Dizaynı', 'ondigital' ),
        'icon'     => 'icon-s-2',
        'features' => array(
            __( 'Loqo Dizaynı', 'ondigital' ),
            __( 'Korporativ Üslub', 'ondigital' ),
            __( 'Brend Strategiyası', 'ondigital' ),
            __( 'Vizual İdentifikasiya', 'ondigital' ),
            __( 'Qablaşdırma Dizaynı', 'ondigital' ),
            __( 'Çap Materialları', 'ondigital' ),
        ),
    ),
    array(
        'title'    => __( 'Rəqəmsal Marketinq', 'ondigital' ),
        'icon'     => 'icon-s-3',
        'features' => array(
            __( 'SEO Optimallaşdırma', 'ondigital' ),
            __( 'Google Ads', 'ondigital' ),
            __( 'Sosial Media', 'ondigital' ),
            __( 'Kontent Marketinq', 'ondigital' ),
            __( 'Email Marketinq', 'ondigital' ),
            __( 'Analitika', 'ondigital' ),
        ),
    ),
    array(
        'title'    => __( 'Veb İnkişaf', 'ondigital' ),
        'icon'     => 'icon-s-4',
        'features' => array(
            __( 'WordPress', 'ondigital' ),
            __( 'E-ticarət', 'ondigital' ),
            __( 'API İnteqrasiya', 'ondigital' ),
            __( 'CMS İnkişaf', 'ondigital' ),
            __( 'Front-end Development', 'ondigital' ),
            __( 'Texniki Dəstək', 'ondigital' ),
        ),
    ),
);
?>
<section class="service-area section-spacing">
    <div class="container">
        <div class="service-top-wrapper">
            <div class="section-heading">
                <h2 class="section-title has_text_move_anim">
                    <?php echo wp_kses_post( __( 'Eksklüziv <br> xidmətlərimiz', 'ondigital' ) ); ?>
                </h2>
            </div>
            <div class="content">
                <p class="text has_fade_anim">
                    <?php esc_html_e( 'Kateqoriyanı dəyişdirən və insanların həyatına dəyər qatan brendlərə investisiya edirik', 'ondigital' ); ?>
                </p>
            </div>
        </div>
        <div class="services-wrapper-box">
            <div class="services-grid">
                <?php if ( $service_query->have_posts() ) : ?>
                    <?php $delay = 0.15; while ( $service_query->have_posts() ) : $service_query->the_post(); ?>
                        <div class="service-item has_fade_anim" data-delay="<?php echo esc_attr( $delay ); ?>">
                            <div class="icon">
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <?php the_post_thumbnail( 'thumbnail' ); ?>
                                <?php endif; ?>
                            </div>
                            <h2 class="title"><?php the_title(); ?></h2>
                            <?php if ( has_excerpt() ) : ?>
                                <div class="service-features-text"><?php the_excerpt(); ?></div>
                            <?php endif; ?>
                        </div>
                    <?php $delay += 0.15; endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                <?php else : ?>
                    <?php foreach ( $static_services as $i => $service ) : ?>
                        <div class="service-item has_fade_anim" data-delay="<?php echo esc_attr( 0.15 + ( $i * 0.15 ) ); ?>">
                            <div class="icon">
                                <img class="show-light" src="<?php echo esc_url( ONDIGITAL_URI . '/assets/imgs/icon/' . $service['icon'] . '.webp' ); ?>" alt="<?php echo esc_attr( $service['title'] ); ?>">
                                <img class="show-dark" src="<?php echo esc_url( ONDIGITAL_URI . '/assets/imgs/icon/' . $service['icon'] . '-light.webp' ); ?>" alt="<?php echo esc_attr( $service['title'] ); ?>">
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
