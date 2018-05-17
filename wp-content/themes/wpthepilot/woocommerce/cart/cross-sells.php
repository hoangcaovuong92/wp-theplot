<?php
/**
 * Cross-sells
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.5
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce_loop, $woocommerce, $product;

$crosssells = WC()->cart->get_cross_sells();

if ( sizeof( $crosssells ) == 0 ) return;

$meta_query = WC()->query->get_meta_query();

$args = array(
	'post_type'           => 'product',
	'ignore_sticky_posts' => 1,
	'no_found_rows'       => 1,
	'posts_per_page'      => apply_filters( 'woocommerce_cross_sells_total', 8 ),
	'orderby'             => $orderby,
	'post__in'            => $crosssells,
	'meta_query'          => $meta_query
);

$products = new WP_Query( $args );

$woocommerce_loop['columns'] 	= apply_filters( 'woocommerce_cross_sells_columns',5 );

if ( $products->have_posts() ) : ?>

	<div class="cross_sells">
		<h3 class="heading-title"><?php esc_html_e( 'Related Items', 'wpnoone' ) ?></h3>
		<div class="cross_content">
		<?php woocommerce_product_loop_start(); ?>

			<?php while ( $products->have_posts() ) : $products->the_post(); ?>

				<?php wc_get_template_part( 'content', 'product' ); ?>

			<?php endwhile; // end of the loop. ?>

		<?php woocommerce_product_loop_end(); ?>			
		</div>
		<script type="text/javascript" language="javascript">
		//<![CDATA[
				jQuery(document).ready(function() {
                    "use strict";
					var $_this = jQuery('.cross_sells');		
					var owl = $_this.find('.products').owlCarousel({
						item : 4
						,responsive		:{
							0:{
								items:2
							},
							480:{
								items:3
							},
							768:{
								items: 3
							},
							992:{
								items: 4
							},
							992:{
								items:5
							}
						}
						,nav : true
						,navText		: [ '<', '>' ]
						,dots			: false
						,loop			: false
						,lazyload		:true
					});
				});
		//]]>	
		</script>
		
	</div>

<?php endif;

wp_reset_postdata();