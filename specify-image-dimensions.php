<?php
/**
 * Plugin Name: Specify Image Dimensions
 * Plugin URI: https://wordpress.org/plugins/specify-image-dimensions/
 * Description: Automatically specify image dimensions that are missing width and/or height attributes. Helps with website speed tools.
 * Version: 1.1.0
 * Author: Fact Maven
 * Author URI: https://www.factmaven.com
 * License: GPLv3
*/

# If accessed directly, exit
if ( ! defined( 'ABSPATH' ) ) exit;

class Fact_Maven_Specify_Image_Dimensions {

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
            # Find all image tags
            preg_match_all( '/<img[^>]+>/i', $content, $images );
            # If there are no images, return
            if ( count( $images ) < 1 ) {
                return $content;
            }

            foreach ( $images[0] as $image ) {
                # Match all image attributes
                $attributes = 'src|srcset|longdesc|alt|class|id|usemap|align|border|hspace|vspace|crossorigin|ismap|sizes|width|height';
                preg_match_all( '/(' . $attributes . ')=("[^"]*")/i', $image, $img );
                # If image has a 'src', continue
                if ( ! in_array( 'src', $img[1] ) ) {
                    continue;
                }
                # If no 'width' or 'height' is available or blank, calculate dimensions
                if ( ! in_array( 'width', $img[1] ) || ! in_array( 'height', $img[1] ) || ( in_array( 'width', $img[1] ) && in_array( '""', $img[2] ) ) || ( in_array( 'height', $img[1] ) && in_array( '""', $img[2] ) ) ) {
                    # Split up string of attributes into variables
                    $attributes = explode( '|', $attributes );
                    foreach ( $attributes as $variable ) {
                        ${$variable} = in_array( $variable, $img[1] ) ? ' ' . $variable . '=' . $img[2][array_search( $variable, $img[1] )] : '';
                    }
                    $src = $img[2][array_search( 'src', $img[1] )];
                    # If image is an SVG/WebP with no dimensions, set specific dimensions
                    if ( preg_match( '/(.*).svg|.webp/i', $src ) ) {
                        if ( ! in_array( 'width', $img[1] ) || ! in_array( 'height', $img[1] ) || ( in_array( 'width', $img[1] ) && in_array( '""', $img[2] ) ) || ( in_array( 'height', $img[1] ) && in_array( '""', $img[2] ) ) ) {
                            $width = '100%';
                            $height = 'auto';
                        }
                    }
                    # Else, get accurate width and height attributes
                    else {
                        list( $width, $height ) = getimagesize( str_replace( "\"", "" , $src ) );
                    }
                    # Recreate the image tag with dimensions set
                    $tag = sprintf( '<img src=%s%s%s%s%s%s%s%s%s%s%s%s%s%s width="%s" height="%s">', $src, $srcset, $longdesc, $alt, $class, $id, $usemap, $align, $border, $hspace, $vspace, $crossorigin, $ismap, $sizes, $width, $height );
                    $content = str_replace( $image, $tag, $content );
                }
            }
            # Return all image with dimensions
            return $content;
        } );
    }
}
# Instantiate the class
new Fact_Maven_Specify_Image_Dimensions();