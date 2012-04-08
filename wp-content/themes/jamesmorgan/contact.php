<?php
/**
 * Template Name: Contact
 *
 * @package WordPress
 * @subpackage JamesMorganPhotography
 * @since JamesMorganPhotography 1.0
 */

get_header(); ?>
</div><!-- end #header -->
<div id="content">
<script type='text/javascript' src='http://jamesmorganphotography.co.uk/wp-content/plugins/contact-form-7/jquery.form.js?ver=2.47'></script>
<script type='text/javascript' src='http://jamesmorganphotography.co.uk/wp-content/plugins/contact-form-7/scripts.js?ver=2.4.1'></script>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'twentyten' ), 'after' => '</div>' ) ); ?>
						<?php edit_post_link( __( 'Edit', 'twentyten' ), '<span class="edit-link">', '</span>' ); ?>
<?php endwhile; ?>
<?php get_footer(); ?>