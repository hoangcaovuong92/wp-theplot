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
	<?php 
          add_action( 'woocommerce_before_shop_loop_item_title1', 'tvgiao_wd_template_loop_product_thumbnail', 1000);
	?>			
	<?php if ( ! function_exists( 'tvgiao_wd_template_loop_product_thumbnail' ) ) {
    function tvgiao_wd_template_loop_product_thumbnail() {
        echo tvgiao_woocommerce_get_product_thumbnail1();
    }
 }
 if ( ! function_exists( 'tvgiao_woocommerce_get_product_thumbnail1' ) ) {
    function tvgiao_woocommerce_get_product_thumbnail1( $size = 'single_product_large_thumbnail_size', $placeholder_width = 0, $placeholder_height = 0 ) {
        global $post,$product, $woocommerce;

        if ( ! $placeholder_width ) $placeholder_width = 428;
        if ( ! $placeholder_height )$placeholder_height =443;

        $output = '';
		$_classes = "product-image";
        if ( has_post_thumbnail() ) {
			 
            $output .='<div class='. $_classes .'> '. get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ) ) .'</div>';	
					$output .=	$product->get_price_html(); 
        } else {
            $output .= '<img src="'. woocommerce_placeholder_img_src() .'" alt="Placeholder" width="' . $placeholder_width . '" height="' . $placeholder_height . '" />';
        }
		$_uri = esc_url(get_permalink($post->ID));
		$rating_html = wc_get_rating_html( $product->get_average_rating() );
		echo "<div class=\"hover-info\" >";
		echo "<h3 class=\"heading-title product-title\">";
		echo "<a href='{$_uri}'>". esc_attr(get_the_title()) ."</a></h3>";
		echo wp_kses_post($rating_html); 
		echo "</div>";
        return $output;
    }
}
?>

			<?php
		
				do_action( 'woocommerce_before_shop_loop_item_title1' );
			?>
	</div>	
</section>
