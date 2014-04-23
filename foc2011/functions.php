<?php

define ('WPLANG', '');
load_textdomain( 'twentyeleven', '/home/rtcnet/public_html/wp-content/themes/foc2011/languages/twentyeleven.mo' );


function bqa_auto_excerpt_more( $more ) {
 return ' <a href="'. esc_url( get_permalink() ) . '">' . __( '[more ...] <span class="meta-nav"></span>', 'twentyeleven' ) . '</a>';
}
remove_filter( 'excerpt_more', 'twentyeleven_auto_excerpt_more' );
add_filter( 'excerpt_more', 'bqa_auto_excerpt_more', 99);



function bqa_main_cat_slug() {
   if (in_category( 'horse-articles' )) return 'horse-articles';
   if (in_category( 'dogs' )) return 'dogs';
   if (in_category( 'blog' )) return 'blog';
}


function twentyeleven_posted_on() {

if (!in_category( 'horse-articles' )) {  
	printf( __( '<span class="sep">Posted on </span><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a><span class="by-author"> <span class="sep"> by </span> <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'twentyeleven' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'twentyeleven' ), get_the_author() ) ),
		get_the_author()
	);

} // if
}



function the_category_filter($thelist,$separator=' ') {  
   // modified from: // http://www.smashingthemes.com/blog/how-to-remove-categories-from-the_category-function-in-wordpress/



    if(!defined('WP_ADMIN')) {  
       // this filters the "posted in" categories and only lists 
       // categories that have no parent. 


       //Category IDs to exclude  
       // alex begin
       // would be cool if this could be passed a function that would set up conditions for exclusion. 
       $exclude=array(); 
       $ecats=get_the_category();
       if ($ecats) { 
          for($i = 0; $i < sizeof($ecats); ++$i) { 
             if(!($ecats[$i]->category_parent==0)) {
                $exclude[] = $ecats[$i]->cat_ID;
             }
           }
        }
        // alex end 
        $exclude2 = array();  
        foreach($exclude as $c) {  
            $exclude2[] = get_cat_name($c);  
        }  
  
        $cats = explode($separator,$thelist);  
        $newlist = array();  
        foreach($cats as $cat) {  
            $catname = trim(strip_tags($cat));  
            if(!in_array($catname,$exclude2))  
                $newlist[] = $cat;  
        }  
        return implode($separator,$newlist);  
    } else {  
        return $thelist;  
    }  
}  
add_filter('the_category','the_category_filter', 10, 2);  




function wpautop_forked_aw($pee, $br = 1) {

	if ( trim($pee) === '' )
		return '';
	$pee = $pee . "\n"; // just to make things a little easier, pad the end
	$pee = preg_replace('|<br />\s*<br />|', "\n\n", $pee);
	// Space things out a little
	$allblocks = '(?:table|thead|tfoot|caption|col|colgroup|tbody|tr|td|th|img|div|dl|dd|dt|ul|ol|li|pre|select|option|form|map|area|blockquote|address|math|style|input|p|h[1-6]|hr|fieldset|legend|section|article|aside|hgroup|header|footer|nav|figure|figcaption|details|menu|summary)';
	$pee = preg_replace('!(<' . $allblocks . '[^>]*>)!', "\n$1", $pee);
	$pee = preg_replace('!(</' . $allblocks . '>)!', "$1\n\n", $pee);
	$pee = str_replace(array("\r\n", "\r"), "\n", $pee); // cross-platform newlines
	if ( strpos($pee, '<object') !== false ) {
		$pee = preg_replace('|\s*<param([^>]*)>\s*|', "<param$1>", $pee); // no pee inside object/embed
		$pee = preg_replace('|\s*</embed>\s*|', '</embed>', $pee);
	}
	$pee = preg_replace("/\n\n+/", "\n\n", $pee); // take care of duplicates
	// make paragraphs, including one at the end
	$pees = preg_split('/\n\s*\n/', $pee, -1, PREG_SPLIT_NO_EMPTY);
	$pee = '';
	foreach ( $pees as $tinkle )
		$pee .= '<p>' . trim($tinkle, "\n") . "</p>\n";
	$pee = preg_replace('|<p>\s*</p>|', '', $pee); // under certain strange conditions it could create a P of entirely whitespace
	$pee = preg_replace('!<p>([^<]+)</(div|address|form)>!', "<p>$1</p></$2>", $pee);
	$pee = preg_replace('!<p>\s*(</?' . $allblocks . '[^>]*>)\s*</p>!', "$1", $pee); // don't pee all over a tag
	$pee = preg_replace("|<p>(<li.+?)</p>|", "$1", $pee); // problem with nested lists
	$pee = preg_replace('|<p><blockquote([^>]*)>|i', "<blockquote$1><p>", $pee);
	$pee = str_replace('</blockquote></p>', '</p></blockquote>', $pee);
	$pee = preg_replace('!<p>\s*(</?' . $allblocks . '[^>]*>)!', "$1", $pee);
	$pee = preg_replace('!(</?' . $allblocks . '[^>]*>)\s*</p>!', "$1", $pee);
	if ($br) {
		$pee = preg_replace_callback('/<(script|style).*?<\/\\1>/s', '_autop_newline_preservation_helper', $pee);
		$pee = preg_replace('|(?<!<br />)\s*\n|', "<br />\n", $pee); // optionally make line breaks
		$pee = str_replace('<WPPreserveNewline />', "\n", $pee);
	}
	$pee = preg_replace('!(</?' . $allblocks . '[^>]*>)\s*<br />!', "$1", $pee);
	$pee = preg_replace('!<br />(\s*</?(?:p|li|div|dl|dd|dt|th|pre|td|ul|ol)[^>]*>)!', '$1', $pee);
	if (strpos($pee, '<pre') !== false)
		$pee = preg_replace_callback('!(<pre[^>]*>)(.*?)</pre>!is', 'clean_pre', $pee );
	$pee = preg_replace( "|\n</p>$|", '</p>', $pee );

	return $pee;
}


remove_filter('the_content', 'wpautop');
add_filter('the_content', 'wpautop_forked_aw');


function bqa_image_to_excerpt($text) { 
   $id=get_the_ID();
   if (!$id) return $text;
   if ( function_exists('has_post_thumbnail') and has_post_thumbnail($id) ) {
     $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($id, array(100, 100) ));
     $image_markup=sprintf('<a href="%s"><img style="border: 4px solid #e8e8e8;  margin-right: 10px;   margin-bottom: 10px;  float: left;" src="%s" width="%s" height="%s" /></a>',  get_permalink( $id ),  $thumbnail[0], $thumbnail[1], $thumbnail[2]);
   }
   if ($image_markup) { $text=$image_markup.$text;}
   return $text;
}

 add_filter('get_the_excerpt', 'bqa_image_to_excerpt');

?>
