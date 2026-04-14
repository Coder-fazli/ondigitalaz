<?php
/**
 * 404 Error Page
 *
 * @package OnDigital
 */

get_header(); ?>

<section class="error-area">
    <div class="container">
        <div class="error-area-inner section-spacing">
            <div class="section-content">
                <div class="shape-1">
                    <img class="show-light" src="<?php echo esc_url( ONDIGITAL_URI . '/assets/imgs/shape/img-s-88.webp' ); ?>" alt="<?php esc_attr_e( 'dekor', 'ondigital' ); ?>">
                    <img class="show-dark" src="<?php echo esc_url( ONDIGITAL_URI . '/assets/imgs/shape/img-s-88-light.webp' ); ?>" alt="<?php esc_attr_e( 'dekor', 'ondigital' ); ?>">
                </div>
                <div class="error-shape has_fade_anim">
                    <img class="show-light" src="<?php echo esc_url( ONDIGITAL_URI . '/assets/imgs/shape/img-s-87.webp' ); ?>" alt="<?php esc_attr_e( '404', 'ondigital' ); ?>">
                    <img class="show-dark" src="<?php echo esc_url( ONDIGITAL_URI . '/assets/imgs/shape/img-s-87-light.webp' ); ?>" alt="<?php esc_attr_e( '404', 'ondigital' ); ?>">
                </div>
                <div class="section-title-wrapper">
                    <div class="title-wrapper">
                        <h1 class="section-title has_fade_anim" data-delay="0.30"><?php esc_html_e( 'Oops! Səhifə tapılmadı!', 'ondigital' ); ?></h1>
                    </div>
                </div>
                <div class="text-wrapper">
                    <p class="text has_fade_anim" data-delay="0.45">
                        <?php esc_html_e( 'Axtardığınız səhifə mövcud deyil və ya köçürülmüşdür.', 'ondigital' ); ?>
                    </p>
                </div>
                <div class="btn-wrapper has_fade_anim" data-delay="0.60">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="wc-btn wc-btn-primary btn-text-flip">
                        <span data-text="<?php esc_attr_e( 'Ana Səhifəyə Qayıt', 'ondigital' ); ?>"><?php esc_html_e( 'Ana Səhifəyə Qayıt', 'ondigital' ); ?></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer();
