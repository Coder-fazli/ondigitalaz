<?php
/**
 * FAQ Page - Hero & Accordion Section
 *
 * @package OnDigital
 */

$default_faqs = array(
    array( 'question' => __( 'OnDigital hansı xidmətləri təklif edir?', 'ondigital' ), 'answer' => __( 'OnDigital veb-sayt dizaynı, inkişaf etdirmə, SEO optimallaşdırma, rəqəmsal marketinq, brendinq və sosial media idarəetməsi xidmətlərini təklif edir.', 'ondigital' ), 'open' => 0 ),
    array( 'question' => __( 'Layihənin tamamlanma müddəti nə qədərdir?', 'ondigital' ), 'answer' => __( 'Layihənin mürəkkəbliyindən asılı olaraq, standart veb-sayt layihəsi 2-4 həftə, daha böyük miqyaslı layihələr isə 4-8 həftə çəkə bilər.', 'ondigital' ), 'open' => 1 ),
    array( 'question' => __( 'Xidmətlərinizin qiyməti necə müəyyən edilir?', 'ondigital' ), 'answer' => __( 'Qiymətlərimiz layihənin həcminə, tələblərə və müddətə görə fərqlənir. Hər bir müştəri üçün fərdi qiymət təklifi hazırlayırıq.', 'ondigital' ), 'open' => 0 ),
    array( 'question' => __( 'Layihə başa çatdıqdan sonra dəstək verirsinizmi?', 'ondigital' ), 'answer' => __( 'Bəli, bütün layihələrimiz üçün layihə tamamlandıqdan sonra texniki dəstək təmin edirik.', 'ondigital' ), 'open' => 0 ),
    array( 'question' => __( 'SEO optimallaşdırma niyə vacibdir?', 'ondigital' ), 'answer' => __( 'SEO optimallaşdırma veb-saytınızın axtarış motorlarında daha yüksək sıralanmasına kömək edir.', 'ondigital' ), 'open' => 0 ),
    array( 'question' => __( 'Mövcud veb-saytımı yeniləyə bilərsinizmi?', 'ondigital' ), 'answer' => __( 'Bəli, mövcud veb-saytınızı müasir dizayn standartlarına uyğun yeniləyə, performansını artıra və yeni funksionallıqlar əlavə edə bilərik.', 'ondigital' ), 'open' => 0 ),
);

$faqs = ondigital_get_repeater( 'faq', $default_faqs );

if ( empty( $faqs ) ) {
    return;
}

$options      = get_option( 'ondigital_options', array() );
$lang         = function_exists( 'pll_current_language' ) ? pll_current_language() : 'en';
$title        = $options[ 'faq_title_' . $lang ] ?? $options['faq_title_az'] ?? __( 'Tez-tez verilən suallar', 'ondigital' );
$sidebar_text = $options[ 'faq_sidebar_text_' . $lang ] ?? $options['faq_sidebar_text_az'] ?? __( 'Dizayn, inkişaf və strategiya sahəsində mükəmməl xidmət göstəririk', 'ondigital' );
$sidebar_url  = $options[ 'faq_sidebar_url_' . $lang ] ?? $options['faq_sidebar_url_az'] ?? home_url( '/elaqe/' );
?>
<section class="faq-area">
    <div class="container large">
        <div class="faq-area-inner section-spacing-bottom">
            <div class="section-content">
                <?php if ( $sidebar_text ) : ?>
                <div class="btn-wrapper has_fade_anim" data-fade-from="left">
                    <a href="<?php echo esc_url( $sidebar_url ); ?>" class="wc-btn wc-btn-underline"><?php echo esc_html( $sidebar_text ); ?><i class="fa-solid fa-arrow-right"></i></a>
                </div>
                <?php endif; ?>
                <div class="content-last">
                    <div class="section-title-wrapper">
                        <div class="title-wrapper">
                            <h1 class="section-title large has_fade_anim"><?php echo esc_html( $title ); ?></h1>
                        </div>
                    </div>
                    <div class="accordion-wrapper has_fade_anim" data-delay="0.45">
                        <div class="accordion accordion-flush" id="faqPageAccordion">
                            <?php foreach ( $faqs as $index => $faq ) :
                                $item_num   = $index + 1;
                                $item_id    = 'faq-collapse-' . $item_num;
                                $heading_id = 'faq-heading-' . $item_num;
                                $is_open    = ! empty( $faq['open'] );
                                $question   = $faq[ 'question_' . $lang ] ?? $faq['question'] ?? '';
                                $answer     = $faq[ 'answer_' . $lang ]   ?? $faq['answer']   ?? '';
                            ?>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="<?php echo esc_attr( $heading_id ); ?>">
                                        <button class="accordion-button<?php echo $is_open ? '' : ' collapsed'; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo esc_attr( $item_id ); ?>" aria-expanded="<?php echo $is_open ? 'true' : 'false'; ?>" aria-controls="<?php echo esc_attr( $item_id ); ?>">
                                            <?php echo esc_html( $question ); ?>
                                        </button>
                                    </h2>
                                    <div id="<?php echo esc_attr( $item_id ); ?>" class="accordion-collapse collapse<?php echo $is_open ? ' show' : ''; ?>" aria-labelledby="<?php echo esc_attr( $heading_id ); ?>">
                                        <div class="accordion-body"><?php echo esc_html( $answer ); ?></div>
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
