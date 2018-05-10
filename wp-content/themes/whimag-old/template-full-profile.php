<?php
/*
Template Name: Profile Page
*/
?>
<?php
$current_user = wp_get_current_user();
?>
<?php get_header(); ?>

<?php do_action( 'bp_before_content' ) ?>
<!-- CONTENT START -->
<div class="content full-width">
<div class="content-inner">

<?php do_action( 'bp_before_blog_home' ) ?>

<!-- POST ENTRY -->
<div id="post-entry">
<section class="post-entry-inner">

<?php if (have_posts()) : ?><?php while (have_posts()) : the_post(); ?>

<article <?php post_class('post-single page-single'); ?> id="post-<?php the_ID(); ?>">
<div class="post-content">
<?php the_content( __('...Continue reading', TEMPLATE_DOMAIN) ); ?>
<?php wp_link_pages('before=<div id="page-links">&after=</div>'); ?>

<!-- **************************************  START Custom Code *********************************************** -->
<style>
    @media (max-width: 1000px) {
        .user-profile {
            width: 90%;
            border: 1px solid grey;
            padding: 15px;
            border-radius: 10px;
        }
    }
    @media (min-width: 1024px) {
        .user-profile {
            width: 50%;
            border: 1px solid grey;
            padding: 15px;
            border-radius: 10px;
        }
    }
</style>
<div align="center">
    <div class="user-profile" align="center">
    <?php echo do_shortcode("[theme-my-login]"); ?>
    </div>
</div>
<!-- **************************************  STOP Custom Code *********************************************** -->
</div><!-- POST CONTENT END -->
</article>

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

<?php get_footer(); ?>
