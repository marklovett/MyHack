<?php
/**
 * The Sidebar containing the main widget area.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

$options = twentyeleven_get_theme_options();
$current_layout = $options['theme_layout'];


function bq_home_side_list($args) { 

echo <<<END
			<aside id="recent-posts-2" class="widget widget_recent_entries">		
   <h3 class="widget-title">Featured</h3>
   <ul>
END;

$my_query = new WP_Query(array(category__in => $args['category__in'],posts_per_page => $args['limit'])); 
while ($my_query->have_posts()) {  
   $my_query->the_post(); 
   $do_not_duplicate = $post->ID;
?>
			   <li><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyeleven' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></span><span class="bq_side_listing_item_date"> <?php if (0 and 'blog'==$args['category_name']) echo get_the_date(); ?></li>
<?php
   }

echo <<<END
</ul>
</aside>
END;
}





function bq_side_listing($args) { ?>

<div class="bq_side_listing">
<?php if($args['title_link']) {?>
<div class="bq_side_listing_title"><span class="bq_side_listing_title"><a href="<?php echo $args['title_link']; ?>"><?php echo $args['title']; ?></a><strong>&rarr;</strong></span></div>
<?php } ?>

<?php 
$my_query = new WP_Query(array(category__in => $args['category__in'],posts_per_page => $args['limit'])); 


while ($my_query->have_posts()) {  
   $my_query->the_post(); 
   $do_not_duplicate = $post->ID;
   if ( function_exists('has_post_thumbnail') and has_post_thumbnail($post->ID) ) {
     $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array(270, 270) );
     $image_markup=sprintf('<a href="%s"><img src="%s" width="%s" height="%s" /></a>',   get_permalink($post->ID),  $thumbnail[0], $thumbnail[1], $thumbnail[2]);
   }

?>
			<div class="bq_side_listing_item"><div><span class="bq_side_listing_item_title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyeleven' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></span><span class="bq_side_listing_item_date"> <?php if (0 and 'blog'==$args['category_name']) echo get_the_date(); ?></span></div><?php if (has_post_thumbnail($post->ID)) echo $image_markup; ?><br />

<?php
 if(0) {
?>
<div style="clear: both;">&nbsp;</div>
<div class="bq_side_listing_item_more"><a style="background-color: gray; padding: 5px; font-size: 12px;" href="<?php the_permalink(); ?>">[more ...]</a></div>
<?php
 }
?>


</div>
<?php } ?>

<div style="clear: both;"><br />&nbsp;</div>
</div>
<?php 
} 





if ( 'content' != $current_layout ) :
?>
		<div id="secondary" class="widget-area" role="complementary">
<?php

bq_home_side_list(array('category__in'=>array(30,31,32,24,34), 'posts_per_page' => 10)); 

?>


			<?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>

				<aside id="archives" class="widget">
					<h3 class="widget-title"><?php _e( 'Archives', 'twentyeleven' ); ?></h3>
					<ul>
						<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
					</ul>
				</aside>

				<aside id="meta" class="widget">
					<h3 class="widget-title"><?php _e( 'Meta', 'twentyeleven' ); ?></h3>
					<ul>
						<?php wp_register(); ?>
						<li><?php wp_loginout(); ?></li>
						<?php wp_meta(); ?>
					</ul>
				</aside>

			<?php endif; // end sidebar widget area ?>

<?php

 

?>
<div id="bq_side_listings">
<?php bq_side_listing(array('limit'=>3, 'title_link'=>null, 'title'=>null, 'category__in'=>array(25,26,29))); ?> 
<div style="height:0px;clear: both;">&nbsp;</div>
</div>

		</div><!-- #secondary .widget-area -->
<?php endif; ?>
