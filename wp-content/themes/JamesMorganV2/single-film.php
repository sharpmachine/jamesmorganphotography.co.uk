<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

get_header(); ?>
<?php wp_nav_menu( array('menu' => 'Film' )); ?>
<div style="clear: both;">&nbsp;</div>
			<section id="content" role="main" class="single-video">

				<?php if (have_posts()) : ?>
				
	<?php while (have_posts()) : the_post(); ?>
		<h1 class="entry-title"><?php the_title(); ?></h1>
		<iframe src="http://player.vimeo.com/video/<?php the_field('vimeo_id'); ?>?title=0&amp;byline=0&amp;portrait=0&amp;autoplay=1" width="900" height="506" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
		
		<?php the_content(); ?>
		
				
	<?php endwhile; ?>
				
		
				
	<?php else : ?>
				
		<?php // No Posts Found ?>
				
<?php endif; ?>

			</section><!-- #content -->

<?php get_footer(); ?>