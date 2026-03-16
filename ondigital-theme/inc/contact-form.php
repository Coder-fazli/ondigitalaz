<?php
/**
 * Contact & Quote Form Handlers
 *
 * Processes form submissions and sends emails via wp_mail().
 * Recipient: office@ondigital.az
 *
 * @package OnDigital
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'ONDIGITAL_MAIL_TO', 'office@ondigital.az' );


// =============================================================================
// CONTACT FORM
// =============================================================================

add_action( 'init', 'ondigital_handle_contact_form' );
function ondigital_handle_contact_form() {
    if ( empty( $_POST['contact_nonce'] ) ) {
        return;
    }

    if ( ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['contact_nonce'] ) ), 'ondigital_contact' ) ) {
        wp_die( esc_html__( 'Təhlükəsizlik yoxlaması uğursuz oldu.', 'ondigital' ) );
    }

    $name    = sanitize_text_field( wp_unslash( $_POST['contact_name']    ?? '' ) );
    $email   = sanitize_email(      wp_unslash( $_POST['contact_email']   ?? '' ) );
    $phone   = sanitize_text_field( wp_unslash( $_POST['contact_phone']   ?? '' ) );
    $subject = sanitize_text_field( wp_unslash( $_POST['contact_subject'] ?? '' ) );
    $message = sanitize_textarea_field( wp_unslash( $_POST['contact_message'] ?? '' ) );

    $referer = wp_get_referer() ?: home_url();

    if ( empty( $name ) || ! is_email( $email ) || empty( $subject ) || empty( $message ) ) {
        wp_safe_redirect( add_query_arg( 'contact', 'error', $referer ) );
        exit;
    }

    $subject_line = sprintf( '[Ondigital] %s — %s', $subject, $name );

    $body  = "Ad: {$name}\n";
    $body .= "Email: {$email}\n";
    $body .= "Telefon: " . ( $phone ?: '—' ) . "\n";
    $body .= "\nMesaj:\n{$message}";

    $headers = array(
        'Content-Type: text/plain; charset=UTF-8',
        "Reply-To: {$name} <{$email}>",
    );

    $sent = wp_mail( ONDIGITAL_MAIL_TO, $subject_line, $body, $headers );

    if ( $sent ) {
        wp_safe_redirect( add_query_arg( 'contact', 'success', $referer ) );
    } else {
        wp_safe_redirect( add_query_arg( 'contact', 'failed', $referer ) );
    }
    exit;
}


// =============================================================================
// QUOTE FORM
// =============================================================================

add_action( 'init', 'ondigital_handle_quote_form' );
function ondigital_handle_quote_form() {
    if ( empty( $_POST['quote_nonce'] ) ) {
        return;
    }

    if ( ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['quote_nonce'] ) ), 'ondigital_quote' ) ) {
        wp_die( esc_html__( 'Təhlükəsizlik yoxlaması uğursuz oldu.', 'ondigital' ) );
    }

    $name    = sanitize_text_field( wp_unslash( $_POST['quote_name']    ?? '' ) );
    $email   = sanitize_email(      wp_unslash( $_POST['quote_email']   ?? '' ) );
    $phone   = sanitize_text_field( wp_unslash( $_POST['quote_phone']   ?? '' ) );
    $company = sanitize_text_field( wp_unslash( $_POST['quote_company'] ?? '' ) );
    $service = sanitize_text_field( wp_unslash( $_POST['quote_service'] ?? '' ) );
    $budget  = sanitize_text_field( wp_unslash( $_POST['quote_budget']  ?? '' ) );
    $message = sanitize_textarea_field( wp_unslash( $_POST['quote_message'] ?? '' ) );

    $referer = wp_get_referer() ?: home_url();

    if ( empty( $name ) || ! is_email( $email ) || empty( $phone ) || empty( $service ) || empty( $message ) ) {
        wp_safe_redirect( add_query_arg( 'contact', 'error', $referer ) );
        exit;
    }

    $subject_line = sprintf( '[Ondigital] Qiymət Təklifi — %s (%s)', $name, $service );

    $body  = "Ad: {$name}\n";
    $body .= "Email: {$email}\n";
    $body .= "Telefon: {$phone}\n";
    $body .= "Şirkət: " . ( $company ?: '—' ) . "\n";
    $body .= "Xidmət: {$service}\n";
    $body .= "Büdcə: " . ( $budget ?: '—' ) . " AZN\n";
    $body .= "\nLayihə haqqında:\n{$message}";

    $headers = array(
        'Content-Type: text/plain; charset=UTF-8',
        "Reply-To: {$name} <{$email}>",
    );

    $sent = wp_mail( ONDIGITAL_MAIL_TO, $subject_line, $body, $headers );

    if ( $sent ) {
        wp_safe_redirect( add_query_arg( 'contact', 'success', $referer ) );
    } else {
        wp_safe_redirect( add_query_arg( 'contact', 'failed', $referer ) );
    }
    exit;
}
