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
	
	<header class="entry-header main-entry-header bg_supporto">

		<h2 class="entry-title"><?php echo get_the_title(245 ); ?></h2>
		<?php if (class_exists('WD_ASP_Globals')){
				echo do_shortcode('[wpdreams_ajaxsearchpro id=1]'); 
			}
		?>

	</header><!-- .entry-header -->
<div class="article-wrapper bg_grey">
	<div class="container " id="content" tabindex="-1">

		<div class="row entry-content justify-content-md-center">
		
			
<section class="article-col">
			<main class="site-main" id="main">

				<?php
				while ( have_posts() ) {
					the_post();
					get_template_part( 'loop-templates/content', 'faq' );
					
					
				}
				?>

			</main><!-- #main -->
</section>
			

		</div><!-- .row -->

	</div><!-- #content -->
	</div>

</div><!-- #single-wrapper -->

<?php
get_footer();
