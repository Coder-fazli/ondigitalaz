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
