<?php

// **********************************************************************// 

// ! Register New Element: WD Button

// **********************************************************************//

// ! File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

// **********************************************************************// 
// ! Register New Element: WD Button
// **********************************************************************//

$button_params = array(
	"name" => esc_html__("Button", 'wpnoone'),
	"base" => "wd_button",
	"icon" => "icon-wpb-wpdance",
	"category" => esc_html__('WPDance Elements', 'wpnoone'),
	"params" => array(
	
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => esc_html__("Font size", 'wpnoone'),
			"admin_label" => true,
			"param_name" => "font_size",
			"value" => '14',
			"description" => esc_html__("In Pixels. Text font size", 'wpnoone'),
		),
		array(
			"type" => "colorpicker",
			"class" => "",
			"heading" => esc_html__("Text Color", 'wpnoone'),
			"admin_label" => true,
			"param_name" => "color",
			"value" => '',
			"description" => ''
		),
		array(
			"type" => "colorpicker",
			"class" => "",
			"heading" => esc_html__("Text Color On Hover", 'wpnoone'),
			"admin_label" => true,
			"param_name" => "color_hover",
			"value" => '',
			"description" => ''
		),
		array(
			"type" => "colorpicker",
			"class" => "",
			"heading" => esc_html__("Background Color", 'wpnoone'),
			"admin_label" => true,
			"param_name" => "bg_color",
			"value" => '',
			"description" => ''
		),
		array(
			"type" => "colorpicker",
			"class" => "",
			"heading" => esc_html__("Background Color On Hover", 'wpnoone'),
			"admin_label" => true,
			"param_name" => "bg_color_hover",
			"value" => '',
			"description" => ''
		),
		
		array(
			"type" => "colorpicker",
			"class" => "",
			"heading" => esc_html__("Border Color", 'wpnoone'),
			"admin_label" => true,
			"param_name" => "border_color",
			"value" => '',
			"description" => ''
		),
		array(
			"type" => "colorpicker",
			"class" => "",
			"heading" => esc_html__("Border Color On Hover", 'wpnoone'),
			"admin_label" => true,
			"param_name" => "border_color_hover",
			"value" => '',
			"description" => ''
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => esc_html__("Border Width", 'wpnoone'),
			"admin_label" => true,
			"param_name" => "border_width",
			"value" => '0',
			"description" => ''
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => esc_html__("Border radius", 'wpnoone'),
			"admin_label" => true,
			"param_name" => "border_radius",
			"value" => '',
			"description" => '',
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => esc_html__("Margin", 'wpnoone'),
			"admin_label" => true,
			"param_name" => "margin",
			"value" => '',
			"description" => '',
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => esc_html__("Padding", 'wpnoone'),
			"admin_label" => true,
			"param_name" => "padding",
			"value" => '',
			"description" => '',
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => esc_html__("Link", 'wpnoone'),
			"admin_label" => true,
			"param_name" => "link",
			"value" => '',
			"description" => __("Input URL you want it to link to", 'wpnoone'),
		),
		
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => esc_html__("Opacity", 'wpnoone'),
			"admin_label" => true,
			"param_name" => "opacity",
			"value" => '100',
			"description" => esc_html__("Input Opacity Number. Min: 0, Max: 100", 'wpnoone')
		),
		
		array(
			"type" => "textarea",
			"holder" => "div",
			"class" => "",
			"heading" => esc_html__("Button Text", 'wpnoone'),
			"admin_label" => true,
			"param_name" => "content",
			"value" => "",
			"description" => '',
		),
		
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => esc_html__("Custom Class", 'wpnoone'),
			"admin_label" => true,
			"param_name" => "custom_class",
			"value" => '',
			"description" => '',
		),
		
	)
);
vc_map( $button_params );
?>