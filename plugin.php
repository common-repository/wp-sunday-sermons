<?php
/*
Plugin Name: WP Sunday - Sermons
Plugin URI:  http://www.wpsunday.com/plugins/wp-sunday-sermons/
Description: Displays featured sermons in WP Sunday child themes.
Version:     1.0.3
Author:      WP Sunday
Author URI:  http://www.wpsunday.com/
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: wp-sunday
*/

include 'wp-sunday-sermons-post-type.php';
include 'class-wp-sunday-sermons.php';

/**
 * Flush the permalinks to make WP Sunday Sermons custom post type
 * and sermon series custom taxonomy URLs work.
 *
 * @since 0.9.0
 */
function wp_sunday_sermons_activate() {
	wp_sunday_sermons_post_type();
	wp_sunday_sermons_taxonomies();
	flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'wp_sunday_sermons_activate' );

/**
 * Register widget.
 *
 * @since 0.9.0
 */
add_action( 'widgets_init', 'wp_sunday_sermons_load_widgets' );
function wp_sunday_sermons_load_widgets() {
	register_widget( 'WP_Sunday_Featured_Sermons' );
}