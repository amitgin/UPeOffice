<footer class="entry-meta meta-top<?php if( is_page() ) { echo ' meta-no-display'; } ?>">


<span class="entry-author vcard"><?php _e('Posted by', 'whimag'); ?> <?php the_author_posts_link(); ?></span>

<span class="entry-date"><?php _e(' on ', 'whimag'); ?><time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo the_time( get_option( 'date_format' ) ); ?></time></span>


<?php _e(' in ', 'whimag'); ?>
<?php if( get_post_type() == 'post' ) { ?>
<span class="entry-category"><?php if(is_single() ) { the_category(', '); } else { echo frkw_get_singular_cat(); } ?></span>
<?php } else { ?>
<?php frkw_get_post_taxonomy(', ','<span class="entry-category">','</span>'); ?>
<?php } ?>

<?php if( has_tag() ) { ?>
<span class="entry-tag"><?php _e(' tags: ', 'whimag'); ?><?php the_tags('', ', '); ?></span>
<?php }
?>

<?php
if( get_theme_mod('entry_view_comment_count') == 'enable') { ?>
<div class="sec-entry-meta"><div class="sec-entry-meta-content">
<?php if ( comments_open()  ) { ?>
<span class="entry-comment"><?php comments_popup_link(__('0 Comment','whimag'), __('1 Comment','whimag'), __('% Comments','whimag') ); ?></span>
 <?php } ?>

<?php
global $post;
if ( function_exists( 'frkw_get_post_view' ) ) {
$view_count = frkw_get_post_view( get_the_ID() );
if(!$view_count) { $view_counts = '0 '. __('Read','whimag');
} elseif( $view_count == '1' ) {
$view_counts = '1 '. __('Read','whimag');
} else {
$view_counts = $view_count . ' ' . __('Reads','whimag');
} ?>
<span class="entry-view"><a title="<?php _e('Click here to read','whimag'); ?> <?php the_title_attribute(); ?>" href="<?php echo the_permalink(); ?>"> <?php echo $view_counts; ?></a></span>
<?php } ?>

</div></div>
<?php } ?>



</footer>
