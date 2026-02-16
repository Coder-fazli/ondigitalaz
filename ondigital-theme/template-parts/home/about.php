<?php
/**
 * Home - About Section
 *
 * @package OnDigital
 */

$about_title      = ondigital_get_option( 'about_title', 'Unlock marketing <span>strategy</span> for your business' );
$about_body       = ondigital_get_option( 'about_body', 'We immerse ourselves in your issues and we put our knowledge and expertise at your service to provide you with an informed response.' );
$about_btn1_text  = ondigital_get_option( 'about_btn1_text', 'Learn more' );
$about_btn1_url   = ondigital_get_option( 'about_btn1_url' );
$about_btn1_url   = $about_btn1_url ? $about_btn1_url : home_url( '/haqqimizda/' );
$about_btn2_text  = ondigital_get_option( 'about_btn2_text', 'How we work' );
$about_btn2_url   = ondigital_get_option( 'about_btn2_url' );
$about_btn2_url   = $about_btn2_url ? $about_btn2_url : home_url( '/xidmetler/' );
$about_exp_number = ondigital_get_option( 'about_exp_number', '7' );
$about_exp_label  = ondigital_get_option( 'about_exp_label', 'Years of hall of fame & experience' );
$about_img1       = ondigital_img( 'about_image_1', '/assets/imgs/gallery/img-s-36.webp' );
$about_img2       = ondigital_img( 'about_image_2', '/assets/imgs/gallery/img-s-37.webp' );
$about_img3       = ondigital_img( 'about_image_3', '/assets/imgs/gallery/img-s-38.webp' );
?>
<section class="about-area">
    <div class="container">
        <div class="about-area-inner section-spacing">
            <div class="thumbs">
                <img class="img-1" src="<?php echo esc_url( $about_img1 ); ?>" alt="<?php esc_attr_e( 'About image', 'ondigital' ); ?>">
                <img class="img-2" src="<?php echo esc_url( $about_img2 ); ?>" alt="<?php esc_attr_e( 'About image', 'ondigital' ); ?>">
                <img class="img-3" src="<?php echo esc_url( $about_img3 ); ?>" alt="<?php esc_attr_e( 'About image', 'ondigital' ); ?>">
            </div>
            <div class="section-content">
                <div class="section-title-wrapper">
                    <div class="title-wrapper">
                        <h2 class="section-title has_text_move_anim">
                            <?php echo wp_kses_post( $about_title ); ?>
                        </h2>
                    </div>
                </div>
                <div class="text-wrapper">
                    <p class="text has_fade_anim">
                        <?php echo esc_html( $about_body ); ?>
                    </p>
                </div>
                <div class="btn-wrapper has_fade_anim">
                    <a href="<?php echo esc_url( $about_btn1_url ); ?>" class="wc-btn wc-btn-primary btn-text-flip">
                        <span data-text="<?php echo esc_attr( $about_btn1_text ); ?>"><?php echo esc_html( $about_btn1_text ); ?></span>
                    </a>
                    <a href="<?php echo esc_url( $about_btn2_url ); ?>" class="wc-btn wc-btn-underline btn-text-flip">
                        <span data-text="<?php echo esc_attr( $about_btn2_text ); ?>"><?php echo esc_html( $about_btn2_text ); ?></span>
                    </a>
                </div>
                <div class="experience-box has_fade_anim">
                    <h3 class="number wc-counter"><?php echo esc_html( $about_exp_number ); ?><i class="fa-solid fa-plus"></i></h3>
                    <h3 class="info"><?php echo esc_html( $about_exp_label ); ?></h3>
                </div>
            </div>
        </div>
    </div>
</section>
