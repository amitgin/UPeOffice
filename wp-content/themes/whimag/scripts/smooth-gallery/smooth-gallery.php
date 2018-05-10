<?php
$featured_on = get_theme_mod('slider_on');
$featured_category = get_theme_mod('slider_feat_cat');
$featured_number = get_theme_mod('slider_feat_cat_count');
$featured_post = get_theme_mod('slider_feat_post');
?>

<?php if($featured_on == 'enable'): ?>
<?php if(!$featured_category && !$featured_post): ?>
<?php else: ?>
<?php if($featured_category): ?>

<!-- GALLERY SLIDER START -->
<div id="featuredbox">
<div id="featured">
<div id="Gallerybox">
<div id="myGallery">
<?php
$query = new WP_Query( "cat=$featured_category&posts_per_page=$featured_number&orderby=date" );
while ( $query->have_posts() ) : $query->the_post(); ?>
<div class="imageElement post-<?php the_ID(); ?>">

<?php
echo frkw_get_featured_image("", "", 640, 480, "alignleft full", "large", frkw_get_image_alt_text() ,the_title_attribute('echo=0'),false);
?>

<h3><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php echo the_title(); ?></a></h3>
<p><?php do_action('bp_before_slider_content'); ?><?php echo frkw_get_custom_the_excerpt(30); ?>
<?php do_action('bp_after_slider_content'); ?></p>
<a href="<?php the_permalink(); ?>" title="<?php _e('Continue reading ', 'whimag'); ?><?php echo the_title_attribute(); ?>" class="open"></a>
</div>
<?php endwhile; wp_reset_query(); ?>
</div><!-- MYGALLERY END -->
</div><!-- GALLERBOX END -->
</div><!-- FEATURED END -->
</div>
<!-- GALLERY SLIDER END -->


<?php elseif($featured_post && !$featured_category): ?>

<!-- GALLERY SLIDER START -->
<div id="featuredbox">
<div id="featured">
<div id="Gallerybox">
<div id="myGallery">
<?php
$allposttype = frkw_get_all_posttype();
query_posts( array( 'post__in' => explode(',', $featured_post), 'post_type'=> $allposttype, 'posts_per_page' => 100, 'ignore_sticky_posts' => 1, 'orderby' => 'post__in' ) );
while ( have_posts() ) : the_post();
?>
<div class="imageElement post-<?php the_ID(); ?>">

<?php
echo frkw_get_featured_image("", "", 640, 480, "alignleft full", "large", frkw_get_image_alt_text() ,the_title_attribute('echo=0'), false);
?>

<h3><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php echo the_title(); ?></a></h3>
<p><?php do_action('bp_before_slider_content'); ?><?php echo frkw_get_custom_the_excerpt(30); ?>
<?php do_action('bp_after_slider_content'); ?></p>
<a href="<?php the_permalink(); ?>" title="<?php _e('Continue reading ', 'whimag'); ?><?php echo the_title_attribute(); ?>" class="open"></a>
</div>
<?php endwhile; wp_reset_query(); ?>
</div><!-- MYGALLERY END -->
</div><!-- GALLERBOX END -->
</div><!-- FEATURED END -->
</div>
<!-- GALLERY SLIDER END -->

<?php endif; ?>
<?php endif; ?>
<?php endif; ?>
