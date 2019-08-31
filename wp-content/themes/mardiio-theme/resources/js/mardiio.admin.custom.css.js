jQuery( document ).ready( function( $ ) {
  var updateCSS = function() {
    // Paste value from ACE editor to textarea input
    $( "#custom_css" ).val( editor.getSession().getValue() );
  }

  $( "#mardiio-admin-custom-css-form" ).submit( updateCSS );
});

var editor = ace.edit( "custom-css-text-editor" );

editor.setTheme( "ace/theme/monokai" );
editor.getSession().setMode( "ace/mode/css" );