</div><!-- #content -->
<div id="footer">
<p class="alignleft">All images &copy; <a href="http://jamesmorganphotography.co.uk">James Morgan Photography</a>
<div class="socialfooter">
<?php if(function_exists("SFBSB_direct")) {echo SFBSB_direct("button");} ?>
<?php if(function_exists('the_tweetbutton')) the_tweetbutton();?>
</div>
</div><!-- #footer -->
</div><!-- #wrapper -->
<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
?>
</body>
</html>

