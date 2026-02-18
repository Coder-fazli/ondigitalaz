<?php
/**
 * About - Hero Section
 *
 * @package OnDigital
 */

$about_hero_title    = ondigital_get_option( 'about_hero_title', 'Biz "OnDigital" - rəqəmsal marketinq və kreativ agentlik, Bakıda fəaliyyət göstəririk' );
$about_hero_subtitle = ondigital_get_option( 'about_hero_subtitle', '01. Haqqımızda' );
$about_hero_body     = ondigital_get_option( 'about_hero_body', '2017-ci ildən bəri müştərilərimizin rəqəmsal dünyada uğur qazanmasına kömək edirik. Kreativ yanaşma, strateji düşüncə və müasir texnologiyalarla biznesinizi irəli aparırıq.' );
?>
<section class="hero-area">
    <div class="container large">
        <div class="hero-area-inner">
            <div class="section-content">
                <div class="section-title-wrapper">
                    <div class="title-wrapper">
                        <h1 class="section-title large has_fade_anim">
                            <?php echo wp_kses_post( $about_hero_title ); ?>
                        </h1>
                    </div>
                </div>
                <div class="content-last">
                    <div class="subtitle-wrapper has_fade_anim" data-fade-from="right">
                        <span class="section-subtitle has-right-line"><?php echo esc_html( $about_hero_subtitle ); ?></span>
                    </div>
                    <div class="text-wrapper">
                        <p class="text has_fade_anim" data-fade-from="left">
                            <?php echo esc_html( $about_hero_body ); ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
