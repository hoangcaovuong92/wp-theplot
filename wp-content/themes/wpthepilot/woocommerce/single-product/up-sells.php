<?php
/**
 * Single Product Up-Sells
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.5
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop;

$upsells = $product->get_upsells(10);

if ( sizeof( $upsells ) == 0 ) return;

$meta_query = WC()->query->get_meta_query();

$args = array(
	'post_type'           => 'product',
	'ignore_sticky_posts' => 1,
	'no_found_rows'       => 1,
	'posts_per_page'      => -1,//=$posts_per_page,
	'orderby'             => $orderby,
	'post__in'            => $upsells,
	'post__not_in'        => array( $product->get_id() ),
	'meta_query'          => $meta_query
);


$products = new WP_Query( $args );

$woocommerce_loop['columns'] 	= $columns;

if ( $products->have_posts() ) : ?>

	<?php  $tvlgiao_wpdance_wd_data = TvlgiaoWpdanceClassNameVar::TVLGiao_wpdance_GetVar("wd_data"); ?>

	<div class="upsells grid">

		<h3 class="heading-title"><?php echo esc_html($_upsell_title = sprintf( __( '%s','wpnoone' ), stripslashes(esc_attr($tvlgiao_wpdance_wd_data['wd_prod_upsell_title'])) )); ?></h3>
		<div class="line line-30"></div>

		<div class="upsell_wrapper wd-loading">
		
			<?php woocommerce_product_loop_start(); ?>

				<?php while ( $products->have_posts() ) : $products->the_post(); ?>

					<?php wc_get_template_part( 'content', 'product' ); ?>

				<?php endwhile; // end of the loop. ?>

			<?php woocommerce_product_loop_end(); ?>
		</div>
		
		<script type="text/javascript" language="javascript">
			
			jQuery(document).ready(function() {
                "use strict";
                var $_this = jQuery('.upsell_wrapper');
				var owl = $_this.find('.products').owlCarousel({
					item : 4
					,responsive		:{
						0:{
							items:2
						},
						480:{
							items:2
						},
						768:{
							items: 3
						},
						992:{
							items: 4
						},
						1200:{
							items:4
						}
					}
					,onInitialized: function(){
						$_this.addClass('wd-loaded').removeClass('wd-loading');
					}
					,nav : true
					,navText		: [ '<', '>' ]
					,dots			: false
					,loop			: true
					,lazyload		:true
				});
			});
		</script>
	</div>

<?php endif;
wp_reset_postdata();
