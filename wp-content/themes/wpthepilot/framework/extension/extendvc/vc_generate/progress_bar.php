<?php

// **********************************************************************// 

// ! Register New Element: WD Progress Bar

// **********************************************************************//

// ! File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

// **********************************************************************// 
// ! Register New Element: WD Progress Bar
// **********************************************************************//

$progress_params = array(
	"name" => esc_html__("Progress Bar", 'wpnoone'),
	"base" => "wd_progress",
	"icon" => "icon-wpb-wpdance",
	"category" => esc_html__('WPDance Elements', 'wpnoone'),
	"params" => array(
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => esc_html__("Animation", 'wpnoone'),
			"admin_label" => true,
			"param_name" => "animated_bars",
			"value" => array(
					'Yes' => 'yes',
					'No' => 'no'
				),
			"description" => ''
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => esc_html__("Strip", 'wpnoone'),
			"admin_label" => true,
			"param_name" => "striped_bars",
			"value" => array(
					'Yes' => 'yes',
					'No' => 'no'
				),
			"description" => ''
		),
		
	)
);
vc_map( $progress_params );

?>