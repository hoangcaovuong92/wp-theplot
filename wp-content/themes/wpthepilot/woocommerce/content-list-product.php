<?php global $product;
  $post = TvlgiaoWpdanceClassNameVar::TVLGiao_wpdance_GetVar("post");
 ?>
<section class="product">
	<?php echo do_action('wd_product_loop_before');?>
	
	<a class="thumbnail" href="<?php echo esc_url( get_permalink( $product->get_id() ) ); ?>" title="<?php echo esc_attr( $product->get_title() ); ?>">
		<?php echo wp_kses_post($product->get_image()); ?>
	</a>
	<div class="content">
		<a href="<?php echo esc_url(get_permalink($post->ID)); ?>" class="product-title-widget" ><?php echo esc_attr(get_the_title($post->ID)); ?></a>
		<?php echo wc_get_rating_html( $product->get_average_rating() ); ?>
		<?php echo wp_kses_post($product->get_price_html()); ?>
	</div>
	
</section>