<?php
/**
 * Home - Testimonials Section
 *
 * @package OnDigital
 */

$t_subtitle     = ondigital_get_option( 'testi_subtitle', "Client's Feedback" );
$t_title        = ondigital_get_option( 'testi_title', 'What our happy client <span>say</span>' );
$t_body         = ondigital_get_option( 'testi_body', 'Optimize your impact this holiday season with an AI-driven, multichannel marketing strategy.' );
$t_rating       = ondigital_get_option( 'testi_rating', '4.9' );
$t_review_count = ondigital_get_option( 'testi_review_count', '30+ client reviews' );
$t_platform     = ondigital_get_option( 'testi_platform', 'Trustpilot' );

$default_testimonials = array(
    array(
        'quote' => __( "Analysts used Mode's advanced analytics capabilities to build parameterized report and visualizations with live data. The customer success team then used the intuitive drag interface to delve", 'ondigital' ),
        'name'  => 'John Butler',
        'role'  => __( 'Developer', 'ondigital' ),
    ),
    array(
        'quote' => __( "Analysts used Mode's advanced analytics capabilities to build parameterized report and visualizations with live data. The customer success team then used the intuitive drag interface to delve", 'ondigital' ),
        'name'  => 'Sarah Johnson',
        'role'  => __( 'Marketing Director', 'ondigital' ),
    ),
    array(
        'quote' => __( "Analysts used Mode's advanced analytics capabilities to build parameterized report and visualizations with live data. The customer success team then used the intuitive drag interface to delve", 'ondigital' ),
        'name'  => 'Michael Chen',
        'role'  => __( 'CEO', 'ondigital' ),
    ),
);

$testimonials = ondigital_get_repeater( 'testimonials', $default_testimonials );
?>
<div class="testimonial-area">
    <div class="container">
        <div class="testimonial-area-inner section-spacing">
            <div class="section-content">
                <div class="section-title-wrapper">
                    <div class="subtitle-wrapper has_fade_anim" data-fade-from="left">
                        <img class="show-light" src="<?php echo esc_url( ONDIGITAL_URI . '/assets/imgs/client/img-s-2.webp' ); ?>" alt="<?php esc_attr_e( 'clients', 'ondigital' ); ?>">
                        <img class="show-dark" src="<?php echo esc_url( ONDIGITAL_URI . '/assets/imgs/client/img-s-2-dark.webp' ); ?>" alt="<?php esc_attr_e( 'clients', 'ondigital' ); ?>">
                        <span class="section-subtitle"><?php echo esc_html( $t_subtitle ); ?></span>
                    </div>
                    <div class="title-wrapper">
                        <h2 class="section-title has_fade_anim" data-fade-from="left">
                            <?php echo wp_kses_post( $t_title ); ?>
                        </h2>
                    </div>
                </div>
                <div class="text-wrapper">
                    <p class="text has_fade_anim" data-fade-from="left">
                        <?php echo esc_html( $t_body ); ?>
                    </p>
                </div>
                <div class="review-wrapper-box">
                    <div class="review-wrapper has_fade_anim" data-fade-from="left">
                        <div class="review-author">
                            <img src="<?php echo esc_url( ONDIGITAL_URI . '/assets/imgs/icon/star-3.webp' ); ?>" alt="<?php echo esc_attr( $t_platform ); ?>">
                            <h3 class="text"><?php echo esc_html( $t_platform ); ?> <br>reviews</h3>
                        </div>
                        <div class="review-rating">
                            <div class="ratings">
                                <h3 class="number"><?php echo esc_html( $t_rating ); ?></h3>
                                <ul class="icon-list">
                                    <?php for ( $i = 0; $i < 4; $i++ ) : ?>
                                        <li>
                                            <img class="show-light" src="<?php echo esc_url( ONDIGITAL_URI . '/assets/imgs/icon/star-4.webp' ); ?>" alt="<?php esc_attr_e( 'star', 'ondigital' ); ?>">
                                            <img class="show-dark" src="<?php echo esc_url( ONDIGITAL_URI . '/assets/imgs/icon/star-4-light.webp' ); ?>" alt="<?php esc_attr_e( 'star', 'ondigital' ); ?>">
                                        </li>
                                    <?php endfor; ?>
                                    <li>
                                        <img class="show-light" src="<?php echo esc_url( ONDIGITAL_URI . '/assets/imgs/icon/star-4-half.webp' ); ?>" alt="<?php esc_attr_e( 'star', 'ondigital' ); ?>">
                                        <img class="show-dark" src="<?php echo esc_url( ONDIGITAL_URI . '/assets/imgs/icon/star-4-half-light.webp' ); ?>" alt="<?php esc_attr_e( 'star', 'ondigital' ); ?>">
                                    </li>
                                </ul>
                            </div>
                            <h3 class="text"><?php echo esc_html( $t_review_count ); ?></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="testimonial-wrapper-box has_fade_anim" data-fade-from="bottom">
                <div class="testimonial-wrapper">
                    <div class="swiper testimonial-slider">
                        <div class="swiper-wrapper">
                            <?php foreach ( $testimonials as $testimonial ) : ?>
                                <div class="swiper-slide">
                                    <div class="testimonial-item">
                                        <div class="content">
                                            <div class="icon">
                                                <img class="quote-icon show-light" src="<?php echo esc_url( ONDIGITAL_URI . '/assets/imgs/icon/quote-7.webp' ); ?>" alt="<?php esc_attr_e( 'Quote', 'ondigital' ); ?>">
                                                <img class="quote-icon show-dark" src="<?php echo esc_url( ONDIGITAL_URI . '/assets/imgs/icon/quote-7-light.webp' ); ?>" alt="<?php esc_attr_e( 'Quote', 'ondigital' ); ?>">
                                            </div>
                                            <div class="text-wrapper">
                                                <p class="text"><?php echo esc_html( $testimonial['quote'] ?? $testimonial['text'] ?? '' ); ?></p>
                                            </div>
                                            <div class="author">
                                                <div class="meta">
                                                    <span class="name"><?php echo esc_html( $testimonial['name'] ?? '' ); ?></span>
                                                    <span class="post"><?php echo esc_html( $testimonial['role'] ?? $testimonial['post'] ?? '' ); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="slider-nav">
                    <div class="testimonial-button-prev nav-icon">
                        <i class="fa-solid fa-arrow-left"></i>
                    </div>
                    <div class="testimonial-button-next nav-icon">
                        <i class="fa-solid fa-arrow-right"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
