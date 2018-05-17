<?php
// ! File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }
// **********************************************************************// 
// ! Register New Element: WD Recent Products By Category Products
// **********************************************************************//
$woo_products_params = array(
	"name" => esc_html__("Products", 'wpnoone'),
	"base" => "simple_product",
	"icon" => "icon-wpb-woo",
	"category" => 'Woocommerce',
	"description"	=> '',
	"params" => array(		
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => esc_html__("IDs", 'wpnoone'),
			"admin_label" => true,
			"param_name" => "id",
			"value" => "",
			"description" => ''
		),
		// Columns
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => esc_html__("Columns", 'wpnoone'),
			"admin_label" => true,
			"param_name" => "columns",
			"value" => "4",
			"description" => ''
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => esc_html__("Order By", 'wpnoone'),
			"admin_label" => true,
			"param_name" => "orderby",
			"value" => array(
				"Date" => "date",
				"Title" => "title",
				"Rand" => "rand"
			),
			"description" => ''
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => esc_html__("Order way", 'wpnoone'),
			"param_name" => "order",
			"value" => array(
				"Descending" => "desc",
				"Ascending" => "asc"
			),
			"description" => esc_html__("Designates the ascending or descending order.", 'wpnoone')
		),
	)
);
vc_map( $woo_products_params );

// ! File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }
// **********************************************************************// 
// ! Register New Element: WD Recent Products By Category Products
// **********************************************************************//

$custom_product_by_category_params = array(
	"name" => esc_html__("WD Products Sales ", 'wpnoone'),
	"base" => "woo_product",
	"icon" => "icon-wpb-wpdance",
	"category" => esc_html__('WPDance Elements', 'wpnoone'),
	"description"	=> '',
	"params" => array(			
		
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
			"heading" => esc_html__("Position", "wpnoone"),
			"admin_label" => true,
			"param_name" => "show_position",
			"value" => array(
				"Left" => "left",
				"Right" => "right"
			),
			"description" => ""
		),
		
	)
);
vc_map( $custom_product_by_category_params );
?>