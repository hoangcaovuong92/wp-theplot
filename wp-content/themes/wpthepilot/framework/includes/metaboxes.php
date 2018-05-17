<?php 
class TvlgiaoWpdanceNoOneAdminTheme extends TvlgiaoWpdanceNoOneTheme
{
	protected $tabs = array();
	
	protected $arrLayout = array();
		
	public function __construct(){
		$this->constants();
		$this->tvlgiao_wpdance_resetArrLayout();
		add_action('admin_init',array($this,'tvlgiao_wpdance_loadJSCSS'));
		add_action('admin_enqueue_scripts',array($this,'tvlgiao_wpdance_loadJSCSS'));
		////// load custom field ///////
		require_once get_template_directory().'/framework/includes/custom_fields.php';
		$classCustomFields = 'TvlgiaoWpdanceNoOneCustomFields';
		$customFields = new $classCustomFields();						
	}
	
	public function constants(){
		define('THEME_INCLUDES_JS_URI', TVLGiao_Wpdance_THEME_INCLUDES_URI . '/js');
		define('THEME_INCLUDES_CSS_URI', TVLGiao_Wpdance_THEME_INCLUDES_URI . '/css');
		define('THEME_INCLUDES_IMAGES', THEME_INCLUDES . '/images');

		define('THEME_INCLUDES_FUNCTIONS', THEME_INCLUDES . '/functions');
		define('THEME_ADMIN_OPTIONS', THEME_INCLUDES . '/options');
		define('THEME_ADMIN_METABOXES', THEME_INCLUDES . '/metaboxes');
		define('THEME_ADMIN_DOCS', THEME_INCLUDES . '/docs');
		
		define('THEME_INCLUDES_METABOXES', THEME_INCLUDES . '/metaboxes');
		
		
		// the option name custom sidebar(layout) for category and tag
 		define('MY_CATEGORY_SIDEBAR', TVLGiao_Wpdance_THEME_SLUG.'my_category_sidebar_option');
		define('MY_TAG_SIDEBAR', TVLGiao_Wpdance_THEME_SLUG.'my_tag_sidebar_option');
	}
	
	protected function tvlgiao_wpdance_setArrLayout($array = array()){
		$this->arrLayout = $array;
	}

	/* Set defaulr value for array layout */
	protected function tvlgiao_wpdance_resetArrLayout(){
		$this->tvlgiao_wpdance_setArrLayout(array(
			'1column'		=>	array(	'image'	=>	'i_1column.png', 		'title'	=>	esc_html__('Content - No Sidebar','wpnoone')	),
			'2columns-left'	=>	array(	'image'	=>	'i_3columns_right.png', 	'title'	=>	esc_html__('Content - Left Sidebar','wpnoone')),
			'2columns-right'=>	array(	'image'	=>	'i_3columns_left.png', 'title'	=>	esc_html__('Content - Right Sidebar','wpnoone')),
		));
		
	}
	/* Save custom sidebar and layout for category and tag */
	
	protected function tvlgiao_wpdance_showTooltip($title,$content){	
		include THEME_INCLUDES_FUNCTIONS.'/tooltip.php';
	}
	
	public function tvlgiao_wpdance_loadJSCSS(){
		wp_enqueue_script('jquery');
		wp_enqueue_script("jquery-ui-core");
		wp_enqueue_script("jquery-ui-widget");
		wp_enqueue_script("jquery-ui-tabs");
		wp_enqueue_script("jquery-ui-mouse");
		wp_enqueue_script("jquery-ui-sortable");
		wp_enqueue_script("jquery-ui-slider");
		wp_enqueue_script("jquery-ui-accordion");
		wp_enqueue_script("jquery-effects-core");
		wp_enqueue_script("jquery-effects-slide");
		wp_enqueue_script("jquery-effects-blind");	
		wp_register_script( 'jqueryform', THEME_INCLUDES_JS_URI.'/jquery.form.js');
		wp_enqueue_script('jqueryform');

		wp_register_script( 'tab', THEME_INCLUDES_JS_URI.'/tab.js');
		wp_enqueue_script('tab');
		
		wp_register_script( 'page_config_js', THEME_INCLUDES_JS_URI.'/page_config.js');
		wp_enqueue_script('page_config_js');
		
		wp_register_script( 'product_config', THEME_INCLUDES_JS_URI.'/product_config.js');
		wp_enqueue_script('product_config');
		
		wp_register_style( 'config_css', THEME_INCLUDES_CSS_URI.'/admin.css');
		wp_enqueue_style('config_css');
		 

		/// Start Fancy Box
		wp_register_style( 'fancybox_css', TVLGiao_Wpdance_THEME_CSS.'/jquery.fancybox.css');
		wp_enqueue_style('fancybox_css');		
		wp_register_script( 'fancybox_js', TVLGiao_Wpdance_THEME_JS.'/jquery.fancybox.pack.js');
		wp_enqueue_script('fancybox_js');	
		/// End Fancy Box		
		
		wp_register_style( 'colorpicker', TVLGiao_Wpdance_THEME_CSS.'/colorpicker.css');
		wp_enqueue_style('colorpicker');		
		wp_register_script( 'bootstrap-colorpicker', TVLGiao_Wpdance_THEME_JS.'/bootstrap-colorpicker.js');
		wp_enqueue_script('bootstrap-colorpicker');	
		
		global $is_admin_menu;
				
		wp_register_style( 'font-awesome', THEME_INCLUDES_CSS_URI.'/font-awesome.css');
		wp_enqueue_style('font-awesome');	

		wp_enqueue_script('plupload-all');
		
		wp_enqueue_script('utils');
		wp_enqueue_script('plupload');
		wp_enqueue_script('plupload-html5');
		wp_enqueue_script('plupload-flash');
		wp_enqueue_script('plupload-silverlight');
		wp_enqueue_script('plupload-html4');
		wp_enqueue_script('media-views');
		wp_enqueue_script('wp-plupload');
		
		
		wp_enqueue_script('thickbox');
		wp_enqueue_style('thickbox');
		wp_enqueue_script('media-upload');
	
		
		wp_register_script( 'logo_upload', THEME_INCLUDES_JS_URI.'/logo-upload.js');
		wp_enqueue_script('logo_upload');
		
		
	}
}
?>