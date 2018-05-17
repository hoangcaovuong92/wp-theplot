<?php
/**
 * Edit address form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-edit-address.php.
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

global $woocommerce, $current_user;

$page_title = ( $load_address == 'billing' ) ? esc_html__( 'Billing Address', 'wpnoone' ) : esc_html__( 'Shipping Address', 'wpnoone' );

get_currentuserinfo();
?>
<div class="col-sm-18">

<?php wc_print_notices();?>

<?php if (!$load_address) : ?>

	<?php wc_get_template('myaccount/my-address.php'); ?>

<?php else : ?>
	<div class="wd_edit_address">
		<h2 class="my-account-title"><?php esc_html_e('edit address','wpnoone'); ?></h2>
		<form method="post">

			<h3><?php echo apply_filters( 'woocommerce_my_account_edit_address_title', $page_title ); ?></h3>

			<?php foreach ( $address as $key => $field ) : ?>

				<?php woocommerce_form_field( $key, $field, ! empty( $_POST[ $key ] ) ? wc_clean( $_POST[ $key ] ) : $field['value'] ); ?>

			<?php endforeach; ?>

			<p>
				<input type="submit" class="button" name="save_address" value="<?php esc_html_e( 'Save Address', 'wpnoone' ); ?>" />
				<?php wp_nonce_field( 'woocommerce-edit_address' ); ?>
				<input type="hidden" name="action" value="edit_address" />
			</p>

		</form>
	</div>
<?php endif; ?>

</div>

<div class="col-sm-6">
	<?php tvlgiao_wpdance_wd_myaccount_menu_custom();?>
</div>