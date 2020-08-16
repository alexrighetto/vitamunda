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
				<?php esc_html_e( 'User Navigation', 'understrap' ); ?>
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
					} else { ?>
						<a class="vitamunda navbar-brand" rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" itemprop="url">
						<img width ="30" src=" <?php echo get_theme_logo_url(); ?>"  class="d-inline-block align-top" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" loading="lazy" />
				
						<?php echo bloginfo( 'name' ); ?>
						</a>
				<?php
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
		<!--
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
			-->