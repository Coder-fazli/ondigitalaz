<?php
/**
 * About - Awards / Who We Are Section
 *
 * @package OnDigital
 */

$awards_subtitle  = ondigital_get_option( 'about_awards_subtitle', '02. Biz kimik' );
$awards_title     = ondigital_get_option( 'about_awards_title', 'OnDigital ilə biznesinizin strateji inkişafını təmin edirik!' );
$awards_body      = ondigital_get_option( 'about_awards_body', 'Dünya səviyyəsində kreativ dizayn, peşəkar komanda və müasir texnologiyalarla müştərilərimizin rəqəmsal dünyada uğur qazanmasına kömək edirik. Bizim üçün ən böyük uğur müştərilərimizin davamlı nəticələr əldə etməsidir.' );

$award1_number    = ondigital_get_option( 'about_award1_number', '50+' );
$award1_text      = ondigital_get_option( 'about_award1_text', 'uğurlu layihə 99% müştəri məmnuniyyəti' );
$award1_icon      = ondigital_img( 'about_award1_icon', '/assets/imgs/icon/icon-s-40.webp' );
$award1_icon_dark = ondigital_img( 'about_award1_icon_dark', '/assets/imgs/icon/icon-s-40-light.webp' );

$award2_number    = ondigital_get_option( 'about_award2_number', '12+' );
$award2_text      = ondigital_get_option( 'about_award2_text', 'rəqəmsal innovasiya mükafatı' );
$award2_icon      = ondigital_img( 'about_award2_icon', '/assets/imgs/icon/icon-s-41.webp' );
$award2_icon_dark = ondigital_img( 'about_award2_icon_dark', '/assets/imgs/icon/icon-s-41-light.webp' );

$awards_thumb1    = ondigital_img( 'about_awards_thumb1', '/assets/imgs/gallery/img-s-3.webp' );
$awards_thumb2    = ondigital_img( 'about_awards_thumb2', '/assets/imgs/gallery/img-s-4.webp' );
?>
<section class="awards-area">
    <div class="container">
        <div class="awards-area-inner section-spacing">
            <div class="section-header">
                <div class="section-title-wrapper">
                    <div class="subtitle-wrapper">
                        <span class="section-subtitle has-left-line"><?php echo esc_html( $awards_subtitle ); ?></span>
                    </div>
                    <div class="title-wrapper">
                        <h2 class="section-title has_fade_anim">
                            <?php echo esc_html( $awards_title ); ?>
                        </h2>
                    </div>
                </div>
            </div>
            <div class="section-content">
                <div class="text-wrapper">
                    <p class="text has_fade_anim" data-fade-from="left">
                        <?php echo esc_html( $awards_body ); ?>
                    </p>
                </div>
                <div class="awards-list has_fade_anim">
                    <ul>
                        <li>
                            <div class="meta">
                                <div class="icon">
                                    <img class="show-light" src="<?php echo esc_url( $award1_icon ); ?>" alt="<?php esc_attr_e( 'ikon', 'ondigital' ); ?>">
                                    <img class="show-dark" src="<?php echo esc_url( $award1_icon_dark ); ?>" alt="<?php esc_attr_e( 'ikon', 'ondigital' ); ?>">
                                </div>
                                <div class="content">
                                    <h3 class="number wc-counter"><?php echo esc_html( $award1_number ); ?></h3>
                                    <p class="text"><?php echo esc_html( $award1_text ); ?></p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="meta">
                                <div class="icon">
                                    <img class="show-light" src="<?php echo esc_url( $award2_icon ); ?>" alt="<?php esc_attr_e( 'ikon', 'ondigital' ); ?>">
                                    <img class="show-dark" src="<?php echo esc_url( $award2_icon_dark ); ?>" alt="<?php esc_attr_e( 'ikon', 'ondigital' ); ?>">
                                </div>
                                <div class="content">
                                    <h3 class="number wc-counter"><?php echo esc_html( $award2_number ); ?></h3>
                                    <p class="text"><?php echo esc_html( $award2_text ); ?></p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="about-thumbs">
                <div class="thumb-first">
                    <img src="<?php echo esc_url( $awards_thumb1 ); ?>" class="has_fade_anim" data-fade-from="right" alt="<?php esc_attr_e( 'Haqqımızda', 'ondigital' ); ?>">
                </div>
                <div class="thumb-second">
                    <img src="<?php echo esc_url( $awards_thumb2 ); ?>" class="has_fade_anim" data-fade-from="left" alt="<?php esc_attr_e( 'Haqqımızda', 'ondigital' ); ?>">
                </div>
            </div>
        </div>
    </div>
</section>
