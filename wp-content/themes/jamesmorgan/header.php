<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'twentyten' ), max( $paged, $page ) );

	?></title>

<meta charset="<?php bloginfo( 'charset' ); ?>" />
<link rel="profile" href="http://gmpg.org/xfn/11" />
<meta name="viewport" content="width=1024;" />
<!--[if ! lte IE 6]><!-->
<style type="text/css"> 
			@import url('http://jamesmorganphotography.co.uk/wp-content/themes/jamesmorgan/c-css.php');
</style> 
<!--<![endif]-->
<!--[if lte IE 6]>
<link rel="stylesheet" href="http://universal-ie6-css.googlecode.com/files/ie6.1.b.css" media="screen, projection">
<style>
#openCloseWrap {
	display:none;
}
</style>
<![endif]-->
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php wp_enqueue_script('jquery'); ?>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="wrapper">
<div id="header">
<div id="box">
<h1><a class="homeLink" href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
<ul id="navportfolio">
<li>Portfolios:</li>
<li>
<ul id="links">
<li><a href="<?php bloginfo('url') ?>/singles">Singles</a></li>
<li><a href="<?php bloginfo('url') ?>/photo-essays">Photo essays</a></li>
<li><a href="<?php bloginfo('url') ?>/multimedia">Multimedia</a></li>
<li><a href="<?php bloginfo('url') ?>/tearsheets">Tearsheets</a></li>
<!-- <li class="noborder"><a href="#">Commercial</a> </li> -->
</ul>
</li>
</ul><!-- #links-->
</div><!-- #box -->
<div id="nav">
<ul>
<li><a href="<?php bloginfo('url') ?>/blog">Blog</a></li>
<li><a href="http://jamesmorganphotography.co.uk/about">About</a></li>
<li><a href="http://jamesmorganphotography.co.uk/contact">Contact</a></li>
<li><a href="https://james.photoshelter.com/login?ref=/usr/usr-account">Client Area</a></li>
</ul>
</div><!-- #nav -->
<!-- Start including additional navs or guidance -->