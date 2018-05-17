<?php 
	add_action( 'tvlgiao_wpdance_wd_header_init', 'tvlgiao_wpdance_wd_print_header_top', 10 );
	if(!function_exists ('tvlgiao_wpdance_wd_print_header_top')){
		function tvlgiao_wpdance_wd_print_header_top(){ 
			global $tvlgiao_wpdance_wd_data;
		?>
			<div class="header-top hidden-xs">
				<div class="header-top-content container">
					<div class="row">					
					<div class="header-wrapper">					
					<div class="header-top-left-area col-sm-8">
						<?php if ( is_active_sidebar( 'wd-header-top-wider-area-left' )): ?>
						<ul class="xoxo">
							<?php dynamic_sidebar( 'wd-header-top-wider-area-left' ); ?>
						</ul>
						<?php endif; ?>
					</div>
					<script type="text/javascript">
					   jQuery( document ).ready(function() {
						"use strict";
						
						var _time_delay=0;
						var _ul_social = jQuery('#header .widget_social');
						jQuery.fn.reverse = [].reverse;
						_ul_social.find("li").each(function(index,element){
						 TweenLite.from(jQuery(element), 1, {x:80,repeat:0,delay:_time_delay,opacity:0,ease:Quad.easeIn});
						 _time_delay += 0.5;
						});      
					   });  
					  </script>
						<div class="header-top-right-area col-sm-16">
							<div class="wd-header-search-control" style="position: relative;">
								<span class="wd-open-control-panel" data-position="right" data-element=".wd-search-box"><i class="fa fa-search"></i></span>
						    </div>								
						<?php if ( is_active_sidebar( 'wd-header-top-wider-area-right' )): ?>
						<div class="header-top-custom-sidebar hidden-xs">
							<ul class="xoxo">
								<?php dynamic_sidebar( 'wd-header-top-wider-area-right' ); ?>
							</ul>
						</div>
						<?php endif; ?>
						<?php if ( tvlgiao_wpdance_wd_is_woocommerce() ) { ?>
						<div class="header-top-account hidden-xs">
							<?php echo tvlgiao_wpdance_wd_tini_account();//TODO : account form goes here?>
						</div>
						<?php } ?>						
						<?php if ( tvlgiao_wpdance_wd_is_woocommerce() && defined('YITH_WCWL') ) { ?>
							<div class="wd_tini_wishlist_wrapper hidden-xs"><?php echo tvlgiao_wpdance_wd_tini_wishlist(); ?></div>
						<?php } ?>
						
						<?php if ( tvlgiao_wpdance_wd_is_woocommerce() ) { ?>
						<div class="phone_quick_menu_1 hidden-lg hidden-sm hidden-md">
							<div class="mobile_my_account">
								<?php if ( is_user_logged_in() ) { ?>
									<a href="<?php echo esc_url(get_permalink( get_option('woocommerce_myaccount_page_id'))); ?>" title="<?php esc_html_e('My Account','wpnoone'); ?>"><?php esc_html_e('My Account','wpnoone'); ?></a>
								<?php }
								else { ?>
									<a href="<?php echo esc_url(get_permalink( get_option('woocommerce_myaccount_page_id') )); ?>" title="<?php esc_html_e('Login / Register','wpnoone'); ?>"><?php esc_html_e('Login / Register','wpnoone'); ?></a>
								<?php } ?>
							</div>
						</div>
						<?php } ?>
						<div class="mobile_cart_container  hidden-lg hidden-sm hidden-md">
							<div class="mobile_cart">
							<?php
								global $woocommerce;
								if( isset($woocommerce) && isset($woocommerce->cart) ){
									$cart_url = esc_url( wc_get_cart_url() );
									echo "<a href='{$cart_url}' title='View Cart'>".esc_html__('View Cart','wpnoone')."</a>";
								}

							?>
							</div>
							<div class="mobile_cart_number">0</div>
						</div>
						
					</div>
					
					<div class="wd-right-control-panel" style="display:none">
						<div class="wd-search-box"><?php tvlgiao_wpdance_wd_get_search_form(); ?></div>
					</div>
					</div>
					</div>
				</div>
			</div>
		<?php
		
		}
	}	
		
	add_action( 'tvlgiao_wpdance_wd_header_init', 'tvlgiao_wpdance_wd_print_header_body', 20 );
	if(!function_exists ('tvlgiao_wpdance_wd_print_header_body')){
		function tvlgiao_wpdance_wd_print_header_body(){
			get_template_part('framework/headers/header-v1');
		}
	}
	
	function tvlgiao_wpdance_theme_logo(){
		global $tvlgiao_wpdance_wd_data, $tvlgiao_wpdance_page_datas;
		
		$header_type = 'wd_logo';	
		$logo = strlen(trim($tvlgiao_wpdance_wd_data[$header_type])) > 0 ? esc_url($tvlgiao_wpdance_wd_data[$header_type]) : '';
		$default_logo = get_template_directory_uri()."/images/logo_v1.png";
		$textlogo = stripslashes(esc_attr($tvlgiao_wpdance_wd_data['wd_text_logo']));
		if($tvlgiao_wpdance_page_datas['page_slider_pos'] == "before_header" )
		{
			$logo = get_template_directory_uri()."/images/logo_black.png";
		}
		//print_r($logo);
	?>
		<div class="logo heading-title">
		<?php if( strlen( trim($logo) ) > 0 ){?>
				<a href="<?php  echo esc_url( home_url( '/' ) );?>"><img src="<?php echo esc_url($logo);?>" alt="<?php echo esc_attr($textlogo ? $textlogo : get_bloginfo('name'));?>" title="<?php echo esc_attr($textlogo ? $textlogo : get_bloginfo('name'));?>"/></a>	
		<?php } else {
			if($textlogo){
			?>
				<a href="<?php   echo esc_url( home_url( '/' ) );?>" title="<?php echo esc_attr($textlogo);?>"><?php echo esc_html($textlogo);?></a>
			<?php }else{ ?>
				<a href="<?php   echo esc_url( home_url( '/' ) );?>"><img src="<?php echo esc_url($default_logo); ?>"  alt="<?php echo get_bloginfo('name');?>" title="<?php echo get_bloginfo('name');?>"/></a>
			<?php
			}
		}?>	
		</div>
	<?php 
	}
	
	function tvlgiao_wpdance_theme_mobile_logo(){
		global $tvlgiao_wpdance_wd_data, $tvlgiao_wpdance_page_datas;
		
		$header_type = 'wd_logo_mobile';
		if(isset($tvlgiao_wpdance_wd_data['wd_logo_mobile']) && strlen(trim($tvlgiao_wpdance_wd_data['wd_logo_mobile'])) > 0 ){
			$logo = esc_url($tvlgiao_wpdance_wd_data['wd_logo_mobile']);
		} else {
			$logo = strlen(trim($tvlgiao_wpdance_wd_data['wd_logo'])) > 0 ? esc_url($tvlgiao_wpdance_wd_data['wd_logo']) : '';
		}
		
		$default_logo = get_template_directory_uri()."/images/logo-mobile.png";
		$textlogo = stripslashes(esc_attr($tvlgiao_wpdance_wd_data['wd_text_logo']));
	?>
	<div class="top_header_mobile">		
		<div class="logo heading-title">
		<?php if( strlen( trim($logo) ) > 0 ){?>
				<a href="<?php  echo esc_url( home_url( '/' ) );?>"><img src="<?php echo esc_url($logo);?>" alt="<?php echo esc_attr($textlogo ? $textlogo : get_bloginfo('name'));?>" title="<?php echo esc_attr($textlogo ? $textlogo : get_bloginfo('name'));?>"/></a>	
		<?php } else {
			if($textlogo){
			?>
				<a href="<?php   echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr($textlogo);?>"><?php echo esc_html($textlogo);?></a>
			<?php }else{ ?>
				<a href="<?php   echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url($default_logo); ?>"  alt="<?php echo get_bloginfo('name');?>" title="<?php echo get_bloginfo('name');?>"/></a>
			<?php
			}
		}?>	
		</div>
		
	</div>
	<?php 
	}
	if(!function_exists ('tvlgiao_wpdance_wd_get_search_form1')){
		function tvlgiao_wpdance_wd_get_search_form1(){
			ob_start();
          
		?>
			<div class="wd_woo_search_box">
				<label class="screen-reader-text"><?php esc_html_e('Search', 'wpnoone');?></label>				
				<form class="wd_search_form" role="search" method="get" action="<?php echo esc_url( home_url( '/'  ) ); ?>">
					<input type="text" name="s" id="sea" <?php if(isset($_GET['s'])) echo "value=\"".esc_attr($_GET['s']) . "\""; ?> placeholder="<?php esc_html_e('Search here...', 'wpnoone');?>" />
					<div class="button_search"><button type="submit" title="<?php echo esc_attr__( 'Search', 'wpnoone' ); ?>"><i class="fa fa-search"></i></button></div>
					<input type="hidden" name="post_type" value="<?php echo esc_attr((class_exists('WooCommerce'))? "product": 'post');?>" />
				</form>
			</div>
			
		<?php
			$output = ob_get_contents();
			ob_end_clean();
			return $output;
		}
	}
	
	if(!function_exists ('tvlgiao_wpdance_wd_get_mobile_search_form')){
		function tvlgiao_wpdance_wd_get_mobile_search_form(){
			ob_start();
		?>
			<div class="wd_woo_search_box">
				<form role="search" method="get" action="<?php echo esc_url( home_url( '/'  ) ); ?>">
					<input type="text" placeholder="<?php echo esc_attr__("Search here...", 'wpnoone');?>" name="s" id="s" <?php if(isset($_GET['s'])) echo "value=\"".esc_attr($_GET['s']) . "\""; ?> />
					<div class="button_search"><button type="submit" title="<?php echo esc_attr__( 'Search', 'wpnoone' ); ?>"><i class="fa fa-search"></i></button></div>
					<input type="hidden" name="post_type" value="<?php echo esc_attr((class_exists('WooCommerce'))? "product": 'post');?>" />
				</form>
			</div>
			
		<?php
			$output = ob_get_contents();
			ob_end_clean();
			return $output;
		}
	}
	
	if(!function_exists ('tvlgiao_wpdance_wd_get_search_form')){
		function tvlgiao_wpdance_wd_get_search_form(){
			global $tvlgiao_wpdance_wd_data;
			 echo tvlgiao_wpdance_wd_get_search_form1();
		}
	}
	
	
	
	function tvlgiao_wpdance_theme_icon(){
		global $tvlgiao_wpdance_wd_data;
		$icon = $tvlgiao_wpdance_wd_data['wd_icon'];
		if( strlen(trim($icon)) > 0 ):?>
			<link rel="shortcut icon" href="<?php echo esc_url($icon);?>" />
		<?php endif;
	}
	
	function tvlgiao_wpdance_wd_printf_breadcrumb($datas,$style=''){
		if( $datas['has_breadcrumb']== true){
			global $tvlgiao_wpdance_wd_data;
			
			$tvlgiao_wpdance_wd_data['wd_bg_breadcrumbs'] = (isset($datas['backg_url']) && $datas['backg_url'] !=='') ? $datas['backg_url']: $tvlgiao_wpdance_wd_data['wd_bg_breadcrumbs'];
			$break_pace ="";$height ='';
			
			if( isset($tvlgiao_wpdance_wd_data['wd_bg_breadcrumbs']) && $tvlgiao_wpdance_wd_data['wd_bg_breadcrumbs'] != '' ){
				if(isset($tvlgiao_wpdance_wd_data['wd_header_style']) && $tvlgiao_wpdance_wd_data['wd_header_style'] == 'v4' && !wp_is_mobile()) $height = "height: 330px;";
				if(empty($style)){
				   $url_page_id = wp_get_attachment_url( get_post_thumbnail_id() );
				   if(isset($url_page_id) && !empty($url_page_id)){
					$style = 'style="background: url('.esc_url($url_page_id).');"';
				   }else{
				   $style = 'style="background: url('.esc_url($tvlgiao_wpdance_wd_data['wd_bg_breadcrumbs_other']).');"';
				   }
				}
			}
			if(isset($tvlgiao_wpdance_wd_data['wd_header_style']) && $tvlgiao_wpdance_wd_data['wd_header_style'] == 'v4' && !wp_is_mobile()){
				$break_pace = "<div style=\"height: 116px; width: 100%;\"></div>";
			}
			if( isset($datas['type']) && $datas['type'] === 'postdetail' && isset($datas['backg_url']) && $datas['backg_url'] !=='' ) {
				//$break_pace = "<div style=\"height: 166px; width: 100%;\"></div>";
			}
			
			echo '<div class="breadcrumb-title-wrapper"><div class="breadcrumb-title" '.trim($style).'>';
			echo esc_html($break_pace);
			if( $datas['has_page_title'] ) {
				echo wp_kses_post($datas['title']);
			}
			
			if( $datas['has_breadcrumb'] ) tvlgiao_wpdance_wd_show_breadcrumbs();
			echo '</div></div>';
			
		}
	}
?>