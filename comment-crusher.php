<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              owmc.co.uk
 * @since             1.0.0
 * @package           Comment_Crusher
 *
 * @wordpress-plugin
 * Plugin Name:       Comment Crusher
 * Plugin URI:        owmc.co.uk
 * Description:       Disable and remove comments on your WP site.
 * Version:           1.0.0
 * Author:            Oliver Wieland
 * Author URI:        owmc.co.uk
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       comment-crusher
 * Domain Path:       /languages
 */

/*
Comment Crusher is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
 
Comment Crusher is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with Comment Crusher. If not, see {URI to Plugin License}.
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
define( 'PLUGIN_NAME_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-comment-crusher-activator.php
 */
function activate_comment_crusher() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-comment-crusher-activator.php';
	Comment_Crusher_Activator::activate();
}


/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-comment-crusher-deactivator.php
 */
function deactivate_comment_crusher() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-comment-crusher-deactivator.php';
	Comment_Crusher_Deactivator::deactivate();
}


register_activation_hook( __FILE__, 'activate_comment_crusher' );
register_deactivation_hook( __FILE__, 'deactivate_comment_crusher' );


/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-comment-crusher.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_comment_crusher() {

	$plugin = new Comment_Crusher();
	$plugin->run();

}


run_comment_crusher();
