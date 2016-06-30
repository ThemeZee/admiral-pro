<?php
/***
 * Admiral Pro Settings Page Class
 *
 * Adds a new tab on the themezee plugins page and displays the settings page.
 *
 * @package Admiral Pro
 */
 
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;


// Use class to avoid namespace collisions
if ( ! class_exists('Admiral_Pro_Settings_Page') ) :

class Admiral_Pro_Settings_Page {

	/**
	 * Setup the Settings Page class
	 *
	 * @return void
	*/
	static function setup() {
		
		// Add settings page to appearance menu
		add_action( 'admin_menu', array( __CLASS__, 'add_settings_page' ), 12 );
		
		// Enqueue Settings CSS
		add_action( 'admin_enqueue_scripts', array( __CLASS__, 'settings_page_css' ) );
	}
	
	/**
	 * Add Settings Page to Admin menu
	 *
	 * @return void
	*/
	static function add_settings_page() {
	
		// Return early if Admiral Theme is not active
		if ( ! current_theme_supports( 'admiral-pro'  ) ) {
			return;
		}
			
		add_theme_page(
			esc_html__( 'Pro Version', 'admiral-pro' ),
			esc_html__( 'Pro Version', 'admiral-pro' ),
			'edit_theme_options',
			'admiral-pro',
			array( __CLASS__, 'display_settings_page' )
		);
		
	}
	
	/**
	 * Display settings page
	 *
	 * @return void
	*/
	static function display_settings_page() { 
		
		// Get Theme Details from style.css
		$theme = wp_get_theme(); 
	
		ob_start();
		?>

		<div class="wrap pro-version-wrap">

			<h1><?php echo ADMIRAL_PRO_NAME; ?> <?php echo ADMIRAL_PRO_VERSION; ?></h1>
			
			<div id="admiral-pro-settings" class="admiral-pro-settings-wrap">
				
				<form class="admiral-pro-settings-form" method="post" action="options.php">
					<?php
						settings_fields( 'admiral_pro_settings' );
						do_settings_sections( 'admiral_pro_settings' );
					?>
				</form>
				
				<p><?php printf( __( 'You can find your license keys and manage your active sites on <a href="%s" target="_blank">themezee.com</a>.', 'admiral-pro' ), __( 'https://themezee.com/license-keys/', 'admiral-pro' ) . '?utm_source=plugin-settings&utm_medium=textlink&utm_campaign=admiral-pro&utm_content=license-keys' ); ?></p>
				
			</div>
			
		</div>
<?php
		echo ob_get_clean();
	}
	
	/**
	 * Enqueues CSS for Settings page
	 *
	 * @return void
	*/
	static function settings_page_css( $hook ) { 

		// Load styles and scripts only on theme info page
		if ( 'appearance_page_admiral-pro' != $hook ) {
			return;
		}
		
		// Embed theme info css style
		wp_enqueue_style( 'admiral-pro-settings-css', plugins_url('/assets/css/settings.css', dirname( dirname(__FILE__) ) ), array(), ADMIRAL_PRO_VERSION );

	}
	
}

// Run Admiral Pro Settings Page Class
Admiral_Pro_Settings_Page::setup();

endif;