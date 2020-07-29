<?php
/**
 * Template Name: Support
 *
 * Template for displaying a page without sidebar even if a sidebar widget is published.
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
$container = get_theme_mod( 'understrap_container_type' );

?>


	
	<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
		
	<header class="entry-header">

		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<?php if (class_exists('WD_ASP_Globals')){
				echo do_shortcode('[wpdreams_ajaxsearchpro id=1]'); 
			}
		?>

	</header><!-- .entry-header -->

	
<div class="container article-wrapper">

		<div class="row entry-content justify-content-md-center">
			<section class="article-col">
				
	

			<?php get_template_part( 'loop-templates/support', 'tab' ); ?>
			
		
	</div><!-- .entry-content -->
	</div>
</article><!-- #post-## -->

		
		
	<div class="container article-wrapper">

		<div class="row entry-content justify-content-md-center">
			<section class="article-col">
				
					<?php
						while ( have_posts() ) {
							the_post();
							get_template_part( 'loop-templates/content', 'tab' );

							
						}
						?>

			</div><!-- .entry-content -->
	</div>
</article><!-- #post-## -->

<?php
get_footer();
