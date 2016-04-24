<?php
global $team_query;
if ($team_query->have_posts()): while ($team_query->have_posts()): $team_query->the_post();
?>
    <div id="post-<?php the_ID(); ?>" class="post-full-width">
		<h2><?php the_title(); ?></h2>

		<div class="entry-meta">
			<?php coraline_posted_on(); coraline_posted_by(); ?>
		</div>

		<?php the_content(); ?>
    </div>
<?php endwhile; endif; wp_reset_query(); ?>