<?php
/**
 * Admiral Pro Admin Notices
 *
 * Adds admin notices to the WordPress Dashboard
 *
 * @package Admiral Pro
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) { exit; }


/**
 * Admin Notices Class
 */
class Admiral_Pro_Admin_Notices {

	/**
	 * Setup the Settings Page class
	 *
	 * @return void
	 */
	static function setup() {

		// Add Missing Theme Notice.
		add_action( 'admin_notices', array( __CLASS__, 'activate_license' ) );

		// Add Missing Theme Notice.
		add_action( 'admin_notices', array( __CLASS__, 'expired_license' ) );

		// Add Missing Theme Notice.
		add_action( 'admin_notices', array( __CLASS__, 'missing_theme' ) );

		// Dismiss Notices.
		add_action( 'init', array( __CLASS__, 'dismiss_notices' ) );

	}

	/**
	 * Display activate license notice
	 *
	 * @return void
	 */
	static function activate_license() {
		global $pagenow;

		// Get Settings.
		$options = Admiral_Pro_Settings::instance();

		if ( '' === $options->get( 'license_key' ) && in_array( $pagenow, array( 'index.php', 'update-core.php', 'plugins.php', 'themes.php' ) ) && ! isset( $_GET['page'] ) && current_theme_supports( 'admiral-pro' ) && ! get_transient( 'admiral_pro_activate_license_dismissed' ) && current_user_can( 'edit_theme_options' ) ) : ?>

			<div class="notice notice-info">
				<p>
					<?php printf( __( 'Please enter your license key for the %1$s add-on in order to receive updates and support. <a href="%2$s">Enter License Key</a>', 'admiral-pro' ),
						ADMIRAL_PRO_NAME,
						admin_url( 'themes.php?page=admiral-pro' )
					);
					?>
					<a style="float: right" href="<?php echo wp_nonce_url( add_query_arg( array( 'admiral_pro_action' => 'dismiss_notices', 'admiral_pro_notice' => 'activate_license' ) ), 'admiral_pro_dismiss_notice', 'admiral_pro_dismiss_notice_nonce' ); ?>"><?php _e( 'Dismiss Notice', 'admiral-pro' ); ?></a>
				</p>
			</div>

		<?php
		endif;

	}

	/**
	 * Display expired license notice
	 *
	 * @return void
	 */
	static function expired_license() {
		global $pagenow;

		// Get Settings.
		$options = Admiral_Pro_Settings::instance();

		if ( 'expired' === $options->get( 'license_status' ) && in_array( $pagenow, array( 'index.php', 'update-core.php', 'plugins.php', 'themes.php' ) ) && ! isset( $_GET['page'] ) && current_theme_supports( 'admiral-pro' ) && ! get_transient( 'admiral_pro_expired_license_dismissed' ) && current_user_can( 'edit_theme_options' ) ) : ?>

			<div class="notice notice-warning">
				<p>
					<?php printf( __( 'Your license for %1$s has expired. Please <a href="%2$s">renew</a> to continue getting updates and support!', 'admiral-pro' ),
						ADMIRAL_PRO_NAME,
						admin_url( 'themes.php?page=admiral-pro' )
					);
					?>
					<a style="float: right" href="<?php echo wp_nonce_url( add_query_arg( array( 'admiral_pro_action' => 'dismiss_notices', 'admiral_pro_notice' => 'expired_license' ) ), 'admiral_pro_dismiss_notice', 'admiral_pro_dismiss_notice_nonce' ); ?>"><?php _e( 'Dismiss Notice', 'admiral-pro' ); ?></a>
				</p>
			</div>

		<?php
		endif;

	}

	/**
	 * Display missing theme notice
	 *
	 * @return void
	 */
	static function missing_theme() {
		global $pagenow;

		if ( ! current_theme_supports( 'admiral-pro' ) && in_array( $pagenow, array( 'index.php', 'update-core.php', 'plugins.php', 'themes.php' ) ) && ! isset( $_GET['page'] ) && ! get_transient( 'admiral_pro_missing_theme_dismissed' ) && current_user_can( 'edit_theme_options' ) ) : ?>

			<div class="notice notice-warning">
				<p>
					<?php printf( __( 'The %1$s add-on needs the %2$s theme activated in order to work. You should deactivate %1$s if you have switched to another theme permanently.', 'admiral-pro' ),
						ADMIRAL_PRO_NAME,
						'Admiral'
					); ?>
					<a style="float: right" href="<?php echo wp_nonce_url( add_query_arg( array( 'admiral_pro_action' => 'dismiss_notices', 'admiral_pro_notice' => 'missing_theme' ) ), 'admiral_pro_dismiss_notice', 'admiral_pro_dismiss_notice_nonce' ); ?>"><?php _e( 'Dismiss Notice', 'admiral-pro' ); ?></a>
				</p>

			</div>

		<?php
		endif;

	}

	/**
	 * Dismiss admin notices when Dismiss links are clicked
	 *
	 * @return void
	 */
	static function dismiss_notices() {

		// Return early if admiral_pro_action was not fired.
		if ( ! isset( $_REQUEST['admiral_pro_action'] ) ) {
			return;
		}

		if ( ! isset( $_GET['admiral_pro_dismiss_notice_nonce'] ) || ! wp_verify_nonce( $_GET['admiral_pro_dismiss_notice_nonce'], 'admiral_pro_dismiss_notice' ) ) {
			wp_die( __( 'Security check failed', 'admiral-pro' ), __( 'Error', 'admiral-pro' ), array( 'response' => 403 ) );
		}

		if ( isset( $_GET['admiral_pro_notice'] ) ) {
			set_transient( 'admiral_pro_' . $_GET['admiral_pro_notice'] . '_dismissed', 1, DAY_IN_SECONDS * 60 );
			wp_redirect( remove_query_arg( array( 'admiral_pro_action', 'admiral_pro_notice', 'admiral_pro_dismiss_notice_nonce' ) ) );
			exit;
		}

	}
}

// Run Admiral Pro Admin Notices Class.
Admiral_Pro_Admin_Notices::setup();
