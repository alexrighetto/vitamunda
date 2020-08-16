<?php
/**
 * Variable product add to cart
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.4.1
 *
 * Modified to use radio buttons instead of dropdowns
 * @author 8manos
 */

defined( 'ABSPATH' ) || exit;

global $product;
global $woocommerce;








$attribute_keys = array_keys( $attributes );

do_action( 'woocommerce_before_add_to_cart_form' ); ?>

<form class="variations_form cart" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $product->get_id() ); ?>" data-product_variations="<?php echo htmlspecialchars( wp_json_encode( $available_variations ) ) ?>">
	<?php do_action( 'woocommerce_before_variations_form' ); ?>

	<?php if ( empty( $available_variations ) && false !== $available_variations ) : ?>
		<p class="stock out-of-stock"><?php esc_html_e( 'This product is currently out of stock and unavailable.', 'woocommerce' ); ?></p>
	<?php else : ?>
		<div class="variations product_switcher_container">
			
				<?php foreach ( $attributes as $name => $options ) : ?>
					<?php $sanitized_name = sanitize_title( $name ); ?>
					<div class="attribute-<?php echo esc_attr( $sanitized_name ); ?> product_variation_wrapper">
						<div class="label"><label for="<?php echo esc_attr( $sanitized_name ); ?>"><?php echo wc_attribute_label( $name ); ?></label></div>
						<?php
						if ( isset( $_REQUEST[ 'attribute_' . $sanitized_name ] ) ) {
							$checked_value = $_REQUEST[ 'attribute_' . $sanitized_name ];
						} elseif ( isset( $selected_attributes[ $sanitized_name ] ) ) {
							$checked_value = $selected_attributes[ $sanitized_name ];
						} else {
							$checked_value = '';
						}
						?>
						<div class="value">
							<?php
							if ( ! empty( $options ) ) {
								if ( taxonomy_exists( $name ) ) {
									// Get terms if this is a taxonomy - ordered. We need the names too.
									$terms = wc_get_product_terms( $product->get_id(), $name, array( 'fields' => 'all' ) );
									
									foreach ( $terms as $key=>$term ) {
										if ( ! in_array( $term->slug, $options ) ) {
											continue;
										}
										$product_variations = $product->get_available_variations();
										
										$variation_product_id = $product_variations [$key]['variation_id'];
										$variation_description = $product_variations [$key]['variation_description'];
										$variation_offer = $product_variations [$key]['_offer_text'];
										$variation_url = $product_variations [$key]['image']['url'];
										$variation_alt = $product_variations [$key]['image']['alt'];
										$product_price = get_product_variation_price($variation_product_id);
										
										echo '<label class="variation-item-wrapper">';
										echo '<div class="' . axl_is_bumped($product_variations,$key) .   ' media p-2 mt-2 variation-item variation-'.$term->slug.' ' .$term->slug .' ">';
										print_attribute_radio_nopic( $checked_value, $term->slug, $term->name, $sanitized_name );
										
										echo '<img class="align-self-center border product_image_variation ml-3 mr-3" height="50" width="50" alt="' . $variation_alt . '" src="' . $variation_url . '" />';
										echo '<div class="media-body">';
										echo '<span class="badge badge-pill badge-danger">' . $variation_offer . '</span>';
                                        echo '<h5 class="mt-0">' . $product->get_name()  . ': ' . $term->name . '</h5>'; 
                                        //printf ('%1$s ', $product_price);
										echo $variation_description;
										echo $product_price;
										
										echo '</div>';
										
										echo '</div>';
										echo '</label>';
									}
									
									
								} else {
									foreach ( $options as $key=>$option ) {
                                        print_attribute_radio2( $checked_value, $option, $option, $sanitized_name );
                                        $product_variations = $product->get_available_variations();
                                        $variation_product_id = $product_variations [$key]['variation_id'];
                                        $product_price = get_product_variation_price($variation_product_id);
                                        printf ('%1$s</div> ', $product_price);
                                    }
								}
								
							}

							echo end( $attribute_keys ) === $name ? wp_kses_post( apply_filters( 'woocommerce_reset_variations_link', '<a class="reset_variations" href="#">' . esc_html__( 'Clear', 'woocommerce' ) . '</a>' ) ) : '';
							?>
						</div>
					</div>
				<?php endforeach; ?>
			
		</div>

		<?php
			if ( version_compare($woocommerce->version, '3.4.0') < 0 ) {
				do_action( 'woocommerce_before_add_to_cart_button' );
			}
		?>

		<div class="single_variation_wrap">
			<?php
				do_action( 'woocommerce_before_single_variation' );
				do_action( 'woocommerce_single_variation' );
				do_action( 'woocommerce_after_single_variation' );
			?>
		</div>

		<?php
			if ( version_compare($woocommerce->version, '3.4.0') < 0 ) {
				do_action( 'woocommerce_after_add_to_cart_button' );
			}
		?>
	<?php endif; ?>

	<?php do_action( 'woocommerce_after_variations_form' ); ?>
</form>

<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>
