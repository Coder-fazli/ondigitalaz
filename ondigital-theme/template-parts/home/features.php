<?php
/**
 * Home - Features Section
 *
 * @package OnDigital
 */

$features_title = ondigital_get_option( 'features_title', 'We build strong <span>productive</span> market that increase your sales growth' );
$features_desc  = ondigital_get_option( 'features_description', "We bet on brands that shift categories and add value to people's lives; and on founders who are motivated to shape" );

$default_features = array(
    array( 'title' => __( 'Productivity', 'ondigital' ), 'description' => __( 'Giving consultancy for every financial projection report and analysis.', 'ondigital' ), 'icon_light' => 0, 'icon_dark' => 0 ),
    array( 'title' => __( 'Strategy', 'ondigital' ),     'description' => __( 'Experiences your customers for more information about services.', 'ondigital' ), 'icon_light' => 0, 'icon_dark' => 0 ),
    array( 'title' => __( 'Research', 'ondigital' ),     'description' => __( 'The most completed powerful experience automation with built-in type.', 'ondigital' ), 'icon_light' => 0, 'icon_dark' => 0 ),
    array( 'title' => __( 'Community', 'ondigital' ),    'description' => __( 'Our quality policy: strict and effective management to have best band for you.', 'ondigital' ), 'icon_light' => 0, 'icon_dark' => 0 ),
);

$features = ondigital_get_repeater( 'features', $default_features );
?>
<section class="features-area">
    <div class="container">
        <div class="features-area-inner">
            <div class="section-header">
                <div class="section-title-wrapper">
                    <div class="title-wrapper">
                        <h2 class="section-title has_text_move_anim">
                            <?php echo wp_kses_post( $features_title ); ?>
                        </h2>
                    </div>
                </div>
                <div class="text-wrapper features-team-img-wrapper">
                    <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
                    <dotlottie-player
                        src="<?php echo esc_url( ONDIGITAL_URI . '/assets/animations/hero-animation.lottie' ); ?>"
                        background="transparent"
                        speed="1"
                        style="width:380px;height:380px;"
                        loop
                        autoplay>
                    </dotlottie-player>
                </div>
            </div>
            <div class="features-wrapper-box">
                <div class="features-wrapper">
                    <?php foreach ( $features as $feature ) :
                        $title = $feature['title'] ?? '';
                        $desc  = $feature['description'] ?? '';

                        // Icon images with fallback
                        if ( ! empty( $feature['icon_light'] ) ) {
                            $icon_light = wp_get_attachment_image_url( $feature['icon_light'], 'thumbnail' );
                        } else {
                            $icon_light = ONDIGITAL_URI . '/assets/imgs/icon/icon-s-20.webp';
                        }
                        if ( ! empty( $feature['icon_dark'] ) ) {
                            $icon_dark = wp_get_attachment_image_url( $feature['icon_dark'], 'thumbnail' );
                        } else {
                            $icon_dark = ONDIGITAL_URI . '/assets/imgs/icon/icon-s-20-light.webp';
                        }
                    ?>
                        <div class="feature-box has_fade_anim" data-fade-from="bottom">
                            <div class="thumb">
                                <img class="show-light" src="<?php echo esc_url( $icon_light ); ?>" alt="<?php echo esc_attr( $title ); ?>">
                                <img class="show-dark" src="<?php echo esc_url( $icon_dark ); ?>" alt="<?php echo esc_attr( $title ); ?>">
                            </div>
                            <div class="content">
                                <h3 class="title"><?php echo esc_html( $title ); ?></h3>
                                <p class="text"><?php echo esc_html( $desc ); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>
