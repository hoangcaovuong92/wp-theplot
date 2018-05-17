<?php
/**
 * Variable product add to cart
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.5
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce, $product;
 $post = TvlgiaoWpdanceClassNameVar::TVLGiao_wpdance_GetVar("post");
 $tvlgiao_wpdance_wd_data = TvlgiaoWpdanceClassNameVar::TVLGiao_wpdance_GetVar("wd_data");
?>

<?php do_action('woocommerce_before_add_to_cart_form'); ?>

<form class="variations_form cart product_detail" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $product->get_id() ); ?>" data-product_variations="<?php echo esc_attr( json_encode( $available_variations ) ) ?>">
		<?php do_action( 'woocommerce_before_variations_form' ); ?>
	<?php if ( ! empty( $available_variations ) ) : ?>	
		<table class="variations">
			<tbody>
				<?php 
				if(class_exists('WD_Shopbycolor')) {
					$_color = 'color';
					$attribute_color = ( isset( $_color ) )? wc_sanitize_taxonomy_name( stripslashes( (string) $_color ) ) : '';
				} else {
					$attribute_color = '';
				}
				
				?>
					<tr><td colspan="2" class="notied"><?php esc_html_e('Please select the required options to display prices', 'wpnoone');?></td></tr>
				<?php $loop = 0; foreach ( $attributes as $name => $options ) : $loop++; ?>
					<tr>
						<td class="label"><label class="bold-upper" for="<?php echo sanitize_title($name); ?>"><?php echo wc_attribute_label( $name ); ?> <abbr class="required" title="required">*</abbr></label></td>
						<td class="value">
							<?php 
							$hide_select = "";
							if($attribute_color !== ''){
								if($name == wc_attribute_taxonomy_name( $attribute_color )){
									if ( is_array( $options ) ) {
										if ( taxonomy_exists( $name ) ) {
											echo tvlgiao_wpdance_wd_color_image_option_html($name, $options);
											
										}
									}
									$hide_select = "style=\"display:none;\"";
								}
							}
							
							?>
							
							<select <?php echo wp_kses_post($hide_select);?> id="<?php echo esc_attr( sanitize_title($name) ); ?>" name="attribute_<?php echo sanitize_title($name); ?>" data-attribute_name="attribute_<?php echo sanitize_title( $name ); ?>">
							<option value=""><?php echo esc_html__( 'Choose an option', 'wpnoone' ) ?>&hellip;</option>
							<?php
								if ( is_array( $options ) ) {

									if ( isset( $_REQUEST[ 'attribute_' . sanitize_title( $name ) ] ) ) {
										$selected_value = $_REQUEST[ 'attribute_' . sanitize_title( $name ) ];
									} elseif ( isset( $selected_attributes[ sanitize_title( $name ) ] ) ) {
										$selected_value = $selected_attributes[ sanitize_title( $name ) ];
									} else {
										$selected_value = '';
									}

									// Get terms if this is a taxonomy - ordered
									if ( taxonomy_exists( $name ) ) {
										
										$terms = wc_get_product_terms( $post->ID, $name, array( 'fields' => 'all' ) );

										foreach ( $terms as $term ) {
											if ( ! in_array( $term->slug, $options ) ) {
												continue;
											}
											echo '<option value="' . esc_attr( $term->slug ) . '" ' . selected( sanitize_title( $selected_value ), sanitize_title( $term->slug ), false ) . '>' . apply_filters( 'woocommerce_variation_option_name', $term->name ) . '</option>';
										}
										
									} else {

										foreach ( $options as $option ) {
											echo '<option value="' . esc_attr( sanitize_title( $option ) ) . '" ' . selected( sanitize_title( $selected_value ), sanitize_title( $option ), false ) . '>' . esc_html( apply_filters( 'woocommerce_variation_option_name', $option ) ) . '</option>';
										}

									}
								}
							?>
						</select> <?php 
							if ( sizeof( $attributes ) === $loop ) {
								echo '<p class="wd_reset_variations"><a class="reset_variations" href="#reset">' . esc_html__( 'Clear selection', 'wpnoone' ) . '</a></p>';
							}
						?></td>
					</tr>
				<?php endforeach;?>
				<?php do_action( 'woocommerce_before_single_variation' ); ?>	
					<tr class="single_variation_wrap" style="display:none;">
						<td class="label"><label><?php esc_html_e('Price', 'wpnoone');?></label></td>
						<td class="value">
							<?php if( $tvlgiao_wpdance_wd_data['wd_prod_price'] == 1 ) { ?>
								<div class="single_variation"></div>
							<?php } ?>
						</td>
					</tr>
					
					<?php do_action('woocommerce_before_add_to_cart_button'); ?>
					
					<tr class="single_variation_wrap" style="display:none;">
						<td class="label"><label><?php esc_html_e('Quantity', 'wpnoone');?></label></td>
						<td class="value">
							<div class="variations_button">
								<input type="hidden" name="variation_id" class="variation_id" value="" />
								<?php woocommerce_quantity_input(); ?>
								<!--button type="submit" class="single_add_to_cart_button button alt big"><?php echo apply_filters('single_add_to_cart_text', esc_html__( 'Add to cart', 'wpnoone' ), $product->get_type()); ?></button-->
							</div>
						</td>
					</tr>
					
					
				<?php do_action( 'woocommerce_after_single_variation' ); ?>	
			</tbody>
		</table>

		<div class="single_variation_wrap" style="display:none;">
			<button type="submit" class="single_add_to_cart_button button alt big"><?php echo apply_filters('single_add_to_cart_text', esc_html__( 'Add to cart', 'wpnoone' ), $product->get_type()); ?></button>
		</div>
		
		<div>	
			<input type="hidden" name="add-to-cart" value="<?php echo wp_kses_post($product->get_id()); ?>" />
			<input type="hidden" name="product_id" value="<?php echo esc_attr( $post->ID ); ?>" />
			<input type="hidden" name="variation_id" class="variation_id" value="" />
		</div>
		<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
		
	<?php else : ?>

		<p class="stock out-of-stock"><?php esc_html_e( 'This product is currently out of stock and unavailable.', 'wpnoone' ); ?></p>

	<?php endif; ?>
</form>

<?php do_action('woocommerce_after_add_to_cart_form'); ?>

<?php
function tvlgiao_wpdance_wd_color_image_option_html($name, $options){ 
	$orderby = wc_attribute_orderby( $name );
	switch ( $orderby ) {
		case 'name' :
			$args = array( 'orderby' => 'name', 'hide_empty' => false, 'menu_order' => false );
			break;
		case 'id' :
			$args = array( 'orderby' => 'id', 'order' => 'ASC', 'menu_order' => false, 'hide_empty' => false );
			break;
		case 'menu_order' :
			$args = array( 'menu_order' => 'ASC', 'hide_empty' => false );
			break;
	}
	$terms = get_terms( $name, $args );
	$select_opt = '';
	$select_opt .= "<div class=\"wd_color_image_swap\">";
	foreach ( $terms as $term ) {		
		if ( ! in_array( $term->slug, $options ) )
			continue;
		$datas = get_metadata( 'woocommerce_term', $term->term_id, "wd_pc_color_config", true );
		if( strlen($datas) > 0 ){
			$datas = unserialize($datas);	
		}else{
			$datas = array(
				'wd_pc_color_color' 				=> "#aaaaaa"
				,'wd_pc_color_image' 				=> 0
			);
		}
		$select_opt .= "<div class=\"wd-select-option\" data-value=\"".esc_attr($term->slug)."\">";
		if( absint($datas['wd_pc_color_image']) > 0 ){
			$_img = wp_get_attachment_image_src( absint($datas['wd_pc_color_image']), 'wd_pc_thumb', true ); 
			$_img = $_img[0];
			
			$select_opt .= "<img alt=\"".$datas['wd_pc_color_color']."\" src=\"".esc_url( $_img )."\" class=\"wd_pc_preview_image\" />";
			
		} else {
			$select_opt .= "<a href=\"#\" style=\"width: 30px; height:30px; background-color: ".$datas['wd_pc_color_color']."\"></a>";
		}
		$select_opt .= "</div>";
		
	}
	$select_opt .= "</div>";
	
	return $select_opt;
}
