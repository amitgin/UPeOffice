<?php
/**
 * Plugin Name: SMS Anywhere
 * Description: A powerful SMS plugin for WordPress
 * Version: 1.0.00
 * Author: Amit Gautam
 * Author URI: http://www.amitg.in/
 * Text Domain: sms-anywhere
 */

 if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

/**
 * Plugin defines
 */
define( 'SMS_ANYWHERE_VERSION', '1.0.00' );
define( 'SMS_ANYWHERE_DIR_PLUGIN', plugin_dir_url( __FILE__ ) );
define( 'SMS_ANYWHERE_ADMIN_URL', get_admin_url() );
define( 'SMS_ANYWHERE_SITE', 'http://www.amitg.in' );
define( 'SMS_ANYWHERE_MOBILE_REGEX', '/^[\+|\(|\)|\d|\- ]*$/' );
define( 'SMS_ANYWHERE_CURRENT_DATE', date( 'Y-m-d H:i:s', current_time( 'timestamp' ) ) );

/**
 * Get plugin options
 */
$wpsms_option = get_option( 'sms_anywhere_settings' );

/**
 * Initial gateway
 */
include_once dirname( __FILE__ ) . '/includes/functions.php';
$sms = initial_gateway();

$WP_SMS_Plugin = new WP_SMS_Plugin;


?>
