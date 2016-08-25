<?php
/**
    Plugin Name: Specify Image Dimensions
    Plugin URI: https://wordpress.org/plugins/specify-image-dimensions/
    Description: Automatically specify image dimensions that are missing width and/or height attributes. Helps with website speed tools.
    Version: 1.0.2
    Author: <a href="https://www.factmaven.com/">Fact Maven</a>
    License: GPLv3
*/

if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_action( 'plugins_loaded', 'factmaven_sid_buffer', 10, 1 );

function factmaven_sid_buffer() { // Enable output buffering for our function
    ob_start( 'factmaven_sid_specify_image_dimensions' );
}

function factmaven_sid_specify_image_dimensions( $content ) { // Automatically insert width and height attributes
    global $pagenow;
    if ( $pagenow == 'upload.php' ) { // Don't apply changes on the Media page
        return $content;
    }

    preg_match_all( '/<img[^>]+>/i', $content, $images );
    if ( count( $images ) < 1 ) { // Don't change content if there are no images
        return $content;
    }

    foreach ( $images[0] as $image ) {
        preg_match_all( '/(src|alt|title|class|id|width|height)=("[^"]*")/i', $image, $img );
        if ( !in_array( 'src', $img[1] ) ) {
            continue;
        }
        if ( !in_array( 'width', $img[1] ) || !in_array( 'height', $img[1] ) ) {
            $src = $img[2][array_search('src', $img[1] )];
            $alt = in_array( 'alt', $img[1] ) ? ' alt=' . $img[2][array_search( 'alt', $img[1] )] : '';
            $title = in_array( 'title', $img[1] ) ? ' title=' . $img[2][array_search('title', $img[1] )] : '';
            $class = in_array( 'class', $img[1] ) ? ' class=' . $img[2][array_search('class', $img[1] )] : '';
            $id = in_array( 'id', $img[1] ) ? ' id=' . $img[2][array_search('id', $img[1] )] : '';
            list( $width, $height, $type, $attr ) = getimagesize( str_replace( "\"", "" , $src ) );

            $image_tag = sprintf( '<img src=%s%s%s%s%s width="%d" height="%d" />', $src, $alt, $title, $class, $id, $width, $height );
            $content = str_replace( $image, $image_tag, $content );
        }
    }
    return $content;
}