<?php
/**
 * OnDigital Panel — About Page Section
 *
 * @package OnDigital
 * @var array $options  Loaded from get_option('ondigital_options')
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$langs    = array( 'az' => '🇦🇿 AZ', 'en' => '🇬🇧 EN' );
$about_faq = ondigital_get_repeater( 'about_faq', array() );
?>
<div class="od-section active" data-section="about">

    <!-- ── FAQ ── -->
    <?php od_card_open( __( 'FAQ Section', 'ondigital' ), 'dashicons-editor-help' ); ?>

        <?php od_lang_open(); ?>
        <?php foreach ( $langs as $lang => $label ) : ?>
            <?php od_lang_pane( $lang ); ?>
                <?php od_text( 'about_faq_title_' . $lang, __( 'Section Title', 'ondigital' ), $options, __( 'e.g. Tez-tez verilən suallar', 'ondigital' ) ); ?>
                <?php od_text( 'about_faq_sidebar_text_' . $lang, __( 'Sidebar Link Text', 'ondigital' ), $options, __( 'e.g. Bizimlə əlaqə saxlayın', 'ondigital' ) ); ?>
                <?php od_url( 'about_faq_sidebar_url_' . $lang, __( 'Sidebar Link URL', 'ondigital' ), $options ); ?>
            <?php od_lang_pane_close(); ?>
        <?php endforeach; ?>
        <?php od_lang_close(); ?>
        <?php od_divider(); ?>

        <?php od_repeater( $about_faq, 'about_faq', 'ondigital_about_faq', function( $i, $row ) {
            echo '<div class="od-repeater-row">';
            echo '<div class="od-repeater-row-head"><span>' . sprintf( __( 'FAQ %d', 'ondigital' ), $i + 1 ) . '</span>';
            echo '<div class="od-row-actions"><button type="button" class="od-remove-row">&times;</button></div></div>';

            echo '<div class="od-lang-wrap"><div class="od-lang-tabs">';
            echo '<span class="od-lang-tab active" data-lang="az">🇦🇿 AZ</span>';
            echo '<span class="od-lang-tab" data-lang="en">🇬🇧 EN</span>';
            echo '</div>';

            foreach ( array( 'az', 'en' ) as $lang ) :
                $active = $lang === 'az' ? 'active' : '';
                echo '<div class="od-lang-pane ' . esc_attr( $active ) . '" data-lang="' . esc_attr( $lang ) . '">';
                echo '<div class="od-field"><label>' . esc_html__( 'Question', 'ondigital' ) . ' (' . strtoupper( $lang ) . ')</label><input type="text" name="ondigital_about_faq[' . $i . '][question_' . $lang . ']" value="' . esc_attr( $row[ 'question_' . $lang ] ?? $row['question'] ?? '' ) . '"></div>';
                echo '<div class="od-field"><label>' . esc_html__( 'Answer', 'ondigital' ) . ' (' . strtoupper( $lang ) . ')</label><textarea name="ondigital_about_faq[' . $i . '][answer_' . $lang . ']" rows="2">' . esc_textarea( $row[ 'answer_' . $lang ] ?? $row['answer'] ?? '' ) . '</textarea></div>';
                echo '</div>';
            endforeach;

            echo '</div>'; // od-lang-wrap
            echo '<label style="display:flex;align-items:center;gap:6px;font-size:13px;margin-top:8px;"><input type="checkbox" name="ondigital_about_faq[' . $i . '][open]" value="1" ' . checked( ! empty( $row['open'] ), true, false ) . '> ' . esc_html__( 'Open by default', 'ondigital' ) . '</label>';
            echo '</div>';
        } ); ?>

    <?php od_card_close(); ?>

    <!-- ── SEO ── -->
    <?php od_card_open( __( 'Page SEO', 'ondigital' ), 'dashicons-search' ); ?>

        <?php od_lang_open(); ?>
        <?php foreach ( $langs as $lang => $label ) : ?>
            <?php od_lang_pane( $lang ); ?>
                <?php od_text( 'about_meta_title_' . $lang, __( 'Meta Title', 'ondigital' ), $options ); ?>
                <?php od_textarea( 'about_meta_desc_' . $lang, __( 'Meta Description', 'ondigital' ), $options ); ?>
            <?php od_lang_pane_close(); ?>
        <?php endforeach; ?>
        <?php od_lang_close(); ?>

    <?php od_card_close(); ?>

</div>
