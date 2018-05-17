<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.5
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop;
 $tvlgiao_wpdance_wd_data = TvlgiaoWpdanceClassNameVar::TVLGiao_wpdance_GetVar("wd_data");

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
	$woocommerce_loop['loop'] = 0;

	// Ensure visibility
if ( ! $product && ! $product->is_visible() )
	return;	
	
//>=1200 >=992 >=768 >=480 >=320
$_sub_class = "wd-col-lg-4 wd-col-md-4 wd-col-sm-3 wd-col-xs-2 wd-col-mb-1";
	
	
	if(isset($columns) && absint($columns) > 0) $woocommerce_loop['columns'] = $columns; else $woocommerce_loop['columns'] = 1;
	$_columns = $woocommerce_loop['columns'];
	$_sub_class = "wd-col-lg-".$_columns;
	$_sub_class .= ' wd-col-md-'.floor( $_columns * 992 / 1200);
	$_sub_class .= ' wd-col-sm-'.floor( $_columns * 768 / 1200);
	$_sub_class .= ' wd-col-xs-'.floor( $_columns * 480 / 1200);
	$_sub_class .= ' wd-col-mb-1';
	
//}	

// Increase loop count
$woocommerce_loop['loop']++;

// Extra post classes
$classes = array();
if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] )
	$classes[] = 'first';
if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] )
	$classes[] = 'last';

//add on column class on cat page	
$classes[] = $_sub_class ;
$classes[] = "product";
?>
<section <?php post_class( $classes ); ?>>
	
	<!--div class="product-hover-box"-->
	
	<div class="product-thumbnail-wrapper wd_sec_border">
		<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
	
		<a href="<?php the_permalink(); ?>">

			<?php
				/**
				 * woocommerce_before_shop_loop_item_title hook
				 *
				 * @hooked woocommerce_show_product_loop_sale_flash - 10
				 * @hooked woocommerce_template_loop_product_thumbnail - 10
				 */
				do_action( 'woocommerce_before_shop_loop_item_title' );
			?>
		</a>
	</div>
	<div class="product-meta-wrapper">
		<?php
			/**
			 * woocommerce_after_shop_loop_item_title hook
			 *
			 * @hooked woocommerce_template_loop_rating - 5
			 * @hooked woocommerce_template_loop_price - 10
			 */
			//do_action( 'woocommerce_after_shop_loop_item_title' );
		?>

		<?php if( empty($shortc_limit)) $shortc_limit = 75;?>

		<?php //do_action( 'woocommerce_after_shop_loop_item', $shortc_limit ); ?>
	</div>
	
	
	
</section>