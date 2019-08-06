<?php
/**
 * @package mardiio-theme
 */

/**
 * Create admin page
 */
function mardiio_add_admin_page() {
    // add_menu_page( 'Mardiio Theme Options', 'Mardiio', 'manage_options', 'mardiio-theme-options', 'mardiio_theme_create_page', get_template_directory_uri() . '/public/images/mardiio-icon.png', 110 );
    
    // Add Mardiio Admin Page
    add_menu_page( 'Mardiio Theme Options', 'Mardiio', 'manage_options', 'mardy_mardiio', 'mardiio_create_admin_page', 'dashicons-palmtree', 110 );

    // Add Mardiio Admin General Subpage
    add_submenu_page( 'mardy_mardiio', 'Mardiio', 'General', 'manage_options', 'mardy_mardiio', 'mardiio_create_admin_page' );

    // Add Mardiio Admin Custom CSS Subpage
    add_submenu_page( 'mardy_mardiio', 'Mardiio CSS Options', 'Custom CSS', 'manage_options', 'mardy_mardiio_custom_css', 'mardiio_create_admin_custom_css_page' );

    // Activate custom settings
    add_action( 'admin_init', 'mardiio_activate_custom_settings' );
}
add_action( 'admin_menu', 'mardiio_add_admin_page' );

/**
 * Generate Admin page
 */
function mardiio_create_admin_page() {
    require_once( get_template_directory() . '/inc/templates/mardiio-admin-options.php' );
}

/**
 * Generate Admin General Page 
 */
function mardiio_create_admin_custom_css_page() {
    require_once( get_template_directory() . '/inc/templates/mardiio-css-options.php' );
}

/**
 * Activate custom settings
 */
function mardiio_activate_custom_settings() {
    register_setting( 'mardiio-admin-settings-group', 'sidebar_name' );
    add_settings_section( 'mardiio-sidebar-options', 'Sidebar Options', 'mardiio_add_sidebar_options', 'mardy_mardiio' );
    add_settings_field( 'mardiio-sidebar-name', 'Sidebar Name', 'mardiio_add_sidebar_name', 'mardy_mardiio', 'mardiio-admin-settings-group' );
}

/**
 * Generate Sidebar options
 */
function mardiio_add_sidebar_options() {
    echo '<input type="text" name="sidebar_name" value="" />';
}

/**
 * Add Sidebar Name
 */
function mardiio_add_sidebar_name() {
    echo '<input type="text" name="sidebar_name" value="" />';
}