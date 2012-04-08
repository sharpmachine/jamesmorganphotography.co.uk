<?php
/**
 * Template Name: Front page blog
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
See blog in original context at <a href="http://huffingtonpost.com/james-morgan">Huffington Post</a></div>
</div><!-- end #header -->

<div id="content">

<?php include_once(ABSPATH.WPINC.'/feed.php');
$rss = fetch_feed('feed://www.huffingtonpost.com/author/index.php?author=james-morgan');
$maxitems = $rss->get_item_quantity(5);
$rss_items = $rss->get_items(0, $maxitems);
?>
<ul class="blogpost">
<?php if ($maxitems == 0) echo '<li>No items.</li>';
else
// Loop through each feed item and display each item as a hyperlink.
foreach ( $rss_items as $item ) : ?>
<li>
<a href='<?php echo $item->get_permalink(); ?>'
title='<?php echo 'Posted '.$item->get_date('j F Y | g:i a'); ?>'>
<h2><?php echo $item->get_title(); ?></a></h2>
<?php echo $item->get_content(); ?></a>
</li>
<?php endforeach; ?>
</ul>


<?php get_footer('socialShare'); ?>