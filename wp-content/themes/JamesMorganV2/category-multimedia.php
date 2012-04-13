<?php
/**
 * The template for displaying Multimedia category.
 */
get_header(); ?>
	<section id="content" role="main">
	<?php if ( have_posts() ) : ?>
	<?php /* Start the Loop */ ?>
	<?php while ( have_posts() ) : the_post(); ?>

	<article id="post-<?php the_ID(); ?>" class="multimedia">
		
	<div class="entry-blog-short">
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
		<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( $size, $attr ); ?></a>
			<?php the_excerpt(); ?>
		</div><!-- .entry-content -->


	

	</article><!-- #post-<?php the_ID(); ?> -->


				<?php endwhile; ?>

		<nav id="navigation">
			<h3 class="assistive-text"><?php _e( 'Post navigation', 'twentyeleven' ); ?></h3>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'twentyeleven' ) ); ?></div>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'twentyeleven' ) ); ?></div>
		</nav><!-- #nav-above -->


			<?php else : ?>

				<article id="post-0" class="post no-results not-found">
					<header class="entry-header">
						<h1 class="entry-title"><?php _e( 'Nothing Found', 'twentyeleven' ); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'twentyeleven' ); ?></p>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-0 -->

			<?php endif; ?>

			</section><!-- #content -->

<?php get_footer(); ?>
