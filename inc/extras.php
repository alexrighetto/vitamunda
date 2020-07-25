<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

add_filter( 'body_class', 'understrap_body_classes' );

if ( ! function_exists( 'understrap_body_classes' ) ) {
	/**
	 * Adds custom classes to the array of body classes.
	 *
	 * @param array $classes Classes for the body element.
	 *
	 * @return array
	 */
	function understrap_body_classes( $classes ) {
		// Adds a class of group-blog to blogs with more than 1 published author.
		if ( is_multi_author() ) {
			$classes[] = 'group-blog';
		}
		// Adds a class of hfeed to non-singular pages.
		if ( ! is_singular() ) {
			$classes[] = 'hfeed';
		}

		return $classes;
	}
}

// Removes tag class from the body_class array to avoid Bootstrap markup styling issues.
add_filter( 'body_class', 'understrap_adjust_body_class' );

if ( ! function_exists( 'understrap_adjust_body_class' ) ) {
	/**
	 * Setup body classes.
	 *
	 * @param string $classes CSS classes.
	 *
	 * @return mixed
	 */
	function understrap_adjust_body_class( $classes ) {

		foreach ( $classes as $key => $value ) {
			if ( 'tag' === $value ) {
				unset( $classes[ $key ] );
			}
		}

		return $classes;

	}
}

// Filter custom logo with correct classes.
add_filter( 'get_custom_logo', 'understrap_change_logo_class' );

if ( ! function_exists( 'understrap_change_logo_class' ) ) {
	/**
	 * Replaces logo CSS class.
	 *
	 * @param string $html Markup.
	 *
	 * @return string
	 */
	function understrap_change_logo_class( $html ) {

		$html = str_replace( 'class="custom-logo"', 'class="img-fluid"', $html );
		$html = str_replace( 'class="custom-logo-link"', 'class="navbar-brand custom-logo-link"', $html );
		$html = str_replace( 'alt=""', 'title="Home" alt="logo"', $html );

		return $html;
	}
}

if ( ! function_exists( 'understrap_post_nav' ) ) {
	/**
	 * Display navigation to next/previous post when applicable.
	 */
	function understrap_post_nav() {
		// Don't print empty markup if there's nowhere to navigate.
		$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
		$next     = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous ) {
			return;
		}
		?>
		<nav class="container navigation post-navigation">
			<h2 class="sr-only"><?php esc_html_e( 'Post navigation', 'understrap' ); ?></h2>
			<div class="row nav-links justify-content-between">
				<?php
				if ( get_previous_post_link() ) {
					previous_post_link( '<span class="nav-previous">%link</span>', _x( '<i class="fa fa-angle-left"></i>&nbsp;%title', 'Previous post link', 'understrap' ) );
				}
				if ( get_next_post_link() ) {
					next_post_link( '<span class="nav-next">%link</span>', _x( '%title&nbsp;<i class="fa fa-angle-right"></i>', 'Next post link', 'understrap' ) );
				}
				?>
			</div><!-- .nav-links -->
		</nav><!-- .navigation -->
		<?php
	}
}

if ( ! function_exists( 'understrap_pingback' ) ) {
	/**
	 * Add a pingback url auto-discovery header for single posts of any post type.
	 */
	function understrap_pingback() {
		if ( is_singular() && pings_open() ) {
			echo '<link rel="pingback" href="' . esc_url( get_bloginfo( 'pingback_url' ) ) . '">' . "\n";
		}
	}
}
add_action( 'wp_head', 'understrap_pingback' );

if ( ! function_exists( 'understrap_mobile_web_app_meta' ) ) {
	/**
	 * Add mobile-web-app meta.
	 */
	function understrap_mobile_web_app_meta() {
		echo '<meta name="mobile-web-app-capable" content="yes">' . "\n";
		echo '<meta name="apple-mobile-web-app-capable" content="yes">' . "\n";
		echo '<meta name="apple-mobile-web-app-title" content="' . esc_attr( get_bloginfo( 'name' ) ) . ' - ' . esc_attr( get_bloginfo( 'description' ) ) . '">' . "\n";
	}
}
add_action( 'wp_head', 'understrap_mobile_web_app_meta' );

if ( ! function_exists( 'understrap_default_body_attributes' ) ) {
	/**
	 * Adds schema markup to the body element.
	 *
	 * @param array $atts An associative array of attributes.
	 * @return array
	 */
	function understrap_default_body_attributes( $atts ) {
		$atts['itemscope'] = '';
		$atts['itemtype']  = 'http://schema.org/WebSite';
		return $atts;
	}
}
add_filter( 'understrap_body_attributes', 'understrap_default_body_attributes' );

// Escapes all occurances of 'the_archive_description'.
add_filter( 'get_the_archive_description', 'understrap_escape_the_archive_description' );

if ( ! function_exists( 'understrap_escape_the_archive_description' ) ) {
	/**
	 * Escapes the description for an author or post type archive.
	 *
	 * @param string $description Archive description.
	 * @return string Maybe escaped $description.
	 */
	function understrap_escape_the_archive_description( $description ) {
		if ( is_author() || is_post_type_archive() ) {
			return wp_kses_post( $description );
		} else {
			/*
			* All other descriptions are retrieved via term_description() which returns
			* a sanitized description.
			*/
			return $description;
		}
	}
} // End of if function_exists( 'understrap_escape_the_archive_description' ).

// Escapes all occurances of 'the_title()' and 'get_the_title()'.
add_filter( 'the_title', 'understrap_kses_title' );

// Escapes all occurances of 'the_archive_title' and 'get_the_archive_title()'.
add_filter( 'get_the_archive_title', 'understrap_kses_title' );

if ( ! function_exists( 'understrap_kses_title' ) ) {
	/**
	 * Sanitizes data for allowed HTML tags for post title.
	 *
	 * @param string $data Post title to filter.
	 * @return string Filtered post title with allowed HTML tags and attributes intact.
	 */
	function understrap_kses_title( $data ) {
		// Tags not supported in HTML5 are not allowed.
		$allowed_tags = array(
			'abbr'             => array(),
			'aria-describedby' => true,
			'aria-details'     => true,
			'aria-label'       => true,
			'aria-labelledby'  => true,
			'aria-hidden'      => true,
			'b'                => array(),
			'bdo'              => array(
				'dir' => true,
			),
			'blockquote'       => array(
				'cite'     => true,
				'lang'     => true,
				'xml:lang' => true,
			),
			'cite'             => array(
				'dir'  => true,
				'lang' => true,
			),
			'dfn'              => array(),
			'em'               => array(),
			'i'                => array(
				'aria-describedby' => true,
				'aria-details'     => true,
				'aria-label'       => true,
				'aria-labelledby'  => true,
				'aria-hidden'      => true,
				'class'            => true,
			),
			'code'             => array(),
			'del'              => array(
				'datetime' => true,
			),
			'ins'              => array(
				'datetime' => true,
				'cite'     => true,
			),
			'kbd'              => array(),
			'mark'             => array(),
			'pre'              => array(
				'width' => true,
			),
			'q'                => array(
				'cite' => true,
			),
			's'                => array(),
			'samp'             => array(),
			'span'             => array(
				'dir'      => true,
				'align'    => true,
				'lang'     => true,
				'xml:lang' => true,
			),
			'small'            => array(),
			'strong'           => array(),
			'sub'              => array(),
			'sup'              => array(),
			'u'                => array(),
			'var'              => array(),
		);
		$allowed_tags = apply_filters( 'understrap_kses_title', $allowed_tags );

		return wp_kses( $data, $allowed_tags );
	}
} // End of if function_exists( 'understrap_kses_title' ).

add_action( 'woocommerce_after_add_to_cart_form', 'understrap_axl_get_product_widgets', 10, 2 );

function understrap_axl_get_product_widgets (){
	
	
	
	?><div class="container">
<div class="row">
<?php
	dynamic_sidebar( 'productsupport' ); 
	
	if (function_exists ( 'get_field' )){
		global $post;
		$postID = $post->ID;
		$value = get_field( "video_prodotto" , false, $postID );
		if( $value ) {
			 echo $value; 
		}else{
			dynamic_sidebar( 'videoproduct' );
		}
	}	
	?>
			</div>
</div>
<?php
}	

/**
blocco di codice per rimuovere il prezzo di range
**/

function understrap_axl_wc_varb_price_range( $wcv_price, $product ) {
 
    $prefix = sprintf('%s', __('', 'wcvp_range'));
 
    $wcv_reg_min_price = $product->get_variation_regular_price( 'min', true );
    $wcv_min_sale_price    = $product->get_variation_sale_price( 'min', true );
    $wcv_max_price = $product->get_variation_price( 'max', true );
    $wcv_min_price = $product->get_variation_price( 'min', true );
 
    $wcv_price = ( $wcv_min_sale_price == $wcv_reg_min_price ) ?
        wc_price( $wcv_reg_min_price ) :
        '<del>' . wc_price( $wcv_reg_min_price ) . '</del>' . '<ins>' . wc_price( $wcv_min_sale_price ) . '</ins>';
 
    return ( $wcv_min_price == $wcv_max_price ) ?
        $wcv_price :
        sprintf('%s%s', $prefix, $wcv_price);
}
 
add_filter( 'woocommerce_variable_sale_price_html', 'understrap_axl_wc_varb_price_range', 10, 2 );
add_filter( 'woocommerce_variable_price_html', 'understrap_axl_wc_varb_price_range', 10, 2 );


/**
blocco di codice per spistare i meta su vicino al titolo
**/
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 15);


/**
  * Edit my account menu order
  */

 function my_account_menu_order() {
 	$menuOrder = array(
 		'dashboard'          => __( 'Dashboard', 'woocommerce' ),
		'edit-account'    	=> __( 'Account Details', 'woocommerce' ),
 		'orders'             => __( 'Orders', 'woocommerce' ),
 		'edit-address'       => __( 'Addresses', 'woocommerce' ),
 		
 		'customer-logout'    => __( 'Logout', 'woocommerce' ),
 	);
 	return $menuOrder;
 }
 add_filter ( 'woocommerce_account_menu_items', 'my_account_menu_order' );



/*
Edit the product archive page

*/

function woocommerce_template_loop_product_title() {
		echo '<h2 class="' . esc_attr( apply_filters( 'woocommerce_product_loop_title_classes', 'woocommerce-loop-product__title' ) ) . '">';
	
	echo get_the_title(); 
	
		
	if (function_exists ( 'get_field' )){
		$value = get_field( "sottotitolo" );	
			if( $value ) {
			?>
			<small class="text-muted"> <?php echo $value; ?></small>
			<?php
		}
	}

	
	echo '</h2>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

add_action( 'woocommerce_product_query', 'all_products_query' );

function all_products_query( $q ){
    $q->set( 'posts_per_page', -1 );
}


/**
 * Replace the home link URL
 */
add_filter( 'woocommerce_breadcrumb_home_url', 'woo_custom_breadrumb_home_url' );
function woo_custom_breadrumb_home_url() {
    return get_permalink(wc_get_page_id('shop')); // URL
}


/**

 * Find matching product variation

 *

 * @param WC_Product $product

 * @param array $attributes

 * @return int Matching variation ID or 0.

 */


function iconic_find_matching_product_variation( $product, $attributes ) {

 


    foreach( $attributes as $key => $value ) {


        if( strpos( $key, 'attribute_' ) === 0 ) {


            continue;


        }

 


        unset( $attributes[ $key ] );


        $attributes[ sprintf( 'attribute_%s', $key ) ] = $value;


    }

 


    if( class_exists('WC_Data_Store') ) {

 


        $data_store = WC_Data_Store::load( 'product' );


        return $data_store->find_matching_product_variation( $product, $attributes );

 


    } else {

 


        return $product->get_matching_variation( $attributes );

 


    }

 

}


