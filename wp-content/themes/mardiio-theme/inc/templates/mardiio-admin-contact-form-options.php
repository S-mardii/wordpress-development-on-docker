<?php
/**
 * @package mardiio-theme\inc\templates
 */
?>

<h1>Mardiio Contact Form Options</h1>
<form method="post" action="options.php" class="mardiio-admin-contact-form-page">
    <?php
    settings_fields( 'mardiio-admin-contact-form-options-group' );
    do_settings_sections( 'mardy-mardiio-admin-contact-form' );
    submit_button();
    ?>
</form>