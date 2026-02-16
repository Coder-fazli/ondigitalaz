<?php
/**
 * About - FAQ Section
 *
 * @package OnDigital
 */

$faqs = array(
    array(
        'question' => __( 'Veb sayt və mobil dizayn', 'ondigital' ),
        'answer'   => __( 'Müasir və istifadəçi dostu veb saytlar və mobil tətbiqlər yaradırıq. Hər bir layihə müştərinin ehtiyaclarına uyğun fərdi yanaşma ilə hazırlanır.', 'ondigital' ),
        'open'     => false,
    ),
    array(
        'question' => __( 'Rəqəmsal marketinq strategiyası', 'ondigital' ),
        'answer'   => __( 'SEO, SMM, Google Ads və digər rəqəmsal kanallar vasitəsilə biznesinizin onlayn görünürlüyünü artırırıq. Hər bir strategiya məlumat əsasında hazırlanır.', 'ondigital' ),
        'open'     => true,
    ),
    array(
        'question' => __( 'Brend identifikasiyası', 'ondigital' ),
        'answer'   => __( 'Loqo dizaynından tutmuş tam korporativ üslub kitabçasına qədər brendinizin hər bir aspektini peşəkar şəkildə formalaşdırırıq.', 'ondigital' ),
        'open'     => false,
    ),
);
?>
<section class="faq-area">
    <div class="container">
        <div class="faq-area-inner section-spacing-bottom">
            <div class="section-content">
                <div class="thumb">
                    <img src="<?php echo esc_url( ONDIGITAL_URI . '/assets/imgs/gallery/img-s-85.webp' ); ?>" alt="<?php esc_attr_e( 'FAQ', 'ondigital' ); ?>">
                </div>
                <div class="content-last">
                    <div class="section-title-wrapper">
                        <div class="title-wrapper">
                            <h2 class="section-title has_fade_anim">
                                <?php esc_html_e( 'UI/UX dizayn və kreativ istiqamətdə fəaliyyət göstəririk.', 'ondigital' ); ?>
                            </h2>
                        </div>
                    </div>
                    <div class="accordion-wrapper has_fade_anim">
                        <div class="accordion accordion-flush" id="aboutAccordion">
                            <?php foreach ( $faqs as $i => $faq ) : ?>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="about-heading-<?php echo esc_attr( $i ); ?>">
                                        <button class="accordion-button <?php echo $faq['open'] ? '' : 'collapsed'; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#about-collapse-<?php echo esc_attr( $i ); ?>" aria-expanded="<?php echo $faq['open'] ? 'true' : 'false'; ?>" aria-controls="about-collapse-<?php echo esc_attr( $i ); ?>">
                                            <?php echo esc_html( $faq['question'] ); ?>
                                        </button>
                                    </h2>
                                    <div id="about-collapse-<?php echo esc_attr( $i ); ?>" class="accordion-collapse collapse <?php echo $faq['open'] ? 'show' : ''; ?>" aria-labelledby="about-heading-<?php echo esc_attr( $i ); ?>" data-bs-parent="#aboutAccordion">
                                        <div class="accordion-body">
                                            <?php echo esc_html( $faq['answer'] ); ?>
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
