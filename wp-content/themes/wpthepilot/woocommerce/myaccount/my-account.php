<?php
/**
 * My Account page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.3.5
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;
 ?>

<?php 

if(!wp_is_mobile()){
	$class_1 = "col-sm-18";
	$class_2 = "col-sm-6";
} else {
	$class_1 = $class_2 = '';
}
 
?>
<div class="<?php echo esc_attr($class_1);?>">

<div class="woocommerce-MyAccount-content myaccount_user" style="width: 100%;">
	<?php wc_print_notices(); ?>
	<?php
		/**
		 * My Account content.
		 * @since 2.6.0
		 */
		do_action( 'woocommerce_account_content' );
	?>
</div>


<?php do_action( 'woocommerce_before_my_account' ); ?>

<?php wc_get_template( 'myaccount/my-downloads.php' ); ?>

<?php wc_get_template( 'myaccount/my-orders.php', array( 'order_count' => $order_count ) ); ?>

<?php wc_get_template( 'myaccount/my-address.php' ); ?>

<?php do_action( 'woocommerce_after_my_account' ); ?>

</div>
 <?php if (is_user_logged_in() ) { ?>
<div class="<?php echo esc_attr($class_2);?>">
	<?php tvlgiao_wpdance_wd_myaccount_menu_custom();?>
</div>
 <?php } ?>