<?php
/***
 * Footer Widgets
 *
 * Registers footer widget areas and hooks into the Admiral theme to display widgets
 *
 * @package Admiral Pro
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

// Use class to avoid namespace collisions.
if ( ! class_exists( 'Admiral_Pro_Header_Menu' ) ) :

class Admiral_Pro_Header_Menu {

	/**
	 * Footer Widgets Setup
	 *
	 * @return void
	*/
	static function setup() {

		// Return early if Admiral Theme is not active
		if ( ! current_theme_supports( 'admiral-pro'  ) ) {
			return;
		}

		// Display Header Bar
		add_action( 'admiral_header_menu', array( __CLASS__, 'display_header_menu' ) );

	}

	/**
	 * Displays top navigation and social menu on header bar
	 *
	 * @return string HTML output
	*/
	static function display_header_menu() {

		// Check if there is a header menu.
		if ( has_nav_menu( 'header' ) ) {

			echo '<nav id="header-navigation" class="sub-navigation navigation clearfix" role="navigation">';

			// Display Top Navigation
			wp_nav_menu( array(
				'theme_location' => 'header',
				'container' => false,
				'menu_class' => 'sub-navigation-menu',
				'echo' => true,
				'fallback_cb' => '')
			);

			echo '</nav>';

		}

	}

	/**
	 * Register navigation menus
	 *
	 * @return void
	*/
	static function register_nav_menus() {

		// Return early if Admiral Theme is not active
		if ( ! current_theme_supports( 'admiral-pro'  ) ) {
			return;
		}

		register_nav_menus( array(
			'header' => esc_html__( 'Header Navigation', 'admiral-pro' ),
		) );

	}

}

// Run Class
add_action( 'init', array( 'Admiral_Pro_Header_Menu', 'setup' ) );

// Register navigation menus in backend
add_action( 'after_setup_theme', array( 'Admiral_Pro_Header_Menu', 'register_nav_menus' ), 20 );

endif;