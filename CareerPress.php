<?php
/**
 * Career Press Class
 * @author: azeemmirza
 * @link: https://azeemirza.com/
 * @version 1.0
 * @license http://www.opensource.org/licenses/mit-license.html MIT License
 */

class CareerPress {
	function __construct() {
		/* Hook into the 'init' action so that the function
		* Containing our post type registration is not
		* unnecessarily executed.
		*/

		add_action( 'init', array($this,'custom_post_type'), 0 );
		add_action( 'init', array($this,'create_discog_taxonomies'), 0 );
		add_action('admin_menu', array($this, 'admin_view'));
	}
	/*
	* Creating a function to create our CPT
	*/

	function custom_post_type() {
		// Set UI labels for Custom Post Type
		$labels = array(
			'name'                => _x( 'Careers', 'Post Type General Name', 'career-press' ),
			'singular_name'       => _x( 'Career', 'Post Type Singular Name', 'career-press' ),
			'menu_name'           => __( 'Careers', 'career-press' ),
			'parent_item_colon'   => __( 'Parent Movie', 'career-press' ),
			'all_items'           => __( 'All Careers', 'career-press' ),
			'view_item'           => __( 'View Career', 'career-press' ),
			'add_new_item'        => __( 'Add New Career', 'career-press' ),
			'add_new'             => __( 'Add New', 'career-press' ),
			'edit_item'           => __( 'Edit Career', 'career-press' ),
			'update_item'         => __( 'Update Career', 'career-press' ),
			'search_items'        => __( 'Search Career', 'career-press' ),
			'not_found'           => __( 'Not Found', 'career-press' ),
			'not_found_in_trash'  => __( 'Not found in Trash', 'career-press' ),
		);
		// Set other options for Custom Post Type

		$args = array(
			'label'               => __( 'career', 'career-press' ),
			'description'         => __( 'Job Listing', 'career-press' ),
			'labels'              => $labels,
			// Features this CPT supports in Post Editor
			'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
			// You can associate this CPT with a taxonomy or custom taxonomy.
			'taxonomies'          => array( 'type' ),
			/* A hierarchical CPT is like Pages and can have
			* Parent and child items. A non-hierarchical CPT
			* is like Posts.
			*/
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 5,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'page',
			'menu_icon' => 'dashicons-universal-access'
		);

		// Registering your Custom Post Type
		register_post_type( 'careers', $args );


	}

	function admin_view(){
		add_submenu_page(
			'edit.php?post_type=careers',
			__('Career Settings ', 'careers'),
			__('Settings', 'careers'),
			'manage_options',
			'careers-settings',

			array($this,'sub_menu_view' ),
			10 );
	}
	function sub_menu_view(){
		echo 'Career Press Settings';
	}
	function create_discog_taxonomies()
	{
		// Add new taxonomy, make it hierarchical (like categories)
		$labels = array(
			'name' => _x( 'Field of Work', 'taxonomy general name' ),
			'singular_name' => _x( 'Type', 'taxonomy singular name' ),
			'search_items' =>  __( 'Search Types' ),
			'popular_items' => __( 'Popular Types' ),
			'all_items' => __( 'All Types' ),
			'parent_item' => __( 'Parent Types' ),
			'parent_item_colon' => __( 'Parent Type:' ),
			'edit_item' => __( 'Edit Type' ),
			'update_item' => __( 'Update Type' ),
			'add_new_item' => __( 'Add New Type' ),
			'new_item_name' => __( 'New Type Name' ),
		);
		register_taxonomy('recordings',array('careers'), array(
			'hierarchical' => true,
			'labels' => $labels,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'type' ),
		));
	}
}

$careerPress = new CareerPress();