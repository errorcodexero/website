<?php
/**
 * Template Name: St. Louis 2012
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

                	<div id="st-louis-posts">
        	                <h1>Latest Updates</h1>
	                        <?php

/*
					$args = array(
						'tax_query' => array(
							'relation' => 'AND',
							array(
								'taxonomy' => 'category',
								'field' => 'slug',
								'terms' => array( 'st-louis-2012' )
							),
							array(
								'taxonomy' => 'tags',
								'field' => 'slug',
								'terms' => array( 'st-louis-2012' )
							)
						)
					);

                        	        $query = new WP_Query( $args );
*/

                        	        $query = new WP_Query( 'category_name=st-louis-2012' );

                	                if ($query->have_posts()): while ($query->have_posts()): $query->the_post();
        	                ?>
	                                <div id="post-<?php the_ID(); ?>" class="page-post post">
                        	                <h2><?php the_title(); ?></h2>

						<div class="entry-meta">
							<?php coraline_posted_on(); coraline_posted_by(); ?>
						</div>

						<?php the_content(); ?>
        	                        </div>
	                        <?php endwhile; endif; wp_reset_query(); ?>
               		 </div>

			</div><!-- #content -->
		</div><!-- #content-container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
