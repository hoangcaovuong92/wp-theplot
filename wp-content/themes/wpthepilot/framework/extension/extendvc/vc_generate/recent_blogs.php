<?php

// **********************************************************************// 

// ! Register New Element: WD Recent Blogs

// **********************************************************************//

// ! File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

// **********************************************************************// 
// ! Register New Element: WD Recent Blogs
// **********************************************************************//
$categories = get_categories();
$list_categories = array(''=>'');
foreach($categories as $category ){
	$list_categories[$category->name] = $category->slug;
}
$recent_blogs_params = array(
	"name" => esc_html__("Recent Blogs", 'wpnoone'),
	"base" => "wd_recent_blogs",
	"icon" => "icon-wpb-wpdance",
	"category" => esc_html__('WPDance Elements', 'wpnoone'),
	"params" => array(
	
		// Heading
		/*array(
			"type" => "wd_taxonomy",
			"class" => "",
			"heading" => __("Category", 'wpnoone'),
			"admin_label" => true,
			"param_name" => "category",
			"value" => $list_categories,
			"description" => ''
		),*/
		array(
			"type" => "wd_taxonomy",
			"taxonomy" => "category",
			"class" => "",
			"heading" => esc_html__("Category", "wpnoone"),
			"admin_label" => true,
			"param_name" => "category",
			"value" => "",
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => esc_html__("Type", 'wpnoone'),
			"admin_label" => true,
			"param_name" => "show_type",
			"value" => array(
					'List' 		=> 'list-posts',
					'Widget' 	=> 'widget'
				),
			"description" => ''
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => esc_html__("Text Position", 'wpnoone'),
			"admin_label" => true,
			"param_name" => "text_position",
			"value" => array(
					'Left' 		=> 'left',
					'Right' 	=> 'right'
				),
			"dependency" => Array('element' => "show_type", 'value' => array('widget'))
		),	
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => esc_html__("Columns", 'wpnoone'),
			"admin_label" => true,
			"param_name" => "columns",
			"value" => '1',
			"dependency" => Array('element' => "show_type", 'value' => array('list-posts'))
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => esc_html__("Limit", 'wpnoone'),
			"admin_label" => true,
			"param_name" => "number_posts",
			"value" => '4',
			"description" => ''
		),
		
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => esc_html__("Show Thumbnail", 'wpnoone'),
			"admin_label" => true,
			"param_name" => "thumbnail",
			"value" => array(
					'Yes' => 'yes',
					'No' => 'no'
				),
			"description" => ''
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => esc_html__("Show Title", 'wpnoone'),
			"admin_label" => true,
			"param_name" => "title",
			"value" => array(
					'Yes' => 'yes',
					'No' => 'no'
				),
			"description" => ''
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => esc_html__("Show Post Meta", 'wpnoone'),
			"admin_label" => true,
			"param_name" => "meta",
			"value" => array(
					'Yes' => 'yes',
					'No' => 'no'
				),
			"description" => ''
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => esc_html__("Show Excerpt", 'wpnoone'),
			"admin_label" => true,
			"param_name" => "excerpt",
			"value" => array(
					'Yes' => 'yes',
					'No' => 'no'
				),
			"dependency" => Array('element' => "show_type", 'value' => array('list-posts'))
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => esc_html__("Show Read More", 'wpnoone'),
			"admin_label" => true,
			"param_name" => "read_more",
			"value" => array(
					'Yes' => 'yes',
					'No' => 'no'
				),
			"dependency" => Array('element' => "show_type", 'value' => array('list-posts'))
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => esc_html__("Show View More Post", 'wpnoone'),
			"admin_label" => true,
			"param_name" => "view_more",
			"value" => array(
					'Yes' => 'yes',
					'No' => 'no'
				),
			"dependency" => Array('element' => "show_type", 'value' => array('list-posts'))
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => esc_html__("Blog link", 'wpnoone'),
			"param_name" => "view_more_link",
			"value" => '',
			"dependency" => Array('element' => "view_more", 'value' => array('yes'))
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => esc_html__("Limit Excerpt Words", 'wpnoone'),
			"admin_label" => true,
			"param_name" => "excerpt_words",
			"value" => '30',
			"dependency" => Array('element' => "show_type", 'value' => array('list-posts'))
		),
		
	)
);
vc_map( $recent_blogs_params );
?>