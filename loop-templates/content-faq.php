<?php
/**
 * Single post partial template
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
<?php echo do_shortcode('[wpdreams_ajaxsearchpro_results id=3 element="div"]'); ?>
	<header class="entry-header">

		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		
	


	</header><!-- .entry-header -->

	<?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>

	<div class="entry-content">
		<?php 
		if ( function_exists('yoast_breadcrumb') ) {
		  yoast_breadcrumb( '<nav id="breadcrumbs" class="woocommerce-breadcrumb">','</nav>' );
		}
		?>

		<?php the_content(); ?>

		

	</div><!-- .entry-content -->

	<footer class="entry-footer">

		<?php //understrap_entry_footer(); ?>

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
