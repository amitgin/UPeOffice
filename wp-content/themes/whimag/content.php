<?php
global $oddpost;
do_action('mp_before_post_article'); ?>

<article <?php post_class( $oddpost ); ?> id="post-<?php the_ID(); ?>"<?php do_action('mp_article_start'); ?>>

<?php do_action('mp_before_post_wrapper'); ?>

<div class="post-wrapper">

<?php do_action('mp_before_post_title'); ?>

<header class="post-title">
<?php if( is_single() ) { ?>
<h1 class="entry-title"<?php do_action('mp_article_post_title'); ?>><?php the_title(); ?></h1>
<?php } else { ?>
<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
<?php } ?>
</header>

<?php do_action('mp_before_post_content'); ?>

<div class="post-content">
<?php do_action('mp_before_entry_content'); ?>
<div class="entry-content"<?php do_action('mp_article_post_content'); ?>>
<?php do_action('mp_before_the_content'); ?>
<?php if( is_singular() ) {
the_content();
if( function_exists('frkw_set_post_view') ) { frkw_set_post_view(get_the_ID()); }
} else {
echo frkw_get_custom_the_excerpt(50,'');
} ?>
<?php do_action('mp_after_the_content'); ?>
</div>
<?php do_action('mp_after_entry_content'); ?>
</div>

<?php do_action('mp_after_post_content'); ?>

</div>

<?php do_action('mp_after_post_wrapper'); ?>
</article>

<?php do_action('mp_after_post_article'); ?>
