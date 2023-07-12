<?php
/*
 * Plugin Name:       Awesome Floating Form
 * Plugin URI:        https://stacksamurai.com/awesome-floatingform
 * Description:       Awesome Floating Form is a WordPress plugin that lets you add a floating contact button to your website. Visitors can click the button to send a contact request directly.
 * Version:           1.1
 * Requires at least: 4.6
 * Requires PHP:      7.2
 * Tested up to:      6.2.2
 * Author:            Stack Samurai
 * Author URI:        https://stacksamurai.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       awesome-floatingform-pro
 * Domain Path:       /languages
 */


// Exit if accessed directly.

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Define AWESOME_FLOATINGFORM_PLUGIN_FILE.

if ( ! defined( 'AWESOME_FLOATINGFORM_PRO_PLUGIN_FILE' ) ) {
    define( 'AWESOME_FLOATINGFORM_PRO_PLUGIN_FILE', __FILE__ );
}

define('AWESOME_FLOATINGFORM_PRO_TEXTDOMAIN', 'awesome-floatingform-pro');

// Include the main WP_FloatingForm class.

if ( ! class_exists( 'Awesome_FloatingForm_Pro' ) ) {
    require_once  'vendor/autoload.php';
    include_once dirname( __FILE__ ) . '/includes/init.php';
}