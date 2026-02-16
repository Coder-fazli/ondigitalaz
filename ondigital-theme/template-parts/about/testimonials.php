<?php
/**
 * About - Testimonials Section
 *
 * @package OnDigital
 */

$testimonials = array(
    array(
        'text' => __( 'OnDigital ilə əməkdaşlıq bizim üçün sadəcə bir biznes tərəfdaşlığı deyil, hər gün bizimlə birlikdə çalışan, çətinliklərdə yanımızda olan və uğurlarımızı birlikdə qeyd edən bir komandadır.', 'ondigital' ),
        'name' => 'Əli Həsənov',
        'post' => __( 'Direktor', 'ondigital' ),
    ),
    array(
        'text' => __( 'Rəqəmsal marketinq strategiyaları sayəsində satışlarımız 3 qat artdı. OnDigital komandası peşəkarlıq və yaradıcılıq baxımından gözləntilərimizi aşdı.', 'ondigital' ),
        'name' => 'Leyla Məmmədova',
        'post' => __( 'Marketinq Meneceri', 'ondigital' ),
    ),
    array(
        'text' => __( 'Veb saytımızın yenidən dizaynı biznesimizə yeni nəfəs verdi. İstifadəçi təcrübəsi və konversiya nisbəti əhəmiyyətli dərəcədə yaxşılaşdı.', 'ondigital' ),
        'name' => 'Rəşad Əliyev',
        'post' => __( 'CEO', 'ondigital' ),
    ),
    array(
        'text' => __( 'SEO xidmətləri sayəsində Google-da birinci səhifəyə çıxdıq. Üzvi trafik 200% artdı və yeni müştəri axını başladı.', 'ondigital' ),
        'name' => 'Nigar Hüseynova',
        'post' => __( 'Biznes Sahibi', 'ondigital' ),
    ),
);
?>
<div class="testimonial-area has_fade_anim">
    <div class="container">
        <div class="testimonial-area-inner section-spacing">
            <div class="testimonial-wrapper-box">
                <div class="testimonial-wrapper">
                    <div class="swiper testimonial-slider">
                        <div class="swiper-wrapper">
                            <?php foreach ( $testimonials as $testimonial ) : ?>
                                <div class="swiper-slide">
                                    <div class="testimonial-item">
                                        <div class="content">
                                            <div class="icon">
                                                <img class="quote-icon show-light" src="<?php echo esc_url( ONDIGITAL_URI . '/assets/imgs/icon/quote-5.webp' ); ?>" alt="<?php esc_attr_e( 'Sitat', 'ondigital' ); ?>">
                                                <img class="quote-icon show-dark" src="<?php echo esc_url( ONDIGITAL_URI . '/assets/imgs/icon/quote-5-light.webp' ); ?>" alt="<?php esc_attr_e( 'Sitat', 'ondigital' ); ?>">
                                            </div>
                                            <div class="text-wrapper">
                                                <p class="text"><?php echo esc_html( $testimonial['text'] ); ?></p>
                                            </div>
                                            <div class="author">
                                                <div class="meta">
                                                    <span class="name"><?php echo esc_html( $testimonial['name'] ); ?>, </span>
                                                    <span class="post"><?php echo esc_html( $testimonial['post'] ); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="slider-nav">
                    <div class="testimonial-button-prev nav-icon">
                        <img class="show-light" src="<?php echo esc_url( ONDIGITAL_URI . '/assets/imgs/icon/angle-left.webp' ); ?>" alt="<?php esc_attr_e( 'əvvəlki', 'ondigital' ); ?>">
                        <img class="show-dark" src="<?php echo esc_url( ONDIGITAL_URI . '/assets/imgs/icon/angle-left-light.webp' ); ?>" alt="<?php esc_attr_e( 'əvvəlki', 'ondigital' ); ?>">
                    </div>
                    <div class="testimonial-button-next nav-icon">
                        <img class="show-light" src="<?php echo esc_url( ONDIGITAL_URI . '/assets/imgs/icon/angle-right.webp' ); ?>" alt="<?php esc_attr_e( 'növbəti', 'ondigital' ); ?>">
                        <img class="show-dark" src="<?php echo esc_url( ONDIGITAL_URI . '/assets/imgs/icon/angle-right-light.webp' ); ?>" alt="<?php esc_attr_e( 'növbəti', 'ondigital' ); ?>">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
