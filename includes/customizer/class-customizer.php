<?php
/**
 * Customizer
 *
 * Setup the Customizer and theme options for the Pro plugin
 *
 * @package Admiral Pro
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Customizer Class
 */
class Admiral_Pro_Customizer {

	/**
	 * Customizer Setup
	 *
	 * @return void
	 */
	static function setup() {

		// Return early if Admiral Theme is not active.
		if ( ! current_theme_supports( 'admiral-pro' ) ) {
			return;
		}

		// Enqueue scripts and styles in the Customizer.
		add_action( 'customize_preview_init', array( __CLASS__, 'customize_preview_js' ) );
		add_action( 'customize_controls_print_styles', array( __CLASS__, 'customize_preview_css' ) );

		// Remove Upgrade section.
		remove_action( 'customize_register', 'admiral_customize_register_upgrade_settings' );
	}

	/**
	 * Get saved user settings from database or plugin defaults
	 *
	 * @return array
	 */
	static function get_theme_options() {

		// Merge Theme Options Array from Database with Default Options array.
		$theme_options = wp_parse_args( get_option( 'admiral_theme_options', array() ), self::get_default_options() );

		// Return theme options.
		return $theme_options;
	}


	/**
	 * Returns the default settings of the plugin
	 *
	 * @return array
	 */
	static function get_default_options() {

		$default_options = array(
			'logo_spacing'            => 0,
			'header_spacing'          => 25,
			'scroll_to_top'           => false,
			'footer_text'             => '',
			'credit_link'             => true,
			'header_color'            => '#404040',
			'navi_color'              => '#404040',
			'header_line_color'       => '#ee4444',
			'content_primary_color'   => '#303030',
			'content_secondary_color' => '#ee4444',
			'footer_widgets_color'    => '#404040',
			'footer_color'            => '#404040',
			'text_font'               => 'Open Sans',
			'title_font'              => 'Montserrat',
			'navi_font'               => 'Montserrat',
			'widget_title_font'       => 'Montserrat',
		);

		return $default_options;
	}

	/**
	 * Embed JS file to make Theme Customizer preview reload changes asynchronously.
	 *
	 * @return void
	 */
	static function customize_preview_js() {

		wp_enqueue_script( 'admiral-pro-customizer-js', ADMIRAL_PRO_PLUGIN_URL . 'assets/js/customizer.js', array( 'customize-preview' ), ADMIRAL_PRO_VERSION, true );

	}

	/**
	 * Embed CSS styles for the theme options in the Customizer
	 *
	 * @return void
	 */
	static function customize_preview_css() {

		wp_enqueue_style( 'admiral-pro-customizer-css', ADMIRAL_PRO_PLUGIN_URL . 'assets/css/customizer.css', array(), ADMIRAL_PRO_VERSION );

	}
}

// Run Class.
add_action( 'init', array( 'Admiral_Pro_Customizer', 'setup' ) );
