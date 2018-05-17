<?php
/**
 * Single product short description
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.5
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$post = TvlgiaoWpdanceClassNameVar::TVLGiao_wpdance_GetVar("post");

if ( ! $post->post_excerpt ) return;
?>

<div class="short-description" itemprop="description">
	<h6 class="short-description-title"><?php esc_html_e('Quick Overview','wpnoone');?></h6>
	<div class="std">
		<?php echo apply_filters( 'woocommerce_short_description', $post->post_excerpt ) ?>
	</div>	
</div>