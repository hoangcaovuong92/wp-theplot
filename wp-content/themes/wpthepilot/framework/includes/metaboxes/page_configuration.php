<?php 
	 $post = TvlgiaoWpdanceClassNameVar::TVLGiao_wpdance_GetVar("post");
	$revolution_exists = ( class_exists('RevSlider') && class_exists('UniteFunctionsRev') );
	$layerslider_exists = ( class_exists('LS_Sliders') );
	$datas = unserialize(get_post_meta($post->ID,TVLGiao_Wpdance_THEME_SLUG.'page_configuration',true));
	$datas = tvlgiao_wd_array_atts(array(										
										"header_style"			=> '0'
										,"page_column"			=> '0-1-0'
										,"left_sidebar" 		=>'primary-widget-area'
										,"right_sidebar" 		=> 'primary-widget-area'
										,"page_slider" 			=> 'none'
										,"page_slider_pos"		=> ''
										,"page_revolution" 		=> ''
										,"page_layerslider"		=> ''	
										,"hide_breadcrumb" 		=> 0		
										,"hide_title" 			=> 0										
										,"hide_top_content"		=> 1
								),$datas);								
?>
<div class="page_config_wrapper">
	<div class="page_config_wrapper_inner">
		<input type="hidden" value="1" name="_page_config">
		<?php wp_nonce_field( "_update_page_config", "nonce_page_config" ); ?>
		<ul class="page_config_list">															
			<li>
				<p>
					<label><?php esc_html_e('Header Style','wpnoone');?> : </label>
					<select name="header_style" id="header_style">
						<option value="0" <?php if( strcmp($datas['header_style'],'0') == 0 ) echo "selected";?>>Inherit</option>
						<option value="v1" <?php if( strcmp($datas['header_style'],'v1') == 0 ) echo "selected";?>>Style 1</option>
						<option value="v2" <?php if( strcmp($datas['header_style'],'v2') == 0 ) echo "selected";?>>Style 2</option>
						<option value="v3" <?php if( strcmp($datas['header_style'],'v3') == 0 ) echo "selected";?>>Style 3</option>
					</select>
				</p> 
			</li>
			
			<li>
				<p>
					<label><?php esc_html_e('Page Layout','wpnoone');?> : </label>
					<select name="page_column" class="global_config" id="page_column" data-config=".layout_">
						<option value="0-1-0" <?php if( strcmp($datas['page_column'],'0-1-0') == 0 ) echo "selected";?>>Fullwidth</option>
						<option value="1-1-0" <?php if( strcmp($datas['page_column'],'1-1-0') == 0 ) echo "selected";?>>Left Sidebar</option>
						<option value="0-1-1" <?php if( strcmp($datas['page_column'],'0-1-1') == 0 ) echo "selected";?>>Right Sidebar</option>
						<option value="1-1-1" <?php if( strcmp($datas['page_column'],'1-1-1') == 0 ) echo "selected";?>>Left & Right Sidebar</option>
					</select>
				</p> 
			</li>

			<li class="global_sub layout_sub layout_1-1-0 layout_1-1-1" style="display:none">
				<p>
					<label><?php esc_html_e('Left Sidebar','wpnoone');?> : </label>
					<select name="left_sidebar" id="_left_sidebar">
						<?php
					$tvlgiao_wpdance_default_sidebars = tvlgiao_wpdance_load_global_var_default_sidebars();
							foreach( $tvlgiao_wpdance_default_sidebars as $key => $_sidebar ){
								$_selected_str = ( strcmp($datas["left_sidebar"],$_sidebar['id']) == 0 ) ? "selected='selected'"  : "";
								echo "<option value='{$_sidebar['id']}' {$_selected_str}>{$_sidebar['name']}</option>";
							}
						?>
					</select>
				</p> 
			</li>
			<li class="global_sub layout_sub layout_0-1-1 layout_1-1-1" style="display:none">
				<p>
					<label><?php esc_html_e('Right Sidebar','wpnoone');?> : </label>
					<select name="right_sidebar" id="_right_sidebar">
						<?php
					$tvlgiao_wpdance_default_sidebars = tvlgiao_wpdance_load_global_var_default_sidebars();
							foreach( $tvlgiao_wpdance_default_sidebars as $key => $_sidebar ){
								$_selected_str = ( strcmp($datas["right_sidebar"],$_sidebar['id']) == 0 ) ? "selected='selected'"  : "";
								echo "<option value='{$_sidebar['id']}' {$_selected_str}>{$_sidebar['name']}</option>";
							}
						?>
					</select>
				</p> 
			</li>												
			<li>
				<p>
					<label><?php esc_html_e('Hide Breadcrumb','wpnoone');?> : </label>
					<select name="hide_breadcrumb" id="_hide_breadcrumb">
						<option value="0" <?php if( absint($datas['hide_breadcrumb']) == 0 ) echo "selected";?>>No</option>
						<option value="1" <?php if( absint($datas['hide_breadcrumb']) == 1 ) echo "selected";?>>Yes</option>
					</select>
				</p> 			
			</li>
			<li>
				<p>
					<label><?php esc_html_e('Hide Page Title','wpnoone');?> : </label>
					<select name="hide_title" id="_hide_title">
						<option value="0" <?php if( absint($datas['hide_title']) == 0 ) echo "selected";?>>No</option>
						<option value="1" <?php if( absint($datas['hide_title']) == 1 ) echo "selected";?>>Yes</option>
					</select>
				</p> 			
			</li>
			<li class="last">
				<p>
					<label><?php esc_html_e('Hide Top Content Widget Area','wpnoone');?> : </label>
					<select name="hide_top_content" id="_hide_top_content">
						<option value="0" <?php if( absint($datas['hide_top_content']) == 0 ) echo "selected";?>>No</option>
						<option value="1" <?php if( absint($datas['hide_top_content']) == 1 ) echo "selected";?>>Yes</option>
					</select>
				</p> 			
			</li>
			
			<li>
				<p>
					<label><?php esc_html_e('Page Slider','wpnoone');?> : </label>
					<select name="page_slider" id="page_slider" class="global_config" data-config=".slider_">
						<option value="none" <?php if( strcmp($datas['page_slider'],'none') == 0 ) echo "selected";?>>No Slider</option>
						<?php if( $revolution_exists ):?>
						<option value="revolution" <?php if( strcmp($datas['page_slider'],'revolution') == 0 ) echo "selected";?>>Revolution Slider</option>
						<?php endif; ?>
						<?php if( $layerslider_exists):?>
						<option value="layerslider" <?php if( strcmp($datas['page_slider'],'layerslider') == 0 ) echo "selected";?>>Layer Slider</option>
						<?php endif; ?>
					</select>
				</p> 			
			</li>
			
			<li class="global_sub slider_sub slider_revolution slider_layerslider slider_flex slider_nivo" style="display:none">
				<p>
					<label><?php esc_html_e('Page Slider position','wpnoone');?> : </label>
					<select name="page_slider_pos" id="page_slider_pos">
						<option value="after_header" <?php if( strcmp($datas['page_slider_pos'],'after_header') == 0 ) echo "selected";?>>After header</option>
						<option value="before_header" <?php if( strcmp($datas['page_slider_pos'],'before_header') == 0 ) echo "selected";?>>After menu</option>
					</select>
				</p> 			
			</li>
			
			<?php if( $revolution_exists ): ?>
			<li class="global_sub slider_sub slider_revolution" style="display:none">
				<p>
					<label><?php esc_html_e('Revolution Slider','wpnoone');?> : </label>
					<?php
						$slider = new RevSlider();
						$arrSliders = $slider->getArrSlidersShort();
						$sliderID = $datas['page_revolution'];
						if(count($arrSliders) > 0):
					?>
					<?php echo $select = UniteFunctionsRev::getHTMLSelect($arrSliders,$sliderID,'name="page_revolution" id="page_revolution_id"',true); ?>					
					<?php 
						else:
							echo '<strong>Please Create A Revolution Slider.</strong>';
						endif;
					?>
				</p> 			
			</li>
			<?php endif;?>	
		</ul>
	</div>
</div>
