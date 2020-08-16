<?php
/**
 * The header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$container = get_theme_mod( 'understrap_container_type' );
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="google-site-verification" content="I_fMs7nHls9h0mp1eSkfLXKsZaXNUIVe7iVnkgB4VTQ" />
	<meta name="ahrefs-site-verification" content="bcb92fea1281f049ceb7f5a0e3d886f6ea993e8726c51dfe31d4691b85fee5a7">
	<meta name="facebook-domain-verification" content="ubu340lcudqvz40d6qwa8606vdm4j6" />
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body id="pagebody" <?php body_class(); ?> <?php if (function_exists('understrap_body_attributes')){ understrap_body_attributes(); }?> data-spy="scroll" data-target="#product-tab" data-offset="150">
<?php do_action( 'wp_body_open' ); ?>

	
	
<div class="site" id="page">
	

<!-- Modal -->
<div id="staticBackdrop" class="fade"></div>
	
	<!-- ******************* The Navbar Area ******************* -->
	<div id="wrapper-navbar" class="sticky-top" >
		
		<?php do_action('theme_navigation_area'); ?>
	
	</div><!-- #wrapper-navbar end -->
	
	<!-- ******************* The Content Area ******************* -->
	<div id="main-wrapper-content" >
	<?php do_action( 'global_page_start' ); ?>	
