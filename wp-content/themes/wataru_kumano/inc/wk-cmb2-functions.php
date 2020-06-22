<?php
/**
 * Include and setup custom metaboxes and fields. (make sure you copy this file to outside the CMB2 directory)
 *
 * Be sure to replace all instances of 'yourprefix_' with your project's prefix.
 * http://nacin.com/2010/05/11/in-wordpress-prefix-everything/
 *
 * @category wataru_kumano theme
 * @package  wataru_kumano
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/CMB2/CMB2
 */


/** WK CMB2 Functions Inventory
 *  
 * wk_project_images
 * wk_profile_fields
 *  
 */



/*
* [group] Group Field
* [file_list] Project Images
* [select] Image Size Selection
*/
add_action( 'cmb2_admin_init', 'wk_project_images' );

function wk_project_images() {
	
	$prefix = 'wk_';
	
	$wk_metabox = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => esc_html__( 'Project Data', wk_get_theme_text_domain() ),
		'object_types'  => array( 'post' ), // Post type
	) );
	
	// GROUP FIELD
	$project_group = $wk_metabox->add_field( array(
		'id'          => $prefix . 'group',
		'type'        => 'group',
		// 'repeatable'  => false, // use false if you want non-repeatable group
		'options'     => array(
			'group_title'       => __( 'Image {#}', wk_get_theme_text_domain() ), // since version 1.1.4, {#} gets replaced by row number
			'add_button'        => __( 'Add Another Image', wk_get_theme_text_domain() ),
			'remove_button'     => __( 'Remove Image', wk_get_theme_text_domain() ),
			'sortable'          => true,
			// 'closed'         => true, // true to have the groups closed by default
			// 'remove_confirm' => esc_html__( 'Are you sure you want to remove?', 'cmb2' ), // Performs confirmation before removing group.
		),
	) );	
	
	// IMAGES
	$wk_metabox->add_group_field( $project_group, array(		
		'name' => esc_html__( 'Project Images', wk_get_theme_text_domain() ),
		'id'   => 'image',
		'type' => 'file_list',
		'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
		// 'query_args' => array( 'type' => 'image' ), // Only images attachment
		// Optional, override default text strings
		'text' => array(
			'add_upload_files_text' => esc_html__( 'Add/Upload Image', wk_get_theme_text_domain() ), // default: "Add or Upload Files"
			'remove_image_text' => esc_html__( 'Remove Image', wk_get_theme_text_domain() ), // default: "Remove Image"
			'file_text' => esc_html__( 'File', wk_get_theme_text_domain() ), // default: "File:"
			'file_download_text' => esc_html__( 'Download', wk_get_theme_text_domain() ), // default: "Download"
			'remove_text' => esc_html__( 'Remove', wk_get_theme_text_domain() ), // default: "Remove"
		),
	) );
		
	// SELECT FIELD
	$wk_metabox->add_group_field( $project_group, array(
		'name'    => __( 'Image Size', wk_get_theme_text_domain() ),
		'id'      => 'size',
		'type'    => 'select',
		'options' => array(
			's' => __( 'Small', wk_get_theme_text_domain() ),
			'm' => __( 'Medium', wk_get_theme_text_domain() ),
			'l' => __( 'Large', wk_get_theme_text_domain() ),
		),
		'default' => 'l',
	) );	
}



/*
* [file_list] Project Images
* [text_area] Group Field
*/
add_action( 'cmb2_admin_init', 'wk_profile_fields' );

function wk_profile_fields() {
	
	$prefix = 'wk_profile_';
	
	$wk_profile_metabox = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => esc_html__( 'Profile Data', wk_get_theme_text_domain() ),
		'object_types'  => array( 'page' ), // Post type
	) );
	
	// IMAGE
	$wk_profile_metabox->add_field( array(
		'name'    => 'Test File',
		'desc'    => 'Upload an image or enter an URL.',
		'id'      => $prefix . 'image',
		'type'    => 'file',
		// Optional:
		'options' => array(
			'url' => false, // Hide the text input for the url
		),
		'text'    => array(
			'add_upload_file_text' => esc_html__( 'Add or Upload File', wk_get_theme_text_domain() ) // Change upload button text. Default: "Add or Upload File"
		),
		'preview_size' => 'large', // Image size to use when previewing in the admin.
	) );
	
	// TEXTAREA
	$wk_profile_metabox->add_field( array(
		'name' => esc_html__( 'Address', wk_get_theme_text_domain() ),
		'id'   => $prefix . 'address',
		'type' => 'wysiwyg',
		'options' => array(
				'wpautop' => true, // use wpautop?
		),
	) );	
	
}
