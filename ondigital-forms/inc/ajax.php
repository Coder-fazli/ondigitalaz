<?php
/**
 * OnDigital Forms — AJAX Form Submission Handler
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'wp_ajax_odf_submit',        'odf_handle_submit' );
add_action( 'wp_ajax_nopriv_odf_submit', 'odf_handle_submit' );

function odf_handle_submit(): void {
    check_ajax_referer( 'odf_submit', 'odf_nonce' );

    // Honeypot — bot filled the hidden field
    if ( ! empty( $_POST['odf_hp'] ) ) {
        wp_send_json_success(); // silently pass to fool bots
        return;
    }

    $opts = get_option( 'odf_options', array() );
    $to   = ! empty( $opts['recipient_email'] ) ? $opts['recipient_email'] : get_option( 'admin_email' );

    $name    = sanitize_text_field( wp_unslash( $_POST['odf_name']      ?? '' ) );
    $email   = sanitize_email( wp_unslash( $_POST['odf_email']          ?? '' ) );
    $phone   = sanitize_text_field( wp_unslash( $_POST['odf_phone']     ?? '' ) );
    $company = sanitize_text_field( wp_unslash( $_POST['odf_company']   ?? '' ) );
    $ecomm   = sanitize_text_field( wp_unslash( $_POST['odf_ecommerce'] ?? '' ) );
    $sources = isset( $_POST['odf_source'] ) && is_array( $_POST['odf_source'] )
        ? array_map( 'sanitize_text_field', wp_unslash( $_POST['odf_source'] ) )
        : array();

    if ( ! $name && ! $email && ! $phone ) {
        wp_send_json_error( array( 'message' => 'Please fill in at least one field.' ) );
    }

    $subject = sprintf( '[%s] New Contact Form Submission', get_bloginfo( 'name' ) );

    $lines = array( 'New submission received:', '' );
    if ( $name )    $lines[] = 'Name:        ' . $name;
    if ( $email )   $lines[] = 'Email:       ' . $email;
    if ( $phone )   $lines[] = 'Phone:       ' . $phone;
    if ( $company ) $lines[] = 'Company:     ' . $company;
    if ( $ecomm )   $lines[] = 'E-commerce:  ' . $ecomm;
    if ( $sources ) $lines[] = 'Source:      ' . implode( ', ', $sources );
    $lines[] = '';
    $lines[] = '--- Sent from ' . home_url() . ' ---';

    $body    = implode( "\n", $lines );
    $headers = array( 'Content-Type: text/plain; charset=UTF-8' );

    if ( $email ) {
        $reply_to  = $name ? "$name <$email>" : $email;
        $headers[] = 'Reply-To: ' . $reply_to;
    }

    $sent = wp_mail( $to, $subject, $body, $headers );

    if ( $sent ) {
        wp_send_json_success( array( 'message' => 'ok' ) );
    } else {
        wp_send_json_error( array( 'message' => 'Could not send email. Please try again.' ) );
    }
}
