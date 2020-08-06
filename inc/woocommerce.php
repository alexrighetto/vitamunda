<?php
/**
 * Add WooCommerce support
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

add_action( 'after_setup_theme', 'understrap_woocommerce_support' );
if ( ! function_exists( 'understrap_woocommerce_support' ) ) {
	/**
	 * Declares WooCommerce theme support.
	 */
	function understrap_woocommerce_support() {
		add_theme_support( 'woocommerce' );

		// Add Product Gallery support.
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-slider' );
	}
}

add_action( 'wp', 'understrap_woocommerce_support' );
if ( ! function_exists( 'understrap_wc_form' ) ) {
	function understrap_wc_form (){
		// Add Bootstrap classes to form fields. but not on checkout 
		if (  is_checkout() ) {

			add_filter('woocommerce_form_field_args','understrap_wc_form_field_args',10,3);

		}

	}
}



// First unhook the WooCommerce content wrappers.
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );



if ( ! function_exists( 'understrap_wc_form_field_args' ) ) {
	/**
	 * Filter hook function monkey patching form classes
	 * Author: Adriano Monecchi http://stackoverflow.com/a/36724593/307826
	 *
	 * @param string $args Form attributes.
	 * @param string $key Not in use.
	 * @param null   $value Not in use.
	 *
	 * @return mixed
	 */
	function understrap_wc_form_field_args( $args, $key, $value = null ) {
		// Start field type switch case.
		switch ( $args['type'] ) {
			// Targets all select input type elements, except the country and state select input types.
			case 'select':
				/*
				 * Add a class to the field's html element wrapper - woocommerce
				 * input types (fields) are often wrapped within a <p></p> tag.
				 */
				$args['class'][] = 'form-group';
				// Add a class to the form input itself.
				$args['input_class'] = array( 'form-control' );
				// Add custom data attributes to the form input itself.
				$args['custom_attributes'] = array(
					'data-plugin'      => 'select2',
					'data-allow-clear' => 'true',
					'aria-hidden'      => 'true',
				);
				break;
			/*
			 * By default WooCommerce will populate a select with the country names - $args
			 * defined for this specific input type targets only the country select element.
			 */
			case 'country':
				$args['class'][] = 'form-group single-country';
				break;
			/*
			 * By default WooCommerce will populate a select with state names - $args defined
			 * for this specific input type targets only the country select element.
			 */
			case 'state':
				$args['class'][] = 'form-group';
				$args['custom_attributes'] = array(
					'data-plugin'      => 'select2',
					'data-allow-clear' => 'true',
					'aria-hidden'      => 'true',
				);
				break;
			case 'password':
			case 'text':
			case 'email':
			case 'tel':
			case 'number':
				$args['class'][]     = 'form-group';
				$args['input_class'] = array( 'form-control' );
				break;
			case 'textarea':
				$args['input_class'] = array( 'form-control' );
				break;
			case 'checkbox':
				// Add a class to the form input's <label> tag.
				$args['label_class'] = array( 'custom-control custom-checkbox' );
				$args['input_class'] = array( 'custom-control-input' );
				break;
			case 'radio':
				$args['label_class'] = array( 'custom-control custom-radio' );
				$args['input_class'] = array( 'custom-control-input' );
				break;
			default:
				$args['class'][]     = 'form-group';
				$args['input_class'] = array( 'form-control' );
				break;
		} // End of switch ( $args ).
		return $args;
	}
}

if ( ! is_admin() && ! function_exists( 'wc_review_ratings_enabled' ) ) {
	/**
	 * Check if reviews are enabled.
	 *
	 * Function introduced in WooCommerce 3.6.0., include it for backward compatibility.
	 *
	 * @return bool
	 */
	function wc_reviews_enabled() {
		return 'yes' === get_option( 'woocommerce_enable_reviews' );
	}

	/**
	 * Check if reviews ratings are enabled.
	 *
	 * Function introduced in WooCommerce 3.6.0., include it for backward compatibility.
	 *
	 * @return bool
	 */
	function wc_review_ratings_enabled() {
		return wc_reviews_enabled() && 'yes' === get_option( 'woocommerce_enable_review_rating' );
	}
}


add_action( 'woocommerce_product_after_tabs', 'axl_woocommerce_tab_end', 10 );

function axl_woocommerce_tab_end (){
	
	global $product; 
	$container = get_theme_mod( 'understrap_container_type' );
	
?>

<div class="final-tab product blue-back">
	<div class="<?php echo esc_attr( $container ); ?>" >
		<div class="row justify-content-md-center">
			<article>
				<h5 class="inverted-title"><?php echo esc_html( $product->single_add_to_cart_text() );?></h5>			
				
				<h2 class="product_title h1">
				<?php echo $product->get_name();?>
				<?php 	
					if (function_exists ( 'get_field' )){
						$value = get_field( "sottotitolo" );	
							if( $value ) {
							?>
							<small class="text-muted"> <?php echo $value; ?></small>
							<?php
						}
					}
				?>			
				</h2>
				
				<?php
				echo '<figure>' .$product->get_image(array( 500, 800 )) . '</figure>' ;// Get Product ID
				echo '<p class="price">' .'€'.$product->get_price() . '</p>';
				$prod_variations = $product->get_children();
				?>
				
				<?php 	
				if (function_exists ( 'get_field' )){
					$value = get_field( "descrizione_breve" );	
						if( $value ) {
						?>
					<p class="lead"> <?php echo $value; ?></p>
						<?php
					}
				}?>
				
				<form class="cart" action="?add-to-cart=<?php echo $prod_variations[0] ; ?>">
					<button class=" btn btn-primary add-to-cart-button" type="submit"><?php echo esc_html( $product->single_add_to_cart_text() ) ." " . $product->get_name(); ?></button>
				</form>
			</article>
			
		</div><!-- .row -->
		
	</div><!-- .container -->
</div><!-- .final-tab -->
<?php
}

add_action( 'woocommerce_product_additional_information', 'axl_woocommerce_add_to_cart_btn', 10 );


function axl_woocommerce_add_to_cart_btn (){
	global $product;
	
	$prod_variations = $product->get_children();
	?>
	<form class="cart" action="?add-to-cart=<?php echo $prod_variations[0] ; ?>">
		<button class="btn btn-primary add-to-cart-button" type="submit"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>
	</form>
<?php
}

add_action( 'woocommerce_after_main_content',  'axl_woocommerce_add_reviews');

function axl_woocommerce_add_reviews(){
	
	$container = get_theme_mod( 'understrap_container_type' );
	
	if(function_exists('wc_yotpo_show_widget')){
	?>
		<div class="<?php echo esc_attr( $container ); ?>" >
		<div class="row">
			<?php wc_yotpo_show_widget(); ?>
		</div>
		</div>
	<?php
	}		
}

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




remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );


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

// To change add to cart text on single product page
add_filter( 'woocommerce_product_single_add_to_cart_text', 'woocommerce_custom_single_add_to_cart_text' ); 
function woocommerce_custom_single_add_to_cart_text() {
    return __( 'Acquista', 'woocommerce' ); 
}

// To change add to cart text on product archives(Collection) page
add_filter( 'woocommerce_product_add_to_cart_text', 'woocommerce_custom_product_add_to_cart_text' );  
function woocommerce_custom_product_add_to_cart_text() {
    return __( 'Acquista', 'woocommerce' );
}



/**
 * Display category image on category archive
 */
add_action( 'woocommerce_archive_description', 'woocommerce_category_image', 2 );
function woocommerce_category_image() {
    if ( is_product_category() ){
	    global $wp_query;
	    $cat = $wp_query->get_queried_object();
	    $thumbnail_id = get_term_meta( $cat->term_id, 'thumbnail_id', true );
	    $image = wp_get_attachment_url( $thumbnail_id );
	    if ( $image ) {
			?>
<figure class="full-width">
		    <img src="<?php echo  $image; ?>" alt="<?php echo $cat->name; ?>" />
</figure>
			<?php
		}
	}
}


/**
 * Display category image on category archive
 */
add_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_image', 2 );
function woocommerce_taxonomy_image() {
	
	
   
	$image = get_field('immagine_tag');
	
if( !empty( $image ) ){ ?>
    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />

<?php }
	

}
	



add_action( 'woocommerce_archive_description', 'woocommerce_category_custom_desc', 10 );

	
function woocommerce_category_custom_desc() {
	if (function_exists ( 'get_field' )){
		global $wp_query;
	    $cat = $wp_query->get_queried_object();
		
		
		
		
		
			 
			// the_field( "desc_cat" , $cat->taxonomy . '_' . $cat->term_id);
			
	
	}

		
	
}
