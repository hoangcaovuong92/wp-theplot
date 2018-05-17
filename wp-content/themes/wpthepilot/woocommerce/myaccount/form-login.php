<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.3.5
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<div class="">

<?php wc_print_notices(); do_action('woocommerce_before_customer_login_form'); ?>
<?php 
if (get_option('woocommerce_enable_myaccount_registration')=== 'yes')
	$action = isset($_REQUEST['action'])? $_REQUEST['action']: 'false';
else $action = 'false';

$register_show = 'col-2';
$login_show = 'col-1';
switch($action) {
	case 'login':
			$login_show = '';
			$register_show = "hide";
			break;
	case 'register':
			$login_show = "hide";
			$register_show = "";
			break;
}
?>
<?php if (get_option('woocommerce_enable_myaccount_registration')=== 'yes') : ?>
<h2 class="my-account-title"><?php the_title() ?></h2>
<div class="col2-set" id="customer_login">

	<div class="<?php echo esc_attr($login_show);?>">

<?php endif; ?>

		<h3><?php esc_html_e( 'Login', 'wpnoone' ); ?></h3>
		
		<form method="post" class="login">
			
			<?php do_action( 'woocommerce_login_form_start' ); ?>
			
			<p class="form-row">
				<label for="username"><?php esc_html_e( 'User or Email', 'wpnoone' ); ?> <span class="required">*</span></label>
				<input type="text" class="input-text" name="username" id="username" />
			</p>
			<p class="form-row">
				<label for="password"><?php esc_html_e( 'Password', 'wpnoone' ); ?> <span class="required">*</span></label>
				<input class="input-text" type="password" name="password" id="password" />
			</p>
			<div class="clear"></div>
			
			<?php do_action( 'woocommerce_login_form' ); ?>
			
			<p class="form-row">
				<?php wp_nonce_field( 'woocommerce-login' ); ?>
				<input type="submit" class="button" name="login" value="<?php esc_html_e( 'Login', 'wpnoone' ); ?>" />
				<a class="lost_password" href="<?php echo esc_url( wc_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'wpnoone' ); ?></a>
				<label for="rememberme" class="inline rememberme">
					<input name="rememberme" type="checkbox" id="rememberme" value="forever" /> <?php esc_html_e( 'Remember me', 'wpnoone' ); ?>
				</label>
			</p>
			
			<?php do_action( 'woocommerce_login_form_end' ); ?>
			
		</form>

<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>

	</div>

	<div class="<?php echo esc_attr($register_show);?>">

		<h3><?php esc_html_e( 'register', 'wpnoone' ); ?></h3>
		
		<form method="post" class="register">
			
			<?php do_action( 'woocommerce_register_form_start' ); ?>
			
			<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>

				<p class="form-row form-row-first">
					<label for="reg_username"><?php esc_html_e( 'username', 'wpnoone' ); ?> <span class="required">*</span></label>
					<input type="text" class="input-text" name="username" id="reg_username" value="<?php if ( ! empty( $_POST['username'] ) ) echo esc_attr( $_POST['username'] ); ?>" />
				</p>

				<p class="form-row form-row-last">

			<?php else : ?>

				<p class="form-row form-row-wide">

			<?php endif; ?>

				<label for="reg_email"><?php esc_html_e( 'email', 'wpnoone' ); ?> <span class="required">*</span></label>
				<input type="email" class="input-text" name="email" id="reg_email" value="<?php if ( ! empty( $_POST['email'] ) ) echo esc_attr( $_POST['email'] ); ?>" />
			</p>		

			<p class="form-row form-row-wide">
				<label for="reg_password"><?php esc_html_e( 'password', 'wpnoone' ); ?> <span class="required">*</span></label>
				<input type="password" class="input-text" name="password" id="reg_password" value="<?php if ( ! empty( $_POST['password'] ) ) esc_attr( $_POST['password'] ); ?>" />
			</p>

			<div class="clear"></div>

			<!-- Spam Trap -->
			<div style="left:-999em; position:absolute;"><label for="trap"><?php esc_html_e( 'Anti-spam', 'wpnoone' ); ?></label><input type="text" name="email_2" id="trap" tabindex="-1" /></div>

			<?php do_action( 'woocommerce_register_form' ); ?>
			<?php do_action( 'register_form' ); ?>
			
			<p class="form-row">
				<?php wp_nonce_field( 'woocommerce-register' ); ?>
				<input type="submit" class="button" name="register" value="<?php esc_html_e( 'Register', 'wpnoone' ); ?>" />
			</p>
			
			<?php do_action( 'woocommerce_register_form_end' ); ?>
			
		</form>

	</div>

</div>
<?php endif; ?>

<?php do_action('woocommerce_after_customer_login_form'); ?>
</div>
