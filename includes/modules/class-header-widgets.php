<?php
/***
 * Footer Widgets
 *
 * Registers footer widget areas and hooks into the Admiral theme to display widgets
 *
 * @package Admiral Pro
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

// Use class to avoid namespace collisions
if ( ! class_exists( 'Admiral_Pro_Header_Widgets' ) ) :

class Admiral_Pro_Header_Widgets {

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

		// Display footer widgets
		add_action( 'admiral_header_widgets', array( __CLASS__, 'display_widgets' ) );

	}

	/**
	 * Displays Footer Widgets
	 *
	 * Hooks into the admiral_before_footer action hook in footer area.
	 */
	static function display_widgets() {

		// Check if there are footer widgets
		if ( is_active_sidebar( 'header' ) ) : ?>

			<div class="header-widgets clearfix">

				<?php dynamic_sidebar( 'header' ); ?>

			</div><!-- .header-widgets -->

		<?php endif;

	}

	/**
	 * Register all Footer Widget areas
	 *
	 * @return void
	*/
	static function register_widgets() {

		// Return early if Admiral Theme is not active
		if ( ! current_theme_supports( 'admiral-pro'  ) ) {
			return;
		}

		// Register Header widgets.
		register_sidebar( array(
			'name' => esc_html__( 'Header', 'admiral-pro' ),
			'id' => 'header',
			'description' => esc_html__( 'Appears on header area. You can use a search or ad widget here.', 'admiral-pro' ),
			'before_widget' => '<aside id="%1$s" class="header-widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h4 class="header-widget-title">',
			'after_title' => '</h4>',
		) );

	}

}

// Run Class
add_action( 'init', array( 'Admiral_Pro_Header_Widgets', 'setup' ) );

// Register widgets in backend
add_action( 'widgets_init', array( 'Admiral_Pro_Header_Widgets', 'register_widgets' ), 20 );

endif;