<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 */

get_header(); ?>

		<div id="primary">

			<div id="content" role="main">

<div>
<?php if (function_exists('rps_show')) echo rps_show(); ?> 
</div>

<?php
if (0) { 
?>

<div id="bq_home_listings">
<?php bq_home_listing(array('limit'=>3, 'title_link'=>'/category/blog/', 'title'=>'Blog', 'category_name'=>'blog')); ?> 
<?php bq_home_listing(array('limit'=>3,'title'=>'Horse articles', 'title_link'=>'/category/horse-articles/','Horse articles'=>'horse-articles')); ?> 
<?php bq_home_listing(array('limit'=>3, 'title_link'=>'/category/dogs/', 'title'=>'Dogs', 'category_name'=>'dogs')); ?> 
<div style="height:0px;clear: both;">&nbsp;</div>
</div>

<?php
}
?>


<?php 
$my_query = new WP_Query('showposts=1&category_name=blog'); 
while ($my_query->have_posts()) {  
   $my_query->the_post(); 
   get_template_part( 'content', 'single' ); 
   // comments_template( '', true ); 
} 
?>


<div>
</div>


<?php 
function bq_home_listing($args) {
?>
<div class="bq_home_listing">
<div class="bq_home_listing_title"><span class="bq_home_listing_title"><a href="<?php echo $args['title_link']; ?>"><?php echo $args['title']; ?></a><strong>&rarr;</strong></span></div>
<?php 
$my_query = new WP_Query('showposts=' . $args['limit'] .'&category_name=' . $args['category_name']); 
while ($my_query->have_posts()) {  
   $my_query->the_post(); 
   $do_not_duplicate = $post->ID;
   if ( function_exists('has_post_thumbnail') and has_post_thumbnail($post->ID) ) {
     $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array(125, 125) );
     $image_markup=sprintf('<a href="%s"><img src="%s" width="%s" height="%s" /></a>',   get_permalink($post->ID),  $thumbnail[0], $thumbnail[1], $thumbnail[2]);
   }

?>
			<div class="bq_home_listing_item"><?php if (has_post_thumbnail($post->ID)) echo $image_markup; ?> <span><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyeleven' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></span><span class="bq_home_listing_item_date"> <?php if (0 and 'blog'==$args['category_name']) echo get_the_date(); ?></span></div>
<?php } ?>
<div style="clear: both;">&nbsp;</div>
<div style="text-align: right"><a style="font-size: 12px; color: #666;" href="<?php echo $args['title_link']; ?>">[more ...]</a></div>


</div>
<?php 
} ?>







<?php

if (0) { 

?>



			<?php if ( have_posts() ) : ?>

				<?php // twentyeleven_content_nav( 'nav-above' ); ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', get_post_format() ); ?>

				<?php endwhile; ?>

				<?php // twentyeleven_content_nav( 'nav-below' ); ?>

			<?php else : ?>

				<article id="post-0" class="post no-results not-found">
					<header class="entry-header">
						<h1 class="entry-title"><?php _e( 'Nothing Found', 'twentyeleven' ); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'twentyeleven' ); ?></p>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-0 -->

			<?php endif; ?>

<?php

} // if 0 

?>


			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
