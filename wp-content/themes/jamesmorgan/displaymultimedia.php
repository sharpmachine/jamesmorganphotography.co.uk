<?php
/**
 * Template Name: Display Multimedia Page
 *
 * A custom page template without sidebar.
 *
 * The "Template Name:" bit above allows this to be selectable
 * from a dropdown menu on the edit page screen.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
get_header(); ?>
<div class="breadcrumb">
<?php
if(function_exists('bcn_display'))
{
	bcn_display();
}
?>
</div>
    <div id="openCloseWrap"><a href="javascript:void(0);" class="topMenuAction" id="topMenuImage">Show synopsis</a></div>
</div><!-- #header -->
<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery(".topMenuAction").click( function() {
			if (jQuery("#openCloseIdentifier").is(":hidden")) {
				jQuery("#slider_box").animate({ 
					marginTop: "-705px"
					}, 500 );
				jQuery("#topMenuImage").html('Show synopsis');
				jQuery("#openCloseIdentifier").show();
			} else {
				jQuery("#slider_box").animate({ 
					marginTop: "0px"
					}, 500 );
				jQuery("#topMenuImage").html('Hide synopsis');
				jQuery("#openCloseIdentifier").hide();
			}
		});  
	});
</script>

<!-- the mousewheel plugin - optional to provide mousewheel support -->
<script type="text/javascript" src="<?php bloginfo("template_url"); ?>/scripts/jquery.mousewheel.js"></script>

<!-- the jScrollPane script -->
<script type="text/javascript" src="<?php bloginfo("template_url"); ?>/scripts/jquery.jscrollpane.min.js"></script>

<script type="text/javascript">
jQuery(function()
{
	jQuery('.scroll-pane').jScrollPane();
});
</script>
<div id="content">
<div id="openCloseIdentifier"></div>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<div class="cover">
    <div id="slider_box">
	<div id="pane" class="scroll-pane">
    <h2><?php single_post_title(''); ?></h2>
	<?php the_content(); ?>
</div>
</div>
</div>
<?php the_meta(); ?>
	<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'twentyten' ), 'after' => '</div>' ) ); ?>
	<?php edit_post_link( __( 'Edit', 'twentyten' ), '<span class="edit-link">', '</span>' ); ?>
<?php endwhile; ?>
<?php get_footer('socialShare'); ?>