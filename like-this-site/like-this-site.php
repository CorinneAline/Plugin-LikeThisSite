<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://www.resoclick.com
 * @since             1.0.0
 * @package           Like_This_Site
 *
 * @wordpress-plugin
 * Plugin Name:       LikeThisSite
 * Plugin URI:        http://www.resoclick.com/plugin-like-this-site
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Corinne Resoclick
 * Author URI:        http://www.resoclick.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       like-this-site
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-like-this-site-activator.php
 */
function activate_like_this_site() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-like-this-site-activator.php';
	Like_This_Site_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-like-this-site-deactivator.php
 */
function deactivate_like_this_site() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-like-this-site-deactivator.php';
	Like_This_Site_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_like_this_site' );
register_deactivation_hook( __FILE__, 'deactivate_like_this_site' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-like-this-site.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_like_this_site() {

	$plugin = new Like_This_Site();
	$plugin->run();

}
run_like_this_site();
