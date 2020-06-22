<?php
/**
 * Wataru Kumano functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Wataru_Kumano
 *  
 *  
 * wk_get_theme_text_domain()			 | Textdomain stored in a variable
 * 										 | Load CMB2 functions
 * wk_choose_template() 				 | Chose a custom template 
 * wk_custom_head() 					 | Add meta tags to the head 
 * wk_get_custom_fields() 				 | Retrieving the custom fields of a post
 * wk_get_terms()						 | Retrieving the terms assigned to a post
 * wk_profile_text()					 | Retrieving text fields from the profile page
 * wk_profile_image()					 | Retrieving image fields from the profile page  
 * wk_add_custom_img_sizes()			 | Custom image sizes
 *  
 *  
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'wataru_kumano_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function wataru_kumano_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Wataru Kumano, use a find and replace
		 * to change 'wataru_kumano' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'wataru_kumano', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'wataru_kumano' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'wataru_kumano_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'wataru_kumano_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function wataru_kumano_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'wataru_kumano_content_width', 640 );
}
add_action( 'after_setup_theme', 'wataru_kumano_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function wataru_kumano_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'wataru_kumano' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'wataru_kumano' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'wataru_kumano_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function wataru_kumano_scripts() {
	wp_enqueue_style( 'wataru_kumano-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'wataru_kumano-style', 'rtl', 'replace' );

	wp_enqueue_script( 'wataru_kumano-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
	
	wp_enqueue_script( 'wk-scripts-js', get_template_directory_uri() . '/js/wk-scripts.js', array( 'jquery' ), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'wataru_kumano_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}


/** SF:
 * Retrieve the text domain of the theme.
 *
 * @since     1.0.0
 * @return    string    The text domain of the plugin.
 */
function wk_get_theme_text_domain() {
	$textdomain = 'wataru_kumano';
	return $textdomain;
}


/** SF:
 * Load CMB2 functions
 */
require_once( get_template_directory() . '/inc/wk-cmb2-functions.php');



/** SF:
 * Chose a custom template
 */
function wk_choose_template( $template ) {
	
	if ( is_admin() ) {
		return $template;
	}
	
	if ( is_home() || is_singular() ) {
		$new_template = locate_template( array( 'tmpl_project.php' ) );
		if ( !empty( $new_template ) ) {
			return $new_template;
		}
	}

	return $template;
}
add_filter( 'template_include', 'wk_choose_template', 99 );



/** SF:
 *  Add meta tags to the head
 */
function wk_custom_head() {

	// TYPEFACE (EN)
	echo '<link rel="stylesheet" href="https://use.typekit.net/wlv6frg.css">';	
	
}

add_action( 'wp_head', 'wk_custom_head' );



/** SF:
 * Retrieving the custom fields (Image Group) of a post.
 *
 */
function wk_get_custom_fields( $class, $theme_img_size = '' ) {
	
	// GET FIELD
	$media_group_entries = get_post_meta( get_the_ID(), 'wk_group', true );
	
	// process group values
	foreach ( ( array ) $media_group_entries as $key => $entry ) {
		
		// VALUES
		$img_size_class = isset( $entry[ 'size' ] ) ? $entry[ 'size' ] : ''; // sizes
		
		// checks if a size is set in the theme, gets custom field value if otherwise
		if( empty( $theme_img_size ) ){
			
			if( isset( $img_size_class ) ){

				switch( $img_size_class ){

						case 's' :
							$img_size = 'wk-large'; // 1700 
							break;

						case 'm' :
							$img_size = 'wk-extra-large'; // 2300
							break;

						case 'l' :
							$img_size = 'wk-super-large'; // 3000
							break;					
				}
			}
		}
		else{
			$img_size = $theme_img_size;
		}
		
		// resets the array
		$media = null;
		$image_orientation = null;

		
		// IMAGE (file_list)
		if ( isset( $entry[ 'image' ] ) && !empty( $entry[ 'image' ] ) ) {
			
			// Loop through the file_list and fill it in the $media array
			foreach ( (array) $entry[ 'image' ] as $attachment_id => $attachment_url ) {
			
				// get image orientation
				$image_src = wp_get_attachment_image_src( $attachment_id, $img_size ); // returns [0]url, [1]width (in px), [2]height (in px)
				if ( $image_src[ 1 ] > $image_src[ 2 ]) {
					// Landscape
					$image_orientation[] = 'landscape';
				} else {
					// Portrait or Square
					$image_orientation[] = 'portrait';
				}
				
				// store image element in array
				$media[] = wp_get_attachment_image( $attachment_id, $img_size );
			}
		}

		// MARKUP
		// final check if a value exists
		if ( !empty( $media ) ){
			print '<div class="' . $class . ' itm-' . $img_size_class . ' ' . implode( ' ', $image_orientation ) . '">' . implode( '', $media ) . '</div><!-- .' . $class . ' -->';
		}
	}
}

add_filter( 'wk-custom-fields', 'wk_get_custom_fields' );



/** SF:
 * Retrieving the terms assigned to a post
 */
function wk_get_terms( $post_id, $taxonomy, $parent, $placeholder ){
	
	$parent_term = get_term_by( 'slug', $parent, $taxonomy, 'OBJECT' );
	
	$args = array(
		'taxonomy'  => $taxonomy,
    	'child_of'  => $parent_term->term_id,
		'fields' 	=> 'names'
	);
	
	$terms = wp_get_post_categories( $post_id, $args );
	$term_list = '';
	
	if( ! empty( $terms ) ){
		foreach( $terms as $term ){
			$term_list .= '<span class="term-item">' . $term . '</span>'; 
		}				
	}
	else{
		$term_list .= '<span class="term-item">' . $placeholder . '</span>'; 
	}
	
	return $term_list;
}



/** SF:
 * Retrieving text fields from the profile page
 */
function wk_profile_text( $post_id ){
	
	$prefix = 'wk_profile_';
	$meta_key = 'address';
	$text = wpautop( get_post_meta( $post_id, $prefix . $meta_key, true ) );
	
	return $text;
}


/** SF:
 * Retrieving iamge fields from the profile page
 */
function wk_profile_image( $post_id, $img_size = '' ){
	
	$prefix = 'wk_profile_';
	$meta_key = 'image';
	$suffix = '_id';
	$image = wp_get_attachment_image( get_post_meta( $post_id, $prefix . $meta_key . $suffix, 1 ), $img_size );
	
	return $image;
}


/** SF:
 * Custom Image Sizes
 */
function wk_add_custom_img_sizes() {
	
	add_image_size( 'wk-large', 1700, 1700 );
	add_image_size( 'wk-extra-large', 2300, 2300 );
	add_image_size( 'wk-super-large', 3000, 3000 );

}
add_action( 'after_setup_theme', 'wk_add_custom_img_sizes' );