<?php
/**
 * Create WP Sunday Sermons custom post type.
 *
 * @since 0.9.0
 */
add_action( 'init', 'wp_sunday_sermons_post_type', 0 );
function wp_sunday_sermons_post_type() {

	$labels = array(
		'name'                => __( 'Sermons', 'wp-sunday' ),
		'singular_name'       => __( 'Sermon', 'wp-sunday' ),
		'menu_name'           => __( 'Sermons', 'wp-sunday' ),
		'parent_item_colon'   => __( 'Sermons:', 'wp-sunday' ),
	    'all_items'           => __( 'All Sermons', 'wp-sunday' ),
    	'view_item'           => __( 'View Sermon', 'wp-sunday' ),
    	'add_new_item'        => __( 'Add New Sermon', 'wp-sunday' ),
    	'add_new'             => __( 'Add New', 'wp-sunday' ),
    	'edit_item'           => __( 'Edit Sermon', 'wp-sunday' ),
    	'update_item'         => __( 'Update Sermon', 'wp-sunday' ),
    	'search_items'        => __( 'Search Sermons', 'wp-sunday' ),
    	'not_found'           => __( 'Not found', 'wp-sunday' ),
    	'not_found_in_trash'  => __( 'Not found in Trash', 'wp-sunday' ),
	);

	$args = array(
		'label'               => __( 'sermons', 'wp-sunday' ),
		'description'         => __( 'Sermons Description', 'wp-sunday' ),
    	'labels'              => $labels,
    	'hierarchical'        => false,
    	'public'              => true,
    	'show_ui'             => true,
    	'show_in_menu'        => true,
    	'show_in_nav_menus'   => false,
    	'show_in_admin_bar'   => true,
    	'menu_position'       => 22,
    	'menu_icon'           => 'dashicons-media-document',
    	'can_export'          => true,
    	'has_archive'         => true,
    	'exclude_from_search' => false,
    	'publicly_queryable'  => true,
    	'capability_type'     => 'post',
    	'rewrite'             => array( 'slug' => 'sermon' ),
    	'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'comments', 'genesis-seo', 'genesis-scripts' ),
	);

	register_post_type( 'wp_sunday_sermons', $args );
}

/**
 * Add Sermon Series taxonomy to the WP Sunday Sermons post type.
 *
 * @since 0.9.0
 */
add_action( 'init', 'wp_sunday_sermons_taxonomies', 0 );
function wp_sunday_sermons_taxonomies() {

	$labels = array(
		'name'                => __( 'Sermon Series' ),
		'singular_name'       => __( 'Sermon Series' ),
    	'search_items'        => __( 'Search Sermon Series' ),
    	'all_items'           => __( 'All Sermon Series' ),
    	'parent_item'         => __( 'Parent Sermon Series' ),
    	'parent_item_colon'   => __( 'Parent Sermon Series:' ),
    	'edit_item'           => __( 'Edit Sermon Series' ), 
    	'update_item'         => __( 'Update Sermon Series' ),
    	'add_new_item'        => __( 'Add New Sermon Series' ),
    	'new_item_name'       => __( 'New Sermon Series' ),
    	'menu_name'           => __( 'Sermon Series' ),
	);

	$args = array(
		'labels'              => $labels,
		'hierarchical'        => true,
    	'show_admin_column'   => true,
    	'rewrite'             => array( 'slug' => 'sermon-series' ),
	);

	register_taxonomy( 'wp_sunday_sermon_series', array( 'wp_sunday_sermons' ), $args );

}

/**
 * Create custom meta box for WP Sunday Sermons post type.
 *
 * @since 0.9.2
 */
add_action( 'add_meta_boxes', 'wp_sunday_sermons_meta_boxes' );
function wp_sunday_sermons_meta_boxes() {

	add_meta_box(
		'wp_sunday_sermons_box',
		__( 'WP Sunday Sermons Settings', 'wp-sunday' ),
		'wp_sunday_sermons_box',
		'wp_sunday_sermons',
		'normal',
		'high' );

}

/**
 * Callback for WP Sunday Sermons meta box.
 *
 * @since 0.9.2
 *
 * @uses genesis_get_custom_field() Get custom field value.
 */
function wp_sunday_sermons_box() {

	wp_nonce_field( plugin_basename( __FILE__ ), 'wp_sunday_sermons_content_box_nonce' );
	?>

	<table class="form-table">
	<tbody>

		<tr valign="top">
			<th scope="row"><label for="_wp_sunday_sermon_speaker"><?php _e( 'Sermon Speaker', 'wp-sunday' ); ?></label></th>
			<td>
				<p><input class="large-text" type="text" name="_wp_sunday_sermon_speaker" id="_wp_sunday_sermon_speaker" value="<?php echo esc_attr( genesis_get_custom_field( '_wp_sunday_sermon_speaker' ) ); ?>" /></p>
				<p><span class="description"><?php _e( 'Enter the name of the speaker for this sermon. Example: Teaching Pastor', 'wp-sunday' ); ?></span></p>
			</td>
		</tr>
		<tr valign="top">
			<th scope="row"><label for="_wp_sunday_sermon_vimeo_id"><?php _e( 'Sermon Vimeo ID Number', 'wp-sunday' ); ?></label></th>
			<td>
				<p><input class="large-text" type="text" name="_wp_sunday_sermon_vimeo_id" id="_wp_sunday_sermon_vimeo_id" value="<?php echo esc_attr( genesis_get_custom_field( '_wp_sunday_sermon_vimeo_id' ) ); ?>" /></p>
				<p><span class="description"><?php _e( 'Upload the sermon video to your church\'s Vimeo account. Then, enter the unique Vimeo ID number of this sermon. Example: 162529649', 'wp-sunday' ); ?></span></p>
			</td>
		</tr>
		<tr valign="top">
			<th scope="row"><label for="_wp_sunday_sermon_youtube_id"><?php _e( 'Sermon YouTube ID Number', 'wp-sunday' ); ?></label></th>
			<td>
				<p><input class="large-text" type="text" name="_wp_sunday_sermon_youtube_id" id="_wp_sunday_sermon_youtube_id" value="<?php echo esc_attr( genesis_get_custom_field( '_wp_sunday_sermon_youtube_id' ) ); ?>" /></p>
				<p><span class="description"><?php _e( 'Upload the sermon video to your church\'s YouTube account. Then, enter the unique YouTube ID number of this sermon. Example: ATRHESdWyvA', 'wp-sunday' ); ?></span></p>
			</td>
		</tr>
		<tr valign="top">
			<th scope="row"><label for="_wp_sunday_sermon_audio"><?php _e( 'Sermon Audio URL', 'wp-sunday' ); ?></label></th>
			<td>
				<p><input class="large-text" type="text" name="_wp_sunday_sermon_audio" id="_wp_sunday_sermon_audio" value="<?php echo esc_attr( genesis_get_custom_field( '_wp_sunday_sermon_audio' ) ); ?>" /></p>
				<p><span class="description"><?php _e( 'Upload the sermon audio file by clicking on "Add Media" above. Then, copy and paste the full URL of the mp3. Example: http://www.yourdomain.com/wp-content/uploads/2016/01/15/your-sermon-audio.mp3', 'wp-sunday' ); ?></span></p>
			</td>
		</tr>
		<tr valign="top">
			<th scope="row"><label for="_wp_sunday_sermon_notes"><?php _e( 'Sermon Notes URL', 'wp-sunday' ); ?></label></th>
			<td>
				<p><input class="large-text" type="text" name="_wp_sunday_sermon_notes" id="_wp_sunday_sermon_notes" value="<?php echo esc_attr( genesis_get_custom_field( '_wp_sunday_sermon_notes' ) ); ?>" /></p>
				<p><span class="description"><?php _e( 'Upload the sermon notes PDF file by clicking on "Add Media" above. Then, copy and paste the full URL of the PDF. Example: http://www.yourdomain.com/wp-content/uploads/2016/01/15/your-sermon-notes.pdf', 'wp-sunday' ); ?></span></p>
			</td>
		</tr>

	</tbody>
	</table>
	<?php

}

/**
 * Save custom meta box content for WP Sunday Sermons post type.
 *
 * @since 0.9.2
 */
add_action( 'save_post', 'wp_sunday_sermons_content_box_save' );
function wp_sunday_sermons_content_box_save( $post_id ) {

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
		return;

	if (
		!isset( $_POST['wp_sunday_sermons_content_box_nonce'] )
		|| !wp_verify_nonce( $_POST['wp_sunday_sermons_content_box_nonce'], plugin_basename( __FILE__ ) ) )
	return;

	if ( 'page' == $_POST['post_type'] ) {
		if ( !current_user_can( 'edit_page', $post_id ) )
		return;
	} else {
		if ( !current_user_can( 'edit_post', $post_id ) )
		return;
	}

	$sermon_speaker = sanitize_text_field( $_POST['_wp_sunday_sermon_speaker'] );
	$sermon_vimeo = sanitize_text_field( $_POST['_wp_sunday_sermon_vimeo_id'] );
	$sermon_youtube = sanitize_text_field( $_POST['_wp_sunday_sermon_youtube_id'] );
	$sermon_audio = sanitize_text_field( $_POST['_wp_sunday_sermon_audio'] );
	$sermon_notes = sanitize_text_field( $_POST['_wp_sunday_sermon_notes'] );

	update_post_meta( $post_id, '_wp_sunday_sermon_speaker', $sermon_speaker );
	update_post_meta( $post_id, '_wp_sunday_sermon_vimeo_id', $sermon_vimeo );
	update_post_meta( $post_id, '_wp_sunday_sermon_youtube_id', $sermon_youtube );
	update_post_meta( $post_id, '_wp_sunday_sermon_audio', $sermon_audio );
	update_post_meta( $post_id, '_wp_sunday_sermon_notes', $sermon_notes );

}