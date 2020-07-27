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

	<header class="entry-header">

		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		
		<a href="<?php echo esc_url( get_permalink( get_page_by_title( 'Supporto' ) ) ); ?>">Torna alle Domande Frequenti</a>


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

		<?php understrap_entry_footer(); ?>

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
