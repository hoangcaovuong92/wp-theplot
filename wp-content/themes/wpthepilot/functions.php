<?php
/**
 * @package WordPress
 * @subpackage WP Woo Glory
 * @since wd_glory
 **/

$_template_path = get_template_directory();
require_once get_template_directory()."/framework/abstract.php";
$tvlgiao_wpdance_theme = new TvlgiaoWpdanceNoOneTheme(array(
	'tvlgiao_wpdance_theme_slug'	=>	'wd_noone'
));
$tvlgiao_wpdance_theme->init();
require_once ('admin/index.php');
add_action( 'init', 'tvlgiao_wpdance_woocommerce_clear_cart_url' );
function tvlgiao_wpdance_woocommerce_clear_cart_url() {
  global $woocommerce;

    if (isset( $_REQUEST['empty-cart'] ) ) { 
        $woocommerce->cart->empty_cart(); 
    }
}
?>