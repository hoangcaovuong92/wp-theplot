<?php
/**
 * Related Products
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.5
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop;

if ( ! $product || ! $product->is_visible() )
	return;
	
$related = wc_get_related_products($product->get_id(), 10);

if ( sizeof( $related ) == 0 ) return;

$args = apply_filters('woocommerce_related_products_args', array(
	'post_type'				=> 'product',
	'ignore_sticky_posts'	=> 1,
	'no_found_rows' 		=> 1,
	'posts_per_page' 		=> -1,//$posts_per_page,
	'orderby' 				=> $orderby,
	'post__in' 				=> $related,
	'post__not_in'			=> array($product->get_id())
) );
	

$products = new WP_Query( $args );
$woocommerce_loop['columns'] 	= $columns;

if ( $products->have_posts() ) : ?>

	<?php
	 $tvlgiao_wpdance_wd_data = TvlgiaoWpdanceClassNameVar::TVLGiao_wpdance_GetVar("wd_data");
	?>

	<div class="related grid">

		<h3 class="heading-title"><?php echo esc_attr($related_title = sprintf( esc_html__( '%s','wpnoone' ), stripslashes(esc_html($tvlgiao_wpdance_wd_data['wd_prod_related_title'])) )); ?></h3>
		<div class="related_wrapper wd-loading">
		
			<?php woocommerce_product_loop_start(); ?>

				<?php while ( $products->have_posts() ) : $products->the_post(); ?>

					<?php wc_get_template_part( 'content', 'product' ); ?>
					
				<?php endwhile; // end of the loop. ?>
				
			<?php woocommerce_product_loop_end(); ?>
		</div>
	</div>
	
	<script type="text/javascript" language="javascript">
		//<![CDATA[
		jQuery(document).ready(function() {
            "use strict";
			var $_this = jQuery('.related_wrapper');
			var owl = $_this.find('.products').owlCarousel({
				item : 4
				,loop : true
				,nav : true
				,dots : false
				,navText		: [ '<', '>' ]
				,lazyload		:true
				,responsiveBaseElement: $_this
				,responsive		:{
					0:{
						items:2
					},
					480:{
						items:2
					},
					768:{
						items: 4
					},
					992:{
						items: 4
					},
					1200:{
						items: 5
					}
				}
				,onInitialized: function(){
					$_this.addClass('wd-loaded').removeClass('wd-loading');
				}
				
			});
		});
	</script>	
<?php endif;
wp_reset_postdata();
