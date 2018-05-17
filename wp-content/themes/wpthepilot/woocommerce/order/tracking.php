<?php
/**
 * Order tracking
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.5
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$order_status_text = sprintf( __( 'Order %s which was made %s has the status &ldquo;%s&rdquo;', 'wpnoone' ), $order->get_order_number(), wc_format_datetime( $order->get_date_created() ) . ' ' . __( 'ago', 'wpnoone' ), wc_get_order_status_name( $order->get_status() ) );

if ( $order->has_status( 'completed' ) ) $order_status_text .= ' ' . __( 'and was completed', 'wpnoone' ) . ' ' . human_time_diff( strtotime( $order->completed_date ), current_time( 'timestamp' ) ) . __( ' ago', 'wpnoone' );

$order_status_text .= '.';

echo wpautop( esc_attr( apply_filters( 'woocommerce_order_tracking_status', $order_status_text, $order ) ) );

$notes = $order->get_customer_order_notes();

if ( $notes ) : ?>
	<h2><?php esc_html_e( 'Order Updates', 'wpnoone' ); ?></h2>
	<ol class="commentlist notes">
		<?php foreach ( $notes as $note ) : ?>
		<li class="comment note">
			<div class="comment_container">
				<div class="comment-text">
					<p class="meta"><?php echo date_i18n( __( 'l jS \o\f F Y, h:ia', 'wpnoone' ), strtotime( $note->comment_date ) ); ?></p>
					<div class="description">
						<?php echo wpautop( wptexturize( wp_kses_post( $note->comment_content ) ) ); ?>
					</div>
	  				<div class="clear"></div>
	  			</div>
				<div class="clear"></div>
			</div>
		</li>
		<?php endforeach; ?>
	</ol>
	<?php endif; ?>

<?php do_action( 'woocommerce_view_order', $order->id ); ?>
