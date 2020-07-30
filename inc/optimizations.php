<?php


//Stop Loading WooCommerce .js (javascript) and .css files on all WordPress Posts/Pages

//https://crunchify.com/how-to-stop-loading-woocommerce-js-javascript-and-css-files-on-all-wordpress-postspages/

//* Enqueue scripts and styles
//add_action( 'wp_enqueue_scripts', 'crunchify_disable_woocommerce_loading_css_js' );
 
function crunchify_disable_woocommerce_loading_css_js() {
 
	// Check if WooCommerce plugin is active
	if( function_exists( 'is_woocommerce' ) ){
 
		// Check if it's any of WooCommerce page
		if(! is_woocommerce() && ! is_cart() && ! is_checkout() ) { 		
			
			## Dequeue WooCommerce styles
			wp_dequeue_style('woocommerce-layout'); 
			wp_dequeue_style('woocommerce-general'); 
			wp_dequeue_style('woocommerce-smallscreen'); 	
 
			## Dequeue WooCommerce scripts
			wp_dequeue_script('wc-cart-fragments');
			wp_dequeue_script('woocommerce'); 
			wp_dequeue_script('wc-add-to-cart'); 
		
			wp_deregister_script( 'js-cookie' );
			wp_dequeue_script( 'js-cookie' );
 
		}
	}	
}


//How to Disable Auto Embed Script for WordPress
//https://crunchify.com/how-to-disable-auto-embed-script-for-wordpress-4-4-wp-embed-min-js///


// Remove jQuery Migrate Script from header and Load jQuery from Google API
function crunchify_stop_loading_wp_embed_and_jquery() {
	if (!is_admin()) {
		wp_deregister_script('wp-embed');
		
	}
}
add_action('init', 'crunchify_stop_loading_wp_embed_and_jquery');



//Stop Loading wp-emoji-release.min.js and CSS file

//https://crunchify.com/not-using-emoji-on-your-wordpress-blog-stop-loading-wp-emoji-release-min-js-and-css-file/

remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

//https://css-tricks.com/snippets/wordpress/remove-wp-generator-meta-tag/
//Remove WP Generator Meta Tag
remove_action('wp_head', 'wp_generator');




function smartwp_remove_wp_block_library_css(){
	if (!is_admin()){
		
	
 wp_dequeue_style( 'wp-block-library' );
 wp_dequeue_style( 'wp-block-library-theme' );
 wp_dequeue_style( 'wc-block-style' ); // Remove WooCommerce block CSS
	}	
}
//add_action( 'wp_enqueue_scripts', 'smartwp_remove_wp_block_library_css', 100 );
