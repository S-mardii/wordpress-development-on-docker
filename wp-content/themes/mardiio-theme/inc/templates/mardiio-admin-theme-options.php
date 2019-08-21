<?php
/**
 * @package mardiio-theme\inc\template
 */
?>

<h1>General Theme Options</h1>

<?php settings_errors(); ?>

<form method="post" action="options.php" class="mardiio-admin-theme-options-form">
    <?php settings_fields( 'mardiio-admin-theme-options-group' ); ?>
    <?php do_settings_sections( 'mardy_mardiio' ); ?>
    <?php submit_button(); ?>
</form>