<?php
/**
 * Sidebar setup for footer full
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$container = get_theme_mod( 'understrap_container_type' );

?>

<?php if ( is_active_sidebar( 'footerfull' ) ) : ?>

	<!-- ******************* The Footer Full-width Widget Area ******************* -->

	<footer class="widgets-wrapper" >

		<div class="<?php echo esc_attr( $container ); ?>" >

			<div class="row">

				<?php dynamic_sidebar( 'footerfull' ); ?>

			</div>

		</div>

	</footer><!-- #wrapper-footer-full -->

	<?php
endif;
