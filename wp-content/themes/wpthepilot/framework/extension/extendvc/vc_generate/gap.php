<?php
// **********************************************************************// 
// ! Register New Element: Gap
// **********************************************************************//
vc_map( array(
	"name" => esc_html__("WD Gap", 'wpnoone'),
	"base" => "wd_gap",
	"icon" => "icon-wpb-wpdance",
	"category" => esc_html__('WPDance Elements', 'wpnoone'),
	"params" => array(
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => esc_html__("Gap height", 'wpnoone'),
			"admin_label" => true,
			"param_name" => "height",
			"value" => "10",
			"description" => esc_html__("In pixels.", 'wpnoone')
		)
	)
) );
?>