<?php
/**
 * Plugin Name: OnDigital Forms
 * Plugin URI:  https://ondigital.az
 * Description: Popup contact form with Polylang support for the OnDigital theme.
 * Version:     1.0.0
 * Author:      OnDigital
 * Text Domain: odf
 * License:     GPL-2.0+
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'ODF_VERSION', '1.0.0' );
define( 'ODF_DIR',     plugin_dir_path( __FILE__ ) );
define( 'ODF_URI',     plugin_dir_url( __FILE__ ) );

require_once ODF_DIR . 'inc/db.php';

// Ensure table exists on every load (safe — uses CREATE TABLE IF NOT EXISTS)
add_action( 'init', 'odf_create_table' );
require_once ODF_DIR . 'inc/admin.php';
require_once ODF_DIR . 'inc/messages.php';
require_once ODF_DIR . 'inc/frontend.php';
require_once ODF_DIR . 'inc/ajax.php';

register_activation_hook( __FILE__, 'odf_activate' );
function odf_activate(): void {
    odf_create_table();
    if ( ! get_option( 'odf_options' ) ) {
        add_option( 'odf_options', odf_default_options() );
    }
}

function odf_default_options(): array {
    return array(
        'form_title_az'      => 'Sizinlə necə əlaqə saxlayım?',
        'form_title_en'      => 'How can I reach you?',
        'btn_text_az'        => 'Zəng tələb et',
        'btn_text_en'        => 'Request a Call',
        'recipient_email'    => get_option( 'admin_email', '' ),
        'success_az'         => 'Təşəkkür edirik! Tezliklə sizinlə əlaqə saxlayacağıq.',
        'success_en'         => 'Thank you! We will contact you soon.',
        'radio_question_az'  => 'E-ticarət biznesiniz var mı?',
        'radio_question_en'  => 'Do you run an e-commerce business?',
        'radio_opt1_az'      => 'Bəli',
        'radio_opt1_en'      => 'Yes',
        'radio_opt2_az'      => 'Xeyr',
        'radio_opt2_en'      => 'No',
        'radio_opt3_az'      => 'Başlayıram',
        'radio_opt3_en'      => "I'm Starting Up",
        'source_question_az' => 'Bizi haradan eşitdiniz?',
        'source_question_en' => 'How did you hear about us?',
        'src_instagram_az'   => 'Instagram',
        'src_instagram_en'   => 'Instagram',
        'src_tiktok_az'      => 'TikTok',
        'src_tiktok_en'      => 'TikTok',
        'src_facebook_az'    => 'Facebook',
        'src_facebook_en'    => 'Facebook',
        'src_linkedin_az'    => 'LinkedIn',
        'src_linkedin_en'    => 'LinkedIn',
        'src_youtube_az'     => 'YouTube',
        'src_youtube_en'     => 'YouTube',
        'src_other_az'       => 'Digər',
        'src_other_en'       => 'Other',
        'field_name'         => '1',
        'field_email'        => '1',
        'field_phone'        => '1',
        'field_company'      => '1',
        'field_radio'        => '1',
        'field_source'       => '1',
    );
}
