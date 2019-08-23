<?php
/**
 * @package  mardiiio\inc
 */

$postFormats = get_option( 'post_formats' );

if ( !empty( $postFormat ) ) {
	$formats = [ 'aside', 'audio', 'chat', 'gallery', 'link', 'image', 'quote', 'status', 'video' ];
    $output = [];

    foreach ( $formats as $format ) {
        if ( @$postFormat[$format] == 1 ) {
            $output[] = $format;
        } else {
            $output[] = '';
        }
    }

    add_theme_support( 'post-formats', $output );
}

$customHeader = get_option( 'custom_header' );
if ( @$customHeader == 1 ) {
    add_theme_support( 'custom-header' );
}

$customBackground = get_option( 'custom_background' );
if ( @$customBackground == 1 ) {
    add_theme_support( 'custom-background' );
}