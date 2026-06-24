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

    // Language for messages: from the form (set via Polylang at render), else Polylang, else AZ.
    $lang = 'az';
    if ( isset( $_POST['odf_lang'] ) ) {
        $lang = ( sanitize_text_field( wp_unslash( $_POST['odf_lang'] ) ) === 'en' ) ? 'en' : 'az';
    } elseif ( function_exists( 'pll_current_language' ) ) {
        $lang = ( pll_current_language() === 'en' ) ? 'en' : 'az';
    }
    $odf_msg = array(
        'one_field' => array( 'az' => 'Zəhmət olmasa ən azı bir sahəni doldurun.',                 'en' => 'Please fill in at least one field.' ),
        'phone'     => array( 'az' => 'Zəhmət olmasa düzgün Azərbaycan telefon nömrəsi daxil edin.', 'en' => 'Please enter a valid Azerbaijani phone number.' ),
        'email'     => array( 'az' => 'Zəhmət olmasa düzgün e-poçt ünvanı daxil edin.',              'en' => 'Please enter a valid email address.' ),
        'send_fail' => array( 'az' => 'Mesaj göndərilə bilmədi. Zəhmət olmasa yenidən cəhd edin.',   'en' => 'Could not send email. Please try again.' ),
    );

    if ( ! $name && ! $email && ! $phone ) {
        wp_send_json_error( array( 'message' => $odf_msg['one_field'][ $lang ] ) );
    }

    // Azerbaijan phone validation (only when a phone was entered).
    // Accepts +994 / 994 / 0 / bare forms; operator code + 7 digits.
    if ( $phone !== '' ) {
        $digits = preg_replace( '/\D/', '', $phone );   // digits only
        $digits = preg_replace( '/^00/', '', $digits ); // drop intl 00 prefix
        if ( strpos( $digits, '994' ) === 0 ) {
            $digits = substr( $digits, 3 );             // drop +994 country code
        } elseif ( isset( $digits[0] ) && $digits[0] === '0' ) {
            $digits = substr( $digits, 1 );             // drop trunk 0
        }
        // AZ mobile operator codes (10/50/51/55/60/70/77/99) + 7-digit subscriber number.
        if ( ! preg_match( '/^(10|50|51|55|60|70|77|99)\d{7}$/', $digits ) ) {
            wp_send_json_error( array( 'message' => $odf_msg['phone'][ $lang ] ) );
        }
    }

    // Validate email format when one was entered.
    if ( $email !== '' && ! is_email( $email ) ) {
        wp_send_json_error( array( 'message' => $odf_msg['email'][ $lang ] ) );
    }

    // Save to database
    odf_save_submission( array(
        'name'        => $name,
        'email'       => $email,
        'phone'       => $phone,
        'company'     => $company,
        'ecommerce'   => $ecomm,
        'source'      => implode( ',', $sources ),
        'services'    => implode( ', ', $services ),
        'form_source' => $form_source,
        'message'     => $message,
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
        wp_send_json_error( array( 'message' => $odf_msg['send_fail'][ $lang ] ) );
    }
}
