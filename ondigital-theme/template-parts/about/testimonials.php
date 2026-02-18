<?php
/**
 * About - Testimonials Section
 *
 * @package OnDigital
 */

$default_testimonials = array(
    array( 'text' => 'OnDigital ilə əməkdaşlıq bizim üçün sadəcə bir biznes tərəfdaşlığı deyil, hər gün bizimlə birlikdə çalışan, çətinliklərdə yanımızda olan və uğurlarımızı birlikdə qeyd edən bir komandadır.', 'name' => 'Əli Həsənov', 'role' => 'Direktor' ),
    array( 'text' => 'Rəqəmsal marketinq strategiyaları sayəsində satışlarımız 3 qat artdı. OnDigital komandası peşəkarlıq və yaradıcılıq baxımından gözləntilərimizi aşdı.', 'name' => 'Leyla Məmmədova', 'role' => 'Marketinq Meneceri' ),
    array( 'text' => 'Veb saytımızın yenidən dizaynı biznesimizə yeni nəfəs verdi. İstifadəçi təcrübəsi və konversiya nisbəti əhəmiyyətli dərəcədə yaxşılaşdı.', 'name' => 'Rəşad Əliyev', 'role' => 'CEO' ),
    array( 'text' => 'SEO xidmətləri sayəsində Google-da birinci səhifəyə çıxdıq. Üzvi trafik 200% artdı və yeni müştəri axını başladı.', 'name' => 'Nigar Hüseynova', 'role' => 'Biznes Sahibi' ),
);

$testimonials = ondigital_get_repeater( 'about_testimonials', $default_testimonials );
?>
<div class="testimonial-area has_fade_anim">
    <div class="container">
        <div class="testimonial-area-inner section-spacing">
            <div class="testimonial-wrapper-box">
                <div class="testimonial-wrapper">
                    <div class="swiper testimonial-slider">
                        <div class="swiper-wrapper">
                            <?php foreach ( $testimonials as $t ) :
                                $text = $t['text'] ?? '';
                                $name = $t['name'] ?? '';
                                $role = $t['role'] ?? ( $t['post'] ?? '' );
                            ?>
                                <div class="swiper-slide">
                                    <div class="testimonial-item">
                                        <div class="content">
                                            <div class="icon">
                                                <img class="quote-icon show-light" src="<?php echo esc_url( ONDIGITAL_URI . '/assets/imgs/icon/quote-5.webp' ); ?>" alt="<?php esc_attr_e( 'Sitat', 'ondigital' ); ?>">
                                                <img class="quote-icon show-dark" src="<?php echo esc_url( ONDIGITAL_URI . '/assets/imgs/icon/quote-5-light.webp' ); ?>" alt="<?php esc_attr_e( 'Sitat', 'ondigital' ); ?>">
                                            </div>
                                            <div class="text-wrapper">
                                                <p class="text"><?php echo esc_html( $text ); ?></p>
                                            </div>
                                            <div class="author">
                                                <div class="meta">
                                                    <span class="name"><?php echo esc_html( $name ); ?>, </span>
                                                    <span class="post"><?php echo esc_html( $role ); ?></span>
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
