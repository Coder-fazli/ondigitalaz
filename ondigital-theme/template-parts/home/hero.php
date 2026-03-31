<?php
/**
 * Home - Hero Section
 *
 * @package OnDigital
 */

$hero_subtitle     = ondigital_get_option( 'hero_subtitle', 'AWARD WINNING DIGITAL AGENCY' );
$hero_h1_line1     = ondigital_get_option( 'hero_h1_line1', 'Digital' );
$hero_h1_line2     = ondigital_get_option( 'hero_h1_line2', 'marketing agency' );
$hero_body         = ondigital_get_option( 'hero_body', 'We are delivering brands with high objectives the strategy' );
$hero_cta_text     = ondigital_get_option( 'hero_cta_text', 'Get started' );
$hero_cta_url      = ondigital_get_option( 'hero_cta_url' );
$hero_cta_url      = $hero_cta_url ? $hero_cta_url : home_url( '/elaqe/' );
$hero_rating       = ondigital_get_option( 'hero_rating', '4.9' );
$hero_review_count = ondigital_get_option( 'hero_review_count', '(32 reviews)' );
$hero_image        = ondigital_img( 'hero_image', '/assets/imgs/gallery/img-s-35.webp' );
?>
<section class="hero-area">
    <div class="container large">
        <div class="hero-area-inner">
            <div class="section-content">
                <div class="bg">
                    <img src="<?php echo esc_url( ONDIGITAL_URI . '/assets/imgs/shape/img-s-52.webp' ); ?>" alt="<?php esc_attr_e( 'background', 'ondigital' ); ?>">
                </div>
                <div class="section-title-wrapper">
                    <div class="subtitle-wrapper">
                        <span class="section-subtitle has-right-line"><?php echo esc_html( $hero_subtitle ); ?></span>
                    </div>
                    <div class="title-wrapper">
                        <h1 class="section-title has_text_move_anim">
                            <?php echo esc_html( $hero_h1_line1 ); ?>
                            <span class="shape-1 hero-chart-card" aria-hidden="true">
                                <span class="hcc-bars">
                                    <span class="hcc-bar hcc-b1"></span>
                                    <span class="hcc-bar hcc-b2"></span>
                                    <span class="hcc-bar hcc-b3"></span>
                                    <span class="hcc-bar hcc-b4"></span>
                                    <span class="hcc-bar hcc-b5"></span>
                                </span>
                            </span><br>
                            <?php echo esc_html( $hero_h1_line2 ); ?>
                        </h1>
                    </div>
                </div>
                <div class="text-wrapper">
                    <p class="text has_fade_anim" data-on-scroll="0" data-fade-from="left" data-delay="0.2">
                        <?php echo esc_html( $hero_body ); ?>
                    </p>
                </div>
                <div class="btn-wrapper has_fade_anim" data-on-scroll="0" data-fade-from="left" data-delay="0.35">
                    <a href="<?php echo esc_url( $hero_cta_url ); ?>" class="wc-btn wc-btn-primary btn-text-flip">
                        <span data-text="<?php echo esc_attr( $hero_cta_text ); ?>"><?php echo esc_html( $hero_cta_text ); ?></span>
                        <i class="fa-solid fa-angle-right"></i>
                    </a>
                </div>
                <div class="review-wrapper has_fade_anim" data-delay="0.45" data-on-scroll="0">
                    <div class="reviews">
                        <h2 class="rating"><?php echo esc_html( $hero_rating ); ?></h2>
                        <span class="review"><?php echo esc_html( $hero_review_count ); ?></span>
                    </div>
                    <div class="ratings">
                        <span class="rating-text"><?php esc_html_e( 'Average Rating', 'ondigital' ); ?></span>
                        <div class="rating-icons">
                            <?php for ( $i = 0; $i < 5; $i++ ) : ?>
                                <img src="<?php echo esc_url( ONDIGITAL_URI . '/assets/imgs/icon/star-2.webp' ); ?>" alt="<?php esc_attr_e( 'star', 'ondigital' ); ?>">
                            <?php endfor; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="thumb">
                <div id="hero-lottie" style="width:100%;height:100%;"></div>
                <noscript>
                    <img src="<?php echo esc_url( $hero_image ); ?>" alt="<?php esc_attr_e( 'Hero image', 'ondigital' ); ?>">
                </noscript>
            </div>
            <script>
            document.addEventListener('DOMContentLoaded', function() {
                if (typeof lottie !== 'undefined') {
                    lottie.loadAnimation({
                        container: document.getElementById('hero-lottie'),
                        renderer: 'svg',
                        loop: true,
                        autoplay: true,
                        path: '<?php echo esc_url( ONDIGITAL_URI . '/assets/lottie/hero/data.json' ); ?>'
                    });
                }
            });
            </script>
        </div>
    </div>
</section>
