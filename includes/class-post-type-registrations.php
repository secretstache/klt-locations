<?php
/**
 * KLT Locations
 *
 * @package   KLT_Locations
 * @license   GPL-2.0+
 */

/**
 * Register post types and taxonomies.
 *
 * @package KLT_Locations
 */
class KLT_Locations_Registrations {

	public $post_type = 'location';

	public $taxonomies = array( 'location-type' );

	public function init() {
		// Add the KLT Locations and taxonomies
		add_action( 'init', array( $this, 'register' ) );
	}

	/**
	 * Initiate registrations of post type and taxonomies.
	 *
	 * @uses KLT_Locations_Registrations::register_post_type()
	 * @uses KLT_Locations_Registrations::register_taxonomy_category()
	 */
	public function register() {
		$this->register_post_type();
		$this->register_location_tax();
	}

	/**
	 * Register the custom post type.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/register_post_type
	 */
	protected function register_post_type() {
		$labels = array(
			'name'               => __( 'Locations', 'klt-locations' ),
			'singular_name'      => __( 'Location', 'klt-locations' ),
			'add_new'            => __( 'Add Location', 'klt-locations' ),
			'add_new_item'       => __( 'Add Location', 'klt-locations' ),
			'edit_item'          => __( 'Edit Location', 'klt-locations' ),
			'new_item'           => __( 'New Location', 'klt-locations' ),
			'view_item'          => __( 'View Location', 'klt-locations' ),
			'search_items'       => __( 'Search Locations', 'klt-locations' ),
			'not_found'          => __( 'No locations found', 'klt-locations' ),
			'not_found_in_trash' => __( 'No locations in the trash', 'klt-locations' ),
		);

		$supports = array(
			'title'
		);

		$args = array(
			'labels'          => $labels,
			'supports'        => $supports,
			'public'          => true,
			'capability_type' => 'page',
			'rewrite'         => array( 'slug' => 'location', ),
			'has_archive'			=> 'locations',
			'menu_position'   => 30,
			'menu_icon'       => 'dashicons-admin-page',
		);

		$args = apply_filters( 'KLT_Locations_Args', $args );

		register_post_type( $this->post_type, $args );
	}

	/**
	 * Register a taxonomy for Project Categories.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/register_taxonomy
	 */
	protected function register_location_tax() {
		$labels = array(
			'name'                       => __( 'Location Types', 'klt-locations' ),
			'singular_name'              => __( 'Location Type', 'klt-locations' ),
			'menu_name'                  => __( 'Location Types', 'klt-locations' ),
			'edit_item'                  => __( 'Edit Location Type', 'klt-locations' ),
			'update_item'                => __( 'Update Location Type', 'klt-locations' ),
			'add_new_item'               => __( 'Add New Location Type', 'klt-locations' ),
			'new_item_name'              => __( 'New Location Type Name', 'klt-locations' ),
			'parent_item'                => __( 'Parent Location Type', 'klt-locations' ),
			'parent_item_colon'          => __( 'Parent Location Type:', 'klt-locations' ),
			'all_items'                  => __( 'All Location Types', 'klt-locations' ),
			'search_items'               => __( 'Search Location Types', 'klt-locations' ),
			'popular_items'              => __( 'Popular Location Types', 'klt-locations' ),
			'separate_items_with_commas' => __( 'Separate location types with commas', 'klt-locations' ),
			'add_or_remove_items'        => __( 'Add or remove location types', 'klt-locations' ),
			'choose_from_most_used'      => __( 'Choose from the most used location types', 'klt-locations' ),
			'not_found'                  => __( 'No location types found.', 'klt-locations' ),
		);

		$args = array(
			'labels'            => $labels,
			'public'            => true,
			'show_in_nav_menus' => true,
			'show_ui'           => true,
			'show_tagcloud'     => true,
			'hierarchical'      => true,
			'rewrite'           => array( 'slug' => 'location-type' ),
			'show_admin_column' => true,
			'query_var'         => true,
		);

		$args = apply_filters( 'KLT_Locations_Location_Type_Args', $args );

		register_taxonomy( $this->taxonomies[0], $this->post_type, $args );
	}
}