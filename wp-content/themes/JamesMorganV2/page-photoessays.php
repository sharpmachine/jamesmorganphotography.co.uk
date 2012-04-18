<?php
/**
 * Template Name: Photo Essays
 *
 * Please select this for Biography, Awards, Exhibitions, Interviews, Clients
 * Else it will not display correctly.
 *
 * Developer: Craig Butcher - Web Tailor
 *
 */
get_header(); ?>

<?php wp_nav_menu( array('menu' => 'primary-sub-menu' )); ?>

<section id="content" role="main">
	<div class="scroll-pane horizontal-only">
		<div id="container">
	
				<?php query_posts("post_type=photo_essay"); ?>
				<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>
			
			<article class="photoessayshorts">
				<div id="essayImage">
					<a href="<?php the_field('photoshelter_link'); ?>">
						<img class="alignnone size-full wp-image-656" title="<?php the_title(); ?>" src="<?php the_field('essay_image'); ?>" alt="<?php the_title(); ?>" width="252" height="163" />
					</a>
				</div>
				<h1 class="entry-title">
					<a href="<?php the_field('photoshelter_link'); ?>"><?php the_title(); ?></a>
				</h1>
				<div class="entry-blog-rss">
					<?php the_excerpt(); ?>
					<?php if(get_field('essay_pdf')): ?>
						<a href="<?php the_field('essay_pdf'); ?>" class="pdf-download">Download PDF</a>
					<?php endif; ?>
				</div>
			</article>
			
		<?php endwhile; else : ?>
				
			<p>Bummer, there's no essays at the moment.  Check back soon!</p>
				
	<?php endif; ?>
			
		</div><!-- #container -->
	</div><!-- #scrollbar -->
	<p class="scroll-notice"><span>&larr;</span> Use the scrollbar above to see more essays <span>&rarr;</span></p>

</section><!-- #primary -->
<?php get_footer(); ?>