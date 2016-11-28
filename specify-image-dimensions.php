<?php
/**
 * Plugin Name: Specify Image Dimensions
 * Plugin URI: https://wordpress.org/plugins/specify-image-dimensions/
 * Description: Automatically specify image dimensions that are missing width and/or height attributes. Helps with website speed tools.
 * Version: 1.0.4
 * Author: Fact Maven
 * Author URI: https://www.factmaven.com
 * License: GPLv3
*/

# If accessed directly, exit
if ( ! defined( 'ABSPATH' ) ) exit;

class Fact_Maven_SID {

    public function __construct() {
        # Specify image dimensions
        add_action( 'wp_loaded', array( $this, 'image_dimensions' ), 10, 1 );
    }

    public function image_dimensions() {
        # Enable output buffering
        ob_start( function( $content ) {
            # If in the admin panel, return
            if ( is_admin() && ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) ) {
                return $content;
            }

            preg_match_all( '/<img[^>]+>/i', $content, $images );
            # If there are no images, return
            if ( count( $images ) < 1 ) {
                return $content;
            }

            foreach ( $images[0] as $image ) {
                preg_match_all( '/(src|alt|title|class|id|width|height)=("[^"]*")/i', $image, $img );
                # If image has a 'src', continue
                if ( ! in_array( 'src', $img[1] ) ) {
                    continue;
                }
                # If no 'width' or 'height' is available, calculate dimensions
                if ( ! in_array( 'width', $img[1] ) || ! in_array( 'height', $img[1] ) ) {
                    $src = $img[2][array_search( 'src', $img[1] )];
                    $alt = in_array( 'alt', $img[1] ) ? 'alt=' . $img[2][array_search( 'alt', $img[1] )] : '';
                    $title = in_array( 'title', $img[1] ) ? 'title=' . $img[2][array_search( 'title', $img[1] )] : '';
                    $class = in_array( 'class', $img[1] ) ? 'class=' . $img[2][array_search( 'class', $img[1] )] : '';
                    $id = in_array( 'id', $img[1] ) ? 'id=' . $img[2][array_search( 'id', $img[1] )] : '';
                    if ( preg_match( '/(.*).svg|.webp/i', $src ) ) {
                        $width = '100%';
                        $height = 'auto';
                    }
                    else {
                        list( $width, $height, $type, $attr ) = getimagesize( str_replace( "\"", "" , $src ) );
                    }

                    $image_tag = sprintf( '<img src=%s %s %s %s %s width="%s" height="%s" />', $src, $alt, $title, $class, $id, $width, $height );
                    $content = str_replace( $image, $image_tag, $content );
                }
            }
            # Return all image with dimensions set
            return $content;
        } );
    }
}
# Instantiate the class
new Fact_Maven_SID();