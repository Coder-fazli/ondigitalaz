<?php
/**
 * About - FAQ Section
 *
 * @package OnDigital
 */

$faq_thumb     = ondigital_img( 'about_faq_thumb', '/assets/imgs/gallery/img-s-85.webp' );
$faq_video_url = ondigital_get_option( 'about_faq_video_url', 'https://www.youtube.com/watch?v=AzwC6umvd1s' );
$faq_title     = ondigital_get_option( 'about_faq_title', 'UI/UX dizayn və kreativ istiqamətdə fəaliyyət göstəririk.' );

$default_faqs = array(
    array( 'question' => 'Veb sayt və mobil dizayn', 'answer' => 'Müasir və istifadəçi dostu veb saytlar və mobil tətbiqlər yaradırıq. Hər bir layihə müştərinin ehtiyaclarına uyğun fərdi yanaşma ilə hazırlanır.', 'open' => 0 ),
    array( 'question' => 'Rəqəmsal marketinq strategiyası', 'answer' => 'SEO, SMM, Google Ads və digər rəqəmsal kanallar vasitəsilə biznesinizin onlayn görünürlüyünü artırırıq. Hər bir strategiya məlumat əsasında hazırlanır.', 'open' => 1 ),
    array( 'question' => 'Brend identifikasiyası', 'answer' => 'Loqo dizaynından tutmuş tam korporativ üslub kitabçasına qədər brendinizin hər bir aspektini peşəkar şəkildə formalaşdırırıq.', 'open' => 0 ),
);

$faqs = ondigital_get_repeater( 'about_faq_items', $default_faqs );
?>
<section class="faq-area">
    <div class="container">
        <div class="faq-area-inner section-spacing-bottom">
            <div class="section-content">
                <div class="thumb">
                    <img src="<?php echo esc_url( $faq_thumb ); ?>" alt="<?php esc_attr_e( 'FAQ', 'ondigital' ); ?>">
                    <?php if ( $faq_video_url ) : ?>
                        <a href="<?php echo esc_url( $faq_video_url ); ?>" class="wc-btn wc-btn-circle video-popup pos-center">
                            <i class="fa-solid fa-play"></i>
                        </a>
                    <?php endif; ?>
                </div>
                <div class="content-last">
                    <div class="section-title-wrapper">
                        <div class="title-wrapper">
                            <h2 class="section-title has_fade_anim">
                                <?php echo esc_html( $faq_title ); ?>
                            </h2>
                        </div>
                    </div>
                    <div class="accordion-wrapper has_fade_anim">
                        <div class="accordion accordion-flush" id="aboutAccordion">
                            <?php foreach ( $faqs as $i => $faq ) :
                                $question = $faq['question'] ?? '';
                                $answer   = $faq['answer'] ?? '';
                                $open     = ! empty( $faq['open'] );
                            ?>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="about-heading-<?php echo esc_attr( $i ); ?>">
                                        <button class="accordion-button <?php echo $open ? '' : 'collapsed'; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#about-collapse-<?php echo esc_attr( $i ); ?>" aria-expanded="<?php echo $open ? 'true' : 'false'; ?>" aria-controls="about-collapse-<?php echo esc_attr( $i ); ?>">
                                            <?php echo esc_html( $question ); ?>
                                        </button>
                                    </h2>
                                    <div id="about-collapse-<?php echo esc_attr( $i ); ?>" class="accordion-collapse collapse <?php echo $open ? 'show' : ''; ?>" aria-labelledby="about-heading-<?php echo esc_attr( $i ); ?>" data-bs-parent="#aboutAccordion">
                                        <div class="accordion-body">
                                            <?php echo esc_html( $answer ); ?>
                                        </div>
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
