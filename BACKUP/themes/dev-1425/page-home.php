
<?php
/**
 * Template Name: Home Page
 * @package WordPress
 * @subpackage TwentyTwelve
 * @since TwentyTwelve X.Y
 *
 * The template for displaying the home page.
 *
 *
 */

get_header(); ?>

<?php echo do_shortcode( "[slideshow_deploy id='1297']" ); ?>

	<div id="primary" class="site-content">	    
		<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'home' ); ?>
			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->
	


<?php get_sidebar( 'front' ); ?>
<?php get_footer(); ?>