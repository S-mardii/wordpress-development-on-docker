<?php
/**
 * @package mardiio-theme\inc
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