<?php
/**
 * @package  mardiiio\inc
 */

$contactForm = get_option( 'activate_contact_form' );

/**
 * Check if Contact Form is activated
 */
if ( @$contactForm == 1 ) {
    // Hook for creating Contact Form custom post type
    add_action( 'init', 'mardiio_contact_form_custom_post_type' );

    // Hook for managing Contact Form columns
    add_filter( 'manage_mardiio-contact-form_posts_columns', 'mardiio_set_contact_form_columns' );

    // Hook for making Contact Form columns sortable
    add_filter( 'manage_edit-mardiio-contact-form_sortable_columns', 'mardiio_make_contact_form_custom_columns_sortable' );

    // Hook for setting Custom Column for Contact Form
    // 10: priority of loading the action; 2= number of argument to pass ($columns and $post_id)
    add_action( 'manage_mardiio-contact-form_posts_custom_column', 'mardiio_set_contact_form_custom_column', 10, 2 );

    // Hook for creating User Email meta box
    add_action( 'add_meta_boxes', 'mardiio_add_contact_form_meta_box' );

    add_action( 'save_post', 'mardiio_save_user_email_data' );
}

/**
 * Contact Form - Custom Post Type
 */
function mardiio_contact_form_custom_post_type() {
    $labels = [
        'name'              => 'Contact Messages',
        'single_name'       => 'Contact Message',
        'menu_name'         => 'Contact Messages',
        'name_admin_bar'    => 'Contact Message'
    ];

    $args = [
        'labels'            => $labels,
        'show_ui'           => true,
        'show_in_menu'      => true,
        'capability_type'   => 'post',
        'hierarchical'      => false,
        'postition'         => 26,
        'menu_icon'         => 'dashicons-email-alt',
        'supports'          => [ 'title', 'editor', 'author' ]
    ];

    // Register attribute for Contact Form custom post type
    register_post_type( 'mardiio-contact-form', $args );
}

/**
 * Manage Contact Form columns
 */
function mardiio_set_contact_form_columns( $columns ) {
    $newColumns = [];
    $newColumns['title'] = 'Full Name';
    $newColumns['message'] = 'Message';
    $newColumns['email'] = 'Email';
    $newColumns['date'] = 'Date';

    return $newColumns;
}

// Make Contact Form columns sortable
function mardiio_make_contact_form_custom_columns_sortable( $columns ) {
    $sortableColumns = [];
    $sortableColumns['title'] = 'Full Name';
    $sortableColumns['email'] = 'User Email';
    $sortableColumns['date'] = 'Date';

    return $sortableColumns;
}

/**
 * Manage Contact Form custom column (a loop function)
 */
function mardiio_set_contact_form_custom_column( $column, $post_id ) {
    switch( $column ) {
        case 'message':
            echo get_the_excerpt();
            break;
        case 'email':
            $email = get_post_meta( $post_id, '_user_email_value_key', true );
            echo '<a href="mailto:' . $email . '">' . $email . '</a>';
            break;
    }
}

//=========================
// CONTACT FORM CUSTOM META BOXES 
//=========================

/**
 * Create meta boxes for Contact Form
 */
function mardiio_add_contact_form_meta_box() {
    add_meta_box( 'mardiio-user-email', 'User Email', 'mardiio_add_user_email', 'mardiio-contact-form', 'side' );
}

/**
 * Add Email metabox to Contact Form
 */
function mardiio_add_user_email( $post ) {
    // Generate security nonce for User Email input
    wp_nonce_field( 'mardiio_save_user_email_data', 'mardiio_user_email_meta_box_nonce' );

    // Collect User Email value
    $value = get_post_meta( $post->ID, '_user_email_value_key', true );

    // Create form for User Email custom meta box
    echo '<label for="mardiio_user_email_field">User Email Address: </label>';
    echo '<input type="email" id="mardiio_user_email_field" name="mardiio_user_email_field" value="' . esc_attr( $value ) . '" size="25" />';
}

/**
 * Save User Email data
 */
function mardiio_save_user_email_data( $post_id ) {
    // Check if nonce of User Email is exist
    if( ! isset( $_POST['mardiio_user_email_meta_box_nonce'] ) ){
        return;
    }

    // Check if nonce of User Email is valide
    if( ! wp_verify_nonce( $_POST['mardiio_user_email_meta_box_nonce'], 'mardiio_save_user_email_data' ) ) {
        return;
    }

    // Check if you would like to save the metabox data on Autosave
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    // Check user manage permission
    if ( !current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    if ( !isset( $_POST['mardiio_user_email_field'] ) ) {
        return;
    }

    $user_email = sanitize_text_field( $_POST['mardiio_user_email_field'] );

    update_post_meta( $post_id, '_user_email_value_key', $user_email );
}