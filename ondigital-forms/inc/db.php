<?php
/**
 * OnDigital Forms — Database helpers
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function odf_create_table(): void {
    global $wpdb;
    $table   = $wpdb->prefix . 'odf_submissions';
    $charset = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE IF NOT EXISTS {$table} (
        id          bigint(20) unsigned NOT NULL AUTO_INCREMENT,
        name        varchar(255)        NOT NULL DEFAULT '',
        email       varchar(255)        NOT NULL DEFAULT '',
        phone       varchar(100)        NOT NULL DEFAULT '',
        company     varchar(255)        NOT NULL DEFAULT '',
        ecommerce   varchar(100)        NOT NULL DEFAULT '',
        source      varchar(500)        NOT NULL DEFAULT '',
        submitted_at datetime           NOT NULL,
        is_read     tinyint(1)          NOT NULL DEFAULT 0,
        PRIMARY KEY (id)
    ) {$charset};";

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta( $sql );
}

function odf_save_submission( array $data ): void {
    global $wpdb;
    $wpdb->insert(
        $wpdb->prefix . 'odf_submissions',
        array(
            'name'         => $data['name']      ?? '',
            'email'        => $data['email']     ?? '',
            'phone'        => $data['phone']     ?? '',
            'company'      => $data['company']   ?? '',
            'ecommerce'    => $data['ecommerce'] ?? '',
            'source'       => $data['source']    ?? '',
            'submitted_at' => current_time( 'mysql' ),
            'is_read'      => 0,
        ),
        array( '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%d' )
    );
}

function odf_default_options(): array {
    return array(
        'form_title_az'       => 'Əlaqə formu',
        'form_title_en'       => 'Contact Form',
        'btn_text_az'         => 'Göndər',
        'btn_text_en'         => 'Send',
        'success_az'          => 'Mesajınız göndərildi!',
        'success_en'          => 'Your message has been sent!',
        'recipient_email'     => '',
        'field_name'          => '1',
        'field_email'         => '1',
        'field_phone'         => '1',
        'field_company'       => '1',
        'field_radio'         => '1',
        'field_source'        => '1',
        'radio_question_az'   => 'E-ticarət saytınız varmı?',
        'radio_question_en'   => 'Do you have an e-commerce site?',
        'radio_opt1_az'       => 'Bəli',
        'radio_opt1_en'       => 'Yes',
        'radio_opt2_az'       => 'Xeyr',
        'radio_opt2_en'       => 'No',
        'radio_opt3_az'       => 'Başlayıram',
        'radio_opt3_en'       => 'Starting Up',
        'source_question_az'  => 'Bizi haradan tapdınız?',
        'source_question_en'  => 'How did you hear about us?',
        'src_instagram_az'    => 'Instagram',
        'src_instagram_en'    => 'Instagram',
        'src_tiktok_az'       => 'TikTok',
        'src_tiktok_en'       => 'TikTok',
        'src_facebook_az'     => 'Facebook',
        'src_facebook_en'     => 'Facebook',
        'src_linkedin_az'     => 'LinkedIn',
        'src_linkedin_en'     => 'LinkedIn',
        'src_youtube_az'      => 'YouTube',
        'src_youtube_en'      => 'YouTube',
        'src_other_az'        => 'Digər',
        'src_other_en'        => 'Other',
    );
}

function odf_default_contact_page_options(): array {
    return array(
        'form_title_az'  => 'Mesaj göndərin',
        'form_title_en'  => 'Send a Message',
        'btn_text_az'    => 'Göndər',
        'btn_text_en'    => 'Send',
        'success_az'     => 'Mesajınız göndərildi! Tezliklə sizinlə əlaqə saxlayacağıq.',
        'success_en'     => 'Your message has been sent! We will contact you shortly.',
        'ph_name_az'     => 'Əli Həsənov',
        'ph_name_en'     => 'John Smith',
        'ph_email_az'    => 'ali@example.com',
        'ph_email_en'    => 'john@example.com',
        'ph_phone_az'    => '+994 50 000 00 00',
        'ph_phone_en'    => '+44 7000 000000',
        'ph_subject_az'  => 'Veb sayt hazırlanması',
        'ph_subject_en'  => 'Website development',
        'ph_message_az'  => 'Layihəniz haqqında ətraflı məlumat verin...',
        'ph_message_en'  => 'Tell us more about your project...',
        'field_subject'  => '1',
    );
}

function odf_get_unread_count(): int {
    global $wpdb;
    return (int) $wpdb->get_var(
        "SELECT COUNT(*) FROM {$wpdb->prefix}odf_submissions WHERE is_read = 0"
    );
}
