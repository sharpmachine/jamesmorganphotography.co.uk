<?php
/**
 * Template Name: Blog
 *
 * A custom blog template bringing in RSS feed from Huffington Post.
 *
 */

get_header(); ?>

<section id="content" role="main">

<?php include_once(ABSPATH.WPINC.'/feed.php');
$rss = fetch_feed('feed://www.huffingtonpost.com/author/index.php?author=james-morgan');
$maxitems = $rss->get_item_quantity(5);
$rss_items = $rss->get_items(0, $maxitems);
?>
<article class="blogpost">
<?php if ($maxitems == 0) echo '<li>No items.</li>';
else
// Loop through each feed item and display each item as a hyperlink.
foreach ( $rss_items as $item ) : ?>
<a href='<?php echo $item->get_permalink(); ?>'title='<?php echo 'Posted '.$item->get_date('j F Y | g:i a'); ?>'>



<h2 class="blogheader"><?php echo $item->get_title(); ?></a></h2>

<?php echo $item->get_content(); ?></a>

<?php endforeach; ?>
</article>

</section>