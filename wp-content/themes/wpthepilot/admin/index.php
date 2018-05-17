<?php
/*
Title		: SMOF
Description	: Slightly Modified Options Framework
Version		: 1.5.2
Author		: Syamil MJ
Author URI	: http://aquagraphite.com
License		: GPLv3 - http://www.gnu.org/copyleft/gpl.html

Credits		: Thematic Options Panel - http://wptheming.com/2010/11/thematic-options-panel-v2/
		 	  Woo Themes - http://woothemes.com/
		 	  Option Tree - http://wordpress.org/extend/plugins/option-tree/

Contributors: Syamil MJ - http://aquagraphite.com
			  Andrei Surdu - http://smartik.ws/
			  Jonah Dahlquist - http://nucleussystems.com/
			  partnuz - https://github.com/partnuz
			  Alex Poslavsky - https://github.com/plovs
			  Dovy Paukstys - http://simplerain.com
*/

define( 'SMOF_VERSION', '1.5.2' );

/**
 * Definitions
 *
 * @since 1.4.0
 */
$theme_version = '';
$smof_output = '';
	    
if( function_exists( 'wp_get_theme' ) ) {
	if( is_child_theme() ) {
		$temp_obj = wp_get_theme();
		$theme_obj = wp_get_theme( $temp_obj->get('Template') );
	} else {
		$theme_obj = wp_get_theme();    
	}

	$theme_version = $theme_obj->get('Version');
	$theme_name = $theme_obj->get('Name');
	$theme_uri = $theme_obj->get('ThemeURI');
	$author_uri = $theme_obj->get('AuthorURI');
} else {
	$theme_data = wp_get_theme( get_template_directory().'/style.css' );
	$theme_version = $theme_data['Version'];
	$theme_name = $theme_data['Name'];
	$theme_uri = $theme_data['ThemeURI'];
	$author_uri = $theme_data['AuthorURI'];
}



if( !defined('TVLGiao_Wpdance_ADMIN_PATH') )
	define( 'TVLGiao_Wpdance_ADMIN_PATH', get_template_directory() . '/admin/' );
if( !defined('TVLGiao_Wpdance_ADMIN_DIR') )
	define( 'TVLGiao_Wpdance_ADMIN_DIR', get_template_directory_uri() . '/admin/' );

define( 'TVLGiao_Wpdance_ADMIN_IMAGES', TVLGiao_Wpdance_ADMIN_DIR . 'assets/images/' );
define( 'TVLGiao_Wpdance_XML_DIR', get_template_directory_uri() . '/config_xml/' );
define( 'TVLGiao_Wpdance_XML_PATH', get_template_directory() . '/config_xml/' );

define( 'TVLGiao_Wpdance_LAYOUT_PATH', TVLGiao_Wpdance_ADMIN_PATH . 'layouts/' );
define( 'TVLGiao_Wpdance_THEMENAME', $theme_name );
/* Theme version, uri, and the author uri are not completely necessary, but may be helpful in adding functionality */
define( 'TVLGiao_Wpdance_THEMEVERSION', $theme_version );
define( 'TVLGiao_Wpdance_BACKUPS','backups' );

/**
 * Required action filters
 *
 * @uses add_action()
 *
 * @since 1.0.0
 */
//if (is_admin() && isset($_GET['activated'] ) && $pagenow == "themes.php" ) add_action('admin_head','of_option_setup');
if (is_admin() && isset($_GET['activated'] ) && $pagenow == "themes.php" ) add_action('admin_head','tvlgiao_wpdance_wd_of_option_setup');
add_action('admin_head', 'optionsframework_admin_message');
add_action('admin_init','optionsframework_admin_init');
add_action('admin_menu', 'optionsframework_add_admin');

/**
 * Required Files
 *
 * @since 1.0.0
 */ 
require_once get_template_directory()."/admin/functions/functions.load.php";
require_once get_template_directory()."/admin/classes/class.options_machine.php";
/**
 * AJAX Saving Options
 *
 * @since 1.0.0
 */
add_action('wp_ajax_of_ajax_post_action', 'tvlgiao_wpdance_of_ajax_callback');
