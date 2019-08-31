<?php
/**
 * @package mardiio-theme\inc\templates
 */
?>

<h1>Mardiio Custom CSS Options</h1>

<?php settings_errors(); ?>

<form id="mardiio-admin-custom-css-form" method="post" action="options.php" class="admin-custom-css-form">
    <?php
    settings_fields( 'mardiio-admin-custom-css-options-group' );
    do_settings_sections( 'mardy_mardiio_admin_custom_css' );
    submit_button();
    ?>
</form>