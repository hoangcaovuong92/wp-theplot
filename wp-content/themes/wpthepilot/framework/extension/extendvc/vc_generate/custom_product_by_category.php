<?php
// ! File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }
// **********************************************************************// 
// ! Register New Element: WD Recent Products By Category Products
// **********************************************************************//

$custom_product_by_category_params = array(
	"name" => esc_html__("WD Custom Products by Category", 'wpnoone'),
	"base" => "custom_product_by_category",
	"icon" => "icon-wpb-wpdance",
	"category" => esc_html__('WPDance Elements', 'wpnoone'),
	"description"	=> '',
	"params" => array(			
	// Title
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => esc_html__("Heading", 'wpnoone'),
			"admin_label" => true,
			"param_name" => "title",
			"value" => "",
			"description" => ''
		),
		
		// Per page
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => esc_html__("Limit", 'wpnoone'),
			"admin_label" => true,
			"param_name" => "per_page",
			"value" => "10",
			"description" => esc_html__("Limit number of products", 'wpnoone')
		),
		
		array(
			"type" => "wd_taxonomy",
			"taxonomy" => "product_cat",
			"class" => "",
			"heading" => esc_html__("Category Slug", 'wpnoone'),
			"admin_label" => true,
			"param_name" => "cat_slug",
			"value" => "",
			"description" => ''
		),
		
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => esc_html__("Show Category Name", "wpnoone"),
			"admin_label" => true,
			"param_name" => "show_cat_title",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => ""
		),
		
	)
);
vc_map( $custom_product_by_category_params );
?>