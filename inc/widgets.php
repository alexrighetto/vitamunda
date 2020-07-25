<?php
/**
 * Declaring widgets
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Add filter to the parameters passed to a widget's display callback.
 * The filter is evaluated on both the front and the back end!
 *
 * @link https://developer.wordpress.org/reference/hooks/dynamic_sidebar_params/
 */
add_filter( 'dynamic_sidebar_params', 'understrap_widget_classes' );

if ( ! function_exists( 'understrap_widget_classes' ) ) {

	/**
	 * Count number of visible widgets in a sidebar and add classes to widgets accordingly,
	 * so widgets can be displayed one, two, three or four per row.
	 *
	 * @global array $sidebars_widgets
	 *
	 * @param array $params {
	 *     Parameters passed to a widget’s display callback.
	 *
	 *     @type array $args  {
	 *         An array of widget display arguments.
	 *
	 *         @type string $name          Name of the sidebar the widget is assigned to.
	 *         @type string $id            ID of the sidebar the widget is assigned to.
	 *         @type string $description   The sidebar description.
	 *         @type string $class         CSS class applied to the sidebar container.
	 *         @type string $before_widget HTML markup to prepend to each widget in the sidebar.
	 *         @type string $after_widget  HTML markup to append to each widget in the sidebar.
	 *         @type string $before_title  HTML markup to prepend to the widget title when displayed.
	 *         @type string $after_title   HTML markup to append to the widget title when displayed.
	 *         @type string $widget_id     ID of the widget.
	 *         @type string $widget_name   Name of the widget.
	 *     }
	 *     @type array $widget_args {
	 *         An array of multi-widget arguments.
	 *
	 *         @type int $number Number increment used for multiples of the same widget.
	 *     }
	 * }
	 * @return array $params
	 */
	function understrap_widget_classes( $params ) {

		global $sidebars_widgets;

		/*
		 * When the corresponding filter is evaluated on the front end
		 * this takes into account that there might have been made other changes.
		 */
		$sidebars_widgets_count = apply_filters( 'sidebars_widgets', $sidebars_widgets );

		// Only apply changes if sidebar ID is set and the widget's classes depend on the number of widgets in the sidebar.
		if ( isset( $params[0]['id'] ) && strpos( $params[0]['before_widget'], 'dynamic-classes' ) ) {
			$sidebar_id   = $params[0]['id'];
			$widget_count = count( $sidebars_widgets_count[ $sidebar_id ] );

			$widget_classes = 'widget-count-' . $widget_count;
			if ( 0 === $widget_count % 4 || $widget_count > 6 ) {
				// Four widgets per row if there are exactly four or more than six.
				$widget_classes .= ' col-md-3 col-sm-6 col-6';
			} elseif ( 6 === $widget_count ) {
				// If two widgets are published.
				$widget_classes .= ' col-md-2 col-sm-6 col-6';
			} elseif ( $widget_count >= 3 ) {
				// Three widgets per row if there's three or more widgets.
				$widget_classes .= ' col-md-4 col-4';
			} elseif ( 2 === $widget_count ) {
				// If two widgets are published.
				$widget_classes .= ' col-md-6 col-sm-6 col-6';
			} elseif ( 1 === $widget_count ) {
				// If just on widget is active.
				$widget_classes .= ' col-md-12';
			}

			// Replace the placeholder class 'dynamic-classes' with the classes stored in $widget_classes.
			$params[0]['before_widget'] = str_replace( 'dynamic-classes', $widget_classes, $params[0]['before_widget'] );
		}

		return $params;

	}
} // End of if function_exists( 'understrap_widget_classes' ).

add_action( 'widgets_init', 'understrap_widgets_init' );

if ( ! function_exists( 'understrap_widgets_init' ) ) {
	/**
	 * Initializes themes widgets.
	 */
	function understrap_widgets_init() {
		register_sidebar(
			array(
				'name'          => __( 'Right Sidebar', 'understrap' ),
				'id'            => 'right-sidebar',
				'description'   => __( 'Right sidebar widget area', 'understrap' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h4 class="widget-title">',
				'after_title'   => '</h4>',
			)
		);

		register_sidebar(
			array(
				'name'          => __( 'Left Sidebar', 'understrap' ),
				'id'            => 'left-sidebar',
				'description'   => __( 'Left sidebar widget area', 'understrap' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h4 class="widget-title">',
				'after_title'   => '</h4>',
			)
		);

		register_sidebar(
			array(
				'name'          => __( 'Hero Slider', 'understrap' ),
				'id'            => 'hero',
				'description'   => __( 'Hero slider area. Place two or more widgets here and they will slide!', 'understrap' ),
				'before_widget' => '<div class="carousel-item">',
				'after_widget'  => '</div>',
				'before_title'  => '',
				'after_title'   => '',
			)
		);

		register_sidebar(
			array(
				'name'          => __( 'Hero Canvas', 'understrap' ),
				'id'            => 'herocanvas',
				'description'   => __( 'Full size canvas hero area for Bootstrap and other custom HTML markup', 'understrap' ),
				'before_widget' => '',
				'after_widget'  => '',
				'before_title'  => '',
				'after_title'   => '',
			)
		);

		register_sidebar(
			array(
				'name'          => __( 'Top Full', 'understrap' ),
				'id'            => 'statichero',
				'description'   => __( 'Full top widget with dynamic grid', 'understrap' ),
				'before_widget' => '<div id="%1$s" class="static-hero-widget %2$s dynamic-classes">',
				'after_widget'  => '</div><!-- .static-hero-widget -->',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);

		register_sidebar(
			array(
				'name'          => __( 'Footer Full', 'understrap' ),
				'id'            => 'footerfull',
				'description'   => __( 'Full sized footer widget with dynamic grid', 'understrap' ),
				'before_widget' => '<div id="%1$s" class="footer-widget %2$s dynamic-classes">',
				'after_widget'  => '</div><!-- .footer-widget -->',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);
		
		register_sidebar(
			array(
				'name'          => __( 'Product Support', 'understrap' ),
				'id'            => 'productsupport',
				'description'   => __( 'widget for under the buy now button', 'understrap' ),
				'before_widget' => '<div id="%1$s" class="product-support-widget %2$s dynamic-classes">',
				'after_widget'  => '</div><!-- .product-support-widget -->',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);
		register_sidebar(
			array(
				'name'          => __( 'Video Product', 'understrap' ),
				'id'            => 'videoproduct',
				'description'   => __( 'Second widget for under the buy now button', 'understrap' ),
				'before_widget' => '<div id="%1$s" class="video-widget %2$s dynamic-classes">',
				'after_widget'  => '</div><!-- .video-widget -->',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);
		
		register_sidebar(
			array(
				'name'          => __( 'Header', 'understrap' ),
				'id'            => 'header',
				'description'   => __( 'Second widget for under the buy now button', 'understrap' ),
				'before_widget' => '<div id="%1$s" class="header-widget">',
				'after_widget'  => '</div><!-- .header-widget -->',
				'before_title'  => '<span class="widget-title">',
				'after_title'   => '</span>',
			)
		);
		
		register_sidebar(
			array(
				'name'          => __( 'Footer Left', 'understrap' ),
				'id'            => 'footer_left',
				'description'   => __( 'Second widget for under the buy now button', 'understrap' ),
				'before_widget' => '<div id="%1$s" class="footer-left-widget">',
				'after_widget'  => '</div><!-- .header-widget -->',
				'before_title'  => '<h5 class="widget-title">',
				'after_title'   => '</h5>',
			)
		);
		
		register_sidebar(
			array(
				'name'          => __( 'Footer Right', 'understrap' ),
				'id'            => 'footer_right',
				'description'   => __( 'Second widget for under the buy now button', 'understrap' ),
				'before_widget' => '<div id="%1$s" class="footer-right-widget">',
				'after_widget'  => '</div><!-- .header-widget -->',
				'before_title'  => '<h5 class="widget-title">',
				'after_title'   => '</h5>',
			)
		);

	}
} // End of function_exists( 'understrap_widgets_init' ).




// Creating the widget 
class axl_product_widget extends WP_Widget {
  
function __construct() {
parent::__construct(
  
// Base ID of your widget
'axl_product_widget', 
  
// Widget name will appear in UI
__('Product images Widget', 'understrap'), 
  
// Widget description
array( 'description' => __( 'Sample widget based on WPBeginner Tutorial', 'understrap' ), ) 
);
}
  
// Creating widget front-end
  
public function widget( $args, $instance ) {
	
	$title = apply_filters( 'widget_title', $instance['title'] );

	// before and after widget arguments are defined by themes
	echo $args['before_widget'];
	
	if ( ! empty( $title ) )
	echo $args['before_title'] . $title . $args['after_title'];
	if (  class_exists( 'Mega_Menu' ) ) {
		// query all the product
		add_action( 'wp_footer',array( $this, 'render_images' ) );

		echo'<a href="#"><img class="target" src="" /></a>';
	}
	echo $args['after_widget'];
	
	
	
}
	
public function render_images(  ) {	
	if (  class_exists( 'Mega_Menu' ) ) {
	$args = array(
    	'post_type' => 'product',
		'posts_per_page' => -1
	);
	// the query
	$query = new WP_Query( $args );

	// The Loop
	if ( $query->have_posts() ) : 
	
	?> <div class="images-group" style="display:none"> <?php
		while ( $query->have_posts() ) :
		 $query->the_post() ;
	
		 /* grab the url for the full size featured image */
        $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'post-thumbnail');
		
		if($featured_img_url){
		?>
		
		<img loading="lazy" class="" alt="<?php echo get_permalink(); ?>" src="<?php echo esc_url($featured_img_url) ?>" />
		
		<?php
		}	
	endwhile ; 
	?> </div> <?php
	endif;
	/* Restore original Post Data */
	wp_reset_postdata();
	
	}
}
          
// Widget Backend 
public function form( $instance ) {
	if ( isset( $instance[ 'title' ] ) ) {
	$title = $instance[ 'title' ];
	}
	else {
	$title = __( 'New title', 'understrap' );
	}
	// Widget admin form
	?>
	<p>
	<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
	<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
	</p>
	<?php 
}
      
// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
$instance = array();
$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
return $instance;
}
 
// Class axl_product_widget ends here
} 
 
 
// Register and load the widget
function wpb_load_widget() {
    register_widget( 'axl_product_widget' );
}
add_action( 'widgets_init', 'wpb_load_widget' );