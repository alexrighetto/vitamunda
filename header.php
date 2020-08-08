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

		
		
		<nav id="user-nav" class="user-nav  bg-light d-none d-sm-none d-md-block" aria-labelledby="user-nav-label">
			

			<h2 id="user-nav-label" class="sr-only">
				<?php esc_html_e( 'User Navigation', 'understrap' ); ?>
			</h2>
			
			
		
			<div class="container">
				<div class="row justify-content-md-center">
		
			<?php	if (  is_active_sidebar( 'header' ) ) { ?>
				
					<div class="col d-none d-sm-none d-lg-block">
						<?php dynamic_sidebar( 'header' ); ?>
					</div>
				
			<?php } ?>
					
					<div class="col">
				<!-- The WordPress Menu goes here -->
				<?php
				wp_nav_menu(
					array(
						'theme_location'  => 'user',
						'container_class' => 'collapse navbar-collapse',
						'container_id'    => 'userNavDropdown',
						'menu_class'      => 'navbar-nav ml-auto',
						'fallback_cb'     => '',
						'menu_id'         => 'user-menu',
						'depth'           => 2,
						'walker'          => new Understrap_WP_Bootstrap_Navwalker(),
					)
				);
				?>
						
			
					</div>
				</div>
			</div><!-- .container -->
			

		</nav><!-- .user-navigation -->
		
		<nav id="main-nav" class="navbar-light bg-light navbar main-nav" aria-labelledby="main-nav-label">

			<h2 id="main-nav-label" class="sr-only">
				<?php esc_html_e( 'Main Navigation', 'understrap' ); ?>
			</h2>

		<?php if ( 'container' === $container ) : ?>
			<div class="container">
		<?php endif; ?>

					<!-- Your site title as branding in the menu -->
					<?php if ( ! has_custom_logo() ) { ?>

						<?php if ( is_front_page() && is_home() ) : ?>

							<h1 class="vitamunda mb-0"><a rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" itemprop="url"><?php bloginfo( 'name' ); ?></a></h1>

						<?php else : ?>

							<a class="vitamunda" rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" itemprop="url"><?php bloginfo( 'name' ); ?></a>

						<?php endif; ?>

						<?php
					} else {
						the_custom_logo();
					}
					?>
					<!-- end custom logo -->
				<?php 
				
				// activate bootstrap nav toggler only if the plugin is not active
				
				$megamenu = "megamenu/megamenu.php";
				$manu_plugin_active = in_array( $megamenu, (array) get_option( 'active_plugins', array() ) );
				
				
				if ( ! $manu_plugin_active  ){
			
				?>
				<!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'understrap' ); ?>">
					<span class="navbar-toggler-icon"></span>
				</button> -->
				<?php
				}
				?>

				<!-- The WordPress Menu goes here -->
				<?php
				wp_nav_menu(
					array(
						'theme_location'  => 'primary',
						'container_class' => 'collapse navbar-collapse',
						'container_id'    => 'navbarNavDropdown',
						'menu_class'      => 'navbar-nav ml-auto',
						'fallback_cb'     => '',
						'menu_id'         => 'main-menu',
						'depth'           => 2,
						'walker'          => new Understrap_WP_Bootstrap_Navwalker(),
					)
				);
				?>
			<?php if ( 'container' === $container ) : ?>
			</div><!-- .container -->
			<?php endif; ?>

		</nav><!-- .site-navigation -->
		
		<nav id="product-nav" class="d-none d-sm-none d-md-block bg-light" aria-labelledby="product-nav-label">
			<div class="container">
				<div class="row">
				<div class='delivery-wrapper d-none d-md-block col-auto'>
					<?php axl_show_delivery_address (); ?>
				</div>
				<div class="product-menu-wrapper col-md-8col-lg-10">
			<?php 
				
				// activate bootstrap nav toggler only if the plugin is not active
				
				$megamenu = "megamenu/megamenu.php";
				$manu_plugin_active = in_array( $megamenu, (array) get_option( 'active_plugins', array() ) );
				
				
			//	if (  $manu_plugin_active  ){
			
		
				wp_nav_menu(
					array(
						'theme_location'  => 'product',
						'container_class' => '',
						'container_id'    => 'productNavbar',
						'menu_class'      => 'navbar-nav ml-auto',
						'fallback_cb'     => '',
						'menu_id'         => 'product-menu',
						'depth'           => 2,
						'walker'          => new Understrap_WP_Bootstrap_Navwalker(),
					)
				);
					
				//	}	
				?>
				</div>
				</div>	
				</div>	
		</nav>
			

	</div><!-- #wrapper-navbar end -->
	
	<!-- ******************* The Content Area ******************* -->
	<div id="main-wrapper-content" >
