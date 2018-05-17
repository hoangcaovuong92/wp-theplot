<?php
/**
 * Checkout login form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.5
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( is_user_logged_in() || 'no' == get_option( 'woocommerce_enable_checkout_login_reminder' ) ) return;


?>

<p class="woocommerce-info"><a href="#" class="showlogin"><?php esc_html_e( 'Click here to login', 'wpnoone' ); ?></a></p>

<?php
	woocommerce_login_form(
		array(
			'message'  => esc_html__( 'If you have shopped with us before, please enter your details in the boxes below. If you are a new customer please proceed to the Billing &amp; Shipping section.', 'wpnoone' ),
			'redirect' => get_permalink( wc_get_page_id( 'checkout') ),
			'hidden'   => true
		)
	);
?>