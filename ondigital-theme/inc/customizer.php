<?php
/**
 * OnDigital Theme Customizer
 *
 * @package OnDigital
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'customize_register', 'ondigital_customizer' );
function ondigital_customizer( $wp_customize ) {

    // =========================================================================
    // Logo Size (inside Site Identity section, below logo upload)
    // =========================================================================
    $wp_customize->add_setting( 'ondigital_logo_width', array(
        'default'           => 150,
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( 'ondigital_logo_width', array(
        'label'       => __( 'Logo Width (px)', 'ondigital' ),
        'section'     => 'title_tagline',
        'type'        => 'number',
        'input_attrs' => array( 'min' => 50, 'max' => 500, 'step' => 5 ),
        'priority'    => 9,
    ) );

    $wp_customize->add_setting( 'ondigital_logo_height', array(
        'default'           => 0,
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( 'ondigital_logo_height', array(
        'label'       => __( 'Logo Height (px) — 0 for auto', 'ondigital' ),
        'section'     => 'title_tagline',
        'type'        => 'number',
        'input_attrs' => array( 'min' => 0, 'max' => 300, 'step' => 5 ),
        'priority'    => 9,
    ) );

    // =========================================================================
    // Contact Info Section
    // =========================================================================
    $wp_customize->add_section( 'ondigital_contact', array(
        'title'    => __( 'Contact Information', 'ondigital' ),
        'priority' => 30,
    ) );

    $contact_fields = array(
        'phone'   => array( 'label' => __( 'Phone Number', 'ondigital' ), 'default' => '+994 (55) 431 47 50' ),
        'email'   => array( 'label' => __( 'Email Address', 'ondigital' ), 'default' => 'office@ondigital.az' ),
        'address' => array( 'label' => __( 'Address', 'ondigital' ), 'default' => 'Old Town Plaza, Baku' ),
    );

    foreach ( $contact_fields as $key => $field ) {
        $wp_customize->add_setting( 'ondigital_' . $key, array(
            'default'           => $field['default'],
            'sanitize_callback' => 'sanitize_text_field',
        ) );
        $wp_customize->add_control( 'ondigital_' . $key, array(
            'label'   => $field['label'],
            'section' => 'ondigital_contact',
            'type'    => 'text',
        ) );
    }

    // =========================================================================
    // Social Media Section
    // =========================================================================
    $wp_customize->add_section( 'ondigital_social', array(
        'title'    => __( 'Social Media Links', 'ondigital' ),
        'priority' => 35,
    ) );

    $socials = array( 'facebook', 'instagram', 'linkedin', 'tiktok', 'youtube', 'behance', 'pinterest' );
    foreach ( $socials as $social ) {
        $wp_customize->add_setting( 'ondigital_' . $social, array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ) );
        $wp_customize->add_control( 'ondigital_' . $social, array(
            'label'   => ucfirst( $social ) . ' URL',
            'section' => 'ondigital_social',
            'type'    => 'url',
        ) );
    }

    // =========================================================================
    // Home Page Content Panel
    // =========================================================================
    $wp_customize->add_panel( 'ondigital_home_panel', array(
        'title'    => __( 'Home Page Content', 'ondigital' ),
        'priority' => 40,
    ) );

    // -------------------------------------------------------------------------
    // Hero Section
    // -------------------------------------------------------------------------
    $wp_customize->add_section( 'ondigital_hero', array(
        'title' => __( 'Hero Section', 'ondigital' ),
        'panel' => 'ondigital_home_panel',
    ) );

    $hero_fields = array(
        'hero_subtitle'     => array( 'label' => __( 'Subtitle', 'ondigital' ),       'default' => 'AWARD WINNING DIGITAL AGENCY', 'type' => 'text' ),
        'hero_h1_line1'     => array( 'label' => __( 'H1 Line 1', 'ondigital' ),      'default' => 'Digital',                      'type' => 'text' ),
        'hero_h1_line2'     => array( 'label' => __( 'H1 Line 2', 'ondigital' ),      'default' => 'marketing agency',              'type' => 'text' ),
        'hero_body'         => array( 'label' => __( 'Body Text', 'ondigital' ),       'default' => 'We are delivering brands with high objectives the strategy', 'type' => 'textarea' ),
        'hero_cta_text'     => array( 'label' => __( 'CTA Button Text', 'ondigital' ), 'default' => 'Get started',                  'type' => 'text' ),
        'hero_cta_url'      => array( 'label' => __( 'CTA Button URL', 'ondigital' ),  'default' => '',                             'type' => 'url' ),
        'hero_rating'       => array( 'label' => __( 'Rating Number', 'ondigital' ),   'default' => '4.9',                          'type' => 'text' ),
        'hero_review_count' => array( 'label' => __( 'Review Count Text', 'ondigital' ), 'default' => '(32 reviews)',               'type' => 'text' ),
    );

    foreach ( $hero_fields as $key => $field ) {
        $sanitize = 'sanitize_text_field';
        if ( $field['type'] === 'url' ) {
            $sanitize = 'esc_url_raw';
        } elseif ( $field['type'] === 'textarea' ) {
            $sanitize = 'sanitize_textarea_field';
        }

        $wp_customize->add_setting( 'ondigital_' . $key, array(
            'default'           => $field['default'],
            'sanitize_callback' => $sanitize,
        ) );

        $control_args = array(
            'label'   => $field['label'],
            'section' => 'ondigital_hero',
            'type'    => $field['type'] === 'textarea' ? 'textarea' : ( $field['type'] === 'url' ? 'url' : 'text' ),
        );

        $wp_customize->add_control( 'ondigital_' . $key, $control_args );
    }

    // Hero image
    $wp_customize->add_setting( 'ondigital_hero_image', array(
        'default'           => '',
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'ondigital_hero_image', array(
        'label'     => __( 'Hero Image', 'ondigital' ),
        'section'   => 'ondigital_hero',
        'mime_type' => 'image',
    ) ) );

    // -------------------------------------------------------------------------
    // About Section
    // -------------------------------------------------------------------------
    $wp_customize->add_section( 'ondigital_about', array(
        'title' => __( 'About Section', 'ondigital' ),
        'panel' => 'ondigital_home_panel',
    ) );

    $about_fields = array(
        'about_title'       => array( 'label' => __( 'Title (HTML allowed)', 'ondigital' ), 'default' => 'Unlock marketing <span>strategy</span> for your business', 'type' => 'textarea', 'sanitize' => 'wp_kses_post' ),
        'about_body'        => array( 'label' => __( 'Body Text', 'ondigital' ),        'default' => 'We immerse ourselves in your issues and we put our knowledge and expertise at your service to provide you with an informed response.', 'type' => 'textarea', 'sanitize' => 'sanitize_textarea_field' ),
        'about_btn1_text'   => array( 'label' => __( 'Button 1 Text', 'ondigital' ),    'default' => 'Learn more',   'type' => 'text', 'sanitize' => 'sanitize_text_field' ),
        'about_btn1_url'    => array( 'label' => __( 'Button 1 URL', 'ondigital' ),     'default' => '',             'type' => 'url',  'sanitize' => 'esc_url_raw' ),
        'about_btn2_text'   => array( 'label' => __( 'Button 2 Text', 'ondigital' ),    'default' => 'How we work',  'type' => 'text', 'sanitize' => 'sanitize_text_field' ),
        'about_btn2_url'    => array( 'label' => __( 'Button 2 URL', 'ondigital' ),     'default' => '',             'type' => 'url',  'sanitize' => 'esc_url_raw' ),
        'about_exp_number'  => array( 'label' => __( 'Experience Number', 'ondigital' ), 'default' => '7',           'type' => 'text', 'sanitize' => 'sanitize_text_field' ),
        'about_exp_label'   => array( 'label' => __( 'Experience Label', 'ondigital' ),  'default' => 'Years of hall of fame & experience', 'type' => 'text', 'sanitize' => 'sanitize_text_field' ),
    );

    foreach ( $about_fields as $key => $field ) {
        $wp_customize->add_setting( 'ondigital_' . $key, array(
            'default'           => $field['default'],
            'sanitize_callback' => $field['sanitize'],
        ) );
        $wp_customize->add_control( 'ondigital_' . $key, array(
            'label'   => $field['label'],
            'section' => 'ondigital_about',
            'type'    => $field['type'] === 'textarea' ? 'textarea' : ( $field['type'] === 'url' ? 'url' : 'text' ),
        ) );
    }

    // About images (3)
    for ( $i = 1; $i <= 3; $i++ ) {
        $wp_customize->add_setting( 'ondigital_about_image_' . $i, array(
            'default'           => '',
            'sanitize_callback' => 'absint',
        ) );
        $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'ondigital_about_image_' . $i, array(
            'label'     => sprintf( __( 'About Image %d', 'ondigital' ), $i ),
            'section'   => 'ondigital_about',
            'mime_type' => 'image',
        ) ) );
    }

    // -------------------------------------------------------------------------
    // Report Section
    // -------------------------------------------------------------------------
    $wp_customize->add_section( 'ondigital_report', array(
        'title' => __( 'Report Section', 'ondigital' ),
        'panel' => 'ondigital_home_panel',
    ) );

    $wp_customize->add_setting( 'ondigital_report_title', array(
        'default'           => 'We help you to increase your <span>conversion</span> rate',
        'sanitize_callback' => 'wp_kses_post',
    ) );
    $wp_customize->add_control( 'ondigital_report_title', array(
        'label'   => __( 'Title (HTML allowed)', 'ondigital' ),
        'section' => 'ondigital_report',
        'type'    => 'textarea',
    ) );

    // Report graph images
    $wp_customize->add_setting( 'ondigital_report_graph_light', array(
        'default'           => '',
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'ondigital_report_graph_light', array(
        'label'     => __( 'Graph Image (Light)', 'ondigital' ),
        'section'   => 'ondigital_report',
        'mime_type' => 'image',
    ) ) );

    $wp_customize->add_setting( 'ondigital_report_graph_dark', array(
        'default'           => '',
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'ondigital_report_graph_dark', array(
        'label'     => __( 'Graph Image (Dark)', 'ondigital' ),
        'section'   => 'ondigital_report',
        'mime_type' => 'image',
    ) ) );

    $wp_customize->add_setting( 'ondigital_report_counter_number', array(
        'default'           => '98',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'ondigital_report_counter_number', array(
        'label'   => __( 'Counter Number', 'ondigital' ),
        'section' => 'ondigital_report',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'ondigital_report_counter_label', array(
        'default'           => 'Customer <span>satisfaction</span> and <br><span>strategical</span> success',
        'sanitize_callback' => 'wp_kses_post',
    ) );
    $wp_customize->add_control( 'ondigital_report_counter_label', array(
        'label'   => __( 'Counter Label (HTML allowed)', 'ondigital' ),
        'section' => 'ondigital_report',
        'type'    => 'textarea',
    ) );

    // -------------------------------------------------------------------------
    // Stats Section (title only — items managed via Theme Options)
    // -------------------------------------------------------------------------
    $wp_customize->add_section( 'ondigital_stats', array(
        'title' => __( 'Stats Section', 'ondigital' ),
        'panel' => 'ondigital_home_panel',
    ) );

    $wp_customize->add_setting( 'ondigital_stats_title', array(
        'default'           => 'The reasons why you should <span>work</span> with us',
        'sanitize_callback' => 'wp_kses_post',
    ) );
    $wp_customize->add_control( 'ondigital_stats_title', array(
        'label'   => __( 'Section Title (HTML allowed)', 'ondigital' ),
        'section' => 'ondigital_stats',
        'type'    => 'textarea',
    ) );

    // -------------------------------------------------------------------------
    // Testimonials Section
    // -------------------------------------------------------------------------
    $wp_customize->add_section( 'ondigital_testimonials', array(
        'title' => __( 'Testimonials Section', 'ondigital' ),
        'panel' => 'ondigital_home_panel',
    ) );

    $testimonial_fields = array(
        'testimonials_subtitle'     => array( 'label' => __( 'Subtitle', 'ondigital' ),          'default' => "Client's Feedback" ),
        'testimonials_title'        => array( 'label' => __( 'Title (HTML allowed)', 'ondigital' ), 'default' => 'What our happy client <span>say</span>', 'sanitize' => 'wp_kses_post' ),
        'testimonials_body'         => array( 'label' => __( 'Body Text', 'ondigital' ),          'default' => 'Optimize your impact this holiday season with an AI-driven, multichannel marketing strategy.' ),
        'testimonials_rating'       => array( 'label' => __( 'Rating Number', 'ondigital' ),      'default' => '4.9' ),
        'testimonials_review_count' => array( 'label' => __( 'Review Count Text', 'ondigital' ),  'default' => '30+ client reviews' ),
        'testimonials_platform'     => array( 'label' => __( 'Platform Name', 'ondigital' ),      'default' => 'Trustpilot' ),
    );

    foreach ( $testimonial_fields as $key => $field ) {
        $sanitize = isset( $field['sanitize'] ) ? $field['sanitize'] : 'sanitize_text_field';
        $wp_customize->add_setting( 'ondigital_' . $key, array(
            'default'           => $field['default'],
            'sanitize_callback' => $sanitize,
        ) );
        $wp_customize->add_control( 'ondigital_' . $key, array(
            'label'   => $field['label'],
            'section' => 'ondigital_testimonials',
            'type'    => ( $sanitize === 'wp_kses_post' ) ? 'textarea' : 'text',
        ) );
    }

    // -------------------------------------------------------------------------
    // CTA Section
    // -------------------------------------------------------------------------
    $wp_customize->add_section( 'ondigital_cta', array(
        'title' => __( 'CTA Section', 'ondigital' ),
        'panel' => 'ondigital_home_panel',
    ) );

    $wp_customize->add_setting( 'ondigital_cta_title', array(
        'default'           => 'Have an idea in your mind? Let\'s <span>make</span> something great together',
        'sanitize_callback' => 'wp_kses_post',
    ) );
    $wp_customize->add_control( 'ondigital_cta_title', array(
        'label'   => __( 'Title (HTML allowed)', 'ondigital' ),
        'section' => 'ondigital_cta',
        'type'    => 'textarea',
    ) );

    $wp_customize->add_setting( 'ondigital_cta_btn_text', array(
        'default'           => "Let's get in touch",
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'ondigital_cta_btn_text', array(
        'label'   => __( 'Button Text', 'ondigital' ),
        'section' => 'ondigital_cta',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'ondigital_cta_btn_url', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'ondigital_cta_btn_url', array(
        'label'   => __( 'Button URL', 'ondigital' ),
        'section' => 'ondigital_cta',
        'type'    => 'url',
    ) );

    // -------------------------------------------------------------------------
    // Services Section (title only)
    // -------------------------------------------------------------------------
    $wp_customize->add_section( 'ondigital_services_home', array(
        'title' => __( 'Services Section', 'ondigital' ),
        'panel' => 'ondigital_home_panel',
    ) );

    $wp_customize->add_setting( 'ondigital_services_title', array(
        'default'           => 'It\'s big challenge to grow-up your sales by providing best <span>services</span>',
        'sanitize_callback' => 'wp_kses_post',
    ) );
    $wp_customize->add_control( 'ondigital_services_title', array(
        'label'   => __( 'Section Title (HTML allowed)', 'ondigital' ),
        'section' => 'ondigital_services_home',
        'type'    => 'textarea',
    ) );

    // -------------------------------------------------------------------------
    // Projects Section (title only)
    // -------------------------------------------------------------------------
    $wp_customize->add_section( 'ondigital_projects_home', array(
        'title' => __( 'Projects Section', 'ondigital' ),
        'panel' => 'ondigital_home_panel',
    ) );

    $wp_customize->add_setting( 'ondigital_projects_title', array(
        'default'           => 'Our exclusive <span>case</span> studies',
        'sanitize_callback' => 'wp_kses_post',
    ) );
    $wp_customize->add_control( 'ondigital_projects_title', array(
        'label'   => __( 'Section Title (HTML allowed)', 'ondigital' ),
        'section' => 'ondigital_projects_home',
        'type'    => 'textarea',
    ) );

    // -------------------------------------------------------------------------
    // Blog Section (title only)
    // -------------------------------------------------------------------------
    $wp_customize->add_section( 'ondigital_blog_home', array(
        'title' => __( 'Blog Section', 'ondigital' ),
        'panel' => 'ondigital_home_panel',
    ) );

    $wp_customize->add_setting( 'ondigital_blog_title', array(
        'default'           => 'Keep up with the latest industry trends, tips with <span>journal</span>',
        'sanitize_callback' => 'wp_kses_post',
    ) );
    $wp_customize->add_control( 'ondigital_blog_title', array(
        'label'   => __( 'Section Title (HTML allowed)', 'ondigital' ),
        'section' => 'ondigital_blog_home',
        'type'    => 'textarea',
    ) );

    // -------------------------------------------------------------------------
    // Features Section (title + description)
    // -------------------------------------------------------------------------
    $wp_customize->add_section( 'ondigital_features_home', array(
        'title' => __( 'Features Section', 'ondigital' ),
        'panel' => 'ondigital_home_panel',
    ) );

    $wp_customize->add_setting( 'ondigital_features_title', array(
        'default'           => 'We build strong <span>productive</span> market that increase your sales growth',
        'sanitize_callback' => 'wp_kses_post',
    ) );
    $wp_customize->add_control( 'ondigital_features_title', array(
        'label'   => __( 'Section Title (HTML allowed)', 'ondigital' ),
        'section' => 'ondigital_features_home',
        'type'    => 'textarea',
    ) );

    $wp_customize->add_setting( 'ondigital_features_description', array(
        'default'           => "We bet on brands that shift categories and add value to people's lives; and on founders who are motivated to shape",
        'sanitize_callback' => 'sanitize_textarea_field',
    ) );
    $wp_customize->add_control( 'ondigital_features_description', array(
        'label'   => __( 'Section Description', 'ondigital' ),
        'section' => 'ondigital_features_home',
        'type'    => 'textarea',
    ) );

    // -------------------------------------------------------------------------
    // Partners Section (title only)
    // -------------------------------------------------------------------------
    $wp_customize->add_section( 'ondigital_partners_home', array(
        'title' => __( 'Partners Section', 'ondigital' ),
        'panel' => 'ondigital_home_panel',
    ) );

    $wp_customize->add_setting( 'ondigital_partners_title', array(
        'default'           => "We worked with the world's best companies",
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'ondigital_partners_title', array(
        'label'   => __( 'Section Title', 'ondigital' ),
        'section' => 'ondigital_partners_home',
        'type'    => 'text',
    ) );
}
