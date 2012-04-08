<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=1300px" />
<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/fonts/BauerBondi.css" type="text/css" charset="utf-8">
<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/fonts/LeagueGothic.css" type="text/css" charset="utf-8">
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />


  <script language="JavaScript">
   <!--
    function do_it() {
     document.forms[0].page_title.value=document.location.hash.substring(1);
    }
   // --->
  </script>



<title><?php wp_title(''); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />

<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
        <!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
			    <style type="text/css">
	    .jspVerticalBar { display: none;}
	    </style>

	    <![endif]--> 
	    
	    <!--[if IE 9]>
	    <style type="text/css">
	    .jspVerticalBar { display: none;}
	    </style>
	    <![endif]-->
<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>



<script type="text/javascript" src="http://jamesmorganphotography.co.uk/wp-content/themes/JamesMorganV2/js/jquery.jscrollpane.min.js"></script>
<script type="text/javascript" src="http://jamesmorganphotography.co.uk/wp-content/themes/JamesMorganV2/js/jquery.mousewheel.js"></script>

<script>
	var $ = jQuery.noConflict();
	

$(document).ready(function(){
$("p:has(img)").css('margin' , '0');
});


	$(function()
	{	$('.scroll-pane').jScrollPane(); });


</script>


</head>

<body <?php body_class(); ?> onload="do_it();">

<div id="wrapper" class="hfeed">
	<header id="branding" role="banner">
			<hgroup>
				<h1 id="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			</hgroup>

			<nav id="access" role="navigation">
				<h3 class="assistive-text"><?php _e( 'Main menu', 'twentyeleven' ); ?></h3>
				<?php /*  Allow screen readers / text browsers to skip the navigation menu and get right to the good stuff. */ ?>
				<div class="skip-link"><a class="assistive-text" href="#content" title="<?php esc_attr_e( 'Skip to primary content', 'twentyeleven' ); ?>"><?php _e( 'Skip to primary content', 'twentyeleven' ); ?></a></div>
				<div class="skip-link"><a class="assistive-text" href="#secondary" title="<?php esc_attr_e( 'Skip to secondary content', 'twentyeleven' ); ?>"><?php _e( 'Skip to secondary content', 'twentyeleven' ); ?></a></div>
				<?php /* Our navigation menu.  If one isn't filled out, wp_nav_menu falls back to wp_page_menu. The menu assiged to the primary position is the one used. If none is assigned, the menu with the lowest ID is used. */ ?>
			
			<nav id="topNav">
				<?php wp_nav_menu( array('menu' => 'primary' )); ?>

			</nav>
			</nav><!-- #access -->
	</header><!-- #branding -->

