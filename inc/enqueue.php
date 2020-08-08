<?php
/**
 * UnderStrap enqueue scripts
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;


/**
 * understrap_styles
 *
 * load all thje style + bootstrap css
 */

function understrap_styles() {
		if ( is_admin() ) {
       		return;
    	}
		$the_theme     = wp_get_theme();
		$theme_version = $the_theme->get( 'Version' );
	
		$css_version = $theme_version . '.' . filemtime( get_template_directory() . '/css/theme.min.css' );
		wp_enqueue_style( 'understrap-styles', get_template_directory_uri() . '/css/theme.min.css', array(), $css_version );
}

add_action( 'wp_enqueue_scripts', 'understrap_styles' );


/**
 * understrap_styles
 *
 * load all Bootstrap js
 */

function understrap_load_bootstrap() {
	if ( is_admin() ) {
       return;
    }
	$the_theme     = wp_get_theme();
	$theme_version = $the_theme->get( 'Version' );
	
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'js.cookie', 'https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js', array(), '2.2.1', true );
	
    //wp_enqueue_script( 'popper.js', 'https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js', array('jquery'), '1.16.0', true );
   // wp_enqueue_script( 'bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js', array('popper.js'), '4.5.0', true );
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/theme.min.js', array('jquery'), '4.5.0', true );
		
}

add_action( 'wp_enqueue_scripts', 'understrap_load_bootstrap' );


/**
 * understrap_styles
 *
 * load headroom
 */
function understrap_load_headroom() {
	if ( is_admin() ) {
       return;
    }
	$the_theme     = wp_get_theme();
	$theme_version = $the_theme->get( 'Version' );
	
	/* materiale caricato in tutte le pagine */
	$js_version = $theme_version . '.' . filemtime( get_template_directory() . '/js/headroom.min.js' );
	wp_enqueue_script( 'headroom', get_template_directory_uri() . '/js/headroom.min.js', array('jquery' ), $js_version, true );
		
}

add_action( 'wp_enqueue_scripts', 'understrap_load_headroom' );

/**
 * understrap_styles
 *
 * load Formstone
 */
function understrap_load_formstone() {
	
	$the_theme  = wp_get_theme();
	$theme_version = $the_theme->get( 'Version' );

	$js_version = $theme_version . '.' . filemtime( get_template_directory() . '/js/core.js' );
	wp_enqueue_script( 'formstone-core', get_template_directory_uri() . '/js/core.js', array('jquery' ), $js_version, true );
	
	$the_theme  = wp_get_theme();
	$theme_version = $the_theme->get( 'Version' );

	$js_version = $theme_version . '.' . filemtime( get_template_directory() . '/js/mediaquery.js' );
	wp_enqueue_script( 'formstone-mediaquery', get_template_directory_uri() . '/js/mediaquery.js', array('jquery' ), $js_version, true );
	
	/** Sticky **/
	
	$js_version = $theme_version . '.' . filemtime( get_template_directory() . '/js/sticky.js' );
	wp_enqueue_script( 'formstone-sticky', get_template_directory_uri() . '/js/sticky.js', array('formstone-core', 'formstone-mediaquery' ), $js_version, true );
	
	$css_version = $theme_version . '.' . filemtime( get_template_directory() . '/css/sticky.css' );
	wp_enqueue_style( 'formstone-sticky-style', get_template_directory_uri() . '/css/sticky.css', array('understrap-styles'), $css_version );
	
	/** Number **/
	
	$js_version = $theme_version . '.' . filemtime( get_template_directory() . '/js/number.js' );
	wp_enqueue_script( 'formstone-number', get_template_directory_uri() . '/js/number.js', array('formstone-core' ), $js_version, true );
	
	$css_version = $theme_version . '.' . filemtime( get_template_directory() . '/css/number.css' );
	wp_enqueue_style( 'formstone-number-style', get_template_directory_uri() . '/css/number.css', array(), $css_version );
}

add_action( 'wp_enqueue_scripts', 'understrap_load_formstone' );


function understrap_custom_theme_flavour() {
	
	$the_theme  = wp_get_theme();
	$theme_version = $the_theme->get( 'Version' );
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
	
	$js_version = $theme_version . '.' . filemtime( get_template_directory() . '/js/global-trigger.js' );
	wp_enqueue_script( 'global-trigger', get_template_directory_uri() . '/js/global-trigger.js', array('jquery' ), $js_version, true );
	
}

add_action( 'wp_enqueue_scripts', 'understrap_custom_theme_flavour' );
