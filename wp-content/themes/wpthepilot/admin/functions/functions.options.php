<?php
add_action('init','of_options');

/***********Instruction***************
** Begin : 177
** Styling options : 396 -> 1061 ==>  	THEME COLOR: 437,THEME PRIMARY:466, THEME BUTTON PRIMAR:524,THEME BUTTON SECONDARY: 580
**			THEME BUTTON TERTIARY:636, PRIMARY TAB: 680, PRIMARY ACCORDION:718, TOP HEADER: 762, VERTICAL MENU:782
**			HORIZONTAL MENU:844 + 20 =  864, SIDEBAR: 918 + 20, FOOTER:986 + 20, PRODUCT:1024 + 20
** Typography	1122 -> 1317	
** Mega Menu	1319 -> 1361
** Integration	1422 -> 1450
** Product Category 	1465 -> 1506
** Product Details		1507 -> 1793
** Blog Options
** Blog Details
** Backup Options
** Documentation
** End
*************************************/
if (!function_exists('of_options'))
{
	function of_options()
	{
		//Access the WordPress Categories via an Array
		$of_categories 		= array();  
		$of_categories_obj 	= get_categories('hide_empty=0');
		foreach ($of_categories_obj as $of_cat) {
		    $of_categories[$of_cat->cat_ID] = $of_cat->cat_name;}
		$categories_tmp 	= array_unshift($of_categories, "Select a category:");    
	       
		//Access the WordPress Pages via an Array
		$of_pages 			= array();
		$of_pages_obj 		= get_pages('sort_column=post_parent,menu_order');    
		foreach ($of_pages_obj as $of_page) {
		    $of_pages[$of_page->ID] = $of_page->post_name; }
		$of_pages_tmp 		= array_unshift($of_pages, "Select a page:");       
	
		//Testing 
		$of_options_select 	= array("one","two","three","four","five"); 
		$of_options_radio 	= array("one" => "One","two" => "Two","three" => "Three","four" => "Four","five" => "Five");
		
		//Sidebars
		$of_sidebars 	= array();
		global $tvlgiao_wpdance_default_sidebars;
		if($tvlgiao_wpdance_default_sidebars){
			foreach( $tvlgiao_wpdance_default_sidebars as $key => $_sidebar ){
				$of_sidebars[$_sidebar['id']] = $_sidebar['name'];
			}
		}

		//Sample Homepage blocks for the layout manager (sorter)
		$of_options_homepage_blocks = array
		( 
			"disabled" => array (
				"placebo" 		=> "placebo", //REQUIRED!
				"block_one"		=> "Block One",
				"block_two"		=> "Block Two",
				"block_three"	=> "Block Three",
			), 
			"enabled" => array (
				"placebo" 		=> "placebo", //REQUIRED!
				"block_four"	=> "Block Four",
			),
		);


		//Stylesheets Reader
		$alt_stylesheet_path = TVLGiao_Wpdance_LAYOUT_PATH;
		$alt_stylesheets = array();
		
		if ( is_dir($alt_stylesheet_path) ) 
		{
		    if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) ) 
		    { 
		        while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false ) 
		        {
		            if(stristr($alt_stylesheet_file, ".css") !== false)
		            {
		                $alt_stylesheets[] = $alt_stylesheet_file;
		            }
		        }    
		    }
		}
		
		//default value for logo and favor icon
		$df_logo_images_uri_mb = get_template_directory_uri(). '/images/logo_black.png';
		$df_logo_images_uri_v1 = get_template_directory_uri(). '/images/logo.png';
		$df_404_backg_images   = get_template_directory_uri(). '/images/parallax_404.jpg';		
		$df_icon_images_uri = get_template_directory_uri(). '/images/favicon-pilot.ico'; 
		$df_header_banner_images_uri = get_template_directory_uri(). '/images/media/googly_top_header_banner.png'; 
		
		
		
		//Background Images Reader
		$df_bg_breadcrumbs = get_template_directory_uri(). '/images/media/breadcrumb1.jpg';
		$df_bg_breadcrumbs_category = get_template_directory_uri(). '/images/media/breadcrumb10.jpg';
		$df_bg_breadcrumbs_other = get_template_directory_uri(). '/images/media/breadcrumb2.jpg';				

		/*-----------------------------------------------------------------------------------*/
		/* TO DO: Add options/functions that use these */
		/*-----------------------------------------------------------------------------------*/
		
		//More Options
		$uploads_arr 		= wp_upload_dir();
		$all_uploads_path 	= $uploads_arr['path'];
		$all_uploads 		= get_option('of_uploads');
		$other_entries 		= array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19");
		$body_repeat 		= array("no-repeat","repeat-x","repeat-y","repeat");
		$body_pos 			= array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right");
		
		$default_font_size = array(	
			"10px"
			,"11px"
			,"12px"
			,"13px"
			,"14px"
			,"15px"
			,"16px"
			,"17px"
			,"18px"
			,"19px"
			,"20px"
			,"21px"
			,"22px"
			,"23px"
			,"24px"
			,"25px"
			,"26px"
			,"27px"
			,"28px"
			,"29px"
			,"30px"		
			,"31px"
			,"32px"
			,"33px"
			,"34px"
			,"35px"
			,"36px"
			,"37px"
			,"38px"
			,"39px"	
			,"40px"	
			,"41px"
			,"42px"
			,"43px"
			,"44px"
			,"45px"
			,"46px"
			,"47px"
			,"48px"
			,"49px"	
			,"50px"		
		);
		
		$faces = array('arial'=>'Arial',
					'verdana'=>'Verdana, Geneva',
					'trebuchet'=>'Trebuchet',
					'georgia' =>'Georgia',
					'times'=>'Times New Roman',
					'tahoma, geneva'=>'Tahoma, Geneva',
					'palatino'=>'Palatino',
					'helvetica'=>'Helvetica' );
										
		define('ADMIN_ASSETS_IMG_DIR', TVLGiao_Wpdance_ADMIN_DIR . 'assets/images/');

		$default_font_size = array_combine($default_font_size, $default_font_size);
		
		// Image Alignment radio box
		$of_options_thumb_align = array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center"); 
		
		// Image Links to Options
		$of_options_image_link_to = array("image" => "The Image","post" => "The Post"); 
									
		//Get list menu
		$menus = wp_get_nav_menus();
		$arr_menu = array();
		if($menus) {
			foreach($menus as $menu) { 
				$arr_temp = array($menu->term_id => $menu->name);
				//array_push($arr_menu, $arr_temp);
				$arr_menu = array_merge($arr_menu, $arr_temp);
			}
		}
		
		$url =  TVLGiao_Wpdance_ADMIN_DIR . 'assets/images/';
		
/*-----------------------------------------------------------------------------------*/
/* The Options Array */
/*-----------------------------------------------------------------------------------*/

/***************** TODO : GENERAL ****************/					


global $of_options,$tvlgiao_wpdance_google_fonts;

$of_options = array();
					
$of_options[] = array( 	"name" 		=> "General Settings",
						"type" 		=> "heading"
				);						

$of_options[] = array( 	"name" 		=> "Logo image"
						,"desc" 	=> "Change your logo."
						,"id" 		=> "wd_logo"
						,"std"		=> $df_logo_images_uri_v1
						,"type" 	=> "upload"
				);
				
$of_options[] = array( 	"name" 		=> "Mobile Logo image"
						,"desc" 	=> "Change your logo."
						,"id" 		=> "wd_logo_mobile"
						,"std"		=> $df_logo_images_uri_mb
						,"type" 	=> "upload"
				);
				

$of_options[] = array( 	"name" 		=> "Favor icon image"
						,"desc" 	=> "Accept ICO files, PNG files"
						,"id" 		=> "wd_icon"
						,"std" 		=> $df_icon_images_uri
						,"type" 		=> "media"
				);
				
$of_options[] = array( 	"name" 		=> "Text Logo"
						,"desc" 	=> "Text Logo"
						,"id" 		=> "wd_text_logo"
						,"std" 		=> "Default"
						,"type" 	=> "text"
				);

$of_options[] = array( 	"name" 		=> "Images Size Session"
						,"desc" 	=> ""
						,"id" 		=> "introduction_images_size_session"
						,"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Images Size Session</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);

$of_options[] = array( 	"name" 		=> "Blog Single Thumbnail Size"
						,"desc" 	=> "Thumbnail width. In px, default value: 1170"
						,"id" 		=> "wd_blog_single_thumbnail_width"
						,"std" 		=> "1170"
						,"min" 		=> "400"
						,"step"		=> "10"
						,"max" 		=> "1980"
						,"type" 	=> "sliderui" 
				);
$of_options[] = array( 	"name" 		=> "Blog Catalog Thumbnail Size"
						,"desc" 	=> "Thumbnail width. In px, default value: 900"
						,"id" 		=> "wd_blog_thumbnail_width"
						,"std" 		=> "900"
						,"min" 		=> "150"
						,"step"		=> "10"
						,"max" 		=> "980"
						,"type" 	=> "sliderui" 
				);
$of_options[] = array( 	"name" 		=> ""
						,"desc" 	=> "Thumbnail height. In px, default value: 410"
						,"id" 		=> "wd_blog_thumbnail_height"
						,"std" 		=> "980"
						,"min" 		=> "150"
						,"step"		=> "10"
						,"max" 		=> "980"
						,"type" 	=> "sliderui" 
				);
				
$of_options[] = array( 	"name" 		=> "Blog Shortcode List Thumbnail Size"
						,"desc" 	=> "Thumbnail width. In px, default value: 350"
						,"id" 		=> "wd_blog_shortcode_thumbnail_width"
						,"std" 		=> "350"
						,"min" 		=> "100"
						,"step"		=> "10"
						,"max" 		=> "440"
						,"type" 	=> "sliderui" 
				);
$of_options[] = array( 	"name" 		=> ""
						,"desc" 	=> "Thumbnail height. In px, default value: 220"
						,"id" 		=> "wd_blog_shortcode_thumbnail_height"
						,"std" 		=> "220"
						,"min" 		=> "100"
						,"step"		=> "10"
						,"max" 		=> "440"
						,"type" 	=> "sliderui" 
				);
				
$of_options[] = array( 	"name" 		=> "Blog Shortcode Grid Thumbnail Size"
						,"desc" 	=> "Thumbnail width. In px, default value: 570 <br />Height auto."
						,"id" 		=> "wd_blog_shortcode_auto_thumbnail_width"
						,"std" 		=> "570"
						,"min" 		=> "100"
						,"step"		=> "10"
						,"max" 		=> "990"
						,"type" 	=> "sliderui" 
				);
				
$of_options[] = array( 	"name" 		=> "Blog Shortcode Widget Thumbnail Size"
						,"desc" 	=> "Thumbnail width. In px, default value: 100"
						,"id" 		=> "wd_blog_shortcode_widget_thumbnail_width"
						,"std" 		=> "100"
						,"min" 		=> "30"
						,"step"		=> "1"
						,"max" 		=> "320"
						,"type" 	=> "sliderui" 
				);
$of_options[] = array( 	"name" 		=> ""
						,"desc" 	=> "Thumbnail height. In px, default value: 70"
						,"id" 		=> "wd_blog_shortcode_widget_thumbnail_height"
						,"std" 		=> "70"
						,"min" 		=> "30"
						,"step"		=> "1"
						,"max" 		=> "320"
						,"type" 	=> "sliderui" 
				);
				
$of_options[] = array( 	"name" 		=> "Tini Shopping Cart Items Thumbnail Size"
						,"desc" 	=> "Thumbnail width. In px, default value: 100"
						,"id" 		=> "wd_tini_shopping_cart_thumbnail_width"
						,"std" 		=> "100"
						,"min" 		=> "30"
						,"step"		=> "1"
						,"max" 		=> "320"
						,"type" 	=> "sliderui" 
				);
$of_options[] = array( 	"name" 		=> ""
						,"desc" 	=> "Thumbnail height. In px, default value: 140"
						,"id" 		=> "wd_tini_shopping_cart_thumbnail_height"
						,"std" 		=> "140"
						,"min" 		=> "30"
						,"step"		=> "1"
						,"max" 		=> "320"
						,"type" 	=> "sliderui" 
				);
				
$of_options[] = array( 	"name" 		=> "Single Poruducts Thumbnail Size"
						,"desc" 	=> "Thumbnail width. In px, default value: 100"
						,"id" 		=> "wd_single_products_thumbnail_width"
						,"std" 		=> "100"
						,"min" 		=> "40"
						,"step"		=> "1"
						,"max" 		=> "320"
						,"type" 	=> "sliderui" 
				);
$of_options[] = array( 	"name" 		=> ""
						,"desc" 	=> "Thumbnail height. In px, default value: 140"
						,"id" 		=> "wd_single_products_thumbnail_height"
						,"std" 		=> "140"
						,"min" 		=> "40"
						,"step"		=> "1"
						,"max" 		=> "320"
						,"type" 	=> "sliderui" 
				);
				
$of_options[] = array( 	"name" 		=> "Poruduct Subcategories Thumbnail Size"
						,"desc" 	=> "Thumbnail width. In px, default value: 270"
						,"id" 		=> "wd_product_subcategories_thumbnail_width"
						,"std" 		=> "270"
						,"min" 		=> "100"
						,"step"		=> "1"
						,"max" 		=> "420"
						,"type" 	=> "sliderui" 
				);
$of_options[] = array( 	"name" 		=> ""
						,"desc" 	=> "Thumbnail height. In px, default value: 200"
						,"id" 		=> "wd_product_subcategories_thumbnail_height"
						,"std" 		=> "200"
						,"min" 		=> "100"
						,"step"		=> "1"
						,"max" 		=> "420"
						,"type" 	=> "sliderui" 
				);
				
$of_options[] = array( 	"name" 		=> "Poruduct Categories Shortcode Thumbnail Size"
						,"desc" 	=> "Thumbnail width. In px, default value: 370"
						,"id" 		=> "wd_product_categories_shortcode_thumbnail_width"
						,"std" 		=> "370"
						,"min" 		=> "100"
						,"step"		=> "5"
						,"max" 		=> "1170"
						,"type" 	=> "sliderui" 
				);
$of_options[] = array( 	"name" 		=> ""
						,"desc" 	=> "Thumbnail height. In px, default value: 540"
						,"id" 		=> "wd_product_categories_shortcode_thumbnail_height"
						,"std" 		=> "540"
						,"min" 		=> "100"
						,"step"		=> "5"
						,"max" 		=> "1170"
						,"type" 	=> "sliderui" 
				);
				
$of_options[] = array( 	"name" 		=> "Custom Catalog Mod"
						,"desc" 	=> ""
						,"id" 		=> "introduction_custom_catalog_mod"
						,"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Custom Catalog Mod</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
				
$of_options[] = array( 	"name" 		=> "Catalog Mod"
						,"desc" 	=> "Enable/Disable Add To Cart Button on site"
						,"id" 		=> "wd_catelog_mod"
						,"on"		=> "Enable"
						,"off"		=> "Disable"
						,"std" 		=> 1
						,"type" 	=> "switch"
				);									
$of_options[] = array( 	"name" 		=> "Other options"
						,"desc" 	=> ""
						,"id" 		=> "introduction_custom_totop"
						,"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Enable/Disable Totop Button</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);

$of_options[] = array( 	"name" 		=> "Enbale Smoothscroll"
						,"desc" 	=> "Enable Nice Scroll Bar on the right browsers"
						,"id" 		=> "wd_smooth_scroll"
						,"on"		=> "Enable"
						,"off"		=> "Disable"
						,"std" 		=> 0
						,"type" 	=> "switch"
				);
$of_options[] = array( 	"name" 		=> "Enbale Loading Page"
						,"desc" 	=> "Enable Loading Bar on the page"
						,"id" 		=> "wd_loading_page"
						,"on"		=> "Enable"
						,"off"		=> "Disable"
						,"std" 		=> 0
						,"type" 	=> "switch"
				);
				
$of_options[] = array( 	"name" 		=> "Enable Totop button"
						,"desc" 	=> "Enable/Disable Totop Button on site"
						,"id" 		=> "wd_totop"
						,"on"		=> "Enable"
						,"off"		=> "Disable"
						,"std" 		=> 0
						,"type" 	=> "switch"
				);					
$of_options[] = array( 	"name" 		=> "Page Content"
						,"desc" 	=> ""
						,"id" 		=> "wd_page404_content"
						,"std" 		=> '[wd_feedburner feedburner="NEWSLETTER SIGNUP" style="style-2" align="text-center" ]'
						,"type" 	=> "textarea"
				);	
				

/***************** TODO : Layout ****************/					
				
$of_options[] = array( 	"name" 		=> "Layout"
						,"type" 	=> "heading"
				);
$of_options[] = array( 	"name" 		=> "Layout"
						,"desc" 	=> ""
						,"id" 		=> "wd_layout_styles"
						,"std" 		=> "Wide"
						,"type" 	=> "select"
						,"options"	=> array("wide","boxed")
				);
$of_options[] = array( 	"name" 		=> "Box Width"
						,"desc" 	=> "px"
						,"id" 		=> "wd_boxed_width"
						,"std" 		=> ''
						,"type" 	=> "text"
				);
$of_options[] = array( 	"name" 		=> "Header"
						,"desc" 	=> ""
						,"id" 		=> "wd_header_styles"
						,"std" 		=> "wide"
						,"type" 	=> "select"
						,"options"	=> array("wide","boxed")
				);
$of_options[] = array( 	"name" 		=> "Main Content"
						,"desc" 	=> ""
						,"id" 		=> "wd_maincontent_styles"
						,"std" 		=> "wide"
						,"type" 	=> "select"
						,"options"	=> array("wide","boxed")
				);				
$of_options[] = array( 	"name" 		=> "Footer"
						,"desc" 	=> ""
						,"id" 		=> "wd_footer_styles"
						,"std" 		=> "wide"
						,"type" 	=> "select"
						,"options"	=> array("wide","boxed")
				);				
/***************** TODO : Header ****************/					
				
$of_options[] = array( 	"name" 		=> "Header"
						,"type" 	=> "heading"
				);

$of_options[] = array( 	"name" 		=> "Header layout"
						,"desc" 	=> ""
						,"id" 		=> "introduction_header_layout"
						,"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Header layout</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
				
$of_options[] = array( 	"name" 		=> "Header Layout"
						,"id" 		=> "wd_header_style"
						,"std" 		=> "v1"
						,"type" 	=> "images"
						,"options" 	=> array(
							'v1' 	=> ADMIN_ASSETS_IMG_DIR . 'header/header-v1.jpg'
							,'v2' 	=> ADMIN_ASSETS_IMG_DIR . 'header/header-v2.jpg'
						)
				);
				
$of_options[] = array( 	"name" 		=> "Using Sticky Menu"
						,"desc" 	=> ""
						,"id" 		=> "introduction_custom_sticky_menu"
						,"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Using Sticky Menu</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);				
$of_options[] = array( 	"name" 		=> ""
						,"desc" 	=> "Using Sticky Menu on site"
						,"id" 		=> "wd_sticky_menu"
						,"on"		=> "Enable"
						,"off"		=> "Disable"
						,"std" 		=> 0
						,"type" 	=> "switch"
				);
if( class_exists('WooCommerce_Widget_Currency_Converter') ){				
$of_options[] = array( 	"name" 		=> "Currency Converter"
						,"desc" 	=> "Currency Codes(1 per line)"
						,"id" 		=> "wd_currency_codes"
						,"std" 		=> 'USD'.chr(10).'EUR'.chr(10).'JPY'
						,"type" 	=> "textarea"
				);	
}
$of_options[] = array( 	"name" 		=> "Breadcrumbs background"
						,"desc" 	=> ""
						,"id" 		=> "wd_bg_breadcrumbs"
						,"std"		=> $df_bg_breadcrumbs_other
						,"type" 	=> "upload"
					);
$of_options[] = array( 	"name" 		=> "Breadcrumbs background 2 "
						,"desc" 	=> ""
						,"id" 		=> "wd_bg_breadcrumbs_other"
						,"std"		=> $df_bg_breadcrumbs
						,"type" 	=> "upload"
					);
$of_options[] = array( 	"name" 		=> "Breadcrumbs background Category "
						,"desc" 	=> ""
						,"id" 		=> "wd_bg_breadcrumbs_category"
						,"std"		=> $df_bg_breadcrumbs_category
						,"type" 	=> "upload"
					);								
					
$of_options[] = array( 	"name" 		=> "Cart option"
						,"desc" 	=> ""
						,"id" 		=> "introduction_cart_options"
						,"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Cart Options.</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
				
$of_options[] = array( 	"name" 		=> "Enable cart in header top"
						,"desc" 	=> ""
						,"id" 		=> "wd_enable_cart_header_top"
						,"on"		=> "Enable"
						,"off"		=> "Disable"
						,"std" 		=> 1
						,"type" 	=> "switch"
				);								
$of_options[] = array( 	"name" 		=> "Number product show in tini cart"
						,"desc" 	=> "Number product show in tini cart.<br /> Min: 1, max: 6, step: 1, default value: 3"
						,"id" 		=> "wd_tini_cart_prod_number"
						,"fold"		=> "wd_enable_cart_header_top"
						,"std" 		=> "3"
						,"min" 		=> "1"
						,"step"		=> "1"
						,"max" 		=> "6"
						,"type" 	=> "sliderui" 
				);
				
/***************** TODO : FOOTER ****************/	
$of_options[] = array( 	"name" 		=> "Footer"
						,"type" 	=> "heading"
					);													
$of_options[] = array( 	"name" 		=> "First footer area"
						,"desc" 	=> "Show/hide First footer area"
						,"id" 		=> "wd_show_first_footer_area"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"folds"	=> 1
						,"type" 	=> "switch"		
					);
					
$of_options[] = array( 	"name" 		=> "Second footer area"
						,"desc" 	=> "Show/hide Second footer area"
						,"id" 		=> "wd_show_second_footer_area"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"folds"	=> 1
						,"type" 	=> "switch"		
					);
$of_options[] = array( 	"name" 		=> "Third footer area"
						,"desc" 	=> "Show/hide Third footer area"
						,"id" 		=> "wd_show_third_footer_area"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"folds"	=> 1
						,"type" 	=> "switch"		
					);														
						
/***************** TODO : STYLE ****************/					
/***************** DON'T ADD MORE ANY ELEMENTS HERE ****************/				
$of_options[] = array( 	"name" 		=> "Styling Options"
						,"type" 	=> "heading"
				);
global $xml_arr_file, $xml_headers;			
$url =  TVLGiao_Wpdance_ADMIN_DIR . 'assets/images/';
$color_image_options = array();
foreach($xml_arr_file as $xml){
	$header_datas = get_file_data( TVLGiao_Wpdance_XML_PATH . $xml . '.xml', $xml_headers );
	$color_image_options[$xml]['img'] = $url . $xml .'.png';
	$color_image_options[$xml]['name'] = $header_datas['Name'];
	$color_image_options[$xml]['desc'] = $header_datas['Description'];
}
$of_options[] = array( 	"name" 		=> "Theme Scheme",
						"desc" 		=> "Select a color.",
						"id" 		=> "wd_color_scheme",
						"std" 		=> "color_default",
						"type" 		=> "theme_colors",
						"actions"	=> 1,
						"options" 	=> $color_image_options
				);

$xml_file = get_option(TVLGiao_Wpdance_THEME_SLUG.'color_select');			
$xml_file = isset($xml_file) && strlen(trim($xml_file)) > 0 ? $xml_file : 'color_default';
$url_xml_file = TVLGiao_Wpdance_THEME_DIR."/config_xml/".$xml_file.".xml";
$objXML_color = simplexml_load_file($url_xml_file);
	foreach ($objXML_color->children() as $child) {	//group
		$group_name = (string)$child->getName();
		$of_options[] = array( 	"name" 		=> $group_name." Scheme"
				,"id" 		=> "introduction_".$group_name
				,"std" 		=> "<h3 slug='".$group_name."' style=\"margin: 0 0 10px;\">".$group_name." Scheme</h3>"
				,"icon" 	=> true
				,"type" 	=> "info"
		);	

		foreach ($child->items->children() as $childofchild) { //items => item
		
			$name =  (string)$childofchild->name;
			$slug =  (string)$childofchild->slug; 
			$std =  (string)$childofchild->std; 
			$nodeName =  (string)$childofchild->getName();
			//$class_name =  (string)$childofchild->class_name;		
			
			if($nodeName =='background_item'){
				$of_options[] = array( 	"name" 		=> "Background Image"
						,"id" 		=> "wd_".$slug.'_image'
						,"type" 	=> "upload"
				);
				$of_options[] = array( 	"name" 		=> "Repeat Image"
						,"id" 		=> "wd_".$slug.'_repeat'
						,"std" 		=> "repeat"
						,"type" 	=> "select"
						,"options"	=> array("repeat","no-repeat","repeat-x","repeat-y")
				);
				$of_options[] = array( 	"name" 		=> "Position Image"
						,"id" 		=> "wd_".$slug.'_position'
						,"std" 		=> "left top"
						,"type" 	=> "select"
						,"options"	=> array("left top","right top","center top","center center")
				);
			}
			
			
			$of_options[] = array( 	"name" 		=> trim($name)
					,"id" 		=> "wd_".$slug
					,"std" 		=> $std
					,"type" 	=> "color"
			);
		}
	}	

/***************** TODO : TYPO ****************/		

$of_options[] = array( 	"name" 		=> "Typography"
						,"type" 	=> "heading"
						,"icon"		=> TVLGiao_Wpdance_ADMIN_IMAGES . "icon-typography.gif"
				);
				
$objXML = simplexml_load_file(TVLGiao_Wpdance_THEME_DIR."/config_xml/font_config.xml");
	foreach ($objXML->children() as $child) {	//items
		$name =  $child->name;
		$slug =  $child->slug; 
		$type =  $child->type; 
		$std =  $child->std; 

		$default_family_font = 'arial';
		$default_google_font = 'Lato';
		$std_slect = ($type == 'google_font') ? 0 : 1;
		if($type == 'family_font') { $default_family_font = in_array($std,$faces) ? strtolower($std) : 'arial';}
		if($type == 'google_font') { $default_google_font = in_array($std,$tvlgiao_wpdance_google_fonts) ? $std : 'Lato';}
		
		$of_options[] = array( 	"name" 		=> $name
				,"desc" 	=> ""
				,"id" 		=> "introduction_".$slug
				,"std" 		=> '<h3 style=\"margin: 0 0 10px;\">'.$name.' Options.</h3>'
				,"icon" 	=> true
				,"type" 	=> "info"
		);
		$of_options[] = array( 	"name" 		=> ""
				,"id" 		=> "wd_".$slug."_googlefont_enable"
				,"std" 		=> $std_slect
				,"folds"	=> 1
				,"on" 		=> "Family Font"
				,"off" 		=> "Google Font"
				,"type" 	=> "switchs"
		);
		$of_options[] = array( 	"name" 		=> ""//ucwords($name)." Family"
				,"id" 		=> "wd_".$slug."_family"
				,"position"	=> "left"
				,"fold"		=> "wd_".$slug."_googlefont_enable"
				,"std" 		=> trim($default_family_font)
				,"type" 	=> "select"
				,"options"	=> $faces
		);
		$of_options[] = array( 	"name" 		=> ""//ucwords($name)." Google"
				,"id" 		=> "wd_".$slug."_googlefont"
				,"position"	=> "right"
				,"std" 		=> trim($default_google_font)
				,"type" 	=> "select_google_font"
				,"fold"		=> "wd_".$slug."_googlefont_enable"
				,"preview" 	=> array(
								"text" => "This is my ".strtolower($name)." preview!"
								,"size" => "30px"
				)
				,"options" 	=> $tvlgiao_wpdance_google_fonts
		);
	}							
/***************** TODO : Quickshop ****************/
if ( in_array( 'wd_quickshop/wd_quickshop.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	$of_options[] = array( 	"name" 		=> "Quickshop Options"
							,"type" 	=> "heading"
							,"icon"		=> TVLGiao_Wpdance_ADMIN_IMAGES . "icon-settings.png"
						);
						
	$of_options[] = array( 	"name" 		=> "Product Title"
							,"desc" 	=> "Show/hide product title"
							,"id" 		=> "wd_qs_product_title"
							,"std" 		=> 1
							,"on" 		=> "Show"
							,"off" 		=> "Hide"
							,"type" 	=> "switch"
						);
						
	$of_options[] = array( 	"name" 		=> "Product Label"
							,"desc" 	=> "Show/hide product label"
							,"id" 		=> "wd_qs_product_label"
							,"std" 		=> 1
							,"on" 		=> "Show"
							,"off" 		=> "Hide"
							,"type" 	=> "switch"
					);
	$of_options[] = array( 	"name" 		=> "Product Availability"
							,"desc" 	=> "Show/hide product availability"
							,"id" 		=> "wd_qs_product_availability"
							,"std" 		=> 1
							,"on" 		=> "Show"
							,"off" 		=> "Hide"
							,"type" 	=> "switch"
					);
	$of_options[] = array( 	"name" 		=> "Product SKU"
							,"desc" 	=> "Show/hide product sku"
							,"id" 		=> "wd_qs_product_sku"
							,"std" 		=> 1
							,"on" 		=> "Show"
							,"off" 		=> "Hide"
							,"type" 	=> "switch"
					);
	$of_options[] = array( 	"name" 		=> "Product Rating"
							,"desc" 	=> "Show/hide product rating"
							,"id" 		=> "wd_qs_product_rating"
							,"std" 		=> 1
							,"on" 		=> "Show"
							,"off" 		=> "Hide"
							,"type" 	=> "switch"
					);
	$of_options[] = array( 	"name" 		=> "Product Short Description"
							,"desc" 	=> "Show/hide product short description"
							,"id" 		=> "wd_qs_product_short_description"
							,"std" 		=> 1
							,"on" 		=> "Show"
							,"off" 		=> "Hide"
							,"type" 	=> "switch"
					);
	$of_options[] = array( 	"name" 		=> "Product Add To Cart"
							,"desc" 	=> "Show/hide product add to cart"
							,"id" 		=> "wd_qs_product_add_to_cart"
							,"std" 		=> 1
							,"on" 		=> "Show"
							,"off" 		=> "Hide"
							,"type" 	=> "switch"
					);
}
					
					
					
/***************** TODO : Product Category Options ****************/							
$of_options[] = array( 	"name" 		=> "Integration"
						,"type" 	=> "heading"
						,"icon"		=> TVLGiao_Wpdance_ADMIN_IMAGES . "icon-add.png"
				);
$of_options[] = array( 	"name" 		=> "Top Blog Details Codes"
						,"desc" 	=> "Quickly add some html/css to top of blog details by adding it to this block."
						,"id" 		=> "wd_top_blog_code"
						,"std" 		=> ""
						,"type" 	=> "textarea"
				);
				
$of_options[] = array( 	"name" 		=> "Bottom Blog Details Codes"
						,"desc" 	=> "Quickly add some html/css to bottom of blog details by adding it to this block."
						,"id" 		=> "wd_bottom_blog_code"
						,"std" 		=> ""
						,"type" 	=> "textarea"
				);				
				
/***************** TODO : Shop Product Options ****************/
$of_options[] = array( 	"name" 		=> " Product Shop"
						,"type" 	=> "heading"
						,"icon"		=> TVLGiao_Wpdance_ADMIN_IMAGES . "icon-slider.png"
				);
$of_options[] = array( 	"name" 		=> "Category Columns"
						,"id" 		=> "wd_prod_shop_cat_column"
						,"std" 		=> "4"
						,"type" 	=> "select"
						,"mod"		=> "mini"
						,"options" 	=> array(2,3,4,5)
				);
$of_options[] = array( 	"name" 		=> "Category Layout"
						,"desc" 	=> "Select main content and sidebar alignment. Choose between 1, 2 column layout."
						,"id" 		=> "wd_prod_shop_cat_layout"
						,"std" 		=> "0-1-0"
						,"type" 	=> "images"
						,"options" 	=> array(
							'0-1-0' 	=> $url . '1col.png'
							,'0-1-1' 	=> $url . '2cr.png'
							,'1-1-0' 	=> $url . '2cl.png'
							,'1-1-1' 	=> $url . '3cm.png'
						)
				);								
$of_options[] = array( 	"name" 		=> "Left Sidebar"
						,"id" 		=> "wd_prod_shop_cat_left_sidebar"
						,"std" 		=> "category-widget-area"
						,"type" 	=> "select"
						//,"mod"		=> "mini"
						,"options" 	=> $of_sidebars
				);

$of_options[] = array( 	"name" 		=> "Right Sidebar"
						,"id" 		=> "wd_prod_shop_cat_right_sidebar"
						,"std" 		=> "category-widget-area"
						,"type" 	=> "select"
						//,"mod"		=> "mini"
						,"options" 	=> $of_sidebars
				);
/***************** TODO : Product Category Options ****************/							
$of_options[] = array( 	"name" 		=> "Product Category"
						,"type" 	=> "heading"
						,"icon"		=> TVLGiao_Wpdance_ADMIN_IMAGES . "icon-slider.png"
				);
$of_options[] = array( 	"name" 		=> "Category Columns"
						,"id" 		=> "wd_prod_cat_column"
						,"std" 		=> "3"
						,"type" 	=> "select"
						,"mod"		=> "mini"
						,"options" 	=> array(2,3,4,5)
				);
				
$of_options[] = array( 	"name" 		=> "Products Per Page"
						,"desc" 	=> "Min: 6, max: 50, step: 1, default value: 12"
						,"id" 		=> "wd_prod_cat_per_page"
						,"std" 		=> "12"
						,"min" 		=> "6"
						,"step"		=> "1"
						,"max" 		=> "50"
						,"type" 	=> "sliderui" 
				);

$of_options[] = array( 	"name" 		=> "Category Layout"
						,"desc" 	=> "Select main content and sidebar alignment. Choose between 1, 2 column layout."
						,"id" 		=> "wd_prod_cat_layout"
						,"std" 		=> "1-1-0"
						,"type" 	=> "images"
						,"options" 	=> array(
							'0-1-0' 	=> $url . '1col.png'
							,'0-1-1' 	=> $url . '2cr.png'
							,'1-1-0' 	=> $url . '2cl.png'
							,'1-1-1' 	=> $url . '3cm.png'
						)
				);								

$of_options[] = array( 	"name" 		=> "Left Sidebar"
						,"id" 		=> "wd_prod_cat_left_sidebar"
						,"std" 		=> "category-widget-area"
						,"type" 	=> "select"
						//,"mod"		=> "mini"
						,"options" 	=> $of_sidebars
				);

$of_options[] = array( 	"name" 		=> "Right Sidebar"
						,"id" 		=> "wd_prod_cat_right_sidebar"
						,"std" 		=> "category-widget-area"
						,"type" 	=> "select"
						//,"mod"		=> "mini"
						,"options" 	=> $of_sidebars
				);
				
$of_options[] = array( 	"name" 		=> "Product sub categories"
						,"desc" 	=> ""
						,"id" 		=> "introduction_product_sub_categories"
						,"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Product sub categories</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
				
$of_options[] = array( 	"name" 		=> "Product sub categories icon style"
						,"desc" 	=> "Use product sub categories icon style or not."
						,"id" 		=> "wd_prod_sub_cats_style"
						,"std" 		=> 0
						,"on" 		=> "Yes"
						,"off" 		=> "No"
						,"type" 	=> "switch"
				);
					
$of_options[] = array( 	"name" 		=> "Number of sub categories"
						,"desc" 	=> "Min: 2, max: 8, step: 1, default value: 4"
						,"id" 		=> "wd_prod_sub_cat_num"
						,"std" 		=> "4"
						,"min" 		=> "2"
						,"step"		=> "1"
						,"max" 		=> "8"
						,"type" 	=> "sliderui" 
				);
				
$of_options[] = array( 	"name" 		=> "Products option"
						,"desc" 	=> ""
						,"id" 		=> "introduction_products_options"
						,"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Products option</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
					

$of_options[] = array( 	"name" 		=> "Number of Words in Discription on List Mode"
						,"desc" 	=> "Min: 15, max: 250, step: 1, default value: 75"
						,"id" 		=> "wd_prod_cat_shortc_limit"
						,"std" 		=> "75"
						,"min" 		=> "15"
						,"step"		=> "1"
						,"max" 		=> "250"
						,"type" 	=> "sliderui" 
				);					
				
				
/***************** TODO : Product Details Options ****************/	

$of_options[] = array( 	"name" 		=> "Product Details"
						,"type" 		=> "heading"
						,"icon"		=> TVLGiao_Wpdance_ADMIN_IMAGES . "icon-slider.png"
				);		

$of_options[] = array( 	"name" 		=> "Product Layout"
						,"desc" 	=> ""
						,"id" 		=> "introduction_single_product_layout"
						,"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Product Layout</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
				
$of_options[] = array( 	"name" 		=> "Product Layout"
						,"desc" 	=> "Select main content and sidebar alignment. Choose between 1, 2 column layout."
						,"id" 		=> "wd_prod_layout"
						,"std" 		=> "0-1-0"
						,"type" 	=> "images"
						,"options" 	=> array(
							'0-1-0' 	=> $url . '1col.png'
							,'0-1-1' 	=> $url . '2cr.png'
							,'1-1-0' 	=> $url . '2cl.png'
							,'1-1-1' 	=> $url . '3cm.png'
						)
				);
$of_options[] = array( 	"name" 		=> "Left Sidebar"
						,"id" 		=> "wd_prod_left_sidebar"
						,"std" 		=> "category-widget-area"
						,"type" 	=> "select"
						//,"mod"		=> "mini"
						,"options" 	=> $of_sidebars
				);	
$of_options[] = array( 	"name" 		=> "Right Sidebar"
						,"id" 		=> "wd_prod_right_sidebar"
						,"std" 		=> "category-widget-area"
						,"type" 	=> "select"
						//,"mod"		=> "mini"
						,"options" 	=> $of_sidebars
				);	
				
$of_options[] = array( 	"name" 		=> "Product Image"
						,"desc" 	=> ""
						,"id" 		=> "introduction_single_product_image"
						,"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Product Image</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
				
$of_options[] = array( 	"name" 		=> "Product Image"
						,"desc" 	=> "Show/hide Product Image"
						,"id" 		=> "wd_prod_image"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"type" 	=> "switch"
				);
$of_options[] = array( 	"name" 		=> "Product Cloud-zoom"
						,"desc" 	=> "Show/hide Product Cloud-zoom"
						,"id" 		=> "wd_prod_cloudzoom"
						,"std" 		=> 1
						,"on" 		=> "Enable"
						,"off" 		=> "Disable"
						,"type" 	=> "switch"
				);
				
$of_options[] = array( 	"name" 		=> "Product Summary"
						,"desc" 	=> ""
						,"id" 		=> "introduction_single_product_summary"
						,"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Product Product Summary</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
				
$of_options[] = array( 	"name" 		=> "Product Price"
						,"desc" 	=> "Show/hide Product Price"
						,"id" 		=> "wd_prod_price"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"type" 	=> "switch"
				);
				
$of_options[] = array( 	"name" 		=> "Product Sku"
						,"desc" 	=> "Show/hide Product Sku"
						,"id" 		=> "wd_prod_sku"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"type" 	=> "switch"
				);
$of_options[] = array( 	"name" 		=> "Product Availability"
						,"desc" 	=> "Show/hide Product Availability"
						,"id" 		=> "wd_prod_available"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"type" 	=> "switch"
				);
								
$of_options[] = array( 	"name" 		=> "Product Rating & Review"
						,"desc" 	=> "Show/hide Product Rating & Review"
						,"id" 		=> "wd_prod_review"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"type" 	=> "switch"
				);
				
$of_options[] = array( 	"name" 		=> "Product Share"
						,"desc" 	=> "Show/hide Product Social Sharing"
						,"id" 		=> "wd_prod_share"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"folds"	=> 1
						,"type" 	=> "switch"
				);
				
$of_options[] = array( 	"name" 		=> "Product Short Desc"
						,"desc" 	=> "Show/hide Product Short Desc"
						,"id" 		=> "wd_prod_shortdesc"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"type" 	=> "switch"
				);	

$of_options[] = array( 	"name" 		=> "Product AddToCart Button"
						,"desc" 	=> "Show/hide Product AddToCart Button"
						,"id" 		=> "wd_prod_cart"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"type" 	=> "switch"
				);


$of_options[] = array( 	"name" 		=> "Product Meta"
						,"desc" 	=> "Show/hide Product Meta"
						,"id" 		=> "wd_prod_meta"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"type" 	=> "switch"
				);
	

$of_options[] = array( 	"name" 		=> "Product Related Products"
						,"desc" 	=> "Show/hide Product Related Products"
						,"id" 		=> "wd_prod_related"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"folds"	=> 1
						,"type" 	=> "switch"
				);
	
$of_options[] = array( 	"name" 		=> "Related Product Title"
						,"id" 		=> "wd_prod_related_title"
						,"std" 		=> esc_html__('RELATED ITEMS','wpthepilot')
						,"fold" 	=> "wd_prod_related"
						,"type" 	=> "text"
				);			
	
$of_options[] = array( 	"name" 		=> "Product Upsell"
						,"desc" 	=> "Show/hide Product Upsell"
						,"id" 		=> "wd_prod_upsell"
						,"std" 		=> 0
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"folds"	=> 1
						,"type" 	=> "switch"
				);			
$of_options[] = array( 	"name" 		=> "Upsell Product Title"
						,"id" 		=> "wd_prod_upsell_title"
						,"std" 		=> esc_html__('YOU MAY ALSO LIKE','wpthepilot')
						,"fold" 	=> "wd_prod_upsell"
						,"type" 	=> "text"
				);			
			

$of_options[] = array( 	"name" 		=> "Product Sharing Code"
						,"id" 		=> "wd_prod_share_code"
						,"std" 		=> ""
						,"desc" 	=> "add the HTML for share item inside <strong>&lt;div&gt;</strong> tag<br />use [wd_c_url] shortcode to get permalink."
						,"fold" 	=> "wd_prod_share"
						,"type" 	=> "textarea"
				);

$of_options[] = array( 	"name" 		=> "Ship & Return Box"
						,"desc" 	=> "Show/hide Ship & Return Box"
						,"id" 		=> "wd_prod_ship_return"
						,"std" 		=> 0
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"folds" 	=> 0
						,"type" 	=> "switch"
				);

$of_options[] = array( 	"name" 		=> "Show Ship & Return Box Title"
						,"id" 		=> "wd_prod_ship_return_title"
						,"std" 		=> "FREE SHIPPING & RETURN"
						,"fold" 	=> "wd_prod_ship_return"
						,"type" 	=> "text"
				);

$of_options[] = array( 	"name" 		=> "Show Ship & Return Box Content"
						,"id" 		=> "wd_prod_ship_return_content"
						,"std" 		=> '<div>Tucked t-shirt relaxed plaited leather tote Jil Sander Vasari bomber clutch. Lilac minimal crop flats slipper denim shorts seam. </div>'
						,"fold" 	=> "wd_prod_ship_return"
						,"type" 	=> "textarea"
				);
								
$of_options[] = array( 	"name" 		=> "Product Tabs"
						,"desc" 	=> "Show/hide Product Tabs"
						,"id" 		=> "wd_prod_tabs"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"folds"	=> 1
						,"type" 	=> "switch"
				);	
	
$of_options[] = array( 	"name" 		=> "Product Custom Tab"
						,"desc" 	=> "Show/hide Product Custom Tab"
						,"id" 		=> "wd_prod_customtab"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"folds"	=> 1
						,"fold"		=> "wd_prod_tabs"
						,"type" 	=> "switch"
				);			
		
$of_options[] = array( 	"name" 		=> "Product Custom Tab Title"
						,"id" 		=> "wd_prod_customtab_title"
						,"std" 		=> "Custom Tab"
						,"fold" 	=> "wd_prod_customtab"
						,"type" 	=> "text"
				);

$of_options[] = array( 	"name" 		=> "Product Custom Tab Content"
						,"id" 		=> "wd_prod_customtab_content"
						,"std" 		=> "custom contents goes here"
						,"fold" 	=> "wd_prod_customtab"
						,"type" 	=> "textarea"
				);		
			
/***************** TODO : Blog Options ****************/	
$of_options[] = array( 	"name" 		=> "Blog Options"
						,"type" 	=> "heading"
						,"icon"		=> TVLGiao_Wpdance_ADMIN_IMAGES . "icon-slider.png"
				);

$of_options[] = array( 	"name" 		=> "Blog Layout"
						,"desc" 	=> "Select main content and sidebar alignment. Choose between 1, 2 column layout."
						,"id" 		=> "wd_blog_layout"
						,"std" 		=> "0-1-1"
						,"type" 	=> "images"
						,"options" 	=> array(
							'0-1-0' 	=> $url . '1col.png'
							,'0-1-1' 	=> $url . '2cr.png'
							,'1-1-0' 	=> $url . '2cl.png'
							,'1-1-1' 	=> $url . '3cm.png'
						)
				);
$of_options[] = array( 	"name" 		=> "Left Sidebar"
						,"id" 		=> "wd_blog_left_sidebar"
						,"std" 		=> "blog-left-widget-area"
						,"type" 	=> "select"
						,"options" 	=> $of_sidebars
				);	
$of_options[] = array( 	"name" 		=> "Right Sidebar"
						,"id" 		=> "wd_blog_right_sidebar"
						,"std" 		=> "blog-right-widget-area"
						,"type" 	=> "select"
						,"options" 	=> $of_sidebars
				);	
				


$of_options[] = array( 	"name" 		=> "Blog Time"
						,"desc" 	=> "Show/hide Time"
						,"id" 		=> "wd_blog_time"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"folds"	=> 1
						,"type" 	=> "switch"		
					);
				
$of_options[] = array( 	"name" 		=> "Blog Comment Number"
						,"desc" 	=> "Show/hide Comment Number"
						,"id" 		=> "wd_blog_comment_number"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"folds"	=> 1
						,"type" 	=> "switch"		
					);		
$of_options[] = array( 	"name" 		=> "Blog Excerpt"
						,"desc" 	=> "Show/hide Excerpt"
						,"id" 		=> "wd_blog_excerpt"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"folds"	=> 1
						,"type" 	=> "switch"		
					);
				
$of_options[] = array( 	"name" 		=> "Blog Excerpt Words Limit"
						,"desc" 	=> "Min: 15, max: 250, step: 1, default value: 35"
						,"id" 		=> "wd_blog_excerpt_words_limit"
						,"std" 		=> "35"
						,"min" 		=> "15"
						,"step"		=> "1"
						,"max" 		=> "150"
						,"type" 	=> "sliderui" 
				);	
					
$of_options[] = array( 	"name" 		=> "Show Read More"
						,"desc" 	=> "Show/hide Read More Button"
						,"id" 		=> "wd_blog_readmore"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"folds"	=> 1
						,"type" 	=> "switch"		
					);

				

/***************** TODO : Blog Details ****************/
	
$of_options[] = array( 	"name" 		=> "Blog Details"
						,"type" 	=> "heading"
						,"icon"		=> TVLGiao_Wpdance_ADMIN_IMAGES . "icon-slider.png"
				);
$of_options[] = array( 	"name" 		=> "Blog Layout"
						,"desc" 	=> "Select main content and sidebar alignment. Choose between 1, 2 column layout."
						,"id" 		=> "wd_post_layout"
						,"std" 		=> "0-1-1"
						,"type" 	=> "images"
						,"options" 	=> array(
							'0-1-0' 	=> $url . '1col.png'
							,'0-1-1' 	=> $url . '2cr.png'
							,'1-1-0' 	=> $url . '2cl.png'
							,'1-1-1' 	=> $url . '3cm.png'
						)
				);
$of_options[] = array( 	"name" 		=> "Left Sidebar"
						,"id" 		=> "wd_post_left_sidebar"
						,"std" 		=> "blog-left-widget-area"
						,"type" 	=> "select"
						//,"mod"		=> "mini"
						,"options" 	=> $of_sidebars
				);	
$of_options[] = array( 	"name" 		=> "Right Sidebar"
						,"id" 		=> "wd_post_right_sidebar"
						,"std" 		=> "blog-right-widget-area"
						,"type" 	=> "select"
						//,"mod"		=> "mini"
						,"options" 	=> $of_sidebars
				);		
				
$of_options[] = array( 	"name" 		=> "Blog Time"
						,"desc" 	=> "Show/hide Time"
						,"id" 		=> "wd_blog_details_time"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"folds"	=> 1
						,"type" 	=> "switch"		
					);	
$of_options[] = array( 	"name" 		=> "Blog Comment Number"
						,"desc" 	=> "Show/hide Comment number of blog"
						,"id" 		=> "wd_blog_details_comment"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"folds"	=> 1
						,"type" 	=> "switch"		
					);		
$of_options[] = array( 	"name" 		=> "Blog Categories"
						,"desc" 	=> "Show/hide Categories"
						,"id" 		=> "wd_blog_details_categories"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"folds"	=> 1
						,"type" 	=> "switch"		
					);
$of_options[] = array( 	"name" 		=> "Blog Tags"
						,"desc" 	=> "Show/hide Tags"
						,"id" 		=> "wd_blog_details_tags"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"folds"	=> 1
						,"type" 	=> "switch"		
					);

$of_options[] = array( 	"name" 		=> "Blog Thumbnail"
						,"desc" 	=> "Show/hide Thumbnail"
						,"id" 		=> "wd_blog_details_thumbnail"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"folds"	=> 1
						,"type" 	=> "switch"		
					);		


$of_options[] = array( 	"name" 		=> "Blog Social Sharing"
						,"desc" 	=> "Show/hide Social Sharing"
						,"id" 		=> "wd_blog_details_socialsharing"
						,"std" 		=> 0
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"folds"	=> 1
						,"type" 	=> "switch"		
					);		
$of_options[] = array( 	"name" 		=> "Blog Author Box"
						,"desc" 	=> "Show/hide Author Box"
						,"id" 		=> "wd_blog_details_authorbox"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"folds"	=> 1
						,"type" 	=> "switch"		
					);						
$of_options[] = array( 	"name" 		=> "Blog Comment List"
						,"desc" 	=> "Show/hide Comment List"
						,"id" 		=> "wd_blog_details_commentlist"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"folds"	=> 1
						,"type" 	=> "switch"		
					);						
				
/***************** TODO : Custom CSS ****************/
$of_options[] = array( 	"name" 		=> "Custom Css"
						,"type" 	=> "heading"
						,"icon"		=> TVLGiao_Wpdance_ADMIN_IMAGES . "icon-slider.png"
				);
$of_options[] = array( 	"name" 		=> "CSS Code",
						"desc" 		=> "Quickly add some CSS to your theme by adding it to this block.",
						"id" 		=> "wd_custom_css",
						"std" 		=> "",
						"type" 		=> "textarea"
				);					
/***************** TODO : Backup Options ****************/

$of_options[] = array( 	"name" 		=> "Backup Options"
						,"type" 	=> "heading"
						,"icon"		=> TVLGiao_Wpdance_ADMIN_IMAGES . "icon-backup.png"
				);
				
$of_options[] = array( 	"name" 		=> "Backup and Restore Options"
						,"id" 		=> "of_backup"
						,"std" 		=> ""
						,"type" 	=> "backup"
						,"desc" 	=> 'You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.'
				);
				
$of_options[] = array( 	"name" 		=> "Transfer Theme Options Data"
						,"id" 		=> "of_transfer"
						,"std" 		=> ""
						,"type" 	=> "transfer"
						,"desc" 	=> 'You can tranfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click "Import Options".'
				);
				
/***************** TODO : Documentation ****************/				
				
$of_options[] = array( 	"name" 		=> "Documentation"
						,"type" 		=> "heading"
						,"icon"		=> TVLGiao_Wpdance_ADMIN_IMAGES . "icon-docs.png"
				);
				
$of_options[] = array( 	"name" 		=> "Docs #1"
						,"desc" 		=> ""
						,"id" 		=> "introduction"
						,"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Welcome to the Options Framework demo.</h3>
							This is a slightly modified version of the original options framework by Devin Price with a couple of aesthetical improvements on the interface and some cool additional features. If you want to learn how to setup these options or just need general help on using it feel free to visit my blog at <a href=\"http://aquagraphite.com/2011/09/29/slightly-modded-options-framework/\">AquaGraphite.com</a>"
						,"icon" 		=> true
						,"type" 		=> "info"
				);	

$of_options[] = array( 	"name" 		=> "Docs #2"
						,"desc" 		=> ""
						,"id" 		=> "introduction"
						,"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Welcome to the Options Framework demo.</h3>
							This is a slightly modified version of the original options framework by Devin Price with a couple of aesthetical improvements on the interface and some cool additional features. If you want to learn how to setup these options or just need general help on using it feel free to visit my blog at <a href=\"http://aquagraphite.com/2011/09/29/slightly-modded-options-framework/\">AquaGraphite.com</a>"
						,"icon" 		=> true
						,"type" 		=> "info"
				);	


$of_options[] = array( 	"name" 		=> "Docs #3"
						,"desc" 		=> ""
						,"id" 		=> "introduction"
						,"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Welcome to the Options Framework demo.</h3>
							This is a slightly modified version of the original options framework by Devin Price with a couple of aesthetical improvements on the interface and some cool additional features. If you want to learn how to setup these options or just need general help on using it feel free to visit my blog at <a href=\"http://aquagraphite.com/2011/09/29/slightly-modded-options-framework/\">AquaGraphite.com</a>"
						,"icon" 		=> true
						,"type" 		=> "info"
				);	

$of_options[] = array( 	"name" 		=> "Docs #4"
						,"desc" 		=> ""
						,"id" 		=> "introduction"
						,"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Welcome to the Options Framework demo.</h3>
							This is a slightly modified version of the original options framework by Devin Price with a couple of aesthetical improvements on the interface and some cool additional features. If you want to learn how to setup these options or just need general help on using it feel free to visit my blog at <a href=\"http://aquagraphite.com/2011/09/29/slightly-modded-options-framework/\">AquaGraphite.com</a>"
						,"icon" 		=> true
						,"type" 		=> "info"
				);			
	}//End function: of_options()
}//End chack if function exists: of_options()

?>
