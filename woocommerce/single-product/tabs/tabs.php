<?php
/**
 * Single Product tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.8.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;

/**
 * Filter tabs and allow third parties to add their own.
 *
 * Each tab is an array containing title, callback and priority.
 *
 * @see woocommerce_default_product_tabs()
 */
$product_tabs = apply_filters( 'woocommerce_product_tabs', array() );

if ( ! empty( $product_tabs ) ) : ?>


	
	<div id="product-tab-wrapper" class="woocommerce-tabs wc-tabs-wrapper">
		
		
		<nav id="product-tab" class="product-tab navbar navbar-light pl-0 pr-0" data-sticky-container="#product-tab-wrapper">
		  <div class="container pl-0 pr-0">
			  
		  <span class="navbar-brand mb-0 h1">
			<?php  echo $product->get_image(array( 30, 30 )); ?>
			  <?php echo $product->get_name(); ?>
			</span>  
		  <ul class="nav nav-pills">
					<?php foreach ( $product_tabs as $key => $product_tab ) : ?>
						<li class="nav-item">

							<a class="nav-link" href="#item-<?php echo esc_attr( $key ); ?>">
								<?php echo wp_kses_post( apply_filters( 'woocommerce_product_' . $key . '_tab_title', $product_tab['title'], $key ) ); ?>
							</a>

						</li>
					<?php endforeach; ?>

				</ul>
			<?php $prod_variations = $product->get_children(); ?>	
	  		<form class="cart form-inline" action="?add-to-cart=<?php echo $prod_variations[0] ; ?>">
			   <button class="btn btn-primary add-to-cart-button" type="submit"><?php echo esc_html( $product->single_add_to_cart_text() ); ?><small> (€<?php echo $product->get_price(); ?>)</small></button>
			</form>
			  
			  
			</div>
		</nav>
		
		
			
		
			
		
			<?php foreach ( $product_tabs as $key => $product_tab ) : ?>
			<div class="tab-card">
			<h4 class="display-4" id="item-<?php echo esc_attr( $key ); ?>" role="tabpanel" aria-labelledby="tab-title-<?php echo esc_attr( $key ); ?>">
			</h4>
			
				<?php
				if ( isset( $product_tab['callback'] ) ) {
					call_user_func( $product_tab['callback'], $key, $product_tab );
				}
				?>
			</div>
		<?php endforeach; ?>
			
		
		<?php do_action( 'woocommerce_product_after_tabs' ); ?>
			
	</div>

<?php endif; ?>