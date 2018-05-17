<?php

/**
 * SMOF Option filters
 *
 * @package     WordPress
 * @subpackage  SMOF
 * @since       1.4.0
 * @author      Jonah Dahlquist
 */

/**
 * Filter URLs from uploaded media fields and replaces them with keywords.
 * This is to keep from storing the site URL in the database to make
 * migrations easier.
 * 
 * @since 1.4.0
 * @param $data Options array
 * @return array
 */
function tvlgiao_wpdance_of_filter_save_media_upload($data) {

    if(!is_array($data)) return $data;
    
    foreach ($data as $key => $value) {
        if( $key == 'background_image' || $key == 'background_image_thumb' )
            continue;
        if (is_string($value)) {
            $data[$key] = str_replace(
                array(
                    site_url('', 'http'),
                    site_url('', 'https'),
                ),
                array(
                    '[site_url]',
                    '[site_url_secure]',
                ),
                $value
            );
        }
    }

    return $data;
}
add_filter('of_options_before_save', 'tvlgiao_wpdance_of_filter_save_media_upload');

/**
 * Filter URLs from uploaded media fields and replaces the site URL keywords
 * with the actual site URL.
 * 
 * @since 1.4.0
 * @param $data Options array
 * @return array
 */
function tvlgiao_wpdance_of_filter_load_media_upload($data) {
    
    if(!is_array($data)) return $data;

    foreach ($data as $key => $value) {
        if( $key == 'background_image' || $key == 'background_image_thumb' )
            continue;
        if (is_string($value)) {
            $data[$key] = str_replace(
                array(
                    '[site_url]', 
                    '[site_url_secure]',
                ),
                array(
                    site_url('', 'http'),
                    site_url('', 'https'),
                ),
                $value
            );
        }
    }

    return $data;
}
add_filter('of_options_after_load', 'tvlgiao_wpdance_of_filter_load_media_upload');