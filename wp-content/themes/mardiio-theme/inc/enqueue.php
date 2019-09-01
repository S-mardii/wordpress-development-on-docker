<?php
/**
 * @package mardiio-theme\inc
 */

/**
 * ===============================
 * Admin Enqueue Functions
 * ===============================
*/

/**
 * Load CSS file for Admin page
 * @param  $hook	String
 */
function mardiio_load_admin_scripts( $hook ) {
	if ( 'mardiio_page_mardy_mardiio_admin_sidebar' == $hook ) {
		wp_register_style( 'mardiio_admin_style', get_template_directory_uri() . '/resources/sass/mardiio.admin.sidebar.css', [], '1.0.0', 'all' );
		wp_enqueue_style( 'mardiio_admin_style' );

		wp_enqueue_media();

		wp_register_script( 'mardiio_admin_script', get_template_directory_uri() . '/resources/js/mardiio.admin.sidebar.js', ['jquery'], '1.0.0', true );
		wp_enqueue_script( 'mardiio_admin_script' );
	} elseif ( 'mardiio_page_mardy_mardiio_admin_custom_css' == $hook ) {
		wp_enqueue_style( 'ace', get_template_directory_uri() . '/resources/sass/mardiio.ace.text.editor.css', [], '1.0.0', 'all' );

		wp_enqueue_script( 'ace', get_template_directory_uri() . '/vendors/ace-builds/src-min-noconflict/ace.js', ['jquery'], '1.4.5', true );
		wp_enqueue_script( 'mardiio_admin_custom_css_script', get_template_directory_uri() . '/resources/js/mardiio.admin.custom.css.js', ['jquery'], '1.0.0', true );
	} else {
		return;
	}
}
add_action( 'admin_enqueue_scripts', 'mardiio_load_admin_scripts' );

/**
 * ===============================
 * Frontend Enqueue Functions
 * ===============================
 */
function mardiio_load_frontend_scripts() {
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/node_modules/bootstrap/dist/css/bootstrap.min.css', [], '4.3.1', 'all' );

	wp_deregister_script( 'jquery' );
	
	wp_register_script( 'jquery', get_template_directory_uri() . '/node_modules/jquery/dist/jquery.min.js', false, '3.4.1', true );
	wp_enqueue_script( 'jquery' );
	
	wp_enqueue_script( 'popper', get_template_directory_uri() . '/node_modules/popper.js/dist/popper.min.js', ['jquery'], '1.14.7', true );
	
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/node_modules/bootstrap/dist/js/bootstrap.min.js', ['jquery'], '4.3.1', true );
}
add_action( 'wp_enqueue_scripts', 'mardiio_load_frontend_scripts' );