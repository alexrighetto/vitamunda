<?php
// Register Custom Post Type
function axl_custom_post_type() {

	$labels = array(
		'name'                  => _x( 'Theme parts', 'Post Type General Name', 'understrap' ),
		'singular_name'         => _x( 'Theme part', 'Post Type Singular Name', 'understrap' ),
		'menu_name'             => __( 'Theme part', 'understrap' ),
		'name_admin_bar'        => __( 'Theme part', 'understrap' ),
		'archives'              => __( 'Item Archives', 'understrap' ),
		'attributes'            => __( 'Item Attributes', 'understrap' ),
		'parent_item_colon'     => __( 'Parent Item:', 'understrap' ),
		'all_items'             => __( 'All Items', 'understrap' ),
		'add_new_item'          => __( 'Add New Item', 'understrap' ),
		'add_new'               => __( 'Add New Part', 'understrap' ),
		'new_item'              => __( 'New part', 'understrap' ),
		'edit_item'             => __( 'Edit part', 'understrap' ),
		'update_item'           => __( 'Update part', 'understrap' ),
		'view_item'             => __( 'View theme part', 'understrap' ),
		'view_items'            => __( 'View parts', 'understrap' ),
		'search_items'          => __( 'Search Item', 'understrap' ),
		'not_found'             => __( 'Not found', 'understrap' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'understrap' ),
		'featured_image'        => __( 'Featured Image', 'understrap' ),
		'set_featured_image'    => __( 'Set featured image', 'understrap' ),
		'remove_featured_image' => __( 'Remove featured image', 'understrap' ),
		'use_featured_image'    => __( 'Use as featured image', 'understrap' ),
		'insert_into_item'      => __( 'Insert into item', 'understrap' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'understrap' ),
		'items_list'            => __( 'Items list', 'understrap' ),
		'items_list_navigation' => __( 'Items list navigation', 'understrap' ),
		'filter_items_list'     => __( 'Filter items list', 'understrap' ),
	);
	$args = array(
		'label'                 => __( 'Theme part', 'understrap' ),
		'description'           => __( 'Post Type Description', 'understrap' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor' ),
		'taxonomies'            => array( 'category', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => true,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'theme_part', $args );

}
add_action( 'init', 'axl_custom_post_type', 0 );