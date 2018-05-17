<?php
/**
 * Lost password form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-lost-password.php.
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
<div class="col-sm-18">
<?php wc_print_notices();?>
<div class="wd_lost_password">
	<h2 class="my-account-title"><?php esc_html_e('lost password','wpnoone');?></h2>
	<form method="post" class="lost_reset_password">

		<?php	if( 'lost_password' == $args['form'] ) : ?>

		<p><?php echo apply_filters( 'woocommerce_lost_password_message', esc_html__( 'Lost your password? Please enter your username or email address. You will receive a link to create a new password via email.', 'wpnoone' ) ); ?></p>

		<p class="form-row form-row-first"><label for="user_login"><?php esc_html_e( 'Username or email', 'wpnoone' ); ?></label> <input class="input-text" type="text" name="user_login" id="user_login" /></p>

		<?php else : ?>

		<p><?php echo apply_filters( 'woocommerce_reset_password_message', esc_html__( 'Enter a new password below.', 'wpnoone') ); ?></p>

		<p class="form-row form-row-first">
			<label for="password_1"><?php esc_html_e( 'New password', 'wpnoone' ); ?> <span class="required">*</span></label>
			<input type="password" class="input-text" name="password_1" id="password_1" />
		</p>
		<p class="form-row form-row-last">
			<label for="password_2"><?php esc_html_e( 'Re-enter new password', 'wpnoone' ); ?> <span class="required">*</span></label>
			<input type="password" class="input-text" name="password_2" id="password_2" />
		</p>

		<input type="hidden" name="reset_key" value="<?php echo isset( $args['key'] ) ? $args['key'] : ''; ?>" />
		<input type="hidden" name="reset_login" value="<?php echo isset( $args['login'] ) ? $args['login'] : ''; ?>" />
		
		<?php endif; ?>

		<div class="clear"></div>

		<p class="form-row">
			<input type="hidden" name="wc_reset_password" value="true" />
			<input type="submit" class="button" value="<?php echo 'lost_password' == $args['form'] ? esc_html__( 'Reset Password', 'wpnoone' ) : esc_html__( 'Save', 'wpnoone' ); ?>" />
		</p>
		
		<?php wp_nonce_field( $args['form'] ); ?>

	</form>
</div>

</div>

<div class="col-sm-6">
	<?php tvlgiao_wpdance_wd_myaccount_menu_custom();?>
</div>