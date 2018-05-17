<?php
	/* Add custom layout for post, portfolio */
	 $post = TvlgiaoWpdanceClassNameVar::TVLGiao_wpdance_GetVar("post");

	$_prod_config = get_post_meta($post->ID,TVLGiao_Wpdance_THEME_SLUG.'custom_product_config',true);
	$_default_prod_config = array(
					'layout' 					=> '0'	/*$datas['layout']*/
					,'left_sidebar' 			=> '0'  /*$datas['left_sidebar']*/
					,'right_sidebar' 			=> '0'	/*$datas['right_sidebar'] */	
	);	
	
	if( strlen($_prod_config) > 0 ){
		$_prod_config = unserialize($_prod_config);
		if( is_array($_prod_config) && count($_prod_config) > 0 ){
			$_prod_config['layout'] = ( isset($_prod_config['layout']) && strlen($_prod_config['layout']) > 0 ) ? $_prod_config['layout'] : $_default_prod_config['layout'];
			$_prod_config['left_sidebar'] = ( isset($_prod_config['left_sidebar']) && strlen($_prod_config['left_sidebar']) > 0 ) ? $_prod_config['left_sidebar'] : $_default_prod_config['left_sidebar'];
			$_prod_config['right_sidebar'] = ( isset($_prod_config['right_sidebar']) && strlen($_prod_config['right_sidebar']) > 0 ) ? $_prod_config['right_sidebar'] : $_default_prod_config['right_sidebar'];
			
		}
	}else{
		$_prod_config = $_default_prod_config;
	}

?>

<div class="select-layout area-config area-config1">
	<div class="area-inner">
		<div class="area-inner1">
			<h3 class="area-title"><?php esc_html_e('Custom Layout','wpnoone'); ?></h3>
			<?php $this->tvlgiao_wpdance_showTooltip(esc_html__("Custom Layout",'wpnoone'),esc_html__('Select custom layout for product page.Using general product page config by default','wpnoone')); ?>
			<div class="area-content">
				<ul class="page_config_list">
					<li class="first">
						<p>
							<label><?php esc_html_e('Page Layout','wpnoone');?> : </label>
							<select name="single_layout" id="_single_prod_layout">
								<option value="0" <?php if( strcmp($_prod_config["layout"],'0') == 0 ) echo "selected='selected'";?>>Default</option>
								<option value="0-1-0" <?php if( strcmp($_prod_config["layout"],'0-1-0') == 0 ) echo "selected='selected'";?>>Fullwidth</option>
								<option value="0-1-1" <?php if( strcmp($_prod_config["layout"],'0-1-1') == 0 ) echo "selected='selected'";?>>Right Sidebar</option>
								<option value="1-1-0" <?php if( strcmp($_prod_config["layout"],'1-1-0') == 0 ) echo "selected='selected'";?>>Left Sidebar</option>
								<option value="1-1-1" <?php if( strcmp($_prod_config["layout"],'1-1-1') == 0 ) echo "selected='selected'";?>>Left & Right Sidebar</option>
							</select>
						</p> 
					</li>
					
					<li>
						<p>
							<label><?php esc_html_e('Left Sidebar','wpnoone');?> : </label>
							<select name="single_left_sidebar" id="_single_prod_left_sidebar">
								<option value="0" <?php if( strcmp($_prod_config["left_sidebar"],'0') == 0 ) echo "selected='selected'";?>>Default</option>
								<?php
								$tvlgiao_wpdance_default_sidebars = tvlgiao_wpdance_load_global_var_default_sidebars();
									foreach( $tvlgiao_wpdance_default_sidebars as $key => $_sidebar ){
										$_selected_str = ( strcmp($_prod_config["left_sidebar"],$_sidebar['id']) == 0 ) ? "selected"  : "";
										echo "<option value='{$_sidebar['id']}' {$_selected_str}>{$_sidebar['name']}</option>";
									}
								?>
							</select>
						</p> 
					</li>
					
					<li>
						<p>
							<label><?php esc_html_e('Right Sidebar','wpnoone');?> : </label>
							<select name="single_right_sidebar" id="_single_prod_right_sidebar">
								<option value="0" <?php if( strcmp($_prod_config["right_sidebar"],'0') == 0 ) echo "selected='selected'";?>>Default</option>
								<?php
								$tvlgiao_wpdance_default_sidebars = tvlgiao_wpdance_load_global_var_default_sidebars();
									foreach( $tvlgiao_wpdance_default_sidebars as $key => $_sidebar ){
										$_selected_str = ( strcmp($_prod_config["right_sidebar"],$_sidebar['id']) == 0 ) ? "selected"  : "";
										echo "<option value='{$_sidebar['id']}' {$_selected_str}>{$_sidebar['name']}</option>";
									}
								?>
							</select>
						</p> 
					</li>
				
				</ul>
						
			
				<input type="hidden" name="custom_product_layout" class="change-layout" value="custom_single_prod_layout"/>
			</div><!-- .area-content -->
		</div>	
			
	</div>	
</div><!-- .select-layout -->