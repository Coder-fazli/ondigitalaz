<?php
/**
 * Home Page — FAQ Section
 *
 * @package OnDigital
 */

$faq_items = ondigital_get_repeater( 'faq', array() );

if ( empty( $faq_items ) ) {
    return;
}

$options      = get_option( 'ondigital_options', array() );
$lang         = function_exists( 'pll_current_language' ) ? pll_current_language() : 'az';
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
                            <h2 class="section-title large has_fade_anim"><?php echo esc_html( $title ); ?></h2>
                        </div>
                    </div>
                    <div class="accordion-wrapper has_fade_anim" data-delay="0.30">
                        <div class="accordion accordion-flush" id="homeFaqAccordion">
                            <?php foreach ( $faq_items as $index => $faq ) :
                                $item_num   = $index + 1;
                                $item_id    = 'home-faq-collapse-' . $item_num;
                                $heading_id = 'home-faq-heading-' . $item_num;
                                $is_open    = ! empty( $faq['open'] );
                                $question   = $faq[ 'question_' . $lang ] ?? $faq['question'] ?? '';
                                $answer     = $faq[ 'answer_' . $lang ]   ?? $faq['answer']   ?? '';
                                if ( ! $question ) continue;
                            ?>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="<?php echo esc_attr( $heading_id ); ?>">
                                        <button class="accordion-button<?php echo $is_open ? '' : ' collapsed'; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo esc_attr( $item_id ); ?>" aria-expanded="<?php echo $is_open ? 'true' : 'false'; ?>" aria-controls="<?php echo esc_attr( $item_id ); ?>">
                                            <?php echo esc_html( $question ); ?>
                                        </button>
                                    </h2>
                                    <div id="<?php echo esc_attr( $item_id ); ?>" class="accordion-collapse collapse<?php echo $is_open ? ' show' : ''; ?>" aria-labelledby="<?php echo esc_attr( $heading_id ); ?>" data-bs-parent="#homeFaqAccordion">
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
