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

		// Add Bootstrap classes to form fields.
		add_filter( 'woocommerce_form_field_args', 'understrap_wc_form_field_args', 10, 3 );
	}
}

// First unhook the WooCommerce content wrappers.
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

// Then hook in your own functions to display the wrappers your theme requires.
add_action( 'woocommerce_before_main_content', 'understrap_woocommerce_wrapper_start', 10 );
add_action( 'woocommerce_after_single_product_summary', 'understrap_woocommerce_wrapper_middle', 9 );
add_action( 'woocommerce_after_main_content', 'understrap_woocommerce_wrapper_end', 10 );

	
if ( ! function_exists( 'understrap_woocommerce_wrapper_start' ) ) {
	/**
	 * Display the theme specific start of the page wrapper.
	 */
	function understrap_woocommerce_wrapper_start() {
		$container = get_theme_mod( 'understrap_container_type' );
		echo '<div class="wrapper" id="woocommerce-wrapper">';
			echo '<div class="product-top-wrapper">';
			echo '<div class="' . esc_attr( $container ) . '" id="content" tabindex="-1">';
			echo '<div class="row">';
			get_template_part( 'global-templates/left-sidebar-check' );
			echo '<main class="site-main" id="main">';
	}
}

function understrap_woocommerce_wrapper_middle() {
			echo '</main><!-- #main -->';
			echo '</div><!-- .row -->';
			echo '</div><!-- Container end -->';
			echo '</div><!-- .product-top-wrapper -->';
			echo '</div><!-- .product-top-wrapper -->';
	
		
			echo '<div class="product-bottom-wrapper" >';
			//echo '<div class="' . esc_attr( $container ) . '"  tabindex="-1">';
			//echo '<div class="row">';
	
}


if ( ! function_exists( 'understrap_woocommerce_wrapper_end' ) ) {
	/**
	 * Display the theme specific end of the page wrapper.
	 */
	function understrap_woocommerce_wrapper_end() {
			echo '</div><!-- .product-bottom-wrapper -->';
			get_template_part( 'global-templates/right-sidebar-check' );
			//echo '</div><!-- .row -->';
			//echo '</div><!-- Container end -->';
			echo '</div><!-- Wrapper end -->';
		
	}
}

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

