<?php

/**
 * @package mardiio-theme
 */

/**
 * Create admin page
 */
function mardiio_add_admin_page() {
    // add_menu_page( 'Mardiio Theme Options', 'Mardiio', 'manage_options', 'mardiio-theme-options', 'mardiio_theme_create_page', get_template_directory_uri() . '/public/images/mardiio-icon.png', 110 );
    add_menu_page( 'Mardiio Theme Options', 'Mardiio', 'manage_options', 'mardiio-theme-options', 'mardiio_theme_create_page', 'dashicons-palmtree', 110 );
}
add_action( 'admin_menu', 'mardiio_add_admin_page' );

/**
 * Generate admin page
 */
function mardiio_theme_create_page() {
    echo '<h1>Mardiio Theme Options</h1>';
}