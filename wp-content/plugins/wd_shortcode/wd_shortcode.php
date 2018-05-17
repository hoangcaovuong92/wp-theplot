<?php
/*
Plugin Name: WD ShortCode
Plugin URI: http://www.wpdance.com/
Description: ShortCode From WPDance Team
Author: Wpdance
Version: 2.0.2
Author URI: http://www.wpdance.com/
*/
class WD_Shortcode
{
	protected $arrShortcodes = array();
	public function __construct(){
		$this->constant();
		//$this->init_script();
		add_action('wp_enqueue_scripts',array($this,'init_script'));
		$this->initArrShortcodes();
		$this->initShortcodes();
	}

	protected function initArrShortcodes(){
		$this->arrShortcodes = array('feature_product_slider','code','specific_product_slider','recent_product_slider', 'recent_product', 'sale_product','typography','feedburner','countdown','wd_testimonial','recent_post','bt_multitab','bt_alerts','bt_buttons','wd_features','bt_progress_bars','quote','google_map','symbol','wd_projects','pricing_table', 'banner', 'woo-shortcode', 'menu', 'wd_html5_video', 'wd_gap','wd_product_cat_slider', 'top_rated_products', 'best_selling_products', 'best_selling_product_slider', 'wd_gallery','child_categories', 'product_filter_by_cats', 'instagram', 'popular_post','custom_product_by_category','product_filter_by_category','woo_product','box','simple_product' );
	}
	
	protected function initShortcodes(){
		foreach($this->arrShortcodes as $shortcode){
			//echo SC_ShortCode."{$shortcode}.php <br/>";
			if(file_exists(SC_ShortCode."/{$shortcode}.php")){
				require_once SC_ShortCode."/{$shortcode}.php";
			}	
		}
	}

	public function init_script(){
		wp_enqueue_script('jquery');

		wp_register_style( 'shop_shortcode', SC_CSS.'/shop_shortcode.css');
		wp_enqueue_style('shop_shortcode');
		
		wp_register_style( 'blog_shortcode', SC_CSS.'/blog_shortcode.css');
		wp_enqueue_style('blog_shortcode');
		
		wp_register_style( 'bootstrap', SC_CSS.'/bootstrap.css');
		wp_enqueue_style('bootstrap');
		
		wp_register_style( 'bootstrap-theme', SC_CSS.'/bootstrap-theme.css');
		wp_enqueue_style('bootstrap-theme');
		
		wp_register_style( 'css.countdown', SC_CSS.'/jquery.countdown.css');
		wp_enqueue_style('css.countdown');
		
		wp_register_style( 'owl.carousel', SC_CSS.'/owl.carousel.min.css');
		wp_enqueue_style('owl.carousel');	
				
		
		
		wp_register_style( 'tooltip_skin', SC_CSS.'/tooltip_skin.css');
		wp_enqueue_style('tooltip_skin');	
		
		wp_register_script( 'bootstrap', SC_JS.'/bootstrap.js',false,false,true);
		wp_enqueue_script('bootstrap');
		
		wp_register_script( 'wd_shortcode', SC_JS.'/wd_shortcode.js',false,false,true);
		wp_enqueue_script('wd_shortcode');
		
		wp_register_script( 'jquery.plugin.countdown', SC_JS.'/jquery.countdown.plugin.min.js',false,false,true);
		wp_enqueue_script('jquery.plugin.countdown');
		
		wp_register_script( 'jquery.countdown', SC_JS.'/jquery.countdown.js',false,false,true);
		wp_enqueue_script('jquery.countdown');
		
		wp_register_script( 'owl.carousel', SC_JS.'/owl.carousel.min.js',false,false,true);
		wp_enqueue_script('owl.carousel');
		
		wp_register_script( 'sky.carousel', SC_JS.'/jquery.sky.carousel-1.0.2.min.js',false,false,true);
		wp_enqueue_script('sky.carousel');
		
		
	}
	
	protected function constant(){
		//define('DS',DIRECTORY_SEPARATOR);	
		define('SC_BASE'	,  	plugins_url( '', __FILE__ ));
		define('SC_ShortCode'	, 	plugin_dir_path( __FILE__ ) . 'shortcode'	);
		define('SC_JS'		, 	SC_BASE . '/js'			);
		define('SC_CSS'		, 	SC_BASE . '/css'		);
		define('SC_IMAGE'	, 	SC_BASE . '/images'		);
	}	
}	

$_wd_shortcode = new WD_Shortcode; // Start an instance of the plugin class
?>