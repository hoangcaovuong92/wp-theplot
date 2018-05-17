<?php 
/*
	Generate theme control.
	Input : 
		- int $num_pages_per_phrase : the number of page per group.
	No output.
*/


add_action( 'template_redirect', 'tvlgiao_wpdance_my_page_template_redirect' );
function tvlgiao_wpdance_my_page_template_redirect(){
	global $wp_query,$post,$tvlgiao_wpdance_page_datas,$tvlgiao_wpdance_wd_data;
	$tvlgiao_wpdance_wd_data['wd_layout_style'] = (isset($tvlgiao_wpdance_wd_data['wd_layout_styles']) ? $tvlgiao_wpdance_wd_data['wd_layout_styles'] : 'wide' ) ;
	$tvlgiao_wpdance_wd_data['wd_layout_header'] =(isset($tvlgiao_wpdance_wd_data['wd_header_styles']) ? $tvlgiao_wpdance_wd_data['wd_header_styles'] : 'wide' ) ;
	$tvlgiao_wpdance_wd_data['wd_layout_main_content'] = (isset($tvlgiao_wpdance_wd_data['wd_maincontent_styles']) ? $tvlgiao_wpdance_wd_data['wd_maincontent_styles'] : 'wide' );
	$tvlgiao_wpdance_wd_data['wd_layout_footer'] = (isset($tvlgiao_wpdance_wd_data['wd_footer_styles']) ? $tvlgiao_wpdance_wd_data['wd_footer_styles'] : 'wide' );
	
	
	if($wp_query->is_page()){
		global $tvlgiao_wpdance_page_datas,$wd_custom_style_config,$tvlgiao_wpdance_wd_data;
		$tvlgiao_wpdance_page_datas = unserialize(get_post_meta($post->ID,TVLGiao_Wpdance_THEME_SLUG.'page_configuration',true));
		$tvlgiao_wpdance_page_datas = tvlgiao_wd_array_atts(array(	
											"header_style"			=> '0'
											,"page_column" 			=> '0-1-0'
											,"left_sidebar" 		=> 'primary-widget-area'
											,"right_sidebar" 		=> 'primary-widget-area'
											,"page_slider" 			=> 'none'
                                            ,"page_slider_pos" 		=> 'after_header'
											,"page_revolution" 		=> ''
											,"page_layerslider"		=> ''
											,"page_flex" 			=> ''
											,"page_nivo" 			=> ''		
											,"product_tag"			=> ''
											,"hide_breadcrumb" 		=> 0		
											,"hide_title" 			=> 0										
											,"hide_top_content" 	=> 1											
										),$tvlgiao_wpdance_page_datas);				
	}
	
	if(is_single()){
		global $tvlgiao_wpdance_wd_data,$post;
		/******************* Start Load Config On Single Post ******************/
		$_post_config = get_post_meta($post->ID,TVLGiao_Wpdance_THEME_SLUG.'custom_post_config',true);
		
		if( strlen($_post_config) > 0 ){
			$_post_config = unserialize($_post_config);
			
			if( is_array($_post_config) && count($_post_config) > 0 ){
				$tvlgiao_wpdance_wd_data['wd_post_layout'] = ( isset($_post_config['layout']) && strlen($_post_config['layout']) > 0 && strcmp($_post_config["layout"],'0') != 0 ) ? $_post_config['layout'] : $tvlgiao_wpdance_wd_data['wd_post_layout'];
				$tvlgiao_wpdance_wd_data['wd_post_left_sidebar'] = ( isset($_post_config['left_sidebar']) && strlen($_post_config['left_sidebar']) > 0 && strcmp($_post_config["left_sidebar"],'0') != 0 ) ? $_post_config['left_sidebar'] : $tvlgiao_wpdance_wd_data['wd_post_left_sidebar'];
				$tvlgiao_wpdance_wd_data['wd_post_right_sidebar'] = ( isset($_post_config['right_sidebar']) && strlen($_post_config['right_sidebar']) > 0 && strcmp($_post_config["right_sidebar"],'0') != 0 ) ? $_post_config['right_sidebar'] : $tvlgiao_wpdance_wd_data['wd_post_right_sidebar'];
				if( ( strcmp( trim($_post_config['left_sidebar']),"0" ) != 0 || strcmp( trim($_post_config['right_sidebar']),"0" ) != 0 ) && strcmp($tvlgiao_wpdance_wd_data['wd_prod_layout'],'0-1-0') != 0 ){
				}
			}
		}	
	}
	
	
	if( is_tax( 'product_cat' ) ){
		global $wp_query,$category_prod_datas;
		$term = $wp_query->queried_object;
		
		$_term_config = get_metadata( 'woocommerce_term', $term->term_id, "cat_config", true );
		
		
		if( strlen($_term_config) > 0 ){
			$_term_config = unserialize($_term_config);	
			
			if( is_array($_term_config) && count($_term_config) > 0 ){
				$tvlgiao_wpdance_wd_data['wd_prod_cat_column'] = ( isset($_term_config['cat_columns']) && strlen($_term_config['cat_columns']) > 0 && (int)$_term_config['cat_columns'] != 0 ) ? $_term_config['cat_columns'] : $tvlgiao_wpdance_wd_data['wd_prod_cat_column'];
				$tvlgiao_wpdance_wd_data['wd_prod_cat_layout'] = ( isset($_term_config['cat_layout']) && strlen($_term_config['cat_layout']) > 0 && strcmp($_term_config["cat_layout"],'0') != 0 ) ? $_term_config['cat_layout'] : $tvlgiao_wpdance_wd_data['wd_prod_cat_layout'];
				$tvlgiao_wpdance_wd_data['wd_prod_cat_left_sidebar'] = ( isset($_term_config['cat_left_sidebar']) && strlen($_term_config['cat_left_sidebar']) > 0 && strcmp($_term_config["cat_left_sidebar"],'0') != 0 ) ? $_term_config['cat_left_sidebar'] : $tvlgiao_wpdance_wd_data['wd_prod_cat_left_sidebar'];
				$tvlgiao_wpdance_wd_data['wd_prod_cat_right_sidebar'] = ( isset($_term_config['cat_right_sidebar']) && strlen($_term_config['cat_right_sidebar']) > 0 && strcmp($_term_config["cat_right_sidebar"],'0') != 0 ) ? $_term_config['cat_right_sidebar'] : $tvlgiao_wpdance_wd_data['wd_prod_cat_right_sidebar'];
				$tvlgiao_wpdance_wd_data['wd_prod_cat_custom_content'] = ( isset($_term_config['cat_custom_content']) && strlen($_term_config['cat_custom_content']) > 0 ) ? $_term_config['cat_custom_content'] : '';
			}
			
		}
		
			
	}
	
	if(isset($tvlgiao_wpdance_wd_data['wd_prod_button_style']) && absint($tvlgiao_wpdance_wd_data['wd_prod_button_style'])) {
		remove_action( 'wd_woocommerce_shop_loop_buttons', 'tvlgiao_wpdance_wd_list_template_loop_add_to_cart', 14 );
	}
	
	if ( is_singular('product') ) {
		global $tvlgiao_wpdance_wd_data,$post;
		/******************* Start Load Config On Single Post ******************/
		$_prod_config = get_post_meta($post->ID,TVLGiao_Wpdance_THEME_SLUG.'custom_product_config',true);
		
		if( strlen($_prod_config) > 0 ){
			$_prod_config = unserialize($_prod_config);
			
			if( is_array($_prod_config) && count($_prod_config) > 0 ){
				
				$tvlgiao_wpdance_wd_data['wd_prod_layout'] = ( isset($_prod_config['layout']) && strlen($_prod_config['layout']) > 0 && strcmp($_prod_config["layout"],'0') != 0 ) ? $_prod_config['layout'] : $tvlgiao_wpdance_wd_data['wd_prod_layout'];
				$tvlgiao_wpdance_wd_data['wd_prod_left_sidebar'] = ( isset($_prod_config['left_sidebar']) && strlen($_prod_config['left_sidebar']) > 0 && strcmp($_prod_config["left_sidebar"],'0') != 0 ) ? $_prod_config['left_sidebar'] : $tvlgiao_wpdance_wd_data['wd_prod_left_sidebar'];
				$tvlgiao_wpdance_wd_data['wd_prod_right_sidebar'] = ( isset($_prod_config['right_sidebar']) && strlen($_prod_config['right_sidebar']) > 0 && strcmp($_prod_config["right_sidebar"],'0') != 0 ) ? $_prod_config['right_sidebar'] : $tvlgiao_wpdance_wd_data['wd_prod_right_sidebar'];
				if( ( strcmp( trim($_prod_config['left_sidebar']),"0" ) != 0 || strcmp( trim($_prod_config['right_sidebar']),"0" ) != 0 ) && strcmp($tvlgiao_wpdance_wd_data['wd_prod_layout'],'0-1-0') != 0 ){
					//we should replace the sidebar on product page if product have at least 1 sidebar
//					add_action( 'get_header',  'wd_init_sidebar_replacement' );
				}
				
			}
		}			
		
		/******************* End Config On Single Post ******************/

		
		if( !$tvlgiao_wpdance_wd_data['wd_prod_image']  )	
			remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );
		
		if( !$tvlgiao_wpdance_wd_data['wd_prod_price'] )	
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price',13 );
		
		if( !$tvlgiao_wpdance_wd_data['wd_prod_sku'] )
			remove_action( 'woocommerce_single_product_summary', 'tvlgiao_wpdance_wd_template_single_sku', 17 );
			
		if( !$tvlgiao_wpdance_wd_data['wd_prod_available'] )
			remove_action( 'woocommerce_single_product_summary', 'tvlgiao_wpdance_wd_template_single_availability', 19 );
		
		if( !$tvlgiao_wpdance_wd_data['wd_prod_review']  )	
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 14 );
			
		if( !$tvlgiao_wpdance_wd_data['wd_prod_share'] )	
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 14 );
		
		if( !$tvlgiao_wpdance_wd_data['wd_prod_shortdesc'] )	
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
		
		if( !$tvlgiao_wpdance_wd_data['wd_prod_cart']){			
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
			
			remove_action( 'woocommerce_simple_add_to_cart', 'woocommerce_simple_add_to_cart', 30 );
			remove_action( 'woocommerce_grouped_add_to_cart', 'woocommerce_grouped_add_to_cart', 30 );
			remove_action( 'woocommerce_variable_add_to_cart', 'woocommerce_variable_add_to_cart', 30 );
			remove_action( 'woocommerce_external_add_to_cart', 'woocommerce_external_add_to_cart', 30 );
		}

		
		if( !$tvlgiao_wpdance_wd_data['wd_prod_meta'] )	{
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
		}
		
		if( !$tvlgiao_wpdance_wd_data['wd_prod_related']){	
			remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
			add_filter( "single_product_wrapper_class", "tvlgiao_wpdance_update_single_product_wrapper_class", 10);
		}else{
			global $post;
			$_product = wc_get_product($post);
			if ( sizeof( wc_get_related_products($_product->get_id()) ) == 0 )
				add_filter( "single_product_wrapper_class", "tvlgiao_wpdance_update_single_product_wrapper_class", 10);
		}

		
		if( !$tvlgiao_wpdance_wd_data['wd_prod_ship_return'] )	
			remove_action( 'woocommerce_product_thumbnails', 'tvlgiao_wpdance_wd_template_shipping_return', 30 );

		if( !$tvlgiao_wpdance_wd_data['wd_prod_tabs'] )	
			remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
			
		if( !$tvlgiao_wpdance_wd_data['wd_prod_customtab'] ){
			remove_filter( 'woocommerce_product_tabs', 'tvlgiao_wpdance_wd_addon_custom_tabs',13 );
		}		

		if( isset($tvlgiao_wpdance_wd_data['wd_prod_upsell']) && !$tvlgiao_wpdance_wd_data['wd_prod_upsell']  )	
			remove_action( 'woocommerce_after_single_product_summary', 'tvlgiao_wpdance_wd_upsell_display', 15 );
		
		
	
	}
	if($tvlgiao_wpdance_wd_data['wd_catelog_mod'] == 0){	
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
		remove_action( 'woocommerce_simple_add_to_cart', 'woocommerce_simple_add_to_cart', 30 );
		remove_action( 'woocommerce_grouped_add_to_cart', 'woocommerce_grouped_add_to_cart', 30 );
		remove_action( 'woocommerce_variable_add_to_cart', 'woocommerce_variable_add_to_cart', 30 );
		remove_action( 'woocommerce_external_add_to_cart', 'woocommerce_external_add_to_cart', 30 );
		
		remove_action( 'woocommerce_after_shop_loop_item', 'tvlgiao_wpdance_wd_list_template_loop_add_to_cart', 8 );
		//add to cart ajax
		remove_action( 'woocommerce_after_shop_loop_item_title', 'tvlgiao_wpdance_wd_list_template_loop_add_to_cart', 10 );
		remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );; 
		remove_action( 'wd_quickshop_single_product_summary', 'woocommerce_template_single_add_to_cart', 11 );  	
	}
}



/**************************important hook**************************/

add_action ('pre_get_posts','tvlgiao_wpdance_prepare_post_query',9); //hook into pre_get_posts to reset some querys

/*merge query post type function*/

function tvlgiao_wpdance_merge_post_type($query,$new_type = array()){
	$defaut_post_type = ( post_type_exists( 'portfolio' ) ? array('portfolio','post') : array('post') );
	$new_type = (is_array($new_type) && count($new_type) > 0) ? $new_type : $defaut_post_type;
	$default_post_type = $query->get('post_type');
	if(is_array($default_post_type)){
		$new_type = array_merge($default_post_type, $new_type);
	}else{
		$new_type = array_merge(array($default_post_type), $new_type);
	}
	return ( $new_type = array_unique($new_type) );
}
/*end merge query post type function*/

function tvlgiao_wpdance_remove_page_from_search_query($where_query){
	global $wpdb;
	$where_query .= " AND ".$wpdb->prefix."posts.post_type NOT IN ('page') ";
	return $where_query;
}
function tvlgiao_wpdance_prepare_post_query($query){
	
	global $tvlgiao_wpdance_page_datas,$post;
	$paged = (int)get_query_var('paged');
		
	
	if($paged>0){
		set_query_var('page',$paged);
	}
	if($query->is_tag()){
		$query->set('post_type',tvlgiao_wpdance_merge_post_type($query) );
	}
	if($query->is_search()){	
		add_action( "posts_where", "tvlgiao_wpdance_remove_page_from_search_query", 10 );
	}	
	if($query->is_date()){
		$query->set('post_type',tvlgiao_wpdance_merge_post_type($query) );
	}

	if($query->is_author()){
		$query->set('post_type',tvlgiao_wpdance_merge_post_type($query) );
	}
	if($query->is_archive){
		if(isset($_GET['term']) && $_GET['term']=="" && isset($_GET['s']) && $_GET['s']=="" && isset($_GET['taxonomy']))
			$query->query_vars['taxonomy'] = "";
	}
	return $query;
	
}
/**************************end the hook**************************/


if( !function_exists('tvlgiao_wpdance_wd_is_woocommerce') ){
	function tvlgiao_wpdance_wd_is_woocommerce(){
		if( in_array( "woocommerce/woocommerce.php", apply_filters( 'active_plugins', get_option( 'active_plugins' )  ) ) ){
			return true;
		}
		return false;
	}
}


?>