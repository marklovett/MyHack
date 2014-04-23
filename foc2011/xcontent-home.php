

<?php
/**
 * The default template for displaying content
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?>
<div>
<?php if (function_exists('rps_show')) echo rps_show(); ?> 
</div>
<div id="bq_home_listings">
<?php bq_home_listing(array('limit'=>4, 'title_link'=>'/category/blog/', 'title'=>'Blog', 'category_name'=>'blog')); ?> 
<?php bq_home_listing(array('limit'=>4,'title'=>'Horse articles', 'title_link'=>'/category/horse-articles/','Horse articles'=>'horse-articles')); ?> 
<?php bq_home_listing(array('limit'=>4, 'title_link'=>'/category/dogs/', 'title'=>'Dogs', 'category_name'=>'dogs')); ?> 
<div style="height:0px;clear: both;">&nbsp;</div>
</div>
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
     $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array(75, 75) );
     $image_markup=sprintf('<img src="%s" width="%s" height="%s" />', $thumbnail[0], $thumbnail[1], $thumbnail[2]);
   }

?>
			<div class="bq_home_listing_item" style="clear: both;"><?php if (has_post_thumbnail($post->ID)) echo $image_markup; ?> <span><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyeleven' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></span><span class="bq_home_listing_item_date"> <?php if ('blog'==$args['category_name']) echo get_the_date(); ?></span></div>
<?php } ?>
</div>
<?php 
} ?>





