<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$container = get_theme_mod( 'understrap_container_type' );
?>



<div class="" id="wrapper-footer">
	
	<?php get_template_part( 'sidebar-templates/sidebar', 'footerfull' ); ?>

	<footer class="site-footer" id="colophon">
		
		<div class="<?php echo esc_attr( $container ); ?>">
			<div class="row">
				<div class="col-md-6">
					<div class="mailing-list">
						<?php  dynamic_sidebar( 'footer-left' ); ?>
					</div><!-- .site-info -->
				</div><!--col end -->
				<div class="col-md-6">
					<div class="site-info">
						<?php  dynamic_sidebar( 'footer-right' ); ?>
					</div><!-- .site-info -->
				</div><!--col end -->
			</div><!-- row end -->
		</div><!-- container end -->
	</footer><!-- #colophon -->	

</div><!-- wrapper end -->

</div><!-- #page we need this extra closing tag here -->

<?php wp_footer(); ?>

</body>

</html>

