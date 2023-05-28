<?php
/*
 * Plugin Name:       Awesome Floating Form
 * Plugin URI:        https://stacksamurai.com/awesome-floatingform
 * Description:       Simple floating form plugin for WordPress.
 * Version:           1.2
 * Requires at least: 4.6
 * Requires PHP:      7.2
 * Tested up to:      6.2.2
 * Author:            Stack Samurai
 * Author URI:        https://stacksamurai.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       awesome-floatingform
 * Domain Path:       /languages
 */


// Exit if accessed directly.

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Define AWESOME_FLOATINGFORM_PLUGIN_FILE.

if ( ! defined( 'AWESOME_FLOATINGFORM_PLUGIN_FILE' ) ) {
    define( 'AWESOME_FLOATINGFORM_PLUGIN_FILE', __FILE__ );
}

define('AWESOME_FLOATINGFORM_TEXTDOMAIN', 'awesome-floatingform');

// Include the main WP_FloatingForm class.

if ( ! class_exists( 'Awesome_FloatingForm' ) ) {
    include_once dirname( __FILE__ ) . '/includes/init.php';
}