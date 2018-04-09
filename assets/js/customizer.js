/**
 * Customizer JS
 *
 * Reloads changes on Theme Customizer Preview asynchronously for better usability
 *
 * @package Admiral Pro
 */

( function( $ ) {

	/* Header Color */
	wp.customize( 'admiral_theme_options[header_color]', function( value ) {
		value.bind( function( newval ) {
			$( '.site-header' )
				.css( 'background', newval );
		} );
	} );

	/* Navi Color */
	wp.customize( 'admiral_theme_options[navi_color]', function( value ) {
		value.bind( function( newval ) {
			$( '.main-navigation-wrap, .main-navigation-menu ul' )
				.css( 'background', newval );
		} );
	} );

	/* Header Line Color */
	wp.customize( 'admiral_theme_options[header_line_color]', function( value ) {
		value.bind( function( newval ) {
			$( '.site-header' ).css( 'border-bottom', '10px solid ' + newval );
			$( '.main-navigation-menu ul' ).css( 'border-top', '10px solid ' + newval );
		} );
	} );

	/* Main Sidebar Color */
	wp.customize( 'admiral_theme_options[main_sidebar_color]', function( value ) {
		value.bind( function( newval ) {
			$( '.main-sidebar .sidebar-header, .main-sidebar-toggle' )
				.css( 'background', newval )
				.css( 'border-color', newval );
		} );
	} );

	/* Small Sidebar Color */
	wp.customize( 'admiral_theme_options[small_sidebar_color]', function( value ) {
		value.bind( function( newval ) {
			$( '.small-sidebar .sidebar-header, .small-sidebar-toggle' )
				.css( 'background', newval )
				.css( 'border-color', newval );
		} );
	} );

	/* Footer Widgets Color */
	wp.customize( 'admiral_theme_options[footer_widgets_color]', function( value ) {
		value.bind( function( newval ) {
			$( '.footer-widgets-wrap' )
				.css( 'background', newval );
		} );
	} );

	/* Footer Color */
	wp.customize( 'admiral_theme_options[footer_color]', function( value ) {
		value.bind( function( newval ) {
			$( '.footer-wrap' )
				.css( 'background', newval );
		} );
	} );

	/* Theme Fonts */
	wp.customize( 'admiral_theme_options[text_font]', function( value ) {
		value.bind( function( newval ) {

			// Embed Font.
			var fontFamilyUrl = newval.split( " " ).join( "+" );
			var googleFontPath = "https://fonts.googleapis.com/css?family=" + fontFamilyUrl + ":400,700";
			var googleFontSource = "<link id='admiral-pro-custom-text-font' href='" + googleFontPath + "' rel='stylesheet' type='text/css'>";
			var checkLink = $( "head" ).find( "#admiral-pro-custom-text-font" ).length;

			if (checkLink > 0) {
				$( "head" ).find( "#admiral-pro-custom-text-font" ).remove();
			}
			$( "head" ).append( googleFontSource );

			// Set Font.
			var systemFont = '-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif';
			var newFont = newval === 'SystemFontStack' ? systemFont : newval;

			// Set CSS.
			$( 'body, input, select, textarea' )
				.css( 'font-family', newFont );

		} );
	} );

	wp.customize( 'admiral_theme_options[title_font]', function( value ) {
		value.bind( function( newval ) {

			// Embed Font.
			var fontFamilyUrl = newval.split( " " ).join( "+" );
			var googleFontPath = "https://fonts.googleapis.com/css?family=" + fontFamilyUrl + ":400,700";
			var googleFontSource = "<link id='admiral-pro-custom-title-font' href='" + googleFontPath + "' rel='stylesheet' type='text/css'>";
			var checkLink = $( "head" ).find( "#admiral-pro-custom-title-font" ).length;

			if (checkLink > 0) {
				$( "head" ).find( "#admiral-pro-custom-title-font" ).remove();
			}
			$( "head" ).append( googleFontSource );

			// Set Font.
			var systemFont = '-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif';
			var newFont = newval === 'SystemFontStack' ? systemFont : newval;

			// Set CSS.
			$( '.site-title, .entry-title, .blog-title, .page-title, .sidebar-title, .archive-title' )
				.css( 'font-family', newFont );

		} );
	} );

	wp.customize( 'admiral_theme_options[navi_font]', function( value ) {
		value.bind( function( newval ) {

			// Embed Font.
			var fontFamilyUrl = newval.split( " " ).join( "+" );
			var googleFontPath = "https://fonts.googleapis.com/css?family=" + fontFamilyUrl + ":400,700";
			var googleFontSource = "<link id='admiral-pro-custom-navi-font' href='" + googleFontPath + "' rel='stylesheet' type='text/css'>";
			var checkLink = $( "head" ).find( "#admiral-pro-custom-navi-font" ).length;

			if (checkLink > 0) {
				$( "head" ).find( "#admiral-pro-custom-navi-font" ).remove();
			}
			$( "head" ).append( googleFontSource );

			// Set Font.
			var systemFont = '-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif';
			var newFont = newval === 'SystemFontStack' ? systemFont : newval;

			// Set CSS.
			$( '.main-navigation-menu a, .sidebar-navigation-menu a, button, input[type="button"], input[type="reset"], input[type="submit"], .infinite-scroll #infinite-handle span' )
				.css( 'font-family', newFont );

		} );
	} );

	wp.customize( 'admiral_theme_options[widget_title_font]', function( value ) {
		value.bind( function( newval ) {

			// Embed Font.
			var fontFamilyUrl = newval.split( " " ).join( "+" );
			var googleFontPath = "https://fonts.googleapis.com/css?family=" + fontFamilyUrl + ":400,700";
			var googleFontSource = "<link id='admiral-pro-custom-widget-title-font' href='" + googleFontPath + "' rel='stylesheet' type='text/css'>";
			var checkLink = $( "head" ).find( "#admiral-pro-custom-widget-title-font" ).length;

			if (checkLink > 0) {
				$( "head" ).find( "#admiral-pro-custom-widget-title-font" ).remove();
			}
			$( "head" ).append( googleFontSource );

			// Set Font.
			var systemFont = '-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif';
			var newFont = newval === 'SystemFontStack' ? systemFont : newval;

			// Set CSS.
			$( '.widget-title, .comments-header .comments-title, .comment-reply-title span' )
				.css( 'font-family', newFont );

		} );
	} );

} )( jQuery );
