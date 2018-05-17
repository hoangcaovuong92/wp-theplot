<?php
/**
 * Pay for order form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.5
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;
?>
<form id="order_review" method="post">

	<table class="shop_table">
		<thead>
			<tr>
				<th class="product-name"><?php esc_html_e( 'Product', 'wpnoone' ); ?></th>
				<th class="product-total"><?php esc_html_e( 'Total', 'wpnoone' ); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php
			if (sizeof($order->get_items())>0) :
				foreach ($order->get_items() as $item_key => $item) :
					$_product = wc_get_product( $item['product_id'] );
					echo '
						<tr>
							<td class="product-name">'.
								'<div class="wd_product_item">
									<a href="'.esc_url( get_permalink( $item['product_id'] )).'">'
										.$_product->get_image('tvlgiao_wpdance_cart_dropdown').
									'</a>'.
								'</div>'.
								'<p class="wd_product_title">'. $item['name'] . '</p>'.
								'<p class="wd_product_number"><strong class="product-quantity">&times; ' . $item['qty']. '</strong></p>'.
								'<p class="wd_product_excerpt">'.substr(strip_tags($_product->post->post_excerpt),0,60).'</p>'.
							'</td>
							<td class="product-total">' . $order->get_formatted_line_subtotal($item) . '</td>
						</tr>';
				endforeach;
			endif;
			?>
		</tbody>
		<tfoot>
		<?php
			if ( $totals = $order->get_order_item_totals() ) foreach ( $totals as $total ) :
				?>
				<tr>
					<th scope="row" colspan="2"><?php echo esc_html($total['label']); ?></th>
					<td class="product-total"><?php echo esc_html($total['value']); ?></td>
				</tr>
				<?php
			endforeach;
		?>
		</tfoot>
	</table>

	<div id="payment">
		<?php if ( $order->needs_payment() ) : ?>
			<h3><?php esc_html_e( 'Payment', 'wpnoone' ); ?></h3>
			<ul class="payment_methods methods">
				<?php
					if ( $available_gateways = $woocommerce->payment_gateways->get_available_payment_gateways() ) {
						// Chosen Method
						if ( sizeof( $available_gateways ) )
							current( $available_gateways )->set_current();

						foreach ( $available_gateways as $gateway ) {
							?>
							<li>
								<input type="radio" id="payment_method_<?php echo esc_attr($gateway->id); ?>" class="input-radio" name="payment_method" value="<?php echo esc_attr( $gateway->id ); ?>" <?php if ($gateway->chosen) echo 'checked="checked"'; ?> />
								<label for="payment_method_<?php echo esc_attr($gateway->id); ?>"><?php echo esc_html($gateway->get_title()); ?> <?php echo esc_html($gateway->get_icon()); ?></label>
								<?php
									if ( $gateway->has_fields() || $gateway->get_description() ) {
										echo '<div class="payment_box payment_method_' . $gateway->id . '" style="display:none;">';
										$gateway->payment_fields();
										echo '</div>';
									}
								?>
							</li>
							<?php
						}
					} else {

						echo '<p>'.esc_html__( 'Sorry, it seems that there are no available payment methods for your location. Please contact us if you require assistance or wish to make alternate arrangements.', 'wpnoone' ).'</p>';

					}
				?>
			</ul>
		<?php endif; ?>

		<div class="form-row">
			<?php wp_nonce_field( 'woocommerce-pay' ); ?>
			<?php
				$pay_order_button_text = apply_filters( 'woocommerce_pay_order_button_text', esc_html__( 'Pay for order', 'wpnoone' ) );
				
				echo apply_filters( 'woocommerce_pay_order_button_html', '<input type="submit" class="button alt" id="place_order" value="' . esc_attr( $pay_order_button_text ) . '" data-value="' . esc_attr( $pay_order_button_text ) . '" />' );
			?>			
			<input type="hidden" name="woocommerce_pay" value="1" />
		</div>

	</div>

</form>