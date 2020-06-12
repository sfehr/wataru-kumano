<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Wataru_Kumano
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		
		$menu_items = '';
		
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'tmpl_project' );
		
			$menu_items .= '<li class="menu-item">
								<a href="#post-' . get_the_ID() . '" title="' . get_the_title() . '" class="anchor-link">
									<span class="link-year">' . get_the_date( 'Y' ) . '</span>
									<span class="link-type">' . wk_get_terms( $post->ID, 'category', 'project_type', '–' ) . '</span>
									<span class="link-title">' . get_the_title() . '</span>
									<span class="link-context">' . wk_get_terms( $post->ID, 'category', 'project_context', '–' ) . '</span>
								</a>
							</li>'; 

		endwhile; // End of the loop.
		?>

		<div id="nav-bar">
			<nav class="project-navigation">
				<ul class="menu-container">
					<?php echo $menu_items; ?>
				</ul>
			</nav><!-- End main-navigation -->
			<div class="nav-content-container">
			</div><!-- End content-container-->
			<div class="nav-profile-container">
				<?php 
				// PROFILE CONTENT
				$page = get_page_by_title( 'Profile Wataru Kumano' );	
				?>
				<div class="profile-image"><?php echo wk_profile_image( $page->ID ); ?></div>
				<div class="profile-content"><?php echo $page->post_content; ?></div>
				<div class="profile-address"><?php echo wk_profile_text( $page->ID ); ?></div>
			</div><!-- End profile -->
			<div class="nav-bar-container">
				<div class="logo">Kumano</div>
				<div class="project-info">
					<div class="project-title"><h1></h1></div>
					<div class="project-type"></div>
					<div class="project-year"></div>
				</div>
			</div><!-- End nav-bar-container -->
		</div>		
		
	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
