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

$lang = function_exists( 'pll_current_language' ) ? pll_current_language() : 'az';
?>
<section class="faq-area">
    <div class="container large">
        <div class="faq-area-inner section-spacing-bottom">
            <div class="section-content">
                <div class="content-last">
                    <div class="section-title-wrapper">
                        <div class="title-wrapper">
                            <h2 class="section-title large has_fade_anim"><?php esc_html_e( 'Tez-tez verilən suallar', 'ondigital' ); ?></h2>
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
