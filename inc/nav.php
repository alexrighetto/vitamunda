<?php 

add_action('theme_navigation_area', 'axl_vitamunda_user_nav', 10);
add_action('theme_navigation_area', 'axl_vitamunda_main_nav', 12);
add_action('theme_navigation_area', 'axl_vitamunda_product_nav', 15);

function axl_vitamunda_user_nav(){
	?>
	<nav id="user-nav" class="navbar navbar-expand-lg navbar-light bg-light d-none d-sm-none d-md-block">
		<div class="container">
			<?php	if (  is_active_sidebar( 'header' ) ) : ?>
			
			<div class="d-flex justify-content-start d-none d-sm-none d-lg-block">
				<?php dynamic_sidebar( 'header' ); ?>
			</div>
				
			<?php endif; ?>
				
			<div class="d-flex ml-sm-auto justify-content-end">
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
	</nav>	
<?php
}



function axl_vitamunda_main_nav(){
?>
	
<nav id="main-nav" class="navbar-light bg-light  main-nav pt-3 pt-md-1 pb-3 pb-md-1" aria-labelledby="main-nav-label">
	<div class="container">
		
		<a class="vitamunda navbar-brand" rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" itemprop="url">
		
			<img width ="30" src=" <?php echo get_theme_logo_url(); ?>"  class="d-inline-block align-top" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" loading="lazy" />

			<?php echo bloginfo( 'name' ); ?>
		
		</a>
		<?php 
		$megamenu = "megamenu/megamenu.php";
		$manu_plugin_active = in_array( $megamenu, (array) get_option( 'active_plugins', array() ) );
		
		if ( ! $manu_plugin_active  ): ?>
					
		<div class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'understrap' ); ?>">
			<span class="navbar-toggler-icon"></span>
		</div>
		<?php endif; ?>
		
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
		
	</div>
</nav>
<?php
}


function axl_vitamunda_product_nav(){
?>
<nav id="product-nav" class="navbar navbar-expand-lg navbar-light bg-light d-none d-sm-none d-md-block bg-light pt-0 pb-0" aria-labelledby="product-nav-label">
	<div class="container">
		<div class='delivery-wrapper d-flex justify-content-start d-none d-md-flex'>
			<?php axl_show_delivery_address (); ?>
		</div>
		<div class="d-flex justify-content-center">
					<?php
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
					?>
			</div>	
	</div>	
</nav>	
<?php
}