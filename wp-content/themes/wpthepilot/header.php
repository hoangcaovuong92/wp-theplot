<?php
/**
 * The Header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage wp_glory
 * @since Wpdance Glory
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8) ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	 <?php if ( ! ( function_exists( 'has_site_icon' ) && has_site_icon() ) ) {
			tvlgiao_wpdance_theme_icon();
     }
		if ( is_singular() && get_option( 'thread_comments' ) ){
			wp_enqueue_script( 'comment-reply' );
		}
		wp_head(); 
	?>
</head>

<?php
	$tvlgiao_wpdance_page_datas = TvlgiaoWpdanceClassNameVar::TVLGiao_wpdance_GetVar("page_datas");
	$tvlgiao_wpdance_wd_data = TvlgiaoWpdanceClassNameVar::TVLGiao_wpdance_GetVar("wd_data");
?>
<body <?php body_class(); ?>>
	<div class="body-wrapper">
	<div class="page-gray-box"></div>
	<?php 
	if(isset($tvlgiao_wpdance_wd_data['wd_loading_page']) && absint($tvlgiao_wpdance_wd_data['wd_loading_page']) == 1 && !wp_is_mobile()){ 
		do_action( 'wd_loading_page' );
	}?>

	<?php do_action( 'wd_before_header' ); ?>

	
<?php
//print_r($tvlgiao_wpdance_wd_data);
	$wd_layout_style = '';
	if($tvlgiao_wpdance_wd_data['wd_layout_style'] != '' && $tvlgiao_wpdance_wd_data['wd_layout_style'] == 'boxed'){
		$wd_layout_style = ' wd-'.$tvlgiao_wpdance_wd_data['wd_layout_style'];
	}
	$wd_layout_custom_width = '';
	if(strlen(trim($tvlgiao_wpdance_wd_data['wd_boxed_width'])) > 0 && $tvlgiao_wpdance_wd_data['wd_layout_style'] == 'boxed'){
		$wd_layout_custom_width = 'max-width:'.absint($tvlgiao_wpdance_wd_data['wd_boxed_width']).'px';
	}
	$header_layout = '';
	
	if($tvlgiao_wpdance_wd_data['wd_layout_header'] != '' && $tvlgiao_wpdance_wd_data['wd_layout_header'] == 'boxed'){
		$header_layout .= ' wd-'.$tvlgiao_wpdance_wd_data['wd_layout_header'];
	}
	
	if(isset($tvlgiao_wpdance_wd_data['wd_header_style']) && $tvlgiao_wpdance_wd_data['wd_header_style'] !== ''){
		$header_layout .= " header_".$tvlgiao_wpdance_wd_data['wd_header_style'];
	}
?>
<div id="template-wrapper" class="hfeed site<?php echo esc_attr($wd_layout_style);?>" style="<?php echo esc_attr($wd_layout_custom_width);?>">
	<div class="wd-control-panel-gray"></div>
	<?php if ( !is_page_template('page-templates/comming-soon.php') && !is_page_template('page-templates/comming-soon_2.php') ) :?>
	
	<?php 
		
		if(isset($tvlgiao_wpdance_page_datas['page_slider_pos']) && $tvlgiao_wpdance_page_datas['page_slider_pos'] == 'before_header' && trim($header_layout) !=='header_v2'){
			$header_layout = 'header_v2';
			tvlgiao_wpdance_wd_print_header($header_layout);
			if(isset($tvlgiao_wpdance_page_datas['page_slider']) && $tvlgiao_wpdance_page_datas['page_slider'] != 'none'){
				tvlgiao_wpdance_wd_print_header_slider();
			}			
		} else {
			tvlgiao_wpdance_wd_print_header($header_layout);
			if(isset($tvlgiao_wpdance_page_datas['page_slider']) && $tvlgiao_wpdance_page_datas['page_slider'] != 'none'){
				tvlgiao_wpdance_wd_print_header_slider();
			}
		}
		
	endif;
	?>

	<?php 
	function tvlgiao_wpdance_wd_print_header($header_layout){
		?>
		<div id="sticket-scroll-header-point"></div>
		<div class="header-box <?php echo esc_attr($header_layout);?>">
		<header id="header" class="<?php echo esc_attr( $header_layout );?> animated">
			<div class="header-main">
				<?php do_action( 'tvlgiao_wpdance_wd_header_init' ); ?>
			</div>
		</header><!-- #masthead -->
		</div>
		<?php do_action( 'wd_before_main_container' ); ?>
		<?php 
	}
	
	function tvlgiao_wpdance_wd_print_header_slider(){
		global $tvlgiao_wpdance_page_datas;
	?>
		<div class="slideshow-wrapper main-slideshow wd_wide">
				<div class="slideshow-sub-wrapper wide-wrapper">
					<?php tvlgiao_wpdance_show_page_slider();?>
				</div>
			</div>
	<?php 
	}
	
	?>		
	<div id="main-module-container" class="site-main">
