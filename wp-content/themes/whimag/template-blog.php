<?php
/*
Template Name: Blog
*/
?>

<?php get_header(); ?>

<?php do_action( 'bp_before_content' ) ?>
<!-- CONTENT START -->
<div class="content">
<div class="content-inner">

<?php do_action( 'bp_before_blog_home' ) ?>

<!-- POST ENTRY START -->
<div id="post-entry">
<section class="post-entry-inner">

<?php
if ( is_home() && get_theme_option('slider_on') == 'Enable' ) {
if ( $paged >= 2 || $page >= 2 ) { } else {
get_template_part( 'lib/sliders/gallery-slider' );
}
}
?>

<?php
global $more; $more = 0;
$max_num_post = get_option('posts_per_page');
$page = (get_query_var('paged')) ? get_query_var('paged') : 1; query_posts("cat=&showposts=$max_num_post&paged=$page");
$oddpost = 'alt-post'; $postcount = 1;
if (have_posts()) : while ( have_posts() ) : the_post(); ?>

<?php do_action( 'bp_before_blog_post' ) ?>

<!-- POST START -->
<article <?php post_class($oddpost); ?> id="post-<?php the_ID(); ?>">


<h1 class="post-title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>
<?php get_template_part( 'lib/templates/post-meta' ); ?>

<div class="sharebox-wrap">
<?php get_template_part( 'lib/templates/share-box' ); ?>
</div>

<div class="post-content">

<?php echo get_featured_post_image("<div class='post-thumb'>", "</div>", 150, 150, "alignleft", "thumbnail", 'image-'.get_the_ID() ,get_the_title(), false); ?>

<?php get_the_featured_excerpt($excerpt_length=55); ?>

<?php $get_google_code = get_theme_option('adsense_post'); if($get_google_code == '') { ?>
<?php } else { ?>
<?php if(( 1 == $postcount) || (2 == $postcount) ){ ?>
<div class="adsense-post">
<?php echo stripcslashes($get_google_code); ?>
</div>
<?php } ?>
<?php } ?>

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
