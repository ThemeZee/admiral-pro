<?php
/**
 * Custom Colors
 *
 * Adds color settings to Customizer and generates color CSS code
 *
 * @package Admiral Pro
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Custom Colors Class
 */
class Admiral_Pro_Custom_Colors {

	/**
	 * Custom Colors Setup
	 *
	 * @return void
	 */
	static function setup() {

		// Return early if Admiral Theme is not active.
		if ( ! current_theme_supports( 'admiral-pro' ) ) {
			return;
		}

		// Add Custom Color CSS code to custom stylesheet output.
		add_filter( 'admiral_pro_custom_css_stylesheet', array( __CLASS__, 'custom_colors_css' ) );

		// Add Custom Color Settings.
		add_action( 'customize_register', array( __CLASS__, 'color_settings' ) );

	}

	/**
	 * Adds Color CSS styles in the head area to override default colors
	 *
	 * @param String $custom_css Custom Styling CSS.
	 * @return string CSS code
	 */
	static function custom_colors_css( $custom_css ) {

		// Get Theme Options from Database.
		$theme_options = Admiral_Pro_Customizer::get_theme_options();

		// Get Default Fonts from settings.
		$default_options = Admiral_Pro_Customizer::get_default_options();

		// Set Header Color.
		if ( $theme_options['header_color'] !== $default_options['header_color'] ) {

			$custom_css .= '
				/* Header Color Setting */
				.site-header {
					background: ' . $theme_options['header_color'] . ';
				}
				';

		}

		// Set Navigation Color.
		if ( $theme_options['navi_color'] !== $default_options['navi_color'] ) {

			$custom_css .= '
				/* Navigation Color Setting */
				.main-navigation-wrap,
				.main-navigation-menu ul {
					background: ' . $theme_options['navi_color'] . ';
				}
				';

		}

		// Set Header Line Color.
		if ( $theme_options['header_line_color'] !== $default_options['header_line_color'] ) {

			$custom_css .= '
				/* Header Line Color Setting */
				.site-header {
					border-bottom: 10px solid ' . $theme_options['header_line_color'] . ';
				}
				.main-navigation-menu ul {
					border-top: 10px solid ' . $theme_options['header_line_color'] . ';
				}
				';

		}

		// Set Primary Content Color.
		if ( $theme_options['content_primary_color'] !== $default_options['content_primary_color'] ) {

			$custom_css .= '
				/* Content Primary Color Setting */
				.entry-title,
				.entry-title a:link,
				.entry-title a:visited,
				.blog-header,
				.archive-header,
				.page-header,
				.sidebar-header,
				.sidebar-navigation-menu a:link,
				.sidebar-navigation-menu a:visited,
				.widget-title,
				.widget-title a:link,
				.widget-title a:visited {
					color: ' . $theme_options['content_primary_color'] . ';
				}

				.entry-title a:hover,
				.entry-title a:active,
				.widget-title a:hover,
				.widget-title a:active {
					color: #ee4444;
				}

				button:hover,
				input[type="button"]:hover,
				input[type="reset"]:hover,
				input[type="submit"]:hover,
				button:focus,
				input[type="button"]:focus,
				input[type="reset"]:focus,
				input[type="submit"]:focus,
				button:active,
				input[type="button"]:active,
				input[type="reset"]:active,
				input[type="submit"]:active,
				.widget_tag_cloud .tagcloud a,
				.entry-tags .meta-tags a,
				.pagination a,
				.pagination .current,
				.infinite-scroll #infinite-handle span,
				.tzwb-tabbed-content .tzwb-tabnavi li a:link,
				.tzwb-tabbed-content .tzwb-tabnavi li a:visited,
				.tzwb-social-icons .social-icons-menu li a:hover {
					background: ' . $theme_options['content_primary_color'] . ';
				}

				.tzwb-tabbed-content .tzwb-tabnavi li a:hover,
				.tzwb-tabbed-content .tzwb-tabnavi li a:active,
				.tzwb-tabbed-content .tzwb-tabnavi li a.current-tab {
					background: #ee4444;
				}
				';

		}

		// Set Secondary Content Color.
		if ( $theme_options['content_secondary_color'] != $default_options['content_secondary_color'] ) {

			$custom_css .= '
				/* Content Secondary Color Setting */
				a:link,
				a:visited,
				.entry-title a:hover,
				.entry-title a:active,
				.widget-title a:hover,
				.widget-title a:active {
					color: ' . $theme_options['content_secondary_color'] . ';
				}

				a:hover,
				a:focus,
				a:active {
					color: #303030;
				}

				button,
				input[type="button"],
				input[type="reset"],
				input[type="submit"],
				.widget_tag_cloud .tagcloud a:hover,
				.widget_tag_cloud .tagcloud a:active,
				.entry-tags .meta-tags a:hover,
				.entry-tags .meta-tags a:active,
				.pagination a:hover,
				.pagination a:active,
				.pagination .current,
				.infinite-scroll #infinite-handle span:hover,
				.tzwb-tabbed-content .tzwb-tabnavi li a:hover,
				.tzwb-tabbed-content .tzwb-tabnavi li a:active,
				.tzwb-tabbed-content .tzwb-tabnavi li a.current-tab,
				.tzwb-social-icons .social-icons-menu li a {
					background: ' . $theme_options['content_secondary_color'] . ';
				}
				';

		}

		// Set Primary Hover Content Color.
		if ( $theme_options['content_primary_color'] != $default_options['content_primary_color'] ) {

			$custom_css .= '
				/* Content Primary Hover Color Setting */
				a:hover,
				a:focus,
				a:active {
					color: ' . $theme_options['content_primary_color'] . ';
				}
				';

		}

		// Set Footer Widget Color.
		if ( $theme_options['footer_widgets_color'] != $default_options['footer_widgets_color'] ) {

			$custom_css .= '

				/* Footer Widget Color Setting */
				.footer-widgets-wrap {
					background: ' . $theme_options['footer_widgets_color'] . ';
				}
				';

		}

		// Set Footer Color.
		if ( $theme_options['footer_color'] != $default_options['footer_color'] ) {

			$custom_css .= '

				/* Footer Line Color Setting */
				.footer-wrap {
					background: ' . $theme_options['footer_color'] . ';
				}
				';

		}

		return $custom_css;

	}

	/**
	 * Adds all color settings in the Customizer
	 *
	 * @param object $wp_customize / Customizer Object.
	 */
	static function color_settings( $wp_customize ) {

		// Add Section for Theme Colors.
		$wp_customize->add_section( 'admiral_pro_section_colors', array(
			'title'    => __( 'Theme Colors', 'admiral-pro' ),
			'priority' => 60,
			'panel'    => 'admiral_options_panel',
			)
		);

		// Get Default Colors from settings.
		$default_options = Admiral_Pro_Customizer::get_default_options();

		// Add Header Color setting.
		$wp_customize->add_setting( 'admiral_theme_options[header_color]', array(
			'default'           => $default_options['header_color'],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'admiral_theme_options[header_color]', array(
				'label'    => _x( 'Header', 'color setting', 'admiral-pro' ),
				'section'  => 'admiral_pro_section_colors',
				'settings' => 'admiral_theme_options[header_color]',
				'priority' => 1,
			)
		) );

		// Add Navigation Color setting.
		$wp_customize->add_setting( 'admiral_theme_options[navi_color]', array(
			'default'           => $default_options['navi_color'],
			'type'           	=> 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'admiral_theme_options[navi_color]', array(
				'label'    => _x( 'Navigation', 'color setting', 'admiral-pro' ),
				'section'  => 'admiral_pro_section_colors',
				'settings' => 'admiral_theme_options[navi_color]',
				'priority' => 2,
			)
		) );

		// Add Header Color setting.
		$wp_customize->add_setting( 'admiral_theme_options[header_line_color]', array(
			'default'           => $default_options['header_line_color'],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'admiral_theme_options[header_line_color]', array(
				'label'    => _x( 'Header Line', 'color setting', 'admiral-pro' ),
				'section'  => 'admiral_pro_section_colors',
				'settings' => 'admiral_theme_options[header_line_color]',
				'priority' => 3,
			)
		) );

		// Add Content Primary Color setting.
		$wp_customize->add_setting( 'admiral_theme_options[content_primary_color]', array(
			'default'           => $default_options['content_primary_color'],
			'type'           	=> 'option',
			'transport'         => 'refresh',
			'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'admiral_theme_options[content_primary_color]', array(
				'label'    => _x( 'Content (primary)', 'color setting', 'admiral-pro' ),
				'section'  => 'admiral_pro_section_colors',
				'settings' => 'admiral_theme_options[content_primary_color]',
				'priority' => 4,
			)
		) );

		// Add Content Secondray Color setting.
		$wp_customize->add_setting( 'admiral_theme_options[content_secondary_color]', array(
			'default'           => $default_options['content_secondary_color'],
			'type'           	=> 'option',
			'transport'         => 'refresh',
			'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'admiral_theme_options[content_secondary_color]', array(
				'label'    => _x( 'Content (secondary)', 'color setting', 'admiral-pro' ),
				'section'  => 'admiral_pro_section_colors',
				'settings' => 'admiral_theme_options[content_secondary_color]',
				'priority' => 5,
			)
		) );

		// Add Footer Widgets Color setting.
		$wp_customize->add_setting( 'admiral_theme_options[footer_widgets_color]', array(
			'default'           => $default_options['footer_widgets_color'],
			'type'           	=> 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'admiral_theme_options[footer_widgets_color]', array(
				'label'    => _x( 'Footer Widgets', 'color setting', 'admiral-pro' ),
				'section'  => 'admiral_pro_section_colors',
				'settings' => 'admiral_theme_options[footer_widgets_color]',
				'priority' => 6,
			)
		) );

		// Add Footer Line Color setting.
		$wp_customize->add_setting( 'admiral_theme_options[footer_color]', array(
			'default'           => $default_options['footer_color'],
			'type'           	=> 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'admiral_theme_options[footer_color]', array(
				'label'    => _x( 'Footer Line', 'color setting', 'admiral-pro' ),
				'section'  => 'admiral_pro_section_colors',
				'settings' => 'admiral_theme_options[footer_color]',
				'priority' => 7,
			)
		) );

	}
}

// Run Class.
add_action( 'init', array( 'Admiral_Pro_Custom_Colors', 'setup' ) );
