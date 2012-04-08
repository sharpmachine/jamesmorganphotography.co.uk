<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package JMP
 * @subpackage JamesMorgan
 * @since JMP 1.0
 */

get_header(); ?>

</div><!-- end #header -->

	<div id="content">
	
					<h2><?php _e( 'Not Found', 'twentyten' ); ?></h2>

					<p><?php _e( 'Apologies, but the page you requested could not be found. Perhaps searching will help.', 'twentyten' ); ?></p>
					<?php get_search_form(); ?>

	<script type="text/javascript">
		// focus on search field after it has loaded
		document.getElementById('s') && document.getElementById('s').focus();
	</script>

<?php get_footer(); ?>