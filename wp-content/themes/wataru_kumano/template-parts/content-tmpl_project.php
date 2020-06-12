<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Wataru_Kumano
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'project' ); ?>>
	<div class="project-info">
		<?php the_title( '<h1 class="project-title">', '</h1>' ); ?>
		<div class="project-content"><?php the_content(); ?></div>
		<div class="project-type"><?php echo wk_get_terms( $post->ID, 'category', 'project_type', '–' ); ?></div>
		<div class="project-context"><?php echo wk_get_terms( $post->ID, 'category', 'project_context', '–' ); ?></div>
		<div class="project-year"><?php echo get_the_date( 'Y' ); ?></div>
	</div><!-- .project-info -->
	<?php wk_get_custom_fields( 'itm' ); // class, img-size ?>
</article><!-- #post-<?php the_ID(); ?> -->
