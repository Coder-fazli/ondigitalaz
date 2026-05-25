<?php
/**
 * Plugin Name: OnDigital Forms
 * Plugin URI:  https://ondigital.az
 * Description: Contact forms with service checkboxes, popup modal, and lead tracking for OnDigital theme.
 * Version:     1.2.0
 * Author:      OnDigital
 * Text Domain: odf
 * License:     GPL-2.0+
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'ODF_VERSION', '1.3.0' );
define( 'ODF_DIR',     plugin_dir_path( __FILE__ ) );
define( 'ODF_URI',     plugin_dir_url( __FILE__ ) );

require_once ODF_DIR . 'inc/db.php';
require_once ODF_DIR . 'inc/admin.php';
require_once ODF_DIR . 'inc/messages.php';
require_once ODF_DIR . 'inc/frontend.php';
require_once ODF_DIR . 'inc/ajax.php';

register_activation_hook( __FILE__, 'odf_activate' );
function odf_activate(): void {
    odf_create_table();
}
