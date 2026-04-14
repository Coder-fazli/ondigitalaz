<?php
/**
 * Team Page - Hero Section
 *
 * @package OnDigital
 */
?>
<section class="hero-area">
    <div class="container large">
        <div class="hero-area-inner">
            <div class="section-content">
                <div class="btn-wrapper has_fade_anim" data-fade-from="left">
                    <a href="<?php echo esc_url( home_url( '/elaqe/' ) ); ?>" class="wc-btn wc-btn-underline"><?php esc_html_e( 'Qlobal auditoriyaya xidmət göstərmək və karyeranızı irəli aparmaq istəyirsiniz?', 'ondigital' ); ?><i class="fa-solid fa-arrow-right"></i></a>
                </div>
                <div class="content-last">
                    <div class="section-title-wrapper">
                        <div class="title-wrapper">
                            <h1 class="section-title large has_text_move_anim"><?php esc_html_e( 'Uğur üçün birlikdə çalışırıq.', 'ondigital' ); ?></h1>
                        </div>
                    </div>
                    <div class="text-wrapper">
                        <p class="text has_fade_anim" data-fade-from="left">
                            <?php esc_html_e( 'OnDigital innovasiya və rəqəmsal həllərin dinamik mərkəzidir. Komandamız hər bir layihəyə ehtiras və peşəkarlıq gətirir.', 'ondigital' ); ?>
                        </p>
                    </div>
                    <div class="fun-fact has_fade_anim" data-fade-from="bottom">
                        <span class="number wc-counter">100 +</span>
                        <p class="text"><?php esc_html_e( 'Məmnun Müştəri', 'ondigital' ); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="image-wrapper">
    <div class="container large">
        <div class="p-relative">
            <div class="experience has_fade_anim" data-fade-from="top" data-ease="bounce">
                <h2 class="number wc-counter">20+</h2>
                <h2 class="text"><?php echo wp_kses_post( __( 'Peşəkar <br> əməkdaş', 'ondigital' ) ); ?></h2>
            </div>
        </div>
    </div>
    <img class="w-100 has_fade_anim" data-on-scroll="0" src="<?php echo esc_url( ONDIGITAL_URI . '/assets/imgs/gallery/img-s-104.webp' ); ?>" alt="<?php esc_attr_e( 'Komanda', 'ondigital' ); ?>">
</div>
