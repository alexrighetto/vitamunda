<?php
/**
 * The template for displaying archive pages
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

$container = get_theme_mod( 'understrap_container_type' );
?>

<div class="wrapper" id="archive-wrapper">
	
	<header class="main-entry-header">

		<?php the_archive_title( '<h2 class="page-title">', '</h2>' ); ?>
		<?php if (class_exists('WD_ASP_Globals')){
				echo do_shortcode('[wpdreams_ajaxsearchpro id=3]'); 
			}
		?>
		<?php the_archive_description( '<div class="taxonomy-description">', '</div>' ); ?>

	</header><!-- .entry-header -->

	<div class="container article-wrapper" id="content" tabindex="-1">

		<div class="row entry-content justify-content-md-center"

			
<section class="article-col">
			<main class="site-main" id="main">
				
				
				
				

			</main><!-- #main -->

		</section>		

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #archive-wrapper -->

<?php
get_footer();
