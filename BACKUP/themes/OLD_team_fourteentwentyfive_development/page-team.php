<?php
/**
 * Template Name: Team Page
 * @package WordPress
 * @subpackage TwentyTwelve
 * @since TwentyTwelve X.Y
 *
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 */

get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">
		
			<?php
			$objslug= get_queried_object()->slug;
			$team_query=
				new WP_Query(
						array( 'category_name' => "$objslug .-team" )
							); ?>			
			
			    <div>
        	        <h1>Latest Updates</h1>
	                     <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
						<div id="post-<?php the_ID(); ?>" <?php post_class( 'post-full-width' ); ?>>
							<h1 class="entry-title"><?php the_title(); ?></h1>
							<div class="entry-content">
								<?php the_content(); ?>
								<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'coraline' ), 'after' => '</div>' ) ); ?>
								<?php edit_post_link( __( 'Edit', 'coraline' ), '<span class="edit-link">', '</span>' ); ?>
							</div><!-- .entry-content -->
						</div><!-- #post-## -->

						<?php endwhile; ?>
							
			</div>
		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>