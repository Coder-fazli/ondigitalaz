<?php
/**
 * Plugin Name: OnDigital Forms
 * Plugin URI:  https://ondigital.az
 * Description: Custom contact forms for OnDigital — popup modal and inline contact page form.
 * Version:     1.2.0
 * Author:      OnDigital
 * Text Domain: odf
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'ODF_VERSION', '1.2.0' );
define( 'ODF_DIR',     plugin_dir_path( __FILE__ ) );
define( 'ODF_URI',     plugin_dir_url( __FILE__ ) );

require_once ODF_DIR . 'inc/db.php';
require_once ODF_DIR . 'inc/ajax.php';
require_once ODF_DIR . 'inc/frontend.php';
require_once ODF_DIR . 'inc/admin.php';
require_once ODF_DIR . 'inc/messages.php';

register_activation_hook( __FILE__, 'odf_create_table' );
