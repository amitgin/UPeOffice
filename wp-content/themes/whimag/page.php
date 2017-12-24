<?php get_header(); ?>

<?php do_action( 'bp_before_content' ) ?>
<!-- CONTENT START -->
<div class="content">
<div class="content-inner">

<?php do_action( 'bp_before_blog_home' ) ?>

<!-- POST ENTRY END -->
<div id="post-entry">
<section class="post-entry-inner">

<?php if (have_posts()) : ?><?php while (have_posts()) : the_post(); ?>

<!-- POST START -->
<article <?php post_class('post-single page-single'); ?> id="post-<?php the_ID(); ?>" rel="author">

<?php //get_template_part( 'lib/templates/post-meta' ); ?>

<div class="sharebox-wrap">
<?php get_template_part( 'lib/templates/share-box' ); ?>
</div>

<div class="post-content">

<?php the_content( __('...more &raquo;',TEMPLATE_DOMAIN) ); ?>
<?php wp_link_pages('before=<div id="page-links">&after=</div>'); ?>

</div>

</article>
<!-- POST END -->

<?php endwhile; ?>

<?php if ( comments_open() ) { ?><?php comments_template( '', true ); ?><?php } ?>

<?php else : ?>

<?php get_template_part( 'lib/templates/result' ); ?>

<?php endif; ?>

</section>
</div>
<!-- POST ENTRY END -->

<?php do_action( 'bp_after_blog_home' ) ?>

</div><!-- CONTENT INNER END -->
</div><!-- CONTENT END -->

<?php do_action( 'bp_after_content' ) ?>

<?php get_sidebar(); ?>
<div id="carousel_container">
<div id="demo4" class="scroll-img">
	<ul>
		<li><div class="thumbnail thum_scroll"><a href="http://goidirectory.nic.in/index.php" title="Click to view more" target="_blank" onclick="return Confirmviewpage();"><img height="73" width="166" src="http://www.upeoffice.in/wp-content/uploads/2017/11/gov.jpg" alt="..."></a></div></li>
		<li><div class="thumbnail thum_scroll"><a href="http://eci.nic.in/" title="Click to view more" target="_blank" onclick="return Confirmviewpage();"><img height="73" width="166" src="http://www.upeoffice.in/wp-content/uploads/2017/11/election.gif" alt="..."></a></div></li>
		<li><div class="thumbnail thum_scroll"><a href="http://india.gov.in/" title="Click to view more" target="_blank" onclick="return Confirmviewpage();"><img height="73" width="166" src="http://www.upeoffice.in/wp-content/uploads/2017/11/indiaGov.gif" alt="..."></a></div></li>
		<li><div class="thumbnail thum_scroll"><a href="http://uponline.up.nic.in/" title="Click to view more" target="_blank" onclick="return Confirmviewpage();"><img height="73" width="166" src="http://www.upeoffice.in/wp-content/uploads/2017/11/logo_uponline.jpg" alt="..."></a></div></li>
		<li><div class="thumbnail thum_scroll"><a href="http://www.digitalindia.gov.in/" title="Click to view more" target="_blank" onclick="return Confirmviewpage();"><img height="73" width="166" src="http://www.upeoffice.in/wp-content/uploads/2017/11/logo_digitalindia.jpg" alt="..."></a></div></li>
		<li><div class="thumbnail thum_scroll"><a href="http://righttoinformation.gov.in/" title="Click to view more" target="_blank" onclick="return Confirmviewpage();"><img height="73" width="166" src="http://www.upeoffice.in/wp-content/uploads/2017/11/rti-icon.gif" alt="..."></a></div></li>
		<li><div class="thumbnail thum_scroll"><a href="http://www.itpolicyup.gov.in" title="Click to view more" target="_blank" onclick="return Confirmviewpage();"><img height="73" width="166" src="http://www.upeoffice.in/wp-content/uploads/2017/11/it-policy.png" alt="..."></a></div></li>
		<li><div class="thumbnail thum_scroll"><a href="http://up.gov.in/" title="Click to view more" target="_blank" onclick="return Confirmviewpage();"><img height="73" width="166" src="http://www.upeoffice.in/wp-content/uploads/2017/11/upgov-icon.gif" alt="..."></a></div></li>
		<li><div class="thumbnail thum_scroll"><a href="http://meity.gov.in/" title="Click to view more" target="_blank" onclick="return Confirmviewpage();"><img height="73" width="166" src="http://www.upeoffice.in/wp-content/uploads/2017/11/deity.jpg" alt="..."></a></div></li>
	</ul>
</div>
</div>
<?php get_footer(); ?>
