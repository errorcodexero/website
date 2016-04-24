<?php
/**
 * Template Name: Team Full Page 
 *
 * Description: Twenty Twelve loves the no-sidebar look as much as
 * you do. Use this page template to remove the sidebar from any page.
 *
 * Tip: to remove the sidebar from all posts and pages simply remove
 * any active widgets from the Main Sidebar area, and the sidebar will
 * disappear everywhere.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">
			
			<?php
				$objslug = get_queried_object()->post_name;
				$team_query=
				new WP_Query(
								array( 'category_name' => "$objslug-team")); 
			?>
						
			<?php while ( have_posts() ) : the_post(); ?>	
				<?php get_template_part( 'content', 'page' ); ?>
				<header class="entry-header"><h1 class="entry-title">Latest Updates</h1></header>
	                 <?php
						if ($team_query->have_posts()): while ($team_query->have_posts()): $team_query->the_post();
					?>
					<article>
					<div id="post-<?php the_ID(); ?>" class="post-full-width">
						<header class="entry-header"><h2><?php the_title(); ?></h2></header>
						<div class="entry-content"><?php the_content(); ?></div>
						<footer class="entry-meta">
						  
						<?php team1425_entry_meta( 'nav-below' ); ?>
						</footer>		
					</div>
					</article>
				<?php endwhile; endif; wp_reset_query(); ?>
			<?php endwhile; // end of the loop. ?>
            
			<div>
        	     
            </div>

			 
			
		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>