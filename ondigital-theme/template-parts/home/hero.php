<?php
/**
 * Home - Hero Section
 *
 * @package OnDigital
 */
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
                        <span class="section-subtitle has-right-line"><?php esc_html_e( 'AWARD WINNING DIGITAL AGENCY', 'ondigital' ); ?></span>
                    </div>
                    <div class="title-wrapper">
                        <h1 class="section-title has_text_move_anim">
                            <?php esc_html_e( 'Digital', 'ondigital' ); ?>
                            <img class="shape-1 has_fade_anim" data-delay="0.7" data-fade-offset="100" data-fade-from="top" data-ease="bounce" src="<?php echo esc_url( ONDIGITAL_URI . '/assets/imgs/shape/img-s-50.webp' ); ?>" alt="<?php esc_attr_e( 'shape', 'ondigital' ); ?>"><br>
                            <?php esc_html_e( 'marketing agency', 'ondigital' ); ?>
                        </h1>
                    </div>
                </div>
                <div class="text-wrapper">
                    <p class="text has_fade_anim" data-fade-from="left" data-delay="0.7">
                        <?php esc_html_e( 'We are delivering brands with high objectives the strategy', 'ondigital' ); ?>
                    </p>
                </div>
                <div class="btn-wrapper has_fade_anim" data-fade-from="left" data-delay="1.2">
                    <a href="<?php echo esc_url( home_url( '/elaqe/' ) ); ?>" class="wc-btn wc-btn-primary btn-text-flip">
                        <span data-text="<?php esc_attr_e( 'Get started', 'ondigital' ); ?>"><?php esc_html_e( 'Get started', 'ondigital' ); ?></span>
                        <i class="fa-solid fa-angle-right"></i>
                    </a>
                </div>
                <div class="review-wrapper has_fade_anim" data-delay="1.2" data-on-scroll="0">
                    <div class="reviews">
                        <h2 class="rating">4.9</h2>
                        <span class="review">(32 reviews)</span>
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
                <img src="<?php echo esc_url( ONDIGITAL_URI . '/assets/imgs/gallery/img-s-35.webp' ); ?>" alt="<?php esc_attr_e( 'Hero image', 'ondigital' ); ?>">
            </div>
        </div>
    </div>
</section>
