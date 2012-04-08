<?php

/* 
 * Template Name: Index
 *
 * Please select this for Index, else it will not display correctly.
 *
 * Developer: Craig Butcher - Web Tailor
*/

get_header(); ?>

<section id="content" role="main">

				<?php the_post(); ?>

<article id="index" <?php post_class(); ?>>
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'twentyeleven' ) . '</span>', 'after' => '</div>' ) ); ?>



	<footer class="entry-meta">
		<?php edit_post_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->

</section><!-- #primary -->

<?php get_footer(); ?>