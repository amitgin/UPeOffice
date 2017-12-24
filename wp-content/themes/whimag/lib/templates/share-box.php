<?php if( get_theme_option('social_on') == 'Yes') { ?>
<div class="share_box">

<div id="twitter_share" class="share_btn"><a href="http://twitter.com/share" data-url="<?php echo urlencode(get_permalink($post->ID)); ?>" class="twitter-share-button" data-count="horizontal"><?php _e('Tweet', TEMPLATE_DOMAIN); ?></a>
</div>

<div class="share_btn">
<div class="fb-like" data-href="<?php echo urlencode(get_permalink($post->ID)); ?>" data-send="true" data-layout="button_count" data-width="90" data-show-faces="false" data-font="arial"></div>
</div>

</div>
<?php } ?>
