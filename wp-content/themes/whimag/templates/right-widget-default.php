<?php $ads_right_sidebar = get_theme_mod('right_sidebar_ad_code'); if($ads_right_sidebar) { ?>
<aside class="widget ads-widget">
<div class="textwidget"><?php echo stripcslashes(do_shortcode($ads_right_sidebar)); ?></div>
</aside>
<?php } ?>

<aside class="widget">
<h3 class="widget-title"><?php _e('Stay Up Date', 'whimag'); ?></h3>
<?php echo frkw_add_social_box(); ?>
</aside>


<?php if ( !is_active_sidebar( 'tabbed-sidebar' ) ) : ?>
<div id="tabber-widget">
<div class="tabber">

<div class="tabbertab">
<aside class="widget">
<h3 class="widget-title"><?php _e('Recent Posts','whimag'); ?></h3>
<?php frkw_get_recent_posts('thumbnail','enable','','5'); ?>
</aside>
</div>

<div class="tabbertab">
<aside class="widget">
<h3 class="widget-title"><?php _e('Comments','whimag'); ?></h3>
<?php frkw_get_recent_comments(); ?>
</aside>
</div>


<div class="tabbertab">
<aside class="widget">
<h3 class="widget-title"><?php _e('Archives','whimag'); ?></h3>
<?php frkw_get_recent_posts('thumbnail','enable','5','5'); ?>
</aside>
</div>

</div>
</div>
<?php endif; ?>

<aside class="widget">
<h3 class="widget-title"><?php _e('Search','whimag'); ?></h3>
<?php get_search_form(); ?>
</aside>

<aside class="widget">
<h3 class="widget-title"><?php _e('Categories', 'whimag'); ?></h3>
<ul><?php wp_list_categories('orderby=name&show_count=1&title_li='); ?></ul>
</aside>


<aside class="widget">
<h3 class="widget-title"><?php _e('Popular Posts','whimag'); ?></h3>
<?php frkw_get_popular_posts('thumbnail','enable','5'); ?>
</aside>
