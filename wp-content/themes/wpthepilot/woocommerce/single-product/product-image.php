<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.5
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce, $product;
$post = TvlgiaoWpdanceClassNameVar::TVLGiao_wpdance_GetVar("post");
$tvlgiao_wpdance_wd_data = TvlgiaoWpdanceClassNameVar::TVLGiao_wpdance_GetVar("wd_data");
$shop_single	= wc_get_image_size( 'shop_single' );
$style = $shop_single['width'];
?>
<div class="images" <?php echo 'style="max-width:'.$style.'px;"';?>>

	<?php do_action( 'wd_before_product_image' ); ?>
	
	<?php
		if ( has_post_thumbnail() ) {

			$image_title 		= esc_attr( $product->get_title() );
			$image       		= get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ),array( 'alt' => $image_title, 'title' => $image_title,'srcset' => ' ' ) );
			$image_link  		= wp_get_attachment_url( get_post_thumbnail_id() );
			$attachment_count   = count( $product->get_gallery_image_ids() );

			if ( $attachment_count > 0 ) {
				$gallery = '[product-gallery]';
			} else {
				$gallery = '';
			}
			if(!is_singular('product')){
				$link = esc_attr(get_permalink($post->ID) );
				echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" itemprop="image" class="woocommerce-main-image" title="%s">%s</a>', $link, $image_title, $image ), $post->ID );
			} else {
				if($tvlgiao_wpdance_wd_data['wd_prod_cloudzoom'] == 1){
					if( wp_is_mobile() ){
						echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" itemprop="image" class="woocommerce-main-image cloud-zoom zoom" title="%s"  id=\'zoom1\' rel="position:\'inside\',showTitle:1,titleOpacity:0.5,lensOpacity:0.5,fixWidth:362,fixThumbWidth:72,fixThumbHeight:72,adjustX: 0, adjustY:0">%s</a>', $image_link, $image_title, $image ), $post->ID );
					} elseif(is_rtl()){
						echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" itemprop="image" class="woocommerce-main-image cloud-zoom zoom on_pc" title="%s"  id=\'zoom1\' rel="position:\'left\',showTitle:1,titleOpacity:0.5,lensOpacity:0.5,fixWidth:362,fixThumbWidth:72,fixThumbHeight:72, adjustY:-4">%s</a>', $image_link, $image_title, $image ), $post->ID );
					} else {
						echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" itemprop="image" class="woocommerce-main-image cloud-zoom zoom on_pc" title="%s"  id=\'zoom1\' rel="position:\'right\',showTitle:1,titleOpacity:0.5,lensOpacity:0.5,fixWidth:362,fixThumbWidth:72,fixThumbHeight:72, adjustY:-4">%s</a>', $image_link, $image_title, $image ), $post->ID );
					} 
					
				} else {
					echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" itemprop="image" class="woocommerce-main-image zoom" title="%s" data-rel="prettyPhoto' . $gallery . '">%s</a>', $image_link, $image_title, $image ), $post->ID );
				  //echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" itemprop="image" class="woocommerce-main-image zoom" title="%s"  rel="prettyPhoto' . $gallery . '">%s</a>', $image_link, $image_title, $image ), $post->ID );
				}
				
			}
			
		} else {

			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="Placeholder" />', woocommerce_placeholder_img_src() ), $post->ID );

		}
	?>

	<?php do_action( 'woocommerce_product_thumbnails' ); ?>

</div>
