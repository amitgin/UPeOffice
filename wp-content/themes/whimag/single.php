<?php get_header(); ?>

<?php do_action( 'bp_before_content' ) ?>
<!-- CONTENT START -->
<div class="content">
<div class="content-inner">

<?php do_action( 'bp_before_blog_home' ) ?>

<!-- POST ENTRY START -->
<div id="post-entry">
<section class="post-entry-inner">

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<!-- POST START -->
<article <?php post_class('post-single'); ?> id="post-<?php the_ID(); ?>" rel="author">

<h1 class="post-title"><?php the_title(); ?></h1>

<div class="sharebox-wrap">
<?php get_template_part( 'lib/templates/share-box' ); ?>
</div>
<div class="post-content">
<div class="adsense-single">
<!-- Google Adsense Code Start -->

<!-- Google Adsense Code End -->
</div>
<?php the_content( __('...more &raquo;',TEMPLATE_DOMAIN) ); ?>
</div>
</article>
<!-- POST END -->
<?php set_wp_post_view( get_the_ID() ); ?>
<?php endwhile; ?>
<?php else : ?>
<?php get_template_part( 'lib/templates/result' ); ?>
<?php endif; ?>
</section>
</div>
<!-- POST ENTRY END -->
</div><!-- CONTENT INNER END -->
</div><!-- CONTENT END -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
