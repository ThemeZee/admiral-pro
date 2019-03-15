<?php
/*
Plugin Name: Admiral Pro
Plugin URI: http://themezee.com/addons/admiral-pro/
Description: Adds additional features like custom colors, google fonts, widget areas and footer copyright to the Admiral theme.
Author: ThemeZee
Author URI: https://themezee.com/
Version: 1.5.1
Text Domain: admiral-pro
Domain Path: /languages/
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Admiral Pro
Copyright(C) 2017, ThemeZee.com - support@themezee.com

*/

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Main Admiral_Pro Class
 *
 * @package Admiral Pro
 */
class Admiral_Pro {

	/**
	 * Call all Functions to setup the Plugin
	 *
	 * @uses Admiral_Pro::constants() Setup the constants needed
	 * @uses Admiral_Pro::includes() Include the required files
	 * @uses Admiral_Pro::setup_actions() Setup the hooks and actions
	 * @return void
	 */
	static function setup() {

		// Setup Constants.
		self::constants();

		// Setup Translation.
		add_action( 'plugins_loaded', array( __CLASS__, 'translation' ) );

		// Include Files.
		self::includes();

		// Setup Action Hooks.
		self::setup_actions();
	}

	/**
	 * Setup plugin constants
	 *
	 * @return void
	 */
	static function constants() {

		// Define Plugin Name.
		define( 'ADMIRAL_PRO_NAME', 'Admiral Pro' );

		// Define Version Number.
		define( 'ADMIRAL_PRO_VERSION', '1.5.1' );

		// Define Plugin Name.
		define( 'ADMIRAL_PRO_PRODUCT_ID', 69758 );

		// Define Update API URL.
		define( 'ADMIRAL_PRO_STORE_API_URL', 'https://themezee.com' );

		// Plugin Folder Path.
		define( 'ADMIRAL_PRO_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

		// Plugin Folder URL.
		define( 'ADMIRAL_PRO_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

		// Plugin Root File.
		define( 'ADMIRAL_PRO_PLUGIN_FILE', __FILE__ );
	}

	/**
	 * Load Translation File
	 *
	 * @return void
	 */
	static function translation() {

		load_plugin_textdomain( 'admiral-pro', false, dirname( plugin_basename( ADMIRAL_PRO_PLUGIN_FILE ) ) . '/languages/' );

	}

	/**
	 * Include required files
	 *
	 * @return void
	 */
	static function includes() {

		// Include Admin Classes.
		require_once ADMIRAL_PRO_PLUGIN_DIR . '/includes/admin/class-plugin-updater.php';
		require_once ADMIRAL_PRO_PLUGIN_DIR . '/includes/admin/class-settings.php';
		require_once ADMIRAL_PRO_PLUGIN_DIR . '/includes/admin/class-settings-page.php';
		require_once ADMIRAL_PRO_PLUGIN_DIR . '/includes/admin/class-admin-notices.php';

		// Include Customizer Classes.
		require_once ADMIRAL_PRO_PLUGIN_DIR . '/includes/customizer/class-customizer.php';

		// Include Pro Features.
		require_once ADMIRAL_PRO_PLUGIN_DIR . '/includes/modules/class-custom-colors.php';
		require_once ADMIRAL_PRO_PLUGIN_DIR . '/includes/modules/class-custom-fonts.php';
		require_once ADMIRAL_PRO_PLUGIN_DIR . '/includes/modules/class-footer-line.php';
		require_once ADMIRAL_PRO_PLUGIN_DIR . '/includes/modules/class-footer-widgets.php';
		require_once ADMIRAL_PRO_PLUGIN_DIR . '/includes/modules/class-header-menu.php';
		require_once ADMIRAL_PRO_PLUGIN_DIR . '/includes/modules/class-header-spacing.php';
		require_once ADMIRAL_PRO_PLUGIN_DIR . '/includes/modules/class-header-widgets.php';
		require_once ADMIRAL_PRO_PLUGIN_DIR . '/includes/modules/class-scroll-to-top.php';

		// Include Magazine Widgets.
		require_once ADMIRAL_PRO_PLUGIN_DIR . '/includes/widgets/widget-magazine-posts-horizontal-box.php';
		require_once ADMIRAL_PRO_PLUGIN_DIR . '/includes/widgets/widget-magazine-posts-vertical-box.php';
		require_once ADMIRAL_PRO_PLUGIN_DIR . '/includes/widgets/widget-magazine-posts-list.php';
		require_once ADMIRAL_PRO_PLUGIN_DIR . '/includes/widgets/widget-magazine-posts-single.php';
	}

	/**
	 * Setup Action Hooks
	 *
	 * @see https://codex.wordpress.org/Function_Reference/add_action WordPress Codex
	 * @return void
	 */
	static function setup_actions() {

		// Enqueue Admiral Pro Stylesheet.
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'enqueue_styles' ), 11 );

		// Register additional Magazine Widgets.
		add_action( 'widgets_init', array( __CLASS__, 'register_widgets' ) );

		// Add Settings link to Plugin actions.
		add_filter( 'plugin_action_links_' . plugin_basename( ADMIRAL_PRO_PLUGIN_FILE ), array( __CLASS__, 'plugin_action_links' ) );

		// Add automatic plugin updater from ThemeZee Store API.
		add_action( 'admin_init', array( __CLASS__, 'plugin_updater' ), 0 );
	}

	/**
	 * Enqueue Styles
	 *
	 * @return void
	 */
	static function enqueue_styles() {

		// Return early if Admiral Theme is not active.
		if ( ! current_theme_supports( 'admiral-pro' ) ) {
			return;
		}

		// Enqueue RTL or default Plugin Stylesheet.
		if ( is_rtl() ) {
			wp_enqueue_style( 'admiral-pro', ADMIRAL_PRO_PLUGIN_URL . 'assets/css/admiral-pro-rtl.css', array(), ADMIRAL_PRO_VERSION );
		} else {
			wp_enqueue_style( 'admiral-pro', ADMIRAL_PRO_PLUGIN_URL . 'assets/css/admiral-pro.css', array(), ADMIRAL_PRO_VERSION );
		}

		// Get Custom CSS.
		$custom_css = apply_filters( 'admiral_pro_custom_css_stylesheet', '' );

		// Sanitize Custom CSS.
		$custom_css = wp_kses( $custom_css, array( '\'', '\"' ) );
		$custom_css = str_replace( '&gt;', '>', $custom_css );
		$custom_css = preg_replace( '/\n/', '', $custom_css );
		$custom_css = preg_replace( '/\t/', '', $custom_css );

		// Add Custom CSS.
		wp_add_inline_style( 'admiral-pro', $custom_css );
	}

	/**
	 * Register Magazine Widgets
	 *
	 * @return void
	 */
	static function register_widgets() {

		// Return early if Admiral Theme is not active.
		if ( ! current_theme_supports( 'admiral-pro' ) ) {
			return;
		}

		register_widget( 'Admiral_Pro_Magazine_Horizontal_Box_Widget' );
		register_widget( 'Admiral_Pro_Magazine_Vertical_Box_Widget' );
		register_widget( 'Admiral_Pro_Magazine_Posts_List_Widget' );
		register_widget( 'Admiral_Pro_Magazine_Posts_Single_Widget' );
	}

	/**
	 * Add Settings link to the plugin actions
	 *
	 * @param array $actions Plugin action links.
	 * @return array $actions Plugin action links
	 */
	static function plugin_action_links( $actions ) {

		$settings_link = array( 'settings' => sprintf( '<a href="%s">%s</a>', admin_url( 'themes.php?page=admiral-pro' ), __( 'Settings', 'admiral-pro' ) ) );

		return array_merge( $settings_link, $actions );
	}

	/**
	 * Plugin Updater
	 *
	 * @return void
	 */
	static function plugin_updater() {

		if ( ! is_admin() ) :
			return;
		endif;

		$options = Admiral_Pro_Settings::instance();

		if ( '' !== $options->get( 'license_key' ) ) :

			$license_key = trim( $options->get( 'license_key' ) );

			// Setup the updater.
			$admiral_pro_updater = new Admiral_Pro_Plugin_Updater( ADMIRAL_PRO_STORE_API_URL, __FILE__, array(
				'version'   => ADMIRAL_PRO_VERSION,
				'license'   => $license_key,
				'item_name' => ADMIRAL_PRO_NAME,
				'item_id'   => ADMIRAL_PRO_PRODUCT_ID,
				'author'    => 'ThemeZee',
			) );

		endif;
	}
}

// Run Plugin.
Admiral_Pro::setup();
