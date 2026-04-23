<?php
/**
 * OnDigital Panel — Home Page Section
 *
 * @package OnDigital
 * @var array $options  Loaded from get_option('ondigital_options')
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$langs = array( 'az' => '🇦🇿 AZ', 'en' => '🇬🇧 EN' );
?>
<div class="od-section active" data-section="home">

    <!-- ── 1. HERO ── -->
    <?php od_card_open( __( '1. Hero', 'ondigital' ), 'dashicons-admin-home' ); ?>
        <?php od_lang_open(); ?>

        <?php foreach ( $langs as $lang => $label ) : ?>
            <?php od_lang_pane( $lang ); ?>
                <?php od_text( 'hero_subtitle_' . $lang, __( 'Subtitle Badge', 'ondigital' ), $options, __( 'e.g. AWARD WINNING DIGITAL AGENCY', 'ondigital' ) ); ?>
                <?php od_text( 'hero_h1_line1_' . $lang, __( 'Title Line 1', 'ondigital' ), $options ); ?>
                <?php od_text( 'hero_h1_line2_' . $lang, __( 'Title Line 2', 'ondigital' ), $options ); ?>
                <?php od_textarea( 'hero_body_' . $lang, __( 'Body Text', 'ondigital' ), $options ); ?>
                <?php od_row_open(); ?>
                    <?php od_text( 'hero_cta_text_' . $lang, __( 'CTA Button Text', 'ondigital' ), $options ); ?>
                    <?php od_url( 'hero_cta_url_' . $lang, __( 'CTA Button URL', 'ondigital' ), $options ); ?>
                <?php od_row_close(); ?>
                <?php od_row_open(); ?>
                    <?php od_text( 'hero_rating_' . $lang, __( 'Rating Number', 'ondigital' ), $options ); ?>
                    <?php od_text( 'hero_review_count_' . $lang, __( 'Review Count', 'ondigital' ), $options ); ?>
                <?php od_row_close(); ?>
            <?php od_lang_pane_close(); ?>
        <?php endforeach; ?>

        <?php od_lang_close(); ?>
        <?php od_divider(); ?>
        <?php od_image( 'hero_image', __( 'Hero Image', 'ondigital' ), $options ); ?>
    <?php od_card_close(); ?>

    <!-- ── 2. PARTNERS ── -->
    <?php
    $partners = ondigital_get_repeater( 'partners', array() );
    od_card_open( __( '2. Partners', 'ondigital' ), 'dashicons-groups' );

    od_lang_open();
    foreach ( $langs as $lang => $label ) :
        od_lang_pane( $lang );
        od_text( 'partners_title_' . $lang, __( 'Section Title', 'ondigital' ), $options );
        od_lang_pane_close();
    endforeach;
    od_lang_close();
    od_divider();

    od_repeater( $partners, 'partner', 'ondigital_partners', function( $i, $row ) {
        echo '<div class="od-repeater-row">';
        echo '<div class="od-repeater-row-head"><span>' . sprintf( __( 'Partner %d', 'ondigital' ), $i + 1 ) . '</span>';
        echo '<div class="od-row-actions"><button type="button" class="od-remove-row">&times;</button></div></div>';
        $light_url = ! empty( $row['image_light'] ) ? wp_get_attachment_image_url( $row['image_light'], 'thumbnail' ) : '';
        $dark_url  = ! empty( $row['image_dark'] )  ? wp_get_attachment_image_url( $row['image_dark'],  'thumbnail' ) : '';
        echo '<div class="od-field-row">';
        // Logo light
        echo '<div class="od-field"><label>' . esc_html__( 'Logo (Light)', 'ondigital' ) . '</label>';
        echo '<div class="od-image-field"><div class="od-image-preview ' . ( $light_url ? '' : 'empty' ) . '">';
        if ( $light_url ) echo '<img src="' . esc_url( $light_url ) . '">';
        echo '</div><div class="od-image-btns">';
        echo '<input type="hidden" name="ondigital_partners[' . $i . '][image_light]" value="' . esc_attr( $row['image_light'] ?? '' ) . '" class="od-img-id">';
        echo '<button type="button" class="button od-upload-img">' . esc_html__( 'Select', 'ondigital' ) . '</button>';
        echo '<button type="button" class="button od-remove-img">' . esc_html__( 'Remove', 'ondigital' ) . '</button>';
        echo '</div></div></div>';
        // Logo dark
        echo '<div class="od-field"><label>' . esc_html__( 'Logo (Dark)', 'ondigital' ) . '</label>';
        echo '<div class="od-image-field"><div class="od-image-preview ' . ( $dark_url ? '' : 'empty' ) . '">';
        if ( $dark_url ) echo '<img src="' . esc_url( $dark_url ) . '">';
        echo '</div><div class="od-image-btns">';
        echo '<input type="hidden" name="ondigital_partners[' . $i . '][image_dark]" value="' . esc_attr( $row['image_dark'] ?? '' ) . '" class="od-img-id">';
        echo '<button type="button" class="button od-upload-img">' . esc_html__( 'Select', 'ondigital' ) . '</button>';
        echo '<button type="button" class="button od-remove-img">' . esc_html__( 'Remove', 'ondigital' ) . '</button>';
        echo '</div></div></div>';
        echo '</div>';
        echo '<div class="od-field"><label>' . esc_html__( 'Alt Text', 'ondigital' ) . '</label>';
        echo '<input type="text" name="ondigital_partners[' . $i . '][alt]" value="' . esc_attr( $row['alt'] ?? '' ) . '"></div>';
        echo '</div>';
    } );

    od_card_close();
    ?>

    <!-- ── 3. FEATURES ── -->
    <?php
    $features = ondigital_get_repeater( 'features', array() );
    od_card_open( __( '3. Features', 'ondigital' ), 'dashicons-star-filled' );
    od_lang_open();
    foreach ( $langs as $lang => $label ) :
        od_lang_pane( $lang );
        od_text( 'features_title_' . $lang, __( 'Section Title', 'ondigital' ), $options );
        od_textarea( 'features_description_' . $lang, __( 'Section Description', 'ondigital' ), $options );
        od_lang_pane_close();
    endforeach;
    od_lang_close();
    od_divider();

    od_repeater( $features, 'feature', 'ondigital_features', function( $i, $row ) {
        echo '<div class="od-repeater-row">';
        echo '<div class="od-repeater-row-head"><span>' . sprintf( __( 'Feature %d', 'ondigital' ), $i + 1 ) . '</span>';
        echo '<div class="od-row-actions"><button type="button" class="od-remove-row">&times;</button></div></div>';
        echo '<div class="od-field"><label>' . esc_html__( 'Title', 'ondigital' ) . '</label>';
        echo '<input type="text" name="ondigital_features[' . $i . '][title]" value="' . esc_attr( $row['title'] ?? '' ) . '"></div>';
        echo '<div class="od-field"><label>' . esc_html__( 'Description', 'ondigital' ) . '</label>';
        echo '<textarea name="ondigital_features[' . $i . '][description]" rows="2">' . esc_textarea( $row['description'] ?? '' ) . '</textarea></div>';
        $light_url = ! empty( $row['icon_light'] ) ? wp_get_attachment_image_url( $row['icon_light'], 'thumbnail' ) : '';
        $dark_url  = ! empty( $row['icon_dark'] )  ? wp_get_attachment_image_url( $row['icon_dark'],  'thumbnail' ) : '';
        echo '<div class="od-field-row">';
        foreach ( array( 'light' => $light_url, 'dark' => $dark_url ) as $variant => $url ) :
            $label = $variant === 'light' ? __( 'Icon (Light)', 'ondigital' ) : __( 'Icon (Dark)', 'ondigital' );
            $field = 'icon_' . $variant;
            echo '<div class="od-field"><label>' . esc_html( $label ) . '</label>';
            echo '<div class="od-image-field"><div class="od-image-preview ' . ( $url ? '' : 'empty' ) . '">';
            if ( $url ) echo '<img src="' . esc_url( $url ) . '">';
            echo '</div><div class="od-image-btns">';
            echo '<input type="hidden" name="ondigital_features[' . $i . '][' . $field . ']" value="' . esc_attr( $row[ $field ] ?? '' ) . '" class="od-img-id">';
            echo '<button type="button" class="button od-upload-img">' . esc_html__( 'Select', 'ondigital' ) . '</button>';
            echo '<button type="button" class="button od-remove-img">' . esc_html__( 'Remove', 'ondigital' ) . '</button>';
            echo '</div></div></div>';
        endforeach;
        echo '</div></div>';
    } );

    od_card_close();
    ?>

    <!-- ── 4. ABOUT ── -->
    <?php od_card_open( __( '4. About', 'ondigital' ), 'dashicons-info' ); ?>
        <?php od_lang_open(); ?>
        <?php foreach ( $langs as $lang => $label ) : ?>
            <?php od_lang_pane( $lang ); ?>
                <?php od_text( 'about_title_' . $lang, __( 'Title', 'ondigital' ), $options, __( 'You can use <span> for highlighted word', 'ondigital' ) ); ?>
                <?php od_textarea( 'about_body_' . $lang, __( 'Body Text', 'ondigital' ), $options ); ?>
                <?php od_row_open(); ?>
                    <?php od_text( 'about_btn1_text_' . $lang, __( 'Button 1 Text', 'ondigital' ), $options ); ?>
                    <?php od_url( 'about_btn1_url_' . $lang, __( 'Button 1 URL', 'ondigital' ), $options ); ?>
                <?php od_row_close(); ?>
                <?php od_row_open(); ?>
                    <?php od_text( 'about_btn2_text_' . $lang, __( 'Button 2 Text', 'ondigital' ), $options ); ?>
                    <?php od_url( 'about_btn2_url_' . $lang, __( 'Button 2 URL', 'ondigital' ), $options ); ?>
                <?php od_row_close(); ?>
                <?php od_row_open(); ?>
                    <?php od_text( 'about_exp_number_' . $lang, __( 'Experience Number', 'ondigital' ), $options ); ?>
                    <?php od_text( 'about_exp_label_' . $lang, __( 'Experience Label', 'ondigital' ), $options ); ?>
                <?php od_row_close(); ?>
            <?php od_lang_pane_close(); ?>
        <?php endforeach; ?>
        <?php od_lang_close(); ?>
        <?php od_divider(); ?>
        <div class="od-field-row">
            <?php od_image( 'about_img1', __( 'Image 1', 'ondigital' ), $options ); ?>
            <?php od_image( 'about_img2', __( 'Image 2', 'ondigital' ), $options ); ?>
            <?php od_image( 'about_img3', __( 'Image 3', 'ondigital' ), $options ); ?>
        </div>
    <?php od_card_close(); ?>

    <!-- ── 5. SERVICES ── -->
    <?php od_card_open( __( '5. Services', 'ondigital' ), 'dashicons-hammer' ); ?>
        <?php od_lang_open(); ?>
        <?php foreach ( $langs as $lang => $label ) : ?>
            <?php od_lang_pane( $lang ); ?>
                <?php od_text( 'services_title_' . $lang, __( 'Section Title', 'ondigital' ), $options ); ?>
                <?php od_text( 'services_subtitle_' . $lang, __( 'Subtitle Badge', 'ondigital' ), $options ); ?>
                <?php od_textarea( 'services_body_' . $lang, __( 'Description Text', 'ondigital' ), $options ); ?>
            <?php od_lang_pane_close(); ?>
        <?php endforeach; ?>
        <?php od_lang_close(); ?>
        <?php od_divider(); ?>

        <p style="font-weight:600;margin-bottom:12px;"><?php esc_html_e( 'Section Background Color', 'ondigital' ); ?></p>
        <?php od_color( 'services_bg', __( 'Background', 'ondigital' ), $options, '#f3ffe0' ); ?>

        <?php od_divider(); ?>
        <p style="font-weight:600;margin-bottom:12px;"><?php esc_html_e( 'Card Colors (cycles through 1→5)', 'ondigital' ); ?></p>
        <?php od_row_open(); ?>
            <?php od_color( 'services_card_1', __( 'Card 1', 'ondigital' ), $options, '#fefce8' ); ?>
            <?php od_color( 'services_card_2', __( 'Card 2', 'ondigital' ), $options, '#f0f5ff' ); ?>
            <?php od_color( 'services_card_3', __( 'Card 3', 'ondigital' ), $options, '#fff4f0' ); ?>
            <?php od_color( 'services_card_4', __( 'Card 4', 'ondigital' ), $options, '#f5f0ff' ); ?>
            <?php od_color( 'services_card_5', __( 'Card 5', 'ondigital' ), $options, '#f0fff8' ); ?>
        <?php od_row_close(); ?>

        <p style="color:#646970;font-size:12px;margin-top:12px;"><?php esc_html_e( 'Service items are managed from WordPress Admin → Services (CPT).', 'ondigital' ); ?></p>
    <?php od_card_close(); ?>

    <!-- ── 6. REPORT ── -->
    <?php od_card_open( __( '6. Report', 'ondigital' ), 'dashicons-chart-bar' ); ?>
        <?php od_lang_open(); ?>
        <?php foreach ( $langs as $lang => $label ) : ?>
            <?php od_lang_pane( $lang ); ?>
                <?php od_text( 'report_title_' . $lang, __( 'Section Title', 'ondigital' ), $options ); ?>
                <?php od_text( 'report_counter_num_' . $lang, __( 'Counter Number', 'ondigital' ), $options ); ?>
                <?php od_text( 'report_counter_label_' . $lang, __( 'Counter Label', 'ondigital' ), $options ); ?>
            <?php od_lang_pane_close(); ?>
        <?php endforeach; ?>
        <?php od_lang_close(); ?>
        <?php od_divider(); ?>
        <div class="od-field-row">
            <?php od_image( 'report_graph_light', __( 'Graph Image (Light)', 'ondigital' ), $options ); ?>
            <?php od_image( 'report_graph_dark', __( 'Graph Image (Dark)', 'ondigital' ), $options ); ?>
        </div>
    <?php od_card_close(); ?>

    <!-- ── 7. PROJECTS ── -->
    <?php od_card_open( __( '7. Projects', 'ondigital' ), 'dashicons-portfolio' ); ?>
        <?php od_lang_open(); ?>
        <?php foreach ( $langs as $lang => $label ) : ?>
            <?php od_lang_pane( $lang ); ?>
                <?php od_text( 'projects_title_' . $lang, __( 'Section Title', 'ondigital' ), $options ); ?>
                <?php od_textarea( 'projects_desc_' . $lang, __( 'Description', 'ondigital' ), $options ); ?>
            <?php od_lang_pane_close(); ?>
        <?php endforeach; ?>
        <?php od_lang_close(); ?>
        <p style="color:#646970;font-size:12px;margin-top:12px;"><?php esc_html_e( 'Project items are managed from WordPress Admin → Projects (CPT).', 'ondigital' ); ?></p>
    <?php od_card_close(); ?>

    <!-- ── 8. FAQ ── -->
    <?php
    $faq = ondigital_get_repeater( 'faq', array() );
    od_card_open( __( '8. FAQ', 'ondigital' ), 'dashicons-editor-help' );
    od_lang_open();
    foreach ( $langs as $lang => $label ) :
        od_lang_pane( $lang );
        od_text( 'faq_title_' . $lang, __( 'Section Title', 'ondigital' ), $options, __( 'e.g. Tez-tez verilən suallar', 'ondigital' ) );
        od_text( 'faq_sidebar_text_' . $lang, __( 'Sidebar Link Text', 'ondigital' ), $options, __( 'e.g. Dizayn, inkişaf və strategiya...', 'ondigital' ) );
        od_url( 'faq_sidebar_url_' . $lang, __( 'Sidebar Link URL', 'ondigital' ), $options );
        od_lang_pane_close();
    endforeach;
    od_lang_close();
    od_divider();
    od_repeater( $faq, 'faq', 'ondigital_faq', function( $i, $row ) {
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
            echo '<div class="od-field"><label>' . esc_html__( 'Question', 'ondigital' ) . ' (' . strtoupper( $lang ) . ')</label><input type="text" name="ondigital_faq[' . $i . '][question_' . $lang . ']" value="' . esc_attr( $row[ 'question_' . $lang ] ?? $row['question'] ?? '' ) . '"></div>';
            echo '<div class="od-field"><label>' . esc_html__( 'Answer', 'ondigital' ) . ' (' . strtoupper( $lang ) . ')</label><textarea name="ondigital_faq[' . $i . '][answer_' . $lang . ']" rows="2">' . esc_textarea( $row[ 'answer_' . $lang ] ?? $row['answer'] ?? '' ) . '</textarea></div>';
            echo '</div>';
        endforeach;

        echo '</div>'; // od-lang-wrap
        echo '<label style="display:flex;align-items:center;gap:6px;font-size:13px;margin-top:8px;"><input type="checkbox" name="ondigital_faq[' . $i . '][open]" value="1" ' . checked( ! empty( $row['open'] ), true, false ) . '> ' . esc_html__( 'Open by default', 'ondigital' ) . '</label>';
        echo '</div>';
    } );
    od_card_close();
    ?>

    <!-- ── 10. STATS ── -->
    <?php
    $stats = ondigital_get_repeater( 'stats', array() );
    od_card_open( __( '10. Stats', 'ondigital' ), 'dashicons-chart-pie' );
    od_lang_open();
    foreach ( $langs as $lang => $label ) :
        od_lang_pane( $lang );
        od_text( 'stats_title_' . $lang, __( 'Section Title', 'ondigital' ), $options );
        od_lang_pane_close();
    endforeach;
    od_lang_close();
    od_divider();
    od_repeater( $stats, 'stats', 'ondigital_stats', function( $i, $row ) {
        echo '<div class="od-repeater-row">';
        echo '<div class="od-repeater-row-head"><span>' . sprintf( __( 'Counter %d', 'ondigital' ), $i + 1 ) . '</span>';
        echo '<div class="od-row-actions"><button type="button" class="od-remove-row">&times;</button></div></div>';
        echo '<div class="od-field-row">';
        echo '<div class="od-field"><label>' . esc_html__( 'Number', 'ondigital' ) . '</label><input type="text" name="ondigital_stats[' . $i . '][number]" value="' . esc_attr( $row['number'] ?? '' ) . '"></div>';
        echo '<div class="od-field"><label>' . esc_html__( 'Suffix (e.g. +)', 'ondigital' ) . '</label><input type="text" name="ondigital_stats[' . $i . '][suffix]" value="' . esc_attr( $row['suffix'] ?? '' ) . '" style="max-width:80px;"></div>';
        echo '<div class="od-field"><label>' . esc_html__( 'Label', 'ondigital' ) . '</label><input type="text" name="ondigital_stats[' . $i . '][label]" value="' . esc_attr( $row['label'] ?? '' ) . '"></div>';
        echo '</div></div>';
    } );
    od_card_close();
    ?>

    <!-- ── 11. TESTIMONIALS ── -->
    <?php
    $testimonials = ondigital_get_repeater( 'testimonials', array() );
    od_card_open( __( '11. Testimonials', 'ondigital' ), 'dashicons-testimonial' );
    od_lang_open();
    foreach ( $langs as $lang => $label ) :
        od_lang_pane( $lang );
        od_text( 'testi_subtitle_' . $lang, __( 'Subtitle', 'ondigital' ), $options );
        od_text( 'testi_title_' . $lang, __( 'Title', 'ondigital' ), $options );
        od_textarea( 'testi_body_' . $lang, __( 'Body Text', 'ondigital' ), $options );
        od_row_open();
        od_text( 'testi_platform_' . $lang, __( 'Platform Name (e.g. Trustpilot)', 'ondigital' ), $options );
        od_row_open();
        od_text( 'testi_rating_' . $lang, __( 'Rating Number', 'ondigital' ), $options );
        od_text( 'testi_review_count_' . $lang, __( 'Review Count', 'ondigital' ), $options );
        od_row_close();
        od_lang_pane_close();
    endforeach;
    od_lang_close();
    od_divider();
    od_row_open();
    od_image( 'testi_avatar_1', __( 'Avatar 1', 'ondigital' ), $options );
    od_image( 'testi_avatar_2', __( 'Avatar 2', 'ondigital' ), $options );
    od_image( 'testi_avatar_3', __( 'Avatar 3', 'ondigital' ), $options );
    od_image( 'testi_avatar_4', __( 'Avatar 4', 'ondigital' ), $options );
    od_image( 'testi_avatar_5', __( 'Avatar 5', 'ondigital' ), $options );
    od_row_close();
    od_divider();
    od_repeater( $testimonials, 'testimonial', 'ondigital_testimonials', function( $i, $row ) {
        echo '<div class="od-repeater-row">';
        echo '<div class="od-repeater-row-head"><span>' . ( ! empty( $row['name'] ) ? esc_html( $row['name'] ) : sprintf( __( 'Testimonial %d', 'ondigital' ), $i + 1 ) ) . '</span>';
        echo '<div class="od-row-actions"><button type="button" class="od-remove-row">&times;</button></div></div>';
        echo '<div class="od-field"><label>' . esc_html__( 'Quote', 'ondigital' ) . '</label><textarea name="ondigital_testimonials[' . $i . '][quote]" rows="3">' . esc_textarea( $row['quote'] ?? '' ) . '</textarea></div>';
        echo '<div class="od-field-row">';
        echo '<div class="od-field"><label>' . esc_html__( 'Name', 'ondigital' ) . '</label><input type="text" name="ondigital_testimonials[' . $i . '][name]" value="' . esc_attr( $row['name'] ?? '' ) . '"></div>';
        echo '<div class="od-field"><label>' . esc_html__( 'Role', 'ondigital' ) . '</label><input type="text" name="ondigital_testimonials[' . $i . '][role]" value="' . esc_attr( $row['role'] ?? '' ) . '"></div>';
        echo '</div></div>';
    } );
    od_card_close();
    ?>

    <!-- ── 12. TEAM ── -->
    <?php od_card_open( __( '12. Team', 'ondigital' ), 'dashicons-groups' ); ?>
        <?php od_lang_open(); ?>
        <?php foreach ( $langs as $lang => $label ) : ?>
            <?php od_lang_pane( $lang ); ?>
                <?php od_text( 'team_title_' . $lang, __( 'Section Title', 'ondigital' ), $options ); ?>
                <?php od_textarea( 'team_desc_' . $lang, __( 'Description', 'ondigital' ), $options ); ?>
            <?php od_lang_pane_close(); ?>
        <?php endforeach; ?>
        <?php od_lang_close(); ?>
        <p style="color:#646970;font-size:12px;margin-top:12px;"><?php esc_html_e( 'Team members are managed from WordPress Admin → Team (CPT).', 'ondigital' ); ?></p>
    <?php od_card_close(); ?>

    <!-- ── 13. BLOG ── -->
    <?php od_card_open( __( '13. Blog', 'ondigital' ), 'dashicons-admin-post' ); ?>
        <?php od_lang_open(); ?>
        <?php foreach ( $langs as $lang => $label ) : ?>
            <?php od_lang_pane( $lang ); ?>
                <?php od_text( 'blog_title_' . $lang, __( 'Section Title', 'ondigital' ), $options ); ?>
            <?php od_lang_pane_close(); ?>
        <?php endforeach; ?>
        <?php od_lang_close(); ?>
        <p style="color:#646970;font-size:12px;margin-top:12px;"><?php esc_html_e( 'Blog posts are managed from WordPress Admin → Posts.', 'ondigital' ); ?></p>
    <?php od_card_close(); ?>

    <!-- ── 14. TEXT SLIDER ── -->
    <?php
    $text_slider = ondigital_get_repeater( 'text_slider', array() );
    od_card_open( __( '14. Text Slider', 'ondigital' ), 'dashicons-slides' );
    od_repeater( $text_slider, 'text_slider', 'ondigital_text_slider', function( $i, $row ) {
        echo '<div class="od-repeater-row">';
        echo '<div class="od-repeater-row-head"><span>' . sprintf( __( 'Slide %d', 'ondigital' ), $i + 1 ) . '</span>';
        echo '<div class="od-row-actions"><button type="button" class="od-remove-row">&times;</button></div></div>';
        echo '<div class="od-field-row">';
        echo '<div class="od-field"><label>' . esc_html__( 'Text', 'ondigital' ) . '</label><input type="text" name="ondigital_text_slider[' . $i . '][text]" value="' . esc_attr( $row['text'] ?? '' ) . '"></div>';
        echo '<div class="od-field"><label>' . esc_html__( 'Highlighted Word', 'ondigital' ) . '</label><input type="text" name="ondigital_text_slider[' . $i . '][highlighted]" value="' . esc_attr( $row['highlighted'] ?? '' ) . '"></div>';
        echo '</div></div>';
    } );
    od_card_close();
    ?>

    <!-- ── CTA ── -->
    <?php od_card_open( __( 'CTA (Shared)', 'ondigital' ), 'dashicons-megaphone' ); ?>
        <?php od_lang_open(); ?>
        <?php foreach ( $langs as $lang => $label ) : ?>
            <?php od_lang_pane( $lang ); ?>
                <?php od_text( 'cta_title_' . $lang, __( 'Title', 'ondigital' ), $options ); ?>
                <?php od_text( 'cta_btn_text_' . $lang, __( 'Button Text', 'ondigital' ), $options ); ?>
                <?php od_url( 'cta_btn_url_' . $lang, __( 'Button URL', 'ondigital' ), $options ); ?>
            <?php od_lang_pane_close(); ?>
        <?php endforeach; ?>
        <?php od_lang_close(); ?>
    <?php od_card_close(); ?>

</div>
