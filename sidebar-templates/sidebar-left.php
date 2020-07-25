<?php
/**
 * The sidebar containing the main widget area
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! is_active_sidebar( 'left-sidebar' ) ) {
	return;
}

// when both sidebars turned on reduce col size to 3 from 4.
$sidebar_pos = get_theme_mod( 'understrap_sidebar_position' );
?>

<?php if ( 'both' === $sidebar_pos ) : ?>
	<div class="col-md-2 d-none d-md-block d-xl-block widget-area" id="left-sidebar" role="complementary">
		<div class="sidebar__outer">
		
<?php else : ?>
	<div class="col-md-3 d-none d-md-block d-xl-block widget-area" id="left-sidebar" role="complementary">
		<div class="sidebar__outer">
		
<?php endif; ?>
<?php dynamic_sidebar( 'left-sidebar' ); ?>

	</div>	
</div><!-- #left-sidebar -->
