<?php
/*
Single Post Template: James Morgan Blog Feed
Description: This part is optional, but helpful for describing the Post Template
*/
?>

<?php
get_header(); ?>
			<section id="content" role="main">
						
			<article id="blogsidebar">
			<ul>
				<?php while ( have_posts() ) : the_post(); ?>			

					<li class="currentsingleblog">
					<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyeleven' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
					</li>
				<?php endwhile; ?>
			</ul>

<?php $recent = new WP_Query(); ?>
<?php $recent->query('cat=5'); ?>
<?php while($recent->have_posts()) : $recent->the_post(); ?>
<ul>
    <li>
            <a href="<?php the_permalink(); ?>">
            <?php the_title(); ?>
            </a>
       </li>
</ul>
<?php endwhile; ?>
			
			
			
			</article><!-- /#blogsidebar -->
			
	<?php while ( have_posts() ) : the_post(); ?>


	<article id="post-<?php the_ID(); ?>" class="blogrss">
		<div class="entry-blog-rss">
	<?php the_content(); ?>
		</div>

					<nav id="navbottom">					
						<span class="nav-previous"><?php previous_post_link('&larr; %link', '%title', TRUE); ?></span>
						<span class="nav-next"><?php next_post_link('%link &rarr;', '%title', TRUE); ?></span>
					</nav><!-- #nav-single -->

	</article>

				<?php endwhile; ?>




			</section><!-- #content -->

<?php get_footer(); ?>