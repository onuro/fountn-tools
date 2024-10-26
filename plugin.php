<?php

/**
 * Plugin Name:       Gutenberg Blocks
 * Description:       An addon for Gutenberg plugin.
 * Requires at least: 6.1
 * Requires PHP:      7.4
 * Version:           0.1.0
 * Author:            Nabi Abdi
 * Author URI:        https://naviddev.com
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       ftn-tools
 */

namespace Naviddev\GutenbergBlocks;

if (!defined('ABSPATH')) {
	header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
	exit;
}

define('FTN_TOOLS_VERSION', '0.1.0');
define('FTN_TOOLS_URL', plugin_dir_url(__FILE__));
define('FTN_TOOLS_INC_URL', FTN_TOOLS_URL . 'assets/');

/**
 * Loads PSR-4-style plugin classes.
 */
function classloader($class) {
	static $ns_offset;
	if (strpos($class, __NAMESPACE__ . '\\') === 0) {
		if ($ns_offset === NULL) {
			$ns_offset = strlen(__NAMESPACE__) + 1;
		}
		include __DIR__ . '/inc/' . strtr(substr($class, $ns_offset), '\\', '/') . '.php';
	}
}
spl_autoload_register(__NAMESPACE__ . '\classloader');

add_action('plugins_loaded', __NAMESPACE__ . '\Plugin::loadTextDomain');
add_action('init', __NAMESPACE__ . '\Plugin::perInit', 0);
add_action('init', __NAMESPACE__ . '\Plugin::init', 20);
//add_action('admin_init', __NAMESPACE__ . '\Admin::init');
