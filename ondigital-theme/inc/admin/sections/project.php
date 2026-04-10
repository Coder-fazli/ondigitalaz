<?php
/**
 * OnDigital Panel — Project Page Section
 *
 * @package OnDigital
 * @var array $options  Loaded from get_option('ondigital_options')
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$langs = array( 'az' => '🇦🇿 AZ', 'en' => '🇬🇧 EN' );
?>
<div class="od-section active" data-section="project">

    <!-- ── 1. HERO ── -->
    <?php od_card_open( __( '1. Hero', 'ondigital' ), 'dashicons-admin-home' ); ?>

        <?php od_lang_open(); ?>
        <?php foreach ( $langs as $lang => $label ) : ?>
            <?php od_lang_pane( $lang ); ?>
                <?php od_text( 'project_tag_' . $lang, __( 'Badge Text', 'ondigital' ), $options, __( 'e.g. Case Study — Education · 2025', 'ondigital' ) ); ?>
                <?php od_row_open(); ?>
                    <?php od_text( 'project_title_main_' . $lang, __( 'Title Line 1', 'ondigital' ), $options, __( 'e.g. Alas Academy', 'ondigital' ) ); ?>
                    <?php od_text( 'project_title_hl_' . $lang, __( 'Highlighted Word (green)', 'ondigital' ), $options, __( 'e.g. Ondigital', 'ondigital' ) ); ?>
                <?php od_row_close(); ?>
                <?php od_row_open(); ?>
                    <?php od_text( 'project_meta_date_' . $lang, __( 'Date', 'ondigital' ), $options, __( 'e.g. Jan – May 2025', 'ondigital' ) ); ?>
                    <?php od_text( 'project_meta_client_' . $lang, __( 'Client', 'ondigital' ), $options ); ?>
                <?php od_row_close(); ?>
                <?php od_row_open(); ?>
                    <?php od_text( 'project_meta_services_' . $lang, __( 'Services', 'ondigital' ), $options, __( 'e.g. Web · SEO · Paid Ads', 'ondigital' ) ); ?>
                    <?php od_text( 'project_meta_outcome_' . $lang, __( 'Outcome', 'ondigital' ), $options, __( 'e.g. +340% Revenue · 4 months', 'ondigital' ) ); ?>
                <?php od_row_close(); ?>
                <?php od_url( 'project_live_url_' . $lang, __( 'Live Site URL', 'ondigital' ), $options ); ?>
            <?php od_lang_pane_close(); ?>
        <?php endforeach; ?>
        <?php od_lang_close(); ?>

    <?php od_card_close(); ?>

    <!-- ── 2. FULL-WIDTH IMAGE ── -->
    <?php od_card_open( __( '2. Full-Width Image', 'ondigital' ), 'dashicons-format-image' ); ?>
        <?php od_image( 'project_hero_image', __( 'Project Screenshot / Hero Image', 'ondigital' ), $options ); ?>
    <?php od_card_close(); ?>

    <!-- ── 3. RESULTS ── -->
    <?php od_card_open( __( '3. Results & Metrics', 'ondigital' ), 'dashicons-chart-line' ); ?>

        <?php od_lang_open(); ?>
        <?php foreach ( $langs as $lang => $label ) : ?>
            <?php od_lang_pane( $lang ); ?>
                <?php od_text( 'project_results_title_' . $lang, __( 'Section Title', 'ondigital' ), $options, __( 'e.g. Numbers that speak for themselves.', 'ondigital' ) ); ?>
                <?php od_textarea( 'project_results_desc_' . $lang, __( 'Description', 'ondigital' ), $options ); ?>
            <?php od_lang_pane_close(); ?>
        <?php endforeach; ?>
        <?php od_lang_close(); ?>

        <?php od_divider(); ?>

        <p style="font-size:12px;color:#888;margin-bottom:16px;"><?php esc_html_e( 'Stats — enter a number value to animate (e.g. 340). Leave suffix empty if not needed.', 'ondigital' ); ?></p>

        <?php for ( $n = 1; $n <= 4; $n++ ) : ?>
            <div style="border:1px solid #e8e8e8;border-radius:8px;padding:16px 20px;margin-bottom:14px;">
                <p style="font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:.06em;color:#aaa;margin-bottom:12px;"><?php echo esc_html( sprintf( __( 'Stat %d', 'ondigital' ), $n ) ); ?></p>
                <?php od_row_open(); ?>
                    <?php od_text( 'project_stat' . $n . '_value', __( 'Value', 'ondigital' ), $options, __( 'e.g. 340 or 3.8', 'ondigital' ) ); ?>
                    <?php od_text( 'project_stat' . $n . '_suffix', __( 'Suffix', 'ondigital' ), $options, __( 'e.g. % or ×', 'ondigital' ) ); ?>
                <?php od_row_close(); ?>
                <?php od_lang_open(); ?>
                <?php foreach ( $langs as $lang => $label ) : ?>
                    <?php od_lang_pane( $lang ); ?>
                        <?php od_text( 'project_stat' . $n . '_label_' . $lang, __( 'Label', 'ondigital' ), $options ); ?>
                    <?php od_lang_pane_close(); ?>
                <?php endforeach; ?>
                <?php od_lang_close(); ?>
            </div>
        <?php endfor; ?>

    <?php od_card_close(); ?>

    <!-- ── 4. TESTIMONIAL ── -->
    <?php od_card_open( __( '4. Testimonial', 'ondigital' ), 'dashicons-format-quote' ); ?>

        <?php od_lang_open(); ?>
        <?php foreach ( $langs as $lang => $label ) : ?>
            <?php od_lang_pane( $lang ); ?>
                <?php od_textarea( 'project_quote_' . $lang, __( 'Quote Text', 'ondigital' ), $options ); ?>
                <?php od_row_open(); ?>
                    <?php od_text( 'project_author_' . $lang, __( 'Author Name', 'ondigital' ), $options ); ?>
                    <?php od_text( 'project_author_role_' . $lang, __( 'Role / Company', 'ondigital' ), $options ); ?>
                <?php od_row_close(); ?>
            <?php od_lang_pane_close(); ?>
        <?php endforeach; ?>
        <?php od_lang_close(); ?>

        <?php od_divider(); ?>
        <?php od_text( 'project_author_initials', __( 'Avatar Initials', 'ondigital' ), $options, __( 'e.g. LA (no language needed)', 'ondigital' ) ); ?>

    <?php od_card_close(); ?>

    <!-- ── 5. PROCESS ── -->
    <?php
    $steps = ondigital_get_repeater( 'project_steps', array() );
    od_card_open( __( '5. Process / Steps', 'ondigital' ), 'dashicons-list-view' );
    ?>

        <?php od_lang_open(); ?>
        <?php foreach ( $langs as $lang => $label ) : ?>
            <?php od_lang_pane( $lang ); ?>
                <?php od_text( 'project_process_eyebrow_' . $lang, __( 'Eyebrow Label', 'ondigital' ), $options, __( 'e.g. Our Process', 'ondigital' ) ); ?>
                <?php od_text( 'project_process_heading_' . $lang, __( 'Section Heading', 'ondigital' ), $options, __( 'e.g. How we made it happen.', 'ondigital' ) ); ?>
            <?php od_lang_pane_close(); ?>
        <?php endforeach; ?>
        <?php od_lang_close(); ?>

        <?php od_divider(); ?>

        <?php
        od_repeater( $steps, 'project_step', 'ondigital_project_steps', function( $i, $row ) {
            echo '<div class="od-repeater-row">';
            echo '<div class="od-repeater-row-head">';
            echo '<span>' . esc_html( sprintf( __( 'Step %d', 'ondigital' ), $i + 1 ) ) . '</span>';
            echo '<div class="od-row-actions"><button type="button" class="od-remove-row">&times;</button></div>';
            echo '</div>';

            // Title — AZ
            echo '<div class="od-field-row">';
            echo '<div class="od-field"><label>' . esc_html__( 'Title (AZ)', 'ondigital' ) . '</label>';
            echo '<input type="text" name="ondigital_project_steps[' . $i . '][title_az]" value="' . esc_attr( $row['title_az'] ?? '' ) . '">';
            echo '</div>';
            echo '<div class="od-field"><label>' . esc_html__( 'Title (EN)', 'ondigital' ) . '</label>';
            echo '<input type="text" name="ondigital_project_steps[' . $i . '][title_en]" value="' . esc_attr( $row['title_en'] ?? '' ) . '">';
            echo '</div>';
            echo '</div>';

            // Desc — AZ
            echo '<div class="od-field"><label>' . esc_html__( 'Description (AZ)', 'ondigital' ) . '</label>';
            echo '<textarea name="ondigital_project_steps[' . $i . '][desc_az]">' . esc_textarea( $row['desc_az'] ?? '' ) . '</textarea>';
            echo '</div>';
            echo '<div class="od-field"><label>' . esc_html__( 'Description (EN)', 'ondigital' ) . '</label>';
            echo '<textarea name="ondigital_project_steps[' . $i . '][desc_en]">' . esc_textarea( $row['desc_en'] ?? '' ) . '</textarea>';
            echo '</div>';

            // Duration
            echo '<div class="od-field"><label>' . esc_html__( 'Duration Badge', 'ondigital' ) . '</label>';
            echo '<input type="text" name="ondigital_project_steps[' . $i . '][duration]" value="' . esc_attr( $row['duration'] ?? '' ) . '" placeholder="e.g. 2 weeks">';
            echo '</div>';

            echo '</div>';
        } );
        ?>

    <?php od_card_close(); ?>

    <!-- ── 6. GALLERY ── -->
    <?php od_card_open( __( '6. Gallery', 'ondigital' ), 'dashicons-images-alt2' ); ?>
        <p style="font-size:12px;color:#888;margin-bottom:16px;"><?php esc_html_e( 'Three images — left one is tall (spans 2 rows), right two stack vertically.', 'ondigital' ); ?></p>
        <?php od_row_open(); ?>
            <?php od_image( 'project_gallery_1', __( 'Image 1 (Large Left)', 'ondigital' ), $options ); ?>
            <?php od_image( 'project_gallery_2', __( 'Image 2 (Top Right)', 'ondigital' ), $options ); ?>
            <?php od_image( 'project_gallery_3', __( 'Image 3 (Bottom Right)', 'ondigital' ), $options ); ?>
        <?php od_row_close(); ?>
    <?php od_card_close(); ?>

</div>
