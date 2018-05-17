<?php
// ! File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

// **********************************************************************// 

// ! Register New Element: WD Specific Product

// **********************************************************************//

$specipic_product_params = array(
	"name" => esc_html__("WD Banner", 'wpnoone'),
	"base" => "banner",
	"icon" => "icon-wpb-wpdance-banner",
	"category" => esc_html__('WPDance Elements', 'wpnoone'),
	"params" => array(
	
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => esc_html__("Link", 'wpnoone'),
			"param_name" => "link_url",
			"value" => "#",
			"description" => '',
		),
		
		array(
			"type" => "colorpicker",
			"class" => "",
			"heading" => esc_html__("Background color", 'wpnoone'),
			"param_name" => "bg_color",
			"value" => "#cccccc",
			"description" => '',
		),
		
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => esc_html__("Background Image", 'wpnoone'),
			"param_name" => "bg_image",
			"value" => "",
			"description" => '',
		),
		
		array(
			"type" => "textarea_html",
			"class" => "",
			"heading" => esc_html__("Content", 'wpnoone'),
			"param_name" => "content",
			"value" => "",
			"description" => '',
		),				
		
		
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => esc_html__("Caption Position", 'wpnoone'),
			"admin_label" => true,
			"param_name" => "caption_pos",
			"value" => array(
				"Middle Center" => 'mid_center',
				"Middle Left" => 'mid_left',
				"Middle Right" => 'mid_right',
				"Top Left" => 'top_left',
				"Top Right" => 'top_right',
				"Top Center" => 'top_center',
				"Bottom Center" => 'bot_center',
				"Bottom Left" => 'bot_left',
				"Bottom Right" => 'bot_right'
			),
			"description" => '',
		),
		
		
	)
);
vc_map( $specipic_product_params );
?>