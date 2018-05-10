<?php if(!is_active_sidebar( 'first-footer-widget-area' ) && !is_active_sidebar( 'second-footer-widget-area' )  && !is_active_sidebar( 'third-footer-widget-area' )  && !is_active_sidebar( 'fourth-footer-widget-area' )  ) : ?>

<?php else: ?>

<footer class="footer-top">

<div class="ftop">
<div class="container-wrap">
<div class="fbox">
<div class="widget-area the-icons">
<?php if ( is_active_sidebar( 'first-footer-widget-area' ) ) : ?>
<?php dynamic_sidebar( 'first-footer-widget-area' ); ?>
<?php endif; ?>
</div>
</div>


<div class="fbox wider-cat">
<div class="widget-area the-icons">
<?php if ( is_active_sidebar( 'second-footer-widget-area' ) ) : ?>
<?php dynamic_sidebar( 'second-footer-widget-area' ); ?>
<?php endif; ?>
</div>
</div>


<div class="fbox">
<div class="widget-area the-icons">
<?php if ( is_active_sidebar( 'third-footer-widget-area' ) ) : ?>
<?php dynamic_sidebar( 'third-footer-widget-area' ); ?>
<?php endif; ?>
</div>
</div>


<div class="fbox">
<div class="widget-area the-icons">
<?php if ( is_active_sidebar( 'fourth-footer-widget-area' ) ) : ?>
<?php dynamic_sidebar( 'fourth-footer-widget-area' ); ?>
<?php endif; ?>
</div>
</div>


</div>
</div>



</footer><!-- FOOTER TOP END -->

<?php endif; //no footer-top sidebar found ?>


<footer class="footer-bottom">

<div class="fbottom">
<div class="footer-left">
<?php _e('Copyright &copy;', TEMPLATE_DOMAIN); ?> <?php echo gmdate(__('Y', TEMPLATE_DOMAIN)); ?>. <?php bloginfo('name'); ?>
</div><!-- FOOTER LEFT END -->

<div class="footer-right">
<?php if ( function_exists( 'wp_nav_menu' ) ) { // Added in 3.0 ?>
	<?php wp_nav_menu( array(
	'theme_location' => 'footer',
	'container' => false,
	'depth' => 1,
	'fallback_cb' => 'none'
	)); ?>
<?php } ?>
<?php get_template_part( 'lib/templates/social-box' ); ?>
</div>
<!-- FOOTER RIGHT END -->
</div>

</footer><!-- FOOTER BOTTOM END -->


</div><!-- CONTAINER WRAP END -->
</section><!-- CONTAINER END -->




</div><!-- INNERWRAP END -->
</div><!-- WRAPPER MAIN END -->
</div><!-- WRAPPER END -->

<div class="cleariefloat"></div>

<?php wp_footer(); ?>

<?php if( get_theme_option('social_on') == 'Yes' ) { ?>
<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
<?php } ?>

</body>

</html>
