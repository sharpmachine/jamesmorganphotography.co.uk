<?php
/**
 * Template Name: Tearsheets
 *
 * @package WordPress
 * @subpackage JamesMorganPhotography
 * @since JamesMorganPhotography 1.0
 */

get_header(); ?>

</div><!-- end #header -->

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<script type="text/javascript" src="<?php bloginfo("template_url"); ?>/scripts/jquery.nivo.slider.pack.js"></script>
<script type="text/javascript">
jQuery(window).load(function() {
	jQuery('#slider').nivoSlider({
		effect:'fade', //Specify sets like: 'fold,fade,sliceDown'
		slices:1,
		pauseTime:5000,
		controlNav:false,
		directionNav:true, //Next & Prev
		directionNavHide:true, //Only show on hover
		manualAdvance:true, //Force manual transitions
		captionOpacity:0 //Universal caption opacity
	});
});
</script>
<div id="content">
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'twentyten' ), 'after' => '</div>' ) ); ?>
						<?php edit_post_link( __( 'Edit', 'twentyten' ), '<span class="edit-link">', '</span>' ); ?>
<?php endwhile; ?>




<?php get_footer('socialShare'); ?>