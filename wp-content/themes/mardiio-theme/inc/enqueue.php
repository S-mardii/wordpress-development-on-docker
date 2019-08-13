<?php
/**
 * @package mardiio-theme\inc
 */

/**
 * Load CSS file for Admin page
 * @param  $hook
 */
function mardiio_load_admin_scripts( $hook ) {
	if ( 'toplevel_page_mardy_mardiio' != $hook ) {
		return;
	}

	wp_register_style( 'mardiio_admin_style', get_template_directory_uri() . '/public/css/mardiio.admin.css', [], '1.0.0', 'all' );
	wp_enqueue_style( 'mardiio_admin_style' );

	wp_enqueue_media();

	wp_register_script( 'mardiio_admin_script', get_template_directory_uri() . '/public/js/mardiio.admin.js', ['jquery'], '1.0.0', true );
	wp_enqueue_script( 'mardiio_admin_script' );
}
add_action( 'admin_enqueue_scripts', 'mardiio_load_admin_scripts' );