<?php
/**
 * Home - About Section
 *
 * @package OnDigital
 */
?>
<section class="about-area">
    <div class="container">
        <div class="about-area-inner section-spacing">
            <div class="thumbs">
                <img class="img-1" src="<?php echo esc_url( ONDIGITAL_URI . '/assets/imgs/gallery/img-s-36.webp' ); ?>" alt="<?php esc_attr_e( 'About image', 'ondigital' ); ?>">
                <img class="img-2" src="<?php echo esc_url( ONDIGITAL_URI . '/assets/imgs/gallery/img-s-37.webp' ); ?>" alt="<?php esc_attr_e( 'About image', 'ondigital' ); ?>">
                <img class="img-3" src="<?php echo esc_url( ONDIGITAL_URI . '/assets/imgs/gallery/img-s-38.webp' ); ?>" alt="<?php esc_attr_e( 'About image', 'ondigital' ); ?>">
            </div>
            <div class="section-content">
                <div class="section-title-wrapper">
                    <div class="title-wrapper">
                        <h2 class="section-title has_text_move_anim">
                            <?php echo wp_kses_post( __( 'Unlock marketing <span>strategy</span> for your business', 'ondigital' ) ); ?>
                        </h2>
                    </div>
                </div>
                <div class="text-wrapper">
                    <p class="text has_fade_anim">
                        <?php esc_html_e( 'We immerse ourselves in your issues and we put our knowledge and expertise at your service to provide you with an informed response.', 'ondigital' ); ?>
                    </p>
                </div>
                <div class="btn-wrapper has_fade_anim">
                    <a href="<?php echo esc_url( home_url( '/haqqimizda/' ) ); ?>" class="wc-btn wc-btn-primary btn-text-flip">
                        <span data-text="<?php esc_attr_e( 'Learn more', 'ondigital' ); ?>"><?php esc_html_e( 'Learn more', 'ondigital' ); ?></span>
                    </a>
                    <a href="<?php echo esc_url( home_url( '/xidmetler/' ) ); ?>" class="wc-btn wc-btn-underline btn-text-flip">
                        <span data-text="<?php esc_attr_e( 'How we work', 'ondigital' ); ?>"><?php esc_html_e( 'How we work', 'ondigital' ); ?></span>
                    </a>
                </div>
                <div class="experience-box has_fade_anim">
                    <h3 class="number wc-counter">7<i class="fa-solid fa-plus"></i></h3>
                    <h3 class="info"><?php esc_html_e( 'Years of hall of fame & experience', 'ondigital' ); ?></h3>
                </div>
            </div>
        </div>
    </div>
</section>
