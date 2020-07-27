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

<div class="wrapper" id="full-width-page-wrapper">
	
	
	<header class="entry-header">

		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<?php if (class_exists('WD_ASP_Globals')){
				echo do_shortcode('[wpdreams_ajaxsearchpro id=1]'); 
			}
		?>

	</header><!-- .entry-header -->

	

	<div class="support-nav">
				<div class="<?php echo esc_attr( $container ); ?>" >

		<div class="row">

			<?php get_template_part( 'loop-templates/support', 'tab' ); ?>
			
		</div><!-- .row end -->

	</div><!-- #content -->
	</div><!-- #support-nav -->
						
	<div class="<?php echo esc_attr( $container ); ?>" >

		<div class="row">
	<?php
						while ( have_posts() ) {
							the_post();
							get_template_part( 'loop-templates/content', 'tab' );

							
						}
						?>
	</div><!-- .row end -->

	</div><!-- #content -->

</div><!-- #full-width-page-wrapper -->

<?php
get_footer();
