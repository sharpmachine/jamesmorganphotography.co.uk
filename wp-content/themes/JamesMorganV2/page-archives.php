<?php
/**
 * Template Name: Archives
 *
 * This is to style the singles page. Must be selected to ensure proper operations
 *
 */

get_header(); ?>

	<?php wp_nav_menu( array('menu' => 'primary-sub-menu' )); ?>

<section id="content" role="main">

	<?php the_post(); ?>
	
	<article id="singles" <?php post_class(); ?>>

		<?php the_content(); ?>
		
	<footer class="entry-meta">
		<?php edit_post_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->

</section><!-- #primary -->

<?php get_footer(); ?>