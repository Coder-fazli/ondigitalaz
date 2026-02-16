<?php
/**
 * Home - Features Section
 *
 * @package OnDigital
 */

$features = array(
    array(
        'title' => __( 'Productivity', 'ondigital' ),
        'text'  => __( 'Giving consultancy for every financial projection report and analysis.', 'ondigital' ),
    ),
    array(
        'title' => __( 'Strategy', 'ondigital' ),
        'text'  => __( 'Experiences your customers for more information about services.', 'ondigital' ),
    ),
    array(
        'title' => __( 'Research', 'ondigital' ),
        'text'  => __( 'The most completed powerful experience automation with built-in type.', 'ondigital' ),
    ),
    array(
        'title' => __( 'Community', 'ondigital' ),
        'text'  => __( 'Our quality policy: strict and effective management to have best band for you.', 'ondigital' ),
    ),
);
?>
<section class="features-area">
    <div class="container">
        <div class="features-area-inner section-spacing-top">
            <div class="section-header">
                <div class="section-title-wrapper">
                    <div class="title-wrapper">
                        <h2 class="section-title has_text_move_anim">
                            <?php echo wp_kses_post( __( 'We build strong <span>productive</span> market that increase your sales growth', 'ondigital' ) ); ?>
                        </h2>
                    </div>
                </div>
                <div class="text-wrapper">
                    <p class="text has_fade_anim">
                        <?php esc_html_e( 'We bet on brands that shift categories and add value to people\'s lives; and on founders who are motivated to shape', 'ondigital' ); ?>
                    </p>
                </div>
            </div>
            <div class="features-wrapper-box">
                <div class="features-wrapper">
                    <?php foreach ( $features as $feature ) : ?>
                        <div class="feature-box has_fade_anim" data-fade-from="bottom">
                            <div class="thumb">
                                <img class="show-light" src="<?php echo esc_url( ONDIGITAL_URI . '/assets/imgs/icon/icon-s-20.webp' ); ?>" alt="<?php echo esc_attr( $feature['title'] ); ?>">
                                <img class="show-dark" src="<?php echo esc_url( ONDIGITAL_URI . '/assets/imgs/icon/icon-s-20-light.webp' ); ?>" alt="<?php echo esc_attr( $feature['title'] ); ?>">
                            </div>
                            <div class="content">
                                <h3 class="title"><?php echo esc_html( $feature['title'] ); ?></h3>
                                <p class="text"><?php echo esc_html( $feature['text'] ); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>
