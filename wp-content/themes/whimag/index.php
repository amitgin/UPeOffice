<?php get_header(); ?>

<?php do_action( 'bp_before_content' ) ?>

<!-- CONTENT START -->
<div class="content">
<div class="content-inner">

<?php do_action( 'bp_before_blog_home' ) ?>

<!-- POST ENTRY START -->
<div id="post-entry">
<section class="post-entry-inner">

<?php if( !is_home() ) { get_template_part( 'lib/templates/headline' ); } ?>


<?php
if ( is_home() && get_theme_option('slider_on') == 'Enable' ) {
if ( $paged >= 2 || $page >= 2 ) { } else {
get_template_part( 'lib/sliders/gallery-slider' );
}
}
?>


<?php $oddpost = 'alt-post'; $postcount = 1; if (have_posts()) : while (have_posts()) :  the_post(); ?>

<?php do_action( 'bp_before_blog_post' ) ?>

<!-- POST START -->
<article <?php post_class($oddpost); ?> id="post-<?php the_ID(); ?>">
<div style="float:left; display:flex; width: 100%;">
<h1 class="post-title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>
<div id="grav" style="float:right;margin-top:3%;"><?php echo get_avatar( get_the_author_email(), '48' ); ?></div>
</div>

<div class="post-content">

<?php echo get_featured_post_image("<div class='post-thumb'>", "</div>", 180, 180, "alignleft", "thumbnail", 'image-'.get_the_ID() ,get_the_title(), false); ?>

<?php get_the_featured_excerpt($excerpt_length=70); ?>

<?php if(( 1 == $postcount) || (2 == $postcount) ){ ?>
<div class="adsense-post">
<!-- Google Adsense Code Start-->
<?php echo do_shortcode('[php snippet=1]'); ?>
<!-- Google Adsense Code End-->
</div>
<?php } ?>
<div class="post-meta" style="margin-top:15px;"><span itemprop="dateCreated" class="post-time updated" datetime="2016-01-01T22:29:26+00:00"><i class="icon-time"></i><?php the_time('d F Y') ?></span> <span class="post-author vcard author fn hCard" style="margin-left:30px;"><i class="icon-user"></i><span class="fn hCard"><?php the_author_posts_link(); ?></span></span> <span class="post-category" style="margin-left:30px;"><i class="icon-folder-open"></i><?php the_category(', ') ?></span> <span id="post-readmore" style="float:right;"><a title="Click here to read <?php the_title(); ?>" href="<?php echo the_permalink(); ?>"> <?php echo $view_count; ?>Read More →</a></span>
<?php if ( current_user_can('edit_posts') ) { ?>
<span class="post-edit" style="margin-left:10px;><i class="icon-edit"></i><?php edit_post_link(__('Edit',TEMPLATE_DOMAIN)); ?></span>
<?php } ?>
</div>
</div>
</article>
<!-- POST END -->

<?php do_action( 'bp_after_blog_post' ) ?>

<?php ($oddpost == "alt-post") ? $oddpost="" : $oddpost="alt-post"; $postcount++; ?>

<?php endwhile; ?>

<?php comments_template( '', true ); ?>

<?php else: ?>

<?php get_template_part( 'lib/templates/result' ); ?>

<?php endif; ?>

<?php get_template_part( 'lib/templates/paginate' ); ?>

</section>
</div>
<!-- POST ENTRY END -->

<?php do_action( 'bp_after_blog_home' ) ?>

</div><!-- CONTENT INNER END -->
</div><!-- CONTENT END -->

<?php do_action( 'bp_after_content' ) ?>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
