<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop;
 $tvlgiao_wpdance_wd_data = TvlgiaoWpdanceClassNameVar::TVLGiao_wpdance_GetVar("wd_data");

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
	$woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) )
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
	
	// Ensure visibility
if ( ! $product && ! $product->is_visible() )
	return;	


	$_columns = absint($woocommerce_loop['columns']);
	$moble_count = (round( $_columns * 480 / 1200 ) > 3)? round( $_columns * 480 / 1200 ): 3 ;
	$mb = absint($_columns) > 1? 1: 1;
	$_sub_class = "wd-col-lg-".$_columns;
	$_sub_class .= ' wd-col-md-'.round( $_columns * 992 / 1200);
	$_sub_class .= ' wd-col-sm-'.round( $_columns * 768 / 1200,PHP_ROUND_HALF_UP);
	$_sub_class .= ' wd-col-xs-'.$mb;
	$_sub_class .= ' wd-col-mb-'.$mb;
	
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
$classes[] = 'product';
?>
<section <?php post_class( $classes ); ?>>
	
	
	<div class="product-thumbnail-wrapper wd_sec_border">
		<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
	
		<a href="<?php the_permalink(); ?>">

			<?php
				do_action( 'woocommerce_before_shop_loop_item_title' );
			?>
		</a>
		
		<?php do_action( 'wd_woocommerce_shop_loop_buttons' ); ?>
		
	</div>
	<div class="product-meta-wrapper">
		<div class="product-meta-inner">
		<?php
			do_action( 'woocommerce_after_shop_loop_item_title' );
		?>
		<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
		</div>
	</div>
	
</section>