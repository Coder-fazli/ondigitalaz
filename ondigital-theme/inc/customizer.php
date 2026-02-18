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
    // Highlight Image (title word brush stroke background)
    // =========================================================================
    $wp_customize->add_setting( 'ondigital_highlight_image', array(
        'default'           => '',
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'ondigital_highlight_image', array(
        'label'     => __( 'Title Highlight Image', 'ondigital' ),
        'description' => __( 'The brush stroke / marker image shown behind highlighted words in section titles.', 'ondigital' ),
        'section'   => 'title_tagline',
        'mime_type' => 'image',
        'priority'  => 10,
    ) ) );

    // =========================================================================
    // Footer Section
    // =========================================================================
    $wp_customize->add_section( 'ondigital_footer', array(
        'title'    => __( 'Footer', 'ondigital' ),
        'priority' => 28,
    ) );

    $footer_fields = array(
        'footer_info_text'        => array( 'label' => __( 'Info Text (below logo)', 'ondigital' ),       'default' => 'OnDigital rəqəmsal marketinq agentliyidir',                                                                                           'sanitize' => 'sanitize_text_field',    'type' => 'text' ),
        'footer_services_title'   => array( 'label' => __( 'Services Column Title', 'ondigital' ),        'default' => 'Xidmətlər',                                                                                                                            'sanitize' => 'sanitize_text_field',    'type' => 'text' ),
        'footer_company_title'    => array( 'label' => __( 'Company Column Title', 'ondigital' ),         'default' => 'Şirkət',                                                                                                                               'sanitize' => 'sanitize_text_field',    'type' => 'text' ),
        'footer_newsletter_title' => array( 'label' => __( 'Newsletter Column Title', 'ondigital' ),      'default' => 'Xəbər bülleteni',                                                                                                                      'sanitize' => 'sanitize_text_field',    'type' => 'text' ),
        'footer_newsletter_text'  => array( 'label' => __( 'Newsletter Body Text', 'ondigital' ),         'default' => 'Bizimlə əməkdaşlıq etmək və ya sadəcə söhbət etmək istəyirsinizsə, sizindən xəbər almaqdan məmnun olarıq.',                           'sanitize' => 'sanitize_textarea_field','type' => 'textarea' ),
        'footer_copyright'        => array( 'label' => __( 'Copyright Text (HTML allowed)', 'ondigital' ),'default' => '© ' . date( 'Y' ) . ' OnDigital Agency. Bütün hüquqlar qorunur.',                                                                     'sanitize' => 'wp_kses_post',           'type' => 'text' ),
    );

    foreach ( $footer_fields as $key => $field ) {
        $wp_customize->add_setting( 'ondigital_' . $key, array(
            'default'           => $field['default'],
            'sanitize_callback' => $field['sanitize'],
        ) );
        $wp_customize->add_control( 'ondigital_' . $key, array(
            'label'   => $field['label'],
            'section' => 'ondigital_footer',
            'type'    => $field['type'],
        ) );
    }

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

    // =========================================================================
    // Services Page Content Panel
    // =========================================================================
    $wp_customize->add_panel( 'ondigital_services_panel', array(
        'title'    => __( 'Services Page Content', 'ondigital' ),
        'priority' => 41,
    ) );

    // Hero Section
    $wp_customize->add_section( 'ondigital_services_hero', array(
        'title' => __( 'Hero Section', 'ondigital' ),
        'panel' => 'ondigital_services_panel',
    ) );

    foreach ( array(
        'services_hero_title' => array( 'label' => __( 'Title (HTML ok)', 'ondigital' ),  'default' => 'Rəqəmsal dünyada fərq yaradan dizayn və xidmətlər.', 'type' => 'textarea', 'sanitize' => 'wp_kses_post' ),
        'services_hero_body'  => array( 'label' => __( 'Body Text', 'ondigital' ),         'default' => 'Müasir və unikal dizayn yanaşması ilə istifadəçi dostu rəqəmsal həllər yaradırıq.', 'type' => 'textarea', 'sanitize' => 'sanitize_textarea_field' ),
    ) as $key => $field ) {
        $wp_customize->add_setting( 'ondigital_' . $key, array( 'default' => $field['default'], 'sanitize_callback' => $field['sanitize'] ) );
        $wp_customize->add_control( 'ondigital_' . $key, array( 'label' => $field['label'], 'section' => 'ondigital_services_hero', 'type' => $field['type'] ) );
    }

    foreach ( array(
        'services_hero_thumb'      => __( 'Hero Image', 'ondigital' ),
        'services_hero_icon_light' => __( 'Decorative Icon (light)', 'ondigital' ),
        'services_hero_icon_dark'  => __( 'Decorative Icon (dark)', 'ondigital' ),
    ) as $key => $label ) {
        $wp_customize->add_setting( 'ondigital_' . $key, array( 'default' => '', 'sanitize_callback' => 'absint' ) );
        $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'ondigital_' . $key, array(
            'label'     => $label,
            'section'   => 'ondigital_services_hero',
            'mime_type' => 'image',
        ) ) );
    }

    // Services Grid Section
    $wp_customize->add_section( 'ondigital_services_grid', array(
        'title' => __( 'Services Grid Section', 'ondigital' ),
        'panel' => 'ondigital_services_panel',
    ) );

    foreach ( array(
        'services_grid_title' => array( 'label' => __( 'Section Title (HTML ok)', 'ondigital' ), 'default' => 'Eksklüziv <br> xidmətlərimiz', 'type' => 'textarea', 'sanitize' => 'wp_kses_post' ),
        'services_grid_body'  => array( 'label' => __( 'Body Text', 'ondigital' ),               'default' => 'Kateqoriyanı dəyişdirən və insanların həyatına dəyər qatan brendlərə investisiya edirik', 'type' => 'textarea', 'sanitize' => 'sanitize_textarea_field' ),
    ) as $key => $field ) {
        $wp_customize->add_setting( 'ondigital_' . $key, array( 'default' => $field['default'], 'sanitize_callback' => $field['sanitize'] ) );
        $wp_customize->add_control( 'ondigital_' . $key, array( 'label' => $field['label'], 'section' => 'ondigital_services_grid', 'type' => $field['type'] ) );
    }

    // Services About Section
    $wp_customize->add_section( 'ondigital_services_about', array(
        'title' => __( 'About Section', 'ondigital' ),
        'panel' => 'ondigital_services_panel',
    ) );

    foreach ( array(
        'services_about_title'    => array( 'label' => __( 'Title (HTML ok)', 'ondigital' ),  'default' => 'Sadə amma peşəkar <br> agentlik', 'type' => 'textarea', 'sanitize' => 'wp_kses_post' ),
        'services_about_body'     => array( 'label' => __( 'Body Text', 'ondigital' ),         'default' => 'Müştərilərimizin saytlarını vizual cəhətdən cəlbedici, funksional və istifadəçi dostu hala gətiririk.', 'type' => 'textarea', 'sanitize' => 'sanitize_textarea_field' ),
        'services_about_btn_text' => array( 'label' => __( 'Button Text', 'ondigital' ),       'default' => 'Ətraflı', 'type' => 'text', 'sanitize' => 'sanitize_text_field' ),
        'services_about_btn_url'  => array( 'label' => __( 'Button URL', 'ondigital' ),        'default' => '', 'type' => 'url', 'sanitize' => 'esc_url_raw' ),
    ) as $key => $field ) {
        $wp_customize->add_setting( 'ondigital_' . $key, array( 'default' => $field['default'], 'sanitize_callback' => $field['sanitize'] ) );
        $wp_customize->add_control( 'ondigital_' . $key, array( 'label' => $field['label'], 'section' => 'ondigital_services_about', 'type' => $field['type'] ) );
    }

    foreach ( array( 'services_about_thumb' => 'Thumb Image', 'services_about_bg' => 'Background Image' ) as $key => $label ) {
        $wp_customize->add_setting( 'ondigital_' . $key, array( 'default' => '', 'sanitize_callback' => 'absint' ) );
        $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'ondigital_' . $key, array(
            'label'     => __( $label, 'ondigital' ),
            'section'   => 'ondigital_services_about',
            'mime_type' => 'image',
        ) ) );
    }

    // Services Contact CTA Section
    $wp_customize->add_section( 'ondigital_services_cta', array(
        'title' => __( 'Contact CTA Section', 'ondigital' ),
        'panel' => 'ondigital_services_panel',
    ) );

    foreach ( array(
        'services_cta_title'    => array( 'label' => __( 'Title', 'ondigital' ),       'default' => 'Arolax ilə təcrübənizə başlayın', 'type' => 'textarea', 'sanitize' => 'wp_kses_post' ),
        'services_cta_btn_text' => array( 'label' => __( 'Button Text', 'ondigital' ), 'default' => 'Əlaqə saxlayaq', 'type' => 'text', 'sanitize' => 'sanitize_text_field' ),
        'services_cta_btn_url'  => array( 'label' => __( 'Button URL', 'ondigital' ),  'default' => '', 'type' => 'url', 'sanitize' => 'esc_url_raw' ),
    ) as $key => $field ) {
        $wp_customize->add_setting( 'ondigital_' . $key, array( 'default' => $field['default'], 'sanitize_callback' => $field['sanitize'] ) );
        $wp_customize->add_control( 'ondigital_' . $key, array( 'label' => $field['label'], 'section' => 'ondigital_services_cta', 'type' => $field['type'] ) );
    }

    // =========================================================================
    // About Page Content Panel
    // =========================================================================
    $wp_customize->add_panel( 'ondigital_about_panel', array(
        'title'    => __( 'About Page Content', 'ondigital' ),
        'priority' => 41,
    ) );

    // -------------------------------------------------------------------------
    // Hero Section
    // -------------------------------------------------------------------------
    $wp_customize->add_section( 'ondigital_about_hero', array(
        'title' => __( 'Hero Section', 'ondigital' ),
        'panel' => 'ondigital_about_panel',
    ) );

    foreach ( array(
        'about_hero_title'    => array( 'label' => __( 'Title', 'ondigital' ),    'default' => 'Biz "OnDigital" - rəqəmsal marketinq və kreativ agentlik, Bakıda fəaliyyət göstəririk', 'type' => 'textarea', 'sanitize' => 'wp_kses_post' ),
        'about_hero_subtitle' => array( 'label' => __( 'Subtitle Label', 'ondigital' ), 'default' => '01. Haqqımızda', 'type' => 'text', 'sanitize' => 'sanitize_text_field' ),
        'about_hero_body'     => array( 'label' => __( 'Body Text', 'ondigital' ),  'default' => '2017-ci ildən bəri müştərilərimizin rəqəmsal dünyada uğur qazanmasına kömək edirik. Kreativ yanaşma, strateji düşüncə və müasir texnologiyalarla biznesinizi irəli aparırıq.', 'type' => 'textarea', 'sanitize' => 'sanitize_textarea_field' ),
    ) as $key => $field ) {
        $wp_customize->add_setting( 'ondigital_' . $key, array( 'default' => $field['default'], 'sanitize_callback' => $field['sanitize'] ) );
        $wp_customize->add_control( 'ondigital_' . $key, array( 'label' => $field['label'], 'section' => 'ondigital_about_hero', 'type' => $field['type'] ) );
    }

    // -------------------------------------------------------------------------
    // Counter Section
    // -------------------------------------------------------------------------
    $wp_customize->add_section( 'ondigital_about_counter', array(
        'title' => __( 'Counter Section', 'ondigital' ),
        'panel' => 'ondigital_about_panel',
    ) );

    foreach ( array( 'about_counter_img1', 'about_counter_img2', 'about_counter_img3' ) as $i => $key ) {
        $wp_customize->add_setting( 'ondigital_' . $key, array( 'default' => '', 'sanitize_callback' => 'absint' ) );
        $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'ondigital_' . $key, array(
            'label'     => sprintf( __( 'Image %d', 'ondigital' ), $i + 1 ),
            'section'   => 'ondigital_about_counter',
            'mime_type' => 'image',
        ) ) );
    }

    foreach ( array(
        'about_counter1_number' => array( 'label' => __( 'Counter 1 — Number', 'ondigital' ), 'default' => '100+' ),
        'about_counter1_text'   => array( 'label' => __( 'Counter 1 — Text (HTML ok)', 'ondigital' ), 'default' => '100+ <br> məmnun müştəri' ),
        'about_counter2_number' => array( 'label' => __( 'Counter 2 — Number', 'ondigital' ), 'default' => '7+' ),
        'about_counter2_text'   => array( 'label' => __( 'Counter 2 — Text (HTML ok)', 'ondigital' ), 'default' => '7+ il<br>təcrübə ilə<br>xidmətinizdəyik' ),
    ) as $key => $field ) {
        $wp_customize->add_setting( 'ondigital_' . $key, array( 'default' => $field['default'], 'sanitize_callback' => 'wp_kses_post' ) );
        $wp_customize->add_control( 'ondigital_' . $key, array( 'label' => $field['label'], 'section' => 'ondigital_about_counter', 'type' => 'text' ) );
    }

    // -------------------------------------------------------------------------
    // Awards / Who We Are Section
    // -------------------------------------------------------------------------
    $wp_customize->add_section( 'ondigital_about_awards', array(
        'title' => __( 'Awards / Who We Are', 'ondigital' ),
        'panel' => 'ondigital_about_panel',
    ) );

    foreach ( array(
        'about_awards_subtitle' => array( 'label' => __( 'Subtitle Label', 'ondigital' ), 'default' => '02. Biz kimik', 'type' => 'text', 'sanitize' => 'sanitize_text_field' ),
        'about_awards_title'    => array( 'label' => __( 'Title', 'ondigital' ), 'default' => 'OnDigital ilə biznesinizin strateji inkişafını təmin edirik!', 'type' => 'text', 'sanitize' => 'sanitize_text_field' ),
        'about_awards_body'     => array( 'label' => __( 'Body Text', 'ondigital' ), 'default' => 'Dünya səviyyəsində kreativ dizayn, peşəkar komanda və müasir texnologiyalarla müştərilərimizin rəqəmsal dünyada uğur qazanmasına kömək edirik.', 'type' => 'textarea', 'sanitize' => 'sanitize_textarea_field' ),
        'about_award1_number'   => array( 'label' => __( 'Stat 1 — Number', 'ondigital' ), 'default' => '50+', 'type' => 'text', 'sanitize' => 'sanitize_text_field' ),
        'about_award1_text'     => array( 'label' => __( 'Stat 1 — Label', 'ondigital' ), 'default' => 'uğurlu layihə 99% müştəri məmnuniyyəti', 'type' => 'text', 'sanitize' => 'sanitize_text_field' ),
        'about_award2_number'   => array( 'label' => __( 'Stat 2 — Number', 'ondigital' ), 'default' => '12+', 'type' => 'text', 'sanitize' => 'sanitize_text_field' ),
        'about_award2_text'     => array( 'label' => __( 'Stat 2 — Label', 'ondigital' ), 'default' => 'rəqəmsal innovasiya mükafatı', 'type' => 'text', 'sanitize' => 'sanitize_text_field' ),
    ) as $key => $field ) {
        $wp_customize->add_setting( 'ondigital_' . $key, array( 'default' => $field['default'], 'sanitize_callback' => $field['sanitize'] ) );
        $wp_customize->add_control( 'ondigital_' . $key, array( 'label' => $field['label'], 'section' => 'ondigital_about_awards', 'type' => $field['type'] ) );
    }

    foreach ( array(
        'about_award1_icon'      => __( 'Stat 1 Icon (light)', 'ondigital' ),
        'about_award1_icon_dark' => __( 'Stat 1 Icon (dark)', 'ondigital' ),
        'about_award2_icon'      => __( 'Stat 2 Icon (light)', 'ondigital' ),
        'about_award2_icon_dark' => __( 'Stat 2 Icon (dark)', 'ondigital' ),
        'about_awards_thumb1'    => __( 'Thumbnail Image 1', 'ondigital' ),
        'about_awards_thumb2'    => __( 'Thumbnail Image 2', 'ondigital' ),
    ) as $key => $label ) {
        $wp_customize->add_setting( 'ondigital_' . $key, array( 'default' => '', 'sanitize_callback' => 'absint' ) );
        $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'ondigital_' . $key, array(
            'label'     => $label,
            'section'   => 'ondigital_about_awards',
            'mime_type' => 'image',
        ) ) );
    }

    // -------------------------------------------------------------------------
    // About Content Section
    // -------------------------------------------------------------------------
    $wp_customize->add_section( 'ondigital_about_content', array(
        'title' => __( 'About Content Section', 'ondigital' ),
        'panel' => 'ondigital_about_panel',
    ) );

    foreach ( array(
        'about_content_thumb'    => __( 'Main Image', 'ondigital' ),
        'about_content_bg'       => __( 'Background Image', 'ondigital' ),
    ) as $key => $label ) {
        $wp_customize->add_setting( 'ondigital_' . $key, array( 'default' => '', 'sanitize_callback' => 'absint' ) );
        $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'ondigital_' . $key, array(
            'label'     => $label,
            'section'   => 'ondigital_about_content',
            'mime_type' => 'image',
        ) ) );
    }

    foreach ( array(
        'about_content_title'    => array( 'label' => __( 'Title', 'ondigital' ), 'default' => 'Sadə amma peşəkar səviyyədə agentlik', 'type' => 'text', 'sanitize' => 'sanitize_text_field' ),
        'about_content_body'     => array( 'label' => __( 'Body Text (HTML ok)', 'ondigital' ), 'default' => 'Veb saytınızın hər bir <span>statik elementi</span> üzərində tam nəzarətə sahib olun', 'type' => 'textarea', 'sanitize' => 'wp_kses_post' ),
        'about_content_btn_text' => array( 'label' => __( 'Button Text', 'ondigital' ), 'default' => 'Ətraflı', 'type' => 'text', 'sanitize' => 'sanitize_text_field' ),
        'about_content_btn_url'  => array( 'label' => __( 'Button URL', 'ondigital' ), 'default' => '', 'type' => 'url', 'sanitize' => 'esc_url_raw' ),
    ) as $key => $field ) {
        $wp_customize->add_setting( 'ondigital_' . $key, array( 'default' => $field['default'], 'sanitize_callback' => $field['sanitize'] ) );
        $wp_customize->add_control( 'ondigital_' . $key, array( 'label' => $field['label'], 'section' => 'ondigital_about_content', 'type' => $field['type'] ) );
    }

    // -------------------------------------------------------------------------
    // FAQ Section
    // -------------------------------------------------------------------------
    $wp_customize->add_section( 'ondigital_about_faq', array(
        'title' => __( 'FAQ Section', 'ondigital' ),
        'panel' => 'ondigital_about_panel',
    ) );

    $wp_customize->add_setting( 'ondigital_about_faq_thumb', array( 'default' => '', 'sanitize_callback' => 'absint' ) );
    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'ondigital_about_faq_thumb', array(
        'label'     => __( 'Thumbnail Image', 'ondigital' ),
        'section'   => 'ondigital_about_faq',
        'mime_type' => 'image',
    ) ) );

    foreach ( array(
        'about_faq_video_url' => array( 'label' => __( 'Video URL', 'ondigital' ), 'default' => 'https://www.youtube.com/watch?v=AzwC6umvd1s', 'type' => 'url', 'sanitize' => 'esc_url_raw' ),
        'about_faq_title'     => array( 'label' => __( 'Title', 'ondigital' ), 'default' => 'UI/UX dizayn və kreativ istiqamətdə fəaliyyət göstəririk.', 'type' => 'textarea', 'sanitize' => 'sanitize_textarea_field' ),
    ) as $key => $field ) {
        $wp_customize->add_setting( 'ondigital_' . $key, array( 'default' => $field['default'], 'sanitize_callback' => $field['sanitize'] ) );
        $wp_customize->add_control( 'ondigital_' . $key, array( 'label' => $field['label'], 'section' => 'ondigital_about_faq', 'type' => $field['type'] ) );
    }

    // -------------------------------------------------------------------------
    // Team Section
    // -------------------------------------------------------------------------
    $wp_customize->add_section( 'ondigital_about_team', array(
        'title' => __( 'Team Section', 'ondigital' ),
        'panel' => 'ondigital_about_panel',
    ) );

    foreach ( array(
        'about_team_title' => array( 'label' => __( 'Title', 'ondigital' ), 'default' => 'Peşəkar komanda', 'type' => 'text', 'sanitize' => 'sanitize_text_field' ),
        'about_team_body'  => array( 'label' => __( 'Body Text', 'ondigital' ), 'default' => 'Dünya səviyyəsində kreativ dizayn komandası ilə müştərilərimizin rəqəmsal dünyada uğur qazanmasına kömək edirik.', 'type' => 'textarea', 'sanitize' => 'sanitize_textarea_field' ),
    ) as $key => $field ) {
        $wp_customize->add_setting( 'ondigital_' . $key, array( 'default' => $field['default'], 'sanitize_callback' => $field['sanitize'] ) );
        $wp_customize->add_control( 'ondigital_' . $key, array( 'label' => $field['label'], 'section' => 'ondigital_about_team', 'type' => $field['type'] ) );
    }

    // -------------------------------------------------------------------------
    // Clients Section
    // -------------------------------------------------------------------------
    $wp_customize->add_section( 'ondigital_about_clients', array(
        'title' => __( 'Clients Section', 'ondigital' ),
        'panel' => 'ondigital_about_panel',
    ) );

    $wp_customize->add_setting( 'ondigital_about_clients_title', array( 'default' => 'Ən böyük qlobal brendlərlə əməkdaşlıq etdik', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'ondigital_about_clients_title', array(
        'label'   => __( 'Section Title', 'ondigital' ),
        'section' => 'ondigital_about_clients',
        'type'    => 'text',
    ) );
}

// Output inline CSS to override the highlight image if a custom one is set
add_action( 'wp_head', 'ondigital_highlight_image_css' );
function ondigital_highlight_image_css() {
    $attachment_id = get_theme_mod( 'ondigital_highlight_image' );
    if ( ! $attachment_id ) {
        return;
    }
    $url = wp_get_attachment_image_url( $attachment_id, 'full' );
    if ( ! $url ) {
        return;
    }
    echo '<style>.section-title span{background-image:url(' . esc_url( $url ) . ')}</style>' . "\n";
}
