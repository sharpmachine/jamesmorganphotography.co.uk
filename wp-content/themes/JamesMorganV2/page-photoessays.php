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
			<div id="container" style="width:1900px;">
			<?php the_post(); ?>
			<?php the_content(); ?>
			<footer class="entry-meta">
		<?php edit_post_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
</div><!-- #container -->
</div><!-- #scrollbar -->

</section><!-- #primary -->
<?php get_footer(); ?>