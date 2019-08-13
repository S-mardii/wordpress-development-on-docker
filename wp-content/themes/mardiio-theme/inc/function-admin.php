<?php
/**
 * @package mardiio-theme\inc
 */

/**
 * Create Admin page
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
    // Register Settings values
    register_setting( 'mardiio-admin-settings-group', 'profile_picture' );
    register_setting( 'mardiio-admin-settings-group', 'first_name' );
    register_setting( 'mardiio-admin-settings-group', 'last_name' );
    register_setting( 'mardiio-admin-settings-group', 'user_description' );
    register_setting( 'mardiio-admin-settings-group', 'twitter_handler', 'mardiio_sanitize_twitter_handler' );
    register_setting( 'mardiio-admin-settings-group', 'facebook_handler' );
    register_setting( 'mardiio-admin-settings-group', 'linkedin_handler' );

    // Create Settings sections
    add_settings_section( 'mardiio-sidebar-options', 'Sidebar Options', 'mardiio_add_sidebar_options', 'mardy_mardiio' );
    
    // Add Settings fields
    add_settings_field( 'mardiio-sidebar-profile-picture', 'Profile Picture', 'mardiio_add_sidebar_profile_picture', 'mardy_mardiio', 'mardiio-sidebar-options' );
    
    add_settings_field( 'mardiio-sidebar-full-name', 'Full Name', 'mardiio_add_sidebar_full_name', 'mardy_mardiio', 'mardiio-sidebar-options' );
    add_settings_field( 'mardiio-sidebar-discription', 'User Description', 'mardiio_add_sidebar_description', 'mardy_mardiio', 'mardiio-sidebar-options' );
    
    add_settings_field( 'mardiio-sidebar-twitter', 'Twitter', 'mardiio_add_sidebar_twitter', 'mardy_mardiio', 'mardiio-sidebar-options' );
    add_settings_field( 'mardiio-sidebar-facebook', 'Facebook', 'mardiio_add_sidebar_facebook', 'mardy_mardiio', 'mardiio-sidebar-options' );
    add_settings_field( 'mardiio-sidebar-linkedin', 'LinkedIn', 'mardiio_add_sidebar_linkedin', 'mardy_mardiio', 'mardiio-sidebar-options' );
}

/**
 * Generate Sidebar options
 */
function mardiio_add_sidebar_options() {
    echo 'Customize the sidebar of your theme.';
}

function mardiio_add_sidebar_profile_picture() {
    $profilePicture = esc_attr( get_option( 'profile_picture' ) );
    
    echo '<input type="button" value="Upload a Profile Picture" class="button button-secondary" id="upload-button"/> <input type="hidden" id="profile-picture" name="profile_picture" value="' . $profilePicture . '"/>';
}

/**
 * Add Full Name fields to Sidebar
 */
function mardiio_add_sidebar_full_name() {
    $firstName = esc_attr( get_option( 'first_name' ) );
    $lastName = esc_attr( get_option( 'last_name' ) );

    echo '<input type="text" name="first_name" value="' . $firstName . '" placeholder="First Name" /> <input type="text" name="last_name" value="' . $lastName . '" placeholder="Last Name" />';
}

/**
 * Add User Description field to Sidebar
 */
function mardiio_add_sidebar_description() {
    $description = esc_attr( get_option( 'user_description' ) );

    echo '<input type="text" name="user_description" value="' . $description . '" placeholder="Description" /> <p class="description">Say something about yourself.</p>';
}

/**
 * Add Twitter Handler field to Sidebar
 */
function mardiio_add_sidebar_twitter() {
    $twitter = esc_attr( get_option( 'twitter_handler' ) );
    echo '<input type="text" name="twitter_handler" value="' . $twitter . '" placeholder="Twitter handler" /> <p class="description">Please input your Twitter handler without @ charactor.</p>';
}

/**
 * Add Facebook Handler field to Sidebar
 */
function mardiio_add_sidebar_facebook() {
    $facebook = esc_attr( get_option( 'facebook_handler' ) );
    echo '<input type="text" name="facebook_handler" value="' . $facebook . '" placeholder="Facebook handler" />';
}

/**
 * Add LinkedIn Handler field to Sidebar
 */
function mardiio_add_sidebar_linkedin() {
    $linkedin = esc_attr( get_option( 'linkedin_handler' ) );
    echo '<input type="text" name="linkedin_handler" value="' . $linkedin . '" placeholder="LinkedIn handler" />';
}

//===========================
// Sanitize options
//===========================
/**
 * Sanitize Twitter Handler
 * 
 * @param  String $input
 * 
 * @return String $output
 */
function mardiio_sanitize_twitter_handler( String $input ) {
    $output = sanitize_text_field( $input );
    $output = str_replace( '@', '', $output );
    return $output;
}