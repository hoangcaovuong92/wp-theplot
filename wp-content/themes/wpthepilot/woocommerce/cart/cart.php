<?php
/**
 * Cart Page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version    	3.3.5
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;

wc_print_notices();
?>

<?php do_action( 'woocommerce_before_cart' ); ?>

<form action="<?php echo esc_url( wc_get_cart_url() ); ?>" class="wd_form_cart overflow-x" method="post">

<?php do_action( 'woocommerce_before_cart_table' ); ?>

<table class="shop_table cart" cellspacing="0">
	<thead>
		<tr>
			<th class="product-thumbnail first"><?php esc_html_e( 'Product', 'wpnoone' ); ?></th>
			<?php if(!wp_is_mobile()):?>
			<th class="product-price"><?php esc_html_e( 'Price', 'wpnoone' ); ?></th>
			<?php endif;?>
			<th class="product-quantity"><?php esc_html_e( 'Quantity', 'wpnoone' ); ?></th>
			<th class="product-subtotal"><?php esc_html_e( 'Total', 'wpnoone' ); ?></th>
			<th class="product-remove last">&nbsp;</th>
		</tr>
	</thead>
	<tbody>
		<?php do_action( 'woocommerce_before_cart_contents' ); ?>

		<?php
		foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
			$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
			$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
			
			if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
				?>
				<tr class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_table_item', $cart_item, $cart_item_key ) ); ?>">

					<!-- The thumbnail -->
					<td class="product-thumbnail product-name">
						<div class="wd_product_content">
						<?php
							$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image('tvlgiao_wpdance_cart_dropdown'), $cart_item, $cart_item_key );
							echo '<div class="wd_product_item">';
							if ( ! $_product->is_visible() )
								echo wp_kses_post($thumbnail);
							else
								printf('<a href="%s">%s</a>',  $_product->get_permalink($cart_item), $thumbnail );
							echo '</div>';
							echo '<div class="wd_product_meta">';
							if ( ! $_product->is_visible() )
								echo apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
							else
								echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<h3><a href="%s">%s</a></h3>', $_product->get_permalink($cart_item), $_product->get_title() ), $cart_item, $cart_item_key );
							
							echo '<p class="wd_product_excerpt">'.substr(strip_tags($_product->post->post_excerpt),0,60).'...</p>';
							
							// Meta data
							echo wc_get_formatted_cart_item_data($cart_item);

							// Backorder notification
               				if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) )
               					echo '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'wpnoone' ) . '</p>';
						
							//echo '<p class="wd_product_number">'.apply_filters( 'woocommerce_checkout_item_quantity', '<strong class="product-quantity">&times; ' . $cart_item['quantity'] . '</strong>', $cart_item, $cart_item_key ).'</p>';
							
							echo '</div>';
						?>
					
						</div>
					<!-- Product Name -->
							
					</td>

					<!-- Product price -->
					<?php if(!wp_is_mobile()):?>
					<td class="product-price">
						<?php
							echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
						?>
					</td>
					<?php endif;?>
					
					<!-- Quantity inputs -->
					<td class="product-quantity">
						<?php
							if ( $_product->is_sold_individually() ) {
								$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
							} else {
								$product_quantity = woocommerce_quantity_input( array(
									'input_name'  => "cart[{$cart_item_key}][qty]",
									'input_value' => $cart_item['quantity'],
									'max_value'   => $_product->backorders_allowed() ? '' : $_product->get_stock_quantity(),
								), $_product, false );
							}

							echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key );
						?>
					</td>

					<!-- Product subtotal -->
					<td class="product-subtotal">
						<?php
							echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );
						?>
					</td>
					<td class="product-removelink">
					<?php 
					//Remove from cart link
							echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="remove" title="%s">&times;</a>', esc_url( wc_get_cart_remove_url($cart_item_key) ), esc_html__( 'Remove this item', 'wpnoone' ) ), $cart_item_key );				
					?>
					</td>
				</tr>
				<?php
			}
		}
		

		do_action( 'woocommerce_cart_contents' );
		?>
		<tr class="hidden">
			<td colspan="6" class="actions">

			<input type="submit" class="button hidden wd_update_button_invisible" name="update_cart" value="<?php esc_html_e( 'Update Cart', 'wpnoone' ); ?>" /> 
			
			
			<!--<input type="submit" class="checkout-button button alt" name="proceed" value="<?php esc_html_e( 'Proceed to Checkout', 'wpnoone' ); ?>" />-->
			<?php do_action('woocommerce_proceed_to_checkout'); ?>

			<?php wp_nonce_field( 'woocommerce-cart' ); ?>
			
			</td>
		</tr>

		<?php do_action( 'woocommerce_after_cart_contents' ); ?>
	</tbody>
</table>
<div class="wd_cart_buttons">
	<a href="#" class="button wd_update_button_visible"><?php esc_html_e( 'Update Cart', 'wpnoone' ); ?></a>
	
   <a class="button" href="<?php echo esc_url( wc_get_cart_url() ); ?>?empty-cart"><?php esc_html_e( 'Empty Cart', 'woocommerce' ); ?></a>
	<a class="button backtoshop" href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>"><?php esc_html_e( 'Back To Shop', 'wpnoone' ) ?></a>
</div>
<?php do_action( 'woocommerce_after_cart_table' ); ?>

</form>

<div class="cart-collaterals">
	<div class="cart-collaterals-top">
	<div class="cart_coupon">
	<form action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">	
		<div class="coupon_wrapper">
		
				<?php if ( WC()->cart->coupons_enabled() ) { ?>
					<div class="coupon">
						<h3 class="heading-title"><?php esc_html_e( 'Discount code', 'wpnoone' ); ?></h3>
						<div>
						<input name="coupon_code" placeholder="<?php esc_attr_e('Enter your coupon code if your have one', 'wpnoone');?>" class="input-text" id="coupon_code" value="" /> 
						<input type="submit" class="button" name="apply_coupon" value="<?php esc_html_e( 'Apply Coupon', 'wpnoone' ); ?>" />
						</div>
						<?php do_action('woocommerce_cart_coupon'); ?>

					</div>
				<?php } ?>

		</div>
	</form>
	</div>
	<div class="cart_shipping">
	<?php woocommerce_shipping_calculator(); ?>
	</div>
	<?php woocommerce_cart_totals(); ?>
	</div>
</div>

<?php do_action( 'woocommerce_after_cart' ); ?>