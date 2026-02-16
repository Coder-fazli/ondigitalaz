<?php
/**
 * FAQ Page - Hero & Accordion Section
 *
 * @package OnDigital
 */

$faqs = array(
    array(
        'question' => __( 'OnDigital hansı xidmətləri təklif edir?', 'ondigital' ),
        'answer'   => __( 'OnDigital veb-sayt dizaynı, inkişaf etdirmə, SEO optimallaşdırma, rəqəmsal marketinq, brendinq və sosial media idarəetməsi xidmətlərini təklif edir. Biz biznesinizin onlayn görünürlüyünü artırmaq üçün hərtərəfli həllər təmin edirik.', 'ondigital' ),
    ),
    array(
        'question' => __( 'Layihənin tamamlanma müddəti nə qədərdir?', 'ondigital' ),
        'answer'   => __( 'Layihənin mürəkkəbliyindən asılı olaraq, standart veb-sayt layihəsi 2-4 həftə, daha böyük miqyaslı layihələr isə 4-8 həftə çəkə bilər. Hər bir layihə üçün dəqiq müddət ilkin məsləhətləşmə zamanı müəyyən edilir.', 'ondigital' ),
    ),
    array(
        'question' => __( 'Xidmətlərinizin qiyməti necə müəyyən edilir?', 'ondigital' ),
        'answer'   => __( 'Qiymətlərimiz layihənin həcminə, tələblərə və müddətə görə fərqlənir. Hər bir müştəri üçün fərdi qiymət təklifi hazırlayırıq. Pulsuz ilkin məsləhətləşmə üçün bizimlə əlaqə saxlayın.', 'ondigital' ),
    ),
    array(
        'question' => __( 'Layihə başa çatdıqdan sonra dəstək verirsinizmi?', 'ondigital' ),
        'answer'   => __( 'Bəli, bütün layihələrimiz üçün layihə tamamlandıqdan sonra texniki dəstək təmin edirik. Bundan əlavə, aylıq texniki xidmət paketlərimiz mövcuddur ki, veb-saytınız həmişə yenilənmiş və təhlükəsiz olsun.', 'ondigital' ),
    ),
    array(
        'question' => __( 'SEO optimallaşdırma niyə vacibdir?', 'ondigital' ),
        'answer'   => __( 'SEO optimallaşdırma veb-saytınızın axtarış motorlarında daha yüksək sıralanmasına kömək edir. Bu, orqanik trafiki artırır, potensial müştərilərin sizi tapmasını asanlaşdırır və uzunmüddətli perspektivdə reklam xərclərini azaldır.', 'ondigital' ),
    ),
    array(
        'question' => __( 'Mövcud veb-saytımı yeniləyə bilərsinizmi?', 'ondigital' ),
        'answer'   => __( 'Bəli, mövcud veb-saytınızı müasir dizayn standartlarına uyğun yeniləyə, performansını artıra və yeni funksionallıqlar əlavə edə bilərik. Yenidən dizayn prosesi mövcud kontentinizi qoruyaraq həyata keçirilir.', 'ondigital' ),
    ),
    array(
        'question' => __( 'Rəqəmsal marketinq strategiyası necə işləyir?', 'ondigital' ),
        'answer'   => __( 'Rəqəmsal marketinq strategiyamız bazarınızın təhlili, hədəf auditoriyanın müəyyən edilməsi, kontent planlaması, sosial media idarəetməsi və performans izləmə mərhələlərini əhatə edir. Hər bir strategiya biznesinizin unikal ehtiyaclarına uyğunlaşdırılır.', 'ondigital' ),
    ),
    array(
        'question' => __( 'Sizinlə necə əlaqə saxlaya bilərəm?', 'ondigital' ),
        'answer'   => __( 'Bizimlə əlaqə səhifəmizdəki forma vasitəsilə, telefon və ya e-poçt ilə əlaqə saxlaya bilərsiniz. Komandamız iş günləri ərzində 24 saat ərzində cavab verir. Pulsuz məsləhətləşmə üçün bizimlə əlaqə saxlamaqdan çəkinməyin.', 'ondigital' ),
    ),
);
?>
<section class="faq-area">
    <div class="container large">
        <div class="faq-area-inner section-spacing-bottom">
            <div class="section-content">
                <div class="btn-wrapper has_fade_anim" data-fade-from="left">
                    <a href="<?php echo esc_url( home_url( '/elaqe/' ) ); ?>" class="wc-btn wc-btn-underline"><?php esc_html_e( 'Dizayn, inkişaf və strategiya sahəsində mükəmməl xidmət göstəririk', 'ondigital' ); ?><i class="fa-solid fa-arrow-right"></i></a>
                </div>
                <div class="content-last">
                    <div class="section-title-wrapper">
                        <div class="title-wrapper">
                            <h1 class="section-title large has_fade_anim"><?php esc_html_e( 'Tez-tez verilən suallar', 'ondigital' ); ?></h1>
                        </div>
                    </div>
                    <div class="text-wrapper">
                        <p class="text has_fade_anim" data-delay="0.30">
                            <?php esc_html_e( 'OnDigital innovasiya və rəqəmsal həllərin dinamik mərkəzidir. Biz müştərilərimizə ən yaxşı xidməti təmin edirik.', 'ondigital' ); ?>
                        </p>
                    </div>
                    <div class="accordion-wrapper has_fade_anim" data-delay="0.45">
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            <?php foreach ( $faqs as $index => $faq ) :
                                $item_num   = $index + 1;
                                $item_id    = 'flush-collapse' . $item_num;
                                $heading_id = 'flush-heading' . $item_num;
                                $is_open    = ( $index === 1 );
                            ?>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="<?php echo esc_attr( $heading_id ); ?>">
                                        <button class="accordion-button<?php echo $is_open ? '' : ' collapsed'; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo esc_attr( $item_id ); ?>" aria-expanded="<?php echo $is_open ? 'true' : 'false'; ?>" aria-controls="<?php echo esc_attr( $item_id ); ?>"><?php echo esc_html( $faq['question'] ); ?></button>
                                    </h2>
                                    <div id="<?php echo esc_attr( $item_id ); ?>" class="accordion-collapse collapse<?php echo $is_open ? ' show' : ''; ?>" aria-labelledby="<?php echo esc_attr( $heading_id ); ?>" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body"><?php echo esc_html( $faq['answer'] ); ?></div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
