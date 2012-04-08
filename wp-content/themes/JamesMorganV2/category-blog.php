<?php
/**
 * The template for displaying Category ~ Blog.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

get_header(); ?>

			
			<section id="content" role="main">

			<article id="blogsidebar">
			
			<ul>
			<li></li>
			</ul>
			
			<ul>
			<?php if ( have_posts(query_posts( '&cat=5' )) ) : ?>			
				<?php while ( have_posts() ) : the_post(); ?>			

					<li>
					<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyeleven' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
					</li>
				<?php endwhile; ?>
			<?php endif; ?>
			</ul>
			</article>
			
			
			<?php if ( have_posts(query_posts( 'posts_per_page=1&cat=5' )) ) : ?>
			
					
				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>


	<article id="post-<?php the_ID(); ?>" class="blogrss">
			
			
			<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyeleven' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
			 <?php the_post_thumbnail( $size, $attr ); ?> 
			</a>


		<?php if ( is_search() ) : // Only display Excerpts for Search ?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
		<?php else : ?>
		<div class="entry-blog-rss">
			<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentyeleven' ) ); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'twentyeleven' ) . '</span>', 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->
		<?php endif; ?>


			<?php edit_post_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?>

	</article><!-- #post-<?php the_ID(); ?> -->


				<?php endwhile; ?>



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
