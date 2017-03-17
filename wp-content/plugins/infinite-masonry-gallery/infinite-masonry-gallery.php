<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://codeneric.com
 * @since             1.0.0
 * @package           Infinite_Masonry_Gallery
 *
 * @wordpress-plugin
 * Plugin Name:       Infinite Masonry Gallery
 * Plugin URI:        img.codeneric.com
 * Description:       Provide your clients with links to (optionally password protected) photographs.
 * Version:           1.0.1
 * Author:            Codeneric
 * Author URI:        http://codeneric.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       infinite-masonry-gallery
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

//if ( ! function_exists( 'get_plugins' ) ) {
//	require_once ABSPATH . 'wp-admin/includes/plugin.php';
//}
//$all_plugins = get_plugins();
//var_dump($all_plugins);
require_once(dirname(__FILE__) .'/admin/shortcode.php'); //TODO(alex): refactor

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/activator.php
 */
function activate_infinite_masonry_gallery() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/activator.php';
	Infinite_Masonry_Gallery_Base_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/deactivator.php
 */
function deactivate_infinite_masonry_gallery() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/deactivator.php';
	Infinite_Masonry_Gallery_Base_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_infinite_masonry_gallery' );
register_deactivation_hook( __FILE__, 'deactivate_infinite_masonry_gallery' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/base.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_infinite_masonry_gallery() {

	global $cc_img_config;
	if(!isset($cc_img_config)) {
		require_once dirname(__FILE__) . '/config.php';
		$config = Infinite_Masonry_Gallery_Base_Config::set('production');
		$GLOBALS["cc_img_config"] = $config;
	}
	$plugin = new Infinite_Masonry_Gallery_Base();
	$plugin->run();


}
run_infinite_masonry_gallery();
