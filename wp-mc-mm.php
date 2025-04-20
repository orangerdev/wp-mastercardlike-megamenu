<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://ridwan-arifandi.com
 * @since             1.0.0
 * @package           Wp_Mc_Mm
 *
 * @wordpress-plugin
 * Plugin Name:       WP MasterCard Megamenu
 * Plugin URI:        https://ridawan-arifandi.com
 * Description:       Create a mega menu like mastercard style
 * Version:           1.0.0
 * Author:            Ridwan Arifandi
 * Author URI:        https://ridwan-arifandi.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wp-mc-mm
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'WP_MC_MM_VERSION', '1.0.0' );
define( 'WP_MC_MM_URL', plugin_dir_url( __FILE__ ) );
define( 'WP_MC_MM_PATH', plugin_dir_path( __FILE__ ) );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wp-mc-mm-activator.php
 */
function activate_wp_mc_mm() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-mc-mm-activator.php';
	Wp_Mc_Mm_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wp-mc-mm-deactivator.php
 */
function deactivate_wp_mc_mm() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-mc-mm-deactivator.php';
	Wp_Mc_Mm_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wp_mc_mm' );
register_deactivation_hook( __FILE__, 'deactivate_wp_mc_mm' );

require_once plugin_dir_path( __FILE__ ) . 'vendor/autoload.php';

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wp-mc-mm.php';


/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wp_mc_mm() {

	$plugin = new Wp_Mc_Mm();
	$plugin->run();

}
run_wp_mc_mm();
