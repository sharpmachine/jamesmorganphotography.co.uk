<?php
/**
 * Template Name: Contact
 *
 * Please select this for Biography, Awards, Exhibitions, Interviews, Clients
 * Else it will not display correctly.
 *
 * Developer: Craig Butcher - Web Tailor
 *
 */
get_header(); ?>
<section id="content" role="main">

<?php the_post(); ?>
				
<article id="contact" <?php post_class(); ?>>

		<?php the_content(); ?>



		<?php edit_post_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?>
</article><!-- #post-<?php the_ID(); ?> -->


</section><!-- #primary -->
<?php get_footer(); ?>