<?php
/**
 * @package mardiio-theme\inc\templates
 */
?>

<h1>Mardiio Sidebar Options</h1>

<?php settings_errors(); ?>

<?php
	$firstName = esc_attr( get_option( 'first_name' ) );
    $lastName = esc_attr( get_option( 'last_name' ) );
    $fullName = $firstName . ' ' . $lastName;
    $description = esc_attr( get_option( 'user_description' ) );
    $profilePicture = esc_attr( get_option( 'profile_picture' ) );
?>

<form method="post" action="options.php" class="mardiio-admin-sidebar-options-form">
    <?php settings_fields( 'mardiio-admin-sidebar-options-group' ); ?>
    <?php do_settings_sections( 'mardy_mardiio_admin_sidebar_options_section' ); ?>
    <?php submit_button(); ?>
</form>

<div class="mardiio-sidebar-preview">
	<div class="mardiio-sidebar">
        <div class="image-container">
            <div id="profile-picture-preview" class="profile-picture" style="background-image: url('<?php print $profilePicture; ?>')"></div>
        </div>
		<h1 class="mardiio-sidebar-username"><?php echo $fullName; ?></h1>
		<h2 class="mardiio-sidebar-description"><?php echo $description; ?></h2>
	</div>
</div>