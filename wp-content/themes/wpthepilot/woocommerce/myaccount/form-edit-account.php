<?php
/**
 * Edit account form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-edit-account.php.
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

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
<div class="col-sm-18">
<?php wc_print_notices();?>

<div class="wd_edit_account">
	<h2 class="my-account-title"><?php esc_html_e('edit account','wpnoone') ?></h2>
	<form action="" method="post">
		
		<?php do_action( 'woocommerce_edit_account_form_start' ); ?>
		
		<p class="form-row form-row-first">
			<label for="account_first_name"><?php esc_html_e( 'First name', 'wpnoone' ); ?> <span class="required">*</span></label>
			<input type="text" class="input-text" name="account_first_name" id="account_first_name" value="<?php echo esc_attr( $user->first_name ); ?>" />
		</p>
		<p class="form-row form-row-last">
			<label for="account_last_name"><?php esc_html_e( 'Last name', 'wpnoone' ); ?> <span class="required">*</span></label>
			<input type="text" class="input-text" name="account_last_name" id="account_last_name" value="<?php echo esc_attr( $user->last_name ); ?>" />
		</p>
		<p class="form-row form-row-wide">
			<label for="account_email"><?php esc_html_e( 'Email address', 'wpnoone' ); ?> <span class="required">*</span></label>
			<input type="email" class="input-text" name="account_email" id="account_email" value="<?php echo esc_attr( $user->user_email ); ?>" />
		</p>
		
		<fieldset>
			<legend><?php esc_html_e( 'Password Change', 'wpnoone' ); ?></legend>
			<p class="form-row form-row-wide">
				<label for="password_current"><?php esc_html_e( 'Current Password (leave blank to leave unchanged)', 'wpnoone' ); ?></label>
				<input type="password" class="input-text" name="password_current" id="password_current" />
			</p>
			<p class="form-row form-row-wide">
				<label for="password_1"><?php esc_html_e( 'New Password (leave blank to leave unchanged)', 'wpnoone' ); ?></label>
				<input type="password" class="input-text" name="password_1" id="password_1" />
			</p>
			<p class="form-row form-row-wide">
				<label for="password_2"><?php esc_html_e( 'Confirm New Password', 'wpnoone' ); ?></label>
				<input type="password" class="input-text" name="password_2" id="password_2" />
			</p>
		</fieldset>
		<div class="clear"></div>
		
		<?php do_action( 'woocommerce_edit_account_form' ); ?>
		
		<p>
			<?php wp_nonce_field( 'save_account_details' ); ?>
			<input type="submit" class="button" name="save_account_details" value="<?php esc_html_e( 'Save changes', 'wpnoone' ); ?>" />
			<input type="hidden" name="action" value="save_account_details" />
		</p>

		<?php do_action( 'woocommerce_edit_account_form_end' ); ?>
		
	</form>
</div>

</div>