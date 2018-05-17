<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.5
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header('shop'); ?>
	<?php 
	
	$brd_data = array(
		'has_breadcrumb'	=> true,
		'has_page_title' 	=> ( apply_filters( 'woocommerce_show_page_title', true ) ),
		'title'				=> '<h1 class="heading-title page-title">'. get_the_title() .'</h1>',
	);
	if( isset($tvlgiao_wpdance_wd_data) ){
		$style = 'style="background: url('.esc_url($tvlgiao_wpdance_wd_data['wd_bg_breadcrumbs_category']).');"';
	}
	tvlgiao_wpdance_wd_printf_breadcrumb($brd_data,$style);
	
	?>	
		<div id="wd-container" class="content-wrapper single-product-template container">
			
			<div id="content-inner" class="row">	
			<?php	
				$_layout_config = explode("-",$tvlgiao_wpdance_wd_data['wd_prod_layout']);
				$_left_sidebar = (int)$_layout_config[0];
				$_right_sidebar = (int)$_layout_config[2];
				$_main_class = ( $_left_sidebar + $_right_sidebar ) == 2 ? "col-sm-12" : ( ( $_left_sidebar + $_right_sidebar ) == 1 ? "col-sm-18" : "col-sm-24" );
			?>
			
			<?php if( $_left_sidebar ): ?>
				<div id="left-content" class="col-sm-6">
					<div class="sidebar-content wd-sidebar">
					<?php do_action('wd_ads_sidebar','left'); ?>
					<?php
						if ( is_active_sidebar($tvlgiao_wpdance_wd_data['wd_prod_left_sidebar']) ) : ?>
							<ul class="xoxo">
								<?php dynamic_sidebar($tvlgiao_wpdance_wd_data['wd_prod_left_sidebar']); ?>
							</ul>
					<?php endif; ?>
					</div>
				</div><!-- end left sidebar -->
			<?php endif;?>					
			
			
			
			<div id="main-content" class="<?php echo esc_attr($_main_class);?>">
			
				<div>
					
					<?php
						/**
						 * woocommerce_before_main_content hook
						 *
						 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
						 * @hooked woocommerce_breadcrumb - 20
						 */
						do_action('woocommerce_before_main_content');
					?>


				
					<?php while ( have_posts() ) : the_post(); ?>

						<?php wc_get_template_part( 'content', 'single-product' ); ?>

					<?php endwhile; // end of the loop. ?>
				
					<?php
						/**
						 * woocommerce_after_main_content hook
						 *
						 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
						 */
									
						do_action('woocommerce_after_main_content');
					?>

				</div>
				
			</div>	
			<?php if( $_right_sidebar  ): ?>
				<div id="right-content" class="col-sm-6">
					<div class="sidebar-content wd-sidebar">
					<?php do_action('wd_ads_sidebar','right'); ?>
					<?php
						if ( is_active_sidebar( $tvlgiao_wpdance_wd_data['wd_prod_right_sidebar']) ) : ?>
							<ul class="xoxo">
								<?php dynamic_sidebar( $tvlgiao_wpdance_wd_data['wd_prod_right_sidebar'] ); ?>
							</ul>
					<?php endif; ?>
					</div>
				</div><!-- end right sidebar -->
			<?php endif;?>	


			</div><!-- end content -->			
		</div><!-- #container -->
		
	<?php
		/**
		 * woocommerce_sidebar hook
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		//do_action('woocommerce_sidebar');
	?>

<?php get_footer('shop'); ?>