<?php

/*
	Plugin Name: Super Timeline 9000
	Description: A super timeline for your timelining needs!
	Version: 0.9
	Author: bodzaital
	Plugin URI: https://github.com/bodzaital/super-timeline-9000
	
*/

function register_timeline_type() {
	$labels = array(
		'name'               => 'Timelines',
		'singular_name'      => 'Timeline',
		'menu_name'          => 'Timelines',
		'name_admin_bar'     => 'Timeline',
		'add_new'            => 'Add New',
		'add_new_item'       => 'Add New Timeline',
		'new_item'           => 'New Timeline',
		'edit_item'          => 'Edit Timeline',
		'view_item'          => 'View Timeline',
		'all_items'          => 'All Timelines',
		'search_items'       => 'Search Timelines',
		'parent_item_colon'  => 'Parent Timeline',
		'not_found'          => 'No Timelines Found',
		'not_found_in_trash' => 'No Timelines Found in Trash'
	  );

	$args = array(
		'labels'              => $labels,
		'public'              => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'show_ui'             => true,
		'show_in_nav_menus'   => true,
		'show_in_menu'        => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-admin-appearance',
		'capability_type'     => 'post',
		'hierarchical'        => false,
		'supports'            => array('title'),
		'has_archive'         => true,
		'rewrite'             => array('slug' => 'timelines'),
		'query_var'           => true
	);

	register_post_type('super_timeline_9000', $args);

	wp_enqueue_style("style", plugins_url('style.css', __FILE__));
	wp_enqueue_script("script", plugins_url('/app.js', __FILE__), array(), false, true);

	add_shortcode('timeline-insert', 'register_timeline_shortcode');
}
add_action('init', 'register_timeline_type');

require_once('generator.php');
require_once('metabox.php');


?>