<?php  
	$tvlgiao_wpdance_wd_data = TvlgiaoWpdanceClassNameVar::TVLGiao_wpdance_GetVar("wd_data") ;
?>

<div class="wd-sticky animated" id="wd-sticky">
	<div class="header-middle hidden-xs" style="float: none;">
		<div class="header-middle-content">
			<div class="container">
				<div class="row">
				<div class="header-middle-inner">
					<div class="header-middle-left col-sm-6">
					<?php tvlgiao_wpdance_theme_logo();?>
					</div>
					<?php if(isset($tvlgiao_wpdance_wd_data['wd_header_style'])):?>
						<div class="shopping-cart shopping-cart-wrapper hidden-xs <?php echo ( isset($tvlgiao_wpdance_wd_data['wd_enable_cart_header_top']) && !absint($tvlgiao_wpdance_wd_data['wd_enable_cart_header_top']) )? 'wd_cart_disable':'';?>">
							<?php if( !isset($tvlgiao_wpdance_wd_data['wd_enable_cart_header_top']) || absint($tvlgiao_wpdance_wd_data['wd_enable_cart_header_top']) ) echo tvlgiao_wpdance_wd_tini_cart();?>
						</div>
					<?php endif;?>
					<div class="nav wd_mega_menu_wrapper">
						<?php 
							if ( function_exists( 'ubermenu' ) && has_nav_menu( 'primary' )): 
						      ubermenu( 'main',array('theme_location'=>'primary') );
							 else:
							 wp_nav_menu( array( 'menu_class' => 'sf-menu') );
							 endif;
						?>
					</div>
					<div class="clear"></div>
				</div>
				</div>
			</div>
		</div>
	</div><!-- end .header-middle -->	
	<?php wp_reset_postdata();?>

	
	
</div><!-- #wd-sticky -->

