<?php
/**
 * Single Product Share
 *
 * Sharing plugins can hook into here or you can add your own code directly.
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.5
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>
<?php
	$tvlgiao_wpdance_wd_data = TvlgiaoWpdanceClassNameVar::TVLGiao_wpdance_GetVar("wd_data");
?>
<?php do_action('woocommerce_share'); // Sharing plugins can hook into here ?>
<div class="social_sharing wd-social">
	
	<div class="social_icon">
		
		<div class="facebook">
			<a class="social_item" title="<?php esc_html_e("share on facebook", 'wpnoone')?>" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url(get_permalink());?>"><i class="fa fa-facebook"></i></a>
		</div>
		
		<div class="twitter">
			<a class="social_item" title="<?php esc_html_e("Tweet on Twitter", 'wpnoone')?>" href="https://twitter.com/home?status=<?php echo esc_url(get_permalink());?>"><i class="fa fa-twitter"></i></a>
		</div>
		
		<div class="google">
			<a class="social_item" title="<?php esc_html_e("share on Google +", 'wpnoone')?>" href="https://plus.google.com/share?url=<?php echo esc_url(get_permalink());?>"><i class="fa fa-google-plus"></i></a>
		</div>
		
		<div class="pinterest">
			<?php $image_link  = wp_get_attachment_url( get_post_thumbnail_id() );?>
			<a class="social_item" title="<?php esc_html_e("Pin it", 'wpnoone')?>" href="<?php echo esc_url("https://pinterest.com/pin/create/button/?url=" . get_permalink() . '&media=' . $image_link );?>"><i class="fa fa-pinterest"></i></a>
		</div>

		<?php if(isset($tvlgiao_wpdance_wd_data["wd_prod_share_code"])) echo stripslashes(do_shortcode(htmlspecialchars_decode($tvlgiao_wpdance_wd_data["wd_prod_share_code"])));?>
		
		<script type="text/javascript">
			jQuery(document).ready(function(){
                "use strict";
                jQuery('.social_icon .social_item').click(function(){
					var url = jQuery(this).attr('href');
					var title = jQuery(this).attr('title');
					window.open(url, title,"width=700, height=520");
					return false;
				});
			});
		</script>
		
		
	</div>            
</div>