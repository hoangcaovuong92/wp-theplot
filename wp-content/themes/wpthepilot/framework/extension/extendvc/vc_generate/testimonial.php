<?php

// **********************************************************************// 

// ! Register New Element: WD Testimonial

// **********************************************************************//

// ! File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

// **********************************************************************// 
// ! Register New Element: WD Testimonial
// **********************************************************************//
$is_woo_testimonial = true;
$_random_id = 'testi'.rand(); 
$_actived = apply_filters( 'active_plugins', get_option( 'active_plugins' )  );
if ( !in_array( "testimonials-by-woothemes/woothemes-testimonials.php", $_actived ) ) {
	$is_woo_testimonial = false;
}

if( $is_woo_testimonial ){
	$testimonials = woothemes_get_testimonials(array('limit'=>-1, 'size' => 100));
	$list_testimonials = array();
	if(!empty($testimonials)) {
		foreach( $testimonials as $testimonial ){
			$list_testimonials[$testimonial->post_title] = $testimonial->ID;
		}
	}
	$testimonial_params = array(
		"name" => esc_html__("Testimonial", 'wpnoone'),
		"base" => "wd_testimonial",
		"icon" => "icon-wpb-wpdance",
		"category" => "WPDance Elements",
		"params" => array(
			
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__("Heading", "wpnoone"),
				"admin_label" => true,
				"param_name" => "title",
				"value" => "",
				"description" => "",
			),
			array(
			"type" => "wd_taxonomy",
			"taxonomy" => "testimonial-category",
			"class" => "",
			"heading" => esc_html__("Category Slug", 'wpnoone'),
			"admin_label" => true,
			"param_name" => "cat_test_slug",
			"value" => "",
			"description" => ''
		    ),			
			array(
				"type" => "dropdown",
				"heading" => esc_html__("Style", 'wpnoone'),
				"param_name" => "style",
				"value" => array(
					"Style 1"	=> 'style1',
					"Style 2"	=> 'style2',
					"Style 3"	=> 'style3',
					"Style 4"	=> 'style4',
					"Style 5"	=> 'style5'
				),
				"description" => '',
			),									
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => esc_html__("Testimonial", 'wpnoone'),
				"admin_label" => true,
				"param_name" => "id",
				"value" => $list_testimonials,
				"description" => '',
				"dependency" => Array('element' => "style", 'value' => array('style3','style5'))
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__("Limit", 'wpnoone'),
				"admin_label" => true,
				"param_name" => "limit",
				"value" => '3',
				"description" => '',
				"dependency" => Array('element' => "style", 'value' => array('style4'))
			),
			
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => esc_html__("Show Image", "wpnoone"),
				"admin_label" => true,
				"param_name" => "show_img",
				"value" => array(
					"Yes" => "1",
					"No" => "0"
				),
				"description" => ""
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => esc_html__("Show Meta Time", "wpnoone"),
				"admin_label" => true,
				"param_name" => "show_date",
				"value" => array(
					"Yes" => "1",
					"No" => "0"
				),
				"description" => ""
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => esc_html__("Show Short Content", "wpnoone"),
				"admin_label" => true,
				"param_name" => "show_short",
				"value" => array(
					"Yes" => "1",
					"No" => "0"
				),
				"description" => ""
			),
			
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__("Excerpt word number", 'wpnoone'),
				"admin_label" => true,
				"param_name" => "short_limit",
				"value" => "20",
				"description" => esc_html__("Limit number of Excerpt words", 'wpnoone')
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Show Nav", "wpnoone"),
				"admin_label" => true,
				"param_name" => "show_nav",
				"value" => array(
					"Yes" => "1",
					"No" => "0"
				),
				"description" => ""
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => esc_html__("Nav Position", 'wpnoone'),
				"admin_label" => true,
				"param_name" => "show_nav_pos",
				"value" => array(
					"Pos 1 (Top Right)" 	=> "top_right",
                    "Pos 2 (Middle center)" => "middle_center",
                    "Pos 3 (Bottom Center)" => "bottom_center",
				),
				"dependency" => Array('element' => "show_nav", 'value' => array('1'))
			),
			
		)
	);
	vc_map( $testimonial_params );
}
?>