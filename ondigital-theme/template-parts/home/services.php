<?php
/**
 * Home - Services Section
 *
 * @package OnDigital
 */

// Query services from CPT
$services_query = new WP_Query( array(
    'post_type'      => 'service',
    'posts_per_page' => 4,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
) );

// Fallback static services if no CPT entries yet
$static_services = array(
    array(
        'title' => __( 'SEO Marketing', 'ondigital' ),
        'text'  => __( 'We immerse ourselves in your issues and we put our knowledge and expertise at your service', 'ondigital' ),
        'image' => 'img-s-39.webp',
    ),
    array(
        'title' => __( 'Social Marketing', 'ondigital' ),
        'text'  => __( 'We immerse ourselves in your issues and we put our knowledge and expertise at your service', 'ondigital' ),
        'image' => 'img-s-40.webp',
    ),
    array(
        'title' => __( 'Content Marketing', 'ondigital' ),
        'text'  => __( 'We immerse ourselves in your issues and we put our knowledge and expertise at your service', 'ondigital' ),
        'image' => 'img-s-41.webp',
    ),
    array(
        'title' => __( 'Email Marketing', 'ondigital' ),
        'text'  => __( 'We immerse ourselves in your issues and we put our knowledge and expertise at your service', 'ondigital' ),
        'image' => 'img-s-42.webp',
    ),
);
?>
<div class="container large">
    <section class="service-area">
        <div class="service-area-inner section-spacing">
            <div class="bg">
                <img src="<?php echo esc_url( ONDIGITAL_URI . '/assets/imgs/shape/img-s-54.webp' ); ?>" alt="<?php esc_attr_e( 'background shape', 'ondigital' ); ?>">
            </div>
            <div class="container">
                <div class="section-header">
                    <div class="section-title-wrapper">
                        <div class="title-wrapper">
                            <?php
                            $services_title = ondigital_get_option( 'services_title', 'It\'s big challenge to grow-up your sales by providing best <span>services</span>' );
                            ?>
                            <h2 class="section-title has_text_move_anim">
                                <?php echo wp_kses_post( $services_title ); ?>
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="services-wrapper-box">
                    <div class="services-wrapper">
                        <?php if ( $services_query->have_posts() ) : ?>
                            <?php $counter = 1; ?>
                            <?php while ( $services_query->have_posts() ) : $services_query->the_post(); ?>
                                <div class="has_fade_anim">
                                    <a href="<?php the_permalink(); ?>">
                                        <div class="service-box">
                                            <h3 class="number"><?php echo esc_html( str_pad( $counter, 2, '0', STR_PAD_LEFT ) ); ?></h3>
                                            <div class="thumb">
                                                <?php if ( has_post_thumbnail() ) : ?>
                                                    <?php the_post_thumbnail( 'medium' ); ?>
                                                <?php endif; ?>
                                            </div>
                                            <div class="content">
                                                <h3 class="title"><?php the_title(); ?></h3>
                                                <p class="text"><?php echo esc_html( get_the_excerpt() ); ?></p>
                                                <span class="wc-btn wc-btn-circle"><i class="fa-solid fa-arrow-right"></i></span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php $counter++; endwhile; ?>
                            <?php wp_reset_postdata(); ?>
                        <?php else : ?>
                            <?php foreach ( $static_services as $index => $service ) : ?>
                                <div class="has_fade_anim">
                                    <a href="<?php echo esc_url( home_url( '/xidmetler/' ) ); ?>">
                                        <div class="service-box">
                                            <h3 class="number"><?php echo esc_html( str_pad( $index + 1, 2, '0', STR_PAD_LEFT ) ); ?></h3>
                                            <div class="thumb">
                                                <img src="<?php echo esc_url( ONDIGITAL_URI . '/assets/imgs/gallery/' . $service['image'] ); ?>" alt="<?php echo esc_attr( $service['title'] ); ?>">
                                            </div>
                                            <div class="content">
                                                <h3 class="title"><?php echo esc_html( $service['title'] ); ?></h3>
                                                <p class="text"><?php echo esc_html( $service['text'] ); ?></p>
                                                <span class="wc-btn wc-btn-circle"><i class="fa-solid fa-arrow-right"></i></span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
