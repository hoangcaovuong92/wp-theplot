<?php 
class TvlgiaoWpdanceNoOneCustomFields extends TvlgiaoWpdanceNoOneAdminTheme 
{
	public function __construct(){
		add_action("admin_init", array($this,"tvlgiao_wpdance_generateCustomFields"));
		add_action('save_post', array($this,'tvlgiao_wpdance_saveCustomField'));
		$this->tvlgiao_wpdance_resetArrLayout();
	}
	
	
	public function tvlgiao_wpdance_generateCustomFields(){
		// Add shortcode Generator

		add_meta_box("page_config", "Page Configuration", array($this,"tvlgiao_wpdance_page_configuration"), "page", "normal", "high");		
		
		if(post_type_exists('product')) {
			add_meta_box("wp_cp_custom_product_layout", "Config Product", array($this,"tvlgiao_wpdance_product_layout"), "product", "normal", "high");
		}	
		if(post_type_exists('product')) {
			add_meta_box("wp_cp_custom_product_ads_sidebar", "WD Additional Product Information", array($this,"tvlgiao_wpdance_product_ads_sidebar"), "product", "normal", "high");
		}
		
		
		add_meta_box("wp_cp_custom_post_layout", "Config Post", array($this,"tvlgiao_wpdance_post_layout"), "post", "normal", "high");
		add_meta_box("post_gallery", "Gallery", array($this,"tvlgiao_wpdance_post_gallery"), "post", "side", "low");
	}
	
	public function tvlgiao_wpdance_product_ads_sidebar(){
		require_once get_template_directory().'/framework/includes/metaboxes/custom_ads_sidebar.php';
	}
	
	public function tvlgiao_wpdance_product_layout(){
		require_once get_template_directory().'/framework/includes/metaboxes/custom_layout.php';
	}
	
	public function tvlgiao_wpdance_post_layout(){
		require_once get_template_directory().'/framework/includes/metaboxes/custom_post_layout.php';
	}
	public function tvlgiao_wpdance_post_gallery(){
		require_once get_template_directory().'/framework/includes/metaboxes/post_gallery.php';
	}
	/* 
		Save config of custom fields for current post
		Input : int $post_id (the id of current post).
		No output.
	*/
	public function tvlgiao_wpdance_saveCustomField($post_id){
		if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE )
		return $post_id;
		if(isset($_POST['_inline_edit'])) 
        return $post_id;
		if( isset($_REQUEST['mode']) && $_REQUEST['mode'] == 'list' )
			return $post_id;	
		if( isset($_REQUEST['action']) &&  $_REQUEST['action'] == 'trash' )
			return $post_id;			
		// Save featured for post
		if(isset($_POST['featured_post']))
			update_post_meta($post_id,TVLGiao_Wpdance_THEME_SLUG.'featured_post',$_POST['featured_post']);
			
		

		// Save layout for custom page
		if(isset($_POST['custom_page_layout']))
			update_post_meta($post_id,TVLGiao_Wpdance_THEME_SLUG.'custom_page_layout',$_POST['custom_page_layout']);
			
		// Save product custom layout & sidebar
		if( isset($_POST['custom_product_layout']) && $_POST['custom_product_layout'] == "custom_single_prod_layout" ){
			$_default_prod_config = array(
				'layout' 					=> $_POST['single_layout']
				,'left_sidebar' 			=> $_POST['single_left_sidebar']
				,'right_sidebar' 			=> $_POST['single_right_sidebar']	
			);		
			$ret_str = serialize($_default_prod_config);
			update_post_meta($post_id,TVLGiao_Wpdance_THEME_SLUG.'custom_product_config',$ret_str);	
		}
		
		// Save post custom layout & sidebar
		if( isset($_POST['custom_post_layout']) && $_POST['custom_post_layout'] == "custom_single_post_layout" && wp_verify_nonce($_POST['nonce_custom_post_layout'],'_update_custom_post_layout') ){
			$_default_post_config = array(
				'layout' 					=> $_POST['single_layout']
				,'left_sidebar' 			=> $_POST['single_left_sidebar']
				,'right_sidebar' 			=> $_POST['single_right_sidebar']
				,'post_type'				=> $_POST['single_post_type']
			);
			$video_url = isset($_POST['video_url'])?$_POST['video_url']:'';
			$video_width = isset($_POST['video_width'])?$_POST['video_width']:700;
			$video_height = isset($_POST['video_height'])?$_POST['video_height']:400;
			
			$audio_mp3 = isset($_POST['audio_mp3'])?$_POST['audio_mp3']: '';
			$audio_soundcloud = isset($_POST['audio_soundcloud'])?$_POST['audio_soundcloud']: '';
			if($_POST['single_post_type'] == 'audio') {
				if(strlen($audio_mp3) > 0) $_default_post_config['audio_mp3'] = $audio_mp3;
				if(strlen($audio_soundcloud) > 0) $_default_post_config['audio_soundcloud'] = $audio_soundcloud;
			}
			if( $_POST['single_post_type'] == 'video' && strlen($video_url) > 0 ) {
				$_default_post_config['video_url'] = $_POST['video_url'];
				$_default_post_config['video_width'] = $_POST['video_width'];
				$_default_post_config['video_height'] = $_POST['video_height'];
			}
			
			$ret_str = serialize($_default_post_config);
			update_post_meta($post_id,TVLGiao_Wpdance_THEME_SLUG.'custom_post_config',$ret_str);
			
			$post_thumb_shortcode = isset($_POST['post_thumb_shortcode'])? $_POST['post_thumb_shortcode']:'';
			if( $_POST['single_post_type'] == 'shortcode' && strlen($post_thumb_shortcode) > 0) {
				update_post_meta($post_id, TVLGiao_Wpdance_THEME_SLUG.'post_thumb_shortcode', $post_thumb_shortcode);
			} else {
				delete_post_meta($post_id, TVLGiao_Wpdance_THEME_SLUG.'post_thumb_shortcode');
			}
			
			
		}
		
		//Save product ADS Sidebar
		if ( isset( $_POST['wd_ads_position'] ) && isset( $_POST['wd_ads_content'] ) && isset( $_POST['wd_ads_name'] ) ) {
			$wd_ads_name = $_POST['wd_ads_name'];
			$wd_ads_position  = $_POST['wd_ads_position'];
			$wd_ads_content = $_POST['wd_ads_content'];
			$wd_ads_count = sizeof( $wd_ads_name );
			// Save Attributes
			$wd_ads_sidebar = array();
			if($wd_ads_count > 0 ){
				for ( $i=0; $i < $wd_ads_count; $i++ ) {
					//if ( ! $wd_ads_name[ $i ] )
					//	continue;
				
					$wd_ads_sidebar[ sanitize_title( $wd_ads_name[ $i ] . rand() ) ] = array(
						'name' 			=> wc_clean( $wd_ads_name[ $i ] ),
						'position' 		=> $wd_ads_position[ $i ],
						'content' 		=> $wd_ads_content[$i]
					);
				}		
				update_post_meta( $post_id, TVLGiao_Wpdance_THEME_SLUG.'product_ads_sidebar', $wd_ads_sidebar );
			} 
		} else {
			delete_post_meta( $post_id, TVLGiao_Wpdance_THEME_SLUG.'product_ads_sidebar');
		}
		
		if(isset($_POST['custom_sidebar']))
			update_post_meta($post_id,TVLGiao_Wpdance_THEME_SLUG.'custom_sidebar',$_POST['custom_sidebar']);
		
		if(isset($_POST['username_twitter_testimonial']))
			update_post_meta($post_id,TVLGiao_Wpdance_THEME_SLUG.'username_twitter_testimonial',$_POST['username_twitter_testimonial']);		
			
		// Save Gallery for slideshow
		if(isset($_POST['gal_slideshow']))
			update_post_meta($post_id,TVLGiao_Wpdance_THEME_SLUG.'gal_slideshow',$_POST['gal_slideshow']);
		
		// Save select for ew_slideshow
		if(isset($_POST['slideshow_post']))
			update_post_meta($post_id,TVLGiao_Wpdance_THEME_SLUG.'slideshow_post',$_POST['slideshow_post']);		
			
		// Save select for video


		// Save logo icon for service
		if(isset($_POST['ew_service_custom_logo']))
			update_post_meta($post_id,TVLGiao_Wpdance_THEME_SLUG.'ew_service_custom_logo',$_POST['ew_service_custom_logo']);		

	
	
		
		if ( isset($_POST['_page_config']) && (int)$_POST['_page_config'] == 1 && wp_verify_nonce($_POST['nonce_page_config'],'_update_page_config') ){
			$_post_params = array(										
										"page_column" 			=> $_POST['page_column']
										,"header_style" 		=> $_POST['header_style']
										,"left_sidebar" 		=> $_POST['left_sidebar']
										,"right_sidebar" 		=> $_POST['right_sidebar']
										,"page_slider" 			=> $_POST['page_slider']
										,"page_slider_pos" 		=> $_POST['page_slider_pos']
										,"page_revolution" 		=> isset($_POST['page_revolution'])? $_POST['page_revolution']:''
										,"page_layerslider"		=> isset($_POST['page_layerslider'])? $_POST['page_layerslider']: ''
										,"hide_breadcrumb" 		=> absint($_POST['hide_breadcrumb'])
										,"hide_title" 			=> absint($_POST['hide_title'])
										,"hide_top_content" 	=> absint($_POST['hide_top_content'])
									);
			//die(print_r($_post_params));						
			$_post_params = tvlgiao_wd_array_atts(array(
										"top_content_widget_layout"		=> 'wide'
										,"page_column"			=> '0-1-0'
										,"header_style" 		=> '0'
										,"left_sidebar" 		=>'primary-widget-area'
										,"right_sidebar" 		=> 'primary-widget-area'
										,"page_slider" 			=> 'none'
										,"page_slider_pos" 		=> 'after_header'
										,"page_revolution" 		=> ''
										,"page_layerslider"		=> ''
										,"portfolio_columns" 	=> 1
										,"portfolio_filter"		=> 1
										,"hor_menu_color" 		=> 'default'
										,"ver_menu_color" 		=> 'default'										
										,"hide_breadcrumb" 		=> 0
										,"hide_title" 			=> 0
										,"hide_top_content" 	=> 0
									),$_post_params	);					
			$ret_str = serialize($_post_params);			
			
			update_post_meta($post_id,TVLGiao_Wpdance_THEME_SLUG.'page_configuration',$ret_str);	
		}		
		if ( isset($_POST['_post_gallery']) && (int)$_POST['_post_gallery'] == 1 && wp_verify_nonce($_POST['nonce_post_gallery'],'_update_post_gallery') ){
			$attachment_ids = $_POST['attachment_ids'];
			update_post_meta($post_id, TVLGiao_Wpdance_THEME_SLUG.'post_gallery', $attachment_ids);
		}
			
	}
	public function tvlgiao_wpdance_createCustomLayout(){
		require_once get_template_directory().'/framework/includes/metaboxes/custom_layout.php';
	}

	public function tvlgiao_wpdance_page_configuration(){
		require_once get_template_directory().'/framework/includes/metaboxes/page_configuration.php';
	}
}
?>