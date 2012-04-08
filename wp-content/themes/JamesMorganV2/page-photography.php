<?php
/**
 * Template Name: Photography
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

<?php the_post(); ?>
				
<article id="index" <?php post_class(); ?>>

		<?php the_content(); ?>



	<footer class="entry-meta">
		<?php edit_post_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->


</section><!-- #primary -->
<?php get_footer(); ?>