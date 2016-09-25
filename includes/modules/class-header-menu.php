<?php
/**
 * Header Menu
 *
 * Registers header menu and hooks into the Admiral theme to display it
 *
 * @package Admiral Pro
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Header Menu Class
 */
class Admiral_Pro_Header_Menu {

	/**
	 * Footer Widgets Setup
	 *
	 * @return void
	 */
	static function setup() {

		// Return early if Admiral Theme is not active.
		if ( ! current_theme_supports( 'admiral-pro' ) ) {
			return;
		}

		// Display Header Bar.
		add_action( 'admiral_header_menu', array( __CLASS__, 'display_header_menu' ) );

	}

	/**
	 * Displays top navigation and social menu on header bar
	 *
	 * @return void
	 */
	static function display_header_menu() {

		// Check if there is a header menu.
		if ( has_nav_menu( 'header' ) ) : ?>

			<div id="header-navigation-wrap" class="header-navigation-wrap clearfix">

				<nav id="header-navigation" class="header-navigation navigation container clearfix" role="navigation">

					<?php // Display Top Navigation.
					wp_nav_menu( array(
						'theme_location' => 'header',
						'container' => false,
						'menu_class' => 'header-navigation-menu',
						'echo' => true,
						'fallback_cb' => '',
						)
					); ?>

				</nav>

			</div>

		<?php endif;

	}

	/**
	 * Register navigation menus
	 *
	 * @return void
	 */
	static function register_nav_menus() {

		// Return early if Admiral Theme is not active.
		if ( ! current_theme_supports( 'admiral-pro' ) ) {
			return;
		}

		register_nav_menus( array(
			'header' => esc_html__( 'Header Navigation', 'admiral-pro' ),
		) );

	}
}

// Run Class.
add_action( 'init', array( 'Admiral_Pro_Header_Menu', 'setup' ) );

// Register navigation menus in backend.
add_action( 'after_setup_theme', array( 'Admiral_Pro_Header_Menu', 'register_nav_menus' ), 20 );
