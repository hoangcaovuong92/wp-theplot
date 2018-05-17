<?php
/**
 * Change password form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.5
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;
?>

<div class="col-sm-18">

<?php wc_print_notices();?>

<form action="<?php echo esc_url( get_permalink( wc_get_page_id('change_password')) ); ?>" method="post">

	<p class="form-row form-row-first">
		<label for="password_1"><?php esc_html_e( 'New password', 'wpnoone' ); ?> <span class="required">*</span></label>
		<input type="password" class="input-text" name="password_1" id="password_1" />
	</p>
	<p class="form-row form-row-last">
		<label for="password_2"><?php esc_html_e( 'Re-enter new password', 'wpnoone' ); ?> <span class="required">*</span></label>
		<input type="password" class="input-text" name="password_2" id="password_2" />
	</p>
	<div class="clear"></div>

	<p><input type="submit" class="button" name="change_password" value="<?php esc_html_e( 'Save', 'wpnoone' ); ?>" /></p>

	<?php wp_nonce_field( 'woocommerce-change_password' ); ?>
	<input type="hidden" name="action" value="change_password" />

</form>

</div>

<div class="col-sm-6">
	<?php tvlgiao_wpdance_wd_myaccount_menu_custom();?>
</div>