// JavaScript Document


			/* aded by alex july 10 2020 */
			if( is_active_widget( '', '', 'axl_product_widget' ) ) { // check if search widget is used
				$js_version = $theme_version . '.' . filemtime( get_template_directory() . '/js/product_image_widget.js' );
				wp_enqueue_script( 'product-widget', get_template_directory_uri() . '/js/product_image_widget.js', array('jquery'), $js_version, true );
			}

			$js_version = $theme_version . '.' . filemtime( get_template_directory() . '/js/site.js' );
			wp_enqueue_script( 'site', get_template_directory_uri() . '/js/site.js', array('jquery'), $js_version, true );

			/* materiale caricato in tutte le pagine */
			$js_version = $theme_version . '.' . filemtime( get_template_directory() . '/js/headroom.min.js' );
			wp_enqueue_script( 'headroom', get_template_directory_uri() . '/js/headroom.min.js', array('jquery','site'), $js_version, true );


			$js_version = $theme_version . '.' . filemtime( get_template_directory() . '/js/headroom-trigger.js' );
			wp_enqueue_script( 'headroom-trigger', get_template_directory_uri() . '/js/headroom-trigger.js', array('jquery', 'headroom' ), $js_version, true );

			$js_version = $theme_version . '.' . filemtime( get_template_directory() . '/js/jquery.sticky-sidebar.min.js' );
			wp_enqueue_script( 'sticky-sidebar', get_template_directory_uri() . '/js/jquery.sticky-sidebar.min.js', array('jquery'), $js_version, true );

			wp_enqueue_script( 'sticky-sidebar-trigger', get_template_directory_uri() . '/js/sticky-sidebar-trigger.js', array('jquery', 'sticky-sidebar'), $js_version, true );

			$js_version = $theme_version . '.' . filemtime( get_template_directory() . '/js/product-page-trigger.js' );
			wp_enqueue_script( 'site-trigger', get_template_directory_uri() . '/js/product-page-trigger.js', array('jquery', 'site'), $js_version, true );