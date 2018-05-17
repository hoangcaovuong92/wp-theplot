<?php 
/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * To override this in a child theme, remove the filter and optionally add
 * your own function tied to the wp_page_menu_args filter hook.
 *
 * @since WP0001
 */
function tvlgiao_wpdance_theme_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'tvlgiao_wpdance_theme_page_menu_args' );

/**
 * Sets the post excerpt length to 40 characters.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 *
 * @since WP0001
 * @return int
 */
function tvlgiao_wpdance_theme_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'tvlgiao_wpdance_theme_excerpt_length' );

/**
 * Returns a "Continue Reading" link for excerpts
 *
 * @since WP0001
 * @return string "Continue Reading" link
 */
function tvlgiao_wpdance_theme_continue_reading_link() {
	return ' <a href="'. esc_url( get_permalink()) . '">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'wpnoone' ) . '</a>';
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and theme_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 *
 * @since WP0001
 * @return string An ellipsis
 */
function tvlgiao_wpdance_theme_auto_excerpt_more( $more ) {
	return ' &hellip;' . tvlgiao_wpdance_theme_continue_reading_link();
}
add_filter( 'excerpt_more', 'tvlgiao_wpdance_theme_auto_excerpt_more' );

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 *
 * @since WP0001
 * @return string Excerpt with a pretty "Continue Reading" link
 */
function tvlgiao_wpdance_theme_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= tvlgiao_wpdance_theme_continue_reading_link();
	}
	return $output;
}
//add_filter( 'get_the_excerpt', 'theme_custom_excerpt_more' );

/**
 * Remove inline styles printed when the gallery shortcode is used.
 *
 * Galleries are styled by the theme in style.css. This is just
 * a simple filter call that tells WordPress to not use the default styles.
 *
 * @since WP0001
 */
add_filter( 'use_default_gallery_style', '__return_false' );

function tvlgiao_wpdance_theme_remove_gallery_css( $css ) {
	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}
// Backwards compatibility with WordPress 3.0.
if ( version_compare( $GLOBALS['wp_version'], '3.1', '<' ) )
	add_filter( 'gallery_style', 'tvlgiao_wpdance_theme_remove_gallery_css' );
	
if ( ! function_exists( 'tvlgiao_wpdance_theme_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own wpdance_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since WP0001
 */
function tvlgiao_wpdance_theme_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>" class="comment-body">
			<div class="comment-author vcard">
				<?php echo get_avatar( $comment, 70 ); ?>
				<?php //printf( __( '%s <span class="says">says:</span>', 'wpnoone' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
			</div><!-- .comment-author .vcard -->
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'wpnoone' ); ?></em>
			<br />
		<?php endif; ?>

			<div class="comment-meta commentmetadata">
				<h3 class="comment-author"><?php echo get_comment_author_link();?></h3>
				<a class="blog-datetime" href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
				<?php
					/* translators: 1: date, 2: time */
					printf( __( '%1$s', 'wpnoone' ), get_comment_date('M d, Y \a\t g:i a')); ?>
				</a>
				<?php edit_comment_link( __( ' - <i class="fa fa-pencil-square-o"></i>', 'wpnoone' ), ' ' );
				?>
			</div><!-- .comment-meta .commentmetadata -->

		<div class="detail_comment">	<?php comment_text(); ?> </div>
			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</div><!-- #comment-##  -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php esc_html_e( 'Pingback:', 'wpnoone' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( esc_html__( '(Edit)', 'wpnoone' ), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
endif;

function tvlgiao_wpdance_theme_remove_recent_comments_style() {
	add_filter( 'show_recent_comments_widget_style', '__return_false' );
}
add_action( 'widgets_init', 'tvlgiao_wpdance_theme_remove_recent_comments_style' );	

/******************** Start Custom Stylesheet for less-css loading ********************/
	
function tvlgiao_wpdance_enqueue_less_styles($tag, $handle) {
	global $wp_styles;		
	$match_pattern = '/\.less$/U';
	if ( preg_match( $match_pattern, $wp_styles->registered[$handle]->src ) ) {
		$handle = $wp_styles->registered[$handle]->handle;
		$media = $wp_styles->registered[$handle]->args;
		$_version = ( strlen($wp_styles->registered[$handle]->ver) > 0 )? $wp_styles->registered[$handle]->ver : $wp_styles->default_version;
		$href = $wp_styles->registered[$handle]->src . '?ver=' . $_version ;
		$rel = isset($wp_styles->registered[$handle]->extra['alt']) && $wp_styles->registered[$handle]->extra['alt'] ? 'alternate stylesheet' : 'stylesheet';
		$title = isset($wp_styles->registered[$handle]->extra['title']) ? "title='" . esc_attr( $wp_styles->registered[$handle]->extra['title'] ) . "'" : '';

		$tag = "<link rel='stylesheet/less' id='{$handle}' {$title} href='{$href}' type='text/less' media='{$media}' />\n";
	}
	return $tag;
}
add_filter( 'style_loader_tag', 'tvlgiao_wpdance_enqueue_less_styles', 5, 2);



add_action( 'tgmpa_register', 'tvlgiao_wpdance_my_theme_register_required_plugins' );
function tvlgiao_wpdance_my_theme_register_required_plugins() {

	/**
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		// This is an example of how to include a plugin pre-packaged with a theme			
		array(
			'name'     				=> 'Contact Form 7', // The plugin name
			'slug'     				=> 'contact-form-7', // The plugin slug (typically the folder name)
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			
		),
								
		array(
			'name'     				=> 'Projects', // The plugin name
			'slug'     				=> 'projects-by-woothemes', // The plugin slug (typically the folder name)
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
		),
		
		array(
			'name'     				=> 'Regenerate Thumbnails', // The plugin name
			'slug'     				=> 'regenerate-thumbnails', // The plugin slug (typically the folder name)
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of require
		),
		
		array(
			'name'     				=> 'Revolution Slider', // The plugin name
			'slug'     				=> 'revslider', // The plugin slug (typically the folder name)
			'source'   				=> get_template_directory() . '/framework/includes/plugins/revslider.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '5.3.1.5', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
				
		array(
			'name'     				=> 'WD Grid / List toggle', // The plugin name
			'slug'     				=> 'wd_grid-list-toggle', // The plugin slug (typically the folder name)
			'source'   				=> get_template_directory() . '/framework/includes/plugins/wd_grid-list-toggle.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '1.0.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		
		array(
			'name'     				=> 'WD Portfolio', // The plugin name
			'slug'     				=> 'wd_portfolio', // The plugin slug (typically the folder name)
			'source'   				=> get_template_directory() . '/framework/includes/plugins/wd_portfolio.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '1.0.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		array(
			'name'     				=> 'Testimonials', // The plugin name
			'slug'     				=> 'testimonials-by-woothemes', // The plugin slug (typically the folder name)
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
		),
		array(
			'name'     				=> 'WD QuickShop', // The plugin name
			'slug'     				=> 'wd_quickshop', // The plugin slug (typically the folder name)
			'source'   				=> get_template_directory() . '/framework/includes/plugins/wd_quickshop.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '2.0.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		
		array(
			'name'     				=> 'WD Shop By Color', // The plugin name
			'slug'     				=> 'wd_product-color', // The plugin slug (typically the folder name)
			'source'   				=> get_template_directory() . '/framework/includes/plugins/wd_product-color.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '1.1', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		
		array(
			'name'     				=> 'WD ShortCode', // The plugin name
			'slug'     				=> 'wd_shortcode', // The plugin slug (typically the folder name)
			'source'   				=> get_template_directory() . '/framework/includes/plugins/wd_shortcode.zip', // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '2.0.1', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),				
		array(
			'name'     				=> 'WD Team', // The plugin name
			'slug'     				=> 'wd_team', // The plugin slug (typically the folder name)
			'source'   				=> get_template_directory() . '/framework/includes/plugins/wd_team.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '1.0.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		
		array(
			'name'     				=> 'WooCommerce', // The plugin name
			'slug'     				=> 'woocommerce', // The plugin slug (typically the folder name)
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required			
		),
		
		array(
			'name'     				=> 'WooSidebars', // The plugin name
			'slug'     				=> 'woosidebars', // The plugin slug (typically the folder name)
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
		),
		
		array(
			'name'     				=> 'WP-PageNavi', // The plugin name
			'slug'     				=> 'wp-pagenavi', // The plugin slug (typically the folder name)
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
		),
		
		array(
			'name'     				=> 'WPBakery Visual Composer', // The plugin name
			'slug'     				=> 'js_composer', // The plugin slug (typically the folder name)
			'source'   				=> get_template_directory() . '/framework/includes/plugins/js_composer.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '5.0.1', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		array(
			'name'     				=> 'YITH Woocommerce Compare', // The plugin name
			'slug'     				=> 'yith-woocommerce-compare', // The plugin slug (typically the folder name)
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
		),
		array(
			'name'     				=> 'UberMenu The Ultimate WordPress Mega Menu', // The plugin name
			'slug'     				=> 'ubermenu', // The plugin slug (typically the folder name)
			'source'   				=> get_template_directory() . '/framework/includes/plugins/ubermenu.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '3.2.5', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		array(
			'name'     				=> 'Visual Composer Extensions', // The plugin name
			'slug'     				=> 'ts-visual-composer-extend', // The plugin slug (typically the folder name)
			'source'   				=> get_template_directory() . '/framework/includes/plugins/ts-visual-composer-extend.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '5.0.8', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		array(
			'name'     				=> 'WP Instagram Widget', // The plugin name
			'slug'     				=> 'wp-instagram-widget', // The plugin slug (typically the folder name)
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
		),
		array(
			'name'     				=> 'Widgets In Tabs', // The plugin name
			'slug'     				=> 'widgets-in-tabs', // The plugin slug (typically the folder name)			
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
		),
		array(
				'name'     				=> 'Product Color By Wpdance', // The plugin name
				'slug'     				=> 'wd_product-color', // The plugin slug (typically the folder name)
				'source'   				=> get_template_directory() . '/framework/plugins/wd_product-color.zip', // The plugin source
				'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
				'version' 				=> '1.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
			),
		array(
			'name'     				=> 'YITH WooCommerce Wishlist', // The plugin name
			'slug'     				=> 'yith-woocommerce-wishlist', // The plugin slug (typically the folder name
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
		),		
	);

	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
		'domain'       		=> 'wpnoone',         	// Text domain - likely want to be the same as your theme.
		'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
		'parent_slug' 	=> 'themes.php', 				// Default parent URL slug
		'menu'         		=> 'install-required-plugins', 	// Menu slug
		'has_notices'      	=> true,                       	// Show admin notices or not
		'is_automatic'    	=> false,					   	// Automatically activate plugins after installation or not
		'message' 			=> '',							// Message to output right before the plugins table
		'strings'      		=> array(
			'page_title'                       			=> esc_html__( 'Install Required Plugins', 'wpnoone' ),
			'menu_title'                       			=> esc_html__( 'Install Plugins', 'wpnoone' ),
			'installing'                       			=> esc_html__( 'Installing Plugin: %s', 'wpnoone' ), // %1$s = plugin name
			'oops'                             			=> esc_html__( 'Something went wrong with the plugin API.', 'wpnoone' ),
			'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ,'wpnoone'), // %1$s = plugin name(s)
			'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ,'wpnoone'), // %1$s = plugin name(s)
			'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.','wpnoone' ), // %1$s = plugin name(s)
			'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ,'wpnoone'), // %1$s = plugin name(s)
			'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.','wpnoone' ), // %1$s = plugin name(s)
			'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ,'wpnoone'), // %1$s = plugin name(s)
			'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ,'wpnoone'), // %1$s = plugin name(s)
			'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.','wpnoone' ), // %1$s = plugin name(s)
			'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins','wpnoone' ),
			'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins','wpnoone' ),
			'return'                           			=> esc_html__( 'Return to Required Plugins Installer', 'wpnoone' ),
			'plugin_activated'                 			=> esc_html__( 'Plugin activated successfully.', 'wpnoone' ),
			'complete' 									=> esc_html__( 'All plugins installed and activated successfully. %s', 'wpnoone' ), // %1$s = dashboard link
			'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
		)
	);

	tgmpa( $plugins, $config );

}

?>