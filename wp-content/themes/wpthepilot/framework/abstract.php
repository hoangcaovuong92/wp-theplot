<?php 
class TvlgiaoWpdanceNoOneTheme
{
	protected $options = array();
	protected $arrFunctions = array();
	protected $arrWidgets = array();
	protected $arrIncludes = array();
	public function __construct($options){
		$this->options = $options;
		$this->TVLGiao_Wpdance_initArrFunctions();
		$this->TVLGiao_Wpdance_initArrWidgets();
		$this->TVLGiao_Wpdance_initArrIncludes();
		$this->constant($options);
	}

	public function init(){
		////// Active theme
		$this->TVLGiao_Wpdance_hookActive($this->options['tvlgiao_wpdance_theme_slug'], array($this,'TVLGiao_Wpdance_activeTheme'));

		$this->TVLGiao_Wpdance_initIncludes();
		
		///// After Setup theme
		add_action( 'after_setup_theme', array($this,'TVLGiao_Wpdance_wpdancesetup'));
		
		////// deactive theme
		$this->TVLGiao_Wpdance_hookDeactive($this->options['tvlgiao_wpdance_theme_slug'], array($this,'TVLGiao_Wpdance_deactiveTheme'));
				
		add_action('wp_enqueue_scripts',array($this,'TVLGiao_Wpdance_addScripts'));
		
		//add_action('wp_enqueue_scripts',array($this,'addTailScripts'),1000000);
			
		$this->TVLGiao_Wpdance_initFunctions();
		$this->TVLGiao_Wpdance_initWidgets();
		
		//call admin
		require_once get_template_directory().'/framework/includes/metaboxes.php';
		$classNameAdmin = 'TvlgiaoWpdanceNoOneAdminTheme';
		$panel = new $classNameAdmin();
		
		//$this->loadImageSize();
		add_action( 'init' , array($this, 'TVLGiao_Wpdance_loadImageSize'));
		$this->TVLGiao_Wpdance_extension();
	}
	
	protected function TVLGiao_Wpdance_initArrFunctions(){
		$this->arrFunctions = array('main','global_var','video','breadcrumbs','excerpt','pagination','theme_control','filter_theme','comment','theme_sidebar','custom_style','header_function','footer_function','woo-cart','woo-product','woo-hook','woo-account', 'woo-wishlist', 'loading_page', 'ajax_function');
	}
	
	
	protected function TVLGiao_Wpdance_initArrWidgets(){
		$this->arrWidgets = array('customrecent','custompages'
								,'recent_comments_custom','ew_social','productaz','ew_subscriptions', 'best_selling_product', 'wd_woo_products', 'hot_product', 'recent_product','team_member');
	}
	
	protected function TVLGiao_Wpdance_initArrIncludes(){
		$this->arrIncludes = array('class-tgm-plugin-activation');
	}
		
	public function TVLGiao_Wpdance_wpdancesetup() {
		// This theme styles the visual editor with editor-style.css to match the theme style.
		add_editor_style();

		// Post Format support. You can also use the legacy "gallery" or "asides" (note the plural) categories.
		//add_theme_support( 'post-formats', array( 'aside', 'gallery' ) );
		$args = array(
			'width'         => 940,
			'height'        => 198,
			'default-image' => get_template_directory_uri() . '/images/headers/header-v1.jpg',
		);
		// This theme supports a variety of post formats.
		add_theme_support( 'post-formats', array( 'aside', 'link', 'gallery', 'status', 'quote', 'image' ) );		
		add_theme_support( 'custom-header', $args ) ;
		
		add_theme_support( 'title-tag' );
		
		
		if ( ! function_exists( '_wp_render_title_tag' ) ) :
			add_action( 'wp_head', array( $this, 'theme_slug_render_title' ) );
		endif;
		
		// This theme uses post thumbnails
		add_theme_support( 'post-thumbnails' );

		// Add default posts and comments RSS feed links to head
		add_theme_support( 'automatic-feed-links' );

		$defaults = array(
			'default-color'          => '',
			'default-image'          => get_template_directory_uri()."/images/default-background.png",			
		);
		
		global $wp_version;
		add_theme_support( 'custom-background', $defaults );
				
		add_post_type_support( 'forum', array('thumbnail') );
		add_theme_support( 'woocommerce' );	
		if ( ! isset( $content_width ) ) $content_width = 960;
		
		// Make theme available for translation
		// Translations can be filed in the /languages/ directory
		load_theme_textdomain( 'wpnoone', get_template_directory() . '/languages' );

		$locale = get_locale();
		$locale_file = get_template_directory() . "/languages/$locale.php";
		if ( is_readable( $locale_file ) )
			require_once get_template_directory()."/languages/$locale.php";

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary Navigation', 'wpnoone' )
		) );
		
		register_nav_menus( array(
			'mobile' =>  esc_html__( 'Mobile Navigation', 'wpnoone' )
		) );					

		// Your changeable header business starts here
		if ( ! defined( 'HEADER_TEXTCOLOR' ) )
			define( 'HEADER_TEXTCOLOR', '' );

		// No CSS, just IMG call. The %s is a placeholder for the theme template directory URI.
		if ( ! defined( 'HEADER_IMAGE' ) )
			define( 'HEADER_IMAGE', '%s/images/headers/path.jpg' );

		set_post_thumbnail_size( HEADER_IMAGE_WIDTH, HEADER_IMAGE_HEIGHT, true );

		// Don't support text inside the header image.
		if ( ! defined( 'NO_HEADER_TEXT' ) )
			define( 'NO_HEADER_TEXT', true );

		// Add a way for the custom header to be styled in the admin panel that controls
		// custom headers. See wpdance_admin_header_style(), below.

		$this->TVLGiao_Wpdance_loadgoogle_fonts();
		// ... and thus ends the changeable header business.
		
	}
	
	protected function constant($options){
		define('TVLGiao_Wpdance_DS',DIRECTORY_SEPARATOR);	
		define('TVLGiao_Wpdance_THEME_SLUG', $options['tvlgiao_wpdance_theme_slug'].'_');
		
		define('TVLGiao_Wpdance_THEME_DIR', get_template_directory());
		
		define('TVLGiao_Wpdance_THEME_CACHE', get_template_directory().TVLGiao_Wpdance_DS.'cache_theme'.TVLGiao_Wpdance_DS);
		
		define('TVLGiao_Wpdance_THEME_URI', get_template_directory_uri());
		
		define('THEME_FRAMEWORK', TVLGiao_Wpdance_THEME_DIR . '/framework');
		
		define('TVLGiao_Wpdance_THEME_FRAMEWORK_URI', TVLGiao_Wpdance_THEME_URI . '/framework');
		
		define('TVLGiao_Wpdance_THEME_FUNCTIONS', THEME_FRAMEWORK . '/functions');
		
		define('TVLGiao_Wpdance_THEME_WIDGETS', THEME_FRAMEWORK . '/widgets');

		define('THEME_INCLUDES', THEME_FRAMEWORK . '/includes');
		
		define('TVLGiao_Wpdance_THEME_LIB', THEME_FRAMEWORK . '/lib');
		
		define('TVLGiao_Wpdance_THEME_INCLUDES_URI', TVLGiao_Wpdance_THEME_URI . '/framework/includes');
		
		define('TVLGiao_Wpdance_THEME_EXTENSION', THEME_FRAMEWORK . '/extension');
		
		define('TVLGiao_Wpdance_THEME_EXTENDS_EXTENDVC_URI', THEME_FRAMEWORK.'/extendvc');
		
		define('TVLGiao_Wpdance_THEME_CSS', TVLGiao_Wpdance_THEME_URI . '/css');
		define('TVLGiao_Wpdance_THEME_JS', TVLGiao_Wpdance_THEME_URI . '/js');

		
		define('TVLGiao_Wpdance_USING_CSS_CACHE', true);
		
	}
	
	protected function TVLGiao_Wpdance_initFunctions(){
		foreach($this->arrFunctions as $function){
			if(file_exists(TVLGiao_Wpdance_THEME_FUNCTIONS."/{$function}.php"))
			{
				require_once get_template_directory()."/framework/functions/{$function}.php";
			}	
		}
	}
	
	protected function TVLGiao_Wpdance_extension(){
		$this->TVLGiao_Wpdance_extendVC();
	}
	
	protected function TVLGiao_Wpdance_initWidgets(){
		foreach($this->arrWidgets as $widget){
			if(file_exists(TVLGiao_Wpdance_THEME_WIDGETS."/{$widget}.php"))
			{
				require_once get_template_directory()."/framework/widgets/{$widget}.php";
			}
		}
		add_action( 'widgets_init', array($this,'TVLGiao_Wpdance_loadWidgets'));
	}
	
	protected function TVLGiao_Wpdance_initIncludes(){
		foreach($this->arrIncludes as $include){
			if(file_exists(TVLGiao_Wpdance_THEME_LIB."/{$include}.php")){
				require_once get_template_directory()."/framework/lib/{$include}.php";
			}
		}
	}
		
	public function TVLGiao_Wpdance_loadWidgets(){
		foreach($this->arrWidgets as $widget)
			register_widget( 'WP_Widget_'.ucfirst($widget) );
	}
	
	public function TVLGiao_Wpdance_activeTheme(){
		//Single Image
		update_option( 'shop_single_image_size', array('height'=>'700', 'width' => '570', 'crop' => 1 ));
		//Thumbnail Image
		update_option( 'shop_thumbnail_image_size', array('height'=>'109', 'width' => '98', 'crop' => 1 ));
		//Catalog Image
		update_option( 'shop_catalog_image_size', array('height'=>'448', 'width' => '353', 'crop' => 1 ));
		
						
		
	}
	
	public function TVLGiao_Wpdance_hookActive($code, $function){
		$optionKey="theme_is_activated_" . $code;
		if(!get_option($optionKey)) {
			call_user_func($function);
			update_option($optionKey , 1);
		}
	}
	
	public function TVLGiao_Wpdance_deactiveTheme(){
	
	}
	
	/**
	 * @desc registers deactivation hook
	 * @param string $code : Code of the theme. This must match the value you provided in wp_register_theme_activation_hook function as $code
	 * @param callback $function : Function to call when theme gets deactivated.
	 */
	public function TVLGiao_Wpdance_hookDeactive($code, $function) {
		// store function in code specific global
		$GLOBALS["wp_register_theme_deactivation_hook_function" . $code]=$function;

		// create a runtime function which will delete the option set while activation of this theme and will call deactivation function provided in $function
		$fn=create_function('$theme', ' call_user_func($GLOBALS["wp_register_theme_deactivation_hook_function' . $code . '"]); delete_option("theme_is_activated_' . $code. '");');

		// add above created function to switch_theme action hook. This hook gets called when admin changes the theme.
		// Due to wordpress core implementation this hook can only be received by currently active theme (which is going to be deactivated as admin has chosen another one.
		// Your theme can perceive this hook as a deactivation hook.)
		add_action("switch_theme", $fn);
	}
	
	public function TVLGiao_Wpdance_addTailScripts(){

		global $tvlgiao_wpdance_wd_data;
	
		wp_register_style( 'custom_default', TVLGiao_Wpdance_THEME_CSS.'/custom_default.less');
		wp_enqueue_style('custom_default');	
		
		

		wp_register_script( 'less', TVLGiao_Wpdance_THEME_JS.'/less.js');
		wp_enqueue_script('less');	
	}
	
	public function TVLGiao_Wpdance_addLastScripts(){
		if(is_rtl()) {
			wp_register_style( 'wd-rtl', TVLGiao_Wpdance_THEME_CSS.'/wd_rtl.css');
			wp_enqueue_style('wd-rtl');
		}
	}
	
	public function TVLGiao_Wpdance_addScripts(){
		global $is_IE, $tvlgiao_wpdance_wd_data;		
		$query_args = array(
		'family' => urlencode( 'Quicksand:400,300,700|Raleway:400,500,600,700|Teko:400,300,500,600,700|Montserrat:400,700|Lora:400,400italic,700,700italic|Archivo+Narrow:400,700|Lato:400,700|Alike+Angular')
		 );

		 wp_register_style( 'tvlgiao-wpdance-google-fonts', add_query_arg( $query_args, "//fonts.googleapis.com/css" ), array(), null );
		 wp_enqueue_style( 'tvlgiao-wpdance-google-fonts' );
		
		
		
		
		wp_register_style( 'bootstrap', TVLGiao_Wpdance_THEME_CSS.'/bootstrap.css');
		wp_enqueue_style('bootstrap');
		
		wp_register_style( 'bootstrap-theme', TVLGiao_Wpdance_THEME_CSS.'/bootstrap-theme.css');
		wp_enqueue_style('bootstrap-theme');
		
		wp_enqueue_style( 'default', get_stylesheet_uri() ); 
		wp_register_style( 'reset', TVLGiao_Wpdance_THEME_CSS.'/reset.css');
		wp_enqueue_style('reset');
		
		wp_register_style( 'colorpicker', TVLGiao_Wpdance_THEME_CSS.'/colorpicker.css');
		wp_enqueue_style('colorpicker');
		wp_register_style( 'fancybox_css', TVLGiao_Wpdance_THEME_CSS.'/jquery.fancybox.css');
		wp_enqueue_style('fancybox_css');
		
		
		wp_register_style( 'font-awesome', TVLGiao_Wpdance_THEME_FRAMEWORK_URI.'/css/font-awesome.css');
		wp_enqueue_style('font-awesome');
		wp_register_style( 'base', TVLGiao_Wpdance_THEME_CSS.'/base.css');
		wp_enqueue_style('base');
		wp_register_style( 'wd-widget', TVLGiao_Wpdance_THEME_CSS.'/widget.css');
		wp_enqueue_style('wd-widget');
		wp_register_style( 'select2', TVLGiao_Wpdance_THEME_CSS.'/select2.css');
		wp_enqueue_style('select2');
		wp_register_style( 'cs-animate', TVLGiao_Wpdance_THEME_CSS.'/cs-animate.css');
		wp_enqueue_style('cs-animate');
		
		if(is_rtl()) {
			wp_register_style( 'wd-rtl', TVLGiao_Wpdance_THEME_CSS.'/wd_rtl.css');
			wp_enqueue_style('wd-rtl');
		}
		
		wp_register_style( 'responsive', TVLGiao_Wpdance_THEME_CSS.'/responsive.css');
		wp_enqueue_style('responsive');
		
		wp_enqueue_script('jquery');	
		wp_register_script( 'bootstrap', TVLGiao_Wpdance_THEME_JS.'/bootstrap.js',false,false,true);
		wp_enqueue_script('bootstrap');		
		wp_register_script( 'TweenMax', TVLGiao_Wpdance_THEME_JS.'/TweenMax.min.js',false,false,true);
		wp_enqueue_script('TweenMax');
		

		wp_register_script( 'bootstrap-colorpicker', TVLGiao_Wpdance_THEME_JS.'/bootstrap-colorpicker.js',false,false,true);
		wp_enqueue_script('bootstrap-colorpicker');	
		
		wp_register_script( 'include-script', TVLGiao_Wpdance_THEME_JS.'/include-script.js',false,false,true);
		wp_enqueue_script('include-script');

		wp_register_script( 'jquery.carouFredSel', TVLGiao_Wpdance_THEME_JS.'/jquery.carouFredSel-6.2.1.min.js',false,false,true);
		wp_enqueue_script('jquery.carouFredSel');

		wp_register_script( 'owl.carousel', TVLGiao_Wpdance_THEME_JS.'/owl.carousel.min.js',false,false,true);
		wp_enqueue_script('owl.carousel');
			
		wp_register_script( 'jquery.select2', TVLGiao_Wpdance_THEME_JS.'/select2.js',false,false,true);
		wp_enqueue_script('jquery.select2');	

		wp_register_script( 'jquery-appear', TVLGiao_Wpdance_THEME_JS.'/jquery.appear.js',false,false,true);
		wp_enqueue_script('jquery-appear');
		
		wp_register_script( 'isotope-min', TVLGiao_Wpdance_THEME_JS.'/isotope.min.js',false,false,true);
		wp_enqueue_script('isotope-min');
		
		wp_register_script( 'tiltfx', TVLGiao_Wpdance_THEME_JS.'/tiltfx.js');
		wp_enqueue_script('tiltfx');
		
		if( is_page_template( 'page-templates/onepage-template.php' ) ) {
			wp_register_style( 'jquery.fullPage.css', TVLGiao_Wpdance_THEME_CSS.'/jquery.fullPage.css');
			wp_enqueue_style('jquery.fullPage.css');
			
			wp_register_script( 'jquery.fullPage', TVLGiao_Wpdance_THEME_JS.'/jquery.fullPage.js',false,false,true);
			wp_enqueue_script( 'jquery.fullPage' );
			
		}
		if(is_singular('product')){
			wp_register_script( 'jquery.cloud-zoom', TVLGiao_Wpdance_THEME_JS.'/cloud-zoom.1.0.2.js',false,false,true);
			wp_enqueue_script('jquery.cloud-zoom');		
			wp_register_style( 'cloud-zoom-css', TVLGiao_Wpdance_THEME_CSS.'/cloud-zoom.css');
			wp_enqueue_style('cloud-zoom-css');
		
		}else{
			wp_register_script( 'jquery.prettyPhoto', TVLGiao_Wpdance_THEME_JS.'/jquery.prettyPhoto.min.js',false,false,true);
			wp_enqueue_script('jquery.prettyPhoto');	
			wp_register_script( 'jquery.prettyPhoto.init', TVLGiao_Wpdance_THEME_JS.'/jquery.prettyPhoto.init.min.js',false,false,true);
			wp_enqueue_script('jquery.prettyPhoto.init');				
			wp_register_style( 'css.prettyPhoto', TVLGiao_Wpdance_THEME_CSS.'/prettyPhoto.css');
			wp_enqueue_style('css.prettyPhoto');
		}
		
		
		if(!is_admin()){		
			if(wp_is_mobile()) {
				wp_register_script( 'mobile-jquery', TVLGiao_Wpdance_THEME_JS.'/jquery.mobile.min.js',false,false,true);
				wp_enqueue_script('mobile-jquery');
				
				wp_register_script( 'mobile-event', TVLGiao_Wpdance_THEME_JS.'/mobile-event.js',false,false,true);
				wp_enqueue_script('mobile-event');
			}
			
			
			wp_register_script( 'main-js', TVLGiao_Wpdance_THEME_JS.'/main.js',false,false,true);
			wp_enqueue_script('main-js');
			
			
			if(isset($tvlgiao_wpdance_wd_data['wd_smooth_scroll']) && absint($tvlgiao_wpdance_wd_data['wd_smooth_scroll']) == 1){
				if(!wp_is_mobile()) {
					if($this->tvlgiao_wpdance_is_windows() && $this->tvlgiao_wpdance_is_chrome()) {
						wp_register_script( 'smooth-scroll', TVLGiao_Wpdance_THEME_JS.'/smoothScroll.js',false,false,true);
						wp_enqueue_script('smooth-scroll');
					}
				}
			}
			
			if(isset($tvlgiao_wpdance_wd_data['wd_loading_page']) && absint($tvlgiao_wpdance_wd_data['wd_loading_page']) == 1){ 
				if(!wp_is_mobile()) { 
					wp_register_style( 'pace-page', TVLGiao_Wpdance_THEME_CSS.'/pace.page.css');
					wp_enqueue_style('pace-page');
					wp_register_script( 'pace-min', TVLGiao_Wpdance_THEME_JS.'/pace.min.js',false,false,true);
					wp_enqueue_script('pace-min');
				}
			}
		}
	}
	
	public function tvlgiao_wpdance_is_windows(){
		$u = $_SERVER['HTTP_USER_AGENT'];
		$window  = (bool)preg_match('/Windows/i', $u );
		return $window;
	}
	public function tvlgiao_wpdance_is_chrome(){
		$u = $_SERVER['HTTP_USER_AGENT'];
		$chrome  = (bool)preg_match('/Chrome/i', $u );
		return $chrome;
	}
	//extend visual composer 
	protected function TVLGiao_Wpdance_extendVC(){
		
		
		// Initialising Shortcodes
		if (false||class_exists('WPBakeryVisualComposerAbstract')) {
			require_once get_template_directory().'/framework/extension/extendvc/vc_includes/vc_functions.php';
			require_once get_template_directory().'/framework/extension/extendvc/vc_includes/vc_images.php';
			function TVLGiao_Wpdance_requireVcExtend(){	
				$vc_generates = array('heading','quote','gap','banner','team_member','portfolio','pricing_table','count_down_icon','button','testimonial','woo-products','recent_blogs','wd_projects','custom_product_by_category');		
				foreach($vc_generates as $vc_generate){
					if(file_exists(TVLGiao_Wpdance_THEME_EXTENSION."/extendvc/vc_generate/{$vc_generate}.php"))
						require_once get_template_directory()."/framework/extension/extendvc/vc_generate/{$vc_generate}.php";
				}	
				
			}
			add_action('admin_init', 'TVLGiao_Wpdance_requireVcExtend',2);
		}
	}
	protected function TVLGiao_Wpdance_loadgoogle_fonts()
	{
		global $tvlgiao_wpdance_google_fonts;
			$tvlgiao_wpdance_google_fonts = array(
				"none" => "Select a font"
				,"ABeeZee" => "ABeeZee"
				,"Abel" => "Abel"
				,"Abril Fatface" => "Abril Fatface"
				,"Aclonica" => "Aclonica"
				,"Acme" => "Acme"
				,"Actor" => "Actor"
				,"Adamina" => "Adamina"
				,"Advent Pro" => "Advent Pro"
				,"Aguafina Script" => "Aguafina Script"
				,"Akronim" => "Akronim"
				,"Aladin" => "Aladin"
				,"Aldrich" => "Aldrich"
				,"Alef" => "Alef"
				,"Alegreya" => "Alegreya"
				,"Alegreya SC" => "Alegreya SC"
				,"Alex Brush" => "Alex Brush"
				,"Alfa Slab One" => "Alfa Slab One"
				,"Alice" => "Alice"
				,"Alike" => "Alike"
				,"Alike Angular" => "Alike Angular"
				,"Allan" => "Allan"
				,"Allerta" => "Allerta"
				,"Allerta Stencil" => "Allerta Stencil"
				,"Allura" => "Allura"
				,"Almendra" => "Almendra"
				,"Almendra Display" => "Almendra Display"
				,"Almendra SC" => "Almendra SC"
				,"Amarante" => "Amarante"
				,"Amaranth" => "Amaranth"
				,"Amatic SC" => "Amatic SC"
				,"Amethysta" => "Amethysta"
				,"Anaheim" => "Anaheim"
				,"Andada" => "Andada"
				,"Andika" => "Andika"
				,"Angkor" => "Angkor"
				,"Annie Use Your Telescope" => "Annie Use Your Telescope"
				,"Anonymous Pro" => "Anonymous Pro"
				,"Antic" => "Antic"
				,"Antic Didone" => "Antic Didone"
				,"Antic Slab" => "Antic Slab"
				,"Anton" => "Anton"
				,"Arapey" => "Arapey"
				,"Arbutus" => "Arbutus"
				,"Arbutus Slab" => "Arbutus Slab"
				,"Architects Daughter" => "Architects Daughter"
				,"Archivo Black" => "Archivo Black"
				,"Archivo Narrow" => "Archivo Narrow"
				,"Arimo" => "Arimo"
				,"Arizonia" => "Arizonia"
				,"Armata" => "Armata"
				,"Artifika" => "Artifika"
				,"Arvo" => "Arvo"
				,"Asap" => "Asap"
				,"Asset" => "Asset"
				,"Astloch" => "Astloch"
				,"Asul" => "Asul"
				,"Atomic Age" => "Atomic Age"
				,"Aubrey" => "Aubrey"
				,"Audiowide" => "Audiowide"
				,"Autour One" => "Autour One"
				,"Average" => "Average"
				,"Average Sans" => "Average Sans"
				,"Averia Gruesa Libre" => "Averia Gruesa Libre"
				,"Averia Libre" => "Averia Libre"
				,"Averia Sans Libre" => "Averia Sans Libre"
				,"Averia Serif Libre" => "Averia Serif Libre"
				,"Bad Script" => "Bad Script"
				,"Balthazar" => "Balthazar"
				,"Bangers" => "Bangers"
				,"Basic" => "Basic"
				,"Battambang" => "Battambang"
				,"Baumans" => "Baumans"
				,"Bayon" => "Bayon"
				,"Belgrano" => "Belgrano"
				,"Belleza" => "Belleza"
				,"BenchNine" => "BenchNine"
				,"Bentham" => "Bentham"
				,"Berkshire Swash" => "Berkshire Swash"
				,"Bevan" => "Bevan"
				,"Bigelow Rules" => "Bigelow Rules"
				,"Bigshot One" => "Bigshot One"
				,"Bilbo" => "Bilbo"
				,"Bilbo Swash Caps" => "Bilbo Swash Caps"
				,"Bitter" => "Bitter"
				,"Black Ops One" => "Black Ops One"
				,"Bokor" => "Bokor"
				,"Bonbon" => "Bonbon"
				,"Boogaloo" => "Boogaloo"
				,"Bowlby One" => "Bowlby One"
				,"Bowlby One SC" => "Bowlby One SC"
				,"Brawler" => "Brawler"
				,"Bree Serif" => "Bree Serif"
				,"Bubblegum Sans" => "Bubblegum Sans"
				,"Bubbler One" => "Bubbler One"
				,"Buda" => "Buda"
				,"Buenard" => "Buenard"
				,"Butcherman" => "Butcherman"
				,"Butterfly Kids" => "Butterfly Kids"
				,"Cabin" => "Cabin"
				,"Cabin Condensed" => "Cabin Condensed"
				,"Cabin Sketch" => "Cabin Sketch"
				,"Caesar Dressing" => "Caesar Dressing"
				,"Cagliostro" => "Cagliostro"
				,"Calligraffitti" => "Calligraffitti"
				,"Cambo" => "Cambo"
				,"Candal" => "Candal"
				,"Cantarell" => "Cantarell"
				,"Cantata One" => "Cantata One"
				,"Cantora One" => "Cantora One"
				,"Capriola" => "Capriola"
				,"Cardo" => "Cardo"
				,"Carme" => "Carme"
				,"Carrois Gothic" => "Carrois Gothic"
				,"Carrois Gothic SC" => "Carrois Gothic SC"
				,"Carter One" => "Carter One"
				,"Caudex" => "Caudex"
				,"Cedarville Cursive" => "Cedarville Cursive"
				,"Ceviche One" => "Ceviche One"
				,"Changa One" => "Changa One"
				,"Chango" => "Chango"
				,"Chau Philomene One" => "Chau Philomene One"
				,"Chela One" => "Chela One"
				,"Chelsea Market" => "Chelsea Market"
				,"Chenla" => "Chenla"
				,"Cherry Cream Soda" => "Cherry Cream Soda"
				,"Cherry Swash" => "Cherry Swash"
				,"Chewy" => "Chewy"
				,"Chicle" => "Chicle"
				,"Chivo" => "Chivo"
				,"Cinzel" => "Cinzel"
				,"Cinzel Decorative" => "Cinzel Decorative"
				,"Clicker Script" => "Clicker Script"
				,"Coda" => "Coda"
				,"Coda Caption" => "Coda Caption"
				,"Codystar" => "Codystar"
				,"Combo" => "Combo"
				,"Comfortaa" => "Comfortaa"
				,"Coming Soon" => "Coming Soon"
				,"Concert One" => "Concert One"
				,"Condiment" => "Condiment"
				,"Content" => "Content"
				,"Contrail One" => "Contrail One"
				,"Convergence" => "Convergence"
				,"Cookie" => "Cookie"
				,"Copse" => "Copse"
				,"Corben" => "Corben"
				,"Courgette" => "Courgette"
				,"Cousine" => "Cousine"
				,"Coustard" => "Coustard"
				,"Covered By Your Grace" => "Covered By Your Grace"
				,"Crafty Girls" => "Crafty Girls"
				,"Creepster" => "Creepster"
				,"Crete Round" => "Crete Round"
				,"Crimson Text" => "Crimson Text"
				,"Croissant One" => "Croissant One"
				,"Crushed" => "Crushed"
				,"Cuprum" => "Cuprum"
				,"Cutive" => "Cutive"
				,"Cutive Mono" => "Cutive Mono"
				,"Damion" => "Damion"
				,"Dancing Script" => "Dancing Script"
				,"Dangrek" => "Dangrek"
				,"Dawning of a New Day" => "Dawning of a New Day"
				,"Days One" => "Days One"
				,"Delius" => "Delius"
				,"Delius Swash Caps" => "Delius Swash Caps"
				,"Delius Unicase" => "Delius Unicase"
				,"Della Respira" => "Della Respira"
				,"Denk One" => "Denk One"
				,"Devonshire" => "Devonshire"
				,"Didact Gothic" => "Didact Gothic"
				,"Diplomata" => "Diplomata"
				,"Diplomata SC" => "Diplomata SC"
				,"Domine" => "Domine"
				,"Donegal One" => "Donegal One"
				,"Doppio One" => "Doppio One"
				,"Dorsa" => "Dorsa"
				,"Dosis" => "Dosis"
				,"Dr Sugiyama" => "Dr Sugiyama"
				,"Droid Sans" => "Droid Sans"
				,"Droid Sans Mono" => "Droid Sans Mono"
				,"Droid Serif" => "Droid Serif"
				,"Duru Sans" => "Duru Sans"
				,"Dynalight" => "Dynalight"
				,"EB Garamond" => "EB Garamond"
				,"Eagle Lake" => "Eagle Lake"
				,"Eater" => "Eater"
				,"Economica" => "Economica"
				,"Electrolize" => "Electrolize"
				,"Elsie" => "Elsie"
				,"Elsie Swash Caps" => "Elsie Swash Caps"
				,"Emblema One" => "Emblema One"
				,"Emilys Candy" => "Emilys Candy"
				,"Engagement" => "Engagement"
				,"Englebert" => "Englebert"
				,"Enriqueta" => "Enriqueta"
				,"Erica One" => "Erica One"
				,"Esteban" => "Esteban"
				,"Euphoria Script" => "Euphoria Script"
				,"Ewert" => "Ewert"
				,"Exo" => "Exo"
				,"Expletus Sans" => "Expletus Sans"
				,"Fanwood Text" => "Fanwood Text"
				,"Fascinate" => "Fascinate"
				,"Fascinate Inline" => "Fascinate Inline"
				,"Faster One" => "Faster One"
				,"Fasthand" => "Fasthand"
				,"Fauna One" => "Fauna One"
				,"Federant" => "Federant"
				,"Federo" => "Federo"
				,"Felipa" => "Felipa"
				,"Fenix" => "Fenix"
				,"Finger Paint" => "Finger Paint"
				,"Fjalla One" => "Fjalla One"
				,"Fjord One" => "Fjord One"
				,"Flamenco" => "Flamenco"
				,"Flavors" => "Flavors"
				,"Fondamento" => "Fondamento"
				,"Fontdiner Swanky" => "Fontdiner Swanky"
				,"Forum" => "Forum"
				,"Francois One" => "Francois One"
				,"Freckle Face" => "Freckle Face"
				,"Fredericka the Great" => "Fredericka the Great"
				,"Fredoka One" => "Fredoka One"
				,"Freehand" => "Freehand"
				,"Fresca" => "Fresca"
				,"Frijole" => "Frijole"
				,"Fruktur" => "Fruktur"
				,"Fugaz One" => "Fugaz One"
				,"GFS Didot" => "GFS Didot"
				,"GFS Neohellenic" => "GFS Neohellenic"
				,"Gabriela" => "Gabriela"
				,"Gafata" => "Gafata"
				,"Galdeano" => "Galdeano"
				,"Galindo" => "Galindo"
				,"Gentium Basic" => "Gentium Basic"
				,"Gentium Book Basic" => "Gentium Book Basic"
				,"Geo" => "Geo"
				,"Geostar" => "Geostar"
				,"Geostar Fill" => "Geostar Fill"
				,"Germania One" => "Germania One"
				,"Gilda Display" => "Gilda Display"
				,"Give You Glory" => "Give You Glory"
				,"Glass Antiqua" => "Glass Antiqua"
				,"Glegoo" => "Glegoo"
				,"Gloria Hallelujah" => "Gloria Hallelujah"
				,"Goblin One" => "Goblin One"
				,"Gochi Hand" => "Gochi Hand"
				,"Gorditas" => "Gorditas"
				,"Goudy Bookletter 1911" => "Goudy Bookletter 1911"
				,"Graduate" => "Graduate"
				,"Grand Hotel" => "Grand Hotel"
				,"Gravitas One" => "Gravitas One"
				,"Great Vibes" => "Great Vibes"
				,"Griffy" => "Griffy"
				,"Gruppo" => "Gruppo"
				,"Gudea" => "Gudea"
				,"Habibi" => "Habibi"
				,"Hammersmith One" => "Hammersmith One"
				,"Hanalei" => "Hanalei"
				,"Hanalei Fill" => "Hanalei Fill"
				,"Handlee" => "Handlee"
				,"Hanuman" => "Hanuman"
				,"Happy Monkey" => "Happy Monkey"
				,"Headland One" => "Headland One"
				,"Henny Penny" => "Henny Penny"
				,"Herr Von Muellerhoff" => "Herr Von Muellerhoff"
				,"Holtwood One SC" => "Holtwood One SC"
				,"Homemade Apple" => "Homemade Apple"
				,"Homenaje" => "Homenaje"
				,"IM Fell DW Pica" => "IM Fell DW Pica"
				,"IM Fell DW Pica SC" => "IM Fell DW Pica SC"
				,"IM Fell Double Pica" => "IM Fell Double Pica"
				,"IM Fell Double Pica SC" => "IM Fell Double Pica SC"
				,"IM Fell English" => "IM Fell English"
				,"IM Fell English SC" => "IM Fell English SC"
				,"IM Fell French Canon" => "IM Fell French Canon"
				,"IM Fell French Canon SC" => "IM Fell French Canon SC"
				,"IM Fell Great Primer" => "IM Fell Great Primer"
				,"IM Fell Great Primer SC" => "IM Fell Great Primer SC"
				,"Iceberg" => "Iceberg"
				,"Iceland" => "Iceland"
				,"Imprima" => "Imprima"
				,"Inconsolata" => "Inconsolata"
				,"Inder" => "Inder"
				,"Indie Flower" => "Indie Flower"
				,"Inika" => "Inika"
				,"Irish Grover" => "Irish Grover"
				,"Istok Web" => "Istok Web"
				,"Italiana" => "Italiana"
				,"Italianno" => "Italianno"
				,"Jacques Francois" => "Jacques Francois"
				,"Jacques Francois Shadow" => "Jacques Francois Shadow"
				,"Jim Nightshade" => "Jim Nightshade"
				,"Jockey One" => "Jockey One"
				,"Jolly Lodger" => "Jolly Lodger"
				,"Josefin Sans" => "Josefin Sans"
				,"Josefin Slab" => "Josefin Slab"
				,"Joti One" => "Joti One"
				,"Judson" => "Judson"
				,"Julee" => "Julee"
				,"Julius Sans One" => "Julius Sans One"
				,"Junge" => "Junge"
				,"Jura" => "Jura"
				,"Just Another Hand" => "Just Another Hand"
				,"Just Me Again Down Here" => "Just Me Again Down Here"
				,"Kameron" => "Kameron"
				,"Karla" => "Karla"
				,"Kaushan Script" => "Kaushan Script"
				,"Kavoon" => "Kavoon"
				,"Keania One" => "Keania One"
				,"Kelly Slab" => "Kelly Slab"
				,"Kenia" => "Kenia"
				,"Khmer" => "Khmer"
				,"Kite One" => "Kite One"
				,"Knewave" => "Knewave"
				,"Kotta One" => "Kotta One"
				,"Koulen" => "Koulen"
				,"Kranky" => "Kranky"
				,"Kreon" => "Kreon"
				,"Kristi" => "Kristi"
				,"Krona One" => "Krona One"
				,"La Belle Aurore" => "La Belle Aurore"
				,"Lancelot" => "Lancelot"
				,"Lato" => "Lato"
				,"League Script" => "League Script"
				,"Leckerli One" => "Leckerli One"
				,"Ledger" => "Ledger"
				,"Lekton" => "Lekton"
				,"Lemon" => "Lemon"
				,"Libre Baskerville" => "Libre Baskerville"
				,"Life Savers" => "Life Savers"
				,"Lilita One" => "Lilita One"
				,"Lily Script One" => "Lily Script One"
				,"Limelight" => "Limelight"
				,"Linden Hill" => "Linden Hill"
				,"Lobster" => "Lobster"
				,"Lobster Two" => "Lobster Two"
				,"Londrina Outline" => "Londrina Outline"
				,"Londrina Shadow" => "Londrina Shadow"
				,"Londrina Sketch" => "Londrina Sketch"
				,"Londrina Solid" => "Londrina Solid"
				,"Lora" => "Lora"
				,"Love Ya Like A Sister" => "Love Ya Like A Sister"
				,"Loved by the King" => "Loved by the King"
				,"Lovers Quarrel" => "Lovers Quarrel"
				,"Luckiest Guy" => "Luckiest Guy"
				,"Lusitana" => "Lusitana"
				,"Lustria" => "Lustria"
				,"Macondo" => "Macondo"
				,"Macondo Swash Caps" => "Macondo Swash Caps"
				,"Magra" => "Magra"
				,"Maiden Orange" => "Maiden Orange"
				,"Mako" => "Mako"
				,"Marcellus" => "Marcellus"
				,"Marcellus SC" => "Marcellus SC"
				,"Marck Script" => "Marck Script"
				,"Margarine" => "Margarine"
				,"Marko One" => "Marko One"
				,"Marmelad" => "Marmelad"
				,"Marvel" => "Marvel"
				,"Mate" => "Mate"
				,"Mate SC" => "Mate SC"
				,"Maven Pro" => "Maven Pro"
				,"McLaren" => "McLaren"
				,"Meddon" => "Meddon"
				,"MedievalSharp" => "MedievalSharp"
				,"Medula One" => "Medula One"
				,"Megrim" => "Megrim"
				,"Meie Script" => "Meie Script"
				,"Merienda" => "Merienda"
				,"Merienda One" => "Merienda One"
				,"Merriweather" => "Merriweather"
				,"Merriweather Sans" => "Merriweather Sans"
				,"Metal" => "Metal"
				,"Metal Mania" => "Metal Mania"
				,"Metamorphous" => "Metamorphous"
				,"Metrophobic" => "Metrophobic"
				,"Michroma" => "Michroma"
				,"Milonga" => "Milonga"
				,"Miltonian" => "Miltonian"
				,"Miltonian Tattoo" => "Miltonian Tattoo"
				,"Miniver" => "Miniver"
				,"Miss Fajardose" => "Miss Fajardose"
				,"Modern Antiqua" => "Modern Antiqua"
				,"Molengo" => "Molengo"
				,"Molle" => "Molle"
				,"Monda" => "Monda"
				,"Monofett" => "Monofett"
				,"Monoton" => "Monoton"
				,"Monsieur La Doulaise" => "Monsieur La Doulaise"
				,"Montaga" => "Montaga"
				,"Montez" => "Montez"
				,"Montserrat" => "Montserrat"
				,"Montserrat Alternates" => "Montserrat Alternates"
				,"Montserrat Subrayada" => "Montserrat Subrayada"
				,"Moul" => "Moul"
				,"Moulpali" => "Moulpali"
				,"Mountains of Christmas" => "Mountains of Christmas"
				,"Mouse Memoirs" => "Mouse Memoirs"
				,"Mr Bedfort" => "Mr Bedfort"
				,"Mr Dafoe" => "Mr Dafoe"
				,"Mr De Haviland" => "Mr De Haviland"
				,"Mrs Saint Delafield" => "Mrs Saint Delafield"
				,"Mrs Sheppards" => "Mrs Sheppards"
				,"Muli" => "Muli"
				,"Mystery Quest" => "Mystery Quest"
				,"Neucha" => "Neucha"
				,"Neuton" => "Neuton"
				,"New Rocker" => "New Rocker"
				,"News Cycle" => "News Cycle"
				,"Niconne" => "Niconne"
				,"Nixie One" => "Nixie One"
				,"Nobile" => "Nobile"
				,"Nokora" => "Nokora"
				,"Norican" => "Norican"
				,"Nosifer" => "Nosifer"
				,"Nothing You Could Do" => "Nothing You Could Do"
				,"Noticia Text" => "Noticia Text"
				,"Noto Sans" => "Noto Sans"
				,"Noto Serif" => "Noto Serif"
				,"Nova Cut" => "Nova Cut"
				,"Nova Flat" => "Nova Flat"
				,"Nova Mono" => "Nova Mono"
				,"Nova Oval" => "Nova Oval"
				,"Nova Round" => "Nova Round"
				,"Nova Script" => "Nova Script"
				,"Nova Slim" => "Nova Slim"
				,"Nova Square" => "Nova Square"
				,"Numans" => "Numans"
				,"Nunito" => "Nunito"
				,"Odor Mean Chey" => "Odor Mean Chey"
				,"Offside" => "Offside"
				,"Old Standard TT" => "Old Standard TT"
				,"Oldenburg" => "Oldenburg"
				,"Oleo Script" => "Oleo Script"
				,"Oleo Script Swash Caps" => "Oleo Script Swash Caps"
				,"Open Sans" => "Open Sans"
				,"Open Sans Condensed" => "Open Sans Condensed"
				,"Oranienbaum" => "Oranienbaum"
				,"Orbitron" => "Orbitron"
				,"Oregano" => "Oregano"
				,"Orienta" => "Orienta"
				,"Original Surfer" => "Original Surfer"
				,"Oswald" => "Oswald"
				,"Over the Rainbow" => "Over the Rainbow"
				,"Overlock" => "Overlock"
				,"Overlock SC" => "Overlock SC"
				,"Ovo" => "Ovo"
				,"Oxygen" => "Oxygen"
				,"Oxygen Mono" => "Oxygen Mono"
				,"PT Mono" => "PT Mono"
				,"PT Sans" => "PT Sans"
				,"PT Sans Caption" => "PT Sans Caption"
				,"PT Sans Narrow" => "PT Sans Narrow"
				,"PT Serif" => "PT Serif"
				,"PT Serif Caption" => "PT Serif Caption"
				,"Pacifico" => "Pacifico"
				,"Paprika" => "Paprika"
				,"Parisienne" => "Parisienne"
				,"Passero One" => "Passero One"
				,"Passion One" => "Passion One"
				,"Pathway Gothic One" => "Pathway Gothic One"
				,"Patrick Hand" => "Patrick Hand"
				,"Patrick Hand SC" => "Patrick Hand SC"
				,"Patua One" => "Patua One"
				,"Paytone One" => "Paytone One"
				,"Peralta" => "Peralta"
				,"Permanent Marker" => "Permanent Marker"
				,"Petit Formal Script" => "Petit Formal Script"
				,"Petrona" => "Petrona"
				,"Philosopher" => "Philosopher"
				,"Piedra" => "Piedra"
				,"Pinyon Script" => "Pinyon Script"
				,"Pirata One" => "Pirata One"
				,"Plaster" => "Plaster"
				,"Play" => "Play"
				,"Playball" => "Playball"
				,"Playfair Display" => "Playfair Display"
				,"Playfair Display SC" => "Playfair Display SC"
				,"Podkova" => "Podkova"
				,"Poiret One" => "Poiret One"
				,"Poller One" => "Poller One"
				,"Poly" => "Poly"
				,"Pompiere" => "Pompiere"
				,"Pontano Sans" => "Pontano Sans"
				,"Port Lligat Sans" => "Port Lligat Sans"
				,"Port Lligat Slab" => "Port Lligat Slab"
				,"Prata" => "Prata"
				,"Preahvihear" => "Preahvihear"
				,"Press Start 2P" => "Press Start 2P"
				,"Princess Sofia" => "Princess Sofia"
				,"Prociono" => "Prociono"
				,"Prosto One" => "Prosto One"
				,"Puritan" => "Puritan"
				,"Purple Purse" => "Purple Purse"
				,"Quando" => "Quando"
				,"Quantico" => "Quantico"
				,"Quattrocento" => "Quattrocento"
				,"Quattrocento Sans" => "Quattrocento Sans"
				,"Questrial" => "Questrial"
				,"Quicksand" => "Quicksand"
				,"Quintessential" => "Quintessential"
				,"Qwigley" => "Qwigley"
				,"Racing Sans One" => "Racing Sans One"
				,"Radley" => "Radley"
				,"Raleway" => "Raleway"
				,"Raleway Dots" => "Raleway Dots"
				,"Rambla" => "Rambla"
				,"Rammetto One" => "Rammetto One"
				,"Ranchers" => "Ranchers"
				,"Rancho" => "Rancho"
				,"Rationale" => "Rationale"
				,"Redressed" => "Redressed"
				,"Reenie Beanie" => "Reenie Beanie"
				,"Revalia" => "Revalia"
				,"Ribeye" => "Ribeye"
				,"Ribeye Marrow" => "Ribeye Marrow"
				,"Righteous" => "Righteous"
				,"Risque" => "Risque"
				,"Roboto" => "Roboto"
				,"Roboto Condensed" => "Roboto Condensed"
				,"Roboto Slab" => "Roboto Slab"
				,"Rochester" => "Rochester"
				,"Rock Salt" => "Rock Salt"
				,"Rokkitt" => "Rokkitt"
				,"Romanesco" => "Romanesco"
				,"Ropa Sans" => "Ropa Sans"
				,"Rosario" => "Rosario"
				,"Rosarivo" => "Rosarivo"
				,"Rouge Script" => "Rouge Script"
				,"Ruda" => "Ruda"
				,"Rufina" => "Rufina"
				,"Ruge Boogie" => "Ruge Boogie"
				,"Ruluko" => "Ruluko"
				,"Rum Raisin" => "Rum Raisin"
				,"Ruslan Display" => "Ruslan Display"
				,"Russo One" => "Russo One"
				,"Ruthie" => "Ruthie"
				,"Rye" => "Rye"
				,"Sacramento" => "Sacramento"
				,"Sail" => "Sail"
				,"Salsa" => "Salsa"
				,"Sanchez" => "Sanchez"
				,"Sancreek" => "Sancreek"
				,"Sansita One" => "Sansita One"
				,"Sarina" => "Sarina"
				,"Satisfy" => "Satisfy"
				,"Scada" => "Scada"
				,"Schoolbell" => "Schoolbell"
				,"Seaweed Script" => "Seaweed Script"
				,"Sevillana" => "Sevillana"
				,"Seymour One" => "Seymour One"
				,"Shadows Into Light" => "Shadows Into Light"
				,"Shadows Into Light Two" => "Shadows Into Light Two"
				,"Shanti" => "Shanti"
				,"Share" => "Share"
				,"Share Tech" => "Share Tech"
				,"Share Tech Mono" => "Share Tech Mono"
				,"Shojumaru" => "Shojumaru"
				,"Short Stack" => "Short Stack"
				,"Siemreap" => "Siemreap"
				,"Sigmar One" => "Sigmar One"
				,"Signika" => "Signika"
				,"Signika Negative" => "Signika Negative"
				,"Simonetta" => "Simonetta"
				,"Sintony" => "Sintony"
				,"Sirin Stencil" => "Sirin Stencil"
				,"Six Caps" => "Six Caps"
				,"Skranji" => "Skranji"
				,"Slackey" => "Slackey"
				,"Smokum" => "Smokum"
				,"Smythe" => "Smythe"
				,"Sniglet" => "Sniglet"
				,"Snippet" => "Snippet"
				,"Snowburst One" => "Snowburst One"
				,"Sofadi One" => "Sofadi One"
				,"Sofia" => "Sofia"
				,"Sonsie One" => "Sonsie One"
				,"Sorts Mill Goudy" => "Sorts Mill Goudy"
				,"Source Code Pro" => "Source Code Pro"
				,"Source Sans Pro" => "Source Sans Pro"
				,"Special Elite" => "Special Elite"
				,"Spicy Rice" => "Spicy Rice"
				,"Spinnaker" => "Spinnaker"
				,"Spirax" => "Spirax"
				,"Squada One" => "Squada One"
				,"Stalemate" => "Stalemate"
				,"Stalinist One" => "Stalinist One"
				,"Stardos Stencil" => "Stardos Stencil"
				,"Stint Ultra Condensed" => "Stint Ultra Condensed"
				,"Stint Ultra Expanded" => "Stint Ultra Expanded"
				,"Stoke" => "Stoke"
				,"Strait" => "Strait"
				,"Sue Ellen Francisco" => "Sue Ellen Francisco"
				,"Sunshiney" => "Sunshiney"
				,"Supermercado One" => "Supermercado One"
				,"Suwannaphum" => "Suwannaphum"
				,"Swanky and Moo Moo" => "Swanky and Moo Moo"
				,"Syncopate" => "Syncopate"
				,"Tangerine" => "Tangerine"
				,"Taprom" => "Taprom"
				,"Tauri" => "Tauri"
				,"Telex" => "Telex"
				,"Tenor Sans" => "Tenor Sans"
				,"Text Me One" => "Text Me One"
				,"The Girl Next Door" => "The Girl Next Door"
				,"Tienne" => "Tienne"
				,"Tinos" => "Tinos"
				,"Titan One" => "Titan One"
				,"Titillium Web" => "Titillium Web"
				,"Trade Winds" => "Trade Winds"
				,"Trocchi" => "Trocchi"
				,"Trochut" => "Trochut"
				,"Trykker" => "Trykker"
				,"Tulpen One" => "Tulpen One"
				,"Ubuntu" => "Ubuntu"
				,"Ubuntu Condensed" => "Ubuntu Condensed"
				,"Ubuntu Mono" => "Ubuntu Mono"
				,"Ultra" => "Ultra"
				,"Uncial Antiqua" => "Uncial Antiqua"
				,"Underdog" => "Underdog"
				,"Unica One" => "Unica One"
				,"UnifrakturCook" => "UnifrakturCook"
				,"UnifrakturMaguntia" => "UnifrakturMaguntia"
				,"Unkempt" => "Unkempt"
				,"Unlock" => "Unlock"
				,"Unna" => "Unna"
				,"VT323" => "VT323"
				,"Vampiro One" => "Vampiro One"
				,"Varela" => "Varela"
				,"Varela Round" => "Varela Round"
				,"Vast Shadow" => "Vast Shadow"
				,"Vibur" => "Vibur"
				,"Vidaloka" => "Vidaloka"
				,"Viga" => "Viga"
				,"Voces" => "Voces"
				,"Volkhov" => "Volkhov"
				,"Vollkorn" => "Vollkorn"
				,"Voltaire" => "Voltaire"
				,"Waiting for the Sunrise" => "Waiting for the Sunrise"
				,"Wallpoet" => "Wallpoet"
				,"Walter Turncoat" => "Walter Turncoat"
				,"Warnes" => "Warnes"
				,"Wellfleet" => "Wellfleet"
				,"Wendy One" => "Wendy One"
				,"Wire One" => "Wire One"
				,"Yanone Kaffeesatz" => "Yanone Kaffeesatz"
				,"Yellowtail" => "Yellowtail"
				,"Yeseva One" => "Yeseva One"
				,"Yesteryear" => "Yesteryear"
				,"Zeyada" => "Zeyada"
			);
	}
	function TVLGiao_Wpdance_loadImageSize(){
		if ( function_exists( 'add_image_size' ) ) {
		   // Add image size for main slideshow
			global $tvlgiao_wpdance_wd_data;
			$wd_blog_single_thumbnail_width = ( isset($tvlgiao_wpdance_wd_data['wd_blog_single_thumbnail_width']) && absint($tvlgiao_wpdance_wd_data['wd_blog_single_thumbnail_width']) > 0 )? absint($tvlgiao_wpdance_wd_data['wd_blog_single_thumbnail_width']) : 1170;
			
			$wd_blog_thumbnail_width = ( isset($tvlgiao_wpdance_wd_data['wd_blog_thumbnail_width']) && absint($tvlgiao_wpdance_wd_data['wd_blog_thumbnail_width']) > 0 )? absint($tvlgiao_wpdance_wd_data['wd_blog_thumbnail_width']) : 420;
			$wd_blog_thumbnail_height = ( isset($tvlgiao_wpdance_wd_data['wd_blog_thumbnail_height']) && absint($tvlgiao_wpdance_wd_data['wd_blog_thumbnail_height']) > 0 )? absint($tvlgiao_wpdance_wd_data['wd_blog_thumbnail_height']) : 300;
			
			$wd_blog_shortcode_thumbnail_width = ( isset($tvlgiao_wpdance_wd_data['wd_blog_shortcode_thumbnail_width']) && absint($tvlgiao_wpdance_wd_data['wd_blog_shortcode_thumbnail_width']) > 0 )? absint($tvlgiao_wpdance_wd_data['wd_blog_shortcode_thumbnail_width']) : 345;
			$wd_blog_shortcode_thumbnail_height = ( isset($tvlgiao_wpdance_wd_data['wd_blog_shortcode_thumbnail_height']) && absint($tvlgiao_wpdance_wd_data['wd_blog_shortcode_thumbnail_height']) > 0 )? absint($tvlgiao_wpdance_wd_data['wd_blog_shortcode_thumbnail_height']) : 223;
			
			$wd_blog_shortcode_auto_thumbnail_width = ( isset($tvlgiao_wpdance_wd_data['wd_blog_shortcode_auto_thumbnail_width']) && absint($tvlgiao_wpdance_wd_data['wd_blog_shortcode_auto_thumbnail_width']) > 0 )? absint($tvlgiao_wpdance_wd_data['wd_blog_shortcode_auto_thumbnail_width']) : 570;
			
			$wd_blog_shortcode_widget_thumbnail_width = ( isset($tvlgiao_wpdance_wd_data['wd_blog_shortcode_widget_thumbnail_width']) && absint($tvlgiao_wpdance_wd_data['wd_blog_shortcode_widget_thumbnail_width']) > 0 )? absint($tvlgiao_wpdance_wd_data['wd_blog_shortcode_widget_thumbnail_width']) : 100;
			$wd_blog_shortcode_widget_thumbnail_height = ( isset($tvlgiao_wpdance_wd_data['wd_blog_shortcode_widget_thumbnail_height']) && absint($tvlgiao_wpdance_wd_data['wd_blog_shortcode_widget_thumbnail_height']) > 0 )? absint($tvlgiao_wpdance_wd_data['wd_blog_shortcode_widget_thumbnail_height']) : 70;
			
			$wd_tini_shopping_cart_thumbnail_width = ( isset($tvlgiao_wpdance_wd_data['wd_tini_shopping_cart_thumbnail_width']) && absint($tvlgiao_wpdance_wd_data['wd_tini_shopping_cart_thumbnail_width']) > 0 )? absint($tvlgiao_wpdance_wd_data['wd_tini_shopping_cart_thumbnail_width']) : 100;
			$wd_tini_shopping_cart_thumbnail_height = ( isset($tvlgiao_wpdance_wd_data['wd_tini_shopping_cart_thumbnail_height']) && absint($tvlgiao_wpdance_wd_data['wd_tini_shopping_cart_thumbnail_height']) > 0 )? absint($tvlgiao_wpdance_wd_data['wd_tini_shopping_cart_thumbnail_height']) : 120;
			
			$wd_single_products_thumbnail_width = ( isset($tvlgiao_wpdance_wd_data['wd_single_products_thumbnail_width']) && absint($tvlgiao_wpdance_wd_data['wd_single_products_thumbnail_width']) > 0 )? absint($tvlgiao_wpdance_wd_data['wd_single_products_thumbnail_width']) : 135;
			$wd_single_products_thumbnail_height = ( isset($tvlgiao_wpdance_wd_data['wd_single_products_thumbnail_height']) && absint($tvlgiao_wpdance_wd_data['wd_single_products_thumbnail_height']) > 0 )? absint($tvlgiao_wpdance_wd_data['wd_single_products_thumbnail_height']) : 171;
			
			$wd_product_subcategories_thumbnail_width = ( isset($tvlgiao_wpdance_wd_data['wd_product_subcategories_thumbnail_width']) && absint($tvlgiao_wpdance_wd_data['wd_product_subcategories_thumbnail_width']) > 0 )? absint($tvlgiao_wpdance_wd_data['wd_product_subcategories_thumbnail_width']) : 270;
			$wd_product_subcategories_thumbnail_height = ( isset($tvlgiao_wpdance_wd_data['wd_product_subcategories_thumbnail_height']) && absint($tvlgiao_wpdance_wd_data['wd_product_subcategories_thumbnail_height']) > 0 )? absint($tvlgiao_wpdance_wd_data['wd_product_subcategories_thumbnail_height']) : 200;
			
			$wd_product_categories_shortcode_thumbnail_width = ( isset($tvlgiao_wpdance_wd_data['wd_product_categories_shortcode_thumbnail_width']) && absint($tvlgiao_wpdance_wd_data['wd_product_categories_shortcode_thumbnail_width']) > 0 )? absint($tvlgiao_wpdance_wd_data['wd_product_categories_shortcode_thumbnail_width']) : 370;
			$wd_product_categories_shortcode_thumbnail_height = ( isset($tvlgiao_wpdance_wd_data['wd_product_categories_shortcode_thumbnail_height']) && absint($tvlgiao_wpdance_wd_data['wd_product_categories_shortcode_thumbnail_height']) > 0 )? absint($tvlgiao_wpdance_wd_data['wd_product_categories_shortcode_thumbnail_height']) : 540;
			
			add_image_size('tvlgiao_wpdance_blog_single',$wd_blog_single_thumbnail_width); /* image for blog thumbnail */
								
			add_image_size('tvlgiao_wpdance_related_thumb',400,255,true); /* image for slideshow */
			add_image_size('tvlgiao_wpdance_blog_shortcode_auto',$wd_blog_shortcode_auto_thumbnail_width); /* blog shortcode */
			add_image_size('tvlgiao_wpdance_blog_shortcode',$wd_blog_shortcode_thumbnail_width,$wd_blog_shortcode_thumbnail_height, true);
			add_image_size('tvlgiao_wpdance_blog_recent',$wd_blog_shortcode_widget_thumbnail_width,$wd_blog_shortcode_widget_thumbnail_height,true);
			add_image_size('tvlgiao_wpdance_blog_thumb',$wd_blog_thumbnail_width,$wd_blog_thumbnail_height,true);
			
			add_image_size('tvlgiao_wpdance_cart_dropdown',$wd_tini_shopping_cart_thumbnail_width,$wd_tini_shopping_cart_thumbnail_height,true);			
			add_image_size('tvlgiao_wpdance_wd_sub_categories_thumbnail',$wd_product_subcategories_thumbnail_width,$wd_product_subcategories_thumbnail_height,true); /* image for single product detail */
			add_image_size('tvlgiao_wpdance_wd_categories_thumbnail',$wd_product_categories_shortcode_thumbnail_width,$wd_product_categories_shortcode_thumbnail_height,true); /* image for single product detail */
			
		}
	}
}
class TvlgiaoWpdanceClassNameVar
{
    private $tvlg_data,$tvlg_data_pages,$tvlg_post,$tvlg_product,$tvlg_yith_woocompare,$tvlg_woocommerce,$tvlg_woocommerce_loop,$tvlg_wp_query,$tvlg_author,$tvlg_projects_loop;
     public function __construct(){
		 $this->TVLGiao_wpdance_SetVar();
	 }
    public  function TVLGiao_wpdance_GetVarBlobal($name)
	{
		if($name =="wd_data")
		 return $this->tvlg_data;
		elseif($name =="page_datas")
		 return $this->tvlg_data_pages;
	    elseif($name =="post")
		 return $this->tvlg_post;
		elseif($name =="product")
		 return $this->tvlg_product;
		elseif($name =="projects_loop")
		 return $this->tvlg_projects_loop;
	}
	
	public static function TVLGiao_wpdance_GetVar($name)
	{
		 $a = new TvlgiaoWpdanceClassNameVar();
        return $a->TVLGiao_wpdance_GetVarBlobal($name);
	}
	public static function TVLGiao_wpdance_SetVarSlidebar($name)
	{
        global $tvlgiao_wpdance_default_sidebars;
		$tvlgiao_wpdance_default_sidebars = $name;
	}
	public function TVLGiao_wpdance_SetVar()
	{
		global $tvlgiao_wpdance_wd_data,$tvlgiao_wpdance_page_datas,$post,$product,$yith_woocompare,$woocommerce,$woocommerce_loop,$wp_query,$author,$projects_loop;
		$this->tvlg_data= $tvlgiao_wpdance_wd_data;
		$this->tvlg_data_pages = $tvlgiao_wpdance_page_datas;
		$this->tvlg_post = $post;
		$this->tvlg_product = $product;
		$this->tvlg_projects_loop  = $projects_loop;
	}
}
?>