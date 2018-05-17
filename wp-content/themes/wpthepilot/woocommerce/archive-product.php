<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
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
		'title'				=> '<h1 class="heading-title page-title">'. esc_html(woocommerce_page_title(false)).'</h1>',
	);
	$tvlgiao_wpdance_wd_data = TvlgiaoWpdanceClassNameVar::TVLGiao_wpdance_GetVar("wd_data");
	if( isset($tvlgiao_wpdance_wd_data) ){
		$style = 'style="background: url('.esc_url($tvlgiao_wpdance_wd_data['wd_bg_breadcrumbs_category']).');"';
	}
	
	?>
	
	<div class ="breadcrumb_category" >
		<?php tvlgiao_wpdance_wd_printf_breadcrumb($brd_data,$style);?>
	</div>
	
	<div id="wd-container" class="content-wrapper product-template container">
		<div id="content-inner" class="row">
			<?php	
				if( isset($tvlgiao_wpdance_wd_data) ){
					$_layout_config = explode("-",$tvlgiao_wpdance_wd_data['wd_prod_cat_layout']);
				}else{
					$_layout_config = array(0,1,0);
				}
				$_left_sidebar = (int)$_layout_config[0];
				$_right_sidebar = (int)$_layout_config[2];
				$_main_class = ( $_left_sidebar + $_right_sidebar ) == 2 ? "col-sm-12" : ( ( $_left_sidebar + $_right_sidebar ) == 1 ? "col-sm-18" : "col-sm-24" );					
			?>
			<?php if( $_left_sidebar ): ?>
				<div id="left-content" class="col-sm-6">
					<div class="sidebar-content wd-sidebar">
					<?php
						if ( is_active_sidebar( $tvlgiao_wpdance_wd_data['wd_prod_cat_left_sidebar'] ) ) : ?>
							<ul class="xoxo">
								<?php dynamic_sidebar( $tvlgiao_wpdance_wd_data['wd_prod_cat_left_sidebar'] ); ?>
							</ul>
					<?php endif; ?>
					</div>
				</div><!-- end left sidebar -->
			<?php endif;?>	

			<div id="main-content" class="<?php echo esc_attr($_main_class)?>">				
					<?php
						/**
						 * woocommerce_before_main_content hook
						 *
						 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
						 * @hooked woocommerce_breadcrumb - 20
						 */
						do_action('woocommerce_before_main_content');
					?>
					<?php
						if( isset($tvlgiao_wpdance_wd_data['wd_prod_cat_custom_content']) && strlen($tvlgiao_wpdance_wd_data['wd_prod_cat_custom_content']) > 0 ){
							echo "<div class='cat_custom_content'>";
							echo do_shortcode (stripslashes(htmlspecialchars_decode($tvlgiao_wpdance_wd_data['wd_prod_cat_custom_content'])) );
							echo "</div>";
						}
					?>
					<?php // do_action( 'woocommerce_archive_description' ); ?> 
				
					<?php 
						global $woocommerce_loop;
						$_old_woocommerce_loop = $woocommerce_loop;
					?>
					
					<?php 
						//$woocommerce_loop = $_old_woocommerce_loop;
						if( absint($tvlgiao_wpdance_wd_data['wd_prod_cat_column']) > 0 ){
							$woocommerce_loop['columns'] = $tvlgiao_wpdance_wd_data['wd_prod_cat_column'];
						}
						
					?>
					<?php ob_start();	?>										
					<?php if ( have_posts() ) : ?>
						<?php do_action( 'wd_woocommerce_message' ); ?>						
						<div class="wd_meta_loop">
						<?php
							/**
							 * woocommerce_before_shop_loop hook
							 *
							 * @hooked woocommerce_result_count - 20
							 * @hooked woocommerce_catalog_ordering - 30
							 */
							
							do_action( 'woocommerce_before_shop_loop' );
						?>
						</div>
						<div class="wd-products-wrapper grid-list-action">
							<?php woocommerce_product_loop_start(); ?>
							
								<?php while ( have_posts() ) : the_post(); ?>

									<?php wc_get_template_part( 'content', 'product' ); ?>

								<?php endwhile; // end of the loop. ?>

							<?php woocommerce_product_loop_end(); ?>
						</div>	
						<?php
							/**
							 * woocommerce_after_shop_loop hook
							 *
							 * @hooked woocommerce_pagination - 10
							 */
							do_action( 'woocommerce_after_shop_loop' );
						?>

					<?php elseif ( ! $show_sub_cat ) : ?>

						<?php wc_get_template( 'loop/no-products-found.php' ); ?>

					<?php endif; ?>

				<?php
					/**
					 * woocommerce_after_main_content hook
					 *
					 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
					 */
					do_action('woocommerce_after_main_content');
				?>

			</div>	

			<?php if( $_right_sidebar  ): ?>
				<div id="right-content" class="col-sm-6">
					<div class="sidebar-content wd-sidebar">
					<?php
						if ( is_active_sidebar( $tvlgiao_wpdance_wd_data['wd_prod_cat_right_sidebar'] ) ) : ?>
							<ul class="xoxo">
								<?php dynamic_sidebar( $tvlgiao_wpdance_wd_data['wd_prod_cat_right_sidebar'] ); ?>
							</ul>
					<?php endif; ?>
					</div>
				</div><!-- end right sidebar -->
			<?php endif;?>	
			
		</div>
	</div>
<?php get_footer('shop'); ?>