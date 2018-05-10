<div id="right-sidebar" class="sidebar">
<div class="sidebar-inner">
<div class="widget-area the-icons">
<?php do_action('bp_before_right_sidebar'); ?>


<?php $get_google_code = get_theme_option('adsense_sidebar'); if($get_google_code == '') { ?>
<?php } else { ?>
<aside id="ctr-ad" class="widget">
<h3 class="widget-title"><?php _e('Links', TEMPLATE_DOMAIN); ?></h3>
<div class="textwidget"><?php echo stripcslashes($get_google_code); ?></div>
</aside>
<?php } ?>

<?php get_template_part('lib/templates/advertisment'); ?>

<?php get_template_part('lib/templates/sidebar-feat-cat'); ?>

<?php if ( is_active_sidebar( 'right-sidebar' ) ) : ?>
<?php dynamic_sidebar( 'right-sidebar' ); ?>
<?php else: ?>

<aside class="widget">
<h3 class="widget-title"><?php _e('Categories', TEMPLATE_DOMAIN); ?></h3>
<ul><?php wp_list_categories('orderby=name&show_count=1&title_li='); ?></ul>
</aside>

<aside class="widget">
<h3 class="widget-title"><?php _e('Archives',TEMPLATE_DOMAIN); ?></h3>
<ul><?php wp_get_archives('type=monthly&limit=12&show_post_count=1'); ?></ul>
</aside>

<aside class="widget">
<h3 class="widget-title"><?php _e('Calendar', TEMPLATE_DOMAIN); ?></h3>
<?php get_calendar(); ?>
</aside>

<aside class="widget">
<h3 class="widget-title"><?php _e('Meta', TEMPLATE_DOMAIN); ?></h3>
<ul>
<?php wp_register(); ?>
<li><?php wp_loginout(); ?></li>
<?php wp_meta(); ?>
</ul>
</aside>

<aside class="widget">
<h3 class="widget-title"><?php _e('About', TEMPLATE_DOMAIN); ?></h3>
<div class="textwidget">
<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Sed odio nibh, tincidunt adipiscing...<a href="#">more &raquo;</a></p>
</div>
</aside>


<?php endif; ?>


<?php /* WARNING: DON'T EDIT OR ADD ANYTHING INSIDE THIS LINE. THE THEME WILL DEACTIVATED IF THESE LINKS ARE MODIFIED IN ANY WAYS */?>
<aside id="text" class="widget widget_text">
<h3 class="widget-title"><a href="http://www.magpress.com/wordpress-themes/whimag.html" target="_blank">Whimag WordPress Theme</a></h3>
<div class="ctwidget"><?php echo ccc_footer_license(); ?></div>
<?php do_action('bp_after_right_sidebar'); ?>
</aside>
<?php /* WARNING: DON'T EDIT OR ADD ANYTHING INSIDE THIS LINE. THE THEME WILL DEACTIVATED IF THESE LINKS ARE MODIFIED IN ANY WAYS */?>


</div>
</div><!-- SIDEBAR-INNER END -->
</div><!-- RIGHT SIDEBAR END -->
