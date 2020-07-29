<?php
/**
 * The template for displaying all single posts
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
$container = get_theme_mod( 'understrap_container_type' );
?>

<div class="wrapper" id="single-wrapper">
	
	<header class="entry-header main-entry-header">

		<h2 class="entry-title">Glossario</h2>
		<?php if (class_exists('WD_ASP_Globals')){
				echo do_shortcode('[wpdreams_ajaxsearchpro id=3]'); 
			}
		?>

	</header><!-- .entry-header -->


	<div class="container article-wrapper" id="content" tabindex="-1">

		<div class="row entry-content justify-content-md-center">
		
			
<section class="article-col">
			<main class="site-main" id="main">
				<?php
				while ( have_posts() ) {
					the_post();
					get_template_part( 'loop-templates/content', 'encyclopedia' );
					//understrap_post_nav();

					
				}
				?>

			</main><!-- #main -->
</section>
			

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #single-wrapper -->

<?php
get_footer();
