<?php
/**
 * Template Name: Web Team Page
 * @package WordPress
 * @subpackage team1425
 */

get_header(); ?>

		<div id="content-container">
			<div id="content" role="main">

			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php if ( is_front_page() ) { ?>
						<h2 class="entry-title"><?php the_title(); ?></h2>
					<?php } else { ?>
						<h1 class="entry-title"><?php the_title(); ?></h1>
					<?php } ?>

					<div class="entry-content">
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'coraline' ), 'after' => '</div>' ) ); ?>
						<?php edit_post_link( __( 'Edit', 'coraline' ), '<span class="edit-link">', '</span>' ); ?>
					</div>
				</div><!-- #post-## -->

			<?php endwhile; ?>

                	<div>
        	                <h1>Latest Updates</h1>
	                        <?php

								global $team_query;
                        	        $team_query = new WP_Query( 'category_name=web-team' );
									
									get_template_part( 'loop-team' );
							?>
                	 </div>

			</div><!-- #content -->
		</div><!-- #content-container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
