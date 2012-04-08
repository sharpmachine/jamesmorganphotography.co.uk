<?php
/**
 * Template Name: About
 *
 * @package JMP
 * @subpackage JamesMorgan
 * @since JMP 1.0
 */

get_header(); ?>

</div><!-- end #header -->

<div id="content">
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'twentyten' ), 'after' => '</div>' ) ); ?>
						<?php edit_post_link( __( 'Edit', 'twentyten' ), '<span class="edit-link">', '</span>' ); ?>
<?php endwhile; ?>
<?php get_footer(); ?>;