<?php
/*
	* Template Name: Multimeda
 */

get_header(); ?>
<?php wp_nav_menu( array('menu' => 'Multimedia' )); ?>
<div style="clear: both">&nbsp;</div>
<section id="content" role="main">

				<?php the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>

</section><!-- #primary -->

<?php get_footer(); ?>