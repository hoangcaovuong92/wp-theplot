<?php
// **********************************************************************// 
// ! Register New Element:Pricing Table
// **********************************************************************//
$ptable_params = array(
	"name" => esc_html__("Pricing Table", 'wpnoone'),
	"base" => "wd_ptable",
	"icon" => "icon-wpb-wpdance",
	"category" => esc_html__('WPDance Elements', 'wpnoone'),
	"allowed_container_element" => 'vc_row',
	"params" => array(
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => esc_html__("Title", 'wpnoone'),
			"param_name" => "title",
			"value" => esc_html__("Basic Plan", 'wpnoone'),
			"description" => ""
		),
		array(
				"type" => "dropdown",
				"class" => "",
				"heading" => esc_html__("Style", 'wpnoone'),
				"admin_label" => true,
				"param_name" => "pricing_style",
				"value" => array(
						'Style 1' => 'style1',
						'Style 2' => 'style2',
						'Style 3' => 'style3'
					),
				"description" => ''
			),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => esc_html__("Price", 'wpnoone'),
			"param_name" => "price",
			"description" => ""
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => esc_html__("Currency", 'wpnoone'),
			"param_name" => "currency",
			"description" => ""
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => esc_html__("Price Period", 'wpnoone'),
			"param_name" => "price_period",
			"description" => ""
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => esc_html__("Link", 'wpnoone'),
			"param_name" => "link",
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"holder" => "div",
			"class" => "",
			"heading" => esc_html__("Target", 'wpnoone'),
			"param_name" => "target",
			"value" => array(
				"" => "",
				"Self" => "_self",
				"Blank" => "_blank",	
				"Parent" => "_parent"
			),
			"description" => ""
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => esc_html__("Button Text", 'wpnoone'),
			"param_name" => "button_text",
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"holder" => "div",
			"class" => "",
			"heading" => esc_html__("Active", 'wpnoone'),
			"param_name" => "active",
			"value" => array(
				"No" => "no",
				"Yes" => "yes"	
			),
			"description" => ""
		),
		array(
			"type" => "textarea_html",
			"holder" => "div",
			"class" => "",
			"heading" => esc_html__("Content", 'wpnoone'),
			"param_name" => "content",
			"value" => "Lorem ipsum dolor sit amet, consectetur adipisicing elit.",
			"description" => ""
		)
	)
);
vc_map($ptable_params);
?>