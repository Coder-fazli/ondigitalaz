<?php
/**
 * Contact - Hero Section
 *
 * @package OnDigital
 */
?>
<section class="hero-area">
    <div class="container">
        <div class="hero-area-inner">
            <div class="section-content">
                <div class="section-title-wrapper">
                    <div class="title-wrapper">
                        <h1 class="section-title large has_fade_anim">
                            <?php echo wp_kses_post( __( 'Sualınız var? <br> Sadəcə soruşun. <br> Burası sizin <br> evinizdir!', 'ondigital' ) ); ?>
                        </h1>
                    </div>
                </div>
                <div class="content-last">
                    <div class="col-first">
                        <div class="image-box overflow-hidden">
                            <img src="<?php echo esc_url( ONDIGITAL_URI . '/assets/imgs/gallery/img-s-106.webp' ); ?>" data-speed="0.9" alt="<?php esc_attr_e( 'Əlaqə', 'ondigital' ); ?>">
                        </div>
                        <div class="contact-box">
                            <div class="shape-1">
                                <img src="<?php echo esc_url( ONDIGITAL_URI . '/assets/imgs/shape/img-s-89.webp' ); ?>" alt="<?php esc_attr_e( 'dekor', 'ondigital' ); ?>">
                            </div>
                            <span class="title"><?php esc_html_e( 'Birbaşa əlaqə:', 'ondigital' ); ?> </span>
                            <?php
                            $phone = get_theme_mod( 'ondigital_phone', '+994 50 123 45 67' );
                            ?>
                            <p class="link"><a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $phone ) ); ?>"><?php echo esc_html( $phone ); ?></a></p>
                        </div>
                    </div>
                    <div class="col-second">
                        <div class="image-box">
                            <img src="<?php echo esc_url( ONDIGITAL_URI . '/assets/imgs/gallery/img-s-107.webp' ); ?>" alt="<?php esc_attr_e( 'Əlaqə', 'ondigital' ); ?>">
                        </div>
                        <div class="image-box overflow-hidden">
                            <img src="<?php echo esc_url( ONDIGITAL_URI . '/assets/imgs/gallery/img-s-108.webp' ); ?>" data-speed="0.9" alt="<?php esc_attr_e( 'Əlaqə', 'ondigital' ); ?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="image-wrapper overflow-hidden">
    <img class="w-100" src="<?php echo esc_url( ONDIGITAL_URI . '/assets/imgs/gallery/img-s-105.webp' ); ?>" data-speed="0.9" alt="<?php esc_attr_e( 'Əlaqə banner', 'ondigital' ); ?>">
</div>
