<?php
/**
 * Description tab
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/description.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 2.0.0
 */

defined( 'ABSPATH' ) || exit;

global $post;
global $product;
$container = get_theme_mod( 'understrap_container_type' );
$heading = apply_filters( 'woocommerce_product_description_heading', __( 'Description', 'woocommerce' ) );

?>


<div class="<?php echo esc_attr( $container ); ?>" >
	<div class="row tab-entry-wrapper">			
		<div class="main-col">
			
				<?php if ( $heading ) : ?>
				<header class="tab-entry-header">

					<h5 class="tab-entry-title"><?php echo esc_html( $heading ); ?></h5>
				</header>
				<?php endif; ?>
				<div class="tab-entry-content">
					<?php the_content(); ?>
				</div>	
			
		</div><!-- .col -->
		
		<div class="side-col tab-sidebar">
			
			<aside class="sidebar__outer">
				<div class="inner-wrapper">
					<?php echo '<figure>' .$product->get_image(array( 500, 800 )) . '</figure>' ;?>
						<header class="tab-entry-header">
						<h5  class="tab-entry-title"><?php echo $product->get_name(); ?></h5>
						</header>
						</div>
			</aside>
			
		</div><!-- .col -->
	</div><!-- .row.tab-entry-wrapper -->
</div><!-- .container -->		