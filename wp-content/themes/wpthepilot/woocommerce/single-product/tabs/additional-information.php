<?php
/**
 * Additional Information tab
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.5
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce, $post, $product;

$heading = apply_filters( 'woocommerce_product_additional_information_heading', esc_html__( 'Additional Information', 'wpnoone' ) );
?>

<h2><?php echo esc_html($heading); ?></h2>

<?php wc_display_product_attributes($product); ?>