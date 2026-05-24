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

    $name     = sanitize_text_field( wp_unslash( $_POST['odf_name']      ?? '' ) );
    $email    = sanitize_email( wp_unslash( $_POST['odf_email']          ?? '' ) );
    $phone    = sanitize_text_field( wp_unslash( $_POST['odf_phone']     ?? '' ) );
    $company  = sanitize_text_field( wp_unslash( $_POST['odf_company']   ?? '' ) );
    $message  = sanitize_textarea_field( wp_unslash( $_POST['odf_message'] ?? '' ) );
    $ecomm    = sanitize_text_field( wp_unslash( $_POST['odf_ecommerce'] ?? '' ) );
    $sources  = isset( $_POST['odf_source'] ) && is_array( $_POST['odf_source'] )
        ? array_map( 'sanitize_text_field', wp_unslash( $_POST['odf_source'] ) )
        : array();
    $services    = isset( $_POST['odf_services'] ) && is_array( $_POST['odf_services'] )
        ? array_map( 'sanitize_text_field', wp_unslash( $_POST['odf_services'] ) )
        : array();
    $form_source = sanitize_text_field( wp_unslash( $_POST['odf_form_source'] ?? '' ) );

    if ( ! $name && ! $email && ! $phone ) {
        wp_send_json_error( array( 'message' => 'Please fill in at least one field.' ) );
    }

    // Save to database
    odf_save_submission( array(
        'name'      => $name,
        'email'     => $email,
        'phone'     => $phone,
        'company'   => $company,
        'ecommerce' => $ecomm,
        'source'    => implode( ',', $sources ),
        'services'  => implode( ', ', $services ),
    ) );

    $source_labels = array(
        'contact-page' => 'Contact Page',
        'popup'        => 'Popup Form',
        'service-page' => 'Service Page',
        'about-page'   => 'About Page',
    );
    $source_label = $form_source && isset( $source_labels[ $form_source ] )
        ? $source_labels[ $form_source ]
        : 'Website';

    $subject = sprintf( '[%s] New Lead — %s', get_bloginfo( 'name' ), $source_label );

    $lines = array( 'New submission received:', '' );
    $lines[] = 'Form:        ' . $source_label;
    if ( $name )    $lines[] = 'Name:        ' . $name;
    if ( $email )   $lines[] = 'Email:       ' . $email;
    if ( $phone )   $lines[] = 'Phone:       ' . $phone;
    if ( $company ) $lines[] = 'Company:     ' . $company;
    if ( $ecomm )   $lines[] = 'E-commerce:  ' . $ecomm;
    if ( $sources )  $lines[] = 'Source:      ' . implode( ', ', $sources );
    if ( $services ) $lines[] = 'Services:    ' . implode( ', ', $services );
    if ( $message ) { $lines[] = ''; $lines[] = 'Message:'; $lines[] = $message; }
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
