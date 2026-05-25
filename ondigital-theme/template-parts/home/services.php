<?php
/**
 * Home - Services Section (startup-agency style)
 *
 * @package OnDigital
 */

$services_subtitle = ondigital_get_option( 'services_subtitle', 'Əsas Xüsusiyyətlər' );
$services_title    = ondigital_get_option( 'services_title', 'Təqdim etdiyimiz <br> xidmətlər' );
$services_body     = ondigital_get_option( 'services_body', 'İstər vizual cəhətdən gözəl brend kimliyi yaratmaq, istərsə də immersiv rəqəmsal təcrübələr dizayn etmək olsun.' );

// Static fallback services (icon-s-5 … icon-s-8 from startup-agency)
$static_services = array(
    array(
        'title' => __( 'İnkişaf', 'ondigital' ),
        'text'  => __( 'Ən yaxşı istifadəçi təcrübəsi strategiyası ilə möhtəşəm rəqəmsal məhsullar yaratmaq.', 'ondigital' ),
        'icon'  => 'icon-s-5.webp',
        'url'   => home_url( '/xidmetler/' ),
    ),
    array(
        'title' => __( 'Marketinq', 'ondigital' ),
        'text'  => __( 'Marketinq xidmətləri strategiya çərçivəsində başlayır, vayfreymlər və möhkəm prototiplərlə bitir.', 'ondigital' ),
        'icon'  => 'icon-s-6.webp',
        'url'   => home_url( '/xidmetler/' ),
    ),
    array(
        'title' => __( 'Dizayn', 'ondigital' ),
        'text'  => __( 'Axtarış mühərrikləri və istifadəçi dostu, peşəkar görünüşlü sadə loqolar dizayn edirik.', 'ondigital' ),
        'icon'  => 'icon-s-7.webp',
        'url'   => home_url( '/xidmetler/' ),
    ),
    array(
        'title' => __( 'Texnologiya', 'ondigital' ),
        'text'  => __( 'Sosial media postları dizaynı, infoqrafik dizayn və e-poçt vizual təhlükəsizliyi.', 'ondigital' ),
        'icon'  => 'icon-s-8.webp',
        'url'   => home_url( '/xidmetler/' ),
    ),
);

$delays = array( '0.15', '0.30', '0.45', '0.60' );

// Query CPT services
$services_query = new WP_Query( array(
    'post_type'      => 'service',
    'posts_per_page' => -1,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
    'lang'           => '',
) );
?>
<section class="service-area">
    <div class="container">
        <div class="service-area-inner section-spacing-bottom">

            <!-- Decorative shapes -->
            <div class="shape-1">
                <img src="<?php echo esc_url( ONDIGITAL_URI . '/assets/imgs/shape/img-s-10.webp' ); ?>" alt="">
            </div>
            <div class="shape-2">
                <img src="<?php echo esc_url( ONDIGITAL_URI . '/assets/imgs/shape/img-s-9.webp' ); ?>" alt="">
            </div>
            <div class="shape-3">
                <img src="<?php echo esc_url( ONDIGITAL_URI . '/assets/imgs/shape/img-s-12.webp' ); ?>" alt="">
            </div>
            <div class="shape-4">
                <img src="<?php echo esc_url( ONDIGITAL_URI . '/assets/imgs/shape/img-s-11.webp' ); ?>" alt="">
            </div>

            <!-- Section header: title left, body right -->
            <div class="section-header">
                <div class="section-title-wrapper">
                    <div class="subtitle-wrapper">
                        <span class="section-subtitle has-left-line has_fade_anim">
                            <?php echo esc_html( $services_subtitle ); ?>
                        </span>
                    </div>
                    <div class="title-wrapper">
                        <h2 class="section-title has_text_move_anim">
                            <?php echo wp_kses_post( $services_title ); ?>
                        </h2>
                    </div>
                </div>
                <div class="text-wrapper">
                    <p class="text has_fade_anim"><?php echo esc_html( $services_body ); ?></p>
                </div>
            </div>

            <!-- Cards -->
            <div class="services-wrapper-box">
                <div class="services-wrapper swiper" id="services-slider">
                    <div class="swiper-wrapper">
                    <?php if ( $services_query->have_posts() ) : ?>
                        <?php $i = 0; while ( $services_query->have_posts() ) : $services_query->the_post();
                            $icon_id  = get_post_meta( get_the_ID(), '_service_icon', true );
                            $icon_url = $icon_id ? wp_get_attachment_image_url( $icon_id, 'thumbnail' ) : '';
                        ?>
                            <div class="swiper-slide od-srv-slide">
                                <div class="od-srv-card">
                                    <a href="<?php the_permalink(); ?>">
                                        <h3 class="od-srv-title"><?php the_title(); ?></h3>
                                        <p class="od-srv-text"><?php echo esc_html( get_the_excerpt() ); ?></p>
                                        <span class="od-srv-link">More <i class="fa-solid fa-arrow-right-long"></i></span>
                                    </a>
                                </div>
                            </div>
                        <?php $i++; endwhile; wp_reset_postdata(); ?>
                    <?php else : ?>
                        <?php foreach ( $static_services as $i => $service ) : ?>
                            <div class="swiper-slide od-srv-slide">
                                <div class="od-srv-card">
                                    <a href="<?php echo esc_url( $service['url'] ); ?>">
                                        <h3 class="od-srv-title"><?php echo esc_html( $service['title'] ); ?></h3>
                                        <p class="od-srv-text"><?php echo esc_html( $service['text'] ); ?></p>
                                        <span class="od-srv-link">More <i class="fa-solid fa-arrow-right-long"></i></span>
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    </div>
                </div>
                <!-- Navigation arrows outside swiper so top:50% is relative to card height only -->
                <div class="services-prev"><i class="fa-solid fa-arrow-left-long"></i></div>
                <div class="services-next"><i class="fa-solid fa-arrow-right-long"></i></div>
                <!-- Pagination outside swiper to prevent swiper from adding internal padding -->
                <div class="swiper-pagination services-pagination"></div>
            </div>

        </div>
    </div>
</section>
