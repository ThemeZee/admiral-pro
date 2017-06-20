<?php
/**
 * Scroll to Top
 *
 * Displays scroll to top button based on theme options
 *
 * @package Admiral Pro
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Scroll to Top Class
 */
class Admiral_Pro_Scroll_To_Top {

	/**
	 * Scroll to Top Setup
	 *
	 * @return void
	 */
	static function setup() {

		// Return early if Admiral Theme is not active.
		if ( ! current_theme_supports( 'admiral-pro' ) ) {
			return;
		}

		// Enqueue Scroll-To-Top JavaScript.
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'enqueue_script' ) );

		// Add Scroll-To-Top Checkbox in Customizer.
		add_action( 'customize_register', array( __CLASS__, 'scroll_to_top_settings' ) );
	}

	/**
	 * Enqueue Scroll-To-Top JavaScript
	 *
	 * @return void
	 */
	static function enqueue_script() {

		// Get Theme Options from Database.
		$theme_options = Admiral_Pro_Customizer::get_theme_options();

		// Call Credit Link function of theme if credit link is activated.
		if ( true === $theme_options['scroll_to_top'] ) :

			wp_enqueue_script( 'admiral-pro-scroll-to-top', ADMIRAL_PRO_PLUGIN_URL . 'assets/js/scroll-to-top.js', array( 'jquery' ), ADMIRAL_PRO_VERSION, true );

		endif;
	}

	/**
	 * Add scroll to top checkbox setting
	 *
	 * @param object $wp_customize / Customizer Object.
	 */
	static function scroll_to_top_settings( $wp_customize ) {

		// Add Scroll to Top headline.
		$wp_customize->add_control( new Admiral_Customize_Header_Control(
			$wp_customize, 'admiral_theme_options[scroll_top_title]', array(
				'label' => esc_html__( 'Scroll to Top', 'admiral-pro' ),
				'section' => 'admiral_pro_section_footer',
				'settings' => array(),
				'priority' => 10,
			)
		) );

		// Add Scroll to Top setting.
		$wp_customize->add_setting( 'admiral_theme_options[scroll_to_top]', array(
			'default'           => true,
			'type'           	=> 'option',
			'transport'         => 'refresh',
			'sanitize_callback' => 'admiral_sanitize_checkbox',
			)
		);
		$wp_customize->add_control( 'admiral_theme_options[scroll_to_top]', array(
			'label'    => __( 'Display Scroll to Top Button', 'admiral-pro' ),
			'section'  => 'admiral_pro_section_footer',
			'settings' => 'admiral_theme_options[scroll_to_top]',
			'type'     => 'checkbox',
			'priority' => 20,
			)
		);

	}
}

// Run Class.
add_action( 'init', array( 'Admiral_Pro_Scroll_To_Top', 'setup' ) );
