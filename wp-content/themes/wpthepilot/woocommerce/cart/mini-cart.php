<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.5
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;
?>

<?php do_action( 'woocommerce_before_mini_cart' ); ?>

<ul class="cart_list thanhdoi product_list_widget <?php echo esc_attr($args['list_class']); ?>">

	<?php if ( sizeof( WC()->cart->get_cart() ) > 0 ) : ?>

		<?php $_index = 0; $_cart_array = sizeof( WC()->cart->get_cart() );
			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
				$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
				$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {

					$product_name  = apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
					$thumbnail     = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image('tvlgiao_wpdance_cart_dropdown'), $cart_item, $cart_item_key );
					$product_price = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
					
					if($_index < 4){
					?>
					<li class="media <?php echo esc_attr($_cart_li_class = ($_index == 0 ? "first" : ($_index == $_cart_array - 1 ? "last" : ""))); ?>">
						<a class="pull-left" href="<?php echo esc_url( get_permalink( $product_id )); ?>">
							<?php echo wp_kses_post($thumbnail); ?>
						</a>
						<div class="cart_item_wrapper">
							<a class="wd_cart_title" href="<?php echo esc_url( get_permalink( $cart_item['product_id'] )); ?>">
								<?php echo esc_html( $product_name ); ?>
							</a>
							<?php echo wc_get_formatted_cart_item_data($cart_item); ?>
							
							<?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf( '%s &times; %s',$product_price, $cart_item['quantity'] ) . '</span>', $cart_item, $cart_item_key ); ?>
							
							<?php echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="remove" title="%s">&times;</a>', esc_url( wc_get_cart_remove_url($cart_item_key) ), esc_html__( 'Remove this item', 'wpnoone' ) ), $cart_item_key ); ?>
						</div>
						
					</li>
					<?php 
					} else {
						?><li class="media last"><?php esc_html_e('view more on cart page', 'wpnoone');?></li><?php 
						break;
					}
					
					$_index++;
				}
				
				
			} //end foreach
			
		?>
	<?php else : ?>

		<li class="empty"><?php esc_html_e( 'No products in the cart.', 'wpnoone' ); ?></li>

	<?php endif; ?>

</ul><!-- end product list -->

<?php if ( sizeof( WC()->cart->get_cart() ) > 0 ) : ?>

	<p class="total"><strong><?php esc_html_e( 'Subtotal', 'wpnoone' ); ?>:</strong> <?php echo WC()->cart->get_cart_subtotal(); ?></p>

	<?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>

	<p class="buttons">
		<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="button"><?php esc_html_e( 'View Cart', 'wpnoone' ); ?></a>
		<a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="button checkout"><?php esc_html_e( 'Checkout', 'wpnoone' ); ?></a>
	</p>

<?php endif; ?>

<?php do_action( 'woocommerce_after_mini_cart' ); ?>
