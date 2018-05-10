<?php
global $post;
$readmore = __('Continue Reading','whimag');
// strip special character in twitter
$texttitle_strip = str_replace('#','',the_title_attribute('echo=0'));
$texttitle = str_replace('@','',$texttitle_strip);
?>
<?php
if( get_theme_mod('social_on') == 'enable') { ?>
<div id="sharebox-wrap">
<div class="share_box">
<p class="fb"><a target="_blank" rel="nofollow" class="fa fa-facebook" title="<?php _e('Share this post in Facebook', 'whimag'); ?>" href="//www.facebook.com/sharer.php?u=<?php echo urlencode(get_permalink()); ?>"><span><?php _e('Share', 'whimag'); ?></span></a></p>
<p class="tw"><a target="_blank" rel="nofollow" class="fa fa-twitter" title="<?php _e('Share this post in Twitter', 'whimag'); ?>" href="//twitter.com/share?text=<?php echo urlencode($texttitle); ?>&url=<?php echo urlencode(get_permalink()); ?>"><span><?php _e('Tweet', 'whimag'); ?></span></a></p>
<p class="gp"><a rel="nofollow" class="fa fa-google-plus" title="<?php _e('Share this post in Google+', 'whimag'); ?>" href="//plus.google.com/share?url=<?php echo urlencode(get_permalink()); ?>"><span><?php _e('Plus+', 'whimag'); ?></span></a></p>

<p class="pinit"><a target="_blank" rel="nofollow" class="fa fa-pinterest" title="<?php _e('Pin this post in Pinterest', 'whimag'); ?>" href="//pinterest.com/pin/create/button/?url=<?php echo urlencode( get_permalink()); ?>&media=<?php $image_id = get_post_thumbnail_id($post->ID);$image_url = wp_get_attachment_image_src($image_id,'full', true); echo $image_url[0];  ?>&description=<?php echo urlencode($texttitle); ?>"><span><?php _e('Pin', 'whimag'); ?></span></a></p>


</div>
</div>
<?php } ?>
