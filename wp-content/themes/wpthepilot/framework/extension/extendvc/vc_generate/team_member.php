<?php

// **********************************************************************// 

// ! Register New Element: WD Team

// **********************************************************************//

// ! File Security Check

if ( ! defined( 'ABSPATH' ) ) { exit; }

$_actived = apply_filters( 'active_plugins', get_option( 'active_plugins' )  );

if ( in_array( "wd_team/wd_team.php", $_actived ) ) {
	
	$query = new WP_Query( array( 'post_type' => 'team','post_status'		=> 'publish'
						,'posts_per_page'	=> -1 ) );
	global $post;
	$slug_arg = array();
	if($query->have_posts()) : 
		while($query->have_posts()) : $query->the_post();
			$name = esc_html(get_the_title($query->post->ID));
			$id = absint($query->post->ID);
			$slug_arg[$name] = $id;
		endwhile;
	endif;
	
	/// ! Team
	vc_map( array(
		"name" => esc_html__("Team member", 'wpnoone'),
		"base" => "team_member",
		"icon" => "icon-wpb-wpdance",
		"category" => "WPDance Elements",
		"params" => array(
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => esc_html__("Appearance",'wpnoone'),
				"admin_label" => true,
				"param_name" => "style",
				"value" => array(
					"Style 1" => "style1",
					"Style 2" => "style2",
					"Style 3" => "style3",
					"Style 4" => "style4",
					"Style 5" => "style5"
				),
				"description" => esc_html__("",'wpnoone')
			),
			
			// Column width
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => esc_html__("Member", 'wpnoone'),
				"param_name" => "id",
				"value" => $slug_arg,
				"admin_label" => true,
				"description" => esc_html__("Slug of Team member item", 'wpnoone')
			),


			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__("Width", 'wpnoone'),
				"param_name" => "width",
				"value" => "350"
			),


			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__("Height", 'wpnoone'),
				"param_name" => "height",
				"value" =>"350"
			)
		)
	) );
}
?>