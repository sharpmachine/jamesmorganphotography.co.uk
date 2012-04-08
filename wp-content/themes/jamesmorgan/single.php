<?php
/**
 * Template Name: Singles Front Page
 *
 * @package WordPress
 * @subpackage JamesMorganPhotography
 * @since JamesMorganPhotography 1.0
 */
get_header(); ?>
</div><!-- end #header -->
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<div id="content">
	<?php the_content(); ?>
	<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'twentyten' ), 'after' => '</div>' ) ); ?>
	<?php edit_post_link( __( 'Edit', 'twentyten' ), '<span class="edit-link">', '</span>' ); ?>
<?php endwhile; ?>
<?php get_footer(); ?>