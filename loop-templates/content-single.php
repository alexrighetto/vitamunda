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
			
			<div class="entry-meta">
				<?php understrap_posted_on(); ?>
			</div><!-- .entry-meta -->

	</header><!-- .entry-header -->
	
		<figure class="full-width">
		<?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>
		</figure>
	
	
	<div class="container article-wrapper">
		<div class="row entry-content justify-content-md-center">
			<section class="article-col">
			<?php
			if ( function_exists('yoast_breadcrumb') ) {
			  yoast_breadcrumb( '<nav id="breadcrumbs" aria-label="breadcrumb" class="woocommerce-breadcrumb">','</nav>' );
			}
			?>
			
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

		
	
			<footer class="article-col entry-footer">

				<?php understrap_entry_footer(); ?>

			</footer><!-- .entry-footer -->
		</div>
	</div>
</article><!-- #post-## -->

<section class="container">
					<div class="row entry-content justify-content-md-center">
		
						<div class="article-col">
				
					<?php
					understrap_post_nav();

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) {
						comments_template();
						
						
					}?>
						</div>
					</div><!-- .entry-content -->
</section>
