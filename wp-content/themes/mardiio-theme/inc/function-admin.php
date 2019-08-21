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
    add_menu_page( 'Mardiio Theme Options', 'Mardiio', 'manage_options', 'mardy_mardiio', 'mardiio_create_admin_general_page', 'dashicons-palmtree', 110 );

    // Add Mardiio Admin General Subpage
    add_submenu_page( 'mardy_mardiio', 'Mardiio', 'General', 'manage_options', 'mardy_mardiio', 'mardiio_create_admin_general_page' );

    // Add Mardiio Admin Sidebar Subpage
    add_submenu_page( 'mardy_mardiio', 'Mardiio Sidebar Options', 'Sidebar', 'manage_options', 'mardy_mardiio_admin_sidebar', 'mardiio_create_admin_sidebar_page' );

    // Add Mardiio Admin Custom CSS Subpage
    add_submenu_page( 'mardy_mardiio', 'Mardiio CSS Options', 'Custom CSS', 'manage_options', 'mardy_mardiio_admin_custom_css', 'mardiio_create_admin_custom_css_page' );

    // Activate custom settings
    add_action( 'admin_init', 'mardiio_activate_custom_settings' );
}
add_action( 'admin_menu', 'mardiio_add_admin_page' );

/**
 * Generate Admin General page
 */
function mardiio_create_admin_general_page() {
    require_once( get_template_directory() . '/inc/templates/mardiio-admin-theme-options.php' );
}

/**
 * Generate Admin Sidebar Page
 */
function mardiio_create_admin_sidebar_page() {
    require_once( get_template_directory() . '/inc/templates/mardiio-admin-sidebar-options.php' );
}

/**
 * Generate Admin Custom CSS Page 
 */
function mardiio_create_admin_custom_css_page() {
    require_once( get_template_directory() . '/inc/templates/mardiio-admin-custom-css-options.php' );
}

/**
 * Activate custom settings
 */
function mardiio_activate_custom_settings() {
    //=========================
    //  Admin Theme Options
    //=========================
    register_setting( 'mardiio-admin-theme-options-group', 'post_formats', 'mardiio_admin_post_formats_callback' );

    add_settings_section( 'mardiio-admin-theme-options', 'Theme Options', 'mardiio_add_theme_options', 'mardy_mardiio' );

    add_settings_field( 'mardiio-theme-post-formats', 'Post Formats', 'mardiio_add_theme_post_formats', 'mardy_mardiio', 'mardiio-admin-theme-options' );
    
    //=========================
    //  Admin Sidebar Options
    //=========================

    // Register Settings values
    register_setting( 'mardiio-admin-sidebar-options-group', 'profile_picture' );
    register_setting( 'mardiio-admin-sidebar-options-group', 'first_name' );
    register_setting( 'mardiio-admin-sidebar-options-group', 'last_name' );
    register_setting( 'mardiio-admin-sidebar-options-group', 'user_description' );
    register_setting( 'mardiio-admin-sidebar-options-group', 'twitter_handler', 'mardiio_sanitize_twitter_handler' );
    register_setting( 'mardiio-admin-sidebar-options-group', 'facebook_handler' );
    register_setting( 'mardiio-admin-sidebar-options-group', 'linkedin_handler' );

    // Create sections
    add_settings_section( 'mardiio-admin-sidebar-options', 'Sidebar Options', 'mardiio_add_sidebar_options', 'mardy_mardiio_admin_sidebar_options_section' );
    
    // Add fields
    add_settings_field( 'mardiio-sidebar-profile-picture', 'Profile Picture', 'mardiio_add_sidebar_profile_picture', 'mardy_mardiio_admin_sidebar_options_section', 'mardiio-admin-sidebar-options' );
    
    add_settings_field( 'mardiio-sidebar-full-name', 'Full Name', 'mardiio_add_sidebar_full_name', 'mardy_mardiio_admin_sidebar_options_section', 'mardiio-admin-sidebar-options' );
    add_settings_field( 'mardiio-sidebar-discription', 'User Description', 'mardiio_add_sidebar_description', 'mardy_mardiio_admin_sidebar_options_section', 'mardiio-admin-sidebar-options' );
    
    add_settings_field( 'mardiio-sidebar-twitter', 'Twitter', 'mardiio_add_sidebar_twitter', 'mardy_mardiio_admin_sidebar_options_section', 'mardiio-admin-sidebar-options' );
    add_settings_field( 'mardiio-sidebar-facebook', 'Facebook', 'mardiio_add_sidebar_facebook', 'mardy_mardiio_admin_sidebar_options_section', 'mardiio-admin-sidebar-options' );
    add_settings_field( 'mardiio-sidebar-linkedin', 'LinkedIn', 'mardiio_add_sidebar_linkedin', 'mardy_mardiio_admin_sidebar_options_section', 'mardiio-admin-sidebar-options' );
}

//===================================
//  Admin Theme Options Functions
//===================================

/**
 * Collect input in array
 * @param  [type] $input [description]
 * @return [type]        [description]
 */
function mardiio_admin_post_formats_callback( $input ) {
    return $input;
}

/**
 * Generate Theme Options
 */
function mardiio_add_theme_options() {
    echo 'Activate and Deactivate specific Theme Options';
}

/**
 * Add Post Formats field
 */
function mardiio_add_theme_post_formats() {
    $options = get_option( 'post_formats' );

    $formats = [ 'aside', 'audio', 'chat', 'gallery', 'link', 'image', 'quote', 'status', 'video' ];
    $output = '';

    foreach ( $formats as $format ) {
        // @ = if( isset() )
        if ( @$options[$format] == 1 ) {
            $checked = 'checked';
        } else {
            $checked = '';
        }

        $output .= '<label><input type="checkbox" id="' . $format . '" name="post_formats[' . $format . ']" value="1"' . $checked . '>' . $format . '</label><br/>';
    }

    echo $output;
}

//===================================
//  Admin Sidebar Options Functions
//===================================

/**
 * Generate Sidebar Options
 */
function mardiio_add_sidebar_options() {
    echo 'Customize the sidebar of your theme.';
}

/**
 * [mardiio_add_sidebar_profile_picture description]
 * @return [type] [description]
 */
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