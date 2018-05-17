<?php
/**
 * Grouped product add to cart
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.5
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce, $product;
$post = TvlgiaoWpdanceClassNameVar::TVLGiao_wpdance_GetVar("post");

$parent_product_post = $post;

?>

<?php do_action('woocommerce_before_add_to_cart_form'); ?>

<form class="cart product_detail" method="post" enctype='multipart/form-data'>
	<div class="grouped_products">
		<?php 
				$wd_prod_id = $product->get_id(); //fix quickshop
				//echo count($grouped_products); die();
				foreach ( $grouped_products as $product_id ) :
					$product = wc_get_product( $product_id );
					//$post    = $product->post;
					//setup_postdata( $post );
					?>
					<div class="grouped_product_item">
						<h3 class="wd_product<?php echo (( $availability = $product->get_availability() ) && $availability['availability']  ) ? '_'.esc_attr( $availability['class'] ) : ''; ?>">
							<?php echo wp_kses_post($product->is_visible() ? '<a href="' . esc_url( get_permalink()) . '">' . get_the_title() . '</a>' : get_the_title()); ?>
						</h3>
						<table class="variations" cellspacing="0">
							<tbody>
								<?php do_action ( 'woocommerce_grouped_product_list_before_price', $product ); ?>

								<tr>
									<td class="label"><label class="bold-upper" for="pa_size"><?php esc_html_e('Price','wpnoone');?></label></td>
									<td>
										<?php
										echo wp_kses_post($product->get_price_html());

										if ( ( $availability = $product->get_availability() ) && $availability['availability'] )
											echo apply_filters( 'woocommerce_stock_html', '<p class="stock ' . esc_attr( $availability['class'] ) . '">' . esc_html( $availability['availability'] ) . '</p>', $availability['availability'] );
										?>
									</td>
								</tr>

								<tr>
									<td class="label"><label class="bold-upper" for="pa_size"><?php esc_html_e('Quantity','wpnoone');?></label></td>
									<td>
										<?php if ( $product->is_sold_individually() || ! $product->is_purchasable() ) : ?>
										<?php woocommerce_template_loop_add_to_cart(); ?>
										<?php else : ?>
											<?php
											$quantites_required = true;
											woocommerce_quantity_input( array( 'input_name' => 'quantity[' . $product_id . ']', 'input_value' => '0' ) );
											?>
										<?php endif; ?>
									</td>
								</tr>

							</tbody>
						</table>
					</div>
				<?php endforeach; 
				// Reset to parent grouped product
				//wp_reset_postdata();	
				$post    = $parent_product_post;
				$product = wc_get_product( $parent_product_post->ID );
				setup_postdata( $parent_product_post );
				?>

			</div>
			<!--<input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" />-->
			<input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $wd_prod_id ); ?>" />

			<?php if ( $quantites_required ) : ?>

				<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

				<button type="submit" class="single_add_to_cart_button button alt big"><?php echo esc_html($product->single_add_to_cart_text()); ?></button>

				<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>

			<?php endif; ?>

		</form>

		<?php do_action('woocommerce_after_add_to_cart_form'); ?>