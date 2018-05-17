<?php
/**
 * Single Product Meta
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.5
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product;
$post = TvlgiaoWpdanceClassNameVar::TVLGiao_wpdance_GetVar("post");
?>
<div class="product_meta">

	<?php do_action( 'woocommerce_product_meta_start' ); ?>


	<?php
		$size = sizeof( get_the_terms( $post->ID, 'product_cat' ) );
		echo wp_kses_post(wc_get_product_category_list($product->get_id(), ', ', '<span class="posted_in">' . _n( 'Category:', 'Categories:', $size, 'wpnoone' ) . ' ', '.</span>' ));
	?>

	<?php
		$size = sizeof( get_the_terms( $post->ID, 'product_tag' ) );
		echo wp_kses_post(wc_get_product_tag_list($product->get_id(), ', ', '<span class="tagged_as">' . _n( 'Tag:', 'Tags:', $size, 'wpnoone' ) . ' ', '.</span>' ));
	?>

	<?php do_action( 'woocommerce_product_meta_end' ); ?>

</div>