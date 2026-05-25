<?php
/**
 * OnDigital — SMTP Configuration
 * Hooks into PHPMailer to send all WP emails via the configured SMTP server.
 *
 * @package OnDigital
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'phpmailer_init', 'ondigital_configure_smtp' );
function ondigital_configure_smtp( PHPMailer\PHPMailer\PHPMailer $phpmailer ): void {
    $options = get_option( 'ondigital_options', array() );

    $host       = ! empty( $options['smtp_host'] )       ? $options['smtp_host']       : '';
    $port       = ! empty( $options['smtp_port'] )       ? (int) $options['smtp_port'] : 587;
    $encryption = ! empty( $options['smtp_encryption'] ) ? $options['smtp_encryption'] : 'tls';
    $username   = ! empty( $options['smtp_username'] )   ? $options['smtp_username']   : '';
    $password   = ! empty( $options['smtp_password'] )   ? $options['smtp_password']   : '';
    $from_name  = ! empty( $options['smtp_from_name'] )  ? $options['smtp_from_name']  : get_bloginfo( 'name' );

    // Only configure if host and credentials are set
    if ( ! $host || ! $username || ! $password ) {
        return;
    }

    $phpmailer->isSMTP();
    $phpmailer->Host       = $host;
    $phpmailer->Port       = $port;
    $phpmailer->SMTPAuth   = true;
    $phpmailer->Username   = $username;
    $phpmailer->Password   = $password;
    $phpmailer->SMTPSecure = $encryption === 'ssl' ? PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_SMTPS : PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
    $phpmailer->From       = $username;
    $phpmailer->FromName   = $from_name;
}
