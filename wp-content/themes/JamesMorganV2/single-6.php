<?php
/*
Single Post Template: James Morgan Multimedia Feed
Description: This part is optional, but helpful for describing the Post Template
*/
?>

<?php
get_header(); ?>
<section id="content" role="main">
	<article id="blogsidebar">
	<ul>
	<?php while ( have_posts() ) : the_post(); ?>			
	<li class="multimediapost">
		<a href="http://jamesmorganphotography.co.uk/multimedia">&laquo; Multimedia</a> &laquo;
		
		<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyeleven' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
	</li>
	<?php endwhile; ?>
	</ul>

			
			
			
			</article><!-- /#blogsidebar -->
			
	<?php while ( have_posts() ) : the_post(); ?>


	<article id="post-<?php the_ID(); ?>" class="multimediarss">
		<div class="entry-blog-rss">
	<?php the_content(); ?>
		</div>


	</article>

				<?php endwhile; ?>




			</section><!-- #content -->

<?php get_footer(); ?>