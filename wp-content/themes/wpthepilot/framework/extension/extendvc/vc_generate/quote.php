<?php

// **********************************************************************// 

// ! Register New Element: WD Quote

// **********************************************************************//

// ! File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

// **********************************************************************// 
// ! Register New Element: WD Quote
// **********************************************************************//

$quote_params = array(
	"name" => esc_html__("Quote", 'wpnoone'),
	"base" => "wd_quote",
	"icon" => "icon-wpb-wpdance",
	"category" => esc_html__('WPDance Elements', 'wpnoone'),
	"params" => array(
	
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => esc_html__("Custom class", 'wpnoone'),
			"admin_label" => true,
			"param_name" => "class",
			"value" => '',
			"description" => '',
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => esc_html__("Style", 'wpnoone'),
			"admin_label" => true,
			"param_name" => "style",
			"value" => array(
				"Style 1" => "style1",
				"Style 2" => "style2"
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
vc_map( $quote_params );
?>