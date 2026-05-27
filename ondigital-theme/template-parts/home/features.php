<?php
/**
 * Home - Features Section
 *
 * @package OnDigital
 */

$lang           = function_exists( 'pll_current_language' ) ? pll_current_language() : 'en';
$features_title = ondigital_get_option( 'features_title', 'We build strong <span>productive</span> market that increase your sales growth' );
$features_desc  = ondigital_get_option( 'features_description', "We bet on brands that shift categories and add value to people's lives; and on founders who are motivated to shape" );

$default_features = array(
    array( 'title_en' => 'Productivity', 'title_az' => 'Məhsuldarlıq', 'description_en' => 'Giving consultancy for every financial projection report and analysis.', 'description_az' => 'Hər maliyyə proqnozu hesabatı və analizi üçün məsləhət.', 'icon_light' => 0, 'icon_dark' => 0 ),
    array( 'title_en' => 'Strategy',     'title_az' => 'Strategiya',    'description_en' => 'Experiences your customers for more information about services.',         'description_az' => 'Xidmətlər haqqında daha çox məlumat üçün müştərilərinizi tanıyın.', 'icon_light' => 0, 'icon_dark' => 0 ),
    array( 'title_en' => 'Research',     'title_az' => 'Tədqiqat',      'description_en' => 'The most completed powerful experience automation with built-in type.',   'description_az' => 'Ən tam güclü təcrübə avtomatlaşdırması.',                          'icon_light' => 0, 'icon_dark' => 0 ),
    array( 'title_en' => 'Community',    'title_az' => 'İcma',          'description_en' => 'Our quality policy: strict and effective management to have best band for you.', 'description_az' => 'Keyfiyyət siyasətimiz: ciddi və effektiv idarəetmə.', 'icon_light' => 0, 'icon_dark' => 0 ),
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
            </div>
            <div class="features-wrapper-box">
                <div class="features-wrapper">
                    <?php foreach ( $features as $feature ) :
                        $title = $lang === 'az'
                            ? ( $feature['title_az'] ?? $feature['title_en'] ?? $feature['title'] ?? '' )
                            : ( $feature['title_en'] ?? $feature['title'] ?? '' );
                        $desc  = $lang === 'az'
                            ? ( $feature['description_az'] ?? $feature['description_en'] ?? $feature['description'] ?? '' )
                            : ( $feature['description_en'] ?? $feature['description'] ?? '' );

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
