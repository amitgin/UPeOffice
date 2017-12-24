<?php
/*
Template Name: Add New Corporation
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
<?php
if ( !is_user_logged_in() ) {
wp_redirect( '/login/?reauth=1' ); 
    exit;
}
?>
<?php global $wpdb;
$current_user = wp_get_current_user();
$org_name = $wpdb->get_results ( "SELECT `organization` FROM  uptron_contributor_list where `userid` LIKE '%". $current_user->user_login . "%' LIMIT 1" );
$result = $wpdb->get_results ( "SELECT * FROM  uptron_contributor_list" );

echo '<div style="width:100%; display: flex;">';
echo '<div style="width:50%; text-align: right;">';
echo '<label><f2 style="font-size: 25px; font-weight: bolder; padding-right: 15px;">Please Select Orgnization</f2></label>';
echo '</div>';
echo '<div style="width:50%; text-align: left;">';
echo '<select name="organizationlist">';
foreach ( $result as $page )
{
	echo '<option value="'.$page->organization.'">'.$page->organization.'</option>';
}
echo '</select>';
echo '</div>';
echo '</div>';
?>

<?php wp_create_user( $username, $password, $email ); ?>
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