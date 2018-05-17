<?php

	add_action( 'product_cat_add_form_fields', 'tvlgiao_wpdance_wd_add_category_fields',19 );
	add_action( 'product_cat_edit_form_fields', 'tvlgiao_wpdance_wd_edit_category_fields', 10,2 );
	add_action( 'created_term', 'tvlgiao_wpdance_wd_category_fields_save', 10,3 );
	add_action( 'edit_term', 'tvlgiao_wpdance_wd_category_fields_save', 10,3 );
	add_action( 'delete_term', 'tvlgiao_wpdance_wd_category_fields_remove', 10,3 );

function tvlgiao_wpdance_wd_add_category_fields(){
?>

	<div class="form-field">
		<label for="display_type"><?php esc_html_e( 'Product Columns', 'wpnoone' ); ?></label>
		<select name="cat_columns" id="_prod_cat_columns" class="postform">
			<option value="0"> Default </option>
			<option value="2"> 2 Columns </option>
			<option value="3"> 3 Columns </option>
			<option value="4"> 4 Columns </option>
			<option value="5"> 5 Columns </option>
		</select>
	</div>

	<div class="form-field">
		<label for="display_type"><?php esc_html_e( 'Category Layout', 'wpnoone' ); ?></label>
		<select name="cat_layout" id="_prod_cat_layout" class="postform">
			<option value="0"> Default </option>
			<option value="0-1-0"> Fullwidth </option>
			<option value="0-1-1"> Right Sidebar </option>
			<option value="1-1-0"> Left Sidebar </option>
			<option value="1-1-1"> Left & Right Sidebar </option>
		</select>
	</div>


	<div class="form-field">
		<label for="display_type"><?php esc_html_e( 'Custom Informations', 'wpnoone' ); ?></label>
		<hr />
		<?php wp_editor( stripslashes(htmlspecialchars_decode('')), 'cat_custom_content' );	?>			
	</div>	


<?php							
}

function tvlgiao_wpdance_wd_edit_category_fields( $term, $taxonomy ){
		
	$datas = get_metadata( 'woocommerce_term', $term->term_id, "cat_config", true );
	if( strlen($datas) > 0 ){
		$datas = unserialize($datas);	
	}else{
		$datas = get_option(TVLGiao_Wpdance_THEME_SLUG.'category_product_config','');
		$datas = unserialize($datas);
		
		$datas = tvlgiao_wd_array_atts(
			array(
						'cat_columns' 				=> 0
						,'cat_layout' 				=> "0"
						,'cat_left_sidebar' 		=> "0"
						,'cat_right_sidebar' 		=> "0"
						,'cat_custom_content'		=> ''
				)
			,$datas);		
	}
?>

	<tr class="form-field">
		<th scope="row" valign="top"><label><?php esc_html_e( 'Product Columns', 'wpnoone' ); ?></label></th>
		<td>
			<select name="cat_columns" id="_prod_cat_columns" class="postform">
				<option value="0" <?php if( strcmp($datas["cat_columns"],'0') == 0 ) echo "selected='selected'";?>> Default </option>
				<option value="2" <?php if( strcmp($datas["cat_columns"],'2') == 0 ) echo "selected='selected'";?>> 2 Columns </option>
				<option value="3" <?php if( strcmp($datas["cat_columns"],'3') == 0 ) echo "selected='selected'";?>> 3 Columns </option>
				<option value="4" <?php if( strcmp($datas["cat_columns"],'4') == 0 ) echo "selected='selected'";?>> 4 Columns </option>
				<option value="5" <?php if( strcmp($datas["cat_columns"],'6') == 0 ) echo "selected='selected'";?>> 5 Columns </option>
			</select>
		</td>
	</tr>

	<tr class="form-field">
		<th scope="row" valign="top"><label><?php esc_html_e( 'Category Layout', 'wpnoone' ); ?></label></th>
		<td>
			<select name="cat_layout" id="_prod_cat_layout" class="postform">
				<option value="0" <?php if( strcmp($datas["cat_layout"],'0') == 0 ) echo "selected='selected'";?>> Default </option>
				<option value="0-1-0" <?php if( strcmp($datas["cat_layout"],'0-1-0') == 0 ) echo "selected='selected'";?>> Fullwidth </option>
				<option value="0-1-1" <?php if( strcmp($datas["cat_layout"],'0-1-1') == 0 ) echo "selected='selected'";?>> Right Sidebar </option>
				<option value="1-1-0" <?php if( strcmp($datas["cat_layout"],'1-1-0') == 0 ) echo "selected='selected'";?>> Left Sidebar </option>
				<option value="1-1-1" <?php if( strcmp($datas["cat_layout"],'1-1-1') == 0 ) echo "selected='selected'";?>> Left & Right Sidebar </option>
			</select>
		</td>
	</tr>
	
	<tr class="form-field">
		<th scope="row" valign="top"><label><?php esc_html_e( 'Left SideBar', 'wpnoone' ); ?></label></th>
		<td>
			<select name="cat_left_sidebar" id="_prod_cat_left_sidebar" class="postform">
				<option value="0" <?php if( strcmp($datas["cat_left_sidebar"],'0') == 0 ) echo "selected='selected'";?>> Default </option>
				<?php
				$tvlgiao_wpdance_default_sidebars = tvlgiao_wpdance_load_global_var_default_sidebars();
					foreach( $tvlgiao_wpdance_default_sidebars as $key => $_sidebar ){
						$_selected_str = ( strcmp($datas["cat_left_sidebar"],$_sidebar['id']) == 0 ) ? "selected='selected'"  : "";
						echo "<option value='{$_sidebar['id']}' {$_selected_str}>{$_sidebar['name']}</option>";
					}
				?>
			</select>
		</td>
	</tr>
	
	<tr class="form-field">
		<th scope="row" valign="top"><label><?php esc_html_e( 'Right Sidebar', 'wpnoone' ); ?></label></th>
		<td>
			<select name="cat_right_sidebar" id="_prod_cat_right_sidebar" class="postform">
				<option value="0" <?php if( strcmp($datas["cat_right_sidebar"],'0') == 0 ) echo "selected='selected'";?>> Default </option>
				<?php
					$tvlgiao_wpdance_default_sidebars = tvlgiao_wpdance_load_global_var_default_sidebars();
					foreach( $tvlgiao_wpdance_default_sidebars as $key => $_sidebar ){
						$_selected_str = ( strcmp($datas["cat_right_sidebar"],$_sidebar['id']) == 0 ) ? "selected='selected'"  : "";
						echo "<option value='{$_sidebar['id']}' {$_selected_str}>{$_sidebar['name']}</option>";
					}
				?>
			</select>
		</td>
	</tr>
	
	<tr class="form-field">
		<th scope="row" valign="top"><label><?php esc_html_e( 'Custom Informations', 'wpnoone' ); ?></label></th>
		<td>
			<?php wp_editor( stripslashes(htmlspecialchars_decode( $datas['cat_custom_content'] )), 'cat_custom_content' );	?>			
		</td>
	</tr>
<?php
}
function tvlgiao_wpdance_wd_category_fields_save( $term_id, $tt_id, $taxonomy ){
	
	if( isset($_POST['_inline_edit']) ) {
        return $term_id;	
	}	
	
	$_term_config = array();
	
	$_term_config["cat_columns"] = isset( $_POST['cat_columns'] ) ? absint( $_POST['cat_columns'] ) : 0 ;
	$_term_config["cat_layout"] = isset( $_POST['cat_layout'] ) ? wp_kses_data( $_POST['cat_layout'] ) : "0" ;
	$_term_config["cat_left_sidebar"] = isset( $_POST['cat_left_sidebar'] ) ? wp_kses_data( $_POST['cat_left_sidebar'] ) : "0" ;
	$_term_config["cat_right_sidebar"] = isset( $_POST['cat_right_sidebar'] ) ? wp_kses_data( $_POST['cat_right_sidebar'] ) : "0" ;
	$_term_config["cat_custom_content"] = isset( $_POST['cat_custom_content'] ) ? htmlspecialchars( $_POST['cat_custom_content']) : "" ;
	
	$_term_config_str = serialize($_term_config);
	
	$result = update_metadata( 'woocommerce_term',$term_id,"cat_config",$_term_config_str );

}

function tvlgiao_wpdance_wd_category_fields_remove( $term_id, $tt_id, $taxonomy ){
	delete_metadata( 'woocommerce_term',$term_id,"cat_config" );
}

?>