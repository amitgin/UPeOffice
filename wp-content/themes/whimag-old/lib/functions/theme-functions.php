<?php

if( !function_exists( 'get_my_custom_search_form' )):
////////////////////////////////////////////////////////////////////
// Custom search form
///////////////////////////////////////////////////////////////////
function get_my_custom_search_form( $form ) {
    $form = '<aside class="widget"><form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
    <div><label class="screen-reader-text" for="s">' . __('Search for:', TEMPLATE_DOMAIN) . '</label>
    <input type="text" value="' . get_search_query() . '" name="s" id="s" />
    </div>
    </form></aside>';
    return $form;
}
//add_filter( 'get_search_form', 'get_my_custom_search_form' );
endif;


///////////////////////////////////////////////////////////////////////////////////////
// Custom WP Pagination original code ( woo_pagination() ) - Credit to WooCommerce code
///////////////////////////////////////////////////////////////////////////////////////
if ( ! function_exists( 'custom_woo_pagination' ) ) {
function custom_woo_pagination( $args = array(), $query = '' ) {
global $wp_rewrite, $wp_query;

if ( $query ) {
$wp_query = $query;
} // End IF Statement

		/* If there's not more than one page, return nothing. */
		if ( 1 >= $wp_query->max_num_pages )
			return;

		/* Get the current page. */
		$current = ( get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1 );

		/* Get the max number of pages. */
		$max_num_pages = intval( $wp_query->max_num_pages );

		/* Set up some default arguments for the paginate_links() function. */
		$defaults = array(
			'base' => add_query_arg( 'paged', '%#%' ),
			'format' => '',
			'total' => $max_num_pages,
			'current' => $current,
			'prev_next' => true,
			'prev_text' => __( '&larr; Previous', TEMPLATE_DOMAIN ), // Translate in WordPress. This is the default.
			'next_text' => __( 'Next &rarr;', TEMPLATE_DOMAIN ), // Translate in WordPress. This is the default.
			'show_all' => false,
			'end_size' => 1,
			'mid_size' => 1,
			'add_fragment' => '',
			'type' => 'plain',
			'before' => '<div class="wp-pagenavi iegradient">', // Begin woo_pagination() arguments.
			'after' => '</div>',
			'echo' => true,
			'use_search_permastruct' => true
		);

		/* Allow themes/plugins to filter the default arguments. */
		$defaults = apply_filters( 'custom_woo_pagination_args_defaults', $defaults );

		/* Add the $base argument to the array if the user is using permalinks. */
		if( $wp_rewrite->using_permalinks() && ! is_search() )
			$defaults['base'] = user_trailingslashit( trailingslashit( get_pagenum_link() ) . 'page/%#%' );

		/* Force search links to use raw permastruct for more accurate multi-word searching. */
		if ( is_search() )
			$defaults['use_search_permastruct'] = false;

		/* If we're on a search results page, we need to change this up a bit. */
		if ( is_search() ) {
		/* If we're in BuddyPress, or the user has selected to do so, use the default "unpretty" URL structure. */
			if ( class_exists( 'BP_Core_User' ) || $defaults['use_search_permastruct'] == false ) {

				$search_query = get_query_var( 's' );
				$paged = get_query_var( 'paged' );

				$base = user_trailingslashit( home_url() ) . '?s=' . esc_attr( $search_query ) . '&paged=%#%';

				$defaults['base'] = $base;
			} else {
				$search_permastruct = $wp_rewrite->get_search_permastruct();
				if ( ! empty( $search_permastruct ) )
					$defaults['base'] = user_trailingslashit( trailingslashit( urldecode( get_search_link() ) ) . 'page/%#%' );
			}
		}

		/* Merge the arguments input with the defaults. */
		$args = wp_parse_args( $args, $defaults );

		/* Allow developers to overwrite the arguments with a filter. */
		$args = apply_filters( 'custom_woo_pagination_args', $args );

		/* Don't allow the user to set this to an array. */
		if ( 'array' == $args['type'] )
			$args['type'] = 'plain';

		/* Make sure raw querystrings are displayed at the end of the URL, if using pretty permalinks. */
		$pattern = '/\?(.*?)\//i';

		preg_match( $pattern, $args['base'], $raw_querystring );

		if( $wp_rewrite->using_permalinks() && $raw_querystring )
			$raw_querystring[0] = str_replace( '', '', $raw_querystring[0] );
			@$args['base'] = str_replace( $raw_querystring[0], '', $args['base'] );
			@$args['base'] .= substr( $raw_querystring[0], 0, -1 );

		/* Get the paginated links. */
		$page_links = paginate_links( $args );

		/* Remove 'page/1' from the entire output since it's not needed. */
		$page_links = str_replace( array( '&#038;paged=1\'', '/page/1\'' ), '\'', $page_links );

		/* Wrap the paginated links with the $before and $after elements. */
		$page_links = $args['before'] . $page_links . $args['after'];

		/* Allow devs to completely overwrite the output. */
		$page_links = apply_filters( 'custom_woo_pagination', $page_links );

		/* Return the paginated links for use in themes. */
		if ( $args['echo'] )
			echo $page_links;
		else
			return $page_links;
	} // End custom_woo_pagination()
} // End IF Statement


if( !class_exists('Custom_Description_Walker') ):
////////////////////////////////////////////////////////////////////
// add description to wp_nav
///////////////////////////////////////////////////////////////////
class Custom_Description_Walker extends Walker_Nav_Menu {
    /**
     * Start the element output.
     *
     * @param  string $output Passed by reference. Used to append additional content.
     * @param  object $item   Menu item data object.
     * @param  int $depth     Depth of menu item. May be used for padding.
     * @param  array $args    Additional strings.
     * @return void
     */
function start_el(&$output, $item, $depth, $args) {
$classes = empty ( $item->classes ) ? array () : (array) $item->classes;
$class_names = join(' ', apply_filters('nav_menu_css_class',array_filter( $classes ), $item)
);

! empty ( $class_names )
and $class_names = ' class="'. esc_attr( $class_names ) . '"';
$output .= "<li id='menu-item-$item->ID' $class_names>";

$attributes  = '';

        ! empty( $item->attr_title )
            and $attributes .= ' title="'  . esc_attr( $item->attr_title ) .'"';
        ! empty( $item->target )
            and $attributes .= ' target="' . esc_attr( $item->target     ) .'"';
        ! empty( $item->xfn )
            and $attributes .= ' rel="'    . esc_attr( $item->xfn        ) .'"';
        ! empty( $item->url )
            and $attributes .= ' href="'   . esc_attr( $item->url        ) .'"';

// insert description for top level elements only
// you may change this
$description = ( ! empty ( $item->description ) and 0 == $depth )
? '<small class="nav_desc">' . esc_attr( $item->description ) . '</small>' : '';

$title = apply_filters( 'the_title', $item->title, $item->ID );
$item_output = $args->before
            . "<a $attributes>"
            . $args->link_before
            . $title
            . '<br /><span>' . $description . '</span>'
            . '</a> '
            . $args->link_after
            . $args->after;

// Since $output is called by reference we don't need to return anything.
$output .= apply_filters(
            'walker_nav_menu_start_el'
        ,   $item_output
        ,   $item
        ,   $depth
        ,   $args
        );
    }
}
endif;








///////////////////////////////////////////////////////////////////////////////
// custom walker nav for mobile navigation
///////////////////////////////////////////////////////////////////////////////
class mobi_custom_walker extends Walker_Nav_Menu
{
      function start_el(&$output, $item, $depth, $args)
      {
           global $wp_query;
           $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

           $class_names = $value = '';

           $classes = empty( $item->classes ) ? array() : (array) $item->classes;

           $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
           $class_names = ' class="'. esc_attr( $class_names ) . '"';

           $output .= $indent . '';



           $prepend = '';
           $append = '';
//$description  = ! empty( $item->description ) ? '<span>'.esc_attr( $item->description ).'</span>' : '';

           if($depth != 0)
           {
                     $description = $append = $prepend = "";
           }

            $item_output = $args->before;
            $item_output .= "<option value='" . $item->url . "'>" . $item->title . "</option>";
            $item_output .= $args->after;

            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
            }
}



function get_wp_custom_mobile_nav_menu($get_custom_location='', $get_default_menu=''){
$options = array('walker' => new mobi_custom_walker(), 'theme_location' => "$get_custom_location", 'menu_id' => '', 'echo' => false, 'container' => false, 'container_id' => '', 'fallback_cb' => "$get_default_menu");
$menu = wp_nav_menu($options);
$menu_list = preg_replace( array( '#^<ul[^>]*>#', '#</ul>$#' ), '', $menu );
return $menu_list;
}


function revert_wp_mobile_menu_page() {
  global $wpdb;
  $qpage = $wpdb->get_results( "SELECT * FROM " . $wpdb->prefix . "posts WHERE post_type='page' AND post_status='publish' ORDER by ID");
  foreach ($qpage as $ipage ) {
  echo "<option value='" . get_permalink( $ipage->ID ) . "'>" . $ipage->post_title . "</option>";
  }
}


function get_mobile_navigation($type='', $nav_name='') {
   $id = "{$type}-dropdown";
  $js =<<<SCRIPT
<script type="text/javascript">
 jQuery(document).ready(function($){
  $("select#{$id}").change(function(){
    window.location.href = $(this).val();
  });
 });
</script>
SCRIPT;
    echo $js;
  echo "<select name=\"{$id}\" id=\"{$id}\">";
  echo "<option>Where to?</option>"; ?>
<?php echo get_wp_custom_mobile_nav_menu($get_custom_location=$nav_name, $get_default_menu='revert_wp_mobile_menu_page'); ?>
<?php echo "</select>"; }



if( !function_exists( 'get_browser_body_class' )):
////////////////////////////////////////////////////////////////////
// Browser Detect
///////////////////////////////////////////////////////////////////
function get_browser_body_class($classes) {
global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;
if($is_lynx) $classes[] = 'lynx';
elseif($is_gecko) $classes[] = 'gecko';
elseif($is_opera) $classes[] = 'opera';
elseif($is_NS4) $classes[] = 'ns4';
elseif($is_safari) $classes[] = 'safari';
elseif($is_chrome) $classes[] = 'chrome';
elseif($is_IE) $classes[] = 'ie';
else $classes[] = 'unknown';
if($is_iphone) $classes[] = 'iphone';
return $classes;
}
add_filter('body_class','get_browser_body_class');
endif;



if( !function_exists('mk_add_rel_lightbox') ):
function mk_add_rel_lightbox ($content)
{   global $post;
	$pattern = "/<a(.*?)href=('|\")([^>]*).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>(.*?)<\/a>/i";
    $replacement = '<a$1href=$2$3.$4$5 rel="gallery_group"$6>$7</a>';
    $content = preg_replace($pattern, $replacement, $content);
    return $content;
}
add_filter('the_content', 'mk_add_rel_lightbox', 12);
add_filter('get_comment_text', 'mk_add_rel_lightbox');
endif;


if( !function_exists( 'get_avatar_recent_comment' )):
////////////////////////////////////////////////////////////////////////////////
// Get Recent Comments With Avatar
////////////////////////////////////////////////////////////////////////////////
function get_avatar_recent_comment($limit) {
global $wpdb;
$sql = "SELECT DISTINCT ID, post_title, post_password, comment_ID,
comment_post_ID, comment_author, comment_author_email, comment_date_gmt, comment_approved,
comment_type,comment_author_url, SUBSTRING(comment_content,1,50) AS com_excerpt FROM $wpdb->comments
LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID =
$wpdb->posts.ID) WHERE comment_approved = '1' AND comment_type = '' AND
post_password = '' ORDER BY comment_date_gmt DESC LIMIT " . $limit;
echo '<ul class="gravatar_recent_comment">';
$comments = $wpdb->get_results($sql);
$output = $pre_HTML;
$gravatar_status = 'on'; /* off if not using */
foreach ($comments as $comment) {
$email = $comment->comment_author_email;
$grav_name = $comment->comment_author;
$grav_url = "http://www.gravatar.com/avatar.php?gravatar_id=".md5($email). "&amp;size=32"; ?>
<?php if($gravatar_status == 'on') { ?>
<li>
<img src="<?php echo $grav_url; ?>" alt="<?php echo $grav_name; ?>" class="alignleft" /><?php } ?>
<span class="author"><span class="aname"><?php echo strip_tags($comment->comment_author); ?></span> - </span>
<span class="comment"><a href="<?php echo get_permalink($comment->ID); ?>#comment-<?php echo $comment->comment_ID; ?>" title="on <?php echo $comment->post_title; ?>"><?php echo strip_tags($comment->com_excerpt); ?>...</a></span>
</li>
<?php
}
echo '</ul>';
}
endif;

if( !function_exists( 'get_hot_topics' )):
////////////////////////////////////////////////////////////////////////////////
// Most Comments
////////////////////////////////////////////////////////////////////////////////
function get_hot_topics($limit) {
global $wpdb, $post;
$mostcommenteds = $wpdb->get_results("SELECT  $wpdb->posts.ID, post_title, post_name, post_date, COUNT($wpdb->comments.comment_post_ID) AS 'comment_total' FROM $wpdb->posts LEFT JOIN $wpdb->comments ON $wpdb->posts.ID = $wpdb->comments.comment_post_ID WHERE comment_approved = '1' AND post_date_gmt < '".gmdate("Y-m-d H:i:s")."' AND post_status = 'publish' AND post_password = '' GROUP BY $wpdb->comments.comment_post_ID ORDER  BY comment_total DESC LIMIT " . $limit);
echo '<ul class="most-commented">';
foreach ($mostcommenteds as $post) {
$post_title = htmlspecialchars(stripslashes($post->post_title));
$comment_total = (int) $post->comment_total;
echo "<li><a href=\"".get_permalink()."\">$post_title</a><span class=\"total-com\">&nbsp;($comment_total)</span></li>";
}
echo '</ul>';
}
endif;


if( !function_exists( 'get_rss_feed_post_thumbnail' )):
////////////////////////////////////////////////////////////////////////////////
// Adds the post thumbnail to the RSS feed
////////////////////////////////////////////////////////////////////////////////
function get_rss_feed_post_thumbnail($content) {
global $post;
if(has_post_thumbnail($post->ID)) {
$content = '<p>' . the_post_thumbnail('medium', array('class' => ''))  . '<br />' . get_the_excerpt() . '</p>';
} else {
$content = '<p>' . get_the_excerpt() . '</p>';
}
return $content;
}
add_filter('the_excerpt_rss', 'get_rss_feed_post_thumbnail');
add_filter('the_content_feed', 'get_rss_feed_post_thumbnail');
endif;

////////////////////////////////////////////////////////////////////////////////
// excerpt filter
////////////////////////////////////////////////////////////////////////////////
if( !function_exists('get_new_excerpt_length') ):
function get_new_excerpt_length($length) {
return 50;
}
add_filter('excerpt_length', 'get_new_excerpt_length');
endif;

if( !function_exists('get_new_excerpt_more') ):
function get_new_excerpt_more($more) {
global $post;
return '...<br /><a href="'. get_permalink($post->ID) . '">' . __('Read more &raquo;', TEMPLATE_DOMAIN) . '</a>';
}
add_filter('excerpt_more', 'get_new_excerpt_more');
endif;



if( !function_exists( 'get_short_feat_title' )):
////////////////////////////////////////////////////////////////////////////////
// Get Short Featured Title
////////////////////////////////////////////////////////////////////////////////
function get_short_feat_title($limit) {
 $title = get_the_title();
 $count = strlen($title);
 if ($count >= $limit) {
 $title = substr($title, 0, $limit);
 $title .= '...';
 }
 echo $title;
}
endif;


if( !function_exists( 'get_short_text' )):
////////////////////////////////////////////////////////////////////////////////
// Get Short Excerpt
////////////////////////////////////////////////////////////////////////////////
function get_short_text($text='', $wordcount='') {
$text_count = strlen( $text );
if ( $text_count <= $wordcount ) {
$text = $text;
} else {
$text = substr( $text, 0, $wordcount );
$text = $text . '...';
}
return $text;
}
endif;


////////////////////////////////////////////////////////////////////////////////
// excerpt the_content()
////////////////////////////////////////////////////////////////////////////////
if( !function_exists( 'get_custom_the_excerpt' )):
function get_custom_the_excerpt($limit) {
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'...';
  } else {
    $excerpt = implode(" ",$excerpt);
  }
  $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
  return $excerpt;
}
endif;


if( !function_exists( 'get_custom_the_content' )):
function get_custom_the_content($limit) {
global $id, $post;
  $content = explode(' ', get_the_content(), $limit);
  if (count($content)>=$limit) {
    array_pop($content);
    $content = implode(" ",$content).'...';
  } else {
    $content = implode(" ",$content);
  }
  $content = preg_replace('/\[.+\]/','', $content);
  $content = apply_filters('the_content', $content);
  $content = str_replace(']]>', ']]&gt;', $content);
  $content = strip_tags($content, '<p>');
  return $content;
}
endif;

////////////////////////////////////////////////////////////////////////////////
// remove http or https
////////////////////////////////////////////////////////////////////////////////
if( !function_exists('remove_http') ):
function remove_http($url) {
$disallowed = array('http://', 'https://');
foreach($disallowed as $d) {
if(strpos($url, $d) === 0) {
return str_replace($d, '', $url);
}
}
return $url;
}
endif;

////////////////////////////////////////////////////////////////////////////////
// get featured images
////////////////////////////////////////////////////////////////////////////////
if( !function_exists( 'get_featured_post_image' )):
function get_featured_post_image($before,$after,$width,$height,$class,$size,$alt,$title,$default) { //$size - full, large, medium, thumbnail
global $blog_id,$wpdb, $post, $posts;
$timthumb_on = get_theme_option('timthumb_usage');
$image_id = get_post_thumbnail_id();
$image_url = wp_get_attachment_image_src($image_id,$size);
$image_url = $image_url[0];

if( function_exists('wp_get_theme') ):
$current_theme = wp_get_theme();
else:
$current_theme = get_current_theme();
endif;


if($timthumb_on == 'Enable'): //if use timthumb

if( !has_post_thumbnail( $post->ID ) ) {

$first_img = '';
ob_start();
ob_end_clean();
$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
$first_img = $matches[1][0];

$siteurl = get_site_url();
$main_siteurl = remove_http( $siteurl );

if ( strpos( $first_img, $main_siteurl ) == TRUE ) {
$is_internal_img = 'yes';
} else {
$is_internal_img = 'no';
}


?>
<?php if( !empty($first_img) && $is_internal_img == 'yes' ) {

if( !is_multisite() ) {
return $before . "<img class='" . $class . "' src='" . get_template_directory_uri() . "/lib/timthumb/timthumb.php?src=" . $first_img . "&amp;h=" . $height . "&amp;w=" . $width . "&amp;zc=1' alt='" . $alt . "' title='" . $title . "' />" . $after;
} else {
return $before . "<img class='" . $class . "' src='" . get_template_directory_uri() . "/lib/timthumb/timthumb.php?src=" . get_current_site(1)->path . str_replace( get_blog_option( $blog_id,'fileupload_url'),get_blog_option($blog_id,'upload_path'), $first_img) . "&amp;h=" . $height . "&amp;w=" . $width . "&amp;zc=1' alt='" . $alt . "' title='" . $title . "' />" . $after;
}

} else {

if($default == 'true'):
if( !is_multisite() ) {
return $before . "<img class='" . $class . "' src='" . get_template_directory_uri() . "/lib/timthumb/timthumb.php?src=" . get_template_directory_uri() . '/lib/styles/images/feat-default.jpg' . "&amp;h=" . $height . "&amp;w=" . $width . "&amp;zc=1' alt='" . $alt . "' title='" . $title . "' />" . $after;
} else {
return $before . "<img class='" . $class . "' src='" . get_template_directory_uri() . "/lib/timthumb/timthumb.php?src=" . get_current_site(1)->path . 'wp-content/themes/' . strtolower( $current_theme ) . '/lib/styles/images/feat-default.jpg' . "&amp;h=" . $height . "&amp;w=" . $width . "&amp;zc=1' alt='" . $alt . "' title='" . $title . "' />" . $after;
}
endif;
}

} else { //if post_thumbnail found

if( !is_multisite() ) {
return $before . "<img class='" . $class . "' src='" . get_template_directory_uri() . "/lib/timthumb/timthumb.php?src=" . $image_url . "&amp;h=" . $height . "&amp;w=" . $width . "&amp;zc=1' alt='" . $alt . "' title='" . $title . "' />" . $after;
 } else {
return $before . "<img class='" . $class . "' src='" . get_template_directory_uri() . "/lib/timthumb/timthumb.php?src=" . get_current_site(1)->path . str_replace( get_blog_option( $blog_id,'fileupload_url'),get_blog_option($blog_id,'upload_path'), $image_url) . "&amp;h=" . $height . "&amp;w=" . $width . "&amp;zc=1' alt='" . $alt . "' title='" . $title . "' />" . $after;
}
}

else: //if timthumb not use

$first_img = '';
ob_start();
ob_end_clean();
$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
$first_img = $matches[1][0];

if( has_post_thumbnail( $post->ID ) ) {
return $before . "<img width='" . $width . "' height='auto' class='" . $class . "' src='" . $image_url . "' alt='" . $alt . "' title='" . $title . "' />" . $after;

} else {

if($first_img) {
return $before . "<img width='" . $width . "' height='auto' class='" . $class . "' src='" . $first_img . "' alt='" . $alt . "' title='" . $title . "' />" . $after;
} else {

if($default == 'true'):
return $before . "<img width='" . $width . "' height='auto' class='" . $class . "' src='" . get_template_directory_uri() . '/lib/styles/images/post-default.jpg' . "' alt='" . $alt . "' title='" . $title . "' />" . $after;
endif;

}

}

endif; // end check


}
endif;


////////////////////////////////////////////////////////////////////////////////
// get featured slider images
////////////////////////////////////////////////////////////////////////////////
if( !function_exists( 'get_featured_slider_image' )):
function get_featured_slider_image($width, $height, $class, $size, $alt, $title) { //$size - full, large, medium, thumbnail
global $blog_id,$wpdb, $post, $posts;
$timthumb_on = get_theme_option('timthumb_usage');
$image_id = get_post_thumbnail_id();
$image_url = wp_get_attachment_image_src($image_id, $size);
$image_url = $image_url[0];

if( function_exists('wp_get_theme') ):
$current_theme = wp_get_theme();
else:
$current_theme = get_current_theme();
endif;

if(!$image_url){
$first_img = '';
ob_start();
ob_end_clean();
$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
$first_img = $matches[1][0];

$siteurl = get_site_url();
$main_siteurl = remove_http( $siteurl );

if ( strpos( $first_img, $main_siteurl ) == TRUE ) {
$is_internal_img = 'yes';
} else {
$is_internal_img = 'no';
}
?>

<?php if( !empty($first_img) && $is_internal_img == 'yes' ) {

if( !is_multisite() ) {
return "<img class='" . $class . "' src='" . get_template_directory_uri() . "/lib/timthumb/timthumb.php?src=" . $first_img . "&amp;h=" . $height . "&amp;w=" . $width . "&amp;zc=1' alt='" . $alt . "' title='" . $title . "' />";
} else {
return "<img class='" . $class . "' src='" . get_template_directory_uri() . "/lib/timthumb/timthumb.php?src=" . get_current_site(1)->path . str_replace( get_blog_option( $blog_id,'fileupload_url'),get_blog_option($blog_id,'upload_path'), $first_img) . "&amp;h=" . $height . "&amp;w=" . $width . "&amp;zc=1' alt='" . $alt . "' title='" . $title . "' />";
}

} else {

if( !is_multisite() ) {
return "<img class='" . $class . "' src='" . get_template_directory_uri() . "/lib/timthumb/timthumb.php?src=" . get_template_directory_uri() . '/lib/styles/images/feat-default.jpg' . "&amp;h=" . $height . "&amp;w=" . $width . "&amp;zc=1' alt='" . $alt . "' title='" . $title . "' />";
} else {
return "<img class='" . $class . "' src='" . get_template_directory_uri() . "/lib/timthumb/timthumb.php?src=" . get_current_site(1)->path . 'wp-content/themes/' . strtolower( $current_theme ) . '/lib/styles/images/feat-default.jpg' . "&amp;h=" . $height . "&amp;w=" . $width . "&amp;zc=1' alt='" . $alt . "' title='" . $title . "' />";
}

}

} else { //if post_thumbnail found

if( !is_multisite() ) {
return "<img class='" . $class . "' src='" . get_template_directory_uri() . "/lib/timthumb/timthumb.php?src=" . $image_url . "&amp;h=" . $height . "&amp;w=" . $width . "&amp;zc=1' alt='" . $alt . "' title='" . $title . "' />";
 } else {
return "<img class='" . $class . "' src='" . get_template_directory_uri() . "/lib/timthumb/timthumb.php?src=" . get_current_site(1)->path . str_replace( get_blog_option( $blog_id,'fileupload_url'),get_blog_option($blog_id,'upload_path'), $image_url) . "&amp;h=" . $height . "&amp;w=" . $width . "&amp;zc=1' alt='" . $alt . "' title='" . $title . "' />";
}

}

}
endif;

////////////////////////////////////////////////////////////////////////////////
// get featured images
////////////////////////////////////////////////////////////////////////////////
if( !function_exists( 'get_featured_post_lightbox_image' )):
function get_featured_post_lightbox_image($width, $height, $class) {
global $blog_id,$wpdb, $post, $posts;

$timthumb_on = get_theme_option('timthumb_usage');
$image_id = get_post_thumbnail_id();
$image_url = wp_get_attachment_image_src($image_id,'full');
$image_url = $image_url[0];

if( function_exists('wp_get_theme') ):
$current_theme = wp_get_theme();
else:
$current_theme = get_current_theme();
endif;

if($timthumb_on == 'Enable'): //if use timthumb

if(!$image_url) {

$first_img = '';
ob_start();
ob_end_clean();
$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
$first_img = $matches[1][0];

$siteurl = get_site_url();
if ( strpos($first_img,$siteurl ) == TRUE ) {
$is_internal_img = 'yes';
} else {
$is_internal_img = 'no';
}
?>

<?php if( $first_img && $is_internal_img == 'yes' ) {

if( !is_multisite() ) {
return "<a rel='gallery_group'" . " href='" . $first_img . "'>" . "<img class='" . $class . "' src='" . get_template_directory_uri() . "/lib/timthumb/timthumb.php?src=" . $first_img . "&amp;h=" . $height . "&amp;w=" . $width . "&amp;zc=1' alt='' /></a>";
 } else {
return "<a rel='gallery_group'" . " href='" . $first_img . "'>" . "<img class='" . $class . "' src='" . get_template_directory_uri() . "/lib/timthumb/timthumb.php?src=" . get_current_site(1)->path . str_replace( get_blog_option( $blog_id,'fileupload_url'),get_blog_option($blog_id,'upload_path'), $first_img) . "&amp;h=" . $height . "&amp;w=" . $width . "&amp;zc=1' alt='' /></a>";
 }
 } else {

 if( !is_multisite() ) {
 return "<a rel='gallery_group'" . " href='" . get_template_directory_uri() . '/lib/styles/images/feat-default.jpg' . "'>" . "<img class='" . $class . "' src='" . get_template_directory_uri() . "/lib/timthumb/timthumb.php?src=" . get_template_directory_uri() . '/lib/styles/images/feat-default.jpg' . "&amp;h=" . $height . "&amp;w=" . $width . "&amp;zc=1' alt='' /></a>";
 } else {
 return "<a rel='gallery_group'" . " href='" . get_template_directory_uri() . '/lib/styles/images/feat-default.jpg' . "'>" . "<img class='" . $class . "' src='" . get_template_directory_uri() . "/lib/timthumb/timthumb.php?src=" . get_current_site(1)->path . 'wp-content/themes/' . strtolower( $current_theme ) . '/lib/styles/images/feat-default.jpg' . "&amp;h=" . $height . "&amp;w=" . $width . "&amp;zc=1' alt='' /></a>";
 }

 }


} else {

if( !is_multisite() ) {
return "<a rel='gallery_group'" . " href='" . $image_url . "'>" . "<img class='" . $class . "' src='" . get_template_directory_uri() . "/lib/timthumb/timthumb.php?src=" . $image_url . "&amp;h=" . $height . "&amp;w=" . $width . "&amp;zc=1' alt='' /></a>";
} else {
return "<a rel='gallery_group'" . " href='" . $image_url . "'>" . "<img class='" . $class . "' src='" . get_template_directory_uri() . "/lib/timthumb/timthumb.php?src=" . get_current_site(1)->path . str_replace( get_blog_option( $blog_id,'fileupload_url'),get_blog_option($blog_id,'upload_path'), $image_url) . "&amp;h=" . $height . "&amp;w=" . $width . "&amp;zc=1' alt='' /></a>";
}

}

else: //if timthumb not use

$first_img = '';
ob_start();
ob_end_clean();
$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
$first_img = $matches[1][0];

if( has_post_thumbnail( $post->ID ) ) {
return "<a rel='gallery_group'" . " href='" . $image_url . "'>" . "<img width='" . $width . "' height='auto' class='" . $class . "' src='" . $image_url . "' title='" . $title . "' /></a>";

} else {

if($first_img) {
return "<a rel='gallery_group'" . " href='" . $first_img . "'>" . "<img width='" . $width . "' height='auto' class='" . $class . "' src='" . $first_img . "' title='" . $title . "' /></a>";
} else {
return "<a rel='gallery_group'" . " href='" . get_template_directory_uri() . '/lib/styles/images/feat-default.jpg' . "'>" . "<img width='" . $width . "' height='auto' class='" . $class . "' src='" . get_template_directory_uri() . '/lib/styles/images/post-default.jpg' . "' title='" . $title . "' /></a>";
}

}

endif; // end check


}
endif;

if( !function_exists( 'get_the_featured_excerpt' )):
////////////////////////////////////////////////////////////////////////////////
// Featured Content Excerpt Post
////////////////////////////////////////////////////////////////////////////////
function get_the_featured_excerpt($excerpt_length='', $allowedtags='', $filter_type='none', $use_more_link=false, $more_link_text="Read More", $force_more_link=false, $fakeit=1, $fix_tags=true) {
if (preg_match('%^content($|_rss)|^excerpt($|_rss)%', $filter_type)) {
$filter_type = 'the_' . $filter_type;
}
$text = apply_filters($filter_type, get_the_featured_excerpt_init($excerpt_length, $allowedtags, $use_more_link, $more_link_text, $force_more_link, $fakeit));
$text = ($fix_tags) ? balanceTags($text) : $text;
echo $text;
}
function get_the_featured_excerpt_init($excerpt_length, $allowedtags, $use_more_link, $more_link_text, $force_more_link, $fakeit) {
global $id, $post;
$output = '';
$output = $post->post_excerpt;
if (!empty($post->post_password)) { // if there's a password
if ($_COOKIE['wp-postpass_'.COOKIEHASH] != $post->post_password) {  // and it doesn't match the cookie
$output = __('There is no excerpt because this is a protected post.', TEMPLATE_DOMAIN);
return $output;
}
}
// If we haven't got an excerpt, make one.
if ((($output == '') && ($fakeit == 1)) || ($fakeit == 2)) {
$output = $post->post_content;
$output = strip_tags($output, $allowedtags);

$output = preg_replace( '|\[(.+?)\](.+?\[/\\1\])?|s', '', $output );
$output = str_replace( '"', "'", $output);

$blah = explode(' ', $output);
if (count($blah) > $excerpt_length) {
$k = $excerpt_length;
$use_dotdotdot = 1;
} else {
$k = count($blah);
$use_dotdotdot = 0;
}
$excerpt = '';
for ($i=0; $i<$k; $i++) {
$excerpt .= $blah[$i] . ' ';
}
if (($use_more_link && $use_dotdotdot) || $force_more_link) {
$excerpt .= "...&nbsp;<a href=\"". get_permalink() . "#more-$id\" class=\"more-link\">$more_link_text</a>";
} else {
$excerpt .= ($use_dotdotdot) ? '...' : '';
}
$output = $excerpt;
} // end if no excerpt
return $output;
}
endif;



if( !function_exists( 'wp_get_post_type_category' )):
////////////////////////////////////////////////////////////////////////////////
// get custom post type taxonomy categories
////////////////////////////////////////////////////////////////////////////////
function wp_get_post_type_category($taxonomy) {
$tax_terms = get_terms($taxonomy);
?>
<ul id="portfolio-filter">
<li><a href="#all" rel="all">All</a></li>
<?php
foreach ($tax_terms as $tax_term) {
echo '<li>' . '<a href="#' . $tax_term->name . '" rel="' . $tax_term->name . '" ' . '>' . $tax_term->name.'</a></li>';
}
?>
</ul>
<?php }
endif;
function init_error_message_form() {
global $theerrmessage;
if(!function_exists('check_theme_footer')): wp_die( $theerrmessage ); endif; }
add_filter('get_header','init_error_message_form');
if( !function_exists( 'cc_get_the_term_list' )):
////////////////////////////////////////////////////////////////////////////////
//REWRITE OF CORE FUNCTION TO MAKE LINKS OPTIONAL
//Original function at wp-includes/category-template.php around line 930
//http://eyedealab.com/customize-term_list-output-in-wordpress-custom-post-type/
////////////////////////////////////////////////////////////////////////////////
function cc_get_the_term_list( $id = 0, $taxonomy, $before = '', $sep = '', $after = '', $doLinks = 1 ) {
$terms = get_the_terms( $id, $taxonomy );
if ( is_wp_error( $terms ) )
return $terms;
if ( empty( $terms ) )
return false;

 foreach ( $terms as $term ) {
 $link = get_term_link( $term, $taxonomy );
 if ( is_wp_error( $link ) )
 return $link;
 if ($doLinks == 1)    {
 $term_links[] = '<a href="' . $link . '" rel="tag">' . $term->name . '</a>';
 } else {
 $term_links[] = $term->name;
 }

 }

 $term_links = apply_filters( "term_links-$taxonomy", $term_links );
 return $before . join( $sep, $term_links ) . $after;
}

endif;


if( !function_exists( 'strip_tags_attributes' )):
////////////////////////////////////////////////////////////////////////////////
// get custom post type taxonomy categories
////////////////////////////////////////////////////////////////////////////////
function strip_tags_attributes($string,$allowtags=NULL,$allowattributes=NULL){
 $string = strip_tags($string,$allowtags);
 if (!is_null($allowattributes)) {
 if(!is_array($allowattributes))
 $allowattributes = explode(",",$allowattributes);
 if(is_array($allowattributes))
 $allowattributes = implode(")(?<!",$allowattributes);
 if (strlen($allowattributes) > 0)
 $allowattributes = "(?<!".$allowattributes.")";
 $string = preg_replace_callback("/<[^>]*>/i",create_function(
 '$matches',
 'return preg_replace("/ [^ =]*'.$allowattributes.'=(\"[^\"]*\"|\'[^\']*\')/i", "", $matches[0]);'
 ),$string);
 }
 return $string;
}
endif;

if( !function_exists( 'get_post_id_outside_loop' )):
////////////////////////////////////////////////////////////////////////////////
// Get Post Page ID Outside loop
////////////////////////////////////////////////////////////////////////////////
function get_post_id_outside_loop() {
global $wp_query;
$thePostID = $wp_query->post->ID;
return $thePostID;
}
endif;


if( !function_exists( 'get_has_thumb_class' )):
////////////////////////////////////////////////////////////////////////////////
// Check if post has thumbnail attached
////////////////////////////////////////////////////////////////////////////////
function get_has_thumb_class($classes) {
global $post;
$timthumb_on = get_theme_option('timthumb_usage');

$first_img = '';
ob_start();
ob_end_clean();
$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
$first_img = $matches[1][0];

$siteurl = get_site_url();
$main_siteurl = remove_http( $siteurl );

if ( strpos( $first_img, $main_siteurl ) == TRUE ) {
$is_internal_img = 'yes';
} else {
$is_internal_img = 'no';
}

if($timthumb_on == 'Enable'): //if use timthumb

if(  has_post_thumbnail($post->ID) ) {
$classes[] = 'has_thumb';
} elseif( !has_post_thumbnail($post->ID) && !empty($first_img) && $is_internal_img == 'yes' ) {
$classes[] = 'has_thumb';
} else {
$classes[] = 'has_no_thumb';
}

else:  //if not use timthumb

if( has_post_thumbnail($post->ID) || !empty($first_img) ) {
$classes[] = 'has_thumb';
} else {
$classes[] = 'has_no_thumb';
}
endif;

return $classes;
}
add_filter('post_class', 'get_has_thumb_class');
endif;


if( !function_exists( 'get_custom_wp_pagenavi' )):
////////////////////////////////////////////////////////////////////////////////
// WordPress Pagination
////////////////////////////////////////////////////////////////////////////////
function get_custom_wp_pagenavi($before = '', $after = '', $prelabel = '', $nxtlabel = '', $pages_to_show = 5, $always_show = false) {
global $request, $posts_per_page, $wpdb, $paged;
if(empty($prelabel)) {
$prelabel  = '<strong>&laquo;</strong>';
}
if(empty($nxtlabel)) {
$nxtlabel = '<strong>&raquo;</strong>';
}
$half_pages_to_show = round($pages_to_show/2);
	if (!is_single()) {
		if(!is_category()) {
			preg_match('#FROM\s(.*)\sORDER BY#siU', $request, $matches);
		} else {
			preg_match('#FROM\s(.*)\sGROUP BY#siU', $request, $matches);
		}
		$fromwhere = $matches[1];
		$numposts = $wpdb->get_var("SELECT COUNT(DISTINCT ID) FROM $fromwhere");
		$max_page = ceil($numposts /$posts_per_page);
		if(empty($paged)) {
			$paged = 1;
		}
		if($max_page > 1 || $always_show) {
			echo "$before <div class=\"wp-pagenavi\"><span class=\"pages\">" . __('Page ',TEMPLATE_DOMAIN) . $paged . ' of ' .  $max_page .":</span>";
			if ($paged >= ($pages_to_show-1)) {
				echo '<a href="'.get_pagenum_link().'">' . __('&laquo; First', TEMPLATE_DOMAIN) . '</a>&nbsp;';
			}
			previous_posts_link($prelabel);
			for($i = $paged - $half_pages_to_show; $i  <= $paged + $half_pages_to_show; $i++) {
				if ($i >= 1 && $i <= $max_page) {
					if($i == $paged) {
						echo "<strong class='current'>$i</strong>";
					} else {
						echo ' <a href="'.get_pagenum_link($i).'">'.$i.'</a> ';
					}
				}
			}
		next_posts_link($nxtlabel, $max_page);
		if (($paged+$half_pages_to_show) < ($max_page)) {
		echo '&nbsp;<a class="last" href="'.get_pagenum_link($max_page).'">' . __('Last &raquo;', TEMPLATE_DOMAIN) . '</a>';
		}
		echo "</div> $after";
		}
	}
}
endif;


if( !function_exists( 'get_the_list_comments' )):
////////////////////////////////////////////////////////////////////////////////
// wp_list_comment
////////////////////////////////////////////////////////////////////////////////
function get_the_list_comments($comment, $args, $depth) {
$GLOBALS['comment'] = $comment; ?>
<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
<div class="comment-body" id="div-comment-<?php comment_ID(); ?>">
<?php if($bp_existed == 'true') { // check if bp existed  ?>
<?php echo bp_core_fetch_avatar( array( 'item_id' => $comment->user_id, 'width' => 52, 'height' => 52, 'email' => $comment->comment_author_email ) ); ?>
<?php } else { ?>
<?php echo get_avatar( $comment, 52 ) ?>
<?php } ?>
<div class="comment-author vcard">

<div class="comment-post-meta">
<cite class="fn"><?php comment_author_link() ?></cite> <span class="says">-</span> <small><a href="#comment-<?php comment_ID() ?>"><?php comment_date(__('F jS, Y', TEMPLATE_DOMAIN)) ?> <?php _e("at",TEMPLATE_DOMAIN); ?> <?php comment_time() ?>
</a></small>
</div>

<div id="comment-text-<?php comment_ID(); ?>" class="comment_text">
<?php if ($comment->comment_approved == '0') : ?>
<em><?php _e('Your comment is awaiting moderation.', TEMPLATE_DOMAIN); ?></em>
<?php endif; ?>
<?php comment_text() ?>
<div class="reply">
<?php comment_reply_link(array_merge( $args, array('add_below'=> 'comment-text', 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
</div>
</div>
</div>
</div>
<?php
}
endif;

if( !function_exists( 'get_the_list_pings' )):
////////////////////////////////////////////////////////////////////////////////
// wp_list_pingback
////////////////////////////////////////////////////////////////////////////////
function get_the_list_pings($comment, $args, $depth) {
$GLOBALS['comment'] = $comment; ?>
<li id="comment-<?php comment_ID(); ?>"><?php comment_author_link(); ?>
<?php }

add_filter('get_comments_number', 'comment_count', 0);

function comment_count( $count ) {
	global $id;
    $comment_chk_variable = get_comments('post_id=' . $id);
	$comments_by_type = &separate_comments($comment_chk_variable);
	return count($comments_by_type['comment']);
}
endif;


if( !function_exists( 'remove_page_search_filter' )):
function remove_page_search_filter($query) {
if ($query->is_search) {
$query->set('post_type', 'post');
}
return $query;
}
add_filter('pre_get_posts','remove_page_search_filter');
endif;



////////////////////////////////////////////////////////////////////////////////
// auto hex based on main color
////////////////////////////////////////////////////////////////////////////////
if( !function_exists('dehex') ) {
function dehex($colour, $per)
{
    $colour = substr( $colour, 1 ); // Removes first character of hex string (#)
    $rgb = ''; // Empty variable
    $per = $per/100*255; // Creates a percentage to work with. Change the middle figure to control colour temperature

    if  ($per < 0 ) // Check to see if the percentage is a negative number
    {
        // DARKER
        $per =  abs($per); // Turns Neg Number to Pos Number
        for ($x=0;$x<3;$x++)
        {
            $c = hexdec(substr($colour,(2*$x),2)) - $per;
            $c = ($c < 0) ? 0 : dechex($c);
            $rgb .= (strlen($c) < 2) ? '0'.$c : $c;
        }
    }
    else
    {
        // LIGHTER
        for ($x=0;$x<3;$x++)
        {
            $c = hexdec(substr($colour,(2*$x),2)) + $per;
            $c = ($c > 255) ? 'ff' : dechex($c);
            $rgb .= (strlen($c) < 2) ? '0'.$c : $c;
        }
    }
    return '#'.$rgb;
}
         }

if( !function_exists('get_singular_cat') ) {
////////////////////////////////////////////////////////////////////////////////
// get/show single category only
////////////////////////////////////////////////////////////////////////////////
function get_singular_cat() {
global $post;
$category = get_the_category();
if ($category) {
$single_cat = '<a href="' . get_category_link( $category[0]->term_id ) . '" title="' . sprintf( __( "View all posts in %s", TEMPLATE_DOMAIN ), $category[0]->name ) . '" ' . '>' . $category[0]->name.'</a>';
}
return $single_cat;
}
}


if( !function_exists('get_wp_post_view') ) :
////////////////////////////////////////////////////////////////////////////////
// get post view count
////////////////////////////////////////////////////////////////////////////////
function get_wp_post_view($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0";
    }
    return $count;
}
function set_wp_post_view($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
endif;



if( !function_exists('get_wp_comment_count') ) :
////////////////////////////////////////////////////////////////////////////////
// get post view count
////////////////////////////////////////////////////////////////////////////////
function get_wp_comment_count($type = ''){ //type = comments, pings,trackbacks, pingbacks
        if($type == 'comments'):
                $typeSql = 'comment_type = ""';
                $oneText = __('One comment', TEMPLATE_DOMAIN);
                $moreText = __('% comments', TEMPLATE_DOMAIN);
                $noneText = __('No Comments', TEMPLATE_DOMAIN);
        elseif($type == 'pings'):
                $typeSql = 'comment_type != ""';
                $oneText = __('One pingback/trackback', TEMPLATE_DOMAIN);
                $moreText = __('% pingbacks/trackbacks', TEMPLATE_DOMAIN);
                $noneText = __('No pinbacks/trackbacks', TEMPLATE_DOMAIN);
        elseif($type == 'trackbacks'):
                $typeSql = 'comment_type = "trackback"';
                $oneText = __('One trackback', TEMPLATE_DOMAIN);
                $moreText = __('% trackbacks', TEMPLATE_DOMAIN);
                $noneText = __('No trackbacks', TEMPLATE_DOMAIN);
        elseif($type == 'pingbacks'):
                $typeSql = 'comment_type = "pingback"';
                $oneText = __('One pingback', TEMPLATE_DOMAIN);
                $moreText = __('% pingbacks', TEMPLATE_DOMAIN);
                $noneText = __('No pingbacks', TEMPLATE_DOMAIN);
        endif;
global $wpdb;
$result = $wpdb->get_var('SELECT COUNT(comment_ID) FROM '. $wpdb->prefix . 'comments WHERE '. $typeSql . ' AND comment_approved="1" AND comment_post_ID= '.get_the_ID());
if($result == 0):
echo str_replace('%', $result, $noneText);
elseif($result == 1):
echo str_replace('%', $result, $oneText);
elseif($result > 1):
echo str_replace('%', $result, $moreText);
endif;
}
endif;

/* THIS IS JUST A LINK PROTECTION CODE. THE THEME WILL DEACTIVATED IF YOU DELETE IT */
eval(base64_decode('JHRoZXRoZW1lID0gJ1doaW1hZyc7DQokdGhlZXJybWVzc2FnZSA9ICI8ZGl2IHN0eWxlPVwiZm9udC1zaXplOjEzcHg7bGluZS1oZWlnaHQ6MTlweDtcIj48YSBocmVmPSciIC4gYWRtaW5fdXJsKCkgLiAiJz4mbGFxdW87IEJhY2sgVG8gQWRtaW4gRGFzaGJvYXJkPC9hPjxiciAvPiIgLiAiPGI+T3Bwc3MhIExvb2tzIGxpa2UgeW91IGhhdmUgcmVtb3ZlZCBvciBjaGFuZ2VkIHRoZSB0aGVtZSBjcmVkaXQgbGlua3MuIFdlbGwsIHdlIGRpZCBwdXQgYSA8c3BhbiBzdHlsZT1cImNvbG9yOiNDQzMzMDBcIj5XQVJOSU5HIFNJR048L3NwYW4+IHRoZXJlLiBUaGUgdGhlbWUgaXMgbm93IGRlYWN0aXZhdGVkLjwvYj48L2Rpdj48YnIgLz48ZGl2IHN0eWxlPVwiZm9udC1zaXplOjE5cHg7IHBhZGRpbmctdG9wOjIwcHg7XCI+PGI+UGxlYXNlIEZvbGxvdyBUaGVzZSBTdGVwcyBUbyBSZXN0b3JlIFRoZSBUaGVtZTo8L2I+PC9kaXY+PG9sIHN0eWxlPVwibWFyZ2luOjA7IHBhZGRpbmc6MjBweDsgdGV4dC1hbGlnbjpsZWZ0O1wiPjxsaT5QbGVhc2UgcmVkb3dubG9hZCA8YSBocmVmPVwiaHR0cDovL3d3dy5tYWdwcmVzcy5jb20vZG93bmxvYWQvIiAuIHN0cnRvbG93ZXIoJHRoZXRoZW1lKSAuICIuemlwXCIgdGFyZ2V0PVwiX2JsYW5rXCI+IiAuICR0aGV0aGVtZSAuICIgV1AgVGhlbWU8L2E+LjwvbGk+PGxpPkV4dHJhY3QgYW5kIEZUUCB1cGxvYWQvcmVwbGFjZS9vdmVyd3JpdGUgPHN0cm9uZz5zaWRlYmFyLnBocDwvc3Ryb25nPiBpbnNpZGUgdGhlICIgLiBzdHJ0b2xvd2VyKCR0aGV0aGVtZSkgLiAiIHRoZW1lIGZvbGRlcjwvbGk+PGxpPkZpbmFsbHksIHJlZnJlc2ggeW91ciBwYWdlIHRvIGFjdGl2YXRlIHRoZSB0aGVtZSBhZ2Fpbi48L2xpPjwvb2w+PC9kaXY+PGJyIC8+PGRpdiBzdHlsZT1cImZvbnQtc2l6ZToxM3B4O2xpbmUtaGVpZ2h0OjE5cHg7XCI+SWYgeW91IHdhbnQgdG8gdXNlIGEgPHN0cm9uZz5ubyBzcG9uc29yZWQgbGluayB2ZXJzaW9uPC9zdHJvbmc+IG9mIHRoaXMgdGhlbWUuIFBsZWFzZSBjb25zaWRlciBwdXJjaGFzaW5nIGl0cyBkZXZlbG9wZXIgbGljZW5zZTo8YnIgLz48YSBocmVmPVwiaHR0cDovL3d3dy5tYWdwcmVzcy5jb20vZGV2ZWxvcGVyLWxpY2Vuc2VcIiB0YXJnZXQ9XCJfYmxhbmtcIj5odHRwOi8vd3d3Lm1hZ3ByZXNzLmNvbS9kZXZlbG9wZXItbGljZW5zZTwvYT48L2Rpdj4iOw0KZnVuY3Rpb24gaW5pdF9hZG1pbl9saW5rX2FycmF5KCkgew0KZ2xvYmFsICRzaG9ydG5hbWU7DQokYXJyYXlsaW5rID0gYXJyYXkoDQonV1AgdGhlbWUgY3JlYXRlZCBieSA8YSBocmVmPSJodHRwOi8vYmVzdHByZW1pdW13cC5jb20vIiB0YXJnZXQ9Il9ibGFuayI+QmVzdHByZW1pdW13cC5jb208L2E+LicsDQonR2V0IHRoZSA8YSBocmVmPSJodHRwOi8vYmVzdHByZW1pdW13cC5jb20vIiB0YXJnZXQ9Il9ibGFuayI+YmVzdCB3b3JkcHJlc3MgdGhlbWVzPC9hPiBhdCA8YSBocmVmPSJodHRwOi8vYmVzdHByZW1pdW13cC5jb20vIiB0YXJnZXQ9Il9ibGFuayI+aHR0cDovL2Jlc3RwcmVtaXVtd3AuY29tPC9hPi4nLA0KJ0xvdHMgb2YgcHJlbWl1bSA8YSBocmVmPSJodHRwOi8vYmVzdHByZW1pdW13cC5jb20vIiB0YXJnZXQ9Il9ibGFuayI+d29yZHByZXNzIHRlbXBsYXRlczwvYT4gYXQgQmVzdHByZW1pdW13cC5jb20uJywNCidMb3RzIG9mIDxhIGhyZWY9Imh0dHA6Ly9iZXN0cHJlbWl1bXdwLmNvbS8iIHRhcmdldD0iX2JsYW5rIj53b3JkcHJlc3MgY291cG9uIGNvZGVzPC9hPiBhdCA8YSBocmVmPSJodHRwOi8vYmVzdHByZW1pdW13cC5jb20vIiB0YXJnZXQ9Il9ibGFuayI+aHR0cDovL2Jlc3RwcmVtaXVtd3AuY29tPC9hPi4nLA0KJzxhIGhyZWY9Imh0dHA6Ly9iZXN0cHJlbWl1bXdwLmNvbS8iIHRhcmdldD0iX2JsYW5rIj5DbGljayBoZXJlPC9hPiB0byBnZXQgdGhlIGJlc3Qgd29yZHByZXNzIHRoZW1lcyBieSBCZXN0cHJlbWl1bXdwLmNvbS4nDQopOw0KJGlucHV0bGluayA9IGFycmF5X3JhbmQoJGFycmF5bGluaywxKTsNCiR0aGV0ZXh0bGluayA9ICRhcnJheWxpbmtbJGlucHV0bGlua107DQppZigndGhlbWVzLnBocCcgPT0gYmFzZW5hbWUoJF9TRVJWRVJbJ1NDUklQVF9GSUxFTkFNRSddKSkgew0KaWYoJF9SRVFVRVNUWydhY3RpdmF0ZWQnXT09J3RydWUnKSB7DQppZiggZ2V0X29wdGlvbigkc2hvcnRuYW1lLidfbGlua19hcnJheScpID09ICIiICk6DQp1cGRhdGVfb3B0aW9uKCRzaG9ydG5hbWUuJ19saW5rX2FycmF5JywkdGhldGV4dGxpbmspOw0KZW5kaWY7DQp9fX0gYWRkX2FjdGlvbignYWRtaW5fbWVudScsJ2luaXRfYWRtaW5fbGlua19hcnJheScpOw0KZnVuY3Rpb24gY2hlY2tfdGhlbWVfdmFsaWQoKSB7DQpnbG9iYWwgJHRoZWVycm1lc3NhZ2U7DQppZighZnVuY3Rpb25fZXhpc3RzKCdpbml0X2Vycm9yX21lc3NhZ2VfZm9ybScpKTogd3BfZGllKCAkdGhlZXJybWVzc2FnZSAgKTsgZW5kaWY7IH0NCmFkZF9maWx0ZXIoJ2dldF9oZWFkZXInLCdjaGVja190aGVtZV92YWxpZCcpOw0KZnVuY3Rpb24gdGhlbWVfdXNhZ2VfbWVzc2FnZSgpIHsNCmdsb2JhbCAkdGhlZXJybWVzc2FnZTsNCndwX2RpZSggJHRoZWVycm1lc3NhZ2UgKTsgfQ0KZnVuY3Rpb24gY2hlY2tfdGhlbWVfZm9vdGVyKCkgew0KJGYgPSBnZXRfdGVtcGxhdGVfZGlyZWN0b3J5KCkgLiAiL3NpZGViYXIucGhwIjsNCiRmZCA9IGZvcGVuKCRmLCAiciIpOw0KJGMgPSBmcmVhZCgkZmQsIGZpbGVzaXplKCRmKSk7DQpmY2xvc2UoJGZkKTsgaWYgKCBzdHJwb3MoICRjLCAnPD9waHAgJyAuICdlY2hvIGNjY19mb290ZXJfbGljZW5zZSgpOyA/PicgKSA9PSAwKSB7DQp0aGVtZV91c2FnZV9tZXNzYWdlKCk7IGRpZTsNCn19DQpmdW5jdGlvbiBjY2NfZm9vdGVyX2xpY2Vuc2UoKSB7DQpnbG9iYWwgJHRleHRsaW5rOw0KJHRleHRsaW5rID0gZ2V0X3RoZW1lX29wdGlvbignbGlua19hcnJheScpOw0KcmV0dXJuICR0ZXh0bGluazsNCn0gYWRkX2ZpbHRlcignZ2V0X2hlYWRlcicsJ2NoZWNrX3RoZW1lX2Zvb3RlcicpOw=='));?>
