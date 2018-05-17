<?php
/**
 * Description tab
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.5
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;

$heading = esc_html( apply_filters('woocommerce_product_description_heading', esc_html__( 'Product Description', 'wpnoone' ) ) );
?>

<?php the_content(); ?>