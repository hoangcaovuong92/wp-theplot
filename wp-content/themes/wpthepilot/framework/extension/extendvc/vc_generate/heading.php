<?php

// **********************************************************************// 

// ! Register New Element: WD Heading

// **********************************************************************//

// ! File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

// **********************************************************************// 
// ! Register New Element: WD Heading
// **********************************************************************//
$heading_params = array(
	"name" => esc_html__("Heading", 'wpnoone'),
	"base" => "wd_heading",
	"icon" => "icon-wpb-wpdance",
	"category" => esc_html__('WPDance Elements', 'wpnoone'),
	"params" => array(
	
		// Heading
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => esc_html__("Size", 'wpnoone'),
			"admin_label" => true,
			"param_name" => "size",
			"value" => array(
				"H1" => 'h1',
				"H2" => 'h2',
				"H3" => 'h3',
				"H4" => 'h4',
				"H5" => 'h5',
				"H6" => 'h6'
			),
			"description" => '',
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => esc_html__("Shown Icon", 'wpnoone'),
			"admin_label" => true,
			"param_name" => "shown_icon",
			"value" => array(
				"Yes" => '1',
				"No" => '0',
			),
			"description" => '',
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Icon library', 'wpnoone' ),
			'value' => array(
				esc_html__( 'Font Awesome', 'wpnoone' ) => 'fontawesome',
				esc_html__( 'Open Iconic', 'wpnoone' ) => 'openiconic',
				esc_html__( 'Typicons', 'wpnoone' ) => 'typicons',
				esc_html__( 'Entypo', 'wpnoone' ) => 'entypo',
				esc_html__( 'Linecons', 'wpnoone' ) => 'linecons',
			),
			'admin_label' => true,
			'param_name' => 'type',
			'description' => esc_html__( 'Select icon library.', 'wpnoone' ),
			"dependency" => Array('element' => "shown_icon", 'value' => array('1'))
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'wpnoone' ),
			'param_name' => 'icon_fontawesome',
			'value' => 'fa fa-adjust', // default value to backend editor admin_label
			'settings' => array(
				'emptyIcon' => false,
				// default true, display an "EMPTY" icon?
				'iconsPerPage' => 4000,
				// default 100, how many icons per/page to display, we use (big number) to display all icons in single page
			),
			'dependency' => array(
				'element' => 'type',
				'value' => 'fontawesome',
			),
			'description' => esc_html__( 'Select icon from library.', 'wpnoone' ),
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'wpnoone' ),
			'param_name' => 'icon_openiconic',
			'value' => 'vc-oi vc-oi-dial', // default value to backend editor admin_label
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'type' => 'openiconic',
				'iconsPerPage' => 4000, // default 100, how many icons per/page to display
			),
			'dependency' => array(
				'element' => 'type',
				'value' => 'openiconic',
			),
			'description' => esc_html__( 'Select icon from library.', 'wpnoone' ),
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'wpnoone' ),
			'param_name' => 'icon_typicons',
			'value' => 'typcn typcn-adjust-brightness', // default value to backend editor admin_label
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'type' => 'typicons',
				'iconsPerPage' => 4000, // default 100, how many icons per/page to display
			),
			'dependency' => array(
				'element' => 'type',
				'value' => 'typicons',
			),
			'description' => esc_html__( 'Select icon from library.', 'wpnoone' ),
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'wpnoone' ),
			'param_name' => 'icon_entypo',
			'value' => 'entypo-icon entypo-icon-note', // default value to backend editor admin_label
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'type' => 'entypo',
				'iconsPerPage' => 4000, // default 100, how many icons per/page to display
			),
			'dependency' => array(
				'element' => 'type',
				'value' => 'entypo',
			),
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'wpnoone' ),
			'param_name' => 'icon_linecons',
			'value' => 'vc_li vc_li-heart', // default value to backend editor admin_label
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'type' => 'linecons',
				'iconsPerPage' => 4000, // default 100, how many icons per/page to display
			),
			'dependency' => array(
				'element' => 'type',
				'value' => 'linecons',
			),
			'description' => esc_html__( 'Select icon from library.', 'wpnoone' ),
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => esc_html__("Style", 'wpnoone'),
			"admin_label" => true,
			"param_name" => "style",
			"value" => array(
				"Style 1" => "style1",
				"Style 2" => "style2",
				"Style 3" => "style3",
				"Style 4" => "style4"
			),
			"description" => '',
		),
		array(
			"type" => "textarea_html",
			"class" => "",
			"heading" => esc_html__("Content", 'wpnoone'),
			"admin_label" => true,
			"param_name" => "content",
			"value" => "",
			"description" => '',
		),
	)
);
vc_map( $heading_params );
?>