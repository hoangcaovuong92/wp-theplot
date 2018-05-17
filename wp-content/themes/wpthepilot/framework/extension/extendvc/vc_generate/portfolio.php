<?php

// **********************************************************************// 

// ! Register New Element: WD Portfolio

// **********************************************************************//

// ! File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

// **********************************************************************// 
// ! Register New Element: WD Portfolio
// **********************************************************************//
if( class_exists('WD_Portfolio') ){
	
	$portfolio_params = array(
		"name" => esc_html__("Portfolio", 'wpnoone'),
		"base" => "wd-portfolio",
		"icon" => "icon-wpb-wpdance",
		"category" => esc_html__('WPDance Elements', 'wpnoone'),
		"params" => array(
		
			// Heading
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__("Columns", 'wpnoone'),
				"admin_label" => true,
				"param_name" => "columns",
				"value" => '4',
				"description" => '',
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => esc_html__("Style", 'wpnoone'),
				"admin_label" => true,
				"param_name" => "portf_style",
				"value" => array(
						'Style 1' => 'style1',
						'Style 2' => 'style2',
						'Style 3' => 'style3',
						'Style 4' => 'style4',
						'Style 5' => 'style5'
					),
				"description" => ''
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => esc_html__("Show Filter", 'wpnoone'),
				"admin_label" => true,
				"param_name" => "show_filter",
				"value" => array(
						'Yes' => 'yes',
						'No' => 'no'
					)
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => esc_html__("Show Title", 'wpnoone'),
				"admin_label" => true,
				"param_name" => "show_title",
				"value" => array(
						'Yes' => 'yes',
						'No' => 'no'
					)
				
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => esc_html__("Show Description", 'wpnoone'),
				"admin_label" => true,
				"param_name" => "show_desc",
				"value" => array(
						'Yes' => 'yes',
						'No' => 'no'
					)
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__("Limit", 'wpnoone'),
				"admin_label" => true,
				"param_name" => "count",
				"value" => '-1',
				"description" => ''
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => esc_html__("Show Page", 'wpnoone'),
				"admin_label" => true,
				"param_name" => "show_pages",
				"value" => array(
						'Yes' => 'yes',
						'No' => 'no'
					)
				
			),
		)
	);
	vc_map( $portfolio_params );
}
?>