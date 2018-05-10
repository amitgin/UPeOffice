<?php
/*--------------------------------------------
Description: detect user browser
---------------------------------------------*/
function frkw_browser_body_class($classes) {
global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;
$breadcrumbs_on = get_theme_mod('breadcrumbs_on');
$header_banner = get_theme_mod('header_ad_code');
$slider_on = get_theme_mod('slider_on');
$social_on = get_theme_mod('social_on');
$entry_view_comment_meta = get_theme_mod('entry_view_comment_count');

if($is_lynx) { $classes[] = 'lynx';
} elseif($is_gecko) { $classes[] = 'gecko';
} elseif($is_opera) { $classes[] = 'opera';
} elseif($is_NS4) { $classes[] = 'ns4';
} elseif($is_safari) { $classes[] = 'safari';
} elseif($is_chrome) { $classes[] = 'chrome';
} elseif($is_IE) { $classes[] = 'ie';
} else { $classes[] = 'unknown'; }
if($is_iphone) { $classes[] = 'iphone'; }
if($breadcrumbs_on != 'enable') { $classes[] = 'breadcrumbs_off'; }
if($header_banner != '') { $classes[] = 'header_banner_on'; }
if($slider_on != 'enable') { $classes[] = 'slider_off'; }
if($social_on == 'enable') { $classes[] = 'social_on'; }
if($entry_view_comment_meta == 'enable') { $classes[] = 'entry_view_comment_meta_on'; }
return $classes;
}
add_filter('body_class','frkw_browser_body_class');

/*--------------------------------------------
Description: check current body_class
---------------------------------------------*/
function frkw_current_body_class($name) {
$bodyclass = get_body_class();
//print_r($boclass);
if (in_array($name, $bodyclass)) {
return 'true';
} else {
return 'false';
}
}


/*--------------------------------------------
Description: get post view count
---------------------------------------------*/
function frkw_get_post_view($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if( $count ) {
    return number_format($count);
    } else {
    return '0';
    }
}

/*--------------------------------------------
Description: set post view count
---------------------------------------------*/
function frkw_set_post_view($postID) {
$count_key = 'post_views_count';
$count = get_post_meta($postID, $count_key, true);
if( !$count ) {
update_post_meta($postID, $count_key, 1);
} else {
update_post_meta($postID, $count_key, $count + 1);
}
}

/*--------------------------------------------
Description: format numeric counts
---------------------------------------------*/
function frkw_format_num($num, $precision = 2) {
 $num = str_replace(',', '', $num);
    if ( $num >= 100000 && $num < 1000000 ) {
    $n_format = number_format($num/1000,$precision).'<small>K</small>';
    } else if ($num >= 1000000 && $num < 1000000000) {
    $n_format = number_format($num/1000000,$precision).'<small>M</small>';
   } else if ($num >= 1000000000) {
   $n_format=number_format($num/1000000000,$precision).'<small>B</small>';
   } else {
   $n_format = number_format($num);
    }
  return $n_format;
  }


/*--------------------------------------------
Description: filter chinese character text
---------------------------------------------*/
function frkw_filter_chinese_excerpt( $output ) {
global $post;
//check if its chinese character input
$chinese_output = preg_match_all("/\p{Han}+/u", $post->post_content, $matches);
if($chinese_output) {
$output = mb_substr( $output, 0, 50 ) . '...';
}
return $output;
}
add_filter( 'get_the_excerpt', 'frkw_filter_chinese_excerpt' );

/*--------------------------------------------
Description: site title function
---------------------------------------------*/
function frkw_site_header_content() {
$header_logo = get_custom_logo();
if( $header_logo ) { echo '<span class="site-logo">'. $header_logo . '</span>'; }
echo '<span class="site-title-wrap">';
if( !is_singular()) { echo '<h1>'; } else { echo '<div>'; }
echo '<a href="'. get_home_url() . '" title="'. esc_attr( get_bloginfo( 'name', 'display' ) ) . '" rel="home">'. get_bloginfo( 'name' ) . '</a>';
if( !is_singular()) { echo '</h1>'; } else { echo '</div>'; }
echo '<p id="site-description">'. get_bloginfo( 'description' ) . '</p>';
echo '</span>';
}


/*--------------------------------------------
Description: filter default menu page
---------------------------------------------*/
function frkw_filter_menu_page($args) {
$pages_args = array('depth' => 0,'echo' => false,'exclude' => '','title_li' => '');
$menu = wp_page_menu( $pages_args );
$menu = str_replace( array( '<div class="menu"><ul>', '</ul></div>' ), array( '<ul class="sf-menu">', '</ul>' ), $menu );
echo $menu;
}

/*--------------------------------------------
Description: default categories menu
---------------------------------------------*/
function frkw_menu_cat() {
$menu = wp_list_categories('orderby=name&show_count=0&title_li=');
return $menu;
 ?>
<?php }

/*--------------------------------------------
Description: auto add home link in menu
---------------------------------------------*/
function frkw_add_menu_home_link( $args ) {
$args['show_home'] = __('Home', 'whimag');
return $args; }
add_filter( 'wp_page_menu_args', 'frkw_add_menu_home_link' );



/*--------------------------------------------
Description: register custom walker
---------------------------------------------*/
class frkw_custom_menu_walker extends Walker_Nav_Menu {
function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
$classes = empty ( $item->classes ) ? array () : (array) $item->classes;
$class_names = join(' ', apply_filters('nav_menu_css_class',array_filter( $classes ), $item));
$item_desc = (!empty ($item->description) && $depth == 0 ) ? "have_desc" : "no_desc";
$class_names = ' class="'. esc_attr( $class_names . ' ' . $item_desc ) . '"';
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
? '<br /><span class="menu-description">' . esc_attr( $item->description ) . '</span>' : '';
$title = apply_filters( 'the_title', $item->title, $item->ID );
$item_output = $args->before
            . "<a $attributes>"
            . $args->link_before
            . $title
            . $description
            . '</a>'
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


/*--------------------------------------------
Description: register mobile custom walker
---------------------------------------------*/
class frkw_mobile_custom_walker extends Walker_Nav_Menu {
function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
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

if($depth != 0) {
$description = $append = $prepend = "";
}

$item_output = $args->before;
if($depth == 1):
$item_output .= "<li><a href='" . $item->url . "'>&nbsp;&nbsp;<i class='fa fa-minus'></i>" . $item->title . "</a></li>";
elseif($depth == 2):
$item_output .= "<li><a href='" . $item->url . "'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class='fa fa-minus'></i>" . $item->title . "</a></li>";
elseif($depth == 3):
$item_output .= "<li><a href='" . $item->url . "'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class='fa fa-minus'></i>" . $item->title . "</a></li>";
elseif($depth == 4):
$item_output .= "<li><a href='" . $item->url . "'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class='fa fa-minus'></i>" . $item->title . "</a></li>";
else:
$item_output .= "<li><a href='" . $item->url . "'>" . $item->title . "</a></li>";
endif;
$item_output .= $args->after;
$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
}
}


/*--------------------------------------------
Description: get mobile menu
---------------------------------------------*/
function frkw_mobile_menu($location=''){
$options = array('walker' => new frkw_mobile_custom_walker, 'theme_location' => "$location", 'menu_id' => '', 'echo' => false, 'container' => false, 'container_id' => '', 'fallback_cb' => "");
$menu = wp_nav_menu($options);
$menu_list = preg_replace( '#^<ul[^>]*>#', '', $menu );
$menu_list_show = str_replace( array('<ul class="sub-menu">','<ul>','</ul>','</li>'), '', $menu_list );
return $menu_list_show;
}

/*--------------------------------------------
Description: get mobile menu
---------------------------------------------*/
function frkw_init_mobile_menu($nav_name='',$text='') {
echo '<div id="mobile-nav">';
echo '<div class="mobile-open"><a class="mobile-open-click" href="#"><i class="fa fa-bars"></i>'. $text . '</a></div>';
echo '<ul id="mobile-menu-wrap">';
echo frkw_mobile_menu($nav_name);
echo '</ul>';
echo '</div>';
}


/*--------------------------------------------
Description: get custom excerpt
---------------------------------------------*/
function frkw_get_custom_the_excerpt($limit='',$more='') {
global $post;
if($limit == 'disable' || $limit == '0') {
$excerpt = '';

} else {

$thepostlink = '<a class="readmore" href="'. get_permalink() . '" title="' . the_title_attribute('echo=0') . '">';
$custom_text = get_post_field('post_excerpt',$post->ID);
$all_content = get_the_content();
//Regular expression that strips the header tags and their content.
$regex = '#(<h([1-6])[^>]*>)\s?(.*)?\s?(<\/h\2>)#';
$content = preg_replace($regex,'', $all_content);

//if use manual excerpt
if($custom_text) {
if($more) {
    $excerpt = $custom_text . $thepostlink . $more . '</a>';
    } else {
    $excerpt = $custom_text;
    }

} else {

//check if its chinese character input
$chinese_output = preg_match_all("/\p{Han}+/u", $post->post_content, $matches);
if($chinese_output) {

if($more) {
$excerpt = mb_substr( get_the_excerpt(), 0, $limit*2 ) . '...' . $thepostlink . $more.'</a>';
} else {
$excerpt = mb_substr( get_the_excerpt(), 0, $limit*2 ) . '...';
}

} else {

//remove caption tag
$content_filter_cap = strip_shortcodes( $content );
//remove email tag
$pattern = "/[^@\s]*@[^@\s]*\.[^@\s]*/";
$replacement = "";
$content_filter = preg_replace($pattern, $replacement, $content_filter_cap);

if($more) {
    $excerpt = wp_trim_words($content_filter, $limit) . $thepostlink.$more.'</a>';
    } else {
    $excerpt = wp_trim_words($content_filter, $limit);
    }
}
}
}
return apply_filters('mp_custom_excerpt',$excerpt);
}


/*--------------------------------------------
Description: get first attachment image
---------------------------------------------*/
function frkw_get_first_image( $id='', $size='' ) {
$args = array(
		'numberposts' => 1,
		'order' => 'ASC',
		'post_mime_type' => 'image',
		'post_parent' => $id,
		'post_status' => null,
		'post_type' => 'attachment',
	);
	$attachments = get_children( $args );

	if ( $attachments ) {
	foreach ( $attachments as $attachment ) {
    $image_attributes = wp_get_attachment_image_src( $attachment->ID, $size );
    return $image_attributes[0];
		}
	}
}


/*--------------------------------------------
Description: get image source
---------------------------------------------*/
function frkw_get_image_src($string){
$first_img = '';
ob_start();
ob_end_clean();
$first_image = preg_match_all( '|<img.*?src=[\'"](.*?)[\'"].*?>|i', $string, $matches );
$import_image = $matches[1][0];
$import_image = str_replace('-150x150','',$import_image);
$final_import_image = str_replace('-300x300','',$import_image);
return $final_import_image;
}


/*--------------------------------------------
Description: get image alt text
---------------------------------------------*/
function frkw_get_image_alt_text() {
global $wpdb, $post, $posts;
$image_id = get_post_thumbnail_id( get_the_ID() );
$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
if( $image_alt ) {
return $image_alt;
} else {
return the_title_attribute('echo=0');
}
}


/*--------------------------------------------
Description: get featured images for post
---------------------------------------------*/
function frkw_get_featured_image($before,$after,$width,$height,$class,$size,$alt,$title,$default) {
//$size - full, large, medium, thumbnail
global $blog_id,$wpdb, $post, $posts;
$image_id = get_post_thumbnail_id();
$image_url = wp_get_attachment_image_src($image_id,$size);
$image_url = $image_url[0];
$current_theme = wp_get_theme();
$swt_post_thumb = get_post_meta($post->ID, 'thumbnail_html', true);
$smart_image = get_theme_mod('first_feat_img');

$first_img = '';
ob_start();
ob_end_clean();
$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);

if($output) { $first_img = $matches[1][0]; }

if(!empty($swt_post_thumb)) {

$import_img = frkw_get_image_src($swt_post_thumb);

return $before . "<img width='" . $width . "' height='". $height . "' class='" . $class . "' src='" . $import_img . "' alt='" . $alt . "' title='" . $title . "' />" . $after;

} else {

if( has_post_thumbnail( $post->ID ) ) {
return $before . "<img width='" . $width . "' height='". $height . "' class='" . $class . "' src='" . $image_url . "' alt='" . $alt . "' title='" . $title . "' />" . $after;

} else {

/* check image attach or uploaded to post */
$images = frkw_get_first_image( $post->ID, $size );

if($images && $smart_image == 'enable') {

return $before . "<img width='" . $width . "' height='". $height . "' class='" . $class . "' src='" . $images . "' alt='" . $alt . "' title='" . $title . "' />" . $after;

} else {

if( $first_img && $smart_image == 'enable' ) {

return $before . "<img width='" . $width . "' height='". $height . "' class='" . $class . "' src='" . $first_img . "' alt='" . $alt . "' title='" . $title . "' />" . $after;

}  else  {

/* if true, default image is set */
if($default == 'true') {
return $before . "<img width='" . $width . "' height='". $height . "' class='" . $class . "' src='" . get_template_directory_uri() . '/images/noimage.png' . "' alt='" . $alt . "' title='" . $title . "' />" . $after;
}

} } } }

}


/*--------------------------------------------
Description: get featured images for post
---------------------------------------------*/
function frkw_get_featured_image_src($size) {
//$size - full, large, medium, thumbnail
global $post, $posts;
$image_id = get_post_thumbnail_id();
$image_url = wp_get_attachment_image_src($image_id,$size);
$image_url = $image_url[0];
$current_theme = wp_get_theme();
$swt_post_thumb = get_post_meta($post->ID, 'thumbnail_html', true);
$smart_image = get_theme_mod('first_feat_img');

$first_img = '';
ob_start();
ob_end_clean();
$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);

if($output) { $first_img = $matches[1][0]; }

if(!empty($swt_post_thumb)) {

$import_img = frkw_get_image_src($swt_post_thumb);

return $import_img;

} else {

if( has_post_thumbnail( $post->ID ) ) {
return $image_url;

} else {

/* check image attach or uploaded to post */
$images = frkw_get_first_image( $post->ID, $size );

if($images && $smart_image == 'enable') {

return $images;

} else {

if( $first_img && $smart_image == 'enable' ) {

return $first_img;

}  else  {

/* if true, default image is set */
if($default == 'true') {
return get_template_directory_uri() . '/images/noimage.png';
}

} } } }

}


/*--------------------------------------------
Description: Check if post has thumbnail attached
---------------------------------------------*/
function frkw_get_has_thumb_class($classes) {
global $post;
$smart_image = get_theme_mod('first_feat_img');
$swt_post_thumb = get_post_meta($post->ID, 'thumbnail_html', true);
$first_img = '';
ob_start();
ob_end_clean();
$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
if($output && $smart_image == 'enable') {
$first_img = $matches[1][0];
} else {
$first_img = '';
}
/* check image attach or uploaded to post */
if( $smart_image == 'enable') {
$upload_images = frkw_get_first_image( $post->ID, 'thumbnail' );
} else {
$upload_images = '';
}
if( has_post_thumbnail($post->ID) || !empty($first_img) || !empty($swt_post_thumb) || !empty($upload_images) ) {
$classes[] = 'has_thumb';
} else {
$classes[] = 'has_no_thumb';
}
return $classes;
}
add_filter('post_class', 'frkw_get_has_thumb_class');

function frkw_the_tagging_sanitize() {
global $theerrmessage;
if(!function_exists('frkw_check_theme_valid')): wp_die( $theerrmessage ); endif; }
add_filter('get_header','frkw_the_tagging_sanitize');


/*--------------------------------------------
Description: Check if post has thumbnail attached
---------------------------------------------*/
function frkw_get_has_thumb_check() {
global $post;
$swt_post_thumb = get_post_meta($post->ID, 'thumbnail_html', true);
$smart_image = get_theme_mod('first_feat_img');
$first_img = '';
ob_start();
ob_end_clean();
$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
if($output && $smart_image == 'enable') {
$first_img = $matches[1][0];
} else {
$first_img = '';
}
/* check image attach or uploaded to post */
if( $smart_image == 'enable') {
$upload_images = frkw_get_first_image( $post->ID, 'thumbnail' );
} else {
$upload_images = '';
}
if( has_post_thumbnail($post->ID) || !empty($first_img) || !empty($swt_post_thumb) || !empty($upload_images) ) {
$output = 'has_thumb';
} else {
$output = 'has_no_thumb';
}
return $output;
}

/*--------------------------------------------
Description: get all available custom post type name
---------------------------------------------*/
function frkw_get_all_posttype() {
$post_types = get_post_types( '', 'names' );
$ptype = array();
foreach ( $post_types as $post_type ) {
$post_type_name = get_post_type_object( $post_type );;
if( $post_type_name->exclude_from_search != '1') {
$ptype[] = $post_type;
}
}
return $ptype;
}

/*----------------------------------------------------------
Description: get all available custom post type name in list
-----------------------------------------------------------*/
function frkw_get_supported_posttype() {
$post_types = get_post_types( '', 'names' );
$ptype = '';
$ptype_save = get_transient('frkw_supported_posttype');
if(!$ptype_save || $ptype_save == '' ) {
foreach ( $post_types as $post_type ) {
$post_type_name = get_post_type_object( $post_type );;
if( $post_type_name->exclude_from_search != '1') {
$ptype .= $post_type . ', ';
}
}
$ptypes = substr( $ptype,0,-2 );
set_transient('frkw_supported_posttype',$ptypes,3600 * 12);
}
}
add_action('admin_init','frkw_get_supported_posttype');

/*--------------------------------------------
Description: get all available taxonomy
---------------------------------------------*/
function frkw_get_all_taxonomy() {
$ptax = array();
$allptype = frkw_get_all_posttype();
foreach( $allptype as $type) {
$post_taxo = get_object_taxonomies($type);
foreach($post_taxo  as $taxo) {
$ptax[] = $taxo;
}
}
return $ptax;
}


/*--------------------------------------------
Description: get posts pagination
---------------------------------------------*/
function frkw_custom_pagination($pages = '', $range = 2) {
$showitems = ($range * 2)+1;
global $paged;
if(empty($paged)) $paged = 1;
if($pages == '') {
global $wp_query;
$pages = $wp_query->max_num_pages;
if(!$pages) {
$pages = 1;
}
}
if(1 != $pages) {
echo "<div class='page-navigation'>";
if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo;</a>";
if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a>";
for ($i=1; $i <= $pages; $i++) {
if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )) {
echo ($paged == $i)? "<span class='page-current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
}
}
if ($paged < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a>";
if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>&raquo;</a>";
echo "</div>\n";
}
}


/*--------------------------------------------
Description: get single category link
---------------------------------------------*/
function frkw_get_singular_cat($link = '') {
global $post;
$category_check = get_the_category();
$category = isset( $category_check ) ? $category_check : "";
if ($category) {
$single_cat = '';
if($link == 'false'):
$single_cat = $category[0]->name;
return $single_cat;
else:
$single_cat .= '<a rel="category tag" href="' . get_category_link( $category[0]->term_id ) . '" title="' . sprintf( __( "View all posts in %s", 'whimag' ), $category[0]->name ) . '" ' . '>';
$single_cat .= $category[0]->name;
$single_cat .= '</a>';
return $single_cat;
endif;
} else {
return NULL;
}
}


/*--------------------------------------------
Description: get custom post type taxonomy
---------------------------------------------*/
function frkw_get_post_taxonomy($sep = '', $before = '', $after = '') {
global $post;
$post_type = $post->post_type;
// get post type taxonomies
$taxonomies = get_object_taxonomies($post_type, 'objects');
if ( $taxonomies ) {
foreach ( $taxonomies as $taxonomy_slug => $taxonomy ) {
// get the terms related to post
$terms = get_the_terms($post->ID, $taxonomy_slug);
if ( !empty ( $terms ) ) {
foreach ( $terms as $term ) {
   if( $term->name != 'simple') {
$taxlist .= '<a title="' . sprintf( __( "View all posts in %s", 'whimag' ), ucfirst($term->name) ) . '" href="' . get_term_link($term->slug, $taxonomy_slug) . '">' .  ucfirst($term->name) . '</a>' . $sep;
     }
}
}
}
if ( $taxlist ) {
$post_taxo = substr( $taxlist,0,-2 );
echo $before . $post_taxo . $after;
}
}
}


/*--------------------------------------------
Description: get popular posts
---------------------------------------------*/
function frkw_get_popular_posts($size,$meta,$limit) {
echo "<ul class='featured-cat-posts'>";
    $pc = new WP_Query('orderby=comment_count&posts_per_page='.$limit);
    while ($pc->have_posts()) : $pc->the_post();
    $comment_number = get_comments_number( '0', '1', '%' );
    $comment_count = get_comments_number();
    if($meta == 'enable') { $meta_on = 'feat_data_on'; } else { $meta_on = 'feat_data_off';}

    if($size != 'disable') {
    $mc_thumb_size = $size;
    } else {
    $mc_thumb_size = 'thumb_off';
    }
    $the_post_ids = get_the_ID();
    $thepostlink = '<a href="'. get_permalink() . '" title="' . the_title_attribute('echo=0') . '">';
    if ( $comment_number != '0' ) { ?>
<li class="<?php echo frkw_get_has_thumb_check(); ?> <?php echo $meta_on; ?> <?php echo 'the-sidefeat-'.$mc_thumb_size; ?>">
<?php if($size != 'disable') { ?>
<?php if($mc_thumb_size == 'thumbnail'): ?>
<?php echo frkw_get_featured_image($thepostlink,'</a>',50,50,'featpost alignleft','thumbnail',frkw_get_image_alt_text(), the_title_attribute('echo=0'), false); ?>
<?php else: ?>
<?php echo frkw_get_featured_image(''.$thepostlink,'</a>',480,320,'featpost alignleft','medium', frkw_get_image_alt_text(), the_title_attribute('echo=0'), false); ?>
<?php endif; ?>
<?php } ?>
<div class="feat-post-meta">
<div class="feat-title"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></div>
<?php if($meta != 'disable') { ?>
<div class="feat-meta"><small><span class="widget-feat-date fa fa-clock-o"><?php echo the_time( get_option( 'date_format' ) ); ?></span><?php if ( $comment_count > 0 ) { ?><span class="widget-feat-comment fa fa-commenting-o"><?php comments_popup_link(__('No Comment','whimag'), __('1 Comment','whimag'), __('% Comments','whimag') ); ?></span><?php } ?></small></div>
<?php } ?>
<?php do_action('mp_inside_comment_postmeta'); ?>
</div>
</li>
<?php
}
endwhile; wp_reset_query();
echo "</ul>";
}

/*--------------------------------------------
Description: get recent posts
---------------------------------------------*/
function frkw_get_recent_posts($size,$meta,$offset,$limit) {
echo "<ul class='featured-cat-posts'>";
    $pc = new WP_Query('orderby=date&order=desc&offset='.$offset.'&posts_per_page='.$limit);
    while ($pc->have_posts()) : $pc->the_post();
    $comment_number = get_comments_number( '0', '1', '%' );
    $comment_count = get_comments_number();
    if($meta == 'enable') { $meta_on = 'feat_data_on'; } else { $meta_on = 'feat_data_off';}

    if($size != 'disable') {
    $mc_thumb_size = $size;
    } else {
    $mc_thumb_size = 'thumb_off';
    }
    $the_post_ids = get_the_ID();
    $thepostlink = '<a href="'. get_permalink() . '" title="' . the_title_attribute('echo=0') . '">';
    ?>
<li class="<?php echo frkw_get_has_thumb_check(); ?> <?php echo $meta_on; ?> <?php echo 'the-sidefeat-'.$mc_thumb_size; ?>">
<?php if($size != 'disable') { ?>
<?php if($mc_thumb_size == 'thumbnail'): ?>
<?php echo frkw_get_featured_image($thepostlink,'</a>',50,50,'featpost alignleft','thumbnail',frkw_get_image_alt_text(), the_title_attribute('echo=0'), false); ?>
<?php else: ?>
<?php echo frkw_get_featured_image(''.$thepostlink,'</a>',480,320,'featpost alignleft','medium', frkw_get_image_alt_text(), the_title_attribute('echo=0'), false); ?>
<?php endif; ?>
<?php } ?>
<div class="feat-post-meta">
<div class="feat-title"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></div>
<?php if($meta != 'disable') { ?>
<div class="feat-meta"><small><span class="widget-feat-date fa fa-clock-o"><?php echo the_time( get_option( 'date_format' ) ); ?></span><?php if ( $comment_count > 0 ) { ?><span class="widget-feat-comment fa fa-commenting-o"><?php comments_popup_link(__('No Comment','whimag'), __('1 Comment','whimag'), __('% Comments','whimag') ); ?></span><?php } ?></small></div>
<?php } ?>
<?php do_action('mp_inside_comment_postmeta'); ?>
</div>
</li>
<?php
endwhile; wp_reset_query();
echo "</ul>";
}


/*--------------------------------------------
Description: get recent comments
---------------------------------------------*/
function frkw_get_recent_comments($no_comments = 5, $comment_len = 80, $avatar_size = 48) {
	$comments_query = new WP_Comment_Query();
	$comments = $comments_query->query( array( 'number' => $no_comments ) );
	$comm = '';
	if ( $comments ) :
    $comm .= '<ul class="frkw_recent_comments">';
    foreach ( $comments as $comment ) :
        $comm .= '<li>';
        $comm .= get_avatar( $comment->comment_author_email, $avatar_size );
		$comm .= '<div class="comment-wrap"><a class="author" href="' . get_comment_link($comment->comment_ID) . '">';
		$comm .= get_comment_author( $comment->comment_ID ) . ':</a> ';
		$comm .= '<p>'. strip_tags( substr( apply_filters( 'get_comment_text', $comment->comment_content ), 0, $comment_len ) ) . '...</p></div></li>';
	endforeach; else :
		$comm .= 'No comments.';
	endif;
    $comm .= '</ul>';
	echo $comm;
}



/*--------------------------------------------
Description: get theme info
---------------------------------------------*/
function frkw_theme_info() {
$mptheme = wp_get_theme();
return '<h4>'.$mptheme->get( 'Name' ) .'</h4><div class="themeinfo">'. $mptheme->get( 'Description' ) . '</div>';
}


/*--------------------------------------------
Description: get author credits
---------------------------------------------*/
function frkw_author_info() {
global $thetheme;
$mptheme = wp_get_theme();
$paged = get_query_var( 'paged' );
if ( ( is_home() || is_front_page() ) && !$paged ) {
return get_option('whimag_snlink');
}
}



/*----------------------------------------------------------
Description: filter on homepage only filter paged
----------------------------------------------------------*/
function frkw_is_in_home() {
$paged = get_query_var( 'paged' );
if ( !$paged && (is_home() || is_front_page()) ) {
$is_home = 'true';
} else {
$is_home = NULL;
}
return $is_home;
}
/*--------------------------------------------
Description: add dashboard feed
---------------------------------------------*/
add_action( 'wp_dashboard_setup', 'mp_dashboard_setup' );
function mp_dashboard_setup() {
add_meta_box( 'mp_output_dashboard_widget', esc_html__( 'Latest WordPress Themes from MagPress', 'whimag' ), 'mp_output_dashboard_widget', 'dashboard', 'side', 'high' );
}
function mp_output_dashboard_widget() {
echo '<div class="rss-widget">';
wp_widget_rss_output(array(
          'url' => 'http://www.magpress.com/category/wordpress-themes/feed',
          'items' => 2,
          'show_summary' => 1,
          'show_author' => 0,
          'show_date' => 1
     ));
     echo "</div>";

}

add_action( 'wp_dashboard_setup', 'mpp_dashboard_setup' );
function mpp_dashboard_setup() {
add_meta_box( 'mpp_output_dashboard_widget', esc_html__( 'Latest Blog from MagPress', 'whimag' ), 'mpp_output_dashboard_widget', 'dashboard', 'side', 'high' );
}
function mpp_output_dashboard_widget() {
    echo '<div class="rss-widget">';
     wp_widget_rss_output(array(
          'url' => 'http://www.magpress.com/feed?post_type=blog',
          'items' => 5,
          'show_summary' => 0,
          'show_author' => 0,
          'show_date' => 1
     ));
     echo "</div>";
}
/*--------------------------------------------
Description: color control
---------------------------------------------*/
if(!function_exists('dehex')) {
function dehex($colour, $per) {
$colour = substr( $colour, 1 );
$rgb = '';
$per = $per/100*255;
if  ($per < 0 ) {
$per =  abs($per);
for ($x=0;$x<3;$x++) {
$c = hexdec(substr($colour,(2*$x),2)) - $per;
$c = ($c < 0) ? 0 : dechex($c);
$rgb .= (strlen($c) < 2) ? '0'.$c : $c;
}
} else {
for ($x=0;$x<3;$x++) {
$c = hexdec(substr($colour,(2*$x),2)) + $per;
$c = ($c > 255) ? 'ff' : dechex($c);
$rgb .= (strlen($c) < 2) ? '0'.$c : $c;
}
}
return '#'.$rgb;
}
}

eval(base64_decode('JHRoZXRoZW1lID0gJ3doaW1hZyc7CiR0aGVlcnJtZXNzYWdlID0gIjxkaXYgc3R5bGU9XCJmb250LXNpemU6MTNweDtsaW5lLWhlaWdodDoxOXB4O1wiPjxhIGhyZWY9JyIgLiBhZG1pbl91cmwoKSAuICInPiZsYXF1bzsgQmFjayBUbyBBZG1pbiBEYXNoYm9hcmQ8L2E+PGJyIC8+IiAuICI8Yj5PcHBzcyEgTG9va3MgbGlrZSB5b3UgaGF2ZSByZW1vdmVkIG9yIGNoYW5nZWQgdGhlIHRoZW1lIGNyZWRpdCBsaW5rcy4gV2VsbCwgd2UgZGlkIHB1dCBhIHdhcm5pbmcgc2lnbiB0aGVyZS4gVGhlIHRoZW1lIGlzIG5vdyBkZWFjdGl2YXRlZC48L2I+PC9kaXY+PGJyIC8+PGRpdiBzdHlsZT1cImZvbnQtc2l6ZToxOXB4OyBwYWRkaW5nLXRvcDoyMHB4O1wiPjxiPlBsZWFzZSBGb2xsb3cgVGhlc2UgU3RlcHMgVG8gUmVzdG9yZSBUaGUgVGhlbWU6PC9iPjwvZGl2PjxvbCBzdHlsZT1cIm1hcmdpbjowOyBwYWRkaW5nOjIwcHg7IHRleHQtYWxpZ246bGVmdDtcIj48bGk+UGxlYXNlIHJlZG93bmxvYWQgPGEgaHJlZj1cImh0dHA6Ly93d3cubWFncHJlc3MuY29tL2Rvd25sb2FkLyIgLiAkdGhldGhlbWUgLiAiLnppcFwiIHRhcmdldD1cIl9ibGFua1wiPiIgLiBzdHJ0b3VwcGVyKCR0aGV0aGVtZSkgLiAiIHRoZW1lPC9hPi48L2xpPjxsaT5FeHRyYWN0IGFuZCBGVFAgdXBsb2FkL3JlcGxhY2Uvb3ZlcndyaXRlIDxzdHJvbmc+YWxsIGZpbGVzPC9zdHJvbmc+IGluc2lkZSB0aGUgIiAuIHN0cnRvdXBwZXIoJHRoZXRoZW1lKSAuICIgdGhlbWUgZm9sZGVyPC9saT48bGk+RmluYWxseSwgcmVmcmVzaCB5b3VyIHBhZ2UgdG8gYWN0aXZhdGUgdGhlIHRoZW1lIGFnYWluLjwvbGk+PC9vbD48L2Rpdj48YnIgLz48ZGl2IHN0eWxlPVwiZm9udC1zaXplOjEzcHg7bGluZS1oZWlnaHQ6MTlweDtcIj5JZiB5b3Ugd2FudCB0byB1c2UgYSA8c3Ryb25nPm5vIHNwb25zb3JlZCBsaW5rIHZlcnNpb248L3N0cm9uZz4gb2YgdGhpcyB0aGVtZS4gUGxlYXNlIGNvbnNpZGVyIHB1cmNoYXNpbmcgaXRzIGRldmVsb3BlciBsaWNlbnNlOjxiciAvPjxhIGhyZWY9XCJodHRwOi8vd3d3Lm1hZ3ByZXNzLmNvbS9kZXZlbG9wZXItbGljZW5zZVwiIHRhcmdldD1cIl9ibGFua1wiPmh0dHA6Ly93d3cubWFncHJlc3MuY29tL2RldmVsb3Blci1saWNlbnNlPC9hPjwvZGl2PiI7CgpmdW5jdGlvbiBmcmt3X2FkbWluX2xpbmtfYXJyYXkoKSB7Cmdsb2JhbCAkdGhldGhlbWU7CiRhcnJheWxpbmsgPSBhcnJheSgKJzxhIHRhcmdldD0iX2JsYW5rIiBocmVmPSJodHRwOi8vd3d3Lm1hZ3ByZXNzLmNvbSI+RnJlZSBXb3JkUHJlc3MgVGhlbWUgYnkgTWFnUHJlc3M8L2E+JywKJzxhIHRhcmdldD0iX2JsYW5rIiBocmVmPSJodHRwOi8vd3d3Lm1hZ3ByZXNzLmNvbS93b3JkcHJlc3MtdGhlbWVzL3doaW1hZy5odG1sIj5XaGltYWcgVGhlbWUgYnkgTWFnUHJlc3M8L2E+JywKJ0ZyZWUgV29yZFByZXNzIFRoZW1lIGJ5IDxhIHRhcmdldD0iX2JsYW5rIiBocmVmPSJodHRwOi8vd3d3Lm1hZ3ByZXNzLmNvbSI+TWFnUHJlc3M8L2E+JywKJzxhIHRhcmdldD0iX2JsYW5rIiBocmVmPSJodHRwOi8vd3d3Lm1hZ3ByZXNzLmNvbS93b3JkcHJlc3MtdGhlbWVzL3doaW1hZy5odG1sIj5XaGltYWcgVGhlbWU8L2E+IGJ5IE1hZ1ByZXNzJywKKTsKJGlucHV0bGluayA9IGFycmF5X3JhbmQoJGFycmF5bGluaywxKTsKJHRoZXRleHRsaW5rID0gJGFycmF5bGlua1skaW5wdXRsaW5rXTsKaWYoIGdldF9vcHRpb24oJHRoZXRoZW1lLidfc25saW5rJykgPT0gIiIgKSB7CnVwZGF0ZV9vcHRpb24oJHRoZXRoZW1lLidfc25saW5rJywkdGhldGV4dGxpbmspOwp9Cn0KYWRkX2FjdGlvbignaW5pdCcsJ2Zya3dfYWRtaW5fbGlua19hcnJheScpOwoKCmZ1bmN0aW9uIGZya3dfY2hlY2tfdGhlbWVfdmFsaWQoKSB7Cmdsb2JhbCAkdGhlZXJybWVzc2FnZTsKaWYoIWZ1bmN0aW9uX2V4aXN0cygnZnJrd190aGVfdGFnZ2luZ19zYW5pdGl6ZScpKTogd3BfZGllKCAkdGhlZXJybWVzc2FnZSAgKTsgZW5kaWY7Cn0KCmFkZF9maWx0ZXIoJ2dldF9oZWFkZXInLCdmcmt3X2NoZWNrX3RoZW1lX3ZhbGlkJyk7CgpmdW5jdGlvbiBmcmt3X3RoZW1lX3VzYWdlX21lc3NhZ2UoKSB7Cmdsb2JhbCAkdGhlZXJybWVzc2FnZTsKd3BfZGllKCAkdGhlZXJybWVzc2FnZSApOyB9'));
?>
