<?php
/*--------------------------------------------
Description: add sidebars widget
---------------------------------------------*/
function frkw_theme_widgets_init() {

    register_sidebar(array(
    'name'=>__('Right Sidebar', 'whimag'),
    'id' => 'right-sidebar',
	'description' => __( 'Right sidebar widget area', 'whimag' ),
	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget' => '</aside>',
	'before_title' => '<h3 class="widget-title">',
	'after_title' => '</h3>',
	));

     register_sidebar(array(
    'name'=>__('Tabbed Sidebar', 'whimag'),
    'id' => 'tabbed-sidebar',
	'description' => __( 'Tabbed sidebar widget area', 'whimag' ),
    'before_widget' => '<div class="tabbertab"><aside id="%1$s" class="widget %2$s">',
    'after_widget' => '</aside></div>',
	'before_title' => '<h3 class="widget-title">',
	'after_title' => '</h3>',
	));


     register_sidebar(array(
    'name'=>__('Footer One', 'whimag'),
    'id' => 'first-footer-widget-area',
	'description' => __( 'Footer one widget area', 'whimag' ),
	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget' => '</aside>',
	'before_title' => '<h3 class="widget-title">',
	'after_title' => '</h3>',
	));

    register_sidebar(array(
    'name'=>__('Footer Two', 'whimag'),
    'id' => 'second-footer-widget-area',
	'description' => __( 'Footer two widget area', 'whimag' ),
	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget' => '</aside>',
	'before_title' => '<h3 class="widget-title">',
	'after_title' => '</h3>',
	));


    register_sidebar(array(
    'name'=>__('Footer Three', 'whimag'),
    'id' => 'third-footer-widget-area',
	'description' => __( 'Footer three widget area', 'whimag' ),
	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget' => '</aside>',
	'before_title' => '<h3 class="widget-title">',
	'after_title' => '</h3>',
	));

          register_sidebar(array(
        'name'=>__('Footer Four', 'whimag'),
        'id' => 'fourth-footer-widget-area',
	'description' => __( 'Footer four widget area', 'whimag' ),
	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget' => '</aside>',
	'before_title' => '<h3 class="widget-title">',
	'after_title' => '</h3>',
	));


}
add_action( 'widgets_init', 'frkw_theme_widgets_init' );




/*----------------------------------------------------
Description: add recent post with thumbnail widget
----------------------------------------------------*/
class frkw_recent_posts_widget extends WP_Widget {
function __construct()  {
parent::__construct(false, $name = __('Recent Posts Featured Image', 'whimag'), array(
'description' => __('Display recent posts with featured images.', 'whimag')
));
}

function widget($args, $instance) {
extract($args);
$mc_name = empty($instance['title']) ? __('Recent Posts', 'whimag') : apply_filters('widget_title', $instance['title']);
$mc_number = isset($instance['number']) ? $instance['number'] : "5";
$mc_thumb = isset($instance['commentthumb']) ? $instance['commentthumb'] : "";
$mc_data = isset($instance['commentdata']) ? $instance['commentdata'] : "";
$mc_offset = isset($instance['postoffset']) ? $instance['postoffset'] : "";
$unique_id = $args['widget_id'];

    echo $before_widget;
    echo $before_title . $mc_name . $after_title;
    echo "<ul class='featured-cat-posts'>";
    $pc = new WP_Query('orderby=date&offset='. $mc_offset . '&posts_per_page='.$mc_number);
    while ($pc->have_posts()) : $pc->the_post();

    $comment_number = get_comments_number( '0', '1', '%' );
    $comment_count = get_comments_number();

    if($mc_data == 'enable') { $mc_data_on = 'feat_data_on'; } else { $mc_data_on = 'feat_data_off';}

    if($mc_thumb != 'disable') {
    $mc_thumb_size = isset($instance['commentthumb']) ? $instance['commentthumb'] : "";
    } else {
    $mc_thumb_size = 'thumb_off';
    }
    $the_post_ids = get_the_ID();
    $thepostlink = '<a href="'. get_permalink() . '" title="' . the_title_attribute('echo=0') . '">';
 ?>
<li class="<?php echo frkw_get_has_thumb_check(); ?> <?php echo $mc_data_on; ?> <?php echo 'the-sidefeat-'.$mc_thumb_size; ?>">
<?php if($mc_thumb != 'disable') { ?>
<?php if($mc_thumb_size == 'thumbnail'): ?>
<?php echo frkw_get_featured_image($thepostlink,'</a>',50,50,'featpost alignleft','thumbnail',frkw_get_image_alt_text(), the_title_attribute('echo=0'), false); ?>
<?php else: ?>
<?php echo frkw_get_featured_image(''.$thepostlink,'</a>',480,320,'featpost alignleft','medium', frkw_get_image_alt_text(), the_title_attribute('echo=0'), false); ?>
<?php endif; ?>
<?php } ?>

<div class="feat-post-meta">
<h5 class="feat-title"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h5>
<?php if($mc_data != 'disable') { ?>
<div class="feat-meta"><small><span class="widget-feat-date fa fa-clock-o"><?php echo the_time( get_option( 'date_format' ) ); ?></span><span class="widget-feat-comment fa fa-commenting-o"><?php comments_popup_link(__('No Comment','whimag'), __('1 Comment','whimag'), __('% Comments','whimag') ); ?></span></small></div>
<?php } ?>
<?php do_action('mp_inside_comment_postmeta'); ?>
</div>
</li>
<?php
    endwhile; wp_reset_postdata();
    echo '</ul>';
    echo $after_widget;
}


function update($new_instance, $old_instance) {return $new_instance;}

function form($instance) {
global $choose_count;
$mc_name = isset($instance['title']) ? $instance['title'] : "";
$mc_number = isset($instance['number']) ? $instance['number'] : "";
$mc_thumb = isset($instance['commentthumb']) ? $instance['commentthumb'] : "";
$mc_data = isset($instance['commentdata']) ? $instance['commentdata'] : "";
$mc_offset = isset($instance['postoffset']) ? $instance['postoffset'] : "";
?>
<p>
<label for="<?php echo $this->get_field_id('title'); ?>">
<?php _e('Title:', 'whimag'); ?>
<input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" class="widefat" value="<?php echo $mc_name;?>" /></label></p>


<p><label for="<?php echo $this->get_field_id('commentthumb'); ?>"><?php _e('Enable Thumbnails?:<br /><em>*post featured images</em>', 'whimag'); ?></label>
<select class="widefat" id="<?php echo $this->get_field_id('commentthumb'); ?>" name="<?php echo $this->get_field_name('commentthumb'); ?>">
<option<?php if($mc_thumb == 'disable') { echo " selected='selected'"; } ?> name="<?php echo $this->get_field_name('commentthumb'); ?>" value="disable"><?php _e('Disable', 'whimag'); ?></option>
<option<?php if($mc_thumb== 'thumbnail') { echo " selected='selected'"; } ?> name="<?php echo $this->get_field_name('commentthumb'); ?>" value="thumbnail"><?php _e('Thumbnail', 'whimag'); ?></option>
<option<?php if($mc_thumb== 'medium') { echo " selected='selected'"; } ?> name="<?php echo $this->get_field_name('commentthumb'); ?>" value="medium"><?php _e('Medium', 'whimag'); ?></option>
</select>
</p>

<p><label for="<?php echo $this->get_field_id('commentdata'); ?>"><?php _e('Enable Post Meta?:<br /><em>*post date and post comment count etc</em>', 'whimag'); ?></label>
<select class="widefat" id="<?php echo $this->get_field_id('commentdata'); ?>" name="<?php echo $this->get_field_name('commentdata'); ?>">
<option<?php if($mc_data == 'enable') { echo " selected='selected'"; } ?> name="<?php echo $this->get_field_name('commentdata'); ?>" value="enable"><?php _e('Enable', 'whimag'); ?></option>
<option<?php if($mc_data == 'disable') { echo " selected='selected'"; } ?> name="<?php echo $this->get_field_name('commentdata'); ?>" value="disable"><?php _e('Disable', 'whimag'); ?></option>
</select>
</p>


<p>
<label for="<?php echo $this->get_field_id('postoffset'); ?>">
<?php _e('Offset Recent Posts: ex: -1 or -3 etc', 'whimag'); ?>
<input id="<?php echo $this->get_field_id('postoffset'); ?>" name="<?php echo $this->get_field_name('postoffset'); ?>" type="text" class="widefat" value="<?php echo $mc_offset;?>" /></label>
</p>


<p>
<label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('How many to show: ', 'whimag');?>
<select class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>">
<?php
foreach( $choose_count as $count ) {
if( $mc_number == $count ) { $selected = " selected='selected'"; } else { $selected = "";}
echo '<option'. $selected . ' name="'. $this->get_field_name('number') . '" value="'. $count . '">' . $count . '</option>';
}
?>

</select>

</label>
</p>

<?php
}
}




/*----------------------------------------------------
Description: add most commented/popular posts widget
----------------------------------------------------*/
class frkw_popular_posts_widget extends WP_Widget {
function __construct()  {
parent::__construct(false, $name = __('Popular Posts', 'whimag'), array(
'description' => __('Display most commented and popular posts.', 'whimag')
));
}

function widget($args, $instance) {
extract($args);
$mc_name = empty($instance['title']) ? __('Popular Posts', 'whimag') : apply_filters('widget_title', $instance['title']);
$mc_number = isset($instance['number']) ? $instance['number'] : "5";
$mc_thumb = isset($instance['commentthumb']) ? $instance['commentthumb'] : "";
$mc_data = isset($instance['commentdata']) ? $instance['commentdata'] : "";
$unique_id = $args['widget_id'];

    echo $before_widget;
    echo $before_title . $mc_name . $after_title;
    echo "<ul class='featured-cat-posts'>";
    $pc = new WP_Query('orderby=comment_count&posts_per_page='.$mc_number);
    while ($pc->have_posts()) : $pc->the_post();

    $comment_number = get_comments_number( '0', '1', '%' );
    $comment_count = get_comments_number();

    if($mc_data == 'enable') { $mc_data_on = 'feat_data_on'; } else { $mc_data_on = 'feat_data_off';}

    if($mc_thumb != 'disable') {
    $mc_thumb_size = isset($instance['commentthumb']) ? $instance['commentthumb'] : "";
    } else {
    $mc_thumb_size = 'thumb_off';
    }
    $the_post_ids = get_the_ID();
    $thepostlink = '<a href="'. get_permalink() . '" title="' . the_title_attribute('echo=0') . '">';
    if ( $comment_number != '0' ) { ?>

<li class="<?php echo frkw_get_has_thumb_check(); ?> <?php echo $mc_data_on; ?> <?php echo 'the-sidefeat-'.$mc_thumb_size; ?>">
<?php if($mc_thumb != 'disable') { ?>
<?php if($mc_thumb_size == 'thumbnail'): ?>
<?php echo frkw_get_featured_image($thepostlink,'</a>',50,50,'featpost alignleft','thumbnail',frkw_get_image_alt_text(), the_title_attribute('echo=0'), false); ?>
<?php else: ?>
<?php echo frkw_get_featured_image(''.$thepostlink,'</a>',480,320,'featpost alignleft','medium', frkw_get_image_alt_text(), the_title_attribute('echo=0'), false); ?>
<?php endif; ?>
<?php } ?>

<div class="feat-post-meta">
<h5 class="feat-title"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h5>
<?php if($mc_data != 'disable') { ?>
<div class="feat-meta"><small><span class="widget-feat-date fa fa-clock-o"><?php echo the_time( get_option( 'date_format' ) ); ?></span><?php if ( $comment_count > 0 ) { ?><span class="widget-feat-comment fa fa-commenting-o"><?php comments_popup_link(__('No Comment','whimag'), __('1 Comment','whimag'), __('% Comments','whimag') ); ?></span><?php } ?></small></div>
<?php } ?>
<?php do_action('mp_inside_comment_postmeta'); ?>
</div>
</li>
<?php
    }
    endwhile;
    echo '</ul>';
    echo $after_widget;
}


function update($new_instance, $old_instance) {return $new_instance;}

function form($instance) {
global $choose_count;
$mc_name = isset($instance['title']) ? $instance['title'] : "";
$mc_number = isset($instance['number']) ? $instance['number'] : "";
$mc_thumb = isset($instance['commentthumb']) ? $instance['commentthumb'] : "";
$mc_data = isset($instance['commentdata']) ? $instance['commentdata'] : "";
?>
<p>
<label for="<?php echo $this->get_field_id('title'); ?>">
<?php _e('Title:', 'whimag'); ?>
<input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" class="widefat" value="<?php echo $mc_name;?>" /></label></p>


<p><label for="<?php echo $this->get_field_id('commentthumb'); ?>"><?php _e('Enable Thumbnails?:<br /><em>*post featured images</em>', 'whimag'); ?></label>
<select class="widefat" id="<?php echo $this->get_field_id('commentthumb'); ?>" name="<?php echo $this->get_field_name('commentthumb'); ?>">
<option<?php if($mc_thumb == 'disable') { echo " selected='selected'"; } ?> name="<?php echo $this->get_field_name('commentthumb'); ?>" value="disable"><?php _e('Disable', 'whimag'); ?></option>
<option<?php if($mc_thumb== 'thumbnail') { echo " selected='selected'"; } ?> name="<?php echo $this->get_field_name('commentthumb'); ?>" value="thumbnail"><?php _e('Thumbnail', 'whimag'); ?></option>
<option<?php if($mc_thumb== 'medium') { echo " selected='selected'"; } ?> name="<?php echo $this->get_field_name('commentthumb'); ?>" value="medium"><?php _e('Medium', 'whimag'); ?></option>
</select>
</p>

<p><label for="<?php echo $this->get_field_id('commentdata'); ?>"><?php _e('Enable Post Meta?:<br /><em>*post date and post comment count etc</em>', 'whimag'); ?></label>
<select class="widefat" id="<?php echo $this->get_field_id('commentdata'); ?>" name="<?php echo $this->get_field_name('commentdata'); ?>">
<option<?php if($mc_data == 'enable') { echo " selected='selected'"; } ?> name="<?php echo $this->get_field_name('commentdata'); ?>" value="enable"><?php _e('Enable', 'whimag'); ?></option>
<option<?php if($mc_data == 'disable') { echo " selected='selected'"; } ?> name="<?php echo $this->get_field_name('commentdata'); ?>" value="disable"><?php _e('Disable', 'whimag'); ?></option>
</select>
</p>

<p>
<label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('How many to show: ', 'whimag');?>
<select class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>">
<?php
foreach( $choose_count as $count ) {
if( $mc_number == $count ) { $selected = " selected='selected'"; } else { $selected = "";}
echo '<option'. $selected . ' name="'. $this->get_field_name('number') . '" value="'. $count . '">' . $count . '</option>';
}
?>

</select>

</label>
</p>

<?php
}
}



/*--------------------------------------------
Description: custom recent comments widget
---------------------------------------------*/
class frkw_recent_comments_widget extends WP_Widget {
function __construct() {
//Constructor
parent::__construct(false, $name = __('Custom Recent Comments', 'whimag'), array(
'description' => __('Display your most recent comments.', 'whimag')
));
}
function widget($args, $instance) {
// outputs the content of the widget
extract($args); // Make before_widget, etc available.
$rc_name = empty($instance['title']) ? __('Custom Recent Comments', 'whimag') : apply_filters('widget_title', $instance['title']);

$rc_number = isset($instance['number']) ? $instance['number'] : "";
$rc_avatar = isset($instance['avatar_on']) ? $instance['avatar_on'] : "";

$unique_id = $args['widget_id'];

global $wpdb;

$sql = "SELECT DISTINCT ID, post_title, post_password, comment_ID,
comment_post_ID, comment_author, comment_author_email, comment_date_gmt, comment_approved,
comment_type,comment_author_url,
SUBSTRING(comment_content,1,50) AS com_excerpt
FROM $wpdb->comments
LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID =
$wpdb->posts.ID)
WHERE post_type IN ('post','page') AND comment_approved = '1' AND comment_type = '' AND
post_password = ''
ORDER BY comment_date_gmt DESC LIMIT $rc_number";

$comments = $wpdb->get_results($sql);
$pre_HTML = '';
$output = $pre_HTML;
echo $before_widget;
echo $before_title . $rc_name . $after_title;
echo "<ul class='custom_recent_comment'>";
foreach ($comments as $comment) {
$grav_email = $comment->comment_author_email;
$grav_name = $comment->comment_author;
$grav_url = "http://www.gravatar.com/avatar.php?gravatar_id=".md5($grav_email). "&amp;size=32";
$comtext = strip_tags($comment->com_excerpt);
?>
<li>
<?php if($rc_avatar == 'yes') {  ?><?php echo get_avatar( $grav_email, '32'); ?><?php } ?>
<?php if($rc_avatar == 'yes') { ?><div class="custom-comment-meta"><?php } ?>
<span class="comment-author"><span class="comment-name"><?php echo strip_tags($comment->comment_author); ?></span> - </span>
<span class="comment-text"><a href="<?php echo get_comment_link($comment->comment_ID); ?>" title="<?php _e('Comment on', 'whimag'); ?> <?php echo strip_tags($comment->post_title); ?>"><?php echo $comtext; ?>...</a></span>
<?php if($rc_avatar == 'yes') { ?></div><?php } ?>
</li>
<?php
}
echo "</ul> ";
echo $after_widget;
?>
<?php }

function update($new_instance, $old_instance) {
global $choose_count;
//update and save the widget
return $new_instance;
}
function form($instance) {
global $choose_count;
// Get the options into variables, escaping html characters on the way
$rc_name = isset($instance['title']) ? $instance['title'] : "";
$rc_number = isset($instance['number']) ? $instance['number'] : "";
$rc_avatar = isset($instance['avatar_on']) ? $instance['avatar_on'] : "";
?>

<p>
<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Name for recent comment(optional):', 'whimag'); ?>
<input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" class="widefat" value="<?php echo $rc_name; ?>" /></label></p>

<p>
<label for="<?php echo $this->get_field_id('avatar_on'); ?>"><?php _e('Enable avatar?:', 'whimag'); ?></label>
<select id="<?php echo $this->get_field_id('avatar_on'); ?>" name="<?php echo $this->get_field_name('avatar_on'); ?>">
<option<?php if($rc_avatar == 'yes') { echo " selected='selected'"; } ?> name="<?php echo $this->get_field_name('avatar_on'); ?>" value="yes"><?php _e('yes', 'whimag'); ?></option>
<option<?php if($rc_avatar == 'no') { echo " selected='selected'"; } ?> name="<?php echo $this->get_field_name('avatar_on'); ?>" value="no"><?php _e('no', 'whimag'); ?></option>
</select>
</p>


<p>
<label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('How many to show: ', 'whimag');?>
<select class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>">
<?php
foreach( $choose_count as $count ) {
if( $rc_number == $count ) { $selected = " selected='selected'"; } else { $selected = "";}
echo '<option'. $selected . ' name="'. $this->get_field_name('number') . '" value="'. $count . '">' . $count . '</option>';
}
?>

</select>

</label>
</p>

<?php
}
}



/*--------------------------------------------
Description: multi featured category widget
---------------------------------------------*/
class frkw_multi_featured_category_widget extends WP_Widget {
function __construct() {
//Constructor
parent::__construct(false, $name = __('Featured Categories', 'whimag'), array(
'description' => __('Display your featured category listing.', 'whimag')
));
}
function widget($args, $instance) {
global $bp_existed, $post;
// outputs the content of the widget
extract($args); // Make before_widget, etc available.

$feat_title = empty($instance['title']) ? __('Featured Categories', 'whimag') : apply_filters('widget_title', $instance['title']);

$feat_name = isset($instance['featcatname']) ? $instance['featcatname'] : "";
$feat_thumb = isset($instance['featthumb']) ? $instance['featthumb'] : "";

if($feat_thumb == 'yes') {
$feat_thumb_size = isset($instance['featthumbsize']) ? $instance['featthumbsize'] : "";
} else {
$feat_thumb_size = 'thumb_off';
}

$feat_data = isset($instance['featdata']) ? $instance['featdata'] : "";
$feat_total = isset($instance['feattotal']) ? $instance['feattotal'] : "";

$unique_id = $args['widget_id'];

echo $before_widget;

echo $before_title . $feat_title . $after_title;

echo "<ul class='featured-cat-posts'>";
$my_query = new WP_Query('cat='. $feat_name . '&' . 'showposts=' . $feat_total);
while ($my_query->have_posts()) : $my_query->the_post();
$do_not_duplicate = $post->ID;
$the_post_ids = get_the_ID();
$thepostlink = '<a href="'. get_permalink() . '" title="' . the_title_attribute('echo=0') . '">';
if($feat_data == 'enable') { $feat_data_on = 'feat_data_on'; } else { $feat_data_on = 'feat_data_off';}
$comment_count = get_comments_number();
?>

<li class="<?php echo frkw_get_has_thumb_check(); ?> <?php echo $feat_data_on; ?> <?php echo 'the-sidefeat-'.$feat_thumb_size; ?>">
<?php if($feat_thumb == 'yes') { ?>
<?php if($feat_thumb_size == '' || $feat_thumb_size == 'thumbnail'): ?>
<?php echo frkw_get_featured_image($thepostlink,'</a>',50,50,'featpost alignleft','thumbnail',frkw_get_image_alt_text(), the_title_attribute('echo=0'), false); ?>
<?php else: ?>
<?php echo frkw_get_featured_image(''.$thepostlink,'</a>',480,320,'featpost alignleft','medium', frkw_get_image_alt_text(), the_title_attribute('echo=0'), false); ?>
<?php endif; ?>
<?php } ?>
<div class="feat-post-meta">
<h5 class="feat-title"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h5>
<?php if($feat_data != 'disable') { ?>
<div class="feat-meta"><small><span class="widget-feat-date fa fa-clock-o"><?php echo the_time( get_option( 'date_format' ) ); ?></span><?php if ( $comment_count > 0 ) { ?><span class="widget-feat-comment fa fa-commenting-o"><?php comments_popup_link(__('No Comment','whimag'), __('1 Comment','whimag'), __('% Comments','whimag') ); ?></span><?php } ?></small></div>
<?php } ?>
<?php do_action('mp_inside_feat_postmeta'); ?>
</div>
</li>
<?php endwhile; wp_reset_query(); ?>
<?php
echo "</ul>";
echo $after_widget;
// end echo result
}


function update($new_instance, $old_instance) {
//update and save the widget
return $new_instance;
}
function form($instance) {
global $choose_count;
// Get the options into variables, escaping html characters on the way
$feat_title = isset($instance['title']) ? $instance['title'] : "";
$feat_name = isset($instance['featcatname']) ? $instance['featcatname'] : "";
$feat_thumb_size = isset($instance['featthumbsize']) ? $instance['featthumbsize'] : "";
$feat_thumb = isset($instance['featthumb']) ? $instance['featthumb'] : "";
$feat_total = isset($instance['feattotal']) ? $instance['feattotal'] : "";
$feat_data = isset($instance['featdata']) ? $instance['featdata'] : "";
?>


<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e("Title:",'whimag'); ?> <em><?php _e("*required",'whimag'); ?></em></label>
<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $feat_title; ?>" />
</p>

<p><label for="<?php echo $this->get_field_id('featcatname'); ?>"><?php _e("Category ID:",'whimag'); ?><br /><em><?php _e("*separate by commas [,]",'whimag'); ?></em> </label>
<input type="text" class="widefat" id="<?php echo $this->get_field_id('featcatname'); ?>" name="<?php echo $this->get_field_name('featcatname'); ?>" value="<?php echo $feat_name; ?>" />
</p>

<p><label for="<?php echo $this->get_field_id('featthumb'); ?>"><?php _e('Enable Thumbnails?:<br /><em>*post featured images</em>', 'whimag'); ?></label>
<select class="widefat" id="<?php echo $this->get_field_id('featthumb'); ?>" name="<?php echo $this->get_field_name('featthumb'); ?>">
<option<?php if($feat_thumb == 'yes') { echo " selected='selected'"; } ?> name="<?php echo $this->get_field_name('featthumb'); ?>" value="yes"><?php _e('yes', 'whimag'); ?></option>
<option<?php if($feat_thumb== 'no') { echo " selected='selected'"; } ?> name="<?php echo $this->get_field_name('featthumb'); ?>" value="no"><?php _e('no', 'whimag'); ?></option>
</select>
</p>

<p><label for="<?php echo $this->get_field_id('featthumbsize'); ?>"><?php _e('Thumbnails Size?:', 'whimag'); ?>    </label>
<select class="widefat" id="<?php echo $this->get_field_id('featthumbsize'); ?>" name="<?php echo $this->get_field_name('featthumbsize'); ?>">
<option<?php if($feat_thumb_size == 'thumbnail') { echo " selected='selected'"; } ?> name="<?php echo $this->get_field_name('featthumbsize'); ?>" value="thumbnail"><?php _e('thumbnail', 'whimag'); ?></option>
<option<?php if($feat_thumb_size == 'medium') { echo " selected='selected'"; } ?> name="<?php echo $this->get_field_name('featthumbsize'); ?>" value="medium"><?php _e('medium', 'whimag'); ?></option>
</select>
</p>


<p><label for="<?php echo $this->get_field_id('featdata'); ?>"><?php _e('Enable Post Meta?:<br /><em>*post date and post comments count</em>', 'whimag'); ?></label>
<select class="widefat" id="<?php echo $this->get_field_id('featdata'); ?>" name="<?php echo $this->get_field_name('featdata'); ?>">
<option<?php if($feat_data == 'enable') { echo " selected='selected'"; } ?> name="<?php echo $this->get_field_name('featdata'); ?>" value="enable"><?php _e('Enable', 'whimag'); ?></option>
<option<?php if($feat_data == 'disable') { echo " selected='selected'"; } ?> name="<?php echo $this->get_field_name('featdata'); ?>" value="disable"><?php _e('Disable', 'whimag'); ?></option>
</select>
</p>


<p>
<label for="<?php echo $this->get_field_id('feattotal'); ?>"><?php _e('How many to show: ', 'whimag');?>
<select class="widefat" id="<?php echo $this->get_field_id('feattotal'); ?>" name="<?php echo $this->get_field_name('feattotal'); ?>">
<?php
foreach( $choose_count as $count ) {
if( $feat_total == $count ) { $selected = " selected='selected'"; } else { $selected = "";}
echo '<option'. $selected . ' name="'. $this->get_field_name('feattotal') . '" value="'. $count . '">' . $count . '</option>';
}
?>

</select>

</label>
</p>



<?php
}
}

/*--------------------------------------------
Multi Custom Post Type Featured Posts Widget
---------------------------------------------*/
class frkw_multi_featured_cpt_widget extends WP_Widget {
function __construct() {
//Constructor
parent::__construct(false, $name = __('Custom Post Type', 'whimag'), array(
'description' => __('Display your custom post type listing.', 'whimag')
));
}
function widget($args, $instance) {
global $bp_existed, $post;
// outputs the content of the widget
extract($args);
// Make before_widget, etc available.
$cpt_title = empty($instance['title']) ? __('Custom Posts', 'whimag') : apply_filters('widget_title', $instance['title']);
$cpt_name = isset($instance['cptname']) ? $instance['cptname'] : "";
$cpt_thumb = isset($instance['cptthumb']) ? $instance['cptthumb'] : "";

if($cpt_thumb == 'yes') {
$cpt_thumb_size = isset($instance['cptthumbsize']) ? $instance['cptthumbsize'] : "";
} else {
$cpt_thumb_size = 'thumb_off';
}

$cpt_data = isset($instance['cptdata']) ? $instance['cptdata'] : "";
$cpt_total = isset($instance['cpttotal']) ? $instance['cpttotal'] : "";
$unique_id = $args['widget_id'];
echo $before_widget;
echo $before_title . $cpt_title . $after_title;
echo "<ul class='featured-cat-posts'>";
$my_query = new WP_Query('post_type='. $cpt_name . '&' . 'showposts=' . $cpt_total);
while ($my_query->have_posts()) : $my_query->the_post();
$do_not_duplicate = $post->ID;
$the_post_ids = get_the_ID();
$thepostlink = '<a href="'. get_permalink() . '" title="' . the_title_attribute('echo=0') . '">';
if($cpt_data == 'enable') { $feat_data_on = 'feat_data_on'; } else { $feat_data_on = 'feat_data_off';}
$comment_count = get_comments_number();
?>
<li class="<?php echo frkw_get_has_thumb_check(); ?> <?php echo $feat_data_on; ?> <?php echo 'the-sidefeat-'.$cpt_thumb_size; ?>">
<?php if($cpt_thumb == 'yes') { ?>
<?php if($cpt_thumb_size == '' || $cpt_thumb_size == 'thumbnail'): ?>
<?php echo frkw_get_featured_image($thepostlink,'</a>',50,50,'featpost alignleft','thumbnail',frkw_get_image_alt_text(), the_title_attribute('echo=0'), false); ?>
<?php else: ?>
<?php echo frkw_get_featured_image(''.$thepostlink,'</a>',480,320,'featpost alignleft','medium', frkw_get_image_alt_text(), the_title_attribute('echo=0'), false); ?>
<?php endif; ?>
<?php } ?>
<div class="feat-post-meta">
<h5 class="feat-title"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h5>
<?php if($cpt_data != 'disable') { ?>
<div class="feat-meta"><small><span class="widget-feat-date fa fa-clock-o"><?php echo the_time( get_option( 'date_format' ) ); ?></span><?php if ( $comment_count > 0 ) { ?><span class="widget-feat-comment fa fa-commenting-o"><?php comments_popup_link(__('No Comment','whimag'), __('1 Comment','whimag'), __('% Comments','whimag') ); ?></span><?php } ?></small></div>
<?php } ?>
<?php do_action('mp_inside_feat_postmeta'); ?>
</div>
</li>
<?php endwhile; wp_reset_postdata(); ?>
<?php
echo "</ul>";
echo $after_widget;
// end echo result
}


function update($new_instance, $old_instance) {
//update and save the widget
return $new_instance;
}
function form($instance) {
global $choose_count;
// Get the options into variables, escaping html characters on the way
$cpt_title = isset($instance['title']) ? $instance['title'] : "";
$cpt_name = isset($instance['cptname']) ? $instance['cptname'] : "";
$cpt_thumb = isset($instance['cptthumb']) ? $instance['cptthumb'] : "";
$cpt_thumb_size = isset($instance['cptthumbsize']) ? $instance['cptthumbsize'] : "";
$cpt_data = isset($instance['cptdata']) ? $instance['cptdata'] : "";
$cpt_total = isset($instance['cpttotal']) ? $instance['cpttotal'] : "";
?>


<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e("Title:",'whimag'); ?> <em><?php _e("*required",'whimag'); ?></em></label>
<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $cpt_title; ?>" />
</p>
<p><label for="<?php echo $this->get_field_id('cptname'); ?>"><?php _e("Select Custom Post Type:",'whimag'); ?></label>
<select class="widefat" id="<?php echo $this->get_field_id('cptname'); ?>" name="<?php echo $this->get_field_name('cptname'); ?>">
<?php
$all_cpt = frkw_get_all_posttype();
if($all_cpt) {
foreach($all_cpt as $cpts) {
if($cpt_name == $cpts) { $is_selected = ' selected="selected" '; } else { $is_selected = ""; }
$cptlist = '<option '. $is_selected . 'name="'.$this->get_field_name('cptname').'" value="'.$cpts.'">'. $cpts. '</option>';
echo $cptlist;
}
}
?>
</select>
</p>

<p><label for="<?php echo $this->get_field_id('cptthumb'); ?>"><?php _e('Enable Thumbnails?:<br /><em>*post featured images</em>', 'whimag'); ?></label>
<select class="widefat" id="<?php echo $this->get_field_id('cptthumb'); ?>" name="<?php echo $this->get_field_name('cptthumb'); ?>">
<option<?php if($cpt_thumb == 'yes') { echo " selected='selected'"; } ?> name="<?php echo $this->get_field_name('cptthumb'); ?>" value="yes"><?php _e('yes', 'whimag'); ?></option>
<option<?php if($cpt_thumb== 'no') { echo " selected='selected'"; } ?> name="<?php echo $this->get_field_name('cptthumb'); ?>" value="no"><?php _e('no', 'whimag'); ?></option>
</select>
</p>

<p><label for="<?php echo $this->get_field_id('cptthumbsize'); ?>"><?php _e('Thumbnails Size?:', 'whimag'); ?>    </label>
<select class="widefat" id="<?php echo $this->get_field_id('cptthumbsize'); ?>" name="<?php echo $this->get_field_name('cptthumbsize'); ?>">
<option<?php if($cpt_thumb_size == 'thumbnail') { echo " selected='selected'"; } ?> name="<?php echo $this->get_field_name('cptthumbsize'); ?>" value="thumbnail"><?php _e('thumbnail', 'whimag'); ?></option>
<option<?php if($cpt_thumb_size == 'medium') { echo " selected='selected'"; } ?> name="<?php echo $this->get_field_name('cptthumbsize'); ?>" value="medium"><?php _e('medium', 'whimag'); ?></option>
</select>
</p>

<p><label for="<?php echo $this->get_field_id('cptdata'); ?>"><?php _e('Enable Post Meta?:<br /><em>*post date and post comments count</em>', 'whimag'); ?></label>
<select class="widefat" id="<?php echo $this->get_field_id('cptdata'); ?>" name="<?php echo $this->get_field_name('cptdata'); ?>">
<option<?php if($cpt_data == 'enable') { echo " selected='selected'"; } ?> name="<?php echo $this->get_field_name('cptdata'); ?>" value="enable"><?php _e('Enable', 'whimag'); ?></option>
<option<?php if($cpt_data == 'disable') { echo " selected='selected'"; } ?> name="<?php echo $this->get_field_name('cptdata'); ?>" value="disable"><?php _e('Disable', 'whimag'); ?></option>
</select>
</p>


<p>
<label for="<?php echo $this->get_field_id('cpttotal'); ?>"><?php _e('How many to show: ', 'whimag');?>
<select class="widefat" id="<?php echo $this->get_field_id('cpttotal'); ?>" name="<?php echo $this->get_field_name('cpttotal'); ?>">
<?php
foreach( $choose_count as $count ) {
if( $cpt_total == $count ) { $selected = " selected='selected'"; } else { $selected = "";}
echo '<option'. $selected . ' name="'. $this->get_field_name('cpttotal') . '" value="'. $count . '">' . $count . '</option>';
}
?>

</select>

</label>
</p>


<?php
}
}


/*--------------------------------------------
Description: add right sidebar ad widget
---------------------------------------------*/
function frkw_right_sidebar_ad_widget() {
$get_ads_right_sidebar = get_theme_mod('right_sidebar_ad_code'); if($get_ads_right_sidebar)  { ?>
<aside class="widget ads-widget">
<div class="textwidget"><?php echo stripcslashes(do_shortcode($get_ads_right_sidebar)); ?></div>
</aside>
<?php }
}
wp_register_sidebar_widget( 'theme_ads_right', 'Ads Right', 'frkw_right_sidebar_ad_widget','' );


/*--------------------------------------------
Description: add social box ad widget
---------------------------------------------*/
function frkw_social_box_ad_widget() {
?>
<aside class="widget">
<h3 class="widget-title"><?php _e('Stay Up Date', 'whimag'); ?></h3>
<?php echo frkw_add_social_box(); ?>
</aside>
<?php }
wp_register_sidebar_widget( 'theme_social_box', 'Social Box', 'frkw_social_box_ad_widget','' );


/*--------------------------------------------
Description: add tabber widget
---------------------------------------------*/
class frkw_widget_tabber extends WP_Widget {
function __construct() {
parent::__construct('theme_tabbed',__('Tabber', 'whimag'),array( 'description' => __( 'Multi tabber for sidebar', 'whimag' ) ) );
}
public function widget( $args, $instance ) {
get_template_part('/templates/tabber-widget');
}
public function form( $instance ) {}
public function update( $new_instance, $old_instance ) {}
}


/*--------------------------------------------
Description: register custom widget
---------------------------------------------*/
function frkw_register_custom_widget() {
register_widget('frkw_recent_posts_widget');
register_widget('frkw_popular_posts_widget');
register_widget('frkw_recent_comments_widget');
register_widget('frkw_multi_featured_cpt_widget');
register_widget('frkw_multi_featured_category_widget');
register_widget('frkw_widget_tabber');
}
add_action('widgets_init','frkw_register_custom_widget' );


?>
