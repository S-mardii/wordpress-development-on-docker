<?php
/**
 * @package  mardiiio\inc
 */
$options = get_option( 'post_formats' );

if ( !empty( $options ) ) {
	$formats = [ 'aside', 'audio', 'chat', 'gallery', 'link', 'image', 'quote', 'status', 'video' ];
    $output = [];

    foreach ( $formats as $format ) {
        if ( @$options[$format] == 1 ) {
            $output[] = $format;
        } else {
            $output[] = '';
        }
    }

    add_theme_support( 'post-formats', $output );
}