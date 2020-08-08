<?php
/**
 * UnderStrap enqueue scripts
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;


function understrap_styles() {
		$the_theme     = wp_get_theme();
		$theme_version = $the_theme->get( 'Version' );
	
		$css_version = $theme_version . '.' . filemtime( get_template_directory() . '/css/theme.min.css' );
		wp_enqueue_style( 'understrap-styles', get_template_directory_uri() . '/css/theme.min.css', array(), $css_version );
}

add_action( 'wp_enqueue_scripts', 'understrap_styles' );



function mytheme_load_bootstrap() {
    if ( is_admin() ) {
       return;
    }
	$the_theme     = wp_get_theme();
	$theme_version = $the_theme->get( 'Version' );
	
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'js.cookie', 'https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js', array(), '2.2.1', true );
	
    wp_enqueue_script( 'popper.js', 'https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js', array('jquery'), '1.16.0', true );
    wp_enqueue_script( 'bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js', array('jquery', 'popper.js'), '4.5.0', true );
	$js_version = $theme_version . '.' . filemtime( get_template_directory() . '/js/footer-scripts.js' );
	wp_enqueue_script( 'footer-scripts', get_template_directory_uri() . '/js/footer-scripts.js', array('jquery', 'bootstrap', 'js.cookie' ), $js_version, true );
	
	
	/* materiale caricato in tutte le pagine */
		$js_version = $theme_version . '.' . filemtime( get_template_directory() . '/js/headroom.min.js' );
		wp_enqueue_script( 'headroom', get_template_directory_uri() . '/js/headroom.min.js', array('jquery' ), $js_version, true );
		
		

	
	
		
}
add_action( 'wp_enqueue_scripts', 'mytheme_load_bootstrap' );

function understrap_sticky (){
	
	$the_theme     = wp_get_theme();
	$theme_version = $the_theme->get( 'Version' );
	
	$js_version = $theme_version . '.' . filemtime( get_template_directory() . '/js/core.js' );
	wp_enqueue_script( 'formstone-core', get_template_directory_uri() . '/js/core.js', array('jquery' ), $js_version, true );
	
	$js_version = $theme_version . '.' . filemtime( get_template_directory() . '/js/sticky.js' );
	wp_enqueue_script( 'formstone-sticky', get_template_directory_uri() . '/js/sticky.js', array('jquery', 'formstone-core' ), $js_version, true );
	
			$js_version = $theme_version . '.' . filemtime( get_template_directory() . '/js/headroom-trigger.js' );
		wp_enqueue_script( 'headroom-trigger', get_template_directory_uri() . '/js/headroom-trigger.js', array('jquery', 'formstone-sticky' ), $js_version, true );
	
	$css_version = $theme_version . '.' . filemtime( get_template_directory() . '/css/sticky.css' );
	wp_enqueue_style( 'formstone-sticky-style', get_template_directory_uri() . '/css/sticky.css', array(), $css_version );
	
	
}
add_action( 'wp_enqueue_scripts', 'understrap_sticky' );


function understrap_numbers (){

	$the_theme     = wp_get_theme();
	$theme_version = $the_theme->get( 'Version' );
	
	$js_version = $theme_version . '.' . filemtime( get_template_directory() . '/js/number.js' );
	wp_enqueue_script( 'formstone-number', get_template_directory_uri() . '/js/number.js', array('formstone-core' ), $js_version, true );
	
	$css_version = $theme_version . '.' . filemtime( get_template_directory() . '/css/number.css' );
	wp_enqueue_style( 'formstone-number-style', get_template_directory_uri() . '/css/number.css', array(), $css_version );
	
}

add_action( 'wp_enqueue_scripts', 'understrap_numbers' );


if ( ! function_exists( 'understrap_scripts' ) ) {
	
	if(!is_404()){
	
	function understrap_scripts() {
		
		$the_theme     = wp_get_theme();
		$theme_version = $the_theme->get( 'Version' );



		
		
		
		
		
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
		
		
		
		
		
		
	
		
		
		
		
		
		
		
		
	
		if ( class_exists( 'woocommerce' ) ) {  
			
			if (is_product_category() OR is_shop() OR is_product()){
		
				$js_version = $theme_version . '.' . filemtime( get_template_directory() . '/js/jquery.sticky-sidebar.min.js' );
				wp_enqueue_script( 'sticky-sidebar', get_template_directory_uri() . '/js/jquery.sticky-sidebar.min.js', array('jquery'), $js_version, true );
				
				wp_enqueue_script( 'sticky-sidebar-trigger', get_template_directory_uri() . '/js/sticky-sidebar-trigger.js', array('jquery', 'sticky-sidebar'), $js_version, true );
			}	
				
			if (is_product()){
				
				
				
				$js_version = $theme_version . '.' . filemtime( get_template_directory() . '/js/product-page-trigger.js' );
				wp_enqueue_script( 'site-trigger', get_template_directory_uri() . '/js/product-page-trigger.js', array('jquery', 'site'), $js_version, true );
				
			
			}
				
			
			
		}

		
		
	}
	}	
} // End of if function_exists( 'understrap_scripts' ).

//add_action( 'wp_enqueue_scripts', 'understrap_scripts' );