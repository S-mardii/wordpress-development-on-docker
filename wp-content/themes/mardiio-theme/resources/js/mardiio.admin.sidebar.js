jQuery( document ).ready( function($){
	var mediaUploader;

	$( '#upload-profile-photo' ).on( 'click', function( e ) {
		e.preventDefault();

		if( mediaUploader ) {
			mediaUploader.open();
			return;
		}

		mediaUploader = wp.media.frames.file_frame = wp.media({
			title: 'Choose a Profile Picture',
			button: {
				text: 'Choose Picture'
			},
			multiple: false
		});

		mediaUploader.on( 'select', function(){
			attachment = mediaUploader.state().get( 'selection' ).first().toJSON();
			$( '#profile-picture' ).val( attachment.url );
			$( '#profile-picture-preview' ).css( 'background-image', 'url( ' + attachment.url + ' )' );
		});

		mediaUploader.open();
	});

	$( '#remove-profile-photo' ).on('click', function( e ) {
		e.preventDefault();
		
		var answer = confirm("Are you sure you want to remove your profile picture?");
		
		if ( answer == true) {
			$( '#profile-picture' ).val( '' );

			// Force refresh form element
			$( '.mardiio-admin-sidebar-options-form' ).submit();
		} else {
			
		}
	});
});