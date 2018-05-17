<?php
/**
 * Checkout Form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.5
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;

wc_print_notices();

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout
if ( ! $checkout->enable_signup && ! $checkout->enable_guest_checkout && ! is_user_logged_in() ) {
	echo apply_filters( 'woocommerce_checkout_must_be_logged_in_message', esc_html__( 'You must be logged in to checkout.', 'wpnoone' ) );
	return;
}

$_user_logged = is_user_logged_in();
$_counter = 1;
// filter hook for include new pages inside the payment method
$get_checkout_url = apply_filters( 'woocommerce_get_checkout_url', esc_url( wc_get_checkout_url() ) ); ?>



	<?php if ( sizeof( $checkout->checkout_fields ) > 0 ) : ?>

		<div class="accordion" id="accordion-checkout-details">
		
		<?php if(!$_user_logged):?>
			<div class="accordion-group" id="accordion-method">				
				<div id="collapse-login-regis" class="accordion-body collapse <?php echo esc_attr($_counter == 1 ? "in" : ""); ?>">
					<div class="accordion-inner">						
						<div class="col-sm-12 second">	
							<h3><?php esc_html_e('Return Customer','wpnoone');?></h3>
							<?php woocommerce_checkout_login_form(); ?>
							
						</div>
						
						<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>
					</div>
				</div>
			</div>		
			<?php $_counter++;?>
		<?php endif;?>	
		
			<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( $get_checkout_url ); ?>">		
				
				<div class="accordion-group hidden accordion-createaccount" id="accordion-account">
					<div class="accordion-heading">
						<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion-checkout-details" href="#collapse-createaccount">
							<h3 id="order_review_heading" class="heading-title checkout-title"><?php esc_html_e("Create an account",'wpnoone'); ?></h3>
						</a>
					</div>
					<div id="collapse-createaccount" class="accordion-body collapse">
						<div class="accordion-inner">
							<?php if ( ! is_user_logged_in() && $checkout->enable_signup ) : ?>

								<?php if ( $checkout->enable_guest_checkout ) : ?>

									<p class="form-row">
										<input class="input-checkbox" id="createaccount" <?php checked($checkout->get_value('createaccount'), true) ?> type="checkbox" name="createaccount" value="1" /> <label for="createaccount" class="checkbox"><?php esc_html_e( 'Create an account?', 'wpnoone' ); ?></label>
									</p>

								<?php endif; ?>

								<?php do_action( 'woocommerce_before_checkout_registration_form', $checkout ); ?>

								<div class="create-account">

									<!--<p><?php esc_html_e( 'Create an account by entering the information below. If you are a returning customer please login at the top of the page.', 'wpnoone' ); ?></p>-->

									<?php foreach ($checkout->checkout_fields['account'] as $key => $field) : ?>

										<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>

									<?php endforeach; ?>

									<div class="clear"></div>

								</div>
								
								<?php do_action( 'woocommerce_after_checkout_registration_form', $checkout ); ?>
							<?php endif; ?>	
							<?php //$woocommerce->nonce_field('register', 'register') ?>
							<input type="button" value="<?php esc_html_e( "Continue","wpnoone" );?>" name="button_billing_address_continue" class="button_billing_address_continue button next_co_btn" rel="accordion-billing">
						</div>
					</div>
				</div>					
							

				<div class="accordion-group" id="accordion-billing">
					<div class="accordion-heading">
						<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion-checkout-details" href="#collapse-billing">
							<h3 id="order_review_heading" class="heading-title checkout-title">
								<?php if ( wc_ship_to_billing_address_only() && WC()->cart->needs_shipping() ) : ?>
									<h3><?php _e( 'Billing &amp; Shipping', 'wpnoone' ); ?></h3>
								<?php else : ?>
									<h3><?php esc_html_e( 'Billing Details', 'wpnoone' ); ?></h3>
								<?php endif; ?>
							</h3>
						</a>
					</div>
					<div id="collapse-billing" class="accordion-body collapse <?php echo esc_attr($_counter == 1 ? "in" : ""); ?>">
						<div class="accordion-inner">
							<?php do_action( 'woocommerce_checkout_billing' ); ?>
							<input type="button" value="<?php esc_html_e( "Continue","wpnoone" );?>" name="button_shipping_address_continue" class="button_shipping_address_continue button next_co_btn" rel="accordion-shipping">
						</div>
					</div>
				</div>
				<?php $_counter++;?>
				

				<div class="accordion-group" id="accordion-review">
					<div class="accordion-review-inner">
						<div class="accordion-heading">
							<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion-checkout-details" href="#collapse-order-review">
								<h3 id="order_review_heading" class="heading-title checkout-title"><?php esc_html_e( 'Your order', 'wpnoone' ); ?></h3>
							</a>
						</div>
						<div id="collapse-order-review" class="accordion-body collapse in">
							<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>
							<div id="order_review" class="accordion-inner woocommerce-checkout-review-order">
								<?php do_action( 'woocommerce_checkout_order_review' ); ?>
							</div>
							<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
						</div>
					</div>
				</div>
				<?php $_counter++;?>
				
			</form>	
		
		</div>
	

		<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

	<?php endif; ?>

<div class="after_checkout_form" style="margin-bottom: 60px;">
	<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
	<?php do_action( 'wd_after_checkout_form', $checkout ); ?>
</div>