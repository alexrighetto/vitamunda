<?php
/**
 * Empty cart page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-empty.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.1
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="container mt-3">
	<div class="row">
		<div class="col-12">
			<?php
			/*
			 * @hooked wc_empty_cart_message - 10
			 */
			do_action( 'woocommerce_cart_is_empty' );
			?>
		</div>
		<div class="col-4">
			<div class="border-right">
			<?php  dynamic_sidebar( 'empty-cart-left' ); ?>
			</div>	
		</div>
		
		
		<div class="col-8">
			<div>
<?php



if ( wc_get_page_id( 'shop' ) > 0 ) :
	?>
<h3>Il tuo carrello è vuoto</h3>
<a class=" " href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>">
			<?php esc_html_e( 'Return to shop', 'understrap' ); ?>
		</a>
			
	<p class="return-to-shop mt-3 mb-3">
		<a class="btn btn-warning btn-gradient xoo-el-login-tgr" href="#">
			<?php esc_html_e( 'Log-in', 'understrap' ); ?>
		</a>
		
		<a class="btn btn-light btn-gradient   xoo-el-reg-tgr" href="#">
			<?php esc_html_e( 'Register', 'understrap' ); ?>
		</a>
	</p>
	<?php
endif;
?></div>
	</div>
		</div>
	</div>
<div class=" container mt-3">
				<div class="row">	
					<?php  dynamic_sidebar( 'empty-cart' ); ?>
				</div>	
				</div><!--col end -->