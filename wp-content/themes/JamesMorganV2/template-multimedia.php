<?php
/*
	* Template Name: Multimeda
 */

get_header(); ?>
<?php wp_nav_menu( array('menu' => 'Film' )); ?>
<div style="clear: both;">&nbsp;</div>

	<section id="content" role="main">
	<?php if(is_page('film')): ?>
					<?php query_posts('post_type=film&film_categories=portfolio') ?>
					<?php elseif(is_page('online')): ?>
						<?php query_posts('post_type=film&film_categories=online') ?>
						<?php elseif(is_page('broadcast')): ?>
						<?php query_posts('post_type=film&film_categories=broadcast') ?>
						<?php endif; ?>
					<?php if (have_posts()) : ?>
					
		<?php while (have_posts()) : the_post(); ?>
					<?php $vimeo_id = get_post_meta( $post->ID, 'vimeo_id', true );?>
			<article id="post-<?php the_ID(); ?>" class="multimedia">
				<div class="entry-blog-short">
					<h1 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
					<?php if(get_field('video_thumbnail')): ?>
						<a href="<?php the_permalink(); ?>" class="film-videos">
							<img src="<?php the_field('video_thumbnail'); ?>" alt="<?php the_title(); ?>">
							<span class="video-icon">
								<img src="<?php bloginfo('template_directory'); ?>/images/play-button.png" alt="Play">
							</span>
						</a>
						<?php else: ?>
					<a href="<?php the_permalink(); ?>" class="film-videos">
						<img src="<?php $imgid = $vimeo_id;
			 					$hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$imgid.php"));
			 					echo $hash[0]['thumbnail_medium']; ?>" class="vimeo" width="252" height="163" alt="<?php the_title(); ?>">
			 			<span class="video-icon">
							<img src="<?php bloginfo('template_directory'); ?>/images/play-button.png" alt="Play">
						</span>			
		 			</a>
			 			<?php endif; ?>
					
					<?php the_excerpt(); ?>
					
				</div><!-- .entry-content -->
			</article><!-- #post-<?php the_ID(); ?> -->
				
	<?php endwhile; else : ?>
				
		<p>Sorry, no posts yet.  Check back soon!</p>
				
<?php endif; ?>

	</section><!-- #primary -->

<?php get_footer(); ?>