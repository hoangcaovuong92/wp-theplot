<?php 
	
	/* MENU PHONE */
	
	
	add_action( 'wd_before_header', 'tvlgiao_wpdance_wd_print_toggle_menu', 2 );
	
	add_action( 'wd_before_header', 'tvlgiao_wpdance_wd_mobile_header_open_div', 3 );
	add_action( 'wd_before_header', 'tvlgiao_wpdance_wd_mobile_header_logo',4 );
	
    add_action( 'wd_before_header', 'tvlgiao_wpdance_wd_mobile_header_menu_search', 5 );		
	add_action( 'wd_before_header', 'tvlgiao_wpdance_wd_mobile_header_act_box_end', 6);	
	
	function tvlgiao_wpdance_wd_mobile_header_act_box_end(){
		echo "</div>";
	}
	
	function tvlgiao_wpdance_wd_print_toggle_menu(){
	?>
  <div class="phone-header visible-xs">
	
	<span class="ts-group-meta-icon-toggle visible-phone"><i class="fa fa-cog"></i></span>	
	<?php	tvlgiao_wpdance_wd_mobile_header_menu_cart(); ?>
	<?php 
		if( has_nav_menu( 'mobile' ) ){ 
			wp_nav_menu( array( 'container_class' => 'mobile-main-menu toggle-menu','theme_location' => 'mobile' ) ); 
		}
		else{
			wp_nav_menu( array( 'container_class' => 'mobile-main-menu toggle-menu','theme_location' => 'primary' ) ); 
		} ?>	
						
	<div class="group-meta-header" style="display:none">
		<?php if(tvlgiao_wpdance_wd_is_woocommerce()) {
				$count =0;
				$myaccount_page_id = get_option( 'woocommerce_myaccount_page_id' );
				$myaccount_page_url = "#";
				if ( $myaccount_page_id ) {
					$myaccount_page_url = get_permalink( $myaccount_page_id );
				}
				$wishlist_page = esc_url( get_permalink( get_option( 'yith_wcwl_wishlist_page_id' ) ) );
				?>
				<div class="wd_mobile_account">
					<a class="wishlist_header" href="<?php echo esc_url($wishlist_page); ?>">
						<span><?php esc_html_e('Wishlist (','wpnoone'); echo '<span class="wd_tini_wishlist_number">'.(((int)$count < 10 && (int)$count != 0)?'0'.(int)$count:(int)$count).')</span>'; ?></span>
		           </a>
				   <?php if ( is_active_sidebar( 'wd-header-top-wider-area-right' )): ?>
						<div class="header-top-custom-sidebar">
							<ul class="xoxo">
								<?php dynamic_sidebar( 'wd-header-top-wider-area-right' ); ?>
							</ul>
						</div>
					<?php endif; ?>
					<?php if(!is_user_logged_in()):?>
						
						<a class="sign-in-form-control" href="<?php echo esc_url($myaccount_page_url);?>" title="<?php _e('Log in/Sign up','wpnoone');?>">
							<i class="fa fa-user"></i>
							<span> <?php  esc_html_e('Log in/Sign up','wpnoone'); ?> </span>
						</a>
						<span class="visible-xs login-drop-icon"></span>			
					<?php else:?>		
						<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php esc_html_e('My Account','wpnoone'); ?>">
							<i class="fa fa-user"></i>
							<span> <?php esc_html_e('My Account','wpnoone') ?> </span>
						</a>	
					<?php endif;?>
				</div>				
				<?php
			} ?>
	</div> 
</div> 
	<?php
	}	
	
	add_filter( 'woocommerce_variable_sale_price_html', 'tvlgiao_wpdance_wc_wc20_variation_price_format', 10, 2 );
	add_filter( 'woocommerce_variable_price_html', 'tvlgiao_wpdance_wc_wc20_variation_price_format', 10, 2 );
	//add_filter( 'woocommerce_grouped_price_html', 'wc_wc20_variation_price_format', 10, 2 );
	function tvlgiao_wpdance_wc_wc20_variation_price_format( $price, $product ) {
		// Main Price
		$prices = array( $product->get_variation_price( 'min', true ), $product->get_variation_price( 'max', true ) );
		$price = $prices[0] == $prices[1]? wc_price($prices[0]): $price = wc_price( $prices[0] ) . ' - ' .wc_price( $prices[1] );
		// Sale Price
		$prices = array( $product->get_variation_regular_price( 'min', true ), $product->get_variation_regular_price( 'max', true ) );
		sort( $prices );
		
		$saleprice = $prices[0] == $prices[1]? $saleprice = wc_price( $prices[0] ): wc_price( $prices[0] ) . ' - ' .wc_price( $prices[1] );
		
		if ( $price !== $saleprice ) {
			$price = '<del>' . $saleprice . '</del> <ins>' . $price . '</ins>';
		}
		return $price;
	}
	
	add_filter( 'woocommerce_grouped_price_html', 'tvlgiao_wpdance_wc_wc20_group_price_format', 10, 2 );
	function tvlgiao_wpdance_wc_wc20_group_price_format( $price, $product ) {
		$tax_display_mode = get_option( 'woocommerce_tax_display_shop' );
		$child_prices     = array();

		foreach ( $product->get_children() as $child_id )
			$child_prices[] = get_post_meta( $child_id, '_price', true );

		$child_prices     = array_unique( $child_prices );
		$get_price_method = 'get_price_' . $tax_display_mode . 'uding_tax';

		if ( ! empty( $child_prices ) ) {
			$min_price = min( $child_prices );
			$max_price = max( $child_prices );
		} else {
			$min_price = '';
			$max_price = '';
		}

		if ( $min_price ) {
			if ( $min_price == $max_price ) {
				$display_price = wc_price( $product->$get_price_method( 1, $min_price ) );
			} else {
				$from          = wc_price( $product->$get_price_method( 1, $min_price ) );
				$to            = wc_price( $product->$get_price_method( 1, $max_price ) );
				$display_price = $from . ' - ' . $to;
			}

			$price = $display_price . $product->get_price_suffix();

		}
		return $price;
		
	}
	
	
	if(!function_exists ('tvlgiao_wpdance_wd_mobile_header_open_div')){
		function tvlgiao_wpdance_wd_mobile_header_open_div(){
	?>	
		<div class="top-logo-seach visible-xs">
	<?php
		}
	}	
	

	if(!function_exists ('tvlgiao_wpdance_wd_mobile_header_menu_cart')){
		function tvlgiao_wpdance_wd_mobile_header_menu_cart(){
			global $tvlgiao_wpdance_wd_data;
			if( !isset($tvlgiao_wpdance_wd_data['wd_enable_cart_header_top']) || absint($tvlgiao_wpdance_wd_data['wd_enable_cart_header_top']) ):
	?>	
		<div class="mobile_cart_container visible-xs">
			<div class="mobile_cart">
			<?php 
				if( in_array( "woocommerce/woocommerce.php", apply_filters( 'active_plugins', get_option( 'active_plugins' )  ) ) ){
				$_cart_size_id = "cart_size_value_head-".rand();
				$cart_size_title = esc_html__('View your shopping bag','wpnoone');
				?>
				
				<span class="cart_size">
					<a href="<?php echo esc_url( wc_get_cart_url() );?>" title="<?php echo esc_attr( $cart_size_title );?>">
					
					<span class="cart_size_value_head" id="<?php echo esc_attr($_cart_size_id); ?>">
						<i class="fa fa-shopping-cart"></i>
						<!--span class="cart_item"-->
							<span class="num_item">
								<?php 
								$number = WC()->cart->cart_contents_count;
								if( $number < 10 && $number != 0 )
									echo '0'.$number;
								else
									echo $number;
								?>
							</span>
						<!--/span-->
					</span>
					</a>
				</span>
				
				<?php } ?>
			</div>
		</div>	
	<?php	
			endif;
		}
	}		

	if(!function_exists ('tvlgiao_wpdance_wd_mobile_header_menu_search')){
		function tvlgiao_wpdance_wd_mobile_header_menu_search(){
			echo tvlgiao_wpdance_wd_get_mobile_search_form();
		}
	}

	if(!function_exists ('tvlgiao_wpdance_wd_mobile_header_logo')){
		function tvlgiao_wpdance_wd_mobile_header_logo(){
			tvlgiao_wpdance_theme_mobile_logo();
		}
	}		
	/* END MENU PHONE */
	
	if(!function_exists ('tvlgiao_wd_array_atts')){
		function tvlgiao_wd_array_atts($pairs, $atts) {
			$atts = (array)$atts;
			$out = array();
		   foreach($pairs as $name => $default) {
				if ( array_key_exists($name, $atts) ){
					if( strlen(trim($atts[$name])) > 0 ){
						$out[$name] = $atts[$name];
					}else{
						$out[$name] = $default;
					}
				}
				else{
					$out[$name] = $default;
				}	
			}
			return $out;
		}
	}					
	if(!function_exists ('tvlgiao_wpdance_show_page_slider')){
		function tvlgiao_wpdance_show_page_slider(){
			global $tvlgiao_wpdance_page_datas;
			$revolution_exists = ( class_exists('RevSlider') && class_exists('UniteFunctionsRev') );
			switch ($tvlgiao_wpdance_page_datas['page_slider']) {
				case 'revolution':
					if( $revolution_exists )
						RevSliderOutput::putSlider($tvlgiao_wpdance_page_datas['page_revolution'],"");
					break;	
				case 'none' :
					break;							
				default:
				   break;
			}	
		}
	}
		
	add_action( 'wd_before_main_container', 'tvlgiao_wpdance_wd_print_top_content_widget_area', 15 );
	if(!function_exists ('tvlgiao_wpdance_wd_print_top_content_widget_area')) {
		function tvlgiao_wpdance_wd_print_top_content_widget_area(){
			global $tvlgiao_wpdance_wd_data, $tvlgiao_wpdance_page_datas;
			if ( is_active_sidebar( 'wd-top-content-wider-area' ) && isset($tvlgiao_wpdance_page_datas['hide_top_content']) && (int)$tvlgiao_wpdance_page_datas['hide_top_content'] == 0 ) :
			?>
				<div class="wd_top_content_widget_area_wrapper">
					<div class="wd_top_content">
						<ul class="xoxo">
							<?php dynamic_sidebar( 'wd-top-content-wider-area' ); ?>
						</ul>
					</div>
				</div>		
			<?php 
			endif;
		}
	}
	
	add_action( 'wd_before_main_container', 'tvlgiao_wpdance_wd_print_inline_script', 10 );
	if(!function_exists ('tvlgiao_wpdance_wd_print_inline_script')){
		function tvlgiao_wpdance_wd_print_inline_script(){
	?>	
		<script type="text/javascript">	
			_ajax_uri = '<?php echo admin_url('admin-ajax.php');?>';
			theme_ajax = '<?php echo admin_url( 'admin-ajax.php' )?>';		
			<?php 
				global $tvlgiao_wpdance_wd_data;
				
			?>
			var _enable_sticky_menu = <?php echo absint($tvlgiao_wpdance_wd_data['wd_sticky_menu']); ?>;
			jQuery('.menu li').each(function(){
				if(jQuery(this).children('.sub-menu').length > 0) jQuery(this).addClass('parent');
			});
		</script>
	<?php
		}
	}		

	
	add_action( 'wd_before_body_end', 'tvlgiao_wpdance_wd_before_body_end_widget_area', 10 );
	if(!function_exists ('tvlgiao_wpdance_wd_before_body_end_widget_area')){
		function tvlgiao_wpdance_wd_before_body_end_widget_area(){
	?>	
	
		<div class="container">
				<div class="body-end-widget-area">
					<?php
						if ( is_active_sidebar( 'body-end-widget-area' ) ) : ?>
							<ul class="xoxo">
								<?php dynamic_sidebar( 'body-end-widget-area' ); ?>
							</ul>
						<?php endif; ?>						
				</div><!-- end #footer-first-area -->
		</div>	
		<?php wp_reset_query();?>
	
	<?php
		}
	}
	
	add_action( 'wd_before_footer_end', 'tvlgiao_wpdance_wd_before_body_end_content', 10 );
	if(!function_exists ('tvlgiao_wpdance_wd_before_body_end_content')){
		function tvlgiao_wpdance_wd_before_body_end_content(){
		global $tvlgiao_wpdance_wd_data;
	?>	
		
		<?php if(!wp_is_mobile() && $tvlgiao_wpdance_wd_data['wd_totop']): ?>
		<div id="to-top" class="scroll-button">
			<a class="scroll-button" href="javascript:void(0)" title="<?php esc_html_e('Back to Top','wpnoone');?>"></a>
		</div>
		<?php endif; ?>
		
		<!--<div class="loading-mark-up">
			<span class="loading-image"></span>
		</div>
		<span class="loading-text"></span>-->
	
	<?php
		}
	}

	
if ( ! function_exists( 'tvlgiao_wpdance_wd_woocommerce_product_loop_start' ) ) {

	function tvlgiao_wpdance_wd_woocommerce_product_loop_start( $style = '', $echo = true ) {
		ob_start();
		wc_get_template( 'loop/wd-loop-start.php', array( 'style' => $style) );
		if ( $echo )
			echo ob_get_clean();
		else
			return ob_get_clean();
	}
}
	
	
if( !function_exists('tvlgiao_wpdance_wd_myaccount_menu_custom') ){
	function tvlgiao_wpdance_wd_myaccount_menu_custom(){
		$_user_logged = is_user_logged_in();
		ob_start();
		$my_account = get_permalink( get_option('woocommerce_myaccount_page_id') );
		$login_url = add_query_arg( 'action', 'login', esc_url($my_account) );
		$regis_url = add_query_arg( 'action', 'register', esc_url($my_account) );
		?>
		<div class="wd_myaccount_menu">
			<div class="title"><?php _e('Account','wpnoone'); ?></div>
			<div class="content">
				<ul>
					<?php if( $_user_logged ){ ?>
					<li><a href="<?php echo wp_logout_url( get_permalink( wc_get_page_id( 'myaccount' ) ) ); ?>"><?php _e('Logout','wpnoone') ?></a></li>
					<li><a href="<?php echo esc_url($my_account) ?>"><?php esc_html_e('My Account','wpnoone'); ?></a></li>
					<li><a href="<?php echo esc_url(wc_customer_edit_account_url()); ?>"><?php _e('Edit account','wpnoone') ?></a></li>
					<?php } else { ?>
					<li><a href="<?php echo esc_url($login_url); ?>"><?php esc_html_e('Login','wpnoone'); ?></a></li>
					<li><a href="<?php echo esc_url($regis_url); ?>"><?php esc_html_e('Register','wpnoone'); ?></a></li>
					<li><a href="<?php echo wp_lostpassword_url(); ?>"><?php esc_html_e('Forgotten Password','wpnoone'); ?></a></li>
					<?php } ?>
					<li><a href="<?php echo esc_url( get_permalink( get_option( 'yith_wcwl_wishlist_page_id' ) ) ); ?>"><?php esc_html_e('Wishlist','wpnoone'); ?></a></li>
				</ul>
			</div>
		</div>
		<?php
		echo ob_get_clean();
	}
}


if( !function_exists('tvlgiao_wpdance_wd_show_variation_product_same_price') ){
	function tvlgiao_wpdance_wd_show_variation_product_same_price($value, $object = null, $variation = null){
		if ($value['price_html'] == '') {
			$value['price_html'] = '<span class="price">' . $variation->get_price_html() . '</span>';
		}
		return $value;
	}
}
add_filter('woocommerce_available_variation','tvlgiao_wpdance_wd_show_variation_product_same_price',10,3);


function tvlgiao_wpdance_wd_add_number_product_list(){
	global $wd_count;
	?><span class="product_count"><?php echo absint($wd_count++);?></span><?php 
}
function tvlgiao_wpdance_load_global_var_default_sidebars()
	{
		global $tvlgiao_wpdance_default_sidebars;
		return $temp = $tvlgiao_wpdance_default_sidebars;
	}
?>