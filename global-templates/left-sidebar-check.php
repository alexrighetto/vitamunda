<?php
/**
 * Left sidebar check
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$sidebar_pos = get_theme_mod( 'understrap_sidebar_position' );
if ( class_exists( 'woocommerce' ) ) {
	
	if ( 'left' === $sidebar_pos || 'both' === $sidebar_pos ||  is_shop() || is_product_category()) {
		get_template_part( 'sidebar-templates/sidebar', 'left' );
	}
}else{
	if ( 'left' === $sidebar_pos || 'both' === $sidebar_pos ) {
		get_template_part( 'sidebar-templates/sidebar', 'left' );
	}
	
}
?>
