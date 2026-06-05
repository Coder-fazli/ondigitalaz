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

$langs    = array( 'en' => '🇬🇧 EN', 'az' => '🇦🇿 AZ' );
$about_faq = ondigital_get_repeater( 'about_faq', array() );

/**
 * Bilingual text field. Renders EN + AZ tabs for <base>_en / <base>_az.
 * The EN pane inherits the legacy no-suffix value the first time, so existing
 * English content is preserved (and migrates to <base>_en on next save).
 */
$an_text = function( string $base, string $label, array $options, string $hint = '' ): void {
    od_lang_open();
    foreach ( array( 'en', 'az' ) as $lang ) {
        od_lang_pane( $lang );
        $opts = $options;
        $k    = $base . '_' . $lang;
        if ( 'en' === $lang && empty( $opts[ $k ] ) && ! empty( $options[ $base ] ) ) {
            $opts[ $k ] = $options[ $base ];
        }
        od_text( $k, $label, $opts, $hint );
        od_lang_pane_close();
    }
    od_lang_close();
};

/**
 * Bilingual textarea field. Same behaviour as $an_text.
 */
$an_textarea = function( string $base, string $label, array $options, string $hint = '' ): void {
    od_lang_open();
    foreach ( array( 'en', 'az' ) as $lang ) {
        od_lang_pane( $lang );
        $opts = $options;
        $k    = $base . '_' . $lang;
        if ( 'en' === $lang && empty( $opts[ $k ] ) && ! empty( $options[ $base ] ) ) {
            $opts[ $k ] = $options[ $base ];
        }
        od_textarea( $k, $label, $opts, $hint );
        od_lang_pane_close();
    }
    od_lang_close();
};
?>
<div class="od-section active" data-section="about">

    <!-- ── FAQ (old template) ── -->
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
            echo '<span class="od-lang-tab" data-lang="az">🇦🇿 AZ</span>';
            echo '<span class="od-lang-tab active" data-lang="en">🇬🇧 EN</span>';
            echo '</div>';
            foreach ( array( 'az', 'en' ) as $lang ) :
                $active = $lang === 'az' ? 'active' : '';
                echo '<div class="od-lang-pane ' . esc_attr( $active ) . '" data-lang="' . esc_attr( $lang ) . '">';
                echo '<div class="od-field"><label>' . esc_html__( 'Question', 'ondigital' ) . ' (' . strtoupper( $lang ) . ')</label><input type="text" name="ondigital_about_faq[' . $i . '][question_' . $lang . ']" value="' . esc_attr( $row[ 'question_' . $lang ] ?? $row['question'] ?? '' ) . '"></div>';
                echo '<div class="od-field"><label>' . esc_html__( 'Answer', 'ondigital' ) . ' (' . strtoupper( $lang ) . ')</label><textarea name="ondigital_about_faq[' . $i . '][answer_' . $lang . ']" rows="2">' . esc_textarea( $row[ 'answer_' . $lang ] ?? $row['answer'] ?? '' ) . '</textarea></div>';
                echo '</div>';
            endforeach;
            echo '</div>';
            echo '<label style="display:flex;align-items:center;gap:6px;font-size:13px;margin-top:8px;"><input type="checkbox" name="ondigital_about_faq[' . $i . '][open]" value="1" ' . checked( ! empty( $row['open'] ), true, false ) . '> ' . esc_html__( 'Open by default', 'ondigital' ) . '</label>';
            echo '</div>';
        } ); ?>

    <?php od_card_close(); ?>

    <!-- ── SEO (old template) ── -->
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

    <?php /* ================================================================
       ABOUT US — NEW TEMPLATE  (page-about-new.php)
       All keys prefixed with  an_
    ================================================================ */ ?>

    <!-- ── HERO ── -->
    <?php od_card_open( __( 'New: 1. Hero', 'ondigital' ), 'dashicons-admin-home' ); ?>
        <p class="od-desc" style="margin-bottom:16px">Used by the <strong>About Us — New</strong> page template.</p>
        <?php
        $an_text( 'an_hero_title_line1', __( 'Title — Line 1', 'ondigital' ), $options, 'e.g. We build the' );
        $an_text( 'an_hero_title_em',    __( 'Title — Accent Word (green)', 'ondigital' ), $options, 'e.g. digital future' );
        $an_text( 'an_hero_title_line3', __( 'Title — Line 3', 'ondigital' ), $options, 'e.g. together' );
        $an_textarea( 'an_hero_desc', __( 'Description', 'ondigital' ), $options );
        od_divider();
        od_row_open();
            $an_text( 'an_hero_btn1_text', __( 'Button 1 Text', 'ondigital' ), $options, 'e.g. Our Story' );
            od_url( 'an_hero_btn1_url',   __( 'Button 1 URL', 'ondigital' ), $options );
        od_row_close();
        od_row_open();
            $an_text( 'an_hero_btn2_text', __( 'Button 2 Text', 'ondigital' ), $options, 'e.g. Get in Touch' );
            od_url( 'an_hero_btn2_url',   __( 'Button 2 URL', 'ondigital' ), $options );
        od_row_close();
        od_divider();
        $an_text( 'an_funnel_eyebrow', __( 'Funnel Card — Eyebrow', 'ondigital' ), $options, 'e.g. Client Growth Funnel' );
        $an_text( 'an_funnel_sub',     __( 'Funnel Card — Subtitle', 'ondigital' ), $options, 'e.g. How we turn traffic into paying clients' );
        od_divider();
        od_row_open();
            od_text( 'an_funnel_stat1_num', __( 'Footer Stat 1 — Number', 'ondigital' ), $options, 'e.g. 4.2×' );
            $an_text( 'an_funnel_stat1_lbl', __( 'Footer Stat 1 — Label', 'ondigital' ), $options, 'e.g. Average ROAS' );
        od_row_close();
        od_row_open();
            od_text( 'an_funnel_stat2_num', __( 'Footer Stat 2 — Number', 'ondigital' ), $options, 'e.g. 90 days' );
            $an_text( 'an_funnel_stat2_lbl', __( 'Footer Stat 2 — Label', 'ondigital' ), $options, 'e.g. To first results' );
        od_row_close();
        od_divider();
        echo '<p class="od-desc">Funnel chart stages</p>';
        for ( $n = 1; $n <= 4; $n++ ) :
        $an_text( 'an_stage' . $n . '_label', __( 'Stage ' . $n . ' — Label', 'ondigital' ), $options );
        od_row_open();
            od_text( 'an_stage' . $n . '_display',  __( 'Stage ' . $n . ' — Display Value', 'ondigital' ), $options );
            od_text( 'an_stage' . $n . '_cvr',      __( 'Stage ' . $n . ' — CVR % (leave empty = hide)', 'ondigital' ), $options );
            od_text( 'an_stage' . $n . '_value',    __( 'Stage ' . $n . ' — Raw Number (for width)', 'ondigital' ), $options );
        od_row_close();
        endfor;
        ?>
    <?php od_card_close(); ?>

    <!-- ── STORY ── -->
    <?php od_card_open( __( 'New: 2. Story', 'ondigital' ), 'dashicons-book' ); ?>
        <?php
        $an_text( 'an_story_eyebrow', __( 'Eyebrow', 'ondigital' ), $options, 'e.g. Our Story' );
        $an_text( 'an_story_heading',    __( 'Heading — Before em', 'ondigital' ), $options, 'e.g. Started in 2020 with one' );
        $an_text( 'an_story_heading_em', __( 'Heading — Accent Word', 'ondigital' ), $options, 'e.g. vision' );
        $an_textarea( 'an_story_desc1', __( 'Paragraph 1', 'ondigital' ), $options );
        $an_textarea( 'an_story_desc2', __( 'Paragraph 2', 'ondigital' ), $options );
        $an_textarea( 'an_story_quote', __( 'Pull Quote', 'ondigital' ), $options );
        $an_text( 'an_story_cite',      __( 'Quote Citation', 'ondigital' ), $options, 'e.g. — Zamin Namazov, Founder & CEO' );
        od_divider();
        for ( $n = 1; $n <= 3; $n++ ) :
            echo '<p class="od-desc"><strong>' . sprintf( __( 'Pillar %d', 'ondigital' ), $n ) . '</strong></p>';
            $an_text( 'an_pillar' . $n . '_num',   __( 'Number Label', 'ondigital' ), $options, 'e.g. 01 — Mission' );
            $an_text( 'an_pillar' . $n . '_title', __( 'Title', 'ondigital' ), $options );
            $an_textarea( 'an_pillar' . $n . '_body', __( 'Body', 'ondigital' ), $options );
        endfor;
        ?>
    <?php od_card_close(); ?>

    <!-- ── STATS ── -->
    <?php od_card_open( __( 'New: 3. Stats', 'ondigital' ), 'dashicons-chart-bar' ); ?>
        <?php
        $stat_defaults = array(
            1 => array( '4', '+',  'Years of experience' ),
            2 => array( '120', '+', 'Projects delivered' ),
            3 => array( '15', '+', 'Team members' ),
            4 => array( '98', '%', 'Client satisfaction' ),
        );
        for ( $n = 1; $n <= 4; $n++ ) :
            od_row_open();
                od_text( 'an_stat' . $n . '_num',    __( 'Stat ' . $n . ' — Number', 'ondigital' ), $options, $stat_defaults[$n][0] );
                od_text( 'an_stat' . $n . '_suffix', __( 'Stat ' . $n . ' — Suffix (+/%)', 'ondigital' ), $options, $stat_defaults[$n][1] );
            od_row_close();
            $an_text( 'an_stat' . $n . '_lbl', __( 'Stat ' . $n . ' — Label', 'ondigital' ), $options, $stat_defaults[$n][2] );
        endfor;
        ?>
    <?php od_card_close(); ?>

    <!-- ── VALUES ── -->
    <?php od_card_open( __( 'New: 4. Values', 'ondigital' ), 'dashicons-heart' ); ?>
        <?php
        $an_text( 'an_values_eyebrow',     __( 'Eyebrow', 'ondigital' ), $options, 'e.g. Our Values' );
        $an_text( 'an_values_heading',     __( 'Heading — Before em', 'ondigital' ), $options, 'e.g. The' );
        $an_text( 'an_values_heading_em',  __( 'Heading — Accent Word', 'ondigital' ), $options, 'e.g. foundation' );
        $an_text( 'an_values_heading_end', __( 'Heading — After em', 'ondigital' ), $options, 'e.g. of our work' );
        $an_textarea( 'an_values_sub', __( 'Sub Text', 'ondigital' ), $options );
        od_divider();
        $val_defaults = array(
            1 => array( '01', 'fa-chart-line',      'Data-Driven Decisions', '' ),
            2 => array( '02', 'fa-shield-halved',   'Full Transparency',     '' ),
            3 => array( '03', 'fa-rocket',          'Continuous Innovation', '1' ),
            4 => array( '04', 'fa-handshake-simple','Partnership Mindset',   '' ),
            5 => array( '05', 'fa-bullseye',        'Results First',         '' ),
            6 => array( '06', 'fa-users-gear',      'Team Power',            '' ),
        );
        for ( $n = 1; $n <= 6; $n++ ) :
            echo '<p class="od-desc"><strong>' . sprintf( __( 'Value Card %d', 'ondigital' ), $n ) . ( $n === 3 ? ' (dark accent)' : '' ) . '</strong></p>';
            od_row_open();
                od_text( 'an_val' . $n . '_num',   __( 'Number', 'ondigital' ), $options, $val_defaults[$n][0] );
                od_text( 'an_val' . $n . '_icon',  __( 'FA Icon Class', 'ondigital' ), $options, $val_defaults[$n][1] );
            od_row_close();
            $an_text( 'an_val' . $n . '_title', __( 'Title', 'ondigital' ), $options, $val_defaults[$n][2] );
            $an_textarea( 'an_val' . $n . '_desc', __( 'Description', 'ondigital' ), $options );
        endfor;
        ?>
    <?php od_card_close(); ?>

    <!-- ── APPROACH ── -->
    <?php od_card_open( __( 'New: 5. Approach', 'ondigital' ), 'dashicons-admin-settings' ); ?>
        <?php
        $an_text( 'an_approach_eyebrow', __( 'Eyebrow', 'ondigital' ), $options, 'e.g. How We Work' );
        $an_text( 'an_approach_heading',    __( 'Heading — Before em', 'ondigital' ), $options, 'e.g. Every step of the process is' );
        $an_text( 'an_approach_heading_em', __( 'Heading — Accent Word', 'ondigital' ), $options, 'e.g. clear' );
        od_divider();
        $step_defaults = array(
            1 => array( '01', 'Discovery & Audit' ),
            2 => array( '02', 'Strategy Development' ),
            3 => array( '03', 'Execution & Optimisation' ),
            4 => array( '04', 'Reporting & Growth' ),
        );
        for ( $n = 1; $n <= 4; $n++ ) :
            echo '<p class="od-desc"><strong>' . sprintf( __( 'Step %d', 'ondigital' ), $n ) . '</strong></p>';
            od_text( 'an_step' . $n . '_num', __( 'Step ' . $n . ' — Number', 'ondigital' ), $options, $step_defaults[$n][0] );
            $an_text( 'an_step' . $n . '_title', __( 'Step ' . $n . ' — Title', 'ondigital' ), $options, $step_defaults[$n][1] );
            $an_textarea( 'an_step' . $n . '_body', __( 'Step ' . $n . ' — Body', 'ondigital' ), $options );
        endfor;
        od_divider();
        echo '<p class="od-desc"><strong>' . __( 'Visual Card (right side)', 'ondigital' ) . '</strong></p>';
        od_text( 'an_av_big_num', __( 'Big Number', 'ondigital' ), $options, 'e.g. 100' );
        $an_text( 'an_av_label',    __( 'Label', 'ondigital' ), $options, 'e.g. Why OnDigital' );
        $an_text( 'an_av_big_word', __( 'Big Word', 'ondigital' ), $options, 'e.g. Bespoke' );
        $an_textarea( 'an_av_desc', __( 'Description', 'ondigital' ), $options );
        od_divider();
        echo '<p class="od-desc"><strong>' . __( 'Tags (up to 5)', 'ondigital' ) . '</strong></p>';
        for ( $n = 1; $n <= 5; $n++ ) :
            $an_text( 'an_av_tag' . $n, __( 'Tag ' . $n, 'ondigital' ), $options );
        endfor;
        ?>
    <?php od_card_close(); ?>

    <!-- ── TEAM ── -->
    <?php od_card_open( __( 'New: 6. Team Header', 'ondigital' ), 'dashicons-groups' ); ?>
        <?php
        $an_text( 'an_team_eyebrow', __( 'Eyebrow', 'ondigital' ), $options, 'e.g. The Team' );
        $an_text( 'an_team_heading',     __( 'Heading — Before em', 'ondigital' ), $options, 'e.g. The' );
        $an_text( 'an_team_heading_em',  __( 'Heading — Accent Word', 'ondigital' ), $options, 'e.g. people' );
        $an_text( 'an_team_heading_end', __( 'Heading — After em', 'ondigital' ), $options, 'e.g. behind your results' );
        $an_textarea( 'an_team_sub', __( 'Sub Text', 'ondigital' ), $options );
        ?>
        <p class="od-desc" style="margin-top:8px">Team member cards are managed via <strong>WordPress Admin → Team</strong> (CPT). All members are shown in a slider, ordered by menu order.</p>
    <?php od_card_close(); ?>

    <!-- ── TIMELINE ── -->
    <?php od_card_open( __( 'New: 7. Timeline', 'ondigital' ), 'dashicons-clock' ); ?>
        <?php
        $an_text( 'an_tl_eyebrow', __( 'Eyebrow', 'ondigital' ), $options, 'e.g. Our Journey' );
        $an_text( 'an_tl_heading',    __( 'Heading — Before em', 'ondigital' ), $options, 'e.g. Growth' );
        $an_text( 'an_tl_heading_em', __( 'Heading — Accent Word', 'ondigital' ), $options, 'e.g. milestones' );
        od_divider();
        $tl_defaults = array(
            1 => array( '2020', 'Foundation',        'fa-flag',    'left'  ),
            2 => array( '2021', 'Team Expansion',    'fa-users',   'right' ),
            3 => array( '2022', 'First Regional Win','fa-trophy',  'left'  ),
            4 => array( '2024', 'AI Integration',    'fa-rocket',  'right' ),
        );
        for ( $n = 1; $n <= 4; $n++ ) :
            echo '<p class="od-desc"><strong>' . sprintf( __( 'Milestone %d', 'ondigital' ), $n ) . '</strong></p>';
            od_row_open();
                od_text( 'an_tl' . $n . '_year',  __( 'Year', 'ondigital' ), $options, $tl_defaults[$n][0] );
                od_text( 'an_tl' . $n . '_icon',  __( 'FA Icon', 'ondigital' ), $options, $tl_defaults[$n][2] );
            od_row_close();
            $an_text( 'an_tl' . $n . '_title', __( 'Title', 'ondigital' ), $options, $tl_defaults[$n][1] );
            $an_textarea( 'an_tl' . $n . '_desc', __( 'Description', 'ondigital' ), $options );
        endfor;
        ?>
    <?php od_card_close(); ?>

    <!-- ── CTA ── -->
    <?php od_card_open( __( 'New: 8. CTA & Form', 'ondigital' ), 'dashicons-email-alt' ); ?>
        <?php
        $an_text( 'an_cta_eyebrow', __( 'Eyebrow', 'ondigital' ), $options, 'e.g. Next Step' );
        $an_text( 'an_cta_title',    __( 'Heading — Before em', 'ondigital' ), $options, "e.g. Let's grow your business" );
        $an_text( 'an_cta_title_em', __( 'Heading — Accent Word', 'ondigital' ), $options, 'e.g. together' );
        $an_textarea( 'an_cta_sub', __( 'Sub Text', 'ondigital' ), $options );
        od_divider();
        echo '<p class="od-desc"><strong>' . __( 'Perks (4 bullet points)', 'ondigital' ) . '</strong></p>';
        for ( $n = 1; $n <= 4; $n++ ) :
            $an_text( 'an_cta_perk' . $n, sprintf( __( 'Perk %d', 'ondigital' ), $n ), $options );
        endfor;
        od_divider();
        $an_text( 'an_cta_form_title', __( 'Form Card Title', 'ondigital' ), $options, 'e.g. Get in Touch' );
        ?>
    <?php od_card_close(); ?>

</div>
