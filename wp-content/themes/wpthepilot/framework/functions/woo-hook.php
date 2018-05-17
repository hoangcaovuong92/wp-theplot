<?php
/**
 * @package WordPress
 * @subpackage Roedok
 * @since WD_Responsive
 */

//remove default hook
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );


//add filter hook
add_filter('woocommerce_widget_cart_product_title','tvlgiao_wpdance_add_sku_after_title',100000000000000000000000000000,2);
//add tab to prod page
add_filter( 'woocommerce_product_tabs', 'tvlgiao_wpdance_wd_addon_product_tabs',13 );
//add new tab to prod page
add_filter( 'woocommerce_product_tabs', 'tvlgiao_wpdance_wd_addon_custom_tabs',12 );

add_filter('loop_shop_columns', 'tvlgiao_wpdance_loop_columns');


/**********************Breadcumns Woocommerce Page***********************/
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
add_action( 'wd_before_main_content', 'tvlgiao_wpdance_dimox_shop_breadcrumbs', 10, 0 );
/**********************End Breadcumns Woocommerce Page***********************/

/***************** Begin Content Product *******************/
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
//add sale,featured and off save label
add_action( 'woocommerce_before_shop_loop_item_title', 'tvlgiao_wpdance_add_label_to_product_list', 5 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
add_action( 'woocommerce_before_shop_loop_item_title', 'wd_template_loop_product_thumbnail', 10 );

add_action( 'wd_woocommerce_shop_loop_buttons', 'tvlgiao_wpdance_wd_list_button_div_box_start', 13 );
add_action( 'wd_woocommerce_shop_loop_buttons', 'tvlgiao_wpdance_wd_list_template_loop_add_to_cart', 24 );
add_action( 'wd_woocommerce_shop_loop_buttons', 'woocommerce_template_loop_rating', 25 );
add_action( 'wd_woocommerce_shop_loop_buttons', 'tvlgiao_wpdance_wd_list_button_div_box_end', 26 );



function tvlgiao_wpdance_wd_list_button_div_box_start(){
	
	$style = 'style2';
	echo '<div class="wd_button_list_box '.$style.'">';
}
function tvlgiao_wpdance_wd_list_button_div_box_start_hide(){
	echo '<div class="wd_button_list_box hide">';
}

function tvlgiao_wpdance_wd_list_button_div_box_end(){
	echo '</div>';
}


remove_action( 'woocommerce_before_shop_loop', 'wc_print_notices', 10 );
add_action( 'wd_woocommerce_message', 'wc_print_notices', 10 );

remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
//add_action( 'woocommerce_after_shop_loop_item', 'wd_list_template_loop_add_to_cart', 10 );
add_action ('woocommerce_after_shop_loop_item','tvlgiao_wpdance_open_div_style',1);
add_action ('woocommerce_after_shop_loop_item','tvlgiao_wpdance_add_product_title',4);
add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_rating', 3 );
add_action ('woocommerce_after_shop_loop_item','tvlgiao_wpdance_add_sku_to_product_list',5);
add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_price', 7 );
add_action ('woocommerce_after_shop_loop_item', 'tvlgiao_wpdance_add_short_content' ,8);
add_action ('woocommerce_after_shop_loop_item','tvlgiao_wpdance_close_div_style',12);
add_action( 'woocommerce_after_shop_loop_item', 'tvlgiao_wpdance_wd_list_template_loop_add_to_cart', 13 );
/************************ End Content Product *********************/

add_action( 'wd_ads_sidebar', 'tvlgiao_wpdance_wd_ads_sidebar', 10, 1 );

/***************** Begin Content Single Product *******************/
//remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );


remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
//remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );

add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );

remove_action( 'woocommerce_template_single_add_to_cart', 'woocommerce_template_single_rating', 10 );
//add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 13 );

function tvlgiao_wpdance_rating_sharing_div_open(){
	echo "<div class=\"rating_sharing_box\" style=\"overflow: hidden;\">";
}

function tvlgiao_wpdance_rating_sharing_div_end(){
	echo "</div>";
}
add_action( 'woocommerce_single_product_summary', 'tvlgiao_wpdance_rating_sharing_div_open', 14 );
//add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 14 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );
//add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta',33);
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 40 );
add_action( 'woocommerce_single_product_summary', 'tvlgiao_wpdance_rating_sharing_div_end', 14 );

add_action( 'woocommerce_single_product_summary', 'tvlgiao_wpdance_wd_template_single_availability', 17 );
add_action( 'woocommerce_single_product_summary', 'tvlgiao_wpdance_wd_template_single_sku', 19 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price',7 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );	
add_action( 'woocommerce_after_single_product_summary', 'tvlgiao_wpdance_wd_upsell_display', 15 );
/***************** End Content Single Product *********************/

/***************** Begin Checkout Page *******************/
remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_login_form', 10 );
remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );
add_action( 'wd_after_checkout_form', 'woocommerce_checkout_coupon_form', 10 );
//add_action( 'woocommerce_review_order_before_submit', 'woocommerce_checkout_coupon_form', 10 );
add_action( 'woocommerce_after_checkout_form', 'tvlgiao_wpdance_wd_checkout_add_on_js', 10 );
add_action( 'woocommerce_before_checkout_registration_form', 'tvlgiao_wpdance_wd_checkout_fields_form', 10 );
/***************** End Checkout Page *********************/

/***************** Begin Product-image *******************/
remove_action( 'woocommerce_product_thumbnails', 'tvlgiao_wpdance_wd_template_shipping_return', 30 );
add_action( 'woocommerce_single_product_summary', 'tvlgiao_wpdance_wd_template_shipping_return', 40 );
/***************** End Product-image *********************/
//custom hook
function tvlgiao_wpdance_wd_list_template_loop_add_to_cart(){
	echo "<div class='list_add_to_cart'>";
	woocommerce_template_loop_add_to_cart();
	echo "</div>";
}

add_filter('loop_shop_per_page', 'tvlgiao_wpdance_wd_change_posts_per_page_category' );
function tvlgiao_wpdance_wd_change_posts_per_page_category(){
	global $tvlgiao_wpdance_wd_data;
    if( is_archive('product') ){
        if( isset($tvlgiao_wpdance_wd_data["wd_prod_cat_per_page"]) && (int)$tvlgiao_wpdance_wd_data["wd_prod_cat_per_page"] > 0){
            return (int)$tvlgiao_wpdance_wd_data["wd_prod_cat_per_page"];
        }
    }
}

function tvlgiao_wpdance_add_short_content($num_words=0){
	global $product, $tvlgiao_wpdance_wd_data;
	$theme_ops_limit = (isset($tvlgiao_wpdance_wd_data['wd_prod_cat_shortc_limit']) && $tvlgiao_wpdance_wd_data['wd_prod_cat_shortc_limit'] !== '')? absint($tvlgiao_wpdance_wd_data['wd_prod_cat_shortc_limit']) : 60;
	$num_words = (isset($num_words) && absint($num_words) > 0)? $num_words: $theme_ops_limit;
	$content = get_the_content($product);
	$rs = '';
	$rs .= '<div class="product_short_content">' ;
	//$rs .= strip_tags(substr($content,0,60));
	$rs .= wp_trim_words( strip_tags($content), $num_words, $more = null );
	$rs .= '</div>';
	echo apply_filters('the_content', $rs);
}

function wd_template_loop_product_thumbnail(){
	global $product,$post;
	$_prod_galleries = $product->get_gallery_image_ids( );
	
	$_classes = "product-image";
	if ( !has_post_thumbnail() ){
		$_classes = $_classes . " default-thumb";
	}	
	
	echo "<div class='{$_classes}'>";
	echo woocommerce_get_product_thumbnail();
	echo '<span class="product-image-hover"></span>';
	echo '</div>';

}


if ( ! function_exists( 'tvlgiao_wpdance_wd_subcategory_thumbnail' ) ) {

	/**
	 * Show subcategory thumbnails.
	 *
	 * @access public
	 * @param mixed $category
	 * @subpackage	Loop
	 * @return void
	 */
	function tvlgiao_wpdance_wd_subcategory_thumbnail( $category ) {
		$small_thumbnail_size  	= apply_filters( 'single_product_small_thumbnail_size', 'tvlgiao_wpdance_wd_sub_categories_thumbnail' );
		$dimensions    			= wc_get_image_size( $small_thumbnail_size );
		$thumbnail_id  			= get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true  );

		if ( $thumbnail_id ) {
			$image = wp_get_attachment_image_src( $thumbnail_id, $small_thumbnail_size  );
			$image = $image[0];
		} else {
			$image = wc_placeholder_img_src();
		}

		if ( $image ) {
			// Prevent esc_url from breaking spaces in urls for image embeds
			// Ref: http://core.trac.wordpress.org/ticket/23605
			$image = str_replace( ' ', '%20', $image );

			echo '<img src="' . esc_url( $image ) . '" alt="' . esc_attr( $category->name ) . '" width="' . esc_attr( $dimensions['width'] ) . '" height="' . esc_attr( $dimensions['height'] ) . '" />';
		}
	}
}
remove_action( 'woocommerce_before_subcategory_title', 'woocommerce_subcategory_thumbnail', 10 );
add_action( 'woocommerce_before_subcategory_title', 'tvlgiao_wpdance_wd_subcategory_thumbnail', 10 );

//open a div to wrap all product meta
function tvlgiao_wpdance_open_div_style(){
	echo "<div class=\"product-meta-content\">";
}
//close div product meta wrapper
function tvlgiao_wpdance_close_div_style(){
	echo "</div>";
}

function tvlgiao_wpdance_add_product_title(){
	global $post, $product,$product_datas;
	$_uri = esc_url(get_permalink($post->ID));
	echo "<h3 class=\"heading-title product-title\">";
	echo "<a href='{$_uri}'>". esc_attr(get_the_title());
}


function tvlgiao_wpdance_add_label_to_product_list(){
	global $post, $product,$product_datas;
	echo '<div class="product_label">';
	if ($product->is_on_sale()){ 
		if( $product->get_regular_price() > 0 ){
			$_off_percent = (1 - round($product->get_price() / $product->get_regular_price(), 2))*100;
			$_off_price = round($product->get_regular_price() - $product->get_price(), 0);
			$_price_symbol = get_woocommerce_currency_symbol();
			echo "<span class=\"onsale show_off product_label\">{$_off_percent}%</span>";	
		}else{
			echo "<span class=\"onsale product_label\">".esc_html__( 'Save','wpnoone' )."</span>";
		}
	}
	elseif ($product->is_featured()){
		echo "<span class=\"featured product_label\">".esc_html__( 'New','wpnoone' )."</span>";
	}
	echo "</div>";
}

function tvlgiao_wpdance_add_sku_to_product_list(){
	global $product, $woocommerce_loop;
	echo "</h3><span class=\"product_sku\">" . esc_attr($product->get_sku()) . "</span>";
}



/***** Custom Wishlist - Compare *****/

add_action( 'wd_woocommerce_shop_loop_buttons', 'tvlgiao_wpdance_wd_woocommerce_product_buttons_box_start', 14 );

add_action( 'wd_woocommerce_shop_loop_buttons', 'tvlgiao_wpdance_wd_woocommerce_product_buttons_box_end', 21 );

function tvlgiao_wpdance_wd_woocommerce_product_buttons_box_start(){
	?>
	<div class="wd_woocommerce_prod_btns_group">
	<?php 
}

function tvlgiao_wpdance_wd_woocommerce_product_buttons_box_end(){
	?>
	</div><!--end .wd_woocommerce_prod_btns_group-->
	<?php 
}

if( class_exists('YITH_WCWL_UI') && class_exists('YITH_WCWL') ){
	
	function tvlgiao_wpdance_wd_add_wishlist_button_to_product_list_shortocode(){ 
		$html = do_shortcode('[yith_wcwl_add_to_wishlist]');
		$html = str_replace('<div class="clear"></div>', '',$html);
		echo $html;
	}
	
	add_action( 'woocommerce_after_shop_loop_item', 'tvlgiao_wpdance_wd_add_wishlist_button_to_product_list_shortocode', 15 );
	add_action( 'wd_woocommerce_shop_loop_buttons', 'tvlgiao_wpdance_wd_add_wishlist_button_to_product_list_shortocode', 14 );
	add_action( 'woocommerce_after_add_to_cart_button', 'tvlgiao_wpdance_wd_add_wishlist_button_to_product_list_shortocode', 15 );
	add_action( 'woocommerce_after_add_to_cart_button' , 'tvlgiao_wpdance_wd_remove_yith_wishlist_button', 16 );
	
	function tvlgiao_wpdance_wd_remove_yith_wishlist_button(){
		?>
		<script type="text/javascript">
			jQuery(document).ready(function(){
                "use strict";
                jQuery('body.woocommerce #content div.product .summary .yith-wcwl-add-to-wishlist').eq(1).remove();
			});
		</script>
		<?php
	}
}

if( class_exists( 'YITH_Woocompare_Frontend' ) && class_exists( 'YITH_Woocompare' ) ) {
	global $yith_woocompare;
	
	$is_ajax = ( defined( 'DOING_AJAX' ) && DOING_AJAX );
	if( $yith_woocompare->is_frontend() || $is_ajax ) {
		if( $is_ajax ){
			$yith_woocompare->obj = new YITH_Woocompare_Frontend();
		}
		
		if ( (get_option('yith_woocompare_compare_button_in_products_list') == 'yes') ) { 
			
			add_action( 'woocommerce_after_shop_loop_item', 'tvlgiao_wpdance_wd_add_compare_link', 20 );
			add_action( 'wd_woocommerce_shop_loop_buttons', 'tvlgiao_wpdance_wd_add_compare_link', 14 );
		}
		
	}
	
	function tvlgiao_wpdance_wd_add_compare_link( ) {
        global $yith_woocompare, $product; 
		$fontend = $yith_woocompare->obj;
        $product_id = method_exists($product, 'get_id') ? $product->get_id() : 0;
		
        // return if product doesn't exist
        if ( empty( $product_id ) ) return;

        $is_button = !isset( $button_or_link ) || !$button_or_link ? get_option( 'yith_woocompare_is_button' ) : $button_or_link;

        if ( ! isset( $button_text ) || $button_text == 'default' ) {
            $button_text = get_option( 'yith_woocompare_button_text', esc_html__( 'Compare', 'wpnoone' ) );
			$button_text = function_exists( 'icl_translate' ) ? icl_translate( 'Plugins', 'plugin_yit_compare_button_text', $button_text ) : $button_text;
        }

        printf( '<a href="%s" class="%s" data-added_link="%s" data-product_id="%d">%s</a>', $fontend->add_product_url( $product_id ), 'wd_compare add' . ( $is_button == 'button' ? ' button' : '' ), get_permalink(get_page_by_path('compare')), $product_id, $button_text );
     }
	
	function tvlgiao_wpdance_wd_add_compare_button1(){
		if(is_singular( 'product' )){
			tvlgiao_wpdance_wd_add_compare_link();
		}
	}
	
	global $yith_woocompare;
	remove_action( 'woocommerce_single_product_summary', array(  $yith_woocompare->obj, 'add_compare_link' ), 35 );
	remove_action( 'woocommerce_after_shop_loop_item', array( $yith_woocompare->obj, 'add_compare_link' ), 20 );
	
	if ( (get_option('yith_woocompare_compare_button_in_product_page') == 'yes') ) {
		add_action( 'woocommerce_after_add_to_cart_button', 'tvlgiao_wpdance_wd_add_compare_button1', 16 );
	}
	
}

function tvlgiao_wpdance_wd_add_style_yith_compare(){
	$css_file = get_template_directory_uri() .'/css/yith_compare.css';
	echo '<link rel="stylesheet" type="text/css" media="all" href="'.$css_file.'" />';
	$js_file =  get_template_directory_uri() .'/js/yith_compare.js';
	echo '<script type="text/javascript" src="'.$js_file.'"></script>';
}
if( isset($_GET['action'],$_GET['iframe']) && $_GET['action'] == 'yith-woocompare-view-table' && $_GET['iframe'] == "true" )
	add_action('wp_head','tvlgiao_wpdance_wd_add_style_yith_compare');
	



function tvlgiao_wpdance_add_sku_after_title($title,$product){
	$prod_uri = "<a href='".get_permalink( $product->get_id() )."'>";
	$_sku_string = "<span class=\"product_sku\">{$product->get_sku()}</span>";
	return $title.$_sku_string;
}

function tvlgiao_wpdance_wd_addon_product_tabs( $tabs = array() ){
		global $product, $post,$tvlgiao_wpdance_wd_data;
		// Description tab - shows product content
		if ( $post->post_excerpt )
			$tabs['description'] = array(
				'title'    => esc_html__( 'Description', 'wpnoone' ),
				'priority' => 10,
				'callback' => 'woocommerce_product_description_tab'
			);

		
		// Reviews tab - shows comments
		if ( comments_open() && $tvlgiao_wpdance_wd_data['wd_prod_review'] )
			$tabs['reviews'] = array(
				'title'    => sprintf( __( 'Reviews (%d)', 'wpnoone' ), get_comments_number( $post->ID ) ),
				'priority' => 90,
				'callback' => 'comments_template'
			);

		if ( $product->has_attributes() || ( get_option( 'woocommerce_enable_dimension_product_attributes' ) == 'yes' && ( $product->has_dimensions() || $product->has_weight() ) ) )
			$tabs['additional_information'] = array(
				'title'    => esc_html__( 'Additional Information', 'wpnoone' ),
				'priority' => 20,
				'callback' => 'woocommerce_product_additional_information_tab'
			);	
		return $tabs;
}

function tvlgiao_wpdance_wd_addon_custom_tabs ( $tabs = array() ){
	global $tvlgiao_wpdance_wd_data;
	if($tvlgiao_wpdance_wd_data['wd_prod_customtab']) {
		$tabs['wd_custom'] = array(
			'title'    =>  sprintf( __( '%s','wpnoone' ), stripslashes(esc_html($tvlgiao_wpdance_wd_data['wd_prod_customtab_title'])) )
			,'priority' => 70
			,'callback' => "tvlgiao_wpdance_print_custom_tabs"
		);
		return $tabs; 
	}
}

function tvlgiao_wpdance_print_custom_tabs(){
	global $tvlgiao_wpdance_wd_data;
	echo stripslashes(htmlspecialchars_decode($tvlgiao_wpdance_wd_data['wd_prod_customtab_content']));
}

/// end new tabs

function tvlgiao_wpdance_wd_template_shipping_return(){
	global $tvlgiao_wpdance_wd_data;
	if(isset($tvlgiao_wpdance_wd_data['wd_prod_ship_return']) && absint($tvlgiao_wpdance_wd_data['wd_prod_ship_return'])){
?>
	<div class="return-shipping">        
        <div class="content-quick">
            <h3 class="title-quickshop text-uppercase text_color">
			<?php 
				echo esc_attr($title = sprintf( __( '%s','wpnoone' ), stripslashes(esc_attr($tvlgiao_wpdance_wd_data['wd_prod_ship_return_title'])) ));
			?>
		</h3>
		<?php echo stripslashes($tvlgiao_wpdance_wd_data['wd_prod_ship_return_content']);?> 
        </div>
	</div>
<?php
	}
}


function tvlgiao_wpdance_wd_template_single_availability(){
	global $product;
	$_product_stock = tvlgiao_wpdance_get_product_availability($product);
	//$_product_stock = $product->get_availability();
?>	
	<p class="availability"><span class="wd_availability"><?php esc_html_e('Availability: ','wpnoone'); ?></span><span class="stock <?php echo esc_attr($_product_stock['class']);?>"><?php echo esc_attr($_product_stock['availability']);?></span></p>	
<?php	
	
}	

function tvlgiao_wpdance_wd_template_single_sku(){
	global $product, $post;
	echo "<p class='wd_product_sku'>".esc_html__("sku: ","wpnoone")."<span class=\"product_sku\">" . esc_attr($product->get_sku()) . "</span></p>";
}	

function tvlgiao_wpdance_wd_upsell_display( $posts_per_page = '-1', $columns = 5, $orderby = 'rand' ){
	wc_get_template( 'single-product/up-sells.php', array(
				'posts_per_page'  => 15,
				'orderby'    => 'rand',
				'columns'    => 15
		) );
}

// woocommerce_before_single_product_summary hook
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );

add_action( 'wd_before_product_image', 'tvlgiao_wpdance_add_label_to_product_list', 10 );

function tvlgiao_wpdance_shop_loop_prod_remove_action($data){
	if( isset($data['show_price']) && !(int)$data['show_image']){
		remove_action( 'woocommerce_before_shop_loop_item_title', 'wd_template_loop_product_thumbnail', 10 );
	}
			
	if( isset($data['show_title']) && !(int)$data['show_title']){
		remove_action( 'woocommerce_after_shop_loop_item', 'tvlgiao_wpdance_add_product_title', 3 );
	}
	if( isset($data['show_rating']) && !(int)$data['show_rating']){
		remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_rating', 3 );	
	}
	if( isset($data['show_price']) && !(int)$data['show_price']){
		remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_price', 7 );				
	} 
				
	if( isset($data['show_price']) && !(int)$data['show_label']){
		remove_action( 'woocommerce_before_shop_loop_item_title', 'tvlgiao_wpdance_add_label_to_product_list', 5 );
	}
	if( isset($data['show_short_content']) && !(int)$data['show_short_content'] ){
			remove_action( 'woocommerce_after_shop_loop_item', 'tvlgiao_wpdance_add_short_content',8 );
		}
	if( isset($data['show_price']) && !(int)$data['show_add_to_cart']){
			
		remove_action( 'wd_woocommerce_shop_loop_buttons', 'tvlgiao_wpdance_wd_list_button_div_box_start', 13 );
		add_action( 'wd_woocommerce_shop_loop_buttons', 'tvlgiao_wpdance_wd_list_button_div_box_start_hide', 13 );
		
		global $tvlgiao_wpdance_wd_quickshop;
		remove_action('woocommerce_after_shop_loop_item', array( $tvlgiao_wpdance_wd_quickshop , 'add_quickshop_button'), 25 );
		remove_action( 'woocommerce_after_shop_loop_item', 'tvlgiao_wpdance_wd_add_wishlist_button_to_product_list_shortocode', 15 );
		remove_action( 'woocommerce_after_shop_loop_item', 'tvlgiao_wpdance_wd_add_compare_link', 20 );
		remove_action( 'woocommerce_after_shop_loop_item', 'tvlgiao_wpdance_wd_list_template_loop_add_to_cart', 13 );
	}
}
function tvlgiao_wpdance_shop_loop_prod_add_action(){
	remove_action( 'woocommerce_before_shop_loop_item_title', 'wd_template_loop_product_thumbnail', 10 );
	add_action( 'woocommerce_before_shop_loop_item_title', 'wd_template_loop_product_thumbnail', 10 );
	
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_rating', 3 );
	add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_rating', 3 );
			
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_price', 7 );
	add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_price', 7 );	
			
	remove_action( 'woocommerce_before_shop_loop_item_title', 'tvlgiao_wpdance_add_label_to_product_list', 5 );
	add_action( 'woocommerce_before_shop_loop_item_title', 'tvlgiao_wpdance_add_label_to_product_list', 5 );
			
	remove_action( 'wd_woocommerce_shop_loop_buttons', 'tvlgiao_wpdance_wd_list_button_div_box_start', 13 );
	remove_action( 'wd_woocommerce_shop_loop_buttons', 'tvlgiao_wpdance_wd_list_button_div_box_start_hide', 13 );
	add_action( 'wd_woocommerce_shop_loop_buttons', 'tvlgiao_wpdance_wd_list_button_div_box_start', 13 );
				
	global $tvlgiao_wpdance_wd_quickshop;
	add_action('woocommerce_after_shop_loop_item', array( $tvlgiao_wpdance_wd_quickshop , 'add_quickshop_button'), 25 );
	add_action( 'woocommerce_after_shop_loop_item', 'tvlgiao_wpdance_wd_add_wishlist_button_to_product_list_shortocode', 15 );
	add_action( 'woocommerce_after_shop_loop_item', 'tvlgiao_wpdance_wd_add_compare_link', 20 );
	add_action( 'woocommerce_after_shop_loop_item', 'tvlgiao_wpdance_wd_list_template_loop_add_to_cart', 13 );
	
     add_action( 'woocommerce_after_shop_loop_item', 'tvlgiao_wpdance_add_short_content',8);
}



if ( ! function_exists( 'tvlgiao_wpdance_dimox_shop_breadcrumbs' ) ) {

	/**
	 * Output the WooCommerce Breadcrumb
	 *
	 * @access public
	 * @return void
	 */
	function tvlgiao_wpdance_dimox_shop_breadcrumbs( $args = array() ) {

		$defaults = apply_filters( 'woocommerce_breadcrumb_defaults', array(
			'delimiter'   => '<span class="brn_arrow">&#47;</span>',
			'wrap_before' => '<nav class="woocommerce-breadcrumb container heading">',
			'wrap_after'  => '</nav>',
			'before'      => '',
			'after'       => '',
			'home'        => _x( 'Home', 'breadcrumb', 'wpnoone' ),
		) );

		$args = wp_parse_args( $args, $defaults );

		if(class_exists('WooCommerce')) {
			wc_get_template( 'global/breadcrumb.php', $args );
		}
	}
}

if ( ! function_exists( 'tvlgiao_wpdance_wd_checkout_fields_form' ) ) {
	function tvlgiao_wpdance_wd_checkout_fields_form($checkout){
		$checkout->checkout_fields['account']    = array(
			'account_username' => array(
				'type' => 'text',
				'label' => esc_html__('Account username', 'wpnoone'),
				'placeholder' => _x('Username', 'placeholder', 'wpnoone'),
				'class' => array('form-row-wide')
				),
			'account_password' => array(
				'type' => 'password',
				'label' => esc_html__('Account password', 'wpnoone'),
				'placeholder' => _x('Password', 'placeholder', 'wpnoone'),
				'class' => array('form-row-first')
				),
			'account_password-2' => array(
				'type' => 'password',
				'label' => esc_html__('Account password', 'wpnoone'),
				'placeholder' => _x('Comfirm Password', 'placeholder', 'wpnoone'),
				'class' => array('form-row-last'),
				'label_class' => array('hidden')
				)
		);
	}
}

function tvlgiao_wpdance_update_single_product_wrapper_class( $_wrapper_class ){
	return $_wrapper_class = "without_related";
}



if (!function_exists('tvlgiao_wpdance_loop_columns')) {
	function tvlgiao_wpdance_loop_columns() {
		return 4; // 5 products per row
	}
}
if (!function_exists('tvlgiao_wpdance_wd_ads_sidebar')) {
	function tvlgiao_wpdance_wd_ads_sidebar($position){
		global $product;
		$wd_ads_sidebars = maybe_unserialize( get_post_meta( $product->get_id(), TVLGiao_Wpdance_THEME_SLUG.'product_ads_sidebar', true ) );
		$wd_ads_count = sizeof( $wd_ads_sidebars );
		
		$check = 0;
		if($wd_ads_sidebars && $wd_ads_count > 0){
			
			$return = '<div class="wd_ads_sidebar_'.$position.'">';
			$i = -1;
			$check = 0;
			foreach($wd_ads_sidebars as $wd_ads_sidebar_item ) {
				$i++;
				//if ( ! $wd_ads_sidebar_item['name'] )
				//	continue;
				if ( $wd_ads_sidebar_item['position'] == $position)	{
					$return .= '<div class="wd_ads_item_'.$i.'">';
					if(strlen(trim($wd_ads_sidebar_item['name'])) > 0 ){
						$return .= '<div class="widget_title_wrapper"><a class="block-control" href="javascript:void(0)" style="display: none;"></a><h3 class="widget-title heading-title">'.$wd_ads_sidebar_item['name'].'</h3><div class="line line-30"></div></div>';
					}
					$return .= '<div>'.$wd_ads_sidebar_item['content'].'</div>';
					$return .= '</div>';
					$check = 1;
				}	
			}
			$return .= '</div>';
		}
		if($check == 1){
			echo wp_kses_post($return);
		}	
		return '';
	}
}

if ( ! function_exists( 'tvlgiao_wpdance_wd_checkout_add_on_js' ) ) {
	function tvlgiao_wpdance_wd_checkout_add_on_js(){
?>
	<script type='text/javascript'>
		jQuery(document).ready(function() {
            "use strict";
			jQuery('input.checkout-method').on('change',function(event){
				if( jQuery(this).val() == 'account' && jQuery(this).is(":checked") ){
					jQuery('.accordion-createaccount').removeClass('hidden');
					jQuery('#collapse-login-regis').find('input.next_co_btn').attr('rel','accordion-account');
					
				}else{
					jQuery('.accordion-createaccount').addClass('hidden');
					jQuery('#collapse-login-regis').find('input.next_co_btn').attr('rel','accordion-billing');				
				}
			});
			jQuery('input.checkout-method').trigger('change');
			
			jQuery('.next_co_btn').on('click',function(){
				var _next_id = '#'+jQuery(this).attr('rel');
				jQuery('.accordion-group').not(_next_id).find('.accordion-body').each(function(index,value){
					if( jQuery(value).hasClass('in') )
						jQuery(value).siblings('.accordion-heading').children('a.accordion-toggle').trigger('click');
				});
				if( !jQuery(_next_id).find('.accordion-body').hasClass('in') ){	
					jQuery(_next_id).find('.accordion-body').siblings('.accordion-heading').children('a.accordion-toggle').trigger('click');
				}
			});    
		
		});
	</script>
<?php	
	}
}

?>