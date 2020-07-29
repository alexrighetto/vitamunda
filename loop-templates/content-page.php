<?php
/**
 * Partial template for content in page.php
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<header class="entry-header">

		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

	</header><!-- .entry-header -->
	
	<figure class="full-width">
		
		<?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>
		
	</figure>
	
	<div class="container article-wrapper">

		<div class="row entry-content justify-content-md-center">
			<section class="article-col">
			<?php the_content(); ?>
			</section>
			<?php
			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'understrap' ),
					'after'  => '</div>',
				)
			);
			?>

		

		<footer class="article-col  entry-footer">

			<?php edit_post_link( __( 'Edit', 'understrap' ), '<span class="edit-link">', '</span>' ); ?>

		</footer><!-- .entry-footer -->
			</div><!-- .entry-content -->
	</div>
</article><!-- #post-## -->
